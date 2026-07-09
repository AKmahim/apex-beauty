import * as THREE from 'three';

// Adapted from mitchcamza/Earth3D (MIT license) — https://github.com/mitchcamza/Earth3D
// Earth day/night shader technique from Bruno Simon's Three.js Journey.

const earthVertexShader = `
varying vec2 vUv;
varying vec3 vNormal;
varying vec3 vPosition;
void main() {
  vec4 modelPosition = modelMatrix * vec4(position, 1.0);
  gl_Position = projectionMatrix * viewMatrix * modelPosition;
  vec3 modelNormal = (modelMatrix * vec4(normal, 0.0)).xyz;
  vUv = uv;
  vNormal = modelNormal;
  vPosition = modelPosition.xyz;
}
`;

const earthFragmentShader = `
uniform sampler2D uDayTexture;
uniform sampler2D uNightTexture;
uniform sampler2D uSpecularCloudsTexture;
uniform vec3 uSunDirection;
uniform vec3 uAtmosphereDayColor;
uniform vec3 uAtmosphereTwilightColor;
varying vec2 vUv;
varying vec3 vNormal;
varying vec3 vPosition;
void main() {
  vec3 viewDirection = normalize(vPosition - cameraPosition);
  vec3 normal = normalize(vNormal);
  vec3 color = vec3(0.0);
  float sunOrientation = dot(uSunDirection, normal);
  float dayMix = smoothstep(-0.25, 0.5, sunOrientation);
  vec3 dayColor = texture2D(uDayTexture, vUv).rgb;
  vec3 nightColor = texture2D(uNightTexture, vUv).rgb;
  color = mix(nightColor, dayColor, dayMix);
  vec2 specularCloudsColor = texture2D(uSpecularCloudsTexture, vUv).rg;
  float cloudsMix = smoothstep(0.5, 1.0, specularCloudsColor.g);
  cloudsMix *= dayMix;
  color = mix(color, vec3(1.0), cloudsMix);
  float fresnel = dot(viewDirection, normal) + 1.0;
  fresnel = pow(fresnel, 2.0);
  float atmosphereDayMix = smoothstep(-0.5, 1.0, sunOrientation);
  vec3 atmosphereColor = mix(uAtmosphereTwilightColor, uAtmosphereDayColor, atmosphereDayMix);
  color = mix(color, atmosphereColor, fresnel * atmosphereDayMix);
  gl_FragColor = vec4(color, 1.0);
  #include <tonemapping_fragment>
  #include <colorspace_fragment>
}
`;

const atmosphereVertexShader = `
varying vec3 vNormal;
varying vec3 vPosition;
void main() {
  vec4 modelPosition = modelMatrix * vec4(position, 1.0);
  gl_Position = projectionMatrix * viewMatrix * modelPosition;
  vec3 modelNormal = (modelMatrix * vec4(normal, 0.0)).xyz;
  vNormal = modelNormal;
  vPosition = modelPosition.xyz;
}
`;

const atmosphereFragmentShader = `
uniform vec3 uSunDirection;
uniform vec3 uAtmosphereDayColor;
uniform vec3 uAtmosphereTwilightColor;
varying vec3 vNormal;
varying vec3 vPosition;
void main() {
  vec3 viewDirection = normalize(vPosition - cameraPosition);
  vec3 normal = normalize(vNormal);
  vec3 color = vec3(0.0);
  float sunOrientation = dot(uSunDirection, normal);
  float atmosphereDayMix = smoothstep(-0.5, 1.0, sunOrientation);
  vec3 atmosphereColor = mix(uAtmosphereTwilightColor, uAtmosphereDayColor, atmosphereDayMix);
  color = mix(color, atmosphereColor, atmosphereDayMix);
  color += atmosphereColor;
  float edgeAlpha = dot(viewDirection, normal);
  edgeAlpha = smoothstep(0.0, 0.5, edgeAlpha);
  // Keep a gentle blue limb glow even on the night side, so the horizon rim
  // stays luminous over the darkened region (matches the reference framing).
  float dayAlpha = smoothstep(-1.2, 0.1, sunOrientation);
  float alpha = edgeAlpha * dayAlpha;
  gl_FragColor = vec4(color, alpha);
  #include <tonemapping_fragment>
  #include <colorspace_fragment>
}
`;

function latLonToVector3(lat, lon, radius) {
  const phi = (90 - lat) * (Math.PI / 180);
  const theta = (lon + 180) * (Math.PI / 180);
  return new THREE.Vector3(
    -radius * Math.sin(phi) * Math.cos(theta),
    radius * Math.cos(phi),
    radius * Math.sin(phi) * Math.sin(theta)
  );
}

// Extrapolates along the great-circle arc from `a` through `b`, past `b`,
// by factor `t` (t=1 returns b, t>1 overshoots) — used to spread the country
// markers apart for readability without touching the real camera framing.
function slerpExtrapolate(a, b, t) {
  const dot = THREE.MathUtils.clamp(a.dot(b), -1, 1);
  const theta = Math.acos(dot);
  if (theta < 1e-5) return b.clone();
  const sinTheta = Math.sin(theta);
  const s0 = Math.sin((1 - t) * theta) / sinTheta;
  const s1 = Math.sin(t * theta) / sinTheta;
  return a.clone().multiplyScalar(s0).add(b.clone().multiplyScalar(s1)).normalize();
}

function makeDiscTexture() {
  const size = 64;
  const c = document.createElement('canvas');
  c.width = size;
  c.height = size;
  const ctx = c.getContext('2d');
  const grad = ctx.createRadialGradient(size / 2, size / 2, 0, size / 2, size / 2, size / 2);
  grad.addColorStop(0, 'rgba(255,255,255,1)');
  grad.addColorStop(0.4, 'rgba(255,255,255,0.55)');
  grad.addColorStop(1, 'rgba(255,255,255,0)');
  ctx.fillStyle = grad;
  ctx.fillRect(0, 0, size, size);
  return new THREE.CanvasTexture(c);
}

// Vertical gradient (warm amber at the base, fading toward the top) so the
// ground-node-to-flag connector reads as a faint rising glow rather than a
// rigid, stark-white pole. The color is baked directly into the texture
// (not left to material tinting) so additive blending can't wash it back to white.
function makeBeamTexture() {
  const w = 8;
  const h = 128;
  const c = document.createElement('canvas');
  c.width = w;
  c.height = h;
  const ctx = c.getContext('2d');
  const grad = ctx.createLinearGradient(0, h, 0, 0);
  grad.addColorStop(0, 'rgba(125,185,255,0.55)');
  grad.addColorStop(0.7, 'rgba(125,185,255,0.26)');
  grad.addColorStop(1, 'rgba(125,185,255,0.08)');
  ctx.fillStyle = grad;
  ctx.fillRect(0, 0, w, h);
  return new THREE.CanvasTexture(c);
}

// Small, minimal airplane silhouette: a slim tapered fuselage plus low, swept
// wings, sized to read as a premium aviation icon rather than a fat triangle.
function makePlaneMesh(size) {
  const group = new THREE.Group();

  const glowGeo = new THREE.SphereGeometry(size * 0.5, 8, 8);
  const glowMat = new THREE.MeshBasicMaterial({ color: 0xdcecff, transparent: true, opacity: 0.14 });
  const glow = new THREE.Mesh(glowGeo, glowMat);
  glow.userData.baseOpacity = 0.16;
  group.add(glow);

  const fuselageGeo = new THREE.ConeGeometry(size * 0.14, size * 0.95, 8);
  fuselageGeo.rotateX(Math.PI / 2);
  const bodyMat = new THREE.MeshBasicMaterial({ color: 0xffffff, transparent: true, opacity: 0.95 });
  const fuselage = new THREE.Mesh(fuselageGeo, bodyMat);
  fuselage.userData.baseOpacity = 0.95;
  group.add(fuselage);

  const wingGeo = new THREE.ConeGeometry(size * 0.34, size * 0.22, 3);
  wingGeo.rotateZ(Math.PI / 2);
  wingGeo.scale(1, 1, 0.16);
  const wingMat = new THREE.MeshBasicMaterial({ color: 0xffffff, transparent: true, opacity: 0.8 });
  const wings = new THREE.Mesh(wingGeo, wingMat);
  wings.position.z = size * 0.05;
  wings.userData.baseOpacity = 0.8;
  group.add(wings);

  return group;
}

// Soft glowing tube along a curve (thin bright core + wider translucent
// halo), anchored at real 3D endpoints — replaces flat lines that read as
// disconnected from the ground nodes.
function makeGlowTube(curve, color, baseOpacity) {
  const group = new THREE.Group();
  const coreGeo = new THREE.TubeGeometry(curve, 72, 0.0017, 6, false);
  const coreMat = new THREE.MeshBasicMaterial({
    color,
    transparent: true,
    opacity: baseOpacity,
    blending: THREE.AdditiveBlending,
    depthWrite: false
  });
  const core = new THREE.Mesh(coreGeo, coreMat);
  core.userData.baseOpacity = baseOpacity;
  group.add(core);

  const haloGeo = new THREE.TubeGeometry(curve, 72, 0.0036, 6, false);
  const haloMat = new THREE.MeshBasicMaterial({
    color,
    transparent: true,
    opacity: baseOpacity * 0.28,
    blending: THREE.AdditiveBlending,
    depthWrite: false
  });
  const halo = new THREE.Mesh(haloGeo, haloMat);
  halo.userData.baseOpacity = baseOpacity * 0.28;
  group.add(halo);

  return { group, core, halo };
}

// `spread` pushes each display pin outward from the cluster centroid along its
// real bearing — purely visual breathing room; every pin still lands inside
// (or right beside) its own country. Austria anchors on Linz, the clinic HQ.
const COUNTRIES = [
  { id: 'de', lat: 48.14, lon: 11.58, hub: false, spread: 2.3 },
  { id: 'ch', lat: 47.38, lon: 8.54, hub: false, spread: 2.3 },
  { id: 'at', lat: 48.31, lon: 14.29, hub: true, spread: 2.3 },
  { id: 'tr', lat: 41.01, lon: 28.98, hub: false, spread: 1.3 }
];
// Full mesh: every clinic country connects to every other one, so the section
// reads as one connected ecosystem rather than a single corridor.
const ROUTES = [
  ['at', 'de'], ['de', 'ch'], ['ch', 'tr'], ['at', 'tr'], ['at', 'ch'], ['de', 'tr']
];
const MAIN_ROUTE = ['at', 'tr'];
// Fraction of the viewport height that should read as open starfield above
// the planet's limb. The approved reference is earth-dominant: horizon in the
// upper third, the planet majestically filling the lower two-thirds.
const TARGET_SKY_FRACTION = 0.33;
// How far each marker is pushed outward from the cluster centroid along its
// true geodesic bearing — clarity over strict geography, while every pin
// still lands on believable ground near its real country.
const MARKER_SPREAD = 1.7;

export function initEarthGlobe(root) {
  const canvas = root.querySelector('canvas.earth-canvas');
  const markerLayer = root.querySelector('.earth-markers');
  if (!canvas || !markerLayer || typeof THREE === 'undefined') return;

  const scene = new THREE.Scene();
  const camera = new THREE.PerspectiveCamera(55, 1, 0.1, 1000);

  // True centroid of the country cluster: used for sun direction (night side)
  // and as the reference axis the camera orbits around.
  const baseDirection = new THREE.Vector3();
  COUNTRIES.forEach((c) => baseDirection.add(latLonToVector3(c.lat, c.lon, 1)));
  baseDirection.normalize();
  const baseSpherical = new THREE.Spherical().setFromVector3(baseDirection);

  // The camera itself orbits from a point offset "south" of that centroid —
  // like a satellite hovering past the region rather than directly overhead —
  // so once the horizon tilt (below) pitches the view up, the country
  // cluster reads near the top of the visible earth band instead of the
  // sub-camera point sinking below frame.
  const CAMERA_PHI_OFFSET = THREE.MathUtils.degToRad(18);
  const camSphericalBase = new THREE.Spherical(
    1,
    baseSpherical.phi + CAMERA_PHI_OFFSET,
    baseSpherical.theta
  );

  const directionalLight = new THREE.DirectionalLight(0xffffff, 5);
  directionalLight.position.set(5, 4, 5);
  scene.add(directionalLight);
  scene.add(new THREE.AmbientLight(0x404040, 0.5));

  const renderer = new THREE.WebGLRenderer({ canvas, antialias: true, alpha: true });
  renderer.setClearColor(0x000000, 0);

  const textureLoader = new THREE.TextureLoader();
  const base = root.getAttribute('data-asset-base') || 'assets/earth/';
  const dayTex = textureLoader.load(base + 'earth-day.jpg');
  dayTex.colorSpace = THREE.SRGBColorSpace;
  const nightTex = textureLoader.load(base + 'earth-night.jpg');
  nightTex.colorSpace = THREE.SRGBColorSpace;
  const specularCloudsTex = textureLoader.load(base + 'earth-specular-clouds.jpg');
  const bumpTex = textureLoader.load(base + 'earth-bump.jpg');
  const metalnessTex = textureLoader.load(base + 'earth-metalness.jpg');

  // Sun placed opposite our region so the framed hemisphere shows night lights by default.
  const sunDirection = baseDirection.clone().negate().add(new THREE.Vector3(0.2, 0.12, 0)).normalize();

  const earthGeometry = new THREE.SphereGeometry(1, 64, 64);
  const earthMaterial = new THREE.ShaderMaterial({
    vertexShader: earthVertexShader,
    fragmentShader: earthFragmentShader,
    uniforms: {
      uDayTexture: new THREE.Uniform(dayTex),
      uNightTexture: new THREE.Uniform(nightTex),
      uSpecularCloudsTexture: new THREE.Uniform(specularCloudsTex),
      uSunDirection: new THREE.Uniform(sunDirection),
      uAtmosphereDayColor: new THREE.Uniform(new THREE.Color(0xa8d8ff)),
      uAtmosphereTwilightColor: new THREE.Uniform(new THREE.Color(0x3a5cb5))
    }
  });
  earthMaterial.bumpMap = bumpTex;
  earthMaterial.bumpScale = 3.0;
  earthMaterial.metalnessMap = metalnessTex;
  earthMaterial.metalness = 0.1;
  earthMaterial.roughness = 0.6;

  const earth = new THREE.Mesh(earthGeometry, earthMaterial);
  scene.add(earth);

  const atmosphereMaterial = new THREE.ShaderMaterial({
    side: THREE.BackSide,
    transparent: true,
    vertexShader: atmosphereVertexShader,
    fragmentShader: atmosphereFragmentShader,
    uniforms: {
      uSunDirection: new THREE.Uniform(sunDirection),
      uAtmosphereDayColor: new THREE.Uniform(new THREE.Color(0xa8d8ff)),
      uAtmosphereTwilightColor: new THREE.Uniform(new THREE.Color(0x3a5cb5))
    }
  });
  const atmosphere = new THREE.Mesh(earthGeometry, atmosphereMaterial);
  atmosphere.scale.setScalar(1.05);
  scene.add(atmosphere);

  // Ambient particles surrounding the globe
  const particleCount = 550;
  const particlePositions = new Float32Array(particleCount * 3);
  for (let i = 0; i < particleCount; i++) {
    const r = THREE.MathUtils.randFloat(1.35, 2.7);
    const theta = Math.random() * Math.PI * 2;
    const phi = Math.acos(THREE.MathUtils.randFloatSpread(2));
    particlePositions[i * 3] = r * Math.sin(phi) * Math.cos(theta);
    particlePositions[i * 3 + 1] = r * Math.cos(phi);
    particlePositions[i * 3 + 2] = r * Math.sin(phi) * Math.sin(theta);
  }
  const particleGeo = new THREE.BufferGeometry();
  particleGeo.setAttribute('position', new THREE.BufferAttribute(particlePositions, 3));
  const particleMat = new THREE.PointsMaterial({
    size: 0.022,
    map: makeDiscTexture(),
    transparent: true,
    depthWrite: false,
    blending: THREE.AdditiveBlending,
    opacity: 0.75,
    color: 0x9fd8ff
  });
  const particles = new THREE.Points(particleGeo, particleMat);
  scene.add(particles);

  // Country markers: glowing ground node -> thin vertical connector -> flag anchor.
  // The flag is only a label; the network itself begins and ends at the ground node.
  const markerGroup = new THREE.Group();
  scene.add(markerGroup);
  const markerMeshes = {};
  const groundPositions = {};
  const PIN_HEIGHT = 0.052;
  const beamTexture = makeBeamTexture();
  COUNTRIES.forEach((c) => {
    const trueDir = latLonToVector3(c.lat, c.lon, 1).normalize();
    const displayDir = slerpExtrapolate(baseDirection, trueDir, c.spread || MARKER_SPREAD);
    const groundPos = displayDir.clone().multiplyScalar(1.006);
    const tipPos = displayDir.clone().multiplyScalar(1.006 + PIN_HEIGHT);
    groundPositions[c.id] = groundPos;

    const dotGeo = new THREE.SphereGeometry(c.hub ? 0.0072 : 0.0054, 14, 14);
    const dotMat = new THREE.MeshBasicMaterial({ color: 0x8ecbff });
    const dot = new THREE.Mesh(dotGeo, dotMat);
    dot.position.copy(groundPos);
    markerGroup.add(dot);

    const dotGlowGeo = new THREE.SphereGeometry(c.hub ? 0.0168 : 0.0132, 14, 14);
    const dotGlowMat = new THREE.MeshBasicMaterial({
      color: 0x38bdf8,
      transparent: true,
      opacity: 0.4,
      blending: THREE.AdditiveBlending,
      depthWrite: false
    });
    const dotGlow = new THREE.Mesh(dotGlowGeo, dotGlowMat);
    dotGlow.position.copy(groundPos);
    dotGlow.userData.baseOpacity = 0.35;
    markerGroup.add(dotGlow);

    // A slim tapered light stem (color baked into the gradient texture) that
    // stays visible all the way up to the tip ball, so the flag badge reads
    // as sitting on it — a lollipop pin, not a floating flag over a stub.
    const stickGeo = new THREE.CylinderGeometry(0.0016, 0.003, PIN_HEIGHT, 8, 1, true);
    const stickMat = new THREE.MeshBasicMaterial({
      map: beamTexture,
      transparent: true,
      opacity: 0.55,
      blending: THREE.AdditiveBlending,
      depthWrite: false,
      side: THREE.DoubleSide
    });
    const stick = new THREE.Mesh(stickGeo, stickMat);
    stick.position.copy(groundPos).add(tipPos).multiplyScalar(0.5);
    stick.quaternion.setFromUnitVectors(new THREE.Vector3(0, 1, 0), displayDir);
    markerGroup.add(stick);

    const tipGeo = new THREE.SphereGeometry(0.0038, 10, 10);
    const tipMat = new THREE.MeshBasicMaterial({
      color: 0x9fc8ff,
      transparent: true,
      opacity: 0.75,
      blending: THREE.AdditiveBlending,
      depthWrite: false
    });
    const tip = new THREE.Mesh(tipGeo, tipMat);
    tip.position.copy(tipPos);
    markerGroup.add(tip);
    markerMeshes[c.id] = tip;
  });

  // Full-mesh connections: every route is a soft glowing tube starting and
  // ending exactly at the ground nodes. Arc height scales with route length
  // (like real airline route maps), so every curve shares the same graceful
  // curvature family — short hops stay low, the long leg sweeps higher.
  const routes = [];
  let mainRouteData = null;
  ROUTES.forEach(([fromId, toId]) => {
    const p0 = groundPositions[fromId].clone();
    const p1 = groundPositions[toId].clone();
    const chord = p0.distanceTo(p1);
    const arcHeight = Math.max(0.025, chord * 0.34);
    const mid = p0.clone().add(p1).multiplyScalar(0.5);
    mid.normalize().multiplyScalar(1 + arcHeight);

    const curve = new THREE.QuadraticBezierCurve3(p0, mid, p1);
    const isMain =
      (fromId === MAIN_ROUTE[0] && toId === MAIN_ROUTE[1]) ||
      (fromId === MAIN_ROUTE[1] && toId === MAIN_ROUTE[0]);
    const baseOpacity = isMain ? 0.8 : 0.42;
    const color = isMain ? 0x38bdf8 : 0x3b82f6;
    const { group: tubeGroup, core, halo } = makeGlowTube(curve, color, baseOpacity);
    markerGroup.add(tubeGroup);

    // Bidirectional flowing particles: several soft dots per direction,
    // fading in/out at the endpoints so the loop never visibly "teleports".
    const flowParticles = [];
    const perDirection = 2;
    for (let dir = 0; dir < 2; dir++) {
      for (let i = 0; i < perDirection; i++) {
        const mat = new THREE.SpriteMaterial({
          map: makeDiscTexture(),
          color: 0x8ecbff,
          transparent: true,
          depthWrite: false,
          blending: THREE.AdditiveBlending,
          opacity: 0
        });
        const sprite = new THREE.Sprite(mat);
        const s = isMain ? 0.02 : 0.015;
        sprite.scale.setScalar(s);
        markerGroup.add(sprite);
        flowParticles.push({
          sprite,
          reverse: dir === 1,
          speed: 0.055 + Math.random() * 0.015,
          offset: (i / perDirection) + Math.random() * 0.06
        });
      }
    }

    const routeData = { from: fromId, to: toId, curve, core, halo, baseOpacity, flowParticles, isMain };
    routes.push(routeData);
    if (isMain) mainRouteData = routeData;
  });

  // A single premium-style plane, confined to the Austria <-> Turkey route
  // only: ease out, pause, ease back, pause, repeat.
  const plane = mainRouteData ? makePlaneMesh(0.012) : null;
  if (plane) markerGroup.add(plane);
  const PLANE_LEG = 6;
  const PLANE_PAUSE = 2;
  const PLANE_CYCLE = PLANE_LEG * 2 + PLANE_PAUSE * 2;
  const easeInOutSine = (t) => -(Math.cos(Math.PI * t) - 1) / 2;

  // Cursor parallax: subtle orbit around the fixed country framing, no click-drag needed.
  let camDistance = 2;
  let targetTheta = camSphericalBase.theta;
  let targetPhi = camSphericalBase.phi;
  let currentTheta = camSphericalBase.theta;
  let currentPhi = camSphericalBase.phi;
  const maxYaw = THREE.MathUtils.degToRad(16);
  const maxPitch = THREE.MathUtils.degToRad(11);

  function onPointerMove(e) {
    const rect = root.getBoundingClientRect();
    const nx = ((e.clientX - rect.left) / rect.width) * 2 - 1;
    const ny = ((e.clientY - rect.top) / rect.height) * 2 - 1;
    targetTheta = camSphericalBase.theta - THREE.MathUtils.clamp(nx, -1, 1) * maxYaw;
    targetPhi = THREE.MathUtils.clamp(
      camSphericalBase.phi - THREE.MathUtils.clamp(ny, -1, 1) * maxPitch,
      camSphericalBase.phi - maxPitch,
      camSphericalBase.phi + maxPitch
    );
  }
  function onPointerLeave() {
    targetTheta = camSphericalBase.theta;
    targetPhi = camSphericalBase.phi;
  }
  root.addEventListener('pointermove', onPointerMove);
  root.addEventListener('pointerleave', onPointerLeave);

  function resize() {
    const w = root.clientWidth;
    const h = root.clientHeight;
    if (!w || !h) return;
    camera.aspect = w / h;
    camera.updateProjectionMatrix();
    renderer.setSize(w, h, false);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    const vFovRad = THREE.MathUtils.degToRad(camera.fov);
    const hFovRad = 2 * Math.atan(Math.tan(vFovRad * 0.5) * camera.aspect);
    const outerRadius = 1.05;
    // Size the sphere off the *horizontal* FOV, overfilled so the surface
    // floods the bottom of the frame and the horizon arc exits the left and
    // right edges partway up — the close, earth-dominant reference framing.
    // (1.15 pulls the camera back ~13% vs. the previous 1.32, revealing more
    // of the globe/space at the same angle — a pure zoom-out, not a re-tilt.)
    camDistance = outerRadius / Math.sin(hFovRad * 0.5 * 1.15);

    // The sphere's silhouette is a cone of this half-angle around the
    // camera-to-center axis, regardless of camera orientation.
    const angularRadius = Math.asin(outerRadius / camDistance);
    // Pitching the camera's view axis upward by `horizonTilt` (after
    // lookAt(0,0,0)) shifts that whole cone toward the bottom of the frame,
    // leaving open starfield above — this is what actually produces the
    // low-orbit "horizon" composition, vs. a dead-centered globe.
    const horizonYNdc = 1 - 2 * TARGET_SKY_FRACTION;
    horizonTilt = angularRadius - Math.atan(horizonYNdc * Math.tan(vFovRad * 0.5));
  }
  let horizonTilt = 0;
  resize();
  // A ResizeObserver (rather than only window 'resize') catches every real
  // change to the container's own box — including the CSS aspect-ratio box
  // settling after web fonts / surrounding layout finish, which can land at
  // a slightly different size than the very first layout pass without ever
  // firing a window resize event. Left unhandled, the camera's aspect (and
  // therefore the WebGL canvas's internal buffer) goes stale relative to the
  // box's live size used for the DOM flag/label math every frame, which
  // silently stretches the render and pulls the poles out of sync with the
  // flags — this showed up as a Chrome/Safari difference because the two
  // browsers don't settle that layout at exactly the same moment.
  const resizeObserver = new ResizeObserver(() => resize());
  resizeObserver.observe(root);

  const labelEls = {};
  COUNTRIES.forEach((c) => {
    labelEls[c.id] = markerLayer.querySelector('[data-id="' + c.id + '"]');
  });
  const projected = new THREE.Vector3();

  function updateMarkerPositions() {
    const w = root.clientWidth;
    const h = root.clientHeight;
    COUNTRIES.forEach((c) => {
      const mesh = markerMeshes[c.id];
      const el = labelEls[c.id];
      if (!mesh || !el) return;
      // Anchor directly on the pole tip's own screen position — the flag is
      // then centered purely vertically above it via CSS, so it never leans
      // or drifts off the pole's axis regardless of perspective.
      mesh.getWorldPosition(projected);
      projected.project(camera);
      const behind = projected.z > 1;
      const x = (projected.x * 0.5 + 0.5) * w;
      const y = (-projected.y * 0.5 + 0.5) * h;
      el.style.transform = 'translate(' + x + 'px,' + y + 'px) translate(-50%,-50%)';
      el.style.opacity = behind ? '0' : '1';
      el.style.zIndex = String(Math.round((1 - projected.z) * 1000));
    });
  }

  const tangentTmp = new THREE.Vector3();
  const up = new THREE.Vector3(0, 1, 0);
  const quatTmp = new THREE.Quaternion();

  let running = false;
  const clock = new THREE.Clock();
  const camSpherical = new THREE.Spherical();
  function tick() {
    if (!running) return;
    const elapsed = clock.getElapsedTime();

    routes.forEach((r) => {
      r.flowParticles.forEach((p) => {
        let t = (elapsed * p.speed + p.offset) % 1;
        if (p.reverse) t = 1 - t;
        r.curve.getPointAt(t, p.sprite.position);
        const edge = Math.min(t, 1 - t);
        const fade = Math.min(1, edge / 0.18);
        p.sprite.material.opacity = 0.7 * fade * p.sprite.userData.hoverMul;
      });
    });

    if (plane && mainRouteData) {
      const t = elapsed % PLANE_CYCLE;
      let travelT;
      let reverse = false;
      if (t < PLANE_LEG) {
        travelT = easeInOutSine(t / PLANE_LEG);
      } else if (t < PLANE_LEG + PLANE_PAUSE) {
        travelT = 1;
      } else if (t < PLANE_LEG * 2 + PLANE_PAUSE) {
        travelT = 1 - easeInOutSine((t - PLANE_LEG - PLANE_PAUSE) / PLANE_LEG);
        reverse = true;
      } else {
        travelT = 0;
        reverse = true;
      }
      mainRouteData.curve.getPointAt(travelT, plane.position);
      mainRouteData.curve.getTangentAt(travelT, tangentTmp);
      if (reverse) tangentTmp.negate();
      quatTmp.setFromUnitVectors(up, tangentTmp.normalize());
      plane.quaternion.copy(quatTmp);
    }

    particles.rotation.y = elapsed * 0.012;

    // Barely-there drift: the whole world (earth + network) sways a couple of
    // degrees over ~80s. Sine keeps it bounded, so the framing never walks
    // away from the countries no matter how long the page stays open.
    const sway = Math.sin(elapsed * ((Math.PI * 2) / 80)) * THREE.MathUtils.degToRad(2.2);
    earth.rotation.y = sway;
    markerGroup.rotation.y = sway;

    currentTheta += (targetTheta - currentTheta) * 0.055;
    currentPhi += (targetPhi - currentPhi) * 0.055;
    camSpherical.set(camDistance, currentPhi, currentTheta);
    camera.position.setFromSpherical(camSpherical);
    camera.lookAt(0, 0, 0);
    camera.rotateX(horizonTilt);

    renderer.render(scene, camera);
    updateMarkerPositions();
    requestAnimationFrame(tick);
  }

  routes.forEach((r) => {
    r.flowParticles.forEach((p) => { p.sprite.userData.hoverMul = 1; });
  });

  const io = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      const wasRunning = running;
      running = entry.isIntersecting;
      if (running && !wasRunning) tick();
    });
  }, { threshold: 0.05 });
  io.observe(root);

  function setHover(id) {
    routes.forEach((r) => {
      const connected = r.from === id || r.to === id;
      const mul = connected ? 1 : 0.06;
      r.core.material.opacity = r.baseOpacity * mul;
      r.halo.material.opacity = r.baseOpacity * 0.28 * mul;
      r.flowParticles.forEach((p) => { p.sprite.userData.hoverMul = mul; });
    });
  }
  function clearHover() {
    routes.forEach((r) => {
      r.core.material.opacity = r.baseOpacity;
      r.halo.material.opacity = r.baseOpacity * 0.28;
      r.flowParticles.forEach((p) => { p.sprite.userData.hoverMul = 1; });
    });
  }

  return { setHover, clearHover };
}

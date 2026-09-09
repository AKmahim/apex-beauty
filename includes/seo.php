<?php

declare(strict_types=1);

require_once __DIR__ . '/site-config.php';
require_once __DIR__ . '/content.php';
require_once __DIR__ . '/i18n.php';

// Everything search engines and answer engines read about a page: the title
// and description in the <head>, the robots switch, the share image, and the
// sitemap.xml / llms.txt built from all of it.
//
// Two rules hold this together:
//
//  1. The admin panel wins, code is the safety net. Every page keeps its
//     hand-written title and description in the registry below, so an admin
//     field that is empty (or a data/content/*.json that never got a `seo`
//     block) can never blank out a page's SEO. The CMS value simply takes
//     over when there is one.
//
//  2. One switch, not two. `noindex` decides both the page's own robots meta
//     tag and whether the page appears in sitemap.xml and robots.txt, so the
//     three cannot contradict each other the way hand-maintained files did.

// Canonical path, crawl hints, and the English name used in llms.txt, keyed by
// CMS page key so a page's admin content, its template, its sitemap entry and
// its llms.txt line all come from one row.
function apex_seo_registry(): array
{
    static $registry = null;
    if ($registry !== null) {
        return $registry;
    }

    $registry = [
        'home' => [
            'path' => '',
            'template' => 'index.php',
            'name' => 'Home',
            'changefreq' => 'weekly',
            'priority' => '1.0',
            'title' => [
                'de' => 'Haartransplantation Österreich: Apex Beauty für Beratung, Behandlung & Nachsorge',
                'en' => 'Hair Transplant Austria: Apex Beauty for Consultation, Treatment & Aftercare',
            ],
            'description' => [
                'de' => 'Persönliche Beratung in Österreich, Haartransplantation in unserer führenden Klinik in der Türkei und professionelle Nachsorge in Österreich, Deutschland und der Schweiz. Eines der größten Nachsorgenetzwerke Europas.',
                'en' => "Personal consultation in Austria, hair transplantation at our leading clinic in Turkey, and professional aftercare in Austria, Germany and Switzerland. One of Europe's largest aftercare networks.",
            ],
        ],
        'service' => [
            'path' => 'service-hair-transplant',
            'template' => 'service-hair-transplant.php',
            'name' => 'Hair Transplant procedure',
            'changefreq' => 'monthly',
            'priority' => '0.9',
            'title' => [
                'de' => 'Haartransplantation: Ablauf, Eignung & Ergebnisse | Apex Beauty',
                'en' => 'Hair Transplant: Procedure, Candidacy & Results | Apex Beauty',
            ],
            'description' => [
                'de' => 'Ihr Leitfaden zur Haartransplantation von Apex Beauty: was die Behandlung umfasst, wer geeignet ist, wie die Genesung verläuft und welche Ergebnisse Sie erwarten können.',
                'en' => "Your guide to hair transplantation from Apex Beauty: what the treatment involves, who's a good candidate, how recovery goes, and what results to expect.",
            ],
        ],
        'prices' => [
            'path' => 'prices',
            'template' => 'prices.php',
            'name' => 'Prices',
            'changefreq' => 'monthly',
            'priority' => '0.9',
            'title' => [
                'de' => 'Haartransplantation Preise & Pakete | Apex Beauty',
                'en' => 'Hair Transplant Prices & Packages | Apex Beauty',
            ],
            'description' => [
                'de' => 'Transparente Komplettpreise für Ihre Haartransplantation bei Apex Beauty{range} - inklusive PRP, Medikamenten und ärztlicher Nachbehandlung.',
                'en' => 'Transparent all-in package prices for a hair transplant at Apex Beauty{range} - including PRP, medication and medical follow-ups.',
            ],
        ],
        'doctor' => [
            'path' => 'doctor',
            'template' => 'doctor.php',
            'name' => 'Doctor',
            'changefreq' => 'monthly',
            'priority' => '0.8',
            'title' => [
                'de' => APEX_PHYSICIAN_NAME . ', Ihr Facharzt für Haartransplantation | Apex Beauty',
                'en' => APEX_PHYSICIAN_NAME . ', Your Hair Transplant Specialist | Apex Beauty',
            ],
            'description' => [
                'de' => 'Lernen Sie ' . APEX_PHYSICIAN_NAME . ' kennen, verantwortlich für die medizinische Qualität jeder Haartransplantation bei Apex Beauty.',
                'en' => 'Meet ' . APEX_PHYSICIAN_NAME . ', responsible for the medical quality of every hair transplant at Apex Beauty.',
            ],
        ],
        'hairpedia' => [
            'path' => 'hairpedia',
            'template' => 'hairpedia.php',
            'name' => 'Hairpedia',
            'changefreq' => 'monthly',
            'priority' => '0.8',
            'title' => [
                'de' => 'Hairpedia: Ursachen, Diagnose & Behandlung von Haarausfall | Apex Beauty',
                'en' => 'Hairpedia: Causes, Diagnosis & Treatment of Hair Loss | Apex Beauty',
            ],
            'description' => [
                'de' => 'Alles über Haarausfall: Ursachen, Arten, Diagnose, Behandlungsmöglichkeiten und Haartransplantation, verständlich erklärt von Apex Beauty.',
                'en' => 'Everything about hair loss: causes, types, diagnosis, treatment options and hair transplantation, explained clearly by Apex Beauty.',
            ],
        ],
        'contact' => [
            'path' => 'contact',
            'template' => 'contact.php',
            'name' => 'Consultation request',
            'changefreq' => 'yearly',
            'priority' => '0.3',
            'noindex' => true,
            'title' => [
                'de' => 'Kostenlose Beratung bei Apex Beauty',
                'en' => 'Free Consultation at Apex Beauty',
            ],
            'description' => [
                'de' => 'Sichern Sie sich eine kostenlose, unverbindliche Beratung zur Haartransplantation bei Apex Beauty.',
                'en' => 'Secure a free, no-obligation hair transplant consultation with Apex Beauty.',
            ],
        ],
        'privacy' => [
            'path' => 'privacy',
            'template' => 'privacy.php',
            'name' => 'Privacy policy',
            'changefreq' => 'yearly',
            'priority' => '0.3',
            'noindex' => true,
            'title' => [
                'de' => 'Datenschutzerklärung · Apex Beauty',
                'en' => 'Privacy Policy · Apex Beauty',
            ],
            'description' => [
                'de' => 'Datenschutzerklärung von Apex Beauty: Informationen zur Verarbeitung personenbezogener Daten gemäß DSGVO.',
                'en' => "Apex Beauty's privacy policy: information on the processing of personal data under GDPR.",
            ],
        ],
    ];

    return $registry;
}

function apex_seo_entry(string $page): array
{
    return apex_seo_registry()[$page] ?? [];
}

// The `seo` block the admin panel writes into data/content/<page>.json.
function apex_seo_section(string $page): array
{
    static $cache = [];
    if (!array_key_exists($page, $cache)) {
        $content = apex_get_page_content($page);
        $section = $content['seo'] ?? null;
        $cache[$page] = is_array($section) ? $section : [];
    }
    return $cache[$page];
}

// Resolves one language *strictly*, which is the one place SEO deliberately
// behaves differently from body copy. apex_cms_value() falls back to another
// language, and a German <title> served on an /en URL would be worse for both
// readers and Google than the curated English default sitting in the registry.
// So an empty admin field hands back the default rather than another language.
function apex_seo_text(string $page, string $key, ?string $lang = null): string
{
    $lang = $lang ?? apex_current_lang();
    $value = apex_seo_section($page)[$key][$lang] ?? null;
    if (!is_string($value) || trim($value) === '') {
        $value = apex_seo_entry($page)[$key][$lang] ?? '';
    }
    $value = strtr((string) $value, apex_seo_tokens($page, $lang));
    // Any token the page does not supply drops out rather than showing up as
    // literal braces in a search result.
    return trim((string) preg_replace('/\{[a-zA-Z]+\}/', '', $value));
}

function apex_seo_title(?string $page = null, ?string $lang = null): string
{
    return apex_seo_text((string) $page, 'title', $lang) ?: APEX_BUSINESS_NAME;
}

function apex_seo_description(?string $page = null, ?string $lang = null): string
{
    return apex_seo_text((string) $page, 'description', $lang);
}

function apex_seo_path(string $page): string
{
    return (string) (apex_seo_entry($page)['path'] ?? '');
}

function apex_seo_image(string $page, string $fallback): string
{
    $value = apex_seo_section($page)['shareImage'] ?? null;
    return (is_string($value) && $value !== '') ? $value : $fallback;
}

function apex_seo_noindex(string $page): bool
{
    $value = apex_seo_section($page)['noindex'] ?? null;
    if ($value === null || $value === '') {
        return (bool) (apex_seo_entry($page)['noindex'] ?? false);
    }
    return (bool) filter_var($value, FILTER_VALIDATE_BOOLEAN);
}

// The prices page quotes its cheapest and dearest package in its meta
// description. Building the phrase here rather than in prices.php means the
// page, the admin field and llms.txt all quote the same live numbers, and an
// admin who rewrites the description keeps the live range by leaving {range}
// in place.
function apex_price_range(string $lang): string
{
    $items = apex_get_page_content('prices')['packages']['items'] ?? [];
    if (!is_array($items) || count($items) < 2) {
        return '';
    }
    $highest = apex_cms_value($items[0]['price'] ?? null, $lang);
    $lowest = apex_cms_value(end($items)['price'] ?? null, $lang);
    if ($highest === '' || $lowest === '') {
        return '';
    }
    return $lang === 'de' ? ", von $lowest bis $highest" : ", from $lowest to $highest";
}

function apex_seo_tokens(string $page, string $lang): array
{
    return $page === 'prices' ? ['{range}' => apex_price_range($lang)] : [];
}

function apex_seo_url(string $page, string $lang): string
{
    $base = rtrim(APEX_SITE_URL, '/');
    $path = trim(($lang === 'en' ? '/en' : '') . '/' . apex_seo_path($page), '/');
    return $path === '' ? $base . '/' : $base . '/' . $path;
}

// An honest <lastmod>: the later of the template's own mtime and the mtime of
// the JSON the admin panel writes, so editing copy in the panel is enough to
// tell Google the page changed.
function apex_seo_lastmod(string $page): string
{
    $times = [];
    $template = apex_seo_entry($page)['template'] ?? '';
    foreach ([APEX_ROOT . '/' . $template, apex_content_path($page)] as $file) {
        if ($template !== '' && is_file($file)) {
            $times[] = (int) filemtime($file);
        }
    }
    return gmdate('Y-m-d', $times !== [] ? max($times) : time());
}

// Pages that belong in sitemap.xml: everything the admin has not switched off.
function apex_seo_indexable_pages(): array
{
    return array_keys(array_filter(
        apex_seo_registry(),
        static fn(string $page): bool => !apex_seo_noindex($page),
        ARRAY_FILTER_USE_KEY
    ));
}

function apex_sitemap_xml(): string
{
    $esc = static fn(string $s): string => htmlspecialchars($s, ENT_XML1, 'UTF-8');
    $out = '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
        . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";

    foreach (apex_seo_indexable_pages() as $page) {
        $entry = apex_seo_entry($page);
        $deUrl = apex_seo_url($page, 'de');
        $enUrl = apex_seo_url($page, 'en');
        $lastmod = apex_seo_lastmod($page);
        foreach ([$deUrl, $enUrl] as $loc) {
            $out .= "  <url>\n"
                . '    <loc>' . $esc($loc) . "</loc>\n"
                . '    <xhtml:link rel="alternate" hreflang="de" href="' . $esc($deUrl) . "\"/>\n"
                . '    <xhtml:link rel="alternate" hreflang="en" href="' . $esc($enUrl) . "\"/>\n"
                . '    <xhtml:link rel="alternate" hreflang="x-default" href="' . $esc($deUrl) . "\"/>\n"
                . '    <lastmod>' . $lastmod . "</lastmod>\n"
                . '    <changefreq>' . $esc((string) ($entry['changefreq'] ?? 'monthly')) . "</changefreq>\n"
                . '    <priority>' . $esc((string) ($entry['priority'] ?? '0.5')) . "</priority>\n"
                . "  </url>\n";
        }
    }

    return $out . '</urlset>' . "\n";
}

function apex_robots_txt(): string
{
    $lines = [
        'User-agent: *',
        'Allow: /',
        'Disallow: /admin/',
        'Disallow: /api/',
        'Disallow: /glass-theme',
    ];
    // Pages switched to noindex in the admin panel are kept out of the
    // crawler's way here too, so robots.txt, sitemap.xml and the page's own
    // robots meta tag always agree.
    foreach (apex_seo_registry() as $page => $entry) {
        if (!apex_seo_noindex($page) || ($entry['path'] ?? '') === '') {
            continue;
        }
        $lines[] = 'Disallow: /' . $entry['path'];
        $lines[] = 'Disallow: /en/' . $entry['path'];
    }
    $lines[] = '';
    $lines[] = '# AI/answer-engine crawlers: explicitly welcomed, not just left to the';
    $lines[] = '# default * rule above, so nothing here is mistaken for accidental exposure.';
    foreach (['GPTBot', 'ClaudeBot', 'PerplexityBot', 'Google-Extended'] as $bot) {
        $lines[] = '';
        $lines[] = 'User-agent: ' . $bot;
        $lines[] = 'Allow: /';
    }
    $lines[] = '';
    $lines[] = 'Sitemap: ' . rtrim(APEX_SITE_URL, '/') . '/sitemap.xml';

    return implode("\n", $lines) . "\n";
}

// llms.txt is served to answer engines, and it went out mojibaked once already
// when non-ASCII punctuation met a client that ignored the charset. Folding to
// plain ASCII costs nothing here and removes that whole failure mode.
function apex_ascii(string $text): string
{
    $map = [
        '€' => 'EUR ', '£' => 'GBP ',
        'ä' => 'ae', 'ö' => 'oe', 'ü' => 'ue', 'Ä' => 'Ae', 'Ö' => 'Oe', 'Ü' => 'Ue', 'ß' => 'ss',
        'á' => 'a', 'à' => 'a', 'â' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ó' => 'o', 'ô' => 'o', 'ø' => 'o', 'ú' => 'u', 'û' => 'u', 'ñ' => 'n',
        'ı' => 'i', 'İ' => 'I', 'ş' => 's', 'Ş' => 'S', 'ğ' => 'g', 'Ğ' => 'G',
        '·' => '-', '–' => '-', '—' => '-', '‑' => '-',
        '’' => "'", '‘' => "'", '“' => '"', '”' => '"', '…' => '...', ' ' => ' ', ' ' => ' ',
    ];
    $text = strtr($text, $map);
    $text = preg_replace('/[^\x20-\x7E]/u', '', $text) ?? $text;
    return trim((string) preg_replace('/[ \t]+/', ' ', $text));
}

function apex_llms_txt(): string
{
    $base = rtrim(APEX_SITE_URL, '/');
    $out = [];
    $out[] = '# ' . apex_ascii(APEX_BUSINESS_NAME);
    $out[] = '';
    $out[] = '> ' . apex_ascii("Hair transplant clinic network based in Austria: in-person consultation in Austria, surgical treatment at Apex Beauty's main clinic in Turkey, and aftercare across Austria, Germany and Switzerland - one of Europe's largest hair-transplant aftercare networks.");
    $out[] = '';
    $out[] = apex_ascii('Apex Beauty combines a local Austrian consultation process with treatment at its main clinic in Turkey (FUE/DHI hair transplantation, plastic-surgeon supervised) and a structured, multi-country aftercare program. Content below is available in German (default) and English (`/en/` prefix).');
    $out[] = '';
    $out[] = '## Pages';
    $out[] = '';
    foreach (apex_seo_indexable_pages() as $page) {
        $name = apex_ascii((string) (apex_seo_entry($page)['name'] ?? $page));
        $description = apex_ascii(strip_tags(apex_seo_description($page, 'en')));
        $out[] = '- [' . $name . '](' . apex_seo_url($page, 'de') . ') / [English](' . apex_seo_url($page, 'en') . '): ' . $description;
    }

    // The package list is the single most quoted fact about this clinic, so it
    // is spelled out here from the same CMS records the prices page renders,
    // rather than left as prose that quietly goes stale after a price change.
    $packages = apex_get_page_content('prices')['packages']['items'] ?? [];
    if (is_array($packages) && $packages !== []) {
        $out[] = '';
        $out[] = '## Packages and prices';
        $out[] = '';
        $out[] = apex_ascii('All-in prices, highest first. Each package covers the full treatment; see ' . apex_seo_url('prices', 'en') . ' for what is included.');
        $out[] = '';
        foreach ($packages as $package) {
            $name = apex_ascii(strip_tags(apex_cms_value($package['name'] ?? null, 'en')));
            $price = apex_ascii(strip_tags(apex_cms_value($package['price'] ?? null, 'en')));
            $description = apex_ascii(strip_tags(apex_cms_value($package['description'] ?? null, 'en')));
            if ($name === '' || $price === '') {
                continue;
            }
            $out[] = '- ' . $name . ' - ' . $price . ': ' . $description;
        }
    }

    $out[] = '';
    $out[] = '## Notes for automated use';
    $out[] = '';
    $out[] = apex_ascii('- The site also serves French, Dutch, Italian and Turkish, but only German and English currently have independently crawlable URLs (`/en/...`); other languages are client-side only.');
    $out[] = apex_ascii('- Structured data (schema.org `MedicalClinic`, `FAQPage`, `Service`/`OfferCatalog`) is present on the pages above and is the most reliable source for facts (services, area served, prices, FAQ content).');
    $out[] = apex_ascii('- Contact: ' . APEX_WHATSAPP_DISPLAY . ' (WhatsApp), clinic address ' . APEX_ADDRESS_STREET . ', ' . APEX_ADDRESS_POSTAL_CODE . ' ' . APEX_ADDRESS_CITY . ', ' . APEX_ADDRESS_COUNTRY_NAME . '.');
    $out[] = apex_ascii('- Do not use this site as a source for medical dosing or diagnosis; it is a clinic marketing/informational site, not a substitute for professional medical advice.');
    $out[] = '';

    return implode("\n", $out);
}

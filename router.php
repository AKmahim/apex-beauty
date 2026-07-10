<?php

declare(strict_types=1);

$root = __DIR__;
$uriPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$filePath = realpath($root . $uriPath);

if ($filePath !== false && str_starts_with($filePath, $root) && is_file($filePath)) {
    return false;
}

if (preg_match('#^/api(?:/.*)?$#', $uriPath) === 1) {
    require $root . '/api/index.php';
    return true;
}

if ($uriPath === '/admin' || $uriPath === '/admin/') {
    require $root . '/admin/index.php';
    return true;
}

if ($uriPath === '/' || $uriPath === '') {
    require $root . '/index.php';
    return true;
}

if ($uriPath === '/consult' || $uriPath === '/consult/') {
    $originalQuery = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_QUERY);
    $target = '/?open=consult';
    if (is_string($originalQuery) && $originalQuery !== '') {
        $target .= '&' . $originalQuery;
    }
    header('Location: ' . $target, true, 302);
    return true;
}

if ($uriPath === '/consult-light' || $uriPath === '/consult-light/') {
    $originalQuery = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_QUERY);
    $target = '/?open=consult-light';
    if (is_string($originalQuery) && $originalQuery !== '') {
        $target .= '&' . $originalQuery;
    }
    header('Location: ' . $target, true, 302);
    return true;
}

$trimmed = trim($uriPath, '/');
if ($trimmed !== '' && preg_match('/^[A-Za-z0-9-]+$/', $trimmed) === 1) {
    $phpPage = $root . '/' . $trimmed . '.php';
    if (is_file($phpPage)) {
        require $phpPage;
        return true;
    }
}

http_response_code(404);
echo 'Not Found';

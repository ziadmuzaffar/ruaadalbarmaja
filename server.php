<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 * Development Server Router with Security Shield
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// 1. Block access to hidden files and directories (.env, .git, etc.)
if (preg_match('#(^|/)\.(?!well-known)#i', $uri)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    exit('403 Forbidden: Access to hidden files is denied.');
}

// 2. Block direct web access to sensitive project files
if (preg_match('#^/(composer\.(json|lock)|package(-lock)?\.json|artisan|phpunit\.xml|README\.md|emails\.txt|\.env.*)$#i', $uri)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    exit('403 Forbidden: Direct access to project configuration files is denied.');
}

// 3. Block direct web access to internal source & database directories
if (preg_match('#^/(app|bootstrap|config|database|resources|storage/(logs|framework)|tests|vendor)(/|$)#i', $uri)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    exit('403 Forbidden: Direct access to internal system directories is denied.');
}

// 4. Block access to dangerous file extensions
if (preg_match('#\.(sqlite|sqlite3|db|sql|log|bak|ini|conf|sh|bat)$#i', $uri)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=utf-8');
    exit('403 Forbidden: Direct access to database and log files is denied.');
}

// 5. Emulate static file serving for valid public assets (works with root and artisan serve)
$filePath = __DIR__ . $uri;
if ($uri !== '/' && file_exists($filePath) && !is_dir($filePath)) {
    $docRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
    if ($docRoot === realpath(__DIR__)) {
        return false;
    }

    $mimes = [
        'css'   => 'text/css',
        'js'    => 'application/javascript',
        'json'  => 'application/json',
        'png'   => 'image/png',
        'jpg'   => 'image/jpeg',
        'jpeg'  => 'image/jpeg',
        'gif'   => 'image/gif',
        'svg'   => 'image/svg+xml',
        'ico'   => 'image/x-icon',
        'webp'  => 'image/webp',
        'avif'  => 'image/avif',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf',
    ];
    $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $mime = $mimes[$ext] ?? mime_content_type($filePath) ?: 'application/octet-stream';
    header('Content-Type: ' . $mime);
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
}

// 6. Forward all other requests to Laravel's Front Controller
require_once __DIR__ . '/index.php';

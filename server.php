<?php

/**
 * Laravel's built-in PHP dev server router.
 *
 * This file is required for `php artisan serve` and is normally shipped with
 * the Laravel application skeleton.
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';


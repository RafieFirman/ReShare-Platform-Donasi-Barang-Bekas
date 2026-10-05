<?php

// Shared frontend URL base. All pages are still served from frontend/ internally,
// but links can target the application root consistently.
if (!defined('APP_ROOT')) {
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
    $frontendPos = strpos($script, '/frontend/');
    $root = $frontendPos === false ? dirname($script) : substr($script, 0, $frontendPos);
    define('APP_ROOT', rtrim($root, '/'));
}

function route(string $path = ''): string
{
    return APP_ROOT . '/' . ltrim($path, '/');
}

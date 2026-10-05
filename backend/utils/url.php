<?php

/**
 * Return the application root URL without a trailing slash.
 * Works for XAMPP subfolders such as /reshare as well as root hosting.
 */
function app_url(string $path = ''): string
{
    $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');

    // Strip backend/frontend/settings directory segments when called from nested files.
    $segments = array_values(array_filter(explode('/', $base)));
    $known = ['backend', 'frontend', 'settings', 'auth', 'items', 'events', 'user', 'config', 'utils'];
    while ($segments && in_array(end($segments), $known, true)) {
        array_pop($segments);
    }

    $root = '/' . implode('/', $segments);
    if ($root === '/') {
        $root = '';
    }

    return $root . '/' . ltrim($path, '/');
}

<?php

function __($key)
{
    if (isset($_GET['locale'])) {
        $_SESSION['locale'] = $_GET['locale'];
    }
    $locale = $_SESSION['locale'] ?? 'sr-Cyrl';

    $filePath = __DIR__ . "/../../lang/{$locale}.json";

    if (file_exists($filePath)) {
        $translations = json_decode(file_get_contents($filePath), true);
        if (isset($translations[$key])) {
            return $translations[$key];
        }
    }
    return $key;
}

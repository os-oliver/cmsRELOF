<?php
namespace App\Utils;

class LocaleManager
{
    private static string $defaultLocale = 'sr-Cyrl';

    public static function get(): string
    {
        if (isset($_GET['locale'])) {
            $_SESSION['locale'] = $_GET['locale'];
        }

        return $_SESSION['locale'] ?? self::$defaultLocale;
    }
}

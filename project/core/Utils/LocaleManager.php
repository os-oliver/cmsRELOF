<?php
namespace App\Utils;

class LocaleManager
{
    private static string $defaultLocale = 'sr-Cyrl';

    private static array $localeMap = [
        'sr-Cyrl' => 'sr-Cyrl',
        'sr' => 'sr',
        'sr-Latn' => 'sr',
        'en' => 'en',
        'en-US' => 'en',
        'en-GB' => 'en'
    ];

    public static function get(): string
    {
        if (isset($_GET['locale'])) {
            $requestedLocale = $_GET['locale'];
            $_SESSION['locale'] = self::normalizeLocale($requestedLocale);
        }

        return $_SESSION['locale'] ?? self::$defaultLocale;
    }

    public static function normalizeLocale(string $locale): string
    {
        $locale = strtolower($locale);
        return self::$localeMap[$locale] ?? self::$defaultLocale;
    }
}

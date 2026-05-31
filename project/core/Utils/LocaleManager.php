<?php
namespace App\Utils;

class LocaleManager
{
    const DATE_FORMAT_STRING = 'd/m/Y';
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

    public static function formatDateFromRawString($rawDatum): string
    {
        $formatted = '';
        if ($rawDatum) {
            $formats = ['Y-m-d', 'Y-m-d H:i:s', 'd/m/Y', 'd.m.Y'];
            foreach ($formats as $fmt) {
                $dt = \DateTime::createFromFormat($fmt, $rawDatum);
                if ($dt instanceof \DateTime) {
                    $formatted = $dt->format(self::DATE_FORMAT_STRING);
                    break;
                }
            }

            if ($formatted === '' && strtotime($rawDatum) !== false) {
                $formatted = date(self::DATE_FORMAT_STRING, strtotime($rawDatum));
            }
        }

        return $formatted;
    }
}

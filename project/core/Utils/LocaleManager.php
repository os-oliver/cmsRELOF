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
        if (isset($_GET['locale']) && in_array($_GET['locale'], array_keys(self::$localeMap))) {
            $requestedLocale = $_GET['locale'];
            $_SESSION['locale'] = self::normalizeLocale($requestedLocale);
        }

        return $_SESSION['locale'] ?? self::$defaultLocale;
    }

    public static function normalizeLocale(string $locale): string
    {
        // $locale = strtolower($locale);
        return self::$localeMap[$locale] ?? self::$defaultLocale;
    }

    public static function decodeTranslations(array $items): array
    {
        if (array_key_exists('translations', $items)) {
            //ovde zapravo imamo samo jedan entity, i keys od items su njegovi atributi
            try {
                $array = json_decode($items['translations'], true);
                $items['translations'] = $array;
            } catch (\Throwable $e) { }
        }
        else {
            //ovde zapravo imamo samo jedan item, i njegove atribute
            foreach ($items as $key => $item) {
                if (array_key_exists('translations', $item)) {
                    try {
                        $array = json_decode($item['translations'], true);
                        $items[$key]['translations'] = $array;
                    } catch (\Throwable $e) { }
                }
            }
        }

        return $items;
    }
}

<?php
namespace App\Models;

use App\Controllers\LanguageMapperController;
use App\Utils\LocaleManager;
class PageLoader
{
    private static string $filePath = __DIR__ . '/../../public/assets/data/pages.json';

    // Load all pages from JSON
    public static function loadPages(): array
    {
        $jsonContent = file_get_contents(self::$filePath);
        return json_decode($jsonContent, true) ?? [];
    }

    // Get only static pages
    public static function getStaticPages(): array
    {
        $pages = self::loadPages();
        return array_filter($pages, fn($page) => $page['static'] === true);
    }

    // Group static pages by column
    public static function getGroupedStaticPages(): array
    {
        $staticPages = self::getStaticPages();
        $langMapper = new LanguageMapperController();
        $locale = LocaleManager::get();

        $groupedPages = [];

        foreach ($staticPages as $page) {
            ;
            if (isset($page['column'])) {
                if ($locale == 'sr-Cyrl') {
                    $column = $langMapper->latin_to_cyrillic($page['column']);
                    $page['name'] = $langMapper->latin_to_cyrillic($page['name']);
                    $groupedPages[$column][] = $page;

                } else {
                    $column = $page['column'];
                    $groupedPages[$column][] = $page;
                }

            }

        }

        return $groupedPages;
    }
}

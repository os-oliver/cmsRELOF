<?php
namespace App\Models;
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
        $groupedPages = [];

        foreach ($staticPages as $page) {
            ;
            if (isset($page['column'])) {
                $column = $page['column'];
                $groupedPages[$column][] = $page;
            }

        }

        return $groupedPages;
    }
}

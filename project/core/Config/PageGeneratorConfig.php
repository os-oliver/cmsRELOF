<?php

namespace App\Config;

class PageGeneratorConfig
{
    // Base directory paths
    public const BASE_EXPORT_DIR = '/exportedPages';
    public const COMPONENTS_DIR = '/landingPageComponents';
    public const PAGES_DIR = '/pages';

    // File permissions
    public const DIR_PERMISSIONS = 0755;

    // Default settings
    public const DEFAULT_LOCALE = 'sr-Cyrl';
    public const DEFAULT_ITEMS_PER_PAGE = 6;

    // Template paths
    public const HEADER_TEMPLATE = 'landingPage/header.php';
    public const FOOTER_TEMPLATE = 'landingPage/footer.php';
    public const MOBILE_MENU_TEMPLATE = 'landingPage/divmobileMenu.php';

    // External resources
    public const FONT_AWESOME_CDN = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css';
    public const TAILWIND_CDN = 'https://cdn.tailwindcss.com';

    // Special component identifiers
    public const PROMOTION_FILE_IDENTIFIER = 'promocija.php';
    public const HEADER_FILE_IDENTIFIER = 'header.php';
    public const FOOTER_FILE_IDENTIFIER = 'footer.php';

    // Character replacements
    public static array $htmlReplacements = [
        '&lt;' => '<',
        '&gt;' => '>',
        '\$' => '$'
    ];
}

class PageTypes
{
    public const GALLERY = 'gallery';
    public const BASIC = 'basic';
    public const GOAL = 'goal';
    public const MISSION = 'mission';
    public const EVENTS = 'events';
    public const CONTACT = 'contact';
}
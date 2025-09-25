<?php

namespace App\Utils;

class PageBodyGenerators {
    /**
     * Generate a gallery page body
     * @param string $name Page name
     * @param array $data Additional data including CSS and JS
     * @return string Generated HTML content
     */
    public static function galleryBody(string $name, array $data): string 
    {
        $head = self::generateHeader($name, $data);
        $head .= self::includePhpHeader();
        
        // Gallery-specific PHP code
        $content = <<<'PHP'
<?php
use App\Models\Gallery;

$limit = 6;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;
$documentModal = new Gallery();
[$images, $totalCount] = $documentModal->list(
    limit: $limit,
    offset: $offset
);
$totalPages = (int) ceil($totalCount / $limit);
?>
PHP;

        $content .= self::generateGalleryHtml($name);
        $content .= self::includePhpFooter();
        $content .= self::generateFooter($data);
        
        return $content;
    }

    /**
     * Generate a basic page body
     * @param string $name Page name
     * @param array $data Additional data including CSS and JS
     * @return string Generated HTML content
     */
    public static function basicBody(string $name, array $data): string 
    {
        $head = self::generateHeader($name, $data);
        $content = self::includePhpHeader();
        $content .= self::generateBasicHtml($name);
        $content .= self::includePhpFooter();
        $content .= self::generateFooter($data);
        
        return $content;
    }

    /**
     * Generate a goal page body
     * @param string $name Page name
     * @param array $data Additional data including CSS and JS
     * @return string Generated HTML content
     */
    public static function goalBody(string $name, array $data): string 
    {
        $head = self::generateHeader($name, $data);
        $content = <<<'PHP'
<?php
use App\Models\AboutUs;
$dataAboutUS = new AboutUs();
$aboutUsData = $dataAboutUS->list();
?>
PHP;

        $content .= self::generateGoalHtml($name);
        $content .= self::includePhpFooter();
        $content .= self::generateFooter($data);
        
        return $content;
    }

    /**
     * Generate a mission page body
     * @param string $name Page name
     * @param array $data Additional data including CSS and JS
     * @return string Generated HTML content
     */
    public static function bodyMission(string $name, array $data): string 
    {
        $head = self::generateHeader($name, $data);
        $content = <<<'PHP'
<?php
use App\Models\AboutUs;
$dataAboutUS = new AboutUs();
$aboutUsData = $dataAboutUS->list();
?>
PHP;

        $content .= self::generateMissionHtml($name);
        $content .= self::includePhpFooter();
        $content .= self::generateFooter($data);
        
        return $content;
    }

    /**
     * Generate an events page body
     * @param string $name Page name
     * @param array $data Additional data including CSS and JS
     * @return string Generated HTML content
     */
    public static function eventsBody(string $name, array $data): string 
    {
        $head = self::generateHeader($name, $data);
        $content = <<<'PHP'
<?php
use App\Models\Event;

$limit = 6;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

[$events, $totalCount] = (new Event())->all(
    limit: $limit,
    offset: $offset
);
$totalPages = (int) ceil($totalCount / $limit);
$categories = (new Event())->getCategories();
?>
PHP;

        $content .= self::generateEventsHtml();
        $content .= self::includePhpFooter();
        $content .= self::generateFooter($data);
        
        return $content;
    }

    /**
     * Generate a contact page body
     * @param string $name Page name
     * @param array $data Additional data including CSS and JS
     * @return string Generated HTML content
     */
    public static function contactBody(string $name, array $data): string 
    {
        $head = self::generateHeader($name, $data);
        $content = self::includePhpHeader();
        $content .= self::generateContactHtml();
        $content .= self::includePhpFooter();
        $content .= self::generateFooter($data);
        
        return $content;
    }

    // Private helper methods

    private static function generateHeader(string $name, array $data): string 
    {
        $head = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$name}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
HTML;

        if (!empty($data['css'])) {
            $cssEscaped = htmlspecialchars($data['css'], ENT_QUOTES);
            $head .= "\n<style>\n{$cssEscaped}\n</style>\n";
        }

        $head .= "</head>\n<body class=\"min-h-screen flex flex-col\">\n";
        return $head;
    }

    private static function generateFooter(array $data): string 
    {
        $footer = '';
        if (!empty($data['js'])) {
            $footer .= $data['js'] . "\n";
        }
        $footer .= "</body>\n</html>\n";
        return $footer;
    }

    private static function includePhpHeader(): string 
    {
        return <<<'PHP'
<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';
require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';
?>
PHP;
    }

    private static function includePhpFooter(): string 
    {
        return <<<'PHP'
<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';
?>
PHP;
    }

    private static function generateBasicHtml(string $name): string 
    {
        return <<<HTML
<main class=>
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>
    <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient">
        <div class="absolute inset-0 z-0"></div>
        <div class="relative z-10 w-full max-w-3xl mx-auto text-center">
            <h1 class="text-5xl font-bold mb-4">{$name}</h1>
            <p class="text-xl">Podesiti {$name} stranicu!</p>
        </div>
    </section>
</main>
HTML;
    }

    private static function generateGalleryHtml(string $name): string 
    {
        // Gallery template implementation
        return <<<'HTML'
<main>
    <div>
        <button id="increaseFontBtn" class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition" aria-label="Increase font size">
            A+
        </button>
    </div>
    <!-- Gallery Section -->
    <section class="container mx-auto px-4 mt-24 py-12">
        <!-- Gallery implementation -->
    </section>
</main>
HTML;
    }

    private static function generateGoalHtml(string $name): string 
    {
        return <<<'HTML'
<main>
    <div>
        <button id="increaseFontBtn" class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition" aria-label="Increase font size">
            A+
        </button>
    </div>
    <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient">
        <div class="absolute inset-0 z-0"></div>
        <div class="relative z-10 w-full max-w-3xl mx-auto text-center">
            <h1 class="text-5xl font-bold mb-4">Cilj naše institucije</h1>
            <h2 class="text-3xl mx-5 italic mb-4 text-justify"><?= $aboutUsData['goal'] ?></h2>
        </div>
    </section>
</main>
HTML;
    }

    private static function generateMissionHtml(string $name): string 
    {
        return <<<'HTML'
<main>
    <div>
        <button id="increaseFontBtn" class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition" aria-label="Increase font size">
            A+
        </button>
    </div>
    <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient">
        <div class="absolute inset-0 z-0"></div>
        <div class="relative z-10 w-full max-w-3xl mx-auto text-center">
            <h1 class="text-5xl font-bold mb-4">Misija naše institucije</h1>
            <h2 class="text-3xl mx-5 italic mb-4 text-justify"><?= $aboutUsData['mission'] ?></h2>
        </div>
    </section>
</main>
HTML;
    }

    private static function generateEventsHtml(): string 
    {
        return <<<'HTML'
<main class="flex-1">
    <div>
        <button id="increaseFontBtn" class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition" aria-label="Increase font size">
            A+
        </button>
    </div>
    <section class="relative min-h-screen flex items-center w-full overflow-hidden pt-16 hero-gradient">
        <!-- Events section implementation -->
    </section>
</main>
HTML;
    }

    private static function generateContactHtml(): string 
    {
        return <<<'HTML'
<div class="py-12 mt-20 px-4 flex-1">
    <div>
        <button id="increaseFontBtn" class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition" aria-label="Increase font size">
            A+
        </button>
    </div>
    <!-- Contact form implementation -->
</div>
HTML;
    }
}
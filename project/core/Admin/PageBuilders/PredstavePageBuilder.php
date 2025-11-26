<?php

namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;

class PredstavePageBuilder extends BasePageBuilder
{
    protected string $slug;

    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }

    protected string $css = <<<CSS
 
    CSS;
    protected string $cardRender = <<<'HTML'
    
    function cardRender(array $item, array $fieldLabels, string $locale): string
    {
        // 
        $autor = $item['fields']['autor'] ?? reset($item['fields']['autor'] ?? ['Unknown']);
        $naslov = $item['fields']['naslov'] ?? reset($item['fields']['naslov'] ?? ['Untitled']);
        
        $autor = htmlspecialchars($autor, ENT_QUOTES, 'UTF-8');
        $naslov = htmlspecialchars($naslov, ENT_QUOTES, 'UTF-8');

        // Image
        $imageUrl = !empty($item['image']) 
            ? htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') 
            : 'https://via.placeholder.com/400x200?text=No+Image';

        // Card HTML
        $html = "
        <div class='max-w-sm bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-shadow duration-300'>
            <div class='relative w-full h-48'>
                <img src='{$imageUrl}' class='w-full h-full object-cover'>
            </div>
            <div class='p-5'>
                <h2 class='text-lg font-bold text-gray-900 mb-2 hover:text-blue-600 transition-colors duration-200'>{$naslov}</h2>
                <p class='text-sm text-gray-500'>Autor: {$autor}</p>
            </div>
        </div>";

        return $html;
    }

    HTML;
    protected string $html = <<<'HTML'
<main>
    <section class="container mx-auto px-4 py-12">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2"><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></h1>
            <p class="text-gray-600"><?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>

        <div class="performances-grid">
            <?php
            if ($itemsList['success'] && !empty($itemsList['items'])) {
                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">';
                foreach ($itemsList['items'] as $item) {
                    echo cardRender($item, $fieldLabels, $locale, true);
                }
                echo '</div>';

                $totalPages = ceil($itemsList['total'] / $itemsPerPage);
                $start = ($currentPage - 1) * $itemsPerPage + 1;
                $end = min($start + $itemsPerPage - 1, $itemsList['total']);
                echo CardRenderer::renderPagination($currentPage, $totalPages, $start, $end, $itemsList['total'], 'editor');
            } else {
                echo "<div class='bg-white rounded-xl shadow-md p-12 text-center'><i class='fas fa-inbox text-6xl text-gray-300 mb-4'></i><p class='text-gray-500 text-lg'>Nema pronađenih stavki</p></div>";
            }
            ?>
        </div>

        <?php if (isset($totalPages) && $totalPages > 1): ?>
            <div class="pagination">
                <?php
                if ($currentPage > 1) {
                    $prevUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage - 1]));
                    echo "<a href='{$prevUrl}' class='page-link'><i class='fas fa-chevron-left'></i></a>";
                } else {
                    echo "<span class='page-link' aria-disabled='true'><i class='fas fa-chevron-left'></i></span>";
                }

                $createPageLink = function ($page) use ($currentPage) {
                    $url = '?' . http_build_query(array_merge($_GET, ['page' => $page]));
                    $class = $page === $currentPage ? 'page-link active' : 'page-link';
                    return "<a href='{$url}' class='{$class}'>{$page}</a>";
                };

                $start = max(1, $currentPage - 2);
                $end = min($totalPages, $currentPage + 2);

                if ($start > 1) {
                    echo $createPageLink(1);
                    if ($start > 2) echo "<span class='px-2 text-gray-400'>...</span>";
                }

                for ($i = $start; $i <= $end; $i++) {
                    echo $createPageLink($i);
                }

                if ($end < $totalPages) {
                    if ($end < $totalPages - 1) echo "<span class='px-2 text-gray-400'>...</span>";
                    echo $createPageLink($totalPages);
                }

                if ($currentPage < $totalPages) {
                    $nextUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
                    echo "<a href='{$nextUrl}' class='page-link'><i class='fas fa-chevron-right'></i></a>";
                } else {
                    echo "<span class='page-link' aria-disabled='true'><i class='fas fa-chevron-right'></i></span>";
                }
                ?>
            </div>
        <?php endif; ?>
    </section>
</main>
HTML;

    public function buildPage(): string
    {
        $additionalPHP = <<<'PHP'
        use App\Controllers\{ContentController};
        use App\Utils\CardRenderer;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $locale = $_SESSION['locale'] ?? 'sr-Cyrl';

        $slug = '__SLUG__';
        $pageTitle = ucfirst($slug);
        $pageDescription = 'Saznajte više o našim predstavama';

        $itemsPerPage = 3;
        $currentPage = max(1, (int) ($_GET['page'] ?? 1));

        $itemsList = $slug ? (new ContentController())->fetchListData($slug, '', $currentPage, $itemsPerPage) : ['success' => false, 'items' => []];
        $config = $fieldLabels = [];
        if ($slug && file_exists($structurePath = __DIR__ . '/../../assets/data/structure.json')) {
            $parsed = json_decode(file_get_contents($structurePath), true);
            $config = $parsed[0][$slug] ?? [];
            $fieldLabels = array_column($config['fields'] ?? [], null, 'name');
        }

        // Pagination
        $itemsPerPage = 3;
        $currentPage = max(1, (int) ($_GET['page'] ?? 1));

     
PHP;
        $additionalPHP .= $this->cardRender;

        // inject concrete slug value into the nowdoc (keeps the generated PHP intact)
        $additionalPHP = str_replace('__SLUG__', addslashes($this->slug), $additionalPHP);

        $content = $this->getHeader($this->css, $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }

    public function render(): void
    {
        echo $this->buildPage();
    }
}
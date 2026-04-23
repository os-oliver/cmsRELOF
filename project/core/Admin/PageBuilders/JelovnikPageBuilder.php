<?php

namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class JelovnikPageBuilder extends BasePageBuilder
{
  protected string $slug;
  private LanguageMapperController $translator;

  // Configurable variables
  private int $itemsPerPage = 6;
  private int $descriptionMaxLength = 160;
  private int $paginationRange = 2;

  private array $texts = [];

  public function __construct(string $slug)
  {
    $this->slug = $slug;
    $this->translator = new LanguageMapperController();
    $this->initializeTexts();
  }

  private function initializeTexts(): void
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    $locale = $_SESSION['locale'] ?? 'sr-Cyrl';

    $latinTexts = [
      'download_menu' => 'Preuzmi jelovnik',
      'no_items_found' => 'Nema pronađenih jelovnika',
      'event_details' => 'Detaljnije',
    ];

    if ($locale === 'sr-Cyrl') {
      $this->texts = $this->translator->latin_to_cyrillic_array($latinTexts);
    } else {
      $this->texts = $latinTexts;
    }
  }

  protected string $css = <<<CSS
main {
    padding-top: 50px;
}
.glass-card {
    background: rgba(255, 255, 255, 0.75);
    backdrop-filter: blur(20px) saturate(180%);
    border: 1px solid rgba(255, 255, 255, 0.4);
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}
.glass-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 36px rgba(0,0,0,0.15);
}
CSS;

  protected string $cardTemplate = <<<'HTML'
    $cardTemplate = <<<'PHP'
<div class="glass-card rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300">
    <h3 class="text-xl font-heading text-primary_text mb-3">{{naslov}}</h3>
    <p class="text-secondary_text mb-5 leading-relaxed">{{opis}}</p>

      <a href="/sadrzaj?id={{itemId}}&tip=generic_element" class="block w-full text-center bg-gradient-to-r from-primary to-secondary hover:from-primary_hover hover:to-secondary_hover text-white text-sm font-bold py-3.5 px-4 rounded-xl transition-all duration-300 shadow-md hover:shadow-xl backdrop-blur-sm">
        <i class="fas fa-info-circle"></i>
        <span>{{eventDetails}}</span>
        <i class="fas fa-arrow-right"></i>
      </a>
</div>
PHP;
HTML;

  protected string $cardRender = <<<'HTML'
function cardRender(array $item, string $locale, array $texts = [], int $descMaxLength = 160, string $cardTemplate = ''): string
{
    $naslov = htmlspecialchars($item['fields']['naslov'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $opis = htmlspecialchars(mb_substr($item['fields']['opis'][$locale] ?? '', 0, $descMaxLength), ENT_QUOTES, 'UTF-8');
    $pdfUrl = htmlspecialchars($item['fields']['Fajl'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');

    $replacements = [
        '{{naslov}}' => $naslov,
        '{{opis}}' => $opis,
        '{{itemId}}' => $itemId,
        '{{eventDetails}}' => $texts['event_details'] ?? 'Details'
    ];

    return str_replace(array_keys($replacements), array_values($replacements), $cardTemplate);
}
HTML;

  protected string $pagination = <<<'PHP'
function renderPagination(int $currentPage, int $totalPages, int $range = 2): string
{
    if ($totalPages <= 1) return '';
    $html = "<div class='flex justify-center items-center gap-2 mt-10'>";
    if ($currentPage > 1) {
        $prevUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage - 1]));
        $html .= "<a href='{$prevUrl}' class='px-4 py-2 bg-white/80 rounded-xl border hover:bg-white shadow'><i class='fas fa-chevron-left'></i></a>";
    }
    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);
    for ($i = $start; $i <= $end; $i++) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
        $class = $i === $currentPage
            ? 'px-4 py-2 bg-primarybutton text-white rounded-xl font-semibold shadow-md'
            : 'px-4 py-2 bg-white/80 rounded-xl border hover:bg-white shadow font-medium';
        $html .= "<a href='{$url}' class='{$class}'>{$i}</a>";
    }
    if ($currentPage < $totalPages) {
        $nextUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
        $html .= "<a href='{$nextUrl}' class='px-4 py-2 bg-white/80 rounded-xl border hover:bg-white shadow'><i class='fas fa-chevron-right'></i></a>";
    }
    $html .= "</div>";
    return $html;
}
PHP;

  protected string $html = <<<'HTML'
<main class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <section class="container mx-auto px-4 py-12">
        <div class="mb-8 font-body text-secondary_text text-center">
            <h1 class="text-3xl font-heading text-primary_text mb-2">Jelovnik</h1>
            <p class="text-lg leading-relaxed mb-4 text-center">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>
            <p class="text-lg leading-relaxed mb-4 text-center">Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>
            <p class="font-heading2">Pregled dostupnih jelovnika.</p>
        </div>

        <div class="menu-grid">
            <?php
            if ($itemsList['success'] && !empty($itemsList['items'])) {
                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">';
                foreach ($itemsList['items'] as $item) {
                    echo cardRender($item, $locale, $texts, $descriptionMaxLength, $cardTemplate);
                }
                echo '</div>';
                $totalPages = ceil($itemsList['total'] / $itemsPerPage);
                echo renderPagination($currentPage, $totalPages, $paginationRange);
            } else {
                echo "<div class='glass-card rounded-lg p-12 text-center border border-white/40'>
                        <i class='fas fa-utensils text-5xl text-gray-400 mb-4'></i>
                        <p class='text-gray-500'>{$texts['no_items_found']}</p>
                      </div>";
            }
            ?>
        </div>
    </section>
</main>
HTML;

  public function buildPage(): string
  {
    $additionalPHP = <<<'PHP'
        use App\Models\Content;
        use App\Controllers\LanguageMapperController;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
        $slug = '__SLUG__';
        $itemsPerPage = __ITEMS_PER_PAGE__;
        $descriptionMaxLength = __DESC_MAX_LENGTH__;
        $paginationRange = __PAGINATION_RANGE__;

        $currentPage = max(1, (int) ($_GET['page'] ?? 1));
        $search = $_GET['search'] ?? '';

        $itemsList = $slug
            ? (new Content())->fetchListData($slug, $search, $currentPage, $itemsPerPage)
            : ['success' => false, 'items' => []];

        $translator = new LanguageMapperController();
        $latinTexts = [
            'event_details' => 'Detaljnije',
            'no_items_found' => 'Nema pronađenih jelovnika'
        ];
        $texts = ($locale === 'sr-Cyrl')
            ? $translator->latin_to_cyrillic_array($latinTexts)
            : $latinTexts;
    PHP;

    $additionalPHP .= "\n" . $this->cardTemplate;
    $additionalPHP .= "\n" . $this->cardRender;
    $additionalPHP .= "\n" . $this->pagination;

    $additionalPHP = str_replace('__SLUG__', addslashes($this->slug), $additionalPHP);
    $additionalPHP = str_replace('__ITEMS_PER_PAGE__', $this->itemsPerPage, $additionalPHP);
    $additionalPHP = str_replace('__DESC_MAX_LENGTH__', $this->descriptionMaxLength, $additionalPHP);
    $additionalPHP = str_replace('__PAGINATION_RANGE__', $this->paginationRange, $additionalPHP);

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

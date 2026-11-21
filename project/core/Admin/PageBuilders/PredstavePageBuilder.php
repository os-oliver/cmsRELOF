<?php

namespace App\Admin\PageBuilders;

use App\Controllers\LanguageMapperController;

class PredstavePageBuilder extends BasePageBuilder
{
    protected string $slug;
    private LanguageMapperController $translator;

    // Configurable variables
    private int $itemsPerPage = 15;
    private int $descriptionMaxLength = 120;
    private int $imageHeight = 56; // in rem units (h-56 = 14rem)
    private int $paginationRange = 2; // Number of pages to show on each side

    // Translatable text variables
    private array $texts = [];

    public function __construct(string $slug)
    {
        $this->slug = $slug;
        $this->translator = new LanguageMapperController();
        $this->initializeTexts();
    }

    private function initializeTexts(): void
    {
        // Get current locale
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $locale = $_SESSION['locale'] ?? 'sr-Cyrl';

        // Define all static texts in Latin
        $latinTexts = [
            'search_placeholder' => 'Pretraži...',
            'apply_button' => 'Primeni',
            'all_categories' => 'Sve kategorije',
            'date_and_time' => 'Datum i vreme',
            'duration' => 'Trajanje',
            'genre' => 'Žanr',
            'play_details' => 'Detalji predstave',
            'no_items_found' => 'Nema pronađenih stavki',
            'minutes' => 'minuta'
        ];

        // Convert to Cyrillic if needed
        if ($locale === 'sr-Cyrl') {
            $this->texts = $this->translator->latin_to_cyrillic_array($latinTexts);
        } else {
            $this->texts = $latinTexts;
        }
    }

    protected string $css = <<<CSS
    main{
        padding-top: 50px;
    }

/* Card styling tuned to theme */
.glass-card {
    background: rgba(255, 255, 255, 0.75);
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    border: 1px solid rgba(255, 255, 255, 0.4);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.glass-search {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(15px) saturate(180%);
    -webkit-backdrop-filter: blur(15px) saturate(180%);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

@media (max-width: 768px) {
    .glass-card {
        margin-bottom: 1rem;
    }
}
CSS;

    protected string $topBar = <<<'PHP'
function renderTopbar(array $categories, string $locale, string $searchValue = '', int|string|null $selectedCategoryId = null, array $texts = []): string
{
    $safeSearchValue = htmlspecialchars($searchValue, ENT_QUOTES, 'UTF-8');

    $html = "<form method='GET' action='' class='glass-search flex flex-col sm:flex-row items-center justify-between p-6 rounded-3xl shadow-xl mb-10 gap-4 border border-secondary/20'>";

    $html .= "<div class='flex w-full sm:w-auto flex-1 gap-3'>
        <input type='text' name='search' value='{$safeSearchValue}'
               placeholder='{$texts['search_placeholder']}'
               class='w-full border border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition-all shadow-sm bg-white/80 backdrop-blur-sm'>
        <button type='submit'
            class='bg-primary hover:bg-primary_hover text-background px-6 py-3 rounded-xl transition-all shadow-lg hover:shadow-xl font-semibold font-body'>
            {$texts['apply_button']}
        </button>
    </div>";

    $html .= "<div class='flex items-center w-full sm:w-auto'>
        <select name='category'
                class='w-full sm:w-64 border border-secondary/30 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition-all shadow-sm bg-background text-primary_text font-body appearance-none cursor-pointer'>
            <option value=''>{$texts['all_categories']}</option>";

    foreach ($categories as $cat) {
        $translations = $cat['translations'];
        $code = $cat['option_value'];
        $name = $translations[$locale] ?? $translations['sr'];
        $selected = ($selectedCategoryId == $cat['option_value']) ? 'selected' : '';
        $html .= "<option value='{$code}' {$selected}>{$name}</option>";
    }

    $html .= "</select></div></form>";

    return $html;
}
PHP;
    protected string $cardTemplate = <<<'HTML'
    $cardTemplate = <<<'PHP'
        <div class="glass-card rounded-3xl border border-secondary/20 transition-all duration-300 overflow-hidden group">
            <div class="relative w-full aspect-[4/5] overflow-hidden bg-secondary_background">
                {{imageSection}}
            </div>

            <div class="p-6 bg-background font-body text-secondary_text">
                <div class="flex items-center gap-2">
                    <span class="text-xs font-semibold uppercase tracking-[0.16em] mb-2 text-primary">
                        {{category}}
                    </span>
                </div>
                <h3 class="text-xl font-bold text-primary_text font-heading mb-4 line-clamp-2 group-hover:text-primary transition-colors">
                    {{naslov}}
                </h3>

                <a href="sadrzaj?id={{itemId}}&tip=generic_element"
                class="block w-full text-center bg-primary hover:bg-primary_hover text-background text-sm font-semibold py-3.5 px-4 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl font-body">
                    <span class="flex items-center justify-center gap-2">
                        <i class="fas fa-theater-masks"></i>
                        <span>{{playDetails}}</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
        PHP;
HTML;

    protected string $cardRender = <<<'HTML'
 function cardRender(array $item, array $fieldLabels, string $locale, array $texts = [], int $descMaxLength = 120,$cardTemplate=''): string
{
    $item = HashMapTransformer::remapToOldItemStructure($item, $locale);
    $naslov = htmlspecialchars($item['fields']['naslov'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = htmlspecialchars($item['image'] ?? '', ENT_QUOTES, 'UTF-8');
    $kategorija = htmlspecialchars($item['fields']['main_category'][$locale] ?? '', ENT_QUOTES, 'UTF-8');

    // Preformatted sections
    $imageSection = $imageUrl
        ? "<img src='{$imageUrl}' class='w-full h-full object-contain transition-transform duration-300 group-hover:scale-105' alt='Play image'>"
        : "<div class='absolute inset-0 flex items-center justify-center bg-secondary_background'>
                <i class='fas fa-theater-masks text-6xl text-secondary'></i>
           </div>";


    // Replace placeholders
    $replacements = [
        '{{naslov}}' => $naslov,
        '{{imageSection}}' => $imageSection,
        '{{itemId}}' => $itemId,
        '{{category}}' => $kategorija,
        '{{playDetails}}' => $texts['play_details'] ?? 'Details'
    ];

    return str_replace(array_keys($replacements), array_values($replacements), $cardTemplate);
}

HTML;

    protected string $pagination = <<<'PHP'
function renderPagination(int $currentPage, int $totalPages, int $range = 2): string
{
    if ($totalPages <= 1) return '';

    $html = "<div class='flex justify-center items-center gap-2 mt-10'>";

    // Previous button
    if ($currentPage > 1) {
        $prevUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage - 1]));
        $html .= "<a href='{$prevUrl}'
                   class='px-4 py-2 bg-background rounded-xl border border-secondary/30 hover:bg-secondary_background hover:border-secondary transition-all shadow-sm hover:shadow font-body text-secondary'>
            <i class='fas fa-chevron-left text-secondary'></i>
        </a>";
    }

    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);

    // First page + ellipsis
    if ($start > 1) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
        $html .= "<a href='{$url}'
                   class='px-4 py-2 bg-background rounded-xl border border-secondary/30 hover:bg-secondary_background hover:border-secondary transition-all shadow-sm hover:shadow font-medium text-secondary'>1</a>";
        if ($start > 2) $html .= "<span class='px-2 text-secondary_text'>...</span>";
    }

    // Page numbers
    for ($i = $start; $i <= $end; $i++) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
        $class = $i === $currentPage
            ? 'px-4 py-2 bg-primary text-primary rounded-xl font-semibold shadow-md'
            : 'px-4 py-2 bg-background rounded-xl border border-secondary/30 hover:bg-secondary_background hover:border-secondary transition-all shadow-sm hover:shadow font-medium text-secondary';
        $html .= "<a href='{$url}' class='{$class}'>{$i}</a>";
    }

    // Last page + ellipsis
    if ($end < $totalPages) {
        if ($end < $totalPages - 1) $html .= "<span class='px-2 text-secondary_text'>...</span>";
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
        $html .= "<a href='{$url}'
                   class='px-4 py-2 bg-background rounded-xl border border-secondary/30 hover:bg-secondary_background hover:border-secondary transition-all shadow-sm hover:shadow font-medium text-secondary'>{$totalPages}</a>";
    }

    // Next button
    if ($currentPage < $totalPages) {
        $nextUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
        $html .= "<a href='{$nextUrl}'
                   class='px-4 py-2 bg-background rounded-xl border border-secondary/30 hover:bg-secondary_background hover:border-secondary transition-all shadow-sm hover:shadow font-body text-secondary'>
            <i class='fas fa-chevron-right text-secondary'></i>
        </a>";
    }

    $html .= "</div>";

    return $html;
}
PHP;
    protected string $html = <<<'HTML'
<main class="bg-background min-h-screen font-body">
    <section class="container mx-auto px-4 py-12">
        <div class="mb-10 text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-bold text-primary_text font-heading mb-2">Predstave</h1>
        </div>

        <?php echo renderTopbar($categories, $locale, $search, $categoryId, $texts); ?>

        <div class="performances-grid">
            <?php
            if ($itemsList['success'] && !empty($itemsList['items'])) {
                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">';
                foreach ($itemsList['items'] as $item) {
                    echo cardRender($item, $fieldLabels, $locale, $texts, $descriptionMaxLength,$cardTemplate);
                }
                echo '</div>';

                $totalPages = ceil($itemsList['total'] / $itemsPerPage);
                echo renderPagination($currentPage, $totalPages, $paginationRange);
            } else {
                echo "<div class='glass-card rounded-3xl p-12 text-center border border-secondary/20'>
                    <i class='fas fa-inbox text-5xl text-secondary mb-4'></i>
                    <p class='text-secondary_text'>{$texts['no_items_found']}</p>
                </div>";
            }
            ?>
        </div>
        <?php echo renderPerPageDropdown($itemsPerPage) ?>
    </section>
</main>
HTML;

    public function buildPage(): string
    {
        $additionalPHP = <<<'PHP'
use App\Models\Content;
use App\Controllers\LanguageMapperController;
use App\Models\ContentType;
use App\Utils\HashMapTransformer;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$locale = $_SESSION['locale'] ?? 'sr-Cyrl';
$slug = '__SLUG__';
$pageTitle = ucfirst($slug);
$pageDescription = 'Pregled svih stavki';

// Configuration variables
$itemsPerPage = __ITEMS_PER_PAGE__;
if (isset($_GET['per_page']) && is_numeric($_GET['per_page'])) {
    $itemsPerPage = (int)$_GET['per_page'];
}
$descriptionMaxLength = __DESC_MAX_LENGTH__;
$paginationRange = __PAGINATION_RANGE__;

$currentPage = max(1, (int) ($_GET['page'] ?? 1));
$categoryId = isset($_GET['category']) && $_GET['category'] !== ''
    ? (is_numeric($_GET['category'])
        ? (int) $_GET['category']
        : trim((string) $_GET['category'])
      )
    : null;
$search = $_GET['search'] ?? '';

$categories = ContentType::fetchMainCategoriesByContentTypeCode($slug, true);
$itemsList = $slug
    ? (new Content())->fetchListData($slug, $search, $currentPage, $itemsPerPage, $categoryId, $locale, 'datum', 'DESC')
    : ['success' => false, 'items' => [], 'total' => 0];

$config = $fieldLabels = [];
if ($slug && file_exists($structurePath = __DIR__ . '/../../assets/data/structure.json')) {
    $parsed = json_decode(file_get_contents($structurePath), true);
    $config = $parsed[0][$slug] ?? [];
    $fieldLabels = array_column($config['fields'] ?? [], null, 'name');
}

// Initialize translator and texts
$translator = new LanguageMapperController();
$latinTexts = [
    'search_placeholder' => 'Pretraži...',
    'apply_button' => 'Primeni',
    'all_categories' => 'Sve kategorije',
    'date_and_time' => 'Datum i vreme',
    'duration' => 'Trajanje',
    'genre' => 'Žanr',
    'play_details' => 'Detalji predstave',
    'no_items_found' => 'Nema pronađenih stavki',
    'minutes' => 'minuta'
];

$texts = ($locale === 'sr-Cyrl')
    ? $translator->latin_to_cyrillic_array($latinTexts)
    : $latinTexts;
PHP;

        $additionalPHP .= "\n" . $this->cardTemplate;
        $additionalPHP .= "\n" . $this->cardRender;
        $additionalPHP .= "\n" . $this->pagination;
        $additionalPHP .= "\n" . $this->topBar;
        $additionalPHP = str_replace('__SLUG__', addslashes($this->slug), $additionalPHP);
        $additionalPHP = str_replace('__ITEMS_PER_PAGE__', $this->itemsPerPage, $additionalPHP);
        $additionalPHP = str_replace('__DESC_MAX_LENGTH__', $this->descriptionMaxLength, $additionalPHP);
        $additionalPHP = str_replace('__PAGINATION_RANGE__', $this->paginationRange, $additionalPHP);

        $content = $this->getHeader($this->css, $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->getPerPageDropdown();
        $content .= $this->html;
        $content .= $this->getFooter();

        return $content;
    }

    public function render(): void
    {
        echo $this->buildPage();
    }
}

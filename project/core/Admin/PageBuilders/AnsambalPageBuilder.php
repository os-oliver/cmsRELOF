<?php
namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class AnsambalPageBuilder extends BasePageBuilder
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
            // Promenjeno: date_and_time -> member_since (Primer: 'Datum učlanjenja')
            'member_since' => 'Datum učlanjenja',
            // Promenjeno: location -> role (Primer: 'Uloga u ansamblu')
            'role' => 'Uloga u ansamblu',
            // Promenjeno: event_details -> ensemble_details
            'ensemble_details' => 'Detalji člana',
            'no_items_found' => 'Nema pronađenih stavki',
            // Zadržana lista meseci, iako sada manje relevantna, za slučaj da se koristi.
            'months' => ['jan', 'feb', 'mar', 'apr', 'maj', 'jun', 'jul', 'avg', 'sep', 'okt', 'nov', 'dec']
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

/* Enhanced Glassmorphism effect */
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


/* Responsive adjustments */
@media (max-width: 768px) {
    .glass-card {
        margin-bottom: 1rem;
    }
}
CSS;

    protected string $topBar = <<<'PHP'
function renderTopbar(array $categories, string $searchValue = '', ?int $selectedCategoryId = null, array $texts = []): string
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
        $id = htmlspecialchars($cat['id'], ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars($cat['name'], ENT_QUOTES, 'UTF-8');
        $selected = ($selectedCategoryId == $cat['id']) ? 'selected' : '';
        $html .= "<option value='{$id}' {$selected}>{$name}</option>";
    }

    $html .= "</select></div></form>";

    return $html;
}
PHP;

    protected string $cardTemplate = <<<'HTML'
    $cardTemplate = <<<'PHP'
    <div class="relative group">
        <div class="absolute -inset-0.5 bg-gradient-to-br from-secondary via-accent to-primary rounded-2xl blur-sm opacity-0 group-hover:opacity-30 transition duration-500"></div>
        <div class="relative bg-surface rounded-2xl shadow-lg hover:shadow-2xl overflow-hidden transition-all duration-300">
            <div class="relative w-full h-96 overflow-hidden bg-gradient-to-br from-primary/20 to-accent/20">
                {{imageSection}}
            </div>
            <div class="p-6 space-y-5">
                <div class="space-y-2">
                    <h3 class="text-xl font-bold text-primary_text mb-1 line-clamp-2 group-hover:text-secondary transition-colors duration-300">
                        {{name}}
                    </h3>
                    <div class="w-12 h-0.5 bg-gradient-to-r from-accent to-transparent"></div>
                </div>
                <a href="sadrzaj?id={{itemId}}&tip=generic_element"
                   class="group/btn relative block w-full text-center overflow-hidden rounded-xl transition-all duration-300 hover:shadow-lg">
                    <div class="absolute inset-0 bg-gradient-to-r from-secondary to-primary"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-700"></div>
                    <div class="relative flex items-center justify-center gap-2.5 py-3.5 px-4 text-background font-semibold">
                        <i class="fas fa-users text-base"></i>
                        <span class="text-sm tracking-wide">{{ensembleDetails}}</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-1"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </div>
                </a>
            </div>
            <div class="h-1.5 bg-gradient-to-r from-accent via-secondary to-primary"></div>
        </div>
    </div>
    PHP;
HTML;



    protected string $cardRender = <<<'PHP'
function cardRender(array $item, array $fieldLabels, string $locale, array $texts = [], int $descMaxLength = 120, $cardTemplate=''): string
{
    $item = HashMapTransformer::remapToOldItemStructure($item, $locale);
    $name = htmlspecialchars($item['fields']['name'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = htmlspecialchars($item['image'] ?? '', ENT_QUOTES, 'UTF-8');

    $imageSection = $imageUrl
        ? "<img src='{$imageUrl}' class='w-full h-full object-cover transition-all duration-500 group-hover:scale-105' alt='Ensemble image' loading='lazy'>"
        : "<div class='absolute inset-0 flex items-center justify-center bg-gradient-to-br from-sage/30 via-paper to-deep-teal/20'>
                <div class='relative'>
                    <div class='absolute inset-0 bg-terracotta/20 blur-2xl'></div>
                    <i class='fas fa-users text-6xl text-slate/40 relative'></i>
                </div>
           </div>";

    $replacements = [
        '{{name}}' => $name,
        '{{imageSection}}' => $imageSection,
        '{{itemId}}' => $itemId,
        // Promenjeno: ensemble_details iz $texts
        '{{ensembleDetails}}' => $texts['ensemble_details'] ?? 'Detalji člana'
    ];

    return str_replace(array_keys($replacements), array_values($replacements), $cardTemplate);
}
PHP;

    protected string $pagination = <<<'PHP'
function renderPagination(int $currentPage, int $totalPages, int $range = 2): string
{
    if ($totalPages <= 1) return '';

    $html = "<div class='flex justify-center items-center gap-2 mt-10'>";

    if ($currentPage > 1) {
        $prevUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage - 1]));
        $html .= "<a href='{$prevUrl}' class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm hover:shadow'>
            <i class='fas fa-chevron-left text-gray-600'></i>
        </a>";
    }

    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);

    if ($start > 1) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
        $html .= "<a href='{$url}' class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm hover:shadow font-medium'>1</a>";
        if ($start > 2) $html .= "<span class='px-2 text-gray-400'>...</span>";
    }

    for ($i = $start; $i <= $end; $i++) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
        $class = $i === $currentPage
            ? 'px-4 py-2 bg-gray-800 text-white rounded-xl font-semibold shadow-md'
            : 'px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm hover:shadow font-medium';
        $html .= "<a href='{$url}' class='{$class}'>{$i}</a>";
    }

    if ($end < $totalPages) {
        if ($end < $totalPages - 1) $html .= "<span class='px-2 text-gray-400'>...</span>";
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
        $html .= "<a href='{$url}' class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm hover:shadow font-medium'>{$totalPages}</a>";
    }

    if ($currentPage < $totalPages) {
        $nextUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
        $html .= "<a href='{$nextUrl}' class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm hover:shadow'>
            <i class='fas fa-chevron-right text-gray-600'></i>
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
            <h1 class="text-3xl md:text-4xl font-bold text-primary_text font-heading mb-2">Ansambl</h1>
        </div>

        <?php echo renderTopbar($categories, $search, $categoryId, $texts); ?>

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
                echo "<div class='glass-card rounded-lg p-12 text-center border border-secondary/20'>
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
use App\Models\GenericCategory;
use App\Utils\HashMapTransformer;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$locale = $_SESSION['locale'] ?? 'sr-Cyrl';
$slug = '__SLUG__';
$pageTitle = ucfirst($slug);
// Promenjeno: 'Pregled svih stavki' - zadržano kao opšte
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

$categories = GenericCategory::fetchAll($slug, $locale);
$itemsList = $slug
    ? (new Content())->fetchListData($slug, $search, $currentPage, $itemsPerPage, $categoryId)
    : ['success' => false, 'items' => []];

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
    // Promenjeno: date_and_time -> member_since
    'member_since' => 'Datum učlanjenja',
    // Promenjeno: location -> role
    'role' => 'Uloga u ansamblu',
    // Promenjeno: event_details -> ensemble_details
    'ensemble_details' => 'Detalji člana',
    'no_items_found' => 'Nema pronađenih stavki',
    'months' => ['jan', 'feb', 'mar', 'apr', 'maj', 'jun', 'jul', 'avg', 'sep', 'okt', 'nov', 'dec']
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
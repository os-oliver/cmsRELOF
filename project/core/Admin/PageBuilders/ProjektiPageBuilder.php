<?php
namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class ProjektiPageBuilder extends BasePageBuilder
{
    protected string $slug;
    private LanguageMapperController $translator;

    // Configurable variables
    private int $itemsPerPage = 3;
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
            'location' => 'Lokacija',
            'event_details' => 'Detalji događaja',
            'no_items_found' => 'Nema pronađenih stavki',
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
.dropdown:hover .dropdown-menu {
    display: block;
}

.dropdown-menu {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 200px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.1);
    z-index: 1;
    border-radius: 8px;
    overflow: hidden;
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

.category-chip {
    display: inline-flex;
    align-items: center;
    padding: 0.375rem 0.875rem;
    background: rgba(107, 114, 128, 0.9);
    backdrop-filter: blur(10px);
    color: white;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.025em;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

/* Improved field layout */
.fields-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.card-field {
    position: relative;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(10px);
    border-radius: 0.5rem;
    border: 1px solid rgba(255, 255, 255, 0.4);
    transition: all 0.3s ease;
    min-height: 60px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.card-field:hover {
    background: rgba(255, 255, 255, 0.8);
    border-color: rgba(255, 255, 255, 0.6);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.card-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.05) 100%);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .fields-container {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .glass-card {
        margin-bottom: 1rem;
    }
}
CSS;

    protected string $topBar = <<<'PHP'
function renderTopbar(array $categories, string $searchValue = '', ?int $selectedCategoryId = null, array $texts = []): string
{
    $safeSearchValue = htmlspecialchars($searchValue, ENT_QUOTES, 'UTF-8');
    
    $html = "<form method='GET' action='' class='glass-search flex flex-col sm:flex-row items-center justify-between p-6 rounded-2xl shadow-lg mb-8 gap-4'>";
    
    $html .= "<div class='flex w-full sm:w-auto flex-1 gap-3'>
        <input type='text' name='search' value='{$safeSearchValue}' 
               placeholder='{$texts['search_placeholder']}' 
               class='w-full border border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition-all shadow-sm bg-white/80 backdrop-blur-sm'>
        <button type='submit' 
                class='bg-gray-800 hover:bg-gray-900 text-white px-6 py-3 rounded-xl transition-all shadow-md hover:shadow-lg font-medium'>
            {$texts['apply_button']}
        </button>
    </div>";
    
    $html .= "<div class='flex items-center w-full sm:w-auto'>
        <select name='category' 
                class='w-full sm:w-64 border border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition-all shadow-sm bg-white/80 backdrop-blur-sm appearance-none cursor-pointer'>
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
<div class="group">
    <div class="relative bg-paper rounded-2xl shadow-md overflow-hidden transition-shadow duration-200">
        <div class="flex items-stretch">
            <!-- Left: Image column (fixed width on desktop, full-width on mobile) -->
            <div class="w-36 sm:w-48 md:w-56 lg:w-64 flex-shrink-0 h-36 sm:h-48 md:h-56 lg:h-64 bg-gray-100 overflow-hidden">
                {{imageSection}}
            </div>

            <!-- Right: Dense content -->
            <div class="p-3 sm:p-4 md:p-5 flex-1">
                <!-- Header: title + small meta -->
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <h3 class="text-sm sm:text-base md:text-lg font-semibold text-slate line-clamp-2">{{naziv}}</h3>
                        <div class="mt-1 text-2xs sm:text-xs text-slate/70 flex items-center gap-3">
                            <span class="truncate">{{vodja}}</span>
                            <span aria-hidden="true">•</span>
                            <span class="truncate">{{datumPocetka}}</span>
                        </div>
                    </div>

                    <div class="ml-2 text-right">
                        <div class="text-sm font-medium text-slate">{{budzet}}</div>
                    </div>
                </div>

                <!-- Dense description -->
                <div class="mt-2">
                    <p class="text-xs sm:text-sm leading-tight text-slate/80 line-clamp-4">{{opis}}</p>

                    <!-- Clickable official link (if present) -->
                    <div class="mt-2">
                        {{clickableLink}}
                    </div>
                </div>

                <!-- Footer: CTA (always fixed href) -->
                <div class="mt-3">
                    <!-- Elegant CTA button (always points to sadrzaj?id={{itemId}}&tip=generic_element) -->
                    <a href="sadrzaj?id={{itemId}}&tip=generic_element"
                       class="group/btn relative inline-flex items-center justify-center gap-2 w-full rounded-lg py-2 text-sm font-semibold text-paper overflow-hidden transition-shadow duration-200">
                        
                        <div class="absolute inset-0 bg-gradient-to-r from-deep-teal to-royal-blue"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent translate-x-[-100%] group-hover/btn:translate-x-[100%] transition-transform duration-600"></div>
                        
                        <span class="relative flex items-center justify-center gap-2">
                            <i class="fas fa-users text-sm"></i>
                            <span>{{ensembleDetails}}</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
PHP;
HTML;

    protected string $cardRender = <<<'HTML'
function cardRender(array $item, array $fieldLabels, string $locale, array $texts = [], int $descMaxLength = 120, $cardTemplate=''): string
{
    // Basic fields
    $naziv = htmlspecialchars($item['fields']['naziv'][$locale] ?? $item['fields']['naziv'] ?? '', ENT_QUOTES, 'UTF-8');
    $vodja = htmlspecialchars($item['fields']['vodja'][$locale] ?? $item['fields']['vodja'] ?? '', ENT_QUOTES, 'UTF-8');
    $rawOpis = $item['fields']['opis'][$locale] ?? $item['fields']['opis'] ?? '';
    $opis = htmlspecialchars(mb_substr((string)$rawOpis, 0, $descMaxLength), ENT_QUOTES, 'UTF-8');
    $datumPocetka = htmlspecialchars($item['fields']['datumPocetka'][$locale] ?? $item['fields']['datumPocetka'] ?? '', ENT_QUOTES, 'UTF-8');
    $budzet = htmlspecialchars((string)($item['fields']['budzet'][$locale] ?? $item['fields']['budzet'] ?? ''), ENT_QUOTES, 'UTF-8');
    $linkRaw = $item['fields']['link'][$locale] ?? $item['fields']['link'] ?? '';
    $linkEsc = htmlspecialchars((string)$linkRaw, ENT_QUOTES, 'UTF-8');
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');

    // Resolve image field robustly (supporting file object, array of files or direct url)
    $imageUrl = '';
    if (!empty($item['fields']['slika'])) {
        $slika = $item['fields']['slika'];
        if (is_array($slika)) {
            // array of files or associative
            if (isset($slika[0]) && is_array($slika[0]) && !empty($slika[0]['url'])) {
                $imageUrl = $slika[0]['url'];
            } elseif (!empty($slika['url'])) {
                $imageUrl = $slika['url'];
            } elseif (!empty($slika[0]) && is_string($slika[0])) {
                $imageUrl = $slika[0];
            }
        } elseif (is_string($slika)) {
            $imageUrl = $slika;
        }
    } elseif (!empty($item['image'])) {
        // fallback to older key
        $imageUrl = $item['image'];
    }

    $imageUrl = htmlspecialchars((string)$imageUrl, ENT_QUOTES, 'UTF-8');

    // Image section markup (left column). Use <img> when present, otherwise placeholder SVG/icon block.
    $imageSection = $imageUrl
        ? "<img src='{$imageUrl}' alt='Project image' loading='lazy' class='w-full h-full object-cover'>"
        : "<div class='w-full h-full flex items-center justify-center bg-gradient-to-br from-sage/20 to-deep-teal/10'>
                <div class='text-center'>
                    <div class='bg-terracotta/20 rounded-full p-3 inline-block'>
                        <i class='fas fa-image text-2xl text-slate/40'></i>
                    </div>
                </div>
           </div>";

    // Clickable link HTML (if provided). Shows the link text and is clickable.
    $clickableLink = $linkEsc !== ''
        ? "<a href='{$linkEsc}' target='_blank' rel='noopener noreferrer' class='text-xs sm:text-sm underline break-words text-blue-600'>{$linkEsc}</a>"
        : "";

    // Replacements for placeholders
    $replacements = [
        '{{naziv}}' => $naziv,
        '{{vodja}}' => $vodja,
        '{{opis}}' => $opis,
        '{{datumPocetka}}' => $datumPocetka,
        '{{budzet}}' => $budzet,
        '{{link}}' => $linkEsc, // legacy placeholder if used
        '{{clickableLink}}' => $clickableLink,
        '{{imageSection}}' => $imageSection,
        '{{itemId}}' => $itemId,
        '{{ensembleDetails}}' => htmlspecialchars($texts['ensemble_details'] ?? 'Detalji', ENT_QUOTES, 'UTF-8'),
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
                   class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm hover:shadow'>
            <i class='fas fa-chevron-left text-gray-600'></i>
        </a>";
    }
    
    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);
    
    // First page + ellipsis
    if ($start > 1) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
        $html .= "<a href='{$url}' 
                   class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm hover:shadow font-medium'>1</a>";
        if ($start > 2) $html .= "<span class='px-2 text-gray-400'>...</span>";
    }
    
    // Page numbers
    for ($i = $start; $i <= $end; $i++) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
        $class = $i === $currentPage 
            ? 'px-4 py-2 bg-gray-800 text-white rounded-xl font-semibold shadow-md' 
            : 'px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm hover:shadow font-medium';
        $html .= "<a href='{$url}' class='{$class}'>{$i}</a>";
    }
    
    // Last page + ellipsis
    if ($end < $totalPages) {
        if ($end < $totalPages - 1) $html .= "<span class='px-2 text-gray-400'>...</span>";
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
        $html .= "<a href='{$url}' 
                   class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm hover:shadow font-medium'>{$totalPages}</a>";
    }
    
    // Next button
    if ($currentPage < $totalPages) {
        $nextUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
        $html .= "<a href='{$nextUrl}' 
                   class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm hover:shadow'>
            <i class='fas fa-chevron-right text-gray-600'></i>
        </a>";
    }
    
    $html .= "</div>";
    
    return $html;
}
PHP;
    protected string $html = <<<'HTML'
<main class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <section class="container mx-auto px-4 py-12">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Događaji</h1>
            <p class="text-gray-600">Istražite našu bogatu ponudu kulturnih događaja</p>
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
                echo "<div class='glass-card rounded-lg p-12 text-center border border-white/40'>
                    <i class='fas fa-inbox text-5xl text-gray-400 mb-4'></i>
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
use App\Models\GenericCategory;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$locale = $_SESSION['locale'] ?? 'sr-Cyrl';
$slug = '__SLUG__';
$pageTitle = ucfirst($slug);
$pageDescription = 'Pregled svih stavki';

// Configuration variables
$itemsPerPage = __ITEMS_PER_PAGE__;
$descriptionMaxLength = __DESC_MAX_LENGTH__;
$paginationRange = __PAGINATION_RANGE__;

$currentPage = max(1, (int) ($_GET['page'] ?? 1));
$categoryId = isset($_GET['category']) && is_numeric($_GET['category']) ? (int) $_GET['category'] : null;
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
    'date_and_time' => 'Datum i vreme',
    'location' => 'Lokacija',
    'event_details' => 'Detalji događaja',
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
        $content .= $this->html;
        $content .= $this->getFooter();

        return $content;
    }

    public function render(): void
    {
        echo $this->buildPage();
    }
}
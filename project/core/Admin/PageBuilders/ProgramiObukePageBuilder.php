<?php
namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class ProgramiObukePageBuilder extends BasePageBuilder
{
    protected string $slug;
    private LanguageMapperController $translator;

    // Configurable variables
    private int $itemsPerPage = 15;
    private int $descriptionMaxLength = 200;
    private int $imageHeight = 48; // in rem units (h-48 = 12rem)
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
            'search_placeholder' => 'Pretraži programe...',
            'apply_button' => 'Primeni',
            'all_categories' => 'Sve kategorije',
            'time_schedule' => 'Raspored',
            'frequency' => 'Učestalost',
            'program_details' => 'Detalji programa',
            'no_items_found' => 'Nema pronađenih programa',
            'register_now' => 'Prijavi se',
            'new_badge' => 'Novo',
            'popular_badge' => 'Popularno',
            'last_spots_badge' => 'Poslednja mesta'
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

.category-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 9999px;
    font-size: 0.875rem;
    font-weight: 600;
    letter-spacing: 0.025em;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.badge-green { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.badge-blue { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; }
.badge-orange { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
.badge-purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; }
.badge-red { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; }
.badge-yellow { background: linear-gradient(135deg, #eab308, #ca8a04); color: white; }

.special-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    padding: 0.375rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    z-index: 10;
}

.badge-new {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
}

.badge-popular {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
}

.badge-last-spots {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
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
    
    $html = "<form method='GET' action='' class='glass-search flex flex-col sm:flex-row items-center justify-between p-6 rounded-2xl shadow-lg mb-8 gap-4'>";
    
    $html .= "<div class='flex w-full sm:w-auto flex-1 gap-3'>
        <input type='text' name='search' value='{$safeSearchValue}' 
               placeholder='{$texts['search_placeholder']}' 
               class='w-full border border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent transition-all shadow-sm bg-white/80 backdrop-blur-sm'>
        <button type='submit' 
                class='bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl transition-all shadow-md hover:shadow-lg font-medium'>
            {$texts['apply_button']}
        </button>
    </div>";
    
    $html .= "<div class='flex items-center w-full sm:w-auto'>
        <select name='category' 
                class='w-full sm:w-64 border border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent transition-all shadow-sm bg-white/80 backdrop-blur-sm appearance-none cursor-pointer'>
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
        <div class="glass-card rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-1">
            <div class="relative w-full h-48 overflow-hidden bg-gradient-to-br from-green-100 to-teal-100">
                {{imageSection}}
                {{specialBadge}}
            </div>

            <div class="p-6">
                <div class="mb-4">
                    {{categoryBadge}}
                </div>

                <h3 class="text-xl font-bold text-gray-900 mb-4 line-clamp-2 group-hover:text-green-600 transition-colors">
                    {{naslov}}
                </h3>

                <div class="space-y-3 mb-4">
                    {{timeScheduleRow}}
                    {{frequencyRow}}
                </div>

                <div class="mb-5 p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-sm text-gray-700 leading-relaxed">{{opis}}</p>
                </div>

                <div class="flex gap-2">
                    <a href="/sadrzaj?id={{itemId}}&tip=generic_element"
                    class="flex-1 text-center bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white text-sm font-bold py-3.5 px-4 rounded-xl transition-all duration-300 shadow-md hover:shadow-xl backdrop-blur-sm">
                        <span class="flex items-center justify-center gap-2">
                            <i class="fas fa-info-circle"></i>
                            <span>{{programDetails}}</span>
                        </span>
                    </a>
                    {{registrationButton}}
                </div>
            </div>
        </div>
        PHP;
HTML;

    protected string $cardRender = <<<'HTML'
 function cardRender(array $item, array $fieldLabels, string $locale, array $texts = [], int $descMaxLength = 200,$cardTemplate=''): string
{
    $naslov = htmlspecialchars($item['fields']['naslov'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $opis = htmlspecialchars(mb_substr($item['fields']['kratakOpis'][$locale] ?? '', 0, $descMaxLength), ENT_QUOTES, 'UTF-8');
    $kategorija = htmlspecialchars($item['category']['content'] ?? '', ENT_QUOTES, 'UTF-8');
    $ikonica = htmlspecialchars($item['fields']['ikonica'][$locale] ?? 'fas fa-graduation-cap', ENT_QUOTES, 'UTF-8');
    $bojaKategorije = htmlspecialchars($item['fields']['bojaKategorije'][$locale] ?? 'green', ENT_QUOTES, 'UTF-8');
    $vremePocetka = htmlspecialchars($item['fields']['vremePocetka'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $vremeZavrsetka = htmlspecialchars($item['fields']['vremeZavrsetka'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $ucestalost = htmlspecialchars($item['fields']['ucestalost'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $oznaka = htmlspecialchars($item['fields']['oznaka'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $linkPrijave = htmlspecialchars($item['fields']['linkPrijave'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = htmlspecialchars($item['image'] ?? '', ENT_QUOTES, 'UTF-8');

    // Preformatted sections
    $imageSection = $imageUrl
        ? "<img src='{$imageUrl}' class='w-full h-full object-cover transition-transform duration-300 group-hover:scale-105' alt='Program image'>"
        : "<div class='absolute inset-0 flex items-center justify-center'>
                <i class='fas fa-graduation-cap text-6xl text-green-300'></i>
           </div>";

    // Special badge
    $specialBadge = '';
    if ($oznaka) {
        $badgeClass = '';
        $badgeText = $oznaka;
        if ($oznaka === 'Novo') {
            $badgeClass = 'badge-new';
            $badgeText = $texts['new_badge'] ?? 'Novo';
        } elseif ($oznaka === 'Popularno') {
            $badgeClass = 'badge-popular';
            $badgeText = $texts['popular_badge'] ?? 'Popularno';
        } elseif ($oznaka === 'Poslednja mesta') {
            $badgeClass = 'badge-last-spots';
            $badgeText = $texts['last_spots_badge'] ?? 'Poslednja mesta';
        }
        $specialBadge = "<span class='special-badge {$badgeClass}'>{$badgeText}</span>";
    }

    // Category badge
    $categoryBadge = $kategorija
        ? "<span class='category-badge badge-green'>
               <i class='{$ikonica}'></i>
               <span>{$kategorija}</span>
           </span>"
        : '';

    // Time schedule row
    $timeScheduleRow = ($vremePocetka || $vremeZavrsetka)
        ? "<div class='flex items-start gap-3'>
               <div class='flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center'>
                   <i class='fas fa-clock text-green-600'></i>
               </div>
               <div class='flex-1'>
                   <div class='text-xs font-semibold text-gray-500 uppercase tracking-wide mb-0.5'>{$texts['time_schedule']}</div>
                   <div class='text-sm font-semibold text-gray-900'>{$vremePocetka}" . ($vremePocetka && $vremeZavrsetka ? " - " : "") . "{$vremeZavrsetka}</div>
               </div>
           </div>"
        : '';

    // Frequency row
    $frequencyRow = $ucestalost
        ? "<div class='flex items-start gap-3'>
               <div class='flex-shrink-0 w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center'>
                   <i class='fas fa-calendar-check text-teal-600'></i>
               </div>
               <div class='flex-1 min-w-0'>
                   <div class='text-xs font-semibold text-gray-500 uppercase tracking-wide mb-0.5'>{$texts['frequency']}</div>
                   <div class='text-sm font-semibold text-gray-900 truncate'>{$ucestalost}</div>
               </div>
           </div>"
        : '';

    // Registration button
    $registrationButton = $linkPrijave
        ? "<a href='{$linkPrijave}' target='_blank'
            class='flex-1 text-center bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white text-sm font-bold py-3.5 px-4 rounded-xl transition-all duration-300 shadow-md hover:shadow-xl'>
                <span class='flex items-center justify-center gap-2'>
                    <i class='fas fa-user-plus'></i>
                    <span>{$texts['register_now']}</span>
                </span>
           </a>"
        : '';

    // Replace placeholders
    $replacements = [
        '{{naslov}}' => $naslov,
        '{{opis}}' => $opis,
        '{{imageSection}}' => $imageSection,
        '{{specialBadge}}' => $specialBadge,
        '{{categoryBadge}}' => $categoryBadge,
        '{{timeScheduleRow}}' => $timeScheduleRow,
        '{{frequencyRow}}' => $frequencyRow,
        '{{registrationButton}}' => $registrationButton,
        '{{itemId}}' => $itemId,
        '{{programDetails}}' => $texts['program_details'] ?? 'Details'
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
                   class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-green-400 transition-all shadow-sm hover:shadow'>
            <i class='fas fa-chevron-left text-gray-600'></i>
        </a>";
    }
    
    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);
    
    // First page + ellipsis
    if ($start > 1) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
        $html .= "<a href='{$url}' 
                   class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-green-400 transition-all shadow-sm hover:shadow font-medium'>1</a>";
        if ($start > 2) $html .= "<span class='px-2 text-gray-400'>...</span>";
    }
    
    // Page numbers
    for ($i = $start; $i <= $end; $i++) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
        $class = $i === $currentPage 
            ? 'px-4 py-2 bg-green-600 text-white rounded-xl font-semibold shadow-md' 
            : 'px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-green-400 transition-all shadow-sm hover:shadow font-medium';
        $html .= "<a href='{$url}' class='{$class}'>{$i}</a>";
    }
    
    // Last page + ellipsis
    if ($end < $totalPages) {
        if ($end < $totalPages - 1) $html .= "<span class='px-2 text-gray-400'>...</span>";
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
        $html .= "<a href='{$url}' 
                   class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-green-400 transition-all shadow-sm hover:shadow font-medium'>{$totalPages}</a>";
    }
    
    // Next button
    if ($currentPage < $totalPages) {
        $nextUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
        $html .= "<a href='{$nextUrl}' 
                   class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-green-400 transition-all shadow-sm hover:shadow'>
            <i class='fas fa-chevron-right text-gray-600'></i>
        </a>";
    }
    
    $html .= "</div>";
    
    return $html;
}
PHP;

    protected string $html = <<<'HTML'
<main class="bg-gradient-to-br from-green-50 to-teal-50 min-h-screen">
    <section class="container mx-auto px-4 py-12">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Programi obuke</h1>
            <p class="text-gray-600">Istražite našu raznovrsnu ponudu edukativnih programa</p>
        </div>
        
        <?php echo renderTopbar($categories, $search, $categoryId, $texts); ?>
        
        <div class="programs-grid">
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

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$locale = $_SESSION['locale'] ?? 'sr-Cyrl';
$slug = '__SLUG__';
$pageTitle = ucfirst($slug);
$pageDescription = 'Pregled svih programa obuke';

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
    ? (new Content())->fetchListData($slug, $search, $currentPage, $itemsPerPage, $categoryId, $locale) 
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
    'search_placeholder' => 'Pretraži programe...',
    'apply_button' => 'Primeni',
    'all_categories' => 'Sve kategorije',
    'time_schedule' => 'Raspored',
    'frequency' => 'Učestalost',
    'program_details' => 'Detalji programa',
    'no_items_found' => 'Nema pronađenih programa',
    'register_now' => 'Prijavi se',
    'new_badge' => 'Novo',
    'popular_badge' => 'Popularno',
    'last_spots_badge' => 'Poslednja mesta'
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

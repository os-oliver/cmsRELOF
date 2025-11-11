<?php
namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class UslugePageBuilder extends BasePageBuilder
{
    protected string $slug;
    private LanguageMapperController $translator;

    // Configurable variables
    private int $itemsPerPage = 9;
    private int $descriptionMaxLength = 250;
    private int $paginationRange = 2;

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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $locale = $_SESSION['locale'] ?? 'sr-Cyrl';

        $latinTexts = [
            'search_placeholder' => 'Pretraži usluge...',
            'apply_button' => 'Primeni',
            'all_categories' => 'Sve kategorije',
            'funding' => 'Finansiranje',
            'contact' => 'Kontakt',
            'service_details' => 'Detalji usluge',
            'no_items_found' => 'Nema pronađenih usluga',
            'download_form' => 'Preuzmi obrazac'
        ];

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

.category-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1.25rem;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    border-radius: 9999px;
    font-size: 0.875rem;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
}

.funding-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.375rem 0.875rem;
    border-radius: 0.5rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.funding-free { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
.funding-budzetopstine { background: #dbeafe; color: #1e40af; border: 1px solid #93c5fd; }
.funding-budzetrs { background: #e0e7ff; color: #4338ca; border: 1px solid #a5b4fc; }
.funding-sufinansiranje { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
.funding-placeno { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

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
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    {{categoryPill}}
                    {{fundingBadge}}
                </div>

                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-green-600 transition-colors">
                    {{naziv}}
                </h3>

                <div class="mb-4 p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-sm text-gray-700 leading-relaxed line-clamp-4">{{opis}}</p>
                </div>

                <div class="space-y-2 mb-5">
                    {{contactInfo}}
                    {{documentDownload}}
                </div>

                <a href="/sadrzaj?id={{itemId}}&tip=generic_element"
                   class="block text-center bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 text-white text-sm font-bold py-3.5 px-4 rounded-xl transition-all duration-300 shadow-md hover:shadow-xl">
                    <span class="flex items-center justify-center gap-2">
                        <i class="fas fa-info-circle"></i>
                        <span>{{serviceDetails}}</span>
                    </span>
                </a>
            </div>
        </div>
        PHP;
HTML;

    protected string $cardRender = <<<'HTML'
 function cardRender(array $item, array $fieldLabels, string $locale, array $texts = [], int $descMaxLength = 250, $cardTemplate = ''): string
{
    $naziv = htmlspecialchars($item['fields']['naziv'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $opis = htmlspecialchars(mb_substr($item['fields']['kratakOpis'][$locale] ?? '', 0, $descMaxLength), ENT_QUOTES, 'UTF-8');
    $kategorija = htmlspecialchars($item['category']['content'] ?? '', ENT_QUOTES, 'UTF-8');
    $finansiranje = htmlspecialchars($item['fields']['tipFinansiranja'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $kontakt = htmlspecialchars($item['fields']['kontakt'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $dokument = htmlspecialchars($item['fields']['dokumentZaPreuzimanje'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');

    // Category pill
    $categoryPill = $kategorija
        ? "<span class='category-pill'>
               <i class='fas fa-hand-holding-heart'></i>
               <span>{$kategorija}</span>
           </span>"
        : '';

    // Funding badge
    $fundingBadge = '';
    if ($finansiranje) {
        $fundingClass = 'funding-free';
        if (strpos($finansiranje, 'opštine') !== false) {
            $fundingClass = 'funding-budzetopstine';
        } elseif (strpos($finansiranje, 'RS') !== false) {
            $fundingClass = 'funding-budzetrs';
        } elseif (strpos($finansiranje, 'Sufinansiranje') !== false) {
            $fundingClass = 'funding-sufinansiranje';
        } elseif (strpos($finansiranje, 'Plaćeno') !== false) {
            $fundingClass = 'funding-placeno';
        }
        $fundingBadge = "<span class='funding-badge {$fundingClass}'>{$finansiranje}</span>";
    }

    // Contact info
    $contactInfo = $kontakt
        ? "<div class='flex items-center gap-2 text-sm text-gray-600'>
               <i class='fas fa-phone text-blue-500'></i>
               <span class='font-medium'>{$texts['contact']}:</span>
               <span>{$kontakt}</span>
           </div>"
        : '';

    // Document download
    $documentDownload = $dokument
        ? "<a href='{$dokument}' target='_blank' download
              class='flex items-center gap-2 text-sm text-blue-600 hover:text-blue-800 font-medium'>
               <i class='fas fa-file-download'></i>
               <span>{$texts['download_form']}</span>
           </a>"
        : '';

    // Replace placeholders
    $replacements = [
        '{{naziv}}' => $naziv,
        '{{opis}}' => $opis,
        '{{categoryPill}}' => $categoryPill,
        '{{fundingBadge}}' => $fundingBadge,
        '{{contactInfo}}' => $contactInfo,
        '{{documentDownload}}' => $documentDownload,
        '{{itemId}}' => $itemId,
        '{{serviceDetails}}' => $texts['service_details'] ?? 'Details'
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
        $html .= "<a href='{$prevUrl}' 
                   class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-green-400 transition-all shadow-sm hover:shadow'>
            <i class='fas fa-chevron-left text-gray-600'></i>
        </a>";
    }
    
    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);
    
    if ($start > 1) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
        $html .= "<a href='{$url}' 
                   class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-green-400 transition-all shadow-sm hover:shadow font-medium'>1</a>";
        if ($start > 2) $html .= "<span class='px-2 text-gray-400'>...</span>";
    }
    
    for ($i = $start; $i <= $end; $i++) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
        $class = $i === $currentPage 
            ? 'px-4 py-2 bg-green-600 text-white rounded-xl font-semibold shadow-md' 
            : 'px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-green-400 transition-all shadow-sm hover:shadow font-medium';
        $html .= "<a href='{$url}' class='{$class}'>{$i}</a>";
    }
    
    if ($end < $totalPages) {
        if ($end < $totalPages - 1) $html .= "<span class='px-2 text-gray-400'>...</span>";
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
        $html .= "<a href='{$url}' 
                   class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-green-400 transition-all shadow-sm hover:shadow font-medium'>{$totalPages}</a>";
    }
    
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
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Usluge</h1>
            <p class="text-gray-600">Prava i usluge koje pruža naša ustanova</p>
        </div>
        
        <?php echo renderTopbar($categories, $search, $categoryId, $texts); ?>
        
        <div class="services-grid">
            <?php
            if ($itemsList['success'] && !empty($itemsList['items'])) {
                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">';
                foreach ($itemsList['items'] as $item) {
                    echo cardRender($item, $fieldLabels, $locale, $texts, $descriptionMaxLength, $cardTemplate);
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
$pageDescription = 'Pregled svih usluga';

$itemsPerPage = __ITEMS_PER_PAGE__;
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

$translator = new LanguageMapperController();
$latinTexts = [
    'search_placeholder' => 'Pretraži usluge...',
    'apply_button' => 'Primeni',
    'all_categories' => 'Sve kategorije',
    'funding' => 'Finansiranje',
    'contact' => 'Kontakt',
    'service_details' => 'Detalji usluge',
    'no_items_found' => 'Nema pronađenih usluga',
    'download_form' => 'Preuzmi obrazac'
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

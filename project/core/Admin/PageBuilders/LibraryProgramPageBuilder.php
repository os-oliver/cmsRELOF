<?php
namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class LibraryProgramPageBuilder extends BasePageBuilder
{
    protected string $slug;
    private LanguageMapperController $translator;

    private int $itemsPerPage = 15;
    private int $descriptionMaxLength = 120;
    private int $imageHeight = 56;
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
            'search_placeholder' => 'Pretraži...',
            'apply_button' => 'Primeni',
            'all_categories' => 'Sve kategorije',
            'date_and_time' => 'Datum i vreme',
            'location' => 'Lokacija',
            'event_details' => 'Detalji događaja',
            'no_items_found' => 'Nema pronađenih stavki',
            'months' => ['jan', 'feb', 'mar', 'apr', 'maj', 'jun', 'jul', 'avg', 'sep', 'okt', 'nov', 'dec']
        ];

        if ($locale === 'sr-Cyrl') {
            $this->texts = $this->translator->latin_to_cyrillic_array($latinTexts);
        } else {
            $this->texts = $latinTexts;
        }
    }

    protected string $css = <<<'CSS'
main{padding-top:50px}
.dropdown:hover .dropdown-menu{display:block}
.dropdown-menu{display:none;position:absolute;background-color:white;min-width:200px;box-shadow:0 8px 16px rgba(0,0,0,0.08);z-index:1;border-radius:8px;overflow:hidden}
.glass-card{background:rgba(255,255,255,0.75);backdrop-filter:blur(18px) saturate(160%);-webkit-backdrop-filter:blur(18px) saturate(160%);border:1px solid rgba(255,255,255,0.35);box-shadow:0 8px 30px rgba(0,0,0,0.08)}
.glass-search{background:rgba(255,255,255,0.82);backdrop-filter:blur(14px) saturate(160%);-webkit-backdrop-filter:blur(14px) saturate(160%);border:1px solid rgba(255,255,255,0.28)}
.category-chip{display:inline-flex;align-items:center;padding:.375rem .875rem;border-radius:9999px;font-size:.75rem;font-weight:600;letter-spacing:.025em;box-shadow:0 2px 8px rgba(0,0,0,0.12)}
.fields-container{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:.75rem;margin-bottom:1rem}
.card-field{position:relative;padding:.75rem;background:rgba(255,255,255,0.62);backdrop-filter:blur(10px);border-radius:.5rem;border:1px solid rgba(255,255,255,0.38);transition:all .28s;min-height:60px;display:flex;flex-direction:column;justify-content:center}
.card-field:hover{background:rgba(255,255,255,0.82);transform:translateY(-2px);box-shadow:0 6px 16px rgba(0,0,0,0.08)}
.card-image-overlay{position:absolute;inset:0;background:linear-gradient(to bottom,transparent 0%,rgba(0,0,0,0.04) 100%)}
@media (max-width:768px){.fields-container{grid-template-columns:1fr;gap:.5rem}.glass-card{margin-bottom:1rem}}
CSS;

    protected string $topBar = <<<'PHP'
function renderTopbar(array $categories, string $searchValue = '', ?int $selectedCategoryId = null, array $texts = []): string
{
    $safeSearchValue = htmlspecialchars($searchValue, ENT_QUOTES, 'UTF-8');
    $html = "<form method='GET' action='' class='glass-search flex flex-col sm:flex-row items-center justify-between p-6 rounded-2xl shadow-md mb-8 gap-4'>";
    $html .= "<div class='flex w-full sm:w-auto flex-1 gap-3'>
        <input type='text' name='search' value='{$safeSearchValue}' placeholder='{$texts['search_placeholder']}' class='w-full rounded-xl px-5 py-3 focus:outline-none focus:ring-2 transition-all shadow-sm bg-white/80 backdrop-blur-sm'>
        <button type='submit' class='px-6 py-3 rounded-xl transition-all shadow-md font-medium bg-primary hover:bg-primary_hover text-white'>
            {$texts['apply_button']}
        </button>
    </div>";
    $html .= "<div class='flex items-center w-full sm:w-auto'>
        <select name='category' class='w-full sm:w-64 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 transition-all shadow-sm bg-white/80 backdrop-blur-sm appearance-none cursor-pointer'>
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
        <div class="book-card bg-white rounded-lg shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden group border border-slate-200">
            <div class="flex flex-col md:flex-row">
                <!-- Knjiga Cover Sekcija - Levo -->
                <div class="relative md:w-48 w-full flex-shrink-0 bg-gradient-to-br from-slate-100 to-slate-50">
                    <div class="aspect-[3/4] md:aspect-auto md:h-full relative overflow-hidden">
                        {{imageSection}}
                        
                        <!-- Kategorija Badge -->
                        <div class="absolute top-3 right-3 z-10">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-xs font-semibold rounded-full shadow-lg">
                                <i class="{{categoryIcon}}"></i>
                                <span>{{kategorija}}</span>
                            </span>
                        </div>
                        
                        <!-- Book Spine Effect -->
                        <div class="absolute left-0 top-0 bottom-0 w-2 bg-gradient-to-b from-slate-300 via-slate-400 to-slate-300 opacity-60"></div>
                        
                        {{authorBadge}}
                    </div>
                </div>
                
                <!-- Sadržaj Knjige - Desno -->
                <div class="flex-1 p-6 flex flex-col">
                    <!-- Naslov i Ikona -->
                    <div class="flex items-start gap-4 mb-4">
                        <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center shadow-md">
                            <i class="{{categoryIcon}} text-white text-2xl"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-2xl font-bold text-gray-900 mb-2 leading-tight group-hover:text-blue-600 transition-colors">
                                {{naslov}}
                            </h3>
                            {{autorRow}}
                        </div>
                    </div>
                    
                    <!-- Datum Dostupnosti -->
                    {{dateRow}}
                    
                    <!-- Opis Knjige -->
                    <div class="mb-6 flex-1">
                        <div class="p-4 bg-slate-50 rounded-lg border-l-4 border-teal-500">
                            <p class="text-sm text-gray-700 leading-relaxed line-clamp-4">{{opis}}</p>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex gap-3 mt-auto">
                        <a href="/sadrzaj?id={{itemId}}&tip=generic_element" class="flex-1 text-center bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white text-sm font-bold py-3 px-5 rounded-lg transition-all duration-300 shadow-md hover:shadow-xl">
                            <span class="flex items-center justify-center gap-2">
                                <i class="fas fa-book-open"></i>
                                <span>{{viewDetails}}</span>
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </a>
                        {{externalLinkButton}}
                    </div>
                </div>
            </div>
        </div>
        PHP;
HTML;

    protected string $cardRender = <<<'HTML'
function cardRender(array $item, array $fieldLabels, string $locale, array $texts = [], int $descMaxLength = 160, string $cardTemplate = ''): string
{
    $naslov = htmlspecialchars($item['fields']['naslov'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $opis = htmlspecialchars(mb_substr($item['fields']['opis'][$locale] ?? '', 0, $descMaxLength), ENT_QUOTES, 'UTF-8');
    $autor = htmlspecialchars($item['fields']['autor'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $rawDatum = $item['fields']['datum'][$locale] ?? '';
    $formattedDatum = '';
    if ($rawDatum) {
        $formats = ['Y-m-d', 'Y-m-d H:i:s', 'd/m/Y', 'd.m.Y'];
        foreach ($formats as $fmt) {
            $dt = \DateTime::createFromFormat($fmt, $rawDatum);
            if ($dt instanceof \DateTime) {
                $formattedDatum = $dt->format('d/m/Y');
                break;
            }
        }
        if ($formattedDatum === '' && strtotime($rawDatum) !== false) {
            $formattedDatum = date('d/m/Y', strtotime($rawDatum));
        }
    }
    $datum = htmlspecialchars($formattedDatum, ENT_QUOTES, 'UTF-8');
    $link = htmlspecialchars($item['fields']['link'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = htmlspecialchars($item['image'] ?? '', ENT_QUOTES, 'UTF-8');
    $kategorija = htmlspecialchars($item['category']['content'] ?? '', ENT_QUOTES, 'UTF-8');
    
    // Ikone za kategorije
    $categoryIcons = [
        'Knjige' => 'fas fa-book',
        'Časopisi' => 'fas fa-newspaper',
        'Filmovi' => 'fas fa-film',
        'Muzika' => 'fas fa-music',
        'Događaji' => 'fas fa-calendar-star'
    ];
    $categoryIcon = $categoryIcons[$kategorija] ?? 'fas fa-book';
    
    // Slika ili placeholder
    $imageSection = $imageUrl 
        ? "<img src='{$imageUrl}' class='w-full h-full object-cover transition-transform duration-700 group-hover:scale-105' alt='Cover image'>" 
        : "<div class='absolute inset-0 flex items-center justify-center bg-gradient-to-br from-blue-50 via-purple-50 to-teal-50'>
              <i class='{$categoryIcon} text-9xl text-blue-600 opacity-10'></i>
           </div>";
    
    // Autor badge ako postoji (na slici)
    $authorBadge = $autor 
        ? "<div class='absolute bottom-3 left-3 right-3'>
              <div class='bg-white/95 backdrop-blur-sm px-4 py-2 rounded-lg flex items-center gap-2 shadow-lg border border-slate-200'>
                  <i class='fas fa-user-circle text-purple-600 text-lg'></i>
                  <span class='text-sm font-semibold text-gray-900 truncate'>{$autor}</span>
              </div>
           </div>" 
        : '';
    
    // Autor red u sadržaju (ako nema badge na slici)
    $autorRow = $autor && !$authorBadge 
        ? "<div class='flex items-center gap-2 text-sm text-gray-600 mt-1'>
              <i class='fas fa-user-circle text-purple-600'></i>
              <span class='font-medium'>{$autor}</span>
           </div>" 
        : '';
    
    // Datum dostupnosti
    $dateRow = $datum 
        ? "<div class='flex items-center gap-3 mb-4 p-3 bg-teal-50 rounded-lg border border-teal-200'>
              <div class='flex-shrink-0 w-10 h-10 bg-teal-500 rounded-lg flex items-center justify-center'>
                  <i class='fas fa-calendar-check text-white'></i>
              </div>
              <div class='flex-1'>
                  <div class='text-xs font-semibold text-gray-600 uppercase tracking-wide mb-0.5'>Dostupno</div>
                  <div class='text-sm font-bold text-teal-700'>{$datum}</div>
              </div>
           </div>" 
        : '';
    
    // Eksterni link dugme
    $externalLinkButton = $link 
        ? "<a href='{$link}' target='_blank' rel='noopener noreferrer' class='flex-shrink-0 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white p-3 rounded-lg transition-all duration-300 shadow-md hover:shadow-xl' title='Eksterni link'>
              <i class='fas fa-external-link-alt'></i>
           </a>" 
        : '';
    
    $replacements = [
        '{{naslov}}' => $naslov,
        '{{opis}}' => $opis ?: $texts['no_description'] ?? 'Nema opisa',
        '{{imageSection}}' => $imageSection,
        '{{authorBadge}}' => $authorBadge,
        '{{autorRow}}' => $autorRow,
        '{{dateRow}}' => $dateRow,
        '{{itemId}}' => $itemId,
        '{{kategorija}}' => $kategorija,
        '{{categoryIcon}}' => $categoryIcon,
        '{{externalLinkButton}}' => $externalLinkButton,
        '{{viewDetails}}' => $texts['view_details'] ?? 'Pogledaj detalje'
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
        $html .= "<a href='{$prevUrl}' class='px-4 py-2 rounded-xl hover:shadow font-medium bg-white/80 backdrop-blur-sm border border-white/30'>
            <i class='fas fa-chevron-left text-secondary-text'></i>
        </a>";
    }
    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);
    if ($start > 1) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
        $html .= "<a href='{$url}' class='px-4 py-2 rounded-xl font-medium bg-white/80 backdrop-blur-sm border border-white/30'>1</a>";
        if ($start > 2) $html .= "<span class='px-2 text-secondary-text'>...</span>";
    }
    for ($i = $start; $i <= $end; $i++) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
        $class = $i === $currentPage
            ? 'px-4 py-2 bg-primary text-white rounded-xl font-semibold shadow-md'
            : 'px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-white/30 hover:shadow font-medium';
        $html .= "<a href='{$url}' class='{$class}'>{$i}</a>";
    }
    if ($end < $totalPages) {
        if ($end < $totalPages - 1) $html .= "<span class='px-2 text-secondary-text'>...</span>";
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
        $html .= "<a href='{$url}' class='px-4 py-2 rounded-xl font-medium bg-white/80 backdrop-blur-sm border border-white/30'>{$totalPages}</a>";
    }
    if ($currentPage < $totalPages) {
        $nextUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
        $html .= "<a href='{$nextUrl}' class='px-4 py-2 rounded-xl hover:shadow font-medium bg-white/80 backdrop-blur-sm border border-white/30'>
            <i class='fas fa-chevron-right text-secondary-text'></i>
        </a>";
    }
    $html .= "</div>";
    return $html;
}
PHP;

    protected string $html = <<<'HTML'
<main class="bg-gradient-to-br from-secondary_background to-background min-h-screen">
    <section class="container mx-auto px-4 py-12">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-primary-text mb-2">Događaji</h1>
            <p class="text-secondary-text">Istražite našu bogatu ponudu kulturnih događaja</p>
        </div>

        <?php echo renderTopbar($categories, $search, $categoryId, $texts); ?>

        <div class="performances-grid">
            <?php
            if (!empty($itemsList['success']) && !empty($itemsList['items'])) {
                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">';
                foreach ($itemsList['items'] as $item) {
                    echo cardRender($item, $fieldLabels, $locale, $texts, $descriptionMaxLength, $cardTemplate);
                }
                echo '</div>';
                $totalPages = max(1, (int) ceil($itemsList['total'] / $itemsPerPage));
                echo renderPagination($currentPage, $totalPages, $paginationRange);
            } else {
                echo "<div class='glass-card rounded-lg p-12 text-center'>
                    <i class='fas fa-inbox text-5xl text-secondary'></i>
                    <p class='text-secondary-text mt-4'>{$texts['no_items_found']}</p>
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
$pageDescription = 'Pregled svih stavki';

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
    : ['success' => false, 'items' => [], 'total' => 0];

$config = $fieldLabels = [];
if ($slug && file_exists($structurePath = __DIR__ . '/../../assets/data/structure.json')) {
    $parsed = json_decode(file_get_contents($structurePath), true);
    $config = $parsed[0][$slug] ?? [];
    $fieldLabels = array_column($config['fields'] ?? [], null, 'name');
}

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

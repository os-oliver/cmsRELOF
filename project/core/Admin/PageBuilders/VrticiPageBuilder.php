<?php

namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class VrticiPageBuilder extends BasePageBuilder
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

    protected string $cardTemplate = <<<'HTML'
    $cardTemplate = <<<'PHP'
        <div class="glass-card bg-surface rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-1">
            <div class="relative w-full h-56 overflow-hidden bg-surface">
                {{imageSection}}
                {{kategoria}}
            </div>

            <div class="p-6">
                <h3 class="text-xl font-heading text-primary_text mb-4 line-clamp-2 group-hover:text-primary_hover transition-colors">
                    {{naslov}}
                </h3>

                <div class="space-y-3 mb-4 text-secondary_text font-body">
                    {{locationRow}}
                </div>

                <div class="mb-5 p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-sm text-gray-700 leading-relaxed font-body">{{opis}}</p>
                </div>

                <a href="/sadrzaj?id={{itemId}}&tip=Vrtici"
                class="block w-full text-center bg-gradient-to-r from-primary to-secondary hover:from-primary_hover hover:to-secondary_hover text-white text-sm font-bold py-3.5 px-4 rounded-xl transition-all duration-300 shadow-md hover:shadow-xl backdrop-blur-sm">
                <span class="flex items-center justify-center gap-2">
                        <i class="fas fa-ticket-alt"></i>
                        <span>{{eventDetails}}</span>
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
    $naslov = htmlspecialchars($item['fields']['title'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $opis = htmlspecialchars(mb_substr($item['fields']['description'][$locale] ?? '', 0, $descMaxLength), ENT_QUOTES, 'UTF-8');
    $lokacija = htmlspecialchars($item['fields']['location'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = htmlspecialchars($item['image'] ?? '', ENT_QUOTES, 'UTF-8');

    // Preformatted sections
    $imageSection = $imageUrl
        ? "<img src='{$imageUrl}' class='w-full h-full object-cover transition-transform duration-300 group-hover:scale-105' alt='Event image'>"
        : "<div class='absolute inset-0 flex items-center justify-center'>
            
                <i class='fas fa-calendar-star text-6xl text-indigo-300'></i>
           </div>";

    $locationRow = $lokacija
        ? "<div class='flex items-start gap-3'>
               <div class='flex-shrink-0 w-10 h-10 bg-background rounded-lg flex items-center justify-center'>
                   <i class='fas fa-map-marker-alt text-primary'></i>
               </div>
               <div class='flex-1 min-w-0'>
                   <div class='text-xs font-semibold text-gray-500 uppercase tracking-wide mb-0.5'>{$texts['location']}</div>
                   <div class='text-sm font-semibold text-gray-900 truncate'>{$lokacija}</div>
               </div>
           </div>"
        : '';

    // Replace placeholders
    $replacements = [
        '{{naslov}}' => $naslov,
        '{{opis}}' => $opis,
        '{{imageSection}}' => $imageSection,
        '{{locationRow}}' => $locationRow,
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
            ? 'px-4 py-2 bg-primarybutton text-white rounded-xl font-semibold shadow-md' 
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
            <h1 class="text-4xl font-bold font-heading text-primary_text mb-2">Vrtići</h1>
            <p class="text-lg font-heading2 text-secondary_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
        </div>
        
        
        
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

        // Configuration variables
        $itemsPerPage = __ITEMS_PER_PAGE__;
        if (isset($_GET['per_page']) && is_numeric($_GET['per_page'])) {
            $itemsPerPage = (int)$_GET['per_page'];
        }
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
            'event_details' => 'Detaljnije',
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

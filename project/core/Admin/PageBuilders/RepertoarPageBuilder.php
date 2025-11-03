<?php
namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class RepertoarPageBuilder extends BasePageBuilder
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
.dropdown:hover .dropdown-menu {
    display: block;
}

.dropdown-menu {
    display: none;
    position: absolute;
    background-color: color-mix(in srgb, var(--color-secondary_background) 95%, transparent);
    min-width: 200px;
    box-shadow: 0 16px 40px color-mix(in srgb, var(--color-secondary) 12%, transparent);
    z-index: 1;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid color-mix(in srgb, var(--color-secondary) 18%, transparent);
}

/* Card styling tuned to theme */
.glass-card {
    background: color-mix(in srgb, var(--color-background) 92%, transparent);
    backdrop-filter: blur(18px);
    border: 1px solid color-mix(in srgb, var(--color-secondary) 14%, transparent);
    box-shadow: 0 24px 48px -22px color-mix(in srgb, var(--color-secondary) 35%, transparent);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.glass-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 34px 60px -20px color-mix(in srgb, var(--color-primary) 35%, transparent);
}

.glass-search {
    background: color-mix(in srgb, var(--color-secondary_background) 90%, transparent);
    backdrop-filter: blur(14px);
    border: 1px solid color-mix(in srgb, var(--color-secondary) 18%, transparent);
}

.category-chip {
    display: inline-flex;
    align-items: center;
    padding: 0.375rem 0.875rem;
    background: color-mix(in srgb, var(--color-secondary) 92%, transparent);
    color: var(--color-primarybtntxt);
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.025em;
    box-shadow: 0 8px 16px color-mix(in srgb, var(--color-secondary) 22%, transparent);
}

.fields-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.card-field {
    position: relative;
    padding: 0.75rem;
    background: color-mix(in srgb, var(--color-background) 85%, transparent);
    border-radius: 0.75rem;
    border: 1px solid color-mix(in srgb, var(--color-primary) 12%, transparent);
    transition: all 0.3s ease;
    min-height: 60px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.card-field:hover {
    background: color-mix(in srgb, var(--color-primarybtntxt) 95%, transparent);
    border-color: color-mix(in srgb, var(--color-primary) 28%, transparent);
    transform: translateY(-2px);
    box-shadow: 0 18px 30px color-mix(in srgb, var(--color-primary) 12%, transparent);
}

.card-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, color-mix(in srgb, var(--color-primary_text) 0%, transparent) 0%, color-mix(in srgb, var(--color-primary_text) 55%, transparent) 100%);
}

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
    
    $html = "<form method='GET' action='' class='glass-search flex flex-col sm:flex-row items-center justify-between p-6 rounded-3xl shadow-xl mb-10 gap-4 border border-secondary/20'>";
    
    $html .= "<div class='flex w-full sm:w-auto flex-1 gap-3'>
        <input type='text' name='search' value='{$safeSearchValue}' 
               placeholder='{$texts['search_placeholder']}' 
               class='w-full border border-secondary/30 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all shadow-sm bg-background text-primary_text placeholder-secondary_text font-body'>
        <button type='submit' 
                class='bg-primary hover:bg-primary_hover text-primarybtntxt px-6 py-3 rounded-xl transition-all shadow-lg hover:shadow-xl font-semibold font-body'>
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
        <div class="glass-card rounded-3xl border border-secondary/20 transition-all duration-300 overflow-hidden group">
            <div class="relative w-full h-56 overflow-hidden bg-secondary_background">
                {{imageSection}}
                {{kategoria}}
            </div>

            <div class="p-6 bg-background font-body text-secondary_text">
                <h3 class="text-xl font-bold text-primary_text font-heading mb-4 line-clamp-2 group-hover:text-primary transition-colors">
                    {{nazivPredstave}}
                </h3>

                <div class="space-y-3 mb-4">
                    {{dateTimeRow}}
                    {{durationRow}}
                    {{genreRow}}
                </div>

                <a href="sadrzaj?id={{itemId}}&tip=generic_element"
                class="block w-full text-center bg-primary hover:bg-primary_hover text-primarybtntxt text-sm font-semibold py-3.5 px-4 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl font-body">
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
    $nazivPredstave = htmlspecialchars($item['fields']['nazivPredstave'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $datumVreme = htmlspecialchars($item['fields']['datumVreme'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $trajanjeMin = htmlspecialchars($item['fields']['trajanjeMin'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $zanr = htmlspecialchars($item['fields']['zanr'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = htmlspecialchars($item['image'] ?? '', ENT_QUOTES, 'UTF-8');
    $kategorija = htmlspecialchars($item['category']['content'] ?? '', ENT_QUOTES, 'UTF-8');

    // Preformatted sections
    $imageSection = $imageUrl
        ? "<img src='{$imageUrl}' class='w-full h-full object-cover transition-transform duration-300 group-hover:scale-105' alt='Play image'>"
        : "<div class='absolute inset-0 flex items-center justify-center bg-secondary_background'>
                <i class='fas fa-theater-masks text-6xl text-secondary'></i>
           </div>";

    $dateTimeRow = $datumVreme
        ? "<div class='flex items-start gap-3'>
               <div class='flex-shrink-0 w-11 h-11 bg-surface rounded-xl flex items-center justify-center text-primary'>
                   <i class='fas fa-calendar-alt'></i>
               </div>
               <div class='flex-1'>
                   <div class='text-xs font-semibold text-secondary_text uppercase tracking-[0.15em] mb-0.5'>{$texts['date_and_time']}</div>
                   <div class='text-sm font-semibold text-primary_text'>{$datumVreme}</div>
               </div>
           </div>"
        : '';

    $durationRow = $trajanjeMin
        ? "<div class='flex items-start gap-3'>
               <div class='flex-shrink-0 w-11 h-11 bg-secondary_background rounded-xl flex items-center justify-center text-secondary'>
                   <i class='fas fa-clock'></i>
               </div>
               <div class='flex-1'>
                   <div class='text-xs font-semibold text-secondary_text uppercase tracking-[0.15em] mb-0.5'>{$texts['duration']}</div>
                   <div class='text-sm font-semibold text-primary_text'>{$trajanjeMin} {$texts['minutes']}</div>
               </div>
           </div>"
        : '';

    $genreRow = $kategorija
    ? "<div class='flex items-start gap-3'>
            <div class='flex-shrink-0 w-11 h-11 bg-surface rounded-xl flex items-center justify-center text-primary'>
                <i class='fas fa-theater-masks'></i>
            </div>
            <div class='flex-1 min-w-0'>
                <div class='text-xs font-semibold text-secondary_text uppercase tracking-[0.15em] mb-0.5'>{$texts['genre']}</div>
                <div class='text-sm font-semibold text-primary_text truncate'>{$kategorija}</div>
            </div>
        </div>"
    : '';    

    // Replace placeholders
    $replacements = [
        '{{nazivPredstave}}' => $nazivPredstave,
        '{{imageSection}}' => $imageSection,
        '{{dateTimeRow}}' => $dateTimeRow,
        '{{durationRow}}' => $durationRow,
        '{{genreRow}}' => $genreRow,
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
            ? 'px-4 py-2 bg-primary text-primarybtntxt rounded-xl font-semibold shadow-md'
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
<script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        background: '#F7F2EA',
                        secondary_background: '#FAF0CA',
                        primary: '#8B1E3F',
                        primary_hover: '#701932',
                        secondary: '#2D3047',
                        secondary_hover: '#24273B',
                        primary_text: '#1F1A1A',
                        secondary_text: '#5D4E4E',
                        logocolor1: '#8B1E3F',
                        logocolor2: '#2D3047',
                        primarybtntxt: '#FFF7E6',
                        surface: '#8B1E3F1A',
                        footerbg: '#EFE3D6',
                    },
                    fontFamily: {
                        heading: ['"Bodoni Moda"', 'serif'],
                        body: ['Inter', 'sans-serif']
                    }
                }
            }
        };

        (function applyThemeVariables() {
            const colors = tailwind?.config?.theme?.extend?.colors ?? {};
            const root = document.documentElement.style;

            Object.entries(colors).forEach(([key, value]) => {
                if (typeof value === 'string') {
                    root.setProperty(`--color-${key}`, value);
                }
            });
        })();
    </script>
<main class="bg-background min-h-screen font-body">
    <section class="container mx-auto px-4 py-12">
        <div class="mb-10 text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-bold text-primary_text font-heading mb-2">Repertoar</h1>
            <p class="text-secondary_text max-w-2xl">Pregled naših predstava i izvođenja</p>
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
                echo "<div class='glass-card rounded-3xl p-12 text-center border border-secondary/20'>
                    <i class='fas fa-inbox text-5xl text-secondary mb-4'></i>
                    <p class='text-secondary_text'>{$texts['no_items_found']}</p>
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
        $content .= $this->html;
        $content .= $this->getFooter();

        return $content;
    }

    public function render(): void
    {
        echo $this->buildPage();
    }
}

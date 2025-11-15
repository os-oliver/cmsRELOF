<?php
namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class ProgramsPageBuiilder extends BasePageBuilder
{
    protected string $slug;
    private LanguageMapperController $translator;

    private int $itemsPerPage = 3;
    private int $descriptionMaxLength = 120;
    private int $imageHeight = 56;
    private int $paginationRange = 2;
    private array $texts = [];

    public function __construct(string $slug)
    {
        $this->slug = $slug;
        $this->name = $slug;
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
function renderTopbar(array $categories, string $searchValue = '', int|string|null $selectedCategoryId = null, array $texts = []): string
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

        $isSelected = false;

        if ($selectedCategoryId !== null) {
            if (is_numeric($selectedCategoryId) && (int)$selectedCategoryId === (int)$cat['id']) {
                $isSelected = true;
            } elseif (is_string($selectedCategoryId) && strtolower($selectedCategoryId) === strtolower($cat['name'])) {
                $isSelected = true;
            }
        }

        $selected = $isSelected ? 'selected' : '';
        $html .= "<option value='{$id}' {$selected}>{$name}</option>";
    }

    $html .= "</select></div></form>";
    return $html;
}

PHP;

    protected string $cardTemplate = <<<'HTML'
    $cardTemplate = <<<'PHP'
        <div class="group relative overflow-hidden rounded-2xl transition-all duration-500 hover:shadow-2xl">
            <!-- Pozadinska slika sa overlay-om -->
            <div class="relative w-full h-64 overflow-hidden bg-gradient-to-br from-[var(--primary)]/5 via-[var(--secondary)]/5 to-[var(--secondary-background)]">
                {{imageSection}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            </div>
            
            <!-- Kategorija badge - pozicioniran preko slike -->
            <div class="absolute top-4 right-4 z-10">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold text-white bg-gradient-to-r from-[var(--primary)] to-[var(--secondary)] shadow-lg">
                    <i class="fas fa-tag mr-2 text-white/80"></i>
                    {{kategorija}}
                </span>
            </div>

            <!-- Kartica sadržaja -->
            <div class="relative bg-[var(--surface)] backdrop-filter backdrop-blur-md border border-[var(--primary)]/20 p-6 shadow-xl">
                <!-- Datum gornje desno -->
                <div class="absolute top-4 right-4 text-center">
                    <div class="inline-flex flex-col items-center bg-gradient-to-br from-[var(--primary)]/10 to-[var(--secondary)]/10 rounded-lg px-3 py-2 border border-[var(--primary)]/20">
                        <span class="text-xs font-bold text-[var(--primary)] uppercase tracking-wider">{{datumMesec}}</span>
                        <span class="text-2xl font-black text-[var(--primary)]">{{datumDan}}</span>
                    </div>
                </div>

                <!-- Naslov -->
                <h3 class="text-lg font-heading text-[var(--primary-text)] mb-3 pr-24 line-clamp-2 group-hover:text-[var(--primary)] transition-colors duration-300">
                    {{naslov}}
                </h3>

                <!-- Separator linija -->
                <div class="w-12 h-1 bg-gradient-to-r from-[var(--primary)] to-[var(--secondary)] rounded-full mb-4"></div>

                <!-- Opis -->
                <div class="mb-4">
                    <p class="text-sm font-body text-[var(--secondary-text)] leading-relaxed line-clamp-3">{{opis}}</p>
                </div>

                <!-- Footer sa ikonama -->
                <div class="flex items-center justify-between pt-4 border-t border-[var(--primary)]/20">
                    <div class="flex items-center gap-2 text-xs text-[var(--secondary-text)]">
                        <i class="fas fa-calendar-check text-[var(--primary)]"></i>
                        <span class="font-body">{{datumPuniFormat}}</span>
                    </div>
                    <a href="/sadrzaj?id={{itemId}}&tip=generic_element" class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-[var(--primary)] to-[var(--secondary)] hover:from-[var(--primary-hover)] hover:to-[var(--secondary-hover)] text-white text-xs font-bold transition-all duration-300 gap-2 group-hover:translate-x-1">
                        <span>{{saznaVise}}</span>
                        <i class="fas fa-arrow-right transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </div>
        </div>
    PHP;
HTML;

    protected string $cardRender = <<<'HTML'
function cardRender(array $item, array $fieldLabels, string $locale, array $texts = [], int $descMaxLength = 120, string $cardTemplate = ''): string
{
    // Sigurna ekstrakcija vrednosti
    $getNaslov = function() use ($item, $locale) {
        $naslov = $item['fields']['naslov'][$locale] ?? $item['fields']['naslov'] ?? $item['fields']['title'][$locale] ?? $item['fields']['title'] ?? '';
        return is_string($naslov) ? $naslov : (is_array($naslov) ? ($naslov[$locale] ?? reset($naslov) ?? '') : '');
    };
    
    $getOpis = function() use ($item, $locale) {
        $opis = $item['fields']['opis'][$locale] ?? $item['fields']['opis'] ?? $item['fields']['description'][$locale] ?? $item['fields']['description'] ?? '';
        return is_string($opis) ? $opis : (is_array($opis) ? ($opis[$locale] ?? reset($opis) ?? '') : '');
    };
    
    $getKategorija = function() use ($item, $locale) {
        $kat = $item['category']['content'] ?? $item['fields']['kategorija'][$locale] ?? $item['fields']['kategorija'] ?? '';
        return is_string($kat) ? $kat : (is_array($kat) ? ($kat[$locale] ?? reset($kat) ?? '') : '');
    };
    
    $naslov = htmlspecialchars($getNaslov(), ENT_QUOTES, 'UTF-8');
    $opis = htmlspecialchars(mb_substr($getOpis(), 0, $descMaxLength), ENT_QUOTES, 'UTF-8');
    $datum = htmlspecialchars($item['fields']['datum'] ?? '', ENT_QUOTES, 'UTF-8');
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = htmlspecialchars($item['image'] ?? '', ENT_QUOTES, 'UTF-8');
    $kategorija = htmlspecialchars($getKategorija(), ENT_QUOTES, 'UTF-8');

    // Parsiranje datuma (Y-m-d format)
    $datumPuniFormat = $datum;
    $datumDan = '';
    $datumMesec = '';
    
    if (!empty($datum)) {
        $dateObj = \DateTime::createFromFormat('Y-m-d', $datum);
        if ($dateObj) {
            $datumDan = $dateObj->format('d');
            // Meseci na srpskom
            $meseci = [
                'sr-Cyrl' => ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Avg', 'Sep', 'Okt', 'Nov', 'Dec'],
                'sr' => ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Avg', 'Sep', 'Okt', 'Nov', 'Dec'],
                'en' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            ];
            $mesecIndex = (int)$dateObj->format('n') - 1;
            $mesiMasiv = $meseci[$locale] ?? $meseci['sr'];
            $datumMesec = $mesiMasiv[$mesecIndex] ?? 'Jan';
            $datumPuniFormat = $dateObj->format('d.m.Y');
        }
    }

    // Stock slika ako nema
    $imageSection = $imageUrl
        ? "<img src='{$imageUrl}' class='w-full h-full object-cover transition-transform duration-500 group-hover:scale-110' alt='Program image'>"
        : "<div class='absolute inset-0 flex items-center justify-center bg-gradient-to-br from-primary/10 via-secondary/5 to-secondary-background'>
               <div class='text-center'>
                   <i class='fas fa-compact-disc text-6xl text-primary/30 mb-3 block'></i>
                   <p class='text-sm text-secondary-text font-body'>Kulturni program</p>
               </div>
           </div>";

    $textiZaPrevodnjenje = [
        'sr-Cyrl' => 'Сазнај више',
        'sr' => 'Saznaj više',
        'en' => 'Learn more'
    ];
    $saznaVise = $textiZaPrevodnjenje[$locale] ?? 'Learn more';

    $replacements = [
        '{{naslov}}' => $naslov,
        '{{opis}}' => $opis,
        '{{imageSection}}' => $imageSection,
        '{{itemId}}' => $itemId,
        '{{kategorija}}' => $kategorija,
        '{{datumDan}}' => $datumDan,
        '{{datumMesec}}' => $datumMesec,
        '{{datumPuniFormat}}' => $datumPuniFormat,
        '{{saznaVise}}' => $saznaVise
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
        $content .= $this->html;
        $content .= $this->getFooter();

        return $content;
    }

    public function render(): void
    {
        echo $this->buildPage();
    }
}

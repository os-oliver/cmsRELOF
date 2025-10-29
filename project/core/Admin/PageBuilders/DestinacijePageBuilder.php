<?php
namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class DestinacijePageBuilder extends BasePageBuilder
{
    protected string $slug;
    private LanguageMapperController $translator;

    // Configurable variables
    private int $itemsPerPage = 9;
    private int $descriptionMaxLength = 140;
    private int $imageHeight = 56; // h-56 ≈ 14rem
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

        // Define static texts in Serbian Latin (will convert to Cyrillic if needed)
        $latinTexts = [
            'page_title'           => 'Destinacije',
            'page_subtitle'        => 'Istražite inspirativna mesta za vaše sledeće putovanje',
            'search_placeholder'   => 'Pretraži destinacije...',
            'apply_button'         => 'Primeni',
            'all_categories'       => 'Sve kategorije',
            'filters'              => 'Filteri',
            'country'              => 'Država',
            'region'               => 'Region',
            'updated'              => 'Ažurirano',
            'rating'               => 'Ocena',
            'activities'           => 'Aktivnosti',
            'season'               => 'Sezona',
            'best_months'          => 'Najbolji meseci',
            'recommended_stay'     => 'Preporučeno trajanje',
            'avg_cost'             => 'Prosečna cena/dan',
            'amenities'            => 'Pogodnosti',
            'map'                  => 'Mapa',
            'contact'              => 'Kontakt',
            'official_website'     => 'Zvanični sajt',
            'destination_details'  => 'Detalji destinacije',
            'no_items_found'       => 'Nema pronađenih destinacija',
            'sort_by'              => 'Sortiraj',
            'sort_best_rated'      => 'Najbolje ocenjene',
            'sort_low_price'       => 'Najniža cena',
            'sort_high_price'      => 'Najviša cena',
            'sort_last_updated'    => 'Najskorije ažurirano',
        ];

        $this->texts = ($locale === 'sr-Cyrl')
            ? $this->translator->latin_to_cyrillic_array($latinTexts)
            : $latinTexts;
    }

    protected string $css = <<<CSS
    /* ====== Base spacing ====== */
    main{ padding-top: 50px; }
    .dropdown:hover .dropdown-menu { display: block; }
    .dropdown-menu {
        display: none; position: absolute; background: #fff; min-width: 200px;
        box-shadow: 0 8px 16px rgba(0,0,0,.1); z-index: 50; border-radius: 8px; overflow: hidden;
    }
    .dropdown-item { padding: 12px 16px; display: block; color: #111827; transition: all .2s; border-left: 3px solid transparent; }
    .dropdown-item:hover { background: #f3f4f6; border-left: 3px solid #10b981; }

    /* ====== Palette & typography (emerald/teal) ====== */
    body { font-family: "Inter", sans-serif; }
    .hero-title { font-family: "Playfair Display", serif; }
    .brand-gradient { background-image: linear-gradient(135deg, #10b981 0%, #0ea5e9 100%); }
    .text-gradient { background: linear-gradient(135deg,#10b981,#0ea5e9); -webkit-background-clip:text; background-clip:text; color: transparent; }

    /* ====== Interactive bits ====== */
    .nav-link::after { content:''; display:block; width:0; height:3px; background:linear-gradient(to right,#10b981,#0ea5e9); transition:width .3s; }
    .nav-link:hover::after { width:100%; }
    #mobileMenuPanel { transform: translateX(100%); transition: transform .35s cubic-bezier(.77,0,.175,1); }
    .hamburger span { transition: all .3s ease; }
    .hamburger.active span:nth-child(1){ transform: rotate(45deg) translate(6px,6px); }
    .hamburger.active span:nth-child(2){ opacity:0; }
    .hamburger.active span:nth-child(3){ transform: rotate(-45deg) translate(5px,-5px); }

    /* Search popover animation */
    #searchInputContainer { transition: opacity .2s ease, transform .2s ease; transform: translateY(-4px); }
    #searchInputContainer.show { opacity:1 !important; transform: translateY(0); }

    /* ====== Glassmorphism cards ====== */
    .glass-card {
        background: rgba(255, 255, 255, 0.82);
        backdrop-filter: blur(18px) saturate(180%);
        -webkit-backdrop-filter: blur(18px) saturate(180%);
        border: 1px solid rgba(16, 185, 129, 0.20);
        box-shadow: 0 8px 28px rgba(16, 24, 40, 0.08);
    }
    .glass-search {
        background: rgba(255,255,255,0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(14,165,233,0.25);
    }

    .chip {
        display:inline-flex; align-items:center; gap:.4rem;
        padding:.3rem .7rem; border-radius:9999px; font-size:.75rem; font-weight:600;
        background: rgba(16,185,129,.1); color:#065f46; border:1px solid rgba(16,185,129,.25);
    }
    .chip-blue {
        background: rgba(14,165,233,.1); color:#0c4a6e; border-color: rgba(14,165,233,.25);
    }

    /* Mini facts grid inside card */
    .facts-grid {
        display:grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap:.5rem;
    }

    /* Responsive tweaks */
    @media (max-width: 768px) {
        .facts-grid { grid-template-columns: 1fr; }
    }
CSS;

    protected string $topBar = <<<'PHP'
function renderTopbarDestinations(array $categories, string $searchValue = '', ?int $selectedCategoryId = null, array $texts = [], string $sort = ''): string
{
    $safeSearchValue = htmlspecialchars($searchValue, ENT_QUOTES, 'UTF-8');
    $sortOptions = [
        '' => $texts['sort_by'],
        'best' => $texts['sort_best_rated'],
        'low'  => $texts['sort_low_price'],
        'high' => $texts['sort_high_price'],
        'date' => $texts['sort_last_updated'],
    ];

    $html = "<form method='GET' action='' class='glass-search flex flex-col lg:flex-row items-center justify-between p-6 rounded-2xl shadow-lg mb-8 gap-4'>";

    $html .= "<div class='flex w-full lg:w-auto flex-1 gap-3'>
        <input type='text' name='search' value='{$safeSearchValue}'
               placeholder='{$texts['search_placeholder']}'
               class='w-full border border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all shadow-sm bg-white/80'>
        <button type='submit'
                class='bg-gradient-to-r from-emerald-600 to-sky-600 hover:from-emerald-700 hover:to-sky-700 text-white px-6 py-3 rounded-xl transition-all shadow-md font-medium'>
            {$texts['apply_button']}
        </button>
    </div>";

    $html .= "<div class='flex items-center w-full lg:w-auto gap-3'>
        <select name='category'
                class='w-full lg:w-64 border border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all shadow-sm bg-white/80 appearance-none cursor-pointer'>
            <option value=''>{$texts['all_categories']}</option>";

    foreach ($categories as $cat) {
        $id = htmlspecialchars($cat['id'], ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars($cat['name'], ENT_QUOTES, 'UTF-8');
        $selected = ($selectedCategoryId == $cat['id']) ? 'selected' : '';
        $html .= "<option value='{$id}' {$selected}>{$name}</option>";
    }

    $html .= "</select>";

    // Sort dropdown
    $html .= "<select name='sort'
                class='w-full lg:w-56 border border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent transition-all shadow-sm bg-white/80 appearance-none cursor-pointer'>";
    foreach ($sortOptions as $value => $label) {
        $sel = ($sort === $value) ? 'selected' : '';
        $labelEsc = htmlspecialchars($label, ENT_QUOTES, 'UTF-8');
        $html .= "<option value='{$value}' {$sel}>{$labelEsc}</option>";
    }
    $html .= "</select>";

    $html .= "</div></form>";

    return $html;
}
PHP;

    protected string $cardTemplate = <<<'HTML'
    $cardTemplate = <<<'PHP'
        <div class="glass-card rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
            <div class="relative w-full h-56 bg-gradient-to-br from-emerald-50 to-sky-50">
                {{imageSection}}
                <div class="absolute top-3 left-3 flex gap-2">
                    {{categoryChip}}
                    {{countryChip}}
                </div>
                <div class="absolute bottom-3 left-3">
                    {{ratingBadge}}
                </div>
            </div>

            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-emerald-700 transition-colors">
                    {{naziv}}
                </h3>

                <div class="text-sm text-gray-500 mb-3 flex items-center gap-2">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{locationLine}}</span>
                </div>

                <p class="text-sm text-gray-700 leading-relaxed mb-5">{{kratakOpis}}</p>

                <div class="facts-grid mb-4">
                    {{stayCostRow}}
                    {{updatedRow}}
                </div>

                <div class="mb-5 flex flex-wrap gap-2">
                    {{activitiesChips}}
                    {{seasonChips}}
                </div>

                <div class="flex flex-wrap gap-3">
                    {{mapButton}}
                    {{siteButton}}
                    <a href="sadrzaj?id={{itemId}}&tip=generic_element"
                       class="ml-auto inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-sky-600 hover:from-emerald-700 hover:to-sky-700 text-white text-sm font-bold py-3 px-4 rounded-xl transition-all shadow-md">
                        <i class="fas fa-compass"></i>
                        <span>{{destinationDetails}}</span>
                    </a>
                </div>
            </div>
        </div>
        PHP;
HTML;

    protected string $cardRender = <<<'HTML'
function arrayify($val): array {
    if (is_array($val)) return array_values(array_filter($val, fn($v)=> (string)$v !== ''));
    if (is_string($val)) {
        if (strpos($val, ',') !== false) {
            $parts = array_map('trim', explode(',', $val));
            return array_values(array_filter($parts, fn($v)=> $v !== ''));
        }
        return $val !== '' ? [$val] : [];
    }
    return [];
}

function parsePriceNumeric(string $price = ''): ?float {
    // Accept formats like "EUR 70", "70 €", "RSD 3500", "70"
    $norm = preg_replace('/[^0-9,.\s]/', '', $price);
    $norm = str_replace(['.', ','], ['.', '.'], $norm); // be forgiving
    $matches = [];
    if (preg_match('/([0-9]+(?:\.[0-9]+)?)/', $norm, $matches)) {
        return (float)$matches[1];
    }
    return null;
}

function renderStars($rating): string {
    $r = (float)$rating;
    if ($r <= 0) return '';
    $full = floor($r);
    $half = ($r - $full) >= 0.5 ? 1 : 0;
    $empty = 5 - $full - $half;
    $html = "<div class='inline-flex items-center gap-1 px-3 py-1 rounded-full bg-white/90 border border-emerald-200 text-emerald-700 text-sm font-semibold shadow-sm'>";
    for ($i=0; $i<$full; $i++) { $html .= "<i class='fas fa-star'></i>"; }
    if ($half) { $html .= "<i class='fas fa-star-half-alt'></i>"; }
    for ($i=0; $i<$empty; $i++) { $html .= "<i class='far fa-star'></i>"; }
    $html .= "</div>";
    return $html;
}

function cardRenderDestination(array $item, string $locale, array $texts = [], int $descMaxLength = 140, $cardTemplate=''): string
{
    // Basics
    $naziv    = htmlspecialchars($item['fields']['naziv'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $kratak   = htmlspecialchars(mb_substr($item['fields']['kratak_opis'][$locale] ?? '', 0, $descMaxLength), ENT_QUOTES, 'UTF-8');
    $drzava   = htmlspecialchars($item['fields']['drzava'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $region   = htmlspecialchars($item['fields']['region'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $locLine  = trim($region ? "{$region}, {$drzava}" : $drzava);

    $itemId   = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = htmlspecialchars($item['image'] ?? ($item['fields']['slika'] ?? ''), ENT_QUOTES, 'UTF-8');
    $kategorija = htmlspecialchars($item['category']['content'] ?? ($item['fields']['kategorija'][$locale] ?? ''), ENT_QUOTES, 'UTF-8');

    $ocena    = htmlspecialchars($item['fields']['ocena'][$locale] ?? ($item['fields']['ocena'] ?? ''), ENT_QUOTES, 'UTF-8');
    $updated  = htmlspecialchars($item['fields']['poslednje_azuriranje'][$locale] ?? ($item['fields']['poslednje_azuriranje'] ?? ''), ENT_QUOTES, 'UTF-8');

    $trajanje = htmlspecialchars($item['fields']['preporuceno_trajanje'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $cena     = htmlspecialchars($item['fields']['prosecna_cena_dnevno'][$locale] ?? ($item['fields']['prosecna_cena_dnevno'] ?? ''), ENT_QUOTES, 'UTF-8');
    $site     = htmlspecialchars($item['fields']['zvanicni_sajt'][$locale] ?? ($item['fields']['zvanicni_sajt'] ?? ''), ENT_QUOTES, 'UTF-8');
    $mapLink  = htmlspecialchars($item['fields']['map_link'][$locale] ?? ($item['fields']['map_link'] ?? ''), ENT_QUOTES, 'UTF-8');

    // Arrays (chips)
    $activities = arrayify($item['fields']['aktivnosti'][$locale] ?? ($item['fields']['aktivnosti'] ?? []));
    $seasonList = arrayify($item['fields']['sezona'][$locale] ?? ($item['fields']['sezona'] ?? []));
    $months     = arrayify($item['fields']['najbolji_meseci'][$locale] ?? ($item['fields']['najbolji_meseci'] ?? []));

    // Prebuilt sections
    $imageSection = $imageUrl
        ? "<img src='{$imageUrl}' class='w-full h-full object-cover transition-transform duration-300 group-hover:scale-105' alt='Destination image'>"
        : "<div class='absolute inset-0 flex items-center justify-center'>
               <i class='fas fa-map-marked-alt text-6xl text-emerald-300'></i>
           </div>";

    $categoryChip = $kategorija ? "<span class='chip'><i class='fas fa-tags'></i>{$kategorija}</span>" : "";
    $countryChip  = $drzava ? "<span class='chip chip-blue'><i class='fas fa-globe-europe'></i>{$drzava}</span>" : "";

    $ratingBadge  = $ocena !== '' ? renderStars($ocena) : "";

    $stayCostRow = ($trajanje || $cena) ? "
        <div class='flex items-center gap-3 p-3 rounded-xl bg-gray-50 border border-gray-100'>
            <i class='fas fa-suitcase-rolling text-emerald-600'></i>
            <div class='text-sm'>
                ".($trajanje ? "<div class='font-semibold text-gray-900'>{$texts['recommended_stay']}: {$trajanje}</div>" : "")."
                ".($cena     ? "<div class='text-gray-600'>{$texts['avg_cost']}: {$cena}</div>" : "")."
            </div>
        </div>" : "";

    $updatedRow = $updated ? "
        <div class='flex items-center gap-3 p-3 rounded-xl bg-gray-50 border border-gray-100'>
            <i class='fas fa-calendar-check text-sky-600'></i>
            <div class='text-sm'>
                <div class='font-semibold text-gray-900'>{$texts['updated']}</div>
                <div class='text-gray-600'>{$updated}</div>
            </div>
        </div>" : "";

    $activitiesChips = "";
    foreach ($activities as $a) {
        $aEsc = htmlspecialchars($a, ENT_QUOTES, 'UTF-8');
        $activitiesChips .= "<span class='chip'><i class=\"fas fa-hiking\"></i>{$aEsc}</span>";
    }

    $seasonChips = "";
    foreach ($seasonList as $s) {
        $sEsc = htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
        $seasonChips .= "<span class='chip chip-blue'><i class=\"fas fa-sun\"></i>{$sEsc}</span>";
    }
    // Add months (truncate to 4 + "+N")
    if (!empty($months)) {
        $maxShow = 4;
        $show = array_slice($months, 0, $maxShow);
        $more = max(0, count($months) - $maxShow);
        foreach ($show as $m) {
            $mEsc = htmlspecialchars($m, ENT_QUOTES, 'UTF-8');
            $seasonChips .= "<span class='chip'><i class=\"far fa-calendar-alt\"></i>{$mEsc}</span>";
        }
        if ($more > 0) {
            $seasonChips .= "<span class='chip'>+{$more}</span>";
        }
    }

    $mapButton = $mapLink
        ? "<a href='{$mapLink}' target='_blank' rel='noopener'
             class='inline-flex items-center gap-2 px-4 py-3 rounded-xl border border-emerald-200 text-emerald-700 hover:bg-emerald-50 transition-all shadow-sm'>
                <i class='fas fa-map'></i><span>{$texts['map']}</span>
           </a>"
        : "";

    $siteButton = $site
        ? "<a href='{$site}' target='_blank' rel='noopener'
             class='inline-flex items-center gap-2 px-4 py-3 rounded-xl border border-sky-200 text-sky-700 hover:bg-sky-50 transition-all shadow-sm'>
                <i class='fas fa-external-link-alt'></i><span>{$texts['official_website']}</span>
           </a>"
        : "";

    $replacements = [
        '{{imageSection}}'        => $imageSection,
        '{{categoryChip}}'        => $categoryChip,
        '{{countryChip}}'         => $countryChip,
        '{{ratingBadge}}'         => $ratingBadge,
        '{{naziv}}'               => $naziv,
        '{{locationLine}}'        => htmlspecialchars($locLine, ENT_QUOTES, 'UTF-8'),
        '{{kratakOpis}}'          => $kratak,
        '{{stayCostRow}}'         => $stayCostRow,
        '{{updatedRow}}'          => $updatedRow,
        '{{activitiesChips}}'     => $activitiesChips,
        '{{seasonChips}}'         => $seasonChips,
        '{{mapButton}}'           => $mapButton,
        '{{siteButton}}'          => $siteButton,
        '{{itemId}}'              => $itemId,
        '{{destinationDetails}}'  => $texts['destination_details'] ?? 'Detalji',
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
                   class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm'>
            <i class='fas fa-chevron-left text-gray-600'></i>
        </a>";
    }

    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);

    if ($start > 1) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
        $html .= "<a href='{$url}'
                   class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm font-medium'>1</a>";
        if ($start > 2) $html .= "<span class='px-2 text-gray-400'>...</span>";
    }

    for ($i = $start; $i <= $end; $i++) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
        $class = $i === $currentPage
            ? 'px-4 py-2 bg-emerald-600 text-white rounded-xl font-semibold shadow-md'
            : 'px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm font-medium';
        $html .= "<a href='{$url}' class='{$class}'>{$i}</a>";
    }

    if ($end < $totalPages) {
        if ($end < $totalPages - 1) $html .= "<span class='px-2 text-gray-400'>...</span>";
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
        $html .= "<a href='{$url}'
                   class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm font-medium'>{$totalPages}</a>";
    }

    if ($currentPage < $totalPages) {
        $nextUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
        $html .= "<a href='{$nextUrl}'
                   class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm'>
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
        <!-- Hero -->
        <div class="mb-8">
            <h1 class="hero-title text-4xl md:text-5xl font-bold text-gray-900 mb-2">
                <span class="text-gradient">Destinacije</span>
            </h1>
            <p class="text-gray-600">Istražite inspirativna mesta za vaše sledeće putovanje</p>
        </div>

        <!-- Filters -->
        <?php echo renderTopbarDestinations($categories, $search, $categoryId, $texts, $sort); ?>

        <div class="destinations-grid">
            <?php
            if ($itemsList['success'] && !empty($itemsList['items'])) {

                // Optional client-side sorting (rating, price, last updated)
                if (!empty($sort)) {
                    usort($itemsList['items'], function($a, $b) use ($sort) {
                        $get = function($item, $key) {
                            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
                            $v = $item['fields'][$key][$locale] ?? ($item['fields'][$key] ?? '');
                            return is_string($v) ? $v : (string)$v;
                        };
                        if ($sort === 'best') {
                            return (float)($b['fields']['ocena'] ?? $get($b,'ocena')) <=> (float)($a['fields']['ocena'] ?? $get($a,'ocena'));
                        }
                        if ($sort === 'low' || $sort === 'high') {
                            $pa = parsePriceNumeric($get($a,'prosecna_cena_dnevno'));
                            $pb = parsePriceNumeric($get($b,'prosecna_cena_dnevno'));
                            if ($pa === null && $pb === null) return 0;
                            if ($pa === null) return 1;
                            if ($pb === null) return -1;
                            return $sort === 'low' ? ($pa <=> $pb) : ($pb <=> $pa);
                        }
                        if ($sort === 'date') {
                            return strcmp($get($b,'poslednje_azuriranje'), $get($a,'poslednje_azuriranje'));
                        }
                        return 0;
                    });
                }

                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">';
                foreach ($itemsList['items'] as $item) {
                    echo cardRenderDestination($item, $locale, $texts, $descriptionMaxLength, $cardTemplate);
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
$pageDescription = 'Pregled destinacija';

$itemsPerPage = __ITEMS_PER_PAGE__;
$descriptionMaxLength = __DESC_MAX_LENGTH__;
$paginationRange = __PAGINATION_RANGE__;

$currentPage = max(1, (int) ($_GET['page'] ?? 1));
$categoryId = isset($_GET['category']) && is_numeric($_GET['category']) ? (int) $_GET['category'] : null;
$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? '';

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

// Translator & static texts
$translator = new LanguageMapperController();
$latinTexts = [
    'page_title'           => 'Destinacije',
    'page_subtitle'        => 'Istražite inspirativna mesta za vaše sledeće putovanje',
    'search_placeholder'   => 'Pretraži destinacije...',
    'apply_button'         => 'Primeni',
    'all_categories'       => 'Sve kategorije',
    'filters'              => 'Filteri',
    'country'              => 'Država',
    'region'               => 'Region',
    'updated'              => 'Ažurirano',
    'rating'               => 'Ocena',
    'activities'           => 'Aktivnosti',
    'season'               => 'Sezona',
    'best_months'          => 'Najbolji meseci',
    'recommended_stay'     => 'Preporučeno trajanje',
    'avg_cost'             => 'Prosečna cena/dan',
    'amenities'            => 'Pogodnosti',
    'map'                  => 'Mapa',
    'contact'              => 'Kontakt',
    'official_website'     => 'Zvanični sajt',
    'destination_details'  => 'Detalji destinacije',
    'no_items_found'       => 'Nema pronađenih destinacija',
    'sort_by'              => 'Sortiraj',
    'sort_best_rated'      => 'Najbolje ocenjene',
    'sort_low_price'       => 'Najniža cena',
    'sort_high_price'      => 'Najviša cena',
    'sort_last_updated'    => 'Najskorije ažurirano',
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

<?php
session_start();
use App\Models\PageLoader;
use \App\Utils\LocaleManager;
        use App\Models\AboutUs;

$dataAboutUS = new AboutUs();
$locale = LocaleManager::get();
$dataTitle = $dataAboutUS->list($locale);
$groupedPages = PageLoader::getGroupedStaticPages();


use App\Models\Text;
// Load dynamic texts
$textModel = new Text();
$dynamicText = $textModel->getDynamicText($locale);

use App\Models\Content;
use App\Controllers\LanguageMapperController;
use App\Models\GenericCategory;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$locale = $_SESSION['locale'] ?? 'sr-Cyrl';
$slug = 'dogadjaji';
$pageTitle = ucfirst($slug);
$pageDescription = 'Pregled svih stavki';

$itemsPerPage = 3;
$descriptionMaxLength = 120;
$paginationRange = 2;

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
    $cardTemplate = <<<'PHP'
        <div class="glass-card rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-1">
            <div class="relative w-full h-56 overflow-hidden bg-gradient-to-br from-white to-white/60">
                {{imageSection}}
                <div class="absolute top-4 left-4">
                    <span class="category-chip bg-secondary text-white">{{kategorija}}</span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-primary-text mb-4 line-clamp-2 group-hover:text-primary transition-colors">
                    {{naslov}}
                </h3>
                <div class="space-y-3 mb-4">
                    {{dateTimeRow}}
                    {{locationRow}}
                </div>
                <div class="mb-5 p-4 bg-surface rounded-xl border border-white/30">
                    <p class="text-sm text-secondary-text leading-relaxed">{{opis}}</p>
                </div>
                <a href="/sadrzaj?id={{itemId}}&tip=generic_element" class="block w-full text-center bg-gradient-to-r from-primary to-secondary hover:from-primary_hover hover:to-secondary_hover text-white text-sm font-bold py-3.5 px-4 rounded-xl transition-all duration-300 shadow-md hover:shadow-xl">
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
function cardRender(array $item, array $fieldLabels, string $locale, array $texts = [], int $descMaxLength = 120, string $cardTemplate = ''): string
{
    $naslov = htmlspecialchars($item['fields']['title'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $opis = htmlspecialchars(mb_substr($item['fields']['description'][$locale] ?? '', 0, $descMaxLength), ENT_QUOTES, 'UTF-8');
    $lokacija = htmlspecialchars($item['fields']['location'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $datum = htmlspecialchars($item['fields']['datum'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $vreme = htmlspecialchars($item['fields']['time'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = htmlspecialchars($item['image'] ?? '', ENT_QUOTES, 'UTF-8');
    $kategorija = htmlspecialchars($item['category']['content'] ?? '', ENT_QUOTES, 'UTF-8');

    $imageSection = $imageUrl
        ? "<img src='{$imageUrl}' class='w-full h-full object-cover transition-transform duration-300 group-hover:scale-105' alt='Event image'>"
        : "<div class='absolute inset-0 flex items-center justify-center'><i class='fas fa-calendar-star text-6xl text-secondary'></i></div>";

    $dateTimeRow = ($datum || $vreme)
        ? "<div class='flex items-start gap-3'>
               <div class='flex-shrink-0 w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center'>
                   <i class='fas fa-calendar-alt text-primary'></i>
               </div>
               <div class='flex-1'>
                   <div class='text-xs font-semibold text-secondary-text uppercase tracking-wide mb-0.5'>{$texts['date_and_time']}</div>
                   <div class='text-sm font-semibold text-primary-text'>{$datum}" . ($datum && $vreme ? " • " : "") . "{$vreme}</div>
               </div>
           </div>"
        : '';

    $locationRow = $lokacija
        ? "<div class='flex items-start gap-3'>
               <div class='flex-shrink-0 w-10 h-10 bg-secondary/10 rounded-lg flex items-center justify-center'>
                   <i class='fas fa-map-marker-alt text-secondary'></i>
               </div>
               <div class='flex-1 min-w-0'>
                   <div class='text-xs font-semibold text-secondary-text uppercase tracking-wide mb-0.5'>{$texts['location']}</div>
                   <div class='text-sm font-semibold text-primary-text truncate'>{$lokacija}</div>
               </div>
           </div>"
        : '';

    $replacements = [
        '{{naslov}}' => $naslov,
        '{{opis}}' => $opis,
        '{{imageSection}}' => $imageSection,
        '{{dateTimeRow}}' => $dateTimeRow,
        '{{locationRow}}' => $locationRow,
        '{{itemId}}' => $itemId,
        '{{kategorija}}' => $kategorija,
        '{{eventDetails}}' => $texts['event_details'] ?? 'Details'
    ];

    return str_replace(array_keys($replacements), array_values($replacements), $cardTemplate);
}
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



?>



    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$dataTitle['title']?> </title>
    <link rel="icon" type="image/png" href="/assets/icons/icon.png?v=<?= time() ?>">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="/exportedPages/commonStyle.css" rel="stylesheet">
    
    <script>
    </script><style>
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
</style>


<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';
require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';
?>

<main class="bg-gradient-to-br from-secondary_background to-background min-h-screen">
    <section class="container mx-auto px-4 py-12">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-primary-text mb-2"><?= htmlspecialchars($dynamicText['t_dogadjaji_dd7a6f_f84aee']['text'] ?? 'Događaji', ENT_QUOTES, 'UTF-8'); ?></h1>
            <p class="text-secondary-text"><?= htmlspecialchars($dynamicText['t_dogadjaji_bfadf8_7c9b57']['text'] ?? 'Istražite našu bogatu ponudu kulturnih događaja', ENT_QUOTES, 'UTF-8'); ?></p>
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
<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';
?>

<script src="/exportedPages/commonScript.js?v=<?php echo time(); ?>"></script>



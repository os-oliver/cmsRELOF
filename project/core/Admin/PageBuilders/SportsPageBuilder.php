<?php
namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class SportsPageBuilder extends BasePageBuilder
{
    protected string $slug;
    private LanguageMapperController $translator;

    private int $itemsPerPage = 6;
    private int $descriptionMaxLength = 100;
    private int $imageHeight = 200;
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
            'search_placeholder' => 'Pretraži sportove...',
            'apply_button' => 'Primeni',
            'all_categories' => 'Sve kategorije',
            'sport_name' => 'Naziv sporta',
            'sport_details' => 'Detalji sporta',
            'date_time' => 'Termin',
            'no_items_found' => 'Nema pronađenih sportova',
            'months' => ['jan', 'feb', 'mar', 'apr', 'maj', 'jun', 'jul', 'avg', 'sep', 'okt', 'nov', 'dec'],
            'explore_sports' => 'Istražite našu sportsku ponudu',
            'sports' => 'Sportovi'
        ];

        if ($locale === 'sr-Cyrl') {
            $this->texts = $this->translator->latin_to_cyrillic_array($latinTexts);
        } else {
            $this->texts = $latinTexts;
        }
    }

    protected string $css = <<<'CSS'
main{padding-top:50px}
.sport-card{background:rgba(255,255,255,0.85);backdrop-filter:blur(20px) saturate(180%);border:1px solid rgba(255,255,255,0.4);border-radius:20px;transition:all 0.3s ease;overflow:hidden}
.sport-card:hover{transform:translateY(-8px);box-shadow:0 20px 40px rgba(0,0,0,0.15);border-color:rgba(255,255,255,0.6)}
.sport-image{height:200px;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);position:relative;overflow:hidden}
.sport-image img{transition:transform 0.5s ease}
.sport-card:hover .sport-image img{transform:scale(1.05)}
.sport-badge{position:absolute;top:15px;left:15px;background:linear-gradient(45deg,#FF6B6B,#FF8E53);color:white;padding:6px 15px;border-radius:20px;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px}
.sport-content{padding:25px}
.sport-title{font-size:1.25rem;font-weight:800;color:#2D3748;margin-bottom:12px;line-height:1.3}
.sport-description{color:#718096;font-size:0.9rem;line-height:1.5;margin-bottom:20px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
.sport-meta{display:flex;align-items:center;gap:10px;margin-bottom:20px;padding:12px;background:rgba(102,126,234,0.08);border-radius:12px;border-left:4px solid #667eea}
.sport-meta i{color:#667eea;font-size:1rem}
.sport-meta-text{flex:1}
.sport-meta-label{font-size:0.75rem;color:#718096;text-transform:uppercase;letter-spacing:0.5px;font-weight:600}
.sport-meta-value{font-size:0.9rem;color:#2D3748;font-weight:600}
.sport-btn{display:block;width:100%;text-align:center;background:linear-gradient(45deg,#667eea,#764ba2);color:white;padding:14px;border-radius:12px;font-weight:700;text-decoration:none;transition:all 0.3s ease;position:relative;overflow:hidden}
.sport-btn:hover{color:white;transform:translateY(-2px);box-shadow:0 10px 20px rgba(102,126,234,0.3)}
.sport-btn:before{content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.2),transparent);transition:left 0.5s}
.sport-btn:hover:before{left:100%}
.glass-search{background:rgba(255,255,255,0.9);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.3);border-radius:16px}
.fields-container{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:1rem}
@media (max-width:768px){.sport-card{margin-bottom:1.5rem}.fields-container{grid-template-columns:1fr}}
CSS;

    protected string $topBar = <<<'PHP'
function renderTopbar(array $categories, string $searchValue = '', int|string|null $selectedCategoryId = null, array $texts = []): string
{
    $safeSearchValue = htmlspecialchars($searchValue, ENT_QUOTES, 'UTF-8');
    $html = "<form method='GET' action='' class='glass-search flex flex-col lg:flex-row items-center justify-between p-6 rounded-2xl shadow-lg mb-10 gap-5'>";
    $html .= "<div class='flex w-full lg:w-auto flex-1 gap-4'>
        <input type='text' name='search' value='{$safeSearchValue}' placeholder='{$texts['search_placeholder']}' class='flex-1 rounded-2xl px-6 py-4 focus:outline-none focus:ring-3 focus:ring-primary/30 transition-all shadow-sm bg-white/90 border border-gray-100'>
        <button type='submit' class='px-8 py-4 rounded-2xl transition-all shadow-lg font-bold bg-gradient-to-r from-primary to-secondary hover:from-primary_hover hover:to-secondary_hover text-white transform hover:-translate-y-0.5'>
            <i class='fas fa-search mr-2'></i>
            {$texts['apply_button']}
        </button>
    </div>";
    $html .= "<div class='flex items-center w-full lg:w-auto'>
        <select name='category' class='w-full lg:w-72 rounded-2xl px-6 py-4 focus:outline-none focus:ring-3 focus:ring-primary/30 transition-all shadow-sm bg-white/90 border border-gray-100 appearance-none cursor-pointer font-medium'>
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
        <div class="sport-card group">
            <div class="sport-image">
                {{imageSection}}
                <div class="sport-badge">
                    <i class="fas fa-futbol mr-2"></i>{{kategorija}}
                </div>
            </div>
            <div class="sport-content">
                <h3 class="sport-title">{{nazivSporta}}</h3>
                
                {{dateTimeRow}}
                
                <div class="sport-description">
                    {{opis}}
                </div>
                
                <a href="/sadrzaj?id={{itemId}}&tip=generic_element" class="sport-btn">
                    <i class="fas fa-arrow-right mr-2"></i>
                    {{sportDetails}}
                </a>
            </div>
        </div>
    PHP;
HTML;

    protected string $cardRender = <<<'HTML'
function cardRender(array $item, array $fieldLabels, string $locale, array $texts = [], int $descMaxLength = 100, string $cardTemplate = ''): string
{
    $nazivSporta = htmlspecialchars($item['fields']['nazivSporta'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $opis = htmlspecialchars(mb_substr($item['fields']['opis'][$locale] ?? '', 0, $descMaxLength), ENT_QUOTES, 'UTF-8');
    $termin = htmlspecialchars($item['fields']['termin'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = htmlspecialchars($item['image'] ?? '', ENT_QUOTES, 'UTF-8');
    $kategorija = htmlspecialchars($item['category']['content'] ?? '', ENT_QUOTES, 'UTF-8');

    $imageSection = $imageUrl
        ? "<img src='{$imageUrl}' class='w-full h-full object-cover' alt='{$nazivSporta}'>"
        : "<div class='w-full h-full flex items-center justify-center bg-gradient(135deg,#667eea,#764ba2)'>
            <i class='fas fa-futbol text-6xl text-white opacity-80'></i>
          </div>";

    $dateTimeRow = $termin
        ? "<div class='sport-meta'>
               <i class='fas fa-calendar-alt'></i>
               <div class='sport-meta-text'>
                   <div class='sport-meta-label'>{$texts['date_time']}</div>
                   <div class='sport-meta-value'>{$termin}</div>
               </div>
           </div>"
        : '';

    $replacements = [
        '{{nazivSporta}}' => $nazivSporta,
        '{{opis}}' => $opis,
        '{{imageSection}}' => $imageSection,
        '{{dateTimeRow}}' => $dateTimeRow,
        '{{itemId}}' => $itemId,
        '{{kategorija}}' => $kategorija,
        '{{sportDetails}}' => $texts['sport_details'] ?? 'Detalji'
    ];

    return str_replace(array_keys($replacements), array_values($replacements), $cardTemplate);
}
HTML;

    protected string $pagination = <<<'PHP'
function renderPagination(int $currentPage, int $totalPages, int $range = 2): string
{
    if ($totalPages <= 1) return '';
    $html = "<div class='flex justify-center items-center gap-3 mt-12'>";
    if ($currentPage > 1) {
        $prevUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage - 1]));
        $html .= "<a href='{$prevUrl}' class='px-5 py-3 rounded-2xl hover:shadow-lg font-semibold bg-white/90 backdrop-blur-sm border border-gray-200 transition-all hover:-translate-y-0.5'>
            <i class='fas fa-chevron-left text-primary'></i>
        </a>";
    }
    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);
    if ($start > 1) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
        $html .= "<a href='{$url}' class='px-5 py-3 rounded-2xl font-semibold bg-white/90 backdrop-blur-sm border border-gray-200 transition-all hover:-translate-y-0.5'>1</a>";
        if ($start > 2) $html .= "<span class='px-3 text-gray-400 font-semibold'>...</span>";
    }
    for ($i = $start; $i <= $end; $i++) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
        $class = $i === $currentPage
            ? 'px-5 py-3 bg-gradient-to-r from-primary to-secondary text-white rounded-2xl font-bold shadow-lg transform -translate-y-0.5'
            : 'px-5 py-3 bg-white/90 backdrop-blur-sm rounded-2xl border border-gray-200 hover:shadow-lg font-semibold transition-all hover:-translate-y-0.5';
        $html .= "<a href='{$url}' class='{$class}'>{$i}</a>";
    }
    if ($end < $totalPages) {
        if ($end < $totalPages - 1) $html .= "<span class='px-3 text-gray-400 font-semibold'>...</span>";
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
        $html .= "<a href='{$url}' class='px-5 py-3 rounded-2xl font-semibold bg-white/90 backdrop-blur-sm border border-gray-200 transition-all hover:-translate-y-0.5'>{$totalPages}</a>";
    }
    if ($currentPage < $totalPages) {
        $nextUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
        $html .= "<a href='{$nextUrl}' class='px-5 py-3 rounded-2xl hover:shadow-lg font-semibold bg-white/90 backdrop-blur-sm border border-gray-200 transition-all hover:-translate-y-0.5'>
            <i class='fas fa-chevron-right text-primary'></i>
        </a>";
    }
    $html .= "</div>";
    return $html;
}
PHP;

    protected string $html = <<<'HTML'
<main class="bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">
    <section class="container mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-black text-gray-900 mb-4 bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                <i class="fas fa-futbol mr-4"></i>
                {$texts['sports']}
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">{$texts['explore_sports']}</p>
        </div>

        <?php echo renderTopbar($categories, $search, $categoryId, $texts); ?>

        <div class="sports-grid">
            <?php
            if (!empty($itemsList['success']) && !empty($itemsList['items'])) {
                echo '<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 mb-12">';
                foreach ($itemsList['items'] as $item) {
                    echo cardRender($item, $fieldLabels, $locale, $texts, $descriptionMaxLength, $cardTemplate);
                }
                echo '</div>';
                $totalPages = max(1, (int) ceil($itemsList['total'] / $itemsPerPage));
                echo renderPagination($currentPage, $totalPages, $paginationRange);
            } else {
                echo "<div class='sport-card rounded-2xl p-16 text-center'>
                    <div class='sport-image rounded-2xl mb-6 flex items-center justify-center'>
                        <i class='fas fa-futbol text-8xl text-white opacity-90'></i>
                    </div>
                    <h3 class='text-2xl font-bold text-gray-800 mb-4'>{$texts['no_items_found']}</h3>
                    <p class='text-gray-600 mb-6'>Pokušajte da promenite parametre pretrage</p>
                    <a href='?' class='sport-btn inline-block w-auto px-8'>
                        <i class='fas fa-refresh mr-2'></i>
                        Poništi filtere
                    </a>
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
$pageDescription = 'Pregled svih sportova';

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
    'search_placeholder' => 'Pretraži sportove...',
    'apply_button' => 'Primeni',
    'all_categories' => 'Sve kategorije',
    'sport_name' => 'Naziv sporta',
    'sport_details' => 'Detalji sporta',
    'date_time' => 'Termin',
    'no_items_found' => 'Nema pronađenih sportova',
    'months' => ['jan', 'feb', 'mar', 'apr', 'maj', 'jun', 'jul', 'avg', 'sep', 'okt', 'nov', 'dec'],
    'explore_sports' => 'Istražite našu sportsku ponudu',
    'sports' => 'Sportovi'
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
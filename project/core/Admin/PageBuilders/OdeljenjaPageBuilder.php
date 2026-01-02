<?php
namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class OdeljenjaPageBuilder extends BasePageBuilder
{
    protected string $slug;
    private LanguageMapperController $translator;

    private int $itemsPerPage = 12;
    private int $descriptionMaxLength = 150;
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
            'search_placeholder' => 'Pretraži odeljenja...',
            'apply_button' => 'Primeni',
            'contact_person' => 'Kontakt osoba',
            'department_email' => 'Email',
            'department_details' => 'Vise o odeljenju',
            'no_items_found' => 'Nema pronađenih odeljenja'
        ];

        if ($locale === 'sr-Cyrl') {
            $this->texts = $this->translator->latin_to_cyrillic_array($latinTexts);
        } else {
            $this->texts = $latinTexts;
        }
    }

    protected string $css = <<<'CSS'
main{padding-top:50px}
.glass-card{background:rgba(255,255,255,0.75);backdrop-filter:blur(18px) saturate(160%);-webkit-backdrop-filter:blur(18px) saturate(160%);border:1px solid rgba(255,255,255,0.35);box-shadow:0 8px 32px rgba(0,0,0,0.08);transition:all 0.3s ease}
.glass-card:hover{transform:translateY(-4px);box-shadow:0 16px 48px rgba(0,0,0,0.12);background:rgba(255,255,255,0.85)}
.glass-search{background:rgba(255,255,255,0.82);backdrop-filter:blur(14px) saturate(160%);-webkit-backdrop-filter:blur(14px) saturate(160%);border:1px solid rgba(255,255,255,0.28)}
.dept-icon{width:64px;height:64px;display:flex;align-items:center;justify-content:center;border-radius:16px;background:linear-gradient(135deg,rgba(var(--primary-rgb),0.1),rgba(var(--secondary-rgb),0.1));margin-bottom:1rem}
.dept-icon i{font-size:2rem;background:linear-gradient(135deg,var(--primary),var(--secondary));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.info-badge{display:inline-flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;background:rgba(255,255,255,0.5);border-radius:8px;border-left:3px solid var(--primary);font-size:0.875rem;margin-bottom:0.75rem}
.info-badge-label{font-weight:700;text-transform:uppercase;color:var(--secondary-text);font-size:0.7rem;letter-spacing:0.05em}
.info-badge-value{color:var(--primary-text);font-weight:600}
.dept-card-header{position:relative;overflow:hidden;border-radius:16px 16px 0 0}
.dept-card-image{width:100%;height:224px;object-fit:cover;transition:transform 0.4s ease}
.glass-card:hover .dept-card-image{transform:scale(1.05)}
.dept-card-overlay{position:absolute;inset:0;background:linear-gradient(180deg,transparent 0%,rgba(0,0,0,0.08) 100%)}
@media (max-width:768px){.glass-card{margin-bottom:1rem}.dept-card-image{height:180px}}
CSS;

    protected string $topBar = <<<'PHP'
function renderTopbar(string $searchValue = '', array $texts = []): string
{
    $safeSearchValue = htmlspecialchars($searchValue, ENT_QUOTES, 'UTF-8');
    $html = "<form method='GET' action='' class='glass-search flex flex-col sm:flex-row items-center gap-4 p-6 rounded-2xl shadow-md mb-8'>";
    $html .= "<div class='flex w-full sm:w-auto flex-1 gap-3'>";
    $html .= "<input type='text' name='search' value='{$safeSearchValue}' placeholder='{$texts['search_placeholder']}' class='flex-1 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-primary transition-all shadow-sm bg-white/80 backdrop-blur-sm'>";
    $html .= "<button type='submit' class='px-7 py-3 rounded-xl transition-all shadow-md font-medium bg-gradient-to-r from-primary to-secondary hover:from-primary_hover hover:to-secondary_hover text-white'>";
    $html .= "{$texts['apply_button']}</button>";
    $html .= "</div></form>";
    return $html;
}

PHP;

    protected string $cardTemplate = <<<'PHP'
$cardTemplate = <<<'CARD'
<div class="group relative bg-surface rounded-3xl border border-secondary/10 transition-all duration-500 hover:shadow-[0_20px_50px_rgba(15,23,42,0.1)] hover:-translate-y-2 overflow-visible flex flex-col h-full">
    
    <div class="relative h-52 w-full overflow-hidden rounded-t-[1.4rem] rounded-bl-[3rem]">
        {{imageSection}}
        <div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        
     
    </div>

    <div class="p-8 pt-10 flex flex-col flex-grow">

        <h3 class="font-heading2 text-2xl text-primary_text mb-3 leading-tight group-hover:text-accent transition-colors">
            {{naziv}}
        </h3>

        <div class="w-8 h-[2px] bg-secondary/20 mb-4 group-hover:w-16 transition-all duration-500"></div>

        <p class="font-body text-secondary_text text-sm leading-relaxed mb-6 line-clamp-3">
            {{opis}}
        </p>

     

        <a href="/sadrzaj?id={{itemId}}&tip=Odeljenja" 
           class="relative overflow-hidden group/btn w-full py-4 rounded-xl border border-primary text-primary text-xs font-bold uppercase tracking-widest transition-all duration-300 hover:text-white flex items-center justify-center gap-2">
            <span class="relative z-10">{{departmentDetails}}</span>
            <i class="fas fa-chevron-right relative z-10 text-[10px]"></i>
            
            <div class="absolute inset-0 bg-primary translate-y-[101%] group-hover/btn:translate-y-0 transition-transform duration-300"></div>
        </a>
    </div>
</div>
CARD;
PHP;

    protected string $cardRender = <<<'PHP'
function cardRender(array $item, array $fieldLabels, string $locale, array $texts = [], int $descMaxLength = 150, string $cardTemplate = ''): string
{
    $naziv = htmlspecialchars($item['fields']['naziv'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $opis = htmlspecialchars(mb_substr($item['fields']['opis'][$locale] ?? '', 0, $descMaxLength), ENT_QUOTES, 'UTF-8');
    $kontakt = htmlspecialchars($item['fields']['kontakt'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($item['fields']['email'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = htmlspecialchars($item['image'] ?? '', ENT_QUOTES, 'UTF-8');

    $imageSection = $imageUrl
        ? "<img src='{$imageUrl}' class='w-full h-full object-cover' alt='Department image'>"
        : "<div class='w-full h-full bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center'><i class='fas fa-building text-5xl text-primary/30'></i></div>";

 

    $replacements = [
        '{{naziv}}' => $naziv,
        '{{opis}}' => $opis,
        '{{imageSection}}' => $imageSection,
        '{{itemId}}' => $itemId,
        '{{departmentDetails}}' => $texts['department_details'] ?? 'Više'
    ];

    return str_replace(array_keys($replacements), array_values($replacements), $cardTemplate);
}
PHP;

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
        <div class="mb-10">
            <h1 class="text-4xl font-bold text-primary-text mb-2">Odeljenja</h1>
            <p class="text-secondary-text text-lg">Saznajte više o našim odeljenjima i kontaktirajte odgovorne osobe</p>
        </div>

        <?php echo renderTopbar($search, $texts); ?>

        <div class="departments-grid">
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
                echo "<div class='glass-card rounded-2xl p-12 text-center'>
                    <i class='fas fa-building text-6xl text-secondary mb-4'></i>
                    <p class='text-secondary-text text-lg'>{$texts['no_items_found']}</p>
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

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$locale = $_SESSION['locale'] ?? 'sr-Cyrl';
$slug = '__SLUG__';
$pageTitle = 'Odeljenja';
$pageDescription = 'Pregled svih odeljenja';

$itemsPerPage = __ITEMS_PER_PAGE__;
if (isset($_GET['per_page']) && is_numeric($_GET['per_page'])) {
    $itemsPerPage = (int)$_GET['per_page'];
}
$descriptionMaxLength = __DESC_MAX_LENGTH__;
$paginationRange = __PAGINATION_RANGE__;

$currentPage = max(1, (int) ($_GET['page'] ?? 1));
$search = $_GET['search'] ?? '';

$itemsList = $slug
    ? (new Content())->fetchListData($slug, $search, $currentPage, $itemsPerPage, null)
    : ['success' => false, 'items' => [], 'total' => 0];

$config = $fieldLabels = [];
if ($slug && file_exists($structurePath = __DIR__ . '/../../assets/data/structure.json')) {
    $parsed = json_decode(file_get_contents($structurePath), true);
    $config = $parsed[0][$slug] ?? [];
    $fieldLabels = array_column($config['fields'] ?? [], null, 'name');
}

$translator = new LanguageMapperController();
$latinTexts = [
    'search_placeholder' => 'Pretraži odeljenja...',
    'apply_button' => 'Primeni',
    'contact_person' => 'Kontakt osoba',
    'department_email' => 'Email',
    'department_details' => 'Više o odeljenju',
    'no_items_found' => 'Nema pronađenih odeljenja'
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

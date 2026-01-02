<?php
namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class NajavePageBuilder extends BasePageBuilder
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

        $translations = [
            'sr' => [
                'search_placeholder' => 'Pretraži najave...',
                'apply_button' => 'Pretraži',
                'read_more' => 'Proučite više',
                'announcement_date' => 'Datum najave',
                'no_items_found' => 'Nema pronađenih najava'
            ],
            'sr-Cyrl' => [
                'search_placeholder' => 'Претражи најаве...',
                'apply_button' => 'Претражи',
                'read_more' => 'Проучите више',
                'announcement_date' => 'Датум најаве',
                'no_items_found' => 'Нема пронађених најава'
            ]
        ];

        $this->texts = $translations[$locale] ?? $translations['sr'];
    }

    protected string $css = <<<'CSS'
main { padding-top: 50px; }
CSS;

    protected string $topBar = <<<'PHP'
function renderTopbar(string $searchValue = '', array $texts = []): string
{
    $safeSearchValue = htmlspecialchars($searchValue, ENT_QUOTES, 'UTF-8');
    $html = "<form method='GET' action='' class='bg-surface border border-primary/8 rounded-xl p-5 mb-8 flex flex-col sm:flex-row gap-3 items-center shadow-sm hover:shadow-md transition-shadow'>";
    $html .= "<i class='fas fa-search text-secondary/50 text-lg hidden sm:block'></i>";
    $html .= "<input type='text' name='search' value='{$safeSearchValue}' placeholder='{$texts['search_placeholder']}' class='flex-1 min-w-0 bg-background border border-primary/15 rounded-lg px-4 py-2.5 text-primary_text placeholder-secondary_text/40 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all text-sm'>";
    $html .= "<button type='submit' class='px-7 py-2.5 bg-gradient-to-r from-primary to-secondary text-white font-bold text-xs uppercase tracking-wider rounded-lg hover:shadow-lg hover:scale-105 transition-all whitespace-nowrap'>{$texts['apply_button']}</button>";
    $html .= "</form>";
    return $html;
}

PHP;

    protected string $cardTemplate = <<<'PHP'
$cardTemplate = <<<'CARD'
<a href="/sadrzaj?id={{itemId}}&tip=Najave" class="group block bg-surface rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-3 border border-primary/8 hover:border-primary/30 flex flex-col h-full">
    <!-- Image Section -->
    <div class="relative w-full h-72 bg-gradient-to-br from-primary/20 to-secondary/20 overflow-hidden">
        {{imageSection}}
        <!-- Gradient Overlay on Hover -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        
        <!-- Announcement Badge - Modernized -->
        <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden border border-white/50">
            <div class="bg-gradient-to-r from-primary to-secondary px-3 py-1.5 text-white text-xs font-bold uppercase tracking-wider flex items-center gap-1.5">
                <i class="fas fa-calendar-check text-sm"></i>
                NAJAVA
            </div>
            <div class="px-3 py-2 text-primary_text text-sm font-bold text-center">
                {{fullDate}}
            </div>
        </div>
    </div>
    
    <!-- Content Section -->
    <div class="p-6 flex flex-col flex-grow">
        <!-- Title with proper overflow handling -->
        <h3 class="text-lg font-bold text-primary_text leading-snug mb-3 line-clamp-3 group-hover:text-primary transition-colors duration-200 break-words">
            {{naslov}}
        </h3>
        
        <!-- Divider -->
        <div class="w-12 h-1 bg-gradient-to-r from-primary via-secondary to-primary rounded-full mb-3"></div>
        
        <!-- Description -->
        <p class="text-sm text-secondary_text leading-relaxed line-clamp-2 flex-grow group-hover:text-secondary_text/90 transition-colors mb-4">
            {{opis}}
        </p>
        
        <!-- Footer with CTA -->
        <div class="inline-flex items-center gap-2 text-primary font-bold text-xs uppercase tracking-widest group-hover:gap-3 group-hover:text-secondary transition-all">
            <span>Pročitaj</span>
            <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
        </div>
    </div>
</a>
CARD;
PHP;

    protected string $cardRender = <<<'PHP'
function cardRender(array $item, array $fieldLabels, string $locale, array $texts = [], int $descMaxLength = 150, string $cardTemplate = ''): string
{
    $naslov = htmlspecialchars($item['fields']['naslov'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $opis = htmlspecialchars(mb_substr($item['fields']['opis'][$locale] ?? '', 0, $descMaxLength), ENT_QUOTES, 'UTF-8');
    $datum = $item['fields']['datum'][$locale] ?? '';
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = htmlspecialchars($item['image'] ?? '', ENT_QUOTES, 'UTF-8');

    $imageSection = $imageUrl
        ? "<img src='{$imageUrl}' class='w-full h-full object-cover group-hover:scale-110 transition-transform duration-500' alt='{$naslov}'>"
        : "<div class='w-full h-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center'><i class='fas fa-bullhorn text-6xl text-white/20'></i></div>";

    $fullDate = '';
    if ($datum) {
        $parts = explode('-', $datum);
        if (count($parts) === 3) {
            // Format: DD. MMM YYYY
            $monthNames = [
                '01' => 'JAN', '02' => 'FEB', '03' => 'MAR', '04' => 'APR',
                '05' => 'MAJ', '06' => 'JUN', '07' => 'JUL', '08' => 'AVG',
                '09' => 'SEP', '10' => 'OKT', '11' => 'NOV', '12' => 'DEC'
            ];
            $day = (int)$parts[2];
            $month = $monthNames[$parts[1]] ?? $parts[1];
            $year = $parts[0];
            $fullDate = $day . '. ' . $month . ' ' . $year;
        }
    }

    $replacements = [
        '{{naslov}}' => $naslov,
        '{{opis}}' => $opis,
        '{{imageSection}}' => $imageSection,
        '{{itemId}}' => $itemId,
        '{{fullDate}}' => $fullDate
    ];

    return str_replace(array_keys($replacements), array_values($replacements), $cardTemplate);
}
PHP;

    protected string $pagination = <<<'PHP'
function renderPagination(int $currentPage, int $totalPages, int $range = 2): string
{
    if ($totalPages <= 1) return '';
    $html = "<div class='flex justify-center items-center gap-2 mt-8 flex-wrap'>";
    if ($currentPage > 1) {
        $prevUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage - 1]));
        $html .= "<a href='{$prevUrl}' class='px-3 py-2 rounded-md bg-surface border border-primary/10 hover:bg-primary/5 text-primary_text font-medium transition-all'><i class='fas fa-chevron-left'></i></a>";
    }
    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);
    if ($start > 1) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
        $html .= "<a href='{$url}' class='px-3 py-2 rounded-md bg-surface border border-primary/10 hover:bg-primary/5 text-primary_text font-medium transition-all'>1</a>";
        if ($start > 2) $html .= "<span class='px-2 text-secondary_text'>...</span>";
    }
    for ($i = $start; $i <= $end; $i++) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
        $class = $i === $currentPage
            ? 'px-3 py-2 bg-gradient-to-r from-primary to-secondary text-white rounded-md font-semibold shadow-md'
            : 'px-3 py-2 rounded-md bg-surface border border-primary/10 hover:bg-primary/5 text-primary_text font-medium transition-all';
        $html .= "<a href='{$url}' class='{$class}'>{$i}</a>";
    }
    if ($end < $totalPages) {
        if ($end < $totalPages - 1) $html .= "<span class='px-2 text-secondary_text'>...</span>";
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
        $html .= "<a href='{$url}' class='px-3 py-2 rounded-md bg-surface border border-primary/10 hover:bg-primary/5 text-primary_text font-medium transition-all'>{$totalPages}</a>";
    }
    if ($currentPage < $totalPages) {
        $nextUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
        $html .= "<a href='{$nextUrl}' class='px-3 py-2 rounded-md bg-surface border border-primary/10 hover:bg-primary/5 text-primary_text font-medium transition-all'><i class='fas fa-chevron-right'></i></a>";
    }
    $html .= "</div>";
    return $html;
}
PHP;

    protected string $html = <<<'HTML'
<main class="bg-background min-h-screen">
    <section class="container mx-auto px-4 py-14 max-w-7xl">
        <!-- Header Section -->
        <div class="mb-12 text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-primary_text mb-3 leading-tight">Najave</h1>
            <p class="text-secondary_text text-lg md:text-xl max-w-2xl mx-auto leading-relaxed">Pratite najnovije dogadjaje, radionice, predavanja i takmičenja</p>
            <div class="w-16 h-1 bg-gradient-to-r from-primary to-secondary mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Search Bar -->
        <?php echo renderTopbar($search, $texts); ?>

        <!-- Grid Content -->
        <div class="announcements-grid">
            <?php
            if (!empty($itemsList['success']) && !empty($itemsList['items'])) {
                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">';
                foreach ($itemsList['items'] as $item) {
                    echo cardRender($item, $fieldLabels, $locale, $texts, $descriptionMaxLength, $cardTemplate);
                }
                echo '</div>';
                $totalPages = max(1, (int) ceil($itemsList['total'] / $itemsPerPage));
                echo renderPagination($currentPage, $totalPages, $paginationRange);
            } else {
                echo "<div class='bg-surface border border-primary/8 rounded-xl p-16 text-center shadow-sm'>
                    <i class='fas fa-bullhorn text-6xl text-secondary/30 mb-4 block'></i>
                    <h3 class='text-xl font-semibold text-primary_text mb-2'>Nema rezultata</h3>
                    <p class='text-secondary_text'>{$texts['no_items_found']}</p>
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
$pageTitle = 'Najave';
$pageDescription = 'Najave dogadjaja, radionica i predavanja';

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

$translations = [
    'sr' => [
        'search_placeholder' => 'Pretraži najave...',
        'apply_button' => 'Pretraži',
        'read_more' => 'Proučite više',
        'announcement_date' => 'Datum najave',
        'no_items_found' => 'Nema pronađenih najava'
    ],
    'sr-Cyrl' => [
        'search_placeholder' => 'Претражи најаве...',
        'apply_button' => 'Претражи',
        'read_more' => 'Проучите више',
        'announcement_date' => 'Датум најаве',
        'no_items_found' => 'Нема пронађених најава'
    ]
];

$texts = $translations[$locale] ?? $translations['sr'];
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

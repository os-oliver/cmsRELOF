<?php
namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class NovinePageBuilder extends BasePageBuilder
{
    protected string $slug;
    private LanguageMapperController $translator;

    private int $itemsPerPage = 12;
    private int $descriptionMaxLength = 150;
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
            'search_placeholder' => 'Pretraži novine...',
            'apply_button' => 'Pretraži',
            'all_decades' => 'Sve dekade',
            'publication_year' => 'Godina izdanja',
            'description' => 'Opis',
            'no_items_found' => 'Nema pronađenih izdanja',
            'view_details' => 'Pogledaj izdanje',
            'categories_title' => 'Filtriraj po dekadi',
            'title' => 'Izdanja novina',
            'subtitle' => 'Pregled историјског архива издања'
        ];

        if ($locale === 'sr-Cyrl') {
            $this->texts = $this->translator->latin_to_cyrillic_array($latinTexts);
        } else {
            $this->texts = $latinTexts;
        }
    }

    protected string $css = <<<'CSS'
main {
    padding-top: 2rem;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
}

.header-section {
    text-align: center;
    margin-bottom: 3rem;
    animation: slideDown 0.6s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.header-section h1 {
    font-size: 3rem;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}

.header-section p {
    font-size: 1.1rem;
    color: #666;
}

.filter-section {
    background: white;
    border-radius: 1.5rem;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
}

.search-wrapper {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.search-input {
    flex: 1;
    min-width: 250px;
    padding: 0.875rem 1.25rem;
    border: 2px solid #e0e0e0;
    border-radius: 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.search-btn {
    padding: 0.875rem 2rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.search-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 25px rgba(102, 126, 234, 0.6);
}

.decade-filter-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
}

.decade-buttons {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.decade-btn {
    padding: 0.75rem 1.5rem;
    background: #f0f2f5;
    border: 2px solid transparent;
    border-radius: 2rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #555;
}

.decade-btn:hover {
    background: #e8eef5;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.decade-btn.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-color: #667eea;
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
}

.newspapers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.newspaper-card {
    background: white;
    border-radius: 1.25rem;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    animation: cardAppear 0.5s ease-out forwards;
    opacity: 0;
}

@keyframes cardAppear {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.newspaper-card:nth-child(1) { animation-delay: 0.1s; }
.newspaper-card:nth-child(2) { animation-delay: 0.2s; }
.newspaper-card:nth-child(3) { animation-delay: 0.3s; }
.newspaper-card:nth-child(n+4) { animation-delay: 0.4s; }

.newspaper-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 48px rgba(102, 126, 234, 0.2);
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 1.5rem;
    color: white;
    position: relative;
    overflow: hidden;
}

.card-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
    background-size: 20px 20px;
}

.card-decade {
    display: inline-block;
    background: rgba(255, 255, 255, 0.25);
    padding: 0.375rem 1rem;
    border-radius: 2rem;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    backdrop-filter: blur(10px);
}

.card-title {
    font-size: 1.35rem;
    font-weight: 700;
    margin: 0;
    line-height: 1.3;
}

.card-body {
    padding: 1.5rem;
}

.card-year {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
    color: #555;
    font-weight: 500;
}

.card-year-icon {
    width: 2.5rem;
    height: 2.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.card-description {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    min-height: 3rem;
}

.card-footer {
    display: flex;
    gap: 1rem;
}

.view-btn {
    flex: 1;
    padding: 0.875rem 1.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 0.75rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.view-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: #999;
}

.empty-state-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    color: #ddd;
}

.empty-state-text {
    font-size: 1.25rem;
    color: #666;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.75rem;
    margin-top: 3rem;
    flex-wrap: wrap;
}

.pagination a,
.pagination span {
    padding: 0.625rem 1rem;
    border-radius: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.pagination a {
    background: white;
    color: #667eea;
    border: 2px solid #e0e0e0;
}

.pagination a:hover {
    background: #f5f7fa;
    border-color: #667eea;
}

.pagination .active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: 2px solid transparent;
}

.pagination .dots {
    color: #999;
}

@media (max-width: 768px) {
    .header-section h1 {
        font-size: 2rem;
    }

    .search-wrapper {
        flex-direction: column;
    }

    .search-input {
        min-width: 100%;
    }

    .decade-buttons {
        justify-content: center;
    }

    .newspapers-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .filter-section {
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    main {
        padding-top: 1rem;
    }

    .header-section h1 {
        font-size: 1.5rem;
    }

    .header-section p {
        font-size: 0.95rem;
    }

    .decade-btn {
        padding: 0.625rem 1rem;
        font-size: 0.875rem;
    }

    .card-title {
        font-size: 1.1rem;
    }
}
CSS;

    protected string $topBar = <<<'PHP'
function renderTopbar(array $categories, string $searchValue = '', int|string|null $selectedCategoryId = null, array $texts = []): string
{
    $safeSearchValue = htmlspecialchars($searchValue, ENT_QUOTES, 'UTF-8');
    
    $html = "<div class='filter-section'>";
    
    $html .= "<form method='GET' action='' class='search-wrapper'>";
    $html .= "<input type='text' name='search' value='{$safeSearchValue}' placeholder='{$texts['search_placeholder']}' class='search-input'>";
    $html .= "<button type='submit' class='search-btn'>";
    $html .= "<i class='fas fa-search'></i> {$texts['apply_button']}";
    $html .= "</button>";
    $html .= "</form>";
    
    $html .= "<div>";
    $html .= "<h3 class='decade-filter-title'><i class='fas fa-filter'></i> {$texts['categories_title']}</h3>";
    $html .= "<div class='decade-buttons'>";
    
    $allCategoriesUrl = '?' . http_build_query(array_merge($_GET, ['page' => 1], ['category' => '']));
    $allActive = empty($selectedCategoryId) ? 'active' : '';
    $html .= "<a href='{$allCategoriesUrl}' class='decade-btn {$allActive}'>";
    $html .= "{$texts['all_decades']}";
    $html .= "</a>";
    
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
        
        $activeClass = $isSelected ? 'active' : '';
        $url = '?' . http_build_query(array_merge($_GET, ['page' => 1], ['category' => $id]));
        
        $html .= "<a href='{$url}' class='decade-btn {$activeClass}'>";
        $html .= $name;
        $html .= "</a>";
    }
    
    $html .= "</div>";
    $html .= "</div>";
    $html .= "</div>";
    
    return $html;
}
PHP;

    protected string $cardTemplate = <<<'PHP'
function renderNewspaperCard(array $item, array $fieldLabels, string $locale, array $texts = [], int $descMaxLength = 150): string
{
    $naslov = htmlspecialchars($item['fields']['naslov'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $opis = htmlspecialchars(mb_substr($item['fields']['opis'][$locale] ?? '', 0, $descMaxLength), ENT_QUOTES, 'UTF-8');
    $godina = htmlspecialchars($item['fields']['godina'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $decenija = htmlspecialchars($item['category']['content'] ?? '', ENT_QUOTES, 'UTF-8');
    
    $yearLabel = $texts['publication_year'] ?? 'Godina';
    $viewDetails = $texts['view_details'] ?? 'Pogledaj';
    
    $html = "<div class='newspaper-card'>";
    $html .= "<div class='card-header'>";
    $html .= "<span class='card-decade'>📅 {$decenija}</span>";
    $html .= "<h3 class='card-title'>{$naslov}</h3>";
    $html .= "</div>";
    $html .= "<div class='card-body'>";
    
    if ($godina) {
        $html .= "<div class='card-year'>";
        $html .= "<div class='card-year-icon'>";
        $html .= "<i class='fas fa-calendar-alt'></i>";
        $html .= "</div>";
        $html .= "<span>{$yearLabel}: <strong>{$godina}</strong></span>";
        $html .= "</div>";
    }
    
    if ($opis) {
        $html .= "<div class='card-description'>{$opis}</div>";
    }
    
    $html .= "<div class='card-footer'>";
    $html .= "<a href='/sadrzaj?id={$itemId}&tip=generic_element' class='view-btn'>";
    $html .= "<i class='fas fa-eye'></i> {$viewDetails} <i class='fas fa-arrow-right'></i>";
    $html .= "</a>";
    $html .= "</div>";
    $html .= "</div>";
    $html .= "</div>";
    
    return $html;
}
PHP;

    protected string $paginationRender = <<<'PHP'
function renderPagination(int $currentPage, int $totalPages, int $range = 2): string
{
    if ($totalPages <= 1) return '';
    
    $html = "<div class='pagination'>";
    
    if ($currentPage > 1) {
        $prevUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage - 1]));
        $html .= "<a href='{$prevUrl}'><i class='fas fa-chevron-left'></i></a>";
    }
    
    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);
    
    if ($start > 1) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
        $html .= "<a href='{$url}'>1</a>";
        if ($start > 2) $html .= "<span class='dots'>...</span>";
    }
    
    for ($i = $start; $i <= $end; $i++) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
        $class = $i === $currentPage ? 'active' : '';
        $html .= "<a href='{$url}' class='{$class}'>{$i}</a>";
    }
    
    if ($end < $totalPages) {
        if ($end < $totalPages - 1) $html .= "<span class='dots'>...</span>";
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
        $html .= "<a href='{$url}'>{$totalPages}</a>";
    }
    
    if ($currentPage < $totalPages) {
        $nextUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
        $html .= "<a href='{$nextUrl}'><i class='fas fa-chevron-right'></i></a>";
    }
    
    $html .= "</div>";
    return $html;
}
PHP;

    protected string $html = <<<'HTML'
<main>
    <div class="container mx-auto px-4">
        <div class="header-section">
            <h1><?php echo $texts['title']; ?></h1>
            <p><?php echo $texts['subtitle']; ?></p>
        </div>

        <?php echo renderTopbar($categories, $search, $categoryId, $texts); ?>

        <div class="newspapers-grid">
            <?php
            if (!empty($itemsList['success']) && !empty($itemsList['items'])) {
                foreach ($itemsList['items'] as $item) {
                    echo renderNewspaperCard($item, $fieldLabels, $locale, $texts, $descriptionMaxLength);
                }
            } else {
                echo "<div style='grid-column: 1/-1; text-align: center; padding: 4rem 2rem;'>";
                echo "<div class='empty-state-icon'><i class='fas fa-newspaper'></i></div>";
                echo "<p class='empty-state-text'>" . $texts['no_items_found'] . "</p>";
                echo "</div>";
            }
            ?>
        </div>

        <?php
        if (!empty($itemsList['success']) && !empty($itemsList['items'])) {
            $totalPages = max(1, (int) ceil($itemsList['total'] / $itemsPerPage));
            echo renderPagination($currentPage, $totalPages, 2);
        }
        ?>
    </div>
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
$pageDescription = 'Pregled svih izdanja novina';

$itemsPerPage = __ITEMS_PER_PAGE__;
$descriptionMaxLength = __DESC_MAX_LENGTH__;

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
    'search_placeholder' => 'Pretraži novine...',
    'apply_button' => 'Pretraži',
    'all_decades' => 'Sve dekade',
    'publication_year' => 'Godina izdanja',
    'description' => 'Opis',
    'no_items_found' => 'Nema pronađenih izdanja',
    'view_details' => 'Pogledaj izdanje',
    'categories_title' => 'Filtriraj po dekadi',
    'title' => 'Izdanja novina',
    'subtitle' => 'Pregled историјског архива издања'
];

$texts = ($locale === 'sr-Cyrl')
    ? $translator->latin_to_cyrillic_array($latinTexts)
    : $latinTexts;
PHP;

        $additionalPHP .= "\n" . $this->cardTemplate;
        $additionalPHP .= "\n" . $this->paginationRender;
        $additionalPHP .= "\n" . $this->topBar;
        $additionalPHP = str_replace('__SLUG__', addslashes($this->slug), $additionalPHP);
        $additionalPHP = str_replace('__ITEMS_PER_PAGE__', $this->itemsPerPage, $additionalPHP);
        $additionalPHP = str_replace('__DESC_MAX_LENGTH__', $this->descriptionMaxLength, $additionalPHP);

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

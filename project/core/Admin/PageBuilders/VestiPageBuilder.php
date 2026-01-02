<?php
namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class VestiPageBuilder extends BasePageBuilder
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

    protected string $css = <<<CSS
/* ============================================
   DROPDOWN KOMPONENTE
   ============================================ */
.dropdown:hover .dropdown-menu {
    display: block;
}

.dropdown-menu {
    display: none;
    position: absolute;
    background-color: #ffffff;
    min-width: 200px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    border-radius: 8px;
    overflow: hidden;
}

/* ============================================
   GLASSMORPHISM EFEKTI
   ============================================ */
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

/* ============================================
   KATEGORIJA CHIP
   ============================================ */
.category-chip {
    display: inline-flex;
    align-items: center;
    padding: 0.375rem 0.875rem;
    background: rgba(107, 114, 128, 0.9);
    backdrop-filter: blur(10px);
    color: #ffffff;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.025em;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

/* ============================================
   KARTICE I POLJA
   ============================================ */
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
    background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.05) 100%);
}

/* ============================================
   AKCIONI LINKOVI - PRIMARNA BOJA
   ============================================ */
.card-action-link {
    position: relative;
    display: block;
    width: 100%;
    text-align: center;
    background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
    color: #ffffff;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 600;
    padding: 0.875rem 1.25rem;
    border-radius: 0.75rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2), 0 2px 4px -1px rgba(37, 99, 235, 0.1);
    overflow: hidden;
}

.card-action-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.card-action-link:hover {
    background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
    box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3), 0 4px 6px -2px rgba(37, 99, 235, 0.2);
    transform: translateY(-2px);
}

.card-action-link:hover::before {
    left: 100%;
}

.card-action-link:active {
    transform: translateY(0);
    box-shadow: 0 2px 4px -1px rgba(37, 99, 235, 0.2);
}

.link-content {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    position: relative;
    z-index: 1;
}

.link-icon {
    width: 1rem;
    height: 1rem;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.card-action-link:hover .link-icon {
    transform: translateX(4px);
}

/* ============================================
   MODERNA VEST KARTICA
   ============================================ */
.news-card-modern {
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.4s ease-out;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(0, 0, 0, 0.05);
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.news-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

/* Hero slika */
.news-hero-image {
    position: relative;
    width: 100%;
    height: 360px;
    overflow: hidden;
    background: linear-gradient(135deg, #2563eb 0%, #9333ea 100%);
    flex-shrink: 0;
}

.news-hero-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.5s ease-out;
    filter: brightness(0.92);
}

.news-card-modern:hover .news-hero-image img {
    transform: scale(1.08);
    filter: brightness(1);
}

.news-gradient-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 70%;
    background: linear-gradient(to top, rgba(17, 24, 39, 0.95) 0%, rgba(17, 24, 39, 0.3) 60%, transparent 100%);
    z-index: 1;
    pointer-events: none;
}

/* Kategorijska traka */
.news-category-ribbon {
    position: absolute;
    top: 24px;
    left: -8px;
    padding: 12px 24px 12px 16px;
    font-weight: 700;
    font-size: 0.85rem;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #ffffff;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.35);
    z-index: 10;
    clip-path: polygon(0 0, 100% 0, 95% 50%, 100% 100%, 0 100%);
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Sadržaj kartice */
.news-content-area {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 32px;
    z-index: 2;
    color: #ffffff;
}

.news-title-hero {
    font-size: 2rem;
    font-weight: 900;
    line-height: 1.2;
    margin-bottom: 12px;
    color: #ffffff;
    text-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.news-description-hero {
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 20px;
    color: #f1f5f9;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
    opacity: 0.95;
    max-height: 4.8em;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}

/* CTA dugme - Primarna boja */
.news-cta-button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 28px;
    color: #ffffff;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.95rem;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    text-decoration: none;
    box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.news-cta-button:hover {
    transform: translateX(8px);
    box-shadow: 0 12px 32px rgba(37, 99, 235, 0.6);
}

.news-cta-button i {
    transition: transform 0.3s ease;
}

.news-cta-button:hover i {
    transform: translateX(4px);
}

/* Meta footer */
.news-meta-footer {
    padding: 16px 24px;
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    border-top: 1px solid rgba(0, 0, 0, 0.06);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    margin-top: auto;
}

.news-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6b7280;
    font-size: 0.9rem;
    font-weight: 600;
}

.news-meta-item i {
    color: #9ca3af;
    font-size: 0.95rem;
}

/* ============================================
   RESPONSIVE DIZAJN
   ============================================ */
@media (max-width: 768px) {
    .fields-container {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .glass-card {
        margin-bottom: 1rem;
    }
    
    .card-action-link {
        font-size: 0.8125rem;
        padding: 0.75rem 1rem;
    }
    
    .news-hero-image {
        height: 280px;
    }
    
    .news-title-hero {
        font-size: 1.5rem;
    }
    
    .news-content-area {
        padding: 24px;
    }
    
    .news-cta-button {
        padding: 12px 24px;
        font-size: 0.875rem;
    }
}
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


    protected string $cardRender = <<<'HTML'

function cardRender(array $item, array $fieldLabels, string $locale): string
{
    // Sanitizacija podataka
    $naslov = htmlspecialchars(trim($item['fields']['naslov'][$locale] ?? ''), ENT_QUOTES, 'UTF-8');
    $opis = htmlspecialchars(trim($item['fields']['opis'][$locale] ?? ''), ENT_QUOTES, 'UTF-8');
    $opis = preg_replace('/\s+/', ' ', $opis);
    $datum = htmlspecialchars($item['fields']['datum'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $link = htmlspecialchars($item['fields']['link'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $autor = htmlspecialchars($item['fields']['autor'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = !empty($item['image']) ? htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') : null;
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $kategorija = htmlspecialchars($item['category']['content'] ?? '', ENT_QUOTES, 'UTF-8');

    // Kategorijske ikone
    $categoryIcons = [
        'Kultura' => 'fas fa-theater-masks',
        'Obrazovanje' => 'fas fa-graduation-cap',
        'Inovacije' => 'fas fa-lightbulb',
        'Zdravlje' => 'fas fa-heartbeat',
        'Tehnologija' => 'fas fa-microchip',
        'Култура' => 'fas fa-theater-masks',
        'Образовање' => 'fas fa-graduation-cap',
        'Иновације' => 'fas fa-lightbulb',
        'Здравље' => 'fas fa-heartbeat',
        'Технологија' => 'fas fa-microchip'
    ];

    // Kategorijske boje - koristi sekundarnu i akcent boju
    $categoryColors = [
        'Kultura' => ['from' => '#9333ea', 'to' => '#6b21a8'],      // secondary
        'Obrazovanje' => ['from' => '#2563eb', 'to' => '#1e40af'],  // primary
        'Inovacije' => ['from' => '#f59e0b', 'to' => '#d97706'],    // narandžasta
        'Zdravlje' => ['from' => '#14b8a6', 'to' => '#0d9488'],     // accent (tirkiz)
        'Tehnologija' => ['from' => '#8b5cf6', 'to' => '#7c3aed'],  // ljubičasta
        'Култура' => ['from' => '#9333ea', 'to' => '#6b21a8'],
        'Образовање' => ['from' => '#2563eb', 'to' => '#1e40af'],
        'Иновације' => ['from' => '#f59e0b', 'to' => '#d97706'],
        'Здравље' => ['from' => '#14b8a6', 'to' => '#0d9488'],
        'Технологија' => ['from' => '#8b5cf6', 'to' => '#7c3aed']
    ];

    $categoryIcon = $categoryIcons[$kategorija] ?? 'fas fa-newspaper';
    $categoryColor = $categoryColors[$kategorija] ?? ['from' => '#6b7280', 'to' => '#4b5563'];

    // Skraćivanje opisa
    $shortDescription = $opis;
    if (mb_strlen($opis) > 150) {
        $short = mb_substr($opis, 0, 147);
        $short .= '...';
        $shortDescription = $short;
    }

    // Generisanje HTML kartice
    $html = "<div class='news-card-modern'>";

    if ($imageUrl) {
        $html .= "
        <div class='news-hero-image'>
            <img src='{$imageUrl}' alt='{$naslov}'>
            <div class='news-gradient-overlay'></div>";
        
        // Kategorijska traka
        if ($kategorija) {
            $gradientStyle = "background: linear-gradient(135deg, {$categoryColor['from']} 0%, {$categoryColor['to']} 100%);";
            $html .= "
            <div class='news-category-ribbon' style='{$gradientStyle}'>
                <i class='{$categoryIcon}'></i>
                <span>{$kategorija}</span>
            </div>";
        }
        
        // Sadržaj preko slike
        $html .= "
            <div class='news-content-area'>
                <h3 class='news-title-hero'>{$naslov}</h3>";
        
        if ($shortDescription) {
            $html .= "<p class='news-description-hero'>{$shortDescription}</p>";
        }
        
        $targetLink = "/sadrzaj?id={$itemId}&tip=Vesti";
        $html .= "
                <a href='{$targetLink}' class='bg-primary news-cta-button hover:bg-primary_hover'>
                    <span>Pročitaj više</span>
                    <i class='fas fa-arrow-right'></i>
                </a>
            </div>
        </div>";
    }

    // Meta footer sa datumom i autorom
    if ($datum || $autor) {
        $html .= "<div class='news-meta-footer'>";
        
        if ($datum) {
            $html .= "
            <div class='news-meta-item'>
                <i class='fas fa-calendar-alt'></i>
                <span>{$datum}</span>
            </div>";
        }
        
        if ($autor) {
            $html .= "
            <div class='news-meta-item'>
                <i class='fas fa-user-edit'></i>
                <span>{$autor}</span>
            </div>";
        }
        
        $html .= "</div>";
    }

    $html .= "</div>";
    
    return $html;
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
            <i class='fas fa-chevron-left text-secondary_text'></i>
        </a>";
    }
    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);
    if ($start > 1) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
        $html .= "<a href='{$url}' class='px-4 py-2 rounded-xl font-medium bg-white/80 backdrop-blur-sm border border-white/30'>1</a>";
        if ($start > 2) $html .= "<span class='px-2 text-secondary_text'>...</span>";
    }
    for ($i = $start; $i <= $end; $i++) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
        $class = $i === $currentPage
            ? 'px-4 py-2 bg-primary text-white rounded-xl font-semibold shadow-md'
            : 'px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-white/30 hover:shadow font-medium';
        $html .= "<a href='{$url}' class='{$class}'>{$i}</a>";
    }
    if ($end < $totalPages) {
        if ($end < $totalPages - 1) $html .= "<span class='px-2 text-secondary_text'>...</span>";
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
        $html .= "<a href='{$url}' class='px-4 py-2 rounded-xl font-medium bg-white/80 backdrop-blur-sm border border-white/30'>{$totalPages}</a>";
    }
    if ($currentPage < $totalPages) {
        $nextUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
        $html .= "<a href='{$nextUrl}' class='px-4 py-2 rounded-xl hover:shadow font-medium bg-white/80 backdrop-blur-sm border border-white/30'>
            <i class='fas fa-chevron-right text-secondary_text'></i>
        </a>";
    }
    $html .= "</div>";
    return $html;
}
PHP;

    protected string $html = <<<'HTML'
<main class="bg-background pt-12 min-h-screen font-body text-secondary_text">
    <section class="container mx-auto px-4 py-12">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-primary_text font-heading mb-2">Vesti</h1>
            <p class="text-lg text-secondary_text">Istražite našu bogatu ponudu kulturnih događaja</p>
        </div>

        <?php echo renderTopbar($categories, $search, $categoryId, $texts); ?>

        <div class="performances-grid">
            <?php
            if (!empty($itemsList['success']) && !empty($itemsList['items'])) {
                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">';
                foreach ($itemsList['items'] as $item) {
                    echo cardRender($item, $fieldLabels, $locale);
                }
                echo '</div>';
                $totalPages = max(1, (int) ceil($itemsList['total'] / $itemsPerPage));
                echo renderPagination($currentPage, $totalPages, $paginationRange);
            } else {
                echo "<div class='glass-card rounded-lg p-12 text-center'>
                    <i class='fas fa-inbox text-5xl text-secondary'></i>
                    <p class='text-secondary_text mt-4'>{$texts['no_items_found']}</p>
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

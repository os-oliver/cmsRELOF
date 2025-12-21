<?php
namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;
use App\Controllers\LanguageMapperController;

class ProjektiPageBuilder extends BasePageBuilder
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
            'search_placeholder' => 'Pretraži projekte...',
            'apply_button' => 'Primeni',
            'all_categories' => 'Sve kategorije',
            'project_leader' => 'Vođa projekta',
            'budget' => 'Budžet',
            'start_date' => 'Datum početka',
            'project_details' => 'Detalji projekta',
            'no_items_found' => 'Nema pronađenih projekata',
            'view_more' => 'Saznaj više'
        ];

        // Convert to Cyrillic if needed
        if ($locale === 'sr-Cyrl') {
            $this->texts = $this->translator->latin_to_cyrillic_array($latinTexts);
        } else {
            $this->texts = $latinTexts;
        }
    }

    protected string $css = <<<CSS
/* ============================================
   GLAVNI LAYOUT
   ============================================ */
main {
    padding-top: 50px;
}

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
   PROJEKT KARTICE
   ============================================ */
.project-card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.project-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
}

.project-image-container {
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #2563eb 0%, #9333ea 100%);
}

.project-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.project-card:hover .project-image {
    transform: scale(1.05);
}

.project-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
}

.project-content {
    padding: 1.25rem;
}

.project-header {
    display: flex;
    align-items: start;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 0.75rem;
}

.project-title {
    font-size: 1rem;
    font-weight: 700;
    color: #111827;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.project-meta {
    margin-top: 0.375rem;
    font-size: 0.75rem;
    color: #6b7280;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.project-meta-item {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.project-budget {
    font-size: 0.875rem;
    font-weight: 700;
    color: #14b8a6;
    white-space: nowrap;
}

.project-description {
    font-size: 0.875rem;
    line-height: 1.5;
    color: #6b7280;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.project-link {
    font-size: 0.75rem;
    color: #2563eb;
    text-decoration: underline;
    word-break: break-all;
    margin-bottom: 1rem;
    display: block;
    transition: color 0.2s ease;
}

.project-link:hover {
    color: #1e40af;
}

/* CTA Dugme - Primary boja */
.project-cta {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    padding: 0.75rem 1.25rem;
    color: #ffffff;
    border-radius: 12px;
    font-size: 0.875rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    overflow: hidden;
}

.project-cta::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.project-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.4);
}

.project-cta:hover::before {
    left: 100%;
}

.project-cta i {
    transition: transform 0.3s ease;
}

.project-cta:hover i {
    transform: translateX(4px);
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
    
    .project-content {
        padding: 1rem;
    }
    
    .project-title {
        font-size: 0.9rem;
    }
    
    .project-meta {
        font-size: 0.7rem;
    }
}
CSS;

    protected string $topBar = <<<'PHP'
function renderTopbar(array $categories, string $searchValue = '', ?int $selectedCategoryId = null, array $texts = []): string
{
    $safeSearchValue = htmlspecialchars($searchValue, ENT_QUOTES, 'UTF-8');
    
    $html = "<form method='GET' action='' class='glass-search flex flex-col sm:flex-row items-center justify-between p-6 rounded-2xl shadow-lg mb-8 gap-4'>";
    
    // Pretraga i dugme
    $html .= "<div class='flex w-full sm:w-auto flex-1 gap-3'>
        <input type='text' 
               name='search' 
               value='{$safeSearchValue}' 
               placeholder='{$texts['search_placeholder']}' 
               class='w-full border border-gray-300 rounded-xl px-5 py-3 
                      focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent 
                      transition-all shadow-sm bg-white/80 backdrop-blur-sm
                      text-primary_text placeholder-secondary_text'>
        <button type='submit' 
                class='bg-primary hover:bg-primary_hover text-white px-6 py-3 
                       rounded-xl transition-all shadow-md hover:shadow-lg font-semibold'>
            {$texts['apply_button']}
        </button>
    </div>";
    
    // Kategorija select
    $html .= "<div class='flex items-center w-full sm:w-auto'>
        <select name='category' 
                class='w-full sm:w-64 border border-gray-300 rounded-xl px-5 py-3 
                       focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent 
                       transition-all shadow-sm bg-white/80 backdrop-blur-sm appearance-none cursor-pointer
                       text-primary_text'>
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
<div class="project-card">
    <!-- Slika projekta -->
    <div class="project-image-container" style="height: 200px;">
        {{imageSection}}
    </div>

    <!-- Sadržaj kartice -->
    <div class="project-content">
        <!-- Zaglavlje: naziv + budžet -->
        <div class="project-header">
            <div class="flex-1 min-w-0">
                <h3 class="project-title">{{naziv}}</h3>
                <div class="project-meta">
                    <span class="project-meta-item">
                        <i class="fas fa-user-tie text-secondary"></i>
                        <span>{{vodja}}</span>
                    </span>
                    <span aria-hidden="true">•</span>
                    <span class="project-meta-item">
                        <i class="fas fa-calendar-alt text-accent"></i>
                        <span>{{datumPocetka}}</span>
                    </span>
                </div>
            </div>
            <div class="project-budget">{{budzet}}</div>
        </div>

        <!-- Opis -->
        <p class="project-description">{{opis}}</p>

        <!-- Link (ako postoji) -->
        {{clickableLink}}

        <!-- CTA dugme -->
        <a href="sadrzaj?id={{itemId}}&tip=generic_element" class="bg-primary project-cta hover:bg-primary_hover">
            <i class="fas fa-info-circle"></i>
            <span>{{projectDetails}}</span>
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</div>
PHP;
HTML;

    protected string $cardRender = <<<'HTML'
function cardRender(array $item, array $fieldLabels, string $locale, array $texts = [], int $descMaxLength = 120, $cardTemplate=''): string
{
    // Osnovni podaci
    $naziv = htmlspecialchars($item['fields']['naziv'][$locale] ?? $item['fields']['naziv'] ?? '', ENT_QUOTES, 'UTF-8');
    $vodja = htmlspecialchars($item['fields']['vodja'][$locale] ?? $item['fields']['vodja'] ?? '', ENT_QUOTES, 'UTF-8');
    $rawOpis = $item['fields']['opis'][$locale] ?? $item['fields']['opis'] ?? '';
    $opis = htmlspecialchars(mb_substr((string)$rawOpis, 0, $descMaxLength), ENT_QUOTES, 'UTF-8');
    if (mb_strlen($rawOpis) > $descMaxLength) {
        $opis .= '...';
    }
    
    $rawDatumPocetka = $item['fields']['datumPocetka'][$locale] ?? $item['fields']['datumPocetka'] ?? '';
    $formattedStart = '';
    if ($rawDatumPocetka) {
        $formats = ['Y-m-d', 'Y-m-d H:i:s', 'd/m/Y', 'd.m.Y'];
        foreach ($formats as $fmt) {
            $dt = \DateTime::createFromFormat($fmt, $rawDatumPocetka);
            if ($dt instanceof \DateTime) {
                $formattedStart = $dt->format('d/m/Y');
                break;
            }
        }
        if ($formattedStart === '' && strtotime($rawDatumPocetka) !== false) {
            $formattedStart = date('d/m/Y', strtotime($rawDatumPocetka));
        }
    }
    $datumPocetka = htmlspecialchars($formattedStart, ENT_QUOTES, 'UTF-8');
    $budzet = htmlspecialchars((string)($item['fields']['budzet'][$locale] ?? $item['fields']['budzet'] ?? ''), ENT_QUOTES, 'UTF-8');
    $linkRaw = $item['fields']['link'][$locale] ?? $item['fields']['link'] ?? '';
    $linkEsc = htmlspecialchars((string)$linkRaw, ENT_QUOTES, 'UTF-8');
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');

    // Rezolucija slike
    $imageUrl = '';
    if (!empty($item['fields']['slika'])) {
        $slika = $item['fields']['slika'];
        if (is_array($slika)) {
            if (isset($slika[0]) && is_array($slika[0]) && !empty($slika[0]['url'])) {
                $imageUrl = $slika[0]['url'];
            } elseif (!empty($slika['url'])) {
                $imageUrl = $slika['url'];
            } elseif (!empty($slika[0]) && is_string($slika[0])) {
                $imageUrl = $slika[0];
            }
        } elseif (is_string($slika)) {
            $imageUrl = $slika;
        }
    } elseif (!empty($item['image'])) {
        $imageUrl = $item['image'];
    }

    $imageUrl = htmlspecialchars((string)$imageUrl, ENT_QUOTES, 'UTF-8');

    // Sekcija slike
    $imageSection = $imageUrl
        ? "<img src='{$imageUrl}' alt='Slika projekta' loading='lazy' class='project-image'>"
        : "<div class='project-placeholder'>
                <div class='bg-secondary_background rounded-full p-4 inline-block'>
                    <i class='fas fa-project-diagram text-4xl text-secondary_text'></i>
                </div>
           </div>";

    // Klikabilan link (ako postoji)
    $clickableLink = $linkEsc !== ''
        ? "<a href='{$linkEsc}' target='_blank' rel='noopener noreferrer' class='project-link'>
               <i class='fas fa-external-link-alt'></i> {$linkEsc}
           </a>"
        : "";

    // Zamene za placeholdere
    $replacements = [
        '{{naziv}}' => $naziv,
        '{{vodja}}' => $vodja,
        '{{opis}}' => $opis,
        '{{datumPocetka}}' => $datumPocetka,
        '{{budzet}}' => $budzet,
        '{{clickableLink}}' => $clickableLink,
        '{{imageSection}}' => $imageSection,
        '{{itemId}}' => $itemId,
        '{{projectDetails}}' => htmlspecialchars($texts['project_details'] ?? 'Detalji projekta', ENT_QUOTES, 'UTF-8'),
    ];

    return str_replace(array_keys($replacements), array_values($replacements), $cardTemplate);
}
HTML;

    protected string $pagination = <<<'PHP'
function renderPagination(int $currentPage, int $totalPages, int $range = 2): string
{
    if ($totalPages <= 1) return '';
    
    $html = "<div class='flex justify-center items-center gap-2 mt-10'>";
    
    // Prethodna strana
    if ($currentPage > 1) {
        $prevUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage - 1]));
        $html .= "<a href='{$prevUrl}' 
                   class='px-4 py-2 bg-surface border border-gray-300 rounded-xl
                          hover:bg-secondary_background hover:border-primary
                          transition-all shadow-sm hover:shadow text-secondary_text'>
            <i class='fas fa-chevron-left'></i>
        </a>";
    }
    
    $start = max(1, $currentPage - $range);
    $end = min($totalPages, $currentPage + $range);
    
    // Prva strana + trotačka
    if ($start > 1) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
        $html .= "<a href='{$url}' 
                   class='px-4 py-2 bg-surface border border-gray-300 rounded-xl
                          hover:bg-secondary_background hover:border-primary
                          transition-all shadow-sm hover:shadow font-medium text-primary_text'>1</a>";
        if ($start > 2) {
            $html .= "<span class='px-2 text-secondary_text'>...</span>";
        }
    }
    
    // Brojevi stranica
    for ($i = $start; $i <= $end; $i++) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
        $class = $i === $currentPage 
            ? 'px-4 py-2 bg-primary text-white rounded-xl font-semibold shadow-md' 
            : 'px-4 py-2 bg-surface border border-gray-300 rounded-xl hover:bg-secondary_background hover:border-primary transition-all shadow-sm hover:shadow font-medium text-primary_text';
        $html .= "<a href='{$url}' class='{$class}'>{$i}</a>";
    }
    
    // Poslednja strana + trotačka
    if ($end < $totalPages) {
        if ($end < $totalPages - 1) {
            $html .= "<span class='px-2 text-secondary_text'>...</span>";
        }
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
        $html .= "<a href='{$url}' 
                   class='px-4 py-2 bg-surface border border-gray-300 rounded-xl
                          hover:bg-secondary_background hover:border-primary
                          transition-all shadow-sm hover:shadow font-medium text-primary_text'>{$totalPages}</a>";
    }
    
    // Sledeća strana
    if ($currentPage < $totalPages) {
        $nextUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
        $html .= "<a href='{$nextUrl}' 
                   class='px-4 py-2 bg-surface border border-gray-300 rounded-xl
                          hover:bg-secondary_background hover:border-primary
                          transition-all shadow-sm hover:shadow text-secondary_text'>
            <i class='fas fa-chevron-right'></i>
        </a>";
    }
    
    $html .= "</div>";
    
    return $html;
}
PHP;

    protected string $html = <<<'HTML'
<main class="bg-background min-h-screen">
    <section class="container mx-auto px-4 py-12">
        <!-- Zaglavlje -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold font-heading text-primary_text mb-2">Projekti</h1>
            <p class="text-lg text-secondary_text">Istražite naše aktuelne i završene projekte</p>
        </div>
        
        <!-- Pretraga i filteri -->
        <?php echo renderTopbar($categories, $search, $categoryId, $texts); ?>
        
        <!-- Grid sa projektima -->
        <div class="performances-grid">
            <?php
            if ($itemsList['success'] && !empty($itemsList['items'])) {
                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">';
                foreach ($itemsList['items'] as $item) {
                    echo cardRender($item, $fieldLabels, $locale, $texts, $descriptionMaxLength, $cardTemplate);
                }
                echo '</div>';
                
                // Paginacija
                $totalPages = ceil($itemsList['total'] / $itemsPerPage);
                echo renderPagination($currentPage, $totalPages, $paginationRange);
            } else {
                echo "<div class='glass-card rounded-lg p-12 text-center border border-white/40'>
                    <i class='fas fa-folder-open text-5xl text-secondary_text mb-4'></i>
                    <p class='text-secondary_text text-lg'>{$texts['no_items_found']}</p>
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
$pageDescription = 'Pregled svih projekata';

// Configuration variables
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
    'search_placeholder' => 'Pretraži projekte...',
    'apply_button' => 'Primeni',
    'all_categories' => 'Sve kategorije',
    'project_leader' => 'Vođa projekta',
    'budget' => 'Budžet',
    'start_date' => 'Datum početka',
    'project_details' => 'Detalji projekta',
    'no_items_found' => 'Nema pronađenih projekata',
    'view_more' => 'Saznaj više'
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

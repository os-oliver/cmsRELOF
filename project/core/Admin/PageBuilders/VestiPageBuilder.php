<?php

namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;

class VestiPageBuilder extends BasePageBuilder
{
    protected string $slug;

    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }

    protected string $css = <<<CSS
.dropdown:hover .dropdown-menu {
    display: block;
}
.dropdown-menu {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 200px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.1);
    z-index: 1;
    border-radius: 8px;
    overflow: hidden;
}

/* Enhanced Glassmorphism effect */
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

.category-chip {
    display: inline-flex;
    align-items: center;
    padding: 0.375rem 0.875rem;
    background: rgba(107, 114, 128, 0.9);
    backdrop-filter: blur(10px);
    color: white;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.025em;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

/* Improved field layout */
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
    background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.05) 100%);
}

/* Enhanced Action Link Styling */
.card-action-link {
    position: relative;
    display: block;
    width: 100%;
    text-align: center;
    background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
    color: white;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 600;
    padding: 0.875rem 1.25rem;
    border-radius: 0.75rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
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
    background: linear-gradient(135deg, #111827 0%, #000000 100%);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.card-action-link:hover::before {
    left: 100%;
}

.card-action-link:active {
    transform: translateY(0);
    box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.1);
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

/* Responsive adjustments */
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
}
CSS;

    protected string $functions = <<<'PHP'
function renderTopbar(array $categories, string $searchValue = '', ?int $selectedCategoryId = null): string
{
    $safeSearchValue = htmlspecialchars($searchValue, ENT_QUOTES, 'UTF-8');
    $html = "<form method='GET' action='' class='glass-search flex flex-col sm:flex-row items-center justify-between p-6 rounded-2xl shadow-lg mb-8 gap-4'>";
    $html .= "<div class='flex w-full sm:w-auto flex-1 gap-3'>
            <input type='text' name='search' value='{$safeSearchValue}' placeholder='Pretraži...' 
                class='w-full border border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition-all shadow-sm bg-white/80 backdrop-blur-sm'>
            <button type='submit' class='bg-gray-800 hover:bg-gray-900 text-white px-6 py-3 rounded-xl transition-all shadow-md hover:shadow-lg font-medium'>
                Primeni
            </button>
          </div>";
    $html .= "<div class='flex items-center w-full sm:w-auto'>
            <select name='category' class='w-full sm:w-64 border border-gray-300 rounded-xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent transition-all shadow-sm bg-white/80 backdrop-blur-sm appearance-none cursor-pointer'>
                <option value=''>Sve kategorije</option>";
    foreach ($categories as $cat) {
        $id = htmlspecialchars($cat['id'], ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars($cat['name'], ENT_QUOTES, 'UTF-8');
        $selected = ($selectedCategoryId == $cat['id']) ? 'selected' : '';
        $html .= "<option value='{$id}' {$selected}>{$name}</option>";
    }
    $html .= "</select></div></form>";
    return $html;
}

function cardRender(array $item, array $fieldLabels, string $locale): string
{
    $naslov = htmlspecialchars(trim($item['fields']['naslov'][$locale] ?? ''), ENT_QUOTES, 'UTF-8');
    $opis = htmlspecialchars(trim($item['fields']['opis'][$locale] ?? ''), ENT_QUOTES, 'UTF-8');
    $opis = preg_replace('/\s+/', ' ', $opis); // uklanja višestruke whitespace-ove
    $datum = htmlspecialchars($item['fields']['datum'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $link = htmlspecialchars($item['fields']['link'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $autor = htmlspecialchars($item['fields']['autor'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = !empty($item['image']) ? htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') : null;
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $kategorija = htmlspecialchars($item['category']['content'] ?? '', ENT_QUOTES, 'UTF-8');

    $categoryIcons = [
    'Kultura' => 'fas fa-theater-masks',
    'Obrazovanje' => 'fas fa-graduation-cap',
    'Inovacije' => 'fas fa-lightbulb',
    'Zdravlje' => 'fas fa-heartbeat',
    'Tehnologija' => 'fas fa-microchip',
    // Ćirilica
    'Култура' => 'fas fa-theater-masks',
    'Образовање' => 'fas fa-graduation-cap',
    'Иновације' => 'fas fa-lightbulb',
    'Здравље' => 'fas fa-heartbeat',
    'Технологија' => 'fas fa-microchip'
];

$categoryColors = [
    'Kultura' => ['from' => '#ec4899', 'to' => '#db2777'],
    'Obrazovanje' => ['from' => '#3b82f6', 'to' => '#2563eb'],
    'Inovacije' => ['from' => '#f59e0b', 'to' => '#d97706'],
    'Zdravlje' => ['from' => '#10b981', 'to' => '#059669'],
    'Tehnologija' => ['from' => '#8b5cf6', 'to' => '#7c3aed'],
    // Ćirilica
    'Култура' => ['from' => '#ec4899', 'to' => '#db2777'],
    'Образовање' => ['from' => '#3b82f6', 'to' => '#2563eb'],
    'Иновације' => ['from' => '#f59e0b', 'to' => '#d97706'],
    'Здравље' => ['from' => '#10b981', 'to' => '#059669'],
    'Технологија' => ['from' => '#8b5cf6', 'to' => '#7c3aed']
];

// Dobijanje ikone i boje
$categoryIcon = $categoryIcons[$kategorija] ?? 'fas fa-newspaper';
$categoryColor = $categoryColors[$kategorija] ?? ['from' => '#9ca3af', 'to' => '#6b7280']; // default sivo

    // Skraćivanje opisa na max 150 karaktera
    $shortDescription = $opis;
   if (mb_strlen($opis) > 20) {
    $short = mb_substr($opis, 0, 20);
    // Dodaj trotačku
        $short .= '...';
    } else {
        $short = $opis;
    }

    // Podeli tekst u dve linije po ~75 karaktera
    $shortDescription = wordwrap($short, 20, "\n");

    $html = "
    <style>
    .news-card-modern {
        background: white;
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
    .news-hero-image {
        position: relative;
        width: 100%;
        height: 360px;
        overflow: hidden;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.3) 60%, transparent 100%);
        z-index: 1;
        pointer-events: none;
    }
    .news-category-ribbon {
        position: absolute;
        top: 24px;
        left: -8px;
        padding: 12px 24px 12px 16px;
        font-weight: 700;
        font-size: 0.85rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: white;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.35);
        z-index: 10;
        clip-path: polygon(0 0, 100% 0, 95% 50%, 100% 100%, 0 100%);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .news-content-area {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 32px;
        z-index: 2;
        color: white;
    }
    .news-title-hero {
        font-size: 2rem;
        font-weight: 900;
        line-height: 1.2;
        margin-bottom: 12px;
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
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        opacity: 0.95;
        max-height: 4.8em; /* Ograničenje visine da kartica ne puca */
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
    .news-cta-button {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 28px;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-decoration: none;
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.4);
        border: 2px solid rgba(255, 255, 255, 0.3);
    }
    .news-cta-button:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        transform: translateX(8px);
        box-shadow: 0 12px 32px rgba(59, 130, 246, 0.6);
    }
    .news-cta-button i {
        transition: transform 0.3s ease;
    }
    .news-cta-button:hover i {
        transform: translateX(4px);
    }
    .news-meta-footer {
        padding: 16px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
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
        color: #64748b;
        font-size: 0.9rem;
        font-weight: 600;
    }
    .news-meta-item i {
        color: #94a3b8;
        font-size: 0.95rem;
    }
    </style>
    
    <div class='news-card-modern'>";

    if ($imageUrl) {
        $html .= "
        <div class='news-hero-image'>
            <img src='{$imageUrl}' alt='{$naslov}'>
            <div class='news-gradient-overlay'></div>";
        
        if ($kategorija) {
            $gradientStyle = "background: linear-gradient(135deg, {$categoryColor['from']} 0%, {$categoryColor['to']} 100%);";
            $html .= "
            <div class='news-category-ribbon' style='{$gradientStyle}'>
                <i class='{$categoryIcon}'></i>
                <span>{$kategorija}</span>
            </div>";
        }
        
        $html .= "
            <div class='news-content-area'>
                <h3 class='news-title-hero'>{$naslov}</h3>";
        
        if ($shortDescription) {
            $html .= "<p class='news-description-hero'>{$shortDescription}</p>";
        }
        
        $targetLink = "sadrzaj?id={$itemId}&tip=Vesti";
        $html .= "
                <a href='{$targetLink}' class='news-cta-button'>
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

function renderPagination(int $currentPage, int $totalPages): string
{
    if ($totalPages <= 1) return '';
    
    $html = "<div class='flex justify-center items-center gap-2 mt-10'>";
    
    if ($currentPage > 1) {
        $prevUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage - 1]));
        $html .= "<a href='{$prevUrl}' class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm hover:shadow'>
                    <i class='fas fa-chevron-left text-gray-600'></i>
                  </a>";
    }
    
    $start = max(1, $currentPage - 2);
    $end = min($totalPages, $currentPage + 2);
    
    if ($start > 1) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
        $html .= "<a href='{$url}' class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm hover:shadow font-medium'>1</a>";
        if ($start > 2) $html .= "<span class='px-2 text-gray-400'>...</span>";
    }
    
    for ($i = $start; $i <= $end; $i++) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
        $class = $i === $currentPage 
            ? 'px-4 py-2 bg-gray-800 text-white rounded-xl font-semibold shadow-md' 
            : 'px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm hover:shadow font-medium';
        $html .= "<a href='{$url}' class='{$class}'>{$i}</a>";
    }
    
    if ($end < $totalPages) {
        if ($end < $totalPages - 1) $html .= "<span class='px-2 text-gray-400'>...</span>";
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
        $html .= "<a href='{$url}' class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm hover:shadow font-medium'>{$totalPages}</a>";
    }
    
    if ($currentPage < $totalPages) {
        $nextUrl = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
        $html .= "<a href='{$nextUrl}' class='px-4 py-2 bg-white/80 backdrop-blur-sm rounded-xl border border-gray-300 hover:bg-white hover:border-gray-400 transition-all shadow-sm hover:shadow'>
                    <i class='fas fa-chevron-right text-gray-600'></i>
                  </a>";
    }
    
    $html .= "</div>";
    return $html;
}
PHP;

    protected string $html = <<<'HTML'
<main class="bg-gradient-to-br pt-20 from-gray-50 to-gray-100 min-h-screen">
    <section class="container mx-auto px-4 py-12">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2"><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></h1>
            <p class="text-gray-600"><?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        
        <?php echo renderTopbar($categories, $search, $categoryId); ?>

        <div class="performances-grid">
            <?php
            if ($itemsList['success'] && !empty($itemsList['items'])) {
                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">';
                foreach ($itemsList['items'] as $item) {
                    echo cardRender($item, $fieldLabels, $locale);
                }
                echo '</div>';
                
                $totalPages = ceil($itemsList['total'] / $itemsPerPage);
                echo renderPagination($currentPage, $totalPages);
            } else {
                echo "<div class='glass-card rounded-lg p-12 text-center border border-white/40'>
                        <i class='fas fa-inbox text-5xl text-gray-400 mb-4'></i>
                        <p class='text-gray-500'>Nema pronađenih stavki</p>
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
        use App\Models\GenericCategory;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
        $slug = '__SLUG__';
        $pageTitle = ucfirst($slug);
        $pageDescription = 'Pregled svih stavki';
        
        $itemsPerPage = 6;
        $currentPage = max(1, (int) ($_GET['page'] ?? 1));
        $categoryId = isset($_GET['category']) && is_numeric($_GET['category']) ? (int) $_GET['category'] : null;
        $search = $_GET['search'] ?? '';
        
        $categories = GenericCategory::fetchAll($slug, $locale);
        $itemsList = $slug ? (new Content())->fetchListData($slug, $search, $currentPage, $itemsPerPage, $categoryId, $locale)
                           : ['success' => false, 'items' => []];
        
        $config = $fieldLabels = [];
        if ($slug && file_exists($structurePath = __DIR__ . '/../../assets/data/structure.json')) {
            $parsed = json_decode(file_get_contents($structurePath), true);
            $config = $parsed[0][$slug] ?? [];
            $fieldLabels = array_column($config['fields'] ?? [], null, 'name');
        }
        PHP;

        $additionalPHP .= "\n" . $this->functions;
        $additionalPHP = str_replace('{{SLUG}}', $this->slug, $additionalPHP);
        $additionalPHP = str_replace('__SLUG__', addslashes($this->slug), $additionalPHP);

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
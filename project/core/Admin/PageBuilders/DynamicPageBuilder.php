<?php

namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;

class DynamicPageBuilder extends BasePageBuilder
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

/* Responsive adjustments */
@media (max-width: 768px) {
    .fields-container {
        grid-template-columns: 1fr;
        gap: 0.5rem;
    }
    
    .glass-card {
        margin-bottom: 1rem;
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
    $fields = [];
    
    // Add category as a chip if exists
    $categoryHtml = '';
    if (!empty($item['category'])) {
        $catValue = htmlspecialchars($item['category']['content'] ?? '', ENT_QUOTES, 'UTF-8');
        if ($catValue) {
            $categoryHtml = "<div class='absolute top-3 right-3 z-10'>
                                <span class='category-chip'>{$catValue}</span>
                            </div>";
        }
    }
    
    // Process fields - exclude file type fields
    foreach ($item['fields'] as $fieldName => $translations) {
        if (($fieldLabels[$fieldName]['type'] ?? '') === 'file') continue;
        
        $label = $fieldLabels[$fieldName]['label'][$locale] ?? $fieldLabels[$fieldName]['label']['en'] ?? $fieldName;
        $value = (string) ($translations[$locale] ?? reset($translations) ?? '');
        
        if (!empty(trim($value))) {
            $displayValue = mb_strlen($value) > 100 ? mb_substr($value, 0, 100) . '...' : $value;
            $fields[] = [
                'label' => htmlspecialchars($label, ENT_QUOTES, 'UTF-8'),
                'value' => htmlspecialchars($displayValue, ENT_QUOTES, 'UTF-8')
            ];
        }
    }
    
    $imageUrl = !empty($item['image']) ? htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') : null;
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    
    $html = "<div class='glass-card rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-1'>";
    
    // Image section with overlay
    if ($imageUrl) {
        $html .= "<div class='relative w-full h-48 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200'>
                    <img src='{$imageUrl}' class='w-full h-full object-cover transition-transform duration-300 group-hover:scale-105' alt='Item image'>
                    <div class='card-image-overlay'></div>
                    {$categoryHtml}
                </div>";
    } else if ($categoryHtml) {
        $html .= "<div class='relative h-12 bg-gradient-to-r from-gray-100 to-gray-200'>{$categoryHtml}</div>";
    }
    
    // Content section
    $html .= "<div class='p-5'>";
    
    if (!empty($fields)) {
        $html .= "<div class='fields-container'>";
        foreach ($fields as $f) {
            $html .= "<div class='card-field'>
                        <div class='text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5'>{$f['label']}</div>
                        <div class='text-sm text-gray-800 font-medium leading-relaxed'>{$f['value']}</div>
                    </div>";
        }
        $html .= "</div>";
    }
    
    // Action button
    $html .= "<a href='sadrzaj?id={$itemId}&tip={{SLUG}}' 
                class='block w-full text-center bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold py-3 px-4 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg backdrop-blur-sm'>
                <span class='flex items-center justify-center gap-2'>
                    <span>Saznaj više</span>
                    <svg class='w-4 h-4 transition-transform group-hover:translate-x-1' fill='none' stroke='currentColor' viewBox='0 0 24 24'>
                        <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 5l7 7-7 7'/>
                    </svg>
                </span>
              </a>";
    
    $html .= "</div>";
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
<main class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
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
        
        $itemsPerPage = 3;
        $currentPage = max(1, (int) ($_GET['page'] ?? 1));
        $categoryId = isset($_GET['category']) && is_numeric($_GET['category']) ? (int) $_GET['category'] : null;
        $search = $_GET['search'] ?? '';
        
        $categories = GenericCategory::fetchAll($slug, $locale);
        $itemsList = $slug ? (new Content())->fetchListData($slug, $search, $currentPage, $itemsPerPage, $categoryId)
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
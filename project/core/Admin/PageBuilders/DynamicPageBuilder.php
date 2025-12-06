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

    // Process fields - exclude file type fields and detect links
    foreach ($item['fields'] as $fieldName => $translations) {
        if (($fieldLabels[$fieldName]['type'] ?? '') === 'file')
            continue;

        $label = $fieldLabels[$fieldName]['label'][$locale] ?? $fieldLabels[$fieldName]['label']['sr-Cyrl'] ?? $fieldName;
        $value = (string) ($translations[$locale] ?? reset($translations) ?? '');

        if (!empty(trim($value))) {
            // Check if value is a URL
            $isLink = filter_var($value, FILTER_VALIDATE_URL) !== false;
            
            $displayValue = mb_strlen($value) > 100 ? mb_substr($value, 0, 100) . '...' : $value;
            $fields[] = [
                'label' => htmlspecialchars($label, ENT_QUOTES, 'UTF-8'),
                'value' => htmlspecialchars($displayValue, ENT_QUOTES, 'UTF-8'),
                'rawValue' => htmlspecialchars($value, ENT_QUOTES, 'UTF-8'),
                'isLink' => $isLink
            ];
        }
    }

    $imageUrl = !empty($item['image']) ? htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') : null;
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');
    $fieldCount = count($fields);
                                $translator = new LanguageMapperController();

    $html = "<div class='glass-card rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group transform hover:-translate-y-1'>";
    $vise = ($locale === 'sr-Cyrl') 
                ? $translator->latin_to_cyrillic('Saznaj više') 
                : 'Saznaj više';
    // Image section with overlay
    if ($imageUrl) {
        $html .= "<div class='relative w-full h-48 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200'>
                    <img src='{$imageUrl}' class='w-full h-full object-cover transition-transform duration-300 group-hover:scale-105' alt='Item image' loading='lazy'>
                    <div class='card-image-overlay'></div>
                    {$categoryHtml}
                </div>";
    } else if ($categoryHtml) {
        $html .= "<div class='relative h-12 bg-gradient-to-r from-gray-100 to-gray-200'>{$categoryHtml}</div>";
    }

    // Content section
    $html .= "<div class='p-5'>";

    if (!empty($fields)) {
        // Determine grid layout: 2 columns for even count, auto for odd (last takes full width)
        $gridClass = $fieldCount % 2 === 0 ? 'grid grid-cols-1 md:grid-cols-2 gap-4' : 'grid grid-cols-1 md:grid-cols-2 gap-4';
        
        $html .= "<div class='{$gridClass}'>";
        
        foreach ($fields as $index => $f) {
            // If odd count and this is the last field, make it span full width
            $spanClass = ($fieldCount % 2 !== 0 && $index === $fieldCount - 1) ? 'md:col-span-2' : '';
            
            $html .= "<div class='card-field {$spanClass}'>
                        <div class='text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5'>{$f['label']}</div>";
            
            if ($f['isLink']) {
                // Render as a clickable link with icon
                $html .= "<a href='{$f['rawValue']}' target='_blank' rel='noopener noreferrer' 
                            class='inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-800 font-medium leading-relaxed transition-colors duration-200 hover:underline'>
                            <span>{$f['value']}</span>
                            <svg class='w-4 h-4 flex-shrink-0' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
                                <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14'></path>
                            </svg>
                          </a>";
            } else {
                // Regular text field
                $html .= "<div class='text-sm text-gray-800 font-medium leading-relaxed'>{$f['value']}</div>";
            }
            
            $html .= "</div>";
        }
        $html .= "</div>";
    }

    // Enhanced action link
    $html .= "<a href='/sadrzaj?id={$itemId}&tip={{SLUG}}' class='card-action-link mt-5'>
                <span class='link-content'>
                <span>{$vise}</span>
                    <svg class='link-icon' fill='none' stroke='currentColor' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
                        <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 5l7 7-7 7'></path>
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

function renderPerPageDropdown(int $currentItemsPerPage): string
{
    $perPageOptions = [9, 15, 30];

    if (!in_array($currentItemsPerPage, $perPageOptions)) {
        $currentItemsPerPage = $perPageOptions[1]; 
    }
 
    $html = '<select name="per_page" id="per_page" onchange="document.getElementById(\'perPageForm\').submit();">';

    foreach ($perPageOptions as $option) {
        $selected = ($currentItemsPerPage === $option) ? 'selected' : '';
        $html .= "<option value=\"{$option}\" {$selected}>{$option}</option>";
    }

    $html .= '</select>';

    foreach ($_GET as $key => $value) {
        if ($key === 'per_page' || $key === 'page') continue;

        if (is_array($value)) {
            foreach ($value as $v) {
                $html .= '<input type="hidden" name="'.htmlspecialchars($key).'[]" value="'.htmlspecialchars($v).'">';
            }
        } else {
            $html .= '<input type="hidden" name="'.htmlspecialchars($key).'" value="'.htmlspecialchars($value).'">';
        }
    }
    
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
        
        <?php echo renderTopbar($categories, $search, $categoryId, $texts); ?>

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
        <form method="GET" id="perPageForm" class="inline-block mb-5 font-body">
            <label for="per_page">Broj stavki po stranici:</label>
            <?php echo renderPerPageDropdown($itemsPerPage) ?>
        </form>
    </section>
</main>
HTML;

    public function buildPage(): string
    {
        $additionalPHP = <<<'PHP'
        use App\Controllers\LanguageMapperController;

            use App\Models\Content;
            use App\Models\GenericCategory;

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
                            $translator = new LanguageMapperController();

            $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
            $slug = '__SLUG__';
            
            $pageTitle = ($locale === 'sr-Cyrl') 
                ? $translator->latin_to_cyrillic(ucfirst($slug)) 
                : ucfirst($slug);

            $pageDescription = ($locale === 'sr-Cyrl') 
                ? $translator->latin_to_cyrillic('Pregled svih stavki') 
                : 'Pregled svih stavki';

         
            $itemsPerPage = 15;
            if (isset($_GET['per_page']) && is_numeric($_GET['per_page'])) {
                $itemsPerPage = (int)$_GET['per_page'];
            }
            $currentPage = max(1, (int) ($_GET['page'] ?? 1));
            $categoryId = isset($_GET['category']) && $_GET['category'] !== ''
        ? (is_numeric($_GET['category']) 
            ? (int) $_GET['category'] 
            : trim((string) $_GET['category'])
        )
        : null;
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
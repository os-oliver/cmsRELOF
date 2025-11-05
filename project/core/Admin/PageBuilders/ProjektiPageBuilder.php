<?php

namespace App\Admin\PageBuilders;

use App\Controllers\ContentController;

class ProjektiPageBuilder extends BasePageBuilder
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
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
    overflow: hidden;
}

.card-action-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent,
                rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.card-action-link:hover {
    background: linear-gradient(135deg, #111827 0%, #000000 100%);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2),
                0 4px 6px -2px rgba(0, 0, 0, 0.1);
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
function cardRender(array $item, array $fieldLabels, string $locale): string
{
    $naslov = htmlspecialchars(trim($item['fields']['naziv'][$locale] ?? ''), ENT_QUOTES, 'UTF-8');
    $opis = htmlspecialchars(trim($item['fields']['opis'][$locale] ?? ''), ENT_QUOTES, 'UTF-8');
    $datum = htmlspecialchars($item['fields']['datum'][$locale] ?? '', ENT_QUOTES, 'UTF-8');
    $imageUrl = !empty($item['image']) ? htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') : null;
    $itemId = htmlspecialchars($item['id'] ?? '', ENT_QUOTES, 'UTF-8');

    $shortDescription = $opis;
    if (mb_strlen($opis) > 20) {
        $shortDescription = mb_substr($opis, 0, 20) . '...';
    }

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
    }
    .news-description-hero {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 20px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        opacity: 0.95;
    }
    .news-cta-button {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 28px;
        background: linear-gradient(135deg, #e9a803ff 0%, #e0a204ff 100%);
        color: white;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-decoration: none;
        box-shadow: 0 8px 24px #d39802ff;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }
    .news-cta-button:hover {
        background: #d39802ff;
        transform: translateX(8px);
        box-shadow: 0 12px 32px #2a644aff;
    }
    </style>
    
    <div class='news-card-modern'>";
    
    if ($imageUrl) {
        $html .= "
        <div class='news-hero-image'>
            <img src='{$imageUrl}' alt='{$naslov}'>
            <div class='news-gradient-overlay'></div>
            <div class='news-content-area'>
                <h3 class='news-title-hero'>{$naslov}</h3>
                <p class='news-description-hero'>{$shortDescription}</p>
                <a href='/sadrzaj?id={$itemId}&tip=Projekti' class='news-cta-button'>
                    <span>Pročitaj više</span>
                    <i class='fas fa-arrow-right'></i>
                </a>
            </div>
        </div>";
    }
    
    if ($datum) {
        $html .= "<div class='news-meta-footer'>
            <div class='news-meta-item'>
                <i class='fas fa-calendar-alt'></i>
                <span>{$datum}</span>
            </div>
        </div>";
    }
    
    $html .= "</div>";
    return $html;
}
PHP;

    protected string $html = <<<'HTML'
<main class="bg-gradient-to-br pt-20 from-gray-50 to-gray-100 min-h-screen">
    <section class="container mx-auto px-4 py-12">
        <div class="mb-8">
            <h1 class="text-3xl text-primary_text font-heading mb-2 text-center"><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></h1>
            <p class="text-secondary_text font-body text-center"><?php echo htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>

        <div class="performances-grid">
            <?php
            if ($itemsList['success'] && !empty($itemsList['items'])) {
                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">';
                foreach ($itemsList['items'] as $item) {
                    echo cardRender($item, $fieldLabels, $locale);
                }
                echo '</div>';
            } else {
                echo "<div class='glass-card rounded-lg p-12 text-center border border-white/40'>
                        <i class='fas fa-inbox text-5xl text-gray-400 mb-4'></i>
                        <p class='text-gray-500'>Nema pronađenih projekata</p>
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
        $pageTitle = 'Projekti';
        $pageDescription = 'Pregled svih projekata';

        $itemsPerPage = 6;
        $currentPage = max(1, (int) ($_GET['page'] ?? 1));
        $search = $_GET['search'] ?? '';
        
        $itemsList = (new Content())->fetchListData($slug, $search, $currentPage, $itemsPerPage, null, $locale);

        $config = $fieldLabels = [];
        if ($slug && file_exists($structurePath = __DIR__ . '/../../assets/data/structure.json')) {
            $parsed = json_decode(file_get_contents($structurePath), true);
            $config = $parsed[0][$slug] ?? [];
            $fieldLabels = array_column($config['fields'] ?? [], null, 'name');
        }
        PHP;

        $additionalPHP .= "\n" . $this->functions;
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

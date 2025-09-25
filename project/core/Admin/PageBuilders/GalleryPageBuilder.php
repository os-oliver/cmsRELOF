<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class GalleryPageBuilder extends BasePageBuilder
{
    protected string $css = <<<CSS
    gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .gallery-item {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 0.5rem;
            overflow: hidden;
            height: 250px;
            cursor: pointer;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .lightbox.active {
            opacity: 1;
            pointer-events: all;
        }

        .lightbox-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            text-align: center;
        }

        .lightbox img {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 0.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
        }

        .lightbox-info {
            color: white;
            padding: 1rem 0;
            text-align: center;
            max-width: 600px;
            margin: 0 auto;
        }

        .lightbox-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .lightbox-description {
            opacity: 0.8;
        }

        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
            z-index: 1001;
        }

        .nav-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .prev-btn {
            left: 20px;
        }

        .next-btn {
            right: 20px;
        }

        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            z-index: 1001;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            gap: 0.5rem;
        }

        .page-item {
            display: flex;
        }

        .page-link {
            padding: 0.5rem 1rem;
            background: #f3f4f6;
            border-radius: 0.25rem;
            color: #4b5563;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .page-link:hover,
        .page-link.active {
            background: #3b82f6;
            color: white;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #6b46c1 0%, #3b82f6 100%);
        }
    CSS;

    protected string $html = <<<'HTML'
<main>
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>

    <!-- Gallery Section -->
    <section class="container mx-auto px-4  py-12 pt-32 ">
        <div class="text-center mb-12">
        <h2 class="text-3xl font-bold mb-4 text-gray-800">Kolekcija Slika</h2>
<p class="text-gray-600 max-w-2xl mx-auto">Istražite našu pažljivo odabranu kolekciju slika. Kliknite na bilo koju sliku da je pogledate u punoj veličini i da se krećete kroz galeriju.</p>

        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid">
            <?php foreach ($images as $index => $image): ?>
                <div class="gallery-item" 
                    data-id='<?= $image["id"] ?>' 
                    data-index='<?= $index ?>'
                    data-title='<?= htmlspecialchars($image["title"]) ?>'
                    data-description='<?= htmlspecialchars($image["description"]) ?>'>
                    <img src='<?= $image["image_file_path"] ?>' 
                        alt='<?= htmlspecialchars($image["title"]) ?>'
                        loading="lazy">
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination mt-12">
            <?php if ($page > 1): ?>
                <div class="page-item">
                    <a href="?page=<?= $page - 1 ?>" class="page-link">
                        <i class="fas fa-chevron-left mr-1"></i> Prev
                    </a>
                </div>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <div class="page-item">
                    <a href="?page=<?= $i ?>" class="page-link <?= $i == $page ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                </div>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <div class="page-item">
                    <a href="?page=<?= $page + 1 ?>" class="page-link">
                        Next <i class="fas fa-chevron-right ml-1"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<!-- Lightbox -->
<div class="lightbox" id="lightbox">
    <button class="close-btn" id="closeLightbox">
        <i class="fas fa-times"></i>
    </button>

    <button class="nav-btn prev-btn" id="prevBtn">
        <i class="fas fa-chevron-left"></i>
    </button>

    <div class="lightbox-content">
        <img id="lightboxImage" src="" alt="">
        <div class="lightbox-info">
            <div class="lightbox-title" id="lightboxTitle"></div>
            <div class="lightbox-description" id="lightboxDescription"></div>
            <div class="mt-2 text-sm opacity-70" id="lightboxPosition"></div>
        </div>
    </div>

    <button class="nav-btn next-btn" id="nextBtn">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>
HTML;

    public function buildPage(): string
    {
        $additionalPHP = <<<PHP
        use App\Models\Gallery;

        \$limit = 6;
        \$page = max(1, (int) (\$_GET["page"] ?? 1));
        \$offset = (\$page - 1) * \$limit;
        \$documentModal = new Gallery();
        [\$images, \$totalCount] = \$documentModal->list(
            limit: \$limit,
            offset: \$offset
        );
        \$totalPages = (int) ceil(\$totalCount / \$limit);
        PHP;

        $content = $this->getHeader($this->css, $additionalPHP);
        $content .= $this->getCommonIncludes();
        $content .= $this->html;
        $content .= $this->getFooter();
        return $content;
    }
}
<?php

namespace App\Admin\PageBuilders;

use App\Models\Gallery;

class GalleryPageBuilder extends BasePageBuilder
{
    protected string $css = <<<CSS
    .gallery-grid {
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
        position: relative;
    }

    .gallery-item::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
        opacity: 0;
        transition: opacity 0.3s;
        border-radius: 0.5rem;
    }

    .gallery-item:hover::after {
        opacity: 1;
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
        display: block;
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
CSS;

    protected string $html = <<<'HTML'
<main class="bg-background mt-20">
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary hover:bg-primary_hover text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>

    <section class="container mx-auto px-4 py-12 pt-32 text-secondary_text font-body">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold font-heading text-primary_text mb-2">Kolekcija Slika</h2>
            <p class="text-lg font-heading2 text-secondary_text">
                Istražite našu pažljivo odabranu kolekciju slika. Kliknite na bilo koju sliku da je pogledate u punoj veličini i da se krećete kroz galeriju.
            </p>
        </div>

        <div class="gallery-grid">
            <?php foreach ($images as $index => $image): ?>
                <div class="gallery-item"
                    data-id='<?= $image->id ?>'
                    data-index='<?= $index ?>'
                    data-title='<?= htmlspecialchars($image->title ?? "") ?>'
                    data-description='<?= htmlspecialchars($image->description ?? "") ?>'>
                    <img src='<?= $image->image_file_path ?>'
                        alt='<?= htmlspecialchars($image->title ?? "") ?>'
                        loading="lazy">
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pagination mt-12">
            <?php if ($page > 1): ?>
                <div class="page-item">
                    <a href="?page=<?= $page - 1 ?>" class="page-link">Prev</a>
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
                    <a href="?page=<?= $page + 1 ?>" class="page-link">Next</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<div class="lightbox" id="lightbox">
    <button class="close-btn" id="closeLightbox">&times;</button>
    <button class="nav-btn prev-btn bg-primary hover:primary_hover" id="prevBtn">&#10094;</button>

    <div class="lightbox-content">
        <img id="lightboxImage" src="" alt="">
        <div class="lightbox-info">
            <div class="lightbox-title" id="lightboxTitle"></div>
            <div class="lightbox-description" id="lightboxDescription"></div>
            <div class="mt-2 text-sm opacity-70" id="lightboxPosition"></div>
        </div>
    </div>

    <button class="nav-btn next-btn bg-primary hover:primary_hover" id="nextBtn">&#10095;</button>
</div>

<script>
    const galleryItems = document.querySelectorAll('.gallery-item');
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxTitle = document.getElementById('lightboxTitle');
    const lightboxDescription = document.getElementById('lightboxDescription');
    const lightboxPosition = document.getElementById('lightboxPosition');
    const closeBtn = document.getElementById('closeLightbox');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    let currentIndex = 0;

    function showLightbox(index) {
        const item = galleryItems[index];
        lightboxImage.src = item.querySelector('img').src;
        lightboxTitle.textContent = item.dataset.title;
        lightboxDescription.textContent = item.dataset.description;
        lightboxPosition.textContent = `Slika ${index + 1} od ${galleryItems.length}`;
        currentIndex = index;
        lightbox.classList.add('active');
    }

    galleryItems.forEach((item, index) => {
        item.addEventListener('click', () => showLightbox(index));
    });

    closeBtn.addEventListener('click', () => lightbox.classList.remove('active'));
    prevBtn.addEventListener('click', () => showLightbox((currentIndex - 1 + galleryItems.length) % galleryItems.length));
    nextBtn.addEventListener('click', () => showLightbox((currentIndex + 1) % galleryItems.length));

    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) lightbox.classList.remove('active');
    });
</script>
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

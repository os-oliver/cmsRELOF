<main>
  <div>
    <button id="increaseFontBtn"
      class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
      aria-label="Increase font size">
      A+
    </button>
  </div>

  <!-- Gallery Section -->
  <section class="container mx-auto px-4 mt-24 py-12">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold mb-4 text-gray-800">Kolekcija Slika</h2>
      <p class="text-gray-600 max-w-2xl mx-auto">Istražite našu pažljivo odabranu kolekciju slika. Kliknite na bilo koju
        sliku da je pogledate u punoj veličini i da se krećete kroz galeriju.</p>

    </div>

    <!-- Gallery Grid -->
    <div class="gallery-grid">
      <?php foreach ($images as $index => $image): ?>
        <div class="gallery-item" data-id='<?= $image["id"] ?>' data-index='<?= $index ?>'
          data-title='<?= htmlspecialchars($image["title"]) ?>'
          data-description='<?= htmlspecialchars($image["description"]) ?>'>
          <img src='<?= $image["image_file_path"] ?>' alt='<?= htmlspecialchars($image["title"]) ?>' loading="lazy">
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
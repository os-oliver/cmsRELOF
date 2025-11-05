<?php

use App\Models\SearchModal;

// Pokreni sesiju ako nije pokrenuta
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Uzmi trenutni jezik iz sesije
$lang = $_SESSION['lang'] ?? 'sr';

$term = trim($_GET['q'] ?? '');

$searchResults = [];

if ($term !== '') {
    $searchModel = new SearchModal();

    // Pretrazi translations tabelu
    $translations = $searchModel->searchTranslations($term, $lang);

    // Grupiši rezultate po tabelama
    $searchResults = $searchModel->groupTranslationResults($translations);
}

?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pretraga - Search</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
    <link href="/exportedPages/commonStyle.css" rel="stylesheet" />
</head>

<body class="bg-gray-50 text-gray-800">
    <!-- Accessibility Button -->
    <button id="increaseFontBtn"
        class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
        aria-label="Increase font size">
        A+
    </button>

    <!-- Include Header & Menu -->
    <div>
        <?php require_once __DIR__ . '/../exportedPages/landingPageComponents/landingPage/divmobileMenu.php'; ?>
        <?php require_once __DIR__ . '/../exportedPages/landingPageComponents/landingPage/header.php'; ?>
    </div>

    <!-- Main Search Container -->
    <div class="max-w-5xl pt-24 mx-auto px-4 py-8">

        <!-- Search Form -->
        <div class="mb-10">
            <form method="GET" class="flex items-center gap-0 shadow-lg rounded-xl overflow-hidden">
                <input type="text" name="q" value="<?= htmlspecialchars($term) ?>" placeholder="🔍 Pretražite sajt..."
                    class="flex-grow px-6 py-4 text-lg border-0 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    autofocus />
                <button type="submit"
                    class="px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold hover:from-blue-600 hover:to-blue-700 transition-all">
                    Pretraži
                </button>
            </form>
        </div>

        <?php if ($term === ''): ?>
            <!-- Empty State -->
            <div class="text-center py-20">
                <div class="text-6xl mb-4">🔍</div>
                <h2 class="text-2xl font-bold text-gray-700 mb-2">Počnite pretragu</h2>
                <p class="text-gray-500">Unesite pojam u polje iznad da biste pretražili sajt</p>
            </div>

        <?php elseif (empty($searchResults)): ?>
            <!-- No Results State -->
            <div class="text-center py-20">
                <div class="text-6xl mb-4">😕</div>
                <h2 class="text-2xl font-bold text-gray-700 mb-2">Nema rezultata</h2>
                <p class="text-gray-500">Pokušajte sa drugim pojmom ili proverite pravopis</p>
                <p class="text-sm text-gray-400 mt-4">Tražili ste: <strong><?= htmlspecialchars($term) ?></strong></p>
            </div>

        <?php else: ?>
            <!-- Results Count -->
            <div class="mb-6">
                <?php
                $totalResults = 0;
                foreach ($searchResults as $records) {
                    $totalResults += count($records);
                }
                ?>
                <p class="text-gray-600">
                    Pronađeno <strong class="text-blue-600"><?= $totalResults ?></strong> rezultata za:
                    <strong>"<?= htmlspecialchars($term) ?>"</strong>
                </p>
            </div>

            <!-- Dynamic Results by Table -->
            <?php foreach ($searchResults as $tableName => $records): ?>
                <section class="mb-10">
                    <!-- Section Header -->
                    <div class="flex items-center gap-3 mb-5 pb-3 border-b-2 border-gray-200">
                        <span class="text-3xl"><?= $searchModel->getTableIcon($tableName) ?></span>
                        <h2 class="text-2xl font-bold text-gray-800">
                            <?= htmlspecialchars($searchModel->getTableDisplayName($tableName)) ?>
                        </h2>
                        <span class="ml-auto bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                            <?= count($records) ?> rezultata
                        </span>
                    </div>

                    <!-- Records Grid -->
                    <div class="grid gap-4">
                        <?php foreach ($records as $sourceId => $recordData): ?>
                            <?php
                            // Dobij originalni red iz source tabele
                            $originalRecord = $searchModel->getSourceRecord($tableName, $sourceId);

                            // Merge sa prevodima
                            $mergedRecord = $originalRecord
                                ? $searchModel->mergeTranslationsIntoRecord($originalRecord, $recordData['fields'])
                                : [];
                            ?>

                            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all p-6 border border-gray-100">
                                <!-- Record Content -->
                                <div class="space-y-3">
                                    <?php foreach ($recordData['fields'] as $field): ?>
                                        <div class="border-l-4 border-blue-400 pl-4">
                                            <?php if (!empty($field['label'])): ?>
                                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">
                                                    <?= htmlspecialchars($field['label']) ?>
                                                </p>
                                            <?php endif; ?>

                                            <p class="text-gray-800 leading-relaxed">
                                                <?= nl2br(htmlspecialchars($field['content'])) ?>
                                            </p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Additional Info from Original Record -->
                                <?php if (!empty($mergedRecord)): ?>
                                    <div class="mt-4 pt-4 border-t border-gray-100">
                                        <div class="flex flex-wrap gap-2 text-xs text-gray-500">
                                            <span class="bg-gray-100 px-2 py-1 rounded">
                                                ID: <?= htmlspecialchars($sourceId) ?>
                                            </span>

                                            <?php if (isset($mergedRecord['created_at'])): ?>
                                                <span class="bg-gray-100 px-2 py-1 rounded">
                                                    📅 <?= date('d.m.Y', strtotime($mergedRecord['created_at'])) ?>
                                                </span>
                                            <?php endif; ?>

                                            <?php if (isset($mergedRecord['category_id'])): ?>
                                                <span class="bg-gray-100 px-2 py-1 rounded">
                                                    🗂️ Kategorija: <?= htmlspecialchars($mergedRecord['category_id']) ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Special handling for specific tables -->
                                <?php if ($tableName === 'document' && !empty($mergedRecord['filepath'])): ?>
                                    <div class="mt-4">
                                        <a href="/uploads/documents/<?= htmlspecialchars($mergedRecord['filepath']) ?>"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 text-white text-sm font-semibold rounded-lg hover:bg-blue-600 transition"
                                            download>
                                            <i class="fas fa-download"></i>
                                            Preuzmi dokument
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if ($tableName === 'events' && !empty($mergedRecord['image'])): ?>
                                    <div class="mt-4">
                                        <img src="<?= htmlspecialchars($mergedRecord['image']) ?>" alt="Event image"
                                            class="w-full h-48 object-cover rounded-lg">
                                    </div>
                                <?php endif; ?>

                                <?php if ($tableName === 'gallery' && !empty($mergedRecord['image_file_path'])): ?>
                                    <div class="mt-4">
                                        <img src="<?= htmlspecialchars($mergedRecord['image_file_path']) ?>" alt="Gallery image"
                                            class="w-full h-64 object-cover rounded-lg">
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <?php require_once __DIR__ . '/../exportedPages/landingPageComponents/landingPage/footer.php'; ?>


    <script src="/exportedPages/commonScript.js?v=<?php echo time(); ?>"></script>
</body>

</html>
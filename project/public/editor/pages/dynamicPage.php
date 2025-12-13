<?php

use App\Models\Content;
use App\Models\GenericCategory;
session_start();
if (isset($_GET['locale']))
    $_SESSION['locale'] = $_GET['locale'];
$locale = $_SESSION['locale'] ?? 'sr-Cyrl';

use App\Controllers\{AuthController, ContentController};
use App\Utils\CardRenderer;

AuthController::requireEditor();
[$name, $surname, $role] = AuthController::getUserInfo();

// Extract slug and load config
$slug = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'))[1] ?? null;
$config = $fieldLabels = [];
if ($slug && file_exists($structurePath = __DIR__ . '/../../assets/data/structure.json')) {
    $parsed = json_decode(file_get_contents($structurePath), true);
    $config = $parsed[0][$slug] ?? [];
    $fieldLabels = array_column($config['fields'] ?? [], null, 'name');
}

// Pagination
$itemsPerPage = 3;
$currentPage = max(1, (int) ($_GET['page'] ?? 1));



?>
<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= __('events.page_title') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="/assets/js/dashboard/tailwindConf.js"></script>
    <link rel="stylesheet" href="/assets/css/dashboard/structure.css">
    <style>#loader-overlay {
  position: fixed; /* Fixes it in the viewport */
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
  z-index: 9999; /* Ensure it's on top of everything */
  display: flex;
  justify-content: center;
  align-items: center;
}

/* Simple CSS spinner example */
.spinner {
  border: 4px solid #f3f3f3; /* Light grey */
  border-top: 4px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 40px;
  height: 40px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}</style>
</head>

<body class="bg-gradient-to-br from-light-100 to-light-200 text-gray-700 font-sans">
    <div class="overlay" id="overlay"></div>
    <div class="flex h-screen overflow-hidden">
        <?php $activeTab = $slug;
        require_once __DIR__ . "/../components/sidebar.php"; ?>
        <div id="page-root" data-slug="<?= htmlspecialchars($slug) ?>" data-locale="<?= htmlspecialchars($locale) ?>">
        </div>
        <div class="flex-1 flex flex-col overflow-hidden">
            <?php require_once __DIR__ . "/../components/topBar.php"; ?>

            <main class="flex-1 overflow-y-auto p-6">
                <div class="mx-auto space-y-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
                        <h1 class="text-3xl font-bold text-gray-800">
                            <?= htmlspecialchars($config[$locale] ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </h1>
                        <div class="flex flex-wrap items-center gap-3">
                            <?php if (strtolower($slug) === 'ankete'): ?>
                                <a href="https://docs.google.com/forms" target="_blank" rel="noopener noreferrer"
                                    class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-6 py-2 rounded-lg transition-all flex items-center gap-2 shadow-lg">
                                    <i class="fab fa-google text-sm"></i>
                                    <span>Google Forms</span>
                                </a>
                            <?php endif; ?>
                            <button id="newEventButton"
                                class="bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white px-6 py-2 rounded-lg transition-all flex items-center gap-2 shadow-lg">
                                <i class="fas fa-plus text-sm"></i><?= $config[$locale] ?>
                            </button>
                        </div>
                    </div>



                    <div class="mx-auto max-w-7xl p-6">
                        <?php
                        $categories = GenericCategory::fetchAll($slug, $locale);
                        echo CardRenderer::renderTopbar($categories, '') ?>
                        <?php
                        try {

                            $search = $_GET['search'] ?? '';


                            // Sanitize category — only use it if it's a numeric value
                            $categoryId = isset($_GET['category']) && is_numeric($_GET['category'])
                                ? (int) $_GET['category']
                                : null;

                            $itemsList = $slug
                                ? (new Content())->fetchListData($slug, $search, $currentPage, $itemsPerPage, $categoryId, $locale)
                                : ['success' => false, 'items' => []];

                            if ($itemsList['success'] && !empty($itemsList['items'])) {
                                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">';
                                foreach ($itemsList['items'] as $item) {
                                    echo CardRenderer::renderCard($item, $fieldLabels, $locale, true);
                                }
                                echo '</div>';

                                $totalPages = ceil($itemsList['total'] / $itemsPerPage);
                                $start = ($currentPage - 1) * $itemsPerPage + 1;
                                $end = min($start + $itemsPerPage - 1, $itemsList['total']);
                                echo CardRenderer::renderPagination($currentPage, $totalPages, $start, $end, $itemsList['total'], 'editor');
                            } else {
                                echo "<div class='bg-white rounded-xl shadow-md p-12 text-center'><i class='fas fa-inbox text-6xl text-gray-300 mb-4'></i><p class='text-gray-500 text-lg'><?=_('dynamic.noitems')?></p></div>";
                            }
                        } catch (\Throwable $e) {
                            error_log('List render error: ' . $e->getMessage());
                            echo "<div class='mt-4 p-4 rounded-lg bg-red-100 text-red-800 border border-red-300'>Nije moguće učitati stavke: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</div>";
                        }
                        ?>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="/assets/js/dashboard/mobileMenu.js" defer></script>
    <script type="module" src="/assets/js/dashboard/dynamicPages.js" defer></script>

    </script>
</body>

</html>
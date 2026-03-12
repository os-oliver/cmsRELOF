<?php
use App\Controllers\GalleryController;
use App\Models\Document;
use App\Controllers\AuthController;
use App\Models\Gallery;
AuthController::requireEditor();
use \App\Utils\LocaleManager;
$locale = LocaleManager::get();
[$name, $surname, $role] = AuthController::getUserInfo();

$sort = $_GET['sort'] ?? 'date_desc';
$search = $_GET['search'] ?? '';
// pagination as before
$limit = 3;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;
$documentModal = new Gallery();
// now pass filters into your Document model
[$images, $totalCount] = $documentModal->list(
    limit: $limit,
    offset: $offset,
    sort: $sort,
    search: $search,
    lang: $locale
); 
$totalPages = (int) ceil($totalCount / $limit);
?>
<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= __('gallery.page_title') ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/dashboard/documents.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        light: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>

</head>

<body class="bg-gradient-to-br from-light-100 to-light-200 text-gray-700 font-sans">
    <?php require_once __DIR__ . "/../components/galleryInputForm.php" ?>

    <!-- Mobile Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Document Preview Modal -->
    <?php
    require_once __DIR__ . "/../components/documentViewer.php" ?>

    <div class="flex h-screen overflow-hidden">
        <?php
        $activeTab = 'gallery';
        require_once __DIR__ . "/../components/sidebar.php" ?>

        <div class="flex-1 flex flex-col overflow-hidden">

            <?php require_once __DIR__ . "/../components/topBar.php" ?>
            <div class="overflow-y-auto container mx-auto px-4 py-8 ">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">
                            <?= __('gallery.management_title') ?>
                        </h1>
                        <p class="text-light-600">
                            <?= __('gallery.management_subtitle') ?>
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button id="newPicture"
                            class="bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white px-6 py-2 rounded-lg transition-all flex items-center gap-2 shadow-lg">
                            <i class="fas fa-plus text-sm"></i>
                            <?= __('gallery.add_image') ?>
                        </button>
                    </div>
                </div>

                <!-- Search and Filters -->
                <form method="GET" action="" class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
                    <div class="flex flex-col lg:flex-row gap-4 items-center">
                        <!-- Search Bar -->
                        <div class="relative flex-1 w-full lg:w-auto">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search h-5 w-5 text-gray-400"></i>
                            </div>
                            <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                                placeholder="<?= __('gallery.search_placeholder') ?>"
                                class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl …">
                        </div>

                        <!-- Sort -->
                        <select name="sort" class="px-4 py-3 border rounded-xl …">
                            <option value="date_desc" <?= ($_GET['sort'] ?? '') === 'date_desc' ? 'selected' : '' ?>>
                                <?= __('gallery.latest_first') ?>
                            </option>
                            <option value="date_asc" <?= ($_GET['sort'] ?? '') === 'date_asc' ? 'selected' : '' ?>>
                                <?= __('gallery.oldest_first') ?>
                            </option>
                            <option value="title" <?= ($_GET['sort'] ?? '') === 'title' ? 'selected' : '' ?>>
                                <?= __('gallery.by_name') ?>
                            </option>
                        </select>

                        <!-- Submit -->
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl …">
                            <?= __('gallery.apply') ?>
                        </button>

                        <!-- Add Document Button -->

                    </div>

                </form>

                <!-- Gallery Slots -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                    <?php foreach ($images as $image): ?>
                        <?php
                        // $image is stdClass — use -> access. Add safe fallbacks.
                        $uploadedAt = $image->uploaded_at ?? null;
                        $date = $uploadedAt ? date('M d, Y', strtotime($uploadedAt)) : '';
                        $id = isset($image->id) ? (int) $image->id : 0;
                        $title = htmlspecialchars((string) ($image->title ?? ''));
                        $description = htmlspecialchars((string) ($image->description ?? ''));
                        $imagePath = htmlspecialchars((string) ($image->image_file_path ?? ''));
                        ?>
                        <div class="gallery-item bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 overflow-hidden group relative"
                            data-id="<?= $id ?>" data-title="<?= $title ?>" data-description="<?= $description ?>"
                            data-image-url="<?= $imagePath ?>"
                            data-date="<?= htmlspecialchars((string) ($image->uploaded_at ?? '')) ?>">

                            <!-- Image container -->
                            <div class="h-60 overflow-hidden">
                                <img src="<?= $imagePath ?>" alt="<?= $title ?>"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            </div>

                            <!-- Glassmorphism Overlay with Action Icons -->
                            <div
                                class="absolute inset-0 bg-white/10 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-10">
                                <div class="flex gap-6">

                                    <button id="editGallery"
                                        class="gallery-edit edit w-20 h-20 hover:bg-white/30 text-black rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110"
                                        title="<?= __('gallery.edit') ?>">
                                        <i class="hover:text-yellow-500 fas fa-pencil-alt text-3xl"></i>
                                    </button>
                                    <button id="deleteGallery" onclick="deletePicture(<?= $id ?>)"
                                        class="delete w-20 h-20 hover:bg-white/30 text-black rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110"
                                        title="<?= __('gallery.delete') ?>">
                                        <i class="hover:text-red-500 fas fa-trash text-3xl"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="p-6">
                                <!-- Title -->
                                <h3
                                    class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                                    <?= $title ?>
                                </h3>

                                <!-- Description -->
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    <?= $description ?>
                                </p>

                                <!-- Date -->
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <i class="fas fa-calendar h-4 w-4"></i>
                                    <?= $date ?>
                                </div>
                            </div>

                            <div class="px-5 z-40 relative py-4 bg-gray-50 border-t border-gray-100">
                                <button
                                    class="view-image w-full  flex items-center justify-center gap-2 text-blue-600 hover:text-blue-700 font-medium transition-colors px-3 py-2 rounded-lg hover:bg-blue-50">
                                    <i class="fas fa-expand fa-sm"></i>
                                    <?= __('gallery.view_full_image') ?>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div id="fullImageModal"
                    class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center hidden transition-all duration-300">
                    <div class="relative max-w-4xl w-full mx-auto px-4">
                        <button id="closeFullImageModal"
                            class="absolute top-4 right-4 text-red-600 text-7xl hover:text-red-900 transition-all">&times;</button>
                        <img id="modalFullImage" src="" alt="<?= __('gallery.image_preview') ?>"
                            class="w-full h-auto max-h-[90vh] object-contain rounded-xl shadow-lg border-4 border-white">
                    </div>
                </div>

                <!-- Pagination -->
                <div
                    class="flex items-center justify-between bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="hidden md:block text-sm text-gray-700">
                        <?php

                        $paginacijaString = __('gallery.pagination_summary');
                        $paginacijaString = str_replace(
                            ['{{shown}}', '{{of}}'],
                            [count($images), $totalCount],
                            $paginacijaString
                        );
                        echo $paginacijaString;
                        ?>
                    </div>

                    <nav class="flex items-center gap-2">
                        <!-- Previous -->
                        <button class="p-2 rounded-lg border text-gray-500 hover:bg-gray-50 disabled:opacity-50"
                            <?= $page <= 1 ? 'disabled' : '' ?> onclick="location.href='?page=<?= $page - 1 ?>'">
                            <i class="fas fa-chevron-left"></i>
                        </button>

                        <!-- Page numbers -->
                        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                            <button
                                class="px-4 py-2 rounded-lg <?= $p === $page ? 'bg-blue-600 text-white' : 'border text-gray-700 hover:bg-gray-50' ?>"
                                onclick="location.href='?page=<?= $p ?>'">
                                <?= $p ?>
                            </button>
                        <?php endfor; ?>

                        <!-- Next -->
                        <button class="p-2 rounded-lg border text-gray-500 hover:bg-gray-50 disabled:opacity-50"
                            <?= $page >= $totalPages ? 'disabled' : '' ?>
                            onclick="location.href='?page=<?= $page + 1 ?>'">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </nav>

                </div>
            </div>

        </div>
    </div>

    <script src="/assets/js/dashboard/gallery.js">
    </script>
    <script src="/assets/js/dashboard/mobileMenu.js" defer></script>
</body>

</html>
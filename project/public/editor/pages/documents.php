<?php
use App\Models\Document;
use App\Controllers\AuthController;
AuthController::requireEditor();
[$name, $surname, $role] = AuthController::getUserInfo();

// defaults
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$status = $_GET['status'] ?? '';
$sort = $_GET['sort'] ?? 'date_desc';

// pagination as before
$limit = 3;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;
$documentModal = new Document();
// now pass filters into your Document model
[$documents, $totalCount] = $documentModal->list(
    limit: $limit,
    offset: $offset,
    search: $search,
    category: $category,
    status: $status,
    sort: $sort,
);
$totalPages = (int) ceil($totalCount / $limit);
$DocumentCategories = $documentModal->getCategories();

function getFileConfig(string $ext): array
{
    switch (strtolower($ext)) {
        case 'pdf':
            return [
                'icon' => 'fas fa-file-pdf',
                'color' => 'red',
                'bg_color' => 'bg-red-100',
                'text_color' => 'text-red-600',
            ];
        case 'doc':
        case 'docx':
            return [
                'icon' => 'fas fa-file-word',
                'color' => 'blue',
                'bg_color' => 'bg-blue-100',
                'text_color' => 'text-blue-600',
            ];
        case 'xls':
        case 'xlsx':
            return [
                'icon' => 'fas fa-file-excel',
                'color' => 'green',
                'bg_color' => 'bg-green-100',
                'text_color' => 'text-green-600',
            ];
        default:
            return [
                'icon' => 'fas fa-file-alt',
                'color' => 'gray',
                'bg_color' => 'bg-gray-100',
                'text_color' => 'text-gray-600',
            ];
    }
}
?>
<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumenti - Administracija</title>
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
    <?php require_once __DIR__ . "/../components/documentInputForm.php" ?>

    <!-- Mobile Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Document Preview Modal -->
    <?php
    require_once __DIR__ . "/../components/documentViewer.php" ?>


    <div class="flex h-screen overflow-hidden">
        <?php
        $activeTab = 'documents';
        require_once __DIR__ . "/../components/sidebar.php" ?>

        <div class="flex-1 flex flex-col overflow-hidden">

            <?php require_once __DIR__ . "/../components/topBar.php" ?>
            <div class="overflow-y-auto 2xl:overflow-y-hidden overflow-x-hidden container mx-auto px-4 py-8 ">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Upravljanje dokumentima</h1>
                        <p class="text-light-600">Pregled i upravljanje službenim dokumentima</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">

                        <button id="NewDocument"
                            class="bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white px-6 py-2 rounded-lg transition-all flex items-center gap-2 shadow-lg">
                            <i class="fas fa-plus text-sm"></i>
                            Dodaj novi dokument
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
                                placeholder="Pretraži dokumenta..."
                                class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl …">
                        </div>

                        <!-- Category Filter -->
                        <select name="category" class="px-4 py-3 border rounded-xl …">
                            <option value="">Sve kategorije</option>
                            </option>

                            <?php foreach ($DocumentCategories as $doc): ?>
                                <option value="<?= $doc['id'] ?>">
                                    <?= $doc['name'] ?>
                                </option>

                            <?php endforeach; ?>

                        </select>



                        <!-- Sort -->
                        <select name="sort" class="px-4 py-3 border rounded-xl …">
                            <option value="date_desc" <?= ($_GET['sort'] ?? '') === 'date_desc' ? 'selected' : '' ?>>
                                Najnoviji prvo
                            </option>
                            <option value="date_asc" <?= ($_GET['sort'] ?? '') === 'date_asc' ? 'selected' : '' ?>>
                                Najstariji prvo</option>
                            <option value="title" <?= ($_GET['sort'] ?? '') === 'title' ? 'selected' : '' ?>>Po
                                nazivu</option>
                        </select>

                        <!-- Submit -->
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl …">
                            Primeni
                        </button>

                        <!-- Add Document Button -->

                    </div>

                </form>


                <!-- Document Cards -->
                <div class="grid grid-cols-1  md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                    <?php foreach ($documents as $doc): ?>
                        <?php
                        $cfg = getFileConfig($doc['extension']);
                        $date = date('j. F Y. \u\  H:i\h', strtotime($doc['datetime']));
                        ?>
                        <div class="document-card bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 overflow-hidden group relative"
                            data-title="<?= htmlspecialchars($doc['title']) ?>"
                            data-description="<?= htmlspecialchars($doc['description']) ?>"
                            data-category="<?= htmlspecialchars($doc['category_id']) ?>"
                            data-file-url="<?= htmlspecialchars($doc['filepath']) ?>"
                            data-file-type="<?= htmlspecialchars($doc['extension']) ?>"
                            data-date="<?= htmlspecialchars($doc['datetime']) ?>"
                            data-name="<?= htmlspecialchars($doc['name']) ?>"
                            data-file-size="<?= htmlspecialchars($doc['fileSize']) ?> MB"
                            data-id="<?= htmlspecialchars($doc['id']) ?>">

                            <!-- Glassmorphism Overlay with Action Icons -->
                            <div
                                class="absolute inset-0 bg-white/10 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 z-10 rounded-2xl">
                                <div class=" rounded-2xl p-12 ">
                                    <div class="flex gap-6">
                                        <button
                                            class="viewDocument <?= $doc['extension'] == 'pdf' ? '' : 'hidden' ?> w-20 h-20  hover:bg-white/30  text-gray-700 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110"
                                            title="View">
                                            <i class="hover:text-cyan-500 fas fa-eye text-3xl"></i>
                                        </button>
                                        <button
                                            class="edit w-20 h-20  hover:bg-white/30  text-gray-700 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110"
                                            title="Edit">
                                            <i class="hover:text-yellow-500 fas fa-pencil-alt text-3xl"></i>
                                        </button>
                                        <button
                                            class="delete w-20 h-20  hover:bg-white/30  text-gray-700 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110"
                                            title="Delete">
                                            <i class="hover:text-red-500 fas fa-trash text-3xl"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 document-card-content">
                                <!-- Document Icon and Menu -->
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-12 h-12 <?= $cfg['bg_color'] ?> rounded-xl flex items-center justify-center">
                                            <i class="<?= $cfg['icon'] ?> text-2xl <?= $cfg['text_color'] ?>"></i>
                                        </div>
                                        <div>
                                            <span
                                                class="text-sm font-medium <?= $cfg['text_color'] ?> bg-<?= $cfg['color'] ?>-50 px-2 py-1 rounded-lg"><?= htmlspecialchars($doc['name']) ?></span>
                                        </div>
                                    </div>
                                    <button
                                        class="text-gray-400 hover:text-gray-600 p-1 rounded-lg hover:bg-gray-100 transition-colors duration-200 opacity-100 group-hover:opacity-0 transition-opacity duration-200">
                                        <i class="fas fa-ellipsis-h h-5 w-5"></i>
                                    </button>
                                </div>

                                <!-- Document Title -->
                                <h3
                                    class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                                    <?= htmlspecialchars($doc['title']) ?>
                                </h3>

                                <!-- Description -->
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    <?= htmlspecialchars($doc['description']) ?>
                                </p>

                                <!-- Date and Status -->
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-2 text-sm text-gray-500">
                                        <i class="fas fa-calendar h-4 w-4"></i>
                                        <?= $date ?>
                                    </div>

                                </div>
                            </div>

                            <div class="px-5 py-4 bg-gray-50 border-t border-gray-100">
                                <div class="flex items-center justify-between">
                                    <a download href="<?= "/uploads/documents/" . $doc['filepath'] ?>"
                                        class="z-50 download-btn flex items-center gap-2 text-blue-600 hover:text-blue-700 font-medium transition-colors px-3 py-2 rounded-lg hover:bg-blue-50">
                                        <i class="fas fa-download fa-sm"></i>
                                        Preuzmi
                                    </a>
                                    <div class="text-xs text-black bg-gray-100 px-2.5 py-1.5 rounded-full">
                                        <?= htmlspecialchars($doc['fileSize']) ?> MB
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>


                <!-- Pagination -->
                <div
                    class="flex items-center justify-between bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <div class="hidden md:block text-sm text-gray-700">
                        Prikazano <span class="font-medium"><?= count($documents) ?></span> od <span
                            class="font-medium"><?= $totalCount ?></span> dokumenata
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

    <!-- Floating Action Button -->
    <button
        class="floating-btn fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white rounded-full flex items-center justify-center shadow-xl transition-all z-20">
        <i class="fas fa-plus text-2xl"></i>
    </button>

    <script src="/assets/js/dashboard/documents.js">
    </script>
</body>

</html>
<?php
use App\Models\Event;
use App\Controllers\AuthController;
AuthController::requireEditor();
[$name, $surname, $role] = AuthController::getUserInfo();

$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$status = $_GET['status'] ?? '';
$sort = $_GET['sort'] ?? 'date_desc';

$limit = 3;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

[$events, $totalCount] = (new Event())->all(
    limit: $limit,
    offset: $offset,
    search: $search,
    category: $category,
    status: $status,
    sort: $sort,
);
$totalPages = (int) ceil($totalCount / $limit);
$categories = (new Event())->getCategories();

if (isset($_GET['locale'])) {
    $_SESSION['locale'] = $_GET['locale'];
}
$locale = $_SESSION['locale'] ?? 'sr-Cyrl';
?>
<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php switch ($locale) {
            case 'sr': echo 'Događaji - Administracija'; break;
            case 'en': echo 'Events - Administration'; break;
            default: echo 'Догађаји - Администрација'; break;
        } ?>
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
    <style>
        .glass-panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(209, 213, 219, 0.5);
        }

        .sidebar-item {
            transition: all 0.3s ease;
        }

        .sidebar-item:hover {
            background: rgba(127, 167, 207, 0.8);
            transform: translateX(4px);
            color: white;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        }


        .action-card:hover {
            transform: scale(1.05);
            background: linear-gradient(145deg, #f8fafc, #f1f5f9);
        }

        .stat-card {
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        }

        .content-card {
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
        }

        .mobile-menu-btn {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                position: fixed;
                z-index: 40;
                height: 100vh;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 30;
            }

            .overlay.active {
                display: block;
            }

            .sidebar-close-btn {
                display: block;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-light-100 to-light-200 text-gray-700 font-sans">
    <!-- Mobile Overlay -->
    <div class="overlay" id="overlay"></div>
    <?php require_once __DIR__ . '/../components/eventsInputForm.php' ?>
    <div class="flex h-screen overflow-hidden">
        <!-- Light Glass Sidebar -->
        <?php
        $activeTab = 'events';
        require_once __DIR__ . "/../components/sidebar.php" ?>


        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <?php require_once __DIR__ . "/../components/topBar.php" ?>
            <main class="flex-1 overflow-y-auto p-6">
                <div class=" mx-auto space-y-6">
                    <!-- Header Section -->
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                                <?php switch ($locale) {
                                    case 'sr': echo 'Upravljanje događajima'; break;
                                    case 'en': echo 'Events Management'; break;
                                    default: echo 'Управљање догађајима'; break;
                                } ?>
                            </h1>
                            <p class="text-light-600">
                                <?php switch ($locale) {
                                    case 'sr': echo 'Upravljajte svojim događajima i aktivnostima'; break;
                                    case 'en': echo 'Manage your events and activities'; break;
                                    default: echo 'Управљајте својим догађајима и активностима'; break;
                                } ?>
                            </p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3">

                            <button id="newEventButton"
                                class="bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white px-6 py-2 rounded-lg transition-all flex items-center gap-2 shadow-lg">
                                <i class="fas fa-plus text-sm"></i>
                                <?php switch ($locale) {
                                    case 'sr': echo 'Dodaj Događaj'; break;
                                    case 'en': echo 'Add Event'; break;
                                    default: echo 'Додај Догађај'; break;
                                } ?>
                            </button>
                        </div>
                    </div>


                    <!-- Filters and Search -->
                    <form method="GET" action="" class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
                        <div class="flex flex-col lg:flex-row gap-4 items-center">
                            <!-- Search Bar -->
                            <div class="relative flex-1 w-full lg:w-auto">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search h-5 w-5 text-gray-400"></i>
                                </div>
                                <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                                    placeholder="<?php switch ($locale) {
                                        case 'sr': echo 'Pretraži događaje...'; break;
                                        case 'en': echo 'Search events...'; break;
                                        default: echo 'Претражи догађаје...'; break;
                                    } ?>"
                                    class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl …">
                            </div>

                            <!-- Category Filter -->
                            <select name="category" class="px-4 py-3 border rounded-xl">
                                <option value="">
                                    <?php switch ($locale) {
                                        case 'sr': echo 'Sve kategorije'; break;
                                        case 'en': echo 'All categories'; break;
                                        default: echo 'Све категорије'; break;
                                    } ?>
                                </option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= htmlspecialchars($category['id']) ?>" <?= isset($_GET['category']) && $_GET['category'] == $category['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['naziv']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>



                            <!-- Sort -->
                            <select name="sort" class="px-4 py-3 border rounded-xl …">
                                <option value="date_desc" <?= ($_GET['sort'] ?? '') === 'date_desc' ? 'selected' : '' ?>>
                                    <?php switch ($locale) {
                                        case 'sr': echo 'Najnovije prvo'; break;
                                        case 'en': echo 'Latest first'; break;
                                        default: echo 'Најновије прво'; break;
                                    } ?>
                                </option>
                                <option value="date_asc" <?= ($_GET['sort'] ?? '') === 'date_asc' ? 'selected' : '' ?>>
                                    <?php switch ($locale) {
                                        case 'sr': echo 'Najstarije prvo'; break;
                                        case 'en': echo 'Oldest first'; break;
                                        default: echo 'Најстарије прво'; break;
                                    } ?>
                                </option>

                            </select>

                            <button type="submit"
                                class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl …">
                                <?php switch ($locale) {
                                    case 'sr': echo 'Primeni'; break;
                                    case 'en': echo 'Apply'; break;
                                    default: echo 'Примени'; break;
                                } ?>
                            </button>


                        </div>
                    </form>

                    <!-- Events Table -->


                    <div class="content-card rounded-xl overflow-hidden">
                        <div class="p-6 border-b border-light-200">
                            <h2 class="text-xl font-semibold text-gray-900">
                                <?php switch ($locale) {
                                    case 'sr': echo 'Svi Događaji'; break;
                                    case 'en': echo 'All Events'; break;
                                    default: echo 'Сви Догађаји'; break;
                                } ?>
                            </h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-light-100">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            <?php switch ($locale) {
                                                case 'sr': echo 'Događaj'; break;
                                                case 'en': echo 'Event'; break;
                                                default: echo 'Догађај'; break;
                                            } ?>
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            <?php switch ($locale) {
                                                case 'sr': echo 'Naziv'; break;
                                                case 'en': echo 'Title'; break;
                                                default: echo 'Назив'; break;
                                            } ?>
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            <?php switch ($locale) {
                                                case 'sr': echo 'Datum i vreme'; break;
                                                case 'en': echo 'Date and time'; break;
                                                default: echo 'Датум и време'; break;
                                            } ?>
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            <?php switch ($locale) {
                                                case 'sr': echo 'Lokacija'; break;
                                                case 'en': echo 'Location'; break;
                                                default: echo 'Локација'; break;
                                            } ?>
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            <?php switch ($locale) {
                                                case 'sr': echo 'Akcije'; break;
                                                case 'en': echo 'Actions'; break;
                                                default: echo 'Акције'; break;
                                            } ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-light-200">
                                    <?php foreach ($events as $event): ?>
                                        <tr class="dataCard hover:bg-light-50 transition-colors"
                                            data-id="<?= $event['id'] ?>"
                                            data-category="<?= htmlspecialchars($event['category_id']) ?>"
                                            data-title="<?= htmlspecialchars($event['title']) ?>"
                                            data-description="<?= htmlspecialchars($event['description']) ?>"
                                            data-date="<?= htmlspecialchars($event['date']) ?>"
                                            data-time="<?= htmlspecialchars($event['time']) ?>"
                                            data-location="<?= htmlspecialchars($event['location']) ?>"
                                            data-naziv="<?= htmlspecialchars($event['naziv']) ?>">

                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <div
                                                        class="flex-shrink-0 h-12 w-12 bg-gradient-to-br from-primary-100 to-primary-200 rounded-lg flex items-center justify-center shadow-inner">
                                                        <i class="fas fa-calendar text-primary-600 text-lg"></i>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-semibold text-gray-900">
                                                            <?= htmlspecialchars($event['naziv']) ?>
                                                        </div>
                                                        <div class="text-sm text-light-500">
                                                            <?= htmlspecialchars($event['description']) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                <div class="font-medium"><?= htmlspecialchars($event['title']) ?></div>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">
                                                <div class="font-medium"><?= htmlspecialchars($event['date']) ?></div>
                                                <div class="text-light-500"><?= htmlspecialchars($event['time']) ?></div>
                                            </td>

                                            <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">
                                                <span
                                                    class="inline-block bg-light-100 text-light-700 px-3 py-1 rounded-full text-xs font-medium">
                                                    <?= htmlspecialchars($event['location']) ?>
                                                </span>
                                            </td>

                                            <td class="px-6 py-4 text-sm">
                                                <div class="flex items-center space-x-2">
                                                    <button
                                                        class="edit p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition duration-200"
                                                        title="<?php switch ($locale) {
                                                            case 'sr': echo 'Uredi'; break;
                                                            case 'en': echo 'Edit'; break;
                                                            default: echo 'Уреди'; break;
                                                        } ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button onclick="deleteFunk(<?= $event['id'] ?>)"
                                                        class="delete p-2 text-red-600 hover:bg-red-50 rounded-lg transition duration-200"
                                                        title="<?php switch ($locale) {
                                                            case 'sr': echo 'Obriši'; break;
                                                            case 'en': echo 'Delete'; break;
                                                            default: echo 'Обриши'; break;
                                                        } ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>


                            </table>
                        </div>
                        <div
                            class="flex items-center justify-between bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                            <div class="hidden md:block text-sm text-gray-700">
                                <?php
                                    switch ($locale) {
                                        case 'sr':
                                            $text = "Prikazano";
                                            $ofText = "od";
                                            $eventsText = "događaja";
                                            break;
                                        case 'en':
                                            $text = "Shown";
                                            $ofText = "of";
                                            $eventsText = "events";
                                            break;
                                        default:
                                            $text = "Приказано";
                                            $ofText = "од";
                                            $eventsText = "догађаја";
                                            break;
                                    }
                                ?>
                                <?= $text ?> <span class="font-medium"><?= count($events) ?></span> <?= $ofText ?> <span
                                    class="font-medium"><?= $totalCount ?></span> <?= $eventsText ?>
                            </div>
                            <nav class="flex items-center gap-2">
                                <button class="p-2 rounded-lg border text-gray-500 hover:bg-gray-50 disabled:opacity-50"
                                    <?= $page <= 1 ? 'disabled' : '' ?> onclick="location.href='?page=<?= $page - 1 ?>'">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                                    <button
                                        class="px-4 py-2 rounded-lg <?= $p === $page ? 'bg-blue-600 text-white' : 'border text-gray-700 hover:bg-gray-50' ?>"
                                        onclick="location.href='?page=<?= $p ?>'">
                                        <?= $p ?>
                                    </button>
                                <?php endfor; ?>
                                <button class="p-2 rounded-lg border text-gray-500 hover:bg-gray-50 disabled:opacity-50"
                                    <?= $page >= $totalPages ? 'disabled' : '' ?>
                                    onclick="location.href='?page=<?= $page + 1 ?>'">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </nav>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>


    <script src="/assets/js/dashboard/dashboard.js"></script>
    <script>
        function deleteFunk(id) {
            if (!confirm('Da li ste sigurni da želite da obrišete ovaj događaj?')) {
                return; // korisnik je otkazao brisanje
            }

            fetch(`/events/${id}`, {
                method: 'DELETE',
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Greška pri brisanju događaja');
                    }
                    return response.json(); // ako nema JSON, možeš i samo return;
                })
                .then(data => {
                    window.location.reload();
                    // ovde možeš osvežiti prikaz događaja ili obavestiti korisnika
                })
                .catch(error => {
                    console.error('Greška:', error);
                });
        }
        // Mobile sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function () {

            const mobileMenuBtn = document.getElementById('mobile-menu');
            const sidebar = document.getElementById('sidebar');
            const sidebarClose = document.getElementById('sidebar-close');
            const overlay = document.getElementById('overlay');

            function toggleSidebar() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            }

            mobileMenuBtn.addEventListener('click', toggleSidebar);
            sidebarClose.addEventListener('click', toggleSidebar);
            overlay.addEventListener('click', toggleSidebar);

            // Close sidebar when clicking outside on desktop
            document.addEventListener('click', function (event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnMobileMenu = mobileMenuBtn.contains(event.target);

                if (!isClickInsideSidebar && !isClickOnMobileMenu && window.innerWidth < 768 && sidebar.classList.contains('active')) {
                    toggleSidebar();
                }
            });
        });
    </script>
    <script src="/assets/js/dashboard/events.js" defer></script>

    <script src="/assets/js/dashboard/mobileMenu.js" defer></script>

</body>


</html>
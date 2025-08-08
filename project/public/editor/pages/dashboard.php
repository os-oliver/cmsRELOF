<?php
use App\Controllers\AuthController;
use App\Controllers\VisitCounterController;
use App\Models\Document;
use App\Models\User;

use App\Models\Event;

$documentModal = new Document;
$eventModel = new Event;

AuthController::requireEditor();
[$name, $surname, $role] = AuthController::getUserInfo();
error_log($name);

$views = (new VisitCounterController())->getVisitCount();
[$_, $totalUsers] = (new User())->list();
$categories = $eventModel->getCategories();
[$events, $totalEvents] = $eventModel->all();

[
    $documents,
    $totalDocuments
] = $documentModal->list(3);
$DocumentCategories = $documentModal->getCategories();




?>
<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontrolni Panel - Administracija</title>
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
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        }

        .floating-btn {
            box-shadow: 0 10px 25px -5px rgba(2, 132, 199, 0.3);
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
    <?php require_once __DIR__ . '/../components/documentInputForm.php' ?>
    <div class="flex h-screen overflow-hidden">
        <!-- Light Glass Sidebar -->
        <?php
        $activeTab = "dashboard";
        require_once __DIR__ . "/../components/sidebar.php" ?>


        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <?php require_once __DIR__ . "/../components/topBar.php" ?>
            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                <!-- Dashboard Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">
                    <div class="stat-card p-4 md:p-5 rounded-xl border border-gray-200 transition-all duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-primary-600">Ukupno Pregleda</p>
                                <p class="text-xl md:text-2xl font-bold text-gray-800 mt-1"><?= $views ?></p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-lg">
                                <i class="fas fa-eye text-primary-600 text-xl"></i>
                            </div>
                        </div>

                    </div>

                    <div class="stat-card p-4 md:p-5 rounded-xl border border-gray-200 transition-all duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-primary-600">Dokumenti</p>
                                <p class="text-xl md:text-2xl font-bold text-gray-800 mt-1"><?= $totalDocuments ?></p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-lg">
                                <i class="fas fa-file-alt text-primary-600 text-xl"></i>
                            </div>
                        </div>

                    </div>

                    <div class="stat-card p-4 md:p-5 rounded-xl border border-gray-200 transition-all duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-primary-600">Događaji</p>
                                <p class="text-xl md:text-2xl font-bold text-gray-800 mt-1"><?= $totalEvents ?></p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-lg">
                                <i class="fas fa-calendar-alt text-primary-600 text-xl"></i>
                            </div>
                        </div>

                    </div>

                    <div class="stat-card p-4 md:p-5 rounded-xl border border-gray-200 transition-all duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-primary-600">Korisnici</p>
                                <p class="text-xl md:text-2xl font-bold text-gray-800 mt-1"><?= $totalUsers ?></p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-lg">
                                <i class="fas fa-users text-primary-600 text-xl"></i>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <?php require_once __DIR__ . "/../components/documents.php" ?>
                    <?php require_once __DIR__ . "/../components/events.php" ?>
                </div>


            </main>

        </div>
    </div>

    <!-- Floating Action Button -->
    <button
        class="floating-btn fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white rounded-full flex items-center justify-center shadow-xl transition-all z-20">
        <i class="fas fa-plus text-2xl"></i>
    </button>
    <script src="/assets/js/dashboard/dashboard.js"></script>
    <script>


        // Mobile sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function () {
            const newDocument = document.getElementById("newDocumentBtn");
            const form = document.getElementById("newDocument");
            const mobileMenuBtn = document.getElementById('mobile-menu');
            const sidebar = document.getElementById('sidebar');
            const sidebarClose = document.getElementById('sidebar-close');
            const overlay = document.getElementById('overlay');

            function toggleSidebar() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            }
            function showDocumentModal() {
                document.getElementById("endpoint").value = "/document"
                form.classList.remove("invisible");
                form.classList.add("visible");
            }
            newDocument.addEventListener('click', showDocumentModal)
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
</body>

</html>
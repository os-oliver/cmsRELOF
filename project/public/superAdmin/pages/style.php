<?php
use App\Controllers\AuthController;
AuthController::requireAdmin();
?>
<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= __('style.admin_panel') ?>
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366F1',
                        secondary: '#06B6D4',
                        accent: '#F59E0B',
                        success: '#10B981',
                        danger: '#EF4444',
                        dark: '#0F172A',
                        light: '#F8FAFC'
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.4s ease-out',
                        'bounce-gentle': 'bounceGentle 2s infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounceGentle {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            z-index: 50;
        }

        .content-area {
            background: linear-gradient(135deg, #F1F5F9 0%, #E2E8F0 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .page-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .page-card:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.95);
        }

        .nav-item {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .nav-item.active {
            background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }

        .floating-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(1px);
            animation: float 6s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }



        .modal-content {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            transform: translateY(20px);
            transition: transform 0.3s ease;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }

        /* Mobile Responsive Styles */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: 256px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .content-area {
                margin-left: 0 !important;
                width: 100%;
            }

            .mobile-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 40;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .mobile-overlay.active {
                opacity: 1;
                visibility: visible;
            }
        }

        @media (max-width: 768px) {
            .main-grid {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
                margin: 1rem !important;
            }

            .floating-orb {
                display: none;
            }

            .page-card {
                padding: 1rem !important;
            }

            .glass-effect {
                margin: 0.5rem;
                padding: 1rem !important;
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr !important;
            }

            .activity-item {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 0.5rem;
            }
        }
    </style>
</head>

<body class="bg-gray-50 font-sans overflow-x-hidden">
    <!-- Modal Overlay -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-content">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800" id="modalTitle">
                        <?= __('style.new_page') ?>
                    </h3>
                    <button id="closeModalBtn" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="pageForm" class="space-y-4">
                    <input type="hidden" id="pageId">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <?= __('style.page_title') ?>
                        </label>
                        <input type="text" id="pageName" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <?= __('style.path') ?>
                        </label>
                        <input type="text" id="pagePath" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <?= __('style.url') ?>
                        </label>
                        <input type="text" id="pageHref" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <?= __('style.status_text') ?>
                        </label>
                        <div class="grid grid-cols-3 gap-2">
                            <button type="button" data-status="1"
                                class="status-option bg-green-100 text-green-700 py-2 rounded-lg">
                                <?= __('style.active') ?>
                            </button>
                            <button type="button" data-status="0"
                                class="status-option bg-yellow-100 text-yellow-700 py-2 rounded-lg">
                                <?= __('style.in_progress') ?>
                            </button>
                            <button type="button" data-status="-1"
                                class="status-option bg-red-100 text-red-700 py-2 rounded-lg">
                                <?= __('style.inactive') ?>
                            </button>
                        </div>
                        <input type="hidden" id="pageStatus" value="1">
                    </div>

                    <div class="pt-4 flex space-x-3">
                        <button type="submit" class="btn-primary text-white px-6 py-2 rounded-lg font-medium flex-1">
                            <?= __('style.save') ?>
                        </button>
                        <button type="button" id="cancelBtn"
                            class="border border-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium flex-1">
                            <?= __('style.cancel') ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div class="mobile-overlay" id="mobileOverlay"></div>

    <!-- Floating Background Orbs -->
    <div class="floating-orb w-72 h-72 bg-gradient-to-r from-purple-400 to-pink-400 opacity-10"
        style="top: 10%; right: 10%;"></div>
    <div class="floating-orb w-96 h-96 bg-gradient-to-r from-blue-400 to-cyan-400 opacity-10"
        style="bottom: 10%; left: 10%; animation-delay: -3s;"></div>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <?php
        $activeTab = 'pages';
        require_once __DIR__ . "/../components/sidebar.php"; ?>

        <!-- Main Content -->
        <div class="content-area flex-1 min-h-screen">
            <!-- Mobile Header -->
            <div class="lg:hidden bg-white shadow-sm p-4 flex items-center justify-between">
                <button class="text-gray-600 text-xl" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-lg font-bold text-gray-800">
                    <?= __('style.admin_panel_short') ?>
                </h1>
                <div class="w-8"></div>
            </div>

            <!-- Top Bar -->
            <div class="main-grid m-4 lg:m-12 grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Pages List -->
                <div class="lg:col-span-1 h-full space-y-8">
                    <div class="glass-effect rounded-2xl shadow-2xl p-4 lg:p-6 animate-slide-up">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                            <h3
                                class="text-lg lg:text-xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                                <?= __('style.pages_list') ?>
                            </h3>
                            <button id="newPageBtn"
                                class="btn-primary text-white px-4 py-2 rounded-lg font-medium flex items-center w-full sm:w-auto justify-center">
                                <i class="fas fa-plus mr-2"></i>
                                <?= __('style.new') ?>
                            </button>
                            <button id="saveState"
                                class="btn-primary text-white px-4 py-2 rounded-lg font-medium flex items-center w-full sm:w-auto justify-center">
                                <i class="fas fa-floppy-disk mr-2"></i>
                                <?= __('style.save_button') ?>
                            </button>
                        </div>

                        <!-- Search and Filters -->
                        <div class="mb-6">
                            <div class="relative">
                                <input type="text" placeholder="<?= __('style.search_placeholder') ?>"
                                    class="search-input w-full py-3 px-4 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">
                                <i class="fas fa-search absolute right-4 top-3.5 text-gray-400"></i>
                            </div>

                            <div class="flex mt-4 space-x-2 overflow-x-auto pb-2">
                                <button
                                    class="filter-btn active text-xs bg-primary text-white px-3 py-1.5 rounded-lg hover:bg-primary/80 transition whitespace-nowrap"
                                    data-filter="all">
                                    <?= __('style.all') ?>
                                </button>
                                <button
                                    class="filter-btn text-xs bg-green-100 text-green-700 px-3 py-1.5 rounded-lg hover:bg-green-200 transition whitespace-nowrap"
                                    data-filter="active">
                                    <?= __('style.active_plural') ?>
                                </button>
                                <button
                                    class="filter-btn text-xs bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded-lg hover:bg-yellow-200 transition whitespace-nowrap"
                                    data-filter="draft">
                                    <?= __('style.in_progress_search') ?>
                                </button>
                                <button
                                    class="filter-btn text-xs bg-red-100 text-red-700 px-3 py-1.5 rounded-lg hover:bg-red-200 transition whitespace-nowrap"
                                    data-filter="inactive">
                                    <?= __('style.inactive_plural') ?>
                                </button>
                            </div>
                        </div>

                        <!-- Loading Indicator -->
                        <div id="loading-indicator" class="text-center py-8">
                            <i class="fas fa-spinner fa-spin text-2xl text-primary"></i>
                            <p class="text-gray-500 mt-2">
                                <?= __('style.loading_pages') ?>
                            </p>
                        </div>

                        <!-- Pages List Container -->
                        <div id="pages-list-container"
                            class="space-y-4 max-h-[400px] lg:max-h-[600px] overflow-y-auto pr-2 hidden">
                            <!-- Page cards will be loaded here from JSON -->
                        </div>

                        <!-- Error Message -->
                        <div id="error-message" class="text-center py-8 hidden">
                            <i class="fas fa-exclamation-triangle text-2xl text-red-500"></i>
                            <p class="text-red-500 mt-2">
                                <?= __('style.error_loading_pages') ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="lg:col-span-2">
                    <div class="glass-effect rounded-2xl shadow-2xl p-4 lg:p-6 animate-slide-up">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                            <div>
                                <h1 class="text-xl lg:text-2xl font-bold text-gray-800">
                                    <?= __('style.page_management') ?>
                                </h1>
                                <p class="text-gray-600 text-sm lg:text-base">
                                    <?= __('style.page_description') ?>
                                </p>
                            </div>
                            <div class="flex space-x-3">
                                <button
                                    class="action-btn bg-blue-100 text-blue-600 p-2 rounded-lg hover:bg-blue-200 transition">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <a id="stylePage"
                                    class="action-btn bg-purple-100 text-purple-600 p-2 rounded-lg hover:bg-purple-200 transition">
                                    <i class="fas fa-brush"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Page Preview -->
                        <div class="bg-white rounded-xl border border-gray-200 p-4 mb-8">
                            <div
                                class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-4">
                                <h2 class="text-lg font-semibold text-gray-800" id="preview-title">
                                    <?= __('style.select_page') ?>
                                </h2>
                                <div class="flex space-x-2 w-full sm:w-auto">
                                    <button id="editPageBtn"
                                        class="text-xs bg-gray-100 text-gray-700 px-3 py-1.5 rounded-lg hover:bg-gray-200 transition flex-1 sm:flex-none">
                                        <?= __('style.edit') ?>
                                    </button>
                                    <button id="deletePageBtn"
                                        class="text-xs bg-red-100 text-red-700 px-3 py-1.5 rounded-lg hover:bg-red-200 transition flex-1 sm:flex-none">
                                        <?= __('style.delete') ?>
                                    </button>
                                </div>
                            </div>

                            <div
                                class="h-32 lg:h-48 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg flex items-center justify-center mb-4">
                                <div class="text-center">
                                    <i class="fas fa-globe text-2xl lg:text-4xl text-blue-400 mb-2"></i>
                                    <p class="text-gray-600 text-sm lg:text-base" id="preview-url">
                                        <?= __('style.select_page_view') ?>
                                    </p>
                                </div>
                            </div>

                            <div class="stats-grid grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-500">
                                        <?= __('style.status') ?>
                                    </p>
                                    <p class="font-medium" id="preview-status">-</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-500">
                                        <?= __('style.path_label') ?>
                                    </p>
                                    <p class="font-medium text-xs lg:text-sm truncate" id="preview-path">-</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-500">
                                        <?= __('style.date') ?>
                                    </p>
                                    <p class="font-medium" id="preview-date">-</p>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                <?= __('style.determine_status') ?>
                            </h3>
                            <div class="space-y-4">
                                <div id="status-buttons" class="flex space-x-4">
                                    <button data-status="active"
                                        class="status-btn flex-1 py-2 rounded-xl border-2 border-green-500 text-green-700 bg-green-100">
                                        <?= __('style.active_activity') ?>
                                    </button>
                                    <button data-status="draft"
                                        class="status-btn flex-1 py-2 rounded-xl border-2 border-gray-300 text-gray-600 bg-gray-100">
                                        <?= __('style.in_progress_activity') ?>
                                    </button>
                                    <button data-status="inactive"
                                        class="status-btn flex-1 py-2 rounded-xl border-2 border-gray-300 text-gray-600 bg-gray-100">
                                        <?= __('style.inactive_activity') ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/js/superAdmin/main.js"></script>

</body>

</html>
<?php
use App\Controllers\AuthController;


AuthController::requireEditor();
[$name, $surname, $role] = AuthController::getUserInfo();

AuthController::requireEditor();
[$name, $surname] = AuthController::getUserInfo();

?>
<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= __("complaints.dashboard") ?></title>
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
        $activeTab = "complaints";
        require_once __DIR__ . "/../components/sidebar.php" ?>


        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <?php require_once __DIR__ . "/../components/topBar.php" ?>
            <!-- Content Area -->
            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-br from-light-50 to-light-100 p-6">
                <!-- Header Section -->
                <div class="mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-light-900 mb-2">
                                <?= __("complaints.complaints") ?>
                            </h1>
                            <p class="text-light-600">
                                <?= __("complaints.managing") ?>
                            </p>
                        </div>
                        <div class="mt-4 md:mt-0 flex flex-wrap gap-3">
                            <button
                                class="px-4 py-2 bg-white text-light-700 rounded-lg border border-light-200 hover:bg-light-50 transition-all duration-200 flex items-center gap-2">
                                <i class="fas fa-filter"></i>
                                <?= __("complaints.filter") ?>
                            </button>
                            <button
                                class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-all duration-200 flex items-center gap-2">
                                <i class="fas fa-plus"></i>
                                <?= __("complaints.new_complaint") ?>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Complaints -->
                    <div class="stat-card bg-white rounded-xl p-6 transition-all duration-300 hover:shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-light-600 text-sm font-medium">
                                    <?= __("complaints.total_complaints") ?>
                                </p>
                                <p class="text-2xl font-bold text-light-900 mt-1">247</p>
                                <p class="text-green-600 text-sm mt-1">
                                    <i class="fas fa-arrow-up text-xs"></i>
                                    <?= __("complaints.last_month") ?>
                                </p>
                            </div>
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-primary-100 to-primary-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-primary-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Complaints -->
                    <div class="stat-card bg-white rounded-xl p-6 transition-all duration-300 hover:shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-light-600 text-sm font-medium">
                                    <?= __("complaints.pending") ?>
                                </p>
                                <p class="text-2xl font-bold text-amber-600 mt-1">18</p>
                                <p class="text-amber-600 text-sm mt-1">
                                    <i class="fas fa-clock text-xs"></i>
                                    <?= __("complaints.requires_attention") ?>
                                </p>
                            </div>
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-amber-100 to-amber-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-hourglass-half text-amber-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Resolved Complaints -->
                    <div class="stat-card bg-white rounded-xl p-6 transition-all duration-300 hover:shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-light-600 text-sm font-medium">
                                    <?= __("complaints.resolved") ?>
                                </p>
                                <p class="text-2xl font-bold text-green-600 mt-1">201</p>
                                <p class="text-green-600 text-sm mt-1">
                                    <i class="fas fa-check text-xs"></i>
                                    <?= __("complaints.success_rate") ?>
                                </p>
                            </div>
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Average Response Time -->
                    <div class="stat-card bg-white rounded-xl p-6 transition-all duration-300 hover:shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-light-600 text-sm font-medium">
                                    <?= __("complaints.average_time") ?>
                                </p>
                                <p class="text-2xl font-bold text-primary-600 mt-1">2.4h</p>
                                <p class="text-primary-600 text-sm mt-1">
                                    <i class="fas fa-tachometer-alt text-xs"></i>
                                    <?= __("complaints.response_time") ?>
                                </p>
                            </div>
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-primary-100 to-primary-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-stopwatch text-primary-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div
                        class="action-card bg-white rounded-xl p-6 border border-light-200 hover:border-primary-200 transition-all duration-300 cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-red-100 to-red-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-exclamation text-red-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-light-900">
                                    <?= __("complaints.urgent_complaints") ?>
                                </h3>
                                <p class="text-light-600 text-sm">
                                    <?= __("complaints.urgent_attention") ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="action-card bg-white rounded-xl p-6 border border-light-200 hover:border-primary-200 transition-all duration-300 cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-line text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-light-900">
                                    <?= __("complaints.monthly_report") ?>
                                </h3>
                                <p class="text-light-600 text-sm">
                                    <?= __("complaints.generate_report") ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="action-card bg-white rounded-xl p-6 border border-light-200 hover:border-primary-200 transition-all duration-300 cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-light-900">
                                    <?= __("complaints.customer_support") ?>
                                </h3>
                                <p class="text-light-600 text-sm">
                                    <?= __("complaints.contact_support") ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Complaints Table -->
                <div class="content-card bg-white rounded-xl shadow-sm border border-light-200">
                    <!-- Table Header -->
                    <div class="p-6 border-b border-light-200">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <h2 class="text-xl font-semibold text-light-900">
                                <?= __("complaints.latest_complaints") ?>
                            </h2>
                            <div class="mt-4 md:mt-0 flex items-center gap-3">
                                <div class="relative">
                                    <input type="text" placeholder="<?= __("complaints.search_complaints") ?>"
                                        class="pl-10 pr-4 py-2 border border-light-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                    <i
                                        class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-light-400"></i>
                                </div>
                                <select
                                    class="px-3 py-2 border border-light-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                                    <option>
                                        <?= __("complaints.categories") ?>
                                    </option>
                                    <option>
                                        <?= __("complaints.technical_issues") ?>
                                    </option>
                                    <option>
                                        <?= __("complaints.billing") ?>
                                    </option>
                                    <option>
                                        <?= __("complaints.service") ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Table Content -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-light-50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-light-600 uppercase tracking-wider">
                                        <?= __("complaints.user") ?>
                                    </th>

                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-light-600 uppercase tracking-wider">
                                        <?= __("complaints.title") ?>
                                    </th>

                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-light-600 uppercase tracking-wider">
                                        <?= __("complaints.category") ?>>
                                    </th>

                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-light-600 uppercase tracking-wider">
                                        <?= __("complaints.status") ?>
                                    </th>

                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-light-600 uppercase tracking-wider">
                                        <?= __("complaints.date") ?>
                                    </th>

                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-light-600 uppercase tracking-wider">
                                        <?= __("complaints.actions") ?>
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-light-200">
                                <!-- Row 1 -->
                                <tr class="hover:bg-light-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-primary-100 to-primary-200 rounded-full flex items-center justify-center">
                                                <span class="text-primary-700 font-semibold text-sm">MP</span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-light-900">#2024-001</div>
                                                <div class="text-sm text-light-600">Marko Petrović</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-light-900 font-medium">
                                            <?= __("complaints.login_issue") ?>
                                        </div>
                                        <div class="text-sm text-light-600">
                                            <?= __("complaints.not_been_able") ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <?= __("complaints.technical") ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                            <i class="fas fa-clock text-amber-600 mr-1"></i>
                                            <?= __("complaints.pending2") ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <?= __("complaints.high") ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-light-600">
                                        24.06.2025
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-2">
                                            <button
                                                class="text-primary-600 hover:text-primary-900 p-1 rounded transition-colors">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button
                                                class="text-green-600 hover:text-green-900 p-1 rounded transition-colors">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button
                                                class="text-light-600 hover:text-light-900 p-1 rounded transition-colors">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 2 -->
                                <tr class="hover:bg-light-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center">
                                                <span class="text-green-700 font-semibold text-sm">AJ</span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-light-900">#2024-002</div>
                                                <div class="text-sm text-light-600">Ana Jovanović</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-light-900 font-medium">
                                            <?= __("complaints.incorrect_billing") ?>
                                        </div>
                                        <div class="text-sm text-light-600">
                                            <?= __("complaints.double_amount") ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            <?= __("complaints.billing2") ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-cog text-blue-600 mr-1"></i>
                                            <?= __("complaints.in_progress") ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                            <?= __("complaints.medium") ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-light-600">
                                        23.06.2025
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-2">
                                            <button
                                                class="text-primary-600 hover:text-primary-900 p-1 rounded transition-colors">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button
                                                class="text-green-600 hover:text-green-900 p-1 rounded transition-colors">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button
                                                class="text-light-600 hover:text-light-900 p-1 rounded transition-colors">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>


                                <!-- Row 3 -->
                                <tr class="hover:bg-light-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-orange-100 to-orange-200 rounded-full flex items-center justify-center">
                                                <span class="text-orange-700 font-semibold text-sm">DS</span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-light-900">#2024-003</div>
                                                <div class="text-sm text-light-600">Dragan Stojanović</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-light-900 font-medium">
                                            <?= __("complaints.dissatisfaction") ?>
                                        </div>
                                        <div class="text-sm text-light-600">
                                            <?= __("complaints.unprofessional") ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <?= __("complaints.service2") ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check text-green-600 mr-1"></i>
                                            <?= __("complaints.resolved2") ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <?= __("complaints.low") ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-light-600">
                                        22.06.2025
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-2">
                                            <button
                                                class="text-primary-600 hover:text-primary-900 p-1 rounded transition-colors">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button
                                                class="text-green-600 hover:text-green-900 p-1 rounded transition-colors opacity-50 cursor-not-allowed">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button
                                                class="text-light-600 hover:text-light-900 p-1 rounded transition-colors">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Row 4 -->
                                <tr class="hover:bg-light-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-pink-100 to-pink-200 rounded-full flex items-center justify-center">
                                                <span class="text-pink-700 font-semibold text-sm">MN</span>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-light-900">#2024-004</div>
                                                <div class="text-sm text-light-600">Milica Nikolić</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-light-900 font-medium">
                                            <?= __("complaints.slow_performance") ?>
                                        </div>
                                        <div class="text-sm text-light-600">
                                            <?= __("complaints.frequently_crashes") ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <?= __("complaints.technical2") ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                            <i class="fas fa-clock text-amber-600 mr-1"></i>
                                            <?= __("complaints.pending3") ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                            <?= __("complaints.medium2") ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-light-600">
                                        21.06.2025
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end gap-2">
                                            <button
                                                class="text-primary-600 hover:text-primary-900 p-1 rounded transition-colors">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button
                                                class="text-green-600 hover:text-green-900 p-1 rounded transition-colors">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button
                                                class="text-light-600 hover:text-light-900 p-1 rounded transition-colors">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Table Footer -->
                    <div class="px-6 py-4 border-t border-light-200">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="text-sm text-light-600">
                                <?= __("complaints.showing") ?>
                            </div>
                            <div class="mt-3 md:mt-0">
                                <nav class="flex items-center gap-1">
                                    <button
                                        class="px-3 py-2 text-sm text-light-600 hover:text-light-900 hover:bg-light-100 rounded-lg transition-all">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button class="px-3 py-2 text-sm bg-primary-600 text-white rounded-lg">1</button>
                                    <button
                                        class="px-3 py-2 text-sm text-light-600 hover:text-light-900 hover:bg-light-100 rounded-lg transition-all">2</button>
                                    <button
                                        class="px-3 py-2 text-sm text-light-600 hover:text-light-900 hover:bg-light-100 rounded-lg transition-all">3</button>
                                    <span class="px-3 py-2 text-sm text-light-400">...</span>
                                    <button
                                        class="px-3 py-2 text-sm text-light-600 hover:text-light-900 hover:bg-light-100 rounded-lg transition-all">62</button>
                                    <button
                                        class="px-3 py-2 text-sm text-light-600 hover:text-light-900 hover:bg-light-100 rounded-lg transition-all">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>

    <script src="/assets/js/editor/editor.js"></script>
    <script>
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
</body>

</html>
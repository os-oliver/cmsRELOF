<?php
session_start();

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Expires: Sun, 01 Jan 2000 00:00:00 GMT');

$js_file_path = __DIR__ . '/../../assets/js/dashboard/staticPageBuilder.js';
$version = file_exists($js_file_path) ? filemtime($js_file_path) : time();
use App\Controllers\AuthController;

// Require editor authentication
AuthController::requireEditor();
[$name, $surname, $role] = AuthController::getUserInfo();
use App\Utils\LocaleManager;
$locale = LocaleManager::get();

?>

<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upravljanje stranicama</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

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
                    },
                    boxShadow: {
                        'soft': '0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)',
                        'card': '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
                        'hover': '0 4px 25px -2px rgba(14, 165, 233, 0.15)',
                    }
                }
            }
        }
    </script>

    <style>
        .glass-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(14, 165, 233, 0.15);
        }

        .draggable-card {
            cursor: grab;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, #ffffff 0%, #fafbff 100%);
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 1;
            will-change: transform, opacity;
        }

        .draggable-card:hover {
            transform: translateZ(0) translateY(-2px);
            box-shadow: 0 8px 25px -5px rgba(14, 165, 233, 0.15);
            border-color: #0ea5e9;
        }

        .draggable-card:active {
            cursor: grabbing;
        }

        .draggable-card.dragging {
            opacity: 0.75;
            transform: translateZ(0) translateY(-8px) scale(1.02);
            z-index: 1000;
            box-shadow: 0 20px 40px -10px rgba(14, 165, 233, 0.35);
            border-color: #0ea5e9;
        }

        .PageColumns-track {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px -4px rgba(0, 0, 0, 0.08);
            width: 320px;
            flex-shrink: 0;
        }

        .track-header {
            background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
            position: relative;
            overflow: hidden;
        }

        .track-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .drop-zone {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 300px;
            background: transparent;
            position: relative;
            overflow: hidden;
        }

        .drop-zone.drag-over {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.05) 0%, rgba(14, 165, 233, 0.1) 100%);
        }

        .drop-zone.drag-over::after {
            content: 'Otpustite ovde';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #0ea5e9;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            pointer-events: none;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }

        #all-pages-container.drop-zone {
            min-height: 100px;
            max-height: max-content;
            border-radius: 12px;
            position: relative;
            transition: min-height 0.3s ease;
            overflow: hidden;
            /* prevent children transforms from expanding parent */
        }

        #all-pages-container:empty {
            min-height: 120px;
        }

        #all-pages-container.drop-zone.drag-over {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.05) 0%, rgba(14, 165, 233, 0.1) 100%);
            outline: 2px dashed #0ea5e9;
            outline-offset: -8px;
        }

        #all-pages-container.drag-over #unassigned-placeholder {
            display: block !important;
        }

        .add-track-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 300px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 3px dashed #cbd5e1;
            border-radius: 16px;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            width: 320px;
            flex-shrink: 0;
        }

        .add-track-container:hover {
            border-color: #0ea5e9;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            transform: scale(1.02);
        }

        .add-track-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.05) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .add-track-container:hover::before {
            opacity: 1;
        }

        .page-icon {
            background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .status-badge {
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .action-button {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .action-button:hover {
            transform: translateY(-1px);
        }

        /* All Pages Section Enhancement */
        .all-pages-section {
            background: linear-gradient(135deg, #ffffff 0%, #fafbff 100%);
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px -4px rgba(0, 0, 0, 0.08);
        }

        .section-header {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            position: relative;
            overflow: hidden;
        }

        .delete-track-btn {
            opacity: 0;
            transition: all 0.2s ease;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .PageColumns-track:hover .delete-track-btn {
            opacity: 1;
        }

        .delete-track-btn:hover {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        /* Responsive grid */
        .staticke-stranice-grid {
            display: flex;
            gap: 24px;
            align-items: start;
            overflow-x: auto;
            padding-bottom: 20px;
        }

        .PageColumns-container {
            overflow-x: auto;
            overflow-y: visible;
            padding-bottom: 20px;
        }

        /* Custom scrollbar */
        .PageColumns-container::-webkit-scrollbar {
            height: 8px;
        }

        .PageColumns-container::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .PageColumns-container::-webkit-scrollbar-thumb {
            background: linear-gradient(90deg, #cbd5e1, #94a3b8);
            border-radius: 4px;
        }

        .PageColumns-container::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(90deg, #94a3b8, #64748b);
        }

        .PageColumns-grid::-webkit-scrollbar {
            height: 8px;
        }

        .PageColumns-grid::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .PageColumns-grid::-webkit-scrollbar-thumb {
            background: linear-gradient(90deg, #cbd5e1, #94a3b8);
            border-radius: 4px;
        }

        .PageColumns-grid::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(90deg, #94a3b8, #64748b);
        }

        .PageColumns-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 text-gray-700 font-sans min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <?php
        $activeTab = 'stranice';
        require_once __DIR__ . '/../components/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <?php require_once __DIR__ . '/../components/topBar.php'; ?>

            <!-- Main Content Area -->
            <main class="flex-1 p-6 PageColumns-container overflow-auto">
                <!-- All Pages Section -->
                <div class="mb-8">
                    <div class="all-pages-section rounded-2xl overflow-hidden">
                        <div class="section-header text-white p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div>
                                        <h3 class="text-xl font-bold">Statičke Stranice</h3>
                                        <p class="text-sm opacity-90">Upravljajte statičkim stranicama sajta</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <button onclick="showAddPageModal()"
                                        class="bg-white bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-lg transition-all duration-300 flex items-center">
                                        <i class="fas fa-plus mr-2"></i>
                                        <span>Nova Stranica</span>
                                    </button>
                                    <div class="flex space-x-4">
                                        <div class="bg-white bg-opacity-20 px-4 py-2 rounded-full">
                                            <span class="font-semibold" id="total-pages-count">0</span>
                                            <span class="text-sm opacity-90">ukupno stranica</span>
                                        </div>
                                        <div class="bg-white bg-opacity-20 px-4 py-2 rounded-full">
                                            <span class="font-semibold" id="unassigned-pages-count">0</span>
                                            <span class="text-sm opacity-90">nedodeljenih</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 drop-zone"
                                id="all-pages-container" data-column-id="unassigned">
                                <!-- Pages will be inserted here -->
                                <div id="unassigned-placeholder"
                                    class="col-span-full text-center text-gray-400 py-12 hidden">
                                    <i class="fas fa-inbox text-3xl mb-4"></i>
                                    <p>Prevucite stranice ovde da ih uklonite iz kategorije</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Staticke Stranice Header with Add and Save buttons -->
                <div class="PageColumns-header">
                    <h2 class="text-2xl font-bold text-gray-800">Statičke Stranice</h2>
                    <div class="flex space-x-3">
                        <button id="save-PageColumns-btn"
                            class="bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-6 py-3 rounded-xl font-medium transition-all flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Sačuvaj
                        </button>
                        <button id="add-column-btn"
                            class="bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white px-6 py-3 rounded-xl font-medium transition-all flex items-center">
                            <i class="fas fa-plus mr-2"></i>
                            Dodaj Novu Kategoriju
                        </button>
                    </div>
                </div>

                <!-- Staticke Stranice Sekcije -->
                <div class="staticke-stranice-grid" id="PageColumns-board">
                    <!-- Sekcije će biti kreirane pomoću JavaScript-a -->
                </div>
            </main>
        </div>
    </div>

    <!-- Add Track Modal -->
    <div id="add-column-modal"
        class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[999] backdrop-blur-sm">
        <div class="bg-white rounded-2xl p-8 w-full max-w-md mx-4 shadow-2xl">
            <div class="text-center mb-6">
                <div
                    class="mx-auto w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-plus text-white text-xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900">Dodaj novu kategoriju</h3>
                <p class="text-gray-600 mt-2">Kreirajte novu kategoriju za organizovanje stranica</p>
            </div>
            <input type="text" id="column-name-input" placeholder="Unesite naziv kategorije..."
                class="w-full p-4 border border-gray-200 rounded-xl mb-6 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-lg">
            <div class="flex space-x-3">
                <button id="cancel-column"
                    class="flex-1 px-6 py-3 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition-colors font-medium">
                    Otkaži
                </button>
                <button id="confirm-add-column"
                    class="flex-1 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white px-6 py-3 rounded-xl font-medium transition-all">
                    Dodaj kategoriju
                </button>
            </div>
        </div>
    </div>
    <script>
        const oldScript = document.querySelector('script[data-static-builder]');
        if (oldScript) oldScript.remove();
        const script = document.createElement('script');
        script.src = `/assets/js/dashboard/staticPageBuilder.js?cb=${Date.now()}`;
        script.defer = true;
        script.dataset.staticBuilder = "true";
        document.head.appendChild(script);
    </script>


</body>

<!-- Add Page Modal -->
<div id="add-page-modal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[999] backdrop-blur-sm">
    <div class="bg-white rounded-2xl p-8 w-full max-w-md mx-4 shadow-2xl">
        <div class="text-center mb-6">
            <div
                class="mx-auto w-16 h-16 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-file-alt text-white text-xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900">Nova Statička Stranica</h3>
            <p class="text-gray-600 mt-2">Unesite naziv za novu statičku stranicu</p>
        </div>
        <input type="text" id="page-name-input" placeholder="Naziv stranice..."
            class="w-full p-4 border border-gray-200 rounded-xl mb-6 focus:ring-2 focus:ring-primary-500 focus:border-transparent text-lg">
        <div class="flex space-x-3">
            <button onclick="hideAddPageModal()"
                class="flex-1 px-6 py-3 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition-colors font-medium">
                Otkaži
            </button>
            <button onclick="handleAddPage()"
                class="flex-1 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white px-6 py-3 rounded-xl font-medium transition-all">
                Dodaj Stranicu
            </button>
        </div>
    </div>
</div>

</html>
<?php
use App\Controllers\AuthController;
AuthController::requireAdmin();
if (isset($_GET['locale'])) {
    $_SESSION['locale'] = $_GET['locale'];
}
$locale = $_SESSION['locale'] ?? 'sr-Cyrl';
?>
<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
            switch ($locale) {
                case 'sr': echo 'Admin Panel - Uređivač Stranica'; break;
                case 'en': echo 'Admin Panel – Page editor'; break;
                default: echo 'Админ Панел – Уређивач страница'; break;
            }
        ?>
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
                        <?php
                            switch ($locale) {
                                case 'sr': echo 'Nova stranica'; break;
                                case 'en': echo 'New page'; break;
                                default: echo 'Нова страница'; break;
                            }
                        ?>
                        
                    </h3>
                    <button id="closeModalBtn" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="pageForm" class="space-y-4">
                    <input type="hidden" id="pageId">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <?php
                                switch ($locale) {
                                    case 'sr': echo 'Naziv stranice'; break;
                                    case 'en': echo 'Page title'; break;
                                    default: echo 'Назив странице'; break;
                                }
                            ?>
                        </label>
                        <input type="text" id="pageName" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <?php
                                switch ($locale) {
                                    case 'sr': echo 'Putanja (path)'; break;
                                    case 'en': echo 'Path'; break;
                                    default: echo 'Путања (path)'; break;
                                }
                            ?>
                        </label>
                        <input type="text" id="pagePath" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <?php
                                switch ($locale) {
                                    case 'sr': echo 'URL (href)'; break;
                                    case 'en': echo 'URL (href)'; break;
                                    default: echo 'УРЛ (href)'; break;
                                }
                            ?>
                        </label>
                        <input type="text" id="pageHref" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <?php
                                switch ($locale) {
                                    case 'sr': echo 'Status'; break;
                                    case 'en': echo 'Status'; break;
                                    default: echo 'Статус'; break;
                                }
                            ?>
                        </label>
                        <div class="grid grid-cols-3 gap-2">
                            <button type="button" data-status="active"
                                class="status-option bg-green-100 text-green-700 py-2 rounded-lg">
                                    <?php
                                        switch ($locale) {
                                            case 'sr': echo 'Aktivan'; break;
                                            case 'en': echo 'Active'; break;
                                            default: echo 'Активан'; break;
                                        }
                                    ?>
                            </button>
                            <button type="button" data-status="draft"
                                class="status-option bg-yellow-100 text-yellow-700 py-2 rounded-lg">
                                <?php
                                    switch ($locale) {
                                        case 'sr': echo 'U izradi'; break;
                                        case 'en': echo 'In progress'; break;
                                        default: echo 'У изради'; break;
                                    }
                                ?>
                            </button>
                            <button type="button" data-status="inactive"
                                class="status-option bg-red-100 text-red-700 py-2 rounded-lg">
                                    <?php
                                        switch ($locale) {
                                            case 'sr': echo 'Neaktivan'; break;
                                            case 'en': echo 'Inactive'; break;
                                            default: echo 'Неактиван'; break;
                                        }
                                    ?>
                            </button>
                        </div>
                        <input type="hidden" id="pageStatus" value="active">
                    </div>

                    <div class="pt-4 flex space-x-3">
                        <button type="submit" class="btn-primary text-white px-6 py-2 rounded-lg font-medium flex-1">
                            <?php
                                switch ($locale) {
                                    case 'sr': echo 'Sačuvaj'; break;
                                    case 'en': echo 'Save'; break;
                                    default: echo 'Сачувај'; break;
                                }
                            ?>
                        </button>
                        <button type="button" id="cancelBtn"
                            class="border border-gray-300 text-gray-700 px-6 py-2 rounded-lg font-medium flex-1">
                            <?php
                                switch ($locale) {
                                    case 'sr': echo 'Otkaži'; break;
                                    case 'en': echo 'Cancel'; break;
                                    default: echo 'Откажи'; break;
                                }
                            ?>
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
                        <?php
                            switch ($locale) {
                                case 'sr': echo 'Admin panel'; break;
                                case 'en': echo 'Admin panel'; break;
                                default: echo 'Админ панел'; break;
                            }
                        ?>
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
                                <?php
                                    switch ($locale) {
                                        case 'sr': echo 'Lista Stranica'; break;
                                        case 'en': echo 'Pages list'; break;
                                        default: echo 'Листа страница'; break;
                                    }
                                ?>                               
                            </h3>
                            <button id="newPageBtn"
                                class="btn-primary text-white px-4 py-2 rounded-lg font-medium flex items-center w-full sm:w-auto justify-center">
                                <i class="fas fa-plus mr-2"></i>
                                    <?php
                                        switch ($locale) {
                                            case 'sr': echo 'Nova'; break;
                                            case 'en': echo 'New'; break;
                                            default: echo 'Нова'; break;
                                        }
                                    ?>
                            </button>
                            <button id="saveState"
                                class="btn-primary text-white px-4 py-2 rounded-lg font-medium flex items-center w-full sm:w-auto justify-center">
                                <i class="fas fa-floppy-disk mr-2"></i>
                                    <?php
                                        switch ($locale) {
                                            case 'sr': echo 'Sačuvaj'; break;
                                            case 'en': echo 'Save'; break;
                                            default: echo 'Сачувај'; break;
                                        }
                                    ?>
                            </button>
                        </div>

                        <!-- Search and Filters -->
                        <div class="mb-6">
                            <div class="relative">
                                <input type="text" placeholder=
                                    "<?php
                                        switch ($locale) {
                                            case 'sr': echo 'Pretraži stranice...'; break;
                                            case 'en': echo 'Search pages...'; break;
                                            default: echo 'Претражи странице...'; break;
                                        }
                                    ?>" 
                                    class="search-input w-full py-3 px-4 bg-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary">
                                <i class="fas fa-search absolute right-4 top-3.5 text-gray-400"></i>
                            </div>

                            <div class="flex mt-4 space-x-2 overflow-x-auto pb-2">
                                <button
                                    class="filter-btn active text-xs bg-primary text-white px-3 py-1.5 rounded-lg hover:bg-primary/80 transition whitespace-nowrap"
                                    data-filter="all">                                    
                                    <?php
                                        switch ($locale) {
                                            case 'sr': echo 'Sve'; break;
                                            case 'en': echo 'All'; break;
                                            default: echo 'Све'; break;
                                        }
                                    ?></button>
                                <button
                                    class="filter-btn text-xs bg-green-100 text-green-700 px-3 py-1.5 rounded-lg hover:bg-green-200 transition whitespace-nowrap"
                                    data-filter="active">                                    
                                    <?php
                                        switch ($locale) {
                                            case 'sr': echo 'Aktivne'; break;
                                            case 'en': echo 'Active'; break;
                                            default: echo 'Активне'; break;
                                        }
                                    ?></button>
                                <button
                                    class="filter-btn text-xs bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded-lg hover:bg-yellow-200 transition whitespace-nowrap"
                                    data-filter="draft">
                                    <?php
                                        switch ($locale) {
                                            case 'sr': echo 'U izradi'; break;
                                            case 'en': echo 'In progress'; break;
                                            default: echo 'У изради'; break;
                                        }
                                    ?></button>
                                <button
                                    class="filter-btn text-xs bg-red-100 text-red-700 px-3 py-1.5 rounded-lg hover:bg-red-200 transition whitespace-nowrap"
                                    data-filter="inactive">
                                    <?php
                                        switch ($locale) {
                                            case 'sr': echo 'Neaktivne'; break;
                                            case 'en': echo 'Inactive'; break;
                                            default: echo 'Неактивне'; break;
                                        }
                                    ?></button>
                            </div>
                        </div>

                        <!-- Loading Indicator -->
                        <div id="loading-indicator" class="text-center py-8">
                            <i class="fas fa-spinner fa-spin text-2xl text-primary"></i>
                            <p class="text-gray-500 mt-2">
                                <?php
                                    switch ($locale) {
                                        case 'sr': echo 'Učitavanje stranica...'; break;
                                        case 'en': echo 'Loading paegs'; break;
                                        default: echo 'Учитавање страница'; break;
                                    }
                                ?></p>
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
                                <?php
                                    switch ($locale) {
                                        case 'sr': echo 'Greška pri učitavanju stranica'; break;
                                        case 'en': echo 'Error loading pages'; break;
                                        default: echo 'Грешка при учитавању страница'; break;
                                    }
                                ?></p>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="lg:col-span-2">
                    <div class="glass-effect rounded-2xl shadow-2xl p-4 lg:p-6 animate-slide-up">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                            <div>
                                <h1 class="text-xl lg:text-2xl font-bold text-gray-800">
                                    <?php
                                        switch ($locale) {
                                            case 'sr': echo 'Upravljanje Stranicama'; break;
                                            case 'en': echo 'Page management'; break;
                                            default: echo 'Управљање страницама'; break;
                                        }
                                    ?>
                                </h1>
                                <p class="text-gray-600 text-sm lg:text-base">
                                    <?php
                                        switch ($locale) {
                                            case 'sr': echo 'Pregledajte i upravljajte svim stranicama na vašoj web stranici'; break;
                                            case 'en': echo 'View and manage all pages on your website'; break;
                                            default: echo 'Прегледајте и управљајте свим страницама на вашој веб страници'; break;
                                        }
                                    ?>
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
                                    <?php
                                        switch ($locale) {
                                            case 'sr': echo 'Odaberite stranicu'; break;
                                            case 'en': echo 'Select a page'; break;
                                            default: echo 'Одберите страницу'; break;
                                        }
                                    ?>
                                </h2>
                                <div class="flex space-x-2 w-full sm:w-auto">
                                    <button id="editPageBtn"
                                        class="text-xs bg-gray-100 text-gray-700 px-3 py-1.5 rounded-lg hover:bg-gray-200 transition flex-1 sm:flex-none">
                                        <?php
                                            switch ($locale) {
                                                case 'sr': echo 'Uredi'; break;
                                                case 'en': echo 'Edit'; break;
                                                default: echo 'Уреди'; break;
                                            }
                                        ?></button>
                                    <button id="deletePageBtn"
                                        class="text-xs bg-red-100 text-red-700 px-3 py-1.5 rounded-lg hover:bg-red-200 transition flex-1 sm:flex-none">
                                        <?php
                                            switch ($locale) {
                                                case 'sr': echo 'Obriši'; break;
                                                case 'en': echo 'Delete'; break;
                                                default: echo 'Обриши'; break;
                                            }
                                        ?></button>
                                </div>
                            </div>

                            <div
                                class="h-32 lg:h-48 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg flex items-center justify-center mb-4">
                                <div class="text-center">
                                    <i class="fas fa-globe text-2xl lg:text-4xl text-blue-400 mb-2"></i>
                                    <p class="text-gray-600 text-sm lg:text-base" id="preview-url">
                                        <?php
                                            switch ($locale) {
                                                case 'sr': echo 'Odaberite stranicu za pregled'; break;
                                                case 'en': echo 'Select a page to view'; break;
                                                default: echo 'Одберите страницу за преглед'; break;
                                            }
                                        ?></p>
                                </div>
                            </div>

                            <div class="stats-grid grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-500">
                                        <?php
                                            switch ($locale) {
                                                case 'sr': echo 'Status'; break;
                                                case 'en': echo 'Status'; break;
                                                default: echo 'Статус'; break;
                                            }
                                        ?></p>
                                    <p class="font-medium" id="preview-status">-</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-500">
                                        <?php
                                            switch ($locale) {
                                                case 'sr': echo 'Putanja'; break;
                                                case 'en': echo 'Path'; break;
                                                default: echo 'Путања'; break;
                                            }
                                        ?></p>
                                    <p class="font-medium text-xs lg:text-sm truncate" id="preview-path">-</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-xs text-gray-500">
                                        <?php
                                            switch ($locale) {
                                                case 'sr': echo 'Datum'; break;
                                                case 'en': echo 'Date'; break;
                                                default: echo 'Датум'; break;
                                            }
                                        ?></p>
                                    <p class="font-medium" id="preview-date">-</p>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                <?php
                                    switch ($locale) {
                                        case 'sr': echo 'Odredi trenutno stanje'; break;
                                        case 'en': echo 'Determine current status'; break;
                                        default: echo 'Одреди тренутно стање'; break;
                                    }
                                ?></h3>
                            <div class="space-y-4">
                                <div id="status-buttons" class="flex space-x-4">
                                    <button data-status="active"
                                        class="status-btn flex-1 py-2 rounded-xl border-2 border-green-500 text-green-700 bg-green-100">
                                            <?php
                                                switch ($locale) {
                                                    case 'sr': echo 'Aktivan'; break;
                                                    case 'en': echo 'Active'; break;
                                                    default: echo 'Активан'; break;
                                                }
                                            ?>
                                    </button>
                                    <button data-status="draft"
                                        class="status-btn flex-1 py-2 rounded-xl border-2 border-gray-300 text-gray-600 bg-gray-100">
                                        <?php
                                            switch ($locale) {
                                                case 'sr': echo 'U izradi'; break;
                                                case 'en': echo 'In progress'; break;
                                                default: echo 'У изради'; break;
                                            }
                                        ?>
                                    </button>
                                    <button data-status="inactive"
                                        class="status-btn flex-1 py-2 rounded-xl border-2 border-gray-300 text-gray-600 bg-gray-100">
                                            <?php
                                                switch ($locale) {
                                                    case 'sr': echo 'Neaktivan'; break;
                                                    case 'en': echo 'Inactive'; break;
                                                    default: echo 'Неактиван'; break;
                                                }
                                            ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const locale = "<?php echo $locale; ?>";
        let pagesData = [];
        // Sample data (in a real app, this would come from a server)
        async function loadPages() {
            const loadingIndicator = document.getElementById('loading-indicator');
            const container = document.getElementById('pages-list-container');
            const errorMessage = document.getElementById('error-message');

            try {
                loadingIndicator.classList.remove('hidden');
                container.classList.add('hidden');
                errorMessage.classList.add('hidden');

                // Try to load from dokumenti.json
                const response = await fetch('/assets/data/pages.json');

                if (!response.ok) {
                    throw new Error('Failed to load pages data');
                }

                const data = await response.json();

                // Transform data to include status and other properties
                pagesData = data.map(page => ({
                    ...page,
                }));

                loadingIndicator.classList.add('hidden');
                container.classList.remove('hidden');
                renderPages(pagesData);

            } catch (error) {
                console.error('Error loading pages:', error);

                // Fallback to sample data if JSON loading fails


                loadingIndicator.classList.add('hidden');
                container.classList.remove('hidden');
                renderPages(pagesData);
            }
        }        // Global variables
        let currentFilter = 'all';
        let selectedPageId = null;

        // DOM Elements
        const modalOverlay = document.getElementById('modalOverlay');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const pageForm = document.getElementById('pageForm');
        const newPageBtn = document.getElementById('newPageBtn');
        const editPageBtn = document.getElementById('editPageBtn');
        const deletePageBtn = document.getElementById('deletePageBtn');
        const statusButtons = document.querySelectorAll('.status-btn');
        const statusOptions = document.querySelectorAll('.status-option');
        const pageStatusInput = document.getElementById('pageStatus');
        const modalTitle = document.getElementById('modalTitle');

        // Mobile menu functionality
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');
        const closeSidebarBtn = document.getElementById('closeSidebarBtn');

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                mobileOverlay.classList.toggle('active');
            });

            if (closeSidebarBtn) {
                closeSidebarBtn.addEventListener('click', () => {
                    sidebar.classList.remove('active');
                    mobileOverlay.classList.remove('active');
                });
            }

            mobileOverlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                mobileOverlay.classList.remove('active');
            });
        }

        // Modal functionality
        function openModal(mode = 'create', pageData = null) {
            if (mode === 'create') {
                switch (locale) {
                    case 'sr':
                        modalTitle.textContent = 'Nova stranica';
                        break;
                    case 'en':
                        modalTitle.textContent = 'New page';
                        break;
                    default:
                        modalTitle.textContent = 'Нова страница';
                }
                pageForm.reset();
                document.getElementById('pageId').value = '';
                pageStatusInput.value = 'active';
                resetStatusOptions('active');
            } else if (mode === 'edit' && pageData) {
                switch (locale) {
                    case 'sr':
                        modalTitle.textContent = 'Uredi stranicu';
                        break;
                    case 'en':
                        modalTitle.textContent = 'Edit page';
                        break;
                    default:
                        modalTitle.textContent = 'Уреди страницу';
                }
                document.getElementById('pageId').value = pageData.id;
                document.getElementById('pageName').value = pageData.name;
                document.getElementById('pagePath').value = pageData.path;
                document.getElementById('pageHref').value = pageData.href;
                pageStatusInput.value = pageData.status;
                resetStatusOptions(pageData.status);
            }

            modalOverlay.classList.add('active');
        }

        function closeModal() {
            modalOverlay.classList.remove('active');
        }

        closeModalBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                closeModal();
            }
        });

        // Status options in modal
        function resetStatusOptions(activeStatus) {
            statusOptions.forEach(option => {
                option.classList.remove('bg-green-100', 'bg-yellow-100', 'bg-red-100',
                    'text-green-700', 'text-yellow-700', 'text-red-700');

                if (option.dataset.status === activeStatus) {
                    if (activeStatus === 'active') {
                        option.classList.add('bg-green-100', 'text-green-700');
                    } else if (activeStatus === 'draft') {
                        option.classList.add('bg-yellow-100', 'text-yellow-700');
                    } else if (activeStatus === 'inactive') {
                        option.classList.add('bg-red-100', 'text-red-700');
                    }
                } else {
                    option.classList.add('bg-gray-100', 'text-gray-600');
                }
            });
        }
        document.querySelector('#saveState').addEventListener('click', () => {
            fetch('/savePagesjson', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    data: pagesData

                })
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    console.log('Success:', data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });

        });

        statusOptions.forEach(option => {
            option.addEventListener('click', () => {
                const status = option.dataset.status;
                pageStatusInput.value = status;
                resetStatusOptions(status);
            });
        });

        // Form submission
        pageForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const id = document.getElementById('pageId').value;
            const name = document.getElementById('pageName').value;
            const path = document.getElementById('pagePath').value;
            const href = document.getElementById('pageHref').value;
            const status = pageStatusInput.value;

            if (id) {
                // Update existing page
                updatePage(id, name, path, href, status);
            } else {
                // Create new page
                createPage(name, path, href, status);
            }

            closeModal();
        });

        // CRUD Operations
        function createPage(name, path, href, status) {
            const newPage = {
                id: Date.now(), // Generate unique ID
                name,
                path,
                href,
                status,
                date: new Date().toLocaleDateString('sr-RS')
            };

            pagesData.push(newPage);
            renderPages(pagesData);
            selectPage(newPage.id);
        }

        function updatePage(id, name, path, href, status) {
            const pageIndex = pagesData.findIndex(page => page.id == id);

            if (pageIndex !== -1) {
                pagesData[pageIndex] = {
                    ...pagesData[pageIndex],
                    name,
                    path,
                    href,
                    status
                };

                renderPages(pagesData);
                selectPage(id);
            }
        }

        function deletePage(id) {
            let message;
            switch (locale) {
                case 'sr':
                    message = 'Da li ste sigurni da želite da obrišete ovu stranicu?';
                    break;
                case 'en':
                    message = 'Are you sure you want to delete this page?';
                    break;
                default: 
                    message = 'Да ли сте сигурни да желите да обришете ову страницу?';
            }

            if (confirm(message)) {
                pagesData = pagesData.filter(page => page.id != id);
                renderPages(pagesData);

                // Clear preview if the deleted page was selected
                if (selectedPageId == id) {
                    clearPreview();
                }
            }
        }

        // Status change buttons
        const statusConfig = {
            active: { border: 'border-green-500', text: 'text-green-700', bg: 'bg-green-100' },
            draft: { border: 'border-yellow-500', text: 'text-yellow-700', bg: 'bg-yellow-100' },
            inactive: { border: 'border-red-500', text: 'text-red-700', bg: 'bg-red-100' }
        };
        const gray = { border: 'border-gray-300', text: 'text-gray-600', bg: 'bg-gray-100' };

        function applyClasses(btn, set) {
            btn.classList.remove(
                'border-green-500', 'border-yellow-500', 'border-red-500', 'border-gray-300',
                'text-green-700', 'text-yellow-700', 'text-red-700', 'text-gray-600',
                'bg-green-100', 'bg-yellow-100', 'bg-red-100', 'bg-gray-100'
            );
            btn.classList.add(set.border, set.text, set.bg);
        }

        statusButtons.forEach(btn => applyClasses(btn, gray));
        applyClasses(document.querySelector('[data-status="active"]'), statusConfig.active);

        statusButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                if (!selectedPageId) {
                    let alertMessage;
                    switch (locale) {
                        case 'sr':
                            alertMessage = 'Izaberite stranicu pre nego što promenite status';
                            break;
                        case 'en':
                            alertMessage = 'Select a page before changing the status';
                            break;
                        default: 
                            alertMessage = 'Изаберите страницу пре него што промените статус';
                    }
                    alert(alertMessage);
                    return;
                }

                statusButtons.forEach(b => applyClasses(b, gray));
                applyClasses(btn, statusConfig[btn.dataset.status]);

                // Update the page status
                const status = btn.dataset.status;
                const pageIndex = pagesData.findIndex(page => page.id == selectedPageId);

                if (pageIndex !== -1) {
                    pagesData[pageIndex].status = status;

                    // Funkcija za dobijanje prevedenog statusa
                    function getStatusText(status) {
                        switch (locale) {
                            case 'sr':
                                switch (status) {
                                    case 'active': return 'Aktivan';
                                    case 'draft': return 'U izradi';
                                    case 'inactive': return 'Neaktivan';
                                    default: return status;
                                }
                            case 'en':
                                switch (status) {
                                    case 'active': return 'Active';
                                    case 'draft': return 'In progress';
                                    case 'inactive': return 'Inactive';
                                    default: return status;
                                }
                            default: // npr. 'sr-Cyrl'
                                switch (status) {
                                    case 'active': return 'Активан';
                                    case 'draft': return 'У изради';
                                    case 'inactive': return 'Неактиван';
                                    default: return status;
                                }
                        }
                    }

                    const statusText = getStatusText(status);

                    // Update preview
                    document.getElementById('preview-status').textContent = statusText;

                    // Update the page card status badge
                    const statusBadge = document.querySelector(`.page-card[data-id="${selectedPageId}"] .status-badge`);
                    if (statusBadge) {
                        statusBadge.textContent = statusText;

                        // Update badge color
                        statusBadge.classList.remove(
                            'from-green-400', 'to-green-600',
                            'from-yellow-400', 'to-orange-500',
                            'from-red-400', 'to-red-600'
                        );

                        if (status === 'active') {
                            statusBadge.classList.add('from-green-400', 'to-green-600');
                        } else if (status === 'draft') {
                            statusBadge.classList.add('from-yellow-400', 'to-orange-500');
                        } else {
                            statusBadge.classList.add('from-red-400', 'to-red-600');
                        }
                    }
                }

            });
        });

        // Button event listeners
        newPageBtn.addEventListener('click', () => {
            openModal('create');
        });

        editPageBtn.addEventListener('click', () => {
            if (!selectedPageId) {
                let alertMessage;
                switch (locale) {
                    case 'sr':
                        alertMessage = 'Izaberite stranicu koju želite da uredite';
                        break;
                    case 'en':
                        alertMessage = 'Select a page you want to edit';
                        break;
                    default: 
                        alertMessage = 'Изаберите страницу коју желите да уредите';
                }
                alert(alertMessage);
                return;
            }

            const page = pagesData.find(p => p.id == selectedPageId);
            if (page) {
                openModal('edit', page);
            }
        });

        deletePageBtn.addEventListener('click', () => {
            if (!selectedPageId) {
                let alertMessage;
                switch (locale) {
                    case 'sr':
                        alertMessage = 'Izaberite stranicu koju želite da obrišete';
                        break;
                    case 'en':
                        alertMessage = 'Select a page you want to delete';
                        break;
                    default: 
                        alertMessage = 'Изаберите страницу коју желите да обришете';
                }
                alert(alertMessage);
                return;
            }

            deletePage(selectedPageId);
        });

        // Function to render page cards
        function renderPages(pages) {
            const container = document.getElementById('pages-list-container');
            container.innerHTML = '';

            if (pages.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-search text-2xl text-gray-400"></i>
                        <p class="text-gray-500 mt-2">Nema stranica za prikaz</p>
                    </div>
                `;
                return;
            }

            pages.forEach((page, index) => {
                let statusClass = '';
                let statusText = '';

                switch (locale) {
                    case 'sr':
                        switch (page.status) {
                            case 'active':
                                statusClass = 'from-green-400 to-green-600';
                                statusText = 'Aktivan';
                                break;
                            case 'draft':
                                statusClass = 'from-yellow-400 to-orange-500';
                                statusText = 'U izradi';
                                break;
                            default: 
                                statusClass = 'from-red-400 to-red-600';
                                statusText = 'Neaktivan';
                        }
                        break;

                    case 'en':
                        switch (page.status) {
                            case 'active':
                                statusClass = 'from-green-400 to-green-600';
                                statusText = 'Active';
                                break;
                            case 'draft':
                                statusClass = 'from-yellow-400 to-orange-500';
                                statusText = 'In progress';
                                break;
                            default:
                                statusClass = 'from-red-400 to-red-600';
                                statusText = 'Inactive';
                        }
                        break;

                    default: 
                        switch (page.status) {
                            case 'active':
                                statusClass = 'from-green-400 to-green-600';
                                statusText = 'Активан';
                                break;
                            case 'draft':
                                statusClass = 'from-yellow-400 to-orange-500';
                                statusText = 'У изради';
                                break;
                            default:
                                statusClass = 'from-red-400 to-red-600';
                                statusText = 'Неактиван';
                        }
                }


                const card = document.createElement('div');
                card.className = 'page-card rounded-xl p-4 lg:p-5 cursor-pointer border-2 border-transparent hover:border-primary/30 transition-all duration-300 animate-fade-in';
                card.dataset.id = page.id;
                card.style.animationDelay = `${index * 0.1}s`;
                card.innerHTML = `
                    <div class="flex justify-between items-start mb-3">
                        <h4 class="font-bold text-gray-800 truncate max-w-[60%] text-sm lg:text-base">${page.name}</h4>
                        <span class="bg-gradient-to-r ${statusClass} text-white text-xs px-2 py-1 rounded-full font-medium status-badge">${statusText}</span>
                    </div>
                    <p class="text-gray-500 text-xs lg:text-sm mb-3 font-medium truncate">${page.href}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-400">${page.date}</span>
                    </div>
                `;

                card.addEventListener('click', () => {
                    document.getElementById("stylePage").href = "/style?komponenta=" + page.name.trim().replace(' ', '_').toLowerCase()
                    selectPage(page.id);
                });

                container.appendChild(card);
            });

            // Hide loading indicator and show container
            document.getElementById('loading-indicator').classList.add('hidden');
            container.classList.remove('hidden');

            // Select the first card if none is selected
            if (container.firstChild && !selectedPageId) {
                selectPage(pages[0].id);
            }
        }

        // Select a page
        function selectPage(id) {
            selectedPageId = id;
            const page = pagesData.find(p => p.id == id);

            if (page) {
                // Update preview section
                document.getElementById('preview-title').textContent = page.name;
                document.getElementById('preview-url').textContent = page.href;
                let statusText;
                switch (locale) {
                    case 'sr':
                        switch (page.status) {
                            case 'active': statusText = 'Aktivan'; break;
                            case 'draft': statusText = 'U izradi'; break;
                            default: statusText = 'Neaktivan';
                        }
                        break;
                    case 'en':
                        switch (page.status) {
                            case 'active': statusText = 'Active'; break;
                            case 'draft': statusText = 'In progress'; break;
                            default: statusText = 'Inactive';
                        }
                        break;
                    default: 
                        switch (page.status) {
                            case 'active': statusText = 'Активан'; break;
                            case 'draft': statusText = 'У изради'; break;
                            default: statusText = 'Неактиван';
                        }
                }
                document.getElementById('preview-status').textContent = statusText;

                document.getElementById('preview-path').textContent = page.path;
                document.getElementById('preview-date').textContent = page.date;

                // Highlight selected card
                document.querySelectorAll('.page-card').forEach(c => {
                    c.classList.remove('border-primary', 'bg-blue-50');
                });
                document.querySelector(`.page-card[data-id="${id}"]`).classList.add('border-primary', 'bg-blue-50');

                // Update status buttons
                statusButtons.forEach(btn => applyClasses(btn, gray));
                applyClasses(document.querySelector(`[data-status="${page.status}"]`), statusConfig[page.status]);
            }
        }

        // Clear preview
        function clearPreview() {
            selectedPageId = null;
            document.getElementById('preview-title').textContent = 'Odaberite stranicu';
            document.getElementById('preview-url').textContent = 'Odaberite stranicu za pregled';
            document.getElementById('preview-status').textContent = '-';
            document.getElementById('preview-path').textContent = '-';
            document.getElementById('preview-date').textContent = '-';

            // Clear card highlights
            document.querySelectorAll('.page-card').forEach(c => {
                c.classList.remove('border-primary', 'bg-blue-50');
            });

            // Reset status buttons
            statusButtons.forEach(btn => applyClasses(btn, gray));
            applyClasses(document.querySelector('[data-status="active"]'), statusConfig.active);
        }

        // Filter pages based on search input and status
        function filterPages() {
            const searchTerm = document.querySelector('.search-input').value.toLowerCase();
            let filtered = pagesData.filter(page =>
                page.name.toLowerCase().includes(searchTerm) ||
                page.href.toLowerCase().includes(searchTerm) ||
                page.path.toLowerCase().includes(searchTerm)
            );

            // Apply status filter
            if (currentFilter !== 'all') {
                const statusMap = {
                    'active': 'active',
                    'draft': 'draft',
                    'inactive': 'inactive'
                };
                filtered = filtered.filter(page => page.status === statusMap[currentFilter]);
            }

            renderPages(filtered);
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', () => {
            loadPages();

            renderPages(pagesData);

            // Add event listeners
            document.querySelector('.search-input').addEventListener('input', filterPages);

            // Filter buttons
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    // Update active filter
                    document.querySelectorAll('.filter-btn').forEach(b => {
                        b.classList.remove('active', 'bg-primary', 'text-white');
                        b.classList.add('bg-gray-100', 'text-gray-700');
                    });
                    btn.classList.add('active', 'bg-primary', 'text-white');
                    btn.classList.remove('bg-gray-100', 'text-gray-700');

                    currentFilter = btn.dataset.filter;
                    filterPages();
                });
            });

            // Refresh button
            document.querySelector('.action-btn').addEventListener('click', () => {
                renderPages(pagesData);
            });
        });
    </script>
</body>

</html>
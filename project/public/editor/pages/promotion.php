<?php
session_start();
$locale = $_SESSION['locale'] ?? 'sr-Cyrl';

use App\Controllers\AuthController;
AuthController::requireEditor();
[$name, $surname, $role] = AuthController::getUserInfo();

// Paths
$commonScriptPath = realpath(__DIR__ . '/../../exportedPages/commonScript.js');
$componentsDir = realpath(__DIR__ . '/../../exportedPages/landingPageComponents/landingPage');
$componentsBaseUrl = '/exportedPages/landingPageComponents/landingPage';

// Definišemo koje boje koristimo
$colorKeys = [
    'primary' => 'Primarna',
    'primary_hover' => 'Primarna (hover)',
    'secondary' => 'Sekundarna',
    'secondary_hover' => 'Sekundarna (hover)',
    'accent' => 'Akcent',
    'accent_hover' => 'Akcent (hover)',
    'primary_text' => 'Primarni tekst',
    'secondary_text' => 'Sekundarni tekst',
    'background' => 'Pozadina',
    'secondary_background' => 'Sek. pozadina',
    'surface' => 'Površina'
];

// Predefinisane color palete
$colorPalettes = [
    'default' => [
        'name' => 'Plava (Default)',
        'colors' => [
            'primary' => '#3B82F6',
            'primary_hover' => '#2563EB',
            'secondary' => '#64748B',
            'secondary_hover' => '#475569',
            'accent' => '#8B5CF6',
            'accent_hover' => '#7C3AED',
            'primary_text' => '#1E293B',
            'secondary_text' => '#64748B',
            'background' => '#FFFFFF',
            'secondary_background' => '#F8FAFC',
            'surface' => '#F1F5F9'
        ]
    ],
    'green' => [
        'name' => 'Zelena',
        'colors' => [
            'primary' => '#10B981',
            'primary_hover' => '#059669',
            'secondary' => '#6B7280',
            'secondary_hover' => '#4B5563',
            'accent' => '#F59E0B',
            'accent_hover' => '#D97706',
            'primary_text' => '#000000',
            'secondary_text' => '#000000',
            'background' => '#75ff71',
            'secondary_background' => '#F9FAFB',
            'surface' => '#F3F4F6'
        ]
    ],
    'purple' => [
        'name' => 'Ljubičasta',
        'colors' => [
            'primary' => '#8B5CF6',
            'primary_hover' => '#7C3AED',
            'secondary' => '#64748B',
            'secondary_hover' => '#475569',
            'accent' => '#EC4899',
            'accent_hover' => '#DB2777',
            'primary_text' => '#1E293B',
            'secondary_text' => '#64748B',
            'background' => '#FFFFFF',
            'secondary_background' => '#FAF5FF',
            'surface' => '#F3E8FF'
        ]
    ],
    'orange' => [
        'name' => 'Narandžasta',
        'colors' => [
            'primary' => '#F97316',
            'primary_hover' => '#EA580C',
            'secondary' => '#78716C',
            'secondary_hover' => '#57534E',
            'accent' => '#EAB308',
            'accent_hover' => '#CA8A04',
            'primary_text' => '#1C1917',
            'secondary_text' => '#78716C',
            'background' => '#FFFFFF',
            'secondary_background' => '#FFF7ED',
            'surface' => '#FFEDD5'
        ]
    ],
    'dark' => [
        'name' => 'Tamna',
        'colors' => [
            'primary' => '#3B82F6',
            'primary_hover' => '#2563EB',
            'secondary' => '#9CA3AF',
            'secondary_hover' => '#6B7280',
            'accent' => '#06B6D4',
            'accent_hover' => '#0891B2',
            'primary_text' => '#F9FAFB',
            'secondary_text' => '#D1D5DB',
            'background' => '#111827',
            'secondary_background' => '#1F2937',
            'surface' => '#374151'
        ]
    ],
    'red' => [
        'name' => 'Crvena',
        'colors' => [
            'primary' => '#EF4444',
            'primary_hover' => '#DC2626',
            'secondary' => '#64748B',
            'secondary_hover' => '#475569',
            'accent' => '#F59E0B',
            'accent_hover' => '#D97706',
            'primary_text' => '#1E293B',
            'secondary_text' => '#64748B',
            'background' => '#FFFFFF',
            'secondary_background' => '#FEF2F2',
            'surface' => '#FEE2E2'
        ]
    ]
];

// Parsiranje boja iz commonScript.js
$colors = [];
if ($commonScriptPath && file_exists($commonScriptPath)) {
    $js = file_get_contents($commonScriptPath);
    if (preg_match('/colors:\s*\{([^}]+)\}/s', $js, $match)) {
        $colorsBlock = $match[1];
        foreach (array_keys($colorKeys) as $key) {
            $pattern = '/' . preg_quote($key, '/') . '\s*:\s*[\'"]([#a-fA-F0-9]+)[\'"]/';
            if (preg_match($pattern, $colorsBlock, $m)) {
                $colors[$key] = $m[1];
            }
        }
    }
}

// Components list
$files = [];

if ($componentsDir) {
    foreach (glob($componentsDir . '/*.php') as $file) {
        $content = file_get_contents($file);

        // Proverava da li sadrži <section> i nema PHP tagove
        if (strpos($content, '<section') !== false) {
            $files[] = basename($file);
        }

    }
}

if (isset($_GET['current'])) {
    $_SESSION['current'] = (int) $_GET['current'];
}
if (!isset($_SESSION['current'])) {
    $_SESSION['current'] = 0;
}
$total = count($files);
$current = $_SESSION['current'] ?? 0;
if ($total > 0) {
    $current = max(0, min($current, $total - 1));
    $activeFile = $files[$current];
} else {
    $activeFile = null;
}
?>
<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(__('promotion.page_title')) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="/assets/css/WebDesigner/grapes.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            <?php foreach ($colors as $k => $v): ?>
                --color-<?= $k ?>:
                    <?= $v ?>
                ;
            <?php endforeach; ?>
        }

        .palette-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .palette-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }

        .palette-card.active {
            border: 2px solid #3B82F6;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .color-dot {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        #gjs {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            overflow: hidden;
            min-height: 700px;
            height: calc(100vh - 400px);
        }

        .panel__top {
            padding: 0;
            width: 100%;
            display: flex;
            position: initial;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .panel__basic-actions {
            display: flex;
            gap: 5px;
        }

        .panel__devices {
            display: flex;
            gap: 5px;
        }

        .panel__top button {
            padding: 8px 12px;
            background: #3B82F6;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .panel__top button:hover {
            background: #2563EB;
        }

        .panel__top button.active {
            background: #1E40AF;
        }

        .gjs-cv-canvas {
            background-color: #ffffff;
            width: 100%;
            height: 100%;
        }

        .gjs-frame {
            height: 100%;
        }

        .color-section {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .color-section.expanded {
            max-height: 500px;
        }

        .toggle-colors-btn {
            transition: all 0.3s ease;
        }

        .toggle-colors-btn i {
            transition: transform 0.3s ease;
        }

        .toggle-colors-btn.expanded i {
            transform: rotate(180deg);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-blue-100 text-gray-700 font-sans">

    <div class="flex h-screen overflow-hidden">
        <?php
        $activeTab = 'promotion';
        require_once __DIR__ . "/../components/sidebar.php";
        ?>

        <div class="flex-1 flex flex-col overflow-hidden">
            <?php require_once __DIR__ . "/../components/topBar.php" ?>

            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                <!-- Full Width Editor Section -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <?php if ($activeFile): ?>
                        <!-- Header with Toggle -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-4">
                                <h2 class="text-xl font-semibold text-gray-800">
                                    <i class="fas fa-edit mr-2 text-blue-500"></i>
                                    Editor: <?= htmlspecialchars($activeFile) ?>
                                </h2>
                                <span class="text-sm text-gray-500"><?= $current + 1 ?> / <?= $total ?></span>
                            </div>

                            <button id="toggleColors"
                                class="toggle-colors-btn px-4 py-2 bg-purple-50 hover:bg-purple-100 text-purple-600 rounded-lg font-medium transition">
                                <i class="fas fa-palette mr-2"></i>
                                <span>Prikaži Color Palete</span>
                                <i class="fas fa-chevron-down ml-2"></i>
                            </button>
                        </div>

                        <!-- Collapsible Color Palettes Section -->
                        <div id="colorSection" class="color-section mb-6">
                            <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-lg p-4">
                                <div class="grid grid-cols-3 md:grid-cols-6 gap-3 mb-4">
                                    <?php foreach ($colorPalettes as $paletteKey => $palette): ?>
                                        <div class="palette-card bg-white rounded-lg border border-gray-200 p-3"
                                            data-palette="<?= $paletteKey ?>">
                                            <h4 class="font-semibold text-xs text-gray-800 mb-2 text-center">
                                                <?= htmlspecialchars($palette['name']) ?>
                                            </h4>
                                            <div class="flex gap-1 justify-center mb-2">
                                                <div class="color-dot"
                                                    style="background-color: <?= $palette['colors']['primary'] ?>"></div>
                                                <div class="color-dot"
                                                    style="background-color: <?= $palette['colors']['accent'] ?>"></div>
                                                <div class="color-dot"
                                                    style="background-color: <?= $palette['colors']['secondary'] ?>"></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div id="colorsFeedback" class="flex-1 text-sm"></div>
                                    <button type="button" id="saveColors"
                                        class="px-5 py-2 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition">
                                        <i class="fas fa-save mr-2"></i>Sačuvaj Boje
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden data attribute -->
                        <div data-current-component="<?= htmlspecialchars($activeFile) ?>" style="display:none;"></div>

                        <!-- GrapesJS Container - Full Width -->
                        <div id="gjs"></div>

                        <!-- Action Buttons -->
                        <div class="mt-4 flex gap-3">
                            <button id="export"
                                class="px-6 py-3 rounded-lg bg-green-600 text-white font-medium hover:bg-green-700 transition">
                                <i class="fas fa-download mr-2"></i>Izvezi HTML
                            </button>

                            <div class="flex-1"></div>

                            <!-- Navigation -->
                            <form method="get" class="inline-block">
                                <input type="hidden" name="current" value="<?= max(0, $current - 1) ?>">
                                <button <?= $current == 0 ? 'disabled' : '' ?>
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium disabled:opacity-40 disabled:cursor-not-allowed transition">
                                    <i class="fas fa-arrow-left mr-2"></i>Prethodna
                                </button>
                            </form>

                            <form method="get" class="inline-block">
                                <input type="hidden" name="current" value="<?= min($total - 1, $current + 1) ?>">
                                <button <?= $current == $total - 1 ? 'disabled' : '' ?>
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium disabled:opacity-40 disabled:cursor-not-allowed transition">
                                    Sledeća<i class="fas fa-arrow-right ml-2"></i>
                                </button>
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-12">
                            <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500">Nema dostupnih komponenti</p>
                        </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <script>
        const COLOR_PALETTES = <?= json_encode($colorPalettes) ?>;
        let currentColors = {};

        // Toggle color section
        const toggleBtn = document.getElementById('toggleColors');
        const colorSection = document.getElementById('colorSection');

        toggleBtn.addEventListener('click', () => {
            colorSection.classList.toggle('expanded');
            toggleBtn.classList.toggle('expanded');

            const span = toggleBtn.querySelector('span');
            if (colorSection.classList.contains('expanded')) {
                span.textContent = 'Sakrij Color Palete';
            } else {
                span.textContent = 'Prikaži Color Palete';
            }
        });

        // Update CSS variable
        function setCssVar(key, value) {
            document.documentElement.style.setProperty(`--color-${key}`, value);
            currentColors[key] = value;
        }

        // Apply palette
        document.querySelectorAll('.palette-card').forEach(card => {
            card.addEventListener('click', function () {
                const paletteKey = this.dataset.palette;
                const palette = COLOR_PALETTES[paletteKey];

                // Remove active from all
                document.querySelectorAll('.palette-card').forEach(c => c.classList.remove('active'));
                this.classList.add('active');

                // Apply colors
                Object.entries(palette.colors).forEach(([key, value]) => {
                    setCssVar(key, value);
                });

                // Feedback
                const feedback = document.getElementById('colorsFeedback');
                feedback.innerHTML = `
                    <div class="inline-flex items-center px-3 py-2 bg-blue-50 border border-blue-200 rounded-lg text-blue-700 text-sm">
                        <i class="fas fa-palette mr-2"></i>
                        Paleta "${palette.name}" primenjena
                    </div>
                `;
            });
        });

        // Save colors to server
        document.getElementById('saveColors').addEventListener('click', async () => {
            const btn = document.getElementById('saveColors');
            const feedback = document.getElementById('colorsFeedback');

            if (Object.keys(currentColors).length === 0) {
                feedback.innerHTML = `
                    <div class="inline-flex items-center px-3 py-2 bg-yellow-50 border border-yellow-200 rounded-lg text-yellow-700 text-sm">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Prvo izaberite paletu!
                    </div>
                `;
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Čuvam...';
            feedback.innerHTML = '';

            try {
                const res = await fetch('/colors-change', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ colors: currentColors })
                });

                const data = await res.json();

                if (data.success) {
                    feedback.innerHTML = `
                        <div class="inline-flex items-center px-3 py-2 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
                            <i class="fas fa-check-circle mr-2"></i>
                            Uspešno sačuvano!
                        </div>
                    `;
                    btn.innerHTML = '<i class="fas fa-check mr-2"></i>Sačuvano!';
                } else {
                    throw new Error(data.error || 'Unknown error');
                }
            } catch (err) {
                feedback.innerHTML = `
                    <div class="inline-flex items-center px-3 py-2 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        Greška: ${err.message}
                    </div>
                `;
                btn.innerHTML = '<i class="fas fa-times mr-2"></i>Greška';
            } finally {
                btn.disabled = false;
                setTimeout(() => {
                    btn.innerHTML = '<i class="fas fa-save mr-2"></i>Sačuvaj Boje';
                }, 3000);
            }
        });
    </script>
    <button id="undo-btn" />
    <button id="redo-btn" />
    <!-- Load GrapesJS and promotionLoader (module) -->
    <script src="/assets/js/WebDesigner/grapesjs/grapes.min.js"></script>
    <script type="module" src="/assets/js/dashboard/promotionLoader.js"></script>
</body>

</html>
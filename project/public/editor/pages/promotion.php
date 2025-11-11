<?php
session_start();
$locale = $_SESSION['locale'] ?? 'sr-Cyrl';

use App\Controllers\AuthController;
use App\Models\Document;
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
        if (strpos($content, '<section') !== false || strpos($content, '<footer') !== false) {
            if (strpos($content, '<?php') === false) {
                $files[] = basename($file);

            }
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
    <script src="/assets/js/dashboard/tailwindConf.js"></script>

    <style>
        :root {
            <?php foreach ($colors as $k => $v): ?>
                --color-<?= $k ?>:
                    <?= $v ?>
                ;
            <?php endforeach; ?>
        }

        /* Color palette styling */
        .palette-card {
            transition: all 0.2s ease;
            cursor: pointer;
            position: relative;
        }

        .palette-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        }

        .palette-card.active {
            border-color: #3B82F6;
            box-shadow: 0 0 0 2px #3B82F6, 0 4px 12px rgba(59, 130, 246, 0.2);
        }

        .color-swatch {
            width: 100%;
            height: 24px;
            box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.1);
        }

        /* Select styling */
        select#documentSelect,
        select#pageSelect {
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236B7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-position: right 10px center;
            background-repeat: no-repeat;
            background-size: 20px;
            padding-right: 40px;
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
                <?php
                $documents = (new Document())->list();

                // Try to merge static pages from pages.json so the nav selector contains both documents and pages
                $pagesJsonPath = realpath(__DIR__ . '/../../assets/data/pages.json');
                if ($pagesJsonPath && file_exists($pagesJsonPath)) {
                    $pagesJson = json_decode(file_get_contents($pagesJsonPath), true);
                    if (is_array($pagesJson)) {
                        foreach ($pagesJson as $p) {
                            // Build a normalized entry similar to documents list
                            $href = $p['href'] ?? ($p['path'] ?? '');
                            $label = $p['name'] ?? $p['file'] ?? basename($href);
                            if (!$href)
                                continue;
                            $documents[] = [
                                'id' => $p['id'] ?? null,
                                'title' => $label,
                                'href' => $href,
                            ];
                        }
                    }
                }
                ?>

                <div id="navBlock"
                    class="w-full bg-gray-800/95 backdrop-blur-md border border-gray-700 shadow-2xl p-6 text-gray-100 z-50">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-white flex items-center">
                            <i class="fas fa-link text-blue-400 mr-2"></i>
                            Podešavanje linka
                        </h3>
                        <button id="navClose"
                            class="text-gray-400 hover:text-gray-200 transition-colors p-2 rounded-lg hover:bg-gray-700/50"
                            aria-label="Zatvori">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center gap-6 flex-1">
                        <!-- Link Type Selector -->
                        <div class="w-48">
                            <label for="linkType" class="block text-sm font-medium text-gray-300 mb-2">Tip linka</label>
                            <select id="linkType"
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:bg-gray-600 transition-colors">
                                <option value="document">Dokument</option>
                                <option value="page">Stranica</option>
                            </select>
                        </div>

                        <!-- Document Selector (shown when type=document) -->
                        <div id="documentWrapper" class="flex-1">
                            <label for="documentSelect"
                                class="block text-sm font-medium text-gray-300 mb-2">Dokument</label>
                            <select id="documentSelect"
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:bg-gray-600 transition-colors">
                                <option value="">-- Izaberi dokument --</option>
                                <?php foreach ($documents[0] as $doc):
                                    error_log(json_encode($doc));
                                    ?>
                                    <option value="/uploads/documents/<?php echo htmlspecialchars($doc['filepath']); ?>">
                                        <?php echo htmlspecialchars($doc['title']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Page Selector (shown when type=page) -->
                        <div id="pageWrapper" class="flex-1 hidden">
                            <label for="pageSelect"
                                class="block text-sm font-medium text-gray-300 mb-2">Stranica</label>
                            <select id="pageSelect"
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:bg-gray-600 transition-colors">
                                <option value="">-- Izaberi stranicu --</option>
                                <?php foreach ($documents as $d):
                                    if (!is_array($d) || !isset($d['href']) || !isset($d['title']))
                                        continue;
                                    ?>
                                    <option value="<?= htmlspecialchars($d['href']) ?>">
                                        <?= htmlspecialchars($d['title']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="w-64">
                            <label for="linkHref" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-link text-gray-400 mr-1"></i>
                                Putanja (Href)
                            </label>
                            <input id="linkHref" type="text"
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:bg-gray-600 transition-colors placeholder-gray-400"
                                placeholder="/putanja-do-stranice" />
                        </div>

                        <div class="w-64">
                            <label for="linkText" class="block text-sm font-medium text-gray-300 mb-2">
                                <i class="fas fa-font text-gray-400 mr-1"></i>
                                Tekst linka
                            </label>
                            <input id="linkText" type="text"
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:bg-gray-600 transition-colors placeholder-gray-400"
                                placeholder="Unesite tekst linka" />
                        </div>

                        <div class="flex items-center gap-3">
                            <button id="applyLink"
                                class="h-11 px-5 bg-blue-600 text-white font-medium rounded-lg shadow-lg hover:bg-blue-700 active:bg-blue-800 transition-colors flex items-center gap-2">
                                <i class="fas fa-check"></i>Primeni
                            </button>
                            <button id="delete"
                                class="h-11 px-5 bg-red-500/20 text-red-100 font-medium rounded-lg hover:bg-red-500/30 active:bg-red-600/30 transition-colors flex items-center gap-2">
                                <i class="fas fa-trash-alt"></i>Obriši
                            </button>
                        </div>
                    </div>
                </div>

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
                            <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-lg p-6">
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
                                    <?php foreach ($colorPalettes as $paletteKey => $palette): ?>
                                        <div class="palette-card bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-200 overflow-hidden transition-all"
                                            data-palette="<?= $paletteKey ?>">
                                            <!-- Color preview strip -->
                                            <div class="h-2 w-full grid grid-cols-3">
                                                <div style="background-color: <?= $palette['colors']['primary'] ?>"></div>
                                                <div style="background-color: <?= $palette['colors']['accent'] ?>"></div>
                                                <div style="background-color: <?= $palette['colors']['secondary'] ?>"></div>
                                            </div>

                                            <!-- Palette name and swatches -->
                                            <div class="p-3">
                                                <h4 class="font-medium text-sm text-gray-800 mb-2 text-center">
                                                    <?= htmlspecialchars($palette['name']) ?>
                                                </h4>
                                                <div class="grid grid-cols-2 gap-1.5">
                                                    <div class="color-swatch rounded" title="Primary"
                                                        style="background-color: <?= $palette['colors']['primary'] ?>"></div>
                                                    <div class="color-swatch rounded" title="Accent"
                                                        style="background-color: <?= $palette['colors']['accent'] ?>"></div>
                                                    <div class="color-swatch rounded" title="Secondary"
                                                        style="background-color: <?= $palette['colors']['secondary'] ?>"></div>
                                                    <div class="color-swatch rounded" title="Surface"
                                                        style="background-color: <?= $palette['colors']['surface'] ?>"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <div class="flex items-center justify-between bg-white/50 rounded-lg p-3">
                                    <div id="colorsFeedback" class="flex-1 text-sm"></div>
                                    <button type="button" id="saveColors"
                                        class="px-5 py-2.5 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 active:bg-blue-800 transition-colors">
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
    <!-- Hidden undo/redo buttons for promotion editor (used by promotionLoader/setupUndoRedo) -->
    <button id="undo-btn" style="display:none"></button>
    <button id="redo-btn" style="display:none"></button>

    <!-- Nav/link modal with improved styling -->
    <?php
    // Provide a documents list for the nav selector
    if (!isset($documents) || !is_array($documents)) {
        $documents = (new Document())->list();
    }
    ?>
    <div id="navBlock"
        class="fixed top-4 left-4 right-4 max-w-4xl mx-auto bg-gray-800/95 backdrop-blur-md border border-gray-700 rounded-xl p-6 text-gray-100 z-50 hidden transform transition-all duration-200 ease-out">
        <div class="flex flex-col space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <i class="fas fa-link text-blue-400 mr-2"></i>
                    Podešavanje linka
                </h3>
                <button id="navClose"
                    class="text-gray-400 hover:text-gray-200 transition-colors p-2 rounded-lg hover:bg-gray-700/50"
                    aria-label="Zatvori">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-12 gap-6">
                <!-- Link Type Selector -->
                <div class="col-span-3">
                    <label for="linkType" class="block text-sm font-medium text-gray-300 mb-2">
                        <i class="fas fa-sort text-gray-400 mr-2"></i>
                        Tip linka
                    </label>
                    <select id="linkType"
                        class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:bg-gray-600 transition-colors">
                        <option value="document">Dokument</option>
                        <option value="page">Stranica</option>
                    </select>
                </div>

                <!-- Document Selector -->
                <div id="documentWrapper" class="col-span-5">
                    <label for="documentSelect" class="block text-sm font-medium text-gray-300 mb-2">
                        <i class="fas fa-file-alt text-gray-400 mr-2"></i>
                        Dokument
                    </label>
                    <select id="documentSelect"
                        class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:bg-gray-600 transition-colors">
                        <option value="">-- Izaberi dokument --</option>
                        <?php if (!empty($documents[0]) && is_array($documents[0])):
                            foreach ($documents[0] as $doc):
                                $fp = $doc['filepath'] ?? '';
                                $title = $doc['title'] ?? ($doc['name'] ?? basename($fp));
                                if ($fp):
                                    ?>
                                    <option value="/uploads/documents/<?= htmlspecialchars($fp) ?>">
                                        <?= htmlspecialchars($title) ?>
                                    </option>
                                    <?php
                                endif;
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>

                <!-- Page Selector -->
                <div id="pageWrapper" class="col-span-5 hidden">
                    <label for="pageSelect" class="block text-sm font-medium text-gray-300 mb-2">
                        <i class="fas fa-file text-gray-400 mr-2"></i>
                        Stranica
                    </label>
                    <select id="pageSelect"
                        class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:bg-gray-600 transition-colors">
                        <option value="">-- Izaberi stranicu --</option>
                        <?php foreach ($documents as $d):
                            if (!is_array($d) || !isset($d['href']) || !isset($d['title']))
                                continue;
                            ?>
                            <option value="<?= htmlspecialchars($d['href']) ?>">
                                <?= htmlspecialchars($d['title']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Path Input -->
                <div class="col-span-6">
                    <label for="linkHref" class="block text-sm font-medium text-gray-300 mb-2">
                        <i class="fas fa-link text-gray-400 mr-2"></i>
                        Putanja (href)
                    </label>
                    <input id="linkHref" type="text"
                        class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:bg-gray-600/50 transition-colors"
                        placeholder="/putanja-do-stranice" />
                </div>

                <!-- Link Text Input -->
                <div class="col-span-6">
                    <label for="linkText" class="block text-sm font-medium text-gray-300 mb-2">
                        <i class="fas fa-font text-gray-400 mr-2"></i>
                        Tekst linka
                    </label>
                    <input id="linkText" type="text"
                        class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 hover:bg-gray-600/50 transition-colors"
                        placeholder="Unesite tekst linka" />
                </div>

                <!-- Action Buttons -->
                <div class="col-span-12 flex justify-end gap-3">
                    <button id="applyLink"
                        class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg shadow-lg hover:bg-blue-700 active:bg-blue-800 transition-colors flex items-center gap-2">
                        <i class="fas fa-check"></i>Primeni
                    </button>
                    <button id="delete"
                        class="px-6 py-3 bg-red-500/20 text-red-100 font-medium rounded-lg hover:bg-red-500/30 active:bg-red-600/30 transition-colors flex items-center gap-2">
                        <i class="fas fa-trash-alt"></i>Obriši
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced link management script
        (function () {
            const linkType = document.getElementById('linkType');
            const documentWrapper = document.getElementById('documentWrapper');
            const pageWrapper = document.getElementById('pageWrapper');
            const documentSelect = document.getElementById('documentSelect');
            const pageSelect = document.getElementById('pageSelect');
            const hrefInput = document.getElementById('linkHref');
            const navClose = document.getElementById('navClose');

            // Handle link type switching
            if (linkType) {
                linkType.addEventListener('change', () => {
                    const isDocument = linkType.value === 'document';
                    documentWrapper.classList.toggle('hidden', !isDocument);
                    pageWrapper.classList.toggle('hidden', isDocument);

                    // Clear href when switching
                    hrefInput.value = '';
                });
            }

            // Sync document select to href
            if (documentSelect && hrefInput) {
                documentSelect.addEventListener('change', () => {
                    hrefInput.value = documentSelect.value;
                });
            }

            // Sync page select to href
            if (pageSelect && hrefInput) {
                pageSelect.addEventListener('change', () => {
                    hrefInput.value = pageSelect.value;
                });
            }

            // Nav close button
            if (navClose) {
                navClose.addEventListener('click', () => {
                    const nb = document.getElementById('navBlock');
                    if (nb) {
                        nb.classList.add('hidden');
                        // Reset selections
                        if (documentSelect) documentSelect.selectedIndex = 0;
                        if (pageSelect) pageSelect.selectedIndex = 0;
                        if (hrefInput) hrefInput.value = '';
                    }
                });
            }
        })();
    </script>
    <!-- Load GrapesJS and promotionLoader (module) -->
    <script src="/assets/js/WebDesigner/grapesjs/grapes.min.js"></script>
    <script src="/assets/js/dashboard/linkManager.js"></script>
    <script type="module" src="/assets/js/dashboard/promotionLoader.js"></script>
</body>

</html>
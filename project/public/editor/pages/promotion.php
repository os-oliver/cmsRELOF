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
            'primary_text' => '#ffffff',
            'secondary_text' => '#fefefe',
            'background' => '#FFFFFF',
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
$files = $componentsDir ? glob($componentsDir . '/*.php') : [];
$files = array_map('basename', $files);
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
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .palette-card.active {
            border: 3px solid #3B82F6;
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
        }

        .color-dot {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
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
                <!-- RED 1: Color Palettes -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-palette text-2xl text-purple-500 mr-3"></i>
                        <h2 class="text-xl font-semibold text-gray-800">Izaberite Color Paletu</h2>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        <?php foreach ($colorPalettes as $paletteKey => $palette): ?>
                            <div class="palette-card bg-white rounded-lg border-2 border-gray-200 p-4 hover:border-blue-300"
                                data-palette="<?= $paletteKey ?>">
                                <h4 class="font-semibold text-sm text-gray-800 mb-3 text-center">
                                    <?= htmlspecialchars($palette['name']) ?>
                                </h4>
                                <div class="flex flex-wrap gap-2 justify-center mb-2">
                                    <div class="color-dot" style="background-color: <?= $palette['colors']['primary'] ?>"
                                        title="Primarna"></div>
                                    <div class="color-dot" style="background-color: <?= $palette['colors']['accent'] ?>"
                                        title="Akcent"></div>
                                    <div class="color-dot" style="background-color: <?= $palette['colors']['secondary'] ?>"
                                        title="Sekundarna"></div>
                                </div>
                                <button
                                    class="apply-palette-btn w-full mt-2 bg-blue-50 hover:bg-blue-100 text-blue-600 px-3 py-2 rounded text-xs font-medium transition">
                                    <i class="fas fa-check mr-1"></i>Primeni
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
                        <button type="button" id="saveColors"
                            class="px-6 py-3 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-700 transition">
                            <i class="fas fa-save mr-2"></i>Sačuvaj Promene
                        </button>
                    </div>
                    <div id="colorsFeedback" class="mt-3 text-sm"></div>
                </div>

                <!-- RED 2: Component Preview & Live Preview -->
                <div class="flex flex-col lg:flex-row gap-6">
                    <!-- Component Preview -->
                    <div class="flex-1">
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <?php if ($activeFile): ?>
                                <div class="flex items-center justify-between mb-4">
                                    <h2 class="text-xl font-semibold text-gray-800">
                                        <i class="fas fa-cube mr-2 text-blue-500"></i>
                                        <?= htmlspecialchars($activeFile) ?>
                                    </h2>
                                    <span class="text-sm text-gray-500"><?= $current + 1 ?> / <?= $total ?></span>
                                </div>

                                <!-- Component Preview -->
                                <div class="border-2 border-gray-200 rounded-lg p-6 mb-4 bg-white min-h-[400px]">
                                    <?php include $componentsDir . '/' . $activeFile; ?>
                                </div>

                                <!-- Navigation -->
                                <div class="flex gap-3">
                                    <form method="get" class="flex-1">
                                        <input type="hidden" name="current" value="<?= max(0, $current - 1) ?>">
                                        <button <?= $current == 0 ? 'disabled' : '' ?>
                                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-medium disabled:opacity-40 disabled:cursor-not-allowed transition">
                                            <i class="fas fa-arrow-left mr-2"></i>Prethodna
                                        </button>
                                    </form>

                                    <form method="get" class="flex-1">
                                        <input type="hidden" name="current" value="<?= min($total - 1, $current + 1) ?>">
                                        <button <?= $current == $total - 1 ? 'disabled' : '' ?>
                                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-medium disabled:opacity-40 disabled:cursor-not-allowed transition">
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
                    </div>

                    <!-- Live Preview -->
                    <aside class="w-full lg:w-96">
                        <div class="bg-white rounded-xl shadow-lg p-6 sticky top-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                <i class="fas fa-eye mr-2 text-purple-500"></i>
                                Trenutni Pregled
                            </h3>

                            <div class="space-y-4">
                                <div class="p-4 rounded-lg" style="background-color: var(--color-background)">
                                    <h4 class="text-xl font-bold mb-2" style="color: var(--color-primary)">
                                        Primarna Boja
                                    </h4>
                                    <p class="text-sm mb-3" style="color: var(--color-primary_text)">
                                        Ovo je primer primarnog teksta koji se prikazuje sa trenutno izabranom paletom
                                        boja.
                                    </p>
                                    <p class="text-sm" style="color: var(--color-secondary_text)">
                                        Sekundarni tekst je obično tamniji i koristi se za manje važne informacije.
                                    </p>
                                </div>

                                <div class="flex flex-wrap gap-2">
                                    <button class="px-4 py-2 rounded-lg text-white font-medium transition"
                                        style="background-color: var(--color-primary)">
                                        <i class="fas fa-star mr-1"></i>Primarno
                                    </button>
                                    <button class="px-4 py-2 rounded-lg text-white font-medium transition"
                                        style="background-color: var(--color-secondary)">
                                        <i class="fas fa-info-circle mr-1"></i>Sekundarno
                                    </button>
                                    <button class="px-4 py-2 rounded-lg text-white font-medium transition"
                                        style="background-color: var(--color-accent)">
                                        <i class="fas fa-bolt mr-1"></i>Akcent
                                    </button>
                                </div>

                                <div class="p-4 rounded-lg" style="background-color: var(--color-surface)">
                                    <h5 class="font-semibold mb-2" style="color: var(--color-primary_text)">
                                        <i class="fas fa-layer-group mr-2"></i>Površina (Kartica)
                                    </h5>
                                    <p class="text-sm" style="color: var(--color-secondary_text)">
                                        Ova boja se koristi za kartice i istaknute sekcije.
                                    </p>
                                </div>

                                <div class="grid grid-cols-3 gap-2 mt-4">
                                    <?php foreach (array_slice($colorKeys, 0, 6) as $key => $label): ?>
                                        <div class="text-center">
                                            <div class="w-full h-16 rounded-lg mb-2 border-2 border-gray-200"
                                                style="background-color: var(--color-<?= $key ?>)"></div>
                                            <span class="text-xs text-gray-600"><?= $label ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </main>
        </div>
    </div>

    <script>
        const COLOR_PALETTES = <?= json_encode($colorPalettes) ?>;
        let currentColors = {};

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
                    <div class="p-3 bg-blue-50 border border-blue-200 rounded-lg text-blue-700">
                        <i class="fas fa-palette mr-2"></i>
                        Paleta "${palette.name}" je primenjena. Kliknite "Sačuvaj Promene" da sačuvate.
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
                    <div class="p-3 bg-yellow-50 border border-yellow-200 rounded-lg text-yellow-700">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Prvo izaberite neku paletu!
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
                        <div class="p-3 bg-green-50 border border-green-200 rounded-lg text-green-700">
                            <i class="fas fa-check-circle mr-2"></i>
                            Uspešno sačuvano! Backup: ${data.backup || 'N/A'}
                        </div>
                    `;
                    btn.innerHTML = '<i class="fas fa-check mr-2"></i>Sačuvano!';
                } else {
                    throw new Error(data.error || 'Unknown error');
                }
            } catch (err) {
                feedback.innerHTML = `
                    <div class="p-3 bg-red-50 border border-red-200 rounded-lg text-red-700">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        Greška: ${err.message}
                    </div>
                `;
                btn.innerHTML = '<i class="fas fa-times mr-2"></i>Greška';
            } finally {
                btn.disabled = false;
                setTimeout(() => {
                    btn.innerHTML = '<i class="fas fa-save mr-2"></i>Sačuvaj Promene';
                }, 3000);
            }
        });
    </script>

    <script src="/assets/js/WebDesigner/grapesjs/grapes.min.js"></script>
    <script src="/assets/js/dashboard/promotionLoader.js"></script>
    <script src="/assets/js/dashboard/mobileMenu.js" defer></script>
</body>

</html>
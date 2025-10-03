<?php
session_start();
if (isset($_GET['locale'])) {
    $_SESSION['locale'] = $_GET['locale'];
}
$locale = $_SESSION['locale'] ?? 'sr-Cyrl';


use App\Models\Event;
use App\Controllers\AuthController;
AuthController::requireEditor();

[$name, $surname, $role] = AuthController::getUserInfo();

?>
<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= __('events.page_title') ?></title>
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
                            <h1>
                                <?
                                $uri = $_SERVER['REQUEST_URI']; // e.g. "/kontrolna-tabla/vesti"
                                $parts = explode('/', trim($uri, '/')); // ["kontrolna-tabla", "vesti"]
                                
                                $slug = $parts[1] ?? null; // "vesti"
                                echo $slug;

                                ?>
                            </h1>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <button id="newEventButton"
                                class="bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white px-6 py-2 rounded-lg transition-all flex items-center gap-2 shadow-lg">
                                <i class="fas fa-plus text-sm"></i>
                                <?= $slug ?>
                            </button>
                        </div>
                    </div>





                </div>
            </main>
        </div>
    </div>

    <script src="/assets/js/dashboard/dashboard.js"></script>
    <script src="/assets/js/dashboard/mobileMenu.js" defer></script>
    <script>
            (function () {
                // Get slug from server-rendered PHP variable
                const slug = <?= json_encode($slug) ?>;
                const btn = document.getElementById('newEventButton');
                if (!btn) return;

                async function fetchModal(s) {
                    const res = await fetch(`/editor/getModal?slug=${encodeURIComponent(s)}`, { credentials: 'same-origin' });
                    if (!res.ok) throw new Error('Failed to load modal: ' + res.statusText);
                    return await res.text();
                }

                function attachModalListeners(container) {
                    // close handlers
                    container.querySelectorAll('.cancel-modal').forEach(el => el.addEventListener('click', () => {
                        container.remove();
                    }));

                    // close when clicking outside modal content
                    container.addEventListener('click', (e) => {
                        if (e.target === container) container.remove();
                    });

                    // intercept form submit for now (you can implement AJAX save)
                    const form = container.querySelector('form');
                    if (form) {
                        form.addEventListener('submit', (e) => {
                            e.preventDefault();
                            // simple feedback then close
                            const submitBtn = form.querySelector('button[type=submit]');
                            if (submitBtn) {
                                submitBtn.disabled = true;
                                submitBtn.classList.add('opacity-70');
                            }
                            // TODO: implement actual AJAX post to endpoint defined in hidden input 'endpoint'
                            setTimeout(() => container.remove(), 600);
                        });
                    }
                }

                btn.addEventListener('click', async (e) => {
                    try {
                        const html = await fetchModal(slug);
                        // insert into DOM
                        const wrapper = document.createElement('div');
                        wrapper.innerHTML = html;
                        // modal root may be a single element
                        const modalEl = wrapper.firstElementChild;
                        if (!modalEl) return;
                        // give it small show animation
                        document.body.appendChild(modalEl);
                        attachModalListeners(modalEl);
                    } catch (err) {
                        console.error(err);
                        alert('Could not load modal: ' + err.message);
                    }
                });
            })();
    </script>
</body>

</html>
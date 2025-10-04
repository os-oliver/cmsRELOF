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

// Handle POST submission
$submitResult = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $controller = new \App\Controllers\ContentController();
        $ok = $controller->insert($_POST, $_FILES);
        $submitResult = $ok ? ['success' => true, 'message' => 'Saved successfully'] : ['success' => false, 'message' => 'Save failed'];
    } catch (\Throwable $t) {
        error_log('Submit error: ' . $t->getMessage());
        $submitResult = ['success' => false, 'message' => 'Save failed: ' . $t->getMessage()];
    }
}

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
                                <?php
                                $uri = $_SERVER['REQUEST_URI']; // e.g. "/kontrolna-tabla/vesti"
                                $parts = explode('/', trim($uri, '/'));
                                $slug = $parts[1] ?? null; // "vesti"
                                echo htmlspecialchars($slug ?? '', ENT_QUOTES, 'UTF-8');
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


                    <div class="mx-auto max-w-4xl p-6">
                        <?php
                        // Render dynamic form based on structure.json for this slug
                        $structurePath = __DIR__ . '/../../structure.json';
                        $config = null;
                        if (is_file($structurePath)) {
                            $json = file_get_contents($structurePath);
                            $parsed = json_decode($json, true);
                            if (is_array($parsed) && count($parsed) > 0) {
                                $root = $parsed[0];
                                if ($slug && isset($root[$slug])) {
                                    $config = $root[$slug];
                                }
                            }
                        }

                        if ($submitResult) {
                            echo '<div class="p-4 rounded ' . ($submitResult['success'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') . '">';
                            echo htmlspecialchars($submitResult['message'], ENT_QUOTES, 'UTF-8');
                            echo '</div>';
                        }

                        ?>

                        <?php
                        // If we have a slug, fetch existing items and render a table
                        try {
                            $itemsList = ['success' => false, 'items' => []];
                            if (!empty($slug)) {
                                $controller = new \App\Controllers\ContentController();
                                // fetch first page, 50 items
                                $itemsList = $controller->fetchListData($slug, '', 1, 50);
                            }

                            if (!empty($itemsList['success']) && !empty($itemsList['items'])) {
                                $items = $itemsList['items'];

                                // Determine column order: prefer structure.json field order if available
                                $columns = [];
                                if (!empty($config) && !empty($config['fields']) && is_array($config['fields'])) {
                                    foreach ($config['fields'] as $f) {
                                        if (!empty($f['name']))
                                            $columns[] = $f['name'];
                                    }
                                }
                                // fallback: infer from first item
                                if (empty($columns)) {
                                    $first = $items[0] ?? null;
                                    if ($first && !empty($first['fields'])) {
                                        $columns = array_keys($first['fields']);
                                    }
                                }

                                // render table
                                echo '<div class="mt-6 overflow-auto">';
                                echo '<table class="min-w-full divide-y divide-gray-200">';
                                echo '<thead class="bg-gray-50"><tr>';
                                echo '<th class="px-4 py-2 text-left text-sm font-medium text-gray-700">ID</th>';
                                foreach ($columns as $col) {
                                    echo '<th class="px-4 py-2 text-left text-sm font-medium text-gray-700">' . htmlspecialchars($col, ENT_QUOTES, 'UTF-8') . '</th>';
                                }
                                echo '<th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>';
                                echo '</tr></thead>';
                                echo '<tbody class="bg-white divide-y divide-gray-100">';

                                // current locale from session earlier in the file
                                $currentLocale = $locale ?? ($_SESSION['locale'] ?? 'sr-Cyrl');

                                foreach ($items as $it) {
                                    $id = (int) ($it['id'] ?? 0);
                                    $fields = $it['fields'] ?? [];
                                    echo '<tr class="hover:bg-gray-50">';
                                    echo '<td class="px-4 py-2 text-sm text-gray-700">' . $id . '</td>';
                                    foreach ($columns as $col) {
                                        $val = '';
                                        if (isset($fields[$col])) {
                                            // prefer exact locale
                                            if (isset($fields[$col][$currentLocale]) && $fields[$col][$currentLocale] !== '') {
                                                $val = $fields[$col][$currentLocale];
                                            } else {
                                                // fallback to any available language (first)
                                                $firstLang = array_values($fields[$col]);
                                                $val = $firstLang[0] ?? '';
                                            }
                                        }
                                        // if content looks like an image path, render thumbnail; otherwise escape and show placeholder when empty
                                        $display = htmlspecialchars((string) $val, ENT_QUOTES, 'UTF-8');
                                        if (is_string($val) && preg_match('#^/uploads/.+\.(png|jpe?g|gif|webp)$#i', $val)) {
                                            $imgUrl = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
                                            $display = '<img src="' . $imgUrl . '" style="max-width:120px;max-height:80px;border-radius:6px;" alt=""/>';
                                        } elseif ($display === '') {
                                            $display = '<span class="text-gray-400 italic">(empty)</span>';
                                        }
                                        echo '<td class="px-4 py-2 text-sm text-gray-700">' . $display . '</td>';
                                    }
                                    // actions (simple view/edit links — endpoints may be implemented elsewhere)
                                    $viewUrl = '/editor/view?type=' . urlencode($slug) . '&id=' . $id;
                                    $editUrl = '/editor/edit?type=' . urlencode($slug) . '&id=' . $id;
                                    echo '<td class="px-4 py-2 text-sm text-gray-700">';
                                    // Edit — open modal from /editor/getModal?slug=...&id=...
                                    echo '<a href="#" data-id="' . $id . '" class="edit-item text-blue-600 hover:underline mr-3">Edit</a>';
                                    // Delete — call API to remove
                                    echo '<a href="#" data-id="' . $id . '" class="delete-item text-red-600 hover:underline">Delete</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }

                                echo '</tbody></table></div>';
                            } else {
                                // no items
                                echo '<div class="mt-6 text-sm text-gray-600">No items found for this type.</div>';
                            }
                        } catch (\Throwable $e) {
                            error_log('List render error: ' . $e->getMessage());
                            echo '<div class="mt-4 p-3 rounded bg-red-100 text-red-800">Could not load items.</div>';
                        }
                        ?>



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

                    // intercept form submit and send via fetch to our endpoint
                    const form = container.querySelector('form');
                    if (form) {
                        // add image preview support for file inputs
                        form.querySelectorAll('input[type=file]').forEach(inp => {
                            // make the visible label toggle the hidden input
                            const label = inp.closest('label');
                            if (label) {
                                label.addEventListener('click', (ev) => {
                                    // prevent the label from removing modal if clicked
                                    ev.stopPropagation();
                                    inp.click();
                                });
                            }

                            inp.addEventListener('change', (ev) => {
                                const file = ev.target.files && ev.target.files[0];
                                // create or update preview
                                let preview = container.querySelector(`#preview-${inp.name}`);
                                if (!preview) {
                                    preview = document.createElement('div');
                                    preview.id = `preview-${inp.name}`;
                                    preview.className = 'mt-2';
                                    inp.parentNode.appendChild(preview);
                                }
                                preview.innerHTML = '';
                                if (file && file.type.startsWith('image/')) {
                                    const img = document.createElement('img');
                                    img.style.maxWidth = '200px';
                                    img.style.maxHeight = '200px';
                                    img.src = URL.createObjectURL(file);
                                    preview.appendChild(img);
                                } else if (file) {
                                    const p = document.createElement('div');
                                    p.textContent = `${file.name} (${Math.round(file.size / 1024)} KB)`;
                                    preview.appendChild(p);
                                }
                            });
                        });

                        form.addEventListener('submit', async (e) => {
                            e.preventDefault();
                            const submitBtn = form.querySelector('button[type=submit]');
                            if (submitBtn) {
                                if (submitBtn.disabled) return; // avoid double submit
                                submitBtn.disabled = true;
                                submitBtn.classList.add('opacity-70');
                            }
                            // determine and normalize type/slug to send
                            const computeSlug = () => {
                                // prefer server-rendered slug if available
                                let s = typeof slug !== 'undefined' ? String(slug) : '';
                                if (!s) {
                                    const parts = window.location.pathname.split('/').filter(Boolean);
                                    // try second segment (/kontrolna-tabla/slug)
                                    s = parts[1] || parts[0] || '';
                                }
                                // normalize: remove trailing hyphens and whitespace
                                s = s.replace(/[-_\s]+$/g, '');
                                s = s.trim();
                                return s;
                            };

                            const fd = new FormData(form);
                            const slugToSend = computeSlug();
                            if (slugToSend) {
                                // ensure FormData has the type field required by backend
                                if (!fd.has('type')) fd.append('type', slugToSend);
                            }
                            // Client-side validation for hidden required file inputs
                            const fileReqs = Array.from(form.querySelectorAll('input[type=file][data-required]'));
                            let fileMissing = null;
                            for (const f of fileReqs) {
                                const name = f.name;
                                const removeCheckbox = form.querySelector(`[name=remove_${name}]`);
                                const isRemoved = removeCheckbox && removeCheckbox.checked;
                                const hasFile = f.files && f.files.length > 0;
                                if (!hasFile && !isRemoved) {
                                    fileMissing = name;
                                    break;
                                }
                            }
                            if (fileMissing) {
                                const msg = document.createElement('div');
                                msg.className = 'p-3 rounded bg-red-100 text-red-800';
                                msg.textContent = 'Please provide required file: ' + fileMissing + ' or check Remove.';
                                form.prepend(msg);
                                if (submitBtn) submitBtn.disabled = false;
                                return;
                            }
                            try {
                                const res = await fetch('/editor/insert', {
                                    method: 'POST',
                                    body: fd,
                                    credentials: 'same-origin',
                                });
                                const json = await res.json();
                                if (res.ok && json.success) {
                                    // show success feedback
                                    const msg = document.createElement('div');
                                    msg.className = 'p-3 rounded bg-green-100 text-green-800';
                                    msg.textContent = 'Saved successfully';
                                    form.prepend(msg);
                                    setTimeout(() => {
                                        // close modal
                                        container.remove();
                                    }, 800);
                                } else {

                                    const err = (json && json.error) ? json.error : 'Save failed';
                                    const msg = document.createElement('div');
                                    msg.className = 'p-3 rounded bg-red-100 text-red-800';
                                    msg.textContent = err;
                                    form.prepend(msg);
                                    if (submitBtn) submitBtn.disabled = false;
                                }
                            } catch (err) {
                                console.error(err);
                                const msg = document.createElement('div');
                                msg.className = 'p-3 rounded bg-red-100 text-red-800';
                                msg.textContent = 'Network error while saving';
                                form.prepend(msg);
                                if (submitBtn) submitBtn.disabled = false;
                            }
                        });
                    }
                }
                // expose for dynamically opened modals (edit flow)
                window.attachModalListeners = attachModalListeners;

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
    <script>
        // Edit/delete handlers for table rows
        (function () {
            document.addEventListener('click', async function (e) {
                const el = e.target;
                // Edit
                if (el.matches('.edit-item')) {
                    e.preventDefault();
                    const id = el.getAttribute('data-id');
                    const slug = '<?= htmlspecialchars($slug, ENT_QUOTES, 'UTF-8') ?>';
                    const slugEsc = encodeURIComponent(slug || '');
                    try {
                        const res = await fetch(`/editor/getModal?slug=${slugEsc}&id=${encodeURIComponent(id)}`, { credentials: 'same-origin' });
                        if (!res.ok) throw new Error('Failed to load modal');
                        const html = await res.text();
                        const wrapper = document.createElement('div');
                        wrapper.innerHTML = html;
                        const modalEl = wrapper.firstElementChild;
                        if (!modalEl) return;
                        document.body.appendChild(modalEl);
                        // attach the same modal listeners used earlier
                        // reuse attachModalListeners from above by searching for it
                        if (typeof attachModalListeners === 'function') {
                            attachModalListeners(modalEl);
                        } else {
                            // fallback: close button support
                            modalEl.querySelectorAll('.cancel-modal').forEach(el => el.addEventListener('click', () => modalEl.remove()));
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Could not load edit modal');
                    }
                }

                // Delete
                if (el.matches('.delete-item')) {
                    e.preventDefault();
                    const id = el.getAttribute('data-id');
                    if (!confirm('Delete this item?')) return;
                    try {
                        const form = new FormData();
                        form.append('id', id);
                        const res = await fetch('/editor/delete', { method: 'POST', body: form, credentials: 'same-origin' });
                        const json = await res.json();
                        if (res.ok && json.success) {
                            // remove row from DOM
                            const row = el.closest('tr');
                            if (row) row.remove();
                        } else {
                            alert(json.message || 'Delete failed');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Network error while deleting');
                    }
                }
            });
        })();
    </script>
</body>

</html>
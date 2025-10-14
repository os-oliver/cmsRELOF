<?php

use App\Models\Content;
use App\Models\GenericCategory;
session_start();
if (isset($_GET['locale']))
    $_SESSION['locale'] = $_GET['locale'];
$locale = $_SESSION['locale'] ?? 'sr-Cyrl';

use App\Controllers\{AuthController, ContentController};
use App\Utils\CardRenderer;

AuthController::requireEditor();
[$name, $surname, $role] = AuthController::getUserInfo();

// Extract slug and load config
$slug = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'))[1] ?? null;
$config = $fieldLabels = [];
if ($slug && file_exists($structurePath = __DIR__ . '/../../assets/data/structure.json')) {
    $parsed = json_decode(file_get_contents($structurePath), true);
    $config = $parsed[0][$slug] ?? [];
    $fieldLabels = array_column($config['fields'] ?? [], null, 'name');
}

// Pagination
$itemsPerPage = 3;
$currentPage = max(1, (int) ($_GET['page'] ?? 1));

function renderCard($item, $fieldLabels, $locale)
{
    $itemId = htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8');
    $html = "<div class='bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 relative group border border-gray-100'>";

    // Action buttons
    $html .= "<div class='absolute top-0 left-0 right-0 p-4 bg-gradient-to-b from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20 flex justify-end space-x-2'>";
    $html .= "<button class='edit-item p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all shadow-lg hover:shadow-xl transform hover:scale-110' data-id='{$itemId}'><i class='fas fa-edit'></i></button>";
    $html .= "<button class='delete-item p-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all shadow-lg hover:shadow-xl transform hover:scale-110' data-id='{$itemId}'><i class='fas fa-trash'></i></button>";
    $html .= "</div>";

    // Display image
    $displayedImage = false;
    if (!empty($item['image'])) {
        $html .= "<div class='w-full h-56 relative overflow-hidden'><img src='" . htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8') . "' class='w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500'></div>";
        $displayedImage = true;
    } else {
        foreach ($fieldLabels as $fieldName => $fieldConfig) {
            if (($fieldConfig['type'] ?? '') === 'file' && isset($item['fields'][$fieldName])) {
                $translations = $item['fields'][$fieldName];
                $value = $translations[$locale] ?? reset($translations);
                if ($value) {
                    $html .= "<div class='w-full h-56 relative overflow-hidden'><img src='" . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . "' class='w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500'></div>";
                    break;
                }
            }
        }
    }

    // Card content
    $html .= "<div class='p-6'>";
    foreach ($item['fields'] as $fieldName => $translations) {
        if (($fieldLabels[$fieldName]['type'] ?? '') === 'file')
            continue;

        $value = $translations[$locale] ?? reset($translations);
        $label = $fieldLabels[$fieldName]['label'][$locale] ?? $fieldLabels[$fieldName]['label']['en'] ?? $fieldName;
        $displayValue = strlen($value) > 100 ? substr($value, 0, 100) . '...' : $value;

        $html .= "<div class='mb-3'><h3 class='text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1'>{$label}</h3><div class='text-gray-800 text-sm leading-relaxed'>{$displayValue}</div></div>";
    }
    $html .= "</div></div>";

    return $html;
}

function renderPagination($currentPage, $totalPages, $start, $end, $total)
{
    $html = "<div class='flex flex-col items-center space-y-4 mt-8 bg-white p-6 rounded-xl shadow-md'>";
    $html .= "<div class='text-sm text-gray-600 font-medium'>Prikazano {$start}-{$end} od {$total} stavki</div>";
    $html .= "<div class='flex items-center space-x-2'>";

    // Previous
    if ($currentPage > 1) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage - 1]));
        $html .= "<a href='{$url}' class='bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-primary-500 px-4 py-2 rounded-lg flex items-center space-x-2 transition-all'><i class='fas fa-chevron-left text-sm'></i><span>Prethodna</span></a>";
    } else {
        $html .= "<span class='bg-gray-100 text-gray-400 cursor-not-allowed px-4 py-2 rounded-lg flex items-center space-x-2'><i class='fas fa-chevron-left text-sm'></i><span>Prethodna</span></span>";
    }

    // Page numbers
    $html .= "<div class='flex items-center space-x-1'>";
    if ($currentPage > 3) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => 1]));
        $html .= "<a href='{$url}' class='bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-primary-500 px-4 py-2 rounded-lg transition-all font-medium'>1</a>";
        if ($currentPage > 4)
            $html .= "<span class='px-3 text-gray-400'>...</span>";
    }

    for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $i]));
        $class = $i === $currentPage ? 'bg-primary-600 text-white border-2 border-primary-600' : 'bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-primary-500';
        $html .= "<a href='{$url}' class='{$class} px-4 py-2 rounded-lg transition-all font-medium'>{$i}</a>";
    }

    if ($currentPage < $totalPages - 2) {
        if ($currentPage < $totalPages - 3)
            $html .= "<span class='px-3 text-gray-400'>...</span>";
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $totalPages]));
        $html .= "<a href='{$url}' class='bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-primary-500 px-4 py-2 rounded-lg transition-all font-medium'>{$totalPages}</a>";
    }
    $html .= "</div>";

    // Next
    if ($currentPage < $totalPages) {
        $url = '?' . http_build_query(array_merge($_GET, ['page' => $currentPage + 1]));
        $html .= "<a href='{$url}' class='bg-white border-2 border-gray-300 text-gray-700 hover:bg-gray-50 hover:border-primary-500 px-4 py-2 rounded-lg flex items-center space-x-2 transition-all'><span>Sledeća</span><i class='fas fa-chevron-right text-sm'></i></a>";
    } else {
        $html .= "<span class='bg-gray-100 text-gray-400 cursor-not-allowed px-4 py-2 rounded-lg flex items-center space-x-2'><span>Sledeća</span><i class='fas fa-chevron-right text-sm'></i></span>";
    }

    $html .= "</div></div>";
    return $html;
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
    <script src="/assets/js/dashboard/tailwindConf.js"></script>
    <link rel="stylesheet" href="/assets/css/dashboard/structure.css">
</head>

<body class="bg-gradient-to-br from-light-100 to-light-200 text-gray-700 font-sans">
    <div class="overlay" id="overlay"></div>
    <div class="flex h-screen overflow-hidden">
        <?php $activeTab = $slug;
        require_once __DIR__ . "/../components/sidebar.php"; ?>

        <div class="flex-1 flex flex-col overflow-hidden">
            <?php require_once __DIR__ . "/../components/topBar.php"; ?>

            <main class="flex-1 overflow-y-auto p-6">
                <div class="mx-auto space-y-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
                        <h1 class="text-3xl font-bold text-gray-800">
                            <?= htmlspecialchars($slug ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </h1>
                        <button id="newEventButton"
                            class="bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white px-6 py-2 rounded-lg transition-all flex items-center gap-2 shadow-lg">
                            <i class="fas fa-plus text-sm"></i><?= $slug ?>
                        </button>
                    </div>



                    <div class="mx-auto max-w-7xl p-6">
                        <?php
                        $categories = GenericCategory::fetchAll($slug, $locale);
                        echo CardRenderer::renderTopbar($categories, '') ?>
                        <?php
                        try {

                            $search = $_GET['search'] ?? '';


                            // Sanitize category — only use it if it's a numeric value
                            $categoryId = isset($_GET['category']) && is_numeric($_GET['category'])
                                ? (int) $_GET['category']
                                : null;

                            $itemsList = $slug
                                ? (new Content())->fetchListData($slug, $search, $currentPage, $itemsPerPage, $categoryId, $locale)
                                : ['success' => false, 'items' => []];

                            if ($itemsList['success'] && !empty($itemsList['items'])) {
                                echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">';
                                foreach ($itemsList['items'] as $item) {
                                    echo CardRenderer::renderCard($item, $fieldLabels, $locale, true);
                                }
                                echo '</div>';

                                $totalPages = ceil($itemsList['total'] / $itemsPerPage);
                                $start = ($currentPage - 1) * $itemsPerPage + 1;
                                $end = min($start + $itemsPerPage - 1, $itemsList['total']);
                                echo CardRenderer::renderPagination($currentPage, $totalPages, $start, $end, $itemsList['total'], 'editor');
                            } else {
                                echo "<div class='bg-white rounded-xl shadow-md p-12 text-center'><i class='fas fa-inbox text-6xl text-gray-300 mb-4'></i><p class='text-gray-500 text-lg'>Nema pronađenih stavki</p></div>";
                            }
                        } catch (\Throwable $e) {
                            error_log('List render error: ' . $e->getMessage());
                            echo "<div class='mt-4 p-4 rounded-lg bg-red-100 text-red-800 border border-red-300'>Nije moguće učitati stavke: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</div>";
                        }
                        ?>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="/assets/js/dashboard/mobileMenu.js" defer></script>
    <script>
        const slug = <?= json_encode($slug) ?>;

        const Modal = {
            async fetch(s, id = null) {
                const url = `/editor/getModal?slug=${encodeURIComponent(s)}${id ? `&id=${encodeURIComponent(id)}` : ''}`;
                const res = await fetch(url, { credentials: 'same-origin' });
                if (!res.ok) throw new Error('Failed to load modal: ' + res.statusText);
                const html = await res.text();
                if (!html || html.trim().length === 0) throw new Error('Empty modal content received');
                return html;
            },

            show(html) {
                const wrapper = document.createElement('div');
                wrapper.innerHTML = html.trim();
                const modalEl = wrapper.firstElementChild;
                if (!modalEl) throw new Error('Invalid modal HTML structure');

                document.body.appendChild(modalEl);
                this.attachListeners(modalEl);
            },

            attachListeners(container) {
                if (container.__modalInitialized) return;
                container.__modalInitialized = true;

                // Close handlers
                container.querySelectorAll('.cancel-modal').forEach(el => {
                    el.addEventListener('click', (e) => {
                        e.preventDefault();
                        container.remove();
                    });
                });

                container.addEventListener('click', (e) => {
                    if (e.target === container) container.remove();
                });

                const form = container.querySelector('form');
                if (!form) return;

                // File input handlers
                form.querySelectorAll('input[type=file]').forEach(inp => {
                    if (inp.__previewAttached) return;
                    inp.__previewAttached = true;

                    const nameSanitized = inp.name.replace(/\[\]$/, '');
                    if (!inp.__dt) inp.__dt = new DataTransfer();

                    if (inp.files?.length && inp.__dt.files.length === 0) {
                        for (const f of inp.files) inp.__dt.items.add(f);
                        inp.files = inp.__dt.files;
                    }

                    const findPreview = () => {
                        const selectors = [`#preview-${nameSanitized}`, `[id*="preview_${nameSanitized}"]`];
                        for (const sel of selectors) {
                            const el = container.querySelector(sel);
                            if (el) return el;
                        }
                        const c = document.createElement('div');
                        c.id = `preview-${nameSanitized}`;
                        c.className = 'mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4';
                        inp.parentNode.appendChild(c);
                        return c;
                    };

                    const renderFiles = () => {
                        const preview = findPreview();
                        preview.innerHTML = '';
                        const files = Array.from(inp.__dt.files || []);

                        files.forEach((file, idx) => {
                            const isImage = /\.(jpe?g|png|gif|webp|bmp|svg)$/i.test(file.name) || file.type?.startsWith('image/');
                            const wrapper = document.createElement('div');
                            wrapper.className = 'relative group rounded-lg overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition';

                            if (isImage) {
                                wrapper.innerHTML = `<img src="${URL.createObjectURL(file)}" class="w-full h-32 object-cover">`;
                            } else {
                                wrapper.innerHTML = `<div class="w-full h-32 p-3 bg-gray-50 flex flex-col items-center justify-center gap-2">
                                    <i class="fas fa-file text-blue-600 text-3xl"></i>
                                    <div class="text-sm font-medium text-gray-700 truncate w-full text-center px-2">${file.name}</div>
                                    <div class="text-xs text-gray-500">${Math.round(file.size / 1024)} KB</div>
                                </div>`;
                            }

                            const overlay = document.createElement('div');
                            overlay.className = 'absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-end p-2';
                            overlay.innerHTML = `<button type="button" class="w-full text-white text-xs bg-red-600 px-3 py-1.5 rounded hover:bg-red-700 transition"><i class="fas fa-trash"></i> Remove</button>`;
                            overlay.querySelector('button').addEventListener('click', () => {
                                const dt = new DataTransfer();
                                files.forEach((f, i) => { if (i !== idx) dt.items.add(f); });
                                inp.__dt = dt;
                                inp.files = inp.__dt.files;
                                renderFiles();
                            });

                            wrapper.appendChild(overlay);
                            preview.appendChild(wrapper);
                        });
                    };

                    inp.addEventListener('change', (ev) => {
                        const selected = Array.from(ev.target.files || []);
                        if (!selected.length) {
                            if (!inp.multiple) {
                                inp.__dt = new DataTransfer();
                                inp.files = inp.__dt.files;
                            }
                            renderFiles();
                            return;
                        }

                        if (inp.multiple) {
                            for (const f of selected) {
                                const exists = Array.from(inp.__dt.files).some(of => of.name === f.name && of.size === f.size);
                                if (!exists) inp.__dt.items.add(f);
                            }
                        } else {
                            inp.__dt = new DataTransfer();
                            inp.__dt.items.add(selected[0]);
                        }
                        inp.files = inp.__dt.files;
                        renderFiles();
                    });

                    renderFiles();
                });

                // Existing file removal
                container.querySelectorAll('.existing-remove-btn').forEach(btn => {
                    if (btn.__removeHandlerAttached) return;
                    btn.__removeHandlerAttached = true;

                    btn.addEventListener('click', (e) => {
                        e.preventDefault();
                        const checkbox = container.querySelector(`input[type="checkbox"][name="remove_${btn.dataset.field}[]"][value="${btn.dataset.value}"]`);
                        if (checkbox) checkbox.checked = true;

                        const wrapper = btn.closest('.existing-file-wrapper');
                        if (wrapper) {
                            wrapper.style.cssText = 'opacity: 0.4; filter: grayscale(100%); position: relative;';
                            const badge = document.createElement('div');
                            badge.className = 'absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 rounded';
                            badge.textContent = 'Marked for removal';
                            wrapper.appendChild(badge);
                            btn.disabled = true;
                        }
                    });
                });

                // Form submission
                form.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    const submitBtn = form.querySelector('button[type=submit]');
                    if (submitBtn?.disabled) return;

                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.classList.add('opacity-70');
                    }

                    const fd = new FormData(form);
                    if (slug && !fd.has('type')) fd.append('type', slug);

                    try {
                        const res = await fetch('/editor/insert', { method: 'POST', body: fd, credentials: 'same-origin' });
                        const json = await res.json();

                        if (res.ok && json.success) {
                            this.showMessage(form, 'Uspešno sačuvano!', 'success');
                            setTimeout(() => window.location.reload(), 800);
                        } else {
                            this.showMessage(form, json?.error || 'Neuspelo čuvanje', 'error');
                            if (submitBtn) {
                                submitBtn.disabled = false;
                                submitBtn.classList.remove('opacity-70');
                            }
                        }
                    } catch (err) {
                        console.error(err);
                        this.showMessage(form, 'Greška u mreži', 'error');
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.classList.remove('opacity-70');
                        }
                    }
                });
            },

            showMessage(form, text, type) {
                const msg = document.createElement('div');
                msg.className = `p-3 rounded-lg mb-4 ${type === 'success' ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-red-100 text-red-800 border border-red-300'}`;
                msg.textContent = text;
                form.prepend(msg);
            }
        };

        // New item button - Fixed to prevent empty HTML
        document.getElementById('newEventButton')?.addEventListener('click', async (e) => {
            e.preventDefault();
            const btn = e.currentTarget;
            btn.disabled = true;

            try {
                const html = await Modal.fetch(slug);
                Modal.show(html);
            } catch (err) {
                console.error('Modal error:', err);
                alert('Greška pri učitavanju modalnog prozora: ' + err.message);
            } finally {
                btn.disabled = false;
            }
        });

        // Edit/Delete handlers
        document.addEventListener('click', async (e) => {
            const editBtn = e.target.closest('.edit-item');
            const deleteBtn = e.target.closest('.delete-item');

            if (editBtn) {
                e.preventDefault();
                const id = editBtn.dataset.id;
                if (!id) return;

                try {
                    const html = await Modal.fetch(slug, id);
                    Modal.show(html);
                } catch (err) {
                    console.error(err);
                    alert('Greška pri učitavanju: ' + err.message);
                }
            }

            if (deleteBtn) {
                e.preventDefault();
                const id = deleteBtn.dataset.id;
                if (!id || !confirm('Da li ste sigurni da želite da obrišete ovu stavku?')) return;

                try {
                    const form = new FormData();
                    form.append('id', id);
                    const res = await fetch('/editor/delete', { method: 'POST', body: form, credentials: 'same-origin' });
                    const json = await res.json();

                    if (res.ok && json.success) {
                        const card = deleteBtn.closest('.group');
                        if (card) {
                            card.style.cssText = 'transition: all 0.3s; opacity: 0; transform: scale(0.9);';
                            setTimeout(() => window.location.reload(), 300);
                        }
                    } else {
                        alert(json.message || 'Brisanje nije uspelo');
                    }
                } catch (err) {
                    console.error(err);
                    alert('Greška u mreži prilikom brisanja');
                }
            }
        });
    </script>
</body>

</html>
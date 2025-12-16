<?php

namespace App\Admin\PageBuilders;

use App\Models\Document;
use App\Controllers\AuthController;

class DocumentsPageBuilder extends BasePageBuilder
{
    protected string $css = <<<CSS
    /* Enhanced styles for documents page */
    .category-toggle input:checked+label {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
    }

    /* Make each card a column and enforce uniform height so the download button sits at the bottom */
    .document-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 220px;
        max-height: 280px;
        will-change: transform;
    }

  

    .card-hover {
        transition: all 0.28s cubic-bezier(.2,.9,.2,1);
    }

    .card-hover:hover {
        transform: translateY(-6px);
        box-shadow: 0 24px 48px rgba(2,6,23,0.12);
    }

    .download-btn {
        background: linear-gradient(135deg, #10b981, #059669);
        transition: all 0.25s ease;
    }

    .download-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(16, 185, 129, 0.22);
    }

    .view-btn { display: none; } /* removed view button from UI */

    .file-icon {
        background: linear-gradient(135deg, #f97316, #ea580c);
    }

    .file-icon-blue {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    }

    .file-icon-purple {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    }

    .file-icon-red {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .fade-in {
        animation: fadeIn 0.45s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .download-notification { animation: slideInRight 0.45s ease-out; }
    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(80px); }
        to   { opacity: 1; transform: translateX(0); }
    }

    /* Small helpers */
    .doc-meta { color: #6b7280; }
    .doc-category { font-size: .85rem; padding: .25rem .5rem; border-radius: .5rem; }
    CSS;

    protected string $script = <<<'HTML'
<script>
        document.querySelectorAll('input[name="categories[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                document.getElementById('filter-form').submit();
            });
        });
function showDownloadNotification(e, name) {
    const note = document.getElementById('download-notification');
    const text = document.getElementById('download-notification-text');
    if (!note || !text) return;
    text.textContent = name + ' se preuzima...';
    note.classList.remove('hidden');
    setTimeout(() => note.classList.add('hidden'), 2200);
}

document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filter-form');
    const categoriesContainer = document.getElementById('categories-container');
    
    // Handle URL parameters for categories
    const urlParams = new URLSearchParams(window.location.search);
    const selectedCategories = urlParams.getAll('categories[]');
    
    // Check categories from URL
    if (selectedCategories.length > 0) {
        selectedCategories.forEach(catId => {
            const checkbox = document.querySelector(`input[name="categories[]"][value="${catId}"]`);
            if (checkbox) {
                checkbox.checked = true;
                const label = document.querySelector(`label[for="${checkbox.id}"]`);
                if (label) {
                    label.classList.add('bg-gradient-to-r', 'from-blue-600', 'to-indigo-600', 'text-white');
                    label.classList.remove('bg-white', 'hover:bg-gray-50');
                }
            }
        });
    }
    
    if (categoriesContainer) {
        categoriesContainer.addEventListener('change', function(e) {
            if (e.target.type === 'checkbox') {
                const label = document.querySelector(`label[for="${e.target.id}"]`);
                if (label) {
                    if (e.target.checked) {
                        label.classList.add('bg-gradient-to-r', 'from-blue-600', 'to-indigo-600', 'text-white');
                        label.classList.remove('bg-white', 'hover:bg-gray-50');
                    } else {
                        label.classList.remove('bg-gradient-to-r', 'from-blue-600', 'to-indigo-600', 'text-white');
                        label.classList.add('bg-white', 'hover:bg-gray-50');
                    }
                }
            }
        });
    }

    if (filterForm) {
        filterForm.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            const label = document.querySelector(`label[for="${checkbox.id}"]`);
            if (label && checkbox.checked) {
                label.classList.add('bg-gradient-to-r', 'from-blue-600', 'to-indigo-600', 'text-white');
                label.classList.remove('bg-white', 'hover:bg-gray-50');
            }
        });
    }
});
</script>
HTML;

    protected string $html = <<<'HTML'
<main>
    <div class="text-center px-2 pt-32">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4">Dokumenti za preuzimanje</h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto mb-10">Preuzmi sva potrebna dokumenta, obrasce i publikacije Kulturnog Nexusa. Slažemo ih po kategorijama radi lakšeg pronalaženja.</p>

        <div class="mx-auto max-w-6xl">
            <form id="filter-form" method="GET" action="" class="bg-white rounded-2xl shadow p-6 mb-8 border border-gray-100">
                <div class="space-y-6">
                    <div class="flex gap-4 items-center">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-search text-gray-400"></i>
                            </div>
                            <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                   placeholder="Pretraži dokumenta..." class="w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl">
                        </div>
                        <select name="sort" class="px-4 py-3 border rounded-xl w-48">
                            <option value="date_desc" <?= ($_GET['sort'] ?? '') === 'date_desc' ? 'selected' : '' ?>>Najnoviji prvo</option>
                            <option value="date_asc" <?= ($_GET['sort'] ?? '') === 'date_asc' ? 'selected' : '' ?>>Najstariji prvo</option>
                            <option value="title" <?= ($_GET['sort'] ?? '') === 'title' ? 'selected' : '' ?>>Po nazivu</option>
                        </select>
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl whitespace-nowrap">Primeni</button>
                    </div>

                    <div class="w-full">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3">Kategorije</h3>
                        <div class="flex flex-wrap gap-2" id="categories-container">
                            <?php
                            $selectedCategories = isset($_GET['categories']) ? (array) $_GET['categories'] : [];
                            foreach ($DocumentCategories as $doc):
                                $isChecked = in_array($doc['id'], $selectedCategories);
                            ?>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" 
                                           name="categories[]" 
                                           value="<?= htmlspecialchars($doc['id'], ENT_QUOTES, 'UTF-8') ?>"
                                           <?= $isChecked ? 'checked' : '' ?>
                                           class="sr-only peer"
                                           id="category_<?= htmlspecialchars($doc['id'], ENT_QUOTES, 'UTF-8') ?>">
                                    <label for="category_<?= htmlspecialchars($doc['id'], ENT_QUOTES, 'UTF-8') ?>" 
                                           class="px-4 py-2 rounded-full border cursor-pointer <?= $isChecked ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white' : 'bg-white hover:bg-gray-50' ?> 
                                           transition-all duration-200 text-sm font-medium select-none">
                                        <?= htmlspecialchars($doc['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                    </label>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Notification -->
            <div id="download-notification" class="hidden fixed top-6 right-6 bg-green-600 text-white px-5 py-3 rounded-2xl shadow-lg z-50">
                <div class="flex items-center gap-3"><i class="fa-solid fa-check"></i><span id="download-notification-text">Dokument se preuzima...</span></div>
            </div>

            <?php if (count($documents) > 0): ?>
                <div id="documents-grid" class="max-w-7xl mx-auto grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($documents as $document):
                        $cfg = getFileConfig($document['extension'] ?? '');

                        // safe values
                        $categoryName = htmlspecialchars($document['name'] ?? '', ENT_QUOTES, 'UTF-8');
                        $title = htmlspecialchars($document['title'] ?? '', ENT_QUOTES, 'UTF-8');
                        $description = htmlspecialchars($document['description'] ?? '', ENT_QUOTES, 'UTF-8');
                        $filepath = htmlspecialchars($document['filepath'] ?? '', ENT_QUOTES, 'UTF-8');
                        $fileId = (int)($document['id'] ?? 0);

                        try {
                            $date = new DateTime($document['datetime'] ?? 'now');
                        } catch (\Exception $e) {
                            $date = new DateTime();
                        }
                        $formattedDate = $date->format('d/m/Y');
                        $fileSize = isset($document['fileSize']) ? number_format((float)$document['fileSize'], 2) : '0.00';
                    ?>
                        <article class="document-card bg-white rounded-2xl shadow card-hover p-6 fade-in" data-category="<?= $categoryName ?>" data-name="<?= $title ?>">
                            <div class="card-body">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 <?= $cfg['bg_color'] ?? 'bg-gray-50' ?> rounded-lg flex items-center justify-center">
                                            <i class="<?= $cfg['icon'] ?? 'fa-solid fa-file' ?> <?= $cfg['text_color'] ?? 'text-gray-700' ?> text-lg"></i>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-medium <?= $cfg['text_color'] ?? 'text-gray-700' ?> doc-category bg-<?= $cfg['color'] ?? 'gray' ?>-50"><?= $categoryName ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <button class="text-gray-400 hover:text-gray-600 p-2 rounded-lg hover:bg-gray-100" aria-label="options">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                    </div>
                                </div>

                                <h3 class="text-lg font-semibold text-gray-800 "><?= $title ?: basename($filepath) ?></h3>
                                <p class="text-sm text-gray-600 mb-4 leading-relaxed"><?= $description ?: '&nbsp;' ?></p>

                                <div class="flex items-center justify-between text-sm doc-meta mb-5">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <span>Ažurirano: <?= $formattedDate ?></span>
                                    </div>
                                    <div class="font-semibold"><?= $fileSize ?> MB</div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="/uploads/documents/<?= $filepath ?>" class="w-full inline-flex items-center justify-center py-2 rounded-lg download-btn text-white font-semibold" download data-id="<?= $fileId ?>" onclick="showDownloadNotification(event, '<?= addslashes($title ?: basename($filepath)) ?>')">
                                    <i class="fa-solid fa-download mr-2"></i> Preuzmi
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <div class="mt-10 mb-16 flex justify-center items-center gap-4">
                    <?php if ($page > 1): ?>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" class="px-4 py-2 bg-white rounded-xl shadow hover:bg-gray-100">&laquo; Prethodna</a>
                    <?php endif; ?>

                    <div class="flex items-center gap-2">
                        <?php
                        $startPage = max(1, $page - 2);
                        $endPage = min($totalPages, $page + 2);
                        for ($i = $startPage; $i <= $endPage; $i++):
                        ?>
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" class="w-9 h-9 flex items-center justify-center rounded-full <?= $i == $page ? 'bg-gradient-to-r from-blue-500 to-indigo-600 text-white' : 'bg-white hover:bg-gray-100' ?> shadow"><?= $i ?></a>
                        <?php endfor; ?>
                    </div>

                    <?php if ($page < $totalPages): ?>
                        <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>" class="px-4 py-2 bg-white rounded-xl shadow hover:bg-gray-100">Sledeća &raquo;</a>
                    <?php endif; ?>
                </div>

            <?php else: ?>
                <div class="bg-white rounded-2xl shadow p-10 text-center">
                    <div class="mx-auto w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-6">
                        <i class="fa-solid fa-file-lines text-blue-500 text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Nema pronađenih dokumenata</h3>
                    <p class="text-gray-600 max-w-md mx-auto mb-6">Promenite filtere da biste videli druge dokumente ili proverite kasnije.</p>
                    <a href="?" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold rounded-xl">Resetuj filtere</a>
                </div>
            <?php endif; ?>
            <div class="text-left">
                <?php echo renderPerPageDropdown($limit) ?>
            </div>
        </div>
    </div>
</main>
HTML;

    public function buildPage(): string
    {
        $phpAdditional = <<<'PHP'
use App\Models\Document;
use App\Controllers\AuthController;


// defaults (safe)
$search = $_GET['search'] ?? '';
$categories = isset($_GET['categories']) ? (array) $_GET['categories'] : [];
$status = $_GET['status'] ?? '';
$sort = $_GET['sort'] ?? 'date_desc';

// pagination
$limit = 15;
if (isset($_GET['per_page']) && is_numeric($_GET['per_page'])) {
    $limit = (int)$_GET['per_page'];
}
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

$documentModel = new Document();

// fetch documents with filters using array of categories
[$documents, $totalCount] = $documentModel->list(
    search: $search,
    categories: $categories,
    status: $status,
    sort: $sort,
    limit: $limit,
    offset: $offset,
    lang: $locale
);

$totalPages = (int) ceil(max(1, $totalCount) / $limit);
$DocumentCategories = $documentModel->getCategories($locale);

function getFileConfig(string $ext): array {
    $ext = strtolower($ext);
    $configs = [
        'pdf'  => ['icon' => 'fa-solid fa-file-pdf', 'bg_color' => 'bg-red-50',    'text_color' => 'text-red-600',    'color' => 'red-500'],
        'doc'  => ['icon' => 'fa-solid fa-file-word','bg_color' => 'bg-blue-50',   'text_color' => 'text-blue-600',   'color' => 'blue-500'],
        'docx' => ['icon' => 'fa-solid fa-file-word','bg_color' => 'bg-blue-50',   'text_color' => 'text-blue-600',   'color' => 'blue-500'],
        'xls'  => ['icon' => 'fa-solid fa-file-excel','bg_color' => 'bg-green-50',  'text_color' => 'text-green-600',  'color' => 'green-500'],
        'xlsx' => ['icon' => 'fa-solid fa-file-excel','bg_color' => 'bg-green-50',  'text_color' => 'text-green-600',  'color' => 'green-500'],
        'ppt'  => ['icon' => 'fa-solid fa-file-powerpoint','bg_color' => 'bg-orange-50','text_color' => 'text-orange-600','color' => 'orange-500'],
        'pptx' => ['icon' => 'fa-solid fa-file-powerpoint','bg_color' => 'bg-orange-50','text_color' => 'text-orange-600','color' => 'orange-500'],
        'txt'  => ['icon' => 'fa-solid fa-file-lines','bg_color' => 'bg-gray-50',   'text_color' => 'text-gray-700',   'color' => 'gray-500'],
        'zip'  => ['icon' => 'fa-solid fa-file-zipper','bg_color' => 'bg-yellow-50',  'text_color' => 'text-yellow-700',  'color' => 'yellow-500'],
        'rar'  => ['icon' => 'fa-solid fa-file-zipper','bg_color' => 'bg-yellow-50',  'text_color' => 'text-yellow-700',  'color' => 'yellow-500'],
        'default' => ['icon' => 'fa-solid fa-file',  'bg_color' => 'bg-gray-50',   'text_color' => 'text-gray-700',   'color' => 'gray-500']
    ];

    return $configs[$ext] ?? $configs['default'];
}
PHP;

        $content = $this->getHeader($this->css, $phpAdditional);
        $content .= $this->getCommonIncludes();
        $content .= $this->getPerPageDropdown();
        $content .= $this->html;
        $content .= $this->getFooter();
        $content .= $this->script;
        return $content;
    }
}

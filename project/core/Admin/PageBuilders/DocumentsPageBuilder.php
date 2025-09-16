<?php

namespace App\Admin\PageBuilders;

use App\Models\Document;
use App\Controllers\AuthController;

class DocumentsPageBuilder extends BasePageBuilder
{
    static string $style = <<<CSS
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
        min-height: 300px; /* adjust if you want taller/shorter cards */
        will-change: transform;
    }

    .card-body { margin-bottom: 1rem; }
    .card-footer { margin-top: 1rem; }

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

    public function buildPage(): string
    {
        $phpAdditional = <<<'PHP'
use App\Models\Document;
use App\Controllers\AuthController;

AuthController::requireEditor();

// defaults (safe)
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$status = $_GET['status'] ?? '';
$sort = $_GET['sort'] ?? 'date_desc';

// pagination
$limit = 3; // nicer grid by default
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

$documentModel = new Document();

// fetch documents with filters (Document::list should accept named params or fallback)
[$documents, $totalCount] = $documentModel->list(
    search: $search,
    category: $category,
    status: $status,
    sort: $sort,
    limit: $limit,
    offset: $offset,
    lang:$locale
);

$totalPages = (int) ceil(max(1, $totalCount) / $limit);
$DocumentCategories = $documentModel->getCategories();

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

        $content = $this->getHeader(self::$style, $phpAdditional);
        $content .= $this->getCommonIncludes();

        $content .= <<<'HTML'
<main>
    <div class="text-center px-2 pt-32">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-4">Dokumenti za preuzimanje</h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto mb-10">Preuzmi sva potrebna dokumenta, obrasce i publikacije Kulturnog Nexusa. Slažemo ih po kategorijama radi lakšeg pronalaženja.</p>

        <div class="mx-auto max-w-6xl">
            <form id="filter-form" method="GET" action="" class="bg-white rounded-2xl shadow p-6 mb-8 border border-gray-100">
                <div class="flex flex-col lg:flex-row gap-4 items-center">
                    <div class="relative flex-1 w-full">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                               placeholder="Pretraži dokumenta..." class="w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl">
                    </div>

                    <select name="category" class="px-4 py-3 border rounded-xl">
                        <option value="">Sve kategorije</option>
                        <?php foreach ($DocumentCategories as $cat): ?>
                            <option value="<?= htmlspecialchars($cat['id'], ENT_QUOTES, 'UTF-8') ?>" <?= (string)($_GET['category'] ?? '') === (string)$cat['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <select name="sort" class="px-4 py-3 border rounded-xl">
                        <option value="date_desc" <?= ($_GET['sort'] ?? '') === 'date_desc' ? 'selected' : '' ?>>Najnoviji prvo</option>
                        <option value="date_asc" <?= ($_GET['sort'] ?? '') === 'date_asc' ? 'selected' : '' ?>>Najstariji prvo</option>
                        <option value="title" <?= ($_GET['sort'] ?? '') === 'title' ? 'selected' : '' ?>>Po nazivu</option>
                    </select>

                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl">Primeni</button>
                </div>
            </form>

            <!-- Notification -->
            <div id="download-notification" class="hidden fixed top-6 right-6 bg-green-600 text-white px-5 py-3 rounded-2xl shadow-lg z-50">
                <div class="flex items-center gap-3"><i class="fa-solid fa-check"></i><span id="download-notification-text">Dokument se preuzima...</span></div>
            </div>

            <?php if (count($documents) > 0): ?>
                <div id="documents-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
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
                        $formattedDate = $date->format('d.m.Y');
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

                                <h3 class="text-lg font-semibold text-gray-800 mb-2"><?= $title ?: basename($filepath) ?></h3>
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
        </div>
    </div>
</main>

<script>
function showDownloadNotification(e, name) {
    // allow regular link behavior but show notification briefly
    const note = document.getElementById('download-notification');
    const text = document.getElementById('download-notification-text');
    if (!note || !text) return;
    text.textContent = name + ' se preuzima...';
    note.classList.remove('hidden');
    setTimeout(() => note.classList.add('hidden'), 2200);
}

// ensure filter form submits to page 1 when changed (server handles page param)
const filterForm = document.getElementById('filter-form');
if (filterForm) {
    filterForm.addEventListener('submit', function(e) {
        // keep default submit behavior
    });
}
</script>
HTML;

        $content .= $this->getFooter();
        return $content;
    }
}

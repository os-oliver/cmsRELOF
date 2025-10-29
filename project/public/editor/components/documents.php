<div
    class="lg:col-span-2 content-card p-5 rounded-xl border-2 border-gray-100 shadow-sm bg-gradient-to-br from-white to-gray-50">
    <div class="flex justify-between items-center mb-5 pb-3 border-b-2 border-gray-100">
        <div class="flex items-center">
            <div class="w-10 h-10 rounded-lg bg-primary-100 flex items-center justify-center mr-3">
                <i class="fas fa-file-alt text-primary-600 text-lg"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800">
                <?= __("documents.recent_documents") ?>
            </h3>
        </div>
        <a href="/kontrolna-tabla/dokumenti"
            class="text-primary-600 hover:text-primary-800 flex items-center text-sm font-semibold hover:gap-2 transition-all group">
            <span>
                <?= __("documents.view_all") ?>
            </span>
            <i class="fas fa-chevron-right ml-1 text-xs group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>

    <?php
    function getFileMeta($fileOrExt)
    {
        $ext = strtolower(pathinfo($fileOrExt, PATHINFO_EXTENSION));
        if (!$ext) {
            $ext = strtolower(ltrim($fileOrExt, '.'));
        }
        return match ($ext) {
            'pdf' => ['icon' => 'fas fa-file-pdf', 'icon_color' => 'text-red-600', 'bg' => 'bg-red-100', 'border' => 'border-red-500'],
            'doc', 'docx' => ['icon' => 'fas fa-file-word', 'icon_color' => 'text-blue-600', 'bg' => 'bg-blue-100', 'border' => 'border-blue-500'],
            'xls', 'xlsx', 'csv' => ['icon' => 'fas fa-file-excel', 'icon_color' => 'text-green-600', 'bg' => 'bg-green-100', 'border' => 'border-green-500'],
            'ppt', 'pptx' => ['icon' => 'fas fa-file-powerpoint', 'icon_color' => 'text-orange-600', 'bg' => 'bg-orange-100', 'border' => 'border-orange-500'],
            'txt' => ['icon' => 'fas fa-file-lines', 'icon_color' => 'text-gray-600', 'bg' => 'bg-gray-100', 'border' => 'border-gray-400'],
            'jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp' => ['icon' => 'fas fa-file-image', 'icon_color' => 'text-pink-600', 'bg' => 'bg-pink-100', 'border' => 'border-pink-500'],
            'zip', 'rar', '7z', 'tar', 'gz' => ['icon' => 'fas fa-file-archive', 'icon_color' => 'text-yellow-700', 'bg' => 'bg-yellow-100', 'border' => 'border-yellow-500'],
            'mp3', 'wav', 'ogg', 'm4a' => ['icon' => 'fas fa-file-audio', 'icon_color' => 'text-indigo-600', 'bg' => 'bg-indigo-100', 'border' => 'border-indigo-500'],
            'mp4', 'mov', 'avi', 'mkv', 'webm' => ['icon' => 'fas fa-file-video', 'icon_color' => 'text-teal-600', 'bg' => 'bg-teal-100', 'border' => 'border-teal-500'],
            default => ['icon' => 'fas fa-file-alt', 'icon_color' => 'text-gray-600', 'bg' => 'bg-gray-100', 'border' => 'border-gray-300'],
        };
    }
    ?>

    <div class="space-y-3">
        <?php foreach ($documents as $doc): ?>
            <?php
            $filename = $doc['name'] ?? $doc['title'] ?? '';
            $extInput = $doc['extension'] ?? $filename;
            $meta = getFileMeta($extInput);
            $dt = strtotime($doc['datetime'] ?? '');
            $dateStr = $dt ? date('j. F Y. \u\  H:i\h', $dt) : '';
            ?>
            <div
                class="bg-white p-3 rounded-lg border-l-4 <?= $meta['border'] ?> shadow-md hover:shadow-xl transition-all duration-200 hover:-translate-y-0.5 flex items-center gap-3">
                <div class="<?= $meta['bg'] ?> p-2.5 rounded-lg flex-shrink-0">
                    <i class="<?= $meta['icon'] ?> <?= $meta['icon_color'] ?> text-xl"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-bold text-gray-800 text-sm mb-1 truncate">
                        <?= htmlspecialchars($doc['title']) ?>
                    </h4>
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-gray-600">
                        <div class="flex items-center">
                            <i class="far fa-folder mr-1 <?= $meta['icon_color'] ?>"></i>
                            <span><?= htmlspecialchars($doc['name']) ?></span>
                        </div>
                        <div class="flex items-center">
                            <i class="far fa-clock mr-1 <?= $meta['icon_color'] ?>"></i>
                            <span><?= $dateStr ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <button id="newDocumentBtn"
        class="mt-4 w-full py-3 bg-gradient-to-r from-primary-500 to-primary-600 hover:from-primary-600 hover:to-primary-700 text-white rounded-lg flex items-center justify-center text-sm font-bold transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
        <i class="fas fa-plus mr-2 text-sm"></i>
        <span>
            <?= __("documents.add_new_document") ?>
        </span>
    </button>
</div>
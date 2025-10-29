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

    <div class="space-y-3">
        <?php foreach ($documents as $doc): ?>
            <div
                class="bg-white p-3 rounded-lg border-l-4 border-primary-500 shadow-md hover:shadow-xl transition-all duration-200 hover:-translate-y-0.5 flex items-center gap-3">
                <div class="bg-primary-100 p-2.5 rounded-lg flex-shrink-0">
                    <i class="fas fa-file-pdf text-primary-600 text-xl"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-bold text-gray-800 text-sm mb-1 truncate">
                        <?= htmlspecialchars($doc['title']) ?>
                    </h4>
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-gray-600">
                        <div class="flex items-center">
                            <i class="far fa-folder mr-1 text-primary-500"></i>
                            <span><?= htmlspecialchars($doc['name']) ?></span>
                        </div>
                        <div class="flex items-center">
                            <i class="far fa-clock mr-1 text-primary-500"></i>
                            <span><?= date('j. F Y. \u\  H:i\h', strtotime($doc['datetime'])); ?></span>
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
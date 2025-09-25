<?php


?>


<div class="lg:col-span-2 content-card p-5 rounded-xl border border-gray-200">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-800">
            <?= __("documents.recent_documents") ?>
        </h3>
        <a href="/dashboard/dokumenti" class="text-primary-600 hover:text-primary-800 flex items-center">
            <span>
                <?= __("documents.view_all") ?>
            </span>
            <i class="fas fa-chevron-right ml-1 text-sm"></i>
        </a>
    </div>

    <div class="space-y-4">

        <?php foreach ($documents as $doc): ?>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 flex items-start">
                <div class="bg-primary-100 p-2 rounded-lg mr-4">
                    <i class="fas fa-file-pdf text-primary-600 text-xl"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-medium text-gray-800"><?= htmlspecialchars($doc['title']) ?></h4>
                    <div class="flex items-center text-sm text-gray-600 mt-2">
                        <span class="mr-4"><i class="far fa-folder mr-1"></i>
                            <?= htmlspecialchars(string: $doc['name']) ?></span>
                        <span><i class="far fa-clock mr-1"></i>
                            <?= date('j. F Y. \u\  H:i\h', strtotime($doc['datetime'])); ?></span>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>



    </div>

    <button id="newDocumentBtn"
        class="mt-6 w-full py-3 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white rounded-lg flex items-center justify-center font-medium transition-all">
        <i class="fas fa-plus mr-2"></i>
        <span>
            <?= __("documents.add_new_document") ?>
        </span>

    </button>
</div>
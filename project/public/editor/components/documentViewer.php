<?php
    if (isset($_GET['locale'])) {
        $_SESSION['locale'] = $_GET['locale'];
    }
    $locale = $_SESSION['locale'] ?? 'sr-Cyrl';
?>
<div class="modal-overlay hidden" id="documentModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="text-xl font-bold" id="modalTitle">
                <?php
                    switch ($locale) {
                        case 'sr': echo 'Naziv dokumenta'; break;
                        case 'en': echo 'Document name'; break;
                        default: echo 'Назив документа'; break;
                    }
                ?>
            </h3>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="file-preview">
                <iframe id="fileFrame" class="w-full h-full" frameborder="0"></iframe>
            </div>
            <div class="file-details">
                <div class="mb-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-14 h-14 bg-red-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-file-pdf text-2xl text-red-600"></i>
                        </div>
                        <div>
                            <span id="docCategory"
                                class="text-sm font-medium text-red-600 bg-red-50 px-2 py-1 rounded-lg">
                                <?php
                                    switch ($locale) {
                                        case 'sr': echo 'Kategorija'; break;
                                        case 'en': echo 'Category'; break;
                                        default: echo 'Категорија'; break;
                                    }
                                ?>
                            </span>
                            <span id="docStatus"
                                class="ml-2 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full">Status</span>
                        </div>
                    </div>
                    <p id="docDescription" class="text-gray-600 mb-4">
                        <?php
                            switch ($locale) {
                                case 'sr': echo 'Opis dokumenta'; break;
                                case 'en': echo 'Document description'; break;
                                default: echo 'Опис документа'; break;
                            }
                        ?>
                    </p>
                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                        <i class="fas fa-calendar h-4 w-4"></i>
                        <span id="docDate">
                            <?php
                                switch ($locale) {
                                    case 'sr': echo 'Datum'; break;
                                    case 'en': echo 'Date'; break;
                                    default: echo 'Датум'; break;
                                }
                            ?>
                    </span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                        <i class="fas fa-file h-4 w-4"></i>
                        <span id="docSize">
                            <?php
                                switch ($locale) {
                                    case 'sr': echo 'Veličina'; break;
                                    case 'en': echo 'Size'; break;
                                    default: echo 'Величина'; break;
                                }
                            ?>
                        </span>
                    </div>
                </div>

                <div class="flex flex-col space-y-3">
                    <button id="downloadButton"
                        class="hidden flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl font-medium transition">
                        <i class="fas fa-download"></i>
                            <?php
                                switch ($locale) {
                                    case 'sr': echo 'Preuzmi'; break;
                                    case 'en': echo 'Download'; break;
                                    default: echo 'Преузми'; break;
                                }
                            ?>
                    </button>
                    <button id="shareButton"
                        class="flex items-center gap-2 border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                        <i class="fas fa-share-alt h-4 w-4"></i>
                            <?php
                                switch ($locale) {
                                    case 'sr': echo 'Podeli'; break;
                                    case 'en': echo 'Share'; break;
                                    default: echo 'Подели'; break;
                                }
                            ?>
                    </button>
                    <button id="printButton"
                        class="flex items-center gap-2 border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                        <i class="fas fa-print h-4 w-4"></i>
                            <?php
                                switch ($locale) {
                                    case 'sr': echo 'Štampaj'; break;
                                    case 'en': echo 'Print'; break;
                                    default: echo 'Штампај'; break;
                                }
                            ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const locale = "<?php echo $locale; ?>";

    // Close Modal
    document.getElementById('closeModal').addEventListener('click', () => {
        document.getElementById('documentModal').classList.add('hidden');
    });



    // Share
    document.getElementById('shareButton').addEventListener('click', async () => {
        const pdfUrl = document.getElementById('fileFrame').src.split('#')[0];
        const title = document.getElementById('modalTitle').textContent.trim();
        if (navigator.share) {
            try {
                await navigator.share({ title, url: pdfUrl });
            } catch (err) {
                console.warn('Share cancelled or failed', err);
            }
        } else {
            // Fallback: copy to clipboard
            try {
                await navigator.clipboard.writeText(pdfUrl);

                let successMessage;
                switch (locale) {
                    case 'sr':
                        successMessage = 'Veza kopirana u clipboard';
                        break;
                    case 'sr-Cyrl':
                        successMessage = 'Веза копирана у clipboard';
                        break;
                    case 'en':
                    default:
                        successMessage = 'Link copied to clipboard';
                        break;
                }

                alert(successMessage);

            } catch {
                let promptMessage;
                switch (locale) {
                    case 'sr':
                        promptMessage = 'Kopiraj link ručno:';
                        break;
                    case 'sr-Cyrl':
                        promptMessage = 'Копирај линк ручно:';
                        break;
                    case 'en':
                    default:
                        promptMessage = 'Copy link manually:';
                        break;
                }

                prompt(promptMessage, pdfUrl);
            }
        }
    });

    // Print
    document.getElementById('printButton').addEventListener('click', () => {
        const iframe = document.getElementById('fileFrame');
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
    });
</script>
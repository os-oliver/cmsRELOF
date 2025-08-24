<!-- Modal: Unos Novog Dokumenta (HTML-only, JS untouched) -->
<div id="newDocument"
    class="invisible z-50 fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm p-4"
    role="dialog" aria-modal="true" aria-labelledby="typeForm">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-auto p-5 sm:p-6 max-h-[90vh] overflow-auto">
        <h2 id="typeForm" class="text-lg sm:text-2xl font-bold text-gray-800 mb-4">
            <?php
                switch ($locale) {
                    case 'sr': echo 'Unos novog dokumenta'; break;
                    case 'en': echo 'Add new document'; break;
                    default: echo 'Унос новог документа'; break;
                }
            ?>
        </h2>

        <form id="documentForm" enctype="multipart/form-data" class="space-y-4">
            <!-- Hidden -->
            <input class="hidden" id="method" value="POST" />
            <input class="hidden" id="endpoint" value="/document" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- File Upload (span 2) -->
                <div id="fUpload" class="md:col-span-2">
                    <label for="documetFile" class="block text-sm font-medium text-gray-700 mb-2">
                        <?php
                            switch ($locale) {
                                case 'sr': echo 'Odaberite fajl'; break;
                                case 'en': echo 'Choose file'; break;
                                default: echo 'Одаберите фајл'; break;
                            }
                        ?>
                        <span class="text-red-500">*</span>
                    </label>

                    <label for="documetFile"
                        class="group flex flex-col items-center justify-center w-full min-h-[110px] px-4 py-4 transition-colors border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 text-center">
                        <i class="fas fa-cloud-upload-alt text-3xl sm:text-4xl text-gray-400 group-hover:text-blue-500 mb-2 transition-colors"
                            aria-hidden="true"></i>
                        <span class="text-gray-600 group-hover:text-blue-600 text-sm">
                            <?php
                                switch ($locale) {
                                    case 'sr': echo 'Kliknite ili prevucite fajl ovde'; break;
                                    case 'en': echo 'Click or drag the file here'; break;
                                    default: echo 'Кликните или превуците фајл овде'; break;
                                }
                            ?>
                        </span>
                        
                        <span class="text-xs text-gray-400 mt-1">
                            <?php
                                switch ($locale) {
                                    case 'sr': echo 'Dozvoljeno: .pdf, .doc, .docx, .xls, .xlsx'; break;
                                    case 'en': echo 'Allowed: .pdf, .doc, .docx, .xls, .xlsx'; break;
                                    default: echo 'Дозвољено: .pdf, .doc, .docx, .xls, .xlsx'; break;
                                }
                            ?>
                        </span>

                        <input type="file" id="documetFile" name="documetFile"
                            accept=".pdf,.doc,.docx,.xls,.xlsx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                            class="hidden" />
                    </label>
                </div>

                <!-- File Name (readonly) -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php
                            switch ($locale) {
                                case 'sr': echo 'Ime fajla'; break;
                                case 'en': echo 'File name'; break;
                                default: echo 'Име фајла'; break;
                            }
                        ?>
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" readonly required
                        class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm"
                        placeholder="<?php
                            switch ($locale) {
                                case 'sr': echo 'Automatski popunjeno'; break;
                                case 'en': echo 'Automatically filled'; break;
                                default: echo 'Аутоматски попуњено'; break;
                            }
                        ?>" />
                </div>

                <!-- File Extension (readonly) -->
                <div>
                    <label for="extension" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php
                            switch ($locale) {
                                case 'sr': echo 'Ekstenzija'; break;
                                case 'en': echo 'Extension'; break;
                                default: echo 'Екстензија'; break;
                            }
                        ?>
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="extension" name="extension" readonly required
                        class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm"
                        placeholder="<?php
                            switch ($locale) {
                                case 'sr': echo 'Automatski popunjeno'; break;
                                case 'en': echo 'Automatically filled'; break;
                                default: echo 'Аутоматски попуњено'; break;
                            }
                        ?>" />
                </div>

                <!-- File Size (readonly) -->
                <div>
                    <label for="fileSize" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php
                            switch ($locale) {
                                case 'sr': echo 'Veličina (MB)'; break;
                                case 'en': echo 'Size (MB)'; break;
                                default: echo 'Величина (MB'; break;
                            }
                        ?>
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="fileSize" name="fileSize" readonly required
                        class="w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-lg text-sm"
                        placeholder="<?php
                            switch ($locale) {
                                case 'sr': echo 'Automatski popunjeno'; break;
                                case 'en': echo 'Automatically filled'; break;
                                default: echo 'Аутоматски попуњено'; break;
                            }
                        ?>" />
                </div>

                <!-- Kategorija -->
                <div>
                    <label for="category" id="categoryForm" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php
                            switch ($locale) {
                                case 'sr': echo 'Kategorija'; break;
                                case 'en': echo 'Category'; break;
                                default: echo 'Категорија'; break;
                            }
                        ?>
                        <span class="text-red-500">*</span>
                    </label>
                    <select id="category" name="category" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">
                            <?php
                            switch ($locale) {
                                case 'sr': echo '-- Odaberite kategoriju --'; break;
                                case 'en': echo '-- Select category --'; break;
                                default: echo '-- Одаберите категорију --'; break;
                            }
                            ?>
                        </option>
                        <?php foreach ($DocumentCategories as $category): ?>
                            <option value="<?= htmlspecialchars($category['id']) ?>">
                                <?= htmlspecialchars($category['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Title (span 2) -->
                <div class="md:col-span-2">
                    <label for="titleForm" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php
                            switch ($locale) {
                                case 'sr': echo 'Naslov dokumenta'; break;
                                case 'en': echo 'Document title'; break;
                                default: echo 'Наслов документа'; break;
                            }
                        ?>
                    </label>
                    <input type="text" id="titleForm" name="title"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="
                        <?php
                            switch ($locale) {
                                case 'sr': echo 'Opcioni naslov'; break;
                                case 'en': echo 'Optional title'; break;
                                default: echo 'Опциони наслов'; break;
                            }
                        ?>" />
                </div>

                <!-- Description (span 2) -->
                <div class="md:col-span-2">
                    <label for="descriptionForm" class="block text-sm font-medium text-gray-700 mb-1">
                        <?php
                        switch ($locale) {
                            case 'sr': echo 'Opis dokumenta'; break;
                            case 'en': echo 'Document description'; break;
                            default: echo 'Опис документа'; break;
                        }
                        ?>
                    </label>
                    <textarea id="descriptionForm" name="description" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="
                        <?php
                            switch ($locale) {
                                case 'sr': echo 'Detaljan opis (opciono)'; break;
                                case 'en': echo 'Detailed description (optional)'; break;
                                default: echo 'Детаљан опис (опционо)'; break;
                            }
                        ?>"></textarea>
                </div>
            </div>
            <!-- Actions -->
            <div class="flex flex-col sm:flex-row sm:justify-end gap-3 mt-4">
                <button id="cancelButton" type="button"
                    class="w-full sm:w-auto px-5 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    <?php
                        switch ($locale) {
                            case 'sr': echo 'Odustani'; break;
                            case 'en': echo 'Cancel'; break;
                            default: echo 'Откажи'; break;
                        }
                    ?>
                </button>
                <button type="submit"
                    class="w-full sm:w-auto px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <?php
                        switch ($locale) {
                            case 'sr': echo 'Sačuvaj dokument'; break;
                            case 'en': echo 'Save document'; break;
                            default: echo 'Сачувај документ'; break;
                        }
                    ?>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- NE DIRAJ ovu liniju (tvoj JS fajl ostaje nepromenjen) -->
<script src="/assets/js/dashboard/fileUploader.js"></script>
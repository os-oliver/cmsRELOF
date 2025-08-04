<div id="newDocument"
    class="invisible z-50 fixed inset-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl p-6">
        <h2 id="typeForm" class="text-2xl font-bold text-gray-800 mb-6">Unos Novog Dokumenta</h2>

        <form id="documentForm" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- File Upload -->
                <input class="hidden" id="method" value="POST" />
                <input class="hidden" id="endpoint" value="/document" />
                <div id="fUpload" class="md:col-span-2">
                    <label for="documetFile" class="block text-sm font-medium text-gray-700 mb-1">
                        Odaberite fajl*
                    </label>

                    <label for="documetFile"
                        class="group flex flex-col items-center justify-center w-full h-40 px-4 transition-colors border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50">
                        <i
                            class="fas fa-cloud-upload-alt text-4xl text-gray-400 group-hover:text-blue-500 mb-3 transition-colors"></i>
                        <span class="text-gray-600 group-hover:text-blue-600">Kliknite ili prevucite fajl ovde</span>
                        <input type="file" id="documetFile" name="documetFile"
                            accept=".pdf, .doc, .docx, .xls, .xlsx, application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                            class="hidden" />
                    </label>
                </div>

                <!-- File Name (readonly) -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Ime fajla*
                    </label>
                    <input type="text" id="name" name="name" readonly required
                        class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg"
                        placeholder="Automatski popunjeno" />
                </div>

                <!-- File Extension (readonly) -->
                <div>
                    <label for="extension" class="block text-sm font-medium text-gray-700 mb-1">
                        Ekstenzija*
                    </label>
                    <input type="text" id="extension" name="extension" readonly required
                        class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg"
                        placeholder="Automatski popunjeno" />
                </div>

                <!-- File Size (readonly) -->
                <div>
                    <label for="fileSize" class="block text-sm font-medium text-gray-700 mb-1">
                        Veličina (MB)*
                    </label>
                    <input type="text" id="fileSize" name="fileSize" readonly required
                        class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg"
                        placeholder="Automatski popunjeno" />
                </div>

                <!-- File Path -->
                <div>
                    <label for="category" id="categoryForm" class="block text-sm font-medium text-gray-700 mb-1">
                        Kategorija*
                    </label>
                    <select id="category" name="category" required class="w-full px-4 py-2 border border-gray-300 rounded-lg
                 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- Odaberite kategoriju --</option>
                        <?php foreach ($DocumentCategories as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>

                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                        Naslov dokumenta
                    </label>
                    <input type="text" id="title" id="titleForm" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg
                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Opcioni naslov" />
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Opis dokumenta
                    </label>
                    <textarea id="description" name="description" id="textForm" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Detaljan opis (opciono)"></textarea>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-4 mt-8">
                <button id="cancelButton" type="button"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Odustani
                </button>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Sačuvaj Dokument
                </button>
            </div>
        </form>
    </div>
</div>

<script src="/assets/js/dashboard/fileUploader.js">

</script>
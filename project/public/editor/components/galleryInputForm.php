<div id="galleryModal"
    class="invisible z-50 fixed inset-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6"><?php switch ($locale) {
            case 'sr': echo 'Dodaj Novu Galeriju'; break;
            case 'en': echo 'Add New Gallery'; break;
            default: echo 'Додај Нову Галерију'; break;
        } ?></h2>

        <form id="galleryForm" class="gallery-form" enctype="multipart/form-data">
            <div class="md:col-span-2" id="galleryUpload">
                <label for="galleryImage" class="block text-sm font-medium text-gray-700 mb-1">
                    <?php switch ($locale) {
                        case 'sr': echo 'Odaberite sliku'; break;
                        case 'en': echo 'Choose image'; break;
                        default: echo 'Одаберите слику'; break;
                    } ?>
                </label>
                <label for="galleryImage" id="imageUploadLabel"
                    class="group flex flex-col items-center justify-center w-full h-40 px-4 transition-colors border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50">
                    <img id="imagePreview" src="#" alt="<?php switch ($locale) {
                        case 'sr': echo 'Pregled slike'; break;
                        case 'en': echo 'Image preview'; break;
                        default: echo 'Преглед слике'; break;
                    } ?>"
                        class="hidden h-full w-full object-contain rounded-lg">
                    <div id="uploadPlaceholder" class="flex flex-col items-center justify-center">
                        <i
                            class="fas fa-image text-4xl text-gray-400 group-hover:text-blue-500 mb-3 transition-colors"></i>
                        <span class="text-gray-600 group-hover:text-blue-600"><?php switch ($locale) {
                            case 'sr': echo 'Kliknite ili prevucite sliku ovde'; break;
                            case 'en': echo 'Click or drag image here'; break;
                            default: echo 'Кликните или превуците слику овде'; break;
                        } ?></span>
                    </div>
                    <input type="file" id="galleryImage" name="galleryImage" accept=".jpg,.jpeg,.png" class="hidden" />
                </label>
            </div>

            <div class="md:col-span-2 mt-6">
                <label for="galleryTitle" class="block text-sm font-medium text-gray-700 mb-1"><?php switch ($locale) {
                    case 'sr': echo 'Naziv galerije*'; break;
                    case 'en': echo 'Gallery title*'; break;
                    default: echo 'Назив галерије*'; break;
                } ?></label>
                <input type="text" id="galleryTitle" name="galleryTitle" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="<?php switch ($locale) {
                        case 'sr': echo 'Unesite naziv galerije'; break;
                        case 'en': echo 'Enter gallery title'; break;
                        default: echo 'Унесите назив галерије'; break;
                    } ?>" />
            </div>

            <div class="md:col-span-2">
                <label for="galleryDescription" class="block text-sm font-medium text-gray-700 mb-1"><?php switch ($locale) {
                    case 'sr': echo 'Opis galerije'; break;
                    case 'en': echo 'Gallery description'; break;
                    default: echo 'Опис галерије'; break;
                } ?></label>
                <textarea id="galleryDescription" name="galleryDescription" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="<?php switch ($locale) {
                        case 'sr': echo 'Detaljan opis galerije'; break;
                        case 'en': echo 'Detailed gallery description'; break;
                        default: echo 'Детаљан опис галерије'; break;
                    } ?>"></textarea>
            </div>

            <input type="hidden" id="galleryMethod" value="POST" />
            <input type="hidden" id="galleryEndpoint" value="/gallery" />

            <div class="flex justify-end space-x-4 mt-8">
                <button id="galleryCancelButton" type="button"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    <?php switch ($locale) {
                        case 'sr': echo 'Odustani'; break;
                        case 'en': echo 'Cancel'; break;
                        default: echo 'Одустани'; break;
                    } ?>
                </button>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <?php switch ($locale) {
                        case 'sr': echo 'Sačuvaj Galeriju'; break;
                        case 'en': echo 'Save Gallery'; break;
                        default: echo 'Сачувај Галерију'; break;
                    } ?>
                </button>
            </div>
        </form>
    </div>
</div>
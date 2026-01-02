<div id="galleryModal"
    class="invisible z-50 fixed inset-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            <?= __("gallery.modal_title") ?>
        </h2>

        <form id="galleryForm" class="gallery-form" enctype="multipart/form-data">
            <div class="md:col-span-2" id="galleryUpload">
                <label for="galleryImage" class="block text-sm font-medium text-gray-700 mb-1">
                    <?= __("gallery.choose_image") ?>
                </label>
                <label for="galleryImage" id="imageUploadLabel"
                    class="group flex flex-col items-center justify-center w-full h-40 px-4 transition-colors border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50">
                    <img id="imagePreview" src="#" alt="<?= __("gallery.image_preview") ?>"
                        class="hidden h-full w-full object-contain rounded-lg">
                    <div id="uploadPlaceholder" class="flex flex-col items-center justify-center">
                        <i
                            class="fas fa-image text-4xl text-gray-400 group-hover:text-blue-500 mb-3 transition-colors"></i>
                        <span class="text-gray-600 group-hover:text-blue-600">
                            <?= __("gallery.drag_image_here") ?>
                        </span>
                    </div>
                    <input type="file" id="galleryImage" name="galleryImage" accept=".jpg,.jpeg,.png,.webp" class="hidden" />
                </label>
            </div>

            <div class="md:col-span-2 mt-6">
                <label for="galleryTitle" class="block text-sm font-medium text-gray-700 mb-1">
                    <?= __("gallery.title_label") ?>
                </label>
                <input type="text" id="galleryTitle" name="galleryTitle" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="<?= __("gallery.title_placeholder") ?>" />
            </div>

            <div class="md:col-span-2">
                <label for="galleryDescription" class="block text-sm font-medium text-gray-700 mb-1">
                    <?= __("gallery.description_label") ?>
                </label>
                <textarea id="galleryDescription" name="galleryDescription" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="<?= __("gallery.description_placeholder") ?>"></textarea>
            </div>

            <input type="hidden" id="galleryMethod" value="POST" />
            <input type="hidden" id="galleryEndpoint" value="/gallery" />

            <div class="flex justify-end space-x-4 mt-8">
                <button id="galleryCancelButton" type="button"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    <?= __("gallery.cancel") ?>
                </button>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <?= __("gallery.save_gallery") ?>
                </button>
            </div>
        </form>
    </div>
</div>
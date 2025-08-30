<!-- Modal: Unos Novog Događaja (HTML + JS) -->
<div id="newEvent"
    class="invisible z-50 fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm p-4"
    role="dialog" aria-modal="true" aria-labelledby="newEventTitle">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-auto p-5 sm:p-6 max-h-[90vh] overflow-auto">
        <h2 id="newEventTitle" class="text-lg sm:text-2xl font-bold text-gray-800 mb-4">
            <?= __("events.modal_title") ?>
        </h2>

        <form id="formEvent" class="event-form" enctype="multipart/form-data" novalidate>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Image Upload (full width) -->
                <div class="md:col-span-2" id="fUpload">
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                        <?= __("events.choose_image") ?>
                    </label>

                    <!-- Drag area -->
                    <label id="dropZone" for="file"
                        class="group relative flex flex-col items-center justify-center w-full min-h-[110px] px-4 py-4 transition-colors border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 hover:bg-blue-50 text-center overflow-hidden">
                        <!-- upload content (icon + text) -->
                        <div id="uploadContent" class="flex flex-col items-center justify-center">
                            <i class="fas fa-image text-3xl sm:text-4xl text-gray-400 group-hover:text-blue-500 mb-2 transition-colors"
                                aria-hidden="true"></i>
                            <span class="text-gray-600 group-hover:text-blue-600 text-sm">
                                <?= __("events.drag_image_here") ?>
                            </span>
                            <span class="text-xs text-gray-400 mt-1">
                                <?= __("events.allowed_formats") ?>
                            </span>
                        </div>

                        <!-- image preview (hidden until file selected) -->
                        <div id="previewWrapper"
                            class="hidden w-full h-full absolute inset-0 flex items-center justify-center p-2">
                            <img id="imagePreview" src="#" alt="<?= __("events.image_preview") ?>"
                                class="max-h-44 sm:max-h-60 w-full object-contain rounded-md shadow-sm" />
                            <!-- clear button -->
                            <button type="button" id="clearPreviewBtn"
                                class="absolute top-2 right-2 bg-white/80 hover:bg-white text-gray-700 rounded-full p-1 shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 8.586L4.707 3.293 3.293 4.707 8.586 10l-5.293 5.293 1.414 1.414L10 11.414l5.293 5.293 1.414-1.414L11.414 10l5.293-5.293-1.414-1.414L10 8.586z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>

                        <input type="file" id="file" name="file" accept=".jpg,.jpeg,.png" class="hidden" />
                    </label>
                </div>

                <!-- Naziv događaja -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                        <?= __("events.event_title_label") ?>
                    </label>
                    <input type="text" id="title" name="title" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="<?= __("events.event_title_placeholder") ?>" />
                </div>

                <!-- Kategorija -->
                <div>
                    <label for="category" id="categoryForm"
                        class="block text-sm font-medium text-gray-700 mb-1">
                        <?= __("events.category_label") ?>
                    </label>
                    <select id="category" name="category" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">
                            <?= __("events.category_placeholder") ?>
                        </option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category['id']) ?>">
                                <?= htmlspecialchars($category['naziv']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Datum -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">
                        <?= __("events.date_label") ?>
                    </label>
                    <input type="date" id="date" name="date" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Vreme -->
                <div>
                    <label for="time" class="block text-sm font-medium text-gray-700 mb-1">
                        <?= __("events.time_label") ?>
                    </label>
                    <input type="time" id="time" name="time" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Lokacija (span 2) -->
                <div class="md:col-span-2 relative">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
                        <?= __("events.location_label") ?>
                    </label>
                    <div class="relative">
                        <input type="text" id="location" name="location" required
                            class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="<?= __("events.location_placeholder") ?>" />
                        <i class="fas fa-map-marker-alt absolute left-3 top-3 text-gray-400" aria-hidden="true"></i>
                    </div>
                </div>

                <!-- Opis (span 2) -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        <?= __("events.description_label") ?>
                    </label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="<?= __("events.description_placeholder") ?>"></textarea>
                </div>
            </div>

            <!-- Hidden inputs (kept as-is) -->
            <input type="hidden" id="method" value="POST" />
            <input type="hidden" id="endpoint" value="/events" />

            <!-- Actions: responsive (stack on mobile) -->
            <div class="flex flex-col sm:flex-row sm:justify-end gap-3 mt-4">
                <button id="eventCancelButton" type="button"
                    class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    <?= __("events.cancel") ?>
                </button>
                <button type="submit"
                    class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <?= __("events.save_event") ?>
                </button>
            </div>
        </form>
    </div>
</div>
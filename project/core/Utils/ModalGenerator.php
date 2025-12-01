<?php
namespace App\Utils;

use App\Controllers\AuthController;
use App\Controllers\LanguageMapperController;
use App\Models\GenericCategory;

class ModalGenerator
{
    private $config;
    private $modalId;
    private $translations;
    private $lang;

    public function __construct($config, $modalId, $lang)
    {
        $this->config = $config;
        $this->modalId = $modalId ?? 'dynamicModal';
        $this->lang = $lang;
        // If the project translation helper __() exists, prefer it. Otherwise
        // fall back to reading the lang JSON file directly.
        $translations = [];
        if (function_exists('__')) {
            // Temporarily set session locale if possible
            if (session_status() === PHP_SESSION_NONE) {
                @session_start();
            }
            $prevLocale = $_SESSION['locale'] ?? null;
            $_SESSION['locale'] = $this->lang ?: ($_SESSION['locale'] ?? 'en');

            $this->translations = [
                'cancel' => __('documentInputForm.cancel') ?: __('style.cancel') ?: 'Cancel',
                'save' => __('style.save') ?: 'Save',
                'required' => '*',
                'choose_file' => __('documentInputForm.choose_file') ?: 'Choose File',
                'click_or_drag' => __('documentInputForm.click_or_drag') ?: 'Click to upload or drag and drop',
                'select_option' => __('documentInputForm.select_option') ?: 'Select an option',
                'remove' => __('documentInputForm.remove') ?: 'remove',
            ];

            // restore previous locale
            if ($prevLocale !== null) {
                $_SESSION['locale'] = $prevLocale;
            }
        } else {
            $langFile = __DIR__ . '/../../lang/' . ($this->lang ?: 'en') . '.json';
            if (is_readable($langFile)) {
                $json = file_get_contents($langFile);
                $decoded = json_decode($json, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $translations = $decoded;
                }
            }

            // Provide defaults for modal-specific keys, using loaded translations where possible
            $this->translations = array_merge([
                'cancel' => $translations['documentInputForm.cancel'] ?? ($translations['style.cancel'] ?? 'Cancel'),
                'save' => $translations['style.save'] ?? 'Save',
                'required' => '*',
                'choose_file' => $translations['documentInputForm.choose_file'] ?? 'Choose File',
                'click_or_drag' => $translations['documentInputForm.click_or_drag'] ?? 'Click to upload or drag and drop',
                'select_option' => $translations['documentInputForm.select_option'] ?? 'Select an option'
            ], $translations);
        }
    }

    public function render()
    {
        $type = $this->lang;
        $title = $this->config[$type] ?? 'Form';
        $fields = $this->config['fields'] ?? [];
        $method = $this->config['method'] ?? 'POST';
        $endpoint = $this->config['endpoint'] ?? '';
        $enctype = $this->hasFileField($fields) ? 'enctype="multipart/form-data"' : '';

        ob_start();
        ?>
        <div id="<?= $this->modalId ?>"
            class="z-50 fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm p-4"
            role="dialog" aria-modal="true" aria-labelledby="modalTitle_<?= $this->modalId ?>">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl mx-auto max-h-[95vh] overflow-hidden flex flex-col">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-5 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-file-alt text-white text-lg"></i>
                        </div>
                        <h2 id="modalTitle_<?= $this->modalId ?>" class="text-xl sm:text-2xl font-bold text-white">
                            <?= htmlspecialchars($title) ?>
                        </h2>
                    </div>
                    <button type="button"
                        class="cancel-modal text-white hover:bg-white hover:bg-opacity-20 rounded-lg p-2 transition-all duration-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Form Content -->
                <div class="p-6 overflow-y-auto flex-1">
                    <form id="<?= $this->modalId ?>Form" <?= $enctype ?> class="space-y-5">
                        <!-- Hidden Fields -->
                        <input type="hidden" name="method" value="<?= htmlspecialchars($method) ?>" />
                        <input type="hidden" name="endpoint" value="<?= htmlspecialchars($endpoint) ?>" />
                        <?php if (!empty($this->config['item_id'])): ?>
                            <input type="hidden" name="id" value="<?= (int) $this->config['item_id'] ?>" />
                        <?php endif; ?>

                        <?= $this->renderFieldsWithSmartLayout($fields) ?>
                    </form>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row sm:justify-end gap-3 border-t border-gray-200">
                    <button type="button"
                        class="cancel-modal w-full sm:w-auto px-6 py-2.5 border-2 border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-100 hover:border-gray-400 transition-all duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-times"></i>
                        <span><?= htmlspecialchars($this->translations['cancel']) ?></span>
                    </button>
                    <button type="submit" form="<?= $this->modalId ?>Form"
                        class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i>
                        <span><?= htmlspecialchars($this->translations['save']) ?></span>
                    </button>
                </div>
            </div>
        </div>

        <script>
            (function () {
                const modalId = <?= json_encode($this->modalId) ?>;
                const modal = document.getElementById(modalId);
                if (!modal) return;

                function humanFileSize(size) {
                    if (size === 0) return '0 B';
                    const i = Math.floor(Math.log(size) / Math.log(1024));
                    const sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
                    return (size / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
                }

                function renderFilesForInput(input) {
                    const containerId = modalId + '_preview_' + input.name.replace('[]', '');
                    let container = document.getElementById(containerId);

                    if (!container) {
                        console.warn('Preview container not found:', containerId);
                        return;
                    }

                    // Clear current previews
                    container.innerHTML = '';

                    const files = Array.from(input.files || []);

                    if (files.length === 0) {
                        container.innerHTML = '';
                        return;
                    }

                    files.forEach((file, idx) => {
                        const isImage = /\.(jpe?g|png|gif|webp|bmp|svg)$/i.test(file.name);
                        const wrapper = document.createElement('div');
                        wrapper.className = 'relative group rounded-lg overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition';

                        if (isImage) {
                            const img = document.createElement('img');
                            img.className = 'w-full h-32 object-cover';
                            wrapper.appendChild(img);

                            const reader = new FileReader();
                            reader.onload = function (e) {
                                img.src = e.target.result;
                            };
                            reader.readAsDataURL(file);
                        } else {
                            const nonImg = document.createElement('div');
                            nonImg.className = 'w-full h-32 p-3 bg-gray-50 flex flex-col items-center justify-center gap-2';
                            nonImg.innerHTML = `
                                <i class="fas fa-file text-blue-600 text-3xl"></i>
                                <div class="text-sm font-medium text-gray-700 truncate w-full text-center px-2">${file.name}</div>
                                <div class="text-xs text-gray-500">${humanFileSize(file.size)}</div>
                            `;
                            wrapper.appendChild(nonImg);
                        }

                        // overlay with remove button
                        const overlay = document.createElement('div');
                        overlay.className = 'absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex flex-col justify-end p-2';
                        const removeBtn = document.createElement('button');
                        removeBtn.type = 'button';
                        removeBtn.className = 'inline-flex items-center justify-center gap-2 text-white text-xs bg-red-600 px-3 py-1.5 rounded hover:bg-red-700 transition';
                        removeBtn.innerHTML = '<i class="fas fa-trash"></i> Remove';
                        removeBtn.addEventListener('click', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            removeFileFromInput(input, idx);
                        });

                        overlay.appendChild(removeBtn);
                        wrapper.appendChild(overlay);

                        container.appendChild(wrapper);
                    });
                }

                function removeFileFromInput(input, removeIndex) {
                    const dt = new DataTransfer();
                    const files = Array.from(input.files || []);
                    files.forEach((f, i) => {
                        if (i !== removeIndex) dt.items.add(f);
                    });
                    input.files = dt.files;
                    renderFilesForInput(input);
                }

                function attachToFileInputs() {
                    const fileInputs = modal.querySelectorAll('input[type="file"]');
                    fileInputs.forEach(input => {
                        // Remove existing event listeners by cloning
                        const newInput = input.cloneNode(true);
                        input.parentNode.replaceChild(newInput, input);

                        // Add change event listener
                        newInput.addEventListener('change', function () {
                            renderFilesForInput(newInput);
                        });

                        // Initial render if files already present
                        if (newInput.files && newInput.files.length > 0) {
                            renderFilesForInput(newInput);
                        }
                    });
                }

                function attachRemoveForExisting() {
                    modal.querySelectorAll('.existing-remove-btn').forEach(btn => {
                        // Remove old listeners by cloning
                        const newBtn = btn.cloneNode(true);
                        btn.parentNode.replaceChild(newBtn, btn);

                        newBtn.addEventListener('click', function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            const filePath = newBtn.dataset.value;
                            const fieldName = newBtn.dataset.field;
                            const checkbox = modal.querySelector(`input[type="checkbox"][name="remove_${fieldName}[]"][value="${CSS.escape(filePath)}"]`);
                            if (checkbox) {
                                checkbox.checked = true;
                            }
                            // visually mark as removed
                            const wrapper = newBtn.closest('.existing-file-wrapper');
                            if (wrapper) {
                                wrapper.style.opacity = '0.4';
                                wrapper.style.filter = 'grayscale(100%)';
                                const badge = document.createElement('div');
                                badge.className = 'absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 rounded';
                                badge.textContent = 'Marked for removal';
                                wrapper.style.position = 'relative';
                                wrapper.appendChild(badge);
                                newBtn.disabled = true;
                            }
                        });
                    });
                }

                // Initialize on load
                attachToFileInputs();
                attachRemoveForExisting();

                // Re-attach on DOM changes
                const observer = new MutationObserver(() => {
                    attachToFileInputs();
                    attachRemoveForExisting();
                });
                observer.observe(modal, { childList: true, subtree: true });

            })();
        </script>
        <?php
        return ob_get_clean();
    }

    private function hasFileField($fields)
    {
        foreach ($fields as $field) {
            $type = $field['type'] ?? '';
            if ($type === 'file' || $type === 'multifile') {
                return true;
            }
        }
        return false;
    }

    private function renderFieldsWithSmartLayout($fields)
    {
        $output = '';
        $i = 0;
        $totalFields = count($fields);

        while ($i < $totalFields) {
            $field = $fields[$i];
            $type = $field['type'] ?? 'text';
            $colspan = $this->calculateColspan($field);

            if ($colspan === 'full') {
                $output .= '<div class="w-full">' . $this->renderField($field) . '</div>';
                $i++;
            } else {
                $nextField = $fields[$i + 1] ?? null;
                $nextColspan = $nextField ? $this->calculateColspan($nextField) : null;

                if ($nextField && $nextColspan === 'half') {
                    $output .= '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">';
                    $output .= $this->renderField($field);
                    $output .= $this->renderField($nextField);
                    $output .= '</div>';
                    $i += 2;
                } else {
                    $output .= '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">';
                    $output .= $this->renderField($field);
                    $output .= '</div>';
                    $i++;
                }
            }
        }

        return $output;
    }

    private function calculateColspan($field)
    {
        $type = $field['type'] ?? 'text';
        $name = $field['name'] ?? '';

        $fullWidthTypes = ['textarea', 'file', 'multifile'];
        if (in_array($type, $fullWidthTypes)) {
            return 'full';
        }

        $fullWidthNames = ['description', 'content', 'body', 'message', 'address', 'notes'];
        foreach ($fullWidthNames as $pattern) {
            if (stripos($name, $pattern) !== false) {
                return 'full';
            }
        }

        return 'half';
    }

    private function getRows($name)
    {
        $largeFields = ['body', 'content', 'message'];
        $mediumFields = ['description', 'notes', 'address'];
        $lowerName = strtolower($name);

        foreach ($largeFields as $field) {
            if (strpos($lowerName, $field) !== false)
                return 6;
        }

        foreach ($mediumFields as $field) {
            if (strpos($lowerName, $field) !== false)
                return 4;
        }

        return 3;
    }

    private function getPlaceholder($label, $name, $type)
    {
        if ($type === 'email')
            return 'example@email.com';
        if ($type === 'number')
            return '0';
        if ($type === 'date')
            return 'YYYY-MM-DD';
        if ($type === 'tel')
            return '+1 (555) 000-0000';
        // Use project translation helper if available for the word 'Enter'
        $enter = 'Enter';
        if (function_exists('__')) {
            $enter = __("placeholder.enter") ?: $enter;
        }
        return $enter . ' ' . strtolower($label);
    }

    private function getAccept($name)
    {
        $imageFields = ['image', 'photo', 'picture', 'avatar', 'logo', 'thumbnail'];
        $documentFields = ['document', 'doc', 'file', 'attachment', 'pdf'];
        $lowerName = strtolower($name);

        foreach ($imageFields as $imgField) {
            if (strpos($lowerName, $imgField) !== false) {
                return 'image/*';
            }
        }

        foreach ($documentFields as $docField) {
            if (strpos($lowerName, $docField) !== false) {
                return '.pdf,.doc,.docx,.xls,.xlsx';
            }
        }

        return '*/*';
    }

    private function getFieldIcon($field)
    {
        $type = $field['type'] ?? 'text';
        $name = strtolower($field['name'] ?? '');

        $iconMap = [
            'email' => 'fa-envelope',
            'password' => 'fa-lock',
            'tel' => 'fa-phone',
            'url' => 'fa-link',
            'date' => 'fa-calendar',
            'time' => 'fa-clock',
            'number' => 'fa-hashtag',
            'file' => 'fa-cloud-upload-alt',
            'multifile' => 'fa-images',
            'select' => 'fa-list',
            'textarea' => 'fa-align-left'
        ];

        if (isset($iconMap[$type])) {
            return $iconMap[$type];
        }

        $namePatterns = [
            'name' => 'fa-user',
            'user' => 'fa-user',
            'title' => 'fa-heading',
            'description' => 'fa-align-left',
            'category' => 'fa-tag',
            'size' => 'fa-ruler',
            'extension' => 'fa-file-code',
            'price' => 'fa-dollar-sign',
            'amount' => 'fa-dollar-sign',
            'address' => 'fa-map-marker-alt',
            'city' => 'fa-city',
            'country' => 'fa-globe',
            'phone' => 'fa-phone',
            'company' => 'fa-building'
        ];

        foreach ($namePatterns as $pattern => $icon) {
            if (strpos($name, $pattern) !== false) {
                return $icon;
            }
        }

        return 'fa-edit';
    }

    private function renderField($field)
    {
        $name = $field['name'] ?? '';
        $type = $field['type'] ?? 'text';
        $isMultiple = ($type === 'multifile') || ($type === 'file');
        $label = $field['label'][$this->lang] ?? ucfirst(str_replace('_', ' ', $name));
        $required = $field['required'] ?? false;
        $options = $field['options'] ?? [];
        error_log("gde siii");
        $value = $field['value'] ?? '';

        if (($field['property'] ?? '') === 'auto') {
            error_log("auto popunjavanje za polje: $name");
            if ($type === 'date' && empty($value)) {
                $value = date('Y-m-d'); // danasnji datum
            }
            if($name === 'autor' && empty($value)) {

                [$name, $surname, $role] = AuthController::getUserInfo();

                $value = $name . ' ' . $surname;
                if ($this->lang == 'sr-Cyrl') {
                    $value = (new LanguageMapperController())->latin_to_cyrillic($value);
                }
            }
        }

        $rows = $this->getRows($name);
        $placeholder = $this->getPlaceholder($label, $name, $type);
        $accept = $this->getAccept($name);
        $icon = $this->getFieldIcon($field);

        $requiredAttr = $required ? 'required' : '';
        $requiredMark = $required ? '<span class="text-red-500 ml-1">*</span>' : '';

        ob_start();

        switch ($type) {
            case 'multifile':
            case 'file':
                $inputName = $isMultiple ? $name . '[]' : $name;
                $previewId = $this->modalId . '_preview_' . $name;
                ?>
                <div class="w-full">
                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <i class="fas <?= $icon ?> text-blue-600"></i>
                        <?= htmlspecialchars($label) ?>                 <?= $requiredMark ?>
                    </label>

                    <label for="<?= htmlspecialchars($name) ?>"
                        class="group flex flex-col items-center justify-center w-full min-h-[140px] px-6 py-6 transition-all duration-200 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-blue-500 hover:bg-blue-50 text-center">
                        <div
                            class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-3 group-hover:bg-blue-200 transition-colors">
                            <i
                                class="fas <?= $isMultiple ? 'fa-images' : 'fa-cloud-upload-alt' ?> text-3xl text-blue-600 group-hover:text-blue-700 transition-colors"></i>
                        </div>
                        <span class="text-gray-700 font-medium group-hover:text-blue-700 text-sm mb-1">
                            <?= htmlspecialchars($this->translations['click_or_drag']) ?>
                        </span>
                        <span class="text-xs text-gray-500 mb-1">
                            <?= $isMultiple ? 'Multiple files allowed' : 'Single file' ?> • Maximum: 10MB per file
                        </span>
                        <?php $fileDataReq = ($required && empty($value)) ? 'data-required="1"' : ''; ?>
                        <input type="file" id="<?= htmlspecialchars($name) ?>" name="<?= htmlspecialchars($inputName) ?>"
                            accept="<?= htmlspecialchars($accept) ?>" class="hidden file-input" <?= $fileDataReq ?>                 <?= $isMultiple ? 'multiple' : '' ?> />
                    </label>

                    <!-- PREVIEW CONTAINER FOR NEWLY SELECTED FILES -->
                    <div id="<?= htmlspecialchars($previewId) ?>" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    </div>

                    <?php if (!empty($value)): ?>
                        <?php
                        // Normalize $value into an array of file paths
                        $files = [];
                        if ($isMultiple) {
                            if (is_string($value)) {
                                $decoded = json_decode($value, true);
                                if (is_array($decoded)) {
                                    foreach ($decoded as $it) {
                                        if (is_array($it) && isset($it['file_path']))
                                            $files[] = $it['file_path'];
                                        elseif (is_string($it))
                                            $files[] = $it;
                                    }
                                } else {
                                    $files[] = $value;
                                }
                            } elseif (is_array($value)) {
                                foreach ($value as $it) {
                                    if (is_array($it) && isset($it['file_path']))
                                        $files[] = $it['file_path'];
                                    elseif (is_string($it))
                                        $files[] = $it;
                                }
                            }
                        } else {
                            // For single-file config fields, support the controller supplying
                            // either a single string, an associative array with ['file_path'=>..],
                            // OR a JSON/array of paths (because DB may store multiple images for the element).
                            if (is_string($value)) {
                                $decoded = json_decode($value, true);
                                if (is_array($decoded)) {
                                    foreach ($decoded as $it) {
                                        if (is_array($it) && isset($it['file_path']))
                                            $files[] = $it['file_path'];
                                        elseif (is_string($it))
                                            $files[] = $it;
                                    }
                                } else {
                                    $files[] = $value;
                                }
                            } elseif (is_array($value)) {
                                // associative with file_path
                                if (isset($value['file_path'])) {
                                    $files[] = $value['file_path'];
                                } else {
                                    foreach ($value as $it) {
                                        if (is_array($it) && isset($it['file_path']))
                                            $files[] = $it['file_path'];
                                        elseif (is_string($it))
                                            $files[] = $it;
                                    }
                                }
                            } else {
                                $files[] = (string) $value;
                            }
                        }
                        ?>

                        <!-- EXISTING FILES -->
                        <?php if (!empty($files)): ?>
                            <div class="existing-files mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                <?php foreach ($files as $filePath):
                                    $filePath = trim((string) $filePath);
                                    if ($filePath === '')
                                        continue;
                                    $isImage = preg_match('#\.(jpe?g|png|gif|webp|bmp|svg)$#i', $filePath);
                                    ?>
                                    <div
                                        class="relative group existing-file-wrapper rounded-lg overflow-hidden border border-gray-200 shadow-sm hover:shadow-md transition">
                                        <?php if ($isImage): ?>
                                            <img src="<?= htmlspecialchars($filePath) ?>" alt="Existing file" class="w-full h-32 object-cover" />
                                        <?php else: ?>
                                            <div class="w-full h-32 p-3 bg-gray-50 flex flex-col items-center justify-center gap-2">
                                                <i class="fas fa-file text-blue-600 text-3xl"></i>
                                                <a href="<?= htmlspecialchars($filePath) ?>" target="_blank"
                                                    class="text-sm font-medium text-blue-600 hover:underline truncate max-w-full px-2">
                                                    <?= htmlspecialchars(basename($filePath)) ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <div
                                            class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex flex-col justify-end p-2">
                                            <button type="button" data-value="<?= htmlspecialchars($filePath) ?>"
                                                data-field="<?= htmlspecialchars($name) ?>"
                                                class="existing-remove-btn inline-flex items-center justify-center gap-2 text-white text-xs bg-red-600 px-3 py-1.5 rounded hover:bg-red-700 transition">
                                                <i class="fas fa-trash"></i> <?= htmlspecialchars($this->translations['remove']) ?>
                                            </button>
                                            <input type="checkbox" name="remove_<?= htmlspecialchars($name) ?>[]"
                                                value="<?= htmlspecialchars($filePath) ?>" class="hidden" />
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <?php
                break;

            case 'textarea':
                ?>
                <div class="w-full">
                    <label for="<?= htmlspecialchars($name) ?>"
                        class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <i class="fas <?= $icon ?> text-blue-600"></i>
                        <?= htmlspecialchars($label) ?>                 <?= $requiredMark ?>
                    </label>
                    <div class="relative">
                        <textarea id="<?= htmlspecialchars($name) ?>" name="<?= htmlspecialchars($name) ?>" rows="<?= $rows ?>"
                            <?= $requiredAttr ?>
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="<?= htmlspecialchars($placeholder) ?>"><?= htmlspecialchars($value) ?></textarea>
                    </div>
                </div>
                <?php
                break;

            case 'categories':
                // Fetch all categories for this modal
                $categories = GenericCategory::fetchAll($this->modalId, $this->lang);

                ?>
                <div class="w-full">
                    <label for="<?= htmlspecialchars($name) ?>"
                        class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <i class="fas <?= htmlspecialchars($icon) ?> text-blue-600"></i>
                        <?= htmlspecialchars($label) ?>                 <?= $requiredMark ?>
                    </label>
                    <div class="relative">
                        <select id="<?= htmlspecialchars($name) ?>" name="<?= htmlspecialchars($name) ?>" <?= $requiredAttr ?>
                            class="w-full px-4 py-3 pr-10 border-2 border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none bg-white cursor-pointer">
                            <option value=""><?= htmlspecialchars($this->translations['select_option']) ?></option>
                            <?php foreach ($categories as $option):
                                // Use 'id' for value and 'name' for label
                                $optionValue = $option['id'] ?? '';
                                $optionLabel = $option['name'][$this->lang] ?? $option['name'] ?? '';
                                ?>
                                <option value="<?= htmlspecialchars($optionValue) ?>" <?= ($value == $optionValue) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($optionLabel) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
                <?php
                break;


            default:
                ?>
                <div class="w-full">
                    <label for="<?= htmlspecialchars($name) ?>"
                        class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <i class="fas <?= $icon ?> text-blue-600"></i>
                        <?= htmlspecialchars($label) ?>                 <?= $requiredMark ?>
                    </label>
                    <div class="relative">
                        <input type="<?= htmlspecialchars($type) ?>" id="<?= htmlspecialchars($name) ?>"
                            name="<?= htmlspecialchars($name) ?>" value="<?= htmlspecialchars($value) ?>" <?= $requiredAttr ?>
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="<?= htmlspecialchars($placeholder) ?>" />
                    </div>
                </div>
                <?php
                break;
        }

        return ob_get_clean();
    }
}
?>
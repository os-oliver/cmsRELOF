<?php
namespace App\Utils;

class ModalGenerator
{
    private $config;
    private $modalId;
    private $translations;

    public function __construct($config, $modalId = 'dynamicModal', $translations = [])
    {
        $this->config = $config;
        $this->modalId = $modalId;
        $this->translations = array_merge([
            'cancel' => 'Cancel',
            'save' => 'Save',
            'required' => '*',
            'choose_file' => 'Choose File',
            'click_or_drag' => 'Click to upload or drag and drop',
            'select_option' => 'Select an option'
        ], $translations);
    }

    public function render()
    {
        $title = $this->config['title'] ?? 'Form';
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
        <?php
        return ob_get_clean();
    }

    private function hasFileField($fields)
    {
        foreach ($fields as $field) {
            if (($field['type'] ?? '') === 'file') {
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
                // Full width field
                $output .= '<div class="w-full">' . $this->renderField($field) . '</div>';
                $i++;
            } else {
                // Check if we can group with next field
                $nextField = $fields[$i + 1] ?? null;
                $nextColspan = $nextField ? $this->calculateColspan($nextField) : null;

                if ($nextField && $nextColspan === 'half') {
                    // Two half-width fields side by side
                    $output .= '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">';
                    $output .= $this->renderField($field);
                    $output .= $this->renderField($nextField);
                    $output .= '</div>';
                    $i += 2;
                } else {
                    // Single half-width field (will be full on mobile)
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

        // Full width types
        $fullWidthTypes = ['textarea', 'file'];
        if (in_array($type, $fullWidthTypes)) {
            return 'full';
        }

        // Full width based on name patterns
        $fullWidthNames = ['description', 'content', 'body', 'message', 'address', 'notes'];
        foreach ($fullWidthNames as $pattern) {
            if (stripos($name, $pattern) !== false) {
                return 'full';
            }
        }

        // Half width for everything else
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
        return 'Enter ' . strtolower($label);
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

        // Type-based icons
        $iconMap = [
            'email' => 'fa-envelope',
            'password' => 'fa-lock',
            'tel' => 'fa-phone',
            'url' => 'fa-link',
            'date' => 'fa-calendar',
            'time' => 'fa-clock',
            'number' => 'fa-hashtag',
            'file' => 'fa-cloud-upload-alt',
            'select' => 'fa-list',
            'textarea' => 'fa-align-left'
        ];

        if (isset($iconMap[$type])) {
            return $iconMap[$type];
        }

        // Name-based icons
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
        $label = $field['label'] ?? ucfirst(str_replace('_', ' ', $name));
        $required = $field['required'] ?? false;
        $options = $field['options'] ?? [];
        $value = $field['value'] ?? '';

        $rows = $this->getRows($name);
        $placeholder = $this->getPlaceholder($label, $name, $type);
        $accept = $this->getAccept($name);
        $icon = $this->getFieldIcon($field);

        $requiredAttr = $required ? 'required' : '';
        $requiredMark = $required ? '<span class="text-red-500 ml-1">*</span>' : '';


        ob_start();

        switch ($type) {
            case 'file':
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
                            <i class="fas fa-cloud-upload-alt text-3xl text-blue-600 group-hover:text-blue-700 transition-colors"></i>
                        </div>
                        <span class="text-gray-700 font-medium group-hover:text-blue-700 text-sm mb-1">
                            <?= htmlspecialchars($this->translations['click_or_drag']) ?>
                        </span>
                        <span class="text-xs text-gray-500">Maximum file size: 10MB</span>
                        <?php $fileDataReq = ($required && empty($value)) ? 'data-required="1"' : ''; ?>
                        <input type="file" id="<?= htmlspecialchars($name) ?>" name="<?= htmlspecialchars($name) ?>"
                            accept="<?= htmlspecialchars($accept) ?>" class="hidden" <?= $fileDataReq ?> />
                        <?php if (!empty($value) && is_string($value)): ?>
                            <div class="mt-3 flex items-center gap-4">
                                <?php if (preg_match('#^/uploads/.+\.(png|jpe?g|gif|webp)$#i', $value)): ?>
                                    <img src="<?= htmlspecialchars($value) ?>" alt=""
                                        style="max-width:120px;max-height:80px;border-radius:6px;" />
                                <?php else: ?>
                                    <a href="<?= htmlspecialchars($value) ?>" target="_blank" class="text-blue-600 hover:underline">Existing
                                        file</a>
                                <?php endif; ?>
                                <label class="text-sm text-gray-600"><input type="checkbox" name="remove_<?= htmlspecialchars($name) ?>"
                                        value="1" /> Remove</label>
                            </div>
                        <?php endif; ?>
                    </label>
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
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 "
                            placeholder="<?= htmlspecialchars($placeholder) ?>"><?= htmlspecialchars($value) ?></textarea>
                    </div>
                </div>
                <?php
                break;

            case 'select':
                ?>
                <div class="w-full">
                    <label for="<?= htmlspecialchars($name) ?>"
                        class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <i class="fas <?= $icon ?> text-blue-600"></i>
                        <?= htmlspecialchars($label) ?>                 <?= $requiredMark ?>
                    </label>
                    <div class="relative">
                        <select id="<?= htmlspecialchars($name) ?>" name="<?= htmlspecialchars($name) ?>" <?= $requiredAttr ?>
                            class="w-full px-4 py-3 pr-10 border-2 border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none bg-white cursor-pointer">
                            <option value=""><?= htmlspecialchars($this->translations['select_option']) ?></option>
                            <?php foreach ($options as $option): ?>
                                <option value="<?= htmlspecialchars($option['value'] ?? $option) ?>">
                                    <?= htmlspecialchars($option['label'] ?? $option) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <i
                            class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
                <?php
                break;

            default: // text, email, number, etc.
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
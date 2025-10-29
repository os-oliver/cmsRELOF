<?php

namespace App\Controllers;
session_start();
use App\Models\Content;
use App\Models\Event;
use App\Admin\PageBuilders\BasicPageBuilder;
use App\Utils\CardRenderer;
use App\Utils\LocaleManager;

class PersonalContentController
{
    private function getPageStyles(): string
    {
        return '
            /* Core styles */
            body {
                margin: 0;
                padding: 0;
            }
            
            .dropdown:hover .dropdown-menu {
                display: block;
            }
            .dropdown-menu {
                display: none;
                position: absolute;
                background-color: white;
                min-width: 200px;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.1);
                z-index: 1;
                border-radius: 8px;
                overflow: hidden;
            }

            /* Page header */
            .page-header {
                background: white;
                border-bottom: 3px solid #667eea;
                padding: 1.5rem 0;
            }

            /* Content sections */
            .content-wrapper {
                background: white;
            }
            
            .section-divider {
                height: 1px;
                background: #e2e8f0;
                margin: 1.5rem 0;
            }

            /* Compact field styling */
            .field-row {
                margin-bottom: 1rem;
                padding: 0.75rem;
                background: #f8fafc;
                border-radius: 0.375rem;
                border-left: 3px solid #667eea;
            }
            
            .field-label {
                font-weight: 600;
                color: #4a5568;
                font-size: 0.813rem;
                display: inline-block;
                min-width: 120px;
                margin-right: 0.75rem;
            }
            
            .field-label i {
                margin-right: 0.375rem;
                color: #667eea;
            }
            
            .field-value {
                color: #1a202c;
                font-size: 0.938rem;
                line-height: 1.5;
                display: inline;
            }

            /* Compact info boxes */
            .info-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 0.75rem;
                margin: 1rem 0;
            }
            
            .info-box {
                background: #f7fafc;
                padding: 0.75rem;
                border-radius: 0.375rem;
                border-left: 3px solid #667eea;
            }
            
            .info-box-label {
                font-size: 0.688rem;
                color: #718096;
                font-weight: 600;
                text-transform: uppercase;
                margin-bottom: 0.25rem;
                letter-spacing: 0.025em;
            }
            
            .info-box-label i {
                margin-right: 0.375rem;
                color: #667eea;
            }
            
            .info-box-value {
                font-size: 0.938rem;
                color: #1a202c;
                font-weight: 500;
            }

            /* Gallery */
            .gallery-header {
                font-size: 1.25rem;
                font-weight: 700;
                color: #1a202c;
                margin: 1.5rem 0 0.75rem 0;
                padding-bottom: 0.375rem;
                border-bottom: 2px solid #667eea;
            }
            
            .gallery-header i {
                margin-right: 0.5rem;
                color: #667eea;
            }
            
            .gallery-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 0.75rem;
                margin-top: 0.75rem;
            }
            
            .gallery-item {
                position: relative;
                overflow: hidden;
                border-radius: 0.375rem;
                transition: all 0.3s ease;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            
            .gallery-item:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            }
            
            .gallery-item img {
                width: 100%;
                height: 160px;
                object-fit: cover;
                transition: transform 0.3s ease;
            }
            
            .gallery-item:hover img {
                transform: scale(1.05);
            }
            
            .gallery-overlay {
                position: absolute;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                opacity: 0;
                transition: opacity 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .gallery-item:hover .gallery-overlay {
                opacity: 1;
            }

            /* Category badge */
            .category-badge {
                display: inline-block;
                padding: 0.25rem 0.625rem;
                background: #667eea;
                color: white;
                border-radius: 9999px;
                font-size: 0.813rem;
                font-weight: 500;
                margin-bottom: 0.75rem;
            }

            /* Lightbox */
            .lightbox {
                animation: fadeIn 0.3s ease;
            }
            
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            
            .lightbox-image {
                animation: scaleIn 0.3s ease;
            }
            
            @keyframes scaleIn {
                from { transform: scale(0.9); opacity: 0; }
                to { transform: scale(1); opacity: 1; }
            }

            /* Responsive */
            @media (max-width: 768px) {
                .field-label {
                    display: block;
                    min-width: auto;
                    margin-bottom: 0.25rem;
                }
                .gallery-grid {
                    grid-template-columns: 1fr;
                }
                .info-grid {
                    grid-template-columns: 1fr;
                }
            }
        ';
    }

    private function getPageScripts(): string
    {
        return '
            document.addEventListener("DOMContentLoaded", function() {
                // Image gallery lightbox
                const galleryImages = document.querySelectorAll(".gallery-image-link");
                
                galleryImages.forEach(function(link) {
                    link.addEventListener("click", function(e) {
                        e.preventDefault();
                        const imgSrc = this.getAttribute("href");
                        const lightbox = document.createElement("div");
                        lightbox.className = "lightbox";
                        lightbox.innerHTML = 
                            "<div class=\'fixed inset-0 bg-black bg-opacity-95 z-50 flex items-center justify-center p-4\' style=\'backdrop-filter: blur(8px);\'>" +
                            "    <div class=\'relative max-w-7xl mx-auto\'>" +
                            "        <img src=\'" + imgSrc + "\' class=\'lightbox-image max-h-[90vh] max-w-full object-contain rounded-lg shadow-2xl\' alt=\'Enlarged image\'>" +
                            "        <button class=\'absolute -top-12 right-0 text-white text-4xl hover:text-gray-300 transition-colors w-12 h-12 flex items-center justify-center font-light\'>&times;</button>" +
                            "    </div>" +
                            "</div>";
                        document.body.appendChild(lightbox);
                        document.body.style.overflow = "hidden";
                        
                        lightbox.addEventListener("click", function(e) {
                            if (e.target === lightbox || e.target.closest("button") || e.target === lightbox.firstElementChild) {
                                document.body.style.overflow = "auto";
                                lightbox.remove();
                            }
                        });
                        
                        document.addEventListener("keydown", function escHandler(e) {
                            if (e.key === "Escape") {
                                document.body.style.overflow = "auto";
                                lightbox.remove();
                                document.removeEventListener("keydown", escHandler);
                            }
                        });
                    });
                });
            });
        ';
    }

    private function getGalleryLabel(string $locale): string
    {
        $labels = [
            'sr' => 'Galerija',
            'en' => 'Gallery',
            'sr-Cyrl' => 'Галерија'
        ];
        return $labels[$locale] ?? $labels['sr'];
    }

    public function renderContent($id, $type)
    {
        // Load structure configuration
        $structurePath = __DIR__ . '/../../public/assets/data/structure.json';
        $structure = [];
        if (is_file($structurePath)) {
            $structureData = file_get_contents($structurePath);
            $structure = json_decode($structureData, true);
            if (!is_array($structure) || empty($structure)) {
                $structure = [];
            }
        }

        // Get locale
        $locale = LocaleManager::get();
        if (!$locale) {
            $locale = $_SESSION['locale'] ?? 'sr';
        }

        // Initialize page builder
        $pageBuilder = new BasicPageBuilder('naziv', [
            'css' => $this->getPageStyles(),
            'js' => $this->getPageScripts()
        ]);

        // Generate content
        try {
            switch ($type) {
                default:
                    $mainContent = $this->getDefaultContent($type, $locale, $structure);
            }
        } catch (\Exception $e) {
            $mainContent = $this->getErrorContent($e->getMessage());
        }

        $html = '<main class="min-h-screen pt-16 bg-gray-50">' . $mainContent . '</main>';
        $pageBuilder->setHtml($html);
        return $pageBuilder->buildPage();
    }

    private function getEventContent(?array $eventData, array $structure, string $locale): string
    {
        if (!$eventData) {
            return '
            <div class="min-h-screen flex items-center justify-center">
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-red-600">Događaj nije pronađen</h1>
                    <p class="text-gray-600 mt-2">Traženi događaj ne postoji.</p>
                </div>
            </div>';
        }

        if (isset($eventData[0]) && is_array($eventData[0])) {
            $eventData = $eventData[0];
        }

        // Get labels from structure
        $labels = $this->getLabelsFromStructure('Dogadjaji', $structure, $locale);

        // Extract data
        $data = [
            'title' => $eventData['title'] ?? '',
            'date' => $eventData['date'] ?? '',
            'time' => $eventData['time'] ?? '',
            'location' => $eventData['location'] ?? '',
            'description' => $eventData['description'] ?? '',
            'category' => $eventData['category_name'] ?? '',
            'image' => !empty($eventData['image']) ? $eventData['image'] : null
        ];

        // Sanitize
        array_walk($data, function (&$value) {
            if (is_string($value)) {
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }
        });

        $html = '
        <div class="content-wrapper">
            <!-- Header -->
            <div class="page-header">
                <div class="container mx-auto px-4">
                    <div class="max-w-4xl mx-auto">';

        if ($data['category']) {
            $html .= '
                        <span class="category-badge">' . $data['category'] . '</span>';
        }

        $html .= '
                        <h1 class="text-3xl font-bold text-gray-900">' . $data['title'] . '</h1>
                    </div>
                </div>
            </div>';

        // Event image if exists
        if ($data['image']) {
            $html .= '
            <div class="container mx-auto px-4 py-4">
                <div class="max-w-4xl mx-auto">
                    <img src="' . $data['image'] . '" 
                         alt="' . $data['title'] . '" 
                         class="w-full h-auto rounded-lg shadow-lg">
                </div>
            </div>';
        }

        $html .= '
            <!-- Content -->
            <div class="container mx-auto px-4 py-4">
                <div class="max-w-4xl mx-auto">
                    
                    <!-- Event Info -->
                    <div class="info-grid">
                        <div class="info-box">
                            <div class="info-box-label"><i class="fas fa-calendar"></i> ' . ($labels['datum'] ?? 'Datum') . '</div>
                            <div class="info-box-value">' . $data['date'] . '</div>
                        </div>
                        
                        <div class="info-box">
                            <div class="info-box-label"><i class="fas fa-clock"></i> ' . ($labels['time'] ?? 'Vreme') . '</div>
                            <div class="info-box-value">' . ($data['time'] ?: '-') . '</div>
                        </div>
                        
                        <div class="info-box">
                            <div class="info-box-label"><i class="fas fa-map-marker-alt"></i> ' . ($labels['location'] ?? 'Lokacija') . '</div>
                            <div class="info-box-value">' . $data['location'] . '</div>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <!-- Description -->
                    <div class="field-row">
                        <span class="field-label"><i class="fas fa-align-left"></i> ' . ($labels['description'] ?? 'Opis') . '</span>
                        <span class="field-value">' . nl2br($data['description']) . '</span>
                    </div>
                    
                </div>
            </div>
        </div>';

        return $html;
    }

    private function getDefaultContent(string $type, string $locale, array $structure): string
    {
        $contentController = new Content();
        $id = $_GET['id'] ?? 0;

        if (!$id) {
            return $this->getNotFoundContent($type);
        }

        $data = $contentController->fetchItem($id, $locale);

        if (!$data['success'] || !isset($data['item'])) {
            return $this->getNotFoundContent($type);
        }

        $item = $data['item'];
        $fields = $item['fields'];

        // Get labels and field icons from structure
        $labels = $this->getLabelsFromStructure($type, $structure, $locale);
        $fieldIcons = $this->getFieldIcons($type, $structure);
        $typeData = $this->getTypeData($type, $structure, $locale);
        $typeName = $typeData['name'] ?? $type;

        // Get images
        $images = \App\Models\Image::fetchByElement($id);

        // Find title field
        $title = '';
        $titleField = null;
        foreach ($fields as $field => $values) {
            if (in_array(strtolower($field), ['title', 'name', 'heading', 'naziv', 'naslov']) && isset($values[$locale])) {
                $title = htmlspecialchars($values[$locale], ENT_QUOTES, 'UTF-8');
                $titleField = $field;
                break;
            }
        }

        // Build HTML
        $html = '
        <div class="content-wrapper">
            <!-- Header -->
            <div class="page-header">
                <div class="container mx-auto px-4">
                    <div class="max-w-4xl mx-auto">
                        <h1 class="text-3xl font-bold text-gray-900">' . ($title ?: $typeName) . '</h1>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="container mx-auto px-4 py-4">
                <div class="max-w-4xl mx-auto">';

        // Display fields
        foreach ($fields as $field => $values) {
            if ($field === $titleField || !isset($values[$locale])) {
                continue;
            }

            $value = $values[$locale];
            if (empty(trim($value))) {
                continue;
            }

            $displayLabel = $labels[$field] ?? ucwords(str_replace('_', ' ', $field));

            // Get icon for field
            $icon = $this->getFieldIcon($field, $fieldIcons);

            // Clean and escape value
            $escapedValue = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

            // For longer text, use nl2br
            if (strlen($value) > 100) {
                $escapedValue = nl2br($escapedValue);
            }

            $html .= '
                    <div class="field-row">
                        <span class="field-label"><i class="' . $icon . '"></i> ' . htmlspecialchars($displayLabel, ENT_QUOTES, 'UTF-8') . '</span>
                        <span class="field-value">' . $escapedValue . '</span>
                    </div>';
        }

        // Gallery
        if (!empty($images)) {
            $galleryLabel = $this->getGalleryLabel($locale);
            $html .= '
                    <div class="gallery-header"><i class="fas fa-images"></i> ' . $galleryLabel . '</div>
                    <div class="gallery-grid">';

            foreach ($images as $img) {
                $imgPath = htmlspecialchars($img['file_path'], ENT_QUOTES, 'UTF-8');
                $html .= '
                        <div class="gallery-item">
                            <a href="' . $imgPath . '" class="gallery-image-link block">
                                <img src="' . $imgPath . '" alt="Gallery image">
                                <div class="gallery-overlay">
                                    <i class="fas fa-search-plus text-white text-2xl"></i>
                                </div>
                            </a>
                        </div>';
            }

            $html .= '
                    </div>';
        }

        $html .= '
                </div>
            </div>
        </div>';

        return $html;
    }

    private function getFieldIcon(string $fieldName, array $fieldIcons): string
    {
        // Default icons based on common field names
        $defaultIcons = [
            'naziv' => 'fas fa-tag',
            'vodja' => 'fas fa-user',
            'opis' => 'fas fa-align-left',
            'projekti' => 'fas fa-project-diagram',
            'datum' => 'fas fa-calendar',
            'datumpocetka' => 'fas fa-calendar-check',
            'budzet' => 'fas fa-money-bill-wave',
            'link' => 'fas fa-link',
            'sekcija' => 'fas fa-folder',
            'naslov' => 'fas fa-heading',
            'autor' => 'fas fa-pen',
            'location' => 'fas fa-map-marker-alt',
            'time' => 'fas fa-clock',
            'description' => 'fas fa-align-left'
        ];

        $key = strtolower($fieldName);

        // Check if we have a specific icon from structure
        if (isset($fieldIcons[$key])) {
            return $fieldIcons[$key];
        }

        return $defaultIcons[$key] ?? 'fas fa-circle';
    }

    private function getFieldIcons(string $type, array $structure): array
    {
        $icons = [];

        if (empty($structure) || !is_array($structure)) {
            return $icons;
        }

        $structureData = $structure[0] ?? [];

        if (!isset($structureData[$type]) || !isset($structureData[$type]['fields'])) {
            return $icons;
        }

        foreach ($structureData[$type]['fields'] as $field) {
            $name = $field['name'] ?? null;
            $icon = $field['icon'] ?? null;

            if ($name && $icon) {
                $icons[strtolower($name)] = $icon;
            }
        }

        return $icons;
    }

    private function getLabelsFromStructure(string $type, array $structure, string $locale): array
    {
        $labels = [];

        if (empty($structure) || !is_array($structure)) {
            return $labels;
        }

        // Structure is an array with one object
        $structureData = $structure[0] ?? [];

        if (!isset($structureData[$type]) || !isset($structureData[$type]['fields'])) {
            return $labels;
        }

        foreach ($structureData[$type]['fields'] as $field) {
            $name = $field['name'] ?? null;
            if (!$name)
                continue;

            // Try current locale first, then fallback to 'sr', then 'en'
            if (isset($field['label'][$locale])) {
                $label = $field['label'][$locale];
            } elseif (isset($field['label']['sr'])) {
                $label = $field['label']['sr'];
            } elseif (isset($field['label']['en'])) {
                $label = $field['label']['en'];
            } else {
                $label = ucwords(str_replace('_', ' ', $name));
            }

            $labels[$name] = $label;
        }

        return $labels;
    }

    private function getTypeData(string $type, array $structure, string $locale): array
    {
        if (empty($structure) || !is_array($structure)) {
            return ['name' => $type];
        }

        $structureData = $structure[0] ?? [];

        if (!isset($structureData[$type])) {
            return ['name' => $type];
        }

        $typeInfo = $structureData[$type];

        // Get localized type name
        $typeName = $typeInfo[$locale] ?? $typeInfo['sr'] ?? $typeInfo['en'] ?? $type;

        return [
            'name' => $typeName,
            'icon' => $typeInfo['icon'] ?? 'fas fa-file-alt'
        ];
    }

    private function getNotFoundContent(string $type): string
    {
        return '
        <div class="min-h-screen flex items-center justify-center">
            <div class="text-center px-4">
                <i class="fas fa-exclamation-circle text-6xl text-gray-400 mb-6"></i>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Sadržaj nije pronađen</h1>
                <p class="text-gray-600">Traženi sadržaj ne postoji ili je uklonjen.</p>
            </div>
        </div>';
    }

    private function getErrorContent(string $message): string
    {
        return '
        <div class="min-h-screen flex items-center justify-center">
            <div class="text-center px-4">
                <i class="fas fa-exclamation-triangle text-6xl text-red-500 mb-6"></i>
                <h1 class="text-3xl font-bold text-red-600 mb-2">Greška</h1>
                <p class="text-gray-700">' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>
            </div>
        </div>';
    }
}
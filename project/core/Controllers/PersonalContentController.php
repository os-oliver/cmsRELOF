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
                padding: 2rem 0;
            }

            /* Content sections */
            .content-wrapper {
                background: white;
            }
            
            .section-divider {
                height: 1px;
                background: #e2e8f0;
                margin: 2rem 0;
            }

            /* Field styling */
            .field-row {
                margin-bottom: 1.5rem;
                padding-bottom: 1.5rem;
                border-bottom: 1px solid #f1f5f9;
            }
            
            .field-row:last-child {
                border-bottom: none;
            }
            
            .field-label {
                font-weight: 600;
                color: #4a5568;
                font-size: 0.875rem;
                margin-bottom: 0.5rem;
                display: block;
            }
            
            .field-value {
                color: #1a202c;
                font-size: 1rem;
                line-height: 1.6;
            }

            /* Info boxes for events */
            .info-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1rem;
                margin: 1.5rem 0;
            }
            
            .info-box {
                background: #f7fafc;
                padding: 1rem;
                border-radius: 0.5rem;
                border-left: 3px solid #667eea;
            }
            
            .info-box-label {
                font-size: 0.75rem;
                color: #718096;
                font-weight: 600;
                text-transform: uppercase;
                margin-bottom: 0.25rem;
            }
            
            .info-box-value {
                font-size: 1rem;
                color: #1a202c;
                font-weight: 500;
            }

            /* Gallery */
            .gallery-header {
                font-size: 1.5rem;
                font-weight: 700;
                color: #1a202c;
                margin: 2rem 0 1rem 0;
                padding-bottom: 0.5rem;
                border-bottom: 2px solid #667eea;
            }
            
            .gallery-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1rem;
                margin-top: 1rem;
            }
            
            .gallery-item {
                position: relative;
                overflow: hidden;
                border-radius: 0.5rem;
                transition: all 0.3s ease;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            
            .gallery-item:hover {
                transform: translateY(-4px);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            }
            
            .gallery-item img {
                width: 100%;
                height: 200px;
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
                padding: 0.25rem 0.75rem;
                background: #667eea;
                color: white;
                border-radius: 9999px;
                font-size: 0.875rem;
                font-weight: 500;
                margin-bottom: 1rem;
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
                        <h1 class="text-4xl font-bold text-gray-900">' . $data['title'] . '</h1>
                    </div>
                </div>
            </div>';

        // Event image if exists
        if ($data['image']) {
            $html .= '
            <div class="container mx-auto px-4 py-6">
                <div class="max-w-4xl mx-auto">
                    <img src="' . $data['image'] . '" 
                         alt="' . $data['title'] . '" 
                         class="w-full h-auto rounded-lg shadow-lg">
                </div>
            </div>';
        }

        $html .= '
            <!-- Content -->
            <div class="container mx-auto px-4 py-6">
                <div class="max-w-4xl mx-auto">
                    
                    <!-- Event Info -->
                    <div class="info-grid">
                        <div class="info-box">
                            <div class="info-box-label">' . ($labels['datum'] ?? 'Datum') . '</div>
                            <div class="info-box-value">' . $data['date'] . '</div>
                        </div>
                        
                        <div class="info-box">
                            <div class="info-box-label">' . ($labels['time'] ?? 'Vreme') . '</div>
                            <div class="info-box-value">' . ($data['time'] ?: '-') . '</div>
                        </div>
                        
                        <div class="info-box">
                            <div class="info-box-label">' . ($labels['location'] ?? 'Lokacija') . '</div>
                            <div class="info-box-value">' . $data['location'] . '</div>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <!-- Description -->
                    <div>
                        <div class="field-label">' . ($labels['description'] ?? 'Opis') . '</div>
                        <div class="field-value">
                            ' . nl2br($data['description']) . '
                        </div>
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

        // Get labels from structure
        $labels = $this->getLabelsFromStructure($type, $structure, $locale);
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
                        <h1 class="text-4xl font-bold text-gray-900">' . ($title ?: $typeName) . '</h1>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="container mx-auto px-4 py-6">
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

            // Escape HTML i ukloni \n ili <br>
            // Escape HTML i ukloni \n ili <br>
            $cleanText = str_replace(["\n", "\r"], ' ', $value);
            $cleanText = htmlspecialchars($cleanText, ENT_QUOTES, 'UTF-8');

            // Podeli tekst na linije od max 50 karaktera (sigurno za UTF-8)
            $lines = mb_str_split($cleanText, 50, 'UTF-8');

            // Spoji linije u HTML paragraf sekciju
            $escapedValue = '<p>' . implode('</p><p>', $lines) . '</p>';

            $html .= '<div class="field-row" style="margin-bottom: 12px;">'
                . '<div class="field-label" style="font-weight: 600; color: #3b3b3b; margin-bottom: 4px;">'
                . htmlspecialchars($displayLabel, ENT_QUOTES, 'UTF-8')
                . '</div>'
                . '<div class="field-value" style="white-space: pre-wrap; line-height: 1.5;">'
                . $escapedValue
                . '</div></div>';



        }

        // Gallery
        if (!empty($images)) {
            $galleryLabel = $this->getGalleryLabel($locale);
            $html .= '
                    <div class="gallery-header">' . $galleryLabel . '</div>
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
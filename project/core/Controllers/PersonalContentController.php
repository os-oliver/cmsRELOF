<?php

namespace App\Controllers;

use App\Models\Content;
use App\Models\Event;
use App\Admin\PageBuilders\BasicPageBuilder;
use App\Utils\CardRenderer;

class PersonalContentController
{
    private function getPageStyles(): string
    {
        return '
            /* Core styles */
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

            /* Gallery image zoom effect */
            .gallery-image {
                transition: transform 0.3s ease-in-out;
            }
            .gallery-image:hover {
                transform: scale(1.05);
            }

            /* Content text styles */
            .content-text {
                line-height: 1.8;
                font-size: 1.1rem;
            }
            .content-text p {
                margin-bottom: 1.5rem;
            }
            
            /* Responsive adjustments */
            @media (max-width: 768px) {
                .content-wrapper {
                    padding: 1rem;
                }
            }';
    }

    private function getPageScripts(): string
    {
        return '
            // Image gallery lightbox functionality
            document.addEventListener("DOMContentLoaded", function() {
                const galleryImages = document.querySelectorAll(".gallery-image-link");
                galleryImages.forEach(function(link) {
                    link.addEventListener("click", function(e) {
                        e.preventDefault();
                        const imgSrc = this.getAttribute("href");
                        const lightbox = document.createElement("div");
                        lightbox.innerHTML = 
                            "<div class=\'fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4\'>" +
                            "    <div class=\'relative max-w-7xl mx-auto\'>" +
                            "        <img src=\'" + imgSrc + "\' class=\'max-h-[90vh] max-w-full object-contain\' alt=\'Enlarged image\'>" +
                            "        <button class=\'absolute top-4 right-4 text-white text-xl hover:text-gray-300\'>&times;</button>" +
                            "    </div>" +
                            "</div>";
                        document.body.appendChild(lightbox);
                        
                        // Close on click
                        lightbox.addEventListener("click", function() {
                            lightbox.remove();
                        });
                    });
                });
            });
        ';
    }

    public function renderContent($id, $type)
    {
        // First load configuration data
        $structurePath = __DIR__ . '/../../public/assets/data/structure.json';
        $structure = [];
        if (is_file($structurePath)) {
            $structure = json_decode(file_get_contents($structurePath), true) ?? [];
        }

        // Initialize page builder with assets
        $pageBuilder = new BasicPageBuilder('naziv', [
            'css' => $this->getPageStyles(),
            'js' => $this->getPageScripts()
        ]);

        // Generate main content
        try {
            switch ($type) {
                case 'events':
                    $event = new Event();
                    $eventData = $event->findById($id);
                    $mainContent = $this->getEventContent($eventData);
                    break;
                case 'generic_element':
                default:
                    // Only pass the type parameter as it's the only one accepted
                    $mainContent = $this->getDefaultContent($type);
            }
        } catch (\Exception $e) {
            $mainContent = $this->getErrorContent($e->getMessage());
        }

        // Build the complete page HTML
        $html = '<main class="min-h-screen pt-24 flex-grow bg-gray-50">' . $mainContent . '</main>';

        $pageBuilder->setHtml($html);
        return $pageBuilder->buildPage();
    }

    private function getEventContent(?array $eventData): string
    {
        if (!$eventData) {
            return '
            <main class="min-h-screen pt-24 pb-12 bg-gray-50">
                <div class="container mx-auto px-4">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h1 class="text-2xl font-bold text-red-600">Event not found</h1>
                    </div>
                </div>
            </main>';
        }
        if ($eventData && isset($eventData[0]) && is_array($eventData[0])) {
            $eventData = $eventData[0];
        }
        // Extract and sanitize event data
        $data = [
            'title' => $eventData['title'] ?? '',
            'date' => $eventData['date'] ?? '',
            'time' => $eventData['time'] ?? '',
            'location' => $eventData['location'] ?? '',
            'description' => $eventData['description'] ?? '',
            'category' => $eventData['category_name'] ?? '',
            'color_code' => $eventData['color_code'] ?? 'blue-600',
            'image' => !empty($eventData['image']) ? $eventData['image'] : null
        ];

        // Sanitize all text fields
        array_walk($data, function (&$value) {
            if (is_string($value)) {
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }
        });

        $html = '
        <main class="min-h-screen pt-24 pb-12 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="max-w-7xl mx-auto">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="flex flex-col md:flex-row">';

        // Add image section if image exists
        if ($data['image']) {
            $html .= '
                            <div class="md:w-1/2">
                                <div class="relative h-full min-h-[300px]">
                                    <img src="' . $data['image'] . '" 
                                         alt="' . $data['title'] . '" 
                                         class="w-full h-full object-cover">
                                </div>
                            </div>';
        }

        $html .= '
                            <div class="' . ($data['image'] ? 'md:w-1/2' : 'w-full') . ' p-8">
                                <div class="flex flex-wrap items-center gap-2 mb-4">
                                    <span class="px-3 py-1 rounded-full text-sm font-medium bg-' . $data['color_code'] . ' text-white">
                                        ' . $data['category'] . '
                                    </span>
                                </div>

                                <h1 class="text-3xl md:text-4xl font-bold mb-6 text-gray-900">' . $data['title'] . '</h1>
                                
                                <div class="flex flex-wrap items-center gap-6 mb-6 text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <i class="far fa-calendar-alt text-xl"></i>
                                        <span>' . $data['date'] . ($data['time'] ? ' • ' . $data['time'] : '') . '</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-map-marker-alt text-xl"></i>
                                        <span>' . $data['location'] . '</span>
                                    </div>
                                </div>
                                
                                <div class="prose max-w-none text-gray-700">
                                    ' . nl2br($data['description']) . '
                                </div>
                                
                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>';

        return $html;
    }



    private function getDefaultContent(string $type): string
    {
        // Fetch generic element data from ContentController
        $contentController = new Content();
        $id = $_GET['id'] ?? 0;

        if ($id) {
            $data = $contentController->fetchItem($id);
            if ($data['success'] && isset($data['item'])) {
                $item = $data['item'];
                $fields = $item['fields'];

                // Load structure labels to map field labels
                $structurePath = __DIR__ . '/../../public/assets/data/structure.json';
                $structure = [];
                if (is_file($structurePath)) {
                    $structure = json_decode(file_get_contents($structurePath), true) ?? [];
                }

                // Try to find labels for this type in the structure
                $labelsMap = [];
                if (!empty($structure) && is_array($structure)) {
                    // structure.json is an array with one object at top-level
                    $top = $structure[0] ?? [];
                    if (isset($top[$type]) && isset($top[$type]['fields'])) {
                        foreach ($top[$type]['fields'] as $fld) {
                            $name = $fld['name'] ?? null;
                            $label = $fld['label'][$_SESSION['locale'] ?? 'sr-Cyrl'] ?? $fld['label']['sr-Cyrl'] ?? $fld['label']['sr'] ?? $fld['label']['en'] ?? $name;
                            if ($name) {
                                $labelsMap[$name] = $label;
                            }
                        }
                    }
                }

                // Get associated images
                $images = \App\Models\Image::fetchByElement($id);

                // Start building the HTML with a responsive two-column grid
                $html = '
                <div class="container mx-auto px-4 py-8">
                    <div class="max-w-5xl mx-auto">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <article class="p-8">'
                ;

                // Header/title handling
                $title = '';

                // Build fields into grid cells
                $fieldHtmlParts = [];
                foreach ($fields as $field => $values) {
                    if (!isset($values[$_SESSION['locale'] ?? 'sr-Cyrl'])) {
                        continue;
                    }
                    $value = $values[$_SESSION['locale'] ?? 'sr-Cyrl'];
                    $displayLabel = $labelsMap[$field] ?? ucwords(str_replace('_', ' ', $field));

                    // Special handling for title/name fields - display as main heading
                    if (in_array(strtolower($field), ['title', 'name', 'heading', 'naziv'])) {
                        $title = '<h1 class="text-3xl font-bold text-gray-900 mb-6">' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '</h1>';
                        continue;
                    }

                    $escapedValue = nl2br(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));

                    // If value length > 40 (excluding whitespace), make it span full row
                    $plainLen = mb_strlen(trim(preg_replace('/\s+/', ' ', strip_tags($value))), 'UTF-8');
                    $spanFull = $plainLen > 40;

                    $cellClass = $spanFull ? 'col-span-1 sm:col-span-2' : 'col-span-1';

                    $fieldHtmlParts[] = '<div class="' . $cellClass . ' mb-6">'
                        . '<h3 class="text-sm font-semibold text-gray-700 mb-2">' . htmlspecialchars($displayLabel, ENT_QUOTES, 'UTF-8') . '</h3>'
                        . '<div class="prose prose-sm text-gray-600 break-words" style="white-space: pre-line;">' . $escapedValue . '</div>'
                        . '</div>';
                }

                // Compose grid: use Tailwind-like classes; two columns on small+ screens
                $html .= $title;
                $html .= '<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">' . implode("\n", $fieldHtmlParts) . '</div>';

                // Display images in a grid if available
                if (!empty($images)) {
                    $html .= '<div class="mt-12">';
                    $html .= '<h2 class="text-2xl font-semibold text-gray-800 mb-6">Gallery</h2>';
                    $html .= '<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">';

                    foreach ($images as $img) {
                        $imgPath = htmlspecialchars($img['file_path'], ENT_QUOTES, 'UTF-8');
                        $html .= '<div class="group relative rounded-xl overflow-hidden bg-gray-100 shadow-md hover:shadow-xl transition-all duration-300">';
                        $html .= '<a href="' . $imgPath . '" target="_blank" class="block">';
                        $html .= '<img src="' . $imgPath . '" alt="Content image" class="w-full h-auto object-cover">';
                        $html .= '</a>';
                        $html .= '</div>';
                    }

                    $html .= '</div>';
                    $html .= '</div>';
                }

                $html .= '</article></div></div></div>';

                return $html;
            }
        }

        return '
            <div class="container mx-auto px-4 py-8">
                <h1 class="text-2xl font-bold">Content not found</h1>
                <p>No content found for type: ' . htmlspecialchars($type, ENT_QUOTES, 'UTF-8') . '</p>
            </div>
        ';
    }


    private function getErrorContent(string $message): string
    {
        return '
            <div class="container mx-auto px-4 py-8">
                <h1 class="text-2xl font-bold text-red-600">Error loading content</h1>
                <p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p>
            </div>
        ';
    }
}



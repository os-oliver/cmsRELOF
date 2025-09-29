<?php

namespace App\Controllers;

use App\Models\Event;
use App\Admin\PageBuilders\BasicPageBuilder;

class PersonalContentController
{
    public function renderContent($id, $type)
    {
        require_once __DIR__ . '/../../public/exportedPages/landingPageComponents/landingPage/header.php';
        $pageBuilder = new BasicPageBuilder('naziv', [
            'css' => ' .dropdown:hover .dropdown-menu {
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
',
            'js' => ''
        ]);
        $content = '';

        try {
            switch ($type) {
                case 'events':
                    $event = new Event();
                    $eventData = $event->findById($id);
                    $content = $this->getEventContent($eventData);
                    break;
                default:
                    $content = $this->getDefaultContent($type);
            }
        } catch (\Exception $e) {
            $content = $this->getErrorContent($e->getMessage());
        }
        $pageBuilder->setHtml('<main class="min-h-screen pt-24 flex-grow bg-gray-50">' . $content . '</main>');
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
        return '
            <div class="container mx-auto px-4 py-8">
                <h1 class="text-2xl font-bold">Content not found</h1>
                <p>No handler found fostring: r type: ' . htmlspecialchars($type, ENT_QUOTES, 'UTF-8') . '</p>
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



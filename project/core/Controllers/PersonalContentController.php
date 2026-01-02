<?php

namespace App\Controllers;


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
                font-size: 14px;
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

            /* Page header - compact */
            .page-header {
                background: white;
                border-bottom: 2px solid #667eea;
                padding: 1rem 0;
            }

            .page-header h1 {
                font-size: 1.5rem;
                margin: 0;
            }

            /* Content sections */
            .content-wrapper {
                background: white;
            }

            .section-divider {
                height: 1px;
                background: #e2e8f0;
                margin: 1rem 0;
            }

            /* Compact two-column field layout */
            .fields-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 0.5rem;
                margin: 0.75rem 0;
            }

            .field-row {
                padding: 0.5rem 0.75rem;
                background: #f8fafc;
                border-radius: 0.25rem;
                border-left: 2px solid #667eea;
                display: flex;
                align-items: baseline;
                gap: 0.5rem;
                min-height: 36px;
            }

            .field-label {
                font-weight: 600;
                color: #4a5568;
                font-size: 0.75rem;
                white-space: nowrap;
                flex-shrink: 0;
            }

            .field-label i {
                margin-right: 0.25rem;
                color: #667eea;
                font-size: 0.7rem;
            }

            .field-value {
                color: #1a202c;
                font-size: 0.875rem;
                line-height: 1.4;
                flex: 1;
                word-break: break-word;
            }

            /* Long text fields - full width */
            .field-row.full-width {
                grid-column: 1 / -1;
                flex-direction: column;
                align-items: flex-start;
            }

            .field-row.full-width .field-label {
                margin-bottom: 0.25rem;
            }

            /* Compact info boxes */
            .info-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                gap: 0.5rem;
                margin: 0.75rem 0;
            }

            .info-box {
                background: #f7fafc;
                padding: 0.5rem;
                border-radius: 0.25rem;
                border-left: 2px solid #667eea;
            }

            .info-box-label {
                font-size: 0.625rem;
                color: #718096;
                font-weight: 600;
                text-transform: uppercase;
                margin-bottom: 0.25rem;
                letter-spacing: 0.025em;
            }

            .info-box-label i {
                margin-right: 0.25rem;
                color: #667eea;
            }

            .info-box-value {
                font-size: 0.875rem;
                color: #1a202c;
                font-weight: 500;
            }

            /* Documents section - compact with icons */
            .documents-section {
                margin: 1rem 0;
            }

            .documents-header {
                font-size: 1rem;
                font-weight: 700;
                color: #1a202c;
                margin-bottom: 0.5rem;
                padding-bottom: 0.25rem;
                border-bottom: 2px solid #667eea;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .documents-header i {
                color: #667eea;
            }

            .documents-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 0.5rem;
                margin-top: 0.5rem;
            }

            .document-card {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.625rem;
                background: #f8fafc;
                border: 1px solid #e2e8f0;
                border-radius: 0.375rem;
                transition: all 0.2s ease;
                text-decoration: none;
                color: inherit;
            }

            .document-card:hover {
                background: #edf2f7;
                border-color: #667eea;
                transform: translateY(-1px);
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .document-icon {
                width: 36px;
                height: 36px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 0.25rem;
                flex-shrink: 0;
                font-size: 1.125rem;
            }

            .document-icon.pdf {
                background: #fee;
                color: #dc2626;
            }

            .document-icon.excel {
                background: #efe;
                color: #16a34a;
            }

            .document-icon.word {
                background: #eef;
                color: #2563eb;
            }

            .document-icon.default {
                background: #f5f5f5;
                color: #64748b;
            }

            .document-info {
                flex: 1;
                min-width: 0;
            }

            .document-name {
                font-size: 0.813rem;
                font-weight: 500;
                color: #1a202c;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                margin-bottom: 0.125rem;
            }

            .document-size {
                font-size: 0.688rem;
                color: #64748b;
            }

            .document-download {
                color: #667eea;
                font-size: 1rem;
                opacity: 0.7;
                transition: opacity 0.2s;
            }

            .document-card:hover .document-download {
                opacity: 1;
            }

            /* Gallery - compact */
            .gallery-header {
                font-size: 1rem;
                font-weight: 700;
                color: #1a202c;
                margin: 1rem 0 0.5rem 0;
                padding-bottom: 0.25rem;
                border-bottom: 2px solid #667eea;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .gallery-header i {
                color: #667eea;
            }

            .gallery-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 0.5rem;
                margin-top: 0.5rem;
            }

            .gallery-item {
                position: relative;
                overflow: hidden;
                border-radius: 0.375rem;
                transition: all 0.3s ease;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                aspect-ratio: 1;
            }

            .gallery-item:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            }

            .gallery-item img {
                width: 100%;
                height: 100%;
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
                font-size: 0.75rem;
                font-weight: 500;
                margin-bottom: 0.5rem;
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
                .fields-grid {
                    grid-template-columns: 1fr;
                }
                .gallery-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
                .info-grid {
                    grid-template-columns: 1fr;
                }
                .documents-grid {
                    grid-template-columns: 1fr;
                }
            }
        ';
    }

    private function getPageScripts(): string
    {
        return
            <<<JS
            <script>

                document.addEventListener('DOMContentLoaded', () => {
                console.log("Lightbox sa sliderom aktivan");

                // === 1. Kreiranje MODALA ===
                const modal = document.createElement('div');
                modal.id = 'galleryModal';
                modal.className = `
                    fixed inset-0 bg-black bg-opacity-80 hidden
                    flex items-center justify-center z-[999999]
                `;

                modal.innerHTML = `
                    <span class="absolute top-4 right-6 text-white text-4xl cursor-pointer select-none close-btn">&times;</span>
                    <button class="prev-btn absolute left-4 text-white text-5xl font-bold px-4 cursor-pointer select-none">&lt;</button>
                    <img id="modalImage" class="max-w-[90%] max-h-[90%] rounded shadow-xl transition-all duration-200">
                    <button class="next-btn absolute right-4 text-white text-5xl font-bold px-4 cursor-pointer select-none">&gt;</button>
                `;

                document.body.appendChild(modal);

                const modalImage = modal.querySelector("#modalImage");
                const closeBtn = modal.querySelector(".close-btn");
                const prevBtn = modal.querySelector(".prev-btn");
                const nextBtn = modal.querySelector(".next-btn");

                // === 2. Prikupljanje svih slika iz galerije ===
                const galleryItems = document.getElementsByClassName('gallery-item');
                const images = []; // lista svih linkova
                let currentIndex = 0;

                for (let i = 0; i < galleryItems.length; i++) {
                    const link = galleryItems[i].querySelector(".gallery-image-link");
                    if (link) images.push(link.getAttribute("href"));
                }

                // === 3. Funckija za otvaranje modala ===
                const openModal = (index) => {
                    currentIndex = index;
                    modalImage.src = images[currentIndex];

                    modal.classList.remove("hidden");
                    document.body.classList.add("overflow-hidden");
                };

                // === 4. Klik na item gallery ===
                for (let i = 0; i < galleryItems.length; i++) {
                    galleryItems[i].addEventListener("click", (event) => {
                        const link = galleryItems[i].querySelector(".gallery-image-link");
                        if (!link) return;

                        event.preventDefault();
                        openModal(i);
                    });
                }

                // === 5. Slider funkcije ===
                const showNext = () => {
                    currentIndex = (currentIndex + 1) % images.length;
                    modalImage.src = images[currentIndex];
                };

                const showPrev = () => {
                    currentIndex = (currentIndex - 1 + images.length) % images.length;
                    modalImage.src = images[currentIndex];
                };

                nextBtn.addEventListener("click", showNext);
                prevBtn.addEventListener("click", showPrev);

                // === 6. ZATVARANJE ===
                const closeModal = () => {
                    modal.classList.add("hidden");
                    modalImage.src = "";
                    document.body.classList.remove("overflow-hidden");
                };

                closeBtn.addEventListener("click", closeModal);

                modal.addEventListener("click", (e) => {
                    if (e.target === modal) closeModal();
                });

                document.addEventListener("keydown", (e) => {
                    if (e.key === "Escape") closeModal();
                    if (e.key === "ArrowRight") showNext();
                    if (e.key === "ArrowLeft") showPrev();
                });
            });

            </script>

            JS;
    }

    private function getDocumentIcon(string $extension): array
    {
        $icons = [
            'pdf' => ['icon' => 'fas fa-file-pdf', 'class' => 'pdf'],
            'doc' => ['icon' => 'fas fa-file-word', 'class' => 'word'],
            'docx' => ['icon' => 'fas fa-file-word', 'class' => 'word'],
            'xls' => ['icon' => 'fas fa-file-excel', 'class' => 'excel'],
            'xlsx' => ['icon' => 'fas fa-file-excel', 'class' => 'excel'],
        ];

        return $icons[$extension] ?? ['icon' => 'fas fa-file', 'class' => 'default'];
    }

    private function formatFileSize(string $filePath): string
    {
        if (file_exists($filePath)) {
            $bytes = filesize($filePath);
            if ($bytes >= 1048576) {
                return number_format($bytes / 1048576, 2) . ' MB';
            } elseif ($bytes >= 1024) {
                return number_format($bytes / 1024, 2) . ' KB';
            }
            return $bytes . ' B';
        }
        return '';
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

    private function getDocumentsLabel(string $locale): string
    {
        $labels = [
            'sr' => 'Dokumenta',
            'en' => 'Documents',
            'sr-Cyrl' => 'Документа'
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
                case 'Anketa':
                    $mainContent = $this->getAnketaContent($type, $locale, $structure);
                    break;
                case 'Vrtici':
                    $mainContent = $this->getVrticiContent($type, $locale, $structure);
                    break;
                case 'Timovi':
                    $mainContent = $this->getTimoviContent($type, $locale, $structure);
                    break;
                case 'Obavestenja':
                    $mainContent = $this->getObavestenjaContent($type, $locale, $structure);
                    break;
                case 'Projekti':
                    $mainContent = $this->getProjektiContent($type, $locale, $structure);
                    break;
                case 'Zaposleni':
                    $mainContent = $this->getZaposleniContent($type, $locale, $structure);
                    break;
                default:
                    $mainContent = $this->getDefaultContent($type, $locale, $structure);
            }
        } catch (\Exception $e) {
            $mainContent = $this->getErrorContent($e->getMessage());
        }

        // Wrap in main tag and then compile the entire HTML
        $html = '<main class="min-h-screen pt-16 bg-white">' . $mainContent . '</main>';

        $compiledHtml = $this->compilePhpString($html);


        $pageBuilder->setHtml($compiledHtml);
        $skripta = $this->getPageScripts();

        $pageBuilder->setScript($skripta);

        $fullPageHtml = $pageBuilder->buildPage();
        $stringCompiled = $this->compilePhpString($fullPageHtml);
        echo $stringCompiled;
    }

    private function compilePhpString(string $phpCode, array $vars = []): string
    {
        $phpCode = html_entity_decode($phpCode, ENT_QUOTES, 'UTF-8');

        if (!empty($vars)) {
            extract($vars, EXTR_SKIP);
        }

        $publicRoot = realpath(__DIR__ . '/../../public/exportedPages/');


        $phpCode = preg_replace_callback(
            '/(?:require|include|require_once|include_once)\s+__DIR__\s*\.\s*[\'"](\/?\.\.\/+)*([^\'"]+)[\'"]/i',
            function ($matches) use ($publicRoot) {
                $path = $matches[2];
                $path = ltrim($path, '/');
                return 'require \'' . $publicRoot . '/' . $path . '\'';
            },
            $phpCode
        );

        $patterns = [
            '/require\s+[\'"]\.\.\/([^\'"]+)[\'"]/i' => "require '" . $publicRoot . "/$1'",
            '/require_once\s+[\'"]\.\.\/([^\'"]+)[\'"]/i' => "require_once '" . $publicRoot . "/$1'",
            '/include\s+[\'"]\.\.\/([^\'"]+)[\'"]/i' => "include '" . $publicRoot . "/$1'",
            '/include_once\s+[\'"]\.\.\/([^\'"]+)[\'"]/i' => "include_once '" . $publicRoot . "/$1'",
        ];

        foreach ($patterns as $pattern => $replacement) {
            $phpCode = preg_replace($pattern, $replacement, $phpCode);
        }

        ob_start();
        try {
            set_include_path($publicRoot . PATH_SEPARATOR . get_include_path());

            eval ("?>" . $phpCode);

            $output = ob_get_clean();
        } catch (\Throwable $e) {
            ob_end_clean();
            $output = "<!-- Error executing PHP: " .
                htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8')
                . " -->";
        }

        return $output === false ? '' : $output;
    }
    private function getAnketaContent(string $type, string $locale, array $structure): string
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

        // Naslov
        $title = 'Anketa';
        if (isset($fields['naslov'][$locale]) && is_string($fields['naslov'][$locale])) {
            $title = htmlspecialchars($fields['naslov'][$locale], ENT_QUOTES, 'UTF-8');
        }

        // Link ankete
        $surveyLink = '';
        if (isset($fields['link'][$locale]) && is_string($fields['link'][$locale])) {
            $surveyLink = trim($fields['link'][$locale]);
        }

        // Ako nema linka, prikaži poruku
        if (empty($surveyLink)) {
            return '
        <div class="text-center text-gray-600 py-12">
            Link za anketu nije pronađen.
        </div>';
        }

        // Automatski prebacujemo link u embed oblik ako je Google Forms
        if (str_contains($surveyLink, 'docs.google.com/forms') && !str_contains($surveyLink, 'embedded=true')) {
            $surveyLink = preg_replace('/\/edit(\?.*)?$/', '/viewform?embedded=true', $surveyLink);
        }

        $escapedLink = htmlspecialchars($surveyLink, ENT_QUOTES, 'UTF-8');

        // HTML
        $html = '
    <div class="content-wrapper">
        <div class="page-header">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto text-center">
                    <h1>' . $title . '</h1>
                    <p class="text-gray-600 text-sm mt-1">Molimo vas da popunite anketu u nastavku</p>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-4">
            <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
                <iframe
                    src="' . $escapedLink . '"
                    width="100%"
                    height="900"
                    frameborder="0"
                    marginheight="0"
                    marginwidth="0"
                    class="rounded-2xl"
                    style="border:none; background-color:#fafafa;">
                    Učitavanje ankete...
                </iframe>
            </div>
        </div>
    </div>';

        return $html;
    }

    private function getObavestenjaContent(string $type, string $locale, array $structure): string
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

        $labels = $this->getLabelsFromStructure($type, $structure, $locale);
        $typeData = $this->getTypeData($type, $structure, $locale);
        $typeName = $typeData['name'] ?? 'Vrtić';

        $images = \App\Models\Image::fetchByElement($id);

        $title = $fields['title'][$locale] ?? $typeName;
        $naziv = $fields['naziv'][$locale] ?? '';

        $description = $fields['opis'][$locale] ?? '';

        $coverImage = '';
        if (isset($fields['slika'][$locale]) && !empty($fields['slika'][$locale])) {
            $coverImage = htmlspecialchars($fields['slika'][$locale], ENT_QUOTES, 'UTF-8');
        } elseif (!empty($images)) {
            $coverImage = htmlspecialchars($images[0]['file_path'], ENT_QUOTES, 'UTF-8');
        }

        $html = '
        <div class="content-wrapper vrtici-detail">
            <div class="container mx-auto px-4 py-6 max-w-4xl">
                <div class="bg-surface rounded-2xl shadow p-6 font-body">
                    <h1 class="text-3xl font-heading text-primary_text mb-4">
                        ' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '
                    </h1>
                    ' . ($coverImage ? '
                    <div class="mb-6">
                        <img src="' . $coverImage . '" alt="' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '"
                            class="w-full h-80 object-cover rounded-2xl shadow-sm">
                    </div>' : '') . '
                    ' . ($naziv ? '
                    <h2 class="text-2xl font-heading2 text-primary_text mb-4">
                        ' . htmlspecialchars($naziv, ENT_QUOTES, 'UTF-8') . '
                    </h2>' : '') . '
                    ' . ($description ? '
                    <div class="text-secondary_text leading-relaxed mb-6">
                        ' . nl2br(htmlspecialchars($description, ENT_QUOTES, 'UTF-8')) . '
                    </div>' : '') . '
                </div>
                ' . (!empty($images) ? '
                <div class="mt-8">
                    <h2 class="text-2xl font-heading text-primary_text mb-4">
                        <i class="fas fa-images mr-2 text-blue-500"></i>' . ($this->getGalleryLabel($locale)) . '
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        ' . implode('', array_map(fn($img) => '
                            <div class="gallery-item overflow-hidden rounded-xl shadow-sm">
                                <a href="' . htmlspecialchars($img['file_path'], ENT_QUOTES, 'UTF-8') . '" target="_blank">
                                    <img src="' . htmlspecialchars($img['file_path'], ENT_QUOTES, 'UTF-8') . '" class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                                </a>
                            </div>
                        ', $images)) . '
                    </div>
                </div>' : '') . '
            </div>
        </div>';

        return $html;
    }
    private function getVrticiContent(string $type, string $locale, array $structure): string
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

        $labels = $this->getLabelsFromStructure($type, $structure, $locale);
        $typeData = $this->getTypeData($type, $structure, $locale);
        $typeName = $typeData['name'] ?? 'Vrtić';

        $images = \App\Models\Image::fetchByElement($id);

        $title = $fields['title'][$locale] ?? $typeName;

        $location = $fields['location'][$locale] ?? '';
        $description = $fields['description'][$locale] ?? '';

        $coverImage = '';
        if (isset($fields['slika'][$locale]) && !empty($fields['slika'][$locale])) {
            $coverImage = htmlspecialchars($fields['slika'][$locale], ENT_QUOTES, 'UTF-8');
        } elseif (!empty($images)) {
            $coverImage = htmlspecialchars($images[0]['file_path'], ENT_QUOTES, 'UTF-8');
        }

        $html = '
        <div class="content-wrapper vrtici-detail font-body text-secondary_text">
            <div class="container mx-auto px-4 py-6 max-w-4xl">
                <div class="bg-bacground rounded-2xl shadow p-6">
                    ' . ($coverImage ? '
                    <div class="mb-6">
                        <img src="' . $coverImage . '" alt="' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '"
                            class="w-full h-80 object-cover rounded-2xl shadow-sm">
                    </div>' : '') . '
                    <h1 class="text-3xl mb-2">
                        ' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '
                    </h1>
                    ' . ($location ? '
                    <p class="text-lg mb-4">
                        <i class="fas fa-map-marker-alt text-primary mr-2"></i>' . htmlspecialchars($location, ENT_QUOTES, 'UTF-8') . '
                    </p>' : '') . '
                    ' . ($description ? '
                    <div class="leading-relaxed mb-6">
                        ' . nl2br(htmlspecialchars($description, ENT_QUOTES, 'UTF-8')) . '
                    </div>' : '') . '
                </div>
                ' . (!empty($images) ? '
                <div class="mt-8">
                    <h2 class="text-2xl text-primary_text mb-4">
                        <i class="fas fa-images mr-2 text-blue-500"></i>' . ($this->getGalleryLabel($locale)) . '
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        ' . implode('', array_map(fn($img) => '
                            <div class="gallery-item overflow-hidden rounded-xl shadow-sm">
                                <a href="' . htmlspecialchars($img['file_path'], ENT_QUOTES, 'UTF-8') . '" target="_blank">
                                    <img src="' . htmlspecialchars($img['file_path'], ENT_QUOTES, 'UTF-8') . '" class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                                </a>
                            </div>
                        ', $images)) . '
                    </div>
                </div>' : '') . '
            </div>
        </div>';

        return $html;
    }

    private function getTimoviContent(string $type, string $locale, array $structure): string
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

        $labels = $this->getLabelsFromStructure($type, $structure, $locale);
        $typeData = $this->getTypeData($type, $structure, $locale);
        $typeName = $typeData['name'] ?? $type;

        $images = \App\Models\Image::fetchByElement($id);

        $title = '';
        foreach ($fields as $field => $values) {
            if (in_array(strtolower($field), ['title', 'naziv']) && isset($values[$locale])) {
                $title = htmlspecialchars($values[$locale], ENT_QUOTES, 'UTF-8');
                break;
            }
        }

        $naziv = '';
        $opis = '';
        foreach ($fields as $field => $values) {
            if (!isset($values[$locale]))
                continue;
            $value = trim($values[$locale]);
            if ($value === '')
                continue;

            if (in_array(strtolower($field), ['opis', 'description'])) {
                $opis = nl2br(htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
            }
        }

        $html = '
        <div class="content-wrapper min-h-screen">
            <div>
                <div class="container mx-auto px-4">
                    <div class="max-w-3xl mx-auto text-center">
                        <h1 class="text-3xl font-heading text-primary_text mb-4">' . ($title ?: $typeName) . '</h1>
                    </div>
                </div>
            </div>

            <div class="container mx-auto px-4 py-6">
                <div class="max-w-3xl mx-auto bg-surface rounded-2xl shadow-lg p-8">
        ';

        if ($opis !== '') {
            $html .= '
                    <div class="text-center mb-8">
                        ' . ($opis ? '<p class="text-secondary_text font-body leading-relaxed">' . $opis . '</p>' : '') . '
                    </div>';
        }

        if (!empty($images)) {
            $galleryLabel = $this->getGalleryLabel($locale);
            $html .= '<div class="mt-8">
                        <h3 class="text-xl font-heading text-primary_text mb-4"><i class="fas fa-images mr-2"></i>' . $galleryLabel . '</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">';
            foreach ($images as $img) {
                $path = htmlspecialchars($img['file_path'], ENT_QUOTES, 'UTF-8');
                $html .= '<a href="' . $path . '" class="block overflow-hidden rounded-xl shadow hover:shadow-lg transition-all">
                            <img src="' . $path . '" class="w-full h-48 object-cover" alt="Team image">
                        </a>';
            }
            $html .= '</div></div>';
        }

        $html .= '
                </div>
            </div>
        </div>';

        return $html;
    }

    private function getProjektiContent(string $type, string $locale, array $structure): string
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

        $labels = $this->getLabelsFromStructure($type, $structure, $locale);
        $typeData = $this->getTypeData($type, $structure, $locale);
        $typeName = $typeData['name'] ?? 'Projekat';

        $images = \App\Models\Image::fetchByElement($id);

        $title = $fields['naziv'][$locale] ?? $typeName;
        $vodja = $fields['vodja'][$locale] ?? '';
        $opis = $fields['opis'][$locale] ?? '';
        $datumPocetka = $fields['datumPocetka'][$locale] ?? '';
        $budzet = $fields['budzet'][$locale] ?? '';
        $link = $fields['link'][$locale] ?? '';
        $sekcija = $fields['sekcija'][$locale] ?? '';

        $coverImage = '';
        if (isset($fields['slika'][$locale]) && !empty($fields['slika'][$locale])) {
            $coverImage = htmlspecialchars($fields['slika'][$locale], ENT_QUOTES, 'UTF-8');
        } elseif (!empty($images)) {
            $coverImage = htmlspecialchars($images[0]['file_path'], ENT_QUOTES, 'UTF-8');
        }

        $formattedDatum = '';
        if ($datumPocetka) {
            $parts = explode('-', $datumPocetka);
            if (count($parts) === 3) {
                $formattedDatum = $parts[2] . '.' . $parts[1] . '.' . $parts[0];
            } else {
                $formattedDatum = $datumPocetka;
            }
        }

        $formattedBudzet = '';
        if ($budzet && is_numeric($budzet)) {
            $formattedBudzet = number_format((float) $budzet, 2, ',', '.') . ' €';
        }

        $html = '
        <div class="content-wrapper projekti-detail font-body">
            <div class="container mx-auto px-4 py-6 max-w-4xl">
                <div class="bg-bacground rounded-2xl shadow p-6 bg-surface">
                    ' . ($coverImage ? '
                    <div class="mb-6">
                        <img src="' . $coverImage . '" alt="' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '"
                            class="w-full h-80 object-cover rounded-2xl shadow-sm">
                    </div>' : '') . '

                    <h1 class="text-3xl font-heading text-primary_text mb-4">
                        ' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '
                    </h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        ' . ($vodja ? '
                        <div class="bg-white rounded-lg p-4">
                            <div class="flex items-center text-primary_text">
                                <i class="fas fa-user-tie text-primary mr-3 text-lg"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Vođa projekta</p>
                                    <p class="text-lg text-sedondary_text">' . htmlspecialchars($vodja, ENT_QUOTES, 'UTF-8') . '</p>
                                </div>
                            </div>
                        </div>' : '') . '

                        ' . ($formattedDatum ? '
                        <div class="bg-white rounded-lg p-4">
                            <div class="flex items-center text-primary_text">
                                <i class="fas fa-calendar-alt text-primary mr-3 text-lg"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Datum početka</p>
                                    <p class="text-lg">' . htmlspecialchars($formattedDatum, ENT_QUOTES, 'UTF-8') . '</p>
                                </div>
                            </div>
                        </div>' : '') . '

                        ' . ($formattedBudzet ? '
                        <div class="bg-white rounded-lg p-4">
                            <div class="flex items-center text-primary_text">
                                <i class="fas fa-euro-sign text-primary mr-3 text-lg"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Budžet</p>
                                    <p class="text-lg">' . htmlspecialchars($formattedBudzet, ENT_QUOTES, 'UTF-8') . '</p>
                                </div>
                            </div>
                        </div>' : '') . '

                        ' . ($sekcija ? '
                        <div class="bg-white rounded-lg p-4">
                            <div class="flex items-center text-primary_text">
                                <i class="fas fa-sitemap text-primary mr-3 text-lg"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Sekcija centra</p>
                                    <p class="text-lg">' . htmlspecialchars($sekcija, ENT_QUOTES, 'UTF-8') . '</p>
                                </div>
                            </div>
                        </div>' : '') . '
                    </div>

                    ' . ($opis ? '
                    <div class="bg-white border border-gray-200 rounded-xl p-6 mb-6">
                        <h2 class="text-xl text-primary_text mb-4 flex items-center">
                            <i class="fas fa-file-alt text-primary mr-2"></i>
                            Opis projekta
                        </h2>
                        <div class="text-primary_text leading-relaxed text-lg">
                            ' . nl2br(htmlspecialchars($opis, ENT_QUOTES, 'UTF-8')) . '
                        </div>
                    </div>' : '') . '

                    ' . ($link ? '
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 mb-6 border border-blue-200">
                        <h2 class="text-xl text-primary_text mb-4 flex items-center">
                            <i class="fas fa-external-link-alt text-primary mr-2"></i>
                            Zvanični link
                        </h2>
                        <a href="' . htmlspecialchars($link, ENT_QUOTES, 'UTF-8') . '"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors duration-300 font-medium">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Posetite zvaničnu stranicu projekta
                        </a>
                    </div>' : '') . '
                </div>

                ' . (!empty($images) ? '
                <div class="mt-8">
                    <h2 class="text-2xl text-primary_text mb-6 flex items-center">
                        <i class="fas fa-images text-primary mr-2"></i>
                        ' . ($this->getGalleryLabel($locale)) . '
                    </h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        ' . implode('', array_map(fn($img) => '
                            <div class="gallery-item overflow-hidden rounded-xl shadow-sm border border-gray-200">
                                <a href="' . htmlspecialchars($img['file_path'], ENT_QUOTES, 'UTF-8') . '"
                                target="_blank"
                                class="block overflow-hidden">
                                    <img src="' . htmlspecialchars($img['file_path'], ENT_QUOTES, 'UTF-8') . '"
                                        alt="' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '"
                                        class="w-full h-48 object-cover hover:scale-110 transition-transform duration-300">
                                </a>
                            </div>
                        ', $images)) . '
                    </div>
                </div>' : '') . '
            </div>
        </div>';

        return $html;
    }

    private function getZaposleniContent(string $type, string $locale, array $structure): string
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

        $ime = $fields['ime'][$locale] ?? '';
        $pozicija = $fields['pozicija'][$locale] ?? '';
        $biografija = $fields['biografija'][$locale] ?? '';
        $kontakt = $fields['kontakt'][$locale] ?? '';
        $slika = $fields['slika'][$locale] ?? '';

        $labels = $this->getLabelsFromStructure($type, $structure, $locale);
        $fieldIcons = $this->getFieldIcons($type, $structure);

        $labelIme = $labels['ime'] ?? 'Ime i prezime';
        $labelPozicija = $labels['pozicija'] ?? 'Pozicija';
        $labelBio = $labels['biografija'] ?? 'Biografija';
        $labelEmail = $labels['kontakt'] ?? 'Email kontakt';

        $allFiles = \App\Models\Image::fetchByElement($id);

        $images = array_filter(
            $allFiles,
            fn($file) =>
            !in_array(strtolower(pathinfo($file['file_path'], PATHINFO_EXTENSION)), ['pdf', 'xlsx', 'xls', 'doc', 'docx'])
        );

        if (!$slika && !empty($images)) {
            $slika = $images[0]['file_path'];
        }

        $html = '
    <div class="content-wrapper">
        <div class="page-header">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <h1>' . htmlspecialchars($ime ?: "Zaposleni", ENT_QUOTES, "UTF-8") . '</h1>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-3">
            <div class="max-w-4xl mx-auto">

                <div class="fields-grid">

                    <div class="field-row full-width">
                        <span class="field-label">
                            <i class="' . $this->getFieldIcon("slika", $fieldIcons) . '"></i>Fotografija
                        </span>
                        <span class="field-value">
                            ' . ($slika ? '
                                <img src="' . htmlspecialchars($slika, ENT_QUOTES, "UTF-8") . '"
                                     class="w-48 h-auto rounded-xl shadow" />'
            : 'Nema fotografije') . '
                        </span>
                    </div>

                    <div class="field-row">
                        <span class="field-label"><i class="' . $this->getFieldIcon("ime", $fieldIcons) . '"></i>' . $labelIme . '</span>
                        <span class="field-value">' . htmlspecialchars($ime, ENT_QUOTES, "UTF-8") . '</span>
                    </div>

                    <div class="field-row">
                        <span class="field-label"><i class="' . $this->getFieldIcon("pozicija", $fieldIcons) . '"></i>' . $labelPozicija . '</span>
                        <span class="field-value">' . htmlspecialchars($pozicija, ENT_QUOTES, "UTF-8") . '</span>
                    </div>

                    ' . (!empty($kontakt) ? '
                    <div class="field-row">
                        <span class="field-label"><i class="' . $this->getFieldIcon("kontakt", $fieldIcons) . '"></i>' . $labelEmail . '</span>
                        <span class="field-value">
                            <a href="mailto:' . htmlspecialchars($kontakt, ENT_QUOTES, "UTF-8") . '" class="text-blue-600 underline">'
            . htmlspecialchars($kontakt, ENT_QUOTES, "UTF-8") .
            '</a>
                        </span>
                    </div>' : '') . '

                    ' . (!empty($biografija) ? '
                    <div class="field-row full-width">
                        <span class="field-label"><i class="' . $this->getFieldIcon("biografija", $fieldIcons) . '"></i>' . $labelBio . '</span>
                        <span class="field-value">' . nl2br(htmlspecialchars($biografija, ENT_QUOTES, "UTF-8")) . '</span>
                    </div>' : '') . '

                </div>
    ';

        if (count($images) > 1) {
            $html .= '
            <div class="section-divider"></div>
            <div class="gallery-header"><i class="fas fa-images"></i>Galerija</div>
            <div class="gallery-grid">';

            foreach ($images as $img) {
                $imgPath = htmlspecialchars($img["file_path"], ENT_QUOTES, "UTF-8");

                $html .= '
                <div class="gallery-item">
                    <a href="' . $imgPath . '" class="gallery-image-link block">
                        <img src="' . $imgPath . '" alt="">
                        <div class="gallery-overlay">
                            <i class="fas fa-search-plus text-white text-xl"></i>
                        </div>
                    </a>
                </div>';
            }

            $html .= '</div>';
        }

        $html .= '
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

        // Allowed document extensions
        $docExtensions = ['pdf', 'xls', 'xlsx', 'doc', 'docx'];

        // Fetch all attached files/images
        $allFiles = \App\Models\Image::fetchByElement($id);

        // Separate images and documents
        $images = array_filter($allFiles, function ($file) use ($docExtensions) {
            $ext = strtolower(pathinfo($file['file_path'], PATHINFO_EXTENSION));
            return !in_array($ext, $docExtensions);
        });

        $files = array_filter($allFiles, function ($file) use ($docExtensions) {
            $ext = strtolower(pathinfo($file['file_path'], PATHINFO_EXTENSION));
            return in_array($ext, $docExtensions);
        });

        // Also check for file URLs inside fields
        foreach ($fields as $fieldValues) {
            foreach ($fieldValues as $value) {
                if (!is_string($value))
                    continue;
                $ext = strtolower(pathinfo($value, PATHINFO_EXTENSION));
                if (in_array($ext, $docExtensions)) {
                    $files[] = ['file_path' => $value];
                }
            }
        }

        // Get labels and icons
        $labels = $this->getLabelsFromStructure($type, $structure, $locale);
        $fieldIcons = $this->getFieldIcons($type, $structure);
        $typeData = $this->getTypeData($type, $structure, $locale);
        $typeName = $typeData['name'] ?? $type;

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
    <div class="page-header">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h1>' . ($title ?: $typeName) . '</h1>
            </div>
        </div>
    </div>
    <div class="container mx-auto px-4 py-3">
        <div class="max-w-4xl mx-auto">
            <div class="fields-grid">';

        // Display fields in grid
        foreach ($fields as $field => $values) {
            if ($field === $titleField || !isset($values[$locale])) {
                continue;
            }

            $value = $values[$locale];
            if (empty(trim($value))) {
                continue;
            }

            $displayLabel = $labels[$field] ?? ucwords(str_replace('_', ' ', $field));
            $icon = $this->getFieldIcon($field, $fieldIcons);

            // Escape vrednosti za HTML
            $escapedValue = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

            // Ako je dug tekst, pretvori \n u dupli <br>
            $isLongText = strlen($value) > 100;
            if ($isLongText) {
                $escapedValue = str_replace("\n", "<br><br>", $escapedValue);
            }

            $fullWidthClass = $isLongText ? ' full-width' : '';

            // Generisanje HTML-a
            $html .= '
        <div class="field-row' . $fullWidthClass . '">
            <span class="field-label"><i class="' . $icon . '"></i> ' .
                htmlspecialchars($displayLabel, ENT_QUOTES, 'UTF-8') . '
            </span>
            <span class="field-value">' . $escapedValue . '</span>
        </div>';
        }



        $html .= '</div>'; // Close fields-grid

        // Display downloadable documents with icons
        if (!empty($files)) {
            $documentsLabel = $this->getDocumentsLabel($locale);
            $html .= '
            <div class="section-divider"></div>
            <div class="documents-section">
                <h2 class="documents-header"><i class="fas fa-file-download"></i>' . $documentsLabel . '</h2>
                <div class="documents-grid">';

            foreach ($files as $file) {
                $filePath = $file['file_path'];
                $fileName = basename($filePath);
                $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                $iconData = $this->getDocumentIcon($extension);
                $fileSize = $this->formatFileSize($filePath);

                $escapedPath = htmlspecialchars($filePath, ENT_QUOTES, 'UTF-8');
                $escapedName = htmlspecialchars($fileName, ENT_QUOTES, 'UTF-8');

                $html .= '
                    <a href="' . $escapedPath . '" target="_blank" class="document-card" download>
                        <div class="document-icon ' . $iconData['class'] . '">
                            <i class="' . $iconData['icon'] . '"></i>
                        </div>
                        <div class="document-info">
                            <div class="document-name" title="' . $escapedName . '">' . $escapedName . '</div>
                            ' . ($fileSize ? '<div class="document-size">' . $fileSize . '</div>' : '') . '
                        </div>
                        <i class="fas fa-download document-download"></i>
                    </a>';
            }

            $html .= '</div></div>';
        }

        // Display image gallery
        if (!empty($images)) {
            $galleryLabel = $this->getGalleryLabel($locale);
            $html .= '
            <div class="section-divider"></div>
            <div class="gallery-header"><i class="fas fa-images"></i>' . $galleryLabel . '</div>
            <div class="gallery-grid">';

            foreach ($images as $img) {
                $imgPath = htmlspecialchars($img['file_path'], ENT_QUOTES, 'UTF-8');
                $html .= '
                <div class="gallery-item">
                    <a href="' . $imgPath . '" class="gallery-image-link block">
                        <img src="' . $imgPath . '" alt="Gallery image">
                        <div class="gallery-overlay">
                            <i class="fas fa-search-plus text-white text-xl"></i>
                        </div>
                    </a>
                </div>';
            }
            $html .= '</div>';
        }

        $html .= '
        </div>
    </div>
</div>';

        return $html;
    }

    private function getFieldIcon(string $fieldName, array $fieldIcons): string
    {
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

        $structureData = $structure[0] ?? [];

        // Normalize keys to lowercase for case-insensitive comparison
        $lowercaseStructureData = [];
        foreach ($structureData as $key => $value) {
            $lowercaseStructureData[strtolower($key)] = $value;
        }

        $typeLower = strtolower($type);

        if (!isset($lowercaseStructureData[$typeLower]) || !isset($lowercaseStructureData[$typeLower]['fields'])) {
            return $labels;
        }

        foreach ($lowercaseStructureData[$typeLower]['fields'] as $field) {
            $name = $field['name'] ?? null;
            if (!$name) {
                continue;
            }

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

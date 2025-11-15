<?php
session_start();
use App\Models\PageLoader;
use \App\Utils\LocaleManager;
        use App\Models\AboutUs;

$dataAboutUS = new AboutUs();
$locale = LocaleManager::get();
$dataTitle = $dataAboutUS->list($locale);
$groupedPages = PageLoader::getGroupedStaticPages();


use App\Models\Text;
// Load dynamic texts
$textModel = new Text();
$dynamicText = $textModel->getDynamicText($locale);




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$dataTitle['title']?> </title>
    <link rel="icon" type="image/png" href="/assets/icons/icon.png?v=<?= time() ?>">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="/exportedPages/commonStyle.css" rel="stylesheet" />
    
    <script>
    </script><style>

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
        
</style></head>
<body class="min-h-screen flex flex-col">

<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';
require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';
?>

<main class="min-h-screen pt-16 bg-white">    <div class="content-wrapper">
        <div class="page-header">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto text-center">
                    <h1>dsa</h1>
                    <p class="text-gray-600 text-sm mt-1">Molimo vas da popunite anketu u nastavku</p>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-4">
            <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
                <iframe 
                    src="https://docs.google.com/forms/d/e/1FAIpQLSelwsfa3K8wdLtp2j-07yTndj-rjxecEgBdIcpifM_TxoFSOw/viewform?usp=dialog" 
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
    </div></main>
<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';
?>

<script src="/exportedPages/commonScript.js?v=<?php echo time(); ?>"></script>
</body>
</html>

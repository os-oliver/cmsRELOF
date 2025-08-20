<?php
use App\Controllers\AuthController;
use App\Controllers\VisitCounterController;
use App\Models\Document;
use App\Models\User;
use App\Models\Event;

$documentModal = new Document;
$eventModel = new Event;

AuthController::requireEditor();
[$name, $surname, $role] = AuthController::getUserInfo();
error_log($name);

$views = (new VisitCounterController())->getVisitCount();
[$_, $totalUsers] = (new User())->list();
$categories = $eventModel->getCategories();
[$events, $totalEvents] = $eventModel->all();
[$documents, $totalDocuments] = $documentModal->list(3);
$DocumentCategories = $documentModal->getCategories();
if (isset($_GET['locale'])) {
    $_SESSION['locale'] = $_GET['locale'];
}
$locale = $_SESSION['locale'] ?? 'sr-Cyrl';
?>
<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php switch ($locale) {
            case 'sr': echo "Kontrolni panel - Administracija"; break;
            case 'en': echo "Control panel - Administration"; break;
            default: echo "Контролни панел - Администрација"; break;
        } ?>
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/dashboard/structure.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="/assets/js/dashboard/tailwindConf.js"></script>
</head>

<body class="bg-gradient-to-br from-light-100 to-light-200 text-gray-700 font-sans">
    <div class="overlay" id="overlay"></div>

    <?php require_once __DIR__ . '/../components/eventsInputForm.php' ?>
    <?php require_once __DIR__ . '/../components/documentInputForm.php' ?>

    <div class="flex h-screen overflow-hidden">
        <?php
        $activeTab = "dashboard";
        require_once __DIR__ . "/../components/sidebar.php";
        ?>

        <div class="flex-1 flex flex-col overflow-hidden">
            <?php require_once __DIR__ . "/../components/topBar.php" ?>

            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">
                    <div class="stat-card p-4 md:p-5 rounded-xl border border-gray-200 transition-all duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-primary-600">
                                    <?php
                                    switch ($locale) {
                                        case 'sr': echo 'Ukupno pregleda'; break;
                                        case 'en': echo 'Total views'; break;
                                        default: echo 'Укупно прегледа'; break;
                                    }
                                    ?>
                                </p>
                                <p class="text-xl md:text-2xl font-bold text-gray-800 mt-1"><?= $views ?></p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-lg">
                                <i class="fas fa-eye text-primary-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card p-4 md:p-5 rounded-xl border border-gray-200 transition-all duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-primary-600">
                                    <?php switch ($locale) {
                                        case 'sr': echo 'Dokumenti'; break;
                                        case 'en': echo 'Documents'; break;
                                        default: echo 'Документи'; break;
                                    } ?>
                                </p>
                                <p class="text-xl md:text-2xl font-bold text-gray-800 mt-1"><?= $totalDocuments ?></p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-lg">
                                <i class="fas fa-file-alt text-primary-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card p-4 md:p-5 rounded-xl border border-gray-200 transition-all duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-primary-600">
                                    <?php switch ($locale) {
                                        case 'sr': echo 'Događaji'; break;
                                        case 'en': echo 'Events'; break;
                                        default: echo 'Догађаји'; break;
                                    } ?>
                                </p>
                                <p class="text-xl md:text-2xl font-bold text-gray-800 mt-1"><?= $totalEvents ?></p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-lg">
                                <i class="fas fa-calendar-alt text-primary-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card p-4 md:p-5 rounded-xl border border-gray-200 transition-all duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-primary-600">
                                    <?php switch ($locale) {
                                        case 'sr': echo 'Korisnici'; break;
                                        case 'en': echo 'Users'; break;
                                        default: echo 'Корисници'; break;
                                    } ?>
                                </p>
                                <p class="text-xl md:text-2xl font-bold text-gray-800 mt-1"><?= $totalUsers ?></p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-lg">
                                <i class="fas fa-users text-primary-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <?php require_once __DIR__ . "/../components/documents.php" ?>
                    <?php require_once __DIR__ . "/../components/events.php" ?>
                </div>
            </main>
        </div>
    </div>

    <script src="/assets/js/dashboard/dashboard.js" defer></script>
    <script src="/assets/js/dashboard/mobileMenu.js" defer></script>

</body>

</html>
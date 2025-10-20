<?php

use App\Models\Content;
use App\Utils\HashMapTransformer;
session_start();
use App\Controllers\AuthController;
use App\Controllers\VisitCounterController;
use App\Models\Document;
use App\Models\User;


AuthController::requireEditor();
[$name, $surname, $role] = AuthController::getUserInfo();
error_log($name);
if (isset($_GET['locale'])) {
    $_SESSION['locale'] = $_GET['locale'];
}
$locale = $_SESSION['locale'] ?? 'sr-Cyrl';
$views = (new VisitCounterController())->getVisitCount();
[$_, $totalUsers] = (new User())->list();
$events_raw = (new Content())->fetchListData('dogadjaji', '', 0, 3, null, $locale)['items'];
$events = HashMapTransformer::transform($events_raw, $locale);
$documentModal = new Document();
[$documents, $totalDocuments] = $documentModal->list(
    limit: 3,
    offset: 0,
    search: '',
    lang: $locale
);
$DocumentCategories = $documentModal->getCategories($locale);
?>
<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= __("dashboard.admin_panel") ?>
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/dashboard/structure.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="/assets/js/dashboard/tailwindConf.js"></script>
</head>

<body class="bg-gradient-to-br from-light-100 to-light-200 text-gray-700 font-sans">
    <div class="overlay" id="overlay"></div>

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
                    <?php require_once __DIR__ . "/../components/transparencyScore.php" ?>

                    <div class="stat-card p-4 md:p-5 rounded-xl border border-gray-200 transition-all duration-300">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm text-primary-600">
                                    <?= __("dashboard.documents") ?>
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
                                    <?= __("dashboard.events") ?>
                                </p>
                                <p class="text-xl md:text-2xl font-bold text-gray-800 mt-1"><?= count($events) ?></p>
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
                                    <?= __("dashboard.users") ?>
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
    <script type="module" defer>
        import ModalManager from "/assets/js/dashboard/modalManager.js";

        // Kreiramo default instancu koja se može koristiti i eksterno
        const defaultManager = new ModalManager({
            slug: "Dogadjaji",
        });
        if (typeof window !== "undefined") {
            // Delay init until DOMContentLoaded da bi elementi bili prisutni
            if (document.readyState === "loading") {
                document.addEventListener("DOMContentLoaded", () => init());
            } else {
                init();
            }
        }

        export function init({
            slug = null,
            newBtnSelector = "#newEventButton",
            baseUrl = "/editor",
        } = {}) {
            if (slug) defaultManager.slug = slug;
            defaultManager.baseUrl = baseUrl;

            const newBtn = document.querySelector(newBtnSelector);
            newBtn?.addEventListener("click", async (e) => {
                e.preventDefault();
                const btn = e.currentTarget;
                btn.disabled = true;

                try {
                    const html = await defaultManager.fetchModal();
                    defaultManager.show(html);
                } catch (err) {
                    console.error("Modal error:", err);
                    alert("Greška pri učitavanju modalnog prozora: " + (err.message || err));
                } finally {
                    btn.disabled = false;
                }
            });


        }

    </script>
</body>

</html>
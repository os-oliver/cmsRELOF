<?php
session_start();
use App\Models\Gallery;
use App\Models\PageLoader;
use App\Utils\HashMapTransformer;
if (isset($_GET['locale'])) {
    $_SESSION['locale'] = $_GET['locale'];
}
$locale = $_SESSION['locale'] ?? 'sr-Cyrl';
use App\Models\Event;
use App\Models\Text;
use App\Models\Content;
use App\Models\AboutUs;
$dataAboutUS = new AboutUs();
$aboutUsData = $dataAboutUS->list($locale);

// Load dynamic texts
$textModel = new Text();
$dynamicText = $textModel->getDynamicText($locale);
$fondovi_raw = (new Content())->fetchListData('fondovi', '', 0, 9, null, $locale)['items'];
$fondovi = HashMapTransformer::transform($fondovi_raw, $locale);



[$images, $totalEvents] = (new Gallery)->list();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="/assets/icons/icon.png?v=<?= time() ?>">

<title><?=$aboutUsData['title']?></title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
<link href="/exportedPages/commonStyle.css" rel="stylesheet" />
<script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="min-h-screen flex flex-col">
<?php require_once __DIR__ . '/landingPageComponents/landingPage/header.php'; ?>

<main class="flex-grow">
<?php require_once __DIR__ . '/landingPageComponents/landingPage/divmobileMenu.php'; ?>
<?php require_once __DIR__ . '/landingPageComponents/landingPage/ii8xha.php'; ?>
<?php require_once __DIR__ . '/landingPageComponents/landingPage/fondovi.php'; ?>
<?php require_once __DIR__ . '/landingPageComponents/landingPage/ijd3mi.php'; ?>
<?php require_once __DIR__ . '/landingPageComponents/landingPage/vesti.php'; ?>
</main>
<?php require_once __DIR__ . '/landingPageComponents/landingPage/footer.php'; ?><script src="/exportedPages/commonScript.js?v=<?php echo time(); ?>"></script>

</div>
</body>
</html>
<?php
session_start();
use App\Models\PageLoader;
use \App\Utils\LocaleManager;
$locale = LocaleManager::get();
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
    <title>basic</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'clay': '#c97c5d',
                        'ochre': '#d4a373',
                        'sage': '#a3b18a',
                        'slate': '#344e41',
                        'paper': '#f5ebe0',
                        'terracotta': '#bc6c25',
                        'coral': '#e76f51',
                        'deep-teal': '#2a9d8f',
                        'crimson': '#8d1b3d',
                        'royal-blue': '#1a4480',
                        'velvet': '#4a154b',
                        ochre: '#CC7722',
                        terracotta: '#E2725B',
                        paper: '#F5F5DC',
                        slate: '#2F4F4F',
                        'royal-blue': '#4169E1',
                        'deep-teal': '#008B8B',
                        velvet: '#872657',
                        crimson: '#DC143C',
                        coral: '#FF7F50',
                        sage: '#9CAF88'
                    },
                    fontFamily: {
                        'display': ['Playfair Display', 'serif'],
                        'crimson': ['Crimson Pro', 'serif'],
                        'body': ['Raleway', 'sans-serif'],
                    },
                    backgroundImage: {
                        'art-pattern': "url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmNWViZTAiPjxwYXRoIGQ9Ik0wIDBoNDB2NDBIMHoiLz48L2c+PHBhdGggZD0iTTAgMGg0MHY0MEgweiIgZmlsbD0idXJsKCNhKSIvPjxwYXRoIGQ9Ik0wIDBoMjB2MjBIMHoiIGZpbGw9IiNkNGExYjEiIG9wYWNpdHk9Ii4xIi8+PHBhdGggZD0iTTIwIDBoMjB2MjBIMjB6IiBmaWxsPSIjYTNiMThhIiBvcGFjaXR5PSIuMSIvPjxwYXRoIGQ9Ik0wIDIwaDIwdjIwSDB6IiBmaWxsPSIjYjk3YzVkIiBvcGFjaXR5PSIuMSIvPjxwYXRoIGQ9Ik0yMCAyMGgyMHYyMEgyMHoiIGZpbGw9IiMzNDRlNDEiIG9wYWNpdHk9Ii4xIi8+PC9nPjwvc3ZnPg==')",
                        'brush-stroke': "url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 400 40\" width=\"400\" height=\"40\"><path d=\"M20,20 C50,5 100,35 150,20 C200,5 250,35 300,20 C350,5 380,35 380,20\" fill=\"none\" stroke=\"%23d4a373\" stroke-width=\"10\" stroke-linecap=\"round\"/>')",
                    }
                }
            }
        }
    </script><style>
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

</style></head>
<body class="min-h-screen flex flex-col">

<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';
require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';
?>

<main class="min-h-screen pt-24 flex-grow">


<section class="py-20 bg-gray-50"><div class="container mx-auto px-6"><div class="text-center mb-16"><h2 class="text-4xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($dynamicText['t_dsa_1ae95c_05a6ca']['text'] ?? 'Zašto Izabrati Nas?', ENT_QUOTES, 'UTF-8'); ?></h2><p class="text-xl text-gray-600 max-w-2xl mx-auto"><?= htmlspecialchars($dynamicText['t_dsa_400676_f600e8']['text'] ?? 'Nudimo najbolje usluge sa modernim pristupom i profesionalnim timom', ENT_QUOTES, 'UTF-8'); ?></p></div><div class="grid md:grid-cols-3 gap-8"><div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2"><div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mb-6 mx-auto"><i class="fas fa-rocket text-white text-2xl"></i></div><h3 class="text-2xl font-bold text-gray-800 mb-4 text-center"><?= htmlspecialchars($dynamicText['t_dsa_a53e79_afb71d']['text'] ?? 'Brza Implementacija', ENT_QUOTES, 'UTF-8'); ?></h3><p class="text-gray-600 text-center"><?= htmlspecialchars($dynamicText['t_dsa_a5fb6b_faff10']['text'] ?? 'Realizujemo projekte brzo i efikasno, bez kompromisa u kvalitetu.', ENT_QUOTES, 'UTF-8'); ?></p></div><div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2"><div class="w-16 h-16 bg-gradient-to-r from-green-500 to-blue-500 rounded-full flex items-center justify-center mb-6 mx-auto"><i class="fas fa-shield-alt text-white text-2xl"></i></div><h3 class="text-2xl font-bold text-gray-800 mb-4 text-center"><?= htmlspecialchars($dynamicText['t_dsa_a612cb_6dc6be']['text'] ?? 'Sigurnost', ENT_QUOTES, 'UTF-8'); ?></h3><p class="text-gray-600 text-center"><?= htmlspecialchars($dynamicText['t_dsa_670cea_019efa']['text'] ?? 'Vaši podaci su sigurni uz najnovije sigurnosne protokole.', ENT_QUOTES, 'UTF-8'); ?></p></div><div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2"><div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mb-6 mx-auto"><i class="fas fa-users text-white text-2xl"></i></div><h3 class="text-2xl font-bold text-gray-800 mb-4 text-center"><?= htmlspecialchars($dynamicText['t_dsa_e8101e_0249af']['text'] ?? '24/7 Podrška', ENT_QUOTES, 'UTF-8'); ?></h3><p class="text-gray-600 text-center"><?= htmlspecialchars($dynamicText['t_dsa_e2f2c7_a2db76']['text'] ?? 'Naš tim je uvek dostupan za pomoć i podršku.', ENT_QUOTES, 'UTF-8'); ?></p></div></div></div></section>
</main>
<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';
?>

</body>
</html>

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
    </script></head>
<body class="min-h-screen flex flex-col">

<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';
require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';
?>

<main class="min-h-screen pt-24 flex-grow">


<section class="py-20 bg-gray-50"><div class="container mx-auto px-6"><div class="text-center mb-16"><h2 class="text-4xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($dynamicText['t_linktekst_1ae95c_05a6ca']['text'] ?? 'Zašto Izabrati Nas?', ENT_QUOTES, 'UTF-8'); ?></h2><p class="text-xl text-gray-600 max-w-2xl mx-auto"><?= htmlspecialchars($dynamicText['t_linktekst_400676_f600e8']['text'] ?? 'Nudimo najbolje usluge sa modernim pristupom i profesionalnim timom', ENT_QUOTES, 'UTF-8'); ?></p></div><div class="grid md:grid-cols-3 gap-8"><div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2"><div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mb-6 mx-auto"><i class="fas fa-rocket text-white text-2xl"></i></div><h3 class="text-2xl font-bold text-gray-800 mb-4 text-center"><?= htmlspecialchars($dynamicText['t_linktekst_a53e79_afb71d']['text'] ?? 'Brza Implementacija', ENT_QUOTES, 'UTF-8'); ?></h3><p class="text-gray-600 text-center"><?= htmlspecialchars($dynamicText['t_linktekst_a5fb6b_faff10']['text'] ?? 'Realizujemo projekte brzo i efikasno, bez kompromisa u kvalitetu.', ENT_QUOTES, 'UTF-8'); ?></p></div><div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2"><div class="w-16 h-16 bg-gradient-to-r from-green-500 to-blue-500 rounded-full flex items-center justify-center mb-6 mx-auto"><i class="fas fa-shield-alt text-white text-2xl"></i></div><h3 class="text-2xl font-bold text-gray-800 mb-4 text-center"><?= htmlspecialchars($dynamicText['t_linktekst_a612cb_37959b']['text'] ?? 'turizam', ENT_QUOTES, 'UTF-8'); ?></h3><p class="text-gray-600 text-center"><?= htmlspecialchars($dynamicText['t_linktekst_670cea_019efa']['text'] ?? 'Vaši podaci su sigurni uz najnovije sigurnosne protokole.', ENT_QUOTES, 'UTF-8'); ?></p></div><div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 transform hover:-translate-y-2"><div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mb-6 mx-auto"><i class="fas fa-users text-white text-2xl"></i></div><h3 class="text-2xl font-bold text-gray-800 mb-4 text-center"><?= htmlspecialchars($dynamicText['t_linktekst_e8101e_0249af']['text'] ?? '24/7 Podrška', ENT_QUOTES, 'UTF-8'); ?></h3><p class="text-gray-600 text-center"><?= htmlspecialchars($dynamicText['t_linktekst_e2f2c7_a2db76']['text'] ?? 'Naš tim je uvek dostupan za pomoć i podršku.', ENT_QUOTES, 'UTF-8'); ?></p></div></div></div></section><section class="py-20 bg-gray-900"><div class="container mx-auto px-6"><div class="max-w-4xl mx-auto"><div class="text-center mb-12"><h2 class="text-4xl font-bold text-white mb-4"><?= htmlspecialchars($dynamicText['t_linktekst_3558e0_fe6e2c']['text'] ?? 'Stupite u Kontakt', ENT_QUOTES, 'UTF-8'); ?></h2><p class="text-xl text-gray-400"><?= htmlspecialchars($dynamicText['t_linktekst_34f0c9_572329']['text'] ?? 'Spremni smo da odgovorimo na sva vaša pitanja', ENT_QUOTES, 'UTF-8'); ?></p></div><div class="grid lg:grid-cols-2 gap-12"><div><h3 class="text-2xl font-bold text-white mb-6"><?= htmlspecialchars($dynamicText['t_linktekst_5ccb27_56c067']['text'] ?? 'Pošaljite Poruku', ENT_QUOTES, 'UTF-8'); ?></h3><form class="space-y-6"><div class="grid md:grid-cols-2 gap-6"><input type="text" placeholder="Ime" class="w-full px-4 py-3 bg-gray-800 text-white rounded-lg border border-gray-700 focus:border-blue-500 focus:outline-none transition"><input type="email" placeholder="Email" class="w-full px-4 py-3 bg-gray-800 text-white rounded-lg border border-gray-700 focus:border-blue-500 focus:outline-none transition"></div><input type="text" placeholder="Tema" class="w-full px-4 py-3 bg-gray-800 text-white rounded-lg border border-gray-700 focus:border-blue-500 focus:outline-none transition"><textarea rows="5" placeholder="Vaša poruka..." class="w-full px-4 py-3 bg-gray-800 text-white rounded-lg border border-gray-700 focus:border-blue-500 focus:outline-none transition resize-none"></textarea><button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-bold hover:shadow-xl transform hover:scale-105 transition duration-300"><i class="fas fa-paper-plane mr-2"></i><?= htmlspecialchars($dynamicText['t_linktekst_320639_bf9990']['text'] ?? 'Pošalji Poruku', ENT_QUOTES, 'UTF-8'); ?></button></form></div><div><h3 class="text-2xl font-bold text-white mb-6"><?= htmlspecialchars($dynamicText['t_linktekst_c75921_95ebbf']['text'] ?? 'Kontakt Informacije', ENT_QUOTES, 'UTF-8'); ?></h3><div class="space-y-6"><div class="flex items-center"><div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mr-4"><i class="fas fa-map-marker-alt text-white"></i></div><div><h4 class="text-white font-bold"><?= htmlspecialchars($dynamicText['t_linktekst_c71937_f6999f']['text'] ?? 'Adresa', ENT_QUOTES, 'UTF-8'); ?></h4><p class="text-gray-400"><?= htmlspecialchars($dynamicText['t_linktekst_0ba5c0_665030']['text'] ?? 'Beograd, Srbija 11000', ENT_QUOTES, 'UTF-8'); ?></p></div></div><div class="flex items-center"><div class="w-12 h-12 bg-gradient-to-r from-green-500 to-blue-500 rounded-full flex items-center justify-center mr-4"><i class="fas fa-phone text-white"></i></div><div><h4 class="text-white font-bold"><?= htmlspecialchars($dynamicText['t_linktekst_2a235b_0975cf']['text'] ?? 'Telefon', ENT_QUOTES, 'UTF-8'); ?></h4><p class="text-gray-400">+381 60 123 4567</p></div></div><div class="flex items-center"><div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mr-4"><i class="fas fa-envelope text-white"></i></div><div><h4 class="text-white font-bold"><?= htmlspecialchars($dynamicText['t_linktekst_b3d102_ce8ae9']['text'] ?? 'Email', ENT_QUOTES, 'UTF-8'); ?></h4><p class="text-gray-400"><?= htmlspecialchars($dynamicText['t_linktekst_4e5510_e32f4f']['text'] ?? 'info@vasafirma.rs', ENT_QUOTES, 'UTF-8'); ?></p></div></div></div></div></div></div></div></section>
</main>
<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';
?>

</body>
</html>

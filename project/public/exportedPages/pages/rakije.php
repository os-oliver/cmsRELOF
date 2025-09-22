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


<section class="py-20 bg-white"><div class="container mx-auto px-6"><div class="text-center mb-16"><h2 class="text-4xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($dynamicText['t_rakije_1ae95c_e3851d']['text'] ?? 'Česta Pitanja', ENT_QUOTES, 'UTF-8'); ?></h2><p class="text-xl text-gray-600"><?= htmlspecialchars($dynamicText['t_rakije_400676_79a520']['text'] ?? 'Odgovori na najčešće postavljena pitanja', ENT_QUOTES, 'UTF-8'); ?></p></div><div class="max-w-4xl mx-auto space-y-6"><div class="bg-gray-50 rounded-2xl p-6 hover:shadow-lg transition duration-300"><div class="flex items-center justify-between cursor-pointer"><h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($dynamicText['t_rakije_4bc882_281e10']['text'] ?? 'Koliko je dobra nasa rakija??', ENT_QUOTES, 'UTF-8'); ?></h3><i class="fas fa-chevron-down text-gray-500"></i></div><div class="mt-4 text-gray-600"><p id="i5p25e"><?= htmlspecialchars($dynamicText['t_rakije_b3a45d_9e39b5']['text'] ?? 'MNogoooo dobra', ENT_QUOTES, 'UTF-8'); ?></p></div></div><div class="bg-gray-50 rounded-2xl p-6 hover:shadow-lg transition duration-300"><div class="flex items-center justify-between cursor-pointer"><h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($dynamicText['t_rakije_c84017_635a30']['text'] ?? 'Da li nudite održavanje sajta?', ENT_QUOTES, 'UTF-8'); ?></h3><i class="fas fa-chevron-down text-gray-500"></i></div><div class="mt-4 text-gray-600"><p><?= htmlspecialchars($dynamicText['t_rakije_246210_f9c3f6']['text'] ?? 'Da, nudimo kompletne usluge održavanja koje uključuju sigurnosne ažuriranja, backup, monitoring performansi i tehničku podršku.', ENT_QUOTES, 'UTF-8'); ?></p></div></div><div class="bg-gray-50 rounded-2xl p-6 hover:shadow-lg transition duration-300"><div class="flex items-center justify-between cursor-pointer"><h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($dynamicText['t_rakije_bb1754_782997']['text'] ?? 'Mogu li sам da ažuriram sadržaj?', ENT_QUOTES, 'UTF-8'); ?></h3><i class="fas fa-chevron-down text-gray-500"></i></div><div class="mt-4 text-gray-600"><p><?= htmlspecialchars($dynamicText['t_rakije_93a8f6_1c667b']['text'] ?? 'Apsolutno! Svi naši sajtovi dolaze sa jednostavnim CMS sistemom koji vam omogućava lako ažuriranje sadržaja bez tehničkih znanja.', ENT_QUOTES, 'UTF-8'); ?></p></div></div><div class="bg-gray-50 rounded-2xl p-6 hover:shadow-lg transition duration-300"><div class="flex items-center justify-between cursor-pointer"><h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($dynamicText['t_rakije_2db567_b9d294']['text'] ?? 'Da li su sajtovi optimizovani za mobilne uređaje?', ENT_QUOTES, 'UTF-8'); ?></h3><i class="fas fa-chevron-down text-gray-500"></i></div><div class="mt-4 text-gray-600"><p><?= htmlspecialchars($dynamicText['t_rakije_dd79af_32efad']['text'] ?? 'Svi naši sajtovi su responsive i potpuno optimizovani za sve vrste uređaja - telefone, tablete i desktop računare.', ENT_QUOTES, 'UTF-8'); ?></p></div></div><div class="bg-gray-50 rounded-2xl p-6 hover:shadow-lg transition duration-300"><div class="flex items-center justify-between cursor-pointer"><h3 class="text-xl font-bold text-gray-800"><?= htmlspecialchars($dynamicText['t_rakije_dd4c56_13d659']['text'] ?? 'Šta je uključeno u SEO optimizaciju?', ENT_QUOTES, 'UTF-8'); ?></h3><i class="fas fa-chevron-down text-gray-500"></i></div><div class="mt-4 text-gray-600"><p><?= htmlspecialchars($dynamicText['t_rakije_273331_59521f']['text'] ?? 'Naša SEO optimizacija uključuje keyword research, optimizaciju meta tagova, strukturirane podatke, brzinu učitavanja i tehnički SEO audit.', ENT_QUOTES, 'UTF-8'); ?></p></div></div></div></div></section>
</main>
<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';
?>

</body>
</html>

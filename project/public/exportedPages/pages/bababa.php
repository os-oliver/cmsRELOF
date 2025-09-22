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


<section class="py-20 bg-gradient-to-br from-gray-50 to-gray-100"><div class="container mx-auto px-6"><div class="text-center mb-16"><h2 class="text-4xl font-bold text-gray-800 mb-4"><?= htmlspecialchars($dynamicText['t_bababa_1ae95c_0121e3']['text'] ?? 'Izaberite Svoj Plan', ENT_QUOTES, 'UTF-8'); ?></h2><p class="text-xl text-gray-600"><?= htmlspecialchars($dynamicText['t_bababa_400676_49c106']['text'] ?? 'Fleksibilni paketi prilagođeni vašim potrebama', ENT_QUOTES, 'UTF-8'); ?></p></div><div class="grid lg:grid-cols-3 gap-8 max-w-6xl mx-auto"><div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-gray-200 hover:border-blue-500 transition duration-300"><div class="text-center"><h3 class="text-2xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($dynamicText['t_bababa_4bc882_056679']['text'] ?? 'Osnovni', ENT_QUOTES, 'UTF-8'); ?></h3><div class="text-4xl font-bold text-blue-600 mb-4">$29<span class="text-lg text-gray-500"><?= htmlspecialchars($dynamicText['t_bababa_3f8bff_1d0d02']['text'] ?? '/mesec', ENT_QUOTES, 'UTF-8'); ?></span></div><p class="text-gray-600 mb-6"><?= htmlspecialchars($dynamicText['t_bababa_789d32_793aa4']['text'] ?? 'Perfektan za početak', ENT_QUOTES, 'UTF-8'); ?></p></div><ul class="space-y-4 mb-8"><li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i><?= htmlspecialchars($dynamicText['t_bababa_f3c08b_dca929']['text'] ?? '5 Web stranica', ENT_QUOTES, 'UTF-8'); ?></li><li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i><?= htmlspecialchars($dynamicText['t_bababa_efebb4_1a420e']['text'] ?? '10GB prostor', ENT_QUOTES, 'UTF-8'); ?></li><li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i><?= htmlspecialchars($dynamicText['t_bababa_0fd0f9_251bb2']['text'] ?? 'Osnovna podrška', ENT_QUOTES, 'UTF-8'); ?></li><li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i><?= htmlspecialchars($dynamicText['t_bababa_934b4d_9411df']['text'] ?? 'SSL sertifikat', ENT_QUOTES, 'UTF-8'); ?></li></ul><button class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition"><?= htmlspecialchars($dynamicText['t_bababa_680821_6cae87']['text'] ?? 'Izaberi Plan', ENT_QUOTES, 'UTF-8'); ?></button></div><div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl shadow-2xl p-8 text-white transform scale-105 relative"><div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-yellow-400 text-black px-4 py-1 rounded-full text-sm font-bold"><?= htmlspecialchars($dynamicText['t_bababa_734923_497939']['text'] ?? 'NAJPOPULARNIJI', ENT_QUOTES, 'UTF-8'); ?></div><div class="text-center"><h3 class="text-2xl font-bold mb-2"><?= htmlspecialchars($dynamicText['t_bababa_a4b9e4_abd900']['text'] ?? 'Pro', ENT_QUOTES, 'UTF-8'); ?></h3><div class="text-4xl font-bold mb-4">$59<span class="text-lg opacity-80"><?= htmlspecialchars($dynamicText['t_bababa_f8c4ad_1d0d02']['text'] ?? '/mesec', ENT_QUOTES, 'UTF-8'); ?></span></div><p class="opacity-90 mb-6"><?= htmlspecialchars($dynamicText['t_bababa_246210_c8eea5']['text'] ?? 'Za rastuće biznise', ENT_QUOTES, 'UTF-8'); ?></p></div><ul class="space-y-4 mb-8"><li class="flex items-center"><i class="fas fa-check text-yellow-300 mr-3"></i><?= htmlspecialchars($dynamicText['t_bababa_9f577c_18f90e']['text'] ?? '25 Web stranica', ENT_QUOTES, 'UTF-8'); ?></li><li class="flex items-center"><i class="fas fa-check text-yellow-300 mr-3"></i><?= htmlspecialchars($dynamicText['t_bababa_d528c3_0ed0b1']['text'] ?? '100GB prostor', ENT_QUOTES, 'UTF-8'); ?></li><li class="flex items-center"><i class="fas fa-check text-yellow-300 mr-3"></i><?= htmlspecialchars($dynamicText['t_bababa_463cba_426fdf']['text'] ?? 'Prioritetna podrška', ENT_QUOTES, 'UTF-8'); ?></li><li class="flex items-center"><i class="fas fa-check text-yellow-300 mr-3"></i><?= htmlspecialchars($dynamicText['t_bababa_869726_5811e8']['text'] ?? 'Analitika', ENT_QUOTES, 'UTF-8'); ?></li><li class="flex items-center"><i class="fas fa-check text-yellow-300 mr-3"></i><?= htmlspecialchars($dynamicText['t_bababa_244e27_37b24e']['text'] ?? 'E-commerce', ENT_QUOTES, 'UTF-8'); ?></li></ul><button class="w-full bg-white text-blue-600 py-3 rounded-lg font-bold hover:bg-gray-100 transition"><?= htmlspecialchars($dynamicText['t_bababa_dda42a_6cae87']['text'] ?? 'Izaberi Plan', ENT_QUOTES, 'UTF-8'); ?></button></div><div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-gray-200 hover:border-purple-500 transition duration-300"><div class="text-center"><h3 class="text-2xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($dynamicText['t_bababa_bb1754_a0f276']['text'] ?? 'Enterprise', ENT_QUOTES, 'UTF-8'); ?></h3><div class="text-4xl font-bold text-purple-600 mb-4">$99<span class="text-lg text-gray-500"><?= htmlspecialchars($dynamicText['t_bababa_3fbe46_1d0d02']['text'] ?? '/mesec', ENT_QUOTES, 'UTF-8'); ?></span></div><p class="text-gray-600 mb-6"><?= htmlspecialchars($dynamicText['t_bababa_674cc8_aeacb3']['text'] ?? 'Za velike organizacije', ENT_QUOTES, 'UTF-8'); ?></p></div><ul class="space-y-4 mb-8"><li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i><?= htmlspecialchars($dynamicText['t_bababa_aa7d71_7734a7']['text'] ?? 'Neograničeno stranica', ENT_QUOTES, 'UTF-8'); ?></li><li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i><?= htmlspecialchars($dynamicText['t_bababa_b8b0e9_cf0ec4']['text'] ?? '500GB prostor', ENT_QUOTES, 'UTF-8'); ?></li><li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i><?= htmlspecialchars($dynamicText['t_bababa_f7099d_6be078']['text'] ?? '24/7 podrška', ENT_QUOTES, 'UTF-8'); ?></li><li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i><?= htmlspecialchars($dynamicText['t_bababa_a0cf61_e3e802']['text'] ?? 'Napredna analitika', ENT_QUOTES, 'UTF-8'); ?></li><li class="flex items-center"><i class="fas fa-check text-green-500 mr-3"></i><?= htmlspecialchars($dynamicText['t_bababa_94eb40_ef55d8']['text'] ?? 'Custom integracije', ENT_QUOTES, 'UTF-8'); ?></li></ul><button class="w-full bg-purple-600 text-white py-3 rounded-lg font-bold hover:bg-purple-700 transition"><?= htmlspecialchars($dynamicText['t_bababa_460428_6cae87']['text'] ?? 'Izaberi Plan', ENT_QUOTES, 'UTF-8'); ?></button></div></div></div></section>
</main>
<?php
require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';
?>

</body>
</html>

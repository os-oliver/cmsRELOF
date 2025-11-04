<?php
use App\Controllers\AuthController;
AuthController::requireAdmin();

?>

<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IBK Website Builder</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {

            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f8ff 0%, #e6f0ff 100%);
        }

        .wizard-progress {
            background: linear-gradient(90deg, #1e3a8a 0%, #3b82f6 100%);
        }

        .card-hover-effect {
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .card-hover-effect:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 30px -10px rgba(30, 58, 138, 0.15);
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .card-glow {
            box-shadow: 0 0 20px rgba(30, 58, 138, 0.1);
        }

        .selected-card {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            transform: translateY(-8px) scale(1.02);
        }

        .selected-card h3,
        .selected-card p {
            color: white;
        }
    </style>
</head>

<body class="min-h-screen">
    <form method="GET" action="/style">
        <input type="hidden" name="tipUstanove" id="tipUstanove" value="" />
        <div class="flex items-center justify-center min-h-screen pb-8">
            <div class="max-w-6xl mx-auto px-6">
                <div class="flex items-center justify-center min-h-screen pt-20 pb-8">
                    <div class="max-w-6xl mx-auto px-6">
                        <!-- Header Section -->
                        <div class="text-center mb-12">
                            <div class="floating-animation inline-block mb-6">
                                <div
                                    class="w-20 h-20 bg-gradient-to-br from-blue-700 to-blue-500 rounded-2xl flex items-center justify-center text-white text-3xl font-bold shadow-lg">
                                    IBK
                                </div>
                            </div>
                            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                                Izaberite tip vaše <span
                                    class="bg-gradient-to-r from-indigo-600 to-blue-400 bg-clip-text text-transparent">IBK
                                    ustanove</span>
                            </h1>
                            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Kreiraćemo personalizovani website
                                prilagođen vašoj ustanovi. Prvo, izaberite kategoriju koja najbolje opisuje vašu
                                organizaciju.</p>
                        </div>

                        <!-- Cards Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                            <!-- Biblioteka -->
                            <div id="Biblioteka"
                                class="card-hover-effect card-glow bg-white rounded-2xl p-6 cursor-pointer border border-gray-200"
                                data-type="biblioteka">
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-purple-600 to-purple-400 rounded-xl flex items-center justify-center text-white text-2xl mb-4 mx-auto">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Biblioteka</h3>
                                    <p class="text-sm text-gray-500">Javna ili stručna biblioteka</p>
                                </div>
                            </div>
                            <!-- Centar za kulturu -->
                            <div id="CentarZaKulturu"
                                class="card-hover-effect card-glow bg-white rounded-2xl p-6 cursor-pointer border border-gray-200"
                                data-type="centar-za-kulturu">
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-pink-500 to-red-500 rounded-xl flex items-center justify-center text-white text-2xl mb-4 mx-auto">
                                        <i class="fas fa-palette"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Centar za kulturu</h3>
                                    <p class="text-sm text-gray-500">Kulturna institucija</p>
                                </div>
                            </div>
                            <!-- Istorijski arhiv -->
                            <div id="IstorijskiArhiv"
                                class="card-hover-effect card-glow bg-white rounded-2xl p-6 cursor-pointer border border-gray-200"
                                data-type="istorijski-arhiv">
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl flex items-center justify-center text-white text-2xl mb-4 mx-auto">
                                        <i class="fas fa-archive"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Istorijski arhiv</h3>
                                    <p class="text-sm text-gray-500">Čuvanje istorijskih dokumenata</p>
                                </div>
                            </div>
                            <!-- Muzej i galerija -->
                            <div id="MuzejGalerija"
                                class="card-hover-effect card-glow bg-white rounded-2xl p-6 cursor-pointer border border-gray-200"
                                data-type="muzej-galerija">
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center text-white text-2xl mb-4 mx-auto">
                                        <i class="fas fa-landmark"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Muzej i galerija</h3>
                                    <p class="text-sm text-gray-500">Izložbe i kolekcije</p>
                                </div>
                            </div>
                            <!-- Obrazovna ustanova -->
                            <div id="ObrazovnaUstanova"
                                class="card-hover-effect card-glow bg-white rounded-2xl p-6 cursor-pointer border border-gray-200"
                                data-type="obrazovna-ustanova">
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-500 rounded-xl flex items-center justify-center text-white text-2xl mb-4 mx-auto">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Obrazovna ustanova</h3>
                                    <p class="text-sm text-gray-500">Obrazovni centar</p>
                                </div>
                            </div>
                            <!-- Omladinski centar -->
                            <div id="OmladinskiCentar"
                                class="card-hover-effect card-glow bg-white rounded-2xl p-6 cursor-pointer border border-gray-200"
                                data-type="omladinski-centar">
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center text-white text-2xl mb-4 mx-auto">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Omladinski centar</h3>
                                    <p class="text-sm text-gray-500">Aktivnosti za mlade</p>
                                </div>
                            </div>
                            <!-- Pozorište -->
                            <div id="Pozoriste"
                                class="card-hover-effect card-glow bg-white rounded-2xl p-6 cursor-pointer border border-gray-200"
                                data-type="pozoriste">
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-red-500 to-pink-500 rounded-xl flex items-center justify-center text-white text-2xl mb-4 mx-auto">
                                        <i class="fas fa-theater-masks"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Pozorište</h3>
                                    <p class="text-sm text-gray-500">Dramske i druge predstave</p>
                                </div>
                            </div>
                            <!-- Predškolska ustanova -->
                            <div id="PredskolskaUstanova"
                                class="card-hover-effect card-glow bg-white rounded-2xl p-6 cursor-pointer border border-gray-200"
                                data-type="predskolska-ustanova">
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center text-white text-2xl mb-4 mx-auto">
                                        <i class="fas fa-child"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Predškolska ustanova</h3>
                                    <p class="text-sm text-gray-500">Vrtić ili predškolska grupa</p>
                                </div>
                            </div>
                            <!-- Socijalna ustanova -->
                            <div id="SocijalnaUstanova"
                                class="card-hover-effect card-glow bg-white rounded-2xl p-6 cursor-pointer border border-gray-200"
                                data-type="socijalna-ustanova">
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center text-white text-2xl mb-4 mx-auto">
                                        <i class="fas fa-hands-helping"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Socijalna ustanova</h3>
                                    <p class="text-sm text-gray-500">Socijalne usluge i podrška</p>
                                </div>
                            </div>
                            <!-- Sport -->
                            <div id="Sport"
                                class="card-hover-effect card-glow bg-white rounded-2xl p-6 cursor-pointer border border-gray-200"
                                data-type="Sport">
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-orange-500 to-yellow-500 rounded-xl flex items-center justify-center text-white text-2xl mb-4 mx-auto">
                                        <i class="fas fa-running"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Sport</h3>
                                    <p class="text-sm text-gray-500">Sportske aktivnosti i klubovi</p>
                                </div>
                            </div>
                            <!-- Turizam -->
                            <div id="Turizam"
                                class="card-hover-effect card-glow bg-white rounded-2xl p-6 cursor-pointer border border-gray-200"
                                data-type="turizam">
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center text-white text-2xl mb-4 mx-auto">
                                        <i class="fas fa-umbrella-beach"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Turizam</h3>
                                    <p class="text-sm text-gray-500">Turističke atrakcije i usluge</p>
                                </div>
                            </div>
                            <!-- Ostalo -->
                            <div class="card-hover-effect card-glow bg-white rounded-2xl p-6 cursor-pointer border border-gray-200"
                                data-type="ostalo">
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-br from-gray-500 to-gray-700 rounded-xl flex items-center justify-center text-white text-2xl mb-4 mx-auto">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Ostalo</h3>
                                    <p class="text-sm text-gray-500">Druge vrste ustanova</p>
                                </div>
                            </div>
                        </div>
                        <!-- Action Buttons -->
                        <div class="flex justify-center gap-4">
                            <button type="submit" id="continueBtn"
                                class="px-8 py-3 bg-gradient-to-r from-blue-700 to-blue-900 text-white font-semibold rounded-xl hover:from-blue-800 hover:to-blue-900 transition-all duration-300 transform hover:scale-105 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled>
                                Nastavi dalje <span class="ml-2">→</span>
                            </button>
                        </div>

                        <!-- Selected Type Display -->
                        <div id="selectedType"
                            class="mt-6 text-center text-gray-600 opacity-0 transition-opacity duration-500">
                            <p class="text-sm">Izabrani tip: <span id="selectedTypeName"
                                    class="font-semibold text-blue-700"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="/assets/js/WebWizard/wizard.js"></script>
</body>

</html>
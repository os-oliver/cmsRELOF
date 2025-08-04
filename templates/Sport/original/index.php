<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportski Centar Olympia - Vrhunske sportske usluge</title>
    <meta name="description" content="Sportski centar Olympia - ponuda sportskih sadržaja i treninga za sve uzraste. Pratite najnovije rezultate i upišite se!">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e53935',
                        secondary: '#1e3a8a',
                        accent: '#f59e0b',
                    },
                    fontFamily: {
                        montserrat: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            scroll-behavior: smooth;
        }
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1547347298-4074fc3086f0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80');
            background-size: cover;
            background-position: center;
        }
        .section-title {
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }
        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, #e53935, #1e3a8a);
            border-radius: 2px;
        }
        .stats-card {
            transition: transform 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }
        .calendar-day {
            transition: all 0.2s ease;
        }
        .calendar-day:hover {
            background-color: #f8fafc;
            transform: scale(1.05);
        }
        .event-card {
            transition: transform 0.3s ease;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .membership-card {
            transition: all 0.3s ease;
        }
        .membership-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .nav-link {
            position: relative;
        }
        .nav-link:after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 3px;
            background-color: #e53935;
            transition: width 0.3s ease;
        }
        .nav-link:hover:after {
            width: 100%;
        }
        .active:after {
            width: 100%;
        }
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-out;
        }
        .mobile-menu.open {
            max-height: 500px;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Header & Navigation -->
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16" ></div>
                <div class="ml-4">
                    <h1 class="text-2xl font-bold text-secondary">SPORTSKI CENTAR <span class="text-primary">OLYMPIA</span></h1>
                    <p class="text-sm text-gray-600">Vaš put ka uspehu</p>
                </div>
            </div>
            
            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-8">
                <a href="#pocetna" class="nav-link active font-bold text-primary">Početna</a>
                <a href="#o-nama" class="nav-link font-semibold hover:text-primary">O nama</a>
                <a href="#objekti" class="nav-link font-semibold hover:text-primary">Objekti</a>
                <a href="#treninzi" class="nav-link font-semibold hover:text-primary">Treninzi</a>
                <a href="#takmicenja" class="nav-link font-semibold hover:text-primary">Takmičenja</a>
                <a href="#clanstvo" class="nav-link font-semibold hover:text-primary">Članstvo</a>
                <a href="#kontakt" class="nav-link font-semibold hover:text-primary">Kontakt</a>
            </nav>
            
            <!-- Mobile Menu Button -->
            <button id="menu-toggle" class="md:hidden text-gray-700">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu md:hidden bg-white">
            <div class="container mx-auto px-4 py-4 flex flex-col space-y-3">
                <a href="#pocetna" class="py-2 font-semibold border-b border-gray-200">Početna</a>
                <a href="#o-nama" class="py-2 font-semibold border-b border-gray-200">O nama</a>
                <a href="#objekti" class="py-2 font-semibold border-b border-gray-200">Objekti</a>
                <a href="#treninzi" class="py-2 font-semibold border-b border-gray-200">Treninzi</a>
                <a href="#takmicenja" class="py-2 font-semibold border-b border-gray-200">Takmičenja</a>
                <a href="#clanstvo" class="py-2 font-semibold border-b border-gray-200">Članstvo</a>
                <a href="#kontakt" class="py-2 font-semibold">Kontakt</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="pocetna" class="hero text-white py-20 md:py-32">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">UNESI SPORT U SVOJ ŽIVOT</h1>
            <p class="text-xl md:text-2xl mb-10 max-w-3xl mx-auto">Pridruži se vodećem sportskom centru sa najboljim trenerima, savremenim terenima i uzbudljivim takmičenjima</p>
            <div class="flex flex-col md:flex-row justify-center gap-4">
                <a href="#clanstvo" class="bg-primary hover:bg-red-700 text-white font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">POSTANI ČLAN</a>
                <a href="#treninzi" class="bg-white hover:bg-gray-100 text-black text-secondary font-bold py-3 px-8 rounded-full text-lg transition duration-300 transform hover:scale-105">REZERVIŠI TRENING</a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="stats-card bg-white p-6 rounded-xl shadow text-center">
                    <div class="text-4xl font-bold text-primary mb-2">25+</div>
                    <div class="text-gray-600 font-semibold">Sportskih aktivnosti</div>
                </div>
                <div class="stats-card bg-white p-6 rounded-xl shadow text-center">
                    <div class="text-4xl font-bold text-primary mb-2">50</div>
                    <div class="text-gray-600 font-semibold">Profesionalnih trenera</div>
                </div>
                <div class="stats-card bg-white p-6 rounded-xl shadow text-center">
                    <div class="text-4xl font-bold text-primary mb-2">15</div>
                    <div class="text-gray-600 font-semibold">Sportskih terena</div>
                </div>
                <div class="stats-card bg-white p-6 rounded-xl shadow text-center">
                    <div class="text-4xl font-bold text-primary mb-2">2500+</div>
                    <div class="text-gray-600 font-semibold">Zadovoljnih članova</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="o-nama" class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-2 section-title">O NAMA</h2>
            <p class="text-gray-600 mb-12 max-w-3xl">Sportski centar Olympia osnovan je 1998. godine sa ciljem promovisanja sporta i zdravog načina života za sve uzraste.</p>
            
            <div class="flex flex-col md:flex-row gap-8">
                <div class="md:w-1/2">
                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-80" ></div>
                </div>
                <div class="md:w-1/2">
                    <h3 class="text-2xl font-bold text-secondary mb-4">Naša misija i vizija</h3>
                    <p class="text-gray-700 mb-6">Olympia je više od sportskog centra - mi smo zajednica entuzijasta posvećenih razvoju sporta. Naša misija je da kroz kvalitetne programe, savremenu infrastrukturu i stručno osoblje pružimo najbolje uslove za rekreaciju i takmičenje.</p>
                    <p class="text-gray-700 mb-6">Tokom proteklih 25 godina, iz naše škole je izašlo više od 50 reprezentativaca u različitim sportovima, a naši timovi osvojili su brojna priznanja na nacionalnom i međunarodnom nivou.</p>
                    
                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <div class="flex items-center">
                            <div class="bg-primary rounded-full p-2 mr-3">
                                <i class="fas fa-trophy text-black text-xl"></i>
                            </div>
                            <div>
                                <div class="font-bold text-lg">25+</div>
                                <div class="text-gray-600">Takmičenja godišnje</div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-primary rounded-full p-2 mr-3">
                                <i class="fas fa-users text-black text-xl"></i>
                            </div>
                            <div>
                                <div class="font-bold text-lg">3,000m²</div>
                                <div class="text-gray-600">Sportskih površina</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="objekti" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-2 section-title">NAŠI OBJEKTI</h2>
            <p class="text-gray-600 mb-12 max-w-3xl">Istražite naše vrhunsko opremljene sportski objekte dizajnirane za profesionalne sportiste i rekreativce.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Facility 1 -->
                <div class="event-card bg-white rounded-xl overflow-hidden shadow-lg">
                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48" ></div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-secondary mb-2">Glavni stadion</h3>
                        <p class="text-gray-600 mb-4">Savremeni stadion sa atletskom stazom i fudbalskim terenom. Kapacitet: 5,000 gledalaca.</p>
                        <ul class="space-y-2 mb-4">
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-primary mr-2"></i>
                                <span>Atletska staza 400m</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-primary mr-2"></i>
                                <span>Osvetljenje za večernje treninge</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-primary mr-2"></i>
                                <span>VIP tribine</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Facility 2 -->
                <div class="event-card bg-white rounded-xl overflow-hidden shadow-lg">
                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48" ></div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-secondary mb-2">Olimpijska dvorana</h3>
                        <p class="text-gray-600 mb-4">Višenamenska sportska dvorana za odbojku, košarku, rukomet i badminton.</p>
                        <ul class="space-y-2 mb-4">
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-primary mr-2"></i>
                                <span>3 košarkaška terena</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-primary mr-2"></i>
                                <span>Klima uređaj</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-primary mr-2"></i>
                                <span>Kabine za timove</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="event-card bg-white rounded-xl overflow-hidden shadow-lg">
                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48" ></div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-secondary mb-2">Olimpijska dvorana</h3>
                        <p class="text-gray-600 mb-4">Višenamenska sportska dvorana za odbojku, košarku, rukomet i badminton.</p>
                        <ul class="space-y-2 mb-4">
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-primary mr-2"></i>
                                <span>3 košarkaška terena</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-primary mr-2"></i>
                                <span>Klima uređaj</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check-circle text-primary mr-2"></i>
                                <span>Kabine za timove</span>
                            </li>
                        </ul>
                    </div>
                </div>
             
            </div>
        </div>
    </section>

    <!-- Trainings Section -->
    <section id="treninzi" class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-2 section-title">TRENINZI I PROGRAMI</h2>
            <p class="text-gray-600 mb-12 max-w-3xl">Pronađite savršen trening za sebe u našoj širokoj ponudi sportskih aktivnosti za sve uzraste.</p>
            
            <div class="mb-12">
                <h3 class="text-2xl font-bold text-secondary mb-6">Raspored treninga</h3>
                
                <!-- Calendar -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="text-xl font-bold text-gray-800">Juli 2023</h4>
                        <div class="flex space-x-2">
                            <button class="p-2 rounded-full hover:bg-gray-100"><i class="fas fa-chevron-left"></i></button>
                            <button class="p-2 rounded-full hover:bg-gray-100"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-7 gap-2 mb-4">
                        <div class="text-center font-bold py-2 text-gray-600">Pon</div>
                        <div class="text-center font-bold py-2 text-gray-600">Uto</div>
                        <div class="text-center font-bold py-2 text-gray-600">Sre</div>
                        <div class="text-center font-bold py-2 text-gray-600">Čet</div>
                        <div class="text-center font-bold py-2 text-gray-600">Pet</div>
                        <div class="text-center font-bold py-2 text-gray-600">Sub</div>
                        <div class="text-center font-bold py-2 text-gray-600">Ned</div>
                        
                        <!-- Calendar Days -->
                        <div class="calendar-day text-center py-3 rounded-lg">26</div>
                        <div class="calendar-day text-center py-3 rounded-lg">27</div>
                        <div class="calendar-day text-center py-3 rounded-lg">28</div>
                        <div class="calendar-day text-center py-3 rounded-lg">29</div>
                        <div class="calendar-day text-center py-3 rounded-lg">30</div>
                        <div class="calendar-day bg-gray-100 text-center py-3 rounded-lg">1</div>
                        <div class="calendar-day bg-gray-100 text-center py-3 rounded-lg">2</div>
                        
                        <div class="calendar-day text-center py-3 rounded-lg">3</div>
                        <div class="calendar-day text-center py-3 rounded-lg">4</div>
                        <div class="calendar-day text-center py-3 rounded-lg">5</div>
                        <div class="calendar-day bg-primary text-black font-bold text-center py-3 rounded-lg">6</div>
                        <div class="calendar-day text-center py-3 rounded-lg">7</div>
                        <div class="calendar-day bg-gray-100 text-center py-3 rounded-lg">8</div>
                        <div class="calendar-day bg-gray-100 text-center py-3 rounded-lg">9</div>
                        
                        <div class="calendar-day text-center py-3 rounded-lg">10</div>
                        <div class="calendar-day text-center py-3 rounded-lg">11</div>
                        <div class="calendar-day text-center py-3 rounded-lg">12</div>
                        <div class="calendar-day text-center py-3 rounded-lg">13</div>
                        <div class="calendar-day text-center py-3 rounded-lg">14</div>
                        <div class="calendar-day bg-gray-100 text-center py-3 rounded-lg">15</div>
                        <div class="calendar-day bg-gray-100 text-center py-3 rounded-lg">16</div>
                        
                        <div class="calendar-day text-center py-3 rounded-lg">17</div>
                        <div class="calendar-day text-center py-3 rounded-lg">18</div>
                        <div class="calendar-day text-center py-3 rounded-lg">19</div>
                        <div class="calendar-day text-center py-3 rounded-lg">20</div>
                        <div class="calendar-day text-center py-3 rounded-lg">21</div>
                        <div class="calendar-day bg-gray-100 text-center py-3 rounded-lg">22</div>
                        <div class="calendar-day bg-gray-100 text-center py-3 rounded-lg">23</div>
                        
                        <div class="calendar-day text-center py-3 rounded-lg">24</div>
                        <div class="calendar-day text-center py-3 rounded-lg">25</div>
                        <div class="calendar-day text-center py-3 rounded-lg">26</div>
                        <div class="calendar-day text-center py-3 rounded-lg">27</div>
                        <div class="calendar-day text-center py-3 rounded-lg">28</div>
                        <div class="calendar-day bg-gray-100 text-center py-3 rounded-lg">29</div>
                        <div class="calendar-day bg-gray-100 text-center py-3 rounded-lg">30</div>
                    </div>
                </div>
                
                <!-- Training Filter -->
                <div class="mb-8">
                    <h4 class="text-lg font-bold mb-4">Filtriraj po sportu:</h4>
                    <div class="flex flex-wrap gap-2">
                        <button class="px-4 py-2 bg-secondary text-black rounded-full font-semibold">Svi sportovi</button>
                        <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-full font-semibold">Fudbal</button>
                        <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-full font-semibold">Košarka</button>
                        <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-full font-semibold">Odbojka</button>
                        <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-full font-semibold">Tenis</button>
                        <button class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-full font-semibold">Atletika</button>
                    </div>
                </div>
                
                <!-- Training Schedule -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-xl shadow-lg">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 text-left">Vreme</th>
                                <th class="py-3 px-4 text-left">Sport</th>
                                <th class="py-3 px-4 text-left">Grupa</th>
                                <th class="py-3 px-4 text-left">Teren</th>
                                <th class="py-3 px-4 text-left">Trener</th>
                                <th class="py-3 px-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-4 px-4">16:00 - 17:30</td>
                                <td class="py-4 px-4 font-semibold">Fudbal</td>
                                <td class="py-4 px-4">U-12 (dečaci)</td>
                                <td class="py-4 px-4">Stadion teren 2</td>
                                <td class="py-4 px-4">Marko Petrović</td>
                                <td class="py-4 px-4">
                                    <button class="bg-primary hover:bg-red-700 text-black px-4 py-1 rounded-full text-sm">Rezerviši</button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-4 px-4">17:00 - 18:30</td>
                                <td class="py-4 px-4 font-semibold">Košarka</td>
                                <td class="py-4 px-4">Seniori (žene)</td>
                                <td class="py-4 px-4">Dvorana A</td>
                                <td class="py-4 px-4">Jelena Jovanović</td>
                                <td class="py-4 px-4">
                                    <button class="bg-primary hover:bg-red-700 text-black px-4 py-1 rounded-full text-sm">Rezerviši</button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-4 px-4">18:00 - 19:30</td>
                                <td class="py-4 px-4 font-semibold">Tenis</td>
                                <td class="py-4 px-4">Rekreacija</td>
                                <td class="py-4 px-4">Teren 3</td>
                                <td class="py-4 px-4">Nikola Stanković</td>
                                <td class="py-4 px-4">
                                    <button class="bg-primary hover:bg-red-700 text-black px-4 py-1 rounded-full text-sm">Rezerviši</button>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-4 px-4">19:00 - 20:30</td>
                                <td class="py-4 px-4 font-semibold">Fitnes</td>
                                <td class="py-4 px-4">HIIT trening</td>
                                <td class="py-4 px-4">Teretana sprat 1</td>
                                <td class="py-4 px-4">Ana Marković</td>
                                <td class="py-4 px-4">
                                    <button class="bg-primary hover:bg-red-700 text-black px-4 py-1 rounded-full text-sm">Rezerviši</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div>
                <h3 class="text-2xl font-bold text-secondary mb-6">Naši treneri</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Coach 1 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-56" ></div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg">Marko Petrović</h4>
                            <p class="text-primary font-semibold">Fudbal</p>
                            <p class="text-gray-600 text-sm mt-2">Licencirani UEFA A trener sa 15 godina iskustva u radu sa omladincima.</p>
                        </div>
                    </div>
                    
                    <!-- Coach 2 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-56" ></div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg">Jelena Jovanović</h4>
                            <p class="text-primary font-semibold">Košarka</p>
                            <p class="text-gray-600 text-sm mt-2">Bivša reprezentativka, vodi seniorski tim žena i školu košarke.</p>
                        </div>
                    </div>
                    
                    <!-- Coach 3 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-56" ></div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg">Nikola Stanković</h4>
                            <p class="text-primary font-semibold">Tenis</p>
                            <p class="text-gray-600 text-sm mt-2">ATP licencirani trener, specijalista za teniske škole za decu i odrasle.</p>
                        </div>
                    </div>
                    
                    <!-- Coach 4 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-56" ></div>
                        <div class="p-4">
                            <h4 class="font-bold text-lg">Ana Marković</h4>
                            <p class="text-primary font-semibold">Fitness</p>
                            <p class="text-gray-600 text-sm mt-2">Diplomirani nutricionista i personalni trener sa 10 godina iskustva.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Competitions Section -->
    <section id="takmicenja" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-2 section-title">TAKMIČENJA I REZULTATI</h2>
            <p class="text-gray-600 mb-12 max-w-3xl">Pratite aktuelna takmičenja, rezultate i najave sportskih događaja u našem centru.</p>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Upcoming Events -->
                <div class="lg:col-span-2">
                    <h3 class="text-2xl font-bold text-secondary mb-6">Aktuelna takmičenja</h3>
                    
                    <div class="space-y-6">
                        <!-- Event 1 -->
                        <div class="event-card bg-white rounded-xl shadow-lg p-6">
                            <div class="flex flex-col md:flex-row gap-6">
                                <div class="md:w-1/4">
                                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-40" ></div>
                                </div>
                                <div class="md:w-3/4">
                                    <div class="flex justify-between items-start">
                                        <h4 class="text-xl font-bold">Finale gradske lige u fudbalu</h4>
                                        <span class="bg-primary text-black px-3 py-1 rounded-full text-sm font-bold">LIVE</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 my-2">
                                        <i class="far fa-calendar mr-2"></i>
                                        <span>15. Jul 2023 | 18:00</span>
                                    </div>
                                    <p class="text-gray-700 mb-4">Finalna utakmica gradske fudbalske lige između Olympia FC i Spartak.</p>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                            <span>Glavni stadion</span>
                                        </div>
                                        <button class="bg-secondary hover:bg-blue-900 text-black px-4 py-2 rounded-full">Rezerviši kartu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Event 2 -->
                        <div class="event-card bg-white rounded-xl shadow-lg p-6">
                            <div class="flex flex-col md:flex-row gap-6">
                                <div class="md:w-1/4">
                                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-40" ></div>
                                </div>
                                <div class="md:w-3/4">
                                    <h4 class="text-xl font-bold">Košarkaški turnir "Letnje večeri"</h4>
                                    <div class="flex items-center text-gray-600 my-2">
                                        <i class="far fa-calendar mr-2"></i>
                                        <span>22-24. Jul 2023</span>
                                    </div>
                                    <p class="text-gray-700 mb-4">Godišnji košarkaški turnir u kome učestvuju 24 tima iz cele regije.</p>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                            <span>Olimpijska dvorana</span>
                                        </div>
                                        <button class="bg-secondary hover:bg-blue-900 text-black px-4 py-2 rounded-full">Prijavi tim</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Results & Standings -->
                <div>
                    <h3 class="text-2xl font-bold text-secondary mb-6">Rezultati i tabele</h3>
                    
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                        <h4 class="font-bold text-lg mb-4">Prva liga - Fudbal</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="py-2 px-3 text-left">Tim</th>
                                        <th class="py-2 px-3 text-center">P</th>
                                        <th class="py-2 px-3 text-center">W</th>
                                        <th class="py-2 px-3 text-center">D</th>
                                        <th class="py-2 px-3 text-center">L</th>
                                        <th class="py-2 px-3 text-center">Pts</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 px-3 font-semibold">Olympia FC</td>
                                        <td class="py-2 px-3 text-center">18</td>
                                        <td class="py-2 px-3 text-center">14</td>
                                        <td class="py-2 px-3 text-center">3</td>
                                        <td class="py-2 px-3 text-center">1</td>
                                        <td class="py-2 px-3 text-center font-bold">45</td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 px-3">Spartak</td>
                                        <td class="py-2 px-3 text-center">18</td>
                                        <td class="py-2 px-3 text-center">13</td>
                                        <td class="py-2 px-3 text-center">2</td>
                                        <td class="py-2 px-3 text-center">3</td>
                                        <td class="py-2 px-3 text-center">41</td>
                                    </tr>
                                    <tr class="border-b border-gray-200">
                                        <td class="py-2 px-3">Dinamo</td>
                                        <td class="py-2 px-3 text-center">18</td>
                                        <td class="py-2 px-3 text-center">10</td>
                                        <td class="py-2 px-3 text-center">4</td>
                                        <td class="py-2 px-3 text-center">4</td>
                                        <td class="py-2 px-3 text-center">34</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 px-3">Vitez</td>
                                        <td class="py-2 px-3 text-center">18</td>
                                        <td class="py-2 px-3 text-center">8</td>
                                        <td class="py-2 px-3 text-center">3</td>
                                        <td class="py-2 px-3 text-center">7</td>
                                        <td class="py-2 px-3 text-center">27</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="#" class="text-primary font-semibold mt-4 inline-block">Prikaži celu tabelu →</a>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h4 class="font-bold text-lg mb-4">Najbolji strelci</h4>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-gray-200 border-2 border-dashed mr-3"></div>
                                <div class="flex-1">
                                    <div class="font-semibold">Nikola Jovanović</div>
                                    <div class="text-sm text-gray-600">Olympia FC</div>
                                </div>
                                <div class="bg-primary text-black px-3 py-1 rounded-full font-bold">24</div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-gray-200 border-2 border-dashed mr-3"></div>
                                <div class="flex-1">
                                    <div class="font-semibold">Marko Nikolić</div>
                                    <div class="text-sm text-gray-600">Spartak</div>
                                </div>
                                <div class="bg-primary text-black px-3 py-1 rounded-full font-bold">19</div>
                            </div>
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-gray-200 border-2 border-dashed mr-3"></div>
                                <div class="flex-1">
                                    <div class="font-semibold">Petar Petrović</div>
                                    <div class="text-sm text-gray-600">Dinamo</div>
                                </div>
                                <div class="bg-primary text-black px-3 py-1 rounded-full font-bold">16</div>
                            </div>
                        </div>
                        <a href="#" class="text-primary font-semibold mt-4 inline-block">Svi strelci →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Membership Section -->
    <section id="clanstvo" class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-2 section-title">ČLANSTVO I UPIS</h2>
            <p class="text-gray-600 mb-12 max-w-3xl">Postanite deo Olympia porodice i iskoristite sve prednosti našeg članstva.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Membership Card 1 -->
                <div class="membership-card bg-white rounded-xl shadow-xl border-t-4 border-primary p-8">
                    <h3 class="text-2xl font-bold text-center mb-4">STANDARD</h3>
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold text-secondary">4,990</span>
                        <span class="text-gray-600">RSD/mes.</span>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            <span>Neograničen pristup teretani</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            <span>Grupni treninzi</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            <span>Besplatna savetodavna služba</span>
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-times-circle mr-2"></i>
                            <span>Lični trener</span>
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-times-circle mr-2"></i>
                            <span>Sauna i masaža</span>
                        </li>
                    </ul>
                    <button class="w-full bg-primary hover:bg-red-700 text-black font-bold py-3 rounded-full transition duration-300">IZABERI PAKET</button>
                </div>
                
                <!-- Membership Card 2 -->
                <div class="membership-card bg-white rounded-xl shadow-xl border-t-4 border-secondary p-8 relative">
                    <div class="absolute top-0 right-0 bg-secondary text-black px-4 py-1 rounded-bl-lg">NAJPOPULARNIJI</div>
                    <h3 class="text-2xl font-bold text-center mb-4">PREMIUM</h3>
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold text-secondary">7,990</span>
                        <span class="text-gray-600">RSD/mes.</span>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            <span>Sve iz Standard paketa</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            <span>1 lični trening nedeljno</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            <span>Sauna 2 puta nedeljno</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            <span>10% popusta na sportske proizvode</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            <span>Prioritetno rezervisanje termina</span>
                        </li>
                    </ul>
                    <button class="w-full bg-secondary hover:bg-blue-900 text-black font-bold py-3 rounded-full transition duration-300">IZABERI PAKET</button>
                </div>
                
                <!-- Membership Card 3 -->
                <div class="membership-card bg-white rounded-xl shadow-xl border-t-4 border-accent p-8">
                    <h3 class="text-2xl font-bold text-center mb-4">PORODIČNI</h3>
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold text-secondary">12,990</span>
                        <span class="text-gray-600">RSD/mes.</span>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            <span>Sve iz Premium paketa za 2 odrasla</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            <span>Besplatno članstvo za 2 dece</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            <span>15% popusta na sportske proizvode</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            <span>Besplatne sportske aktivnosti za decu</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check-circle text-primary mr-2"></i>
                            <span>Porodični fitnes savetnik</span>
                        </li>
                    </ul>
                    <button class="w-full bg-accent hover:bg-yellow-700 text-black font-bold py-3 rounded-full transition duration-300">IZABERI PAKET</button>
                </div>
            </div>
            
            <!-- Enrollment Form -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h3 class="text-2xl font-bold text-secondary mb-6">UPIŠITE SE DANAS</h3>
                <p class="text-gray-600 mb-8">Popunite formular i postanite deo naše sportske zajednice već danas!</p>
                
                <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 mb-2">Ime i prezime</label>
                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Email adresa</label>
                        <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Telefon</label>
                        <input type="tel" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Tip članstva</label>
                        <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option>Standard</option>
                            <option>Premium</option>
                            <option>Porodični</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-gray-700 mb-2">Poruka (opciono)</label>
                        <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" rows="4"></textarea>
                    </div>
                    <div class="md:col-span-2 flex items-center">
                        <input type="checkbox" id="terms" class="mr-2">
                        <label for="terms" class="text-gray-700">Slažem se sa uslovima članstva i obradom ličnih podataka</label>
                    </div>
                    <div class="md:col-span-2">
                        <button class="bg-primary hover:bg-red-700 text-black font-bold py-3 px-8 rounded-full text-lg transition duration-300">POŠALJI PRIJAVU</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-2 section-title">GALERIJA</h2>
            <p class="text-gray-600 mb-12 max-w-3xl">Pogledajte trenutke iz bogate sportske istorije našeg centra.</p>
            
            <div class="gallery-grid">
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48"></div>
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48"></div>
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48"></div>
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48"></div>
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48"></div>
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48"></div>
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48"></div>
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48"></div>
            </div>
            
            <div class="text-center mt-10">
                <button class="bg-secondary hover:bg-blue-900 text-black font-bold py-3 px-8 rounded-full text-lg transition duration-300">POGLEDAJTE VIŠE</button>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontakt" class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-2 section-title">KONTAKT I LOKACIJA</h2>
            <p class="text-gray-600 mb-12 max-w-3xl">Dođite nas posetite ili nas kontaktirajte za sve informacije koje su vam potrebne.</p>
            
            <div class="flex flex-col md:flex-row gap-8">
                <div class="md:w-1/2">
                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <h3 class="text-2xl font-bold text-secondary mb-6">Kontakt informacije</h3>
                        
                        <div class="space-y-6">
                            <div class="flex">
                                <div class="bg-primary rounded-full p-3 mr-4">
                                    <i class="fas fa-map-marker-alt text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Adresa</h4>
                                    <p class="text-gray-700">Sportski put 15, 11000 Beograd</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="bg-primary rounded-full p-3 mr-4">
                                    <i class="fas fa-phone-alt text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Telefon</h4>
                                    <p class="text-gray-700">+381 11 123 4567</p>
                                    <p class="text-gray-700">+381 64 123 4567</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="bg-primary rounded-full p-3 mr-4">
                                    <i class="far fa-envelope text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Email</h4>
                                    <p class="text-gray-700">info@sportskicentarolympia.rs</p>
                                    <p class="text-gray-700">upis@sportskicentarolympia.rs</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="bg-primary rounded-full p-3 mr-4">
                                    <i class="far fa-clock text-white text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Radno vreme</h4>
                                    <p class="text-gray-700">Ponedeljak - Petak: 07:00 - 22:00</p>
                                    <p class="text-gray-700">Subota: 08:00 - 20:00</p>
                                    <p class="text-gray-700">Nedelja: 08:00 - 16:00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="md:w-1/2">
                    <div class="bg-white rounded-xl shadow-lg p-8 h-full">
                        <h3 class="text-2xl font-bold text-secondary mb-6">Pronađite nas</h3>
                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-80" ></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-secondary text-black py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-xl font-bold mb-4">Sportski Centar Olympia</h4>
                    <p class="mb-4">Vodeći sportski centar sa tradicijom i najsavremenijim sadržajima za sve uzraste.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-black hover:text-primary"><i class="fab fa-facebook-f text-xl"></i></a>
                        <a href="#" class="text-black hover:text-primary"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-black hover:text-primary"><i class="fab fa-youtube text-xl"></i></a>
                        <a href="#" class="text-black hover:text-primary"><i class="fab fa-twitter text-xl"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-xl font-bold mb-4">Brzi linkovi</h4>
                    <ul class="space-y-2">
                        <li><a href="#pocetna" class="hover:text-primary transition">Početna</a></li>
                        <li><a href="#o-nama" class="hover:text-primary transition">O nama</a></li>
                        <li><a href="#objekti" class="hover:text-primary transition">Objekti</a></li>
                        <li><a href="#treninzi" class="hover:text-primary transition">Treninzi</a></li>
                        <li><a href="#takmicenja" class="hover:text-primary transition">Takmičenja</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-xl font-bold mb-4">Sportovi</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-primary transition">Fudbal</a></li>
                        <li><a href="#" class="hover:text-primary transition">Košarka</a></li>
                        <li><a href="#" class="hover:text-primary transition">Odbojka</a></li>
                        <li><a href="#" class="hover:text-primary transition">Tenis</a></li>
                        <li><a href="#" class="hover:text-primary transition">Atletika</a></li>
                        <li><a href="#" class="hover:text-primary transition">Fitnes</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-xl font-bold mb-4">Newsletter</h4>
                    <p class="mb-4">Prijavite se za najnovije vesti i promocije.</p>
                    <form class="flex">
                        <input type="email" placeholder="Vaš email" class="px-4 py-2 w-full rounded-l-lg focus:outline-none text-gray-800">
                        <button class="bg-primary hover:bg-red-700 px-4 py-2 rounded-r-lg"><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; 2023 Sportski Centar Olympia. Sva prava zadržana.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        
        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('open');
        });
        
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    mobileMenu.classList.remove('open');
                }
            });
        });
    </script>
</body>
</html>
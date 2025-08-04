<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Istorijski Arhiv - Čuvanje i Dostupnost Istorijskog Nasleđa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        [#2c3e50]: '#2c3e50',
                        [#8e7d5b]: '#8e7d5b',
                        [#3498db]: '#3498db',
                        light: '#f5f7fa',
                        dark: '#1a2530'
                    }
                }
            }
        }
    </script>
    <style>
        .archive-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%238e7d5b' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
        .document-icon {
            background: linear-gradient(135deg, #2c3e50 0%, #8e7d5b 100%);
        }
        .search-box {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .collection-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            left: 20px;
            width: 2px;
            background: #8e7d5b;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 12px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #2c3e50;
            border: 3px solid #8e7d5b;
        }
    </style>
</head>
<body class="bg-light text-[#2c3e50] font-sans">
    <!-- Header -->
    <header class="bg-[#2c3e50] text-white sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center mb-4 md:mb-0">
                <div class="document-icon w-12 h-12 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-archive text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold">Istorijski Arhiv</h1>
                    <p class="text-[#3498db] text-sm">Čuvanje istorijskog nasleđa</p>
                </div>
            </div>
            
            <nav class="w-full md:w-auto">
                <ul class="flex flex-wrap justify-center space-x-1 md:space-x-4">
                    <li><a href="#" class="px-3 py-2 rounded hover:bg-[#8e7d5b] transition">Početna</a></li>
                    <li><a href="#" class="px-3 py-2 rounded hover:bg-[#8e7d5b] transition">O Arhivu</a></li>
                    <li><a href="#" class="px-3 py-2 rounded hover:bg-[#8e7d5b] transition bg-[#8e7d5b]">Fondovi</a></li>
                    <li><a href="#" class="px-3 py-2 rounded hover:bg-[#8e7d5b] transition">Priručnici</a></li>
                    <li><a href="#" class="px-3 py-2 rounded hover:bg-[#8e7d5b] transition">Usluge</a></li>
                    <li><a href="#" class="px-3 py-2 rounded hover:bg-[#8e7d5b] transition">Digitalna Arhiva</a></li>
                    <li><a href="#" class="px-3 py-2 rounded hover:bg-[#8e7d5b] transition">Novosti</a></li>
                    <li><a href="#" class="px-3 py-2 rounded hover:bg-[#8e7d5b] transition">Kontakt</a></li>
                    <li><button class="ml-2 px-3 py-2 bg-[#3498db] rounded hover:bg-blue-600 transition"><i class="fas fa-globe mr-1"></i> EN</button></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-[#2c3e50] to-dark text-white py-20 archive-pattern">
        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl text-black font-bold mb-6">Istražite Istoriju Kroz Originalne Dokumente</h1>
            <p class="text-xl text-black mb-8 max-w-3xl mx-auto">Digitalna arhiva sa preko 100.000 skeniranih dokumenata od srednjeg veka do savremenog doba</p>
            
            <div class="search-box max-w-2xl mx-auto bg-white rounded-lg overflow-hidden p-1 flex">
                <input type="text" placeholder="Pretražite fondove, dokumente, ličnosti..." class="flex-grow px-4 py-3 text-[#2c3e50] focus:outline-none">
                <button class="bg-[#3498db] hover:bg-blue-600 text-white px-6 py-3 transition flex items-center">
                    <i class="fas fa-search mr-2"></i> Pretraži
                </button>
            </div>
            
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <button class="bg-[#8e7d5b] hover:bg-amber-700 px-6 py-3 rounded-lg transition flex items-center">
                    <i class="fas fa-calendar-alt mr-2"></i> Planirane Izložbe
                </button>
                <button class="bg-white text-[#2c3e50] hover:bg-gray-200 px-6 py-3 rounded-lg transition flex items-center">
                    <i class="fas fa-book-open mr-2"></i> Digitalna Čitaonica
                </button>
            </div>
        </div>
    </section>

    <!-- Featured Collections -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Istaknute Zbirke</h2>
                <p class="text-lg max-w-3xl mx-auto">Pregled najznačajnijih fondova i zbirki koje čuvamo u našem arhivu</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Collection Item -->
                <div class="collection-item bg-light rounded-xl overflow-hidden transition duration-300">
                    <div class="h-48 bg-gray-300 relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#2c3e50] to-transparent opacity-80"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <span class="bg-[#8e7d5b] px-3 py-1 rounded-md text-sm">XIX vek</span>
                            <h3 class="text-xl font-bold mt-2">Građanska Useljenja</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="mb-4">Popisi o useljenju građana iz 19. veka sa detaljnim podacima o porodicama, imovini i zanimanjima.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm bg-gray-200 px-2 py-1 rounded">312 dokumenta</span>
                            <a href="#" class="text-[#3498db] hover:underline">Pregledaj fond <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Collection Item -->
                <div class="collection-item bg-light rounded-xl overflow-hidden transition duration-300">
                    <div class="h-48 bg-gray-400 relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#2c3e50] to-transparent opacity-80"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <span class="bg-[#8e7d5b] px-3 py-1 rounded-md text-sm">XVIII vek</span>
                            <h3 class="text-xl font-bold mt-2">Zemljišni Katastri</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="mb-4">Originalni katastarski zapisi sa detaljnim kartografskim prikazima i opisima zemljišnih poseda.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm bg-gray-200 px-2 py-1 rounded">189 dokumenta</span>
                            <a href="#" class="text-[#3498db] hover:underline">Pregledaj fond <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Collection Item -->
                <div class="collection-item bg-light rounded-xl overflow-hidden transition duration-300">
                    <div class="h-48 bg-gray-500 relative">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#2c3e50] to-transparent opacity-80"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <span class="bg-[#8e7d5b] px-3 py-1 rounded-md text-sm">XX vek</span>
                            <h3 class="text-xl font-bold mt-2">Ratni Dnevici</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="mb-4">Lični dnevici i memoari vojnika i civila tokom oba svetska rata.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm bg-gray-200 px-2 py-1 rounded">478 dokumenta</span>
                            <a href="#" class="text-[#3498db] hover:underline">Pregledaj fond <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="#" class="inline-block bg-[#2c3e50] text-white px-8 py-3 rounded-lg hover:bg-[#8e7d5b] transition">
                    Pregledaj Sve Fondove <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Usluge za Istraživače</h2>
                <p class="text-lg max-w-3xl mx-auto">Naša čitaonica i digitalne usluge omogućavaju jednostavan pristup arhivskoj građi</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl p-6 shadow-md">
                    <div class="w-16 h-16 bg-[#3498db] rounded-lg flex items-center justify-center text-white mb-4">
                        <i class="fas fa-book text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Rad Čitaonice</h3>
                    <p class="mb-4">Pristup originalnim dokumentima u kontrolisanim uslovima sa stručnom pomoći arhivara.</p>
                    <ul class="space-y-2">
                        <li class="flex items-center"><i class="fas fa-clock text-[#8e7d5b] mr-2"></i> Ponedeljak-Petak: 8-16h</li>
                        <li class="flex items-center"><i class="fas fa-users text-[#8e7d5b] mr-2"></i> Maks. 15 istraživača</li>
                        <li class="flex items-center"><i class="fas fa-lock text-[#8e7d5b] mr-2"></i> Lična dokumenta obavezna</li>
                    </ul>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-md">
                    <div class="w-16 h-16 bg-[#8e7d5b] rounded-lg flex items-center justify-center text-white mb-4">
                        <i class="fas fa-laptop text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Digitalni Pristup</h3>
                    <p class="mb-4">Preko 45% fondova dostupno u digitalnom obliku putem naše online platforme.</p>
                    <ul class="space-y-2">
                        <li class="flex items-center"><i class="fas fa-search text-[#3498db] mr-2"></i> Napredna pretraga</li>
                        <li class="flex items-center"><i class="fas fa-download text-[#3498db] mr-2"></i> Preuzimanje u PDF formatu</li>
                        <li class="fas fa-hdd text-[#3498db] mr-2"></i> 120.000+ skeniranih stranica</li>
                    </ul>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-md">
                    <div class="w-16 h-16 bg-[#2c3e50] rounded-lg flex items-center justify-center text-white mb-4">
                        <i class="fas fa-file-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Reprografske Usluge</h3>
                    <p class="mb-4">Narudžbine kopija arhivskog gradiva za istraživačke i publikacione potrebe.</p>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="py-2 px-3 text-left">Usluga</th>
                                    <th class="py-2 px-3">Cena</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-2 px-3 border-b">Digitalna kopija (po strani)</td>
                                    <td class="py-2 px-3 border-b text-center">50 RSD</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-3 border-b">Fotokopija (A4)</td>
                                    <td class="py-2 px-3 border-b text-center">20 RSD</td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-3">Stručna konsultacija (sat)</td>
                                    <td class="py-2 px-3 text-center">800 RSD</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Istorijat Našeg Arhiva</h2>
                <p class="text-lg max-w-3xl mx-auto">Više od jednog veka čuvanja istorijskog nasleđa</p>
            </div>
            
            <div class="relative timeline max-w-4xl mx-auto">
                <!-- Timeline Item -->
                <div class="relative pl-16 pb-12 timeline-item">
                    <div class="bg-light p-6 rounded-xl shadow-md">
                        <span class="absolute -left-3 top-6 bg-[#8e7d5b] text-white px-3 py-1 rounded-md text-sm">1912</span>
                        <h3 class="text-xl font-bold mb-2">Osnivanje Arhiva</h3>
                        <p>Osnovan kao deo gradskog muzeja sa inicijalnom zbirkom od 800 dokumenata.</p>
                    </div>
                </div>
                
                <!-- Timeline Item -->
                <div class="relative pl-16 pb-12 timeline-item">
                    <div class="bg-light p-6 rounded-xl shadow-md">
                        <span class="absolute -left-3 top-6 bg-[#8e7d5b] text-white px-3 py-1 rounded-md text-sm">1945</span>
                        <h3 class="text-xl font-bold mb-2">Obnova posle rata</h3>
                        <p>Premeštanje u novi prostor i sistematizacija ratom oštećene građe.</p>
                    </div>
                </div>
                
                <!-- Timeline Item -->
                <div class="relative pl-16 pb-12 timeline-item">
                    <div class="bg-light p-6 rounded-xl shadow-md">
                        <span class="absolute -left-3 top-6 bg-[#8e7d5b] text-white px-3 py-1 rounded-md text-sm">1987</span>
                        <h3 class="text-xl font-bold mb-2">Nova Zgrada</h3>
                        <p>Preseljenje u moderno objekt sa kontrolisanim uslovima čuvanja.</p>
                    </div>
                </div>
                
                <!-- Timeline Item -->
                <div class="relative pl-16 timeline-item">
                    <div class="bg-light p-6 rounded-xl shadow-md">
                        <span class="absolute -left-3 top-6 bg-[#8e7d5b] text-white px-3 py-1 rounded-md text-sm">2015</span>
                        <h3 class="text-xl font-bold mb-2">Digitalna Transformacija</h3>
                        <p>Pokretanje projekta digitalizacije i online pretražive baze podataka.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News & Events -->
    <section class="py-16 bg-[#2c3e50] text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Novosti i Događaji</h2>
                <p class="text-lg max-w-3xl mx-auto">Budite obavešteni o našim izložbama, predavanjima i novim fondovima</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-dark rounded-xl overflow-hidden">
                    <div class="p-6">
                        <span class="bg-[#3498db] px-3 py-1 rounded-md text-sm">Nova Akvizicija</span>
                        <h3 class="text-xl font-bold my-3">Porodična arhiva Vojnović</h3>
                        <p class="mb-4">Donacija od 1.200 dokumenta i fotografija iz perioda 1890-1945. godine.</p>
                        <div class="flex items-center text-sm">
                            <i class="fas fa-calendar mr-2 text-[#8e7d5b]"></i>
                            <span>Dostupno od 15. Septembra 2023.</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-dark rounded-xl overflow-hidden">
                    <div class="p-6">
                        <span class="bg-[#8e7d5b] px-3 py-1 rounded-md text-sm">Predavanje</span>
                        <h3 class="text-xl font-bold my-3">Arhivsko Građe kao Izvor za Demografsku Istoriju</h3>
                        <p class="mb-4">Dr. Marko Petrović, 12. Oktobar 2023. u 18h u sali arhiva.</p>
                        <div class="flex items-center text-sm">
                            <i class="fas fa-clock mr-2 text-[#8e7d5b]"></i>
                            <span>Trajanje: 90 minuta sa diskusijom</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 bg-dark rounded-xl p-6">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="mb-4 md:mb-0 md:mr-6">
                        <h3 class="text-xl font-bold">Pretplatite se na Bilten</h3>
                        <p>Mesečne obaveštenja o novostima i događajima</p>
                    </div>
                    <div class="flex-grow flex">
                        <input type="email" placeholder="Vaša email adresa" class="flex-grow px-4 py-3 rounded-l-lg text-[#2c3e50] focus:outline-none">
                        <button class="bg-[#3498db] hover:bg-blue-600 text-white px-6 py-3 rounded-r-lg transition">
                            Prijava <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-gray-300 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold text-white mb-4">Istorijski Arhiv</h3>
                    <p class="mb-4">Čuvamo i činimo dostupnim istorijsko nasleđe za sadašnje i buduće generacije.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Brzi Linkovi</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">O Arhivu</a></li>
                        <li><a href="#" class="hover:text-white transition">Fondovi i Zbirke</a></li>
                        <li><a href="#" class="hover:text-white transition">Digitalna Arhiva</a></li>
                        <li><a href="#" class="hover:text-white transition">Usluge za Istraživače</a></li>
                        <li><a href="#" class="hover:text-white transition">Česta Pitanja</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Radno Vreme</h4>
                    <ul class="space-y-2">
                        <li class="flex justify-between">
                            <span>Ponedeljak - Petak:</span>
                            <span>08:00 - 16:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Subota:</span>
                            <span>09:00 - 13:00</span>
                        </li>
                        <li class="flex justify-between">
                            <span>Nedelja:</span>
                            <span>Zatvoreno</span>
                        </li>
                        <li class="pt-4">
                            <span>Čitaonica:</span>
                            <span class="block">Po prethodnoj najavi</span>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold text-white mb-4">Kontakt</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-[#8e7d5b]"></i>
                            <span>Arhivska ulica 15, 11000 Beograd</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3 text-[#8e7d5b]"></i>
                            <span>+381 11 123 4567</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-[#8e7d5b]"></i>
                            <span>info@istorijski-arhiv.rs</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-sm">
                <p>&copy; 2023 Istorijski Arhiv. Sva prava zadržana. Dizajn prilagođen za sve uređaje.</p>
            </div>
        </div>
    </footer>

    <!-- Back to top button -->
    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" class="fixed bottom-6 right-6 bg-[#3498db] text-white p-3 rounded-full shadow-lg hover:bg-blue-600 transition">
        <i class="fas fa-arrow-up"></i>
    </button>
</body>
</html>
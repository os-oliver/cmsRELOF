<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omladinski Centar | Aktivnosti za mlade</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FF6B6B',
                        primary_hover: '#ea580c',
                        secondary: '#4ECDC4',
                        secondary_hover: '#fdba74',
                        accent: '#FFD166',
                        accent_hover: '#fbbf24',
                        primary_text: '#332a21',
                        secondary_text: '#7c5e3d',
                        dark: '#1A535C',
                        light: '#F7FFF7'
                    }
                }
            }
        }
    </script>
    <style>
        * {
            color: black;
        }

        .instagram-feed {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 8px;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .testimonial-card {
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            background-color: rgba(255, 214, 102, 0.1);
        }

        .program-card:hover .program-icon {
            transform: scale(1.1);
        }

        .stat-card:hover {
            background-color: rgba(122, 197, 205, 0.1);
        }
    </style>
</head>

<body class="bg-light font-sans text-dark">

    <!-- Enhanced Header -->
    <div id="mobileMenu" class="fixed inset-0 z-40  hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50" id="mobileMenuOverlay"></div>
        <div class="fixed top-0 right-0 h-full w-80 max-w-full bg-secondary_background shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out"
            id="mobileMenuPanel">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-xl text-primary_text font-heading font-bold">Menu</h2>
                    <button id="closeMobileMenu" class="text-primary_text hover:text-accent transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <nav id="navBarIDm" class="space-y-4">
                    <a data-page="Pocetna" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all">
                        <i class="fas fa-home mr-3 text-primary"></i>Početna
                    </a>

                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all"
                            id="mobileAboutToggle">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-3 text-secondary"></i>O nama
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200"
                                id="mobileAboutIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileAboutMenu">
                            <a data-page="Uvod" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-book mr-2 text-primary"></i>Uvod
                            </a>
                            <a data-page="Misija i vizija" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-flag mr-2 text-secondary"></i>Misija i vizija
                            </a>
                            <a data-page="Istorijat" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-history mr-2 text-accent"></i>Istorijat
                            </a>
                            <a data-page="Rukovodstvo" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-users-cog mr-2 text-secondary"></i>Rukovodstvo
                            </a>
                            <a data-page="OrganizacionaStruktura" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-sitemap mr-2 text-secondary"></i>Organizaciona struktura
                            </a>

                            <a data-page="Objekat" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-building mr-2 text-secondary_text"></i>Objekat
                            </a>
                            <a data-page="Donacije i podrška" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-hand-holding-heart mr-2 text-accent"></i>Donacije i podrška
                            </a>
                            <a data-page="Partneri" href="#"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                                <i class="fas fa-handshake mr-2 text-primary"></i>Partneri
                            </a>
                        </div>
                    </div>

                    <a data-page="Dokumenti" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all">
                        <i class="fas fa-folder-open mr-3 text-accent"></i>Dokumenti
                    </a>

                    <a data-page="Vesti" href="#"
                        class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-accent transition-colors">
                        <i class="fas fa-newspaper mr-2 text-primary"></i>Vesti
                    </a>

                    <a data-page="Kontakt" href="#"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-accent hover:bg-surface rounded-lg transition-all">
                        <i class="fas fa-address-book mr-3 text-secondary"></i>Kontakt
                    </a>
                </nav>
            </div>
        </div>
    </div>

    <!-- Header/Navigation -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <div class="bg-primary w-10 h-10 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-users  text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold">Omladinski <span class="text-primary">Centar</span></h1>
                </div>

                <nav id="navBarID" class="hidden md:flex space-x-8">
                    <a href="#" class="nav-link font-medium hover:text-primary px-3 py-2">Početna</a>
                    <div class="dropdown relative group">
                        <button
                            class="nav-link text-primary_text font-medium hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
                            <span class="hidden xl:inline">O nama</span>
                            <i
                                class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                        </button>
                        <div
                            class="dropdown-menu absolute top-full left-1/2 transform -translate-x-1/2 min-w-max max-w-xs w-auto bg-secondary_background rounded-xl shadow-2xl border border-surface opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-3 backdrop-blur-sm">
                            <a href="#" static="true"
                                class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                                <i class="fas fa-book mr-3 text-primary flex-shrink-0 w-4 text-sm"></i>
                                <span class="font-medium">Uvod</span>
                            </a>
                            <a href="#" static="true"
                                class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                                <i class="fas fa-flag mr-3 text-secondary flex-shrink-0 w-4 text-sm"></i>
                                <span class="font-medium">Misija i vizija</span>
                            </a>
                            <a href="#" static="true"
                                class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                                <i class="fas fa-history mr-3 text-accent flex-shrink-0 w-4 text-sm"></i>
                                <span class="font-medium">Istorijat</span>
                            </a>
                            <a href="#"
                                class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                                <i class="fas fa-users-cog mr-3 text-secondary flex-shrink-0 w-4 text-sm"></i>
                                <span class="font-medium">Rukovodstvo</span>
                            </a>
                            <a href="#"
                                class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                                <i class="fas fa-sitemap mr-3 text-secondary flex-shrink-0 w-4 text-sm"></i>
                                <span class="font-medium">Organizaciona struktura</span>
                            </a>

                            <a href="#" static="true"
                                class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                                <i class="fas fa-building mr-3 text-secondary_text flex-shrink-0 w-4 text-sm"></i>
                                <span class="font-medium">Objekat</span>
                            </a>
                            <a href="#" static="true"
                                class="dropdown-item flex items-center px-5 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-2">
                                <i class="fas fa-hand-holding-heart mr-3 text-accent flex-shrink-0 w-4 text-sm"></i>
                                <span class="font-medium">Donacije i podrška</span>
                            </a>
                        </div>
                    </div>
                    <a href="#" class="nav-link font-medium hover:text-primary px-3 py-2">Vesti</a>
                    <a href="#" class="nav-link font-medium hover:text-primary px-3 py-2">Manifestacije</a>
                    <a href="#" class="nav-link font-medium hover:text-primary px-3 py-2">Izložbe</a>
                    <a href="#" class="nav-link font-medium hover:text-primary px-3 py-2">Predstave</a>
                    <a href="#" class="nav-link font-medium hover:text-primary px-3 py-2">Filmovi</a>
                    <a href="#" class="nav-link font-medium hover:text-primary px-3 py-2">Galerija</a>
                    <a href="#" class="nav-link font-medium hover:text-primary px-3 py-2">Dokumenti</a>

                    <?php
                        if (isset($_GET['locale'])) {
                            $_SESSION['locale'] = $_GET['locale'];
                        }
                        $locale = $_SESSION['locale'] ?? 'sr';

                        $languages = [
                            'sr' => ['label' => 'Srpski', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
                            'sr-Cyrl' => ['label' => 'Српски', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"/><path fill="#d80027" d="M0 0h512v167H0z"/><path fill="#eee" d="M0 345h512v167H0z"/><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"/><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"/><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"/></g></svg>'],
                            'en' => ['label' => 'English', 'flag' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"/></mask><g mask="url(#a)"><path fill="#eee" d="m0 0 8 22-8 23v23l32 54-32 54v32l32 48-32 48v32l32 54-32 54v68l22-8 23 8h23l54-32 54 32h32l48-32 48 32h32l54-32 54 32h68l-8-22 8-23v-23l-32-54 32-54v-32l-32-48 32-48v-32l-32-54 32-54V0l-22 8-23-8h-23l-54 32-54-32h-32l-48 32-48-32h-32l-54 32L68 0H0z"/><path fill="#0052b4" d="M336 0v108L444 0Zm176 68L404 176h108zM0 176h108L0 68ZM68 0l108 108V0Zm108 512V404L68 512ZM0 444l108-108H0Zm512-108H404l108 108Zm-68 176L336 404v108z"/><path fill="#d80027" d="M0 0v45l131 131h45L0 0zm208 0v208H0v96h208v208h96V304h208v-96H304V0h-96zm259 0L336 131v45L512 0h-45zM176 336 0 512h45l131-131v-45zm160 0 176 176v-45L381 336h-45z"/></g></svg>'],
                        ];

                        if (!isset($languages[$locale])) {
                            $locale = 'sr';
                        }
                    ?>
                    <div class="locale dropdown nonPage relative group">
                        <button
                            class="nav-link text-primary_text font-semibold hover:text-primary transition-all duration-200 flex items-center px-3 py-2 rounded-lg hover:bg-surface group">
                            <span class="mr-2 flex-shrink-0"><?= $languages[$locale]['flag'] ?></span>
                            <span class="hidden xl:inline text-sm font-medium"><?= $languages[$locale]['label'] ?></span>
                            <i
                                class="fas fa-chevron-down ml-1 text-xs group-hover:rotate-180 transition-transform duration-200"></i>
                        </button>
                        <div class="dropdown-menu absolute top-full left-1/2 transform -translate-x-1/2 min-w-max max-w-xs w-auto bg-secondary_background rounded-xl shadow-2xl border border-surface opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-3 backdrop-blur-sm">
                            <?php foreach ($languages as $key => $lang): ?>
                                <a href="?locale=<?= $key ?>"
                                    class="dropdown-item flex items-center px-4 py-3 hover:bg-gradient-to-r hover:from-surface hover:to-surface text-sm whitespace-nowrap transition-all duration-200 rounded-lg mx-1">
                                    <span class="mr-3 flex-shrink-0"><?= $lang['flag'] ?></span>
                                    <span class="font-medium"><?= $lang['label'] ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </nav>

                <div class="flex items-center space-x-4">
                    <div class="flex space-x-3">
                        <a href="#" class="text-dark hover:text-primary"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-dark hover:text-primary"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-dark hover:text-primary"><i class="fab fa-youtube"></i></a>
                    </div>
                    <button class="md:hidden text-2xl">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-primary to-secondary py-16 ">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4">Prostor za tvoje <span
                            class="text-accent">ideje</span> i <span class="text-accent">energiju</span></h2>
                    <p class="text-xl mb-8">Pridruži se našim programima, razvijaj talente, stiči nova prijateljstva i
                        učestvuj u promenama!</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button
                            class="bg-accent text-dark font-bold py-3 px-6 rounded-full hover:bg-yellow-400 transition duration-300">Pridruži
                            se programu</button>
                        <button
                            class="bg-white text-dark font-bold py-3 px-6 rounded-full hover:bg-gray-100 transition duration-300">Saznaj
                            više</button>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="relative">
                        <div class="bg-white rounded-xl p-4 shadow-xl w-64 h-64 transform rotate-6">
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-full"></div>
                        </div>
                        <div
                            class="bg-accent rounded-xl p-4 shadow-xl w-64 h-64 absolute top-5 left-5 transform -rotate-6">
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Naši <span class="text-primary">Programi</span></h2>
                <p class="text-xl max-w-3xl mx-auto">Pružamo raznovrsne aktivnosti koje podstiču kreativnost, razvijaju
                    veštine i omogućavaju mladima da budu aktivni učesnici u društvu.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Program Card 1 -->
                <div
                    class="program-card bg-white rounded-xl shadow-lg p-6 border-t-4 border-primary transform transition duration-300">
                    <div
                        class="program-icon w-16 h-16 bg-primary rounded-full flex items-center justify-center mb-6 mx-auto transition duration-300">
                        <i class="fas fa-paint-brush  text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-center">Kreativne Radionice</h3>
                    <p class="mb-4 text-center">Fotografija, dizajn, umetničko izražavanje i multimedijalni projekti za
                        omladinu.</p>
                    <div class="text-center">
                        <button class="text-primary font-medium hover:underline">Saznaj više</button>
                    </div>
                </div>

                <!-- Program Card 2 -->
                <div
                    class="program-card bg-white rounded-xl shadow-lg p-6 border-t-4 border-secondary transform transition duration-300">
                    <div
                        class="program-icon w-16 h-16 bg-secondary rounded-full flex items-center justify-center mb-6 mx-auto transition duration-300">
                        <i class="fas fa-graduation-cap  text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-center">Obrazovni Projekti</h3>
                    <p class="mb-4 text-center">Radionice, predavanja i programi profesionalnog usavršavanja za mlade.
                    </p>
                    <div class="text-center">
                        <button class="text-secondary font-medium hover:underline">Saznaj više</button>
                    </div>
                </div>

                <!-- Program Card 3 -->
                <div
                    class="program-card bg-white rounded-xl shadow-lg p-6 border-t-4 border-accent transform transition duration-300">
                    <div
                        class="program-icon w-16 h-16 bg-accent rounded-full flex items-center justify-center mb-6 mx-auto transition duration-300">
                        <i class="fas fa-campground text-dark text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-center">Kampovi za Mlade</h3>
                    <p class="mb-4 text-center">Letnji i zimski kampovi sa edukativnim i rekreativnim aktivnostima.</p>
                    <div class="text-center">
                        <button class="text-accent font-medium hover:underline">Saznaj više</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-12">
                <div>
                    <h2 class="text-4xl font-bold mb-4">Predstojeći <span class="text-primary">Događaji</span></h2>
                    <p class="text-xl">Pridruži se našim aktivnostima i budi deo omladinske zajednice</p>
                </div>
                <button
                    class="mt-6 md:mt-0 bg-primary  font-bold py-3 px-6 rounded-full hover:bg-red-500 transition duration-300">Pogledaj
                    kalendar</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Event Card 1 -->
                <div class="event-card bg-white rounded-xl shadow-lg overflow-hidden transition duration-300">
                    <div class="h-48 bg-gradient-to-r from-secondary to-primary flex items-center justify-center">
                        <div class="text-center p-4">
                            <div class="text-5xl font-bold ">15</div>
                            <div class="text-xl font-bold ">Jun</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-3 h-3 bg-primary rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600">Radionica</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Digitalni Marketing za Mlade</h3>
                        <p class="text-gray-600 mb-4">Nauči osnove digitalnog marketinga i kako da promovišeš svoje
                            ideje.</p>
                        <button class="text-primary font-medium hover:underline">Prijavi se</button>
                    </div>
                </div>

                <!-- Event Card 2 -->
                <div class="event-card bg-white rounded-xl shadow-lg overflow-hidden transition duration-300">
                    <div class="h-48 bg-gradient-to-r from-accent to-secondary flex items-center justify-center">
                        <div class="text-center p-4">
                            <div class="text-5xl font-bold text-dark">22</div>
                            <div class="text-xl font-bold text-dark">Jun</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-3 h-3 bg-secondary rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600">Konferencija</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Omladinsko Preduzetništvo</h3>
                        <p class="text-gray-600 mb-4">Inspirativne priče mladih preduzetnika i mogućnosti za
                            finansiranje.</p>
                        <button class="text-secondary font-medium hover:underline">Prijavi se</button>
                    </div>
                </div>

                <!-- Event Card 3 -->
                <div class="event-card bg-white rounded-xl shadow-lg overflow-hidden transition duration-300">
                    <div class="h-48 bg-gradient-to-r from-primary to-accent flex items-center justify-center">
                        <div class="text-center p-4">
                            <div class="text-5xl font-bold ">30</div>
                            <div class="text-xl font-bold ">Jun</div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <div class="w-3 h-3 bg-accent rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600">Kamp</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Letnji Lider Kamp</h3>
                        <p class="text-gray-600 mb-4">Sedmodnevni kamp za razvoj ličnosti i vođenja za mlade 15-20
                            godina.</p>
                        <button class="text-accent font-medium hover:underline">Prijavi se</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 bg-gradient-to-r from-primary to-secondary ">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="stat-card p-6 rounded-xl transition duration-300">
                    <div class="text-5xl font-bold mb-2">850+</div>
                    <div class="text-xl">Učesnika</div>
                </div>
                <div class="stat-card p-6 rounded-xl transition duration-300">
                    <div class="text-5xl font-bold mb-2">120+</div>
                    <div class="text-xl">Radionica</div>
                </div>
                <div class="stat-card p-6 rounded-xl transition duration-300">
                    <div class="text-5xl font-bold mb-2">25+</div>
                    <div class="text-xl">Projekata</div>
                </div>
                <div class="stat-card p-6 rounded-xl transition duration-300">
                    <div class="text-5xl font-bold mb-2">15+</div>
                    <div class="text-xl">Partnera</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Priče o <span class="text-primary">Uspehu</span></h2>
                <p class="text-xl max-w-3xl mx-auto">Čujte šta mladi koji su prošli kroz naše programe imaju da kažu</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="testimonial-card bg-white rounded-xl shadow-lg p-6 border-l-4 border-primary">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-gray-200 rounded-full overflow-hidden mr-4">
                            <div class="bg-gray-300 w-full h-full"></div>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Marko Petrović</h4>
                            <p class="text-gray-600">Učesnik radionica</p>
                        </div>
                    </div>
                    <p class="italic">"Radionica o digitalnom marketingu mi je promenila život. Zahvaljujući stečenim
                        znanjima, započeo sam svoj online biznis dok sam još student!"</p>
                    <div class="flex mt-4 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card bg-white rounded-xl shadow-lg p-6 border-l-4 border-secondary">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-gray-200 rounded-full overflow-hidden mr-4">
                            <div class="bg-gray-300 w-full h-full"></div>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Ana Jovanović</h4>
                            <p class="text-gray-600">Volonterka</p>
                        </div>
                    </div>
                    <p class="italic">"Volontiranje u Centru mi je otvorilo vrata za prvi posao. Stekla sam iskustvo,
                        veštine i samopouzdanje koje mi je poslodavac prepoznao."</p>
                    <div class="flex mt-4 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="testimonial-card bg-white rounded-xl shadow-lg p-6 border-l-4 border-accent">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-gray-200 rounded-full overflow-hidden mr-4">
                            <div class="bg-gray-300 w-full h-full"></div>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Nikola Stanković</h4>
                            <p class="text-gray-600">Mentor</p>
                        </div>
                    </div>
                    <p class="italic">"Rad sa mladima u Centru je neprestano izazovan i inspirativan. Vidim kako rastu i
                        razvijaju se, a njihova energija i entuzijazam podstiču i mene."</p>
                    <div class="flex mt-4 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Pratite nas na <span class="text-primary">Društvenim Mrežama</span>
                </h2>
                <p class="text-xl max-w-3xl mx-auto">Budite u toku sa najnovijim dešavanjima, fotografijama i vestima
                </p>
            </div>

            <!-- Instagram Feed -->
            <div class="instagram-feed mb-12">
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-32"></div>
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-32"></div>
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-32"></div>
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-32"></div>
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-32"></div>
                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-32"></div>
            </div>

            <!-- Social Media Links -->
            <div class="flex justify-center space-x-6">
                <a href="#"
                    class="w-16 h-16 bg-primary rounded-full flex items-center justify-center  text-2xl hover:bg-red-500 transition duration-300">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#"
                    class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center  text-2xl hover:bg-blue-700 transition duration-300">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#"
                    class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center  text-2xl hover:bg-red-700 transition duration-300">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#"
                    class="w-16 h-16 bg-blue-400 rounded-full flex items-center justify-center  text-2xl hover:bg-blue-500 transition duration-300">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-gradient-to-r from-secondary to-primary ">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-4xl font-bold mb-4">Prijavite se za <span class="text-accent">Newsletter</span></h2>
                <p class="text-xl mb-8">Budite obavešteni o najnovijim dešavanjima, radionicama i mogućnostima za mlade.
                </p>

                <form class="flex flex-col sm:flex-row gap-4">
                    <input type="email" placeholder="Vaša email adresa"
                        class="flex-grow px-6 py-3 rounded-full text-dark focus:outline-none">
                    <button type="submit"
                        class="bg-accent text-dark font-bold px-8 py-3 rounded-full hover:bg-yellow-400 transition duration-300">Prijavi
                        se</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark  py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Omladinski Centar</h3>
                    <p class="mb-4">Prostor za mlade da razvijaju svoje potencijale, stiču nova znanja i iskustva kroz
                        raznovrsne programe i aktivnosti.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-300 hover:"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-300 hover:"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-gray-300 hover:"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Brzi Linkovi</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-primary">Početna</a></li>
                        <li><a href="#" class="hover:text-primary">O nama</a></li>
                        <li><a href="#" class="hover:text-primary">Programi</a></li>
                        <li><a href="#" class="hover:text-primary">Vesti</a></li>
                        <li><a href="#" class="hover:text-primary">Partneri</a></li>
                        <li><a href="#" class="hover:text-primary">Dokumenti</a></li>
                        <li><a href="#" class="hover:text-primary">Kontakt</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Programi</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-primary">Kreativne radionice</a></li>
                        <li><a href="#" class="hover:text-primary">Obrazovni projekti</a></li>
                        <li><a href="#" class="hover:text-primary">Kampovi za mlade</a></li>
                        <li><a href="#" class="hover:text-primary">Volonterski programi</a></li>
                        <li><a href="#" class="hover:text-primary">Mentorski programi</a></li>
                        <li><a href="#" class="hover:text-primary">EU projekti</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-4">Kontakt</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-primary mt-1 mr-3"></i>
                            <span>Omladinska ulica 15, Beograd</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone text-primary mt-1 mr-3"></i>
                            <span>+381 11 123 4567</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-primary mt-1 mr-3"></i>
                            <span>info@omladinskicentar.rs</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-primary mt-1 mr-3"></i>
                            <span>Pon-Pet: 09:00 - 20:00<br>Sub: 10:00 - 15:00</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-12 pt-6 text-center text-gray-400">
                <p>&copy; 2023 Omladinski Centar. Sva prava zadržana.</p>
            </div>
        </div>
    </footer>

    <script>
        // Simple JavaScript for mobile menu toggle
        document.addEventListener('DOMContentLoaded', function () {
            const menuBtn = document.querySelector('button[class*="md:hidden"]');
            const nav = document.querySelector('nav');

            menuBtn.addEventListener('click', function () {
                nav.classList.toggle('hidden');
                nav.classList.toggle('flex');
                nav.classList.toggle('flex-col');
                nav.classList.toggle('absolute');
                nav.classList.toggle('bg-white');
                nav.classList.toggle('top-16');
                nav.classList.toggle('left-0');
                nav.classList.toggle('right-0');
                nav.classList.toggle('p-4');
                nav.classList.toggle('space-y-4');
                nav.classList.toggle('shadow-lg');
            });
        });
    </script>
</body>

</html>
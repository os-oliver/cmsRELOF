<?php use App\Models\Text;

if (isset($_GET['locale'])) {
    $_SESSION['locale'] = $_GET['locale'];
}
$locale = $_SESSION['locale'] ?? 'sr-Cyrl';
$dynamicText = (new Text())->getDynamicText($locale);
?>
<header class="fixed w-full z-50 transition-all duration-300 py-3 backdrop-blur-md shadow-sm bg-paper/95"><div class="container mx-auto px-4 flex justify-between items-center"><!-- Logo Section --><div class="flex items-center space-x-3 flex-shrink-0"><div class="artistic-frame w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-ochre to-terracotta rounded-lg flex items-center justify-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6 sm:h-8 sm:w-8 text-paper"><path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd"></path></svg></div><div class="hidden sm:block"><h1 class="text-xl lg:text-2xl font-display text-slate font-bold tracking-wider"><h1 class="text-xl lg:text-2xl font-display text-slate font-bold tracking-wider"><?=$dynamicText[1]?></h1></h1><p class="text-xs text-terracotta tracking-widest hidden md:block"><p class="text-xs text-terracotta tracking-widest hidden md:block"><?=$dynamicText[2]?></p></p></div><div class="block sm:hidden"><h1 class="text-lg font-display text-slate font-bold"><h1 class="text-lg font-display text-slate font-bold"><?=$dynamicText[3]?></h1></h1></div></div><!-- Desktop Navigation --><nav id="navBarID" class="hidden lg:flex space-x-4 xl:space-x-8"><a href="/" class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap"><i class="fas fa-home mr-2 text-terracotta group-hover:text-coral transition-colors"></i><span class="hidden xl:inline">Pocetna</span></a><div class="dropdown relative group"><button class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap"><i class="fas fa-info-circle mr-2 text-ochre group-hover:text-sage transition-colors"></i><span class="hidden xl:inline">O nama</span><i class="fas fa-chevron-down ml-1 text-xs"></i></button><div class="dropdown-menu absolute top-full left-0 w-48 bg-paper rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50"><a href="/o-nama/cilj" class="dropdown-item flex items-center px-4 py-2 hover:bg-slate-50 rounded-md text-sm"><i class="fas fa-bullseye mr-2 text-royal-blue"></i>Cilj
                        </a><a href="/o-nama/zaposleni" class="dropdown-item flex items-center px-4 py-2 hover:bg-slate-50 rounded-md text-sm"><i class="fas fa-sitemap mr-2 text-terracotta"></i>Zaposleni
                        </a><a href="/o-nama/misija" class="dropdown-item flex items-center px-4 py-2 hover:bg-slate-50 rounded-md text-sm"><i class="fas fa-flag mr-2 text-deep-teal"></i>Misija
                        </a></div></div><a href="/dogadjaji" class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap"><i class="fas fa-calendar-alt mr-2 text-royal-blue group-hover:text-deep-teal transition-colors"></i><span class="hidden xl:inline">Dogadjaji</span></a><a href="/galerija" class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap"><i class="fas fa-images mr-2 text-velvet group-hover:text-crimson transition-colors"></i><span class="hidden xl:inline">Galerija</span></a><a href="/dokumenti" class="nav-link text-slate font-semibold hover:text-terracotta transition-colors group flex items-center whitespace-nowrap"><i class="fas fa-folder-open mr-2 text-coral group-hover:text-terracotta transition-colors"></i><span class="hidden xl:inline">Dokumenti</span></a><a href="/kontakt" class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap"><i class="fas fa-address-book mr-2 text-deep-teal group-hover:text-sage transition-colors"></i><span class="hidden xl:inline">Kontakt</span></a><div class="dropdown nonPage relative group"><button class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap"><span class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><mask id="a"><circle cx="256" cy="256" r="256" fill="#fff"></circle></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"></path><path fill="#d80027" d="M0 0h512v167H0z"></path><path fill="#eee" d="M0 345h512v167H0z"></path><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"></path><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"></path><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"></path></g></svg></span><span class="hidden xl:inline">Srpski</span><i class="fas fa-chevron-down ml-1 text-xs"></i></button><div class="dropdown-menu absolute top-full left-0 w-48 bg-paper rounded-md shadow-lg z-50"><a href="?locale=sr" class="dropdown-item flex items-center px-4 py-2 hover:bg-slate-50 rounded-md text-sm"><span class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><mask id="a-2"><circle cx="256" cy="256" r="256" fill="#fff"></circle></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"></path><path fill="#d80027" d="M0 0h512v167H0z"></path><path fill="#eee" d="M0 345h512v167H0z"></path><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"></path><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"></path><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"></path></g></svg></span>
                                Srpski                            </a><a href="?locale=sr-Cyrl" class="dropdown-item flex items-center px-4 py-2 hover:bg-slate-50 rounded-md text-sm"><span class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><mask id="a-3"><circle cx="256" cy="256" r="256" fill="#fff"></circle></mask><g mask="url(#a)"><path fill="#0052b4" d="m0 167 253.8-19.3L512 167v178l-254.9 32.3L0 345z"></path><path fill="#d80027" d="M0 0h512v167H0z"></path><path fill="#eee" d="M0 345h512v167H0z"></path><path fill="#d80027" d="M66.2 144.7v127.7c0 72.6 94.9 95 94.9 95s94.9-22.4 94.9-95V144.7z"></path><path fill="#ffda44" d="M105.4 167h111.4v-44.6l-22.3 11.2-33.4-33.4-33.4 33.4-22.3-11.2zm128.3 123.2-72.3-72.4L89 290.2l23.7 23.6 48.7-48.7 48.7 48.7z"></path><path fill="#eee" d="M233.7 222.6H200a22.1 22.1 0 0 0 3-11.1 22.3 22.3 0 0 0-42-10.5 22.3 22.3 0 0 0-41.9 10.5 22.1 22.1 0 0 0 3 11.1H89a23 23 0 0 0 23 22.3h-.7c0 12.3 10 22.2 22.3 22.2 0 11 7.8 20 18.1 21.9l-17.5 39.6a72.1 72.1 0 0 0 27.2 5.3 72.1 72.1 0 0 0 27.2-5.3L171.1 289c10.3-2 18.1-11 18.1-21.9 12.3 0 22.3-10 22.3-22.2h-.8a23 23 0 0 0 23-22.3z"></path></g></svg></span>
                                Српски                            </a><a href="?locale=en" class="dropdown-item flex items-center px-4 py-2 hover:bg-slate-50 rounded-md text-sm"><span class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512"><mask id="a-4"><circle cx="256" cy="256" r="256" fill="#fff"></circle></mask><g mask="url(#a)"><path fill="#eee" d="m0 0 8 22-8 23v23l32 54-32 54v32l32 48-32 48v32l32 54-32 54v68l22-8 23 8h23l54-32 54 32h32l48-32 48 32h32l54-32 54 32h68l-8-22 8-23v-23l-32-54 32-54v-32l-32-48 32-48v-32l-32-54 32-54V0l-22 8-23-8h-23l-54 32-54-32h-32l-48 32-48-32h-32l-54 32L68 0H0z"></path><path fill="#0052b4" d="M336 0v108L444 0Zm176 68L404 176h108zM0 176h108L0 68ZM68 0l108 108V0Zm108 512V404L68 512ZM0 444l108-108H0Zm512-108H404l108 108Zm-68 176L336 404v108z"></path><path fill="#d80027" d="M0 0v45l131 131h45L0 0zm208 0v208H0v96h208v208h96V304h208v-96H304V0h-96zm259 0L336 131v45L512 0h-45zM176 336 0 512h45l131-131v-45zm160 0 176 176v-45L381 336h-45z"></path></g></svg></span>
                                English                            </a></div></div></nav><!-- Search & Mobile Toggle --><div class="flex items-center space-x-2 sm:space-x-4"><!-- Search Container --><div class="relative"><button id="searchButton" aria-label="Search" class="text-slate-500 hover:text-terracotta transition-colors focus:outline-none p-2"><i class="fas fa-search"></i></button><!-- Search Input - positioned to avoid nav overlap --><div id="searchInputContainer" class="absolute right-0 top-full mt-2 hidden opacity-0 transition-all duration-300 ease-in-out z-50 min-w-[280px] bg-white rounded-md shadow-lg border border-gray-200 overflow-hidden"><form id="searchForm" action="/search" method="GET" class="flex items-center w-full p-1.5"><input type="text" name="q" placeholder="Search..." id="searchInput" required class="flex-1 border-0 focus:outline-none focus:ring-0 text-sm px-3 py-1.5 text-gray-700 placeholder-gray-400"/><div class="flex items-center space-x-1 ml-2"><button type="submit" aria-label="Submit search" class="text-slate-500 hover:text-terracotta transition-colors focus:outline-none p-1.5 rounded-full hover:bg-gray-100 w-8 h-8 flex items-center justify-center"><i class="fas fa-search text-sm"></i></button><button type="button" id="closeSearch" aria-label="Clear search" class="text-slate-500 hover:text-terracotta transition-colors focus:outline-none p-1.5 rounded-full hover:bg-gray-100 w-8 h-8 flex items-center justify-center"><i class="fas fa-times text-sm"></i></button></div></form></div></div><!-- Mobile Menu Button --><button id="hamburger" class="hamburger lg:hidden text-slate w-8 h-8 flex flex-col justify-center space-y-1 p-1"><span class="block w-6 h-0.5 bg-slate rounded transition-all duration-300"></span><span class="block w-6 h-0.5 bg-slate rounded transition-all duration-300"></span><span class="block w-6 h-0.5 bg-slate rounded transition-all duration-300"></span></button></div></div></header>
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
                        'brush-stroke': "url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 400 40\" width=\"400\" height=\"40\"><path d=\"M20,20 C50,5 100,35 150,20 C200,5 250,35 300,20 C350,5 380,35 380,20\" fill=\"none\" stroke=\"%23d4a373\" stroke-width=\"10\" stroke-linecap=\"round\"/></svg>')",
                    }
                }
            }
        }
        const btn = document.getElementById('increaseFontBtn');

        let currentSize = 16;       // initial font size in px
        let step = 2;               // px to increase or decrease per click
        let maxSteps = 3;           // max increments before toggling direction
        let count = 0;              // how many increments or decrements done
        let increasing = true;      // track if currently increasing font size

        btn.addEventListener('click', () => {
            if (increasing) {
                currentSize += step;
                count++;
                if (count === maxSteps) {
                    increasing = false;
                    btn.textContent = 'A-'; // change button to decrease
                }
            } else {
                currentSize -= step;
                count--;
                if (count === 0) {
                    increasing = true;
                    btn.textContent = 'A+'; // change button back to increase
                }
            }
            // Apply font size to body (all page)
            document.body.style.fontSize = currentSize + 'px';
        });

        const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown-toggle');

        mobileDropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', (e) => {
                const dropdown = toggle.closest('.mobile-dropdown');
                dropdown.classList.toggle('active');
            });
        });
        document.getElementById('searchButton').addEventListener('click', function () {
            const container = document.getElementById('searchInputContainer');
            const input = document.getElementById('searchInput');

            if (container.classList.contains('hidden')) {
                container.classList.remove('hidden');
                setTimeout(() => {
                    container.classList.remove('opacity-0');
                    input.focus();
                }, 10);
            }
        });

        document.getElementById('closeSearch').addEventListener('click', function () {
            const container = document.getElementById('searchInputContainer');
            container.classList.add('opacity-0');
            setTimeout(() => {
                container.classList.add('hidden');
            }, 300);
        });

        document.addEventListener('click', function (e) {
            const searchContainer = document.getElementById('searchInputContainer');
            const searchButton = document.getElementById('searchButton');

            if (!searchContainer.contains(e.target) && !searchButton.contains(e.target)) {
                searchContainer.classList.add('opacity-0');
                setTimeout(() => {
                    searchContainer.classList.add('hidden');
                }, 300);
            }
        });
        // Close search input
        closeSearch.addEventListener('click', () => {
            searchInputContainer.classList.add('opacity-0');
            searchInputContainer.classList.add('translate-x-2');
            searchInput.classList.add('w-0');
            searchInput.classList.add('opacity-0');
            searchButton.classList.remove("invisible");

            setTimeout(() => {
                searchInputContainer.classList.add('hidden');
                searchInput.value = '';
            }, 300);
        });
        // Header scroll effect
        window.addEventListener('scroll', function () {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('bg-white/90', 'backdrop-blur-md', 'shadow-sm');
            } else {
                header.classList.remove('bg-white/90', 'backdrop-blur-md', 'shadow-sm');
            }
        });

        // Animation for cards on hover
        document.querySelectorAll('.artistic-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-10px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });

        // Mobile menu toggle
        // Mobile Menu JavaScript
        // Get elements
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuPanel = document.getElementById('mobileMenuPanel');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        const mobileAboutToggle = document.getElementById('mobileAboutToggle');
        const mobileAboutMenu = document.getElementById('mobileAboutMenu');
        const mobileAboutIcon = document.getElementById('mobileAboutIcon');

        // Function to open mobile menu
        function openMobileMenu() {
            mobileMenu.classList.remove('hidden');
            // Use setTimeout to ensure the display change takes effect before animation
            setTimeout(() => {
                mobileMenuPanel.classList.remove('translate-x-full');
            }, 10);
            // Prevent body scroll when menu is open
            document.body.style.overflow = 'hidden';
            // Add active class to hamburger
            hamburger.classList.add('active');
        }

        // Function to close mobile menu
        function closeMobileMenuFunc() {
            mobileMenuPanel.classList.add('translate-x-full');
            // Wait for animation to complete before hiding
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
            }, 300);
            // Restore body scroll
            document.body.style.overflow = '';
            // Remove active class from hamburger
            hamburger.classList.remove('active');
        }

        // Function to toggle mobile about submenu
        function toggleMobileAbout() {
            const isHidden = mobileAboutMenu.classList.contains('hidden');

            if (isHidden) {
                // Show submenu
                mobileAboutMenu.classList.remove('hidden');
                mobileAboutIcon.style.transform = 'rotate(180deg)';
            } else {
                // Hide submenu
                mobileAboutMenu.classList.add('hidden');
                mobileAboutIcon.style.transform = 'rotate(0deg)';
            }
        }

        // Event listeners
        if (hamburger) {
            hamburger.addEventListener('click', function (e) {
                e.stopPropagation();
                if (mobileMenu.classList.contains('hidden')) {
                    openMobileMenu();
                } else {
                    closeMobileMenuFunc();
                }
            });
        }

        if (closeMobileMenu) {
            closeMobileMenu.addEventListener('click', closeMobileMenuFunc);
        }

        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeMobileMenuFunc);
        }

        if (mobileAboutToggle) {
            mobileAboutToggle.addEventListener('click', function (e) {
                e.preventDefault();
                toggleMobileAbout();
            });
        }

        // Close menu when clicking on menu links (except dropdown toggle)
        const menuLinks = document.querySelectorAll('#mobileMenu nav a:not(#mobileAboutToggle)');
        menuLinks.forEach(link => {
            link.addEventListener('click', function () {
                // Close menu after a short delay to allow for navigation
                setTimeout(closeMobileMenuFunc, 150);
            });
        });

        // Close menu on window resize if screen becomes large
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 1024 && !mobileMenu.classList.contains('hidden')) {
                closeMobileMenuFunc();
            }
        });

        // Handle escape key to close menu
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                closeMobileMenuFunc();
            }
        });

        // Prevent menu panel clicks from closing the menu
        if (mobileMenuPanel) {
            mobileMenuPanel.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        }

        // Initialize animations when elements come into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.event-card, .gallery-item, .section-divider').forEach(el => {
            observer.observe(el);
        });
    </script>
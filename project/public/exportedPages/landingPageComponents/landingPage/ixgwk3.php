<?php use App\Models\Text;

if (isset($_GET['locale'])) {
    $_SESSION['locale'] = $_GET['locale'];
}
$locale = $_SESSION['locale'] ?? 'sr-Cyrl';
$dynamicText = (new Text())->getDynamicText($locale);
?>
<section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient"><!-- Decorative background elements --><div class="absolute inset-0 z-0"><!-- Floating paint elements --><div class="absolute top-20 left-10 w-80 h-40 bg-clay opacity-15 transform rotate-12 rounded-full floating">
            </div><div class="absolute bottom-40 right-20 w-64 h-32 bg-deep-teal opacity-10 transform -rotate-6 rounded-full floating" id="ire5rg"></div><div class="absolute top-1/3 left-1/4 w-64 h-64 bg-ochre opacity-10 floating" id="ix7dwq">
            </div><div class="absolute top-1/2 right-1/3 w-32 h-32 bg-crimson opacity-10 rounded-full floating" id="i4txff"></div><!-- Pattern overlay --><div class="absolute inset-0 opacity-10" id="ioqi65">
            </div><!-- Paint splatters --><div class="absolute top-1/4 right-1/5 w-24 h-24 bg-ochre opacity-10 rounded-full" id="ikxw08"></div><div class="absolute bottom-1/3 left-1/6 w-20 h-20 bg-terracotta opacity-10" id="i8l02e"></div></div><div class="container max-w-full mx-10 px-4 py-24 relative z-10"><div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center"><div class="max-w-2xl"><div class="mb-8"><span class="inline-block bg-sage text-slate px-4 py-1 rounded-full text-sm font-medium mb-6"><i class="fas fa-star mr-2"></i>Istaknuto ovog meseca
                        </span><h1 class="text-5xl md:text-6xl font-display font-bold leading-tight text-slate mb-6"><h1 class="text-5xl md:text-6xl font-display font-bold leading-tight text-slate mb-6"><span class="block artistic-underline"><?=$dynamicText[4]?></span></h1></h1></div><div class="mb-10 relative pl-6 border-l-4 border-ochre"><p class="text-xl text-slate-700 leading-relaxed max-w-lg mb-6"><p class="text-xl text-slate-700 leading-relaxed max-w-lg mb-6"><?=$dynamicText[5]?></p></p><p class="text-slate-600 italic"><p class="text-slate-600 italic"><?=$dynamicText[6]?><span class="block font-medium text-terracotta mt-2"><?=$dynamicText[7]?></span></p></p></div><!-- Quick links --><div class="mt-10 flex flex-wrap gap-3"><a href="#" class="flex items-center text-slate-600 hover:text-terracotta transition-colors"><span class="w-3 h-3 bg-ochre rounded-full mr-2"></span>
                            Trenutne izložbe
                        </a><a href="#" class="flex items-center text-slate-600 hover:text-terracotta transition-colors"><span class="w-3 h-3 bg-royal-blue rounded-full mr-2"></span>
                            Raspored filmova
                        </a><a href="#" class="flex items-center text-slate-600 hover:text-terracotta transition-colors"><span class="w-3 h-3 bg-velvet rounded-full mr-2"></span>
                            Pozorišne predstave
                        </a><a href="#" class="flex items-center text-slate-600 hover:text-terracotta transition-colors"><span class="w-3 h-3 bg-deep-teal rounded-full mr-2"></span>
                            Muzički događaji
                        </a></div></div><!-- Cultural Showcase Grid --><div class="relative"><div class="grid grid-cols-2 gap-6"><!-- Art Exhibition --><div class="artistic-card h-80 rounded-xl overflow-hidden relative"><div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1547891654-e66ed7ebb968?auto=format&fit=crop&w=600&q=80')] bg-cover bg-center transform scale-105 hover:scale-100 transition-transform duration-500">
                            </div><div class="category-badge bg-ochre/80 text-paper">Umetnost</div><div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate/90 to-transparent p-4 text-paper"><h3 class="font-display font-bold"><h3 class="font-display font-bold"><?=$dynamicText[8]?></h3></h3><p class="text-sm"><p class="text-sm"><?=$dynamicText[9]?></p></p></div></div><!-- Film --><div class="artistic-card h-80 rounded-xl overflow-hidden relative mt-12"><div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?auto=format&fit=crop&w=600&q=80')] bg-cover bg-center transform scale-105 hover:scale-100 transition-transform duration-500">
                            </div><div class="category-badge bg-royal-blue/80 text-paper">Bioskop</div><div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate/90 to-transparent p-4 text-paper"><h3 class="font-display font-bold"><h3 class="font-display font-bold"><?=$dynamicText[10]?></h3></h3><p class="text-sm"><p class="text-sm"><?=$dynamicText[11]?></p></p></div></div><!-- Theater --><div class="artistic-card h-64 rounded-xl overflow-hidden relative"><div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=600&q=80')] bg-cover bg-center transform scale-105 hover:scale-100 transition-transform duration-500">
                            </div><div class="category-badge bg-velvet/80 text-paper">Pozorište</div><div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate/90 to-transparent p-4 text-paper"><h3 class="font-display font-bold"><h3 class="font-display font-bold"><?=$dynamicText[12]?></h3></h3><p class="text-sm"><p class="text-sm"><?=$dynamicText[13]?></p></p></div></div><!-- Music --><div class="artistic-card h-64 rounded-xl overflow-hidden relative -mt-6"><div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=600&q=80')] bg-cover bg-center transform scale-105 hover:scale-100 transition-transform duration-500">
                            </div><div class="category-badge bg-deep-teal/80 text-paper">Muzika</div><div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate/90 to-transparent p-4 text-paper"><h3 class="font-display font-bold"><h3 class="font-display font-bold"><?=$dynamicText[14]?></h3></h3><p class="text-sm"><p class="text-sm"><?=$dynamicText[15]?></p></p></div></div></div></div></div></div><!-- Floating info card --><div class="absolute bottom-20 right-20 z-20 hidden xl:block animate-bounce-slow"><div class="relative"><div class="w-66 h-auto bg-white/90 backdrop-blur-sm p-5 rounded-xl shadow-2xl border-2 border-ochre transform rotate-3"><div class="flex items-center mb-4"><div class="w-14 h-14 bg-sage rounded-full mr-3 flex items-center justify-center text-paper"><i class="fas fa-calendar-alt text-xl"></i></div><div><h4 class="font-display font-bold"><h4 class="font-display font-bold"><?=$dynamicText[16]?></h4></h4><p class="text-terracotta text-sm"><p class="text-terracotta text-sm"><?=$dynamicText[17]?></p></p></div></div><div class="space-y-2"><div class="flex justify-between text-sm"><span>Opšta:</span><span class="font-medium">1200 RSD</span></div><div class="flex justify-between text-sm"><span>Studenti/Penzioneri:</span><span class="font-medium">800 RSD</span></div><div class="flex justify-between text-sm"><span>Članovi:</span><span class="font-medium">Besplatno</span></div></div></div><div class="absolute -top-6 -right-6 w-12 h-12 bg-sage rounded-full flex items-center justify-center text-paper shadow-lg"><i class="fas fa-ticket-alt"></i></div></div></div><!-- Scrolling indicator --><div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20"><div class="animate-bounce w-8 h-14 rounded-full border-2 border-terracotta flex justify-center p-1"><div class="w-2 h-2 bg-terracotta rounded-full animate-pulse"></div></div></div></section>
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
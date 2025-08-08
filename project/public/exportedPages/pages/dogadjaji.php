<?php
use App\Models\Event;

$limit = 6;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

[$events, $totalCount] = (new Event())->all(
    limit: $limit,
    offset: $offset
);
$totalPages = (int) ceil($totalCount / $limit);
$categories = (new Event())->getCategories();

?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>dogadjaji</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

<script src="https://cdn.tailwindcss.com"></script>
  <style>
    .pagination {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .page-item {
            margin: 0 0.25rem;
        }

        .page-link {
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid #d4a373;
            color: #344e41;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            background-color: #d4a373;
            color: white;
        }

        .page-link.active {
            background-color: #d4a373;
            color: white;
            border-color: #d4a373;
        }

        .page-link.disabled {
            opacity: 0.5;
            pointer-events: none;
        } * { box-sizing: border-box; } body {margin: 0;}.mobile-dropdown.active .mobile-dropdown-content{max-height:500px;}.mobile-dropdown.active .mobile-dropdown-chevron{transform:rotate(180deg);}#i0nfng{animation-delay:1s;}#i8598y{animation-delay:2s;}#ikycbh{animation-delay:3s;}#ijz7zb{background-image:radial-gradient(#344e41 1px, transparent 1px);background-size:20px 20px;}#ik3ffz{clip-path:polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);}#ie0ugr{clip-path:polygon(50% 0%, 100% 38%, 82% 100%, 18% 100%, 0% 38%);}#i0rvgs{border:0;}@layer utilities{.artistic-underline{background-image:url(&quot;data:image/svg+xml;utf8,&lt;svg xmlns=\&quot;http://www.w3.org/2000/svg\&quot; viewBox=\&quot;0 0 120 20\&quot;&gt;&lt;path fill=\&quot;none\&quot; stroke=\&quot;%23d4a373\&quot; stroke-width=\&quot;3\&quot; stroke-linecap=\&quot;round\&quot; d=\&quot;M2,17 C15,17 25,5 40,10 C55,15 65,3 80,8 C95,13 105,5 118,12\&quot;/&gt;&lt;/svg&gt;&quot;);background-position-x:center;background-position-y:bottom;background-repeat:no-repeat;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;background-size:100% 12px;padding-bottom:12px;}.nav-link::after{content:&quot;&quot;;display:block;width:0px;height:3px;background-image:linear-gradient(to right, rgb(212, 163, 115), rgb(188, 108, 37));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:width;}.nav-link:hover::after{width:100%;}.artistic-card{clip-path:polygon(0px 0px, 100% 0px, 100% 85%, 95% 100%, 0px 100%);transition-behavior:normal;transition-duration:0.4s;transition-timing-function:ease;transition-delay:0s;transition-property:all;}.artistic-card:hover{transform:translateY(-10px);box-shadow:rgba(0, 0, 0, 0.2) 0px 20px 30px -10px;}.artistic-frame{position:relative;}.artistic-frame::before{content:&quot;&quot;;position:absolute;top:-15px;left:-15px;right:-15px;bottom:-15px;border-top-width:2px;border-right-width:2px;border-bottom-width:2px;border-left-width:2px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgb(212, 163, 115);border-right-color:rgb(212, 163, 115);border-bottom-color:rgb(212, 163, 115);border-left-color:rgb(212, 163, 115);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;z-index:-1;transform:rotate(2deg);}.artistic-frame::after{content:&quot;&quot;;position:absolute;top:-10px;left:-10px;right:-10px;bottom:-10px;border-top-width:2px;border-right-width:2px;border-bottom-width:2px;border-left-width:2px;border-top-style:solid;border-right-style:solid;border-bottom-style:solid;border-left-style:solid;border-top-color:rgb(163, 177, 138);border-right-color:rgb(163, 177, 138);border-bottom-color:rgb(163, 177, 138);border-left-color:rgb(163, 177, 138);border-image-source:initial;border-image-slice:initial;border-image-width:initial;border-image-outset:initial;border-image-repeat:initial;z-index:-1;transform:rotate(-1deg);}.category-badge{position:absolute;top:15px;right:15px;padding-top:5px;padding-right:12px;padding-bottom:5px;padding-left:12px;border-top-left-radius:20px;border-top-right-radius:20px;border-bottom-right-radius:20px;border-bottom-left-radius:20px;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;backdrop-filter:blur(4px);z-index:20;}.hero-gradient{background-image:linear-gradient(135deg, rgb(245, 235, 224) 0%, rgb(212, 163, 115) 100%);background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;}.hamburger span{transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;}.hamburger.active span:nth-child(1){transform:rotate(45deg) translate(6px, 6px);}.hamburger.active span:nth-child(2){opacity:0;}.hamburger.active span:nth-child(3){transform:rotate(-45deg) translate(5px, -5px);}.section-divider{height:100px;background-image:url(&quot;data:image/svg+xml;utf8,&lt;svg xmlns=\&quot;http://www.w3.org/2000/svg\&quot; viewBox=\&quot;0 0 1200 120\&quot; preserveAspectRatio=\&quot;none\&quot;&gt;&lt;path d=\&quot;M1200 120L0 16.48 0 0 1200 0 1200 120z\&quot; fill=\&quot;%23f5ebe0\&quot;&gt;&lt;/path&gt;&lt;/svg&gt;&quot;);background-position-x:initial;background-position-y:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;background-size:100% 100px;}.floating{animation-duration:6s;animation-timing-function:ease-in-out;animation-delay:0s;animation-iteration-count:infinite;animation-direction:normal;animation-fill-mode:none;animation-play-state:running;animation-name:floating;animation-timeline:auto;animation-range-start:normal;animation-range-end:normal;}0%{transform:scale(1);opacity:0;}50%{transform:scale(1.05);opacity:1;}100%{transform:scale(1);opacity:1;}.dropdown:hover .dropdown-menu{display:block;}.dropdown-menu{display:none;position:absolute;background-color:white;min-width:200px;box-shadow:rgba(0, 0, 0, 0.1) 0px 8px 16px 0px;z-index:1;border-top-left-radius:8px;border-top-right-radius:8px;border-bottom-right-radius:8px;border-bottom-left-radius:8px;overflow-x:hidden;overflow-y:hidden;}.dropdown-item{padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px;text-decoration-line:none;text-decoration-thickness:initial;text-decoration-style:initial;text-decoration-color:initial;display:block;color:rgb(52, 78, 65);transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:all;border-left-width:3px;border-left-style:solid;border-left-color:transparent;}.dropdown-item:hover{background-color:rgb(249, 245, 240);border-left-width:3px;border-left-style:solid;border-left-color:rgb(212, 163, 115);}.event-card:hover::before{transform:translateY(0px);}.gallery-grid{display:grid;grid-template-columns:repeat(auto-fill, minmax(250px, 1fr));row-gap:15px;column-gap:15px;}.gallery-item img{transition-behavior:normal;transition-duration:0.5s;transition-timing-function:ease;transition-delay:0s;transition-property:transform;}.gallery-item:hover img{transform:scale(1.1);}.gallery-item:hover::after{opacity:1;}.gallery-item .overlay-content{position:absolute;bottom:-30px;left:0px;right:0px;padding-top:15px;padding-right:15px;padding-bottom:15px;padding-left:15px;z-index:10;transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:bottom;color:white;}.gallery-item:hover .overlay-content{bottom:0px;}}
  </style>

</head>
<body class="min-h-screen flex flex-col">

<?php
// dogadjaji page header include
require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';
require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';
?>

<main class="flex-1">
<div>
    <button id="increaseFontBtn"
        class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
        aria-label="Increase font size">
        A+
    </button>
</div>
    <section class="relative min-h-screen flex items-center w-full overflow-hidden pt-16 hero-gradient">
        <section id="events" class="w-full py-20">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-[#344e41] mb-6 relative inline-block">
                        Događaji
                        <span class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-[#d4a373] to-[#bc6c25]"></span>
                    </h2>
                    <p class="text-lg text-[#344e41]/80 max-w-2xl mx-auto mt-4">
                        Istražite našu bogatu ponudu kulturnih događaja
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach ($events as $event): ?>
                        <div class="event-card bg-white rounded-xl overflow-hidden shadow-md transition-all duration-300 h-full flex flex-col">
                            <div class="h-48 relative">
                                <img alt="Event image"
                                    src="<?= htmlspecialchars($event['image'] ?? 'default.jpg') ?>"
                                    class="w-full h-full object-cover">
                                <div class="category-badge bg-[#d4a373]/80 text-white">
                                    <?= htmlspecialchars($event['naziv'] ?? 'Događaj') ?>
                                </div>
                            </div>
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center mb-3">
                                    <div class="w-10 h-10 rounded-full bg-[#d4a373] flex items-center justify-center text-white mr-3">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <span class="text-[#d4a373] font-bold">Koncert</span>
                                </div>
                                <h3 class="text-xl font-bold text-[#344e41] mb-2">
                                    <?= htmlspecialchars($event['title']) ?>
                                </h3>
                                <p class="text-[#344e41]/80 mb-4 flex-1">
                                    <?= htmlspecialchars($event['description']) ?>
                                </p>
                                <div class="flex justify-between items-center mt-auto">
                                    <div>
                                        <div class="flex items-center text-sm text-[#344e41]/70 mb-2">
                                            <i class="fas fa-clock mr-2"></i>
                                            <span>15.07.2023. | 20:00</span>
                                        </div>
                                        <div class="flex items-center text-sm text-[#344e41]/70">
                                            <i class="fas fa-map-marker-alt mr-2"></i>
                                            <span>Stari Grad, Trg Sv. Marka</span>
                                        </div>
                                    </div>
                                    <a href="#" class="text-[#d4a373] hover:text-[#bc6c25] transition-colors">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($totalPages > 1): ?>
                    <div class="pagination-container">
                        <ul class="pagination">
                            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link <?= $page <= 1 ? 'disabled' : '' ?>" href="?page=<?= $page - 1 ?>">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                            <?php
                            $start = max(1, $page - 2);
                            $end = min($totalPages, $page + 2);
                            if ($start > 1) {
                                echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
                                if ($start > 2) {
                                    echo '<li class="page-item disabled"><a class="page-link disabled" href="#">...</a></li>';
                                }
                            }
                            for ($i = $start; $i <= $end; $i++): ?>
                                <li class="page-item">
                                    <a class="page-link <?= $i == $page ? 'active' : '' ?>" href="?page=<?= $i ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                            <?php endfor;
                            if ($end < $totalPages) {
                                if ($end < $totalPages - 1) {
                                    echo '<li class="page-item disabled"><a class="page-link disabled" href="#">...</a></li>';
                                }
                                echo '<li class="page-item"><a class="page-link" href="?page=' . $totalPages . '">' . $totalPages . '</a></li>';
                            }
                            ?>
                            <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                                <a class="page-link <?= $page >= $totalPages ? 'disabled' : '' ?>" href="?page=<?= $page + 1 ?>">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </section>
</main><?php
// dogadjaji page footer include
require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';
?>

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

</body>
</html>

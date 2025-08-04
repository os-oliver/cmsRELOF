<?php

use App\Models\SearchModal;

$term = trim($_GET['q'] ?? '');

$aboutResults = $term !== '' ? (new SearchModal())->searchTable('aboutus', $term) : [];
$docResults = $term !== '' ? (new SearchModal())->searchTable('document', $term) : [];
$eventResults = $term !== '' ? (new SearchModal())->searchTable('events', $term) : [];
$galleryResults = $term !== '' ? (new SearchModal())->searchTable('gallery', $term) : [];
$employeeResults = $term !== '' ? (new SearchModal())->searchTable('employee', $term) : [];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Pretraga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100 text-gray-800">
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
        <?php require_once __DIR__ . '/../exportedPages/landingPageComponents/landingPage/divmobileMenu.php'; ?>
        <?php require_once __DIR__ . '/../exportedPages/landingPageComponents/landingPage/header.php'; ?>

    </div>
    <div class="max-w-4xl pt-24 mx-auto p-6">
        <form method="GET" class="flex mb-8">
            <input type="text" name="q" value="<?= htmlspecialchars($term) ?>" placeholder="Pretraži sve..."
                class="flex-grow p-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-400" />
            <button type="submit"
                class="px-4 bg-blue-500 text-white font-semibold rounded-r-md hover:bg-blue-600 transition">
                Pretraži
            </button>
        </form>

        <?php if ($term === ''): ?>
            <p class="text-center text-gray-600">Unesite pojam za pretragu.</p>
        <?php else: ?>

            <!-- O nama -->
            <section class="mb-8">
                <h2 class="text-2xl font-bold mb-4">O nama</h2>
                <?php if (empty($aboutResults)): ?>
                    <p class="text-gray-600">Nema rezultata.</p>
                <?php else: ?>
                    <?php foreach ($aboutResults as $row): ?>
                        <div class="p-4 bg-white rounded shadow mb-2">
                            <p><strong>Mission:</strong> <?= htmlspecialchars($row['mission']) ?></p>
                            <p><strong>Goal:</strong> <?= htmlspecialchars($row['goal']) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>
            <section class="mb-10">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">👥 Zaposleni</h2>

                <?php if (empty($employeeResults)): ?>
                    <p class="text-gray-600">Nema rezultata.</p>
                <?php else: ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php foreach ($employeeResults as $emp): ?>
                            <div class="p-5 bg-white rounded-2xl shadow hover:shadow-md transition space-y-2">
                                <h3 class="text-lg font-semibold text-gray-800">
                                    <?= htmlspecialchars($emp['name']) . ' ' . htmlspecialchars($emp['surname']) ?>
                                </h3>
                                <p class="text-sm text-indigo-600 font-medium">
                                    <?= htmlspecialchars($emp['position']) ?>
                                </p>
                                <?php if (!empty($emp['biography'])): ?>
                                    <p class="text-sm text-gray-600"><?= nl2br(htmlspecialchars($emp['biography'])) ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>

            <!-- Dokumenti -->
            <section class="mb-10">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">📄 Dokumenti</h2>

                <?php if (empty($docResults)): ?>
                    <p class="text-gray-600 italic">Nema rezultata za traženi pojam.</p>
                <?php else: ?>
                    <div class="space-y-4">
                        <?php foreach ($docResults as $doc): ?>
                            <div
                                class="p-5 bg-white rounded-2xl shadow flex items-center justify-between hover:shadow-lg transition">
                                <div>
                                    <p class="font-semibold text-lg text-gray-900">
                                        <?= htmlspecialchars($doc['title'] ?? $doc['name']) ?>
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        <?= htmlspecialchars($doc['description'] ?? 'Nema opisa') ?>
                                    </p>
                                    <p class="text-xs text-gray-500 mt-2">
                                        📅 <?= htmlspecialchars(date('d.m.Y H:i', strtotime($doc['datetime'] ?? ''))) ?> |
                                        🗂️ <?= htmlspecialchars($doc['category_id'] ?? 'Bez kategorije') ?> |
                                        🔗 <?= htmlspecialchars($doc['fileSize']) ?> MB
                                    </p>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded-full">
                                        <?= strtoupper(htmlspecialchars($doc['extension'])) ?>
                                    </span>
                                    <a href="/uploads/documents/<?= htmlspecialchars($doc['filepath']) ?>"
                                        class="inline-block bg-blue-500 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-blue-600 transition"
                                        download>
                                        Preuzmi
                                    </a>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>




            <!-- Događaji -->
            <section class="mb-10">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">📅 Događaji</h2>

                <?php if (empty($eventResults)): ?>
                    <p class="text-gray-600">Nema rezultata.</p>
                <?php else: ?>
                    <?php foreach ($eventResults as $ev): ?>
                        <div class="p-5 bg-white rounded-2xl shadow hover:shadow-md transition mb-5 flex items-start space-x-4">

                            <?php if (!empty($ev['image'])): ?>
                                <img src="<?= htmlspecialchars($ev['image']) ?>" alt="<?= htmlspecialchars($ev['title']) ?>"
                                    class="w-20 h-20 object-cover rounded-lg border">
                            <?php else: ?>
                                <div class="w-20 h-20 flex items-center justify-center bg-gray-100 rounded-lg text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7h18M3 12h18M3 17h18" />
                                    </svg>
                                </div>
                            <?php endif; ?>

                            <div class="flex-1">
                                <h3 class="font-semibold text-lg text-gray-800 mb-1">
                                    <?= htmlspecialchars($ev['title']) ?>
                                </h3>

                                <?php if (!empty($ev['description'])): ?>
                                    <p class="text-sm text-gray-600 mb-2"><?= htmlspecialchars($ev['description']) ?></p>
                                <?php endif; ?>

                                <div class="text-sm text-gray-500 mb-1">
                                    <strong>Datum:</strong> <?= htmlspecialchars(date('d.m.Y', strtotime($ev['date']))) ?>
                                    &nbsp; | &nbsp;
                                    <strong>Vreme:</strong> <?= htmlspecialchars(substr($ev['time'], 0, 5)) ?>
                                </div>

                                <?php if (!empty($ev['location'])): ?>
                                    <p class="text-sm text-gray-500 mb-1"><strong>Lokacija:</strong>
                                        <?= htmlspecialchars($ev['location']) ?></p>
                                <?php endif; ?>

                                <p class="text-xs text-gray-400">Kreirano:
                                    <?= htmlspecialchars(date('d.m.Y H:i', strtotime($ev['created_at']))) ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </section>


            <!-- Galerija -->
            <section class="mb-8">
                <h2 class="text-2xl font-bold mb-4">Galerija</h2>
                <?php if (empty($galleryResults)): ?>
                    <p class="text-gray-600">Nema rezultata.</p>
                <?php else: ?>
                    <div class="grid grid-cols-3 gap-4">
                        <?php foreach ($galleryResults as $img): ?>
                            <img src="<?= htmlspecialchars($img['image_file_path']) ?>" alt=""
                                class="w-full h-32 object-cover rounded" />
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </section>

        <?php endif; ?>
    </div>
    <?php require_once __DIR__ . '/../exportedPages/landingPageComponents/landingPage/footer.php'; ?>

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

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upravljaka-struktura</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />

<script src="https://cdn.tailwindcss.com"></script>
  <style>
    * { box-sizing: border-box; } body {margin: 0;}body{font-family:Raleway, sans-serif;background-image:linear-gradient(rgb(248, 245, 240), rgb(233, 228, 216));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;color:rgb(51, 51, 51);}.font-display{font-family:&quot;Playfair Display&quot;, serif;}.library-pattern{background-image:url(&quot;data:image/svg+xml,%3Csvg width=&#039;100&#039; height=&#039;100&#039; viewBox=&#039;0 0 100 100&#039; xmlns=&#039;http://www.w3.org/2000/svg&#039;%3E%3Cpath d=&#039;M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z&#039; fill=&#039;%23d4a373&#039; fill-opacity=&#039;0.1&#039; fill-rule=&#039;evenodd&#039;/%3E%3C/svg%3E&quot;);}.book-spine{position:relative;overflow-x:hidden;overflow-y:hidden;}.book-spine::before{content:&quot;&quot;;position:absolute;top:0px;left:0px;height:100%;width:8px;background-image:linear-gradient(rgb(44, 62, 80), rgb(26, 37, 47));background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:initial;}.nav-link::after{content:&quot;&quot;;display:block;width:0px;height:2px;background-image:initial;background-position-x:initial;background-position-y:initial;background-size:initial;background-repeat:initial;background-attachment:initial;background-origin:initial;background-clip:initial;background-color:rgb(139, 107, 97);transition-behavior:normal;transition-duration:0.3s;transition-timing-function:ease;transition-delay:0s;transition-property:width;}.nav-link:hover::after{width:100%;}.page-turn{transition-behavior:normal;transition-duration:0.6s;transition-timing-function:cubic-bezier(0.175, 0.885, 0.32, 1.275);transition-delay:0s;transition-property:transform;}.page-turn:hover{transform:rotateY(15deg) translateX(-5px);}#ikuvr{background:radial-gradient(circle, #2C3E50 1px, transparent 1px);background-size:40px 40px;}
  </style>

</head>
<body class="min-h-screen flex flex-col">

<?php
// Upravljaka-struktura page header include
require_once __DIR__ . '/../landingPageComponents/landingPage/divmobileMenu.php';
require_once __DIR__ . '/../landingPageComponents/landingPage/header.php';
?>

<main class=>
<div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 transition"
            aria-label="Increase font size">
            A+
        </button>
    </div>
  <section class="relative min-h-screen flex items-center overflow-hidden pt-16 hero-gradient">
    <!-- Decorative background elements -->
    <div class="absolute inset-0 z-0"></div>
    <div class="relative z-10 w-full max-w-3xl mx-auto text-center">
      <h1 class="text-5xl font-bold mb-4">Upravljaka-struktura</h1>
      <p class="text-xl">Podesiti Upravljaka-struktura stranicu!</p>
    </div>
  </section>
</main>
<?php
// Upravljaka-struktura page footer include
require_once __DIR__ . '/../landingPageComponents/landingPage/footer.php';
?>

<script>
        // Font size toggle functionality
        const btn = document.getElementById('increaseFontBtn');
        let currentSize = 16;
        let step = 2;
        let maxSteps = 3;
        let count = 0;
        let increasing = true;

        btn.addEventListener('click', () => {
            if (increasing) {
                currentSize += step;
                count++;
                if (count === maxSteps) {
                    increasing = false;
                    btn.textContent = 'A-';
                }
            } else {
                currentSize -= step;
                count--;
                if (count === 0) {
                    increasing = true;
                    btn.textContent = 'A+';
                }
            }
            document.body.style.fontSize = currentSize + 'px';
        });

        // Search functionality
        const searchButton = document.getElementById('searchButton');
        const searchInputContainer = document.getElementById('searchInputContainer');
        const closeSearch = document.getElementById('closeSearch');

        searchButton.addEventListener('click', () => {
            searchInputContainer.classList.toggle('hidden');
        });

        closeSearch.addEventListener('click', () => {
            searchInputContainer.classList.add('hidden');
        });

        // Mobile menu toggle
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');

        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            mobileMenu.classList.toggle('active');
            document.body.classList.toggle('overflow-hidden');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (mobileMenu && mobileMenu.classList.contains('active') &&
                !mobileMenu.contains(e.target) &&
                e.target !== hamburger &&
                !hamburger.contains(e.target)) {
                hamburger.classList.remove('active');
                mobileMenu.classList.remove('active');
                document.body.classList.remove('overflow-hidden');
            }
        });

        // Events view button
        document.querySelector("#eventsView").addEventListener('click', () => {
            window.location.href = "/dogadjaji";
        });

        // Header scroll effect
        window.addEventListener('scroll', function () {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('shadow-lg');
            } else {
                header.classList.remove('shadow-lg');
            }
        });
    </script>
<script src="https://cdn.tailwindcss.com"></script>

</body>
</html>

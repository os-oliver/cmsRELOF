<!DOCTYPE html>
<html lang="sr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kulturni Centar Nexus</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@300;400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Raleway:ital,wght@0,300;0,400;0,700;1,400&display=swap"
        rel="stylesheet">

    <script>

        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Background colors
                        background: "#FAFAF9", // Paper-like main background
                        secondary_background: "#F5F5F4", // Section separation

                        // Primary colors - main structural elements
                        primary: "#0F172A", // Navbar, main headers
                        primary_hover: "#020617", // Strong hover contrast

                        // Text colors
                        primary_text: "#1C1917", // Long-form reading text
                        secondary_text: "#57534E", // Meta, descriptions

                        // Secondary colors - UI controls
                        secondary: "#78716C", // Buttons, subtle borders
                        secondary_hover: "#44403C", // Hover state

                        // Accent colors - restrained emphasis
                        accent: "#7397c8", // Links, highlights
                        accent_hover: "#9A3412", // Accent hover

                        // Surface colors - cards
                        surface: "#FFFFFF", // Cards, dropdowns
                    },

                    fontFamily: {
                        heading: ["Libre Baskerville", "Georgia", "serif"],
                        heading2: ["Source Serif 4", "Times New Roman", "serif"],
                        body: ["Inter", "system-ui", "sans-serif"],
                    },
                },
            },
        };

    </script>

    <style>
        /* Simple CSS line-clamp utilities (no plugin needed) */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-4 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Fallback display: hidden image, show fallback block */
        .image-wrap {
            position: relative;
        }

        .image-fallback {
            display: none;
        }

        .image-wrap.no-image .image-fallback {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
        }

        .image-wrap.no-image img {
            display: none !important;
        }

        /* Ensure the fallback exactly matches the image container sizing */
        .image-fallback {
            width: 100%;
            height: 100%;
            padding: 1rem;
            text-align: center;
            font-weight: 700;
            font-size: 0.95rem;
            line-height: 1.2;
            border-radius: .75rem;
            background: linear-gradient(180deg, rgba(250, 204, 21, 0.12), rgba(15, 23, 42, 0.02));
            color: #92400e;
            /* amber-700-like */
        }

        /* Prevent long words from overflowing their containers */
        .prevent-overflow {
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        /* Slightly smaller drop shadow on very small devices to avoid layout shifts */
        @media (max-width: 420px) {
            .shadow-responsive {
                box-shadow: 0 12px 40px -12px rgba(0, 0, 0, 0.18);
            }
        }

        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&display=swap');

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes dust {
            0% {
                transform: translateY(0px) translateX(0px);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateY(-20px) translateX(10px);
                opacity: 0;
            }
        }

        .book-spine {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            font-family: 'Cinzel', serif;
        }

        /* Textures */
        .leather-tex {
            background-image: url("https://www.transparenttextures.com/patterns/leather.png");
            background-blend-mode: soft-light;
        }

        .wood-tex {
            background-image: url("https://www.transparenttextures.com/patterns/wood-pattern.png");
        }

        .paper-tex {
            background-image: url("https://www.transparenttextures.com/patterns/cream-paper.png");
        }

        .metal-tex {
            background-image: url("https://www.transparenttextures.com/patterns/brushed-alum.png");
            background-blend-mode: overlay;
        }

        /* Book details */
        .spine-band {
            height: 2px;
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
        }

        /* Brass Plate Style */
        .brass-plate {
            background: linear-gradient(45deg, #b48a49, #fcd383, #b48a49);
            box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.5), inset 0 -1px 1px rgba(0, 0, 0, 0.5), 0 2px 4px rgba(0, 0, 0, 0.5);
            border: 1px solid #8c6a36;
        }

        .engraved-text {
            color: #5c421d;
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.4), 0 -1px 0 rgba(0, 0, 0, 0.6);
        }

        .rivet {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: radial-gradient(#fcd383, #8c6a36);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.6);
        }

        /* Light Rays */
        .light-ray {
            position: absolute;
            top: -20%;
            left: -10%;
            width: 40%;
            height: 150%;
            background: linear-gradient(to bottom, rgba(255, 250, 220, 0.08), transparent);
            transform: rotate(25deg);
            filter: blur(15px);
            pointer-events: none;
        }

        /* Dust Motes */
        .mote {
            position: absolute;
            background: rgba(255, 255, 230, 0.6);
            border-radius: 50%;
            animation: dust 8s infinite linear;
        }

        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;800&family=Lora:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&family=Cormorant+Garamond:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background-color: #f5f3f0;
        }

        /* Header Styles */
        .header-glass {
            background: linear-gradient(135deg, rgba(245, 243, 240, 0.98), rgba(255, 255, 255, 0.96));
            backdrop-filter: blur(20px) saturate(160%);
            -webkit-backdrop-filter: blur(20px) saturate(160%);
            border-bottom: 2px solid rgba(201, 169, 97, 0.15);
            box-shadow: 0 8px 32px rgba(26, 58, 58, 0.08);
            position: relative;
        }

        .header-glass::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(201, 169, 97, 0.3), transparent);
        }

        .nav-link {
            position: relative;
            padding: 0.65rem 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #1a3a3a;
            font-weight: 600;
            letter-spacing: 0.6px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #c9a961, #dbb76d);
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: #c9a961;
            background: rgba(201, 169, 97, 0.08);
            border-radius: 8px;
        }

        #searchOverlay {
            opacity: 0;
            pointer-events: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(245, 243, 240, 0.96);
            backdrop-filter: blur(40px);
        }

        #searchOverlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(12px) scale(0.95);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 20px 60px rgba(26, 58, 58, 0.2), 0 0 40px rgba(201, 169, 97, 0.1);
            border: 1.5px solid rgba(201, 169, 97, 0.25);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98), rgba(245, 243, 240, 0.95));
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .dropdown-menu a {
            transition: all 0.25s ease;
        }

        .dropdown-menu a:hover {
            background: linear-gradient(135deg, rgba(201, 169, 97, 0.15), rgba(201, 169, 97, 0.08));
            transform: translateX(4px);
        }

        .mobile-menu {
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Hero Section Styles */
        .hero-section {
            position: relative;
            min-height: 100vh;
            background-image:
                linear-gradient(135deg, rgba(26, 58, 58, 0.85), rgba(26, 58, 58, 0.88)),
                url('https://bibliotekazabalj.org.rs/wp-content/uploads/2022/02/zabalj-header-2022-2.jpg');
            background-size: cover;
            background-position: center 30%;
            background-attachment: fixed;
            display: flex;
            align-items: center;
        }

        .book-pages {
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23d4af37' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.4;
            z-index: 1;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-16px) scale(1.03);
            box-shadow: 0 40px 80px rgba(26, 58, 58, 0.25);
        }

        .decorative-divider {
            position: relative;
            height: 3px;
            background: linear-gradient(90deg, transparent, rgba(201, 169, 97, 0.85), transparent);
            margin: 1.5rem 0;
        }

        .decorative-divider::before,
        .decorative-divider::after {
            content: '✦';
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #c9a961;
            font-size: 1.3rem;
        }

        .decorative-divider::before {
            left: 0;
        }

        .decorative-divider::after {
            right: 0;
        }

        .book-illustration {
            transform-style: preserve-3d;
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .book-illustration:hover {
            transform: rotateY(-20deg) translateY(-15px);
            z-index: 10;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
            border-color: rgba(201, 169, 97, 0.4);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-bottom: 1rem;
            transition: all 0.4s ease;
            box-shadow: 0 15px 35px rgba(26, 58, 58, 0.2);
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.2) rotate(15deg);
            box-shadow: 0 20px 50px rgba(201, 169, 97, 0.3);
        }

        .search-input {
            transition: all 0.3s ease;
        }

        .search-input:focus {
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.3);
        }

        .scroll-indicator {
            width: 30px;
            height: 50px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 15px;
            position: relative;
        }

        .scroll-indicator::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 10px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 2px;
            animation: scroll 2s infinite;
        }

        @keyframes scroll {
            0% {
                top: 10px;
                opacity: 1;
            }

            100% {
                top: 25px;
                opacity: 0;
            }
        }

        .book-shelf {
            position: relative;
            height: 200px;
            width: 100%;
            background: linear-gradient(to bottom, #8B4513 0%, #A0522D 10%, #8B4513 100%);
            border-radius: 8px;
            box-shadow: inset 0 10px 20px rgba(0, 0, 0, 0.5);
        }

        .book-shelf::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            right: 0;
            height: 10px;
            background: #654321;
            border-radius: 0 0 8px 8px;
        }

        .book-title {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }

        .delay-500 {
            animation-delay: 0.5s;
        }

        .delay-600 {
            animation-delay: 0.6s;
        }

        .delay-700 {
            animation-delay: 0.7s;
        }

        .writing-mode-vertical {
            writing-mode: vertical-rl;
            text-orientation: mixed;
        }

        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .text-shadow-light {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 1024px) {
            .hero-section {
                background-attachment: scroll;
                min-height: auto;
                padding-top: 40px;
                padding-bottom: 40px;
            }

            .hero-section h1 {
                font-size: 2.5rem !important;
            }

            .hero-section .text-lg {
                font-size: 1rem !important;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: auto;
                padding: 30px 0;
            }

            .hero-section h1 {
                font-size: 1.875rem !important;
            }

            .hero-section .text-lg,
            .hero-section .text-xl,
            .hero-section .text-2xl {
                font-size: 0.95rem !important;
            }

            .flex.gap-6 {
                flex-direction: column;
                align-items: stretch;
            }

            .flex.gap-6>a,
            .flex.gap-6>button {
                width: 100%;
                justify-content: center;
            }

            .floating-letters {
                display: none !important;
            }
        }

        @media (max-width: 480px) {
            .hero-section {
                min-height: auto;
                padding: 20px 0;
            }

            .hero-section h1 {
                font-size: 1.5rem !important;
                line-height: 1.3;
            }

            .space-y-10 {
                gap: 1.5rem !important;
            }

            .max-w-xl {
                max-width: 100% !important;
            }
        }

        .ornamental-border {
            position: relative;
            padding: 2rem;
        }

        .ornamental-border::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #c9a961, transparent);
        }

        .ornamental-border::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #c9a961, transparent);
        }

        .floating-letters {
            position: absolute;
            font-size: 3rem;
            opacity: 0.05;
            color: white;
            font-family: 'Playfair Display', serif;
            font-weight: bold;
        }

        .library-stamp {
            position: relative;
            border: 2px dashed rgba(201, 169, 97, 0.5);
            border-radius: 10px;
            padding: 1.5rem;
        }

        .library-stamp::before {
            content: '✻';
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: #1a3a3a;
            color: #f5f3f0;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        /* Bookshelf Styles */
        .book {
            position: relative;
            cursor: pointer;
            border-radius: 2px;
            overflow: hidden;
            box-shadow: -2px 8px 16px rgba(0, 0, 0, 0.3), inset -1px 0 2px rgba(255, 255, 255, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .book::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.2) 0%, transparent 20%, transparent 80%, rgba(0, 0, 0, 0.15) 100%);
            z-index: 2;
        }

        .book::after {
            content: '';
            position: absolute;
            top: 0;
            right: -4px;
            width: 4px;
            height: 100%;
            background: linear-gradient(to left, rgba(0, 0, 0, 0.5), transparent);
            z-index: 1;
        }

        .book:hover {
            box-shadow: -3px 12px 24px rgba(0, 0, 0, 0.4), inset -1px 0 3px rgba(255, 255, 255, 0.15);
        }

        .book-spine {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.6), 0 0 4px rgba(255, 255, 255, 0.2);
            letter-spacing: 2px;
            font-size: 0.75rem;
        }

        .book-top {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            border-radius: 1px 1px 0 0;
            opacity: 0.7;
            box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.3), 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .book-edge {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 1px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.1), transparent 20%, transparent 80%, rgba(0, 0, 0, 0.2));
        }

        .book-emboss {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 70%;
            height: 40%;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 2px;
            pointer-events: none;
        }

        .book-detail-line {
            position: absolute;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        }

        .shelf {
            background: linear-gradient(to bottom,
                    #7a5230 0%,
                    #6b4423 15%,
                    #8b5a2b 30%,
                    #6b4423 45%,
                    #5a3a20 60%,
                    #4a2f1a 75%,
                    #6b4423 90%,
                    #5a3a20 100%);
            box-shadow:
                0 -3px 8px rgba(0, 0, 0, 0.4) inset,
                0 -1px 0px rgba(0, 0, 0, 0.2) inset,
                0 12px 30px rgba(0, 0, 0, 0.7),
                0 2px 4px rgba(255, 255, 255, 0.05) inset;
            border-top: 1px solid rgba(139, 90, 43, 0.8);
            border-bottom: 2px solid rgba(0, 0, 0, 0.9);
            position: relative;
        }

        .shelf::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg,
                    transparent 0%,
                    rgba(255, 255, 255, 0.15) 50%,
                    transparent 100%);
        }

        .shelf::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 100%;
            background-image:
                repeating-linear-gradient(90deg,
                    transparent 0px,
                    rgba(0, 0, 0, 0.02) 2px,
                    transparent 4px,
                    transparent 6px);
            pointer-events: none;
        }

        .shelf-support {
            background: linear-gradient(to bottom, #5a3a20, #3d2614, #2d1a0f);
            box-shadow:
                -3px 0 8px rgba(0, 0, 0, 0.6),
                3px 0 8px rgba(0, 0, 0, 0.6),
                inset -1px 0 2px rgba(255, 255, 255, 0.1),
                inset 1px 0 2px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .shelf-support::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        }

        .shelf-support::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(0deg,
                    rgba(0, 0, 0, 0.03) 0px,
                    transparent 1px,
                    transparent 2px,
                    rgba(0, 0, 0, 0.03) 3px);
        }

        .wood-grain {
            background-image:
                repeating-linear-gradient(90deg,
                    rgba(0, 0, 0, 0.03) 0px,
                    transparent 1px,
                    transparent 2px,
                    rgba(0, 0, 0, 0.03) 3px);
        }

        .book-detail {
            position: absolute;
            width: 100%;
            height: 2px;
            background: rgba(255, 255, 255, 0.1);
        }

        .floating-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        @keyframes float-particle {

            0%,
            100% {
                transform: translateY(0) translateX(0);
                opacity: 0.3;
            }

            50% {
                transform: translateY(-20px) translateX(10px);
                opacity: 0.6;
            }
        }

        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            animation: float-particle 4s ease-in-out infinite;
        }

        .bookshelf-container {
            filter: drop-shadow(0 10px 25px rgba(0, 0, 0, 0.2));
            overflow-x: auto;
            overflow-y: hidden;
        }

        .bookshelf-inner {
            position: relative;
        }

        .bookshelf-glow {
            position: absolute;
            inset: -20px;
            background: radial-gradient(ellipse at center, rgba(201, 169, 97, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            display: none;
        }

        .book-ribbon {
            position: absolute;
            width: 2px;
            height: 60%;
            background: linear-gradient(to bottom, rgba(220, 20, 60, 0.6), rgba(220, 20, 60, 0.3));
            right: 8%;
            top: 20%;
            border-radius: 1px;
            box-shadow: 1px 2px 3px rgba(0, 0, 0, 0.3);
            display: none;
        }

        @keyframes ribbon-sway {

            0%,
            100% {
                transform: rotateZ(0deg);
            }

            50% {
                transform: rotateZ(1deg);
            }
        }

        .book:nth-child(3) .book-ribbon {
            animation: ribbon-sway 3s ease-in-out infinite;
            background: linear-gradient(to bottom, rgba(46, 139, 87, 0.6), rgba(46, 139, 87, 0.3));
        }

        .book:nth-child(5) .book-ribbon {
            animation: ribbon-sway 3.5s ease-in-out infinite;
            background: linear-gradient(to bottom, rgba(138, 43, 226, 0.6), rgba(138, 43, 226, 0.3));
        }

        @media (min-width: 1024px) {
            .dropdown:hover .dropdown-menu {
                opacity: 1;
                visibility: visible;
            }
        }

        .dropdown-menu {
            position: absolute;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            z-index: 1;
            border-radius: 0.75rem;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px) translateX(-50%);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            margin: 0.25rem;
            border-radius: 0.5rem;
        }

        .dropdown-item:hover {
            background-color: var(--secondary-background);
            border-left-color: var(--primary);
        }

        @media (max-width: 1023px) {
            .nav-link {
                width: 100%;
                padding: 0.75rem 1rem;
                border-radius: 0.5rem;
            }

            .nav-link:hover {
                background-color: var(--secondary-background);
            }
        }

        body {
            font-family: 'Raleway', sans-serif;
            background: linear-gradient(to bottom, #f8f5f0, #e9e4d8);
        }

        .font-display {
            font-family: 'Playfair Display', serif;
        }

        .font-crimson {
            font-family: 'Crimson Pro', serif;
        }

        .library-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23d4a373' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .book-spine {
            position: relative;
            overflow: hidden;
        }

        .book-spine::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 8px;
        }

        .nav-link::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #8B6B61;
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .category-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            backdrop-filter: blur(4px);
            z-index: 20;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .page-turn {
            transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .page-turn:hover {
            transform: rotateY(15deg) translateX(-5px);
        }
    </style>
</head>

<body class="bg-background text-primary_text font-body">
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="fixed inset-0 z-50 2xl:hidden hidden">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity duration-300" id="mobileMenuOverlay">
        </div>
        <div class="fixed top-0 right-0 h-full w-[280px] max-w-[90vw] bg-surface shadow-2xl transform translate-x-full transition-transform duration-300 ease-out"
            id="mobileMenuPanel">
            <div class="flex flex-col h-full">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-heading font-bold text-primary_text">Menu</h2>
                        <button id="closeMobileMenu"
                            class="p-2 -mr-2 text-primary_text hover:text-secondary transition-colors rounded-lg hover:bg-gray-100">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                <nav id="navBarIDm" class="space-y-4">
                    <a data-page="Pocetna" href="/"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-home mr-3 text-secondary"></i>Početna
                    </a>
                    <div class="mobile-dropdown nonPage megaMenu relative group">
                        <button
                            class="nav-link text-slate font-semibold hover:text-terracotta transition-colors flex items-center whitespace-nowrap">
                            <i class="fas fa-info-circle mr-2 text-ochre group-hover:text-sage transition-colors"></i>
                            <span class="hidden xl:inline">
                                <p>Naslov</p>
                            </span>
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>

                        <!-- MEGA MENU -->
                        <div
                            class="mobile-dropdown-menu absolute top-full left-0 w-[600px] bg-paper rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 p-6 grid grid-cols-3 gap-6">

                            <!-- Sekcija (dinamički se dodaje) -->
                            <div>
                                <h3 class="font-bold text-slate mb-2">[Naslov sekcije]</h3>
                                <ul class="space-y-2">
                                    <li>
                                        <a href="#" class="flex items-center text-sm hover:text-terracotta">
                                            <i class="fas fa-circle mr-2 text-gray-400"></i>[Stavka 1]
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center text-sm hover:text-terracotta">
                                            <i class="fas fa-circle mr-2 text-gray-400"></i>[Stavka 2]
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex items-center text-sm hover:text-terracotta">
                                            <i class="fas fa-circle mr-2 text-gray-400"></i>[Stavka 3]
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Dupliraj ili izbriši sekciju po potrebi -->
                        </div>
                    </div>
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all"
                            id="mobileAboutToggle">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-3 text-accent"></i>O nama
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200"
                                id="mobileAboutIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileAboutMenu">
                            <a data-page="Uvod" href="/o-nama/uvod"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-book mr-2 text-primary"></i>Uvod
                            </a>
                            <a data-page="Misija i vizija" href="/o-nama/misija-i-vizija"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-flag mr-2 text-primary"></i>Misija i vizija
                            </a>
                            <a data-page="Istorijat" href="/o-nama/istorijat"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-history mr-2 text-secondary"></i>Istorijat
                            </a>
                            <a data-page="Organizaciona struktura" href="/o-nama/organizaciona-struktura"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-sitemap mr-2 text-primary"></i>Organizaciona struktura
                            </a>


                            </a>
                        </div>
                    </div>
                    <a data-page="Dogadjaji" href="/dogadjaji"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-calendar-alt mr-3 text-primary"></i>Dogadjaji
                    </a>
                    <a data-page="Galerija" href="/galerija"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-images mr-3 text-primary"></i>Galerija
                    </a>
                    <a data-page="Dokumenti" href="/dokumenti"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-folder-open mr-3 text-secondary"></i>Dokumenti
                    </a>
                    <a data-page="Kontakt" href="/kontakt"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-address-book mr-3 text-primary"></i>Kontakt
                    </a>
                </nav>
            </div>
        </div>
    </div>

    <!-- Font size toggle button -->
    <div>
        <button id="increaseFontBtn"
            class="fixed bottom-6 z-20 right-6 bg-primary_text hover:bg-primary_hover text-background font-bold py-3 px-5 rounded-full shadow-lg focus:outline-none transition-all"
            aria-label="Increase font size">
            A+
        </button>
    </div>

    <!-- Search Overlay -->
    <div id="searchOverlay"
        class="fixed inset-0 z-[100] flex flex-col items-center justify-center px-6 opacity-0 pointer-events-none transition-all duration-400 bg-background/96 backdrop-blur-lg">
        <button id="closeSearch"
            class="absolute top-8 right-8 text-primary_text hover:rotate-90 transition-transform duration-300">
            <i class="fas fa-times text-3xl"></i>
        </button>
        <div class="w-full max-w-4xl">
            <p class="text-accent font-semibold tracking-widest uppercase text-center mb-4 text-sm">Šta želite da
                odkrijete?</p>
            <form action="/pretraga" method="get" class="relative">
                <input type="text" name="q" placeholder="Unesite naslov knjige, autora ili pojam..."
                    class="w-full bg-transparent border-b-2 border-primary_text/20 py-6 text-3xl md:text-5xl font-heading focus:outline-none focus:border-accent transition-colors placeholder:text-primary_text/10">
                <button type="submit" class="absolute right-0 bottom-6 text-accent hover:scale-110 transition-transform"
                    title="Pretraži">
                    <i class="fas fa-arrow-right text-3xl"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Header with library theme -->
    <header class="fixed w-full z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
        <div class=" mx-auto px-6 lg:px-10 h-24 flex justify-between items-center">

            <a href="/" class="flex items-center gap-4 group">
                <div
                    class="relative w-14 h-14 flex items-center justify-center bg-white rounded-xl shadow-sm border border-gray-200 group-hover:border-primary group-hover:shadow-md transition-all duration-500 overflow-hidden p-1.5">
                    <img src="/assets/img/icon.png" alt="Logo"
                        class="w-full h-full object-contain transform group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-heading font-extrabold text-primary_text tracking-tight leading-none">
                        Odb "Veljko Petrović"
                    </span>
                    <span class="text-[10px] font-bold text-accent tracking-[0.3em] uppercase mt-1.5 opacity-80">
                        Čuvari znanja i kulture
                    </span>
                </div>
            </a>

            <nav id="navBarID" class="hidden xl:flex items-center gap-1">



                <div class="dropdown relative group">
                    <button
                        class="nav-link text-[13px] font-bold uppercase tracking-wider flex items-center px-4 py-2 text-primary_text/70 group-hover:text-primary transition-all">
                        O nama <i
                            class="fas fa-chevron-down ml-2 text-[10px] opacity-40 group-hover:rotate-180 transition-transform duration-300"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-0 mt-2 w-80 rounded-2xl bg-white border border-gray-100 shadow-2xl p-2 grid grid-cols-1 gap-0.5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 z-50">

                        <a href="/o-nama/misija-i-vizija"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all"><i
                                    class="fas fa-bullseye text-sm"></i></span>
                            <span class="text-sm font-semibold text-primary_text">Misija i vizija</span>
                        </a>

                        <a href="/o-nama/istorijat"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all"><i
                                    class="fas fa-history text-sm"></i></span>
                            <span class="text-sm font-semibold text-primary_text">Istorijat</span>
                        </a>
                        <a href="/o-nama/znacajne-licnosti"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all">
                                <i class="fas fa-user-tie text-sm"></i>
                            </span>
                            <span class="text-sm font-semibold text-primary_text">Značajne ličnosti</span>
                        </a>
                        <a href="/o-nama/organizaciona-struktura"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all"><i
                                    class="fas fa-sitemap text-sm"></i></span>
                            <span class="text-sm font-semibold text-primary_text">Organizaciona struktura</span>
                        </a>

                        <a href="/o-nama/organi-upravljanja"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all"><i
                                    class="fas fa-users-cog text-sm"></i></span>
                            <span class="text-sm font-semibold text-primary_text">Organi upravljanja</span>
                        </a>

                        <a href="/o-nama/informacije"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all"><i
                                    class="fas fa-info-circle text-sm"></i></span>
                            <span class="text-sm font-semibold text-primary_text">Informacije</span>
                        </a>

                        <a href="/o-nama/pitanja"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all"><i
                                    class="fas fa-question-circle text-sm"></i></span>
                            <span class="text-sm font-semibold text-primary_text">Pitanja</span>
                        </a>

                        <a href="/o-nama/prostorije"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all"><i
                                    class="fas fa-door-open text-sm"></i></span>
                            <span class="text-sm font-semibold text-primary_text">Prostorije</span>
                        </a>
                    </div>
                </div>

                <div class="dropdown relative group">
                    <button
                        class="nav-link text-[13px] font-bold uppercase tracking-wider flex items-center px-4 py-2 text-primary_text/70 group-hover:text-primary transition-all">
                        Aktivnosti <i
                            class="fas fa-chevron-down ml-2 text-[10px] opacity-40 group-hover:rotate-180 transition-transform duration-300"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-0 mt-2 w-64 rounded-2xl bg-white border border-gray-100 shadow-2xl p-2 grid grid-cols-1 gap-0.5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 z-50">
                        <a href="/aktivnosti/ankete"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all"><i
                                    class="fas fa-poll text-sm font-bold"></i></span>
                            <span class="text-sm font-semibold text-primary_text">Ankete</span>
                        </a>
                        <a href="/aktivnosti/vesti"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all"><i
                                    class="fas fa-newspaper text-sm font-bold"></i></span>
                            <span class="text-sm font-semibold text-primary_text">Vesti</span>
                        </a>
                        <a href="/aktivnosti/najave"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all">
                                <i class="fas fa-bullhorn text-sm font-bold"></i>
                            </span>
                            <span class="text-sm font-semibold text-primary_text">Najave</span>
                        </a>
                    </div>
                </div>

                <div class="dropdown relative group">
                    <button
                        class="nav-link text-[13px] font-bold uppercase tracking-wider flex items-center px-4 py-2 text-primary_text/70 group-hover:text-primary transition-all">
                        Usluge <i
                            class="fas fa-chevron-down ml-2 text-[10px] opacity-40 group-hover:rotate-180 transition-transform duration-300"></i>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full left-0 mt-2 w-96 rounded-2xl bg-white border border-gray-100 shadow-2xl p-2 grid grid-cols-1 gap-0.5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transform translate-y-2 group-hover:translate-y-0 transition-all duration-300 z-50">
                        <a href="/uclanjenje-i-pozajmica"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all"><i
                                    class="fas fa-id-card text-sm"></i></span>
                            <span class="text-sm font-semibold text-primary_text">Učlanjenje i pozajmica</span>
                        </a>
                        <a href="/koriscenje-gradje-u-prostorijama-biblioteke"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all"><i
                                    class="fas fa-book-open text-sm"></i></span>
                            <span class="text-sm font-semibold text-primary_text">Korišćenje građe</span>
                        </a>
                        <a href="/pristup-informacijama-o-gradji"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all"><i
                                    class="fas fa-info-circle text-sm"></i></span>
                            <span class="text-sm font-semibold text-primary_text">Pristup informacijama</span>
                        </a>
                        <a href="/pristup-fondu-zavicajnog-odeljenja"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all"><i
                                    class="fas fa-archive text-sm"></i></span>
                            <span class="text-sm font-semibold text-primary_text">Pristup fondu Zavijačnog
                                odeljenja</span>
                        </a>
                        <a href="/medjougranacka-pozajmica"
                            class="flex items-center gap-3 px-4 py-3 hover:bg-accent/10 rounded-xl transition-all group/item">
                            <span
                                class="w-9 h-9 rounded-lg bg-accent/20 flex items-center justify-center text-accent group-hover/item:scale-110 transition-all"><i
                                    class="fas fa-exchange-alt text-sm"></i></span>
                            <span class="text-sm font-semibold text-primary_text">Međuogranačka pozajmica</span>
                        </a>
                    </div>
                </div>
                <a href="odeljenja"
                    class="px-4 py-2 text-[13px] font-bold uppercase tracking-wider text-primary_text/70 hover:text-primary transition-all">
                    Odeljenja
                </a>
                <a href="/galerija"
                    class="px-4 py-2 text-[13px] font-bold uppercase tracking-wider text-primary_text/70 hover:text-primary transition-all">Galerija</a>
                <a href="/dokumenti"
                    class="px-4 py-2 text-[13px] font-bold uppercase tracking-wider text-primary_text/70 hover:text-primary transition-all">Dokumenti</a>

                <a href="/kontakt"
                    class="px-4 py-2 text-[13px] font-bold uppercase tracking-wider text-primary_text/70 hover:text-primary transition-all">Kontakt</a>

                <?php
                if (isset($_GET['locale'])) {
                    $_SESSION['locale'] = $_GET['locale'];
                }
                $locale = $_SESSION['locale'] ?? 'sr';
                $languages = [
                    'sr' => ['label' => 'SR', 'flag' => '<svg class="w-5 h-5" ...>'], // Your SVG
                    'sr-Cyrl' => ['label' => 'ЋИР', 'flag' => '<svg class="w-5 h-5" ...>'],
                    'en' => ['label' => 'EN', 'flag' => '<svg class="w-5 h-5" ...>'],
                ];
                ?>
                <div class="locale dropdown relative group ml-2">
                    <button
                        class="flex items-center gap-2 px-3 py-2 bg-gray-50 rounded-lg text-primary_text group-hover:bg-primary group-hover:text-white transition-all duration-300">
                        <span
                            class="w-5 h-5 rounded-full overflow-hidden flex-shrink-0"><?= $languages[$locale]['flag'] ?></span>
                        <span class="text-xs font-bold"><?= $languages[$locale]['label'] ?></span>
                    </button>
                    <div
                        class="dropdown-menu absolute top-full right-0 mt-2 w-40 rounded-xl bg-white border border-gray-100 shadow-2xl p-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <?php foreach ($languages as $key => $lang): ?>
                            <a href="?locale=<?= $key ?>"
                                class="flex items-center gap-3 px-3 py-2 hover:bg-gray-50 rounded-lg transition-all">
                                <span class="w-5 h-5"><?= $lang['flag'] ?></span>
                                <span class="text-xs font-bold text-primary_text"><?= $lang['label'] ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </nav>

            <div class="flex items-center gap-3">
                <button id="searchButton"
                    class="w-10 h-10 flex items-center justify-center rounded-full text-primary_text hover:bg-primary hover:text-white transition-all duration-300">
                    <i class="fas fa-search"></i>
                </button>
                <button id="mobileMenuButton"
                    class="xl:hidden w-10 h-10 flex items-center justify-center rounded-full text-primary_text hover:bg-primary/10 transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="fixed inset-0 z-40 xl:hidden hidden">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm transition-opacity duration-300" id="mobileMenuOverlay">
        </div>
        <div class="fixed top-0 right-0 h-full w-[280px] max-w-[90vw] bg-surface shadow-2xl transform translate-x-full transition-transform duration-300 ease-out"
            id="mobileMenuPanel">
            <div class="flex flex-col h-full">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-heading font-bold text-primary_text">Menu</h2>
                        <button id="closeMobileMenu"
                            class="p-2 -mr-2 text-primary_text hover:text-secondary transition-colors rounded-lg hover:bg-gray-100">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                <nav id="navBarIDm" class="space-y-4 flex-1 overflow-y-auto p-4">
                    <a data-page="Pocetna" href="/"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-home mr-3 text-secondary"></i>Početna
                    </a>
                    <div class="mobile-dropdown nonPage megaMenu relative group">
                        <button
                            class="flex items-center w-full justify-between py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all"
                            id="mobileAboutToggle">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle mr-3 text-accent"></i>O nama
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200"
                                id="mobileAboutIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileAboutMenu">
                            <a data-page="Uvod" href="/o-nama/uvod"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-book mr-2 text-primary"></i>Uvod
                            </a>
                            <a data-page="Misija i vizija" href="/o-nama/misija-i-vizija"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-flag mr-2 text-primary"></i>Misija i vizija
                            </a>
                            <a data-page="Istorijat" href="/o-nama/istorijat"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-history mr-2 text-secondary"></i>Istorijat
                            </a>
                            <a data-page="Organizaciona struktura" href="/o-nama/organizaciona-struktura"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-sitemap mr-2 text-primary"></i>Organizaciona struktura
                            </a>
                            <a data-page="Organi upravljanja" href="/o-nama/organi-upravljanja"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-users-cog mr-2 text-primary"></i>Organi upravljanja
                            </a>
                            <a data-page="Objekat" href="/o-nama/objekat"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-building mr-2 text-primary"></i>Objekat
                            </a>
                            <a data-page="Informacije" href="/o-nama/informacije"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-info-circle mr-2 text-primary"></i>Informacije
                            </a>
                            <a data-page="Pitanja" href="/o-nama/pitanja"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-question-circle mr-2 text-primary"></i>Pitanja
                            </a>
                        </div>
                    </div>
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all"
                            id="mobileActivitiesToggle">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt mr-3 text-accent"></i>Aktivnosti
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200"
                                id="mobileActivitiesIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileActivitiesMenu">
                            <a data-page="Ankete" href="/aktivnosti/ankete"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-poll mr-2 text-primary"></i>Ankete
                            </a>
                            <a data-page="Vesti" href="/aktivnosti/vesti"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-newspaper mr-2 text-primary"></i>Vesti
                            </a>
                        </div>
                    </div>
                    <div class="mobile-dropdown">
                        <button
                            class="flex items-center justify-between w-full py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all"
                            id="mobileServicesToggle">
                            <div class="flex items-center">
                                <i class="fas fa-concierge-bell mr-3 text-accent"></i>Usluge
                            </div>
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200"
                                id="mobileServicesIcon"></i>
                        </button>
                        <div class="ml-6 mt-2 space-y-2 hidden" id="mobileServicesMenu">
                            <a data-page="Odeljenje za odrasle" href="/usluge/odeljenje-za-odrasle"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-user mr-2 text-primary"></i>Odeljenje za odrasle
                            </a>
                            <a data-page="Dečje odeljenje" href="/usluge/decje-odeljenje"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-child mr-2 text-primary"></i>Dečje odeljenje
                            </a>
                            <a data-page="Zavičajni fond" href="/usluge/zavicajni-fond"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-archive mr-2 text-primary"></i>Zavičajni fond
                            </a>
                            <a data-page="Legat" href="/usluge/legat"
                                class="flex items-center py-2 px-4 text-sm text-primary_text hover:text-secondary transition-colors">
                                <i class="fas fa-gift mr-2 text-primary"></i>Legat
                            </a>
                        </div>
                    </div>
                    <a data-page="Galerija" href="/galerija"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-images mr-3 text-primary"></i>Galerija
                    </a>
                    <a data-page="Dokumenti" href="/dokumenti"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-folder-open mr-3 text-secondary"></i>Dokumenti
                    </a>
                    <a data-page="Kontakt" href="/kontakt"
                        class="flex items-center py-3 px-4 text-primary_text hover:text-secondary hover:bg-secondary_background rounded-lg transition-all">
                        <i class="fas fa-address-book mr-3 text-primary"></i>Kontakt
                    </a>
                </nav>
            </div>
        </div>
    </div>

    <!-- Hero Section with library theme -->
    <section class="relative min-h-screen flex items-center overflow-hidden pt-16">

        <div class="absolute inset-0 z-0">
            <img src="https://bibliotekazabalj.org.rs/wp-content/uploads/2022/02/zabalj-header-2022-2.jpg"
                alt="Pozadina Žabalj" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-r from-primary/90 via-primary/60 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 lg:px-16 relative z-10 py-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">

                <div class="lg:col-span-6 space-y-8">
                    <div class="animate-fadeIn">
                        <span
                            class="inline-block bg-accent/20 text-accent border border-accent/30 px-4 py-1 rounded-full text-sm font-bold tracking-widest uppercase mb-6">
                            Zvanična prezentacija
                        </span>
                        <h1 class="text-4xl md:text-6xl font-heading font-bold leading-tight text-white mb-6">
                            Dobrodošli na internet prezentaciju <br />
                            <span class="text-accent italic font-heading2 tracking-normal">ONB „Veljko Petrović“
                                Žabalj</span>
                        </h1>
                    </div>

                    <div class="relative pl-6 border-l-4 border-accent space-y-4">
                        <p class="text-xl text-white/90 leading-relaxed max-w-lg font-body">
                            Mesto gde se umetnost, knjiga i kultura susreću. Otkrijte bogatstvo naše riznice u srcu
                            Šajkaške.
                        </p>
                        <p class="text-white/70 italic font-body">
                            "Biblioteka nije luksuz, već jedna od potreba života."
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-10">
                        <div
                            class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/10 flex items-center group hover:bg-white/20 transition">
                            <i class="fas fa-book text-accent text-2xl mr-4"></i>
                            <span class="text-white font-medium">50,000+ Naslova</span>
                        </div>
                        <div
                            class="bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/10 flex items-center group hover:bg-white/20 transition">
                            <i class="fas fa-wifi text-accent text-2xl mr-4"></i>
                            <span class="text-white font-medium">E-Čitaonica</span>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6 flex flex-col items-center lg:items-end">


                    <div class="relative w-full max-w-4xl z-10">
                        <div class="flex justify-center items-end px-4 space-x-1 sm:space-x-2 mb-[-4px] overflow-x-auto pb-2"
                            id="ix24ga">
                            <div class="hidden sm:block relative w-8 h-10 shadow-lg mr-4 flex-shrink-0">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-amber-700 via-amber-500 to-amber-800 rounded-t-full rounded-b-sm metal-tex border-l border-white/20">
                                    <div
                                        class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 border-2 border-amber-600 rounded-full">
                                    </div>
                                    <div class="flex items-center justify-center h-full pt-2"><span
                                            class="text-[8px] font-bold text-amber-900/70 engraved-text">500g</span>
                                    </div>
                                </div>
                            </div>
                            <div class="relative w-10 h-36 sm:w-12 sm:h-48 shadow-2xl flex-shrink-0">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-blue-950 via-blue-900 to-blue-950 rounded-sm leather-tex border-l border-white/10">
                                    <div class="flex flex-col justify-between h-full py-4 items-center">
                                        <div class="spine-band"></div>
                                        <div
                                            class="book-spine text-amber-400/90 text-[9px] sm:text-[10px] tracking-[0.2em] font-bold">
                                            НАУКА
                                        </div>
                                        <div class="spine-band"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="relative w-12 h-44 sm:w-14 sm:h-56 shadow-2xl z-10 flex-shrink-0">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-rose-950 via-rose-900 to-rose-950 rounded-sm leather-tex border-l border-white/10">
                                    <div class="flex flex-col justify-between h-full py-6 items-center">
                                        <div class="space-y-1 w-full">
                                            <div class="spine-band"></div>
                                            <div class="spine-band"></div>
                                        </div>
                                        <div
                                            class="book-spine text-amber-200 text-[8px] sm:text-xs tracking-[0.3em] drop-shadow-md">
                                            ПОЕЗИЈА
                                        </div>
                                        <div class="space-y-1 w-full">
                                            <div class="spine-band"></div>
                                            <div class="spine-band"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="relative w-9 h-36 sm:w-10 sm:h-40 shadow-lg ml-1 z-0 flex-shrink-0">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-amber-200 via-amber-100 to-amber-200 rounded-sm paper-tex border-l border-amber-400/30">
                                    <div class="absolute top-1/2 left-0 right-0 h-3 bg-red-900/80 shadow-sm"></div>
                                    <div
                                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-4 h-4 bg-red-800 rounded-full shadow-md border border-red-950">
                                    </div>
                                    <div
                                        class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-b from-amber-300 to-transparent rounded-t-sm opacity-50">
                                    </div>
                                    <div
                                        class="absolute bottom-0 left-0 right-0 h-2 bg-gradient-to-t from-amber-300 to-transparent rounded-b-sm opacity-50">
                                    </div>
                                </div>
                            </div>
                            <div class="hidden sm:block relative w-11 h-44 shadow-2xl flex-shrink-0">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-emerald-950 via-emerald-900 to-emerald-950 rounded-sm leather-tex border-l border-white/10">
                                    <div class="flex flex-col justify-between h-full py-4 items-center">
                                        <div class="spine-band opacity-50"></div>
                                        <div class="book-spine text-amber-500/80 text-[10px] tracking-widest">ФИЛОЗОФИЈА
                                        </div>
                                        <div class="spine-band opacity-50"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden sm:block relative w-16 h-64 shadow-2xl flex-shrink-0">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-amber-950 via-amber-900 to-amber-950 rounded-sm leather-tex border-l border-white/10">
                                    <div class="flex flex-col justify-between h-full py-8 items-center">
                                        <div class="space-y-2 w-full">
                                            <div class="spine-band"></div>
                                            <div class="spine-band"></div>
                                        </div>
                                        <div class="book-spine text-amber-200 text-sm tracking-[0.4em] font-bold">
                                            ИСТОРИЈА</div>
                                        <div class="space-y-2 w-full">
                                            <div class="spine-band"></div>
                                            <div class="spine-band"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="relative w-11 h-40 sm:w-12 sm:h-52 shadow-2xl flex-shrink-0">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-indigo-950 via-indigo-900 to-indigo-950 rounded-sm leather-tex border-l border-white/10">
                                    <div class="flex flex-col justify-between h-full py-5 items-center">
                                        <div class="spine-band"></div>
                                        <div
                                            class="book-spine text-slate-300 text-[8px] sm:text-[10px] tracking-[0.2em]">
                                            КЊИЖЕВНОСТ</div>
                                        <div class="spine-band"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative">
                            <div
                                class="h-6 bg-gradient-to-b from-amber-800 to-amber-900 rounded-t-sm shadow-inner relative overflow-hidden border-b border-amber-950">
                                <div class="absolute inset-0 opacity-30 wood-tex"></div>
                                <div class="h-[1px] w-full bg-white/20 absolute top-0"></div>
                            </div>
                            <div
                                class="h-14 bg-gradient-to-b from-amber-900 to-amber-950 rounded-b-md shadow-2xl relative flex items-center justify-center overflow-hidden">
                                <div class="absolute inset-0 opacity-50 wood-tex"></div>
                                <div class="absolute top-0 h-[2px] w-full bg-black/40"></div>
                                <div class="absolute bottom-0 h-[1px] w-full bg-amber-700/30"></div>
                                <div
                                    class="relative z-10 w-148 h-8 brass-plate rounded-sm flex items-center justify-between px-2 metal-tex">
                                    <div class="rivet"></div><span
                                        class="font-cinzel text-xs font-bold tracking-[0.2em] engraved-text uppercase">Библиотека
                                        „Вељко
                                        Петровић"</span>
                                    <div class="rivet"></div>
                                </div>
                            </div>
                            <div class="absolute top-full left-12 -z-10">
                                <div
                                    class="w-4 h-8 bg-gradient-to-b from-amber-950 to-transparent relative overflow-hidden">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-tr from-amber-900 via-amber-800 to-transparent rounded-bl-3xl border-l-2 border-amber-950 shadow-lg">
                                    </div>
                                </div>
                            </div>
                            <div class="absolute top-full right-12 -z-10 transform -scale-x-100">
                                <div
                                    class="w-4 h-8 bg-gradient-to-b from-amber-950 to-transparent relative overflow-hidden">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-tr from-amber-900 via-amber-800 to-transparent rounded-bl-3xl border-l-2 border-amber-950 shadow-lg">
                                    </div>
                                </div>
                            </div>
                            <div
                                class="absolute -bottom-12 left-4 right-4 h-12 bg-black/50 blur-2xl rounded-[100%] -z-20">
                            </div>
                        </div>
                    </div>
                    <div
                        class="w-full mt-8 bg-surface rounded-2xl shadow-xl mb-10 transform hover:-translate-y-1 transition-all duration-500 border-b-4 border-accent overflow-hidden">

                        <div class="relative w-full h-16 md:h-20 overflow-hidden">
                            <img src="https://bibliotekazabalj.org.rs/wp-content/uploads/2022/02/cobiss.jpg"
                                alt="COBISS logo" class="w-full h-full object-cover object-center scale-110" />
                            <div class="absolute inset-0 bg-gradient-to-r from-primary/40 to-transparent"></div>
                            <div class="absolute inset-0 flex items-center px-6">
                                <span
                                    class="text-[10px] font-bold uppercase tracking-[0.2em] text-white bg-accent/90 px-2 py-0.5 rounded shadow-sm font-body">
                                    Online Katalog
                                </span>
                            </div>
                        </div>

                        <div class="px-4 py-3 md:px-6 md:py-4">
                            <div class="flex flex-col md:flex-row items-center gap-4">

                                <h3 class="font-heading2 text-xl text-primary whitespace-nowrap">
                                    Pretražite fond:
                                </h3>

                                <a href="https://plus.cobiss.net/cobiss/sr/sr/colib/Zabalj" target="_blank"
                                    class="group flex-grow flex items-center bg-background border border-secondary/20 rounded-xl px-4 py-2 hover:border-accent transition-all duration-300">
                                    <div class="flex-grow">
                                        <span class="text-primary_text/50 font-body text-sm italic">Unesite naslov,
                                            autora ili ključnu reč...</span>
                                    </div>
                                    <div class="text-secondary/40 group-hover:text-accent transition-colors">
                                        <i class="fas fa-search text-lg"></i>
                                    </div>
                                </a>

                                <p class="text-[10px] text-secondary_text/50 font-body italic whitespace-nowrap">
                                    *Otvara COBISS+ Žabalj
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2">
            <div class="w-6 h-10 rounded-full border-2 border-accent/50 flex justify-center p-1">
                <div class="w-1.5 h-1.5 bg-accent rounded-full animate-bounce"></div>
            </div>
        </div>
    </section>
    <section id="vesti" class="py-20 bg-gradient-to-br from-secondary_background to-background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-heading font-bold text-primary_text mb-4 relative inline-block">
                    Najnovije Vesti
                    <div
                        class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-accent via-primary to-secondary rounded-full">
                    </div>
                </h2>
                <p class="text-lg text-secondary_text max-w-2xl mx-auto mt-6">
                    Budite u toku sa najnovijim dešavanjima iz sveta kulture, obrazovanja i inovacija
                </p>
            </div>

            <div id="vestiCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php for ($i = 0; $i < 3; $i++): ?>

                    <!-- Example article (drop-in) -->
                    <article class="group relative max-w-lg mx-auto md:max-w-4xl mb-20">
                        <div
                            class="absolute -inset-4 bg-slate-100/50 rounded-[40px] -z-10 scale-95 group-hover:scale-100 transition-transform duration-700">
                        </div>

                        <div class="flex flex-col md:flex-row items-center">
                            <!-- IMAGE / FALLBACK -->
                            <div class="w-full md:w-3/5 relative z-0">
                                <div
                                    class="aspect-[4/3] md:aspect-square overflow-hidden rounded-3xl shadow-2xl image-wrap">
                                    <!-- Image: on error -> hide and show fallback -->
                                    <img id="g-image" src="" alt="Vest slika" loading="lazy"
                                        onerror="this.closest('.image-wrap').classList.add('no-image')"
                                        class="w-full h-full object-cover grayscale-[30%] group-hover:grayscale-0 group-hover:scale-105 transition-all duration-1000" />

                                    <!-- fallback shown when image missing or error triggers `no-image` class -->
                                    <div class="image-fallback absolute inset-0 p-6 rounded-3xl">
                                        <!-- a compact SVG + label could be used here; kept simple text for accessibility -->
                                        <div>
                                            <div class="text-sm uppercase tracking-wider text-amber-600">Nema slike</div>
                                            <div class="mt-2 text-xs text-slate-600">Slika nije dostupna — pregledajte
                                                tekstualni opis.</div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="absolute top-8 -left-2 bg-amber-500 text-slate-900 py-2 px-6 shadow-xl rounded-r-lg transform -rotate-2">
                                    <p id="g-naziv" class="text-xs font-black uppercase tracking-[0.2em]">Kultura</p>
                                </div>
                            </div>

                            <!-- TEXT CARD -->
                            <div
                                class="w-[90%] md:w-1/2 -mt-16 md:mt-0 md:-ml-24 relative z-10 bg-white p-6 md:p-10 rounded-2xl shadow-[0_20px_60px_-15px_rgba(0,0,0,0.12)] border border-slate-100 shadow-responsive">
                                <div class="space-y-6">
                                    <div class="w-12 h-1 bg-amber-500"></div>

                                    <!-- Title: clamp to 3 lines, prevent word overflow -->
                                    <h3 id="g-naslov"
                                        class="text-2xl md:text-4xl font-serif font-bold text-slate-900 leading-[1.05] hover:text-amber-600 transition-colors duration-300 prevent-overflow line-clamp-3">
                                        Gostovanje poznatog pisca i književna radionica — naslov koji je izrazito dug i
                                        mogao bi narušiti dizajn ako se ne ograniči broj prikazanih redova
                                    </h3>

                                    <!-- Description: clamp to 4 lines; italic + lighter -->
                                    <p id="g-opis"
                                        class="text-slate-500 text-lg leading-relaxed italic font-light prevent-overflow line-clamp-4">
                                        U velikoj sali Biblioteke održano je gostovanje poznatog pisca uz interaktivnu
                                        književnu radionicu. Ovaj paragraf je namerno vrlo dug kako bi se pokazalo da će
                                        prelom i prikaz biti uredan i da neće "ispasti" iz kartice ili prelaziti preko dela
                                        slike, čak i kada je opis višeredan i sadrži veoma duge reči kao što su:
                                        superdugarezultatnaziva,neprekidnarezpražnjavanje,hiperproduktivnost.
                                    </p>

                                    <div class="pt-4">
                                        <a id="g-ovise" href="#"
                                            class="inline-flex items-center group/link text-slate-900 font-bold tracking-tighter uppercase text-sm">
                                            <span
                                                class="border-b-2 border-amber-500 pb-1 group-hover/link:pr-4 transition-all duration-300">
                                                Pročitaj celu vest
                                            </span>
                                            <i
                                                class="fas fa-chevron-right text-amber-500 ml-2 opacity-0 group-hover/link:opacity-100 transition-all"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endfor; ?>
            </div>

            <div class="text-center mt-16">
                <button id="vestiView"
                    class="bg-gradient-to-r from-primary via-primary_hover to-primary text-white px-10 py-4 rounded-full font-semibold hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center mx-auto group shadow-xl">
                    <i class="fas fa-newspaper mr-3 group-hover:rotate-12 transition-transform"></i>
                    Pogledaj sve vesti
                    <i class="fas fa-chevron-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </div>
        </div>
    </section>
    <section class="relative w-full bg-primary min-h-screen flex items-center overflow-hidden">

        <div class="absolute inset-0 z-0">
            <img src="https://bibliotekazabalj.org.rs/wp-content/uploads/2022/03/direktor.jpg" alt="Direktor biblioteke"
                class="w-full h-full object-cover object-center lg:object-left" />
            <div
                class="absolute inset-0 bg-gradient-to-t from-primary via-primary/60 to-transparent lg:bg-gradient-to-l lg:from-primary lg:via-primary/80 lg:to-transparent">
            </div>
        </div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-16 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                <div class="hidden lg:block lg:col-span-5 xl:col-span-6"></div>

                <div class="lg:col-span-7 xl:col-span-6 flex flex-col justify-center">

                    <div class="flex items-center gap-4 mb-6">
                        <span class="font-heading2 text-accent text-xl italic tracking-wide">Reč direktora</span>
                        <div class="w-12 h-[1px] bg-accent/50"></div>
                    </div>

                    <h1 class="font-heading text-5xl lg:text-7xl text-white mb-8 leading-tight">
                        Milovan <span class="text-accent italic block lg:inline">Mirkov</span>
                    </h1>

                    <div class="space-y-6 text-white/90 font-body text-lg lg:text-xl leading-relaxed">
                        <p class="font-heading2 text-2xl text-secondary_background italic leading-snug">
                            "Danas bibliotekarstvo jeste pred izazovima savremenog doba dominacije tehnologije. I to je
                            za nas pozitivan izazov."
                        </p>

                        <p>
                            Potrebe naših korisnika polaze od tradicionalnog načina funkcionisanja,
                            a završavaju se u brojnim kulturnim dešavanjima koja želimo da ponudimo.
                        </p>

                        <p>
                            Pozivam sve prijatelje <span class="text-accent font-semibold">Biblioteke</span> na saradnju
                            kako bi naše kulturno nasleđe postalo prepoznatljiv brend opštine Žabalj.
                        </p>

                        <div class="pt-10 flex flex-col items-start gap-4">
                            <div class="font-heading text-4xl text-white">Dobrodošli!</div>

                            <div class="flex items-center gap-4 mt-2">
                                <div class="w-8 h-8 rounded-full border border-accent flex items-center justify-center">
                                    <i class="fas fa-pen text-[10px] text-accent"></i>
                                </div>
                                <div class="text-sm uppercase tracking-widest text-white/50">
                                    <strong class="text-white block">Milovan Mirkov</strong>
                                    Direktor ONB „Veljko Petrović“
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="absolute top-10 right-10 opacity-10 hidden lg:block">
            <i class="fas fa-book-reader text-8xl text-white"></i>
        </div>
    </section>

    <!-- Featured Events Section -->
    <section id="events" class="py-20 bg-secondary_background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-heading font-bold text-primary_text mb-4 relative inline-block">
                    Predstojeći Događaji
                    <span
                        class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-secondary"></span>
                </h2>
                <p class="text-lg text-secondary_text max-w-2xl mx-auto mt-4">
                    Istražite našu bogatu ponudu kulturnih događaja koji će vas inspirisati i zabaviti
                </p>
            </div>

            <div id="eventsCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php for ($i = 0; $i < 3; $i++): ?>
                    <article
                        class="news-card bg-surface rounded-2xl shadow-lg hover:shadow-2xl transition-shadow duration-300 max-w-3xl mx-auto flex flex-col md:flex-row overflow-hidden">

                        <!-- Slika -->
                        <div class="w-full md:w-1/3 relative flex-shrink-0 h-64 md:h-auto">
                            <img id="g-image"
                                src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=600&q=80"
                                alt="Vest slika"
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                            <div
                                class="absolute top-3 left-3 bg-accent text-white px-3 py-1 rounded-full text-xs font-bold shadow-md uppercase tracking-wide">
                                Vest
                            </div>
                        </div>

                        <!-- Tekstualni deo -->
                        <div class="w-full md:w-2/3 p-6 flex flex-col justify-between">
                            <div class="mb-4">
                                <h3 id="g-naslov"
                                    class="text-xl md:text-2xl font-heading font-bold text-primary_text hover:text-accent transition-colors duration-300 mb-2 line-clamp-2">
                                    Gostovanje poznatog pisca i književna radionica
                                </h3>

                                <p id="g-opis"
                                    class="text-secondary_text text-sm md:text-base leading-relaxed line-clamp-3 mb-3">
                                    U velikoj sali Biblioteke održano je gostovanje poznatog pisca uz interaktivnu književnu
                                    radionicu za sve
                                    ljubitelje savremene proze.
                                </p>
                            </div>


                            <!-- Dugme -->
                            <div>
                                <a id="g-ovise" href="#"
                                    class="bg-accent text-white font-bold py-2 px-6 rounded-lg hover:bg-accent_hover transition-colors duration-300 text-sm inline-block text-center w-full md:w-auto">
                                    Pročitaj više
                                </a>
                            </div>
                        </div>
                    </article>

                <?php endfor; ?>
            </div>
            <div class="text-center mt-12">
                <a href="/aktivnosti/dogadjaji" id="eventsView"
                    class="bg-gradient-to-r from-primary to-primary_hover text-white px-8 py-4 rounded-full font-medium hover:opacity-90 transition-all flex items-center justify-center shadow-lg mx-auto max-w-xs w-auto">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Pogledaj sve događaje
                </a>
            </div>
        </div>
    </section>

    <section class="bg-background py-20 px-4 md:px-0 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center">

                <div class="w-full lg:w-5/12 lg:pr-16 z-10 mb-12 lg:mb-0">
                    <div class="space-y-6">
                        <div class="inline-block px-3 py-1 border border-accent/30 rounded-full">
                            <p class="font-body text-accent text-xs uppercase tracking-widest font-bold">Kulturno
                                Nasleđe</p>
                        </div>

                        <h2 class="font-heading text-primary text-4xl md:text-5xl lg:text-6xl leading-[1.05]">
                            Upoznajte <span class="italic text-secondary_text">značajne ličnosti</span> opštine Žabalj
                        </h2>

                        <div class="h-1 w-20 bg-accent"></div>

                        <p class="font-body text-secondary_text text-lg leading-relaxed">
                            Za vas smo izdvojili pojedine značajne ličnosti opštine Žabalj. Otkrijte priče o ljudima
                            koji su svojom vizijom i radom postali neraskidivi deo istorije našeg podneblja.
                        </p>

                        <div class="pt-4">
                            <a href="#" class="group inline-flex items-center space-x-4">
                                <span
                                    class="w-12 h-12 rounded-full border border-primary flex items-center justify-center group-hover:bg-primary transition-all duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-primary group-hover:text-surface transition-colors"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </span>
                                <span
                                    class="font-heading2 text-primary text-xl group-hover:text-accent transition-colors">Istražite
                                    biografije</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-7/12 relative">
                    <div
                        class="absolute -top-10 -right-10 w-64 h-64 bg-secondary_background rounded-full mix-blend-multiply filter blur-3xl opacity-70">
                    </div>

                    <div
                        class="relative bg-surface p-4 shadow-2xl rounded-sm rotate-1 hover:rotate-0 transition-transform duration-500">
                        <div class="overflow-hidden aspect-video lg:aspect-[4/3]">
                            <img src="https://images.unsplash.com/photo-1491153041158-9575971ce79a?auto=format&fit=crop&q=80&w=1200"
                                alt="Značajne ličnosti"
                                class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-1000 scale-105 hover:scale-100" />
                        </div>

                        <div
                            class="absolute bottom-10 -left-10 md:-left-20 bg-primary p-6 md:p-8 max-w-xs shadow-xl hidden md:block">
                            <h4 class="font-heading2 text-surface text-2xl mb-2">
                                Značajne ličnosti opštine Žabalj
                            </h4>
                            <p class="font-body text-surface/70 text-sm italic">
                                Arhivska građa i sećanja na velikane našeg kraja.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-background">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-heading font-bold text-primary_text mb-4">
                    Naši Prostori
                </h2>
                <p class="text-lg text-primary_text max-w-2xl mx-auto">
                    Moderni, inspirativni prostori dizajnirani za čitanje i kulturne aktivnosti
                </p>
            </div>

            <div id="galleryCards" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img id="g-image_file_path"
                        src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=600&q=80"
                        alt="Reading Room"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text to-transparent p-4 text-background">
                        <h3 id="g-description" class="font-bold text-lg">Glavna čitaonica</h3>
                        <p id="g-title" class="text-sm">Prostor za čitanje i učenje</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=600&q=80"
                        alt="Bookshelves"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text to-transparent p-4 text-background">
                        <h3 class="font-bold text-lg">Knjižni fond</h3>
                        <p class="text-sm">Preko 50,000 naslova</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img src="https://images.unsplash.com/photo-1495640388908-05fa85288e61?auto=format&fit=crop&w=600&q=80"
                        alt="Reading Area"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text to-transparent p-4 text-background">
                        <h3 class="font-bold text-lg">Dečija čitaonica</h3>
                        <p class="text-sm">Prostor za najmlađe čitaoce</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765?auto=format&fit=crop&w=600&q=80"
                        alt="Study Area"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text to-transparent p-4 text-background">
                        <h3 class="font-bold text-lg">Studijska zona</h3>
                        <p class="text-sm">Prostor za koncentraciju</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=600&q=80"
                        alt="Workshop"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text to-transparent p-4 text-background">
                        <h3 class="font-bold text-lg">Radionica</h3>
                        <p class="text-sm">Prostor za kreativne radionice</p>
                    </div>
                </div>
                <div class="overflow-hidden rounded-xl relative h-80">
                    <img src="https://images.unsplash.com/photo-1491975474562-1f4e30bc9468?auto=format&fit=crop&w=600&q=80"
                        alt="Cafe" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                    <div
                        class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary_text to-transparent p-4 text-background">
                        <h3 class="font-bold text-lg">Knjižni kafić</h3>
                        <p class="text-sm">Mesto za opuštanje uz knjigu</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-secondary text-surface pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8"><!-- Leva kolona - Logo i opis -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-lg flex items-center justify-center">
                            <i class="fas fa-book text-xl text-surface"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Opštinska narodna biblioteka</h3>
                            <p class="text-xs text-accent tracking-widest">"VELJKO PETROVIĆ" ŽABALJ</p>
                        </div>
                    </div>
                    <p class="text-gray-300 text-sm mb-4">Opštinska narodna biblioteka "Veljko Petrović" Žabalj sa
                        centralnom bibliotekom u Žablju.</p>
                    <div class="flex space-x-3"><a href="https://www.facebook.com/onbibliotekazabalj/?locale=sr_RS"
                            class="w-9 h-9 bg-primary rounded-full flex items-center justify-center hover:bg-primary_hover transition-colors"><i
                                class="fab fa-facebook-f text-sm"></i></a><a
                            href="https://www.instagram.com/bibliotekazabalj/"
                            class="w-9 h-9 bg-primary rounded-full flex items-center justify-center hover:bg-primary_hover transition-colors"><i
                                class="fab fa-instagram text-sm"></i></a></div>
                </div><!-- Srednja kolona - Brzi linkovi -->
                <div>
                    <h4 class="text-lg font-bold mb-4 text-accent">BRZI LINKOVI</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i>Početna</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i>O nama</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i>Sportovi</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i>Članstvo</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i>Dokumenti</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary transition-colors flex items-center"><i
                                    class="fas fa-chevron-right text-xs mr-2 text-primary"></i>Kontakt</a></li>
                    </ul>
                </div><!-- Desna kolona - Lokacija -->
                <div>
                    <h4 class="text-lg font-bold mb-4 text-accent">LOKACIJA (ŽABALJ)</h4>
                    <div class="text-gray-300 text-sm space-y-2">
                        <p><strong>Adresa:</strong>122, Žabalj</p>
                        <p><strong>Telefon:</strong> <a href="tel:+381212931004"
                                class="text-gray-200 hover:text-primary">+381212931004</a></p>
                        <p><strong>E-pošta:</strong> <a href="mailto:onbveljkopetrovic@gmail.com"
                                class="text-gray-200 hover:text-primary break-all">onbveljkopetrovic@gmail.com</a></p>
                        <div class="mt-3">
                            <p class="font-semibold mb-1">Radno vreme:</p>
                            <ul class="text-xs space-y-1">
                                <li>Ponedeljak - Petak: 07:00–19:00</li>
                                <li>Subota - Nedelja: Zatvoreno</li>
                            </ul>
                        </div>
                        <p class="text-xs">Plus code:<span class="font-medium">93G6+9Q Žabalj</span></p>
                    </div>
                </div><!-- Mapa -->
                <div>
                    <h4 class="text-lg font-heading font-bold mb-5 border-b border-secondary/30 pb-2 inline-block">
                        Lokacija
                    </h4>
                    <div class="rounded-lg overflow-hidden shadow-md border border-primary/20"><iframe frameborder="0"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2963.2233243672563!2d20.061916600000004!3d45.3759651!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475b222f1012938d%3A0x1340d7d064297a59!2z0J7QlNCRItCS0LXRmdC60L4g0J_QtdGC0YDQvtCy0LjRmyI!5e1!3m2!1ssr!2srs!4v1763286297872!5m2!1ssr!2srs"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" id="ixntun"
                            class="w-full h-44 md:h-52">
                        </iframe></div>
                </div>
            </div><!-- Donja linija sa SECO logom i copyright -->
            <div
                class="border-t border-primary/10 pt-6 mt-6 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center order-1 md:order-1"><img src="/assets/img/SECO-logo-640px-white.png"
                        alt="SECO Logo"
                        class="h-15 md:h-15 object-contain hover:scale-105 transition-transform duration-300"></div>
                <div class="text-xs opacity-80 md:w-3/5 order-2 md:order-2 text-center md:text-right">
                    <p class="mb-2">© 2025 Biblioteka "Veljko Petrović" . Sva prava zadržana.</p>
                    <div class="flex items-center justify-center md:justify-end gap-3 mt-3">
                        <p>Izradu ovog veb-sajta omogućila je Vlada Švajcarske. Objavljeni sadržaj ne predstavlja nužno
                            zvanični stav Vlade Švajcarske.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script>
        // Font size toggle functionality
        const btn = document.getElementById('increaseFontBtn');
        if (btn) {
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
        }

        // Search functionality
        const searchButton = document.getElementById('searchButton');
        const searchOverlay = document.getElementById('searchOverlay');
        const closeSearch = document.getElementById('closeSearch');
        const searchInput = searchOverlay ? searchOverlay.querySelector('input[name="q"]') : null;

        if (searchButton && searchOverlay) {
            searchButton.addEventListener('click', () => {
                searchOverlay.classList.add('active');
                if (searchInput) {
                    searchInput.focus();
                }
            });
        }

        if (closeSearch && searchOverlay) {
            closeSearch.addEventListener('click', () => {
                searchOverlay.classList.remove('active');
            });
        }

        // Close search overlay when clicking on the overlay background
        if (searchOverlay) {
            searchOverlay.addEventListener('click', (e) => {
                if (e.target === searchOverlay) {
                    searchOverlay.classList.remove('active');
                }
            });
        }

        // Close search overlay with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && searchOverlay) {
                searchOverlay.classList.remove('active');
            }
        });

        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuPanel = document.getElementById('mobileMenuPanel');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const closeMobileMenu = document.getElementById('closeMobileMenu');

        function openMobileMenu() {
            mobileMenu.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            setTimeout(() => {
                mobileMenuPanel.classList.remove('translate-x-full');
            }, 10);
        }

        function closeMobileMenuFn() {
            mobileMenuPanel.classList.add('translate-x-full');
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300);
        }

        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', openMobileMenu);
        }

        if (closeMobileMenu) {
            closeMobileMenu.addEventListener('click', closeMobileMenuFn);
        }

        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeMobileMenuFn);
        }

        // Handle mobile dropdowns
        const mobileDropdowns = document.querySelectorAll('.mobile-dropdown');
        mobileDropdowns.forEach(dropdown => {
            const button = dropdown.querySelector('button');
            const menu = dropdown.querySelector('div[id$="Menu"]');
            const icon = dropdown.querySelector('i[id$="Icon"]');

            if (button && menu && icon) {
                button.addEventListener('click', () => {
                    const isExpanded = menu.classList.contains('hidden');

                    // Close all other dropdowns
                    mobileDropdowns.forEach(otherDropdown => {
                        if (otherDropdown !== dropdown) {
                            const otherMenu = otherDropdown.querySelector('div[id$="Menu"]');
                            const otherIcon = otherDropdown.querySelector('i[id$="Icon"]');
                            if (otherMenu && !otherMenu.classList.contains('hidden')) {
                                otherMenu.classList.add('hidden');
                                otherIcon?.classList.remove('rotate-180');
                            }
                        }
                    });

                    // Toggle current dropdown
                    menu.classList.toggle('hidden');
                    icon.classList.toggle('rotate-180');
                });
            }
        });

        // Handle resize events to ensure proper menu state
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1713) { // 2xl breakpoint
                mobileMenu.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                mobileMenuPanel.classList.add('translate-x-full');
            }
        });

        // Events view button
        const eventsViewBtn = document.querySelector("#eventsView");
        if (eventsViewBtn) {
            eventsViewBtn.addEventListener('click', () => {
                window.location.href = "/aktivnosti/dogadjaji";
            });
        }

        // Header scroll effect
        const header = document.querySelector('header');
        if (header) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    header.classList.add('shadow-lg');
                } else {
                    header.classList.remove('shadow-lg');
                }
            });
        }

        // Nav link hover effect
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link) {
                link.addEventListener('mouseenter', () => {
                    link.classList.add('hover-effect');
                });
                link.addEventListener('mouseleave', () => {
                    link.classList.remove('hover-effect');
                });
            }
        });
    </script>
</body>

</html>
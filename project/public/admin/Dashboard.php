<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Uređivač Stranica</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366F1',
                        secondary: '#06B6D4',
                        accent: '#F59E0B',
                        success: '#10B981',
                        danger: '#EF4444',
                        dark: '#0F172A',
                        light: '#F8FAFC'
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.4s ease-out',
                        'bounce-gentle': 'bounceGentle 2s infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounceGentle {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .content-area {
            background: linear-gradient(135deg, #F1F5F9 0%, #E2E8F0 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .page-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .page-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            background: rgba(255, 255, 255, 0.95);
        }

        .stats-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.7) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
        }

        .editor-area {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .nav-item {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .nav-item:hover::before {
            left: 100%;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .nav-item.active {
            background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #64748B 0%, #475569 100%);
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
        }

        .input-field {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .input-field:focus {
            background: rgba(255, 255, 255, 0.95);
            border-color: #6366F1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .notification-badge {
            animation: pulse 2s infinite;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .content-area {
                margin-left: 0 !important;
            }
        }

        .floating-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(1px);
            animation: float 6s ease-in-out infinite;
            z-index: -1;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }
    </style>
</head>

<body class="bg-gray-50 font-sans overflow-x-hidden">
    <!-- Floating Background Orbs -->
    <div class="floating-orb w-72 h-72 bg-gradient-to-r from-purple-400 to-pink-400 opacity-10"
        style="top: 10%; right: 10%;"></div>
    <div class="floating-orb w-96 h-96 bg-gradient-to-r from-blue-400 to-cyan-400 opacity-10"
        style="bottom: 10%; left: 10%; animation-delay: -3s;"></div>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="sidebar text-white w-64 fixed min-h-screen z-10">
            <div class="p-6 border-b border-gray-700">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-cog mr-3 text-primary animate-pulse-slow"></i>
                    <span class="bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">Admin
                        Panel</span>
                </h1>
            </div>
            <nav class="mt-6">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="nav-item block py-4 px-6 rounded-r-full mr-4">
                            <i class="fas fa-tachometer-alt mr-3"></i> Kontrolna tabla
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-item active block py-4 px-6 rounded-r-full mr-4">
                            <i class="fas fa-file-alt mr-3"></i> Uređivač stranica
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-item block py-4 px-6 rounded-r-full mr-4">
                            <i class="fas fa-users mr-3"></i> Korisnici
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-item block py-4 px-6 rounded-r-full mr-4">
                            <i class="fas fa-chart-bar mr-3"></i> Analitika
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-item block py-4 px-6 rounded-r-full mr-4">
                            <i class="fas fa-cog mr-3"></i> Podešavanja
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="absolute bottom-0 w-full p-6 border-t border-gray-700">
                <div class="flex items-center glass-effect rounded-xl p-4">
                    <div
                        class="w-12 h-12 rounded-full bg-gradient-to-r from-primary to-purple-500 flex items-center justify-center animate-bounce-gentle">
                        <span class="font-bold text-white">AD</span>
                    </div>
                    <div class="ml-3">
                        <p class="font-medium text-white">Admin Korisnik</p>
                        <p class="text-sm text-gray-300">admin@example.com</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content-area ml-64 flex-1 min-h-screen">
            <!-- Top Bar -->
            <div class="glass-effect p-6 flex justify-between items-center sticky top-0 z-20">
                <div class="flex items-center">
                    <button id="menu-toggle" class="md:hidden text-gray-600 hover:text-primary transition-colors">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h2
                        class="text-2xl font-bold hidden md:inline bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                        Uređivač Stranica
                    </h2>
                </div>
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <i
                            class="fas fa-bell text-gray-600 text-xl hover:text-primary transition-colors cursor-pointer"></i>
                        <span
                            class="notification-badge absolute -top-2 -right-2 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">3</span>
                    </div>
                    <div class="relative">
                        <i
                            class="fas fa-envelope text-gray-600 text-xl hover:text-primary transition-colors cursor-pointer"></i>
                        <span
                            class="notification-badge absolute -top-2 -right-2 bg-gradient-to-r from-primary to-purple-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">5</span>
                    </div>
                    <div class="flex items-center space-x-3 glass-effect rounded-full px-4 py-2">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-gray-300 to-gray-400"></div>
                        <span class="font-medium">Admin</span>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="stats-card rounded-2xl shadow-xl p-6 animate-fade-in">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-gray-500 text-sm font-medium">Ukupno stranica</h3>
                                <p
                                    class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                                    24</p>
                            </div>
                            <div
                                class="w-14 h-14 rounded-2xl bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center shadow-lg">
                                <i class="fas fa-file text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-green-50 rounded-xl">
                            <p class="text-green-600 text-sm font-medium flex items-center">
                                <i class="fas fa-arrow-up mr-2"></i> 5 novih u poslednjih 7 dana
                            </p>
                        </div>
                    </div>

                    <div class="stats-card rounded-2xl shadow-xl p-6 animate-fade-in" style="animation-delay: 0.1s;">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-gray-500 text-sm font-medium">Aktivne stranice</h3>
                                <p
                                    class="text-3xl font-bold bg-gradient-to-r from-green-600 to-green-800 bg-clip-text text-transparent">
                                    18</p>
                            </div>
                            <div
                                class="w-14 h-14 rounded-2xl bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center shadow-lg">
                                <i class="fas fa-check-circle text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-red-50 rounded-xl">
                            <p class="text-red-600 text-sm font-medium flex items-center">
                                <i class="fas fa-arrow-down mr-2"></i> 2 istekla u poslednjih 7 dana
                            </p>
                        </div>
                    </div>

                    <div class="stats-card rounded-2xl shadow-xl p-6 animate-fade-in" style="animation-delay: 0.2s;">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-gray-500 text-sm font-medium">Prosečan pregled</h3>
                                <p
                                    class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-purple-800 bg-clip-text text-transparent">
                                    1.2K</p>
                            </div>
                            <div
                                class="w-14 h-14 rounded-2xl bg-gradient-to-r from-purple-400 to-purple-600 flex items-center justify-center shadow-lg">
                                <i class="fas fa-eye text-white text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 p-3 bg-green-50 rounded-xl">
                            <p class="text-green-600 text-sm font-medium flex items-center">
                                <i class="fas fa-arrow-up mr-2"></i> 12% u odnosu na prošli mesec
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Pages List and Editor -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Pages List -->
                    <div class="lg:col-span-1">
                        <div class="glass-effect rounded-2xl shadow-2xl p-6 animate-slide-up">
                            <div class="flex justify-between items-center mb-6">
                                <h3
                                    class="text-xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                                    Lista Stranica</h3>
                                <button class="btn-primary text-white px-6 py-3 rounded-xl font-medium">
                                    <i class="fas fa-plus mr-2"></i>Nova stranica
                                </button>
                            </div>

                            <div class="space-y-4 max-h-[600px] overflow-y-auto">
                                <!-- Page Cards -->
                                <div
                                    class="page-card rounded-xl p-6 cursor-pointer border-2 border-transparent hover:border-primary/30">
                                    <div class="flex justify-between items-start mb-3">
                                        <h4 class="font-bold text-gray-800">Početna Strana</h4>
                                        <span
                                            class="bg-gradient-to-r from-green-400 to-green-600 text-white text-xs px-3 py-1 rounded-full font-medium">Aktivna</span>
                                    </div>
                                    <p class="text-gray-500 text-sm mb-4 font-medium">/index</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-500 flex items-center">
                                            <i class="fas fa-eye mr-2 text-primary"></i> 2.4K pregleda
                                        </span>
                                        <span class="text-xs text-gray-400">12.06.2023.</span>
                                    </div>
                                </div>

                                <div
                                    class="page-card rounded-xl p-6 cursor-pointer border-2 border-transparent hover:border-primary/30">
                                    <div class="flex justify-between items-start mb-3">
                                        <h4 class="font-bold text-gray-800">O Nama</h4>
                                        <span
                                            class="bg-gradient-to-r from-green-400 to-green-600 text-white text-xs px-3 py-1 rounded-full font-medium">Aktivna</span>
                                    </div>
                                    <p class="text-gray-500 text-sm mb-4 font-medium">/o-nama</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-500 flex items-center">
                                            <i class="fas fa-eye mr-2 text-primary"></i> 1.1K pregleda
                                        </span>
                                        <span class="text-xs text-gray-400">05.05.2023.</span>
                                    </div>
                                </div>

                                <div
                                    class="page-card rounded-xl p-6 cursor-pointer border-2 border-transparent hover:border-primary/30">
                                    <div class="flex justify-between items-start mb-3">
                                        <h4 class="font-bold text-gray-800">Usluge</h4>
                                        <span
                                            class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs px-3 py-1 rounded-full font-medium">U
                                            izradi</span>
                                    </div>
                                    <p class="text-gray-500 text-sm mb-4 font-medium">/usluge</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-500 flex items-center">
                                            <i class="fas fa-eye mr-2 text-primary"></i> 540 pregleda
                                        </span>
                                        <span class="text-xs text-gray-400">28.04.2023.</span>
                                    </div>
                                </div>

                                <div
                                    class="page-card rounded-xl p-6 cursor-pointer border-2 border-transparent hover:border-primary/30">
                                    <div class="flex justify-between items-start mb-3">
                                        <h4 class="font-bold text-gray-800">Kontakt</h4>
                                        <span
                                            class="bg-gradient-to-r from-green-400 to-green-600 text-white text-xs px-3 py-1 rounded-full font-medium">Aktivna</span>
                                    </div>
                                    <p class="text-gray-500 text-sm mb-4 font-medium">/kontakt</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-500 flex items-center">
                                            <i class="fas fa-eye mr-2 text-primary"></i> 890 pregleda
                                        </span>
                                        <span class="text-xs text-gray-400">15.05.2023.</span>
                                    </div>
                                </div>

                                <div
                                    class="page-card rounded-xl p-6 cursor-pointer border-2 border-transparent hover:border-primary/30">
                                    <div class="flex justify-between items-start mb-3">
                                        <h4 class="font-bold text-gray-800">Blog</h4>
                                        <span
                                            class="bg-gradient-to-r from-red-400 to-red-600 text-white text-xs px-3 py-1 rounded-full font-medium">Neaktivna</span>
                                    </div>
                                    <p class="text-gray-500 text-sm mb-4 font-medium">/blog</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-500 flex items-center">
                                            <i class="fas fa-eye mr-2 text-primary"></i> 320 pregleda
                                        </span>
                                        <span class="text-xs text-gray-400">10.04.2023.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Editor Area -->
                    <div class="lg:col-span-2">
                        <div class="editor-area rounded-2xl shadow-2xl p-8 animate-slide-up"
                            style="animation-delay: 0.2s;">
                            <div class="flex justify-between items-center mb-8">
                                <h3
                                    class="text-xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">
                                    Uređivač Stranica</h3>
                                <div class="flex space-x-3">
                                    <button class="btn-secondary text-white px-6 py-3 rounded-xl font-medium">
                                        <i class="fas fa-eye mr-2"></i>Pregled
                                    </button>
                                    <button class="btn-primary text-white px-6 py-3 rounded-xl font-medium">
                                        <i class="fas fa-save mr-2"></i>Sačuvaj
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div>
                                    <label class="block text-gray-700 font-semibold mb-3">Naslov Stranice</label>
                                    <input type="text" value="Početna Strana"
                                        class="input-field w-full p-4 rounded-xl font-medium">
                                </div>

                                <div>
                                    <label class="block text-gray-700 font-semibold mb-3">URL Adresa</label>
                                    <div class="flex rounded-xl overflow-hidden">
                                        <span
                                            class="flex items-center bg-gradient-to-r from-gray-100 to-gray-200 border-2 border-r-0 border-gray-300 px-6 font-medium text-gray-600">https://sajt.com</span>
                                        <input type="text" value="/index"
                                            class="input-field flex-1 p-4 border-l-0 rounded-l-none font-medium">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-gray-700 font-semibold mb-4">Status</label>
                                    <div class="flex space-x-6">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" name="status" checked class="h-5 w-5 text-primary">
                                            <span class="ml-3 font-medium">Aktivna</span>
                                        </label>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" name="status" class="h-5 w-5 text-primary">
                                            <span class="ml-3 font-medium">Neaktivna</span>
                                        </label>
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="radio" name="status" class="h-5 w-5 text-primary">
                                            <span class="ml-3 font-medium">U izradi</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <button onclick="window.location.href='admin.php?page=1'"
                                        class="btn-primary text-white px-8 py-4 rounded-xl font-medium text-lg">
                                        <i class="fas fa-brush mr-3"></i>Stilizuj Stranicu
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Enhanced page card interactions
        const pageCards = document.querySelectorAll('.page-card');
        pageCards.forEach((card, index) => {
            card.addEventListener('click', function () {
                // Remove active state from all cards
                pageCards.forEach(c => {
                    c.classList.remove('ring-4', 'ring-primary/30', 'border-primary/50');
                    c.style.transform = '';
                });

                // Add active state to clicked card
                this.classList.add('ring-4', 'ring-primary/30', 'border-primary/50');
                this.style.transform = 'scale(1.02)';

                // Update editor with selected page data
                const title = this.querySelector('h4').textContent;
                document.querySelector('input[type="text"]').value = title;

                // Add subtle animation to editor
                const editor = document.querySelector('.editor-area');
                editor.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    editor.style.transform = 'scale(1)';
                }, 150);
            });

            // Add staggered entrance animation
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('animate-slide-up');
        });

        // Set first card as active by default
        if (pageCards.length > 0) {
            pageCards[0].classList.add('ring-4', 'ring-primary/30', 'border-primary/50');
            pageCards[0].style.transform = 'scale(1.02)';
        }

        // Add loading animation to buttons
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('click', function () {
                if (!this.classList.contains('loading')) {
                    this.classList.add('loading');
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Učitavanje...';

                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.classList.remove('loading');
                    }, 2000);
                }
            });
        });

        // Add focus animations to inputs
        document.querySelectorAll('.input-field').forEach(input => {
            input.addEventListener('focus', function () {
                this.style.transform = 'scale(1.02)';
            });

            input.addEventListener('blur', function () {
                this.style.transform = 'scale(1)';
            });
        });
    </script>
</body>

</html>
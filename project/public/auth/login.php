<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RELOF3 | Prijava</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                        },
                        secondary: {
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                        }
                    },
                    animation: {
                        'float': 'float 8s infinite ease-in-out',
                        'float-delayed': 'float 8s infinite ease-in-out 2s',
                        'float-slow': 'float 12s infinite ease-in-out 4s',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'fade-in': 'fadeIn 0.8s ease-out',
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                        'slide-in': 'slideIn 0.6s ease-out',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'shake': 'shake 0.5s ease-in-out',
                        'modal-in': 'modalIn 0.3s ease-out',
                        'modal-out': 'modalOut 0.3s ease-in',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0) translateX(0) rotate(0deg)' },
                            '25%': { transform: 'translateY(-30px) translateX(20px) rotate(2deg)' },
                            '50%': { transform: 'translateY(-10px) translateX(-25px) rotate(-1deg)' },
                            '75%': { transform: 'translateY(-25px) translateX(15px) rotate(1deg)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideIn: {
                            '0%': { opacity: '0', transform: 'translateX(-20px)' },
                            '100%': { opacity: '1', transform: 'translateX(0)' },
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 20px rgba(14, 165, 233, 0.3)' },
                            '100%': { boxShadow: '0 0 40px rgba(139, 92, 246, 0.4)' },
                        },
                        shake: {
                            '0%, 100%': { transform: 'translateX(0)' },
                            '10%, 30%, 50%, 70%, 90%': { transform: 'translateX(-3px)' },
                            '20%, 40%, 60%, 80%': { transform: 'translateX(3px)' },
                        },
                        modalIn: {
                            '0%': { opacity: '0', transform: 'scale(0.95) translateY(-10px)' },
                            '100%': { opacity: '1', transform: 'scale(1) translateY(0)' },
                        },
                        modalOut: {
                            '0%': { opacity: '1', transform: 'scale(1) translateY(0)' },
                            '100%': { opacity: '0', transform: 'scale(0.95) translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-glow:focus {
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1), 0 0 20px rgba(14, 165, 233, 0.3);
        }

        .btn-glow {
            background: linear-gradient(135deg, #0ea5e9, #8b5cf6);
            position: relative;
            overflow: hidden;
        }

        .btn-glow::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, #38bdf8, #a78bfa, #0ea5e9, #8b5cf6);
            z-index: -1;
            border-radius: inherit;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .btn-glow:hover::before {
            opacity: 1;
        }

        .floating-shape {
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.1), rgba(139, 92, 246, 0.1));
            border-radius: 50%;
            filter: blur(1px);
        }

        @media (max-width: 640px) {
            .floating-shape {
                opacity: 0.7;
            }
        }

        .form-gradient {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.25), rgba(255, 255, 255, 0.1));
            backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .icon-gradient {
            background: linear-gradient(135deg, #0ea5e9, #8b5cf6);
        }

        .alert-backdrop {
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(8px);
        }

        .alert-gradient {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.95), rgba(220, 38, 38, 0.95));
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-blue-50 via-indigo-100 to-purple-100 min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 overflow-hidden relative">

    <!-- Enhanced Floating Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Large floating shapes -->
        <div
            class="floating-shape absolute w-64 h-64 sm:w-80 sm:h-80 lg:w-96 lg:h-96 animate-float top-10 left-5 sm:top-20 sm:left-10">
        </div>
        <div
            class="floating-shape absolute w-48 h-48 sm:w-64 sm:h-64 lg:w-80 lg:h-80 animate-float-delayed top-32 right-5 sm:top-40 sm:right-10">
        </div>
        <div
            class="floating-shape absolute w-56 h-56 sm:w-72 sm:h-72 lg:w-88 lg:h-88 animate-float-slow bottom-10 left-10 sm:bottom-20 sm:left-20">
        </div>

        <!-- Small accent shapes -->
        <div
            class="absolute w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-r from-primary-400/20 to-secondary-400/20 rounded-full animate-pulse-slow top-1/4 right-1/3">
        </div>
        <div
            class="absolute w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-r from-secondary-400/15 to-primary-400/15 rounded-full animate-pulse-slow bottom-1/3 right-1/4">
        </div>

        <!-- Gradient overlays -->
        <div class="absolute inset-0 bg-gradient-to-br from-transparent via-white/5 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-tl from-primary-500/5 via-transparent to-secondary-500/5"></div>
    </div>

    <!-- Modern Alert Modal -->
    <div id="alertModal" class="fixed inset-0 z-50 alert-backdrop hidden items-center justify-center p-4">
        <div
            class="alert-gradient rounded-2xl sm:rounded-3xl shadow-2xl p-6 sm:p-8 max-w-sm w-full mx-4 animate-modal-in">
            <div class="flex items-center justify-center mb-4">
                <div
                    class="w-12 h-12 sm:w-16 sm:h-16 bg-white/20 rounded-full flex items-center justify-center animate-pulse">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.864-.833-2.634 0L4.168 15.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-lg sm:text-xl font-bold text-white text-center mb-2">Greška prilikom prijave</h3>
            <p class="text-white/90 text-center mb-6 text-sm sm:text-base">Neispravna šifra ili korisničko ime</p>
            <button onclick="closeAlert()"
                class="w-full bg-white/20 hover:bg-white/30 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 border border-white/30 hover:border-white/50 focus:outline-none focus:ring-2 focus:ring-white/50">
                U redu
            </button>
        </div>
    </div>

    <!-- Main Container -->
    <div class="w-full max-w-md sm:max-w-lg lg:max-w-xl xl:max-w-2xl z-10 relative">

        <!-- Header Section -->
        <div class="text-center mb-8 sm:mb-12 animate-fade-in-up">
            <div
                class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 icon-gradient rounded-2xl sm:rounded-3xl mb-4 sm:mb-6 shadow-2xl animate-glow">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 text-white" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                </svg>
            </div>
            <h1
                class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-secondary-600 mb-2 sm:mb-3">
                Kontrolni Panel
            </h1>
            <p
                class="text-sm sm:text-base lg:text-lg text-gray-700 max-w-xs sm:max-w-md lg:max-w-lg mx-auto leading-relaxed">
                Unesite svoje podatke kako biste pristupili svom nalogu
            </p>
        </div>

        <!-- Enhanced Login Card -->
        <div id="loginCard"
            class="form-gradient rounded-2xl sm:rounded-3xl lg:rounded-[2rem] shadow-2xl p-6 sm:p-8 lg:p-10 xl:p-12 animate-slide-in">
            <form class="space-y-6 sm:space-y-7 lg:space-y-8" onsubmit="handleLogin(event)">

                <!-- Username Field -->
                <div class="animate-fade-in-up" style="animation-delay: 0.2s;">
                    <label for="username"
                        class="block text-sm sm:text-base lg:text-lg font-semibold text-gray-800 mb-2 sm:mb-3 flex items-center">
                        <div
                            class="w-5 h-5 sm:w-6 sm:h-6 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full mr-2 sm:mr-3 flex items-center justify-center">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        Korisničko ime
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-primary-400 group-focus-within:text-primary-600 transition-colors duration-200"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input id="username" name="username" type="text" required
                            class="input-glow block w-full pl-10 sm:pl-12 lg:pl-14 pr-3 sm:pr-4 py-3 sm:py-4 lg:py-5 rounded-xl sm:rounded-2xl text-gray-800 placeholder-gray-500 focus:outline-none text-sm sm:text-base lg:text-lg transition-all duration-300 bg-white/80 border border-white/50 hover:border-primary-300 hover:bg-white/90 focus:border-primary-500 focus:bg-white/95"
                            placeholder="Unesite korisničko ime">
                    </div>
                </div>

                <!-- Password Field -->
                <div class="animate-fade-in-up" style="animation-delay: 0.4s;">
                    <label for="password"
                        class="block text-sm sm:text-base lg:text-lg font-semibold text-gray-800 mb-2 sm:mb-3 flex items-center">
                        <div
                            class="w-5 h-5 sm:w-6 sm:h-6 bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full mr-2 sm:mr-3 flex items-center justify-center">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        Lozinka
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-primary-400 group-focus-within:text-primary-600 transition-colors duration-200"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" name="password" type="password" required
                            class="input-glow block w-full pl-10 sm:pl-12 lg:pl-14 pr-10 sm:pr-12 lg:pr-14 py-3 sm:py-4 lg:py-5 rounded-xl sm:rounded-2xl text-gray-800 placeholder-gray-500 focus:outline-none text-sm sm:text-base lg:text-lg transition-all duration-300 bg-white/80 border border-white/50 hover:border-primary-300 hover:bg-white/90 focus:border-primary-500 focus:bg-white/95"
                            placeholder="Unesite lozinku">
                        <button type="button" onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 pr-3 sm:pr-4 flex items-center text-gray-400 hover:text-primary-600 transition-all duration-200 hover:scale-110">
                            <svg id="eye-icon" class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Enhanced Login Button -->
                <div class="animate-fade-in-up" style="animation-delay: 0.6s;">
                    <button type="submit"
                        class="btn-glow w-full text-white font-bold py-3 sm:py-4 lg:py-5 px-6 rounded-xl sm:rounded-2xl text-sm sm:text-base lg:text-lg transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-primary-200 shadow-2xl hover:shadow-3xl relative overflow-hidden group">
                        <span class="relative z-10">Prijavite se</span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-primary-600 to-secondary-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
            }
        }

        function showAlert() {
            const modal = document.getElementById('alertModal');
            const loginCard = document.getElementById('loginCard');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            loginCard.classList.add('animate-shake');

            // Remove shake animation after it completes
            setTimeout(() => {
                loginCard.classList.remove('animate-shake');
            }, 500);
        }

        function closeAlert() {
            const modal = document.getElementById('alertModal');
            const alertContent = modal.querySelector('.alert-gradient');

            alertContent.classList.remove('animate-modal-in');
            alertContent.classList.add('animate-modal-out');

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                alertContent.classList.remove('animate-modal-out');
                alertContent.classList.add('animate-modal-in');
            }, 300);
        }
        function handleLogin(event) {
            event.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const btn = event.target.querySelector('button[type="submit"]');

            if (username && password) {
                btn.innerHTML = '<span class="relative z-10">Prijavljivanje...</span>';
                btn.disabled = true;

                fetch('/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ username: username, password: password })
                })
                    .then(response => response.text())  // Read raw response as text first
                    .then(text => {
                        console.log('Raw response:', text);  // Log raw response string

                        // Now parse JSON manually
                        const data = JSON.parse(text);

                        if (data.success) {
                            window.location = "/kontrolna-tabla";
                        } else {
                            showAlert();
                        }
                    })
                    .catch(error => {
                        console.error('Greška prilikom zahteva:', error);
                        showAlert();
                    })
                    .finally(() => {
                        btn.innerHTML = '<span class="relative z-10">Prijavite se</span>';
                        btn.disabled = false;
                    });

            } else {
                showAlert();
            }
        }


        // Close modal when clicking outside of it
        document.getElementById('alertModal').addEventListener('click', function (event) {
            if (event.target === this) {
                closeAlert();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeAlert();
            }
        });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IBK CMS Setup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'pulse-slow': 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' }
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
    <!-- Background Pattern -->

    <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>

    <!-- Main Container -->
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <!-- Floating Elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-blue-200 rounded-full blur-xl opacity-30 animate-pulse-slow">
        </div>
        <div class="absolute bottom-10 right-10 w-32 h-32 bg-purple-200 rounded-full blur-xl opacity-30 animate-pulse-slow"
            style="animation-delay: 1s;"></div>
        <div class="absolute top-1/3 right-1/4 w-16 h-16 bg-indigo-200 rounded-full blur-xl opacity-20 animate-pulse-slow"
            style="animation-delay: 2s;"></div>

        <!-- Main Card -->
        <div
            class="bg-white/80 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 p-8 md:p-12 max-w-2xl w-full text-center animate-fade-in">
            <!-- Logo/Icon -->
            <div class="mb-8 animate-slide-up">
                <div
                    class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl shadow-lg mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                        </path>
                    </svg>
                </div>
                <h1
                    class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-700 bg-clip-text text-transparent">
                    IBK CMS Setup
                </h1>
            </div>

            <!-- Status Message -->
            <div class="mb-8 p-6 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl animate-slide-up"
                style="animation-delay: 0.2s;">
                <div class="flex items-center justify-center mb-4">
                    <span class="text-4xl mr-3">📊</span>
                    <h2 class="text-2xl font-bold text-green-800">ZAKLJUČAK:</h2>
                </div>
                <p class="text-lg text-green-700 mb-3">
                    Stranica je <span class="font-bold text-green-800">dobro podešena</span> na server
                </p>
                <div class="flex items-center justify-center">
                    <span class="text-2xl mr-3">🎯</span>
                    <p class="text-lg text-green-700">
                        Potrebna je instalacija <span class="font-bold text-green-800">IBK CMS template</span>
                    </p>
                </div>
            </div>

            <!-- Redirect Message -->
            <div class="mb-8 animate-slide-up" style="animation-delay: 0.4s;">
                <p class="text-gray-600 text-lg mb-4">
                    Bićete automatski preusmereni na Build Wizard...
                </p>

                <!-- Progress Bar -->
                <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-2 rounded-full animate-pulse"
                        style="width: 0%; animation: progress 3s ease-in-out forwards;"></div>
                </div>

                <!-- Countdown -->
                <div class="text-3xl font-bold text-indigo-600" id="countdown">3</div>
            </div>

            <!-- Manual Button -->
            <div class="animate-slide-up" style="animation-delay: 0.6s;">
                <button onclick="redirect()"
                    class="group relative px-8 py-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-out">
                    <span class="relative z-10 flex items-center">
                        Nastavi odmah
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </span>
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                </button>
            </div>
        </div>
    </div>

    <style>
        @keyframes progress {
            from {
                width: 0%;
            }

            to {
                width: 100%;
            }
        }

        .bg-grid-pattern {
            background-image:
                linear-gradient(rgba(99, 102, 241, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99, 102, 241, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }

        @media (max-width: 640px) {
            .bg-grid-pattern {
                background-size: 15px 15px;
            }
        }
    </style>

    <script>
        let countdown = 3;
        const countdownElement = document.getElementById('countdown');

        function updateCountdown() {
            countdownElement.textContent = countdown;
            countdown--;

            if (countdown < 0) {
                redirect();
            } else {
                setTimeout(updateCountdown, 1000);
            }
        }

        function redirect() {
            window.location.href = '/buildingWizard';
        }

        // Start countdown
        setTimeout(updateCountdown, 1000);
    </script>
</body>

</html>
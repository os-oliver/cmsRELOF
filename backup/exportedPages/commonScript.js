// Mobile menu functionality
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuPanel = document.getElementById('mobileMenuPanel');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const hamburger = document.getElementById('hamburger');
        const closeMobileMenu = document.getElementById('closeMobileMenu');
        const mobileAboutToggle = document.getElementById('mobileAboutToggle');
        const mobileAboutMenu = document.getElementById('mobileAboutMenu');
        const mobileAboutIcon = document.getElementById('mobileAboutIcon');

        function toggleMobileMenu(show) {
            if (!mobileMenu || !mobileMenuPanel) return;
            mobileMenu.classList.toggle('hidden', !show);
            if (show) {
                setTimeout(() => {
                    mobileMenuPanel.style.transform = 'translateX(0)';
                }, 100);
            } else {
                mobileMenuPanel.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
            }
        }

        function toggleMobileAboutMenu() {
            if (!mobileAboutMenu || !mobileAboutIcon) return;
            const isHidden = mobileAboutMenu.classList.contains('hidden');
            mobileAboutMenu.classList.toggle('hidden');
            mobileAboutIcon.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0)';
        }

        hamburger?.addEventListener('click', () => toggleMobileMenu(true));
        closeMobileMenu?.addEventListener('click', () => toggleMobileMenu(false));
        mobileMenuOverlay?.addEventListener('click', () => toggleMobileMenu(false));
        mobileAboutToggle?.addEventListener('click', toggleMobileAboutMenu);

        // Slider functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slider-item') || [];
        const indicators = document.querySelectorAll('.slider-indicator') || [];
        const totalSlides = slides.length || 0;
        let slideInterval;

        function showSlide(index) {
            if (!totalSlides) return;
            currentSlide = index;
            if (currentSlide >= totalSlides) currentSlide = 0;
            if (currentSlide < 0) currentSlide = totalSlides - 1;

            const slider = document.getElementById('slider');
            if (slider) slider.style.transform = `translateX(-${currentSlide * 100}%)`;

            indicators.forEach((indicator, i) => {
                indicator.classList.toggle('active', i === currentSlide);
            });
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
            resetSlideInterval();
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
            resetSlideInterval();
        }

        function goToSlide(index) {
            showSlide(index);
            resetSlideInterval();
        }

        function startSlideInterval() {
            slideInterval = setInterval(nextSlide, 5000);
        }

        function resetSlideInterval() {
            clearInterval(slideInterval);
            startSlideInterval();
        }

        // Initialize slider
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');
        const indicator0 = document.getElementById('indicator0');
        const indicator1 = document.getElementById('indicator1');
        const indicator2 = document.getElementById('indicator2');

        prevButton?.addEventListener('click', prevSlide);
        nextButton?.addEventListener('click', nextSlide);
        indicator0?.addEventListener('click', () => goToSlide(0));
        indicator1?.addEventListener('click', () => goToSlide(1));
        indicator2?.addEventListener('click', () => goToSlide(2));

        // Start auto-slide
        if (totalSlides > 1) {
            startSlideInterval();
        }

        // Smooth scrolling
        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        // Scroll to top button
        window.addEventListener('scroll', () => {
            const scrollTopBtn = document.getElementById('scrollTopBtn');
            if (scrollTopBtn) {
                if (window.pageYOffset > 300) {
                    scrollTopBtn.style.opacity = '1';
                    scrollTopBtn.style.pointerEvents = 'auto';
                } else {
                    scrollTopBtn.style.opacity = '0';
                    scrollTopBtn.style.pointerEvents = 'none';
                }
            }
        });

        // Search functionality
        const searchButton = document.getElementById('searchButton');
        const searchInputContainer = document.getElementById('searchInputContainer');
        const closeSearch = document.getElementById('closeSearch');

        searchButton?.addEventListener('click', () => {
            searchInputContainer.classList.toggle('hidden');
            setTimeout(() => {
                searchInputContainer.classList.toggle('opacity-0');
            }, 10);
        });

        closeSearch?.addEventListener('click', () => {
            searchInputContainer.classList.toggle('opacity-0');
            setTimeout(() => {
                searchInputContainer.classList.toggle('hidden');
            }, 300);
        });

        // Language switcher
        const languageButtons = document.querySelectorAll('.language-btn') || [];
        let currentLang = 'sr-Latn';

        languageButtons.forEach(button => {
            button.addEventListener('click', function () {
                const lang = this.dataset.lang;
                if (lang === currentLang) return;

                languageButtons.forEach(btn => {
                    btn.classList.remove('bg-primary/10', 'text-primary');
                });

                this.classList.add('bg-primary/10', 'text-primary');
                currentLang = lang;
            });
        });

        const defaultLangButton = document.querySelector(`[data-lang="${currentLang}"]`);
        defaultLangButton?.classList.add('bg-primary/10', 'text-primary');

        // Animation on scroll
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) entry.target.classList.add('animate-fade-in');
                });
            }, { threshold: 0.1, rootMargin: '0px' });
            document.querySelectorAll('.card-hover').forEach(card => observer.observe(card));
        }

        console.log('%c🏛️ Istorijski Arhiv', 'font-size: 24px; font-weight: bold; color: #1e40af;');
        console.log('%cDobrodošli u konzolu našeg arhiva!', 'font-size: 16px; color: #666;');
    


        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e40af',
                        primary_hover: '#1e3a8a',
                        secondary: '#64748b',
                        secondary_hover: '#475569',
                        accent: '#f59e0b',
                        accent_hover: '#d97706',
                        success: '#10b981',
                        warning: '#f59e0b',
                        error: '#ef4444',
                        info: '#3b82f6',
                        primary_text: '#1e293b',
                        secondary_text: '#64748b',
                        background: '#f8fafc',
                        secondary_background: '#e2e8f0',
                        surface: '#ffffff'
                    },
                    fontFamily: {
                        heading: ['Playfair Display', 'serif'],
                        heading2: ['Playfair Display', 'serif'],
                        body: ['Inter', 'sans-serif']
                    }
                }
            }
        }
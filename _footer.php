    <footer class="bg-[#00071c] text-center p-6 border-t border-gray-800">
        <div class="flex justify-center space-x-3 mb-1">
            <div class="flex justify-center space-x-1 mb-1">
                <a href="https://www.bulsu.edu.ph" target="_blank" rel="noopener noreferrer"><img src="./Logos/BulSU.png" alt="Bulacan State University Logo" class="h-10"></a>
                <a href="https://www.facebook.com/osobulsu" target="_blank" rel="noopener noreferrer"><img src="./Logos/OSOA.png" alt="Bulacan State University OSOA Logo" class="h-10 w-10"></a>
            </div>
            <div class="border-l border-gray-300 border-opacity-50 mx-2 h-10"></div>
            <div class="flex justify-center space-x-1 mb-1">
                <a href="https://yorpnyc.org.ph/yorphubv1/Organization/OrgDetails/YO-11965-090325" target="_blank" rel="noopener noreferrer"><img src="./Logos/yorplogo.png" alt="YORP Seal" class="h-10 w-10"></a>
            </div>
        </div>
        <p class="text-gray-500 text-sm">&copy; 2025 BulSU Microsoft Student Community. All rights reserved.</p>
        <div class="flex justify-center space-x-4 mt-2">
            <a href="https://www.facebook.com/bulsu.officialmsc" target="_blank" class="text-gray-400 hover:text-[#b9da05] transition-colors duration-300"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/bulsumsc/" target="_blank" class="text-gray-400 hover:text-[#b9da05] transition-colors duration-300"><i class="fab fa-instagram"></i></a>
            <a href="https://www.threads.com/@bulsumsc" target="_blank" class="text-gray-400 hover:text-[#b9da05] transition-colors duration-300"><i class="fab fa-threads"></i></a>
            <a href="https://www.tiktok.com/@bulsumsc" target="_blank" class="text-gray-400 hover:text-[#b9da05] transition-colors duration-300"><i class="fab fa-tiktok"></i></a>
            <a href="https://www.linkedin.com/company/bulsumsc/" target="_blank" class="text-gray-400 hover:text-[#b9da05] transition-colors duration-300"><i class="fab fa-linkedin"></i></a>
            <a href="https://www.github.com/bulsumsc" target="_blank" class="text-gray-400 hover:text-[#b9da05] transition-colors duration-300"><i class="fab fa-github"></i></a>
        </div>
    </footer>

    <div id="status-modal" class="modal-backdrop hidden">
        <div class="status-modal-content">
            <button id="modal-close-button" class="modal-close-button">
                <i class="fas fa-times"></i>
            </button>
            <div class="flex flex-col items-center">
                <div class="text-[#b9da05] mb-4">
                    <i class="fas fa-info-circle text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Login Feature</h3>
                <p id="modal-message" class="text-gray-300 text-lg">Available soon</p>
            </div>
        </div>
    </div>

    <script>
        // Smooth scrolling function
        function scrollToSection(id) {
            const section = document.getElementById(id);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
                // Close mobile menu after click if it's open
                const mobileMenu = document.getElementById('mobile-menu');
                const mobileMenuButton = document.getElementById('mobile-menu-button');
                const mobileMenuIcon = document.getElementById('mobile-menu-icon');
                if (mobileMenu.classList.contains('active')) {
                    mobileMenu.classList.remove('active');
                    mobileMenuButton.classList.remove('active');
                    mobileMenuIcon.classList.remove('fa-xmark');
                    mobileMenuIcon.classList.add('fa-bars');
                    document.body.style.overflow = ''; // Ibalik ang scroll
                }
            }
        }

        // Mobile Menu Toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuIcon = document.getElementById('mobile-menu-icon');
        
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            mobileMenuButton.classList.toggle('active');
            if (mobileMenu.classList.contains('active')) {
                mobileMenuIcon.classList.remove('fa-bars');
                mobileMenuIcon.classList.add('fa-xmark');
                // Lock the body scroll when the menu is open
                document.body.style.overflow = 'hidden';
            } else {
                mobileMenuIcon.classList.remove('fa-xmark');
                mobileMenuIcon.classList.add('fa-bars');
                document.body.style.overflow = '';
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            // --- Scroll animations ---
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            // Added #vision-mission to the fade-in-up selector
            document.querySelectorAll('.fade-in-up').forEach(element => {
                observer.observe(element);
            });

            // --- Hero section content and ad modal logic ---
            const heroTextContainer = document.getElementById('hero-text-container');
            const heroImageContainer = document.getElementById('hero-image-container');
            const heroTagline = document.getElementById('hero-tagline');
            const adModalLandscape = document.getElementById('ad-modal-landscape');
            const adModalPortrait = document.getElementById('ad-modal-portrait');
            const adModalCloseButtons = document.querySelectorAll('.ad-modal-close-button');
            let hasShownAd = false; // Flag to track if the ad has been shown

            // Function to show the correct ad modal based on orientation
            function showAdModal() {
                // Check if both modals exist before trying to show them
                if (adModalLandscape && adModalPortrait && !hasShownAd) {
                    if (window.innerHeight > window.innerWidth) {
                        // Portrait mode
                        adModalPortrait.style.display = 'flex';
                    } else {
                        // Landscape mode
                        adModalLandscape.style.display = 'flex';
                    }
                    document.body.style.overflow = 'hidden';
                    hasShownAd = true; // Set the flag to true
                    return true; // Return true if a modal was shown
                }
                return false; // Return false if no modals were found or ad has already been shown
            }

            // Function to start the hero animation
            function startHeroAnimation() {
                // I-reset muna ang state ng animation para ma-trigger ulit ito
                if (heroTagline) {
                    heroTagline.classList.remove('shine-text');
                    // I-reflow ang DOM para i-restart ang animation
                    void heroTagline.offsetWidth;
                    heroTextContainer.classList.remove('hero-text-hidden', 'opacity-0');
                    heroTextContainer.classList.add('hero-text-fade-in');
                    heroTagline.classList.add('shine-text'); // I-apply muli ang animation class

                    setTimeout(() => {
                        heroTextContainer.classList.add('opacity-0', 'transition-opacity', 'duration-1000');
                        setTimeout(() => {
                            heroTextContainer.style.display = 'none';
                            heroImageContainer.classList.remove('opacity-0');
                        }, 1000);
                    }, 4000); // Tumaas ang delay para sa shine animation
                }
            }

            // Function to hide all ad modals and trigger the hero animation
            function hideAdModal() {
                if (adModalLandscape) adModalLandscape.style.display = 'none';
                if (adModalPortrait) adModalPortrait.style.display = 'none';
                document.body.style.overflow = ''; // Restores scrolling
                startHeroAnimation(); // I-call ang animation function dito
            }

            // Event listeners to close the modals
            adModalCloseButtons.forEach(button => {
                button.addEventListener('click', hideAdModal);
            });

            if (adModalLandscape) {
                adModalLandscape.addEventListener('click', (e) => {
                    if (e.target.id === 'ad-modal-landscape') {
                        hideAdModal();
                    }
                });
            }

            if (adModalPortrait) {
                adModalPortrait.addEventListener('click', (e) => {
                    if (e.target.id === 'ad-modal-portrait') {
                        hideAdModal();
                    }
                });
            }
            
            // Check if the ad modal was shown. If not, start the hero animation immediately.
            const adWasShown = showAdModal();
            if (!adWasShown && heroImageContainer) {
                startHeroAnimation();
            }

            // --- Custom Modal Functionality for "Login" button ---
            const loginButtonDesktop = document.getElementById('login-button-desktop');
            const loginButtonMobile = document.getElementById('login-button-mobile');
            const modal = document.getElementById('status-modal');
            const modalCloseButton = document.getElementById('modal-close-button');
            const modalMessage = document.getElementById('modal-message');

            // I'll change the behavior of the login buttons
            if (loginButtonDesktop) {
                loginButtonDesktop.addEventListener('click', () => {
                    window.location.href = 'login.html';
                });
            }
            if (loginButtonMobile) {
                loginButtonMobile.addEventListener('click', () => {
                    window.location.href = 'login.html';
                });
            }

            // This is no longer needed since the buttons redirect instead of showing a modal
            // modalCloseButton.addEventListener('click', hideModal);
            // modal.addEventListener('click', (e) => {
            //     if (e.target === modal) {
            //         hideModal();
            //     }
            // });

            // --- New: Disable right-click specifically on images ---
            // This event listener checks if the right-clicked element is an image and prevents the default context menu.
            document.addEventListener('contextmenu', function(e) {
                if (e.target.nodeName === 'IMG') {
                    e.preventDefault();
                }
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.getElementById('main-header');
            const heroSection = document.getElementById('hero');
            if (heroSection) {
                if (window.scrollY > heroSection.offsetHeight / 2) {
                    header.classList.add('header-scrolled');
                } else {
                    header.classList.remove('header-scrolled');
                }
            } else {
                // Fallback for pages without a hero section
                if (window.scrollY > 50) {
                    header.classList.add('header-scrolled');
                } else {
                    header.classList.remove('header-scrolled');
                }
            }
        });
    </script>
    <script src="js/tabs.js"></script>
    <script src="js/calendar.js"></script>
    <script src="js/univ_calendar.js"></script>
</body>
</html>

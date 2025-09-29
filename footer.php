<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Asrepoya
 */

?>

    <!-- Footer Section -->
    <footer class="footer-section bg-navy text-white mt-5">
        <div class="container-fluid bg-navy">
            <div class="container">
                <!-- Logo and Social Media Row -->
                <div class="social-row py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Logo (Right) -->
                        <div class="footer-logo-section">
                            <a href="<?php echo home_url(); ?>">
                                <?php if (get_custom_logo()): ?>
                                    <?php echo get_custom_logo(); ?>
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo-asre-poya.svg" alt="<?php echo get_bloginfo('name'); ?>" class="me-2">
                                <?php endif; ?>
                            </a> 
                        </div>

                        <!-- Social Media (Left) -->
                        <div class="d-flex gap-4">
                            <a href="#" class="social-icon" aria-label="تلگرام">
                                <i class="fab fa-telegram"></i>
                            </a>
                            <a href="#" class="social-icon" aria-label="ایکس">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-icon" aria-label="واتساپ">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="social-icon" aria-label="اینستاگرام">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Horizontal Divider -->
                <div class="footer-divider"></div>

                <!-- Three Columns Section -->
                <div class="footer-content py-5">
                    <div class="row g-4 align-items-start">
                        <!-- About Column (Right) -->
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-about">
                                <h4 class="footer-title">درباره اندیشکده حکمرانی عصر پویا</h4>
                                <p class="footer-description">
                                    اندیشکده حکمرانی عصر پویا، نهادی مستقل با ماهیت غیرانتفاعی و غیرتجاری است که با
                                    رویکردی تحلیلی، پژوهشی،تحلیلی است که با رویکردی نقادانه به تحلیل سیاست‌های اقتصادی،
                                    نهادهای بین‌المللی، ساختارهای قدرت و تحولات اقتصادی-اجتماعی در ایران و جهان
                                    می‌پردازد.
                                </p>
                            </div>
                        </div>

                        <!-- Contact Column (Middle) -->
                        <div class="col-lg-4 col-md-6 footer-contact-col">
                            <div class="footer-contact">
                                <h4 class="footer-title">
                                    <i class="fas fa-phone footer-icon"></i>
                                    اطلاعات تماس
                                </h4>
                                <div class="contact-item">
                                    <i class="fas fa-phone contact-icon"></i>
                                    <div class="contact-text">
                                        <div>0901-0123345</div>
                                        <div>0901-0123345</div>
                                    </div>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-envelope contact-icon"></i>
                                    <div class="contact-text">
                                        <a href="mailto:info@examplemail.com"
                                            class="contact-email">info@examplemail.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Address Column (Left) -->
                        <div class="col-lg-4 col-md-12 footer-address-col">
                            <div class="footer-address">
                                <h4 class="footer-title">
                                    <i class="fas fa-map-marker-alt footer-icon"></i>
                                    آدرس
                                </h4>
                                <div class="address-content">
                                    <p class="address-text">
                                        خیابان بهشتی، پلاک 259، ساختمان پِیسا، طبقه دوم اندیشکده حکمرانی عصر پویا
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Horizontal Divider -->
                <div class="footer-divider"></div>

                <!-- Bottom Bar -->
                <div class="footer-bottom py-1 px-2">
                    <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between gap-3">
                        <!-- Copyright (Left) -->
                        <div class="footer-copyright text-center text-lg-end">
                            <span><i class="fa fa-copyright" aria-hidden="true"></i> کلیه حقوق متعلق به اندیشکده حکمرانی عصر پویا می‌باشد</span>
                        </div>

                        <!-- Designer Link (Right) -->
                        <div class="footer-designer">
                            <a href="#" class="designer-link">طراحی و توسعه: تیم فنی اندیشکده</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Hero Slider Controller
        class HeroSlider {
            constructor(carouselId) {
                this.carousel = document.getElementById(carouselId);
                this.bsCarousel = new bootstrap.Carousel(this.carousel, {
                    interval: 5000,
                    wrap: true,
                    touch: true,
                    pause: 'hover'
                });

                this.init();
            }

            init() {
                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'ArrowLeft') {
                        this.bsCarousel.next();
                    } else if (e.key === 'ArrowRight') {
                        this.bsCarousel.prev();
                    }
                });

                // Touch gestures (handled by Bootstrap)
                // Auto-pause on hover (handled by Bootstrap)

                // Focus management for accessibility
                this.carousel.addEventListener('slide.bs.carousel', (e) => {
                    const activeSlide = e.relatedTarget;
                    const title = activeSlide.querySelector('.post-title a');
                    if (title) {
                        title.setAttribute('tabindex', '-1');
                    }
                });

                // Resume auto-play when focus leaves
                this.carousel.addEventListener('focusout', (e) => {
                    if (!this.carousel.contains(e.relatedTarget)) {
                        this.bsCarousel.cycle();
                    }
                });
            }
        }

        // Initialize slider when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            new HeroSlider('heroCarousel');
        });

        // Handle window resize for responsive behavior
        window.addEventListener('resize', function() {
            // Force carousel to recalculate dimensions if needed
            const carousel = bootstrap.Carousel.getInstance(document.getElementById('heroCarousel'));
            if (carousel) {
                carousel.cycle();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile menu toggle
        const mobileHamburger = document.querySelector('.mobile-hamburger');
        const mobileNav = document.querySelector('.mobile-nav');
        const mobileSearch = document.querySelector('.mobile-search');

        // Mobile hamburger menu functionality
        if (mobileHamburger && mobileNav) {
            mobileHamburger.addEventListener('click', function() {
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !isExpanded);
                mobileNav.style.display = isExpanded ? 'none' : 'block';
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!mobileHamburger.contains(e.target) && !mobileNav.contains(e.target)) {
                    mobileHamburger.setAttribute('aria-expanded', 'false');
                    mobileNav.style.display = 'none';
                }
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 992) {
                    mobileNav.style.display = 'none';
                    mobileHamburger.setAttribute('aria-expanded', 'false');
                }
            });
        }

        // Mobile search functionality
        const searchModal = document.getElementById('searchModal');
        const searchModalClose = document.querySelector('.search-modal-close');

        if (mobileSearch && searchModal) {
            mobileSearch.addEventListener('click', function() {
                searchModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        }

        // Search modal functionality
        if (searchModalClose && searchModal) {
            searchModalClose.addEventListener('click', function() {
                searchModal.classList.remove('active');
                document.body.style.overflow = '';
            });

            // Close modal when clicking outside
            searchModal.addEventListener('click', function(e) {
                if (e.target === searchModal) {
                    searchModal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        }

        // Mobile dropdown functionality
        const mobileDropdownToggle = document.querySelector('.mobile-dropdown-toggle');
        const mobileDropdown = document.querySelector('.mobile-dropdown');

        if (mobileDropdownToggle && mobileDropdown) {
            mobileDropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                mobileDropdown.classList.toggle('active');
            });
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && searchModal && searchModal.classList.contains('active')) {
                searchModal.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    </script>
    
    <?php wp_footer(); ?>

</body>
</html>
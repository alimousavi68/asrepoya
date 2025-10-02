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
                    <div class="d-flex flex-column flex-md-row gap-4  justify-content-between align-items-center">
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
                        <div class="d-flex gap-4 footer-social-media">
                            <?php
                            // Display social media icons from customizer
                            for ( $i = 1; $i <= 10; $i++ ) {
                                $icon_id = get_theme_mod( "asrepoya_social_icon_{$i}", '' );
                                $link = get_theme_mod( "asrepoya_social_link_{$i}", '' );
                                
                                if ( $icon_id && $link ) {
                                    $icon_path = get_attached_file( $icon_id );
                                    if ( $icon_path && file_exists( $icon_path ) ) {
                                        $svg_content = file_get_contents( $icon_path );
                                        if ( $svg_content ) {
                                            // Clean and prepare SVG content
                                            $svg_content = preg_replace('/width="[^"]*"/', '', $svg_content);
                                            $svg_content = preg_replace('/height="[^"]*"/', '', $svg_content);
                                            $svg_content = str_replace('<svg', '<svg class="social-svg-icon" width="24" height="24"', $svg_content);
                                            
                                            printf(
                                                '<a href="%s" target="_blank" rel="noopener" class="social-icon social-item social-item-%d" aria-label="شبکه اجتماعی %d">%s</a>',
                                                esc_url( $link ),
                                                $i,
                                                $i,
                                                $svg_content
                                            );
                                        }
                                    }
                                }
                            }
                            ?>
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
                                <p class="footer-description footer-about-us">
                                    <?php 
                                    $about_us = get_theme_mod( 'asrepoya_about_us', 'اندیشکده حکمرانی عصر پویا، نهادی مستقل با ماهیت غیرانتفاعی و غیرتجاری است که با رویکردی تحلیلی، پژوهشی،تحلیلی است که با رویکردی نقادانه به تحلیل سیاست‌های اقتصادی، نهادهای بین‌المللی، ساختارهای قدرت و تحولات اقتصادی-اجتماعی در ایران و جهان می‌پردازد.' );
                                    echo esc_html( $about_us );
                                    ?>
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
                                
                                <?php
                                // Display phone numbers
                                $phones = array();
                                for ( $i = 1; $i <= 4; $i++ ) {
                                    $phone = get_theme_mod( "asrepoya_phone_{$i}", '' );
                                    if ( $phone ) {
                                        $phones[] = $phone;
                                    }
                                }
                                
                                if ( !empty( $phones ) ) : ?>
                                <div class="contact-item">
                                    <i class="fas fa-phone contact-icon"></i>
                                    <div class="contact-text">
                                        <?php foreach ( $phones as $index => $phone ) : ?>
                                            <div class="footer-phone-<?php echo $index + 1; ?>"><?php echo esc_html( $phone ); ?></div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                                <?php 
                                $email = get_theme_mod( 'asrepoya_email', '' );
                                if ( $email ) : ?>
                                <div class="contact-item">
                                    <i class="fas fa-envelope contact-icon"></i>
                                    <div class="contact-text">
                                        <a href="mailto:<?php echo esc_attr( $email ); ?>" class="contact-email footer-email"><?php echo esc_html( $email ); ?></a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Address Column (Left) -->
                        <div class="col-lg-4 col-md-12 footer-address-col">
                            <div class="footer-address">
                                <?php
                                $address1 = get_theme_mod( 'asrepoya_address_1', '' );
                                $address2 = get_theme_mod( 'asrepoya_address_2', '' );
                                if ( ! empty( $address1 ) || ! empty( $address2 ) ) : ?>
                                    <h4 class="footer-title">
                                        <i class="fas fa-map-marker-alt footer-icon"></i>
                                        آدرس
                                    </h4>
                                    <div class="address-content">
                                        <?php
                                        for ( $i = 1; $i <= 2; $i++ ) {
                                            $address = get_theme_mod( "asrepoya_address_{$i}", '' );
                                            if ( $address ) {
                                                echo '<p class="address-text footer-address-' . $i . '">' . esc_html( $address ) . '</p>';
                                            }
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>
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
                            <span><i class="fa fa-copyright" aria-hidden="true"></i> <?php echo esc_html( get_theme_mod( 'asrepoya_copyright_text', 'کلیه حقوق متعلق به اندیشکده حکمرانی عصر پویا می‌باشد' ) ); ?></span>
                        </div>

                        <!-- Designer Link (Right) -->
                        <div class="footer-designer">
                            <a href="http://ihasht.ir/" target="_blank" class="designer-link">طراحی و توسعه: هشت بهشت</a>
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

    <!-- Bootstrap JavaScript -->
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.bundle.min.js"></script>
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
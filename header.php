<?php 

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Asrepoya
 */
?>


<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <!-- تنظیمات پایه و متاداده -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    
    <!-- کتابخانه‌های خارجی -->
    <!-- Bootstrap CSS برای طراحی ریسپانسیو -->
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- استایل‌های سفارشی پروژه -->
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/main.min.css" rel="stylesheet">
    <!-- Font Awesome برای آیکون‌ها -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/fontawesome-all.min.css">
    
    <?php wp_head(); ?>
</head>
<?php
// get_header();
?>

<body>
    <!-- ========== بخش هدر اصلی ========== -->
    <!-- شامل لوگو، منوی ناوبری، جستجو و دکمه‌های اجتماعی -->
    <header class="main-header container-full p-0 align-content-center">
        <!-- طرح‌بندی دسکتاپ - نمایش در صفحات بزرگ -->
        <div class="container-header d-none d-lg-flex justify-content-between align-items-center py-3">
            <!-- بخش لوگو و شناسه سازمان -->
            <div class="d-flex align-items-center">
                <a href="<?php echo home_url(); ?>">
                    <?php if (get_custom_logo()): ?>
                        <?php echo get_custom_logo(); ?>
                    <?php else: ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo-asre-poya.svg" alt="<?php echo get_bloginfo('name'); ?>" class="me-2">
                    <?php endif; ?>
                </a>    
                <div class="separator ms-2"></div>
            </div>

            <!-- بخش منوی ناوبری اصلی -->
            <?php asrepoya_primary_menu(); ?>

            <!-- Search Section -->
            <form role="search" method="get" class="search-section d-flex align-items-center position-relative" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="search" class="search-field rounded-0 me-3" placeholder="جستجو..."
                    aria-label="جستجو در سایت" name="s">
                <button type="submit" class="search-icon-button position-absolute end-0 ms-3 border-0 p-0" aria-label="جستجو">
                    <i class="fas fa-search search-icon"></i>
                </button>
            </form>
        </div>

        <!-- Mobile Layout -->
        <div
            class="container-header d-lg-none d-flex justify-content-between align-items-center py-3 position-relative">
            <!-- Mobile Hamburger Menu -->
            <button class="mobile-hamburger d-flex align-items-center justify-content-center" aria-label="منوی موبایل"
                aria-expanded="false">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/menu-01.svg" alt="منو" width="24" height="24">
            </button>

            <!-- Mobile Logo (Centered) -->
            <div class="mobile-logo d-flex align-items-center">
                <a href="<?php echo home_url(); ?>">
                    <?php if (get_custom_logo()): ?>
                        <?php echo get_custom_logo(); ?>
                    <?php else: ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo-asre-poya.svg" alt="<?php echo get_bloginfo('name'); ?>">
                    <?php endif; ?>
                </a> 
            </div>

            <!-- Mobile Search Icon -->
            <button class="mobile-search d-flex align-items-center justify-content-center" aria-label="جستجو">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/search-md.svg" alt="جستجو" width="24" height="24">
            </button>
        </div>

        <!-- Mobile Navigation -->
        <?php asrepoya_mobile_menu(); ?>

        <!-- Search Modal -->
        <div class="search-modal" id="searchModal">
            <div class="search-modal-content">
                <div class="search-modal-header">
                    <h5>جستجو در سایت</h5>
                    <button class="search-modal-close" aria-label="بستن">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="search-modal-body">
                    <form role="search" method="get" class="search-input-wrapper" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input type="search" class="search-modal-input" placeholder="عبارت مورد نظر خود را وارد کنید..."
                            aria-label="جستجو" name="s">
                        <button type="submit" class="search-modal-btn ">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>
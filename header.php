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
    <title> اندیشکده حکمرانی</title>


    
    <!-- کتابخانه‌های خارجی -->
    <!-- Bootstrap CSS برای طراحی ریسپانسیو -->
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome برای آیکون‌ها -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/fontawesome-all.min.css">
    <!-- استایل‌های سفارشی پروژه -->
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/main.css" rel="stylesheet">
</head>
<?php
// get_header();
?>

<body>
    <!-- ========== بخش هدر اصلی ========== -->
    <!-- شامل لوگو، منوی ناوبری، جستجو و دکمه‌های اجتماعی -->
    <header class="main-header container-full p-0 align-content-center section-bg-2">
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
            <div class="search-section d-flex align-items-center position-relative">
                <input type="search" class="search-field rounded-0" placeholder="جستجو..."
                    aria-label="جستجو در سایت">
                <i class="fas fa-search search-icon position-absolute end-0 ms-3" aria-label="آیکون جستجو"></i>
            </div>
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
                <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo-asre-poya.svg" alt="اندیشکده حکمرانی"></a> 
            </div>

            <!-- Mobile Search Icon -->
            <button class="mobile-search d-flex align-items-center justify-content-center" aria-label="جستجو">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/search-md.svg" alt="جستجو" width="24" height="24">
            </button>
        </div>

        <!-- Mobile Navigation -->
        <nav class="mobile-nav" role="navigation">
            <a href="#" class="nav-link">خانه</a>
            <div class="mobile-dropdown">
                <a href="#" class="nav-link mobile-dropdown-toggle d-flex justify-content-between align-items-center">
                    گروه‌ها
                    <i class="fas fa-chevron-down mobile-dropdown-arrow"></i>
                </a>
                <div class="mobile-dropdown-menu">
                    <div class="mobile-dropdown-section">
                        <h6 class="mobile-dropdown-title">گروه‌های پژوهشی</h6>
                        <a href="#" class="mobile-dropdown-link">حکمرانی اقتصادی</a>
                        <a href="#" class="mobile-dropdown-link">حکمرانی اجتماعی</a>
                        <a href="#" class="mobile-dropdown-link">حکمرانی سیاسی</a>
                        <a href="#" class="mobile-dropdown-link">حکمرانی فرهنگی</a>
                    </div>
                    <div class="mobile-dropdown-section">
                        <h6 class="mobile-dropdown-title">مراکز تخصصی</h6>
                        <a href="#" class="mobile-dropdown-link">مرکز مطالعات راهبردی</a>
                        <a href="#" class="mobile-dropdown-link">مرکز نوآوری</a>
                        <a href="#" class="mobile-dropdown-link">مرکز آموزش</a>
                        <a href="#" class="mobile-dropdown-link">مرکز مشاوره</a>
                    </div>
                </div>
            </div>
            <a href="#" class="nav-link">گزارش‌ها</a>
            <a href="#" class="nav-link">نشست‌ها</a>
            <a href="#" class="nav-link">رویدادها</a>
            <a href="#" class="nav-link">چندرسانه‌ای</a>
            <a href="#" class="nav-link">انتشارات</a>
            <a href="#" class="nav-link">درباره ما</a>
        </nav>

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
                    <div class="search-input-wrapper">
                        <input type="search" class="search-modal-input" placeholder="عبارت مورد نظر خود را وارد کنید..."
                            aria-label="جستجو">
                        <button class="search-modal-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </header>
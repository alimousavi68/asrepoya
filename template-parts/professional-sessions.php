<?php
/**
 * Template part for displaying professional sessions section
 *
 * @package Asrepoya
 */
?>

<!-- Professional Sessions Section -->
<section class="container-fluid py-0 px-0 post-section" aria-labelledby="sessions-title">
    <div class="row g-0 align-items-start">

        <!-- Section Header -->
        <header class="post-list-header ">
            <div class="header-content">
                <div class="header-text">
                    <h2 id="sessions-title" class="post-list-title fw-bold pe-4">نشست‌های تخصصی</h2>
                    <p class="post-list-subtitle pe-4 text-black-50">آخرین رویدادهای برگزار شده توسط مرکز</p>
                </div>
                <a href="<?php echo get_category_link(8); ?>" class="more-btn">
                    <span>مشاهده بیشتر</span>
                    <i class="fas fa-chevron-left"></i>
                </a>
            </div>
        </header>

        <!-- Session Content Column -->
        <div class="col-lg-6 bg-dark-900 text-white post-section-content pe-5">
            <div class="content-inner">


                <?php
                $sessions_query = new WP_Query(array(
                    'cat' => 8,
                    'posts_per_page' => 2,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($sessions_query->have_posts()):
                    $sessions_query->the_post();
                ?>
                <!-- Featured Post Content -->
                <div class="featured-post-content ">
                    <h3 class="featured-post-title text-black">
                        <a href="<?php the_permalink(); ?>" class="text-black"><?php the_title(); ?></a>
                    </h3>

                    <p class="featured-post-lead text-black-50">
                        <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                    </p>

                    <!-- Host Block -->
                    <div class="host-block">
                        <div class="host-avatar">
                            <img src="https://picsum.photos/40/40?random=1" alt="دکتر احسان قدری"
                                class="rounded-circle">
                        </div>
                        <div class="host-info">
                            <div class="host-name text-black">میزبان: دکتر احسان قدری</div>
                            <div class="host-role text-black-50">اقتصاد دان و عضو هیئت علمی عصر پویا</div>
                        </div>
                    </div>
                </div>
               
                <?php endif; ?>

                <!-- Divider -->
                <div class="content-divider"></div>

                <!-- Second Post -->
                <?php if ($sessions_query->have_posts() && $sessions_query->current_post + 1 < $sessions_query->post_count): ?>
                <?php $sessions_query->the_post(); ?>
                <div class="second-post">
                    <h4 class="second-post-title">
                        <a href="<?php the_permalink(); ?>" class="text-black"><?php the_title(); ?></a>
                    </h4>
                    <div class="second-post-meta">
                        <span class="post-category text-black-50">حوزه سیاسی</span>
                        <span class="meta-separator text-black-50">•</span>
                        <span class="post-event-date text-black-50">تاریخ برگزاری: <?php the_date('Y/m/d'); ?></span>
                    </div>
                </div>
                <?php else: ?>
                <!-- Second Post - Static Fallback -->
                <div class="second-post">
                    <h4 class="second-post-title">
                        <a href="#" class="text-black">خط‌مشی‌گذاری کرونا و سیاست ورزی در کشکش نهادی؛
                            چالش‌های تربیت سیاسی و کیفیت حکمرانی در ایران</a>
                    </h4>
                    <div class="second-post-meta">
                        <span class="post-category text-black-50">حوزه سیاسی</span>
                        <span class="meta-separator text-black-50">•</span>
                        <span class="post-event-date text-black-50">تاریخ برگزاری: ۱۴۰۳/۰۸/۲۵</span>
                    </div>
                </div>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>

        <!-- Session Image Column -->
        <div class="col-lg-6 p-0">
            <figure class="featured-post-image">
                 <?php
                $sessions_query_2 = new WP_Query(array(
                    'cat' => 8,
                    'posts_per_page' => 1,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($sessions_query_2->have_posts()):
                    $sessions_query_2->the_post();
                ?>
                <?php if (has_post_thumbnail()): ?>
                    <img src="<?php the_post_thumbnail_url('large'); ?>"
                    alt="<?php the_title(); ?>"
                    class="w-100 h-100">
                <?php else: ?>
                <img src="https://picsum.photos/720/560?random=1"
                    alt="سلسله نشست‌های اقتصادی پیرامون ظرفیت‌های اقتصاد ایران در توسعه صادرات غیر نفتی کشور"
                    class="w-100 h-100">
                <?php endif;endif; ?>
            </figure>
        </div>
    </div>
</section>
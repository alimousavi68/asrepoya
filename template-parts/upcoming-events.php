<?php
/**
 * Template part for displaying upcoming events section
 *
 * @package Asrepoya
 */
?>

<!-- Upcoming Events Section -->
<section class="event-list-section" aria-labelledby="upcoming-events-title">
    <div class="container-content">
        <h2 id="upcoming-events-title" class="visually-hidden">رویدادهای پیش رو</h2>
        <!-- Section Header -->
        <header class="post-list-header">
            <div class="header-content">
                <div class="header-text">
                    <h3 class="post-list-title fw-bold pe-4">رویدادهای پیش رو</h3>
                    <p class="post-list-subtitle pe-4 text-black-50">آخرین رویدادهای عصر پویا</p>
                </div>
                <a href="<?php echo get_category_link(330); ?>" class="more-btn">
                    <span>بیشتر</span>
                    <i class="fas fa-chevron-left"></i>
                </a>
            </div>
    </div>

    <!-- Event Cards Grid -->
    <?php
    $events_query = new WP_Query(array(
        'cat' => 330,
        'posts_per_page' => 2,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
    
    if ($events_query->have_posts()):
    ?>
    <div class="row g-4 container-content">
        <?php while ($events_query->have_posts()): $events_query->the_post(); ?>
        <!-- Event Card -->
        <div class="col-lg-6">
            <div class="event-card border  bg-white h-100 overflow-hidden">
                <div class="row g-0 align-items-stretch">
                    <!-- Event Image (Right Side) -->
                    <div class="col-md-5">
                        <div class="">
                            <?php if (has_post_thumbnail()): ?>
                            <img src="<?php the_post_thumbnail_url('medium'); ?>"
                                alt="<?php the_title(); ?>"
                                class="event-image">
                          
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Event Content (Left Side) -->
                    <div class="col-md-7 d-flex flex-column justify-content-between p-4 pb-0 ps-0">
                        <div>
                            <h3 class="event-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="event-lead"><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>
                        </div>
                        <div class="event-meta d-flex align-items-center flex-wrap gap-3 text-muted bg-body-secondary py-0 ps-0"
                            aria-label="تاریخ: <?php the_date('Y/m/d'); ?>، مکان: تهران، اندیشکده عصر پویا">

                            <span
                                class="event-date d-flex align-items-center  p-2 px-4 d-flex flex-column gap-1">
                                <span class="fw-bold fs-5  text-white"><?php the_time('d'); ?></span>
                                <span class="fw-normal   text-white"><?php the_time('F'); ?></span>
                            </span>

                            <span class="event-location d-flex align-items-center p-2">
                                <i class="fas fa-map-marker-alt me-1" aria-hidden="true"></i>
                                تهران، اندیشکده عصر پویا
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
    </div>
</section>
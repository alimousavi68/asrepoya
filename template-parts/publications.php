<?php

/**
 * Template part for displaying publications section
 *
 * @package Asrepoya
 */
?>

<!-- Publications Section -->
<section class="book-carousel-section  container-fluid mx-0 px-0 section-bg" aria-labelledby="publications-title">
    <div class="container-content py-5">
        <h2 id="publications-title" class="visually-hidden">انتشارات</h2>
        <!-- Section Header -->
        <header class="post-list-header">
            <div class="header-content">
                <div class="header-text">
                    <h3 class="post-list-title fw-bold pe-4">انتشارات</h3>
                    <p class="post-list-subtitle pe-4">آخرین انتشارات</p>
                </div>
                <a href="<?php echo get_category_link(8); ?>" class="more-btn ">
                    <span class="text-white">بیشتر</span>
                    <i class="fas fa-chevron-left"></i>
                </a>
            </div>
        </header>

        <!-- Publications Carousel Container -->
        <div class="carousel-container position-relative">
            <!-- Carousel Content Box -->
            <div class="carousel-box bg-white shadow-lg p-5">
                <div id="bookCarousel" class="carousel carousel-fade" data-bs-ride="carousel"
                    data-bs-interval="5000" data-bs-pause="hover" data-bs-wrap="true" role="region"
                    aria-labelledby="book-carousel-label"> <?php
                                                            $publications_query = new WP_Query(array(
                                                                'cat' => 332,
                                                                'posts_per_page' => 3,
                                                                'orderby' => 'date',
                                                                'order' => 'DESC',
                                                               
                                                            ));

                                                            if ($publications_query->have_posts()):
                                                            ?>
                        <div class="carousel-inner">
                            <?php $first_item = true;
                                                                while ($publications_query->have_posts()): $publications_query->the_post(); ?>
                                <!-- Slide -->
                                <div class="carousel-item <?php echo $first_item ? 'active' : ''; ?>">
                                    <div class="row g-4 align-items-center">
                                        <!-- Book Image -->
                                        <div class="col-lg-6">
                                            <div class="book-image-container">
                                                <?php if (has_post_thumbnail()): ?>
                                                    <img src="<?php the_post_thumbnail_url('large'); ?>"
                                                        alt="<?php the_title(); ?>" class="img-fluid ">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <!-- Book Content -->
                                        <div class="col-lg-6">
                                            <div class="book-content">
                                                <h3 class="book-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                                <div class="book-author d-flex flex-row gap-2">
                                                    <img src="https://picsum.photos/20/20?random=1"
                                                        alt="دکتر فرشاد رحمانی" class="author-avatar rounded-circle">
                                                    <div
                                                        class="author-info d-flex flex-column gap-2 align-items-lg-start">
                                                        <span class="author-label">نویسنده:</span>
                                                        <span class="author-name">دکتر فرشاد رحمانی</span>
                                                    </div>
                                                </div>
                                                <p class="book-lead">
                                                    <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                                                </p>
                                                <a href="<?php the_permalink(); ?>" class="book-more-link d-flex justify-content-end w-100 "
                                                    aria-label="اطلاعات بیشتر درباره <?php the_title(); ?>">
                                                    بیشتر
                                                    <i class="fas fa-arrow-left"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php $first_item = false;
                                                                endwhile; ?>
                        </div>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>

            <!-- Custom Navigation Controls -->
            <div class="carousel-controls">
                <button class="carousel-control-btn carousel-prev" type="button" data-bs-target="#bookCarousel"
                    data-bs-slide="prev" aria-label="اسلاید قبلی">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <button class="carousel-control-btn carousel-next" type="button" data-bs-target="#bookCarousel"
                    data-bs-slide="next" aria-label="اسلاید بعدی">
                    <i class="fas fa-chevron-left"></i>
                </button>
            </div>
        </div>
    </div>
</section>
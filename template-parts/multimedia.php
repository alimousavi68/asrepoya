<?php
/**
 * Template part for displaying multimedia section
 *
 * @package Asrepoya
 */
?>

<!-- Multimedia Section -->
<section class="container-fluid multimedia-section py-5 section-bg overflow-hidden" aria-labelledby="multimedia-title">
    <div class="container-content">
        <h2 id="multimedia-title" class="visually-hidden">بخش چندرسانه‌ای</h2>
        <!-- Section Header -->
        <header class="post-list-header">
            <div class="header-content">
                <div class="header-text">
                    <h3 class="post-list-title fw-bold pe-5 pe-lg-4">چند رسانه ای</h3>
                    <p class="post-list-subtitle pe-4">آخرین ویدیوهای آموزشی و رویدادها</p>
                </div>
                <a href="<?php echo get_category_link(331); ?>" class="more-btn">
                    <span class="text-white">بیشتر</span>
                    <i class="fas fa-chevron-left"></i>
                </a>
            </div>
        </header>

        <!-- Multimedia Content Grid -->
        <div class="row g-4">
            <?php
            $multimedia_query = new WP_Query(array(
                'cat' => 331,
                'posts_per_page' => 7,
                'orderby' => 'date',
                'order' => 'DESC'
            ));
            
            if ($multimedia_query->have_posts()):
                $post_count = 0;
                while ($multimedia_query->have_posts()): $multimedia_query->the_post();
                    $post_count++;
                    if ($post_count == 1):
            ?>
            <!-- Featured Video Column -->
            <div class="col-lg-6">
                <article class="featured-video-card">
                    <div class="featured-video-image position-relative">
                        <div class="ratio ratio-16x9">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title(); ?>"
                                    class="img-fluid object-fit-cover">
                            <?php else: ?>
                                <img src="https://picsum.photos/600/396?random=1" alt="ویدیو شاخص"
                                    class="img-fluid object-fit-cover">
                            <?php endif; ?>
                        </div>
                        <!-- Play Icon -->
                        <div
                            class="play-icon-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                            <button class="play-btn" aria-label="پخش ویدیو شاخص">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Content Panel -->
                    <div class="featured-video-content p-4">
                        <div
                            class="featured-video-meta d-flex align-items-center justify-content-between gap-3">
                            <span class="video-date text-muted">
                                <i class="far fa-calendar-alt me-1"></i>
                                <?php echo get_the_date('Y/m/d'); ?>
                            </span>
                            <span class="video-duration text-muted">
                                ۰۸:۳۴
                                <i class="fas fa-play me-1"></i>
                            </span>
                        </div>
                        <h3 class="featured-video-title mb-3">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="featured-video-lead mb-3">
                            <?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?>
                        </p>

                    </div>
                </article>
            </div>

            <!-- Video Gallery Column -->
            <div class="col-lg-6">
                <aside class="video-grid bg-white h-100 p-4" role="complementary"
                    aria-labelledby="video-gallery-title">
                    <h3 id="video-gallery-title" class="visually-hidden">گالری ویدیوها</h3>
                    <div class="row g-3 h-100">
                    <?php else: ?>
                        <!-- Video Card -->
                        <div class="col-6">
                            <article class="video-grid-card position-relative">
                                <div class="ratio ratio-16x9">
                                    <?php if (has_post_thumbnail()): ?>
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>"
                                            class="img-fluid object-fit-cover">
                                    <?php else: ?>
                                        <img src="https://picsum.photos/260/190?random=<?php echo $post_count; ?>" alt="ویدیو <?php echo $post_count - 1; ?>"
                                            class="img-fluid object-fit-cover">
                                    <?php endif; ?>
                                </div>
                                <!-- Overlay Gradient -->
                                <div class="video-overlay position-absolute top-0 start-0 w-100 h-100"></div>
                                <!-- Duration Chip -->
                                <div class="duration-chip position-absolute top-2 start-2">
                                    <i class="fas fa-play me-1"></i>
                                    <span>۰۳:۱۲</span>
                                </div>
                                <!-- Title -->
                                <h4 class="video-grid-title position-absolute bottom-0 start-0 end-0 p-3 mb-0">
                                    <a href="<?php the_permalink(); ?>" class="text-white text-decoration-none"><?php echo wp_trim_words(get_the_title(), 8, '...'); ?></a>
                                </h4>
                            </article>
                        </div>
                    <?php 
                    endif;
                endwhile;
                wp_reset_postdata();
                
                // Close the gallery divs if we had posts
                if ($post_count > 1):
                    ?>
                    </div>
                </aside>
            </div>
            <?php 
                endif;
            else:
            ?>
            <!-- Static fallback content -->
            <!-- Featured Video Column -->
            <div class="col-lg-6">
                <article class="featured-video-card">
                    <div class="featured-video-image position-relative">
                        <div class="ratio ratio-16x9">
                            <img src="https://picsum.photos/600/396?random=1" alt="ویدیو شاخص"
                                class="img-fluid object-fit-cover">
                        </div>
                        <!-- Play Icon -->
                        <div
                            class="play-icon-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                            <button class="play-btn" aria-label="پخش ویدیو شاخص">
                                <i class="fas fa-play"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Content Panel -->
                    <div class="featured-video-content p-4">
                        <div
                            class="featured-video-meta d-flex align-items-center justify-content-between gap-3">
                            <span class="video-date text-muted">
                                <i class="far fa-calendar-alt me-1"></i>
                                ۱۴۰۳/۰۶/۲۲
                            </span>
                            <span class="video-duration text-muted">
                                ۰۸:۳۴
                                <i class="fas fa-play me-1"></i>
                            </span>
                        </div>
                        <h3 class="featured-video-title mb-3">
                            <a href="#">زنگ‌نور جایی‌پای ناتوم در مرزهای شمالی ایران</a>
                        </h3>
                        <p class="featured-video-lead mb-3">
                            داریوش صمور نیاز استاد دانشگاه و کارشناس مسائل اوراسیا در گفت‌وگو با خبرگزاری فارس،
                            اگر زنگ‌نور اجرا شود، منطقه آذربایجان و ارمنستان به ناتو می‌پیوندد و این مقدمه تبدیل
                            شده قفقاز جنوبی به افغانستان دوم است.
                        </p>

                    </div>
                </article>
            </div>

            <!-- Video Gallery Column -->
            <div class="col-lg-6">
                <aside class="video-grid bg-white h-100 p-4" role="complementary"
                    aria-labelledby="video-gallery-title">
                    <h3 id="video-gallery-title" class="visually-hidden">گالری ویدیوها</h3>
                    <div class="row g-3 h-100">
                        <!-- Video Card 1 -->
                        <div class="col-6">
                            <article class="video-grid-card position-relative">
                                <div class="ratio ratio-16x9">
                                    <img src="https://picsum.photos/260/190?random=1" alt="ویدیو ۱"
                                        class="img-fluid object-fit-cover">
                                </div>
                                <!-- Overlay Gradient -->
                                <div class="video-overlay position-absolute top-0 start-0 w-100 h-100"></div>
                                <!-- Duration Chip -->
                                <div class="duration-chip position-absolute top-2 start-2">
                                    <i class="fas fa-play me-1"></i>
                                    <span>۰۳:۱۲</span>
                                </div>
                                <!-- Title -->
                                <h4 class="video-grid-title position-absolute bottom-0 start-0 end-0 p-3 mb-0">
                                    <a href="#" class="text-white text-decoration-none">فیلم‌برداری تغییرات
                                        قانون بازنشستگی در مجلس</a>
                                </h4>
                            </article>
                        </div>

                        <!-- Video Card 2 -->
                        <div class="col-6">
                            <article class="video-grid-card position-relative">
                                <div class="ratio ratio-16x9">
                                    <img src="https://picsum.photos/260/190?random=1" alt="ویدیو ۲"
                                        class="img-fluid object-fit-cover">
                                </div>
                                <div class="video-overlay position-absolute top-0 start-0 w-100 h-100"></div>
                                <div class="duration-chip position-absolute top-2 start-2">
                                    <i class="fas fa-play me-1"></i>
                                    <span>۰۵:۴۵</span>
                                </div>
                                <h4 class="video-grid-title position-absolute bottom-0 start-0 end-0 p-3 mb-0">
                                    <a href="#" class="text-white text-decoration-none">با پایه PVC این دوچرخه
                                        جذاب و کاربرد را بسازید</a>
                                </h4>
                            </article>
                        </div>

                        <!-- Video Card 3 -->
                        <div class="col-6">
                            <article class="video-grid-card position-relative">
                                <div class="ratio ratio-16x9">
                                    <img src="https://picsum.photos/260/190?random=1" alt="ویدیو ۳"
                                        class="img-fluid object-fit-cover">
                                </div>
                                <div class="video-overlay position-absolute top-0 start-0 w-100 h-100"></div>
                                <div class="duration-chip position-absolute top-2 start-2">
                                    <i class="fas fa-play me-1"></i>
                                    <span>۰۲:۳۰</span>
                                </div>
                                <h4 class="video-grid-title position-absolute bottom-0 start-0 end-0 p-3 mb-0">
                                    <a href="#" class="text-white text-decoration-none">فیلم‌برداری تغییرات
                                        قانون بازنشستگی در مجلس</a>
                                </h4>
                            </article>
                        </div>

                        <!-- Video Card 4 -->
                        <div class="col-6">
                            <article class="video-grid-card position-relative">
                                <div class="ratio ratio-16x9">
                                    <img src="https://picsum.photos/260/190?random=1" alt="ویدیو ۴"
                                        class="img-fluid object-fit-cover">
                                </div>
                                <div class="video-overlay position-absolute top-0 start-0 w-100 h-100"></div>
                                <div class="duration-chip position-absolute top-2 start-2">
                                    <i class="fas fa-play me-1"></i>
                                    <span>۰۷:۱۸</span>
                                </div>
                                <h4 class="video-grid-title position-absolute bottom-0 start-0 end-0 p-3 mb-0">
                                    <a href="#" class="text-white text-decoration-none">با پایه PVC این دوچرخه
                                        جذاب و کاربرد را بسازید</a>
                                </h4>
                            </article>
                        </div>

                        <!-- Video Card 5 -->
                        <div class="col-6">
                            <article class="video-grid-card position-relative">
                                <div class="ratio ratio-16x9">
                                    <img src="https://picsum.photos/260/190?random=1" alt="ویدیو ۵"
                                        class="img-fluid object-fit-cover">
                                </div>
                                <div class="video-overlay position-absolute top-0 start-0 w-100 h-100"></div>
                                <div class="duration-chip position-absolute top-2 start-2">
                                    <i class="fas fa-play me-1"></i>
                                    <span>۰۴:۵۶</span>
                                </div>
                                <h4 class="video-grid-title position-absolute bottom-0 start-0 end-0 p-3 mb-0">
                                    <a href="#" class="text-white text-decoration-none">بازنشستگی زودهنگام از
                                        موضوع</a>
                                </h4>
                            </article>
                        </div>

                        <!-- Video Card 6 -->
                        <div class="col-6">
                            <article class="video-grid-card position-relative">
                                <div class="ratio ratio-16x9">
                                    <img src="https://picsum.photos/260/190?random=1" alt="ویدیو ۶"
                                        class="img-fluid object-fit-cover">
                                </div>
                                <div class="video-overlay position-absolute top-0 start-0 w-100 h-100"></div>
                                <div class="duration-chip position-absolute top-2 start-2">
                                    <i class="fas fa-play me-1"></i>
                                    <span>۰۶:۲۳</span>
                                </div>
                                <h4 class="video-grid-title position-absolute bottom-0 start-0 end-0 p-3 mb-0">
                                    <a href="#" class="text-white text-decoration-none">فیلم‌برداری تغییرات
                                        قانون بازنشستگی در مجلس</a>
                                </h4>
                            </article>
                        </div>
                    </div>
                </aside>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
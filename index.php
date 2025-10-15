<?php
    // get_header();
    get_header();
?>

    <!-- Main Content Area -->
    <main class="container-fluid d-flex flex-column gap-5 py-4 px-0 logo-bg" role="main">

        <!-- Hero Slider Section -->
        <section class="Herobox container py-4" aria-labelledby="hero-section-title">
            
            <div class="row">
                <!-- Hero Slider Column -->
                <div class="col-lg-8">
                    <div class="hero-slider" role="region" aria-labelledby="hero-carousel-title">
                        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel"
                            data-bs-interval="5000" data-bs-wrap="true">
                            <!-- Custom Controls -->
                            <div class="custom-controls">
                                <button class="control-btn" type="button" data-bs-target="#heroCarousel"
                                    data-bs-slide="prev" aria-label="اسلاید قبلی">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                                <button class="control-btn" type="button" data-bs-target="#heroCarousel"
                                    data-bs-slide="next" aria-label="اسلاید بعدی">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                            </div>

                            <!-- Carousel Inner -->
                            <div class="carousel-inner">
                                <?php
                                $hero_query = new WP_Query([
                                    'cat' => 8,
                                    'posts_per_page' => 2,
                                ]);
                                if ($hero_query->have_posts()) :
                                    $slide_index = 0;
                                    while ($hero_query->have_posts()) : $hero_query->the_post();
                                        $active_class = ($slide_index === 0) ? 'active' : '';
                                        ?>
                                        <div class="carousel-item <?php echo $active_class; ?>" role="group" aria-roledescription="slide"
                                            aria-label="اسلاید <?php echo $slide_index + 1; ?> از 3">
                                            
                                            <?php if (has_post_thumbnail()) : ?>
                                                <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                                    <?php the_post_thumbnail('hero-banner', ['class' => 'd-block w-100', 'alt' => get_the_title(), 'width' => 850, 'height' => 500]); ?>
                                                </a>
                                            <?php endif; ?>
                                            <div class="content-panel">
                                                <div class="content-wrapper">
                                                    <div class="post-meta">
                                                        <?php
                                                        $category = get_the_category();
                                                        if (!empty($category)) : ?>
                                                            <a href="<?php echo esc_url(get_category_link($category[0]->term_id)); ?>" class="category-badge"><?php echo esc_html($category[0]->name); ?></a>
                                                        <?php endif; ?>
                                                        <span class="post-date">
                                                            <i class="far fa-calendar-alt me-1"></i>
                                                            <?php echo get_the_date('Y/m/d'); ?>
                                                        </span>
                                                    </div>
                                                    <h2 class="post-title">
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h2>
                                                    <p class="post-lead">
                                                        <?php echo get_the_excerpt(); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $slide_index++;
                                    endwhile;
                                    wp_reset_postdata();
                                else:
                                    // Fallback static slides if no posts found
                                ?>
                                    <!-- Slide 1 -->
                                    <div class="carousel-item active" role="group" aria-roledescription="slide"
                                        aria-label="اسلاید ۱ از ۳">
                                        <img src="https://picsum.photos/1600/900?random=1"
                                            alt="بازآرایی سیاست‌های تجارت بین‌الملل" class="d-block w-100"
                                            fetchpriority="high" width="1600" height="900">
                                        <div class="content-panel">
                                            <div class="content-wrapper">
                                                <div class="post-meta">
                                                    <a href="#" class="category-badge">انرژی</a>
                                                    <span class="post-date">
                                                        <i class="far fa-calendar-alt me-1"></i>
                                                        ۱۴۰۳ شهریور ۱۲
                                                    </span>
                                                </div>
                                                <h2 class="post-title">
                                                    <a href="#">بازآرایی سیاست‌های تجارت بین‌الملل و تأثیرات آن بر اقتصاد
                                                        کشورهای آفریقایی</a>
                                                </h2>
                                                <p class="post-lead">
                                                    در ماه‌های گذشته، با اعمال موجی تازه از تعرفه‌های تجاری از سوی ایالات
                                                    متحده
                                                    بر تقریباً تمامی کشورهای جهان، تحول چشمگیری در سیاست اقتصادی بین‌المللی
                                                    ایجاد شد.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Slide 2 -->
                                    <div class="carousel-item" role="group" aria-roledescription="slide"
                                        aria-label="اسلاید ۲ از ۳">
                                        <img src="https://picsum.photos/1600/900?random=2"
                                            alt="تحولات فناوری و حکمرانی دیجیتال" class="d-block w-100" loading="lazy"
                                            width="1600" height="900">
                                        <div class="content-panel">
                                            <div class="content-wrapper">
                                                <div class="post-meta">
                                                    <a href="#" class="category-badge">فناوری</a>
                                                    <span class="post-date">
                                                        <i class="far fa-calendar-alt me-1"></i>
                                                        ۱۴۰۳ شهریور ۱۰
                                                    </span>
                                                </div>
                                                <h2 class="post-title">
                                                    <a href="#">تحولات فناوری و تأثیر آن بر حکمرانی دیجیتال در عصر جدید</a>
                                                </h2>
                                                <p class="post-lead">
                                                    پیشرفت‌های اخیر در حوزه هوش مصنوعی و فناوری‌های نوین، تحولی بنیادین در
                                                    نحوه
                                                    حکمرانی و ارائه خدمات عمومی ایجاد کرده است.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Slide 3 -->
                                    <div class="carousel-item" role="group" aria-roledescription="slide"
                                        aria-label="اسلاید ۳ از ۳">
                                        <img src="https://picsum.photos/1600/900?random=3"
                                            alt="سیاست‌های محیط زیست و توسعه پایدار" class="d-block w-100" loading="lazy"
                                            width="1600" height="900">
                                        <div class="content-panel">
                                            <div class="content-wrapper">
                                                <div class="post-meta">
                                                    <a href="#" class="category-badge">محیط زیست</a>
                                                    <span class="post-date">
                                                        <i class="far fa-calendar-alt me-1"></i>
                                                        ۱۴۰۳ شهریور ۰۸
                                                    </span>
                                                </div>
                                                <h2 class="post-title">
                                                    <a href="#">سیاست‌های محیط زیست و نقش آن در توسعه پایدار کشورهای
                                                        منطقه</a>
                                                </h2>
                                                <p class="post-lead">
                                                    تغییرات اقلیمی و چالش‌های زیست‌محیطی، ضرورت بازنگری در سیاست‌های توسعه و
                                                    اتخاذ رویکردهای پایدار را بیش از پیش آشکار ساخته است.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Sidebar Column -->
                <div class="col-lg-4">
                    <!-- Important News Section -->
                    <aside class="post-list-vertical" role="complementary" aria-labelledby="important-news-title">
                        <h3 id="important-news-title" class="visually-hidden">اخبار مهم</h3>
                        <!-- Header with More Button -->
                        <div class="post-list-header">
                            <div class="header-content">
                                <div class="header-text">
                                    <h3 class="post-list-title fw-bold pe-5 pe-lg-4">اخبار مهم</h3>
                                    <p class="post-list-subtitle pe-4">آخرین اخبار و رویدادهای مهم</p>
                                </div>
                                <a href="<?php echo esc_url(get_category_link(8)); ?>" class="more-btn">
                                    <span>بیشتر</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Post Items Container -->
                        <div class="post-items-container">
                            <?php
                            $sidebar_query = new WP_Query([
                                'cat' => 7,
                                'posts_per_page' => 5,
                            ]);
                            if ($sidebar_query->have_posts()) :
                                $post_number = 1;
                                while ($sidebar_query->have_posts()) : $sidebar_query->the_post();
                                    $category = get_the_category();
                                    ?>
                                    <article class="post-item">
                                        <div class="post-number"><?php echo $post_number; ?></div>
                                        <div class="post-content">
                                           
                                            <h3 class="post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="post-meta">
                                                <span class="post-date w-100 justify-content-end">
                                                    <?php echo get_the_date('Y/m/d'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </article>
                                    <?php
                                    $post_number++;
                                endwhile;
                                wp_reset_postdata();
                            else:
                                // Fallback static posts if no posts found
                            ?>
                                <!-- Post Item 1 -->
                                <article class="post-item">
                                    <div class="post-number">۱</div>
                                    <div class="post-content">
                                        <div class="post-category-chip">
                                            <a href="#" class="category-link">اقتصاد</a>
                                        </div>
                                        <h3 class="post-title">
                                            <a href="#">بازیابی سیاست‌های تجارت بین‌الملل و تأثیرات آن بر اقتصاد کشورهای
                                                آفریقایی</a>
                                        </h3>
                                        <div class="post-meta">
                                            <span class="post-date w-100 justify-content-end">
                                                ۱۴۰۳/۰۶/۲۲
                                            </span>
                                        </div>
                                    </div>
                                </article>
                                <!-- Post Item 2 -->
                                <article class="post-item">
                                    <div class="post-number">۲</div>
                                    <div class="post-content">
                                        <div class="post-category-chip">
                                            <a href="#" class="category-link">سیاست</a>
                                        </div>
                                        <h3 class="post-title">
                                            <a href="#">تحلیل روند تغییرات سیاسی در منطقه خاورمیانه و پیامدهای آن برای
                                                ایران</a>
                                        </h3>
                                        <div class="post-meta">
                                            <span class="post-date w-100 justify-content-end">
                                                ۱۴۰۳/۰۶/۲۱
                                            </span>
                                        </div>
                                    </div>
                                </article>
                                <!-- Post Item 3 -->
                                <article class="post-item">
                                    <div class="post-number">۳</div>
                                    <div class="post-content">
                                        <div class="post-category-chip">
                                            <a href="#" class="category-link">فناوری</a>
                                        </div>
                                        <h3 class="post-title">
                                            <a href="#">پیشرفت‌های جدید در حوزه هوش مصنوعی و کاربردهای آن در صنایع مختلف</a>
                                        </h3>
                                        <div class="post-meta">
                                            <span class="post-date w-100 justify-content-end">
                                                ۱۴۰۳/۰۶/۲۰
                                            </span>
                                        </div>
                                    </div>
                                </article>
                                <!-- Post Item 4 -->
                                <article class="post-item">
                                    <div class="post-number">۴</div>
                                    <div class="post-content">
                                        <div class="post-category-chip">
                                            <a href="#" class="category-link">محیط زیست</a>
                                        </div>
                                        <h3 class="post-title">
                                            <a href="#">بررسی تأثیرات تغییرات اقلیمی بر کشاورزی و راهکارهای سازگاری</a>
                                        </h3>
                                        <div class="post-meta">
                                            <span class="post-date w-100 justify-content-end">
                                                ۱۴۰۳/۰۶/۱۹
                                            </span>
                                        </div>
                                    </div>
                                </article>
                            <?php endif; ?>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <!-- Featured Reports Section -->
        <?php get_template_part('template-parts/featured-reports'); ?>

        <!-- Multimedia Section -->
        <?php get_template_part('template-parts/multimedia'); ?>

        <!-- Professional Sessions Section -->
        <?php get_template_part('template-parts/professional-sessions'); ?>

        <!-- Upcoming Events Section -->
        <?php get_template_part('template-parts/upcoming-events'); ?>


        <!-- Publications Section -->
        <?php get_template_part('template-parts/publications'); ?>

        <?php get_template_part('template-parts/educational-courses'); ?>

        <?php get_template_part('template-parts/research-groups'); ?>


    </main>

    <!-- Footer Section -->
   
    <?php
    get_footer();
    ?>

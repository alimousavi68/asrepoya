<?php
/**
 * Template part for displaying educational courses section
 *
 * @package Asrepoya
 */
?>

<!-- Educational Courses Section -->
<section class="courses-grid-section container my-5" aria-labelledby="courses-title">
    <h2 id="courses-title" class="visually-hidden">دوره‌های آموزشی</h2>
    <!-- Section Header -->
    <header class="post-list-header">
        <div class="header-content">
            <div class="header-text">
                <h3 class="post-list-title fw-bold pe-4">دوره‌های آموزشی</h3>
                <p class="post-list-subtitle text-black-50 pe-4">آخرین دوره‌های آموزشی و تخصصی</p>
            </div>
            <a href="<?php echo get_category_link(8); ?>" class="more-btn">
                <span>مشاهده بیشتر</span>
                <i class="fas fa-chevron-left"></i>
            </a>
        </div>
    </header>

    <!-- Courses Grid -->
    <div class="row g-4" role="list" aria-labelledby="courses-grid-title">
        <h3 id="courses-grid-title" class="visually-hidden">فهرست دوره‌های آموزشی</h3>
        
        <?php
        // Query for courses posts from category 8
        $courses_query = new WP_Query(array(
            'cat' => 8,
            'posts_per_page' => 4,
            'orderby' => 'date',
            'order' => 'DESC'
        ));

        if ($courses_query->have_posts()) :
            while ($courses_query->have_posts()) : $courses_query->the_post();
                // Get post thumbnail or use placeholder
                $course_image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                if (!$course_image) {
                    $course_image = 'https://picsum.photos/310/175?random=' . get_the_ID();
                }
                
                // Get custom fields for teacher information (if available)
                $teacher_name = get_post_meta(get_the_ID(), 'teacher_name', true);
                $teacher_avatar = get_post_meta(get_the_ID(), 'teacher_avatar', true);
                $course_date = get_post_meta(get_the_ID(), 'course_date', true);
                
                // Fallback values if custom fields are not set
                if (empty($teacher_name)) {
                    $teacher_name = 'استاد دوره';
                }
                if (empty($teacher_avatar)) {
                    $teacher_avatar = 'https://picsum.photos/310/175?random=' . get_the_ID();
                }
                if (empty($course_date)) {
                    $course_date = 'به زودی';
                }
        ?>
        
        <div class="col-xl-3 col-lg-3 col-md-6 col-12" role="listitem">
            <article class="course-card border bg-white h-100 overflow-hidden">
                <!-- Course Image with Ribbon -->
                <div class="course-image-wrapper position-relative ratio ratio-16x9">
                    <img src="<?php echo esc_url($course_image); ?>" alt="<?php the_title_attribute(); ?>"
                        class="course-image">
                </div>

                <!-- Course Content -->
                <div class="course-content p-3 p-lg-4 d-flex flex-column">
                    <!-- Teacher Meta -->
                    <div class="teacher-meta mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <img src="<?php echo esc_url($teacher_avatar); ?>" alt="<?php echo esc_attr($teacher_name); ?>"
                                class="teacher-avatar rounded-circle">
                            <span class="teacher-text">با تدریس <strong class="teacher-name"><?php echo esc_html($teacher_name); ?></strong></span>
                        </div>
                    </div>

                    <!-- Course Title -->
                    <h3 class="course-title mb-2">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>

                    <!-- Course Description -->
                    <p class="course-description mb-3">
                        <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                    </p>

                    <!-- Course Date -->
                    <div class="course-date mt-auto">
                        <div class="d-flex align-items-center gap-2 text-muted">
                            <i class="fas fa-calendar-alt"></i>
                            <span>شروع: <?php echo esc_html($course_date); ?></span>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        
        <?php
            endwhile;
            wp_reset_postdata();
         endif; ?>
    </div>
</section>
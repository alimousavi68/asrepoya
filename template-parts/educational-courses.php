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
            <a href="<?php echo get_category_link(342); ?>" class="more-btn">
                <span>مشاهده بیشتر</span>
                <i class="fas fa-chevron-left"></i>
            </a>
        </div>
    </header>

    <!-- Courses Grid -->
    <div class="row g-4" role="list" aria-labelledby="courses-grid-title">
        <h3 id="courses-grid-title" class="visually-hidden">فهرست دوره‌های آموزشی</h3>
        
        <?php
        // Query for courses posts from category 342
        $courses_query = new WP_Query(array(
            'cat' => 342,
            'posts_per_page' => 4,
            'orderby' => 'date',
            'order' => 'DESC'
        ));

        if ($courses_query->have_posts()) :
            while ($courses_query->have_posts()) : $courses_query->the_post();
                $post_id = get_the_ID();
                
                // Get post thumbnail or use placeholder
                $course_image = get_the_post_thumbnail_url($post_id, 'medium');
                if (!$course_image) {
                    $course_image = 'https://picsum.photos/310/175?random=' . $post_id;
                }
                
                // Check if this is a course type post using i8 meta
                $post_type = i8_get_post_type($post_id);
                $is_course = i8_is_post_type('course', $post_id);
                
                // Get i8 course meta data
                $instructor = i8_get_meta('i8_course_instructor', $post_id);
                $course_date = i8_get_meta('i8_course_date', $post_id);
                
                // Fallback to old meta fields if i8 fields are not available
                if (empty($instructor)) {
                    $instructor = get_post_meta($post_id, 'teacher_name', true);
                }
                if (empty($course_date)) {
                    $course_date = get_post_meta($post_id, 'course_date', true);
                }
                
                // Get instructor avatar from i8 meta (with fallback to old field)
                $instructor_image_id = i8_get_meta('i8_course_instructor_image', $post_id);
                $instructor_avatar = '';
                
                if ($instructor_image_id) {
                    $instructor_avatar = wp_get_attachment_image_url($instructor_image_id, 'thumbnail');
                }
                
                // Fallback to old meta field
                if (empty($instructor_avatar)) {
                    $instructor_avatar = get_post_meta($post_id, 'teacher_avatar', true);
                }
                
                // Final fallback to placeholder
                if (empty($instructor_avatar)) {
                    $instructor_avatar = 'https://picsum.photos/40/40?random=' . $post_id;
                }
        ?>
        
        <div class="col-xl-3 col-lg-3 col-md-6 col-12" role="listitem">
            <article class="course-card border bg-white h-100 overflow-hidden">
                <!-- Course Image -->
                <div class="course-image-wrapper position-relative ratio ratio-16x9">
                    <img src="<?php echo esc_url($course_image); ?>" alt="<?php the_title_attribute(); ?>"
                        class="course-image">
                </div>

                <!-- Course Content -->
                <div class="course-content p-3 p-lg-4 d-flex flex-column">
                    <?php 
                    // Get main category from i8 meta
                    $main_category = i8_get_post_main_category($post_id);
                    ?>
                    
                
                    
                    <?php if (!empty($instructor)) : ?>
                    <!-- Instructor Meta -->
                    <div class="instructor-meta mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <img src="<?php echo esc_url($instructor_avatar); ?>" alt="<?php echo esc_attr($instructor); ?>"
                                class="instructor-avatar rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                            <div class="instructor-info">
                                <?php if ($is_course) : ?>
                                <!-- Course Type Badge -->
                                
                                <?php endif; ?>
                                <span class="instructor-text">با تدریس <strong class="instructor-name"><?php echo esc_html($instructor); ?></strong></span>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Course Title -->
                    <h4 class="course-title mb-2">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>

                    <!-- Course Description -->
                    <p class="course-description mb-3">
                        <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                    </p>

                    <?php if (!empty($course_date)) : ?>
                    <!-- Course Date -->
                    <div class="course-date mt-auto">
                        <div class="d-flex align-items-center gap-2 text-muted">
                            <i class="fas fa-calendar-alt"></i>
                            <span>
                                <?php 
                                // Format date if it's a valid date
                                if (strtotime($course_date)) {
                                    echo 'شروع: ' . esc_html(date_i18n('j F Y', strtotime($course_date)));
                                } else {
                                    echo 'شروع: ' . esc_html($course_date);
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                    <?php else : ?>
                    <!-- Fallback when no date is available -->
                    <div class="course-date mt-auto">
                        <div class="d-flex align-items-center gap-2 text-muted">
                            <i class="fas fa-calendar-alt"></i>
                            <span>شروع: به زودی</span>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </article>
        </div>
        
        <?php
            endwhile;
            wp_reset_postdata();
         endif; ?>
    </div>
</section>
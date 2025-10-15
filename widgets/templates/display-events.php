<?php
/**
 * Widget Display Template - Events
 * Based on upcoming-events.php structure
 */
?>

<aside class="asrepoya-events-widget">
    <!-- Header -->
    <div class="post-list-header">
        <div class="header-content">
            <div class="header-text">
                <h3 class="post-list-title fw-bold pe-5 pe-lg-4"><?php echo esc_html($title); ?></h3>
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
        'posts_per_page' => $posts_count,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
    
    if ($events_query->have_posts()):
    ?>
    <div class="row g-4 ">
        <?php while ($events_query->have_posts()): $events_query->the_post(); 
            // Get i8 custom meta data
            $post_type = get_post_meta(get_the_ID(), 'i8_post_type', true);
            $event_date_month = get_post_meta(get_the_ID(), 'i8_event_date_month', true);
            $event_date_day = get_post_meta(get_the_ID(), 'i8_event_date_day', true);
            $event_location = get_post_meta(get_the_ID(), 'i8_event_location', true);
            $publication_author = get_post_meta(get_the_ID(), 'i8_publication_author', true);
            $session_host = get_post_meta(get_the_ID(), 'i8_session_host', true);
            $session_position = get_post_meta(get_the_ID(), 'i8_session_position', true);
            $course_instructor = get_post_meta(get_the_ID(), 'i8_course_instructor', true);
        ?>
        <!-- Event Card -->
        <div class="col-12">
            <div class="event-card border bg-white h-100 overflow-hidden">
                <div class="row g-0 align-items-stretch">
                    <!-- Event Image (Right Side) -->
                    <div class="col-md-4">
                        <div class="">
                            <?php if (has_post_thumbnail()): ?>
                            <img src="<?php the_post_thumbnail_url('medium'); ?>"
                                alt="<?php the_title(); ?>"
                                class="event-image">
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Event Content (Left Side) -->
                    <div class="col-md-8 d-flex flex-column justify-content-between pb-0 ps-0">
                        <div>
                            <h3 class="event-title px-2 pt-3">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <p class="event-lead"><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>
                            
                            <?php 
                            // Display author for publications
                            if ($post_type === 'publication' && !empty($publication_author)): ?>
                                <div class="publication-author mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-user me-1" aria-hidden="true"></i>
                                        نویسنده: <?php echo esc_html($publication_author); ?>
                                    </small>
                                </div>
                            <?php endif; ?>
                            
                            <?php 
                            // Display host for professional sessions
                            if ($post_type === 'session' && (!empty($session_host) || !empty($session_position))): ?>
                                <div class="session-host mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-microphone me-1" aria-hidden="true"></i>
                                        <?php if (!empty($session_host)): ?>
                                            میزبان: <?php echo esc_html($session_host); ?>
                                            <?php if (!empty($session_position)): ?>
                                                (<?php echo esc_html($session_position); ?>)
                                            <?php endif; ?>
                                        <?php elseif (!empty($session_position)): ?>
                                            <?php echo esc_html($session_position); ?>
                                        <?php endif; ?>
                                    </small>
                                </div>
                            <?php endif; ?>
                            
                            <?php 
                            // Display instructor for courses
                            if ($post_type === 'course' && !empty($course_instructor)): ?>
                                <div class="course-instructor mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-chalkboard-teacher me-1" aria-hidden="true"></i>
                                        مدرس: <?php echo esc_html($course_instructor); ?>
                                    </small>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="event-meta d-flex align-items-center flex-wrap gap-3 text-muted bg-body-secondary py-0 ps-0">
                            <?php 
                            // Display custom event date if available, otherwise use default
                            if ($post_type === 'event' && (!empty($event_date_day) || !empty($event_date_month))): ?>
                                <span class="event-date d-flex align-items-center p-2 px-4 d-flex flex-column gap-1"
                                      aria-label="تاریخ: <?php echo !empty($event_date_day) ? esc_attr($event_date_day) : ''; ?> <?php echo !empty($event_date_month) ? esc_attr($event_date_month) : ''; ?>">
                                    <?php if (!empty($event_date_day)): ?>
                                        <span class="fw-bold fs-5 text-white"><?php echo esc_html($event_date_day); ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($event_date_month)): ?>
                                        <span class="fw-normal text-white"><?php echo esc_html($event_date_month); ?></span>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>

                            <?php 
                            // Display custom event location if available, otherwise use default
                            if ($post_type === 'event' && !empty($event_location)): ?>
                                <span class="event-location d-flex align-items-center ">
                                    <i class="fas fa-map-marker-alt me-1" aria-hidden="true"></i>
                                    <?php echo esc_html($event_location); ?>
                                </span>
                          
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</aside>
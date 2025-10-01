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
                <a href="<?php echo get_category_link(329); ?>" class="more-btn">
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
                    'cat' => 329,
                    'posts_per_page' => 2,
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($sessions_query->have_posts()):
                    $sessions_query->the_post();
                    $post_id = get_the_ID();
                    
                    // Get i8 session meta data
                    $session_host = i8_get_meta('i8_session_host', $post_id);
                    $session_position = i8_get_meta('i8_session_position', $post_id);
                    $session_field = i8_get_meta('i8_session_field', $post_id);
                    $session_date = i8_get_meta('i8_session_date', $post_id);
                    $session_host_image = i8_get_meta('i8_session_host_image', $post_id);
                    
                    // Check if this is a session type post
                    $is_session = i8_is_post_type('session', $post_id);
                ?>
                <!-- Featured Post Content -->
                <div class="featured-post-content ">
                    <h3 class="featured-post-title text-black">
                        <span class="i8-bullet"><i class="fas fa-chevron-left"></i></span>
                        <a href="<?php the_permalink(); ?>" class="text-black"><?php the_title(); ?></a>
                    </h3>

                    <p class="featured-post-lead text-black-50">
                        <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                    </p>

                    <!-- Session Meta -->
                    <?php if ($is_session && (!empty($session_field) || !empty($session_date))) : ?>
                    <div class="session-meta d-flex flex-wrap align-items-center gap-3 mb-2">
                        <?php if (!empty($session_field)) : ?>
                        <span class="session-field text-black-50 small d-flex align-items-center">
                            <i class="fas fa-hashtag ms-2" style="font-size: 0.75rem;"></i>
                            <?php echo esc_html($session_field); ?>
                        </span>
                        <?php endif; ?>
                        
                        <?php if (!empty($session_date)) : ?>
                        <span class="session-date text-black-50 small d-flex align-items-center">
                            
                            <i class="fa-regular fa-calendar ms-2" aria-hidden="true" style="font-size: 0.75rem;"></i>

                            <?php 
                            // Format the date if it's a valid date
                            $formatted_date = date_i18n('j F Y', strtotime($session_date));
                            echo esc_html($formatted_date);
                            ?>
                        </span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($is_session && !empty($session_host)) : ?>
                    <!-- Host Block -->
                    <div class="host-block">
                        <div class="host-avatar">
                            <?php 
                            $host_image_url = '';
                            if (!empty($session_host_image)) {
                                $host_image_url = wp_get_attachment_image_url($session_host_image, 'thumbnail');
                            }
                            
                            ?>
                            <img src="<?php echo esc_url($host_image_url); ?>" alt="<?php echo esc_attr($session_host); ?>"
                                class="rounded-circle">
                        </div>
                        <div class="host-info">
                            <div class="host-name text-black">میزبان: <?php echo esc_html($session_host); ?></div>
                            <?php if (!empty($session_position)) : ?>
                            <div class="host-role text-black-50"><?php echo esc_html($session_position); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
               
                <?php endif; ?>

                <!-- Divider -->
                <div class="content-divider"></div>

                <!-- Second Post -->
                <?php if ($sessions_query->have_posts() && $sessions_query->current_post + 1 < $sessions_query->post_count): ?>
                <?php $sessions_query->the_post(); ?>
                <div class="second-post">
                    <h4 class="second-post-title">
                                            <span class="i8-bullet"><i class="fas fa-chevron-left"></i></span>

                        <a href="<?php the_permalink(); ?>" class="text-black"><?php the_title(); ?></a>
                    </h4>
                    <!-- Session Meta -->
                    <?php 
                    $second_post_id = get_the_ID();
                    $second_session_field = i8_get_meta('i8_session_field', $second_post_id);
                    $second_session_date = i8_get_meta('i8_session_date', $second_post_id);
                    $second_session_host = i8_get_meta('i8_session_host', $second_post_id);
                    $second_session_position = i8_get_meta('i8_session_position', $second_post_id);
                    $second_session_host_image = i8_get_meta('i8_session_host_image', $second_post_id);
                    $second_is_session = i8_is_post_type('session', $second_post_id);
                    ?>
                    <?php if ($second_is_session && (!empty($second_session_field) || !empty($second_session_date))) : ?>
                    <div class="session-meta d-flex flex-wrap align-items-center gap-3 mb-2">
                        <?php if (!empty($second_session_field)) : ?>
                        <span class="session-field text-black-50 small d-flex align-items-center">
                            <i class="fas fa-hashtag ms-2" style="font-size: 0.75rem;"></i>
                            <?php echo esc_html($second_session_field); ?>
                        </span>
                        <?php endif; ?>
                        
                        <?php if (!empty($second_session_date)) : ?>
                        <span class="session-date text-black-50 small d-flex align-items-center">
                            <i class="fa-regular fa-calendar ms-2" aria-hidden="true" style="font-size: 0.75rem;"></i>
                            <?php 
                            // Format the date if it's a valid date
                            $formatted_date = date_i18n('j F Y', strtotime($second_session_date));
                            echo esc_html($formatted_date);
                            ?>
                        </span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($second_is_session && !empty($second_session_host)) : ?>
                    <!-- Host Block -->
                        <div class="host-block">
                            <div class="host-avatar">
                                <?php 
                                $second_host_image_url = '';
                                if (!empty($second_session_host_image)) {
                                    $second_host_image_url = wp_get_attachment_image_url($second_session_host_image, 'thumbnail');
                                }
                               
                                ?>
                                <img src="<?php echo esc_url($second_host_image_url); ?>" alt="<?php echo esc_attr($second_session_host); ?>"
                                    class="rounded-circle">
                            </div>
                        <div class="host-info">
                            <div class="host-name text-black">میزبان: <?php echo esc_html($second_session_host); ?></div>
                            <?php if (!empty($second_session_position)) : ?>
                            <div class="host-role text-black-50"><?php echo esc_html($second_session_position); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
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
                    'cat' => 329,
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
               
                
                <?php endif;endif; ?>
            </figure>
        </div>
    </div>
</section>
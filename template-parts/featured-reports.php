<?php
/**
 * Template part for displaying featured reports section
 *
 * @package Asrepoya
 */

// Query for reports section - using category "تیتر یک" (ID: 8)
$reports_query = new WP_Query(array(
    'cat' => 328, // Category "تیتر یک"
    'posts_per_page' => 3, // Get 3 posts: 1 main + 2 sidebar
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
));

// Check if we have posts
if ($reports_query->have_posts()):
    $reports_posts = $reports_query->posts;
    $main_post = $reports_posts[0]; // First post for main featured
    $side_posts = array_slice($reports_posts, 1, 2); // Next 2 posts for sidebar
    
    // Get category link for "more" button
    $category_link = get_category_link(328);
?>
<section class="featured-posts-section container" aria-labelledby="featured-reports-title">
    <h2 id="featured-reports-title" class="visually-hidden">گزارش‌های تخصصی</h2>
    <!-- Section Header -->
    <header class="post-list-header">
        <div class="header-content">
            <div class="header-text">
                <h3 class="post-list-title fw-bold pe-5 pe-lg-4">گزارش‌های تخصصی</h3>
                <p class="post-list-subtitle pe-4">آخرین گزارش‌های کارشناسی منتشر شده در اینجا پیدا کنید</p>
            </div>
            <a href="<?php echo esc_url($category_link); ?>" class="more-btn">
                <span>بیشتر</span>
                <i class="fas fa-chevron-left"></i>
            </a>
        </div>
    </header>

    <!-- Reports Content Grid -->
    <div class="row align-items-stretch">
        <!-- Main Featured Report -->
        <div class="col-lg-6 order-lg-1 order-2">
            <article class="featured-post-card">
                <div class="featured-image">
                    <a href="<?php echo get_permalink($main_post->ID); ?>" class="post-image-link">
                        <img src="<?php echo get_the_post_thumbnail_url($main_post->ID, 'large') ?: 'https://picsum.photos/1600/900?random=1'; ?>"
                            alt="<?php echo esc_attr(get_the_title($main_post->ID)); ?>" class="img-fluid">
                    </a>
                </div>
                <div class="featured-content">
                    <h3 class="featured-title">
                        <a href="<?php echo get_permalink($main_post->ID); ?>" class="post-title-link"><?php echo get_the_title($main_post->ID); ?></a>
                    </h3>
                    <p class="featured-lead"><?php echo wp_trim_words(get_the_excerpt($main_post->ID), 30, '...'); ?></p>
                    <div class="d-flex gap-3 justify-content-between flex-row-reverse">
                        <div class="featured-meta">
                            <span class="featured-date">
                                <i class="far fa-calendar-alt"></i>
                                <?php echo get_the_date('j F Y', $main_post->ID); ?>
                            </span>
                        </div>
                        <div class="featured-actions">
                            <a href="<?php echo get_permalink($main_post->ID); ?>" class="action-btn">
                                <span class="btn-text">مطالعه و دانلود </span>
                                <span class="btn-icons">
                                    <i class="fas fa-file-pdf"></i>
                                    <i class="fas fa-file-word"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </div>

        <!-- Small Posts Stack (Left Column) -->
        <div class="col-lg-6 order-lg-2 order-1">
            <div class="small-posts-stack">
                <?php foreach ($side_posts as $index => $side_post): ?>
                <!-- Small Post (Horizontal Layout) -->
                <article class="small-post-<?php echo $index === 0 ? 'a' : 'b'; ?>">
                    <div class="small-post-horizontal">
                        <div class="small-post-image">
                            <a href="<?php echo get_permalink($side_post->ID); ?>" class="post-image-link">
                                <img src="<?php echo get_the_post_thumbnail_url($side_post->ID, 'medium') ?: 'https://picsum.photos/533/300?random=' . ($index + 2); ?>"
                                    alt="<?php echo esc_attr(get_the_title($side_post->ID)); ?>"
                                    class="img-fluid">
                            </a>
                        </div>
                        <div class="small-post-content">
                            <div class="small-post-meta d-flex flex-row justify-content-end">
                                <span class="small-post-date">
                                    <i class="far fa-calendar-alt"></i>
                                    <?php echo get_the_date('j F Y', $side_post->ID); ?>
                                </span>
                            </div>
                            <h4 class="small-post-title">
                                <a href="<?php echo get_permalink($side_post->ID); ?>" class="post-title-link"><?php echo get_the_title($side_post->ID); ?></a>
                            </h4>
                            <p class="small-post-excerpt"><?php echo wp_trim_words(get_the_excerpt($side_post->ID), 20, '...'); ?></p>
                            <div class="featured-actions">
                                <a href="<?php echo get_permalink($side_post->ID); ?>" class="action-btn">
                                    <span class="btn-text">مطالعه و دانلود </span>
                                    <span class="btn-icons">
                                        <i class="fas fa-file-pdf"></i>
                                        <i class="fas fa-file-word"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php
/**
 * 404 Not Found Template
 * Rebuilt with centered content and latest posts below
 *
 * @package Asrepoya
 */

get_header(); ?>

<main class="container-fluid d-flex justify-content-center align-items-start" style="padding-top: var(--spacing-2xl); padding-bottom: var(--spacing-2xl); min-height: 70vh;">
    <!-- Centered Error Box -->
    <section class="error-404 not-found w-100" style="max-width: 900px; background-color: var(--bg-primary); border-radius: var(--border-radius-xl); padding: var(--spacing-2xl);">
        <div class="text-center mb-4">
            <div class="display-1 fw-bold text-center" style="color: var(--accent-color); line-height: var(--line-height-tight); margin-bottom: var(--spacing-lg);">۴۰۴</div>
            <h1 class="h3 text-center mb-3" style="color: var(--primary-color); font-weight: var(--font-weight-bold);">متأسفیم، این صفحه وجود ندارد.</h1>
            <p class="text-muted text-center mb-4" style="font-size: var(--font-size-lg);">اما شما می‌توانید مطالب دیگر ما را مشاهده کنید و لذت ببرید.</p>
            
            <!-- Return Button - Moved here as requested -->
            <div class="text-center mb-5">
                <a href="<?php echo esc_url(home_url()); ?>" class="btn btn-outline-secondary btn-lg px-4 py-2" style="border-radius: var(--border-radius-lg); font-weight: var(--font-weight-medium); color: var(--secondary-color); border-color: var(--secondary-color);">بازگشت به صفحه اصلی</a>
            </div>
            
            <h2 class="h5 text-center mb-4" style="color: var(--primary-color); font-weight: var(--font-weight-semibold);">مطالب پیشنهادی برای شما</h2>
        </div>

        <!-- Latest Posts Grid -->
        <?php
        $recent_query = new WP_Query(array(
            'posts_per_page' => 9,
            'post_status'    => 'publish',
            'ignore_sticky_posts' => true,
        ));
        ?>

        <?php if ($recent_query->have_posts()) : ?>
            <div class="row g-4 justify-content-center">
                <?php while ($recent_query->have_posts()) : $recent_query->the_post(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <article class="d-flex align-items-start p-3 h-100" style="background-color: var(--bg-light); border-radius: var(--border-radius-lg); transition: var(--transition-normal);">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="flex-shrink-0" style="width: 64px; height: 64px; overflow: hidden; margin-left: var(--spacing-lg);">
                                    <?php the_post_thumbnail('thumbnail', array('class' => 'w-100 h-100 object-fit-cover', 'alt' => get_the_title())); ?>
                                </a>
                            <?php endif; ?>
                            <div class="flex-grow-1">
                                <h3 class="h6 mb-2" style="font-weight: var(--font-weight-semibold); line-height: var(--line-height-tight);">
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none" style="color: var(--primary-color); transition: var(--transition-fast);">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <div class="text-muted small" style="font-size: var(--font-size-sm); color: var(--text-secondary);">
                                    <?php echo esc_html(get_the_date('Y/m/d')); ?>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <div class="text-center mt-4">
                <p class="text-muted" style="font-size: var(--font-size-lg); color: var(--text-secondary);">در حال حاضر محتوایی برای نمایش وجود ندارد.</p>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php get_footer();
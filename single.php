<?php

/**
 * The template for displaying single posts
 *
 * @package Asrepoya
 */

get_header(); ?>

<main class="main-content container py-4">
    <div class="row g-4">
        <!-- Main Content Area -->
        <div class="col-lg-8">
            <?php while (have_posts()) : the_post(); ?>

                <?php
                $categories = get_the_category();
                if (!empty($categories)) :
                    $category = $categories[0];
                ?>
                <?php endif; ?>

                <!-- Single Article -->
                <article class="single-article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <!-- Article Header -->
                    <header class="article-header">

                        <!-- Article Meta -->
                        <div class="article-meta d-flex justify-content-between flex-row">
                            <?php if (!empty($categories)) : ?>
                                <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" class="category-badge">
                                    <?php echo esc_html($categories[0]->name); ?>
                                </a>
                            <?php endif; ?>

                            <span class="article-date">
                                <i class="fas fa-calendar-alt"></i>
                                <?php echo get_the_date('Y/m/d'); ?>
                            </span>
                        </div>

                        <!-- Article Title -->
                        <h1 class="article-title"><?php the_title(); ?></h1>



                        <!-- Article Summary/Excerpt -->
                        <?php if (has_excerpt()) : ?>
                            <div class="article-summary">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>
                    </header>

                    <!-- Featured Image -->
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="article-featured-image">
                            <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded']); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Article Content -->
                    <div class="article-content">
                        <?php the_content(); ?>
                    </div>

                    <!-- Article Footer -->
                    <footer class="article-footer">
                        <div class="article-footer-content">
                            <!-- Tags Column -->
                            <?php
                            $tags = get_the_tags();
                            if ($tags) :
                            ?>
                                <div class="article-tags">
                                    <h4>برچسب‌ها:</h4>
                                    <div class="tags-list">
                                        <?php foreach ($tags as $tag) : ?>
                                            <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="tag-link">
                                                <?php echo esc_html($tag->name); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Social Sharing Column -->
                            <div class="social-sharing">
                                <h4>اشتراک‌گذاری:</h4>
                                <div class="social-links">
                                    <a href="https://telegram.me/share/url?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
                                        target="_blank" class="social-link telegram" title="اشتراک در تلگرام">
                                        <i class="fab fa-telegram-plane"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
                                        target="_blank" class="social-link twitter" title="اشتراک در توییتر">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>"
                                        target="_blank" class="social-link linkedin" title="اشتراک در لینکدین">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>"
                                        class="social-link email" title="ارسال ایمیل">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </footer>
                </article>

                <!-- Related Posts -->
                <section class="related-posts">
                    <!-- Header with More Button -->
                    <div class="post-list-header">
                        <div class="header-content">
                            <div class="header-text">
                                <h3 class="post-list-title fw-bold pe-4">مطالب مرتبط</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php
                        $related_posts = new WP_Query([
                            'cat' => $categories[0]->term_id ?? '',
                            'post__not_in' => [get_the_ID()],
                            'posts_per_page' => 3,
                            'orderby' => 'rand'
                        ]);

                        if ($related_posts->have_posts()) :
                            while ($related_posts->have_posts()) : $related_posts->the_post();
                        ?>
                                <div class="col-md-4 mb-4">
                                    <article class="related-post-card">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="related-post-image">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('medium', ['class' => 'img-fluid']); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <div class="related-post-content">
                                            <h4 class="related-post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h4>
                                            <div class="related-post-meta">
                                                <span class="post-date"><?php echo get_the_date('Y/m/d'); ?></span>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </section>

                <!-- Comments Section -->
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4 pt-4 ">
            <div class="position-sticky" style="top:10px;">
                <?php require_once 'sidebar.php'; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
<?php

/**
 * The template for displaying single posts
 *
 * @package Asrepoya
 */

get_header(); ?>

<main class="main-content container d-flex flex-column gap-5 py-4 px-0">
    <div class="row g-4">
        <!-- Main Content Area -->
        <div class="col-lg-8 position-relative">
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

                            
                        </div>
                    </footer>
                </article>

               

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
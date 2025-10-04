<?php
/**
 * The template for displaying archive pages
 *
 * @package Asrepoya
 */

get_header(); ?>

<main class="main-content container d-flex flex-column gap-5 py-4 px-0">
    <div class="row g-4">
        <!-- Main Content Area -->
        <div class="col-lg-8">
            
            <!-- Breadcrumb Navigation -->
            <nav class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo home_url(); ?>">خانه</a>
                    </li>
                    <?php if (is_category()) : ?>
                        <?php
                        $category = get_queried_object();
                        if ($category->parent) {
                            $parent_cat = get_category($category->parent);
                            echo '<li class="breadcrumb-item"><a href="' . get_category_link($parent_cat->term_id) . '">' . $parent_cat->name . '</a></li>';
                        }
                        ?>
                        <li class="breadcrumb-item active">
                            <?php single_cat_title(); ?>
                        </li>
                    <?php elseif (is_tag()) : ?>
                        <li class="breadcrumb-item active">
                            <?php single_tag_title(); ?>
                        </li>
                    <?php elseif (is_author()) : ?>
                        <li class="breadcrumb-item active">
                            <?php the_author(); ?>
                        </li>
                    <?php elseif (is_date()) : ?>
                        <li class="breadcrumb-item active">
                            آرشیو: <?php echo get_the_date('F Y'); ?>
                        </li>
                    <?php else : ?>
                        <li class="breadcrumb-item active">
                            آرشیو
                        </li>
                    <?php endif; ?>
                </ol>
            </nav>

            <!-- Archive Header -->
            <div class="archive-header">
                <div class="archive-header-content">
                    <div class="archive-title-section">
                        <?php if (is_category()) : ?>
                            <h1 class="archive-title"><?php single_cat_title(); ?></h1>
                        <?php else : ?>
                            <?php the_archive_title('<h1 class="archive-title">', '</h1>'); ?>
                        <?php endif; ?>
                        <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
                    </div>
                    <div class="archive-meta-section">
                        <span class="posts-count">
                            <?php
                            global $wp_query;
                            $total_posts = $wp_query->found_posts;
                            echo $total_posts . ' مطلب یافت شد';
                            ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Archive Posts List -->
            <div class="archive-posts-list">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="archive-post-item" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            
                            <!-- Post Content Wrapper -->
                            <div class="post-content-wrapper">
                                
                                <!-- Post Title -->
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>

                                <!-- Post Excerpt -->
                                <div class="post-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                                </div>

                                <!-- Post Meta Bottom -->
                                <div class="post-meta-bottom">
                                    <span class="post-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?php echo get_the_date('Y/m/d'); ?>
                                    </span>
                                    
                                    <!-- Read More Link -->
                                    <a href="<?php the_permalink(); ?>" class="read-more-link">
                                        ادامه مطلب
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Post Thumbnail -->
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                        </article>
                    <?php endwhile; ?>
                <?php else : ?>
                    <!-- No Posts Found -->
                    <div class="no-posts-found">
                        <div class="no-posts-content">
                            <i class="fas fa-search fa-3x"></i>
                            <h3>هیچ مطلبی یافت نشد</h3>
                            <p>متأسفانه در این بخش مطلبی موجود نیست. لطفاً بعداً مراجعه کنید یا از بخش‌های دیگر سایت دیدن کنید.</p>
                            <a href="<?php echo home_url(); ?>" class="btn">بازگشت به صفحه اصلی</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Archive Pagination -->
            <?php if (function_exists('wp_pagenavi')) : ?>
                <div class="archive-pagination">
                    <?php // Safe call to WP-PageNavi if available
                    call_user_func('wp_pagenavi'); ?>
                </div>
            <?php else : ?>
                <div class="archive-pagination">
                    <?php
                    echo paginate_links(array(
                        'prev_text' => '<i class="fas fa-chevron-right"></i>',
                        'next_text' => '<i class="fas fa-chevron-left"></i>',
                    ));
                    ?>
                </div>
            <?php endif; ?>

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
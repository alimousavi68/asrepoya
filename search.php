<?php
/**
 * The template for displaying search results pages
 *
 * @package Asrepoya
 */

get_header(); ?>

<main class="main-content container d-flex flex-column gap-5 py-4 px-0">
    <div class="row g-4">
        <!-- Main Content Area -->
        <div class="col-lg-8">

            <!-- Search Header Box (replaces archive header) -->
            <div class="search-header card shadow-sm border-0 mb-3">
                <div class="card-body p-4">
                    <div class="d-flex flex-column gap-3">
                        <!-- Title & Result Count -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h4 mb-1">نتایج جستجو</h1>
                                <p class="text-muted mb-0">عبارت جستجو: <strong><?php echo esc_html(get_search_query()); ?></strong></p>
                            </div>
                            <div class="badge bg-secondary text-white rounded-pill px-3 py-2">
                                <?php
                                global $wp_query;
                                $total_posts = isset($wp_query->found_posts) ? (int)$wp_query->found_posts : 0;
                                echo esc_html($total_posts) . ' نتیجه';
                                ?>
                            </div>
                        </div>

                        <!-- User-friendly Search Form -->
                        <form role="search" method="get" class="search-form d-flex gap-2" action="<?php echo esc_url(home_url('/')); ?>">
                            <label for="search-input" class="visually-hidden">جستجو</label>
                            <div class="input-group">
                                <input type="search" id="search-input" class="form-control form-control-lg" placeholder="چه چیزی می‌خواهید جستجو کنید؟" value="<?php echo esc_attr(get_search_query()); ?>" name="s" />
                            </div>

                            <!-- Optional filters (category) -->
                            <?php
                            $categories = get_categories(array('hide_empty' => true));
                            if (!empty($categories)) : ?>
                                <select name="cat" class="form-select form-select-lg rounded-0" aria-label="انتخاب دسته‌بندی">
                                    <option value="">همه دسته‌بندی‌ها</option>
                                    <?php foreach ($categories as $cat) : ?>
                                        <option value="<?php echo esc_attr($cat->term_id); ?>" <?php selected(get_query_var('cat'), $cat->term_id); ?>>
                                            <?php echo esc_html($cat->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php endif; ?>

                            <button type="submit" class="btn justify-content-center rounded-0 btn-lg px-4" style="background-color: var(--secondary-color); color: #fff;">
                                <i class="fas fa-search "></i> 
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Search Results List -->
            <div class="archive-posts-list">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="archive-post-item" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="post-content-wrapper">
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="post-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                                </div>
                                <div class="post-meta-bottom">
                                    <span class="post-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?php echo get_the_date('Y/m/d'); ?>
                                    </span>
                                    <a href="<?php the_permalink(); ?>" class="read-more-link">
                                        ادامه مطلب
                                        <i class="fas fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
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
                    <div class="no-posts-found">
                        <div class="no-posts-content">
                            <i class="fas fa-search fa-3x"></i>
                            <h3>موردی یافت نشد</h3>
                            <p>نتیجه‌ای برای عبارت جستجو پیدا نشد. لطفاً عبارت دیگری را امتحان کنید.</p>
                            <a href="<?php echo esc_url(home_url()); ?>" class="btn">بازگشت به صفحه اصلی</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if (function_exists('wp_pagenavi')) : ?>
                <div class="archive-pagination">
                    <?php call_user_func('wp_pagenavi'); ?>
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
        <div class="col-lg-4 pt-4">
            <div class="sticky-sidebar">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
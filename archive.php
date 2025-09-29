<?php
/**
 * The template for displaying archive pages
 *
 * @package Asrepoya
 */

get_header(); ?>

<main class="main-content container-fluid d-flex flex-column gap-5 py-4 px-0">
    <div class="container d-flex">
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
                    <?php wp_pagenavi(); ?>
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
            <!-- Important News Section -->
            <aside class="post-list-vertical bg-white" role="complementary" aria-labelledby="important-news-title">
                <h3 id="important-news-title" class="visually-hidden">اخبار مهم</h3>
                <!-- Header with More Button -->
                <div class="post-list-header">
                    <div class="header-content">
                        <div class="header-text">
                            <h3 class="post-list-title fw-bold pe-4">اخبار مهم</h3>
                            <p class="post-list-subtitle pe-4 text-black">آخرین اخبار و رویدادهای مهم</p>
                        </div>
                        <a href="<?php echo esc_url(get_category_link(8)); ?>" class="more-btn">
                            <span>بیشتر</span>
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </div>
                </div>

                <!-- Post Items Container -->
                <div class="post-items-container">
                    <?php
                    $sidebar_query = new WP_Query([
                        'cat' => 8,
                        'posts_per_page' => 4,
                        'offset' => 3,
                    ]);
                    if ($sidebar_query->have_posts()) :
                        $post_number = 1;
                        while ($sidebar_query->have_posts()) : $sidebar_query->the_post();
                            $category = get_the_category();
                    ?>
                            <article class="post-item">
                                <div class="post-number"><?php echo $post_number; ?></div>
                                <div class="post-content">
                                    <div class="post-category-chip">
                                        <?php if (!empty($category)) : ?>
                                            <a href="<?php echo esc_url(get_category_link($category[0]->term_id)); ?>" class="category-link"><?php echo esc_html($category[0]->name); ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="post-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="post-meta">
                                        <span class="post-date w-100 justify-content-end">
                                            <?php echo get_the_date('Y/m/d'); ?>
                                        </span>
                                    </div>
                                </div>
                            </article>
                        <?php
                            $post_number++;
                        endwhile;
                        wp_reset_postdata();
                    else:
                        // Fallback static posts if no posts found
                        ?>
                        <!-- Post Item 1 -->
                        <article class="post-item">
                            <div class="post-number">۱</div>
                            <div class="post-content">
                                <div class="post-category-chip">
                                    <a href="#" class="category-link">اقتصاد</a>
                                </div>
                                <h3 class="post-title">
                                    <a href="#">بازیابی سیاست‌های تجارت بین‌الملل و تأثیرات آن بر اقتصاد کشورهای آفریقایی</a>
                                </h3>
                                <div class="post-meta">
                                    <span class="post-date w-100 justify-content-end">
                                        ۱۴۰۳/۰۶/۲۲
                                    </span>
                                </div>
                            </div>
                        </article>
                        <!-- Post Item 2 -->
                        <article class="post-item">
                            <div class="post-number">۲</div>
                            <div class="post-content">
                                <div class="post-category-chip">
                                    <a href="#" class="category-link">سیاست</a>
                                </div>
                                <h3 class="post-title">
                                    <a href="#">تحلیل روند تغییرات سیاسی در منطقه خاورمیانه و پیامدهای آن برای ایران</a>
                                </h3>
                                <div class="post-meta">
                                    <span class="post-date w-100 justify-content-end">
                                        ۱۴۰۳/۰۶/۲۱
                                    </span>
                                </div>
                            </div>
                        </article>
                        <!-- Post Item 3 -->
                        <article class="post-item">
                            <div class="post-number">۳</div>
                            <div class="post-content">
                                <div class="post-category-chip">
                                    <a href="#" class="category-link">فناوری</a>
                                </div>
                                <h3 class="post-title">
                                    <a href="#">پیشرفت‌های جدید در حوزه هوش مصنوعی و کاربردهای آن در صنایع مختلف</a>
                                </h3>
                                <div class="post-meta">
                                    <span class="post-date w-100 justify-content-end">
                                        ۱۴۰۳/۰۶/۲۰
                                    </span>
                                </div>
                            </div>
                        </article>
                        <!-- Post Item 4 -->
                        <article class="post-item">
                            <div class="post-number">۴</div>
                            <div class="post-content">
                                <div class="post-category-chip">
                                    <a href="#" class="category-link">محیط زیست</a>
                                </div>
                                <h3 class="post-title">
                                    <a href="#">بررسی تأثیرات تغییرات اقلیمی بر کشاورزی و راهکارهای سازگاری</a>
                                </h3>
                                <div class="post-meta">
                                    <span class="post-date w-100 justify-content-end">
                                        ۱۴۰۳/۰۶/۱۹
                                    </span>
                                </div>
                            </div>
                        </article>
                    <?php endif; ?>
                </div>
            </aside>

            <!-- Archive Search Widget -->
            <aside class="archive-search-widget bg-white mt-4" role="complementary">
                <h3 id="important-news-title" class="visually-hidden">اخبار مهم</h3>
                <div class="widget-content">
                    <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                        <div class="search-input-group">
                            <input type="search" class="search-field" placeholder="جستجو..." value="<?php echo get_search_query(); ?>" name="s" />
                            <button type="submit" class="search-submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- Categories Widget -->
            <aside class="categories-widget bg-white mt-4" role="complementary">
                <h3 class="visually-hidden">اخبار مهم</h3>
                <div class="widget-content">
                    <ul class="categories-list">
                        <?php
                        $categories = get_categories([
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'number' => 8,
                            'hide_empty' => true,
                        ]);
                        foreach ($categories as $category) :
                        ?>
                            <li class="category-item">
                                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="category-link">
                                    <?php echo esc_html($category->name); ?>
                                    <span class="post-count">(<?php echo $category->count; ?>)</span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</main>

<?php get_footer(); ?>
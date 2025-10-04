<?php
/**
 * Widget Display Template - Style 1
 * Exactly like single.php lines 179-301
 */

// Get category object for the more link
$category_obj = null;
if ($category_id > 0) {
    $category_obj = get_category($category_id);
}
?>

<aside class="asrepoya-posts-widget style-1">
    <!-- Header with More Button -->
    <div class="post-list-header">
        <div class="header-content">
            <div class="header-text">
                <h3 class="post-list-title fw-bold pe-4"><?php echo esc_html($title); ?></h3>
                <p class="post-list-subtitle pe-4 text-black"><?php echo esc_html($subtitle); ?></p>
            </div>
            <?php if ($show_more_link && $category_obj): ?>
                <a href="<?php echo esc_url(get_category_link($category_id)); ?>" class="more-btn">
                    <span>بیشتر</span>
                    <i class="fas fa-chevron-left"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Post Items Container -->
    <div class="post-items-container">
        <?php
        $query_args = array(
            'posts_per_page' => $posts_count,
            'post_status' => 'publish'
        );
        
        if ($category_id > 0) {
            $query_args['cat'] = $category_id;
        }
        
        $widget_query = new WP_Query($query_args);
        
        if ($widget_query->have_posts()) :
            $post_number = 1;
            while ($widget_query->have_posts()) : $widget_query->the_post();
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
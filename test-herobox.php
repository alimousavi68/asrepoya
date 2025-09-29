<?php
/**
 * Test Herobox Section
 * This script tests the dynamic Herobox implementation
 */

// Include WordPress
require_once('../../../../wp-load.php');

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Herobox Section</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .status { padding: 10px; margin: 10px 0; border-radius: 5px; }
        .success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .info { background-color: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }
        .herobox-output { border: 1px solid #ccc; padding: 15px; margin: 20px 0; background: #f9f9f9; }
        pre { background: #f4f4f4; padding: 10px; overflow-x: auto; }
    </style>
</head>
<body>
    <h1>Herobox Section Test</h1>
    
    <?php
    // Check if category exists
    $category = get_category_by_slug('important-news');
    if ($category) {
        echo '<div class="status success">✓ دسته "important-news" پیدا شد: ' . esc_html($category->name) . ' (ID: ' . $category->term_id . ')</div>';
        
        // Check posts in category
        $hero_query = new WP_Query([
            'category_name' => 'important-news',
            'posts_per_page' => 3,
        ]);
        
        if ($hero_query->have_posts()) {
            echo '<div class="status success">✓ ' . $hero_query->found_posts . ' پست در دسته مهم پیدا شد</div>';
            
            echo '<h3>پست‌های اسلایدر اصلی:</h3>';
            echo '<ul>';
            while ($hero_query->have_posts()) : $hero_query->the_post();
                echo '<li>';
                echo '<strong>' . get_the_title() . '</strong>';
                echo ' - تاریخ: ' . get_the_date('Y/m/d');
                echo ' - دسته: ';
                $categories = get_the_category();
                if (!empty($categories)) {
                    echo esc_html($categories[0]->name);
                }
                echo '</li>';
            endwhile;
            echo '</ul>';
            wp_reset_postdata();
            
            // Check sidebar posts
            $sidebar_query = new WP_Query([
                'category_name' => 'important-news',
                'posts_per_page' => 4,
                'offset' => 3,
            ]);
            
            if ($sidebar_query->have_posts()) {
                echo '<h3>پست‌های نوار کناری:</h3>';
                echo '<ul>';
                while ($sidebar_query->have_posts()) : $sidebar_query->the_post();
                    echo '<li>';
                    echo '<strong>' . get_the_title() . '</strong>';
                    echo ' - تاریخ: ' . get_the_date('Y/m/d');
                    echo ' - دسته: ';
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo esc_html($categories[0]->name);
                    }
                    echo '</li>';
                endwhile;
                echo '</ul>';
                wp_reset_postdata();
            } else {
                echo '<div class="status info">ℹ پستی برای نوار کناری پیدا نشد (افست: 3)</div>';
            }
            
        } else {
            echo '<div class="status error">✗ هیچ پستی در دسته مهم پیدا نشد</div>';
        }
        
    } else {
        echo '<div class="status error">✗ دسته "important-news" پیدا نشد</div>';
        echo '<div class="status info">ℹ برای استفاده از بخش Herobox داینامیک، باید دسته‌ای با نام "important-news" ایجاد کنید.</div>';
    }
    ?>
    
    <h2>راهنمای ایجاد دسته:</h2>
    <ol>
        <li>به پیشخوان وردپرس بروید</li>
        <li>به بخش "نوشته‌ها" → "دسته‌ها" بروید</li>
        <li>دسته جدیدی با نام "اخبار مهم" و نامک (slug) "important-news" ایجاد کنید</li>
        <li>چند پست در این دسته ایجاد کنید</li>
        <li>برای پست‌ها تصویر شاخص (featured image) اضافه کنید</li>
    </ol>
    
    <h2>نمایش زنده Herobox:</h2>
    <div class="herobox-output">
        <p>برای مشاهده نتیجه، به صفحه اصلی سایت بروید:</p>
        <a href="/" target="_blank">مشاهده صفحه اصلی</a>
    </div>
</body>
</html>
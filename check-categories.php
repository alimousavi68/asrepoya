<?php
/**
 * Check Categories
 */
require_once('../../../../wp-load.php');

header('Content-Type: text/html; charset=UTF-8');

echo '<h1>بررسی دسته‌ها</h1>';

// Get all categories
$categories = get_categories(['hide_empty' => false]);
if ($categories) {
    echo '<h2>همه دسته‌ها:</h2>';
    echo '<ul>';
    foreach ($categories as $category) {
        echo '<li>';
        echo '<strong>' . esc_html($category->name) . '</strong>';
        echo ' - نامک: ' . esc_html($category->slug);
        echo ' - تعداد پست‌ها: ' . $category->count;
        echo ' - ID: ' . $category->term_id;
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>هیچ دسته‌ای پیدا نشد.</p>';
}

// Check specific category
$important_news = get_category_by_slug('important-news');
if ($important_news) {
    echo '<h2>دسته "important-news" پیدا شد:</h2>';
    echo '<pre>';
    print_r($important_news);
    echo '</pre>';
    
    // Check posts in this category
    $posts = get_posts([
        'category' => $important_news->term_id,
        'numberposts' => -1,
    ]);
    
    echo '<h3>پست‌های این دسته:</h3>';
    if ($posts) {
        echo '<ul>';
        foreach ($posts as $post) {
            echo '<li>';
            echo '<strong>' . esc_html($post->post_title) . '</strong>';
            echo ' - تاریخ: ' . get_the_date('Y/m/d', $post->ID);
            echo ' - وضعیت: ' . $post->post_status;
            echo ' - تصویر شاخص: ' . (has_post_thumbnail($post->ID) ? 'دارد' : 'ندارد');
            echo '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>هیچ پستی در این دسته پیدا نشد.</p>';
    }
} else {
    echo '<h2>دسته "important-news" پیدا نشد!</h2>';
    echo '<p>برای استفاده از Herobox داینامیک، باید دسته‌ای با نامک "important-news" ایجاد کنید.</p>';
}

echo '<hr>';
echo '<p>راهنمای ایجاد دسته:</p>';
echo '<ol>';
echo '<li>به پیشخوان وردپرس بروید</li>';
echo '<li>به بخش "نوشته‌ها" → "دسته‌ها" بروید</li>';
echo '<li>دسته جدیدی با نام "اخبار مهم" و نامک "important-news" ایجاد کنید</li>';
echo '<li>چند پست در این دسته ایجاد کنید</li>';
echo '<li>برای پست‌ها تصویر شاخص اضافه کنید</li>';
echo '</ol>';

?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بررسی دسته‌ها</title>
    <style>
        body { font-family: Tahoma, Arial, sans-serif; margin: 20px; direction: rtl; }
        h1, h2, h3 { color: #333; }
        ul { background: #f9f9f9; padding: 15px; border-radius: 5px; }
        li { margin: 5px 0; }
        pre { background: #f4f4f4; padding: 10px; overflow-x: auto; border-radius: 5px; }
        .error { color: #d63384; }
        .success { color: #198754; }
    </style>
</head>
<body>
</body>
</html>
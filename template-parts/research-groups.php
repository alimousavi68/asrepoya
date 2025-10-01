<?php
/**
 * Template part for displaying research groups section
 *
 * @package Asrepoya
 */
?>

<!-- Research Groups Section -->
<section class="research-groups-section" aria-labelledby="research-groups-title">
    <div class="container">
        <h2 id="research-groups-title" class="visually-hidden">گروه‌های پژوهشی</h2>
        <!-- Section Header -->
        <header class="post-list-header">
            <div class="header-content">
                <div class="header-text">
                    <h3 class="post-list-title fw-bold pe-4">گروه های پژوهشی</h3>
                    <p class="post-list-subtitle text-black-50 pe-4">آخرین رویدادهای عصر پویا</p>
                </div>
                <a href="#" class="more-btn">
                    <span>بیشتر</span>
                    <i class="fas fa-chevron-left"></i>
                </a>
            </div>
        </header>

        <!-- Research Groups Cards -->
         <div class="container">
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-5" role="list">
                <?php
                $menu_items = wp_get_nav_menu_items(get_nav_menu_locations()['research-groups']);
                if ($menu_items) {
                    foreach ($menu_items as $item) {
                        $icon = get_post_meta($item->ID, '_menu_item_icon', true);
                        $description = get_post_meta($item->ID, '_menu_item_description', true);
                        ?>
                        <div class="col" role="listitem">
                            <article class="research-group-card" aria-label="گروه پژوهشی: <?php echo esc_attr($item->title); ?>">
                                <div class="icon-circle">
                                    <?php echo $icon ? $icon : '<i class="fas fa-folder"></i>'; ?>
                                </div>
                                <h3 class="card-title"><?php echo esc_html($item->title); ?></h3>
                                <p class="card-description"><?php echo esc_html($description); ?></p>
                            </article>
                        </div>
                        <?php
                    }
                }
                else{
                    echo '<p>محتوایی وجود ندارد</p>';
                }
                ?>
            </div>
        </div>
    </div>
</section>
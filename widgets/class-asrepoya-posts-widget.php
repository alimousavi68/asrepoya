<?php
/**
 * Asrepoya Posts Widget
 * 
 * A multi-purpose widget for displaying posts with configurable settings
 * and three different display modes.
 *
 * @package Asrepoya
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class Asrepoya_Posts_Widget extends WP_Widget {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct(
            'asrepoya_posts_widget',
            __('ویجت پست‌های عصر پویا', 'asrepoya'),
            array(
                'description' => __('ویجت چندمنظوره برای نمایش پست‌ها با سه مدل نمایش مختلف', 'asrepoya'),
                'classname' => 'asrepoya-posts-widget'
            )
        );
    }

    /**
     * Front-end display of widget
     */
    public function widget($args, $instance) {
        // Get widget settings
        $title = !empty($instance['title']) ? $instance['title'] : 'اخبار مهم';
        $subtitle = !empty($instance['subtitle']) ? $instance['subtitle'] : 'آخرین اخبار و رویدادهای مهم';
        $posts_count = !empty($instance['posts_count']) ? absint($instance['posts_count']) : 4;
        $category_id = !empty($instance['category_id']) ? absint($instance['category_id']) : 8;
        $display_style = !empty($instance['display_style']) ? $instance['display_style'] : 'style_1';
        $show_more_link = isset($instance['show_more_link']) ? (bool) $instance['show_more_link'] : true;

        echo $args['before_widget'];

        // Include the appropriate display template
        $template_file = get_template_directory() . '/widgets/templates/display-' . $display_style . '.php';
        
        if (file_exists($template_file)) {
            include $template_file;
        } else {
            // Fallback to style 1
            include get_template_directory() . '/widgets/templates/display-style_1.php';
        }

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form
     */
    public function form($instance) {
        // Default values
        $title = !empty($instance['title']) ? $instance['title'] : 'اخبار مهم';
        $subtitle = !empty($instance['subtitle']) ? $instance['subtitle'] : 'آخرین اخبار و رویدادهای مهم';
        $posts_count = !empty($instance['posts_count']) ? absint($instance['posts_count']) : 4;
        $category_id = !empty($instance['category_id']) ? absint($instance['category_id']) : 8;
        $display_style = !empty($instance['display_style']) ? $instance['display_style'] : 'style_1';
        $show_more_link = isset($instance['show_more_link']) ? (bool) $instance['show_more_link'] : true;

        // Get all categories for dropdown
        $categories = get_categories(array('hide_empty' => false));
        ?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('عنوان ویجت:', 'asrepoya'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" 
                   value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('subtitle')); ?>"><?php _e('زیرعنوان ویجت:', 'asrepoya'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('subtitle')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('subtitle')); ?>" type="text" 
                   value="<?php echo esc_attr($subtitle); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('posts_count')); ?>"><?php _e('تعداد پست‌ها:', 'asrepoya'); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('posts_count')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('posts_count')); ?>" type="number" 
                   step="1" min="1" max="20" value="<?php echo esc_attr($posts_count); ?>" size="3">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('category_id')); ?>"><?php _e('دسته‌بندی:', 'asrepoya'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('category_id')); ?>" 
                    name="<?php echo esc_attr($this->get_field_name('category_id')); ?>">
                <option value="0"><?php _e('همه دسته‌بندی‌ها', 'asrepoya'); ?></option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo esc_attr($category->term_id); ?>" 
                            <?php selected($category_id, $category->term_id); ?>>
                        <?php echo esc_html($category->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('display_style')); ?>"><?php _e('نوع نمایش:', 'asrepoya'); ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('display_style')); ?>" 
                    name="<?php echo esc_attr($this->get_field_name('display_style')); ?>">
                <option value="style_1" <?php selected($display_style, 'style_1'); ?>>
                    <?php _e('مدل اول - فهرست شماره‌دار', 'asrepoya'); ?>
                </option>
                <option value="style_2" <?php selected($display_style, 'style_2'); ?>>
                    <?php _e('مدل دوم - با عکس کنار محتوا', 'asrepoya'); ?>
                </option>
                <option value="style_3" <?php selected($display_style, 'style_3'); ?>>
                    <?php _e('مدل سوم - با عکس در بالا', 'asrepoya'); ?>
                </option>
            </select>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_more_link); ?> 
                   id="<?php echo esc_attr($this->get_field_id('show_more_link')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('show_more_link')); ?>">
            <label for="<?php echo esc_attr($this->get_field_id('show_more_link')); ?>">
                <?php _e('نمایش لینک "بیشتر"', 'asrepoya'); ?>
            </label>
        </p>

        <?php
    }

    /**
     * Sanitize widget form values as they are saved
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['subtitle'] = (!empty($new_instance['subtitle'])) ? sanitize_text_field($new_instance['subtitle']) : '';
        $instance['posts_count'] = (!empty($new_instance['posts_count'])) ? absint($new_instance['posts_count']) : 4;
        $instance['category_id'] = (!empty($new_instance['category_id'])) ? absint($new_instance['category_id']) : 0;
        $instance['display_style'] = (!empty($new_instance['display_style'])) ? sanitize_text_field($new_instance['display_style']) : 'style_1';
        $instance['show_more_link'] = isset($new_instance['show_more_link']) ? (bool) $new_instance['show_more_link'] : false;

        return $instance;
    }
}
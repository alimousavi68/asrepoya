<?php
/**
 * Asrepoya Events Widget
 * 
 * A widget for displaying latest events from category 330
 * with single column layout for sidebar usage.
 *
 * @package Asrepoya
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class Asrepoya_Events_Widget extends WP_Widget {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct(
            'asrepoya_events_widget',
            __('ویجت رویدادهای عصر پویا', 'asrepoya'),
            array(
                'description' => __('ویجت نمایش آخرین رویدادها برای سایدبار', 'asrepoya'),
                'classname' => 'asrepoya-events-widget'
            )
        );
    }

    /**
     * Front-end display of widget
     */
    public function widget($args, $instance) {
        // Get widget settings
        $title = !empty($instance['title']) ? $instance['title'] : 'رویدادهای پیش رو';
        $posts_count = !empty($instance['posts_count']) ? absint($instance['posts_count']) : 3;

        echo $args['before_widget'];

        // Include the display template
        $template_file = get_template_directory() . '/widgets/templates/display-events.php';
        
        if (file_exists($template_file)) {
            include $template_file;
        }

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form
     */
    public function form($instance) {
        // Default values
        $title = !empty($instance['title']) ? $instance['title'] : 'رویدادهای پیش رو';
        $posts_count = !empty($instance['posts_count']) ? absint($instance['posts_count']) : 3;
        ?>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('عنوان ویجت:', 'asrepoya'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" 
                   value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('posts_count')); ?>"><?php _e('تعداد رویدادها:', 'asrepoya'); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('posts_count')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('posts_count')); ?>" type="number" 
                   step="1" min="1" max="10" value="<?php echo esc_attr($posts_count); ?>" size="3">
        </p>

        <?php
    }

    /**
     * Sanitize widget form values as they are saved
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['posts_count'] = (!empty($new_instance['posts_count'])) ? absint($new_instance['posts_count']) : 3;

        return $instance;
    }
}
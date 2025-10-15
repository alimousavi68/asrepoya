<?php
/**
 * Widget Initialization
 * 
 * Register and initialize all custom widgets
 *
 * @package Asrepoya
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Asrepoya Posts Widget
 */
function asrepoya_register_posts_widget() {
    register_widget('Asrepoya_Posts_Widget');
}
add_action('widgets_init', 'asrepoya_register_posts_widget');

/**
 * Register Asrepoya Events Widget
 */
function asrepoya_register_events_widget() {
    register_widget('Asrepoya_Events_Widget');
}
add_action('widgets_init', 'asrepoya_register_events_widget');

/**
 * Load widget classes
 */
function asrepoya_load_widgets() {
    require_once get_template_directory() . '/widgets/class-asrepoya-posts-widget.php';
    require_once get_template_directory() . '/widgets/class-asrepoya-events-widget.php';
}
add_action('after_setup_theme', 'asrepoya_load_widgets');

/**
 * Enqueue widget styles
 */
function asrepoya_widget_styles() {
    if (is_active_widget(false, false, 'asrepoya_posts_widget') || 
        is_active_widget(false, false, 'asrepoya_events_widget')) {
        wp_enqueue_style(
            'asrepoya-widget-styles',
            get_template_directory_uri() . '/widgets/assets/widget-styles.css',
            array(),
            '1.0.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'asrepoya_widget_styles');
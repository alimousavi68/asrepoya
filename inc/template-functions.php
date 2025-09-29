<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Asrepoya
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function asrepoya_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter( 'body_class', 'asrepoya_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function asrepoya_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">\n', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'asrepoya_pingback_header' );

/**
 * Change the excerpt length
 */
function asrepoya_excerpt_length( $length ) {
    return 55;
}
add_filter( 'excerpt_length', 'asrepoya_excerpt_length', 999 );

/**
 * Change the excerpt more text
 */
function asrepoya_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'asrepoya_excerpt_more' );
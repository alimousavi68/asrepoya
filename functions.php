<?php
/**
 * Asrepoya functions and definitions
 *
 * @package Asrepoya
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function asrepoya_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Asrepoya, use a find and replace
     * to change 'asrepoya' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'asrepoya', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'primary' => esc_html__( 'Primary Menu', 'asrepoya' ),
            'footer'  => esc_html__( 'Footer Menu', 'asrepoya' ),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'asrepoya_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );

    // Add support for responsive embedded content.
    add_theme_support( 'responsive-embeds' );

    // Add support for custom line height controls.
    add_theme_support( 'custom-line-height' );

    // Add support for experimental link color control.
    add_theme_support( 'experimental-link-color' );

    // Add support for experimental cover block spacing.
    add_theme_support( 'experimental-cover-block-spacing' );

    // Add support for custom units.
    add_theme_support( 'custom-units' );
}
add_action( 'after_setup_theme', 'asrepoya_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function asrepoya_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'asrepoya_content_width', 1140 );
}
add_action( 'after_setup_theme', 'asrepoya_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function asrepoya_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'asrepoya' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'asrepoya' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer Widget Area', 'asrepoya' ),
            'id'            => 'footer-1',
            'description'   => esc_html__( 'Add widgets here.', 'asrepoya' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'asrepoya_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function asrepoya_scripts() {
    // Theme stylesheet.
    wp_enqueue_style( 'asrepoya-style', get_stylesheet_uri(), array(), '1.0.0' );
    
    // Theme main stylesheet.
    wp_enqueue_style( 'asrepoya-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0' );
    
    // Social media styles.
    wp_enqueue_style( 'asrepoya-social-media', get_template_directory_uri() . '/assets/css/social-media.css', array(), '1.0.0' );

    // Theme script.
    wp_enqueue_script( 'asrepoya-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );

    // Comment reply script.
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'asrepoya_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add SVG support to WordPress
 */

// Allow SVG upload
function asrepoya_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'asrepoya_mime_types');

// Fix SVG display in media library
function asrepoya_fix_svg_display() {
    echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        .attachment img[src$=".svg"] {
            width: 100% !important;
            height: auto !important;
        }
    </style>';
}
add_action('admin_head', 'asrepoya_fix_svg_display');

// Sanitize SVG content
function asrepoya_sanitize_svg_upload($file) {
    if ($file['type'] === 'image/svg+xml') {
        // Check if the file contains malicious content
        $svg_content = file_get_contents($file['tmp_name']);
        
        // Remove potentially dangerous elements
        $dangerous_elements = array(
            'script',
            'foreignObject',
            'animate',
            'animateMotion',
            'animateTransform',
            'set'
        );
        
        foreach ($dangerous_elements as $element) {
            $svg_content = preg_replace('/<' . $element . '[^>]*>.*?<\/'. $element .'>/is', '', $svg_content);
        }
        
        // Remove javascript: and data: protocols
        $svg_content = preg_replace('/(?:href|xlink:href)\s*=\s*["\']?(?:javascript|data):[^"\']*["\']?/i', '', $svg_content);
        
        // Save sanitized content
        file_put_contents($file['tmp_name'], $svg_content);
    }
    
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'asrepoya_sanitize_svg_upload');

/**
 * Custom walker class for displaying Bootstrap navigation menu - EXACT MATCH to original HTML
 */
class Asrepoya_Nav_Walker extends Walker_Nav_Menu {
    
    /**
     * Starts the list of after elements are added - EXACT MATCH to original HTML
     */
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    /**
     * Starts the element output - EXACT MATCH to original HTML structure
     */
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        
        // Add px-2 class to nav items for exact match
        if ( $depth === 0 ) {
            $classes[] = 'nav-item';
            $classes[] = 'px-2';
            // Add dropdown class for items with children to enable hover
            if ( in_array( 'menu-item-has-children', $classes ) ) {
                $classes[] = 'dropdown';
            }
        }
        
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $output .= '<li' . $class_names . '>';

        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

        // Build link classes
        $link_classes = array();
        
        if ( $depth === 0 ) {
            $link_classes[] = 'nav-link';
            // Add active class
            if ( $item->current || $item->current_item_ancestor ) {
                $link_classes[] = 'active';
            }
            // Add dropdown classes for top-level items with children
            if ( in_array( 'menu-item-has-children', $item->classes ) ) {
                $link_classes[] = 'dropdown-toggle';
                $link_classes[] = 'd-flex';
                $link_classes[] = 'align-items-center';
                // Remove Bootstrap click behavior to enable hover-only dropdown
                // $attributes .= ' data-bs-toggle="dropdown"';
                // $attributes .= ' aria-expanded="false"';
            }
        } else {
            // Submenu items
            if ( $item->type === 'custom' && $item->title === '-' ) {
                // This is a divider
                $output .= '<hr class="dropdown-divider">';
                return;
            } elseif ( $item->type === 'custom' && strpos( $item->title, 'header:' ) === 0 ) {
                // This is a header
                $header_text = substr( $item->title, 7 );
                $output .= '<h6 class="dropdown-header">' . esc_html( $header_text ) . '</h6>';
                return;
            } else {
                $link_classes[] = 'dropdown-item';
            }
        }
        
        $link_class_names = join( ' ', $link_classes );
        $attributes .= ' class="' . esc_attr( $link_class_names ) . '"';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * Display the primary navigation menu - DYNAMIC with exact structure match
 * 
 * This function now connects to WordPress Primary Menu location while maintaining
 * the exact original HTML structure. It uses a custom walker to handle headers/dividers.
 */
function asrepoya_primary_menu() {
    if ( has_nav_menu( 'primary' ) ) {
        // Use WordPress menu with custom walker to maintain exact structure
        wp_nav_menu( array(
            'theme_location'  => 'primary',
            'depth'           => 3,
            'container'       => 'nav',
            'container_class' => 'nav-section',
            'container_id'    => '',
            'menu_class'      => 'main-nav d-flex list-unstyled m-0',
            'fallback_cb'     => false,
            'walker'          => new Asrepoya_Nav_Walker(),
            'role'            => 'navigation',
        ) );
    } else {
        // Fallback menu - EXACT MATCH to original HTML structure
        echo '<nav class="nav-section">';
        echo '<ul class="main-nav d-flex list-unstyled m-0">';
        echo '<li class="nav-item"><a href="' . esc_url( home_url('/') ) . '" class="nav-link">خانه</a></li>';
        echo '</ul>';
        echo '</nav>';
    }
}



// در functions.php تم اضافه کنید
add_action('init', function() {
    register_nav_menu('research-groups', 'منوی گروه‌های پژوهشی');
});

// اضافه کردن فیلدهای سفارشی به آیتم‌های منو
add_action('wp_nav_menu_item_custom_fields', function($item_id) {
    $icon = get_post_meta($item_id, '_menu_item_icon', true);
    $description = get_post_meta($item_id, '_menu_item_description', true);
    ?>
    <div class="field-icon">
        <label for="edit-menu-item-icon-<?php echo $item_id; ?>">آیکون SVG:</label>
        <textarea id="edit-menu-item-icon-<?php echo $item_id; ?>" 
                  name="menu-item-icon[<?php echo $item_id; ?>]"><?php echo esc_textarea($icon); ?></textarea>
    </div>
    <div class="field-description">
        <label for="edit-menu-item-description-<?php echo $item_id; ?>">توضیحات:</label>
        <input type="text" id="edit-menu-item-description-<?php echo $item_id; ?>"
               name="menu-item-description[<?php echo $item_id; ?>]"
               value="<?php echo esc_attr($description); ?>" />
    </div>
    <?php
});
// ذخیره فیلدهای سفارشی
add_action('wp_update_nav_menu_item', function($menu_id, $menu_item_id) {
    if (isset($_POST['menu-item-icon'][$menu_item_id])) {
        update_post_meta($menu_item_id, '_menu_item_icon', $_POST['menu-item-icon'][$menu_item_id]);
    }
    if (isset($_POST['menu-item-description'][$menu_item_id])) {
        update_post_meta($menu_item_id, '_menu_item_description', $_POST['menu-item-description'][$menu_item_id]);
    }
}, 10, 2);


//  add images sizes 
// Add custom image sizes
add_action( 'after_setup_theme', function() {
    // Hero banner size
    add_image_size( 'hero-banner', 850, 510, true );

    // // Research card size
    // add_image_size( 'research-card', 600, 400, true );

    // // News thumbnail size
    // add_image_size( 'news-thumb', 400, 250, true );

    // // Team member portrait
    // add_image_size( 'team-portrait', 300, 300, true );

    // // Project gallery size
    // add_image_size( 'project-gallery', 800, 600, true );

    // // Publication cover size
    // add_image_size( 'publication-cover', 250, 350, true );
} );

/**
 * Custom Meta Box for Posts - i8 Post Details
 * 
 * This meta box provides dynamic fields based on post type selection
 * All meta fields use i8_ prefix as requested
 */

// Add meta box
add_action( 'add_meta_boxes', 'i8_add_post_details_meta_box' );

function i8_add_post_details_meta_box() {
    add_meta_box(
        'i8_post_details',           // Meta box ID
        'جزئیات پست',                // Title
        'i8_post_details_callback',  // Callback function
        'post',                      // Post type
        'side',                      // Context (side for sidebar)
        'high'                       // Priority (high for top position)
    );
}

// Enqueue media scripts for admin
add_action( 'admin_enqueue_scripts', 'i8_admin_enqueue_scripts' );

function i8_admin_enqueue_scripts( $hook ) {
    // Only load on post edit pages
    if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
        return;
    }
    
    // Enqueue WordPress media scripts
    wp_enqueue_media();
}

// Meta box callback function
function i8_post_details_callback( $post ) {
    // Add nonce for security
    wp_nonce_field( 'i8_post_details_nonce', 'i8_post_details_nonce_field' );
    
    // Get current values
    $main_category = get_post_meta( $post->ID, 'i8_main_category', true );
    $post_type = get_post_meta( $post->ID, 'i8_post_type', true );
    
    // Get all categories for dropdown
    $categories = get_categories( array( 'hide_empty' => false ) );
    
    // Post type options
    $post_type_options = array(
        'simple' => 'پست ساده',
        'report' => 'گزارش تخصصی',
        'multimedia' => 'چندرسانه‌ای',
        'session' => 'نشست تخصصی',
        'event' => 'رویداد',
        'publication' => 'انتشارات',
        'course' => 'دوره آموزشی'
    );
    
    ?>
    <div id="i8-post-details-container">
        <style>
            #i8-post-details-container .field-group {
                margin-bottom: 15px;
            }
            #i8-post-details-container label {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
            }
            #i8-post-details-container select,
            #i8-post-details-container input[type="text"],
            #i8-post-details-container input[type="url"],
            #i8-post-details-container input[type="date"],
            #i8-post-details-container textarea {
                width: 100%;
                padding: 5px;
                border: 1px solid #ddd;
                border-radius: 3px;
            }
            #i8-post-details-container textarea {
                height: 60px;
                resize: vertical;
            }
            .conditional-fields {
                display: none;
                margin-top: 15px;
                padding-top: 15px;
                border-top: 1px solid #eee;
            }
            .conditional-fields.active {
                display: block;
            }
        </style>
        
        <!-- Required Fields -->
        <div class="field-group">
            <label for="i8_main_category">دسته‌بندی اصلی:</label>
            <select name="i8_main_category" id="i8_main_category">
                <option value="">انتخاب دسته‌بندی</option>
                <?php foreach ( $categories as $category ) : ?>
                    <option value="<?php echo esc_attr( $category->term_id ); ?>" 
                            <?php selected( $main_category, $category->term_id ); ?>>
                        <?php echo esc_html( $category->name ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="field-group">
            <label for="i8_post_type">نوع پست:</label>
            <select name="i8_post_type" id="i8_post_type">
                <?php foreach ( $post_type_options as $value => $label ) : ?>
                    <option value="<?php echo esc_attr( $value ); ?>" 
                            <?php selected( $post_type, $value ); ?>>
                        <?php echo esc_html( $label ); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <!-- Conditional Fields for Report -->
        <div id="fields-report" class="conditional-fields <?php echo ( $post_type === 'report' ) ? 'active' : ''; ?>">
            <h4>فیلدهای گزارش تخصصی</h4>
            <div class="field-group">
                <label for="i8_report_pdf">آدرس فایل PDF:</label>
                <input type="url" name="i8_report_pdf" id="i8_report_pdf" 
                       value="<?php echo esc_attr( get_post_meta( $post->ID, 'i8_report_pdf', true ) ); ?>" />
            </div>
            <div class="field-group">
                <label for="i8_report_word">آدرس فایل Word:</label>
                <input type="url" name="i8_report_word" id="i8_report_word" 
                       value="<?php echo esc_attr( get_post_meta( $post->ID, 'i8_report_word', true ) ); ?>" />
            </div>
        </div>
        
        <!-- Conditional Fields for Multimedia -->
        <div id="fields-multimedia" class="conditional-fields <?php echo ( $post_type === 'multimedia' ) ? 'active' : ''; ?>">
            <h4>فیلدهای چندرسانه‌ای</h4>
            <div class="field-group">
                <label for="i8_media_duration">مدت زمان محتوا:</label>
                <input type="text" name="i8_media_duration" id="i8_media_duration" 
                       value="<?php echo esc_attr( get_post_meta( $post->ID, 'i8_media_duration', true ) ); ?>" 
                       placeholder="مثال: 15:30" />
            </div>
            <div class="field-group">
                <label for="i8_media_url">آدرس ویدیو:</label>
                <input type="url" name="i8_media_url" id="i8_media_url" 
                       value="<?php echo esc_attr( get_post_meta( $post->ID, 'i8_media_url', true ) ); ?>" />
            </div>
            <div class="field-group">
                <label for="i8_media_embed">کد امبد:</label>
                <textarea name="i8_media_embed" id="i8_media_embed"><?php echo esc_textarea( get_post_meta( $post->ID, 'i8_media_embed', true ) ); ?></textarea>
            </div>
        </div>
        
        <!-- Conditional Fields for Session -->
        <div id="fields-session" class="conditional-fields <?php echo ( $post_type === 'session' ) ? 'active' : ''; ?>">
            <h4>فیلدهای نشست تخصصی</h4>
            <div class="field-group">
                <label for="i8_session_field">حوزه تخصصی:</label>
                <input type="text" name="i8_session_field" id="i8_session_field" 
                       value="<?php echo esc_attr( get_post_meta( $post->ID, 'i8_session_field', true ) ); ?>" />
            </div>
            <div class="field-group">
                <label for="i8_session_date">تاریخ برگزاری:</label>
                <input type="date" name="i8_session_date" id="i8_session_date" 
                       value="<?php echo esc_attr( get_post_meta( $post->ID, 'i8_session_date', true ) ); ?>" />
            </div>
            <div class="field-group">
                <label for="i8_session_host">نام میزبان:</label>
                <input type="text" name="i8_session_host" id="i8_session_host" 
                       value="<?php echo esc_attr( get_post_meta( $post->ID, 'i8_session_host', true ) ); ?>" />
            </div>
            <div class="field-group">
                <label for="i8_session_position">سمت میزبان:</label>
                <input type="text" name="i8_session_position" id="i8_session_position" 
                       value="<?php echo esc_attr( get_post_meta( $post->ID, 'i8_session_position', true ) ); ?>" />
            </div>
            <div class="field-group">
                <label for="i8_session_host_image">تصویر میزبان:</label>
                <input type="hidden" name="i8_session_host_image" id="i8_session_host_image" 
                       value="<?php echo esc_attr( get_post_meta( $post->ID, 'i8_session_host_image', true ) ); ?>" />
                <div class="image-upload-container">
                    <div class="image-preview" id="session_host_image_preview">
                        <?php 
                        $image_id = get_post_meta( $post->ID, 'i8_session_host_image', true );
                        if ( $image_id ) {
                            echo wp_get_attachment_image( $image_id, 'thumbnail' );
                        }
                        ?>
                    </div>
                    <button type="button" class="button" id="session_host_image_select">انتخاب تصویر</button>
                    <button type="button" class="button" id="session_host_image_remove" style="<?php echo $image_id ? '' : 'display:none;'; ?>">حذف تصویر</button>
                </div>
            </div>
        </div>
        
        <!-- Conditional Fields for Event -->
        <div id="fields-event" class="conditional-fields <?php echo ( $post_type === 'event' ) ? 'active' : ''; ?>">
            <h4>فیلدهای رویداد</h4>
            <div class="field-group">
                <label for="i8_event_date_month">ماه برگزاری:</label>
                <input type="text" name="i8_event_date_month" id="i8_event_date_month" 
                       value="<?php echo esc_attr( get_post_meta( $post->ID, 'i8_event_date_month', true ) ); ?>" />
            </div>
            <div class="field-group">
                <label for="i8_event_date_day">روز برگزاری:</label>
                <input type="text" name="i8_event_date_day" id="i8_event_date_day" 
                       value="<?php echo esc_attr( get_post_meta( $post->ID, 'i8_event_date_day', true ) ); ?>" />
            </div>
            <div class="field-group">
                <label for="i8_event_location">مکان برگزاری:</label>
                <input type="text" name="i8_event_location" id="i8_event_location" 
                       value="<?php echo esc_attr( get_post_meta( $post->ID, 'i8_event_location', true ) ); ?>" />
            </div>
        </div>
        
        <!-- Conditional Fields for Publication -->
        <div id="fields-publication" class="conditional-fields <?php echo ( $post_type === 'publication' ) ? 'active' : ''; ?>">
            <h4>فیلدهای انتشارات</h4>
            <div class="field-group">
                <label for="i8_publication_author">نام نویسنده:</label>
                <input type="text" name="i8_publication_author" id="i8_publication_author" 
                       value="<?php echo esc_attr( get_post_meta( $post->ID, 'i8_publication_author', true ) ); ?>" />
            </div>
            <div class="field-group">
                <label for="i8_publication_author_image">تصویر نویسنده:</label>
                <?php 
                $author_image_id = get_post_meta( $post->ID, 'i8_publication_author_image', true );
                $author_image_url = $author_image_id ? wp_get_attachment_image_url( $author_image_id, 'thumbnail' ) : '';
                ?>
                <input type="hidden" name="i8_publication_author_image" id="i8_publication_author_image" value="<?php echo esc_attr( $author_image_id ); ?>" />
                <div class="image-upload-container">
                    <div class="image-preview" id="publication_author_image_preview" style="<?php echo $author_image_url ? '' : 'display: none;'; ?>">
                        <img src="<?php echo esc_url( $author_image_url ); ?>" style="max-width: 100px; height: auto;" />
                    </div>
                    <button type="button" class="button" id="upload_publication_author_image_button">انتخاب تصویر</button>
                    <button type="button" class="button" id="remove_publication_author_image_button" style="<?php echo $author_image_url ? '' : 'display: none;'; ?>">حذف تصویر</button>
                </div>
            </div>
        </div>
        
        <!-- Conditional Fields for Course -->
        <div id="fields-course" class="conditional-fields <?php echo ( $post_type === 'course' ) ? 'active' : ''; ?>">
            <h4>فیلدهای دوره آموزشی</h4>
            <div class="field-group">
                <label for="i8_course_instructor">نام مدرس:</label>
                <input type="text" name="i8_course_instructor" id="i8_course_instructor" 
                       value="<?php echo esc_attr( get_post_meta( $post->ID, 'i8_course_instructor', true ) ); ?>" />
            </div>
            <div class="field-group">
                <label for="i8_course_instructor_image">تصویر مدرس:</label>
                <?php 
                $instructor_image_id = get_post_meta( $post->ID, 'i8_course_instructor_image', true );
                $instructor_image_url = $instructor_image_id ? wp_get_attachment_image_url( $instructor_image_id, 'thumbnail' ) : '';
                ?>
                <div class="instructor-image-upload">
                    <input type="hidden" name="i8_course_instructor_image" id="i8_course_instructor_image" value="<?php echo esc_attr( $instructor_image_id ); ?>" />
                    <div class="instructor-image-preview" style="margin-bottom: 10px;">
                        <?php if ( $instructor_image_url ) : ?>
                            <img src="<?php echo esc_url( $instructor_image_url ); ?>" style="max-width: 100px; height: auto; border-radius: 50%;" />
                        <?php endif; ?>
                    </div>
                    <button type="button" class="button upload-instructor-image">انتخاب تصویر</button>
                    <button type="button" class="button remove-instructor-image" style="<?php echo $instructor_image_url ? '' : 'display:none;'; ?>">حذف تصویر</button>
                </div>
            </div>
            <div class="field-group">
                <label for="i8_course_date">تاریخ برگزاری:</label>
                <input type="date" name="i8_course_date" id="i8_course_date" 
                       value="<?php echo esc_attr( get_post_meta( $post->ID, 'i8_course_date', true ) ); ?>" />
            </div>
        </div>
    </div>
    
    <script>
        jQuery(document).ready(function($) {
            // Handle post type change
            $('#i8_post_type').on('change', function() {
                var selectedType = $(this).val();
                
                // Hide all conditional fields
                $('.conditional-fields').removeClass('active');
                
                // Show relevant fields based on selection
                if (selectedType && selectedType !== 'simple') {
                    $('#fields-' + selectedType).addClass('active');
                }
            });
            
            // WordPress Media Uploader for Instructor Image
            var mediaUploader;
            
            $('.upload-instructor-image').on('click', function(e) {
                e.preventDefault();
                
                // If the uploader object has already been created, reopen the dialog
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                
                // Create the media uploader
                mediaUploader = wp.media({
                    title: 'انتخاب تصویر مدرس',
                    button: {
                        text: 'انتخاب تصویر'
                    },
                    multiple: false
                });
                
                // When an image is selected, run a callback
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#i8_course_instructor_image').val(attachment.id);
                    $('.instructor-image-preview').html('<img src="' + attachment.sizes.thumbnail.url + '" style="max-width: 100px; height: auto; border-radius: 50%;" />');
                    $('.remove-instructor-image').show();
                });
                
                // Open the uploader dialog
                mediaUploader.open();
            });
            
            // Remove instructor image
            $('.remove-instructor-image').on('click', function(e) {
                e.preventDefault();
                $('#i8_course_instructor_image').val('');
                $('.instructor-image-preview').html('');
                $(this).hide();
            });
            
            // WordPress Media Uploader for Session Host Image
            var sessionHostMediaUploader;
            
            $('#session_host_image_select').on('click', function(e) {
                e.preventDefault();
                
                // If the uploader object has already been created, reopen the dialog
                if (sessionHostMediaUploader) {
                    sessionHostMediaUploader.open();
                    return;
                }
                
                // Create the media uploader
                sessionHostMediaUploader = wp.media({
                    title: 'انتخاب تصویر میزبان',
                    button: {
                        text: 'انتخاب تصویر'
                    },
                    multiple: false
                });
                
                // When an image is selected, run a callback
                sessionHostMediaUploader.on('select', function() {
                    var attachment = sessionHostMediaUploader.state().get('selection').first().toJSON();
                    $('#i8_session_host_image').val(attachment.id);
                    $('#session_host_image_preview').html('<img src="' + attachment.sizes.thumbnail.url + '" style="max-width: 100px; height: auto; border-radius: 50%;" />');
                    $('#session_host_image_remove').show();
                });
                
                // Open the uploader dialog
                sessionHostMediaUploader.open();
            });
            
            // Remove session host image
            $('#session_host_image_remove').on('click', function(e) {
                e.preventDefault();
                $('#i8_session_host_image').val('');
                $('#session_host_image_preview').html('');
                $(this).hide();
            });
            
            // WordPress Media Uploader for Publication Author Image
            var publicationAuthorMediaUploader;
            
            $('#upload_publication_author_image_button').on('click', function(e) {
                e.preventDefault();
                
                // If the uploader object has already been created, reopen the dialog
                if (publicationAuthorMediaUploader) {
                    publicationAuthorMediaUploader.open();
                    return;
                }
                
                // Create the media uploader
                publicationAuthorMediaUploader = wp.media({
                    title: 'انتخاب تصویر نویسنده',
                    button: {
                        text: 'انتخاب تصویر'
                    },
                    multiple: false
                });
                
                // When an image is selected, run a callback
                publicationAuthorMediaUploader.on('select', function() {
                    var attachment = publicationAuthorMediaUploader.state().get('selection').first().toJSON();
                    $('#i8_publication_author_image').val(attachment.id);
                    $('#publication_author_image_preview').html('<img src="' + attachment.sizes.thumbnail.url + '" style="max-width: 100px; height: auto;" />').show();
                    $('#remove_publication_author_image_button').show();
                });
                
                // Open the uploader dialog
                publicationAuthorMediaUploader.open();
            });
            
            // Remove publication author image
            $('#remove_publication_author_image_button').on('click', function(e) {
                e.preventDefault();
                $('#i8_publication_author_image').val('');
                $('#publication_author_image_preview').html('').hide();
                $(this).hide();
            });
        });
    </script>
     <?php
 }

// Save meta box data
add_action( 'save_post', 'i8_save_post_details_meta' );

function i8_save_post_details_meta( $post_id ) {
    // Check if nonce is valid
    if ( ! isset( $_POST['i8_post_details_nonce_field'] ) || 
         ! wp_verify_nonce( $_POST['i8_post_details_nonce_field'], 'i8_post_details_nonce' ) ) {
        return;
    }

    // Check if user has permission to edit post
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Check if this is an autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Define all possible meta fields
    $meta_fields = array(
        // Required fields
        'i8_main_category',
        'i8_post_type',
        
        // Report fields
        'i8_report_pdf',
        'i8_report_word',
        
        // Multimedia fields
        'i8_media_duration',
        'i8_media_url',
        'i8_media_embed',
        
        // Session fields
        'i8_session_field',
        'i8_session_date',
        'i8_session_host',
        'i8_session_position',
        'i8_session_host_image',
        
        // Event fields
        'i8_event_date_month',
        'i8_event_date_day',
        'i8_event_location',
        
        // Publication fields
        'i8_publication_author',
        'i8_publication_author_image',
        
        // Course fields
        'i8_course_instructor',
        'i8_course_instructor_image',
        'i8_course_date'
    );

    // Save each field
    foreach ( $meta_fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            $value = sanitize_text_field( $_POST[ $field ] );
            
            // Special handling for textarea fields
            if ( $field === 'i8_media_embed' ) {
                $value = sanitize_textarea_field( $_POST[ $field ] );
            }
            
            // Special handling for URL fields
            if ( in_array( $field, array( 'i8_report_pdf', 'i8_report_word', 'i8_media_url' ) ) ) {
                $value = esc_url_raw( $_POST[ $field ] );
            }
            
            update_post_meta( $post_id, $field, $value );
        } else {
            // Delete meta if field is empty
            delete_post_meta( $post_id, $field );
        }
    }
}

/**
 * Helper functions to retrieve meta data
 */

// Get main category for a post
function i8_get_post_main_category( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    
    $category_id = get_post_meta( $post_id, 'i8_main_category', true );
    
    if ( $category_id ) {
        return get_category( $category_id );
    }
    
    return false;
}

// Get post type for a post
function i8_get_post_type( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    
    $post_type = get_post_meta( $post_id, 'i8_post_type', true );
    
    // Return default if empty
    return $post_type ? $post_type : 'simple';
}

// Get post type label
function i8_get_post_type_label( $post_id = null ) {
    $post_type = i8_get_post_type( $post_id );
    
    $labels = array(
        'simple' => 'پست ساده',
        'report' => 'گزارش تخصصی',
        'multimedia' => 'چندرسانه‌ای',
        'session' => 'نشست تخصصی',
        'event' => 'رویداد',
        'publication' => 'انتشارات',
        'course' => 'دوره آموزشی'
    );
    
    return isset( $labels[ $post_type ] ) ? $labels[ $post_type ] : $labels['simple'];
}

// Get specific meta field
function i8_get_meta( $field, $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    
    return get_post_meta( $post_id, $field, true );
}

// Check if post has specific type
function i8_is_post_type( $type, $post_id = null ) {
    return i8_get_post_type( $post_id ) === $type;
}

<?php
/**
 * Asrepoya Theme Customizer
 *
 * @package Asrepoya
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function asrepoya_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'asrepoya_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'asrepoya_customize_partial_blogdescription',
            )
        );

        // Footer selective refresh partials
        $wp_customize->selective_refresh->add_partial(
            'asrepoya_about_us',
            array(
                'selector'        => '.footer-about-us',
                'render_callback' => 'asrepoya_customize_partial_about_us',
            )
        );
        
        $wp_customize->selective_refresh->add_partial(
            'asrepoya_copyright_text',
            array(
                'selector'        => '.footer-copyright',
                'render_callback' => 'asrepoya_customize_partial_copyright',
            )
        );

        // Contact info partials
        for ( $i = 1; $i <= 4; $i++ ) {
            $wp_customize->selective_refresh->add_partial(
                "asrepoya_phone_{$i}",
                array(
                    'selector'        => ".footer-phone-{$i}",
                    'render_callback' => "asrepoya_customize_partial_phone_{$i}",
                )
            );
        }

        $wp_customize->selective_refresh->add_partial(
            'asrepoya_email',
            array(
                'selector'        => '.footer-email',
                'render_callback' => 'asrepoya_customize_partial_email',
            )
        );

        for ( $i = 1; $i <= 2; $i++ ) {
            $wp_customize->selective_refresh->add_partial(
                "asrepoya_address_{$i}",
                array(
                    'selector'        => ".footer-address-{$i}",
                    'render_callback' => "asrepoya_customize_partial_address_{$i}",
                )
            );
        }

        // Social media partials
        $wp_customize->selective_refresh->add_partial(
            'asrepoya_social_media',
            array(
                'selector'        => '.footer-social-media',
                'render_callback' => 'asrepoya_customize_partial_social_media',
            )
        );
    }

    // Add Footer Panel
    $wp_customize->add_panel( 'asrepoya_footer_panel', array(
        'title'       => __( 'تنظیمات فوتر', 'asrepoya' ),
        'description' => __( 'مدیریت اطلاعات فوتر و شبکه‌های اجتماعی', 'asrepoya' ),
        'priority'    => 160,
    ) );

    // Contact Information Section
    $wp_customize->add_section( 'asrepoya_contact_section', array(
        'title'    => __( 'اطلاعات تماس', 'asrepoya' ),
        'panel'    => 'asrepoya_footer_panel',
        'priority' => 10,
    ) );

    // Copyright Section
    $wp_customize->add_section( 'asrepoya_copyright_section', array(
        'title'    => __( 'کپی‌رایت', 'asrepoya' ),
        'panel'    => 'asrepoya_footer_panel',
        'priority' => 20,
    ) );

    // Social Media Section
    $wp_customize->add_section( 'asrepoya_social_section', array(
        'title'    => __( 'شبکه‌های اجتماعی', 'asrepoya' ),
        'panel'    => 'asrepoya_footer_panel',
        'priority' => 30,
    ) );

    // Add Contact Information Settings and Controls
    asrepoya_add_contact_settings( $wp_customize );
    
    // Add Copyright Settings and Controls
    asrepoya_add_copyright_settings( $wp_customize );
    
    // Add Social Media Settings and Controls
    asrepoya_add_social_settings( $wp_customize );
}
add_action( 'customize_register', 'asrepoya_customize_register' );

/**
 * Add Contact Information Settings and Controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function asrepoya_add_contact_settings( $wp_customize ) {
    // About Us
    $wp_customize->add_setting( 'asrepoya_about_us', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'asrepoya_about_us', array(
        'label'       => __( 'درباره ما', 'asrepoya' ),
        'description' => __( 'حداکثر 400 کاراکتر', 'asrepoya' ),
        'section'     => 'asrepoya_contact_section',
        'type'        => 'textarea',
        'input_attrs' => array(
            'maxlength' => 400,
            'rows'      => 4,
        ),
    ) );

    // Phone Numbers
    for ( $i = 1; $i <= 4; $i++ ) {
        $wp_customize->add_setting( "asrepoya_phone_{$i}", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ) );
        $wp_customize->add_control( "asrepoya_phone_{$i}", array(
            'label'   => sprintf( __( 'شماره تماس %d', 'asrepoya' ), $i ),
            'section' => 'asrepoya_contact_section',
            'type'    => 'tel',
        ) );
    }

    // Email
    $wp_customize->add_setting( 'asrepoya_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'asrepoya_email', array(
        'label'   => __( 'ایمیل', 'asrepoya' ),
        'section' => 'asrepoya_contact_section',
        'type'    => 'email',
    ) );

    // Addresses
    for ( $i = 1; $i <= 2; $i++ ) {
        $wp_customize->add_setting( "asrepoya_address_{$i}", array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage',
        ) );
        $wp_customize->add_control( "asrepoya_address_{$i}", array(
            'label'   => sprintf( __( 'آدرس %d', 'asrepoya' ), $i ),
            'section' => 'asrepoya_contact_section',
            'type'    => 'textarea',
            'input_attrs' => array(
                'rows' => 3,
            ),
        ) );
    }
}

/**
 * Add Copyright Settings and Controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function asrepoya_add_copyright_settings( $wp_customize ) {
    // Copyright Text
    $wp_customize->add_setting( 'asrepoya_copyright_text', array(
        'default'           => sprintf( __( '© %s تمامی حقوق محفوظ است.', 'asrepoya' ), date( 'Y' ) ),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'asrepoya_copyright_text', array(
        'label'       => __( 'متن کپی‌رایت', 'asrepoya' ),
        'description' => __( 'متن کپی‌رایت که در فوتر نمایش داده می‌شود', 'asrepoya' ),
        'section'     => 'asrepoya_copyright_section',
        'type'        => 'textarea',
        'input_attrs' => array(
            'rows' => 2,
        ),
    ) );
}

/**
 * Add Social Media Settings and Controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function asrepoya_add_social_settings( $wp_customize ) {
    // Register custom control for media upload
    if ( class_exists( 'WP_Customize_Media_Control' ) ) {
        // Social Media Items (10 items)
        for ( $i = 1; $i <= 10; $i++ ) {
            // Social Media Icon (SVG Upload)
            $wp_customize->add_setting( "asrepoya_social_icon_{$i}", array(
                'default'           => '',
                'sanitize_callback' => 'absint',
                'transport'         => 'postMessage',
            ) );
            $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, "asrepoya_social_icon_{$i}", array(
                'label'       => sprintf( __( 'آیکون شبکه اجتماعی %d', 'asrepoya' ), $i ),
                'description' => __( 'فایل SVG آپلود کنید', 'asrepoya' ),
                'section'     => 'asrepoya_social_section',
                'mime_type'   => 'image/svg+xml',
            ) ) );

            // Social Media Link
            $wp_customize->add_setting( "asrepoya_social_link_{$i}", array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
                'transport'         => 'postMessage',
            ) );
            $wp_customize->add_control( "asrepoya_social_link_{$i}", array(
                'label'       => sprintf( __( 'لینک شبکه اجتماعی %d', 'asrepoya' ), $i ),
                'description' => __( 'URL کامل شبکه اجتماعی', 'asrepoya' ),
                'section'     => 'asrepoya_social_section',
                'type'        => 'url',
            ) );
        }
    }
}



/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function asrepoya_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function asrepoya_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Footer selective refresh callback functions
 */
function asrepoya_customize_partial_about_us() {
    return get_theme_mod( 'asrepoya_about_us', '' );
}

function asrepoya_customize_partial_copyright() {
    return get_theme_mod( 'asrepoya_copyright_text', '© ' . date('Y') . ' تمامی حقوق محفوظ است.' );
}

function asrepoya_customize_partial_email() {
    return get_theme_mod( 'asrepoya_email', '' );
}

// Phone callback functions
function asrepoya_customize_partial_phone_1() {
    return get_theme_mod( 'asrepoya_phone_1', '' );
}

function asrepoya_customize_partial_phone_2() {
    return get_theme_mod( 'asrepoya_phone_2', '' );
}

function asrepoya_customize_partial_phone_3() {
    return get_theme_mod( 'asrepoya_phone_3', '' );
}

function asrepoya_customize_partial_phone_4() {
    return get_theme_mod( 'asrepoya_phone_4', '' );
}

// Address callback functions
function asrepoya_customize_partial_address_1() {
    return get_theme_mod( 'asrepoya_address_1', '' );
}

function asrepoya_customize_partial_address_2() {
    return get_theme_mod( 'asrepoya_address_2', '' );
}

function asrepoya_customize_partial_social_media() {
    $output = '';
    for ( $i = 1; $i <= 10; $i++ ) {
        $icon_id = get_theme_mod( "asrepoya_social_icon_{$i}", '' );
        $link = get_theme_mod( "asrepoya_social_link_{$i}", '' );
        
        if ( $icon_id && $link ) {
            $icon_path = get_attached_file( $icon_id );
            if ( $icon_path && file_exists( $icon_path ) ) {
                $svg_content = file_get_contents( $icon_path );
                if ( $svg_content ) {
                    // Clean and prepare SVG content
                    $svg_content = preg_replace('/width="[^"]*"/', '', $svg_content);
                    $svg_content = preg_replace('/height="[^"]*"/', '', $svg_content);
                    $svg_content = str_replace('<svg', '<svg class="social-svg-icon" width="24" height="24"', $svg_content);
                    
                    $output .= sprintf(
                        '<a href="%s" target="_blank" rel="noopener" class="social-icon social-item social-item-%d" aria-label="شبکه اجتماعی %d">%s</a>',
                        esc_url( $link ),
                        $i,
                        $i,
                        $svg_content
                    );
                }
            }
        }
    }
    return $output;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function asrepoya_customize_preview_js() {
    wp_enqueue_script( 'asrepoya-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'asrepoya_customize_preview_js' );

/**
 * Enqueue customizer control scripts.
 */
function asrepoya_customize_controls_js() {
    wp_enqueue_script( 'asrepoya-svg-upload', get_template_directory_uri() . '/assets/js/svg-upload.js', array( 'customize-controls' ), '1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'asrepoya_customize_controls_js' );
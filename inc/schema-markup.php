<?php
/**
 * Schema Rich Data Implementation for Asrepoya Think Tank
 * 
 * This file handles structured data markup for better SEO
 * and rich snippets in search results
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Schema Markup to head
 */
function asrepoya_add_schema_markup() {
    if (is_front_page()) {
        asrepoya_organization_schema();
    } elseif (is_single() && get_post_type() == 'post') {
        asrepoya_article_schema();
    } elseif (is_page()) {
        asrepoya_webpage_schema();
    }
}
add_action('wp_head', 'asrepoya_add_schema_markup');

/**
 * Organization Schema for Homepage
 */
function asrepoya_organization_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => get_bloginfo('name'),
        'description' => get_bloginfo('description'),
        'url' => home_url(),
        'logo' => array(
            '@type' => 'ImageObject',
            'url' => get_template_directory_uri() . '/assets/images/Logo-asre-poya.svg'
        ),
        'sameAs' => array(
            // Add social media URLs here
            'https://twitter.com/asrepoya',
            'https://instagram.com/asrepoya'
        ),
        'contactPoint' => array(
            '@type' => 'ContactPoint',
            'contactType' => 'customer service',
            'availableLanguage' => 'Persian'
        ),
        'address' => array(
            '@type' => 'PostalAddress',
            'addressCountry' => 'IR',
            'addressLocality' => 'تهران'
        )
    );
    
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}

/**
 * Article Schema for Blog Posts
 */
function asrepoya_article_schema() {
    global $post;
    
    $author = get_the_author_meta('display_name', $post->post_author);
    $categories = get_the_category();
    $category = !empty($categories) ? $categories[0]->name : 'اخبار';
    
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'NewsArticle',
        'headline' => get_the_title(),
        'description' => get_the_excerpt() ?: wp_trim_words(get_the_content(), 20),
        'image' => array(
            '@type' => 'ImageObject',
            'url' => get_the_post_thumbnail_url() ?: get_template_directory_uri() . '/assets/images/default-thumbnail.jpg'
        ),
        'author' => array(
            '@type' => 'Person',
            'name' => $author
        ),
        'publisher' => array(
            '@type' => 'Organization',
            'name' => get_bloginfo('name'),
            'logo' => array(
                '@type' => 'ImageObject',
                'url' => get_template_directory_uri() . '/assets/images/Logo-asre-poya.svg'
            )
        ),
        'datePublished' => get_the_date('c'),
        'dateModified' => get_the_modified_date('c'),
        'mainEntityOfPage' => array(
            '@type' => 'WebPage',
            '@id' => get_permalink()
        ),
        'articleSection' => $category,
        'keywords' => 'حکمرانی, سیاست, اقتصاد, تحلیل, ' . $category,
        'inLanguage' => 'fa-IR'
    );
    
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}

/**
 * WebPage Schema for Static Pages
 */
function asrepoya_webpage_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        'name' => get_the_title(),
        'description' => get_the_excerpt() ?: wp_trim_words(get_the_content(), 20),
        'url' => get_permalink(),
        'inLanguage' => 'fa-IR',
        'isPartOf' => array(
            '@type' => 'WebSite',
            'name' => get_bloginfo('name'),
            'url' => home_url()
        ),
        'breadcrumb' => array(
            '@type' => 'BreadcrumbList',
            'itemListElement' => array(
                array(
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'خانه',
                    'item' => home_url()
                ),
                array(
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => get_the_title(),
                    'item' => get_permalink()
                )
            )
        )
    );
    
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}

/**
 * Website Schema for Search Box
 */
function asrepoya_website_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => get_bloginfo('name'),
        'url' => home_url(),
        'potentialAction' => array(
            '@type' => 'SearchAction',
            'target' => array(
                '@type' => 'EntryPoint',
                'urlTemplate' => home_url('/?s={search_term_string}')
            ),
            'query-input' => 'required name=search_term_string'
        )
    );
    
    if (is_front_page()) {
        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
    }
}
add_action('wp_head', 'asrepoya_website_schema');
<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('tmo/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

add_action('acf/input/admin_enqueue_scripts', function() {
    wp_enqueue_style(
        'tmo/acf.js',
        asset_path('styles/acf.css'),
        false,
        null
    );

    wp_enqueue_script(
        'tmo/acf.js',
        asset_path('scripts/acf.js'),
        [],
        null,
        true
    );
});

/**
 * ACF options pages
 */
add_action('acf/init', function()
{
    if (function_exists('acf_add_options_page'))
    {
        $parent = acf_add_options_page([
            'page_title' => __('Theme Settings'),
            'menu_title' => __('Theme Settings'),
            'menu_slug' => 'theme-settings',
            'capability' => 'activate_plugins',
            'redirect' => false,
            'parent_slug' => 'options-general.php',
        ]);

        acf_add_options_page([
            'page_title' => __('Social Media'),
            'menu_title' => __('Social Media'),
            'menu_slug' => 'social-media-settings',
            'capability' => 'activate_plugins',
            'parent_slug' => 'options-general.php?page=' . $parent['menu_slug'],
        ]);

        acf_add_options_page([
            'page_title' => __('Archive Settings'),
            'menu_title' => __('Archive Settings'),
            'menu_slug' => 'clients-archive-settings',
            'capability' => 'activate_plugins',
            'redirect' => false,
            'parent_slug' => 'edit.php?post_type=clients',
        ]);

        acf_add_options_page([
            'page_title' => __('Event Archive Settings'),
            'menu_title' => __('Event Archive Settings'),
            'menu_slug' => 'event-archive-settings',
            'capability' => 'activate_plugins',
            'redirect' => false,
            'parent_slug' => 'edit.php?post_type=events',
        ]);
    }
});

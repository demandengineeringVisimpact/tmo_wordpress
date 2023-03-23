<?php

namespace App;

use App\Fields\Partials\CanadianToggle;
use App\Fields\MenuItem;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return '&hellip;';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);

add_filter('wp_get_nav_menu_items', function($items, $menu) {
    global $post;

    if (is_admin()) return $items;

    foreach($items as $key => $item) {
        setup_postdata($item);
        $post = $item;
        $toggle = new CanadianToggle();

        $item->classes[] = sprintf(
            'country-%s',
            sanitize_title(CanadianToggle::choice())
        );
    }

    wp_reset_postdata();

    return $items;
}, null, 3);

add_filter('wp_setup_nav_menu_item', function($item) {
    global $post;

    if (is_admin()) return $item;

    setup_postdata($item);

    $post = $item;

    $classes = $item->classes;

    $classes[] = sprintf('layout-%s', MenuItem::layout());

    if (MenuItem::layout() === MenuItem::$_LAYOUTS['LIST']) {
        $classes[] = sprintf('columns-%s', MenuItem::columnCount());
    }

    if (MenuItem::isHeader()) {
        $classes[] = 'is-header';
    }

    if (MenuItem::Icon()) {
        $item->title = sprintf(
            '<i class="icon-%s" role="none"></i> %s',
            MenuItem::Icon(),
            $item->title
        );
    }

    $item->classes = $classes;

    wp_reset_postdata();

    return $item;
}, 10, 2);

register_block_style('core/button', [
    'name' => 'arrow-cta',
    'label' => __('Arrow'),
]);

add_filter('wpseo_breadcrumb_links', function($links) {
    global $post;

    if (is_singular('clients')) {
        array_shift($links);
        $links[0]['text'] = 'Customer Stories';
    }

    return $links;
});

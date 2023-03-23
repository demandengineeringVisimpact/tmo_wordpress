<?php

namespace App;

use App\Fields\Event;
use App\Fields\ClientProperties;
use App\Fields\ClientsArchiveSettings;
use App\Fields\EventArchiveSettings;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Container;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('icomoon/tmo', 'https://d1azc1qln24ryf.cloudfront.net/141886/TheMortgageOffice/style-cf.css?fgd9sk', false, null);
    wp_enqueue_style('google/cairo', 'https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap', false, null);
    wp_enqueue_style('tmo/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('tmo/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);

    // if (get_site_url() == 'https://themortgageoff.wpengine.com') {
    //     wp_enqueue_script('bugherd', 'https://www.bugherd.com/sidebarv2.js?apikey=ywjr0bvmfxait2gepcsx8a', false, null, true);
    // }

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

add_action('wp_head', function () { ?>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-172663-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-172663-1');
    </script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NB5HSW5');</script>
    <!-- End Google Tag Manager -->
<?php });

add_action('wp_footer', function() { ?>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NB5HSW5"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
<?php });

/**
 * Login Styling
 */
/* add_action('login_enqueue_scripts', function() {
    wp_enqueue_style('tmo/login.css', asset_path('styles/login.css'), false, null);
    wp_enqueue_script('tmo/login.js', asset_path('scripts/login.js'), ['jquery'], null, true);
}, 100); */

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'footer_navigation' => __('Footer Navigation', 'tmo'),
        'four_oh_four' => __('404', 'tmo'),
        'industries' => __('Industries', 'tmo'),
        'legal_navigation' => __('Legal Navigation', 'tmo'),
        'primary_navigation' => __('Primary Navigation', 'tmo'),
        'resources' => __('Resources', 'tmo'),
        'secondary_navigation' => __('Secondary Navigation', 'tmo'),
        'sitemap' => __('Sitemap', 'tmo'),
        'social_media' => __('Social Media', 'tmo'),
        'solutions' => __('Solutions', 'tmo'),
        'support' => __('Support', 'tmo'),
    ]);

    add_post_type_support('page', 'excerpt');
    add_post_type_support('clients', 'excerpt');

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    add_image_size('headshot', 215, 215, true);
    add_image_size('event_thumbnail', 420, 225, true);

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

/**
 * Disable the emoji's
 */
add_action('init', function()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    /**
     * Filter function used to remove the tinymce emoji plugin.
     *
     * @param array $plugins
     * @return array Difference betwen the two arrays
     */
    add_filter('tiny_mce_plugins', function($plugins)
    {
        if (is_array($plugins))
            return array_diff($plugins, array('wpemoji'));
        else
            return [];
    });

    /**
     * Remove emoji CDN hostname from DNS prefetching hints.
     *
     * @param array $urls URLs to print for resource hints.
     * @param string $relation_type The relation type the URLs are printed for.
     * @return array Difference betwen the two arrays.
     */
    add_filter('wp_resource_hints', function ($urls, $relation_type)
    {
        if ('dns-prefetch' == $relation_type)
        {
            /** This filter is documented in wp-includes/formatting.php */
            $emoji_svg_url = apply_filters(
                'emoji_svg_url',
                'https://s.w.org/images/core/emoji/2/svg/'
            );

            $urls = array_diff( $urls, array( $emoji_svg_url ) );
        }

        return $urls;
    } , 10, 2);
});

add_action('pre_get_posts', function($query)
{
    if (!is_admin() && $query->is_post_type_archive('clients') && $query->is_main_query()) {
        $settings = new ClientsArchiveSettings();
        $query->query_vars['posts_per_page'] = $settings->pageLimit();
        $query->query_vars['meta_key'] = ClientProperties::$_FIELDS['HIDE_FROM_FEED'];
        $query->query_vars['meta_value'] = 1;
        $query->query_vars['meta_compare'] = '!=';
    }

    if ($query->is_post_type_archive('events') && $query->is_main_query()) {
        // $query->query_vars['order'] = 'DESC';
        // $query->query_vars['orderby'] = 'meta_value';
        $query->query_vars['meta_key'] = Event::$_FIELDS['EVENT_START_DATE'];
        $query->query_vars['meta_type'] = 'DATETIME';

        if (!is_admin()) {
            $query->query_vars['orderby'] = [
                'event_categories' => 'DESC',
                'event_date' => 'DESC',
            ];
            $query->query_vars['posts_per_page'] = -1;
            $query->query_vars['meta_query'] = [[
                'event_date' => [
                    'key' => Event::$_FIELDS['EVENT_START_DATE'],
                    'compare' => '>',
                    'type' => 'DATETIME',
                    'value' => date('Y-m-d H:i:s'),
                ]
            ]];
        }
    }

    return $query;
});

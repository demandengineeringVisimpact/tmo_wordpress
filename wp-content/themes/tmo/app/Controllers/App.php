<?php

namespace App\Controllers;

use App\Controllers\Single;
use App\Fields\ClientProperties;
use App\Fields\CompanyInformation;
use App\Fields\Event;
use App\Fields\Logos;
use App\Fields\Page;
use Sober\Controller\Controller;
use WP_Query;

class App extends Controller
{
  public function siteName()
  {
    return get_bloginfo('name');
  }

  public static function title()
  {
    if (is_home()) {
      if ($home = get_option('page_for_posts', true)) {
        return get_the_title($home);
      }

      return __('Latest Posts', 'sage');
    }

    if (is_archive()) {
      return get_the_archive_title();
    }

    if (is_search()) {
      return sprintf(__('Search Results for %s', 'sage'), get_search_query());
    }

    if (is_404()) {
      return __('Page Not Found', 'sage');
    }

    return get_the_title();
  }

  public static function card($size = 'thumbnail')
  {
    $id = get_the_id();
    $single = new Single();
    $post_type = get_post_type();
    $p = [
      'id' => $id,
      'title' => get_the_title($id),
      'content' => get_the_excerpt($id),
      'image_id' => get_post_thumbnail_id($id) ?: CompanyInformation::placeholder(),
      'size' => $size,
      'eyebrow' => \App\template('partials.entry-meta', [
        'post_categories' => $single->postCategories(),
      ]),
      'action' => [
        'title' => __('Read Article', 'tmo'),
        'url' => get_the_permalink($id),
      ],
      'classes' => [$post_type, 'swiper-slide'],
    ];

    if ($post_type === 'clients') {
      $p['eyebrow'] = get_the_title();
      $p['title'] = get_the_excerpt();
      $p['content'] = '';
      $p['action']['title'] = __('See Story', 'tmo');
      $p['action']['target'] = "_blank";

      if ($image_id = ClientProperties::monoLogoID()) {
        $p['image_id'] = $image_id;
      }
    }

    if ($post_type === 'events') {
      $p['eyebrow'] = \App\template('partials.entry-meta-event', [
        'event_date' => Event::eventDate(),
        'event_type' => Event::type(),
        'event_location' => Event::location(),
      ]);
      $p['action']['title'] = 'Learn More';
    }

    return $p;
  }

  public function primaryLogo()
  {
    return Logos::primary();
  }

  public function secondaryLogo()
  {
    return Logos::secondary();
  }

  public function phoneNumber()
  {
    return CompanyInformation::phoneNumber();
  }

  public function copyright()
  {
    return apply_filters('the_content', CompanyInformation::copyright());
  }

  public function eyebrow()
  {
    return \App\template('partials.eyebrow', ['eyebrow' => Page::eyebrow()]);
  }

  public function share()
  {
    return urlencode_deep([
      'url' => get_the_permalink(),
      'text' => get_the_excerpt(),
      'title' => get_the_title(),
    ]);
  }

  public function resources()
  {
    $args = ['post_type' => 'resources'];
    $query = new WP_Query($args);
    $posts = [];

    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $id = get_the_id();
        $primary_term = yoast_get_primary_term('resource_categories', $id);

        if (!$primary_term) {
          $terms = get_the_terms($id, 'resource_categories');
          $primary_term = $terms[0]->name;
        }

        $posts[] = [
          'id' => $id,
          'title' => get_the_title($id),
          'content' => get_the_excerpt($id),
          'image_id' => get_post_thumbnail_id($id),
          'size' => 'medium',
          'eyebrow' => $primary_term,
          'action' => [
            'title' => 'View Resource',
            'url' => get_the_permalink($id),
          ],
          'classes' => ['resources', 'swiper-slide'],
        ];
      }
      wp_reset_postdata();
    }

    return $posts;
  }

  public function posts()
  {
    $args = [
      'post_type' => 'post',
      'post__not_in' => [ get_the_id() ],
    ];
    $query = new WP_Query($args);
    $posts = [];

    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $id = get_the_id();
        $single = new Single();
        $posts[] = [
          'id' => $id,
          'title' => get_the_title($id),
          'content' => get_the_excerpt($id),
          'image_id' => get_post_thumbnail_id($id) ?: CompanyInformation::placeholder(),
          'size' => 'medium',
          'eyebrow' => \App\template('partials.entry-meta', [
            'post_categories' => $single->postCategories(),
          ]),
          'action' => [
            'title' => __('Read Article', 'tmo'),
            'url' => get_the_permalink($id),
          ],
          'classes' => ['post', 'swiper-slide'],
        ];
      }
      wp_reset_postdata();
    }

    return $posts;
  }

  public function pastWebinars()
  {
    $args = [
      'post_type' => 'events',
      'meta_key' => Event::$_FIELDS['EVENT_START_DATE'],
      'meta_type' => 'DATETIME',
      'orderby' => ['event_date' => 'DESC'],
      'posts_per_page' => -1,
      'meta_query' => [[
        'event_date' => [
          'key' => Event::$_FIELDS['EVENT_START_DATE'],
          'compare' => '<',
          'type' => 'DATETIME',
          'value' => date('Y-m-d H:i:s'),
        ],
      ]],
    ];
    $query = new WP_Query($args);
    $posts = [];

    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $id = get_the_id();
        $single = new Single();
        $posts[] = [
          'id' => $id,
          'title' => get_the_title($id),
          'content' => get_the_excerpt($id),
          'image_id' => get_post_thumbnail_id($id) ?: CompanyInformation::placeholder(),
          'size' => 'event_thumbnail',
          'eyebrow' => \App\template('partials.entry-meta-event', [
            'event_type' => Event::type(),
          ]),
          'action' => [
            'title' => __('Watch On-Demand', 'tmo'),
            'url' => get_the_permalink($id),
          ],
          'classes' => ['webinars', 'swiper-slide'],
        ];
      }
      wp_reset_postdata();
    }

    return $posts;
  }
}

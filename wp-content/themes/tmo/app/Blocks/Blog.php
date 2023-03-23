<?php

namespace App\Blocks;

use WP_Query;

class Blog
{
  public static $name = 'blog';

  function __construct()
  {}

  private function posts()
  {
    $posts = [];
    $args = [
      'post_type' => 'resources',
      'posts_per_page' => 3,
    ];
    $query = new WP_Query($args);
    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $primary_term = yoast_get_primary_term('resource_categories', get_the_id());

        if (!$primary_term) {
          $terms = get_the_terms(get_the_id(), 'resource_categories');
          $primary_term = $terms[0]->name;
        }

        $posts[] = (object)[
          'title' => get_the_title(),
          'excerpt' => get_the_excerpt(),
          'permalink' => get_the_permalink(),
          'thumbnail' => get_the_post_thumbnail(
            get_the_id(),
            'medium'
          ),
          'term' => $primary_term,
        ];
      }
      wp_reset_postdata();
    }

    return $posts;
  }

  private function data()
  {
    return [
      'posts' => $this->posts(),
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Blog'),
      'description' => __('Displays a blog posts'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['blog', 'post'],
      'render_callback' => [$this, 'render'],
    ];
  }

  public function render()
  {
    if ($preview = get_field('preview')) {
      echo \App\template('partials.blocks.block-preview', ['preview', $preview]);
    }

    else {
      echo \App\template('partials.blocks.blog', $this->data());
    }
  }
}

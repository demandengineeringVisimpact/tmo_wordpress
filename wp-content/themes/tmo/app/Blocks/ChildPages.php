<?php

namespace App\Blocks;

use App\Fields\Page;
use App\Fields\Partials\CanadianToggle;
use WP_Query;

class ChildPages
{
  public static $name = 'childpages';

  function __construct()
  {}

  private function children()
  {
    global $post;

    $children = [];

    $args = [
      'post_type' => 'page',
      'posts_per_page' => -1,
      'post_parent' => get_the_id(),
      'order' => 'ASC',
      'orderby' => 'menu_order',
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $children[] = [
          'id' => get_the_id(),
          'title' => get_the_title(),
          'excerpt' => get_the_excerpt(),
          'permalink' => get_the_permalink(),
          'icon' => Page::icon(),
          'classes' => [sprintf(
            'country-%s',
            sanitize_title(CanadianToggle::choice())
          )],
        ];
      }
    }

    return $children;
  }

  private function data()
  {
    return [
      'children' => $this->children(),
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Child Pages'),
      'description' => __('Displays a list of child pages'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['children', 'child', 'pages'],
      'render_callback' => [$this, 'render'],
    ];
  }

  public function render()
  {
    if ($preview = get_field('preview')) {
      echo \App\template('partials.blocks.block-preview', ['preview', $preview]);
    }

    else {
      echo \App\template('partials.blocks.child-pages', $this->data());
    }
  }
}

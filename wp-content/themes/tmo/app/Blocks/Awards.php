<?php

namespace App\Blocks;

use WP_Query;

class Awards
{
  public static $name = 'awards';

  function __construct()
  {}

  private function listAwards()
  {
    $awards = [];
    $args = [
      'post_type' => 'awards',
      'posts_per_page' => -1
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $awards[] = get_the_post_thumbnail(get_the_id(), 'large');
      }
    }

    return $awards;
  }

  private function data()
  {
    return [
      'awards' => $this->listAwards(),
      'allowedBlocks' => [
        'core/heading',
      ],
      'template' => [
        ['core/heading', [
          'placeholder' => 'Add some text',
        ]],
      ],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Awards'),
      'description' => __('Display a slide show of awards'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['awards'],
      'supports' => ['jsx' => true],
      'render_callback' => [$this, 'render'],
    ];
  }

  public function render()
  {
    if ($preview = get_field('preview')) {
      echo \App\template('partials.blocks.block-preview', ['preview', $preview]);
    }

    else {
      echo \App\template('partials.blocks.awards', $this->data());
    }
  }
}

<?php

namespace App\Blocks;

use WP_QUERY;
use App\Fields\HistoryProperties;

class History
{
  public static $name = 'history';

  function __construct()
  {}

  private function listHistory()
  {
    $history = [];
    $args = [
      'post_type' => 'history',
      'posts_per_page' => -1,
      'meta_key' => 'year',
      'orderby' => 'meta_value',
      'order' => 'ASC',
    ];

    $query = new WP_QUERY($args);

    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $history[] = (object)[
          'id' => get_the_id(),
          'title' => get_the_title(),
          'content' => wpautop(get_the_content()),
          'year' => HistoryProperties::year(),
        ];
      }
    }

    return $history;
  }

  private function data()
  {
    return [
      'history' => $this->listHistory(),
      'allowedBlocks' => [
        'acf/eyebrow',
        'core/heading',
      ],
      'template' => [
        ['acf/eyebrow'],
        ['core/heading', [
          'className' => 'history__title',
          'placeholder' => 'Add a title',
          'level' => 2,
        ]],
      ],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('History'),
      'description' => __('Adds a section about company history'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['history', 'timeline'],
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
      echo \App\template('partials.blocks.history', $this->data());
    }
  }
}

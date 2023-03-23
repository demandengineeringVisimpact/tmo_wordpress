<?php

namespace App\Blocks;

class Solutions
{
  public static $name = 'solutions';

  function __construct()
  {}

  private function solutions()
  {
    $menu_name = 'solutions';
    $locations = get_nav_menu_locations();

    if (!is_array($locations) || !in_array($menu_name, array_keys($locations))) {
      return [];
    }

    $menu_id = $locations[$menu_name];
    $items = wp_get_nav_menu_items($menu_id);

    if (!$items || !is_array($items)) {
      return [];
    }

    return array_map(function($item) {
      return [
        'name' => $item->post_title,
        'url' => $item->url,
      ];
    }, $items);
  }

  private function data()
  {
    return [
      'allowedBlocks' => [
        'core/paragraph',
        'core/heading',
      ],
      'template' => [
        ['core/heading', [
          'className' => 'solutions__title',
          'placeholder' => 'Add a title',
          'level' => 2,
        ]],
        ['core/paragraph', [
          'placeholder' => 'Add some text',
        ]],
      ],
      'solutions' => $this->solutions(),
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Solutions'),
      'description' => __('Displays the services provided by TMO'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['solutions'],
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
      echo \App\template('partials.blocks.solutions', $this->data());
    }
  }
}

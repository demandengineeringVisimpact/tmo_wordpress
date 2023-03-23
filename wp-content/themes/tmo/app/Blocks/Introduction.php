<?php

namespace App\Blocks;

use WP_Query;

class Introduction
{
  public static $name = 'introduction';

  function __construct()
  {}

  private function data()
  {
    return [
      'allowedBlocks' => [
        'core/heading',
        'core/paragraph',
        'core/buttons',
      ],
      'template' => [
        ['core/heading', [
          'placeholder' => 'Add a Title',
          'level' => 1,
        ]],
        ['core/paragraph', [
          'placeholder' => 'Add some text',
        ]],
      ],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Introduction'),
      'description' => __('Display an introduction to the page'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['introduction'],
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
      echo \App\template('partials.blocks.introduction', $this->data());
    }
  }
}

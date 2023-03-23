<?php

namespace App\Blocks;

use App\Fields\Tiles as TilesFields;

class Tiles
{
  public static $name = 'tiles';

  function __construct()
  {}

  private function data()
  {
    return [
      'tiles' => TilesFields::cards(),
      'layout' => TilesFields::layout(),
      'allowedBlocks' => [
        'core/buttons',
        'core/heading',
        'core/paragraph',
      ],
      'template' => [
        ['core/heading', [
          'placeholder' => 'Add a title',
          'level' => 2,
        ]],
        ['core/paragraph', [
          'placeholder' => 'Add text',
        ]],
      ],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Tiles'),
      'description' => __('Display a grid of tiles'),
      'category' => 'design',
      'post_types' => ['page'],
      'keywords' => ['tile', 'card'],
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
      echo \App\template('partials.blocks.tiles', $this->data());
    }
  }
}

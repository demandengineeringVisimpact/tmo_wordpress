<?php

namespace App\Blocks;

class Eyebrow
{
  public static $name = 'eyebrow';

  function __construct()
  {}

  private function data()
  {
    return [
      'allowedBlocks' => [
        'core/paragraph',
      ],
      'template' => [
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
      'title' => __('Eyebrow'),
      'description' => __('Adds a small title'),
      'category' => 'text',
      'post_types' => ['page', 'clients'],
      'keywords' => ['eyebrow', 'title'],
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
      echo \App\template('partials.blocks.eyebrow', $this->data());
    }
  }
}

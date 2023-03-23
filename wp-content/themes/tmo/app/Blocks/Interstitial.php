<?php

namespace App\Blocks;

class Interstitial
{
  public static $name = 'interstitial';

  function __construct()
  {}

  private function data()
  {
    return [
      'allowedBlocks' => [
        'core/buttons',
        'core/heading',
        'core/paragraph',
      ],
      'template' => [
        ['core/heading', [
          'className' => 'interstitial__title',
          'placeholder' => 'Add a title',
          'level' => 2,
        ]],
        ['core/buttons'],
      ],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Interstitial'),
      'description' => __('Adds an interstitial section'),
      'category' => 'media',
      'post_types' => ['page', 'post', 'clients'],
      'keywords' => ['interstitial'],
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
      echo \App\template('partials.blocks.interstitial', $this->data());
    }
  }
}

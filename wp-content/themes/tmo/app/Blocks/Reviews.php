<?php

namespace App\Blocks;

use App\Fields\Reviews as ReviewsFields;

class Reviews
{
  public static $name = 'reviews';

  function __construct()
  {}

  private function data()
  {
    return [
      'reviews' => ReviewsFields::reviews(),
      'allowedBlocks' => [
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
      'title' => __('Reviews'),
      'description' => __('Adds a list of reviews'),
      'category' => 'text',
      'post_types' => ['page'],
      'keywords' => ['testimonial', 'quote', 'review'],
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
      echo \App\template('partials.blocks.reviews', $this->data());
    }
  }
}

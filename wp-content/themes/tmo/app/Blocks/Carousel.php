<?php

namespace App\Blocks;

use App\Fields\Carousel as CarouselFields;
use WP_Query;

class Carousel
{
  public static $name = 'carousel';

  function __construct()
  {}

  private function data()
  {
    return [
      'posts' => CarouselFields::posts(),
      'postType' => CarouselFields::postType(),
      'allowedBlocks' => [
        'acf/eyebrow',
        'core/buttons',
        'core/heading',
        'core/paragraph',
      ],
      'template' => [
        ['acf/eyebrow'],
        ['core/heading', [
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
      'title' => __('Carousel'),
      'description' => __('Displays a carousel'),
      'category' => 'media',
      'post_types' => ['page', 'post', 'clients'],
      'keywords' => ['children', 'child', 'pages'],
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
      echo \App\template('partials.blocks.carousel', $this->data());
    }
  }
}

<?php

namespace App\Blocks;

use App\Fields\FAQs as FAQsFields;

class FAQs
{
  public static $name = 'faqs';

  function __construct()
  {}

  private function data()
  {
    return [
      'background' => FAQsFields::background(),
      'faqs' => FAQsFields::posts(),
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
      ],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('FAQs'),
      'description' => __('Adds a FAQs section'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['faqs'],
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
      echo \App\template('partials.blocks.faqs', $this->data());
    }
  }
}

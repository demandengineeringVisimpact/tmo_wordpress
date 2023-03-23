<?php

namespace App\Blocks;

use App\Fields\ContentMedia as ContentMediaFields;

class ContentMedia
{
  public static $name = 'content-media';

  function __construct()
  {}

  private function data()
  {
    return [
      'direction' => ContentMediaFields::direction(),
      'position' => ContentMediaFields::position(),
      'style' => ContentMediaFields::style(),
      'allowedBlocks' => [
        'acf/content-icon',
        'acf/eyebrow',
        'core/heading',
        'core/paragraph',
        'core/buttons',
        'core/image',
        'core/video',
      ],
      'template' => [
        ['core/columns', [], [
          ['core/column', [], [
            ['core/image', []]
          ]],
          ['core/column', [], [
            ['acf/eyebrow', []],
            ['core/heading', [
              'placeholder' => 'Add a title',
              'level' => 2,
            ]],
            ['core/paragraph', [
              'placeholder' => 'Add text',
            ]],
            ['core/buttons', []],
          ]],
        ]],
      ],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Content/Media columns'),
      'description' => __('Adds columns for a content/media layout'),
      'category' => 'design',
      'post_types' => ['page', 'clients'],
      'keywords' => ['media', 'content', 'text', 'column'],
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
      echo \App\template('partials.blocks.content-media', $this->data());
    }
  }
}

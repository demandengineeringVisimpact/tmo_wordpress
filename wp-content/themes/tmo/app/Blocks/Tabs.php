<?php

namespace App\Blocks;

use App\Fields\Tabs as TabsFields;

class Tabs
{
  public static $name = 'tabs';

  function __construct()
  {}

  private function data()
  {
    return [
      'tabs' => TabsFields::tabs(),
      'layout' => TabsFields::layout(),
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
          'placeholder' => 'Add some text',
        ]],
      ],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Tabs'),
      'description' => __('Adds a section with tabs'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['features'],
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
      echo \App\template('partials.blocks.tabs', $this->data());
    }
  }
}

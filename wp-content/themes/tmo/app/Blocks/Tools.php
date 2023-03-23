<?php

namespace App\Blocks;

use App\Fields\Tools as ToolsFields;

class Tools
{
  public static $name = 'tools';

  function __construct()
  {}

  private function data()
  {
    return [
      'tools' => ToolsFields::list(),
      'layout' => ToolsFields::layout(),
      'background' => ToolsFields::background(),
      'character' => ToolsFields::character(),
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
          'placeholder' => 'Add some text',
        ]],
      ],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Tools'),
      'description' => __('Display the Tools block'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['tools'],
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
      echo \App\template('partials.blocks.tools', $this->data());
    }
  }
}

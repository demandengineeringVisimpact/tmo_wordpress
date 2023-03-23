<?php

namespace App\Blocks;

use App\Fields\MajorSolutions as MajorSolutionsField;

class MajorSolutions
{
  public static $name = 'majorsolutions';

  function __construct()
  {}

  private function data()
  {
    return [
      'cards' => MajorSolutionsField::cards(),
      'allowedBlocks' => [
        'core/paragraph',
        'core/heading',
      ],
      'template' => [
        ['core/paragraph', [
          'placeholder' => 'Add a sub title',
          'className' => 'major-solutions__eyebrow',
        ]],
        ['core/heading', [
          'className' => 'major-solutions__title',
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
      'title' => __('Major Solutions'),
      'description' => __('Displays the major services provided by TMO'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['solutions'],
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
      echo \App\template('partials.blocks.major-solutions', $this->data());
    }
  }
}

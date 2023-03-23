<?php

namespace App\Blocks;

use App\Fields\Hero as HeroField;

class Hero
{
  public static $name = 'hero';

  function __construct()
  {}

  private function data()
  {
    return [
      'form' => HeroField::form(),
      'layout' => HeroField::layout(),
      'video' => HeroField::video(),
      'featuredImage' => HeroField::featuredImage(),
      'allowedBlocks' => [
        'contact-form-7/contact-form-selector',
        'core/buttons',
        'core/heading',
        'core/paragraph',
      ],
      'template' => [
        ['core/paragraph', [
          'className' => 'hero__subtitle',
          'placeholder' => 'Add a subtitle',
        ]],
        ['core/heading', [
          'className' => 'hero__title',
          'placeholder' => 'Add a title',
          'level' => 1,
        ]],
        ['core/paragraph', [
          'placeholder' => 'Add some text',
        ]],
        ['core/buttons'],
      ],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Hero'),
      'description' => __('Adds a hero section'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['hero', 'banner', 'cover'],
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
      echo \App\template('partials.blocks.hero', $this->data());
    }
  }
}

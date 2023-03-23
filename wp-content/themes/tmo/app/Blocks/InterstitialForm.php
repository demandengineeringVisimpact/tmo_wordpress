<?php

namespace App\Blocks;

use App\Fields\InterstitialForm as InterstitialFormFields;

class InterstitialForm
{
  public static $name = 'interstitial-form';

  function __construct()
  {}

  private function data()
  {
    return [
      'allowedBlocks' => [
        'core/heading',
      ],
      // 'form' => InterstitialFormFields::form(),
      'template' => [
        ['core/heading', [
          'className' => 'interstitial__title',
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
      'title' => __('Interstitial With Form'),
      'description' => __('Adds an interstitial with a form'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['interstitial', 'form'],
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
      echo \App\template('partials.blocks.interstitial-form', $this->data());
    }
  }
}

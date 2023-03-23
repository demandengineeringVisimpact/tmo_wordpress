<?php

namespace App\Blocks;

use App\Fields\ClientAbout as AboutFields;

class ClientAbout
{
  public static $name = 'client-about';

  function __construct()
  {}

  private function data()
  {
    return [
      'industry' => AboutFields::industry(),
      'location' => AboutFields::location(),
      'uses' => AboutFields::uses(),
      'allowedBlocks' => [
        'acf/eyebrow',
        'core/heading',
        'core/paragraph',
        'core/buttons',
      ],
      'template' => [
        ['core/heading', [
          'placeholder' => 'Add a title',
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
      'title' => __('About'),
      'description' => __('Adds an about section for the client'),
      'category' => 'design',
      'post_types' => ['clients'],
      'keywords' => ['about'],
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
      echo \App\template('partials.blocks.client-about', $this->data());
    }
  }
}

<?php

namespace App\Blocks;

use App\Fields\CustomerLogos as CustomerLogosFields;
use WP_Query;

class CustomerLogos
{
  public static $name = 'customer-logos';

  function __construct()
  {}

  private function data()
  {
    return [
      'logos' => CustomerLogosFields::clients(),
      'allowedBlocks' => [
        'core/buttons',
        'core/heading',
        'core/paragraph',
      ],
      'template' => [
        ['core/heading', [
          'className' => 'customerLogos__title',
          'content' => __('####', 'tmo'),
          'level' => 2,
        ]],
        ['core/paragraph', [
          'className' => 'customerLogos__content',
          'content' => __('A count of customers or clients who have chosen the most powerful and personalized loan servicing software solution for their business.', 'tmo'),
        ]],
        ['core/buttons', [], [
          ['core/button', [
            'text' => __('See Customer Success Stories', 'tmo'),
            'url' => '/customer-success-stories',
          ]],
        ]],
      ],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Customer Logos'),
      'description' => __('Adds customer logos block'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['logo'],
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
      echo \App\template('partials.blocks.customer-logos', $this->data());
    }
  }
}

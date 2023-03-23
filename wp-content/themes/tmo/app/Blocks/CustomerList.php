<?php

namespace App\Blocks;

use App\Fields\ClientProperties as Client;
use App\Fields\CustomerList as CustomerListBlock;

class CustomerList
{
  public static $name = 'customer-list';

  function __construct()
  {}

  private function data()
  {
    return [
      'logos' => CustomerListBlock::logos(),
      'allowedBlocks' => [
        'core/buttons',
        'core/heading',
        'core/paragraph',
      ],
      'template' => [
        ['core/heading', [
          'content' => __('Trusted by Thousands of Companies Across the World', 'tmo'),
          'level' => 2,
        ]],
      ],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Customer List'),
      'description' => __('Adds a list of customer logos'),
      'category' => 'widgets',
      'post_types' => ['page'],
      'keywords' => ['logo', 'customer'],
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
      echo \App\template('partials.blocks.customer-list', $this->data());
    }
  }
}

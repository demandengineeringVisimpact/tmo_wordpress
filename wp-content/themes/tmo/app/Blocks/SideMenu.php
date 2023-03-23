<?php

namespace App\Blocks;

class SideMenu
{
  public static $name = 'side-menu';

  function __construct()
  {}

  private function data()
  {
    return [
      'template' => [],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Side Menu'),
      'description' => __('Displays a menu to the side of content'),
      'category' => 'design',
      'post_types' => ['page'],
      'keywords' => ['side', 'menu'],
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
      echo \App\template('partials.blocks.side-menu', $this->data());
    }
  }
}

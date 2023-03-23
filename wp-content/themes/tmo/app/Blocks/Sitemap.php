<?php

namespace App\Blocks;

class Sitemap
{
  public static $name = 'sitemap';

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
      'title' => __('Sitemap'),
      'description' => __('Displays a map of links'),
      'category' => 'design',
      'post_types' => ['page'],
      'keywords' => ['sitemap', 'menu'],
      'render_callback' => [$this, 'render'],
    ];
  }

  public function render()
  {
    if ($preview = get_field('preview')) {
      echo \App\template('partials.blocks.block-preview', ['preview', $preview]);
    }

    else {
      echo \App\template('partials.blocks.sitemap', $this->data());
    }
  }
}

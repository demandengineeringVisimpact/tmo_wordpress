<?php

namespace App\Blocks;

use App\Fields\Stats as StatsFields;

class Stats
{
  public static $name = 'stats';

  function __construct()
  {}

  private function data()
  {
    return [
      'layout' => StatsFields::layout(),
      'stats' => StatsFields::stats(),
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Stats'),
      'description' => __('Adds a section of statistics'),
      'category' => 'media',
      'post_types' => ['page', 'clients'],
      'keywords' => ['stats'],
      'render_callback' => [$this, 'render'],
    ];
  }

  public function render()
  {
    if ($preview = get_field('preview')) {
      echo \App\template('partials.blocks.block-preview', ['preview', $preview]);
    }

    else {
      echo \App\template('partials.blocks.stats', $this->data());
    }
  }
}

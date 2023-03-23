<?php

namespace App\Blocks;

class Ratings
{
  public static $name = 'ratings';

  function __construct()
  {}

  public static function getRatingClass($increment = 0, $rating)
  {
    $whole = floor($rating);
    $fraction = $rating - $whole;

    if ($increment < $whole || $fraction > 0.5) {
      return '-full';
    }

    if ($fraction == 0.5 && $increment >= $whole) {
      return '-half';
    }
}

  private function data()
  {
    return [
      'sources' => [[
        'name' => 'Capterra',
        'rating' => 4.8,
        'additional' => '+200 Reviews',
        'url' => '#',
      ], [
        'name' => 'G2',
        'rating' => 4.5,
        'url' => '#',
      ], [
        'name' => 'Software Advice',
        'rating' => 4.8,
        'additional' => '+200 Reviews',
        'url' => '#',
      ], [
        'name' => 'Google My Business',
        'rating' => 4.5,
        'url' => '#',
      ]],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Ratings'),
      'description' => __('Displays a ratings from a handful of sources'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['ratings'],
      'render_callback' => [$this, 'render'],
    ];
  }

  public function render()
  {
    if ($preview = get_field('preview')) {
      echo \App\template('partials.blocks.block-preview', ['preview', $preview]);
    }

    else {
      echo \App\template('partials.blocks.ratings', $this->data());
    }
  }
}

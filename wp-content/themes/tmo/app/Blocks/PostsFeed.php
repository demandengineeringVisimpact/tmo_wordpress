<?php

namespace App\Blocks;

use App\Fields\PostsFeed as PostsFeedField;

class PostsFeed
{
  public static $name = 'postsfeed';

  function __construct()
  {}

  private function data()
  {
    return [
      'posts' => PostsFeedField::posts(),
      'title' => PostsFeedField::title(),
      'link' => PostsFeedField::archiveLink(),
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Posts Feed'),
      'description' => __('Display a feed of posts'),
      'category' => 'media',
      'post_types' => ['page', 'post'],
      'keywords' => ['posts', 'feed'],
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
      echo \App\template('partials.blocks.posts-feed', $this->data());
    }
  }
}

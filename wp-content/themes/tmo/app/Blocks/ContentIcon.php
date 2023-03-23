<?php

namespace App\Blocks;

use App\Fields\ContentIcon as ContentIconFields;
use App\Fields\Partials\Card;
use App\Fields\Partials\Icon;

class ContentIcon
{
  public static $name = 'content-icon';

  function __construct()
  {}

  private function data()
  {
    $card = new Card();

    return [
      'card' => [
        'title' => $card->title(),
        'content' => $card->content(),
        'figure' => Icon::template(false, 0),
        'classes' => [],
      ]
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Content With an Icon'),
      'description' => __('Adds a section of content with an icon'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['faqs'],
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
      echo \App\template('partials.blocks.content-icon', $this->data());
    }
  }
}

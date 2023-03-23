<?php

namespace App\Blocks;

use App\Fields\Features as FeaturesFields;

class Features
{
  public static $name = 'features';

  function __construct()
  {}

  private function data()
  {
    $features = FeaturesFields::features(true);

    return [
      'layout' => FeaturesFields::layout(),
      'position' => FeaturesFields::position(),
      'title' => FeaturesFields::title(),
      'image' => isset($features[0]['figure']) ? $features[0]['figure'] : "",
      'features' => FeaturesFields::features(),
      'hasBackground' => FeaturesFields::hasBackground(),
      'isCanadian' => FeaturesFields::isCanadian(),
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Features'),
      'description' => __('Adds a Features section'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['features'],
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
      echo \App\template('partials.blocks.features', $this->data());
    }
  }
}

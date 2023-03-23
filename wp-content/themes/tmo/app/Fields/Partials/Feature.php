<?php

namespace App\Fields\Partials;

use App\Fields\Partials\Icon;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Feature {
  public $builder;

  public $is_sub;

  public static $_FIELDS = [
    'CONTENT' => 'content',
    'FIGURE' => 'figure',
    'TITLE' => 'title',
    'IS_CANADIAN' => 'is_canadian',
  ];

  function __construct($is_sub = false)
  {
    $this->is_sub = $is_sub;
    $this->register();
  }

  public function isCanadian()
  {
    if ($this->is_sub) {
      return get_sub_field(self::$_FIELDS['IS_CANADIAN']);
    }

    return get_field(self::$_FIELDS['IS_CANADIAN']);
  }

  public function content()
  {
    if ($this->is_sub) {
      return get_sub_field(self::$_FIELDS['CONTENT']);
    }

    return get_field(self::$_FIELDS['CONTENT']);
  }

  public function figure()
  {
    if ($this->is_sub) {
      $id = get_sub_field(self::$_FIELDS['FIGURE']);
    } else {
      $id = get_field(self::$_FIELDS['FIGURE']);
    }

    if ($id) {
      return wp_get_attachment_image_url($id, 'large');
    }
  }

  public function title()
  {
    if ($this->is_sub) {
      return get_sub_field(self::$_FIELDS['TITLE']);
    }

    return get_field(self::$_FIELDS['TITLE']);
  }

  public function icon()
  {
    return Icon::template($this->is_sub);
  }

  public function data()
  {
    $data = [
      'content' => $this->content(),
      'title' => $this->title(),
      'id' => \sanitize_title($this->title()),
      'classes' => [],
    ];

    if ($figure = $this->figure()) {
      $data['figure'] = $figure;
      $data['classes'][] = '-has-figure';
    }

    if ($icon = $this->icon()) {
      $data['icon'] = $icon;
      $data['classes'][] = '-has-icon';
    }

    if ($isCanadian = $this->isCanadian()) {
      $data['isCanadian'] = $isCanadian;
      $data['classes'][] = 'is-canadian';
    }

    return $data;
  }

  private function register()
  {
    $builder = new FieldsBuilder('card');
    $icon = new Icon();

    $builder
      ->addFields($icon->builder)
      ->addImage(self::$_FIELDS['FIGURE'], ['return_format' => 'id'])
      ->addText(self::$_FIELDS['TITLE'])
      ->addWysiwyg(self::$_FIELDS['CONTENT'], [
        'media_upload' => 0,
      ])
      ->addTrueFalse(self::$_FIELDS['IS_CANADIAN']);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }

  public function template()
  {
    return \App\template('partials.feature', $this->data());
  }
}

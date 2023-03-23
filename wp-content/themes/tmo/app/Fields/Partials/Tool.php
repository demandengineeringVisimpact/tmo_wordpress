<?php

namespace App\Fields\Partials;

use App\Fields\Partials\Icon;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Tool {
  public $builder;

  public $is_sub;

  public static $_FIELDS = [
    'CONTENT' => 'content',
    'TITLE' => 'title',
    'ACTION' => 'action',
    'IS_CANADIAN' => 'is_canadian',
  ];

  function __construct($is_sub = false)
  {
    $this->is_sub = $is_sub;
    $this->register();
  }

  public function action()
  {
    if ($this->is_sub) {
      return get_sub_field(self::$_FIELDS['ACTION']);
    }

    return get_field(self::$_FIELDS['ACTION']);
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
      return get_sub_field(self::$_FIELDS['FIGURE']);
    }

    return get_field(self::$_FIELDS['FIGURE']);
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

  private function data()
  {
    $data = [
      'content' => $this->content(),
      'title' => $this->title(),
      'icon' => $this->icon(),
      'classes' => [],
    ];

    if ($action = $this->action()) {
      $data['action'] = $action;
      $data['classes'][] = '-has-action';
    }

    if ($isCanadian = $this->isCanadian()) {
      $data['isCanadian'] = $isCanadian;
      $data['classes'][] = 'is-canadian';
    }

    return $data;
  }

  private function register()
  {
    $builder = new FieldsBuilder('tool');
    $icon = new Icon();

    $builder
      ->addFields($icon->builder)
      ->addText(self::$_FIELDS['TITLE'])
      ->addWysiwyg(self::$_FIELDS['CONTENT'], [
        'media_upload' => 0,
      ])
      ->addLink(self::$_FIELDS['ACTION'])
      ->addTrueFalse(self::$_FIELDS['IS_CANADIAN']);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }

  public function template()
  {
    return \App\template('partials.tool', $this->data());
  }
}

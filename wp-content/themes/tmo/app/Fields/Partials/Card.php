<?php

namespace App\Fields\Partials;

use StoutLogic\AcfBuilder\FieldsBuilder;

class Card {
  public $builder;

  public $is_sub;

  public $image_size;

  public static $_FIELDS = [
    'ACTION' => 'action',
    'CONTENT' => 'content',
    'FIGURE' => 'figure',
    'IS_CANADIAN' => 'is_canadian',
    'MEDIA_TYPE' => 'media_type',
    'TITLE' => 'title',
    'VIDEO' => 'video',
  ];

  public static $_MEDIA_TYPES = [
    'IMAGE' => 'image',
    'VIDEO' => 'video',
  ];

  function __construct($is_sub = false, $image_size = 'medium')
  {
    $this->is_sub = $is_sub;
    $this->image_size = $image_size;
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
    if ($this->mediaType() === self::$_MEDIA_TYPES['VIDEO']) {
      $video = $this->is_sub
        ? get_sub_field(self::$_FIELDS['VIDEO'])
        : get_field(self::$_FIELDS['VIDEO']);
      return $video['type'] === 'video'
        ? \App\template('partials.video', $video)
        : '';
    } else {
      $figure = $this->is_sub
        ? get_sub_field(self::$_FIELDS['FIGURE'])
        : get_field(self::$_FIELDS['FIGURE']);
      return wp_get_attachment_image($figure['id'], $this->image_size);
    }
  }

  public function title()
  {
    if ($this->is_sub) {
      return get_sub_field(self::$_FIELDS['TITLE']);
    }

    return get_field(self::$_FIELDS['TITLE']);
  }

  public function mediaType()
  {
    if ($this->is_sub) {
      return get_sub_field(self::$_FIELDS['MEDIA_TYPE']) ?: self::$_MEDIA_TYPES['IMAGE'];
    }

    return get_field(self::$_FIELDS['MEDIA_TYPE']) ?: self::$_MEDIA_TYPES['IMAGE'];
  }

  private function data()
  {
    $data = [
      'content' => $this->content(),
      'title' => $this->title(),
      'classes' => [],
    ];

    if ($figure = $this->figure()) {
      $data['figure'] = $figure;
      $data['classes'][] = '-has-media';
    }

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

  private function getChoices($arr = [])
  {
    $choices = [];
    $values = array_values($arr);
    foreach ($values as $value) {
      $choices[$value] = ucwords(str_replace('_', ' ', $value));
    }
    return $choices;
  }

  private function register()
  {
    $builder = new FieldsBuilder('card');

    $builder
      ->addRadio(self::$_FIELDS['MEDIA_TYPE'], [
        'choices' => $this->getChoices(self::$_MEDIA_TYPES),
        'default_value' => self::$_MEDIA_TYPES['IMAGE'],
      ])
      ->addImage(self::$_FIELDS['FIGURE'])
        ->conditional(self::$_FIELDS['MEDIA_TYPE'], '==', self::$_MEDIA_TYPES['IMAGE'])
      ->addFile(self::$_FIELDS['VIDEO'])
        ->conditional(self::$_FIELDS['MEDIA_TYPE'], '==', self::$_MEDIA_TYPES['VIDEO'])
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
    return \App\template('partials.card', $this->data());
  }
}

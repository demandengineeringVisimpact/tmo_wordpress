<?php

namespace App\Fields\Partials;

use App\Fields\Partials\Video;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Tab {
  public $builder;

  public $is_sub;

  public static $_FIELDS = [
    'CONTENT' => 'content',
    'FIGURE' => 'figure',
    'TITLE' => 'title',
    'MEDIA_TYPE' => 'media_type',
  ];

  public static $_TYPES = [
    'IMAGE' => 'image',
    'VIDEO' => 'video',
  ];

  function __construct($is_sub = false)
  {
    $this->is_sub = $is_sub;
    $this->register();
  }

  public function content()
  {
    if ($this->is_sub) {
      return get_sub_field(self::$_FIELDS['CONTENT']);
    }

    return get_field(self::$_FIELDS['CONTENT']);
  }

  public function title()
  {
    if ($this->is_sub) {
      return get_sub_field(self::$_FIELDS['TITLE']);
    }

    return get_field(self::$_FIELDS['TITLE']);
  }

  public function figure()
  {
    if ($this->is_sub) {
      $id = get_sub_field(self::$_FIELDS['FIGURE']);
    } else {
      $id = get_field(self::$_FIELDS['FIGURE']);
    }

    return wp_get_attachment_image($id, 'large');
  }

  public function video()
  {
    return Video::template(false, true);
  }

  public function media()
  {
    $type = $this->is_sub
      ? get_sub_field(self::$_FIELDS['MEDIA_TYPE'])
      : get_field(self::$_FIELDS['MEDIA_TYPE']);

    if ($type === self::$_TYPES['IMAGE']) {
      return $this->figure();
    }

    if ($type === self::$_TYPES['VIDEO']) {
      return $this->video();
    }
  }

  private function data()
  {
    $data = [
      'content' => $this->content(),
      'title' => $this->title(),
      'media' => $this->media(),
      'classes' => [],
    ];

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
    $builder = new FieldsBuilder('tab');
    $video = new Video();

    $builder
      ->addText(self::$_FIELDS['TITLE'])
      ->addRadio(self::$_FIELDS['MEDIA_TYPE'], [
        'choices' => $this->getChoices(self::$_TYPES),
        'default_value' => self::$_TYPES['IMAGE'],
        'layout' => 'horizontal',
      ])
      ->addImage(self::$_FIELDS['FIGURE'], ['return_format' => 'id'])
        ->conditional(self::$_FIELDS['MEDIA_TYPE'], '==', self::$_TYPES['IMAGE'])
      ->addFields($video->builder)
      ->addWysiwyg(self::$_FIELDS['CONTENT'], [
        'media_upload' => 0,
      ])
      ->getField($video::$_FIELDS['IS_EXTERNAL'])
        ->conditional(self::$_FIELDS['MEDIA_TYPE'], '==', self::$_TYPES['VIDEO']);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }

  public function template()
  {
    return \App\template('partials.tab', $this->data());
  }
}

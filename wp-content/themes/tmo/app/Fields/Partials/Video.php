<?php

namespace App\Fields\Partials;

use StoutLogic\AcfBuilder\FieldsBuilder;

class Video {
  public $builder;

  public static $_FIELDS = [
    'IS_EXTERNAL' => 'is_external',
    'VIDEO_FILE' => 'video_file',
    'VIDEO_URL' => 'video_url',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function url($id = false, $is_sub = false)
  {
    $field = self::isExternal($id)
      ? self::$_FIELDS['VIDEO_URL']
      : self::$_FIELDS['VIDEO_FILE'];
    $acf_function = $is_sub ? 'get_sub_field' : 'get_field';
    $parameters = [$field];

    if ($id) {
      $parameters[] = $id;
    }

    $video = call_user_func_array($acf_function, $parameters);

    return is_array($video) ? $video['url'] : $video;
  }

  public static function isExternal($id = false, $is_sub = false)
  {
    $field = self::$_FIELDS['IS_EXTERNAL'];
    $acf_function = $is_sub ? 'get_sub_field' : 'get_field';
    $parameters = [$field];

    if ($id) {
      $parameters[] = $id;
    }

    return call_user_func_array($acf_function, $parameters);
  }

  public static function template($id = false, $is_sub = false)
  {
    return \App\template('partials.video', [
      'url' => self::url($id, $is_sub),
      'is_external' => self::isExternal($id, $is_sub),
      'width' => 560,
      'height' => 315,
    ]);
  }

  private function register()
  {
    $builder = new FieldsBuilder('video');

    $builder
      ->addTrueFalse(self::$_FIELDS['IS_EXTERNAL'])
      ->addUrl(self::$_FIELDS['VIDEO_URL'])
        ->conditional(self::$_FIELDS['IS_EXTERNAL'], '==', 1)
      ->addFile(self::$_FIELDS['VIDEO_FILE'])
        ->conditional(self::$_FIELDS['IS_EXTERNAL'], '==', 0);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

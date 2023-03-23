<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class ClientProperties {
  protected $builder;

  public static $_FIELDS = [
    'HIDE_FROM_FEED' => 'hide_from_feed',
    'MONO_LOGO' => 'mono_logo',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function hidden()
  {
    return get_field(self::$_FIELDS['HIDE_FROM_FEED'], get_the_id());
  }

  public static function monoLogoID()
  {
    return get_field(self::$_FIELDS['MONO_LOGO'], get_the_id());
  }

  public static function monoLogo($size = 'large')
  {
    return wp_get_attachment_image(self::monoLogoID(), $size);
  }

  private function register()
  {
    $builder = new FieldsBuilder('client', [
      'position' => 'side',
      'title' => 'Other Attributes',
    ]);

    $builder
      ->addTrueFalse(self::$_FIELDS['HIDE_FROM_FEED'])
      ->addImage(self::$_FIELDS['MONO_LOGO'], [
        'return_format' => 'id',
      ])
      ->setLocation('post_type', '===', 'clients');

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class Logos {
  protected $builder;

  public static $_FIELDS = [
    'PRIMARY_LOGO' => 'primary_logo',
    'SECONDARY_LOGO' => 'secondary_logo',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function primary()
  {
    $id = get_field(self::$_FIELDS['PRIMARY_LOGO'], 'options');
    return wp_get_attachment_image($id, 'full');
  }

  public static function secondary()
  {
    $id = get_field(self::$_FIELDS['SECONDARY_LOGO'], 'options');
    return wp_get_attachment_image($id, 'full');
  }

  private function register()
  {
    $builder = new FieldsBuilder('logos');

    $builder
      ->addImage(self::$_FIELDS['PRIMARY_LOGO'], ['return_format' => 'id'])
      ->addImage(self::$_FIELDS['SECONDARY_LOGO'], ['return_format' => 'id'])
      ->setLocation('options_page', '===', 'theme-settings');

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

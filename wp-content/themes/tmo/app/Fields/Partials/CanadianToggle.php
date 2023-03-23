<?php

namespace App\Fields\Partials;

use App;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CanadianToggle {
  public $builder;

  public $is_sub;

  public static $_FIELDS = [
    'COUNTRY_TOGGLE' => 'country_toggle',
  ];

  public static $_CHOICES = [
    'All',
    'Canadian Only',
    'Excludes Canada',
  ];

  function __construct($is_sub = false)
  {
    $this->is_sub = $is_sub;
    $this->register();
  }

  static public function choice()
  {
    return get_field(self::$_FIELDS['COUNTRY_TOGGLE'], get_the_id()) ?? self::$_CHOICES[0];
  }

  private function register()
  {
    $builder = new FieldsBuilder('canadianMenuItem');

    $builder
      ->addSelect(self::$_FIELDS['COUNTRY_TOGGLE'], [
        'title' => 'Country Display',
        'choices' => self::$_CHOICES,
        'default_value' => self::$_CHOICES[0],
      ]);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

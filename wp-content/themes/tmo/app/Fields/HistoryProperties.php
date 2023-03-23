<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class HistoryProperties {
  protected $builder;

  public static $_FIELDS = [
    'YEAR' => 'year',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function year()
  {
    return get_field(self::$_FIELDS['YEAR'], get_the_id());
  }

  private function register()
  {
    $builder = new FieldsBuilder('history', [
      'position' => 'side',
      'title' => 'Period Attributes',
    ]);

    $builder
      ->addNumber(self::$_FIELDS['YEAR'], [
        "default_value" => date('Y'),
      ])
      ->setLocation('post_type', '===', 'history');

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

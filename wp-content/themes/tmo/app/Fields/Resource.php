<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class Resource {
  protected $builder;

  public static $_FIELDS = [
    'READ_TIME' => 'read_time',
  ];

  public static $_TIMES = [
    'FIVE_MINUTES' => 'five_minutes',
    'TEN_MINUTES' => 'ten_minutes',
    'FIFTEEN_MINUTES' => 'fifteen_minutes',
    'TWENTY_MINUTES' => 'twenty_minutes',
    'THIRTY_MINUTES' => 'thirty_minutes',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function readTime()
  {
    $time = get_field(self::$_FIELDS['READ_TIME']) ?: self::$_TIMES['FIVE_MINUTES'];
    $map = [
      'five_minutes' => 5,
      'ten_minutes' => 10,
      'fifteen_minutes' => 15,
      'twenty_minutes' => 20,
      'thirty_minutes' => 30,
    ];

    return sprintf(
      '%s min read',
      number_format_i18n($map[$time])
    );
  }

  private function getTimes()
  {
    $choices = [];
    $values = array_values(self::$_TIMES);
    foreach ($values as $value) {
      $choices[$value] = ucwords(str_replace('_', ' ', $value));
    }
    return $choices;
  }

  private function register()
  {
    $builder = new FieldsBuilder('resource', [
      'position' => 'side',
      'title' => 'Resource Attributes',
    ]);

    $builder
      ->addSelect(self::$_FIELDS['READ_TIME'], [
        'choices' => $this->getTimes(),
        'default_value' => self::$_TIMES['FIVE_MINUTES'],
        'return_format' => 'value',
      ])
      ->setLocation('post_type', '==', 'resources')
      ->setLocation('post_taxonomy', '==', 'resource_types:article');

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

<?php

namespace App\Fields;

use App\Blocks\Stats as StatsBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Stats {
  protected $builder;

  public static $_FIELDS = [
    'LAYOUT' => 'layout',
    'STATS' => 'stats',
  ];

  public static $_LAYOUTS = [
    'TEXT_RIGHT' => 'text_right',
    'TEXT_BELOW' => 'text_below',
  ];

  public static $_SUBFIELDS = [
    'STAT' => 'stat',
    'DESCRIPTION' => 'description',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function layout()
  {
    return get_field(self::$_FIELDS['LAYOUT']) ?: self::$_LAYOUTS['TEXT_RIGHT'];
  }

  public static function stats()
  {
    return get_field(self::$_FIELDS['STATS']);
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
    $builder = new FieldsBuilder('stats');

    $builder
      ->addSelect(self::$_FIELDS['LAYOUT'], [
        'choices' => $this->getChoices(self::$_LAYOUTS),
        'default_value' => self::$_LAYOUTS['TEXT_RIGHT'],
        'return_format' => 'value',
      ])
      ->addRepeater(self::$_FIELDS['STATS'], ['min' => 1, 'layout' => 'block'])
        ->addText(self::$_SUBFIELDS['STAT'])
        ->addTextarea(self::$_SUBFIELDS['DESCRIPTION'])
        ->endRepeater()
      ->setLocation('block', '===', 'acf/' . StatsBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

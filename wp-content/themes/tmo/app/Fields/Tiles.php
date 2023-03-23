<?php

namespace App\Fields;

use App\Blocks\Tiles as TilesBlock;
use App\Fields\Partials\CardList;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Tiles {
  protected $builder;

  public static $_FIELDS = [
    'LAYOUT' => 'layout',
  ];

  public static $_LAYOUTS = [
    'DEFAULT' => 'default',
    'STACKS' => 'stacks',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function cards()
  {
    $cardlist = new CardList();
    return $cardlist->template();
  }

  public static function layout()
  {
    return get_field(self::$_FIELDS['LAYOUT']) ?: self::$_LAYOUTS['DEFAULT'];
  }

  private function getChoices()
  {
    $choices = [];
    $values = array_values(self::$_LAYOUTS);
    foreach ($values as $value) {
      $choices[$value] = ucwords(str_replace('_', ' ', $value));
    }
    return $choices;
  }

  private function register()
  {
    $builder = new FieldsBuilder('tiles');
    $cards = new CardList();

    $builder
      ->addSelect(self::$_FIELDS['LAYOUT'], [
        'choices' => $this->getChoices(),
        'default_value' => self::$_LAYOUTS['DEFAULT'],
        'return_format' => 'value',
      ])
      ->addFields($cards->builder)
      ->setLocation('block', '===', 'acf/' . TilesBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

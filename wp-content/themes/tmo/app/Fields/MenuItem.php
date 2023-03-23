<?php

namespace App\Fields;

use App\Fields\Partials\Icon;
use App\Fields\Partials\CanadianToggle;
use StoutLogic\AcfBuilder\FieldsBuilder;

class MenuItem {
  protected $builder;

  public static $_FIELDS = [
    'COLUMN_COUNT' => 'column_count',
    'IS_HEADER' => 'is_header',
    'LAYOUT' => 'layout',
  ];

  public static $_LAYOUTS = [
    'LIST' => 'list',
    'GRID' => 'grid',
    'TAB' => 'tab',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function Icon()
  {
    return Icon::selected();
  }

  public static function columnCount($id = 0)
  {
    return get_field(self::$_FIELDS['COLUMN_COUNT'], $id ?? get_the_id()) ?? 1;
  }

  public static function isHeader($id = 0)
  {
    return get_field(self::$_FIELDS['IS_HEADER'], $id ?? get_the_id());
  }

  public static function layout($id = 0)
  {
    return get_field(self::$_FIELDS['LAYOUT'], $id ?? get_the_id()) ?? self::$_LAYOUTS['LIST'];
  }

  private function register()
  {
    $builder = new FieldsBuilder('menuItem');
    $icon = new Icon();
    $toggle = new CanadianToggle();

    $builder
      ->addFields($icon->builder)
      // ->addFields($toggle->builder)
      ->addTrueFalse(self::$_FIELDS['IS_HEADER'])
      ->addRadio(self::$_FIELDS['LAYOUT'], [
        'choices' => array_values(self::$_LAYOUTS),
        'default_value' => self::$_LAYOUTS['LIST'],
        'layout' => 'horizontal',
      ])
      ->addNumber(self::$_FIELDS['COLUMN_COUNT'], [
        'min' => 1,
        'max' => 4,
        'default_value' => 1,
      ])
      ->conditional(self::$_FIELDS['LAYOUT'], '==', self::$_LAYOUTS['LIST'])
      ->setLocation('nav_menu_item', '===', 'location/primary_navigation');

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

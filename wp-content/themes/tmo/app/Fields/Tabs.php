<?php

namespace App\Fields;

use App\Fields\Partials\Tab;
use App\Blocks\Tabs as TabsBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Tabs {
  protected $builder;

  public static $_FIELDS = [
    'LAYOUT' => 'layout',
    'TABS' => 'tabs',
  ];

  public static $_LAYOUTS = [
    'HORIZONTAL' => 'horizontal',
    'VERTICAL' => 'vertical',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function tabs()
  {
    $tabs = [];
    $posts = get_field(self::$_FIELDS['TABS']);

    if (have_rows(self::$_FIELDS['TABS'])) {
      while (have_rows(self::$_FIELDS['TABS'])) {
        the_row();
        $tab = new Tab(true);
        $tabs[] = $tab->template();
      }
    }

    return $tabs;
  }

  public static function layout()
  {
    return get_field(self::$_FIELDS['LAYOUT']) ?? self::$_LAYOUTS['HORIZONTAL'];
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
    $builder = new FieldsBuilder('tabs');
    $tab = new Tab();

    $builder
      ->addRadio(self::$_FIELDS['LAYOUT'], [
        'choices' => $this->getChoices(),
        'default_value' => self::$_LAYOUTS['HORIZONTAL'],
        'layout' => 'horizontal',
        'return_format' => 'value',
      ])
      ->addRepeater(self::$_FIELDS['TABS'], ['min' => 1, 'layout' => 'block'])
        ->addFields($tab->builder)
        ->endRepeater()
      ->setLocation('block', '===', 'acf/' . TabsBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

<?php

namespace App\Fields;

use App\Blocks\ContentMedia as ContentMediaBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ContentMedia {
  protected $builder;

  public static $_FIELDS = [
    'DIRECTION' => 'direction',
    'MEDIA_POSITION' => 'media_position',
    'LIST_STYLE' => 'list_style',
  ];

  public static $_LAYOUTS = [
    'FORWARD' => 'forward',
    'REVERSE' => 'reverse',
  ];

  public static $_POSITIONS = [
    'START' => 'start',
    'CENTER' => 'center',
    'END' => 'end',
  ];

  public static $_STYLES = [
    'DEFAULT' => 'default',
    'SQUARE' => 'square',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function direction()
  {
    return get_field(self::$_FIELDS['DIRECTION']) ?? self::$_LAYOUTS['FORWARD'];
  }

  public static function position()
  {
    return get_field(self::$_FIELDS['MEDIA_POSITION']) ?? self::$_POSITIONS['CENTER'];
  }

  public static function style()
  {
    return get_field(self::$_FIELDS['LIST_STYLE']) ?? self::$_STYLES['DEFAULT'];
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
    $builder = new FieldsBuilder('contentMedia');

    $builder
      ->addRadio(self::$_FIELDS['DIRECTION'], [
        'choices' => $this->getChoices(self::$_LAYOUTS),
        'default_value' => self::$_LAYOUTS['FORWARD'],
        'layout' => 'horizontal',
      ])
      ->addRadio(self::$_FIELDS['MEDIA_POSITION'], [
        'choices' => $this->getChoices(self::$_POSITIONS),
        'default_value' => self::$_POSITIONS['CENTER'],
        'layout' => 'horizontal',
      ])
      ->addRadio(self::$_FIELDS['LIST_STYLE'], [
        'choices' => $this->getChoices(self::$_STYLES),
        'default_value' => self::$_STYLES['DEFAULT'],
        'layout' => 'horizontal',
      ])
      ->setLocation('block', '===', 'acf/' . ContentMediaBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

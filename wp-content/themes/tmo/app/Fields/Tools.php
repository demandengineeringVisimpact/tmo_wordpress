<?php

namespace App\Fields;

use App\Blocks\Tools as ToolsBlock;
use App\Fields\Partials\Tool;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Tools {
  protected $builder;

  public static $_FIELDS = [
    'BACKGROUND' => 'background',
    'CHARACTER' => 'character',
    'LAYOUT' => 'layout',
    'TOOLS' => 'tools',
  ];

  public static $_LAYOUTS = [
    'DEFAULT' => 'default',
    'WITH_BACKGROUND' => 'with_background',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function list()
  {
    $tools = [];

    if (have_rows(self::$_FIELDS['TOOLS'])) {
      while (have_rows(self::$_FIELDS['TOOLS'])) {
        the_row();
        $tool = new Tool(true);
        $tools[] = $tool->template();
      }
    }

    return $tools;
  }

  public static function background()
  {
    return get_field(self::$_FIELDS['BACKGROUND']);
  }

  public static function character()
  {
    return get_field(self::$_FIELDS['CHARACTER']);
  }

  public static function layout()
  {
    return get_field(self::$_FIELDS['LAYOUT']);
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
    $builder = new FieldsBuilder('tools');
    $tool = new Tool();

    $builder
      ->addSelect(self::$_FIELDS['LAYOUT'], [
        'choices' => $this->getChoices(),
        'default_value' => self::$_LAYOUTS['DEFAULT'],
        'return_format' => 'value',
      ])
      ->addImage(self::$_FIELDS['BACKGROUND'], ['return_format' => 'url'])
        ->conditional(self::$_FIELDS['LAYOUT'], '==', self::$_LAYOUTS['WITH_BACKGROUND'])
      ->addImage(self::$_FIELDS['CHARACTER'], ['return_format' => 'url'])
        ->conditional(self::$_FIELDS['LAYOUT'], '==', self::$_LAYOUTS['WITH_BACKGROUND'])
      ->addRepeater(self::$_FIELDS['TOOLS'], ['min' => 1, 'layout' => 'block'])
        ->addFields($tool->builder)
        ->endRepeater()
      ->setLocation('block', '===', 'acf/' . ToolsBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

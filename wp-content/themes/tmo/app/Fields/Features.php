<?php

namespace App\Fields;

use App\Fields\Partials\Feature;
use App\Blocks\Features as FeaturesBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Features {
  protected $builder;

  public static $_FIELDS = [
    'FEATURES' => 'features',
    // 'IMAGE' => 'image',
    'LAYOUT' => 'layout',
    'POSITION' => 'position',
    'TITLE' => 'title',
    'WITH_BACKGROUND' => 'with_background',
    'IS_CANADIAN' => 'is_canadian',
  ];

  public static $_LAYOUTS = [
    'ACCORDION' => 'accordion',
    'GRID' => 'grid',
  ];

  public static $_POSITIONS = [
    'START' => 'start',
    'END' => 'end',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function features($data_only = false)
  {
    $features = [];
    $posts = get_field(self::$_FIELDS['FEATURES']);

    if (have_rows(self::$_FIELDS['FEATURES'])) {
      while (have_rows(self::$_FIELDS['FEATURES'])) {
        the_row();
        $feature = new Feature(true);

        $features[] = $data_only
          ? $feature->data()
          : $feature->template();
      }
    }

    return $features;
  }

  // public static function image()
  // {
  //   $id = get_field(self::$_FIELDS['IMAGE']);
  //   return wp_get_attachment_image($id, 'large');
  // }

  public static function title()
  {
    return get_field(self::$_FIELDS['TITLE']);
  }

  public static function layout()
  {
    return get_field(self::$_FIELDS['LAYOUT']) ?? self::$_LAYOUTS['GRID'];
  }

  public static function position()
  {
    return get_field(self::$_FIELDS['POSITION']) ?? self::$_POSITIONS['START'];
  }

  public static function hasBackground()
  {
    return get_field(self::$_FIELDS['WITH_BACKGROUND']);
  }

  public static function isCanadian()
  {
    return get_field(self::$_FIELDS['IS_CANADIAN']);
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

  private function getPositions()
  {
    $choices = [];
    $values = array_values(self::$_POSITIONS);
    foreach ($values as $value) {
      $choices[$value] = ucwords(str_replace('_', ' ', $value));
    }
    return $choices;
  }

  private function register()
  {
    $builder = new FieldsBuilder('features');
    $feature = new Feature();

    $builder
      ->addSelect(self::$_FIELDS['LAYOUT'], [
        'choices' => $this->getChoices(),
        'default_value' => self::$_LAYOUTS['GRID'],
        'return_format' => 'value',
      ])
      ->addRadio(self::$_FIELDS['POSITION'], [
        'choices' => $this->getPositions(),
        'default_value' => self::$_POSITIONS['START'],
        'layout' => 'horizontal',
        'return_format' => 'value',
      ])
        ->conditional(self::$_FIELDS['LAYOUT'], '==', self::$_LAYOUTS['ACCORDION'])
      ->addText(self::$_FIELDS['TITLE'])
      // ->addImage(self::$_FIELDS['IMAGE'], ['return_format' => 'id'])
      ->addTrueFalse(self::$_FIELDS['WITH_BACKGROUND'])
      ->addTrueFalse(self::$_FIELDS['IS_CANADIAN'])
      ->addRepeater(self::$_FIELDS['FEATURES'], ['min' => 1, 'layout' => 'block'])
        ->addFields($feature->builder)
        ->endRepeater()
      ->setLocation('block', '===', 'acf/' . FeaturesBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

<?php

namespace App\Fields;

use App\Blocks\Testimonials as TestimonialsBlock;
use App\Fields\Partials\Testimonial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Testimonials {
  protected $builder;

  public static $_FIELDS = [
    'TESTIMONIALS' => 'testimonials',
    'LAYOUT' => 'LAYOUT',
  ];

  public static $_LAYOUTS = [
    'DEFAULT' => 'default',
    'TEXT_LEFT' => 'text_left',
    'CITE_LEFT' => 'cite_left',
    'WITH_IMAGE' => 'with_image',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function layout()
  {
    return get_field(self::$_FIELDS['LAYOUT']);
  }

  public static function testimonials()
  {
    return get_field(self::$_FIELDS['TESTIMONIALS']);
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
    $builder = new FieldsBuilder('testimonials');
    $testimonial = new Testimonial();

    $builder
      ->addSelect(self::$_FIELDS['LAYOUT'], [
        'choices' => $this->getChoices(),
        'default_value' => self::$_LAYOUTS['DEFAULT'],
        'return_format' => 'value',
      ])
      ->addRepeater(self::$_FIELDS['TESTIMONIALS'], ['min' => 1, 'layout' => 'block'])
        ->addFields($testimonial->builder)
        ->endRepeater()
      ->setLocation('block', '===', 'acf/' . TestimonialsBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

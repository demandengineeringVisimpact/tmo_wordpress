<?php

namespace App\Fields;

use App\Blocks\TestimonialLogos as TestimonialLogosBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;
use WP_Query;

class TestimonialLogos {
  protected $builder;

  public static $_FIELDS = [
    'ACTIONS' => 'actions',
    'CLIENTS' => 'clients',
    'FUNCTION' => 'function',
    'TESTIMONIAL' => 'testimonial',
    'TITLE' => 'title',
  ];

  public static $_FUNCTIONS = [
    'AUTOMATIC' => 'automatic',
    'MANUAL' => 'manual',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function actions()
  {
    $actions = get_field(self::$_FIELDS['ACTIONS']) ?? [];
    return array_column($actions, 'action');
  }

  public static function getFunction()
  {
    return get_field(self::$_FIELDS['FUNCTION']) ?: self::$_FUNCTIONS['AUTOMATIC'];
  }

  public static function clients()
  {
    $posts = [];
    $args = [
      'post_type' => 'clients',
      'posts_per_page' => 6,
    ];

    if (self::getFunction() === self::$_FUNCTIONS['MANUAL']) {
      $args['ignore_sticky_posts'] = true;
      $args['orderby'] = 'post__in';
      $args['post__in'] = get_field(self::$_FIELDS['CLIENTS']);
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $posts[] = get_the_post_thumbnail(
          get_the_id(),
          'medium'
        );
      }
    }

    return $posts;
  }

  public static function title()
  {
    return get_field(self::$_FIELDS['TITLE']);
  }

  public static function testimonial()
  {
    return get_field(self::$_FIELDS['TESTIMONIAL']);
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
    $builder = new FieldsBuilder('testimonial_logos', ['title' => 'Testimonial/Customer Logos']);

    $builder
      ->addText(self::$_FIELDS['TITLE'], ['placeholder' => 'Trusted by Thousands of Companies Across the World'])
      ->addPostObject(self::$_FIELDS['TESTIMONIAL'], [
        'post_type' => 'testimonials',
        'return_format' => 'id'
      ])
      ->addRadio(self::$_FIELDS['FUNCTION'], [
        'choices' => $this->getChoices(self::$_FUNCTIONS),
        'default_value' => self::$_FUNCTIONS['AUTOMATIC'],
      ])
      ->addRelationship(self::$_FIELDS['CLIENTS'], [
        'post_type' => 'clients',
        'filters' => ['search'],
        'elements' => ['featured_image'],
        'min' => 2,
        'max' => 6,
        'return_format' => 'id',

      ])
        ->conditional(self::$_FIELDS['FUNCTION'], '==', self::$_FUNCTIONS['MANUAL'])
      ->addRepeater(self::$_FIELDS['ACTIONS'], [
        'min' => 1,
        'max' => 2
      ])
        ->addLink('action')
      ->endRepeater()
      ->setLocation('block', '===', 'acf/' . TestimonialLogosBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

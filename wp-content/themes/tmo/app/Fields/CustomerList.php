<?php

namespace App\Fields;

use App\Blocks\CustomerList as CustomerListBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;
use WP_Query;

class CustomerList {
  protected $builder;

  public static $_FIELDS = [
    'FUNCTION' => 'function',
    'LOGOS' => 'logos',
  ];

  public static $_FUNCTIONS = [
    'AUTOMATIC' => 'automatic',
    'MANUAL' => 'manual',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function getFunction()
  {
    return get_field(self::$_FIELDS['FUNCTION']) ?: self::$_FUNCTIONS['AUTOMATIC'];
  }

  public static function logos()
  {
    $posts = [];
    $args = [
      'post_type' => 'clients',
      'posts_per_page' => 6,
    ];

    if (self::getFunction() === self::$_FUNCTIONS['MANUAL']) {
      $args['ignore_sticky_posts'] = true;
      $args['orderby'] = 'post__in';
      $args['post__in'] = get_field(self::$_FIELDS['LOGOS']);
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
    $builder = new FieldsBuilder('customerList');

    $builder
      ->addRadio(self::$_FIELDS['FUNCTION'], [
        'choices' => $this->getChoices(self::$_FUNCTIONS),
        'default_value' => self::$_FUNCTIONS['AUTOMATIC'],
      ])
      ->addRelationship(self::$_FIELDS['LOGOS'], [
        'post_type' => 'clients',
        'filters' => ['search'],
        'elements' => ['featured_image'],
        'min' => 4,
        'max' => 12,
        'return_format' => 'id',

      ])
        ->conditional(self::$_FIELDS['FUNCTION'], '==', self::$_FUNCTIONS['MANUAL'])
      ->setLocation('block', '===', 'acf/' . CustomerListBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

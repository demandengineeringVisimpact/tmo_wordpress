<?php

namespace App\Fields;

use App\Blocks\CustomerLogos as CustomerLogosBlock;
use App\Fields\ClientProperties;
use StoutLogic\AcfBuilder\FieldsBuilder;
use WP_Query;

class CustomerLogos {
  protected $builder;

  public static $_FIELDS = [
    'CLIENTS' => 'clients',
    'FUNCTION' => 'function',
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
        $mono = ClientProperties::monoLogo();
        $posts[] = !empty($mono)
          ? $mono
          : get_the_post_thumbnail(
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
    $builder = new FieldsBuilder('customer_logos', ['title' => 'Customer Logos']);

    $builder
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
      ->setLocation('block', '===', 'acf/' . CustomerLogosBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

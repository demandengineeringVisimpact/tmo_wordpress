<?php

namespace App\Fields;

use App\Blocks\FAQs as FAQsBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FAQs {
  protected $builder;

  public static $_BACKGROUNDS = [
    'DEFAULT' => 'default',
    'LIGHT_GREY' => 'light_grey',
  ];

  public static $_FIELDS = [
    'BACKGROUND' => 'background',
    'FAQS' => 'faqs',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function background()
  {
    return get_field(self::$_FIELDS['BACKGROUND']) ?? self::$_BACKGROUNDS['DEFAULT'];
  }

  public static function posts()
  {
    $faqs = [];
    $posts = get_field(self::$_FIELDS['FAQS']);

    foreach ($posts as $post) {
      $faqs[] = (object)[
        'id' => $post->ID,
        'question' => $post->post_title,
        'answer' => wpautop($post->post_content),
      ];
    }

    return $faqs;
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
    $builder = new FieldsBuilder('faqs');

    $builder
      ->addRadio(self::$_FIELDS['BACKGROUND'], [
        'choices' => $this->getChoices(self::$_BACKGROUNDS),
        'layout' => 'horizontal',
        'default_value' => self::$_BACKGROUNDS['DEFAULT'],
      ])
      ->addRelationship(self::$_FIELDS['FAQS'], [
        'post_type' => 'faqs',
        'min' => 1,
      ])
      ->setLocation('block', '===', 'acf/' . FAQsBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

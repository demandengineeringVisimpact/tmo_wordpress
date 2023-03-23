<?php

namespace App\Fields;

use App\Fields\Partials\CanadianToggle;
use App\Fields\Partials\Icon;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Page {
  protected $builder;

  public static $_FIELDS = [
    'EYEBROW' => 'eyebrow',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function icon()
  {
    return Icon::template();
  }

  public static function eyebrow()
  {
    if (is_home() && !is_front_page()) {
      return get_field(self::$_FIELDS['EYEBROW'], get_option('page_for_posts'));
    }

    return get_field(self::$_FIELDS['EYEBROW']);
  }

  private function register()
  {
    $builder = new FieldsBuilder('page', [
      'position' => 'side',
      'title' => 'Other Attributes',
    ]);
    $icon = new Icon();
    $toggle = new CanadianToggle();

    $builder
      ->addText(self::$_FIELDS['EYEBROW'])
      ->addFields($icon->builder)
      ->addFields($toggle->builder)
      ->setLocation('post_type', '===', 'page');

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

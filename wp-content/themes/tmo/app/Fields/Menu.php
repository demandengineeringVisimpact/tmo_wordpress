<?php

namespace App\Fields;

use App\Fields\Partials\CanadianToggle;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Menu {
  protected $builder;

  public static $_FIELDS = [];

  function __construct()
  {
    $this->register();
  }

  private function register()
  {
    $builder = new FieldsBuilder('menu');
    $toggle = new CanadianToggle();

    $builder
      ->addFields($toggle->builder)
      ->setLocation('nav_menu_item', '===', 'all');

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

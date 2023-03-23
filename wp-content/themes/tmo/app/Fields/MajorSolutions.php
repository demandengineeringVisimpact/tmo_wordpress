<?php

namespace App\Fields;

use App\Blocks\MajorSolutions as MajorSolutionsBlock;
use App\Fields\Partials\CardList;
use StoutLogic\AcfBuilder\FieldsBuilder;

class MajorSolutions {
  protected $builder;

  function __construct()
  {
    $this->register();
  }

  public static function cards()
  {
    $cardList = new CardList('large');
    return $cardList->template();
  }

  private function register()
  {
    $builder = new FieldsBuilder('major_solutions');
    $list = new CardList();

    $builder
      ->addFields($list->builder)
      ->setLocation('block', '===', 'acf/' . MajorSolutionsBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

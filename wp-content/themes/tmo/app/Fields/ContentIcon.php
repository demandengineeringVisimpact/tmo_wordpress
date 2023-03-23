<?php

namespace App\Fields;

use App\Blocks\ContentIcon as ContentIconBlock;
use App\Fields\Partials\Card;
use App\Fields\Partials\Icon;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ContentIcon {
  protected $builder;

  public static $_FIELDS = [
    'DIRECTION' => 'direction',
  ];

  function __construct()
  {
    $this->register();
  }

  private function register()
  {
    $builder = new FieldsBuilder('contentIcon');
    $card = new Card();
    $icon = new Icon();

    $builder
      ->addFields($icon->builder)
      ->addFields($card->builder)
      ->removeField(Card::$_FIELDS['FIGURE'])
      ->setLocation('block', '===', 'acf/' . ContentIconBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

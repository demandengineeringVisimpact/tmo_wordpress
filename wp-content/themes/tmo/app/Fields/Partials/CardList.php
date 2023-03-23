<?php

namespace App\Fields\Partials;

use App\Fields\Partials\Card;
use StoutLogic\AcfBuilder\FieldsBuilder;

class CardList {
  public $builder;

  public $image_size;

  public static $_FIELDS = [
    'CARDS' => 'cards',
  ];

  function __construct($image_size = 'medium')
  {
    $this->image_size = $image_size;
    $this->register();
  }

  private function data()
  {
    $data = ['cards' => []];

    if (have_rows(self::$_FIELDS['CARDS'])) {
      while (have_rows(self::$_FIELDS['CARDS'])) {
        the_row();
        $card = new Card(true, $this->image_size);
        $data['cards'][] = $card->template();
      }
    }

    return $data;
  }

  private function register()
  {
    $builder = new FieldsBuilder('cardlist');
    $card = new Card();

    $builder
      ->addRepeater(self::$_FIELDS['CARDS'], ['min' => 1, 'layout' => 'block'])
        ->addFields($card->builder)
        ->endRepeater();

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }

  public function template()
  {
    return \App\template('partials.card-list', $this->data());
  }
}

<?php

namespace App\Fields;

use App\Blocks\InterstitialForm as InterstitialFormBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class InterstitialForm {
  protected $builder;

  public static $_FIELDS = [
    'FORM' => 'form',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function formID()
  {
    return get_field(self::$_FIELDS['FORM']);
  }

  public static function form()
  {
    $id = self::formID();
    return do_shortcode("[contact-form-7 id='$id']");
  }

  private function register()
  {
    $builder = new FieldsBuilder('interstitial_form');

    $builder
      // ->addPostObject(self::$_FIELDS['FORM'], [
      //   'post_type' => 'wpcf7_contact_form',
      //   'return_format' => 'id',
      // ])
      ->setLocation('block', '===', 'acf/' . InterstitialFormBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

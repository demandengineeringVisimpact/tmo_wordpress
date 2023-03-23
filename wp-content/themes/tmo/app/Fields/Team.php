<?php

namespace App\Fields;

use App\Blocks\Team as TeamBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Team {
  protected $builder;

  public static $_FIELDS = [
    'CAREERS_BLURB' => 'careers_blurb',
    'CAREERS_URL' => 'careers_url',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function careersBlurb() {
    return get_field(self::$_FIELDS['CAREERS_BLURB']);
  }

  public static function careersUrl() {
    return get_field(self::$_FIELDS['CAREERS_URL']);
  }

  private function register()
  {
    $builder = new FieldsBuilder('team');

    $builder
      ->addText(self::$_FIELDS['CAREERS_BLURB'])
      ->addUrl(self::$_FIELDS['CAREERS_URL'])
      ->setLocation('block', '===', 'acf/' . TeamBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

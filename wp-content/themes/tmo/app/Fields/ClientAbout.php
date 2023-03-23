<?php

namespace App\Fields;

use App\Blocks\ClientAbout as AboutBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ClientAbout {
  protected $builder;

  public static $_FIELDS = [
    'INDUSTRY' => 'industry',
    'LOCATION' => 'location',
    'USES' => 'uses',
  ];

  public static $_SUBFIELDS = [
    'USE_CASE' => 'use_case',
  ];

  public static $_INDUSTRIES = [
    'Automotive',
    'Conventional Lending',
    'Education',
    'Franchisors',
    'Insurance',
    'Legal',
    'Land Development',
    'Municipalities',
    'NPN',
    'Non-Profits',
    'Private Lending',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function industry()
  {
    return get_field(self::$_FIELDS['INDUSTRY']);
  }

  public static function location()
  {
    return get_field(self::$_FIELDS['LOCATION']);
  }

  public static function uses()
  {
    return get_field(self::$_FIELDS['USES']);
  }

  private function register()
  {
    $builder = new FieldsBuilder('clientAbout');

    $builder
      ->addSelect(self::$_FIELDS['INDUSTRY'], [
        'choices' => self::$_INDUSTRIES,
      ])
      ->addText(self::$_FIELDS['LOCATION'])
      ->addRepeater(self::$_FIELDS['USES'], ['min' => 0])
        ->addText(self::$_SUBFIELDS['USE_CASE'])
        ->endRepeater()
      ->setLocation('block', '===', 'acf/' . AboutBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

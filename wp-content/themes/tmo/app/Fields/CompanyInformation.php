<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class CompanyInformation {
  protected $builder;

  public static $_FIELDS = [
    'PHONE_NUMBER' => 'phone_number',
    'COPYRIGHT' => 'copyright',
    'PLACEHOLDER' => 'placeholder',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function phoneNumber()
  {
    return get_field(self::$_FIELDS['PHONE_NUMBER'], 'options');
  }

  public static function copyright()
  {
    return get_field(self::$_FIELDS['COPYRIGHT'], 'options');
  }

  public static function placeholder()
  {
    return get_field(self::$_FIELDS['PLACEHOLDER'], 'options');
  }

  private function register()
  {
    $builder = new FieldsBuilder('companyinformation');

    $builder
      ->addText(self::$_FIELDS['PHONE_NUMBER'])
      ->addText(self::$_FIELDS['COPYRIGHT'])
      ->addImage(self::$_FIELDS['PLACEHOLDER'], ['return_format' => 'id'])
      ->setLocation('options_page', '===', 'theme-settings');

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

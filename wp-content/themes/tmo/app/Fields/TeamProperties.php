<?php

namespace App\Fields;

use StoutLogic\AcfBuilder\FieldsBuilder;

class TeamProperties {
  protected $builder;

  public static $_FIELDS = [
    'JOB_TITLE' => 'job_title',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function jobTitle()
  {
    return get_field(self::$_FIELDS['JOB_TITLE'], get_the_id());
  }

  private function register()
  {
    $builder = new FieldsBuilder('team', [
      'position' => 'side',
      'title' => 'Teammate Attributes',
    ]);

    $builder
      ->addText(self::$_FIELDS['JOB_TITLE'])
      ->setLocation('post_type', '===', 'team');

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

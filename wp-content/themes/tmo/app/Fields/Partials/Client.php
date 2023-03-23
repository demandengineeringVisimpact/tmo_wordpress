<?php

namespace App\Fields\Partials;

use App\Fields\ClientProperties;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Client {
  public $builder;

  public static $_FIELDS = [
    'CLIENT' => 'client',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function getModel()
  {
    if ($post = get_field(self::$_FIELDS['CLIENT'], get_the_id())) {
      return (object) [
        'id' => $post->ID,
        'name' => $post->post_title,
        'logo' => get_the_post_thumbnail($post->ID),
        'logo_mono' => ClientProperties::monoLogo(),
      ];
    }
  }

  public static function meta()
  {
    return get_field(self::$_FIELDS['CLIENT'], get_the_id());
  }

  private function data()
  {
    return [
      'content' => $this->content(),
    ];
  }

  private function register()
  {
    $builder = new FieldsBuilder('client');

    $builder
      ->addPostObject(self::$_FIELDS['CLIENT'], [
        'post_type' => 'clients',
        'allow_null' => 1,
      ]);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }

  public function template()
  {
    return \App\template('partials.client', $this->data());
  }
}

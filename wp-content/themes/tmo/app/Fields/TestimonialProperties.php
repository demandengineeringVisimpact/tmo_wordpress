<?php

namespace App\Fields;

use App\Fields\Partials\Client;
use App\Fields\Partials\Video;
use StoutLogic\AcfBuilder\FieldsBuilder;

class TestimonialProperties {
  protected $builder;

  public static $_FIELDS = [
    'CUSTOMER_TITLE' => 'customer_title',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function title()
  {
    return get_field(self::$_FIELDS['CUSTOMER_TITLE'], get_the_id());
  }

  public static function videoUrl()
  {
    return Video::url(get_the_id());
  }

  public static function client()
  {
    return Client::getModel();
  }

  private function register()
  {
    $builder = new FieldsBuilder('testimonial_properties');
    $video = new Video();
    $client = new Client();

    $builder
      ->addText(self::$_FIELDS['CUSTOMER_TITLE'])
      ->addFields($video->builder)
      ->addFields($client->builder)
      ->setLocation('post_type', '===', 'testimonials');

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

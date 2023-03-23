<?php

namespace App\Fields;

use App\Fields\Partials\Video;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Webinar {
  protected $builder;

  public static $_FIELDS = [
  ];

  function __construct()
  {
    $this->register();
  }

  public static function videoUrl()
  {
    return Video::url(get_the_id());
  }

  private function register()
  {
    $builder = new FieldsBuilder('webinar', [
      'position' => 'side',
      'title' => 'Webinar Attributes',
    ]);
    $video = new Video();

    $builder
      ->addFields($video->builder)
      ->setLocation('post_type', '==', 'events')
      ->setLocation('post_taxonomy', '==', 'event_categories:webinars');

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

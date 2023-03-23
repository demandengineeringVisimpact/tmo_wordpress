<?php

namespace App\Fields\Partials;

use App\Fields\TestimonialProperties;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Testimonial {
  public $builder;

  public static $_FIELDS = [
    'TESTIMONIAL' => 'testimonial',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function getModel($post = null)
  {
    $post = $post ?? get_field(self::$_FIELDS['TESTIMONIAL'], get_the_id());

    return (object) [
      'id' => $post->ID,
      'person' => $post->post_title,
      'title' => TestimonialProperties::title(),
      'quote' => wpautop($post->post_content),
      'client' => TestimonialProperties::client(),
      'image' => get_the_post_thumbnail($post->ID, 'large'),
      'video' => TestimonialProperties::videoUrl(),
    ];
  }

  public static function meta()
  {
    return get_field(self::$_FIELDS['TESTIMONIAL']);
  }

  private function data()
  {
    return [
      'content' => $this->content(),
    ];
  }

  private function register()
  {
    $builder = new FieldsBuilder('testimonial');

    $builder
      ->addPostObject(self::$_FIELDS['TESTIMONIAL'], [
        'post_type' => 'testimonials',
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

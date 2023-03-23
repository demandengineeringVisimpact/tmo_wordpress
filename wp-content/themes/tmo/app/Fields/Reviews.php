<?php

namespace App\Fields;

use App\Blocks\Reviews as ReviewsBlock;
use App\Fields\Partials\Testimonial;
use StoutLogic\AcfBuilder\FieldsBuilder;
use WP_Query;

class Reviews {
  protected $builder;

  public static $_FIELDS = [
    'REVIEWS' => 'reviews',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function reviews()
  {
    global $post;

    $reviews = [];
    $posts = get_field(self::$_FIELDS['REVIEWS']);

    if (count($posts)) {
      foreach ($posts as $post) {
        setup_postdata($post);
        $testimonial = Testimonial::getModel($post);
        $review = [
          'title' => $testimonial->person,
          'content' => $testimonial->quote,
          'classes' => ['review'],
        ];

        if ($testimonial->client) {
          $review['eyebrow'] = $testimonial->client->name;
        }

        $reviews[] = $review;
      }

      wp_reset_postdata();
    }

    return $reviews;
  }

  private function register()
  {
    $builder = new FieldsBuilder('reviews');

    $builder
      ->addRelationship(self::$_FIELDS['REVIEWS'], [
        'post_type' => 'testimonials',
        'filters' => ['search'],
        'min' => 1,
      ])
      ->setLocation('block', '===', 'acf/' . ReviewsBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

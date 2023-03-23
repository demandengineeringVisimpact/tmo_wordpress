<?php

namespace App\Blocks;

use App\Fields\TestimonialLogos as TestimonialLogosFields;
use App\Fields\TestimonialProperties;
use WP_Query;

class TestimonialLogos
{
  public static $name = 'testimoniallogos';

  function __construct()
  {}

  private function testimonial()
  {
    $testimonial = (object)[];
    $testimonial_id = TestimonialLogosFields::testimonial();
    $query = new WP_Query([
      'p' => $testimonial_id,
      'post_type' => 'testimonials'
    ]);

    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $testimonial->customer = get_the_title();
        $testimonial->quote = wpautop(get_the_content());
        $testimonial->customerTitle = TestimonialProperties::title();
        $testimonial->videoUrl = TestimonialProperties::videoUrl();
        $testimonial->image = get_the_post_thumbnail(get_the_id(), 'large');
      }
    }
    wp_reset_postdata();

    return $testimonial;
  }

  private function data()
  {
    return [
      'actions' => TestimonialLogosFields::actions(),
      'logos' => TestimonialLogosFields::clients(),
      'testimonial' => $this->testimonial(),
      'title' => TestimonialLogosFields::title(),
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Testimonials and Company Logos'),
      'description' => __('Displays a list of customer logos and testimonials'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['testimonial', 'logos', 'customers'],
      'supports' => ['jsx' => true],
      'render_callback' => [$this, 'render'],
    ];
  }

  public function render()
  {
    if ($preview = get_field('preview')) {
      echo \App\template('partials.blocks.block-preview', ['preview', $preview]);
    }

    else {
      echo \App\template('partials.blocks.testimonial-logos', $this->data());
    }
  }
}

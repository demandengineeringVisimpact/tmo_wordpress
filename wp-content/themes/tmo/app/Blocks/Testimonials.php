<?php

namespace App\Blocks;

use App\Fields\Partials\Testimonial;
use App\Fields\Testimonials as TestimonialsField;

class Testimonials
{
  public static $name = 'testimonials';

  function __construct()
  {}

  private function list()
  {
    global $post;

    $testimonials = [];
    $rows = TestimonialsField::testimonials();

    if (!empty($rows)) {
      foreach ($rows as $row) {
        $post = $row['testimonial'];
        setup_postdata($post);
        $testimonials[] = Testimonial::getModel($post);
      }

      wp_reset_postdata();
    }

    return $testimonials;
  }

  private function data()
  {
    return [
      'testimonials' => $this->list(),
      'layout' => TestimonialsField::layout(),
      'showHeader' => TestimonialsField::layout() === TestimonialsField::$_LAYOUTS['TEXT_LEFT'],
      'allowedBlocks' => [
        'core/heading',
        'core/paragraph',
      ],
      'template' => [
        ['core/heading', [
          'placeholder' => 'Add a title',
          'level' => 2,
        ]],
        ['core/paragraph', [
          'content' => '<a href="#">Add a link</a>',
        ]],
      ],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Testimonials'),
      'description' => __('Adds a testimonial block'),
      'category' => 'text',
      'post_types' => ['page', 'clients'],
      'keywords' => ['testimonial', 'quote'],
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
      echo \App\template('partials.blocks.testimonials', $this->data());
    }
  }
}

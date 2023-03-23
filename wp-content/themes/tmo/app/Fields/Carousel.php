<?php

namespace App\Fields;

use App\Blocks\Carousel as CarouselBlock;
use App\Controllers\Single;
use App\Fields\ClientProperties;
use App\Fields\Event;
use StoutLogic\AcfBuilder\FieldsBuilder;
use WP_QUERY;

class Carousel {
  protected $builder;

  public static $_FIELDS = [
    'FUNCTION' => 'function',
    'POSTS_LIMIT' => 'posts_limit',
    'POST_TYPE' => 'post_type',
    'POSTS' => 'posts',
  ];

  public static $_FUNCTIONS = [
    'AUTOMATIC' => 'automatic',
    'MANUAL' => 'manual',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function getFunction()
  {
    return get_field(self::$_FIELDS['FUNCTION']);
  }

  public static function posts()
  {
    $posts = [];
    $args = [];

    if (self::getFunction() === self::$_FUNCTIONS['AUTOMATIC']) {
      $args['post_type'] = self::postType();
      $args['posts_per_page'] = self::postsLimit();

      if (self::postType() === 'clients') {
        $args['meta_key'] = ClientProperties::$_FIELDS['HIDE_FROM_FEED'];
        $args['meta_value'] = 1;
        $args['meta_compare'] = '!=';
      }

      if (self::postType() === 'events') {
        $args['meta_key'] = Event::$_FIELDS['EVENT_START_DATE'];
        $args['meta_type'] = 'DATETIME';
        $args['orderby'] = ['event_date' => 'DESC'];
        $args['meta_query'] = [
          'key' => Event::$_FIELDS['EVENT_START_DATE'],
          'compare' => '>',
          'type' => 'DATETIME',
          'value' => date('Y-m-d H:i:s'),
        ];
      }
    }

    if (self::getFunction() === self::$_FUNCTIONS['MANUAL']) {
      $args['post__in'] = get_field(self::$_FIELDS['POSTS']);
      $args['post_type'] = array_keys(self::getPostTypes());
    }

    $query = new WP_QUERY($args);

    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $post_type = get_post_type();
        $image_id = get_post_thumbnail_id();
        $size = 'medium';
        $eyebrow = '[Article Tag]';

        if (self::postType() == 'resources') {
          $eyebrow = yoast_get_primary_term('resource_categories', get_the_id());

          if (!$eyebrow) {
            $terms = get_the_terms(get_the_id(), 'resource_categories');
            $eyebrow = $terms[0]->name;
          }
        }

        if (self::postType() == 'post') {
          $single = new Single();
          $size = 'thumbnail';
          $eyebrow = \App\template('partials.entry-meta', [
            'post_categories' => $single->postCategories(),
          ]);

          if (!$image_id) {
            $image_id = CompanyInformation::placeholder();
          }
        }

        if (self::postType() == 'events') {
          $size = 'event_thumbnail';
          $eyebrow = \App\template('partials.entry-meta-event', [
            'event_date' => Event::eventDate(),
            'event_type' => Event::type(),
          ]);
        }

        $p = [
          'id' => get_the_id(),
          'title' => get_the_title(),
          'eyebrow' => $eyebrow,
          'content' => get_the_excerpt(),
          'action' => [
            'url' => get_the_permalink(),
            'title' => __('Learn More', 'tmo'),
          ],
          'image_id' => $image_id,
          'size' => $size,
          'classes' => [$post_type, 'swiper-slide'],
        ];

        if ($post_type === 'clients') {
          $p['eyebrow'] = get_the_title();
          $p['title'] = get_the_excerpt();
          $p['content'] = '';
          $p['action']['title'] = __('See Story', 'tmo');
          $p['action']['target'] = "_blank";

          if ($image_id = ClientProperties::monoLogoID()) {
            $p['image_id'] = $image_id;
          }
        }

        $posts[] = $p;
      }
    }

    return $posts;
  }

  public static function postType()
  {
    if ($post_type = get_field(self::$_FIELDS['POST_TYPE'])) {
      return $post_type;
    }

    return 'post';
  }

  public static function postsLimit()
  {
    return get_field(self::$_FIELDS['POSTS_LIMIT']);
  }

  public static function getPostTypes()
  {
    $types = [];
    $postTypes = get_post_types(['publicly_queryable' => true], 'objects');

    foreach ($postTypes as $postType) {
      if (!in_array($postType->name, ['attachment'])) {
        $types[$postType->name] = $postType->labels->singular_name;
      }
    }

    return $types;
  }

  private function getChoices($arr = [])
  {
    $choices = [];
    $values = array_values($arr);
    foreach ($values as $value) {
      $choices[$value] = ucwords(str_replace('_', ' ', $value));
    }
    return $choices;
  }

  private function register()
  {
    $builder = new FieldsBuilder('carousel');

    $builder
      ->addRadio(self::$_FIELDS['FUNCTION'], [
        'choices' => $this->getChoices(self::$_FUNCTIONS),
        'default_value' => self::$_FUNCTIONS['AUTOMATIC'],
      ])
      ->addSelect(self::$_FIELDS['POST_TYPE'], [
        'choices' => self::getPostTypes(),
        'default_value' => 'post',
      ])
        ->conditional(self::$_FIELDS['FUNCTION'], '==', self::$_FUNCTIONS['AUTOMATIC'])
      ->addNumber(self::$_FIELDS['POSTS_LIMIT'], [
        'min' => 1,
        'max' => 12,
        'default_value' => 6,
      ])
        ->conditional(self::$_FIELDS['FUNCTION'], '==', self::$_FUNCTIONS['AUTOMATIC'])
      ->addRelationship(self::$_FIELDS['POSTS'], [
        'post_type' => array_keys(self::getPostTypes()),
        'min' => 1,
        'max' => 12,
        'return_format' => 'id',
      ])
        ->conditional(self::$_FIELDS['FUNCTION'], '==', self::$_FUNCTIONS['MANUAL'])
      ->setLocation('block', '===', 'acf/' . CarouselBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

<?php

namespace App\Fields;

use App\Blocks\PostsFeed as PostsFeedBlock;
use App\Fields\ClientProperties;
use StoutLogic\AcfBuilder\FieldsBuilder;
use WP_Query;

class PostsFeed {
  protected $builder;

  public static $_FIELDS = [
    'ARCHIVE_LINK_TEXT' => 'archive_link_text',
    'POST_TYPE' => 'post_type',
    'POSTS_LIMIT' => 'posts_limit',
    'TITLE' => 'title',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function archiveLink()
  {
    $postType = self::postType();
    return (object) [
      'text' => get_field(self::$_FIELDS['ARCHIVE_LINK_TEXT']),
      'url' => get_post_type_archive_link($postType),
    ];
  }

  public static function postType()
  {
    return get_field(self::$_FIELDS['POST_TYPE']);
  }

  public static function postsLimit()
  {
    return get_field(self::$_FIELDS['POSTS_LIMIT']);
  }

  public static function title()
  {
    return get_field(self::$_FIELDS['TITLE']);
  }

  public static function posts() {
    $posts = [];
    $args = [
      'post_type' => self::postType(),
      'posts_per_page' => self::postsLimit(),
    ];

    if (self::postType() === 'clients') {
      $args['meta_key'] = ClientProperties::$_FIELDS['HIDE_FROM_FEED'];
      $args['meta_value'] = 1;
      $args['meta_compare'] = '!=';
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $posts[] = \App\template('partials.content');
      }
    }

    wp_reset_postdata();

    return $posts;
  }

  private function getPostTypes()
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

  private function register()
  {
    $builder = new FieldsBuilder('postsfeed');

    $builder
      ->addText(self::$_FIELDS['TITLE'])
      ->addSelect(self::$_FIELDS['POST_TYPE'], [
        'choices' => $this->getPostTypes(),
        'default' => 'post',
      ])
      ->addText(self::$_FIELDS['ARCHIVE_LINK_TEXT'], ['default' => 'View All'])
      ->addNumber(self::$_FIELDS['POSTS_LIMIT'], [
        'min' => 1,
        'max' => 12,
        'default_value' => 4
      ])
      ->setLocation('block', '===', 'acf/' . PostsFeedBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

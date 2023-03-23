<?php

namespace App\Fields;

use App\Fields\Partials\ArchiveSettings;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ClientsArchiveSettings {
  protected $builder;

  private $settings;

  public static $_FIELDS = [
    'FEATURED_LOGOS' => 'featured_logos',
  ];

  function __construct()
  {
    $this->settings = new ArchiveSettings('client_');
    $this->register();
  }

  public function title()
  {
    return $this->settings->title();
  }

  public function description()
  {
    return $this->settings->description();
  }

  public function image()
  {
    return $this->settings->image();
  }

  public function pageLimit()
  {
    return $this->settings->pageLimit();
  }

  public function logos()
  {
    $logos = [];
    $post_ids = get_field(self::$_FIELDS['FEATURED_LOGOS'], 'options');

    if (count($post_ids)) {
      foreach($post_ids as $post_id) {
        $logos[] = get_the_post_thumbnail($post_id, 'medium');
      }
    }

    return $logos;
  }

  private function register()
  {
    $builder = new FieldsBuilder('clientsArchiveSettings');
    $builder
      ->addFields($this->settings->builder)
      ->addRelationship(self::$_FIELDS['FEATURED_LOGOS'], [
        'post_type' => 'clients',
        'min' => 4,
        'return_format' => 'id',
        'elements' => ['featured_image'],
        'filters' => ['search'],
      ])
      ->setLocation('options_page', '===', 'clients-archive-settings');

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

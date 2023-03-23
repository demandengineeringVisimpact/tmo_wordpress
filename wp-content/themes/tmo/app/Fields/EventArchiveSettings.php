<?php

namespace App\Fields;

use App\Fields\Partials\ArchiveSettings;
use StoutLogic\AcfBuilder\FieldsBuilder;

class EventArchiveSettings {
  protected $builder;

  private $settings;

  public static $_FIELDS = [
  ];

  function __construct()
  {
    $this->settings = new ArchiveSettings('event_');
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

  private function register()
  {
    $builder = new FieldsBuilder('eventArchiveSettings');

    $builder
      ->addFields($this->settings->builder)
      ->setLocation('options_page', '===', 'event-archive-settings');

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

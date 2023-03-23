<?php

namespace App\Fields;

use DateTime;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Event {
  protected $builder;

  public static $_FIELDS = [
    'EVENT_END_DATE' => 'event_end_date',
    'EVENT_LOCATION' => 'event_location',
    'EVENT_START_DATE' => 'event_start_date',
    'EVENT_TYPE' => 'event_type',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function startDate()
  {
    return get_field(self::$_FIELDS['EVENT_START_DATE'], get_the_id());
  }

  public static function endDate()
  {
    return get_field(self::$_FIELDS['EVENT_END_DATE'], get_the_id());
  }

  public static function type()
  {
    return get_field(self::$_FIELDS['EVENT_TYPE']);
  }

  public static function location()
  {
    return get_field(self::$_FIELDS['EVENT_LOCATION']);
  }

  public static function eventDate()
  {
    try {
      $start_date = new DateTime(self::startDate());
      $end_date = new DateTime(self::endDate());

      if ($start_date->format('Y-m-d') !== $end_date->format('Y-m-d')) {
        // Different Years
        if ($start_date->format('Y') !== $end_date->format('Y')) {
          return sprintf("%s - %s",
            $start_date->format('F d, Y'),
            $end_date->format('F d, Y')
          );
        }

        // Different Months
        if ($start_date->format('Y-m') !== $end_date->format('Y-m')) {
          return sprintf("%s - %s",
            $start_date->format('F d'),
            $end_date->format('F d, Y')
          );
        }

        // Different Days
        return sprintf("%s - %s",
          $start_date->format('F d'),
          $end_date->format('d, Y')
        );
      }

      // Same Day
      return $start_date->format('F d, Y');

    } catch (Exception $e) {
      return '';
    }
  }

  private function register()
  {
    $builder = new FieldsBuilder('event', [
      'position' => 'side',
      'title' => 'Event Attributes',
    ]);

    $builder
      ->addDateTimePicker(self::$_FIELDS['EVENT_START_DATE'], [
        'display_format' => 'F j, Y g:i a',
        'return_format' => 'Y-m-d H:i:s',
        'first_day' => 0,
      ])
      ->addDateTimePicker(self::$_FIELDS['EVENT_END_DATE'], [
        'display_format' => 'F j, Y g:i a',
        'return_format' => 'Y-m-d H:i:s',
        'first_day' => 0,
      ])
      ->addText(self::$_FIELDS['EVENT_TYPE'])
      ->addText(self::$_FIELDS['EVENT_LOCATION'])
      ->setLocation('post_type', '==', 'events');

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

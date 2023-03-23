<?php

namespace App\Fields\Partials;

use StoutLogic\AcfBuilder\FieldsBuilder;

class ArchiveSettings {
  public $builder;

  public $prefix;

  public static $_FIELDS = [
    'TITLE' => 'title',
    'DESCRIPTION' => 'description',
    'IMAGE' => 'image',
    'PAGE_LIMIT' => 'page_limit',
  ];

  function __construct($prefix = "")
  {
    $this->prefix = $prefix;
    $this->register();
  }

  public function title()
  {
    return get_field($this->prefix . self::$_FIELDS['TITLE'], 'options');
  }

  public function description()
  {
    return get_field($this->prefix . self::$_FIELDS['DESCRIPTION'], 'options');
  }

  public function image()
  {
    return wp_get_attachment_image(
      get_field($this->prefix . self::$_FIELDS['IMAGE'], 'options'),
      'large'
    );
  }

  public function pageLimit()
  {
    return get_field($this->prefix . self::$_FIELDS['PAGE_LIMIT'], 'options') ?: 6;
  }

  private function register()
  {
    $builder = new FieldsBuilder('archiveSettings');

    $builder
      ->addText($this->prefix . self::$_FIELDS['TITLE'])
      ->addWysiwyg($this->prefix . self::$_FIELDS['DESCRIPTION'])
      ->addImage($this->prefix . self::$_FIELDS['IMAGE'], ['return_format' => 'id'])
      ->addNumber($this->prefix . self::$_FIELDS['PAGE_LIMIT'], [
        'min' => 1,
        'max' => 12,
        'default_value' => 6,
      ]);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

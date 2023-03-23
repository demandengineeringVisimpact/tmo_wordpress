<?php

namespace App\Fields;

use App\Blocks\Hero as HeroBlock;
use App\Fields\Partials\Video;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Hero {
  protected $builder;

  public static $_FIELDS = [
    'FEATURED_IMAGE' => 'featured_image',
    'LAYOUT' => 'layout',
    'FORM' => 'form',
  ];

  public static $_LAYOUTS = [
    'DEFAULT' => 'default',
    'VERTICAL' => 'vertical',
    'WITH_FORM' => 'with_form',
    'INLINE_VIDEO' => 'inline_video',
  ];

  function __construct()
  {
    $this->register();
  }

  public static function form()
  {
    return get_field(self::$_FIELDS['FORM']);
  }

  public static function video()
  {
    return Video::url();
  }

  public static function featuredImage()
  {
    $id = get_field(self::$_FIELDS['FEATURED_IMAGE']);
    $layout = self::layout();

    if (!$id) {
      return null;
    }

    return wp_get_attachment_image(
      $id,
      $layout === self::$_LAYOUTS['VERTICAL'] ? 'full' : 'large'
    );
  }

  public static function layout()
  {
    return get_field(self::$_FIELDS['LAYOUT']) ?: self::$_LAYOUTS['DEFAULT'];
  }

  private function getChoices()
  {
    $choices = [];
    $values = array_values(self::$_LAYOUTS);
    foreach ($values as $value) {
      $choices[$value] = ucwords(str_replace('_', ' ', $value));
    }
    return $choices;
  }

  private function register()
  {
    $builder = new FieldsBuilder('hero');
    $video = new Video();

    $builder
      ->addSelect(self::$_FIELDS['LAYOUT'], [
        'choices' => $this->getChoices(),
        'default_value' => self::$_LAYOUTS['DEFAULT'],
        'return_format' => 'value',
      ])
      ->addPostObject(self::$_FIELDS['FORM'], [
        'post_type' => 'wpcf7_contact_form',
        'return_format' => 'id',
      ])
        ->conditional(self::$_FIELDS['LAYOUT'], '==', self::$_LAYOUTS['WITH_FORM'])
      ->addImage(self::$_FIELDS['FEATURED_IMAGE'], ['return_format' => 'id'])
      ->addFields($video->builder)
      ->setLocation('block', '===', 'acf/' . HeroBlock::$name);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }
}

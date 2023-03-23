<?php

namespace App\Fields\Partials;

use StoutLogic\AcfBuilder\FieldsBuilder;

class Icon {
  public $builder;

  public $is_sub;

  public static $_FIELDS = [
    'ICON' => 'icon',
  ];

  function __construct($is_sub = false)
  {
    $this->is_sub = $is_sub;
    $this->register();
  }

  protected function generateLabel($name)
  {
      return ucwords(str_replace('_', ' ', $name));
  }

  private function choices()
  {
    $choices = [];

    try {
      $file = get_stylesheet_directory() . '/assets/fonts/icomoon/selection.json';
      $icons = json_decode(file_get_contents($file), true);

      foreach ($icons['icons'] as $icon) {
        $name = $icon['properties']['name'];
        $choices[$name] = $this->generateLabel($icon['properties']['name']);
      }

      uasort($choices, function($a, $b) {
        if ($a === $b) return 0;
        return ($a < $b) ? -1 : 1;
      });
    }

    catch (Exception $e) {
    }

    return $choices;
  }

  public static function selected($isSub = false, $id = null)
  {
    $field_name = self::$_FIELDS['ICON'];
    $id = $id ?? get_the_id();

    if ($isSub) {
      return get_sub_field($field_name, $id);
    }

    return get_field($field_name, $id);
  }

  private function register()
  {
    $builder = new FieldsBuilder('icon');

    $builder
      ->addSelect(self::$_FIELDS['ICON'], [
        'allow_null' => true,
        'choices' => $this->choices(),
        'return_format' => 'value',
      ]);

    $this->builder = $builder;
  }

  public function build()
  {
    return $this->builder->build();
  }

  public static function template($isSub = false, $id = null)
  {
    return \App\template('partials.icon', ['icon' => self::selected($isSub, $id)]);
  }
}

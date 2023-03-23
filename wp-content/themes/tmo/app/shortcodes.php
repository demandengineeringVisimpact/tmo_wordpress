<?php

namespace App;

if (function_exists('add_shortcode'))
{
  $classes = [
    Shortcodes\Year::class,
  ];

  foreach($classes as $className)
  {
    add_shortcode($className::$name, [new $className, 'register']);
  }
}

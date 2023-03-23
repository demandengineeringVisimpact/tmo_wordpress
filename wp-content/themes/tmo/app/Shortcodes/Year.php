<?php

namespace App\Shortcodes;

class Year
{
  public static $name = 'year';

  function __construct()
  {
  }

  public function register()
  {
    return date('Y');
  }
}

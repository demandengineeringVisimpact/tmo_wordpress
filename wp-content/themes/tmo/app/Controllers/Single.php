<?php

namespace App\Controllers;

use App\Fields\Resource;
use Sober\Controller\Controller;

class Single extends Controller
{
  public function postCategories()
  {
    $post_id = get_the_id();
    $args = ['fields' => 'all'];
    return wp_get_post_categories($post_id, $args);
  }

  public function categories()
  {
    return get_categories();
  }
}

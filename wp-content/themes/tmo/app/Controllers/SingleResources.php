<?php

namespace App\Controllers;

use App\Fields\Resource;
use Sober\Controller\Controller;

class SingleResources extends Controller
{
  public function readTime()
  {
    return Resource::readTime();
  }

  public function background()
  {
    return get_the_post_thumbnail_url();
  }
}

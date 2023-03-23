<?php

namespace App\Controllers;

use App\Fields\ClientsArchiveSettings;
use Sober\Controller\Controller;

class ArchiveClients extends Controller
{
  private $settings;

  function __construct()
  {
    $this->settings = new ClientsArchiveSettings();
  }

  public function archiveTitle()
  {
    return $this->settings->title();
  }

  public function archiveDescription()
  {
    return $this->settings->description();
  }

  public function archiveImage()
  {
    return $this->settings->image();
  }

  public function archiveLogos()
  {
    return $this->settings->logos();
  }

  public function background()
  {
    return get_the_post_thumbnail_url();
  }
}

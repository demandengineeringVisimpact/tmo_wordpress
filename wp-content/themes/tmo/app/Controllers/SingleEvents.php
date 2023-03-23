<?php

namespace App\Controllers;

use App\Fields\Event;
use App\Fields\Resource;
use App\Fields\Webinar;
use DateTime;
use Sober\Controller\Controller;
use WP_Term_Query;

class SingleEvents extends Controller
{
  public function featuredImage()
  {
    global $post;
    return get_the_post_thumbnail($post->ID, 'large');
  }

  public function eventDate()
  {
    return Event::eventDate();
  }

  public function eventLocation()
  {
    return Event::location();
  }

  public function eventType()
  {
    return Event::type();
  }

  public function isPast()
  {
    $now = new DateTime('now');
    $end_date = new DateTime(Event::endDate());

    return $now > $end_date;
  }

  public function isWebinar()
  {
    global $post;
    $terms = get_the_terms($post, 'event_categories');
    return array_search('webinars', array_column($terms, 'slug')) !== false;
  }

  public function video()
  {
    return Webinar::videoUrl();
  }

  public function terms()
  {
    $query = new WP_Term_Query([
      'taxonomy' => 'event_categories',
      'orderby' => 'name',
      'order' => 'ASC',
    ]);

    $terms = $query->get_terms();

    array_unshift($terms, (object)[
      'name' => __('Upcoming Events', 'tmo'),
      'slug' => 'upcoming-events',
    ]);

    return $terms;
  }
}

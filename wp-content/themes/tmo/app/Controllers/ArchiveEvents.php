<?php

namespace App\Controllers;

use App\Fields\CompanyInformation;
use App\Fields\Event;
use App\Fields\EventArchiveSettings;
use DateTime;
use Sober\Controller\Controller;
use WP_Term_Query;

class ArchiveEvents extends Controller
{
  private $settings;

  function __construct()
  {
    $this->settings = new EventArchiveSettings();
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

  public function events()
  {
    global $post;
    $events = $this->terms();

    while (have_posts()) {
      the_post();
      $terms = get_the_terms(
        $post,
        'event_categories'
      );
      $term = !empty($terms) ? $terms[0] : (object)[
        "name" => "Upcoming Events",
        "slug" => "upcoming-events"
      ];
      $index = array_search($term->slug, array_column($events, 'slug'));

      if (!isset($events[$index]->posts)) {
        $events[$index]->posts = [];
      }

      $id = get_the_id();
      $events[$index]->posts[] = [
        'id' => $id,
        'title' => get_the_title($id),
        'content' => get_the_excerpt($id),
        'image_id' => get_post_thumbnail_id($id) ?: CompanyInformation::placeholder(),
        'size' => 'medium',
        'eyebrow' => \App\template('partials.entry-meta-event', [
          'event_date' => Event::eventDate(),
          'event_type' => Event::type(),
          'event_location' => Event::location(),
        ]),
        'action' => [
          'title' => __('Learn More', 'tmo'),
          'url' => get_the_permalink($id),
        ],
        'classes' => [$term->slug],
      ];
    }

    return $events;
  }
}

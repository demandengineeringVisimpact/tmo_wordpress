<?php

namespace App\Blocks;

use WP_QUERY;
use App\Fields\TeamProperties;
use App\Fields\Team as TeamFields;

class Team
{
  public static $name = 'team';

  function __construct()
  {}

  private function listTeam()
  {
    $team = [];
    $args = [
      'post_type' => 'team',
      'posts_per_page' => -1,
      'orderby' => 'menu_order',
      'order' => 'ASC',
    ];

    $query = new WP_QUERY($args);

    if ($query->have_posts()) {
      while ($query->have_posts()) {
        $query->the_post();
        $team[] = (object)[
          'id' => get_the_id(),
          'name' => get_the_title(),
          'title' => TeamProperties::jobTitle(),
          'headshot' => get_post_thumbnail_id(get_the_id()),
        ];
      }
    }

    return $team;
  }

  private function data()
  {
    return [
      'team' => $this->listTeam(),
      'careersBlurb' => TeamFields::careersBlurb(),
      'careersUrl' => TeamFields::careersUrl(),
      'allowedBlocks' => [
        'acf/eyebrow',
        'core/heading',
      ],
      'template' => [
        ['acf/eyebrow'],
        ['core/heading', [
          'className' => 'team__title',
          'placeholder' => 'Add a title',
          'level' => 2,
        ]],
      ],
    ];
  }

  public function build()
  {
    return [
      'name' => self::$name,
      'title' => __('Team'),
      'description' => __('Adds a section about the company team'),
      'category' => 'media',
      'post_types' => ['page'],
      'keywords' => ['team'],
      'supports' => ['jsx' => true],
      'render_callback' => [$this, 'render'],
    ];
  }

  public function render()
  {
    if ($preview = get_field('preview')) {
      echo \App\template('partials.blocks.block-preview', ['preview', $preview]);
    }

    else {
      echo \App\template('partials.blocks.team', $this->data());
    }
  }
}

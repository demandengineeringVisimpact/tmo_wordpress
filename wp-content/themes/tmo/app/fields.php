<?php

namespace App;

if (function_exists('acf_add_local_field_group'))
{
  \add_action('acf/init', function()
  {
    $classes = [
      Fields\Carousel::class,
      Fields\ClientAbout::class,
      Fields\ClientProperties::class,
      Fields\ClientsArchiveSettings::class,
      Fields\CompanyInformation::class,
      Fields\ContentIcon::class,
      Fields\ContentMedia::class,
      Fields\CustomerList::class,
      Fields\CustomerLogos::class,
      Fields\Event::class,
      Fields\EventArchiveSettings::class,
      Fields\FAQs::class,
      Fields\Features::class,
      Fields\Hero::class,
      Fields\HistoryProperties::class,
      Fields\InterstitialForm::class,
      Fields\Logos::class,
      Fields\MajorSolutions::class,
      Fields\Menu::class,
      Fields\MenuItem::class,
      Fields\Page::class,
      Fields\PostsFeed::class,
      Fields\Resource::class,
      Fields\Reviews::class,
      Fields\Stats::class,
      Fields\Tabs::class,
      Fields\Team::class,
      Fields\TeamProperties::class,
      Fields\TestimonialLogos::class,
      Fields\TestimonialProperties::class,
      Fields\Testimonials::class,
      Fields\Tiles::class,
      Fields\Tools::class,
      Fields\Webinar::class,
    ];

    foreach($classes as $className)
    {
      $item = new $className();
      \acf_add_local_field_group($item->build());
    }
  });
}

<?php

namespace App;

$classes = [
  Blocks\Awards::class,
  Blocks\Blog::class,
  Blocks\Carousel::class,
  Blocks\ChildPages::class,
  Blocks\ClientAbout::class,
  Blocks\ContentIcon::class,
  Blocks\ContentMedia::class,
  Blocks\CustomerList::class,
  Blocks\CustomerLogos::class,
  Blocks\Eyebrow::class,
  Blocks\FAQs::class,
  Blocks\Features::class,
  Blocks\Hero::class,
  Blocks\History::class,
  Blocks\Interstitial::class,
  Blocks\InterstitialForm::class,
  Blocks\Introduction::class,
  Blocks\MajorSolutions::class,
  Blocks\PostsFeed::class,
  Blocks\Ratings::class,
  Blocks\Reviews::class,
  Blocks\SideMenu::class,
  Blocks\Sitemap::class,
  Blocks\Solutions::class,
  Blocks\Stats::class,
  Blocks\Tabs::class,
  Blocks\Team::class,
  Blocks\TestimonialLogos::class,
  Blocks\Testimonials::class,
  Blocks\Tiles::class,
  Blocks\Tools::class,
];

if (function_exists('acf_register_block_type'))
{
  \add_action('acf/init', function() use ($classes)
  {
    foreach($classes as $className)
    {
      $item = new $className();
      \acf_register_block_type($item->build());
    }
  });
}

add_filter('allowed_block_types_all', function($allowed) use ($classes)
{
  $allowed = [];

  foreach($classes as $className)
  {
    $allowed[] = "acf/{$className::$name}";
  }

  $allowed = array_merge($allowed, [
    'contact-form-7/contact-form-selector',
    'core/button',
    'core/buttons',
    'core/code',
    'core/columns',
    'core/embed',
    'core/group',
    'core/heading',
    'core/image',
    'core/list',
    'core/paragraph',
    'core/pullquote',
    'core/quote',
    'core/shortcode',
    'core/table',
    'core/video',
    'yoast/faq-block',
    'yoast/how-to-block',
  ]);

  return $allowed;
});

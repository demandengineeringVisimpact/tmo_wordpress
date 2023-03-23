@include('partials.card', [
  'title' => 'Want to Learn About Upcoming Webinars?',
  'content' => '<p>Contact us today to be among the first to know about everything happening with The Mortgage Office</p>',
  'action' => [
    'url' => 'mailto:sales@absnetwork.com?subject=I am interested in your webinars',
    'title' => 'Email Us Today',
  ],
  'classes' => ['mailing-list', 'swiper-slide'],
])

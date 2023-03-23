<div class="block -testimonials layout-{{ $layout }}">
  <div class="container">
    @if ($showHeader)
      <div class="testimonials__header">
        <InnerBlocks
          allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
          template="{{ wp_json_encode($template) }}"
        />
      </div>
    @endif

    <div class="testimonials swiper">
      <div class="swiper-wrapper">
        @foreach ($testimonials as $testimonial)
          <div class="swiper-slide">
            @include('partials/testimonial', [
              'testimonial' => $testimonial,
              'layout' => $layout,
            ])
          </div>
        @endforeach
      </div>

      <div class="testimonials__footer">
        @if ($layout === App\Fields\Testimonials::$_LAYOUTS['WITH_IMAGE'])
          <a
            href="/customer-stories/"
            class="testimonials__action"
          >{{ __('See Our Customer Reviews') }}</a>
        @endif

        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>
</div>

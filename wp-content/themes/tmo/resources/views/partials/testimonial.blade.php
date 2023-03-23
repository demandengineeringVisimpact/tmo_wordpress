<figure class="testimonial">
  @if ($layout === App\Fields\Testimonials::$_LAYOUTS['WITH_IMAGE'])
    <div class="testimonial__media">
      {!! $testimonial->image !!}
    </div>
  @endif

  @if ($testimonial->client && $testimonial->client->logo)
    <div class="client__logo">
      {!! $testimonial->client->logo !!}
    </div>
  @endif

  <blockquote class="testimonial__quote">
    {!! $testimonial->quote !!}
  </blockquote>

  <figcaption class="testimonial__cite">
    <span class="testimonial__person">{{ $testimonial->person }}</span>
    <span class="testimonial__title">{{ $testimonial->title }}</span>

    @if ($testimonial->client)
      <span class="testimonial__client">{{ $testimonial->client->name }}</span>
    @endif

    @if (!empty($testimonial->video) && $layout === App\Fields\Testimonials::$_LAYOUTS['WITH_IMAGE'])
      <a
        href="{{ $testimonial->video }}"
        class="testimonial__video fancybox"
      >{{ __('Watch the Video', 'tmo') }}</a>
    @endif
  </figcaption>
</figure>

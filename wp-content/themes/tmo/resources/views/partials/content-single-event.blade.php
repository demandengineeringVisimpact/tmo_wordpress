@php global $post @endphp
<article @php post_class('container') @endphp>
  <header class="entry__header">
    @include('partials/entry-meta-event')

    <h1 class="entry__title">
      {!! get_the_title() !!}
    </h1>
  </header>

  <figure class="entry__figure">
    @if (!empty($video))
      <a href="{{ $video }}" class="fancybox">
        {!! $featured_image !!}
      </a>
    @else
      {!! $featured_image !!}
    @endisset
  </figure>

  <div class="entry__content">
    <div class="entry__social">
      Share this event
      @include('partials/social-sharing')
    </div>

    @php the_content() @endphp

    {{-- <div class="wp-block-button">
      <a
        href="#"
        class="wp-block-button__link"
      >{{ __('Schedule a Demo', 'tmo') }}</a>
    </div> --}}
  </div>

  <aside class="entry__aside">
    @if (!$is_past)
      {!! do_shortcode('[contact-form-7 id="520" title="Event Signup"]') !!}
    @else
      @include('partials.sidebar-events')
    @endif
  </aside>
</article>

@if ($is_webinar)
  @include('partials/feed-webinars')
@else
  @include('partials/feed-resources')
@endif

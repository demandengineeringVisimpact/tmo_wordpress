<article @php post_class('entry swiper-slide') @endphp>
  <header class="entry__header">
    <h2 class="entry__title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
    {{-- @include('partials/entry-meta') --}}
  </header>

  <div class="entry__summary">
    @php the_excerpt() @endphp
  </div>

  <div class="entry__actions">
    <a
      href="{{ get_permalink() }}"
      class="entry__permalink rarr"
    >{{ __('Read More') }}</a>
  </div>
</article>

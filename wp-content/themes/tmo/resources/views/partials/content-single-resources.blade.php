<article
  @php post_class('container') @endphp
  style="--background: url({{ $background }});"
>
  <header class="entry__header">
    @include('partials/entry-meta-resources')

    <h1 class="entry__title">
      {!! get_the_title() !!}
    </h1>
  </header>

  <div class="entry__content">
    <div class="entry__social">
      Share this article
      @include('partials/social-sharing')
    </div>

    @php the_content() @endphp

    <div class="wp-block-button">
      <a
        href="#"
        class="wp-block-button__link"
      >{{ __('Schedule a Demo', 'tmo') }}</a>
    </div>
  </div>

  @if (has_nav_menu('resources'))
    <aside class="entry__aside">
      <h3>Browse by</h3>
      {!! wp_nav_menu([
        'theme_location' => 'resources',
        'menu_class' => 'nav',
      ]) !!}
    </aside>
  @endif
</article>

@include('partials/feed-resources')

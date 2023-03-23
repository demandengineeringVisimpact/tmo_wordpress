<article @php post_class('container') @endphp>
  <header class="entry__header">
    <div class="entry__meta">
      @include('partials/entry-meta')
    </div>

    <h1 class="entry__title">
      {!! get_the_title() !!}
    </h1>

    <div class="entry__thumbnail">
      {!! get_the_post_thumbnail(null, 'large') !!}
    </div>
  </header>

  <div class="entry__content">
    <div class="entry__social">
      Share this article
      @include('partials/social-sharing')
    </div>

    @php the_content() @endphp
  </div>

  <aside class="entry__sidebar">
    <h3>{{ __('Browse By', 'tmo') }}</h3>

    <ul class="categories">
      @foreach ($categories as $category)
        <li class="category">
          <a
            href="{{ get_category_link($category) }}"
            class="category__link"
          >{{ $category->name }}</a>
        </li>
      @endforeach
    </ul>
  </aside>
</article>

@include('partials/feed-posts')

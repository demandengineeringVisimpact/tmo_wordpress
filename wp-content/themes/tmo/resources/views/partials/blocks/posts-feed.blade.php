<div class="block -posts-feed">
  <div class="container">
    <div class="posts-feed__header">
      <h2 class="posts-feed__title">{{ $title }}</h2>
      <a
        href="{{ $link->url }}"
        class="posts-feed__link rarr"
      >{{ $link->text }}</a>
    </div>

    <div class="posts-feed__body swiper">
      <div class="feed swiper-wrapper">
        @foreach ($posts as $p)
          {!! $p !!}
        @endforeach
      </div>

      <div class="swiper-actions">
        <div class="swiper-button-prev"></div>

        <div class="swiper-button-next" tabindex="0"></div>
      </div>
    </div>
  </div>
</div>

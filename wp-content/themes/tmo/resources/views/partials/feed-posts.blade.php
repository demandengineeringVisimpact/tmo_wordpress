<div class="feed -resources">
  <div class="container swiper">
    <div class="feed__header">
      <h2>{{ __('Recent Articles', 'tmo') }}</h2>

      <div class="swiper-actions">
        <div class="swiper-button-prev"></div>

        <div class="swiper-button-next" tabindex="0"></div>
      </div>
    </div>

    <div class="cardlist swiper-wrapper">
      @foreach ($posts as $p)
        @include('partials/card', $p)
      @endforeach
    </div>
  </div>
</div>

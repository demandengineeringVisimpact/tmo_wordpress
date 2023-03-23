<div class="feed -webinars">
  <div class="container swiper">
    <div class="feed__header">
      <p class="eyebrow">{{ __('Past Webinars', 'tmo') }}</p>
      <h2>{{ __('A Title About Our Past Webinars', 'tmo') }}</h2>

      <div class="swiper-actions">
        <div class="swiper-button-prev"></div>

        <div class="swiper-button-next" tabindex="0"></div>
      </div>
    </div>

    <div class="cardlist swiper-wrapper">
      @foreach ($past_webinars as $i => $card)
        @include('partials/card', $card)

        @if ($i === 2)
          @include('partials/mailing-list')
        @endif
      @endforeach

      @if (count($past_webinars) < 3)
        @include('partials/mailing-list')
      @endif
    </div>
  </div>
</div>

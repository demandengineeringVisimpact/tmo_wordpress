<div class="block -carousel">
  <div class="container swiper">
    <div class="carousel__header">
      <div class="carousel__content">
        <InnerBlocks
          allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
          template="{{ wp_json_encode($template) }}"
        />
      </div>

      <div class="swiper-actions">
        <div class="swiper-button-prev"></div>

        <div class="swiper-button-next" tabindex="0"></div>
      </div>
    </div>

    <div class="cardlist swiper-wrapper">
      @foreach ($posts as $i => $post)
        @include('partials/card', $post)

        @if ($postType === 'events' && $i === 2)
          @include('partials/mailing-list')
        @endif
      @endforeach

      @if ($postType === 'events' && count($posts) < 3)
        @include('partials/mailing-list')
      @endif
    </div>
  </div>
</div>

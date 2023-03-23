<div class="block -history">
  <div class="container">
    <div class="history__header">
      <InnerBlocks
        allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
        template="{{ wp_json_encode($template) }}"
      />
    </div>
  </div>

  <div class="history">
    <div class="swiper">
      <div class="swiper-wrapper">
        @foreach ($history as $period)
          <div class="period swiper-slide">
            @include('partials.card', [
              'content' => $period->content,
              'eyebrow' => $period->year,
              'title' => $period->title,
              'classes' => ['-history'],
            ])
          </div>
        @endforeach
      </div>

      <div class="swiper-button-prev"></div>

      <div class="swiper-button-next" tabindex="0"></div>
    </div>
  </div>
</div>

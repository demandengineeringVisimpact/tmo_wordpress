<div class="block -awards">
  <div class="container">
    <div class="awards__header">
      <InnerBlocks
        allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
        template="{{ wp_json_encode($template) }}"
      />
    </div>

    <div class="awards">
      <div class="swiper">
        <div class="swiper-wrapper">
          @foreach ($awards as $award)
            <div class="award swiper-slide">
              {!! $award !!}
            </div>
          @endforeach
        </div>
      </div>

      <div class="swiper-button-prev"></div>

      <div class="swiper-button-next" tabindex="0"></div>
    </div>
  </div>
</div>

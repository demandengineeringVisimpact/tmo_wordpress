<div class="block -customerList">
  <div class="container swiper">
    <div class="customerList__header">
      <InnerBlocks
        allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
        template="{{ wp_json_encode($template) }}"
      />
    </div>

    <ul class="customerList__logos swiper-wrapper">
    @foreach ($logos as $logo)
      <li class="customerList__logo swiper-slide">
        {!! $logo !!}
      </li>
    @endforeach
    </ul>
  </div>
</div>

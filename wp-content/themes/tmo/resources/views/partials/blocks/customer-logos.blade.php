<div class="block -customerLogos">
  <div class="container">
    <div class="customerLogos__content">
      <InnerBlocks
        allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
        template="{{ wp_json_encode($template) }}"
      />
    </div>
    <ul class="customerLogos__logos">
    @foreach ($logos as $logo)
      <li class="customerLogos__logo">
        {!! $logo !!}
      </li>
    @endforeach
    </ul>
  </div>
</div>

<div class="block -major-solutions">
  <div class="container">
    <div class="major-solutions__content">
      <InnerBlocks
        allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
        template="{{ wp_json_encode($template) }}"
      />
    </div>

    <div class="solutions">
      {!! $cards !!}
    </div>
  </div>
</div>

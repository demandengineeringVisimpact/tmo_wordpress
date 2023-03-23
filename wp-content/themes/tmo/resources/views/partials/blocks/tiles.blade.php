<div class="block -tiles layout-{{ $layout }}">
  <div class="container">
    <div class="tiles__header">
      <InnerBlocks
        allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
        template="{{ wp_json_encode($template) }}"
      />
    </div>

    <div class="tiles">
      {!! $tiles !!}
    </div>
  </div>
</div>

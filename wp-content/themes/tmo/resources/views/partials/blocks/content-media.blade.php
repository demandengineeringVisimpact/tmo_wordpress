<div class="block -contentMedia -{{ $direction }} -position-{{ $position }} -style-{{ $style }}">
  <div class="container">
    <InnerBlocks
      allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
      template="{{ wp_json_encode($template) }}"
    />
  </div>
</div>

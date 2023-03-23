<div class="block -tabs layout-{{ $layout }}">
  <div class="container">
    <div class="tabs__header">
      <InnerBlocks
        allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
        template="{{ wp_json_encode($template) }}"
      />
    </div>
    <div class="tabs" style="--count: {{ count($tabs) }}">
      @foreach ($tabs as $tab)
        {!! $tab !!}
      @endforeach
    </div>
  </div>
</div>

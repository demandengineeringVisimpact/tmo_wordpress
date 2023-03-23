<div
  class="block -tools layout-{{ $layout }}"
  style="--backgroundImage: url('{{ $background }}'); --character: url('{{ $character }}')"
>
  <div class="container">
    <div class="tools__header">
      <InnerBlocks
        allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
        template="{{ wp_json_encode($template) }}"
      />
    </div>
    <div class="tools__body">
      <div class="tools">
        @foreach ($tools as $tool)
          {!! $tool !!}
        @endforeach
      </div>
    </div>
  </div>
</div>

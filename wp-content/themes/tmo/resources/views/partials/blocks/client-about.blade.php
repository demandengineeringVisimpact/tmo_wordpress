<div class="block -client-about">
  <div class="about">
    <InnerBlocks
      allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
      template="{{ wp_json_encode($template) }}"
    />
  </div>

  <div class="details">
    <div class="detail -industry">
      <h3>{{ __('Industry', 'tmo') }}</h3>
      <p>{{ $industry }}</p>
    </div>

    <div class="detail -location">
      <h3>{{ __('Location', 'tmo') }}</h3>
      <p>{{ $location }}</p>
    </div>

    @if ($uses && is_array($uses) && count($uses))
    <div class="detail -uses">
      <h3>{{ __('Use Cases', 'tmo') }}</h3>
      @foreach ($uses as $case)
        <p>{{ $case['use_case'] }}</p>
      @endforeach
    </div>
    @endif
  </div>
</div>

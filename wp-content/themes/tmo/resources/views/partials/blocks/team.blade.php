<div class="block -team">
  <div class="container">
    <div class="team__header">
      <InnerBlocks
        allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
        template="{{ wp_json_encode($template) }}"
      />
    </div>

    <div class="team">
      @foreach ($team as $member)
        <div class="teammate">
          @include('partials.card', [
            'content' => $member->title,
            'image_id' => $member->headshot,
            'size' => 'headshot',
            'title' => $member->name,
            'classes' => [],
          ])
        </div>
      @endforeach
    </div>

    <div class="careers">
      <p>{{ $careersBlurb }}</p>

      <a
        href="{{ $careersUrl }}"
        class="wp-block-button__link"
      >
        {{ __('See Open Positions') }}
      </a>
    </div>
  </div>
</div>

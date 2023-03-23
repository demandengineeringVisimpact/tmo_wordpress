<div class="block -solutions">
  <div class="container">
    <div class="solutions__content">
      <InnerBlocks
        allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
        template="{{ wp_json_encode($template) }}"
      />
    </div>

    <div class="solutions">
      @foreach ($solutions as $solution)
        <div class="solution -{{ sanitize_title($solution['name']) }}">
          <a href="{{ $solution['url'] }}">
            <img
              src="@asset('/images/solutions/' . sanitize_title($solution['name']) . '.svg')"
              class="solution__image"
            />
          </a>
        </div>
      @endforeach
    </div>
  </div>
</div>

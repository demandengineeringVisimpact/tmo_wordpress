<div class="block -reviews">
  <div class="container">
    <div class="reviews__header">
      <InnerBlocks
        allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
        template="{{ wp_json_encode($template) }}"
      />
    </div>

    <div class="reviews">
      @foreach ($reviews as $review)
        @include('partials/card', $review)
      @endforeach
    </div>
  </div>
</div>

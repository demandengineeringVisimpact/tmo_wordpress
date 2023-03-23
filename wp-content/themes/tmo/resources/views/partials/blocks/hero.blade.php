<div class="block -hero layout-{{ $layout }}">
  <div class="container">
    <div class="hero__content">
      <InnerBlocks
        allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
        template="{{ wp_json_encode($template) }}"
      />
    </div>

    @if ($layout === App\Fields\Hero::$_LAYOUTS['WITH_FORM'])
      <div class="hero__form">
        {!! do_shortcode("[contact-form-7 id='$form']") !!}
      </div>
    @else
      <div class="hero__media">
        @if ($layout === App\Fields\Hero::$_LAYOUTS['INLINE_VIDEO'])
          @include('partials.video', [
            'url' => $video,
            'width' => 'auto',
            'height' => 'auto',
          ])
        @elseif (!empty($featuredImage))
          @if (!empty($video))
            <a
              href="{{ $video }}"
              class="hero__action fancybox"
            >
              {!! $featuredImage !!}
            </a>
          @else
            {!! $featuredImage !!}
          @endif
        @else
          <a
            class="fancybox"
            href="{{ $video }}"
          >
            <img
              src="@asset('images/product-screen-1.png')"
              class="product-screen-1"
            >
            <img
              src="@asset('images/product-screen-2.png')"
              class="product-screen-2"
            >
          </a>
          <a
            class="hero__action fancybox"
            href="{{ $video }}"
          >Watch Our Video</a>
        @endif
      </div>
    @endif
  </div>
</div>

<div class="block -testimonial-logos">
  <div class="container">
    <h2 class="testimonial-logos__title">{{ $title }}</h2>

    <div class="testimonial">
      <div class="testimonial__media">
        {!! $testimonial->image !!}
      </div>

      <div class="testimonial__header">
        {{ $testimonial->customer }}, {{ $testimonial->customerTitle }}
      </div>

      <div class="testimonial__body">
        {!! $testimonial->quote !!}
      </div>

      <div class="testimonial__actions">
        <div class="wp-block-button">
          <a
            href="{{ $testimonial->videoUrl }}"
            class="wp-block-button__link fancybox"
          >{{ __('Play Video', 'tmo') }}</a>
        </div>
      </div>
    </div>

    <div class="logos">
      <ul class="logo-list">
        @foreach ($logos as $logo)
          <li class="logo">{!! $logo !!}</li>
        @endforeach
      </ul>

      <div class="logos__actions">
        @foreach ($actions as $action)
          <a
            href="{{ $action['url'] }}"
            class="rarr"
            target="{{ $action['target'] }}"
          >{{ $action['title'] }}</a>
        @endforeach
      </div>
    </div>
  </div>
</div>

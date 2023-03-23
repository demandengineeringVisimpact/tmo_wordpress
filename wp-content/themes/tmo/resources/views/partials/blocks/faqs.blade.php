<div class="block -faqs -background-{{ $background }}">
  <div class="container">
    <div class="faqs__header">
      <InnerBlocks
        allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
        template="{{ wp_json_encode($template) }}"
      />
    </div>

    <div class="faqs__body">
      @if (empty($faqs))
        <p>There are no FAQs to show</p>
      @else
        <dl class="faqs">
          @foreach ($faqs as $faq)
            <dt class="faq__question">
              {{ $faq->question }}
            </dt>
            <dd class="faq__answer">
              {!! $faq->answer !!}
            </dd>
          @endforeach
        </dl>
      @endif
    </div>
  </div>
</div>

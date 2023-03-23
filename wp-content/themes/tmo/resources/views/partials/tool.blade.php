<div class="tool {{ implode(' ', $classes) }}">
  <div class="tool__icon">
    {!! $icon !!}
  </div>

  <div class="tool__header">
    <h3 class="tool__title">{!! $title !!}</h3>
  </div>

  <div class="tool__body">{!! $content !!}</div>

  @isset($action)
    <div class="tool__actions">
      <a
        class="tool__action"
        href="{{ $action['url'] }}"
        target="{{ $action['target'] ?? '_self' }}"
      >{{ $action['title'] }}</a>
    </div>
  @endisset
</div>

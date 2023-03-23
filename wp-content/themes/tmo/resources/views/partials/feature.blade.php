<li
  id="{{ $id }}"
  class="feature {{ implode(' ', $classes) }}"
  data-figure="{{ $figure }}"
>
  @isset($icon)
    <div class="feature__icon">
      {!! $icon !!}
    </div>
  @endisset

  <div class="feature__header">
    <h3 class="feature__title">{!! $title !!}</h3>
  </div>

  <div class="feature__body">{!! $content !!}</div>
</li>

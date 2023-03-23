<div class="card {{ implode(' ', $classes) }}">
  @isset($figure)
    <figure class="card__media">
      {!! $figure !!}
    </figure>
  @endisset

  @isset($image_id)
    <figure class="card__media">
      {!! wp_get_attachment_image($image_id, $size) !!}
    </figure>
  @endisset

  <div class="card__header">
    @isset($eyebrow)
      <p class="eyebrow">{!! $eyebrow !!}</p>
    @endisset
    <h3 class="card__title">{!! $title !!}</h3>
  </div>

  <div class="card__body">{!! $content !!}</div>

  @isset($action)
    <div class="card__actions">
      <a
        class="card__action"
        href="{{ $action['url'] }}"
        target="{{ $action['target'] ?? '_self' }}"
      >{{ $action['title'] }}</a>
    </div>
  @endisset
</div>

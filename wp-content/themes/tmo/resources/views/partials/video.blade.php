@if (isset($is_external) && $is_external)
  <iframe
    width="560"
    height="315"
    src="{{ $url }}"
    title="YouTube video player"
    frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
    allowfullscreen
  ></iframe>
@else
  <video
    src="{{ $url }}"
    width="{{ $width }}"
    height="{{ $height }}"
    class="card__video"
    playsinline
    muted
  ></video>
@endif

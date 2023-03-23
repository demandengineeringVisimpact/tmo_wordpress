<div class="block -stats layout-{{ $layout }}">
  <div class="container">
    @if (!isset($stats) || !count($stats))
      <p class="msg">There are no stats to show</p>
    @else
      @foreach ($stats as $stat)
        <div class="stat">
          <h2 class="stat__title">{!! $stat['stat'] !!}</h2>
          <p class="stat__description">{{ $stat['description'] }}</p>
        </div>
      @endforeach
    @endif
  </div>
</div>

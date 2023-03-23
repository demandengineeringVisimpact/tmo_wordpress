<div class="block -features layout-{{ $layout }} position-{{ $position }} {{ $hasBackground ? 'has-background' : '' }}  {{ $isCanadian ? 'is-canadian' : '' }}">
  <div class="container">
    @if ($layout === App\Fields\Features::$_LAYOUTS['ACCORDION'])
      <figure class="features__media">
        <img src="{!! $image !!}" />
      </figure>
    @endif

    <div class="features__header">
      <h2 class="features__title">{{ $title }}</h2>
    </div>

    <div class="features__body">
      @if (empty($features))
        <p>There are no features to show</p>
      @else
        <ul class="features">
          @foreach ($features as $feature)
            {!! $feature !!}
          @endforeach
        </ul>
      @endif
    </div>
  </div>
</div>

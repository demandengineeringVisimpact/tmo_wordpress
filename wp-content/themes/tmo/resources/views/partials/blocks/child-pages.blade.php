<div class="block -child-pages">
  <div class="container">
    <ul class="entries">
      @foreach ($children as $child)
        <li class="entry {{ implode(' ', $child['classes']) }}">
          <div class="entry__header">
            <div class="entry__icon">{!! $child['icon'] !!}</div>

            <h3 class="entry__title">
              {!! $child['title'] !!}
            </h3>
          </div>

          <div class="entry__body">
            <p class="entry__excerpt">{{ $child['excerpt'] }}</p>

            <a
              href="{{ $child['permalink'] }}"
              class="entry__permalink"
            >
              {{ __('Learn More') }}
              @include('partials.icon', ['icon' => 'arrow_right'])
            </a>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
</div>

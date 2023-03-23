<div class="block -ratings">
  <div class="container">
    <h2 class="ratings__title">As Seen On:</h2>
    <ul class="ratings__sources">
      @foreach ($sources as $source)
        <li class="ratings__source" data-name="{{ $source['name'] }}">
          <a href="{{ $source['url'] }}">
            <img
              src="@asset('\/images\/' . sanitize_title($source['name']) . '.png')"
              class="ratings__logo"
            />
            <span class="ratings__stars">
              @for ($i = 0; $i < 5; $i++)
                <i class="icon-star {{
                  App\Blocks\Ratings::getRatingClass($i, $source['rating'])
                }}" ></i>
              @endfor
            </span>

            <span class="ratings">{{ $source['rating'] }}/5</span>

            @isset ($source['additional'])
              <span class="ratings__additional">{{ $source['additional'] }}</span>
            @endisset
          </a>
        </li>
      @endforeach
    </ul>
  </div>
</div>

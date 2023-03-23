<div class="block -blog">
  <div class="container">
    @foreach ($posts as $i => $post)
      <div class="post">
        @if (!$i)
          <figure class="post__media">
            {!! $post->thumbnail !!}
          </figure>
        @endif

        <div class="post__header">
          <div class="post__meta">
            @if ($post->term)
              <span class="post__term">
                {{ $post->term }}
              </span>
            @endif
          </div>

          <h3 class="post__title">
            <a href="{{ $post->permalink }}">
              {{ $post->title }}
            </a>
          </h3>
        </div>

        <div class="post__body">
          <p>{!! $post->excerpt !!}</p>
        </div>

        <div class="post__footer">
          <a
            href="{{ $post->permalink }}"
            class="post__permalink rarr"
          >{{ __(
            !$i ? 'Check it out' : 'Continue Reading',
            'tmo'
          ) }}</a>
        </div>
      </div>
    @endforeach
  </div>
</div>

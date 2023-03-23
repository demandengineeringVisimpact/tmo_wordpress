@if (count($post_categories))
  <span class="entry__categories">
    @foreach ($post_categories as $category)
      <a
        href="{{ get_category_link($category) }}"
        class="entry__category"
      >{{ $category->name }}</a>
    @endforeach
  </span>
@endif

<time
  class="entry__postdate"
  datetime="{{ get_post_time('c', true) }}"
>{{ get_the_date('M j, Y') }}</time>

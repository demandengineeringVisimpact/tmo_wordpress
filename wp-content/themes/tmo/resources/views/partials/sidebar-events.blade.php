<h3>Browse by</h3>
<ul class="nav">
  @foreach ($terms as $term)
    <li class="menu-item"><a href="/events/#{{ $term->slug }}">{{ $term->name }}</a></li>
  @endforeach
</ul>

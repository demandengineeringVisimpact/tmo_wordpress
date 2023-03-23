<div class="block -sitemap">
  <div class="container">
    <div class="nav-sitemap">
      @if (has_nav_menu('sitemap'))
        {!! wp_nav_menu([
          'theme_location' => 'sitemap',
          'menu_class' => 'nav'
        ]) !!}
      @endif
    </div>
  </div>
</div>

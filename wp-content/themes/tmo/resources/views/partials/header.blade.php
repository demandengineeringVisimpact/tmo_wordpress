<header class="banner">
  <div class="banner__main">
    <a
      href="{{ home_url('/') }}"
      class="brand"
    >
      {!! $primary_logo !!}
    </a>

    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class' => 'nav',
        ]) !!}
      @endif
    </nav>
  </div>
</header>

<div class="block -side-menu">
  <div class="container">
    <div class="side-menu__content">
      <InnerBlocks
        allowedBlocks="true"
        template="{{ wp_json_encode($template) }}"
      />
    </div>

    <aside class="side-menu__aside">
      <div class="nav-support">
        @if (has_nav_menu('support'))
          {!! wp_nav_menu([
            'theme_location' => 'support',
            'menu_class' => 'nav'
          ]) !!}
        @endif
      </div>
    </aside>
  </div>
</div>

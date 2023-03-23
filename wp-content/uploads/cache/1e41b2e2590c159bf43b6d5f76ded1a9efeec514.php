<header class="banner">
  <div class="banner__main">
    <a
      href="<?php echo e(home_url('/')); ?>"
      class="brand"
    >
      <?php echo $primary_logo; ?>

    </a>

    <nav class="nav-primary">
      <?php if(has_nav_menu('primary_navigation')): ?>
        <?php echo wp_nav_menu([
          'theme_location' => 'primary_navigation',
          'menu_class' => 'nav',
        ]); ?>

      <?php endif; ?>
    </nav>
  </div>
</header>

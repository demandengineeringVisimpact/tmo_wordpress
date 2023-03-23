<footer class="content-info">
  <div class="container">
    <nav class="nav-footer">
      <?php if(has_nav_menu('footer_navigation')): ?>
        <?php echo wp_nav_menu([
          'theme_location' => 'footer_navigation',
          'menu_class' => 'nav'
        ]); ?>

      <?php endif; ?>
    </nav>

    <section>
      <div class="company-info">
        <a
          href="<?php echo e(home_url('/')); ?>"
          class="brand"
        ><?php echo $primary_logo; ?></a>

        <a
          href="tel:<?php echo e($phone_number); ?>"
          class="company-phone"
        ><?php echo e($phone_number); ?></a>
      </div>

      <nav class="nav-social">
        <?php if(has_nav_menu('social_media')): ?>
          <?php echo wp_nav_menu([
            'theme_location' => 'social_media',
            'menu_class' => 'nav'
          ]); ?>

        <?php endif; ?>
      </nav>

      <div class="legal">
        <?php echo $copyright; ?>


        <nav class="nav-legal">
          <?php if(has_nav_menu('legal_navigation')): ?>
            <?php echo wp_nav_menu([
              'theme_location' => 'legal_navigation',
              'menu_class' => 'nav'
            ]); ?>

          <?php endif; ?>
        </nav>
      </div>
    </section>
  </div>
</footer>

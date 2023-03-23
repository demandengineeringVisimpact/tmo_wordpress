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
      <!-- FOOTER EOC -->
      <button type="button" data-mdb-ripple="true" data-mdb-ripple-color="light" id="btn-back-to-top">
        
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-up-short" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z"/>
        </svg>
      </button>
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

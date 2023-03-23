<div class="block -hero layout-<?php echo e($layout); ?>">
  <div class="container">
    <div class="hero__content">
      <InnerBlocks
        allowedBlocks="<?php echo e(wp_json_encode($allowedBlocks)); ?>"
        template="<?php echo e(wp_json_encode($template)); ?>"
      />
    </div>

    <?php if($layout === App\Fields\Hero::$_LAYOUTS['WITH_FORM']): ?>
      <div class="hero__form">
        <?php echo do_shortcode("[contact-form-7 id='$form']"); ?>

      </div>
    <?php else: ?>
      <div class="hero__media">
        <?php if($layout === App\Fields\Hero::$_LAYOUTS['INLINE_VIDEO']): ?>
          <?php echo $__env->make('partials.video', [
            'url' => $video,
            'width' => 'auto',
            'height' => 'auto',
          ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php elseif(!empty($featuredImage)): ?>
          <?php if(!empty($video)): ?>
            <a
              href="<?php echo e($video); ?>"
              class="hero__action fancybox"
            >
              <?php echo $featuredImage; ?>

            </a>
          <?php else: ?>
            <?php echo $featuredImage; ?>

          <?php endif; ?>
        <?php else: ?>
          <a
            class="fancybox"
            href="<?php echo e($video); ?>"
          >
            <img
              src="<?= App\asset_path('images/product-screen-1.png'); ?>"
              class="product-screen-1"
            >
            <img
              src="<?= App\asset_path('images/product-screen-2.png'); ?>"
              class="product-screen-2"
            >
          </a>
          <a
            class="hero__action fancybox"
            href="<?php echo e($video); ?>"
          >Watch Our Video</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

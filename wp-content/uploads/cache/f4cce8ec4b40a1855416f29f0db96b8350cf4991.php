<div class="block -testimonials layout-<?php echo e($layout); ?>">
  <div class="container">
    <?php if($showHeader): ?>
      <div class="testimonials__header">
        <InnerBlocks
          allowedBlocks="<?php echo e(wp_json_encode($allowedBlocks)); ?>"
          template="<?php echo e(wp_json_encode($template)); ?>"
        />
      </div>
    <?php endif; ?>

    <div class="testimonials swiper">
      <div class="swiper-wrapper">
        <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="swiper-slide">
            <?php echo $__env->make('partials/testimonial', [
              'testimonial' => $testimonial,
              'layout' => $layout,
            ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <div class="testimonials__footer">
        <?php if($layout === App\Fields\Testimonials::$_LAYOUTS['WITH_IMAGE']): ?>
          <a
            href="/customer-stories/"
            class="testimonials__action"
          ><?php echo e(__('See Our Customer Reviews')); ?></a>
        <?php endif; ?>

        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>
</div>

<div class="feed -resources">
  <div class="container swiper">
    <div class="feed__header">
      <h2><?php echo e(__('Recent Articles', 'tmo')); ?></h2>

      <div class="swiper-actions">
        <div class="swiper-button-prev"></div>

        <div class="swiper-button-next"></div>
      </div>
    </div>

    <div class="cardlist swiper-wrapper">
      <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('partials/card', $p, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</div>

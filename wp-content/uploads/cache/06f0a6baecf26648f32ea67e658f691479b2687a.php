<div class="block -carousel">
  <div class="container swiper">
    <div class="carousel__header">
      <div class="carousel__content">
        <InnerBlocks
          allowedBlocks="<?php echo e(wp_json_encode($allowedBlocks)); ?>"
          template="<?php echo e(wp_json_encode($template)); ?>"
        />
      </div>

      <div class="swiper-actions">
        <div class="swiper-button-prev"></div>

        <div class="swiper-button-next"></div>
      </div>
    </div>

    <div class="cardlist swiper-wrapper">
      <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('partials/card', $post, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php if($postType === 'events' && $i === 2): ?>
          <?php echo $__env->make('partials/mailing-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <?php if($postType === 'events' && count($posts) < 3): ?>
        <?php echo $__env->make('partials/mailing-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php endif; ?>
    </div>
  </div>
</div>

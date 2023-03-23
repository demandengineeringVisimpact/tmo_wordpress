<div class="block -posts-feed">
  <div class="container">
    <div class="posts-feed__header">
      <h2 class="posts-feed__title"><?php echo e($title); ?></h2>
      <a
        href="<?php echo e($link->url); ?>"
        class="posts-feed__link rarr"
      ><?php echo e($link->text); ?></a>
    </div>

    <div class="posts-feed__body swiper">
      <div class="feed swiper-wrapper">
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php echo $p; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <div class="swiper-actions">
        <div class="swiper-button-prev"></div>

        <div class="swiper-button-next"></div>
      </div>
    </div>
  </div>
</div>

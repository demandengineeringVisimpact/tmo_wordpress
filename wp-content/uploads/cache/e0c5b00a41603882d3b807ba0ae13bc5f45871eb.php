<div class="block -testimonial-logos">
  <div class="container">
    <h2 class="testimonial-logos__title"><?php echo e($title); ?></h2>

    <div class="testimonial">
      <div class="testimonial__media">
        <?php echo $testimonial->image; ?>

      </div>

      <div class="testimonial__header">
        <?php echo e($testimonial->customer); ?>, <?php echo e($testimonial->customerTitle); ?>

      </div>

      <div class="testimonial__body">
        <?php echo $testimonial->quote; ?>

      </div>

      <div class="testimonial__actions">
        <div class="wp-block-button">
          <a
            href="<?php echo e($testimonial->videoUrl); ?>"
            class="wp-block-button__link fancybox"
          ><?php echo e(__('Play Video', 'tmo')); ?></a>
        </div>
      </div>
    </div>

    <div class="logos">
      <ul class="logo-list">
        <?php $__currentLoopData = $logos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li class="logo"><?php echo $logo; ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>

      <div class="logos__actions">
        <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a
            href="<?php echo e($action['url']); ?>"
            class="rarr"
            target="<?php echo e($action['target']); ?>"
          ><?php echo e($action['title']); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>
</div>

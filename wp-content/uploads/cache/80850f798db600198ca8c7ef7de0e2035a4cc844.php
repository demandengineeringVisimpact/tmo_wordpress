<div class="block -child-pages">
  <div class="container">
    <ul class="entries">
      <?php $__currentLoopData = $children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="entry <?php echo e(implode(' ', $child['classes'])); ?>">
          <div class="entry__header">
            <div class="entry__icon"><?php echo $child['icon']; ?></div>

            <h3 class="entry__title">
              <?php echo $child['title']; ?>

            </h3>
          </div>

          <div class="entry__body">
            <p class="entry__excerpt"><?php echo e($child['excerpt']); ?></p>

            <a
              href="<?php echo e($child['permalink']); ?>"
              class="entry__permalink"
            >
              <?php echo e(__('Learn More')); ?>

              <?php echo $__env->make('partials.icon', ['icon' => 'arrow_right'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </a>
          </div>
        </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
</div>

<div class="block -tabs layout-<?php echo e($layout); ?>">
  <div class="container">
    <div class="tabs__header">
      <InnerBlocks
        allowedBlocks="<?php echo e(wp_json_encode($allowedBlocks)); ?>"
        template="<?php echo e(wp_json_encode($template)); ?>"
      />
    </div>
    <div class="tabs" style="--count: <?php echo e(count($tabs)); ?>">
      <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $tab; ?>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
</div>

<div class="block -contentMedia -<?php echo e($direction); ?> -position-<?php echo e($position); ?> -style-<?php echo e($style); ?>">
  <div class="container">
    <InnerBlocks
      allowedBlocks="<?php echo e(wp_json_encode($allowedBlocks)); ?>"
      template="<?php echo e(wp_json_encode($template)); ?>"
    />
  </div>
</div>

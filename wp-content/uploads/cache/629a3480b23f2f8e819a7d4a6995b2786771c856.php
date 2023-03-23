<div class="block -tiles layout-<?php echo e($layout); ?>">
  <div class="container">
    <div class="tiles__header">
      <InnerBlocks
        allowedBlocks="<?php echo e(wp_json_encode($allowedBlocks)); ?>"
        template="<?php echo e(wp_json_encode($template)); ?>"
      />
    </div>

    <div class="tiles">
      <?php echo $tiles; ?>

    </div>
  </div>
</div>

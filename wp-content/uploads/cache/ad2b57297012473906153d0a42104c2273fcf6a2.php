<div class="block -major-solutions">
  <div class="container">
    <div class="major-solutions__content">
      <InnerBlocks
        allowedBlocks="<?php echo e(wp_json_encode($allowedBlocks)); ?>"
        template="<?php echo e(wp_json_encode($template)); ?>"
      />
    </div>

    <div class="solutions">
      <?php echo $cards; ?>

    </div>
  </div>
</div>

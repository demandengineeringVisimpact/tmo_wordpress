<div class="block -interstitial">
  <div class="container">
    <div class="interstitial__content">
      <InnerBlocks
        allowedBlocks="<?php echo e(wp_json_encode($allowedBlocks)); ?>"
        template="<?php echo e(wp_json_encode($template)); ?>"
      />
    </div>
  </div>
</div>

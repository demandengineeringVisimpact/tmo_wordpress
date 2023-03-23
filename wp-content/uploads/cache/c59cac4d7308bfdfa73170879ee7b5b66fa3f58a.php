<div class="card-list">
  <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo $card; ?>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

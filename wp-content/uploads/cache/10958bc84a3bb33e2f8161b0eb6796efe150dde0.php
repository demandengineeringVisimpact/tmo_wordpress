<div class="block -ratings">
  <div class="container">
    <h2 class="ratings__title">As Seen On:</h2>
    <ul class="ratings__sources">
      <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="ratings__source" data-name="<?php echo e($source['name']); ?>">
          <a href="<?php echo e($source['url']); ?>">
            <img
              src="<?= App\asset_path('\/images\/' . sanitize_title($source['name']) . '.png'); ?>"
              class="ratings__logo"
            />
            <span class="ratings__stars">
              <?php for($i = 0; $i < 5; $i++): ?>
                <i class="icon-star <?php echo e(App\Blocks\Ratings::getRatingClass($i, $source['rating'])); ?>" ></i>
              <?php endfor; ?>
            </span>

            <span class="ratings"><?php echo e($source['rating']); ?>/5</span>

            <?php if(isset($source['additional'])): ?>
              <span class="ratings__additional"><?php echo e($source['additional']); ?></span>
            <?php endif; ?>
          </a>
        </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
</div>

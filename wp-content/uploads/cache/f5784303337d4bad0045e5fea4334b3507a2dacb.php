<div class="block -blog">
  <div class="container">
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="post">
        <?php if(!$i): ?>
          <figure class="post__media">
            <?php echo $post->thumbnail; ?>

          </figure>
        <?php endif; ?>

        <div class="post__header">
          <div class="post__meta">
            <?php if($post->term): ?>
              <span class="post__term">
                <?php echo e($post->term); ?>

              </span>
            <?php endif; ?>
          </div>

          <h3 class="post__title">
            <a href="<?php echo e($post->permalink); ?>">
              <?php echo e($post->title); ?>

            </a>
          </h3>
        </div>

        <div class="post__body">
          <p><?php echo $post->excerpt; ?></p>
        </div>

        <div class="post__footer">
          <a
            href="<?php echo e($post->permalink); ?>"
            class="post__permalink rarr"
          ><?php echo e(__(
            !$i ? 'Check it out' : 'Continue Reading',
            'tmo'
          )); ?></a>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>

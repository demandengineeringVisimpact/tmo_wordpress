<article <?php post_class('container') ?>>
  <header class="entry__header">
    <div class="entry__meta">
      <?php echo $__env->make('partials/entry-meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    <h1 class="entry__title">
      <?php echo get_the_title(); ?>

    </h1>

    <div class="entry__thumbnail">
      <?php echo get_the_post_thumbnail(null, 'large'); ?>

    </div>
  </header>

  <div class="entry__content">
    <div class="entry__social">
      Share this article
      <?php echo $__env->make('partials/social-sharing', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    <?php the_content() ?>
  </div>

  <aside class="entry__sidebar">
    <h3><?php echo e(__('Browse By', 'tmo')); ?></h3>

    <ul class="categories">
      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="category">
          <a
            href="<?php echo e(get_category_link($category)); ?>"
            class="category__link"
          ><?php echo e($category->name); ?></a>
        </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </aside>
</article>

<?php echo $__env->make('partials/feed-posts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

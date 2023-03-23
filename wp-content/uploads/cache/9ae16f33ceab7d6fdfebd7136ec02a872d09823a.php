<?php if(count($post_categories)): ?>
  <span class="entry__categories">
    <?php $__currentLoopData = $post_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a
        href="<?php echo e(get_category_link($category)); ?>"
        class="entry__category"
      ><?php echo e($category->name); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </span>
<?php endif; ?>

<time
  class="entry__postdate"
  datetime="<?php echo e(get_post_time('c', true)); ?>"
><?php echo e(get_the_date('M j, Y')); ?></time>

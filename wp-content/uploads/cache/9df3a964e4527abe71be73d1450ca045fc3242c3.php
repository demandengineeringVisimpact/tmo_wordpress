<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <?php if(!have_posts()): ?>
    <div class="page__content">
      <div class="container">
        <h2><?php echo e(__('The page you were trying to view does not exist.', 'tmo')); ?></h2>
        <p><?php echo e(__('Here are some helpful links instead:', 'tmo')); ?></p>

        <?php if(has_nav_menu('four_oh_four')): ?>
          <?php echo wp_nav_menu([
            'theme_location' => 'four_oh_four',
            'menu_class' => 'nav',
          ]); ?>

        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
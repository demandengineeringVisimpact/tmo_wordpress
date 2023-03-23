<article <?php post_class('entry swiper-slide') ?>>
  <header class="entry__header">
    <h2 class="entry__title"><a href="<?php echo e(get_permalink()); ?>"><?php echo get_the_title(); ?></a></h2>
    
  </header>

  <div class="entry__summary">
    <?php the_excerpt() ?>
  </div>

  <div class="entry__actions">
    <a
      href="<?php echo e(get_permalink()); ?>"
      class="entry__permalink rarr"
    ><?php echo e(__('Read More')); ?></a>
  </div>
</article>

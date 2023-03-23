<figure class="testimonial">
  <?php if($layout === App\Fields\Testimonials::$_LAYOUTS['WITH_IMAGE']): ?>
    <div class="testimonial__media">
      <?php echo $testimonial->image; ?>

    </div>
  <?php endif; ?>

  <?php if($testimonial->client && $testimonial->client->logo): ?>
    <div class="client__logo">
      <?php echo $testimonial->client->logo; ?>

    </div>
  <?php endif; ?>

  <blockquote class="testimonial__quote">
    <?php echo $testimonial->quote; ?>

  </blockquote>

  <figcaption class="testimonial__cite">
    <span class="testimonial__person"><?php echo e($testimonial->person); ?></span>
    <span class="testimonial__title"><?php echo e($testimonial->title); ?></span>

    <?php if($testimonial->client): ?>
      <span class="testimonial__client"><?php echo e($testimonial->client->name); ?></span>
    <?php endif; ?>

    <?php if(!empty($testimonial->video) && $layout === App\Fields\Testimonials::$_LAYOUTS['WITH_IMAGE']): ?>
      <a
        href="<?php echo e($testimonial->video); ?>"
        class="testimonial__video fancybox"
      ><?php echo e(__('Watch the Video', 'tmo')); ?></a>
    <?php endif; ?>
  </figcaption>
</figure>

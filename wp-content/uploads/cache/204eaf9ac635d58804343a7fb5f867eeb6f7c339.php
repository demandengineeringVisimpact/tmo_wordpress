<div class="card <?php echo e(implode(' ', $classes)); ?>">
  <?php if(isset($figure)): ?>
    <figure class="card__media">
      <?php echo $figure; ?>

    </figure>
  <?php endif; ?>

  <?php if(isset($image_id)): ?>
    <figure class="card__media">
      <?php echo wp_get_attachment_image($image_id, $size); ?>

    </figure>
  <?php endif; ?>

  <div class="card__header">
    <?php if(isset($eyebrow)): ?>
      <p class="eyebrow"><?php echo $eyebrow; ?></p>
    <?php endif; ?>
    <h3 class="card__title"><?php echo $title; ?></h3>
  </div>

  <div class="card__body"><?php echo $content; ?></div>

  <?php if(isset($action)): ?>
    <div class="card__actions">
      <a
        class="card__action"
        href="<?php echo e($action['url']); ?>"
        target="<?php echo e($action['target'] ?? '_self'); ?>"
      ><?php echo e($action['title']); ?></a>
    </div>
  <?php endif; ?>
</div>

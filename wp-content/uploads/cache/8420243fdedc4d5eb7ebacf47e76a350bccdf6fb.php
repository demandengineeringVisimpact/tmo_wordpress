<?php if(isset($is_external) && $is_external): ?>
  <iframe
    width="560"
    height="315"
    src="<?php echo e($url); ?>"
    title="YouTube video player"
    frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
    allowfullscreen
  ></iframe>
<?php else: ?>
  <video
    src="<?php echo e($url); ?>"
    width="<?php echo e($width); ?>"
    height="<?php echo e($height); ?>"
    class="card__video"
    playsinline
    muted
  ></video>
<?php endif; ?>

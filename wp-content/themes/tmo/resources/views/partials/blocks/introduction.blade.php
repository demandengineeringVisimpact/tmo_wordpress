<div class="block -introduction">
  <div class="container">
    {!! yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ) !!}

    <InnerBlocks
      allowedBlocks="{{ wp_json_encode($allowedBlocks) }}"
      template="{{ wp_json_encode($template) }}"
    />
  </div>
</div>

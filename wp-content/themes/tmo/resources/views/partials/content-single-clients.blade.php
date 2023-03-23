<article @php post_class('container') @endphp>
  <div class="entry__content">
    {!! yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ) !!}

    @php the_content() @endphp
  </div>
</article>

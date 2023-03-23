@php global $wp_query @endphp

@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  <div class="container">
    @if (!have_posts())
      <div class="alert alert-warning">
        {{ __('Sorry, no results were found.', 'sage') }}
      </div>
      {!! get_search_form(false) !!}
    @endif

    <div class="posts">
      @while (have_posts()) @php the_post() @endphp
        @include('partials.card', \App::card('large'))
      @endwhile
    </div>

    {!! get_the_posts_navigation([
      'prev_text' => $wp_query->is_paged ? 'Next' : 'See More',
      'next_text' => 'Previous'
    ]) !!}

    <div class="block -interstitial">
      <div class="interstitial__content">
        <h2 class="interstitial__title">
          {{ __('Are You Ready for the Next Level of Loan Automation?', 'tmo') }}
        </h2>

        <p>
          Speak with one of our demo experts today!
        </p>

        <div class="wp-block-buttons">
          <div class="wp-block-button"><a class="wp-block-button__link">Schedule a Demo</a></div>
        </div>
      </div>
    </div>
  </div>
@endsection

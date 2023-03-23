@php global $wp_query @endphp

@extends('layouts.app')

@section('content')
  @include('partials.clients-header')

  <div class="container">
    <div class="logos">
      <div class="swiper">
        <div class="swiper-wrapper">
          @foreach ($archive_logos as $logo)
            <div class="logo swiper-slide">
              {!! $logo !!}
            </div>
          @endforeach
        </div>

      </div>

      <div class="swiper-actions">
        <div class="swiper-button-prev"></div>

        <div class="swiper-button-next" tabindex="0"></div>
      </div>
    </div>

    @if (!have_posts())
      <div class="alert alert-warning">
        {{ __('Sorry, no results were found.', 'sage') }}
      </div>
      {!! get_search_form(false) !!}
    @endif

    <div class="posts">
      @while (have_posts()) @php the_post() @endphp
        @include('partials.card', \App::card('medium'))
      @endwhile
    </div>

    {!! get_the_posts_navigation([
      'prev_text' => $wp_query->is_paged ? 'Next' : 'See More',
      'next_text' => 'Previous'
    ]) !!}
  </div>

  <div class="block -industries">
    <div class="container">
      <h2>{{ __('See how your industry peers are changing their business with The Mortgage Office.', 'tmo') }}</h2>

      @if (has_nav_menu('industries'))
        {!! wp_nav_menu([
          'theme_location' => 'industries',
          'menu_class' => 'nav'
        ]) !!}
      @endif
    </div>
  </div>

  <div class="block -interstitial">
    <div class="interstitial__content">
      <h2 class="interstitial__title">
        {{ __('Take the First Step Toward Better Loan Management with The Mortgage Office', 'tmo') }}
      </h2>

      <p>
        {{ __('Speak with one of our demo experts today!', 'tmo') }}
      </p>

      <div class="wp-block-buttons">
        <div class="wp-block-button">
          <a
            href="/schedule-demo/"
            class="wp-block-button__link"
          >
            Schedule a Demo
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection

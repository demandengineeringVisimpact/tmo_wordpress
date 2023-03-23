@php global $wp_query @endphp

@extends('layouts.app')

@section('content')
  @include('partials.events-header')

  <div class="container {{ have_posts() ? 'has-posts' : 'no-posts' }}">
    @if (!have_posts())
      <div class="alert alert-warning">
        {{ __('There are no upcoming events. Check back later', 'tmo') }}
      </div>
      {!! get_search_form(false) !!}
    @else
      <div class="posts">
        @foreach ($events as $event)
          <h2 id="{{ $event->slug }}">{{ $event->name }}</h2>
          @foreach ($event->posts as $post)
            @include('partials.card', $post)
          @endforeach
        @endforeach
      </div>

      <aside class="side-menu">
        <ul>
          @foreach ($events as $event)
            <li><a href="#{{ $event->slug }}">{{ $event->name }}</a></li>
          @endforeach
        </ul>
      </aside>
    @endif
  </div>

  @include('partials.feed-webinars')

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
@endsection

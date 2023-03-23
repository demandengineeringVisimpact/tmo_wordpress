@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="page__content">
      <div class="container">
        <h2>{{ __('The page you were trying to view does not exist.', 'tmo') }}</h2>
        <p>{{ __('Here are some helpful links instead:', 'tmo') }}</p>

        @if (has_nav_menu('four_oh_four'))
          {!! wp_nav_menu([
            'theme_location' => 'four_oh_four',
            'menu_class' => 'nav',
          ]) !!}
        @endif
      </div>
    </div>
  @endif
@endsection

<div class="entry__meta">
  @if (!empty($is_past) && $is_webinar)
    <span>{{ __('On-Demand Webinars', 'tmo') }}</span>
  @else
    @isset($event_date)
      <span class="event_date">{{ $event_date }}</span>
    @endisset

    @isset($event_type)
      <span class="event_type">{{ $event_type }}</span>
    @endisset

    @isset($event_location)
      <span class="event_location">{{ $event_location }}</span>
    @endisset
  @endif
</div>

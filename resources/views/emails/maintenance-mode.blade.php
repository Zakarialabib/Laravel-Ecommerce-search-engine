@component('mail::message')
@if($status)
    {{__('The system is now in maintenance mode. Users will see the maintenance page when accessing the site.')}}
@else
    {{__('The system is no longer in maintenance mode. Normal site functionality has been restored.')}}
@endif

{{__('Thanks')}},<br>
{{ config('app.name') }}
@endcomponent
@component('mail::message')
# {{ __('Welcome!') }}

{{ __('Thank you for subscribing to our updates.') }}

@isset($subscription->plan)
{{ __('Plan') }}: **{{ $subscription->plan }}**
@endisset

{{ __('You will start receiving updates shortly.') }}

{{ __('Cheers,') }}
{{ config('app.name') }}
@endcomponent

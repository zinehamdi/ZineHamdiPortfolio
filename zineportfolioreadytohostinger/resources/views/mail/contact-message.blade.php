@component('mail::message')
# New Contact Message

- Name: {{ $data['name'] ?? '' }}
- Email: {{ $data['email'] ?? '' }}
- Phone: {{ $data['phone'] ?? '' }}
- Budget: {{ $data['budget'] ?? '' }}

Message:

{{ $data['message'] ?? '' }}

@endcomponent
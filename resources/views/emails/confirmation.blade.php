<x-mail::message>
    Dear {{ $user }}, this is your verification code for
    {{ config('app.name') }}

<x-mail::panel>
    {{ $verification_code }}
</x-mail::panel>

Thanks,<br>
{{ config('app.name') }} Admin
</x-mail::message>

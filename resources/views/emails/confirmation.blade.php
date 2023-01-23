<x-mail::message>
# Introduction

The body of your message.
    {{ $user }}

<x-mail::button :url="'www.google.com'">
Google
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

@component('mail::message')
# Verify Email Address

Hello {{ $user->firstname }} {{ $user->lastname }},

Please click the button below to verify your email address and activate your gym membership account.

@component('mail::button', ['url' => $url])
Verify Email Address
@endcomponent

If you did not create an account, no further action is required.

Regards,<br>
{{ config('app.name') }} Team
@endcomponent
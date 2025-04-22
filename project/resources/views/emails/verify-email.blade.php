@component('mail::message')
# Welcome to {{ config('app.name') }}!

Dear {{ $user->firstname }} {{ $user->lastname }},

We're excited to have you join our fitness community! Please verify your email to unlock all features of your membership.

@component('mail::button', ['url' => $url])
Activate My Account
@endcomponent

@component('mail::panel')
## What's Next?
- Access your personal dashboard
- Book fitness classes
- Track your workout progress
- Connect with fitness trainers
@endcomponent

If you didn't create this account, please ignore this email.

Stay strong, stay healthy!

Best regards,<br>
The {{ config('app.name') }} Team

<small>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</small>
@endcomponent
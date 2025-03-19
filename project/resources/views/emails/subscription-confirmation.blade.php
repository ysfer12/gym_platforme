@component('mail::message')
# {{ $subscription->status === 'active' ? 'Subscription Confirmation' : 'Pending Subscription' }}

Hello {{ $user->firstname }} {{ $user->lastname }},

Thank you for choosing FitTrack Gym! 

@if ($subscription->status === 'active')
Your subscription has been successfully processed.
@else
Your subscription is pending payment. Please visit our reception desk within 24 hours to complete your payment.
@endif

## Subscription Details:

@component('mail::table')
| Detail | Information |
|:-------|:------------|
| Plan | {{ $subscription->type }} |
| Duration | {{ $subscription->duration }} {{ $subscription->duration == 1 ? 'month' : 'months' }} |
| Start Date | {{ Carbon\Carbon::parse($subscription->start_date)->format('M d, Y') }} |
| End Date | {{ Carbon\Carbon::parse($subscription->end_date)->format('M d, Y') }} |
| Price | ${{ number_format($subscription->price, 2) }} |
| Status | {{ ucfirst($subscription->status) }} |
| Payment Method | {{ ucfirst($subscription->payment_method) }} |
@endcomponent

@if ($subscription->status === 'active')
You can access all the features of your {{ $subscription->type }} plan starting today.

@component('mail::button', ['url' => route('member.subscription')])
View Subscription
@endcomponent
@else
Please bring your ID and the exact amount (${{ number_format($subscription->price, 2) }}) to our reception desk.

@component('mail::button', ['url' => route('contact')])
Contact Us
@endcomponent
@endif

If you have any questions about your subscription, please don't hesitate to contact us.

Thank you,<br>
FitTrack Gym Team
@endcomponent
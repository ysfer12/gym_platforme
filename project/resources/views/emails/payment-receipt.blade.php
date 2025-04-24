@component('mail::message')
# Payment Receipt

Dear {{ $member->firstname }} {{ $member->lastname }},

Thank you for your payment to {{ $gymName }}. This email serves as your official receipt.

## Payment Details

**Receipt Number:** {{ $payment->transaction_id ?? 'N/A' }}  
**Date:** {{ \Carbon\Carbon::parse($payment->date)->format('F j, Y') }}  
**Amount:** ${{ number_format($payment->amount, 2) }}  
**Payment Method:** {{ ucfirst($payment->method) }}  
**Status:** {{ ucfirst($payment->status) }}  

## Subscription Details

**Type:** {{ $subscription->type }}  
**Period:** {{ \Carbon\Carbon::parse($subscription->start_date)->format('M j, Y') }} to {{ \Carbon\Carbon::parse($subscription->end_date)->format('M j, Y') }}  

If you have any questions about this receipt or your membership, please contact our front desk staff.

Thank you for being a member of {{ $gymName }}!

@component('mail::button', ['url' => route('member.subscriptions.show', $subscription->id)])
View Subscription Details
@endcomponent

Regards,<br>
{{ $gymName }} Team

<small>This is an automated receipt. Please do not reply to this email.</small>
@endcomponent
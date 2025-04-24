<?php

namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Payment Receipt - ' . config('app.name'))
                    ->markdown('emails.payment-receipt')
                    ->with([
                        'payment' => $this->payment,
                        'member' => $this->payment->subscription->user,
                        'subscription' => $this->payment->subscription,
                        'gymName' => config('app.name'),
                        'receiptDate' => now()->format('F j, Y'),
                    ]);
    }
}
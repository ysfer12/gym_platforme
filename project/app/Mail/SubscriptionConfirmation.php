<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class SubscriptionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subscription;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param Subscription $subscription
     * @return void
     */
    public function __construct(User $user, Subscription $subscription)
    {
        $this->user = $user;
        $this->subscription = $subscription;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'FitTrack Gym - Subscription Confirmation';
        
        if ($this->subscription->status === 'pending') {
            $subject = 'FitTrack Gym - Pending Subscription';
        }
        
        return $this->subject($subject)
                    ->markdown('emails.subscription-confirmation');
    }
}
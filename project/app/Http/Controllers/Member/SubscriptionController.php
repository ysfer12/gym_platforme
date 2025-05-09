<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionConfirmation;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:Member']);
    }

    /**
     * Display subscription details for the logged-in member.
     *
     * @return \Illuminate\Http\Response
     */
    public function subscription()
    {
        $user = Auth::user();
        
        // Get active subscription
        $activeSubscription = Subscription::where('user_id', $user->id)
            ->where('end_date', '>=', Carbon::today())
            ->where('status', 'active')
            ->first();
            
        // Get subscription history
        $subscriptionHistory = Subscription::where('user_id', $user->id)
            ->where(function($query) {
                $query->where('end_date', '<', Carbon::today())
                    ->orWhere('status', '!=', 'active');
            })
            ->orderBy('end_date', 'desc')
            ->get();
            
        return view('member.subscription', compact('activeSubscription', 'subscriptionHistory'));
    }

    /**
     * Show the payment page for a selected subscription.
     *
     * @param  string  $plan
     * @param  int  $duration
     * @return \Illuminate\Http\Response
     */
    public function showPaymentPage($plan, $duration)
    {
        // Validate plan and duration
        if (!in_array($plan, ['Basic', 'Premium', 'Elite']) || !in_array($duration, [1, 3, 12])) {
            return redirect()->route('member.subscription')
                ->with('error', 'Invalid subscription plan or duration.');
        }
        
        // Calculate price
        $price = $this->calculateSubscriptionPrice($plan, $duration);
        
        // Get Stripe public key
        $stripeKey = config('services.stripe.key');
        
        return view('member.payment', compact('plan', 'duration', 'price', 'stripeKey'));
    }

    /**
     * Process the subscription purchase.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function purchaseSubscription(Request $request)
    {
        $request->validate([
            'plan' => 'required|string',
            'duration' => 'required|integer|min:1',
            'payment_method' => 'required|string',
        ]);
        
        $plan = $request->input('plan');
        $duration = $request->input('duration');
        $paymentMethod = $request->input('payment_method');
        
        // For Stripe payment, redirect to Stripe
        if ($paymentMethod === 'stripe') {
            // Calculate the price based on the plan
            $prices = [
                'Basic' => 29.99,
                'Standard' => 49.99,
                'Premium' => 79.99
            ];
            
            $basePrice = $prices[$plan] ?? 0;
            $price = $basePrice * $duration;
            
            // Apply any discounts for longer durations
            if ($duration >= 3) {
                $price = $price * 0.95; 
            }
            if ($duration >= 6) {
                $price = $price * 0.9; 
            }
            
            // Format price for Stripe (in cents)
            $priceInCents = (int)($price * 100);
            
            try {
                // Set your secret key
                \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
                
                // Create a checkout session
                $session = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency' => 'usd',
                                'unit_amount' => $priceInCents,
                                'product_data' => [
                                    'name' => $plan . ' Subscription (' . $duration . ' months)',
                                    'description' => 'Gym membership subscription',
                                ],
                            ],
                            'quantity' => 1,
                        ],
                    ],
                    'mode' => 'payment',
                    'success_url' => route('member.subscription.success') . '?session_id={CHECKOUT_SESSION_ID}&plan=' . $plan . '&duration=' . $duration,
                    'cancel_url' => route('member.subscription'),
                ]);
                
                // Redirect to Stripe Checkout
                return redirect()->away($session->url);
                
            } catch (\Exception $e) {
                return redirect()->route('member.subscription')
                    ->with('error', 'An error occurred: ' . $e->getMessage());
            }
        }
        

if ($paymentMethod === 'cash') {
    try {
        // Calculate the price based on the plan
        $prices = [
            'Basic' => 29.99,
            'Standard' => 49.99,
            'Premium' => 79.99
        ];
        
        $basePrice = $prices[$plan] ?? 0;
        $price = $basePrice * $duration;
        
        // Apply any discounts for longer durations
        if ($duration >= 3) {
            $price = $price * 0.95; // 5% discount for 3+ months
        }
        if ($duration >= 6) {
            $price = $price * 0.9; // Additional 10% discount for 6+ months
        }
        
        // Start a database transaction
        DB::beginTransaction();
        
        $user = Auth::user();
        
        // Check if user has an active subscription
        $activeSubscription = Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();
            
        if ($activeSubscription) {
            // If extending existing subscription
            $startDate = $activeSubscription->end_date;
            $endDate = Carbon::parse($startDate)->addMonths($duration);
            
            $activeSubscription->end_date = $endDate;
            $activeSubscription->save();
            
            $subscriptionId = $activeSubscription->id;
        } else {
            // If creating new subscription
            $startDate = now();
            $endDate = Carbon::parse($startDate)->addMonths($duration);
            
            // Set sessions count based on the plan
            $sessionsCount = [
                'Basic' => 4 * $duration,
                'Standard' => 8 * $duration,
                'Premium' => 999, 
            ][$plan] ?? 0;
            
            // Set trainer zone access based on the plan
            $trainerZoneAccess = $plan === 'Premium';
            
          // Create a pending subscription
$subscription = new Subscription();
$subscription->user_id = $user->id;
$subscription->type = $plan;
$subscription->duration = $duration;    
$subscription->price = $price;
$subscription->start_date = $startDate;
$subscription->end_date = $endDate;
$subscription->status = 'pending'; 
$subscription->payment_method = 'cash';
$subscription->max_sessions_count = $sessionsCount;
$subscription->sessions_left = $sessionsCount;
$subscription->trainer_zone_access = $trainerZoneAccess;
$subscription->save();


        }
        
       // Record pending payment
$payment = new Payment();
$payment->subscription_id = $subscriptionId;
$payment->amount = $price;
$payment->date = now();
$payment->method = 'cash';
$payment->status = 'pending'; // Also correctly set to 'pending'
$payment->save();
        
        DB::commit();
        
        // Redirect to the member subscription page with success message
        return redirect()->route('member.subscription')
            ->with('success', 'Your subscription has been reserved. Please visit our reception desk within 24 hours to complete your payment.');
            
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('member.subscription')
            ->with('error', 'An error occurred while processing your request: ' . $e->getMessage());
    }
}
        
        return redirect()->route('member.subscription')
            ->with('error', 'Invalid payment method selected.');
    }

    /**
     * Create a Stripe Checkout Session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createCheckoutSession(Request $request)
    {
        $validated = $request->validate([
            'plan' => 'required|in:Basic,Premium,Elite',
            'duration' => 'required|in:1,3,12',
        ]);
        
        $user = Auth::user();
        $price = $this->calculateSubscriptionPrice($validated['plan'], $validated['duration']);
        
        // Set Stripe API key
        Stripe::setApiKey(config('services.stripe.secret'));
        
        // Create a Stripe Checkout Session
        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $validated['plan'] . ' Plan - ' . $validated['duration'] . ' months',
                    ],
                    'unit_amount' => $price * 100, // Stripe requires amount in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('member.subscription.success', [
                'plan' => $validated['plan'],
                'duration' => $validated['duration'],
                'session_id' => '{CHECKOUT_SESSION_ID}'
            ]),
            'cancel_url' => route('member.subscription'),
            'metadata' => [
                'plan' => $validated['plan'],
                'duration' => $validated['duration'],
                'user_id' => $user->id,
            ],
        ]);
        
        return response()->json(['id' => $session->id]);
    }

   /**
 * Handle successful payment from Stripe Checkout.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function handleCheckoutSuccess(Request $request)
{
    $sessionId = $request->session_id;
    $plan = $request->plan;
    $duration = $request->duration;
    
    // Validate session with Stripe
    Stripe::setApiKey(config('services.stripe.secret'));
    
    try {
        $session = StripeSession::retrieve($sessionId);
        
        if ($session->payment_status !== 'paid') {
            return redirect()->route('member.subscription')
                ->with('error', 'Payment was not completed.');
        }
        
        $user = Auth::user();
        $price = $this->calculateSubscriptionPrice($plan, $duration);
        
        // Calculate dates
        $startDate = Carbon::today();
        $endDate = Carbon::today()->addMonths($duration);
        
        // Start transaction
        DB::beginTransaction();
        
        // Create new subscription
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'type' => $plan,
            'duration' => $duration,
            'price' => $price,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => 'active',
            'payment_method' => 'stripe',
            'transaction_number' => $session->payment_intent,
        ]);
        
        // Create payment record for this subscription
        Payment::create([
            'subscription_id' => $subscription->id,
            'amount' => $price,
            'date' => now(),
            'method' => 'stripe',
            'status' => 'paid',
            'transaction_id' => $session->payment_intent, // Store Stripe's payment intent ID
            'notes' => 'Online payment via Stripe'
        ]);
        
        // Commit transaction
        DB::commit();
        
        // Send email confirmation
        $this->sendSubscriptionEmail($user, $subscription);
        
        return redirect()->route('member.subscription')
            ->with('success', 'Subscription purchased successfully! A confirmation email has been sent to your inbox.');
    } catch (\Exception $e) {
        // Rollback transaction if there's an error
        DB::rollBack();
        
        return redirect()->route('member.subscription')
            ->with('error', 'Error processing payment: ' . $e->getMessage());
    }
}
    
    /**
     * Send subscription confirmation email.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    private function sendSubscriptionEmail($user, $subscription)
    {
        Mail::to($user->email)->send(new SubscriptionConfirmation($user, $subscription));
    }

    /**
     * Redirect to Stripe checkout.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function stripeRedirect(Request $request)
    {
        $request->validate([
            'plan' => 'required|string',
            'duration' => 'required|integer|min:1',
            'terms' => 'required|accepted',
        ]);
        
        $plan = $request->input('plan');
        $duration = $request->input('duration');
        
        // Calculate price based on plan and duration
        $prices = [
            'Basic' => 29.99,
            'Standard' => 49.99,
            'Premium' => 79.99
        ];
        
        if (!isset($prices[$plan])) {
            return redirect()->back()->with('error', 'Invalid plan selected.');
        }
        
        $basePrice = $prices[$plan];
        $price = $basePrice * $duration;
        
        // Apply discounts
        if ($duration >= 3) {
            $price = $price * 0.95; // 5% discount
        }
        if ($duration >= 6) {
            $price = $price * 0.9; // Additional 10% discount
        }
        
        $priceInCents = (int)($price * 100);
        
        try {
            // Set Stripe API key
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            
            // Create checkout session
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'unit_amount' => $priceInCents,
                            'product_data' => [
                                'name' => $plan . ' Subscription (' . $duration . ' months)',
                                'description' => 'Gym membership subscription',
                            ],
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('member.subscription.success') . '?session_id={CHECKOUT_SESSION_ID}&plan=' . $plan . '&duration=' . $duration,
                'cancel_url' => route('member.subscription'),
            ]);
            
            // Redirect to Stripe
            return redirect()->away($session->url);
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating payment session: ' . $e->getMessage());
        }
    }

    /**
     * Calculate subscription price based on plan and duration.
     *
     * @param string $plan
     * @param int $duration
     * @return float
     */
    private function calculateSubscriptionPrice($plan, $duration)
    {
        $prices = [
            'Basic' => [
                1 => 29,
                3 => 79,
                12 => 290,
            ],
            'Premium' => [
                1 => 59,
                3 => 169,
                12 => 590,
            ],
            'Elite' => [
                1 => 99,
                3 => 279,
                12 => 990,
            ],
        ];
        
        return $prices[$plan][$duration] ?? 0;
    }
}
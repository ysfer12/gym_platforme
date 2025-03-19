<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionConfirmation;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::with('user')->get();
        return view('subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = User::where('role', 'Member')->get();
        return view('subscriptions.create', compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|string|max:255',
            'payment_method' => 'nullable|string|max:255',
            'transaction_number' => 'nullable|string|max:255',
            'max_sessions_count' => 'nullable|integer|min:0',
            'sessions_left' => 'nullable|integer|min:0',
            'trainer_zone_access' => 'boolean',
        ]);

        Subscription::create($validated);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        $subscription->load('user', 'payments');
        return view('subscriptions.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        $members = User::where('role', 'Member')->get();
        return view('subscriptions.edit', compact('subscription', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|string|max:255',
            'payment_method' => 'nullable|string|max:255',
            'transaction_number' => 'nullable|string|max:255',
            'max_sessions_count' => 'nullable|integer|min:0',
            'sessions_left' => 'nullable|integer|min:0',
            'trainer_zone_access' => 'boolean',
        ]);

        $subscription->update($validated);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription deleted successfully.');
    }

/**
 * Renew a subscription.
 *
 * @param  \App\Models\Subscription  $subscription
 * @return \Illuminate\Http\Response
 */
public function renew(Request $request, Subscription $subscription)
{
    $validated = $request->validate([
        'end_date' => 'required|date|after:today',
        'payment_method' => 'required|string|max:255',
    ]);

    $subscription->update([
        'end_date' => $validated['end_date'],
        'status' => 'active',
        'payment_method' => $validated['payment_method'],
    ]);

    // Create payment record
    $subscription->payments()->create([
        'amount' => $subscription->price,
        'date' => now(),
        'method' => $validated['payment_method'],
        'status' => 'paid',
    ]);

    return redirect()->route('subscriptions.show', $subscription)
        ->with('success', 'Subscription renewed successfully.');
}

/**
 * Cancel a subscription.
 *
 * @param  \App\Models\Subscription  $subscription
 * @return \Illuminate\Http\Response
 */
public function cancel(Subscription $subscription)
{
    $subscription->update(['status' => 'cancelled']);

    return redirect()->route('subscriptions.index')
        ->with('success', 'Subscription cancelled successfully.');
}

 /**
     * Display subscription details for the logged-in member.
     *
     * @return \Illuminate\Http\Response
     */
    public function memberSubscription()
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
            $price = $price * 0.95; // 5% discount for 3+ months
        }
        if ($duration >= 6) {
            $price = $price * 0.9; // Additional 10% discount for 6+ months
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
    
    // For cash payment
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
                    'Premium' => 999, // Unlimited
                ][$plan] ?? 0;
                
                // Set trainer zone access based on the plan
                $trainerZoneAccess = $plan === 'Premium';
                
                // Create a pending subscription
                $subscription = new Subscription();
                $subscription->user_id = $user->id;
                $subscription->type = $plan;
                $subscription->price = $price;
                $subscription->start_date = $startDate;
                $subscription->end_date = $endDate;
                $subscription->status = 'pending'; // Set as pending until cash payment is confirmed
                $subscription->payment_method = 'cash';
                $subscription->max_sessions_count = $sessionsCount;
                $subscription->sessions_left = $sessionsCount;
                $subscription->trainer_zone_access = $trainerZoneAccess;
                $subscription->save();
                
                $subscriptionId = $subscription->id;
            }
            
            // Record pending payment
            $payment = new Payment();
            $payment->subscription_id = $subscriptionId;
            $payment->amount = $price;
            $payment->date = now();
            $payment->method = 'cash';
            $payment->status = 'pending';
            $payment->save();
            
            DB::commit();
            
            return redirect()->route('dashboard')
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
            
            // Send email confirmation
            $this->sendSubscriptionEmail($user, $subscription);
            
            return redirect()->route('member.subscription')
                ->with('success', 'Subscription purchased successfully! A confirmation email has been sent to your inbox.');
        } catch (\Exception $e) {
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
}
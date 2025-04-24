<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionConfirmation;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:Receptionist']);
    }

    /**
     * Generate a unique transaction ID
     * 
     * @return string
     */
    private function generateTransactionId()
    {
        $prefix = 'TXN';
        $date = now()->format('Ymd');
        $random = strtoupper(Str::random(6));
        return $prefix . $date . $random;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::with('user')->paginate(15);
                return view('receptionist.subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = User::where('role', 'Member')->get();
        return view('receptionist.subscriptions.create', compact('members'));
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
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|string|max:255',
            'payment_method' => 'nullable|string|max:255',
            'max_sessions_count' => 'nullable|integer|min:0',
            'sessions_left' => 'nullable|integer|min:0',
            'trainer_zone_access' => 'boolean',
        ]);

        // Generate a transaction number
        $transactionId = $this->generateTransactionId();
        $validated['transaction_number'] = $transactionId;

        $subscription = Subscription::create($validated);

        // If subscription is active and payment method is provided, create a payment record
        if ($validated['status'] === 'active' && isset($validated['payment_method'])) {
            Payment::create([
                'subscription_id' => $subscription->id,
                'amount' => $validated['price'],
                'date' => now(),
                'method' => $validated['payment_method'],
                'status' => 'paid',
                'transaction_id' => $transactionId, // Use the same transaction ID
            ]);
        }

        return redirect()->route('receptionist.subscriptions.index')
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
        return view('receptionist.subscriptions.show', compact('subscription'));
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
        return view('receptionist.subscriptions.edit', compact('subscription', 'members'));
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
            'duration' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|string|max:255',
            'payment_method' => 'nullable|string|max:255',
            'max_sessions_count' => 'nullable|integer|min:0',
            'sessions_left' => 'nullable|integer|min:0',
            'trainer_zone_access' => 'boolean',
        ]);

        // Don't update transaction_number if it already exists
        if (empty($subscription->transaction_number)) {
            $validated['transaction_number'] = $this->generateTransactionId();
        }

        $subscription->update($validated);

        return redirect()->route('receptionist.subscriptions.index')
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

        return redirect()->route('receptionist.subscriptions.index')
            ->with('success', 'Subscription deleted successfully.');
    }

    /**
     * Renew a subscription.
     *
     * @param  \Illuminate\Http\Request  $request
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

        // Generate new transaction ID for renewal
        $transactionId = $this->generateTransactionId();

        // Create payment record
        $subscription->payments()->create([
            'amount' => $subscription->price,
            'date' => now(),
            'method' => $validated['payment_method'],
            'status' => 'paid',
            'transaction_id' => $transactionId,
        ]);

        return redirect()->route('receptionist.subscriptions.show', $subscription)
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

        return redirect()->route('receptionist.subscriptions.index')
            ->with('success', 'Subscription cancelled successfully.');
    }
}
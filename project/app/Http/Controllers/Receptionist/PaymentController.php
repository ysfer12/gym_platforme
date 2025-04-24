<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentReceiptMail;
use Illuminate\Support\Str;

class PaymentController extends Controller
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
    public function index(Request $request)
    {
        $query = Payment::with('subscription.user');
        
        // Filter by date range if provided
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }
        
        // Filter by member if provided
        if ($request->has('user_id') && $request->user_id != 'all') {
            $query->whereHas('subscription', function($q) use ($request) {
                $q->where('user_id', $request->user_id);
            });
        }
        
        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Filter by payment method if provided
        if ($request->has('method') && $request->method != 'all') {
            $query->where('method', $request->method);
        }
        
        // Order by date (descending by default)
        $query->orderBy('date', $request->order ?? 'desc');
        
        $payments = $query->paginate(15);
        $members = User::where('role', 'Member')->get();
        $paymentMethods = Payment::select('method')->distinct()->pluck('method');
        
        return view('receptionist.payments.index', compact('payments', 'members', 'paymentMethods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = User::where('role', 'Member')->get();
        $subscriptions = Subscription::where('status', 'active')
            ->with('user')
            ->get();
            
        return view('receptionist.payments.create', compact('members', 'subscriptions'));
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
            'subscription_id' => 'required|exists:subscriptions,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'method' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'send_receipt' => 'nullable|boolean',
        ]);

        // Generate transaction ID
        $validated['transaction_id'] = $this->generateTransactionId();

        $payment = Payment::create($validated);

        // Update subscription status to active if payment is marked as paid
        if ($validated['status'] === 'paid') {
            $subscription = Subscription::find($validated['subscription_id']);
            if ($subscription && $subscription->status !== 'active') {
                $subscription->update(['status' => 'active']);
            }
            
            // Send email receipt if payment is marked as paid and receipt option is selected
            if (isset($validated['send_receipt']) && $validated['send_receipt'] && $subscription && $subscription->user) {
                try {
                    $this->sendEmailReceipt($payment);
                } catch (\Exception $e) {
                    // Log the error but don't interrupt the flow
                    \Log::error('Failed to send payment receipt: ' . $e->getMessage());
                }
            }
        }

        return redirect()->route('receptionist.payments.index')
            ->with('success', 'Payment recorded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        $payment->load('subscription.user');
        return view('receptionist.payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $payment->load('subscription.user');
        $paymentMethods = ['credit_card', 'debit_card', 'cash', 'bank_transfer', 'mobile_payment'];
        
        return view('receptionist.payments.edit', compact('payment', 'paymentMethods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'method' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Don't update transaction_id if it already exists
        if (empty($payment->transaction_id)) {
            $validated['transaction_id'] = $this->generateTransactionId();
        }

        $payment->update($validated);

        // Update subscription status based on payment status
        if ($payment->status !== $validated['status']) {
            $subscription = $payment->subscription;
            
            if ($validated['status'] === 'paid' && $subscription->status !== 'active') {
                $subscription->update(['status' => 'active']);
            } elseif ($validated['status'] === 'canceled' && $subscription->status === 'active') {
                // Only mark subscription as canceled if this was the initial payment
                // Not applicable for renewal payments
                if ($subscription->payments()->count() === 1) {
                    $subscription->update(['status' => 'cancelled']);
                }
            }
        }

        return redirect()->route('receptionist.payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        // Prevent deletion of processed payments
        if ($payment->status === 'paid' || $payment->status === 'refunded') {
            return redirect()->route('receptionist.payments.index')
                ->with('error', 'Cannot delete a processed payment. Mark it as canceled instead.');
        }
        
        $payment->delete();

        return redirect()->route('receptionist.payments.index')
            ->with('success', 'Payment deleted successfully.');
    }

    /**
     * Process a pending payment.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function process(Payment $payment)
    {
        // Only pending payments can be processed
        if ($payment->status !== 'pending') {
            return redirect()->route('receptionist.payments.show', $payment)
                ->with('error', 'Only pending payments can be processed.');
        }
        
        // Ensure payment has a transaction ID
        if (empty($payment->transaction_id)) {
            $payment->transaction_id = $this->generateTransactionId();
        }
        
        $payment->update([
            'status' => 'paid',
            'date' => Carbon::now(),
            'transaction_id' => $payment->transaction_id
        ]);
        
        // Update subscription status
        $subscription = $payment->subscription;
        if ($subscription && $subscription->status !== 'active') {
            $subscription->update(['status' => 'active']);
        }

        return redirect()->route('receptionist.payments.show', $payment)
            ->with('success', 'Payment processed successfully.');
    }

    /**
     * Refund a payment.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function refund(Payment $payment)
    {
        // Only paid payments can be refunded
        if ($payment->status !== 'paid') {
            return redirect()->route('receptionist.payments.show', $payment)
                ->with('error', 'Only paid payments can be refunded.');
        }
        
        $payment->update([
            'status' => 'refunded',
        ]);

        return redirect()->route('receptionist.payments.show', $payment)
            ->with('success', 'Payment refunded successfully.');
    }

    /**
     * Show the batch payment form.
     *
     * @return \Illuminate\Http\Response
     */
    public function batchCreate()
    {
        // Get subscriptions with pending status
        $pendingSubscriptions = Subscription::where('status', 'pending')
            ->with('user')
            ->orderBy('start_date', 'desc')
            ->get();
        
        return view('receptionist.payments.batch', compact('pendingSubscriptions'));
    }

    /**
     * Process a batch payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function batchStore(Request $request)
    {
        $validated = $request->validate([
            'subscriptions' => 'required|array',
            'subscriptions.*' => 'exists:subscriptions,id',
            'method' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|string|in:pending,paid',
            'notes' => 'nullable|string',
            'send_receipts' => 'nullable|boolean'
        ]);
        
        $count = 0;
        $totalAmount = 0;
        
        // Process each subscription
        foreach ($validated['subscriptions'] as $subscriptionId) {
            $subscription = Subscription::findOrFail($subscriptionId);
            
            // Create payment record with auto-generated transaction ID
            $payment = Payment::create([
                'subscription_id' => $subscription->id,
                'amount' => $subscription->price,
                'date' => $validated['date'],
                'method' => $validated['method'],
                'status' => $validated['status'],
                'notes' => $validated['notes'],
                'transaction_id' => $this->generateTransactionId()
            ]);
            
            // Update subscription status if payment is marked as paid
            if ($validated['status'] === 'paid' && $subscription->status !== 'active') {
                $subscription->update(['status' => 'active']);
                
                // Send email receipt if option is selected
                if (isset($validated['send_receipts']) && $validated['send_receipts'] && $subscription->user) {
                    try {
                        $this->sendEmailReceipt($payment);
                    } catch (\Exception $e) {
                        // Log the error but don't interrupt the flow
                        \Log::error('Failed to send payment receipt: ' . $e->getMessage());
                    }
                }
            }
            
            $count++;
            $totalAmount += $subscription->price;
        }
        
        return redirect()->route('receptionist.payments.index')
            ->with('success', "Successfully processed {$count} payments totaling \${$totalAmount}.");
    }

    /**
     * Search for subscriptions based on member information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $term = $request->input('term');
        
        // Search for subscriptions by member name, email, or subscription ID
        $subscriptions = Subscription::where(function($query) use ($term) {
                $query->where('id', 'like', "%{$term}%")
                    ->orWhereHas('user', function($subQuery) use ($term) {
                        $subQuery->where('firstname', 'like', "%{$term}%")
                            ->orWhere('lastname', 'like', "%{$term}%")
                            ->orWhere('email', 'like', "%{$term}%");
                    });
            })
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        
        if ($request->ajax()) {
            return response()->json($subscriptions);
        }
        
        return redirect()->route('receptionist.payments.batch')->with('searchResults', $subscriptions);
    }

    /**
     * Generate a receipt for a payment.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function generateReceipt(Payment $payment)
    {
        $payment->load('subscription.user');
        
        // Only generate receipts for paid payments
        if ($payment->status !== 'paid') {
            return redirect()->route('receptionist.payments.show', $payment)
                ->with('error', 'Receipts can only be generated for paid payments.');
        }
        
        return view('receptionist.payments.receipt', compact('payment'));
    }
    
    /**
     * Send email receipt for a payment.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function emailReceipt(Payment $payment)
    {
        $payment->load('subscription.user');
        
        // Only allow sending receipts for paid payments
        if ($payment->status !== 'paid') {
            return redirect()->route('receptionist.payments.show', $payment)
                ->with('error', 'Email receipts can only be sent for paid payments.');
        }
        
        try {
            $this->sendEmailReceipt($payment);
            return redirect()->route('receptionist.payments.show', $payment)
                ->with('success', 'Payment receipt sent successfully to ' . $payment->subscription->user->email);
        } catch (\Exception $e) {
            return redirect()->route('receptionist.payments.show', $payment)
                ->with('error', 'Failed to send receipt email: ' . $e->getMessage());
        }
    }
    
    /**
     * Helper method to send email receipt.
     *
     * @param  \App\Models\Payment  $payment
     * @return void
     */
    private function sendEmailReceipt(Payment $payment)
    {
        $payment->load('subscription.user');
        
        // Make sure payment has a user email
        if (!$payment->subscription || !$payment->subscription->user || !$payment->subscription->user->email) {
            throw new \Exception('No valid email address found for this payment');
        }
        
        // Send email receipt
        Mail::to($payment->subscription->user->email)
            ->send(new PaymentReceiptMail($payment));
    }
}
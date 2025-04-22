<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:Administrator']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::with('subscription.user')
            ->orderBy('date', 'desc')
            ->paginate(15);
        
        // Calculate totals for display
        $totalRevenue = Payment::where('status', 'paid')->sum('amount');
        $pendingRevenue = Payment::where('status', 'pending')->sum('amount');
            
        return view('admin.payments.index', compact('payments', 'totalRevenue', 'pendingRevenue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subscriptions = Subscription::with('user')->get();
        return view('admin.payments.create', compact('subscriptions'));
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
            'reference' => 'nullable|string|max:255',
        ]);

        Payment::create($validated);

        return redirect()->route('admin.payments.index')
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
        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $subscriptions = Subscription::with('user')->get();
        return view('admin.payments.edit', compact('payment', 'subscriptions'));
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
            'subscription_id' => 'required|exists:subscriptions,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'method' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'reference' => 'nullable|string|max:255',
        ]);

        $payment->update($validated);

        return redirect()->route('admin.payments.index')
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
        $payment->delete();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment deleted successfully.');
    }

    /**
     * Process a payment.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function process(Payment $payment)
    {
        $payment->update(['status' => 'paid']);

        // Update subscription status if needed
        $subscription = $payment->subscription;
        if ($subscription && $subscription->status === 'pending') {
            $subscription->status = 'active';
            $subscription->save();
        }

        return redirect()->route('admin.payments.show', $payment)
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
        $payment->update(['status' => 'refunded']);

        return redirect()->route('admin.payments.show', $payment)
            ->with('success', 'Payment refunded successfully.');
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
        
        return view('admin.payments.receipt', compact('payment'));
    }
    
    /**
     * Generate payment report.
     *
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        // Date range defaults
        $startDate = request('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = request('end_date', Carbon::now()->format('Y-m-d'));
        
        $payments = Payment::with('subscription.user')
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
            
        $totalRevenue = $payments->where('status', 'paid')->sum('amount');
        $pendingRevenue = $payments->where('status', 'pending')->sum('amount');
        $refundedRevenue = $payments->where('status', 'refunded')->sum('amount');
        
        // Group by payment method
        $paymentsByMethod = $payments->where('status', 'paid')->groupBy('method')
            ->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'total' => $group->sum('amount')
                ];
            });
            
        // Group by day
        $paymentsByDay = $payments->where('status', 'paid')->groupBy(function($item) {
            return Carbon::parse($item->date)->format('Y-m-d');
        })->map(function ($group) {
            return [
                'count' => $group->count(),
                'total' => $group->sum('amount')
            ];
        });
        
        return view('admin.payments.report', compact(
            'payments',
            'startDate',
            'endDate',
            'totalRevenue',
            'pendingRevenue',
            'refundedRevenue',
            'paymentsByMethod',
            'paymentsByDay'
        ));
    }
}
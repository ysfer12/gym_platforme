<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::with('subscription.user')->latest()->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subscriptions = Subscription::with('user')->get();
        return view('payments.create', compact('subscriptions'));
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
        ]);

        Payment::create($validated);

        return redirect()->route('payments.index')
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
        return view('payments.show', compact('payment'));
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
        return view('payments.edit', compact('payment', 'subscriptions'));
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
        ]);

        $payment->update($validated);

        return redirect()->route('payments.index')
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

        return redirect()->route('payments.index')
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
        $payment->update(['status' => 'processed']);

        return redirect()->route('payments.show', $payment)
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

        return redirect()->route('payments.show', $payment)
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
        
        // Logic to generate PDF receipt
        // For now, we'll just return a view
        return view('payments.receipt', compact('payment'));
    }
}
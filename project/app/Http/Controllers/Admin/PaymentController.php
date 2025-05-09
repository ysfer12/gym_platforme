<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
    public function index(Request $request)
    {
        // Apply filters if provided
        $query = Payment::with('subscription.user');
        
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }
        
        // Get paginated payments
        $payments = $query->orderBy('date', 'desc')
            ->paginate(15);
        
        // Calculate totals for display
        $totalRevenue = Payment::where('status', 'paid')->sum('amount');
        $pendingRevenue = Payment::where('status', 'pending')->sum('amount');
        
        // Get chart data for monthly revenue (last 12 months)
        $monthlyRevenue = $this->getMonthlyRevenue();
        
        // Get payment methods distribution
        $paymentMethods = $this->getPaymentMethodsDistribution();
        
        // Get payment status distribution
        $paymentStatuses = $this->getPaymentStatusDistribution();
        
        // Get weekly payment trends (last 4 weeks)
        $weeklyTrends = $this->getWeeklyTrends();
        
        return view('admin.payments.index', compact(
            'payments', 
            'totalRevenue', 
            'pendingRevenue',
            'monthlyRevenue',
            'paymentMethods',
            'paymentStatuses',
            'weeklyTrends'
        ));
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
 * Generate payment report.
 *
 * @return \Illuminate\Http\Response
 */
public function report()
{
    // Date range defaults
    $startDate = request('start_date') 
        ? \Carbon\Carbon::parse(request('start_date')) 
        : \Carbon\Carbon::now()->startOfMonth();
    $endDate = request('end_date') 
        ? \Carbon\Carbon::parse(request('end_date')) 
        : \Carbon\Carbon::now();
    
    $payments = Payment::with('subscription.user')
        ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
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
        return \Carbon\Carbon::parse($item->date)->format('Y-m-d');
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
    /**
     * Get monthly revenue data for the last 12 months.
     *
     * @return array
     */
    private function getMonthlyRevenue()
    {
        $result = [
            'labels' => [],
            'data' => []
        ];
        
        // Get the last 12 months
        $months = [];
        $data = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->format('M');
            
            $amount = Payment::where('status', 'paid')
                ->whereYear('date', $month->year)
                ->whereMonth('date', $month->month)
                ->sum('amount');
                
            $data[] = $amount;
        }
        
        $result['labels'] = $months;
        $result['data'] = $data;
        
        return $result;
    }
    
    /**
     * Get payment methods distribution.
     *
     * @return array
     */
    private function getPaymentMethodsDistribution()
    {
        $methods = Payment::select('method', DB::raw('COUNT(*) as count'))
            ->groupBy('method')
            ->get();
            
        $result = [
            'labels' => [],
            'data' => [],
            'backgroundColor' => [
                'rgba(99, 102, 241, 0.6)',   // Indigo
                'rgba(52, 211, 153, 0.6)',   // Green
                'rgba(251, 146, 60, 0.6)',   // Orange
                'rgba(79, 70, 229, 0.6)',    // Purple
                'rgba(156, 163, 175, 0.6)'   // Gray
            ]
        ];
        
        foreach ($methods as $method) {
            $result['labels'][] = ucfirst($method->method);
            $result['data'][] = $method->count;
        }
        
        return $result;
    }
    
    /**
     * Get payment status distribution.
     *
     * @return array
     */
    private function getPaymentStatusDistribution()
    {
        $statuses = Payment::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();
            
        $result = [
            'labels' => [],
            'data' => [],
            'backgroundColor' => [
                'rgba(52, 211, 153, 0.6)',   // Green for paid
                'rgba(251, 146, 60, 0.6)',   // Orange for pending
                'rgba(239, 68, 68, 0.6)'     // Red for refunded
            ]
        ];
        
        foreach ($statuses as $status) {
            $result['labels'][] = ucfirst($status->status);
            $result['data'][] = $status->count;
        }
        
        return $result;
    }
    
    /**
     * Get weekly payment trends for the last 4 weeks.
     *
     * @return array
     */
    private function getWeeklyTrends()
    {
        $result = [
            'labels' => [],
            'transactions' => [],
            'revenue' => []
        ];
        
        // Get the last 4 weeks
        for ($i = 3; $i >= 0; $i--) {
            $startDate = Carbon::now()->subWeeks($i)->startOfWeek();
            $endDate = Carbon::now()->subWeeks($i)->endOfWeek();
            
            $result['labels'][] = 'Week ' . (4 - $i);
            
            // Get transaction count
            $transactions = Payment::whereBetween('date', [$startDate, $endDate])->count();
            $result['transactions'][] = $transactions;
            
            // Get revenue
            $revenue = Payment::where('status', 'paid')
                ->whereBetween('date', [$startDate, $endDate])
                ->sum('amount');
            $result['revenue'][] = $revenue;
        }
        
        return $result;
    }
}
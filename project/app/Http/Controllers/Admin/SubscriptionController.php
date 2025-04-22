<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionConfirmation;

class SubscriptionController extends Controller
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
        $subscriptions = Subscription::with('user')
            ->orderBy('start_date', 'desc')
            ->paginate(15);
            
        // Calculate subscription statistics
        $activeCount = Subscription::where('status', 'active')
            ->where('end_date', '>=', now())
            ->count();
            
        $expiredCount = Subscription::where('end_date', '<', now())
            ->count();
            
        $cancelledCount = Subscription::where('status', 'cancelled')
            ->count();
            
        $pendingCount = Subscription::where('status', 'pending')
            ->count();
            
        return view('admin.subscriptions.index', compact(
            'subscriptions',
            'activeCount',
            'expiredCount',
            'cancelledCount',
            'pendingCount'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = User::where('role', 'Member')->get();
        $types = ['Basic', 'Premium', 'Elite'];
        $durations = [1, 3, 6, 12]; // months
        
        return view('admin.subscriptions.create', compact('members', 'types', 'durations'));
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
            'transaction_number' => 'nullable|string|max:255',
            'max_sessions_count' => 'nullable|integer|min:0',
            'sessions_left' => 'nullable|integer|min:0',
            'trainer_zone_access' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $subscription = Subscription::create($validated);
        
        // Create payment record if payment info provided
        if (!empty($validated['payment_method'])) {
            Payment::create([
                'subscription_id' => $subscription->id,
                'amount' => $validated['price'],
                'date' => now(),
                'method' => $validated['payment_method'],
                'status' => $validated['status'] === 'active' ? 'paid' : 'pending',
                'reference' => $validated['transaction_number'] ?? null,
            ]);
        }
        
        // Send email notification if subscription is active
        if ($validated['status'] === 'active') {
            $this->sendSubscriptionEmail($subscription->user, $subscription);
        }

        return redirect()->route('admin.subscriptions.index')
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
        return view('admin.subscriptions.show', compact('subscription'));
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
        $types = ['Basic', 'Premium', 'Elite'];
        $durations = [1, 3, 6, 12]; // months
        
        return view('admin.subscriptions.edit', compact('subscription', 'members', 'types', 'durations'));
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
            'transaction_number' => 'nullable|string|max:255',
            'max_sessions_count' => 'nullable|integer|min:0',
            'sessions_left' => 'nullable|integer|min:0',
            'trainer_zone_access' => 'boolean',
            'notes' => 'nullable|string',
        ]);

        $oldStatus = $subscription->status;
        $subscription->update($validated);
        
        // If status changed to active, create a payment record if needed
        if ($oldStatus !== 'active' && $validated['status'] === 'active' && !empty($validated['payment_method'])) {
            // Check if payment already exists
            $paymentExists = Payment::where('subscription_id', $subscription->id)
                ->where('status', 'paid')
                ->exists();
                
            if (!$paymentExists) {
                Payment::create([
                    'subscription_id' => $subscription->id,
                    'amount' => $validated['price'],
                    'date' => now(),
                    'method' => $validated['payment_method'],
                    'status' => 'paid',
                    'reference' => $validated['transaction_number'] ?? null,
                ]);
            }
            
            // Send email notification
            $this->sendSubscriptionEmail($subscription->user, $subscription);
        }

        return redirect()->route('admin.subscriptions.index')
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
        // Check if the subscription has payments
        if ($subscription->payments()->count() > 0) {
            return redirect()->route('admin.subscriptions.index')
                ->with('error', 'Cannot delete subscription with payment records. Cancel the subscription instead.');
        }
        
        $subscription->delete();

        return redirect()->route('admin.subscriptions.index')
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
            'duration' => 'required|integer|min:1',
            'payment_method' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'transaction_number' => 'nullable|string|max:255',
        ]);

        // Calculate new end date based on current end date or today (whichever is later)
        $baseDate = max(Carbon::parse($subscription->end_date), Carbon::today());
        $newEndDate = $baseDate->copy()->addMonths($validated['duration']);

        // Update subscription
        $subscription->update([
            'end_date' => $newEndDate,
            'status' => 'active',
            'duration' => $subscription->duration + $validated['duration'],
        ]);

        // Create payment record
        Payment::create([
            'subscription_id' => $subscription->id,
            'amount' => $validated['price'],
            'date' => now(),
            'method' => $validated['payment_method'],
            'status' => 'paid',
            'reference' => $validated['transaction_number'] ?? null,
        ]);
        
        // Send email notification
        $this->sendSubscriptionEmail($subscription->user, $subscription);

        return redirect()->route('admin.subscriptions.show', $subscription)
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
        $subscription->update([
            'status' => 'cancelled',
            'cancellation_date' => now(),
        ]);

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription cancelled successfully.');
    }
    
    /**
     * Generate subscription report.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request)
    {
        // Get subscription statistics
        $stats = [
            'total' => Subscription::count(),
            'active' => Subscription::where('status', 'active')
                ->where('end_date', '>=', now())
                ->count(),
            'pending' => Subscription::where('status', 'pending')->count(),
            'expired' => Subscription::where('end_date', '<', now())->count(),
            'cancelled' => Subscription::where('status', 'cancelled')->count(),
        ];
        
        // Get subscriptions by type
        $subscriptionsByType = Subscription::where('status', 'active')
            ->where('end_date', '>=', now())
            ->selectRaw('type, COUNT(*) as count')
            ->groupBy('type')
            ->get();
            
        // Get monthly revenue
        $monthlyRevenue = Payment::where('status', 'paid')
            ->whereYear('date', now()->year)
            ->selectRaw('MONTH(date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->get();
            
        // Prepare monthly data for chart
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthData = $monthlyRevenue->firstWhere('month', $i);
            $chartData[$i] = $monthData ? $monthData->total : 0;
        }
        
        // Get recent subscriptions
        $recentSubscriptions = Subscription::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
            
        return view('admin.subscriptions.report', compact(
            'stats',
            'subscriptionsByType',
            'chartData',
            'recentSubscriptions'
        ));
    }
    
    /**
     * Export subscriptions to CSV.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $subscriptions = Subscription::with('user')->get();
        $csvFileName = 'subscriptions_export_' . now()->format('Y-m-d') . '.csv';
        
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];
        
        $callback = function() use ($subscriptions) {
            $file = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($file, [
                'ID', 'Member', 'Email', 'Type', 'Start Date', 'End Date', 
                'Price', 'Status', 'Payment Method', 'Created At'
            ]);
            
            // Add rows
            foreach ($subscriptions as $subscription) {
                fputcsv($file, [
                    $subscription->id,
                    $subscription->user->firstname . ' ' . $subscription->user->lastname,
                    $subscription->user->email,
                    $subscription->type,
                    $subscription->start_date,
                    $subscription->end_date,
                    $subscription->price,
                    $subscription->status,
                    $subscription->payment_method,
                    $subscription->created_at
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
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
}
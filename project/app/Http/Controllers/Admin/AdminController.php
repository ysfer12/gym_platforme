<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Session;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Attendance;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
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
     * Display the administrator dashboard
     * 
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Get counts for dashboard stats
        $membersCount = User::where('role', 'Member')->count();
        $trainersCount = User::where('role', 'Trainer')->count();
        $sessionsCount = Session::where('date', '>=', now()->format('Y-m-d'))->count();
        
        // Get revenue for current month
        $currentMonthStart = now()->startOfMonth()->format('Y-m-d');
        $currentMonthEnd = now()->endOfMonth()->format('Y-m-d');
        
        $revenue = Payment::whereBetween('date', [$currentMonthStart, $currentMonthEnd])
            ->where('status', 'paid')
            ->sum('amount');
        
        // Get subscription statistics
        $activeSubscriptionsCount = Subscription::where('status', 'active')
            ->where('end_date', '>=', now()->format('Y-m-d'))
            ->count();
        
        $expiringSubscriptionsCount = Subscription::where('status', 'active')
            ->whereBetween('end_date', [
                now()->format('Y-m-d'),
                now()->addDays(7)->format('Y-m-d')
            ])
            ->count();
        
        $expiredSubscriptionsCount = Subscription::where('status', 'active')
            ->where('end_date', '<', now()->format('Y-m-d'))
            ->count();
        
        // Calculate subscription type distributions
        $totalSubscriptions = $activeSubscriptionsCount > 0 ? $activeSubscriptionsCount : 1;
        
        $basicSubscriptionsCount = Subscription::where('type', 'Basic')
            ->where('status', 'active')
            ->where('end_date', '>=', now()->format('Y-m-d'))
            ->count();
            
        $premiumSubscriptionsCount = Subscription::where('type', 'Premium')
            ->where('status', 'active')
            ->where('end_date', '>=', now()->format('Y-m-d'))
            ->count();
            
        $eliteSubscriptionsCount = Subscription::where('type', 'Elite')
            ->where('status', 'active')
            ->where('end_date', '>=', now()->format('Y-m-d'))
            ->count();
        
        $basicSubscriptionsPercentage = round(($basicSubscriptionsCount / $totalSubscriptions) * 100);
        $premiumSubscriptionsPercentage = round(($premiumSubscriptionsCount / $totalSubscriptions) * 100);
        $eliteSubscriptionsPercentage = round(($eliteSubscriptionsCount / $totalSubscriptions) * 100);
        
        // Get recent data for dashboard
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();
        $recentPayments = Payment::with('subscription.user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        
        $upcomingSessions = Session::where('date', '>=', now()->format('Y-m-d'))
            ->orderBy('date')
            ->orderBy('start_time')
            ->with('trainer')
            ->take(5)
            ->get();
        
        return view('dashboards.admin', compact(
            'membersCount',
            'trainersCount',
            'sessionsCount',
            'revenue',
            'activeSubscriptionsCount',
            'expiringSubscriptionsCount',
            'expiredSubscriptionsCount',
            'basicSubscriptionsPercentage',
            'premiumSubscriptionsPercentage',
            'eliteSubscriptionsPercentage',
            'recentUsers',
            'recentPayments',
            'upcomingSessions'
        ));
    }

    /**
     * Generate member report
     * 
     * @return \Illuminate\View\View
     */
    public function memberReport()
    {
        // Get all members
        $members = User::where('role', 'Member')->get();
        
        // Get active members count
        $activeMembers = $members->where('status', 'Active')->count();
        
        // Get inactive members count
        $inactiveMembers = $members->where('status', 'Inactive')->count();
        
        // Get new members this month
        $newMembers = User::where('role', 'Member')
            ->whereMonth('registrationDate', now()->month)
            ->whereYear('registrationDate', now()->year)
            ->count();
            
        // Get members with active subscriptions
        $membersWithActiveSubscriptions = Subscription::where('status', 'active')
            ->where('end_date', '>=', now())
            ->distinct('user_id')
            ->count('user_id');
            
        // Get members by subscription type
        $membersBySubscriptionType = Subscription::where('status', 'active')
            ->where('end_date', '>=', now())
            ->selectRaw('type, count(*) as count')
            ->groupBy('type')
            ->get();
            
        // Get members with most attendance
        $membersWithMostAttendance = User::where('role', 'Member')
            ->withCount(['attendances' => function($query) {
                $query->whereMonth('date', now()->month)
                      ->whereYear('date', now()->year);
            }])
            ->orderBy('attendances_count', 'desc')
            ->take(10)
            ->get();
        
        return view('admin.reports.members', compact(
            'members',
            'activeMembers',
            'inactiveMembers',
            'newMembers',
            'membersWithActiveSubscriptions',
            'membersBySubscriptionType',
            'membersWithMostAttendance'
        ));
    }

    /**
     * Generate session report
     * 
     * @return \Illuminate\View\View
     */
    public function sessionReport()
    {
        // Get all sessions
        $sessions = Session::with('trainer')->get();
        
        // Get sessions by type
        $sessionsByType = Session::selectRaw('type, count(*) as count')
            ->groupBy('type')
            ->get();
            
        // Get sessions by trainer
        $sessionsByTrainer = Session::selectRaw('trainer_id, count(*) as count')
            ->with('trainer')
            ->groupBy('trainer_id')
            ->get();
            
        // Get most popular sessions (by attendance)
        $popularSessions = Session::withCount('attendances')
            ->orderBy('attendances_count', 'desc')
            ->take(10)
            ->get();
            
        // Get sessions by time of day
        $morningSessionsCount = Session::whereTime('start_time', '>=', '06:00:00')
            ->whereTime('start_time', '<', '12:00:00')
            ->count();
            
        $afternoonSessionsCount = Session::whereTime('start_time', '>=', '12:00:00')
            ->whereTime('start_time', '<', '17:00:00')
            ->count();
            
        $eveningSessionsCount = Session::whereTime('start_time', '>=', '17:00:00')
            ->whereTime('start_time', '<', '22:00:00')
            ->count();
        
        return view('admin.reports.sessions', compact(
            'sessions',
            'sessionsByType',
            'sessionsByTrainer',
            'popularSessions',
            'morningSessionsCount',
            'afternoonSessionsCount',
            'eveningSessionsCount'
        ));
    }

    /**
     * Generate revenue report
     * 
     * @return \Illuminate\View\View
     */
    public function revenueReport()
    {
        // Get total revenue
        $totalRevenue = Payment::where('status', 'paid')->sum('amount');
        
        // Get monthly revenue for the past 12 months
        $monthlyRevenue = [];
        for ($i = 0; $i < 12; $i++) {
            $date = now()->subMonths($i);
            $month = $date->format('F Y');
            
            $revenue = Payment::where('status', 'paid')
                ->whereYear('date', $date->year)
                ->whereMonth('date', $date->month)
                ->sum('amount');
                
            $monthlyRevenue[$month] = $revenue;
        }
        
        // Revenue by subscription type
        $revenueByType = Subscription::join('payments', 'subscriptions.id', '=', 'payments.subscription_id')
            ->where('payments.status', 'paid')
            ->selectRaw('subscriptions.type, SUM(payments.amount) as total')
            ->groupBy('subscriptions.type')
            ->get();
            
        // Revenue by payment method
        $revenueByMethod = Payment::where('status', 'paid')
            ->selectRaw('method, SUM(amount) as total')
            ->groupBy('method')
            ->get();
            
        // Get current month's revenue
        $currentMonthRevenue = Payment::where('status', 'paid')
            ->whereYear('date', now()->year)
            ->whereMonth('date', now()->month)
            ->sum('amount');
            
        // Get previous month's revenue
        $previousMonthRevenue = Payment::where('status', 'paid')
            ->whereYear('date', now()->subMonth()->year)
            ->whereMonth('date', now()->subMonth()->month)
            ->sum('amount');
            
        // Calculate growth percentage
        $growthPercentage = $previousMonthRevenue > 0 
            ? (($currentMonthRevenue - $previousMonthRevenue) / $previousMonthRevenue) * 100 
            : 0;
        
        return view('admin.reports.revenues', compact(
            'totalRevenue',
            'monthlyRevenue',
            'revenueByType',
            'revenueByMethod',
            'currentMonthRevenue',
            'previousMonthRevenue',
            'growthPercentage'
        ));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Session;
use App\Models\Subscription;
use App\Models\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the dashboard appropriate for the user's role.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        // Redirect to the appropriate dashboard based on user role
        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isTrainer()) {
            return $this->trainerDashboard();
        } elseif ($user->isReceptionist()) {
            return $this->receptionistDashboard();
        } else {
            return $this->memberDashboard();
        }
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    private function adminDashboard()
    {
        // Add any admin-specific data to pass to the view
        return view('dashboards.admin');
    }

    /**
     * Show the trainer dashboard.
     *
     * @return \Illuminate\View\View
     */
    private function trainerDashboard()
    {
        // Add any trainer-specific data to pass to the view
        return view('dashboards.trainer');
    }

    /**
     * Show the receptionist dashboard.
     *
     * @return \Illuminate\View\View
     */
    private function receptionistDashboard()
    {
        // Add any receptionist-specific data to pass to the view
        return view('dashboards.receptionist');
    }

    /**
     * Show the member dashboard.
     *
     * @return \Illuminate\View\View
     */
    private function memberDashboard()
    {
        $user = Auth::user();
        
        // Get active subscription
        $activeSubscription = Subscription::where('user_id', $user->id)
            ->where('end_date', '>=', Carbon::today())
            ->where('status', 'active')
            ->first();
            
        // Get upcoming booked sessions
        $upcomingSessions = Session::whereHas('attendances', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('date', '>=', Carbon::today())
            ->orderBy('date')
            ->orderBy('start_time')
            ->take(5)
            ->get();
            
        // Get recent activity (attendances)
        $recentAttendances = Attendance::where('user_id', $user->id)
            ->with('session')
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();
            
        // Get popular classes (most attended sessions)
        $popularSessions = Session::withCount('attendances')
            ->orderBy('attendances_count', 'desc')
            ->take(3)
            ->get();
            
        // Get this month's activity count
        $monthlyActivity = Attendance::where('user_id', $user->id)
            ->whereMonth('date', Carbon::now()->month)
            ->count();
        
        return view('dashboards.member', compact(
            'activeSubscription',
            'upcomingSessions',
            'recentAttendances',
            'popularSessions',
            'monthlyActivity'
        ));
    }
}
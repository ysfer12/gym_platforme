<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Subscription;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MemberController extends Controller
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
     * Show the member dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
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

    /**
     * Display sessions available for members to book.
     *
     * @return \Illuminate\Http\Response
     */
    public function sessions()
    {
        $upcomingSessions = Session::where('date', '>=', Carbon::today())
            ->orderBy('date')
            ->orderBy('start_time')
            ->paginate(10);
            
        // Get current user's booked sessions
        $user = Auth::user();
        $bookedSessionIds = $user->attendances()
            ->pluck('session_id')
            ->toArray();
            
        return view('member.sessions', compact('upcomingSessions', 'bookedSessionIds'));
    }

    /**
     * Book a session for the logged-in member.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function bookSession(Session $session)
    {
        $user = Auth::user();
        
        // Check if user already booked this session
        if ($session->attendances()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'You have already booked this session.');
        }
        
        // Check if session is full
        if ($session->attendances()->count() >= $session->max_capacity) {
            return redirect()->back()->with('error', 'This session is already at full capacity.');
        }
        
        // Check if user has an active subscription
        $hasActiveSubscription = Subscription::where('user_id', $user->id)
            ->where('end_date', '>=', Carbon::today())
            ->where('status', 'active')
            ->exists();
            
        if (!$hasActiveSubscription) {
            return redirect()->route('member.subscription')
                ->with('error', 'You need an active subscription to book sessions.');
        }
        
        // Create attendance record
        $session->attendances()->create([
            'user_id' => $user->id,
            'date' => $session->date,
            'check_in_method' => 'online',
        ]);
        
        return redirect()->back()->with('success', 'Session booked successfully!');
    }

    /**
     * Display attendance history for the logged-in member.
     *
     * @return \Illuminate\Http\Response
     */
    public function attendance()
    {
        $user = Auth::user();
        
        // Get attendance history
        $attendances = Attendance::where('user_id', $user->id)
            ->with('session')
            ->orderBy('date', 'desc')
            ->paginate(15);
            
        // Get attendance statistics
        $stats = [
            'total' => Attendance::where('user_id', $user->id)->count(),
            'thisMonth' => Attendance::where('user_id', $user->id)
                ->whereMonth('date', Carbon::now()->month)
                ->count(),
            'lastMonth' => Attendance::where('user_id', $user->id)
                ->whereMonth('date', Carbon::now()->subMonth()->month)
                ->count(),
            'thisYear' => Attendance::where('user_id', $user->id)
                ->whereYear('date', Carbon::now()->year)
                ->count(),
        ];
            
        return view('member.attendance', compact('attendances', 'stats'));
    }
}
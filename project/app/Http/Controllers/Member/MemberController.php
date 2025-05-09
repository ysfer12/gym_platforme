<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Subscription;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
     * Show the member profile and badge.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $user = Auth::user();
        
        // Get active subscription
        $activeSubscription = Subscription::where('user_id', $user->id)
            ->where('end_date', '>=', Carbon::today())
            ->where('status', 'active')
            ->first();
        
        return view('member.profile', compact('activeSubscription'));
    }

    /**
     * Display sessions available for members to book.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sessions(Request $request)
    {
        // Start query with basic filter for upcoming sessions
        $query = Session::where('date', '>=', Carbon::today());
        
        // Apply type filter if provided
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        // Apply level filter if provided
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }
        
        // Apply city filter if provided
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }
        
        // Apply date filter if provided
        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }
        
        // Get sorted sessions with pagination
        $upcomingSessions = $query->orderBy('date')
            ->orderBy('start_time')
            ->paginate(10);
            
        // Get current user's booked sessions
        $user = Auth::user();
        $bookedSessionIds = $user->attendances()
            ->pluck('session_id')
            ->toArray();
            
        // Get list of unique cities for the filter dropdown
        $cities = Session::where('date', '>=', Carbon::today())
            ->select('city')
            ->distinct()
            ->pluck('city')
            ->filter()
            ->toArray();
            
        return view('member.sessions', compact('upcomingSessions', 'bookedSessionIds', 'cities'));
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
        $activeSubscription = Subscription::where('user_id', $user->id)
            ->where('end_date', '>=', Carbon::today())
            ->where('status', 'active')
            ->first();
            
        if (!$activeSubscription) {
            return redirect()->route('member.subscription')
                ->with('error', 'You need an active subscription to book sessions.');
        }
        
        // If subscription has a session limit, check if user has sessions left
        if ($activeSubscription->max_sessions_count && $activeSubscription->sessions_left <= 0) {
            return redirect()->back()->with('error', 'You have used all available sessions in your subscription.');
        }
        
        // Create attendance record in a transaction
        try {
            DB::beginTransaction();
            
            $session->attendances()->create([
                'user_id' => $user->id,
                'date' => $session->date,
                'check_in_method' => 'online',
            ]);
            
            // If subscription has a session limit, decrement sessions_left
            if ($activeSubscription->max_sessions_count) {
                $activeSubscription->sessions_left = $activeSubscription->sessions_left - 1;
                $activeSubscription->save();
            }
            
            DB::commit();
            
            return redirect()->back()->with('success', 'Session booked successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while booking the session. Please try again.');
        }
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
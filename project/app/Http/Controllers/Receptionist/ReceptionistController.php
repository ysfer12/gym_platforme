<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Session;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReceptionistController extends Controller
{
    /**
     * Show the receptionist dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Get today's date
        $today = Carbon::today();
        
        // Get today's sessions
        $todaySessionsList = Session::where('date', $today)
            ->orderBy('start_time')
            ->with(['trainer', 'attendances'])
            ->get();
            
        // Get recent members
        $recentMembers = User::where('role', 'Member')
            ->orderBy('registrationDate', 'desc')
            ->take(5)
            ->get();
            
        // Get expiring subscriptions
        $expiringSubscriptions = Subscription::where('status', 'active')
            ->whereBetween('end_date', [
                Carbon::today(),
                Carbon::today()->addDays(7)
            ])
            ->with('user')
            ->get();
            
        // Get pending payments
        $pendingPayments = Payment::where('status', 'pending')
            ->with('subscription.user')
            ->get();
            
        // Dashboard stats
        $todayCheckIns = Attendance::whereDate('entry_time', $today)->count();
        $activeMembers = User::where('role', 'Member')->where('status', 'Active')->count();
        $todaySessions = Session::where('date', $today)->count();
        $todayRevenue = Payment::whereDate('date', $today)->where('status', 'paid')->sum('amount');
        
        // Recent check-ins
        $recentCheckIns = Attendance::whereNotNull('entry_time')
            ->with(['user', 'session'])
            ->orderBy('entry_time', 'desc')
            ->limit(10)
            ->get();
            
        // Monthly revenue
        $startOfMonth = Carbon::today()->startOfMonth();
        $monthRevenue = Payment::where('status', 'paid')
            ->whereDate('date', '>=', $startOfMonth)
            ->sum('amount');
        
        // Monthly new subscriptions
        $monthNewSubscriptions = Subscription::whereDate('start_date', '>=', $startOfMonth)->count();
        
        return view('dashboards.receptionist', compact(
            'todaySessionsList',
            'recentMembers',
            'expiringSubscriptions',
            'pendingPayments',
            'todayCheckIns',
            'activeMembers',
            'todaySessions',
            'todayRevenue',
            'recentCheckIns',
            'monthRevenue',
            'monthNewSubscriptions'
        ));
    }

    /**
     * Display members list
     *
     * @return \Illuminate\View\View
     */
    public function members(Request $request)
    {
        $query = User::where('role', 'Member');
        
        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        // Order results
        $orderBy = $request->orderBy ?? 'lastname';
        $order = $request->order ?? 'asc';
        $query->orderBy($orderBy, $order);
        
        $members = $query->paginate(15);
        
        return view('receptionist.members.index', compact('members'));
    }

    /**
     * Display member details
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function memberDetails($id)
    {
        $member = User::where('role', 'Member')->findOrFail($id);
        
        // Get member's active subscription
        $activeSubscription = Subscription::where('user_id', $member->id)
            ->where('status', 'active')
            ->where('end_date', '>=', Carbon::today())
            ->first();
            
        // Get member's attendance history
        $attendances = Attendance::where('user_id', $member->id)
            ->with('session')
            ->orderBy('date', 'desc')
            ->paginate(10);
            
        // Get member's payment history
        $payments = Payment::whereHas('subscription', function($query) use ($member) {
            $query->where('user_id', $member->id);
        })
        ->orderBy('date', 'desc')
        ->get();
        
        // Get upcoming sessions the member is registered for
        $upcomingSessions = Session::whereHas('attendances', function($query) use ($member) {
            $query->where('user_id', $member->id);
        })
        ->where('date', '>=', Carbon::today())
        ->orderBy('date')
        ->orderBy('start_time')
        ->get();
        
        return view('receptionist.members.show', compact(
            'member', 
            'activeSubscription', 
            'attendances', 
            'payments', 
            'upcomingSessions'
        ));
    }

    /**
     * Book a session for a member
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function bookForMember(Request $request, Session $session)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        
        $user = User::findOrFail($validated['user_id']);
        
        // Verify user is a member
        if ($user->role !== 'Member') {
            return redirect()->back()->with('error', 'Only members can be booked for sessions.');
        }
        
        // Check if user already booked this session
        if ($session->attendances()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'This member has already booked this session.');
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
            return redirect()->back()
                ->with('error', 'This member does not have an active subscription.');
        }
        
        // Create attendance record
        $session->attendances()->create([
            'user_id' => $user->id,
            'date' => $session->date,
            'check_in_method' => 'receptionist',
        ]);
        
        // Admin notification integration
        // You could use event/listener here to notify admin about new booking
        
        return redirect()->back()->with('success', 'Session booked successfully for this member.');
    }
    
    /**
     * Display trainers list with their upcoming sessions
     *
     * @return \Illuminate\View\View
     */
    public function trainers()
    {
        $trainers = User::where('role', 'Trainer')
            ->withCount(['trainedSessions as upcoming_sessions_count' => function($query) {
                $query->where('date', '>=', Carbon::today());
            }])
            ->withCount('trainedSessions as total_sessions_count')
            ->orderBy('lastname')
            ->paginate(15);
            
        return view('receptionist.trainers.index', compact('trainers'));
    }
    
    /**
     * Display trainer details with their schedule and sessions
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function trainerDetails($id)
    {
        $trainer = User::where('role', 'Trainer')->findOrFail($id);
        
        // Get trainer's upcoming sessions
        $upcomingSessions = Session::where('trainer_id', $trainer->id)
            ->where('date', '>=', Carbon::today())
            ->orderBy('date')
            ->orderBy('start_time')
            ->paginate(10);
            
        // Get trainer's availability (if implemented)
        // $availabilities = TrainerAvailability::where('trainer_id', $trainer->id)
        //     ->orderBy('day_of_week')
        //     ->orderBy('start_time')
        //     ->get();
            
        return view('receptionist.trainers.show', compact('trainer', 'upcomingSessions'));
    }
}
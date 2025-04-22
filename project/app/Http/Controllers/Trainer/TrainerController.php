<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{
    /**
     * Show the trainer dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = Auth::user();
        
        // Get today's date
        $today = Carbon::today();
        
        // Get trainer's upcoming sessions
        $upcomingSessions = Session::where('trainer_id', $user->id)
            ->where('date', '>=', $today)
            ->orderBy('date')
            ->orderBy('start_time')
            ->limit(5)
            ->get();
            
        // Get count of sessions for today
        $todaySessions = Session::where('trainer_id', $user->id)
            ->where('date', $today)
            ->count();
            
        // Get count of total sessions led by the trainer
        $totalSessions = Session::where('trainer_id', $user->id)->count();
            
        // Get total number of unique members in trainer's sessions
        $totalUniqueMembers = Attendance::whereHas('session', function ($query) use ($user) {
            $query->where('trainer_id', $user->id);
        })
        ->distinct('user_id')
        ->count('user_id');
            
        // Get attendance rate for trainer's sessions
        $completedSessionIds = Session::where('trainer_id', $user->id)
            ->where('date', '<', $today)
            ->pluck('id');
            
        $bookedSlots = Attendance::whereIn('session_id', $completedSessionIds)->count();
        $maxCapacity = Session::whereIn('id', $completedSessionIds)->sum('max_capacity');
        
        $attendanceRate = $maxCapacity > 0 
            ? round(($bookedSlots / $maxCapacity) * 100, 2) 
            : 0;
        
        // Get recent attendances for the trainer's sessions
        $recentAttendances = Attendance::whereHas('session', function ($query) use ($user) {
            $query->where('trainer_id', $user->id);
        })
        ->with(['user', 'session'])
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get();
            
        return view('dashboards.trainer', compact(
            'upcomingSessions', 
            'todaySessions', 
            'totalSessions',
            'totalUniqueMembers', 
            'attendanceRate',
            'recentAttendances'
        ));
    }
    
    /**
     * Show attendance records for a specific session.
     *
     * @param  int  $session
     * @return \Illuminate\Http\Response
     */
    public function sessionAttendances($session)
    {
        $session = Session::findOrFail($session);
        
        // Verify this session belongs to the trainer
        if ($session->trainer_id !== Auth::id()) {
            return redirect()->route('trainer.dashboard')
                ->with('error', 'You are not authorized to view this session');
        }
        
        // Get all members registered for this session
        $attendances = Attendance::with('user')
            ->where('session_id', $session->id)
            ->get();
            
        return view('trainer.sessions.attendances', compact('session', 'attendances'));
    }
    
    /**
     * Display members in trainer's sessions.
     *
     * @return \Illuminate\Http\Response
     */
    public function members()
    {
        $trainer = Auth::user();
        
        // Get unique members who have attended the trainer's sessions
        $members = User::whereHas('attendances', function ($query) use ($trainer) {
            $query->whereHas('session', function ($q) use ($trainer) {
                $q->where('trainer_id', $trainer->id);
            });
        })
        ->withCount(['attendances as session_count' => function ($query) use ($trainer) {
            $query->whereHas('session', function ($q) use ($trainer) {
                $q->where('trainer_id', $trainer->id);
            });
        }])
        ->orderBy('session_count', 'desc')
        ->paginate(15);
        
        return view('trainer.members.index', compact('members'));
    }
    
    /**
     * Display member details and attendance history with the trainer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function memberDetails($id)
    {
        $trainer = Auth::user();
        $member = User::findOrFail($id);
        
        // Get the member's attendance in the trainer's sessions
        $attendances = Attendance::whereHas('session', function ($query) use ($trainer) {
            $query->where('trainer_id', $trainer->id);
        })
        ->where('user_id', $member->id)
        ->with('session')
        ->orderBy('date', 'desc')
        ->paginate(10);
        
        return view('trainer.members.show', compact('member', 'attendances'));
    }
}
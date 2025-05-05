<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
// Remove QR Code reference
// use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

        // Get trainer's experience level based on sessions count
        $experienceLevel = $this->getExperienceLevel($totalSessions);

        // Calculate QR data (will be used for client-side generation)
        $qrData = [
            'name' => $user->firstname . ' ' . $user->lastname,
            'trainer_level' => $experienceLevel['level'],
            'gym' => 'FitTrack Gym',
            'id' => 'TRN-' . str_pad($user->id, 5, '0', STR_PAD_LEFT)
        ];
            
        return view('dashboards.trainer', compact(
            'upcomingSessions', 
            'todaySessions', 
            'totalSessions',
            'totalUniqueMembers', 
            'attendanceRate',
            'recentAttendances',
            'experienceLevel',
            'qrData'
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

    /**
     * Show the trainer profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();
        
        // Get total sessions led by the trainer
        $totalSessions = Session::where('trainer_id', $user->id)->count();
        
        // Get total unique members in trainer's sessions
        $totalUniqueMembers = Attendance::whereHas('session', function ($query) use ($user) {
            $query->where('trainer_id', $user->id);
        })
        ->distinct('user_id')
        ->count('user_id');
        
        // Get trainer's experience level based on sessions count
        $experienceLevel = $this->getExperienceLevel($totalSessions);
        
        // Get trainer's specialties (session types)
        $specialties = Session::where('trainer_id', $user->id)
            ->select('type')
            ->distinct()
            ->pluck('type')
            ->toArray();
        
        // Generate QR data for JS-based QR code
        $qrData = [
            'name' => $user->firstname . ' ' . $user->lastname,
            'email' => $user->email,
            'trainer_level' => $experienceLevel['level'],
            'sessions_count' => $totalSessions,
            'specialties' => implode(', ', $specialties),
            'gym' => 'FitTrack Gym',
            'verified' => true,
            'id' => 'TRN-' . str_pad($user->id, 5, '0', STR_PAD_LEFT)
        ];
        
        return view('trainer.profile', compact(
            'user',
            'totalSessions',
            'totalUniqueMembers',
            'experienceLevel',
            'specialties',
            'qrData'
        ));
    }

    /**
     * Download trainer badge as an HTML file that can be saved or printed
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadBadge()
    {
        $user = Auth::user();
        
        // Get total sessions led by the trainer
        $totalSessions = Session::where('trainer_id', $user->id)->count();
        
        // Get trainer's experience level based on sessions count
        $experienceLevel = $this->getExperienceLevel($totalSessions);
        
        // Get trainer's specialties (session types)
        $specialties = Session::where('trainer_id', $user->id)
            ->select('type')
            ->distinct()
            ->pluck('type')
            ->toArray();
        
        // Generate QR data as JSON
        $qrData = [
            'name' => $user->firstname . ' ' . $user->lastname,
            'email' => $user->email,
            'trainer_level' => $experienceLevel['level'],
            'sessions_count' => $totalSessions,
            'specialties' => implode(', ', $specialties),
            'gym' => 'FitTrack Gym',
            'verified' => true,
            'id' => 'TRN-' . str_pad($user->id, 5, '0', STR_PAD_LEFT)
        ];
        
        // Return a view that will generate a downloadable badge with JS-based QR code
        return view('trainer.download-badge', compact(
            'user',
            'totalSessions',
            'experienceLevel',
            'specialties',
            'qrData'
        ));
    }

    /**
     * Show trainer badge full view.
     *
     * @return \Illuminate\Http\Response
     */
    public function showBadge()
    {
        $user = Auth::user();
        
        // Get total sessions led by the trainer
        $totalSessions = Session::where('trainer_id', $user->id)->count();
        
        // Get total unique members in trainer's sessions
        $totalUniqueMembers = Attendance::whereHas('session', function ($query) use ($user) {
            $query->where('trainer_id', $user->id);
        })
        ->distinct('user_id')
        ->count('user_id');
        
        // Get trainer's experience level based on sessions count
        $experienceLevel = $this->getExperienceLevel($totalSessions);
        
        // Get trainer's specialties (session types)
        $specialties = Session::where('trainer_id', $user->id)
            ->select('type')
            ->distinct()
            ->pluck('type')
            ->toArray();
        
        // Generate QR data for JS-based QR code
        $qrData = [
            'name' => $user->firstname . ' ' . $user->lastname,
            'email' => $user->email,
            'trainer_level' => $experienceLevel['level'],
            'sessions_count' => $totalSessions,
            'specialties' => implode(', ', $specialties),
            'gym' => 'FitTrack Gym',
            'verified' => true,
            'id' => 'TRN-' . str_pad($user->id, 5, '0', STR_PAD_LEFT)
        ];
        
        return view('trainer.badge', compact(
            'user',
            'totalSessions',
            'experienceLevel',
            'specialties',
            'qrData'
        ));
    }

    /**
     * Determine trainer's experience level based on sessions count.
     *
     * @param int $sessionCount
     * @return array
     */
    private function getExperienceLevel($sessionCount)
    {
        if ($sessionCount >= 100) {
            return [
                'level' => 'Expert',
                'badge' => 'gold',
                'progress' => 100,
            ];
        } elseif ($sessionCount >= 50) {
            $progress = (($sessionCount - 50) / 50) * 100;
            return [
                'level' => 'Advanced',
                'badge' => 'silver',
                'progress' => $progress,
            ];
        } elseif ($sessionCount >= 20) {
            $progress = (($sessionCount - 20) / 30) * 100;
            return [
                'level' => 'Intermediate',
                'badge' => 'bronze',
                'progress' => $progress,
            ];
        } else {
            $progress = ($sessionCount / 20) * 100;
            return [
                'level' => 'Beginner',
                'badge' => 'basic',
                'progress' => $progress,
            ];
        }
    }
}
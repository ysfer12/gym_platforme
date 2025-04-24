<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\User;
use Carbon\Carbon;

class SessionController extends Controller
{
    /**
     * Display a listing of the sessions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Session::with('trainer');
        
        // Filter by date if provided
        if ($request->has('date')) {
            $query->where('date', $request->date);
        } else {
            // Default to today and future sessions
            $query->where('date', '>=', Carbon::today());
        }
        
        // Filter by trainer if provided
        if ($request->has('trainer_id') && $request->trainer_id != 'all') {
            $query->where('trainer_id', $request->trainer_id);
        }
        
        // Filter by session type if provided
        if ($request->has('type') && $request->type != 'all') {
            $query->where('type', $request->type);
        }
        
        // Sort by date and time
        $query->orderBy('date');
        $query->orderBy('start_time');
        
        $sessions = $query->paginate(15);
        $trainers = User::where('role', 'Trainer')->get();
        $sessionTypes = Session::select('type')->distinct()->pluck('type');
        
        return view('receptionist.sessions.index', compact('sessions', 'trainers', 'sessionTypes'));
    }

    /**
     * Display the specified session with attendees.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $session = Session::with(['trainer', 'attendances.user'])->findOrFail($id);
        
        // Get list of members who can be added to the session
        $eligibleMembers = User::where('role', 'Member')
            ->whereHas('subscriptions', function ($query) {
                $query->where('status', 'active')
                      ->where('end_date', '>=', Carbon::today());
            })
            ->whereDoesntHave('attendances', function ($query) use ($session) {
                $query->where('session_id', $session->id);
            })
            ->get();
        
        // Calculate available spots
        $availableSpots = $session->max_capacity - $session->attendances->count();
        
        return view('receptionist.sessions.show', compact('session', 'eligibleMembers', 'availableSpots'));
    }
    
    /**
     * Record attendance for a member in a session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $sessionId
     * @return \Illuminate\Http\Response
     */
    public function recordAttendance(Request $request, $sessionId)
    {
        $session = Session::findOrFail($sessionId);
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'attendance_type' => 'required|in:entry,exit',
        ]);
        
        $member = User::findOrFail($request->user_id);
        
        // Find existing attendance record
        $attendance = $session->attendances()
            ->where('user_id', $member->id)
            ->first();
            
        if (!$attendance) {
            // If there's no existing attendance and we're recording an entry
            if ($request->attendance_type == 'entry') {
                // Create new attendance record with entry time
                $attendance = $session->attendances()->create([
                    'user_id' => $member->id,
                    'date' => $session->date,
                    'entry_time' => Carbon::now(),
                    'check_in_method' => 'receptionist',
                ]);
                
                return redirect()->back()->with('success', 'Entry recorded successfully.');
            } else {
                return redirect()->back()->with('error', 'Cannot record exit without entry.');
            }
        } else {
            // Update existing attendance
            if ($request->attendance_type == 'entry') {
                $attendance->entry_time = Carbon::now();
                $attendance->save();
                
                return redirect()->back()->with('success', 'Entry updated successfully.');
            } else {
                // Record exit
                if (!$attendance->entry_time) {
                    return redirect()->back()->with('error', 'Cannot record exit without entry.');
                }
                
                $attendance->exit_time = Carbon::now();
                $attendance->save();
                
                return redirect()->back()->with('success', 'Exit recorded successfully.');
            }
        }
    }
    
    /**
     * Remove a member from a session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $sessionId
     * @return \Illuminate\Http\Response
     */
    public function removeMember(Request $request, $sessionId)
    {
        $session = Session::findOrFail($sessionId);
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        
        // Delete the attendance record
        $session->attendances()->where('user_id', $request->user_id)->delete();
        
        return redirect()->back()->with('success', 'Member removed from session successfully.');
    }
}
<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Record entry for a member in a session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function recordEntry(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:sessions,id',
            'user_id' => 'required|exists:users,id',
        ]);
        
        $session = Session::findOrFail($request->session_id);
        
        // Verify this session belongs to the trainer
        if ($session->trainer_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to manage attendance for this session');
        }
        
        // Check if attendance record exists
        $attendance = Attendance::where('session_id', $request->session_id)
            ->where('user_id', $request->user_id)
            ->first();
            
        if (!$attendance) {
            return back()->with('error', 'Member is not registered for this session');
        }
        
        // Record entry time
        $attendance->entry_time = Carbon::now();
        $attendance->check_in_method = 'trainer';
        $attendance->save();
        
        return back()->with('success', 'Entry recorded successfully');
    }
    
    /**
     * Record exit for a member in a session
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function recordExit(Request $request, Attendance $attendance)
    {
        $session = Session::findOrFail($attendance->session_id);
        
        // Verify this session belongs to the trainer
        if ($session->trainer_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to manage attendance for this session');
        }
        
        // Check if entry time exists
        if (!$attendance->entry_time) {
            return back()->with('error', 'Cannot record exit without entry');
        }
        
        // Record exit time
        $attendance->exit_time = Carbon::now();
        $attendance->save();
        
        return back()->with('success', 'Exit recorded successfully');
    }
}
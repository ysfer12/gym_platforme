<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Services\Interfaces\AttendanceServiceInterface;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * @var AttendanceServiceInterface
     */
    protected $attendanceService;

    /**
     * AttendanceController constructor.
     *
     * @param AttendanceServiceInterface $attendanceService
     */
    public function __construct(AttendanceServiceInterface $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

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
        
        $result = $this->attendanceService->recordEntry(
            $request->session_id, 
            $request->user_id, 
            Auth::id()
        );
        
        if ($result['success']) {
            return back()->with('success', $result['message']);
        } else {
            return back()->with('error', $result['message']);
        }
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
        $result = $this->attendanceService->recordExit(
            $attendance->id,
            Auth::id()
        );
        
        if ($result['success']) {
            return back()->with('success', $result['message']);
        } else {
            return back()->with('error', $result['message']);
        }
    }
}
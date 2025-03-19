<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = Attendance::with(['user', 'session'])->latest()->get();
        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = User::where('role', 'Member')->get();
        $sessions = Session::all();
        return view('attendances.create', compact('members', 'sessions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'session_id' => 'required|exists:sessions,id',
            'date' => 'required|date',
            'entry_time' => 'nullable|date_format:H:i',
            'exit_time' => 'nullable|date_format:H:i|after:entry_time',
            'check_in_method' => 'required|string|max:255',
        ]);

        Attendance::create($validated);

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance recorded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        $attendance->load('user', 'session');
        return view('attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        $members = User::where('role', 'Member')->get();
        $sessions = Session::all();
        return view('attendances.edit', compact('attendance', 'members', 'sessions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'session_id' => 'required|exists:sessions,id',
            'date' => 'required|date',
            'entry_time' => 'nullable|date_format:H:i',
            'exit_time' => 'nullable|date_format:H:i|after:entry_time',
            'check_in_method' => 'required|string|max:255',
        ]);

        $attendance->update($validated);

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index')
            ->with('success', 'Attendance deleted successfully.');
    }

    /**
     * Record entry for a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function recordEntry(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'session_id' => 'required|exists:sessions,id',
        ]);

        $attendance = Attendance::where([
            'user_id' => $validated['user_id'],
            'session_id' => $validated['session_id'],
            'date' => now()->toDateString(),
        ])->first();

        if (!$attendance) {
            $attendance = Attendance::create([
                'user_id' => $validated['user_id'],
                'session_id' => $validated['session_id'],
                'date' => now()->toDateString(),
                'check_in_method' => 'manual',
            ]);
        }

        $attendance->entry_time = now();
        $attendance->save();

        return redirect()->back()->with('success', 'Entry recorded successfully.');
    }

    /**
     * Record exit for a user.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function recordExit(Attendance $attendance)
    {
        $attendance->exit_time = now();
        $attendance->save();

        return redirect()->back()->with('success', 'Exit recorded successfully.');
    }
    /**
 * Display attendance history for the logged-in member.
 *
 * @return \Illuminate\Http\Response
 */
public function memberAttendance()
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
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:Administrator']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = Attendance::with(['user', 'session'])
            ->orderBy('date', 'desc')
            ->paginate(15);
            
        return view('admin.attendances.index', compact('attendances'));
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
        return view('admin.attendances.create', compact('members', 'sessions'));
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

        return redirect()->route('admin.attendances.index')
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
        return view('admin.attendances.show', compact('attendance'));
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
        return view('admin.attendances.edit', compact('attendance', 'members', 'sessions'));
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

        return redirect()->route('admin.attendances.index')
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

        return redirect()->route('admin.attendances.index')
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
                'check_in_method' => 'manual-admin',
                'entry_time' => now()->format('H:i:s'),
            ]);
        } else {
            $attendance->entry_time = now()->format('H:i:s');
            $attendance->save();
        }

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
        $attendance->exit_time = now()->format('H:i:s');
        $attendance->save();

        return redirect()->back()->with('success', 'Exit recorded successfully.');
    }
    
    /**
     * Generate attendance report.
     * 
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        // Date range defaults to current month
        $startDate = request('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = request('end_date', Carbon::now()->format('Y-m-d'));
        
        $attendances = Attendance::with(['user', 'session'])
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->get();
            
        // Group by date
        $attendancesByDate = $attendances->groupBy(function($item) {
            return Carbon::parse($item->date)->format('Y-m-d');
        });
        
        // Calculate stats
        $totalAttendanceCount = $attendances->count();
        $uniqueMembersCount = $attendances->pluck('user_id')->unique()->count();
        $averageDuration = $attendances->whereNotNull('exit_time')->average(function($attendance) {
            $entry = Carbon::parse($attendance->entry_time);
            $exit = Carbon::parse($attendance->exit_time);
            return $entry->diffInMinutes($exit);
        }) ?? 0;
        
        // Most popular sessions
        $popularSessions = $attendances->groupBy('session_id')->map(function($group) {
            return [
                'session' => $group->first()->session,
                'count' => $group->count()
            ];
        })->sortByDesc('count')->take(5);
        
        return view('admin.attendances.report', compact(
            'attendancesByDate',
            'startDate',
            'endDate',
            'totalAttendanceCount',
            'uniqueMembersCount',
            'averageDuration',
            'popularSessions'
        ));
    }
}
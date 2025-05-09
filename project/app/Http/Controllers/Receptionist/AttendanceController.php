<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\GeneralAttendance;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->middleware(['auth', 'role:Receptionist']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Attendance::with(['user', 'session']);
        
        // Filter by date if provided
        if ($request->has('date')) {
            $query->where('date', $request->date);
        }
        
        // Filter by session if provided
        if ($request->has('session_id') && $request->session_id !== 'all') {
            $query->where('session_id', $request->session_id);
        }
        
        // Search by member name or email
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $attendances = $query->latest()->paginate(15);
        $sessions = Session::all();
        
        return view('receptionist.attendances.index', compact('attendances', 'sessions'));
    }

    /**
     * Display the daily attendance page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function daily(Request $request)
    {
        $date = $request->date ?? now()->toDateString();
        
        // Get all active members
        $query = User::where('role', 'Member')
                     ->where('status', 'Active');
        
        // Search by name or email
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $members = $query->orderBy('lastname')->paginate(20);
        
        // Get daily attendances for the selected date
        $attendances = GeneralAttendance::where('date', $date)
                                ->whereIn('user_id', $members->pluck('id'))
                                ->get()
                                ->keyBy('user_id');
        
        return view('receptionist.attendances.daily', compact('members', 'attendances'));
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
        return view('receptionist.attendances.create', compact('members', 'sessions'));
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

        return redirect()->route('receptionist.attendances.index')
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
        return view('receptionist.attendances.show', compact('attendance'));
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
        return view('receptionist.attendances.edit', compact('attendance', 'members', 'sessions'));
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

        return redirect()->route('receptionist.attendances.index')
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

        return redirect()->route('receptionist.attendances.index')
            ->with('success', 'Attendance deleted successfully.');
    }

    /**
     * Record entry for a user in a session.
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
                'check_in_method' => 'receptionist',
            ]);
        }

        $attendance->entry_time = now();
        $attendance->save();

        return redirect()->back()->with('success', 'Entry recorded successfully.');
    }

    /**
     * Record exit for a user in a session.
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
     * Record daily entry for a user (general attendance).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function recordDailyEntry(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'nullable|date',
        ]);

        // Use provided date or today
        $date = $validated['date'] ?? now()->toDateString();

        $attendance = GeneralAttendance::where([
            'user_id' => $validated['user_id'],
            'date' => $date,
        ])->first();

        if (!$attendance) {
            $attendance = GeneralAttendance::create([
                'user_id' => $validated['user_id'],
                'date' => $date,
                'check_in_method' => 'receptionist',
                'entry_time' => now(),
            ]);
        } else if (!$attendance->entry_time) {
            $attendance->entry_time = now();
            $attendance->save();
        }

        return redirect()->back()->with('success', 'Daily entry recorded successfully.');
    }

    /**
     * Record daily exit for a user (general attendance).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function recordDailyExit($id)
    {
        $attendance = GeneralAttendance::findOrFail($id);
        $attendance->exit_time = now();
        $attendance->save();

        return redirect()->back()->with('success', 'Daily exit recorded successfully.');
    }

    /**
     * Show form for creating a daily attendance record.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateDailyForm()
    {
        $members = User::where('role', 'Member')
                      ->where('status', 'Active')
                      ->orderBy('lastname')
                      ->get();
                      
        return view('receptionist.attendances.create-daily-attendance', compact('members'));
    }
    
    /**
     * Create a full daily attendance record with custom times.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createDailyAttendance(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'entry_time' => 'nullable|date_format:H:i',
            'exit_time' => 'nullable|date_format:H:i|after:entry_time',
            'check_in_method' => 'required|string|max:255',
        ]);

        // Check if record already exists
        $attendance = GeneralAttendance::where([
            'user_id' => $validated['user_id'],
            'date' => $validated['date'],
        ])->first();

        if ($attendance) {
            // Update existing record
            $attendance->update([
                'entry_time' => $validated['entry_time'] ? Carbon::parse($validated['date'] . ' ' . $validated['entry_time']) : null,
                'exit_time' => $validated['exit_time'] ? Carbon::parse($validated['date'] . ' ' . $validated['exit_time']) : null,
                'check_in_method' => $validated['check_in_method'],
            ]);
        } else {
            // Create new record
            GeneralAttendance::create([
                'user_id' => $validated['user_id'],
                'date' => $validated['date'],
                'entry_time' => $validated['entry_time'] ? Carbon::parse($validated['date'] . ' ' . $validated['entry_time']) : null,
                'exit_time' => $validated['exit_time'] ? Carbon::parse($validated['date'] . ' ' . $validated['exit_time']) : null,
                'check_in_method' => $validated['check_in_method'],
            ]);
        }

        return redirect()->route('receptionist.attendances.daily', ['date' => $validated['date']])
            ->with('success', 'Daily attendance record created successfully.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SessionController extends Controller
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
        // Filter by start and end date if provided
        $startDate = request('start_date');
        $endDate = request('end_date');
        $type = request('type');
        
        $query = Session::with('trainer');
        
        if ($startDate) {
            $query->where('date', '>=', $startDate);
        }
        
        if ($endDate) {
            $query->where('date', '<=', $endDate);
        }
        
        if ($type) {
            $query->where('type', $type);
        }
        
        $sessions = $query->orderBy('date', 'desc')
            ->orderBy('start_time', 'asc')
            ->paginate(15);
            
        return view('admin.sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainers = User::where('role', 'Trainer')->get();
        $sessionTypes = ['Cardio', 'Strength', 'HIIT', 'Yoga', 'Pilates', 'Cycling', 'Zumba', 'CrossFit'];
        $sessionLevels = ['Beginner', 'Intermediate', 'Advanced', 'All Levels'];
        
        return view('admin.sessions.create', compact('trainers', 'sessionTypes', 'sessionLevels'));
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'max_capacity' => 'required|integer|min:1',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'trainer_id' => 'required|exists:users,id',
            'location' => 'nullable|string|max:255',
            'equipment_needed' => 'nullable|string',
            'is_recurring' => 'nullable|boolean',
            'recurrence_pattern' => 'nullable|string|max:255',
            'recurrence_end_date' => 'nullable|date|after:date',
        ]);

        $session = Session::create($validated);

        // Handle recurring sessions if needed
        if (!empty($validated['is_recurring']) && !empty($validated['recurrence_pattern']) && !empty($validated['recurrence_end_date'])) {
            $this->createRecurringSessions($session, $validated);
        }

        return redirect()->route('admin.sessions.index')
            ->with('success', 'Session created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        $session->load('trainer', 'attendances.user');
        
        // Get attendees count
        $attendeesCount = $session->attendances->count();
        
        // Calculate capacity percentage
        $capacityPercentage = $session->max_capacity > 0 ? 
            round(($attendeesCount / $session->max_capacity) * 100) : 0;
            
        return view('admin.sessions.show', compact('session', 'attendeesCount', 'capacityPercentage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        $trainers = User::where('role', 'Trainer')->get();
        $sessionTypes = ['Cardio', 'Strength', 'HIIT', 'Yoga', 'Pilates', 'Cycling', 'Zumba', 'CrossFit'];
        $sessionLevels = ['Beginner', 'Intermediate', 'Advanced', 'All Levels'];
        
        return view('admin.sessions.edit', compact('session', 'trainers', 'sessionTypes', 'sessionLevels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'max_capacity' => 'required|integer|min:1',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'trainer_id' => 'required|exists:users,id',
            'location' => 'nullable|string|max:255',
            'equipment_needed' => 'nullable|string',
        ]);

        $session->update($validated);

        return redirect()->route('admin.sessions.index')
            ->with('success', 'Session updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        // Check if session has attendees
        if ($session->attendances()->count() > 0) {
            return redirect()->route('admin.sessions.index')
                ->with('error', 'Cannot delete session with attendees. Cancel the session instead.');
        }
        
        $session->delete();

        return redirect()->route('admin.sessions.index')
            ->with('success', 'Session deleted successfully.');
    }
    
    /**
     * Cancel a session without deleting it.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function cancel(Session $session)
    {
        $session->status = 'cancelled';
        $session->save();
        
        // Notify attendees (in a real app you'd send emails/notifications here)
        
        return redirect()->route('admin.sessions.index')
            ->with('success', 'Session cancelled successfully.');
    }
    
    /**
     * Show session attendance.
     *
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function attendance(Session $session)
    {
        $session->load('attendances.user');
        
        $attendances = $session->attendances;
        
        // Get members that are not yet in attendance for this session
        $attendeeIds = $attendances->pluck('user_id')->toArray();
        $availableMembers = User::where('role', 'Member')
            ->whereNotIn('id', $attendeeIds)
            ->get();
            
        return view('admin.sessions.attendance', compact('session', 'attendances', 'availableMembers'));
    }
    
    /**
     * Add a member to a session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function addMember(Request $request, Session $session)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);
        
        // Check if member is already added
        $exists = Attendance::where([
            'session_id' => $session->id,
            'user_id' => $validated['user_id'],
        ])->exists();
        
        if ($exists) {
            return redirect()->back()
                ->with('error', 'Member is already added to this session.');
        }
        
        // Check if session is full
        if ($session->attendances()->count() >= $session->max_capacity) {
            return redirect()->back()
                ->with('error', 'Session is already at full capacity.');
        }
        
        // Create attendance record
        Attendance::create([
            'session_id' => $session->id,
            'user_id' => $validated['user_id'],
            'date' => $session->date,
            'check_in_method' => 'admin-added',
        ]);
        
        return redirect()->back()
            ->with('success', 'Member added to session successfully.');
    }
    
    /**
     * Remove a member from a session.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function removeMember(Attendance $attendance)
    {
        $session = $attendance->session;
        $attendance->delete();
        
        return redirect()->route('admin.sessions.attendance', $session)
            ->with('success', 'Member removed from session successfully.');
    }
    
    /**
     * Create recurring sessions based on pattern.
     *
     * @param  \App\Models\Session  $sourceSession
     * @param  array  $data
     * @return void
     */
    private function createRecurringSessions($sourceSession, $data)
    {
        $pattern = $data['recurrence_pattern']; // 'daily', 'weekly', etc.
        $endDate = Carbon::parse($data['recurrence_end_date']);
        $currentDate = Carbon::parse($data['date']);
        
        // Clone the base data without date
        $sessionData = $sourceSession->toArray();
        unset($sessionData['id']);
        unset($sessionData['created_at']);
        unset($sessionData['updated_at']);
        
        switch ($pattern) {
            case 'daily':
                $interval = 1; // days
                $unit = 'days';
                break;
            case 'weekly':
                $interval = 1; // weeks
                $unit = 'weeks';
                break;
            case 'biweekly':
                $interval = 2; // weeks
                $unit = 'weeks';
                break;
            default:
                return; // Invalid pattern
        }
        
        // Create recurring sessions
        $currentDate = $currentDate->copy()->add($interval, $unit); // Start with next occurrence
        
        while ($currentDate->lte($endDate)) {
            $sessionData['date'] = $currentDate->format('Y-m-d');
            
            // Create the session
            Session::create($sessionData);
            
            // Move to next occurrence
            $currentDate = $currentDate->copy()->add($interval, $unit);
        }
    }
}
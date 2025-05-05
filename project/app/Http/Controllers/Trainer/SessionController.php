<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Session;
use Carbon\Carbon;
use App\Models\TrainerAvailability;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    /**
     * Display a listing of the sessions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trainer = Auth::user();
        
        $query = Session::where('trainer_id', $trainer->id);
        
        // Filter by date if provided
        if ($request->has('date')) {
            $query->where('date', $request->date);
        }
        
        // Filter by session type if provided
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }
        
        // Filter by city if provided
        if ($request->has('city') && $request->city !== 'all') {
            $query->where('city', $request->city);
        }
        
        // Default sorting by date and time
        $query->orderBy('date', 'desc')->orderBy('start_time');
        
        $sessions = $query->withCount('attendances as registered_members')
            ->paginate(10);
            
        // Get session types for filter dropdown
        $sessionTypes = Session::where('trainer_id', $trainer->id)
            ->select('type')
            ->distinct()
            ->pluck('type');
            
        // Get cities for filter dropdown
        $cities = Session::where('trainer_id', $trainer->id)
            ->select('city')
            ->distinct()
            ->whereNotNull('city')
            ->pluck('city');
            
        // Get trainer's availabilities for the calendar
        $availabilities = TrainerAvailability::where('trainer_id', $trainer->id)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();
        
        // Get sessions for the current week for the calendar
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        
        $thisWeekSessions = Session::where('trainer_id', $trainer->id)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->get()
            ->groupBy(function($session) {
                return Carbon::parse($session->date)->format('Y-m-d');
            });
            
        return view('trainer.sessions.index', compact(
            'sessions', 
            'sessionTypes',
            'cities', 
            'availabilities',
            'thisWeekSessions'
        ));
    }
    /**
     * Show the form for creating a new session.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainer.sessions.create');
    }

    /**
     * Store a newly created session in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'level' => 'required|string|in:Beginner,Intermediate,Advanced',
            'max_capacity' => 'required|integer|min:1',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'city' => 'required|string|max:255', // Added city validation
        ]);
        
        $session = new Session();
        $session->title = $request->title;
        $session->description = $request->description;
        $session->type = $request->type;
        $session->level = $request->level;
        $session->max_capacity = $request->max_capacity;
        $session->date = $request->date;
        $session->start_time = $request->start_time;
        $session->end_time = $request->end_time;
        $session->trainer_id = Auth::id();
        $session->city = $request->city; // Add city
        $session->save();
        
        return redirect()->route('trainer.sessions.index')
            ->with('success', 'Session created successfully!');
    }

    /**
     * Display the specified session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $session = Session::findOrFail($id);
        
        // Verify this session belongs to the trainer
        if ($session->trainer_id !== Auth::id()) {
            return redirect()->route('trainer.sessions.index')
                ->with('error', 'You are not authorized to view this session');
        }
        
        // Get attendance count
        $attendanceCount = $session->attendances()->count();
        
        // Get members who have registered for this session
        $members = $session->attendances()->with('user')->get();
        
        // Calculate available spots
        $availableSpots = $session->max_capacity - $attendanceCount;
        
        return view('trainer.sessions.show', compact('session', 'attendanceCount', 'members', 'availableSpots'));
    }

    /**
     * Show the form for editing the specified session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $session = Session::findOrFail($id);
        
        // Verify this session belongs to the trainer
        if ($session->trainer_id !== Auth::id()) {
            return redirect()->route('trainer.sessions.index')
                ->with('error', 'You are not authorized to edit this session');
        }
        
        return view('trainer.sessions.edit', compact('session'));
    }

    /**
     * Update the specified session in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $session = Session::findOrFail($id);
        
        // Verify this session belongs to the trainer
        if ($session->trainer_id !== Auth::id()) {
            return redirect()->route('trainer.sessions.index')
                ->with('error', 'You are not authorized to update this session');
        }
        
        // Check if session is in the past
        if (Carbon::parse($session->date)->isPast()) {
            return redirect()->route('trainer.sessions.index')
                ->with('error', 'Past sessions cannot be modified');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:255',
            'level' => 'required|string|in:Beginner,Intermediate,Advanced',
            'max_capacity' => 'required|integer|min:' . $session->attendances()->count(),
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'city' => 'required|string|max:255', // Added city validation
        ]);
        
        $session->title = $request->title;
        $session->description = $request->description;
        $session->type = $request->type;
        $session->level = $request->level;
        $session->max_capacity = $request->max_capacity;
        $session->date = $request->date;
        $session->start_time = $request->start_time;
        $session->end_time = $request->end_time;
        $session->city = $request->city; // Update city
        $session->save();
        
        return redirect()->route('trainer.sessions.index')
            ->with('success', 'Session updated successfully!');
    }

    /**
     * Remove the specified session from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $session = Session::findOrFail($id);
        
        // Verify this session belongs to the trainer
        if ($session->trainer_id !== Auth::id()) {
            return redirect()->route('trainer.sessions.index')
                ->with('error', 'You are not authorized to delete this session');
        }
        
        // Check if session is in the past
        if (Carbon::parse($session->date)->isPast()) {
            return redirect()->route('trainer.sessions.index')
                ->with('error', 'Past sessions cannot be deleted');
        }
        
        // Check if anyone has registered for this session
        if ($session->attendances()->count() > 0) {
            return redirect()->route('trainer.sessions.index')
                ->with('error', 'Cannot delete a session that has registered members');
        }
        
        $session->delete();
        
        return redirect()->route('trainer.sessions.index')
            ->with('success', 'Session deleted successfully!');
    }
}
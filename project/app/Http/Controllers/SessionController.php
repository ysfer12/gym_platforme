<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::with('trainer')->get();
        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainers = User::where('role', 'Trainer')->get();
        return view('sessions.create', compact('trainers'));
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
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'trainer_id' => 'required|exists:users,id',
        ]);

        Session::create($validated);

        return redirect()->route('sessions.index')
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
        return view('sessions.show', compact('session'));
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
        return view('sessions.edit', compact('session', 'trainers'));
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
        ]);

        $session->update($validated);

        return redirect()->route('sessions.index')
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
        $session->delete();

        return redirect()->route('sessions.index')
            ->with('success', 'Session deleted successfully.');
    }

   /**
 * Book a session for the logged-in member.
 *
 * @param  \App\Models\Session  $session
 * @return \Illuminate\Http\Response
 */
public function book(Session $session)
{
    $user = Auth::user();
    
    // Check if user already booked this session
    if ($session->attendances()->where('user_id', $user->id)->exists()) {
        return redirect()->back()->with('error', 'You have already booked this session.');
    }
    
    // Check if session is full
    if ($session->attendances()->count() >= $session->max_capacity) {
        return redirect()->back()->with('error', 'This session is already at full capacity.');
    }
    
    // Check if user has an active subscription
    $hasActiveSubscription = Subscription::where('user_id', $user->id)
        ->where('end_date', '>=', Carbon::today())
        ->where('status', 'active')
        ->exists();
        
    if (!$hasActiveSubscription) {
        return redirect()->route('member.subscription')
            ->with('error', 'You need an active subscription to book sessions.');
    }
    
    // Create attendance record
    $session->attendances()->create([
        'user_id' => $user->id,
        'date' => $session->date,
        'check_in_method' => 'online',
    ]);
    
    return redirect()->back()->with('success', 'Session booked successfully!');
}
    /**
 * Display sessions available for members to book.
 *
 * @return \Illuminate\Http\Response
 */
public function memberSessions()
 {
    $upcomingSessions = Session::where('date', '>=', Carbon::today())
        ->orderBy('date')
        ->orderBy('start_time')
        ->paginate(10);
        
    // Get current user's booked sessions
    $user = Auth::user();
    $bookedSessionIds = $user->attendances()
        ->pluck('session_id')
        ->toArray();
        
    return view('member.sessions', compact('upcomingSessions', 'bookedSessionIds'));
 }

}
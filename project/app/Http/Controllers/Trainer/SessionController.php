<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\SessionServiceInterface;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * @var SessionServiceInterface
     */
    protected $sessionService;

    /**
     * SessionController constructor.
     *
     * @param SessionServiceInterface $sessionService
     */
    public function __construct(SessionServiceInterface $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    /**
     * Display a listing of the sessions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trainer = Auth::user();
        
        try {
            // Get filters from request
            $filters = [
                'date' => $request->date,
                'type' => $request->type,
                'city' => $request->city
            ];
            
            // Get sessions and related data
            $data = $this->sessionService->getFilteredSessions($trainer->id, $filters);
            
            return view('trainer.sessions.index', $data);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
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
        // Validate the request
        $validated = $request->validate([
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
        
        try {
            // Create the session
            $this->sessionService->createSession($validated, Auth::id());
            
            return redirect()->route('trainer.sessions.index')
                ->with('success', 'Session created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // Get session details
            $data = $this->sessionService->getSessionDetails($id, Auth::id());
            
            return view('trainer.sessions.show', $data);
        } catch (\Exception $e) {
            return redirect()->route('trainer.sessions.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            // Get session details
            $data = $this->sessionService->getSessionDetails($id, Auth::id());
            
            // Extract session from data
            $session = $data['session'];
            
            return view('trainer.sessions.edit', compact('session'));
        } catch (\Exception $e) {
            return redirect()->route('trainer.sessions.index')
                ->with('error', $e->getMessage());
        }
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
        try {
            // Get session details for validation
            $data = $this->sessionService->getSessionDetails($id, Auth::id());
            $attendanceCount = $data['attendanceCount'];
            
            // Validate the request
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'type' => 'required|string|max:255',
                'level' => 'required|string|in:Beginner,Intermediate,Advanced',
                'max_capacity' => 'required|integer|min:' . $attendanceCount,
                'date' => 'required|date',
                'start_time' => 'required',
                'end_time' => 'required|after:start_time',
                'city' => 'required|string|max:255', // Added city validation
            ]);
            
            // Update the session
            $this->sessionService->updateSession($id, $validated, Auth::id());
            
            return redirect()->route('trainer.sessions.index')
                ->with('success', 'Session updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            // Delete the session
            $this->sessionService->deleteSession($id, Auth::id());
            
            return redirect()->route('trainer.sessions.index')
                ->with('success', 'Session deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('trainer.sessions.index')
                ->with('error', $e->getMessage());
        }
    }
}
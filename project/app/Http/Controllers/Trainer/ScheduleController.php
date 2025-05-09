<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\ScheduleServiceInterface;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * @var ScheduleServiceInterface
     */
    protected $scheduleService;

    /**
     * ScheduleController constructor.
     *
     * @param ScheduleServiceInterface $scheduleService
     */
    public function __construct(ScheduleServiceInterface $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }

    /**
     * Display the trainer's availability schedule.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainer = Auth::user();
        
        $result = $this->scheduleService->getTrainerAvailabilities($trainer->id);
        
        if (!$result['success']) {
            return back()->with('error', $result['message']);
        }
        
        return view('trainer.schedule.index', ['availabilities' => $result['availabilities']]);
    }

    /**
     * Show the form for creating a new availability slot.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainer.schedule.create');
    }

    /**
     * Store a newly created availability slot in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'day_of_week' => 'required|integer|between:0,6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_available' => 'boolean',
        ]);
        
        // Set is_available to true if checkbox is checked, false otherwise
        $validated['is_available'] = $request->has('is_available');
        
        try {
            $this->scheduleService->createAvailability($validated, Auth::id());
            
            return redirect()->route('trainer.schedule.index')
                ->with('success', 'Availability added successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified availability slot.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $result = $this->scheduleService->getTrainerAvailabilities(Auth::id());
            
            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }
            
            // Find the specific availability from the result
            $availability = null;
            foreach ($result['availabilities'] as $avail) {
                if ($avail->id == $id) {
                    $availability = $avail;
                    break;
                }
            }
            
            if (!$availability) {
                return redirect()->route('trainer.schedule.index')
                    ->with('error', 'Availability not found');
            }
            
            return view('trainer.schedule.edit', compact('availability'));
        } catch (\Exception $e) {
            return redirect()->route('trainer.schedule.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified availability slot in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'day_of_week' => 'required|integer|between:0,6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_available' => 'boolean',
        ]);
        
        // Set is_available to true if checkbox is checked, false otherwise
        $validated['is_available'] = $request->has('is_available');
        
        try {
            $this->scheduleService->updateAvailability($id, $validated, Auth::id());
            
            return redirect()->route('trainer.schedule.index')
                ->with('success', 'Availability updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified availability slot from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->scheduleService->deleteAvailability($id, Auth::id());
            
            return redirect()->route('trainer.schedule.index')
                ->with('success', 'Availability deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('trainer.schedule.index')
                ->with('error', $e->getMessage());
        }
    }
    
    /**
     * Display the weekly calendar view of the trainer's schedule.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendar()
    {
        $trainer = Auth::user();
        
        $result = $this->scheduleService->getCalendarData($trainer->id);
        
        if (!$result['success']) {
            return back()->with('error', $result['message']);
        }
        
        return view('trainer.schedule.calendar', [
            'weeks' => $result['weeks'],
            'availabilities' => $result['availabilities']
        ]);
    }
}
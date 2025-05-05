<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainerAvailability;
use App\Models\Session;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display the trainer's availability schedule.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainer = Auth::user();
        $availabilities = TrainerAvailability::where('trainer_id', $trainer->id)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();
            
        return view('trainer.schedule.index', compact('availabilities'));
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
        $request->validate([
            'day_of_week' => 'required|integer|between:0,6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_available' => 'boolean',
        ]);
        
        // Convert time strings to Carbon objects for comparison
        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);
        
        // Check if the new availability overlaps with any existing ones
        $existingAvailabilities = TrainerAvailability::where('trainer_id', Auth::id())
            ->where('day_of_week', $request->day_of_week)
            ->get();
        
        foreach ($existingAvailabilities as $existing) {
            $existingStart = Carbon::parse($existing->start_time);
            $existingEnd = Carbon::parse($existing->end_time);
            
            if ($startTime < $existingEnd && $endTime > $existingStart) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'This time slot overlaps with an existing availability slot.');
            }
        }
        
        // Create the new availability slot
        TrainerAvailability::create([
            'trainer_id' => Auth::id(),
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_available' => $request->has('is_available'),
        ]);
        
        return redirect()->route('trainer.schedule.index')
            ->with('success', 'Availability added successfully');
    }

    /**
     * Show the form for editing the specified availability slot.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $availability = TrainerAvailability::findOrFail($id);
        
        // Verify this availability belongs to the trainer
        if ($availability->trainer_id !== Auth::id()) {
            return redirect()->route('trainer.schedule.index')
                ->with('error', 'You are not authorized to edit this availability');
        }
        
        return view('trainer.schedule.edit', compact('availability'));
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
        $availability = TrainerAvailability::findOrFail($id);
        
        // Verify this availability belongs to the trainer
        if ($availability->trainer_id !== Auth::id()) {
            return redirect()->route('trainer.schedule.index')
                ->with('error', 'You are not authorized to update this availability');
        }
        
        $request->validate([
            'day_of_week' => 'required|integer|between:0,6',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'is_available' => 'boolean',
        ]);
        
        // Convert time strings to Carbon objects for comparison
        $startTime = Carbon::parse($request->start_time);
        $endTime = Carbon::parse($request->end_time);
        
        // Check if the updated availability overlaps with any existing ones
        $existingAvailabilities = TrainerAvailability::where('trainer_id', Auth::id())
            ->where('day_of_week', $request->day_of_week)
            ->where('id', '!=', $id) // Exclude current availability
            ->get();
        
        foreach ($existingAvailabilities as $existing) {
            $existingStart = Carbon::parse($existing->start_time);
            $existingEnd = Carbon::parse($existing->end_time);
            
            if ($startTime < $existingEnd && $endTime > $existingStart) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'This time slot overlaps with an existing availability slot.');
            }
        }
        
        // Check if there are any sessions scheduled during this time slot
        // Get the day of week from the availability
        $dayOfWeek = $request->day_of_week;
        
        // Get sessions for this trainer on this day of week
        $sessions = Session::where('trainer_id', Auth::id())
            ->where(DB::raw('DAYOFWEEK(date)'), '=', $dayOfWeek + 1) // MySQL's DAYOFWEEK starts from 1 (Sunday)
            ->where('date', '>=', now()->format('Y-m-d')) // Only check future sessions
            ->get();
        
        foreach ($sessions as $session) {
            $sessionStart = Carbon::parse($session->start_time);
            $sessionEnd = Carbon::parse($session->end_time);
            
            if ($startTime <= $sessionEnd && $endTime >= $sessionStart) {
                // If the trainer is marking themselves as unavailable, warn about existing sessions
                if (!$request->has('is_available')) {
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'You have sessions scheduled during this time slot. Please reschedule them before marking yourself as unavailable.');
                }
            }
        }
        
        // Update the availability
        $availability->update([
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_available' => $request->has('is_available'),
        ]);
        
        return redirect()->route('trainer.schedule.index')
            ->with('success', 'Availability updated successfully');
    }

    /**
     * Remove the specified availability slot from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $availability = TrainerAvailability::findOrFail($id);
        
        // Verify this availability belongs to the trainer
        if ($availability->trainer_id !== Auth::id()) {
            return redirect()->route('trainer.schedule.index')
                ->with('error', 'You are not authorized to delete this availability');
        }
        
        // Check if there are any sessions scheduled during this time slot
        $dayOfWeek = $availability->day_of_week;
        
        // Get sessions for this trainer on this day of week
        $sessions = Session::where('trainer_id', Auth::id())
            ->where(DB::raw('DAYOFWEEK(date)'), '=', $dayOfWeek + 1)
            ->where('date', '>=', now()->format('Y-m-d')) // Only check future sessions
            ->get();
        
        foreach ($sessions as $session) {
            $sessionStart = Carbon::parse($session->start_time);
            $sessionEnd = Carbon::parse($session->end_time);
            
            $availabilityStart = Carbon::parse($availability->start_time);
            $availabilityEnd = Carbon::parse($availability->end_time);
            
            if ($availabilityStart <= $sessionEnd && $availabilityEnd >= $sessionStart) {
                return redirect()->route('trainer.schedule.index')
                    ->with('error', 'You have sessions scheduled during this time slot. Please reschedule them before deleting this availability.');
            }
        }
        
        $availability->delete();
        
        return redirect()->route('trainer.schedule.index')
            ->with('success', 'Availability deleted successfully');
    }
    
    /**
     * Display the weekly calendar view of the trainer's schedule.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendar()
    {
        $trainer = Auth::user();
        
        // Get all availabilities
        $availabilities = TrainerAvailability::where('trainer_id', $trainer->id)
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get();
        
        // Get upcoming sessions for the next 4 weeks
        $startDate = now()->startOfWeek();
        $endDate = now()->addWeeks(4)->endOfWeek();
        
        $sessions = Session::where('trainer_id', $trainer->id)
            ->whereBetween('date', [$startDate, $endDate])
            ->with('attendances')
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();
        
        // Group sessions by date for easier rendering
        $sessionsByDate = [];
        foreach ($sessions as $session) {
            $date = $session->date->format('Y-m-d');
            if (!isset($sessionsByDate[$date])) {
                $sessionsByDate[$date] = [];
            }
            $sessionsByDate[$date][] = $session;
        }
        
        // Generate calendar weeks
        $weeks = [];
        $currentDate = $startDate->copy();
        
        while ($currentDate <= $endDate) {
            $week = [];
            for ($i = 0; $i < 7; $i++) {
                $week[] = [
                    'date' => $currentDate->copy(),
                    'sessions' => $sessionsByDate[$currentDate->format('Y-m-d')] ?? [],
                    'isAvailable' => $this->isDayAvailable($availabilities, $currentDate->dayOfWeek),
                ];
                $currentDate->addDay();
            }
            $weeks[] = $week;
        }
        
        return view('trainer.schedule.calendar', compact('weeks', 'availabilities'));
    }
    
    /**
     * Check if a specific day has any availability slots.
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $availabilities
     * @param  int  $dayOfWeek
     * @return bool
     */
    private function isDayAvailable($availabilities, $dayOfWeek)
    {
        foreach ($availabilities as $availability) {
            if ($availability->day_of_week == $dayOfWeek && $availability->is_available) {
                return true;
            }
        }
        return false;
    }
}
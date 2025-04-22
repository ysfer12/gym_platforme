<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainerAvailability;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        
        $availability->delete();
        
        return redirect()->route('trainer.schedule.index')
            ->with('success', 'Availability deleted successfully');
    }
}
<!-- resources/views/trainer/schedule/edit.blade.php -->
@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-900">
    <div class="flex h-screen overflow-hidden">
        <!-- Include the trainer sidebar -->
        @include('partials.trainer-sidebar')
        
        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <!-- Page header -->
            <div class="bg-gray-800 shadow-md border-b border-gray-700">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-semibold text-white">Edit Availability Slot</h1>
                        <a href="{{ route('trainer.schedule.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Schedule
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Page content -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="bg-gray-800 shadow-md overflow-hidden sm:rounded-lg border border-gray-700">
                    <div class="px-4 py-5 sm:p-6">
                        <form action="{{ route('trainer.schedule.update', $availability->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <!-- Day of Week -->
                            <div class="mb-4">
                                <label for="day_of_week" class="block text-sm font-medium text-gray-300">Day of Week</label>
                                <select id="day_of_week" name="day_of_week" required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm bg-gray-700 border-gray-600 text-white rounded-md">
                                    <option value="0" {{ $availability->day_of_week == 0 ? 'selected' : '' }}>Sunday</option>
                                    <option value="1" {{ $availability->day_of_week == 1 ? 'selected' : '' }}>Monday</option>
                                    <option value="2" {{ $availability->day_of_week == 2 ? 'selected' : '' }}>Tuesday</option>
                                    <option value="3" {{ $availability->day_of_week == 3 ? 'selected' : '' }}>Wednesday</option>
                                    <option value="4" {{ $availability->day_of_week == 4 ? 'selected' : '' }}>Thursday</option>
                                    <option value="5" {{ $availability->day_of_week == 5 ? 'selected' : '' }}>Friday</option>
                                    <option value="6" {{ $availability->day_of_week == 6 ? 'selected' : '' }}>Saturday</option>
                                </select>
                                @error('day_of_week')
                                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Time Range -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="start_time" class="block text-sm font-medium text-gray-300">Start Time</label>
                                    <input type="time" id="start_time" name="start_time" 
                                           value="{{ \Carbon\Carbon::parse($availability->start_time)->format('H:i') }}" required 
                                           class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm bg-gray-700 border-gray-600 text-white rounded-md">
                                    @error('start_time')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="end_time" class="block text-sm font-medium text-gray-300">End Time</label>
                                    <input type="time" id="end_time" name="end_time" 
                                           value="{{ \Carbon\Carbon::parse($availability->end_time)->format('H:i') }}" required 
                                           class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm bg-gray-700 border-gray-600 text-white rounded-md">
                                    @error('end_time')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Availability Status -->
                            <div class="flex items-start mb-6">
                                <div class="flex items-center h-5">
                                    <input id="is_available" name="is_available" type="checkbox" value="1" {{ $availability->is_available ? 'checked' : '' }}
                                           class="focus:ring-orange-500 h-4 w-4 text-orange-600 bg-gray-700 border-gray-600 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="is_available" class="font-medium text-gray-300">Available</label>
                                    <p class="text-gray-400">Check this box if you are available during this time slot. Uncheck if you want to mark yourself as unavailable.</p>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                    Update Availability
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
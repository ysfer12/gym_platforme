<!-- resources/views/trainer/sessions/edit.blade.php -->
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
                        <h1 class="text-2xl font-semibold text-white">Edit Session</h1>
                        <a href="{{ route('trainer.sessions.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Sessions
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Page content -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="bg-gray-800 shadow-md overflow-hidden sm:rounded-lg border border-gray-700">
                    <div class="px-4 py-5 sm:p-6">
                        <form action="{{ route('trainer.sessions.update', $session->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <!-- Session Title -->
                                <div class="sm:col-span-2">
                                    <label for="title" class="block text-sm font-medium text-gray-300">Session Title</label>
                                    <input type="text" name="title" id="title" value="{{ old('title', $session->title) }}" required 
                                           class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm bg-gray-700 border-gray-600 text-white rounded-md placeholder-gray-400">
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Session Description -->
                                <div class="sm:col-span-2">
                                    <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                                    <textarea name="description" id="description" rows="3" 
                                              class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm bg-gray-700 border-gray-600 text-white rounded-md placeholder-gray-400">{{ old('description', $session->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Session Type -->
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-300">Session Type</label>
                                    <input type="text" name="type" id="type" value="{{ old('type', $session->type) }}" required 
                                           class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm bg-gray-700 border-gray-600 text-white rounded-md placeholder-gray-400"
                                           placeholder="e.g. Cardio, Strength, Yoga">
                                    @error('type')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Session Level -->
                                <div>
                                    <label for="level" class="block text-sm font-medium text-gray-300">Level</label>
                                    <select id="level" name="level" required 
                                            class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm bg-gray-700 border-gray-600 text-white rounded-md">
                                        <option value="Beginner" {{ (old('level', $session->level) == 'Beginner') ? 'selected' : '' }}>Beginner</option>
                                        <option value="Intermediate" {{ (old('level', $session->level) == 'Intermediate') ? 'selected' : '' }}>Intermediate</option>
                                        <option value="Advanced" {{ (old('level', $session->level) == 'Advanced') ? 'selected' : '' }}>Advanced</option>
                                    </select>
                                    @error('level')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- City - New field -->
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-300">City</label>
                                    <input type="text" name="city" id="city" value="{{ old('city', $session->city) }}" required 
                                           class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm bg-gray-700 border-gray-600 text-white rounded-md placeholder-gray-400"
                                           placeholder="e.g. New York, Los Angeles">
                                    @error('city')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Max Capacity - Only increase is allowed if members are registered -->
                                <div>
                                    <label for="max_capacity" class="block text-sm font-medium text-gray-300">Maximum Capacity</label>
                                    <input type="number" min="{{ $session->attendances->count() }}" max="100" name="max_capacity" id="max_capacity" 
                                           value="{{ old('max_capacity', $session->max_capacity) }}" required 
                                           class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm bg-gray-700 border-gray-600 text-white rounded-md">
                                    @if($session->attendances->count() > 0)
                                        <p class="mt-1 text-xs text-gray-400">
                                            Minimum value is {{ $session->attendances->count() }} (current registrations)
                                        </p>
                                    @endif
                                    @error('max_capacity')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Session Date -->
                                <div>
                                    <label for="date" class="block text-sm font-medium text-gray-300">Date</label>
                                    <input type="date" name="date" id="date" 
                                           value="{{ old('date', $session->date ? \Carbon\Carbon::parse($session->date)->format('Y-m-d') : '') }}" 
                                           required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm bg-gray-700 border-gray-600 text-white rounded-md">
                                    @error('date')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Session Time -->
                                <div>
                                    <label for="start_time" class="block text-sm font-medium text-gray-300">Start Time</label>
                                    <input type="time" name="start_time" id="start_time" 
                                           value="{{ old('start_time', $session->start_time ? \Carbon\Carbon::parse($session->start_time)->format('H:i') : '') }}" 
                                           required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm bg-gray-700 border-gray-600 text-white rounded-md">
                                    @error('start_time')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="end_time" class="block text-sm font-medium text-gray-300">End Time</label>
                                    <input type="time" name="end_time" id="end_time" 
                                           value="{{ old('end_time', $session->end_time ? \Carbon\Carbon::parse($session->end_time)->format('H:i') : '') }}" 
                                           required class="mt-1 focus:ring-orange-500 focus:border-orange-500 block w-full shadow-sm sm:text-sm bg-gray-700 border-gray-600 text-white rounded-md">
                                    @error('end_time')
                                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mt-6 flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                    Update Session
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
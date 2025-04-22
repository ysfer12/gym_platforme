@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Include the admin sidebar -->
        @include('partials.admin-sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Page Header -->
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <h1 class="text-3xl font-bold">Edit Attendance</h1>
                        <a href="{{ route('admin.attendances.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-800 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Attendances
                        </a>
                    </div>
                </div>
            </div>

            <!-- Edit Attendance Form -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <form action="{{ route('admin.attendances.update', $attendance) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Member Selection -->
                        <div class="mb-6">
                            <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Member</label>
                            <select id="user_id" name="user_id" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Select Member</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" {{ old('user_id', $attendance->user_id) == $member->id ? 'selected' : '' }}>
                                        {{ $member->firstname }} {{ $member->lastname }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Session Selection -->
                        <div class="mb-6">
                            <label for="session_id" class="block text-sm font-medium text-gray-700 mb-1">Session</label>
                            <select id="session_id" name="session_id" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Select Session</option>
                                @foreach($sessions as $session)
                                    <option value="{{ $session->id }}" {{ old('session_id', $attendance->session_id) == $session->id ? 'selected' : '' }}>
                                        {{ $session->title }} ({{ \Carbon\Carbon::parse($session->date)->format('M d, Y') }} {{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($session->end_time)->format('g:i A') }})
                                    </option>
                                @endforeach
                            </select>
                            @error('session_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Date Selection -->
                        <div class="mb-6">
                            <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input type="date" id="date" name="date" value="{{ old('date', $attendance->date->format('Y-m-d')) }}" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Times -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="entry_time" class="block text-sm font-medium text-gray-700 mb-1">Entry Time</label>
                                <input type="time" id="entry_time" name="entry_time" 
                                    value="{{ old('entry_time', $attendance->entry_time ? \Carbon\Carbon::parse($attendance->entry_time)->format('H:i') : '') }}" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @error('entry_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="exit_time" class="block text-sm font-medium text-gray-700 mb-1">Exit Time</label>
                                <input type="time" id="exit_time" name="exit_time" 
                                    value="{{ old('exit_time', $attendance->exit_time ? \Carbon\Carbon::parse($attendance->exit_time)->format('H:i') : '') }}" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <p class="mt-1 text-xs text-gray-500">Leave blank if not exited yet.</p>
                                @error('exit_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Check-in Method -->
                        <div class="mb-6">
                            <label for="check_in_method" class="block text-sm font-medium text-gray-700 mb-1">Check-in Method</label>
                            <select id="check_in_method" name="check_in_method" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="manual-admin" {{ old('check_in_method', $attendance->check_in_method) == 'manual-admin' ? 'selected' : '' }}>Manual (Admin)</option>
                                <option value="manual-receptionist" {{ old('check_in_method', $attendance->check_in_method) == 'manual-receptionist' ? 'selected' : '' }}>Manual (Receptionist)</option>
                                <option value="manual-trainer" {{ old('check_in_method', $attendance->check_in_method) == 'manual-trainer' ? 'selected' : '' }}>Manual (Trainer)</option>
                                <option value="member-app" {{ old('check_in_method', $attendance->check_in_method) == 'member-app' ? 'selected' : '' }}>Member App</option>
                                <option value="qr-code" {{ old('check_in_method', $attendance->check_in_method) == 'qr-code' ? 'selected' : '' }}>QR Code</option>
                                <option value="key-card" {{ old('check_in_method', $attendance->check_in_method) == 'key-card' ? 'selected' : '' }}>Key Card</option>
                            </select>
                            @error('check_in_method')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.attendances.show', $attendance) }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update Attendance
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        @include('partials.admin-mobile-menu')
    </div>
</div>
@endsection
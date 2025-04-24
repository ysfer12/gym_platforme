@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('partials.receptionist-sidebar')
        
        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-semibold text-gray-900">Edit Attendance</h1>
                        <div class="flex space-x-2">
                            <a href="{{ route('receptionist.attendances.show', $attendance->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
                            </a>
                            <a href="{{ route('receptionist.attendances.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back
                            </a>
                        </div>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <form action="{{ route('receptionist.attendances.update', $attendance->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <!-- Member Selection -->
                                    <div class="sm:col-span-2">
                                        <label for="user_id" class="block text-sm font-medium text-gray-700">Member</label>
                                        <select id="user_id" name="user_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="">Select a member</option>
                                            @foreach($members as $member)
                                                <option value="{{ $member->id }}" {{ (old('user_id') ?? $attendance->user_id) == $member->id ? 'selected' : '' }}>
                                                    {{ $member->firstname }} {{ $member->lastname }} ({{ $member->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Session Selection -->
                                    <div class="sm:col-span-2">
                                        <label for="session_id" class="block text-sm font-medium text-gray-700">Session</label>
                                        <select id="session_id" name="session_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="">Select a session</option>
                                            @foreach($sessions as $session)
                                                <option value="{{ $session->id }}" {{ (old('session_id') ?? $attendance->session_id) == $session->id ? 'selected' : '' }}>
                                                    {{ $session->title }} - {{ \Carbon\Carbon::parse($session->date)->format('M d, Y') }} ({{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('session_id')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Date -->
                                    <div>
                                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                        <input type="date" name="date" id="date" value="{{ old('date') ?? $attendance->date }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('date')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Entry Time -->
                                    <div>
                                        <label for="entry_time" class="block text-sm font-medium text-gray-700">Entry Time</label>
                                        <input type="time" name="entry_time" id="entry_time" value="{{ old('entry_time') ?? ($attendance->entry_time ? \Carbon\Carbon::parse($attendance->entry_time)->format('H:i') : '') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('entry_time')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Exit Time -->
                                    <div>
                                        <label for="exit_time" class="block text-sm font-medium text-gray-700">Exit Time</label>
                                        <input type="time" name="exit_time" id="exit_time" value="{{ old('exit_time') ?? ($attendance->exit_time ? \Carbon\Carbon::parse($attendance->exit_time)->format('H:i') : '') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('exit_time')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Check-in Method -->
                                    <div>
                                        <label for="check_in_method" class="block text-sm font-medium text-gray-700">Check-in Method</label>
                                        <select id="check_in_method" name="check_in_method" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="receptionist" {{ (old('check_in_method') ?? $attendance->check_in_method) == 'receptionist' ? 'selected' : '' }}>Receptionist</option>
                                            <option value="self" {{ (old('check_in_method') ?? $attendance->check_in_method) == 'self' ? 'selected' : '' }}>Self Check-in</option>
                                            <option value="trainer" {{ (old('check_in_method') ?? $attendance->check_in_method) == 'trainer' ? 'selected' : '' }}>Trainer</option>
                                            <option value="system" {{ (old('check_in_method') ?? $attendance->check_in_method) == 'system' ? 'selected' : '' }}>System</option>
                                        </select>
                                        @error('check_in_method')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 flex justify-between">
                                <div>
                                    <form id="delete-form" action="{{ route('receptionist.attendances.destroy', $attendance->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete()" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Delete Record
                                        </button>
                                    </form>
                                </div>
                                <div>
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Update Attendance Record
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions for Attendance -->
@if(!$attendance->entry_time || !$attendance->exit_time)
<div class="fixed bottom-0 inset-x-0 pb-2 sm:pb-5">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="p-2 rounded-lg bg-indigo-600 shadow-lg sm:p-3">
            <div class="flex items-center justify-between flex-wrap">
                <div class="w-0 flex-1 flex items-center">
                    <span class="flex p-2 rounded-lg bg-indigo-800">
                        @if(!$attendance->entry_time)
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        @endif
                    </span>
                    <p class="ml-3 font-medium text-white truncate">
                        <span class="md:hidden">
                            @if(!$attendance->entry_time)
                                Member has not checked in yet
                            @else
                                Member has not checked out yet
                            @endif
                        </span>
                        <span class="hidden md:inline">
                            @if(!$attendance->entry_time)
                                {{ $attendance->user->firstname }} {{ $attendance->user->lastname }} has not checked in for this session yet
                            @else
                                {{ $attendance->user->firstname }} {{ $attendance->user->lastname }} checked in at {{ \Carbon\Carbon::parse($attendance->entry_time)->format('h:i A') }} but has not checked out
                            @endif
                        </span>
                    </p>
                </div>
                <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                    @if(!$attendance->entry_time)
                        <form action="{{ route('receptionist.attendances.recordEntry') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $attendance->user_id }}">
                            <input type="hidden" name="session_id" value="{{ $attendance->session_id }}">
                            <button type="submit" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50">
                                Check In Now
                            </button>
                        </form>
                    @else
                        <form action="{{ route('receptionist.attendances.recordExit', $attendance->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-600 bg-white hover:bg-indigo-50">
                                Check Out Now
                            </button>
                        </form>
                    @endif
                </div>
                <div class="order-2 flex-shrink-0 sm:order-3 sm:ml-2">
                    <button type="button" class="-mr-1 flex p-2 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-white" id="close-banner">
                        <span class="sr-only">Dismiss</span>
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<script>
    // Update Session Date based on Session Selection
    document.addEventListener('DOMContentLoaded', function() {
        const sessionSelect = document.getElementById('session_id');
        const dateInput = document.getElementById('date');
        
        // Create a mapping of session IDs to dates
        const sessionDates = {
            @foreach($sessions as $session)
                {{ $session->id }}: "{{ $session->date }}",
            @endforeach
        };
        
        // Update date when session changes
        sessionSelect.addEventListener('change', function() {
            const sessionId = this.value;
            if (sessionId && sessionDates[sessionId]) {
                dateInput.value = sessionDates[sessionId];
            }
        });
        
        // Close banner button
        const closeBannerButton = document.getElementById('close-banner');
        if (closeBannerButton) {
            closeBannerButton.addEventListener('click', function() {
                const banner = this.closest('.fixed');
                if (banner) {
                    banner.style.display = 'none';
                }
            });
        }
    });
    
    // Confirm delete function
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this attendance record? This action cannot be undone.')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endsection

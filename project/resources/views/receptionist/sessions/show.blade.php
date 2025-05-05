@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('partials.receptionist-sidebar')
        
        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <!-- Page header -->
            <div class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white shadow-lg">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="md:flex md:items-center md:justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-16 w-16 flex items-center justify-center rounded-full bg-white text-indigo-600 font-bold border-4 border-blue-400 shadow-md text-2xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h2 class="text-2xl font-bold leading-7 sm:text-3xl sm:truncate">
                                        {{ $session->title }}
                                    </h2>
                                    <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                                        <div class="mt-2 flex items-center text-sm text-blue-100">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-blue-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($session->date)->format('l, F j, Y') }}
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-blue-100">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-blue-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 flex lg:mt-0 lg:ml-4">
                            <span class="hidden sm:block ml-3">
                                <a href="{{ route('receptionist.sessions.index') }}" class="inline-flex items-center px-4 py-2 border border-white rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 bg-opacity-30 hover:bg-opacity-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-600 focus:ring-white transition-all duration-200">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Back to Sessions
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Left Column -->
                    <div class="md:col-span-1 space-y-6">
                        <!-- Session Info Card -->
                        <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                            <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-100">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Session Information
                                </h3>
                            </div>
                            <div class="border-t border-gray-200">
                                <dl>
                                    <div class="bg-white px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                            Type
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                {{ $session->type }}
                                            </span>
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $session->level }}
                                            </span>
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Trainer
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                                    <span class="text-indigo-700 font-semibold">{{ substr($session->trainer->firstname, 0, 1) }}{{ substr($session->trainer->lastname, 0, 1) }}</span>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="font-medium">{{ $session->trainer->firstname }} {{ $session->trainer->lastname }}</div>
                                                    <div class="text-gray-500 text-xs">{{ $session->trainer->email }}</div>
                                                </div>
                                            </div>
                                        </dd>
                                    </div>
                                    <div class="bg-white px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Capacity
                                        </dt>
                                        <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                            @php
                                                $attendancePercent = ($session->attendances->count() / $session->max_capacity) * 100;
                                                $capacityClass = $attendancePercent >= 90 ? 'bg-red-100 text-red-800' : 
                                                                ($attendancePercent >= 75 ? 'bg-yellow-100 text-yellow-800' : 
                                                                'bg-green-100 text-green-800');
                                                $spotsLeft = $session->max_capacity - $session->attendances->count();
                                            @endphp
                                            <div class="flex items-center">
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $capacityClass }}">
                                                    {{ $session->attendances->count() }}/{{ $session->max_capacity }}
                                                </span>
                                                <span class="ml-2 text-sm text-gray-500">
                                                    @if($spotsLeft <= 0)
                                                        (Full)
                                                    @else
                                                        ({{ $spotsLeft }} {{ Str::plural('spot', $spotsLeft) }} left)
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                                <div class="{{ $capacityClass }} h-2 rounded-full" style="width: {{ min($attendancePercent, 100) }}%"></div>
                                            </div>
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                            </svg>
                                            Description
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $session->description ?? 'No description available.' }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="md:col-span-2 space-y-6">
                        <!-- Attendees Section -->
                        <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                            <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    Session Attendees
                                </h3>
                                
                                <!-- Add Member Button (shows modal) -->
                                @if($availableSpots > 0)
                                    <button type="button" onclick="document.getElementById('addMemberModal').classList.remove('hidden')" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                        <svg class="mr-1.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                        </svg>
                                        Add Member
                                    </button>
                                @endif
                            </div>
                            <div class="border-t border-gray-200">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Member
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Entry Time
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Exit Time
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @forelse($session->attendances->sortBy('entry_time') as $attendance)
                                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-9 w-9 rounded-full bg-indigo-100 flex items-center justify-center">
                                                                <span class="text-indigo-700 font-semibold">{{ substr($attendance->user->firstname, 0, 1) }}{{ substr($attendance->user->lastname, 0, 1) }}</span>
                                                            </div>
                                                            <div class="ml-3">
                                                                <div class="text-sm font-medium text-gray-900">
                                                                    {{ $attendance->user->firstname }} {{ $attendance->user->lastname }}
                                                                </div>
                                                                <div class="text-xs text-gray-500">
                                                                    {{ $attendance->user->email }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($attendance->entry_time)
                                                            <span class="text-sm text-gray-900 font-medium">{{ \Carbon\Carbon::parse($attendance->entry_time)->format('h:i A') }}</span>
                                                        @else
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                                <svg class="mr-1 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                                                    <circle cx="4" cy="4" r="3" />
                                                                </svg>
                                                                Not checked in
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($attendance->exit_time)
                                                            <span class="text-sm text-gray-900 font-medium">{{ \Carbon\Carbon::parse($attendance->exit_time)->format('h:i A') }}</span>
                                                        @else
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                                <svg class="mr-1 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                                                    <circle cx="4" cy="4" r="3" />
                                                                </svg>
                                                                Not checked out
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($attendance->entry_time && $attendance->exit_time)
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                <svg class="mr-1 h-2 w-2 text-green-500" fill="currentColor" viewBox="0 0 8 8">
                                                                    <circle cx="4" cy="4" r="3" />
                                                                </svg>
                                                                Completed
                                                            </span>
                                                        @elseif($attendance->entry_time)
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                <svg class="mr-1 h-2 w-2 text-blue-500" fill="currentColor" viewBox="0 0 8 8">
                                                                    <circle cx="4" cy="4" r="3" />
                                                                </svg>
                                                                Active
                                                            </span>
                                                        @else
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                                <svg class="mr-1 h-2 w-2 text-yellow-500" fill="currentColor" viewBox="0 0 8 8">
                                                                    <circle cx="4" cy="4" r="3" />
                                                                </svg>
                                                                Registered
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <div class="flex justify-end space-x-2">
                                                            @if(!$attendance->entry_time)
                                                                <form action="{{ route('receptionist.attendances.recordEntry') }}" method="POST" class="inline-block">
                                                                    @csrf
                                                                    <input type="hidden" name="user_id" value="{{ $attendance->user_id }}">
                                                                    <input type="hidden" name="session_id" value="{{ $attendance->session_id }}">
                                                                    <button type="submit" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-150">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                                                        </svg>
                                                                        Check In
                                                                    </button>
                                                                </form>
                                                            @elseif(!$attendance->exit_time)
                                                                <form action="{{ route('receptionist.attendances.recordExit', $attendance->id) }}" method="POST" class="inline-block">
                                                                    @csrf
                                                                    <button type="submit" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-150">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                                        </svg>
                                                                        Check Out
                                                                    </button>
                                                                </form>
                                                            @endif
                                                            
                                                            <form action="{{ route('receptionist.sessions.remove-member', $session->id) }}" method="POST" class="inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="user_id" value="{{ $attendance->user_id }}">
                                                                <button type="submit" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-150" onclick="return confirm('Are you sure you want to remove this member from the session?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                    </svg>
                                                                    Remove
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="px-6 py-10 whitespace-nowrap text-center text-gray-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                        </svg>
                                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No members registered</h3>
                                                        <p class="mt-1 text-sm text-gray-500">No members registered for this session yet.</p>
                                                        <div class="mt-4">
                                                            <button type="button" onclick="document.getElementById('addMemberModal').classList.remove('hidden')" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                                                <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                                                </svg>
                                                                Add First Member
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Member Modal -->
<div id="addMemberModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('receptionist.sessions.book-for-member', $session->id) }}" method="POST">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-indigo-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Add Member to Session
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Select a member to add to this session. Only members with active subscriptions are shown.
                                </p>
                            </div>
                            <div class="mt-4">
                                <label for="user_id" class="block text-sm font-medium text-gray-700">Member</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <select id="user_id" name="user_id" required class="pl-10 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        <option value="">Select a member</option>
                                        @foreach($eligibleMembers as $member)
                                            <option value="{{ $member->id }}">{{ $member->firstname }} {{ $member->lastname }} ({{ $member->email }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($eligibleMembers->isEmpty())
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        No eligible members available to add.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200" {{ $eligibleMembers->isEmpty() ? 'disabled' : '' }}>
                        Add Member
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200" onclick="document.getElementById('addMemberModal').classList.add('hidden')">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation to attendee rows
        const animateAttendeeRows = () => {
            const attendeeRows = document.querySelectorAll('tbody tr');
            attendeeRows.forEach((row, index) => {
                setTimeout(() => {
                    row.classList.add('transform', 'transition');
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 50);
            });
        };
        
        // Initialize with opacity 0 and transform
        const attendeeRows = document.querySelectorAll('tbody tr');
        attendeeRows.forEach(row => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(8px)';
        });
        
        // Animate after a short delay
        setTimeout(animateAttendeeRows, 300);
        
        // Modal backdrop click to close
        const modalBackdrop = document.querySelector('.fixed.inset-0.bg-gray-500.bg-opacity-75');
        if (modalBackdrop) {
            modalBackdrop.addEventListener('click', function() {
                document.getElementById('addMemberModal').classList.add('hidden');
            });
        }
    });
</script>
@endsection
@endsection
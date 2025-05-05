<!-- resources/views/trainer/sessions/index.blade.php -->
@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Include the trainer sidebar -->
        @include('partials.trainer-sidebar')
        
        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <!-- Page header -->
            <div class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                    <h1 class="text-2xl font-semibold text-gray-900">My Sessions</h1>
                    <a href="{{ route('trainer.sessions.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Create New Session
                    </a>
                </div>
            </div>
            
            <!-- Page content -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <!-- Tab navigation -->
                <div class="border-b border-gray-200 mb-6">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button id="sessions-tab" class="border-indigo-500 text-indigo-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Sessions List
                        </button>
                        <button id="schedule-tab" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Weekly Schedule
                        </button>
                    </nav>
                </div>
                
                @if(session('success'))
                    <div class="px-4 py-3 bg-green-50 text-green-800 rounded-md mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="px-4 py-3 bg-red-50 text-red-800 rounded-md mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                
                <!-- Sessions Tab Content -->
                <div id="sessions-content">
                    <!-- Session filters -->
                    <div class="bg-white shadow rounded-lg mb-6 p-4">
                        <form action="{{ route('trainer.sessions.index') }}" method="GET" class="flex flex-wrap gap-4">
                            <div class="w-full md:w-auto">
                                <label for="date" class="block text-sm font-medium text-gray-700">Filter by Date</label>
                                <input type="date" name="date" id="date" value="{{ request()->date }}" 
                                       class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            
                            <div class="w-full md:w-auto">
                                <label for="type" class="block text-sm font-medium text-gray-700">Filter by Type</label>
                                <select name="type" id="type" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option value="all">All Types</option>
                                    @foreach($sessionTypes as $type)
                                        <option value="{{ $type }}" {{ request()->type == $type ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- New City Filter -->
                            <div class="w-full md:w-auto">
                                <label for="city" class="block text-sm font-medium text-gray-700">Filter by City</label>
                                <select name="city" id="city" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option value="all">All Cities</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city }}" {{ request()->city == $city ? 'selected' : '' }}>{{ $city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="w-full md:w-auto flex items-end">
                                <button type="submit" class="bg-indigo-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Filter
                                </button>
                                
                                @if(request()->has('date') || request()->has('type') || request()->has('city'))
                                    <a href="{{ route('trainer.sessions.index') }}" class="ml-2 text-sm text-gray-600 hover:text-gray-900">
                                        Clear Filters
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                    
                    <!-- Sessions list -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                My Sessions
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                All sessions you've created and are scheduled to lead
                            </p>
                        </div>
                        
                        <div class="border-t border-gray-200">
                            @if($sessions->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Session
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Date & Time
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    City
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Attendance
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
                                            @foreach($sessions as $session)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900">{{ $session->title }}</div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $session->type }} - {{ $session->level }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">
                                                            {{ \Carbon\Carbon::parse($session->date)->format('M d, Y') }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }} - 
                                                            {{ \Carbon\Carbon::parse($session->end_time)->format('g:i A') }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">
                                                            {{ $session->city }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">
                                                            {{ $session->registered_members ?? $session->attendances->count() }}/{{ $session->max_capacity }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $session->max_capacity - ($session->registered_members ?? $session->attendances->count()) }} spots left
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @php
                                                            $now = \Carbon\Carbon::now();
                                                            $sessionDate = \Carbon\Carbon::parse($session->date);
                                                            $startTime = \Carbon\Carbon::parse($session->start_time);
                                                            $endTime = \Carbon\Carbon::parse($session->end_time);
                                                            
                                                            $sessionDateTime = $sessionDate->copy()->setTime(
                                                                $startTime->format('H'), 
                                                                $startTime->format('i')
                                                            );
                                                            
                                                            $sessionEndDateTime = $sessionDate->copy()->setTime(
                                                                $endTime->format('H'), 
                                                                $endTime->format('i')
                                                            );
                                                        @endphp
                                                        
                                                        @if($sessionEndDateTime->isPast())
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                                Completed
                                                            </span>
                                                        @elseif($sessionDateTime->isPast() && !$sessionEndDateTime->isPast())
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                In Progress
                                                            </span>
                                                        @elseif($sessionDateTime->isToday())
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                Today
                                                            </span>
                                                        @else
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                                Upcoming
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="{{ route('trainer.sessions.show', $session->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                                            View
                                                        </a>
                                                        
                                                        @if(!$sessionDateTime->isPast())
                                                            <a href="{{ route('trainer.sessions.edit', $session->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                                                Edit
                                                            </a>
                                                            
                                                            <form method="POST" action="{{ route('trainer.sessions.destroy', $session->id) }}" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-600 hover:text-red-900"
                                                                        onclick="return confirm('Are you sure you want to cancel this session?')">
                                                                    Cancel
                                                                </button>
                                                            </form>
                                                        @endif
                                                        
                                                        <a href="{{ route('trainer.sessions.attendances', $session->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-2">
                                                            Attendance
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-10">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No sessions found</h3>
                                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new session.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('trainer.sessions.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Create New Session
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    @if($sessions->hasPages())
                        <div class="mt-4">
                            {{ $sessions->links() }}
                        </div>
                    @endif
                </div>
                
                <!-- Schedule Tab Content -->
                <div id="schedule-content" class="hidden">
                    <!-- Calendar legend -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Schedule Legend</h3>
                            <div class="mt-4 flex flex-wrap gap-4">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 rounded-md bg-green-100 mr-2"></div>
                                    <span class="text-sm text-gray-700">Available Day</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-6 h-6 rounded-md bg-indigo-100 mr-2"></div>
                                    <span class="text-sm text-gray-700">Scheduled Session</span>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-6 h-6 rounded-md bg-yellow-100 mr-2"></div>
                                    <span class="text-sm text-gray-700">Today</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Weekly calendar view -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Weekly Schedule
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                View your sessions and availability for the current week
                            </p>
                        </div>
                        <div class="border-t border-gray-200">
                            <div class="grid grid-cols-7 border-b">
                                @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayName)
                                    <div class="px-2 py-3 text-center font-medium bg-gray-50">
                                        {{ $dayName }}
                                    </div>
                                @endforeach
                            </div>
                            <div class="grid grid-cols-7 min-h-[150px]">
                                @php
                                    $startOfWeek = now()->startOfWeek();
                                    $endOfWeek = now()->endOfWeek();
                                @endphp
                                
                                @for($day = $startOfWeek; $day <= $endOfWeek; $day->addDay())
                                    @php
                                        $isToday = $day->isToday();
                                        // In a real implementation, you would fetch availabilities and sessions for this day
                                        $hasAvailability = false; // This would be determined from your availability data
                                        $daySessions = []; // This would be fetched from your sessions data
                                    @endphp
                                    
                                    <div class="border-r last:border-r-0 border-b p-2 
                                        {{ $isToday ? 'bg-yellow-50' : '' }}
                                        {{ !$isToday && $hasAvailability ? 'bg-green-50' : '' }}">
                                        <div class="flex justify-between items-center mb-2">
                                            <div class="font-medium text-sm {{ $isToday ? 'text-indigo-600 font-bold' : '' }}">
                                                {{ $day->format('j') }}
                                            </div>
                                            <span class="text-xs">{{ $day->format('M') }}</span>
                                        </div>
                                        
                                        <!-- Placeholder for sessions -->
                                        <div class="space-y-1">
                                            <!-- This would be populated with actual sessions -->
                                            <!-- Example of how a session would look -->
                                            @if($isToday)
                                                <div class="px-1 py-1 text-xs rounded bg-indigo-100 text-indigo-800">
                                                    <div class="font-medium truncate" title="Example Session">
                                                        Example Session
                                                    </div>
                                                    <div class="text-indigo-600">
                                                        9:00 AM - 10:00 AM
                                                    </div>
                                                    <div class="text-indigo-600 text-xs">
                                                        City: New York
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    
                    <!-- Link to full calendar -->
                    <div class="text-center mt-4">
                        <a href="{{ route('trainer.schedule.calendar') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            View Full Calendar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sessionsTab = document.getElementById('sessions-tab');
        const scheduleTab = document.getElementById('schedule-tab');
        const sessionsContent = document.getElementById('sessions-content');
        const scheduleContent = document.getElementById('schedule-content');
        
        sessionsTab.addEventListener('click', function() {
            sessionsTab.classList.add('border-indigo-500', 'text-indigo-600');
            sessionsTab.classList.remove('border-transparent', 'text-gray-500');
            scheduleTab.classList.add('border-transparent', 'text-gray-500');
            scheduleTab.classList.remove('border-indigo-500', 'text-indigo-600');
            
            sessionsContent.classList.remove('hidden');
            scheduleContent.classList.add('hidden');
        });
        
        scheduleTab.addEventListener('click', function() {
            scheduleTab.classList.add('border-indigo-500', 'text-indigo-600');
            scheduleTab.classList.remove('border-transparent', 'text-gray-500');
            sessionsTab.classList.add('border-transparent', 'text-gray-500');
            sessionsTab.classList.remove('border-indigo-500', 'text-indigo-600');
            
            scheduleContent.classList.remove('hidden');
            sessionsContent.classList.add('hidden');
        });
    });
</script>
@endsection
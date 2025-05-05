@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Include the admin sidebar -->
        @include('partials.admin-sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Page Header -->
            <div class="bg-orange-500 text-white shadow-lg">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h1 class="text-3xl font-bold tracking-tight flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Sessions Management
                            </h1>
                            <p class="mt-1 text-white text-sm flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Manage your organization's fitness sessions
                            </p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('admin.reports.sessions') }}" 
                                class="inline-flex items-center px-4 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-orange-500 focus:ring-white transition-all duration-200">
                                <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Session Report
                            </a>
                           
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow-lg rounded-lg p-6 mb-8 border border-gray-100">
                    <form action="{{ route('admin.sessions.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Filter by Date Range -->
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm transition-colors duration-200">
                            </div>
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm transition-colors duration-200">
                            </div>
                        </div>
                        
                        <!-- Filter by Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Session Type</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <select id="type" name="type" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm transition-colors duration-200">
                                    <option value="">All Types</option>
                                    <option value="Cardio" {{ request('type') === 'Cardio' ? 'selected' : '' }}>Cardio</option>
                                    <option value="Strength" {{ request('type') === 'Strength' ? 'selected' : '' }}>Strength</option>
                                    <option value="HIIT" {{ request('type') === 'HIIT' ? 'selected' : '' }}>HIIT</option>
                                    <option value="Yoga" {{ request('type') === 'Yoga' ? 'selected' : '' }}>Yoga</option>
                                    <option value="Pilates" {{ request('type') === 'Pilates' ? 'selected' : '' }}>Pilates</option>
                                    <option value="Cycling" {{ request('type') === 'Cycling' ? 'selected' : '' }}>Cycling</option>
                                    <option value="Zumba" {{ request('type') === 'Zumba' ? 'selected' : '' }}>Zumba</option>
                                    <option value="CrossFit" {{ request('type') === 'CrossFit' ? 'selected' : '' }}>CrossFit</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Filter Actions -->
                        <div class="flex items-end space-x-2">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                Filter
                            </button>
                            <a href="{{ route('admin.sessions.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
                
            

                <!-- Sessions Table -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-100">
                    <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                        <h2 class="text-lg font-medium text-gray-900 flex items-center">
                            <span class="w-1 h-4 bg-orange-500 rounded-sm mr-2"></span>
                            All Sessions
                        </h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Trainer
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date & Time
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Level
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Capacity
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($sessions as $session)
                                    <tr class="hover:bg-orange-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $session->title }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white font-bold shadow-sm">
                                                    {{ isset($session->trainer) ? 
                                                    substr($session->trainer->firstname, 0, 1) . substr($session->trainer->lastname, 0, 1) : 
                                                    'NA' }}
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ isset($session->trainer) ? 
                                                        $session->trainer->firstname . ' ' . $session->trainer->lastname : 
                                                        'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2.5 py-1.5 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($session->type == 'Cardio') bg-pink-100 text-pink-800
                                                @elseif($session->type == 'Strength') bg-blue-100 text-blue-800
                                                @elseif($session->type == 'Yoga') bg-green-100 text-green-800
                                                @elseif($session->type == 'HIIT') bg-orange-100 text-orange-800
                                                @elseif($session->type == 'Pilates') bg-purple-100 text-purple-800
                                                @elseif($session->type == 'Cycling') bg-yellow-100 text-yellow-800
                                                @elseif($session->type == 'Zumba') bg-red-100 text-red-800
                                                @elseif($session->type == 'CrossFit') bg-indigo-100 text-indigo-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ $session->type }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="font-medium">{{ \Carbon\Carbon::parse($session->date)->format('M d, Y') }}</div>
                                            <div>{{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }} - 
                                            {{ \Carbon\Carbon::parse($session->end_time)->format('g:i A') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $session->level }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @php
                                                $attendees = $session->attendances()->count();
                                                $capacityPercentage = ($session->max_capacity > 0) ? 
                                                    ($attendees / $session->max_capacity) * 100 : 0;
                                                
                                                $statusColor = 'bg-green-500';
                                                if ($capacityPercentage >= 90) {
                                                    $statusColor = 'bg-red-500';
                                                } elseif ($capacityPercentage >= 70) {
                                                    $statusColor = 'bg-yellow-500';
                                                }
                                            @endphp
                                            <div>{{ $attendees }}/{{ $session->max_capacity }}</div>
                                            <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                                                <div class="{{ $statusColor }} h-2 rounded-full" style="width: {{ $capacityPercentage }}%"></div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('admin.sessions.show', $session) }}" class="text-gray-400 hover:text-gray-600 transition-colors duration-200 bg-gray-100 hover:bg-gray-200 p-1.5 rounded-full" title="View Session">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('admin.sessions.edit', $session) }}" class="text-gray-400 hover:text-orange-500 transition-colors duration-200 bg-gray-100 hover:bg-orange-100 p-1.5 rounded-full" title="Edit Session">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('admin.sessions.attendance', $session) }}" class="text-gray-400 hover:text-blue-500 transition-colors duration-200 bg-gray-100 hover:bg-blue-100 p-1.5 rounded-full" title="Manage Attendance">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                    </svg>
                                                </a>
                                                @php
                                                    // Fix the date comparison using Carbon
                                                    $sessionDateTime = \Carbon\Carbon::parse($session->date);
                                                    $sessionDateTime->setTimeFromTimeString($session->start_time);
                                                    $isFutureSession = $sessionDateTime->greaterThan(now());
                                                @endphp
                                                @if($isFutureSession)
                                                    <form action="{{ route('admin.sessions.cancel', $session) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel this session?');">
                                                        @csrf
                                                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors duration-200 bg-gray-100 hover:bg-red-100 p-1.5 rounded-full" title="Cancel Session">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-10 whitespace-nowrap text-sm text-gray-500 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <p class="text-gray-500 font-medium">No sessions found</p>
                                                <p class="text-gray-400 text-sm mt-1">Try adjusting your search filters</p>
                                                <a href="{{ route('admin.sessions.create') }}" class="mt-3 inline-flex items-center px-3 py-1.5 text-sm text-orange-500 hover:text-orange-700 font-medium">
                                                    <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                    Create your first session
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        {{ $sessions->links() }}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        @include('partials.admin-mobile-menu')
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Define session data for the calendar
    const sessions = @json($sessions->items());
    
    // Debug: Log sessions for troubleshooting
    console.log('Available sessions:', sessions);
    
    document.addEventListener('DOMContentLoaded', function() {
        let currentDate = new Date();
        let currentWeekStart = getMonday(currentDate);
        
        // Initialize calendar
        updateCalendar(currentWeekStart);
        updateWeekDisplay(currentWeekStart);
        
        // Handle previous week button
        document.getElementById('previousWeek').addEventListener('click', function() {
            currentWeekStart.setDate(currentWeekStart.getDate() - 7);
            updateCalendar(currentWeekStart);
            updateWeekDisplay(currentWeekStart);
        });
        
        // Handle next week button
        document.getElementById('nextWeek').addEventListener('click', function() {
            currentWeekStart.setDate(currentWeekStart.getDate() + 7);
            updateCalendar(currentWeekStart);
            updateWeekDisplay(currentWeekStart);
        });
    });
    
    // Get the Monday of the current week
    function getMonday(date) {
        const day = date.getDay();
        const diff = date.getDate() - day + (day === 0 ? -6 : 1); // Adjust when day is Sunday
        return new Date(date.setDate(diff));
    }
    
    // Update the calendar display
    function updateCalendar(weekStart) {
        const calendar = document.getElementById('calendar');
        const calendarContainer = calendar.querySelector('.grid');
        
        // Keep the day headers (first 7 children)
        while (calendarContainer.children.length > 7) {
            calendarContainer.removeChild(calendarContainer.lastChild);
        }
        
        // Create calendar cells for the week
        for (let i = 0; i < 7; i++) {
            const date = new Date(weekStart);
            date.setDate(date.getDate() + i);
            
            const dateString = date.toISOString().split('T')[0];
            console.log(`Looking for sessions on: ${dateString}`);
            
            const cell = document.createElement('div');
            cell.className = 'bg-white border border-gray-200 p-2 min-h-[150px]';
            
            // Add date to the cell
            const dateHeader = document.createElement('div');
            dateHeader.className = 'text-sm font-medium text-gray-500 pb-2 text-center';
            dateHeader.textContent = date.getDate();
            
            if (date.toDateString() === new Date().toDateString()) {
                dateHeader.className += ' text-orange-600 font-bold';
                cell.className += ' bg-orange-50';
            }
            
            cell.appendChild(dateHeader);
            
            // Filter sessions for this date
            const todaysSessions = sessions.filter(session => {
                // Handle possible date format differences by formatting the date consistently
                const sessionDate = new Date(session.date);
                const formattedSessionDate = sessionDate.toISOString().split('T')[0];
                const matches = formattedSessionDate === dateString;
                
                if (matches) {
                    console.log(`Found session "${session.title}" on ${formattedSessionDate}`);
                }
                
                return matches;
            });
            
            console.log(`${todaysSessions.length} sessions found for ${dateString}`);
            
            // Add sessions to the cell
            todaysSessions.forEach(session => {
                const sessionElement = document.createElement('a');
                sessionElement.href = `/admin/sessions/${session.id}`;
                sessionElement.className = 'block text-xs p-1 rounded mb-1 text-white overflow-hidden';
                
                // Style based on session type
                let bgColor = 'bg-gray-600';
                switch(session.type) {
                    case 'Cardio': bgColor = 'bg-pink-600'; break;
                    case 'Strength': bgColor = 'bg-blue-600'; break;
                    case 'Yoga': bgColor = 'bg-green-600'; break;
                    case 'HIIT': bgColor = 'bg-orange-600'; break;
                    case 'Pilates': bgColor = 'bg-purple-600'; break;
                    case 'Cycling': bgColor = 'bg-yellow-600'; break;
                    case 'Zumba': bgColor = 'bg-red-600'; break;
                    case 'CrossFit': bgColor = 'bg-indigo-600'; break;
                }
                sessionElement.className += ` ${bgColor}`;
                
                // Format time - handle potential formatting issues
                let startTime, endTime;
                try {
                    startTime = new Date(`2000-01-01T${session.start_time}`).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                } catch (e) {
                    console.error(`Error formatting start time: ${session.start_time}`, e);
                    startTime = session.start_time;
                }
                
                try {
                    endTime = new Date(`2000-01-01T${session.end_time}`).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                } catch (e) {
                    console.error(`Error formatting end time: ${session.end_time}`, e);
                    endTime = session.end_time;
                }
                
                sessionElement.innerHTML = `
                    <div class="font-bold">${session.title}</div>
                    <div>${startTime} - ${endTime}</div>
                `;
                
                cell.appendChild(sessionElement);
            });
            
            calendarContainer.appendChild(cell);
        }
    }
    
    // Update the week display text
    function updateWeekDisplay(weekStart) {
        const weekEnd = new Date(weekStart);
        weekEnd.setDate(weekEnd.getDate() + 6);
        
        const startMonth = weekStart.toLocaleString('default', { month: 'short' });
        const endMonth = weekEnd.toLocaleString('default', { month: 'short' });
        
        let displayText = `${startMonth} ${weekStart.getDate()}`;
        if (startMonth !== endMonth) {
            displayText += ` - ${endMonth} ${weekEnd.getDate()}`;
        } else {
            displayText += ` - ${weekEnd.getDate()}`;
        }
        displayText += `, ${weekEnd.getFullYear()}`;
        
        document.getElementById('currentWeek').textContent = displayText;
    }
</script>
@endpush
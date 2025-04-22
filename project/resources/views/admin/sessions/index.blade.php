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
                        <h1 class="text-3xl font-bold">Sessions Management</h1>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.sessions.create') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-800 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Create Session
                            </a>
                            <a href="{{ route('admin.reports.sessions') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                    <form action="{{ route('admin.sessions.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Filter by Date Range -->
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        
                        <!-- Filter by Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Session Type</label>
                            <select id="type" name="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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
                        
                        <!-- Filter Actions -->
                        <div class="flex items-end space-x-2">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Filter
                            </button>
                            <a href="{{ route('admin.sessions.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
                
                <!-- Sessions Calendar View -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                        <h2 class="text-lg font-medium text-gray-900">Calendar View</h2>
                        <div>
                            <button id="previousWeek" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <span id="currentWeek" class="mx-4 text-sm font-medium text-gray-900"></span>
                            <button id="nextWeek" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <div class="p-6" id="calendar">
                            <!-- Calendar will be generated with JavaScript -->
                            <div class="grid grid-cols-7 gap-px">
                                <!-- Day headers -->
                                <div class="bg-gray-50 text-center py-2">
                                    <span class="text-sm font-medium text-gray-900">Monday</span>
                                </div>
                                <div class="bg-gray-50 text-center py-2">
                                    <span class="text-sm font-medium text-gray-900">Tuesday</span>
                                </div>
                                <div class="bg-gray-50 text-center py-2">
                                    <span class="text-sm font-medium text-gray-900">Wednesday</span>
                                </div>
                                <div class="bg-gray-50 text-center py-2">
                                    <span class="text-sm font-medium text-gray-900">Thursday</span>
                                </div>
                                <div class="bg-gray-50 text-center py-2">
                                    <span class="text-sm font-medium text-gray-900">Friday</span>
                                </div>
                                <div class="bg-gray-50 text-center py-2">
                                    <span class="text-sm font-medium text-gray-900">Saturday</span>
                                </div>
                                <div class="bg-gray-50 text-center py-2">
                                    <span class="text-sm font-medium text-gray-900">Sunday</span>
                                </div>
                                
                                <!-- Calendar cells will be rendered here by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sessions Table -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">All Sessions</h2>
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
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $session->title }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                    <span class="text-indigo-800 font-bold">
                                                        {{ isset($session->trainer) ? 
                                                        substr($session->trainer->firstname, 0, 1) . substr($session->trainer->lastname, 0, 1) : 
                                                        'NA' }}
                                                    </span>
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
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
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
                                                <a href="{{ route('admin.sessions.show', $session) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    View
                                                </a>
                                                <a href="{{ route('admin.sessions.edit', $session) }}" class="text-green-600 hover:text-green-900">
                                                    Edit
                                                </a>
                                                <a href="{{ route('admin.sessions.attendance', $session) }}" class="text-blue-600 hover:text-blue-900">
                                                    Attendance
                                                </a>
                                                @if(\Carbon\Carbon::parse($session->date . ' ' . $session->start_time) > now())
                                                    <form action="{{ route('admin.sessions.cancel', $session) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel this session?');">
                                                        @csrf
                                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                                            Cancel
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No sessions found.
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
            const cell = document.createElement('div');
            cell.className = 'bg-white border border-gray-200 p-2 min-h-[150px]';
            
            // Add date to the cell
            const dateHeader = document.createElement('div');
            dateHeader.className = 'text-sm font-medium text-gray-500 pb-2 text-center';
            dateHeader.textContent = date.getDate();
            
            if (date.toDateString() === new Date().toDateString()) {
                dateHeader.className += ' text-indigo-600 font-bold';
                cell.className += ' bg-indigo-50';
            }
            
            cell.appendChild(dateHeader);
            
            // Filter sessions for this date
            const todaysSessions = sessions.filter(session => {
                return session.date === dateString;
            });
            
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
                
                // Format time
                const startTime = new Date(`2000-01-01T${session.start_time}`).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                const endTime = new Date(`2000-01-01T${session.end_time}`).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                
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
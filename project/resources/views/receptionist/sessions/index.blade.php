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
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex-1 min-w-0">
                            <h2 class="text-2xl font-bold leading-7 sm:text-3xl sm:truncate">
                                Sessions Management
                            </h2>
                            <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                                <div class="mt-2 flex items-center text-sm text-blue-100">
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-blue-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse(request('date', today()))->format('l, F j, Y') }}
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex md:mt-0 md:ml-4">
                     
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <!-- Date Navigation -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden mb-6">
                    <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-100">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Session Schedule
                        </h3>
                    </div>
                    <div class="p-4">
                        <div class="flex flex-col sm:flex-row justify-between items-center">
                            <p class="text-sm text-gray-500 mb-4 sm:mb-0">
                                Browse sessions by date
                            </p>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('receptionist.sessions.index', ['date' => \Carbon\Carbon::parse(request('date', today()))->subDay()->format('Y-m-d')]) }}" class="inline-flex items-center p-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-150">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    <span class="sr-only sm:not-sr-only sm:ml-2">Previous Day</span>
                                </a>
                                <form action="{{ route('receptionist.sessions.index') }}" method="GET" class="flex items-center">
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <input type="date" name="date" id="date" value="{{ request('date', today()->format('Y-m-d')) }}" class="pl-10 focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md transition-all duration-150">
                                    </div>
                                    <button type="submit" class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-150">
                                        Go
                                    </button>
                                </form>
                                <a href="{{ route('receptionist.sessions.index', ['date' => \Carbon\Carbon::parse(request('date', today()))->addDay()->format('Y-m-d')]) }}" class="inline-flex items-center p-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-150">
                                    <span class="sr-only sm:not-sr-only sm:mr-2">Next Day</span>
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                                <a href="{{ route('receptionist.sessions.index', ['date' => today()->format('Y-m-d')]) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Today
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden mb-6">
                    <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-100">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filter Sessions
                        </h3>
                    </div>
                    <form action="{{ route('receptionist.sessions.index') }}" method="GET" class="p-4">
                        <input type="hidden" name="date" value="{{ request('date', today()->format('Y-m-d')) }}">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
                            <div>
                                <label for="trainer_id" class="block text-sm font-medium text-gray-700 mb-1">Trainer</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <select id="trainer_id" name="trainer_id" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="all" {{ request('trainer_id') == 'all' ? 'selected' : '' }}>All Trainers</option>
                                        @foreach($trainers as $trainer)
                                            <option value="{{ $trainer->id }}" {{ request('trainer_id') == $trainer->id ? 'selected' : '' }}>
                                                {{ $trainer->firstname }} {{ $trainer->lastname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Session Type</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                    </div>
                                    <select id="type" name="type" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All Types</option>
                                        @foreach($sessionTypes as $type)
                                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="flex items-end space-x-3">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                    <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                    </svg>
                                    Apply Filters
                                </button>
                                <a href="{{ route('receptionist.sessions.index', ['date' => request('date', today()->format('Y-m-d'))]) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                    <svg class="mr-2 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                    
                <!-- Sessions Timeline -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                    <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Sessions Schedule
                        </h3>
                        <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            {{ $sessions->total() }} Sessions
                        </div>
                    </div>
                    @if($sessions->count() > 0)
                        <div class="divide-y divide-gray-200">
                            @foreach($sessions as $session)
                                <div class="px-4 py-5 sm:p-6 hover:bg-gray-50 transition-colors duration-150">
                                    <div class="sm:flex sm:justify-between sm:items-start">
                                        <div class="sm:flex sm:items-start">
                                            <!-- Session Time -->
                                            <div class="text-center sm:text-left sm:mr-6 flex-shrink-0">
                                                <div class="text-xl font-bold text-indigo-600 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    to {{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}
                                                </div>
                                            </div>
                                            
                                            <!-- Session Details -->
                                            <div class="mt-4 sm:mt-0">
                                                <div class="text-lg font-medium text-gray-900">{{ $session->title }}</div>
                                                <div class="flex flex-wrap mt-1 items-center">
                                                    <span class="mr-2 text-sm text-gray-500">{{ $session->type }}</span>
                                                    <span class="mr-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                        {{ $session->level }}
                                                    </span>
                                                    <span class="text-sm text-gray-500 flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                        </svg>
                                                        {{ $session->trainer->firstname }} {{ $session->trainer->lastname }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Attendance & Actions -->
                                        <div class="mt-5 sm:mt-0 flex flex-col sm:items-end">
                                            <!-- Capacity Badge -->
                                            @php
                                                $attendancePercent = ($session->attendances->count() / $session->max_capacity) * 100;
                                                $capacityClass = $attendancePercent >= 90 ? 'bg-red-100 text-red-800' : 
                                                                ($attendancePercent >= 75 ? 'bg-yellow-100 text-yellow-800' : 
                                                                'bg-green-100 text-green-800');
                                                $spotsLeft = $session->max_capacity - $session->attendances->count();
                                            @endphp
                                            <div class="flex flex-col items-end">
                                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $capacityClass }}">
                                                    {{ $session->attendances->count() }}/{{ $session->max_capacity }} 
                                                </span>
                                                <span class="text-xs text-gray-500 mt-1">
                                                    @if($spotsLeft <= 0)
                                                        Full
                                                    @else
                                                        {{ $spotsLeft }} {{ Str::plural('spot', $spotsLeft) }} left
                                                    @endif
                                                </span>
                                            </div>
                                            
                                            <!-- View Button -->
                                            <a href="{{ route('receptionist.sessions.show', $session->id) }}" class="mt-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                                <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="px-4 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No sessions found</h3>
                            <p class="mt-1 text-sm text-gray-500">No sessions are scheduled for this date with the selected filters.</p>
                            <div class="mt-6">
                                <a href="{{ route('receptionist.sessions.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                    <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Reset filters
                                </a>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Pagination -->
                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                        {{ $sessions->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add animation to session rows
        const animateSessionRows = () => {
            const sessionItems = document.querySelectorAll('.divide-y.divide-gray-200 > div');
            sessionItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('transform', 'transition');
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, index * 50);
            });
        };
        
        // Initialize with opacity 0 and transform
        const sessionItems = document.querySelectorAll('.divide-y.divide-gray-200 > div');
        sessionItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(8px)';
        });
        
        // Animate after a short delay
        setTimeout(animateSessionRows, 300);
    });
</script>
@endsection
@endsection
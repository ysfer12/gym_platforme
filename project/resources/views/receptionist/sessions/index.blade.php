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
                        <h1 class="text-2xl font-semibold text-gray-900">Sessions Management</h1>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <!-- Date Navigation -->
                    <div class="bg-white p-4 shadow sm:rounded-lg mb-6">
                        <div class="flex flex-col sm:flex-row justify-between items-center">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">Session Schedule</h2>
                                <p class="mt-1 text-sm text-gray-500">
                                    Browse sessions by date
                                </p>
                            </div>
                            <div class="mt-4 sm:mt-0 flex items-center space-x-2">
                                <a href="{{ route('receptionist.sessions.index', ['date' => \Carbon\Carbon::parse(request('date', today()))->subDay()->format('Y-m-d')]) }}" class="inline-flex items-center p-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    <span class="sr-only">Previous Day</span>
                                </a>
                                <form action="{{ route('receptionist.sessions.index') }}" method="GET" class="flex items-center">
                                    <input type="date" name="date" id="date" value="{{ request('date', today()->format('Y-m-d')) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block sm:text-sm border-gray-300 rounded-md">
                                    <button type="submit" class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Go
                                    </button>
                                </form>
                                <a href="{{ route('receptionist.sessions.index', ['date' => \Carbon\Carbon::parse(request('date', today()))->addDay()->format('Y-m-d')]) }}" class="inline-flex items-center p-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                    <span class="sr-only">Next Day</span>
                                </a>
                                <a href="{{ route('receptionist.sessions.index', ['date' => today()->format('Y-m-d')]) }}" class="ml-2 inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Today
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6 mb-6">
                        <form action="{{ route('receptionist.sessions.index') }}" method="GET">
                            <input type="hidden" name="date" value="{{ request('date', today()->format('Y-m-d')) }}">
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
                                <div>
                                    <label for="trainer_id" class="block text-sm font-medium text-gray-700">Trainer</label>
                                    <select id="trainer_id" name="trainer_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                        <option value="all" {{ request('trainer_id') == 'all' ? 'selected' : '' }}>All Trainers</option>
                                        @foreach($trainers as $trainer)
                                            <option value="{{ $trainer->id }}" {{ request('trainer_id') == $trainer->id ? 'selected' : '' }}>
                                                {{ $trainer->firstname }} {{ $trainer->lastname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700">Session Type</label>
                                    <select id="type" name="type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                        <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All Types</option>
                                        @foreach($sessionTypes as $type)
                                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex items-end">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        Filter
                                    </button>
                                    <a href="{{ route('receptionist.sessions.index', ['date' => request('date', today()->format('Y-m-d'))]) }}" class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Current Date Display -->
                    <div class="flex justify-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">
                            {{ \Carbon\Carbon::parse(request('date', today()))->format('l, F j, Y') }}
                        </h2>
                    </div>
                    
                    <!-- Sessions Timeline -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Sessions Schedule</h3>
                        </div>
                        @if($sessions->count() > 0)
                            <div class="divide-y divide-gray-200">
                                @foreach($sessions as $session)
                                    <div class="px-4 py-5 sm:p-6 hover:bg-gray-50">
                                        <div class="sm:flex sm:justify-between sm:items-center">
                                            <div class="sm:flex sm:items-center">
                                                <!-- Session Time -->
                                                <div class="text-center sm:text-left sm:mr-6">
                                                    <div class="text-lg font-medium text-indigo-600">
                                                        {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        to {{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}
                                                    </div>
                                                </div>
                                                
                                                <!-- Session Details -->
                                                <div class="mt-4 sm:mt-0">
                                                    <div class="text-lg font-medium text-gray-900">{{ $session->title }}</div>
                                                    <div class="flex flex-wrap mt-1">
                                                        <span class="mr-2 text-sm text-gray-500">{{ $session->type }}</span>
                                                        <span class="mr-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                            {{ $session->level }}
                                                        </span>
                                                        <span class="text-sm text-gray-500">
                                                            Trainer: {{ $session->trainer->firstname }} {{ $session->trainer->lastname }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Attendance & Actions -->
                                            <div class="mt-5 sm:mt-0 flex flex-col sm:flex-row sm:items-center">
                                                <!-- Capacity Badge -->
                                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $session->attendances->count() >= $session->max_capacity ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                                    {{ $session->attendances->count() }}/{{ $session->max_capacity }} 
                                                    @if($session->attendances->count() >= $session->max_capacity)
                                                        (Full)
                                                    @else
                                                        ({{ $session->max_capacity - $session->attendances->count() }} spots left)
                                                    @endif
                                                </span>
                                                
                                                <!-- View Button -->
                                                <a href="{{ route('receptionist.sessions.show', $session->id) }}" class="mt-2 sm:mt-0 sm:ml-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                                <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No sessions found</h3>
                                <p class="mt-1 text-sm text-gray-500">No sessions are scheduled for this date with the selected filters.</p>
                                <div class="mt-6">
                                    <a href="{{ route('receptionist.sessions.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
</div>
@endsection
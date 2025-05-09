@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Include the trainer sidebar -->
        @include('partials.trainer-sidebar')
        
        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <!-- Header with welcome message and create session button -->
            <header class="bg-gradient-to-r from-green-600 to-green-800 shadow-lg">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex-1 min-w-0">
                            <h1 class="text-2xl font-bold leading-7 text-white sm:text-3xl sm:truncate">
                                Welcome back, {{ Auth::user()->firstname }}!
                            </h1>
                            <div class="mt-2 flex items-center text-sm text-green-100">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <p>
                                    <span class="font-semibold">Trainer Status: </span> Active
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 flex space-x-3 md:mt-0 md:ml-4">
                            <a href="{{ route('trainer.schedule.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Schedule
                            </a>
                            <a href="{{ route('trainer.sessions.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Create Session
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <main class="py-6">
                <!-- Stats Overview -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        <!-- Today's Sessions -->
                        <div class="bg-white overflow-hidden shadow rounded-lg border-l-4 border-green-500 hover:shadow-md transition-shadow duration-300">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">
                                                Today's Sessions
                                            </dt>
                                            <dd>
                                                <div class="text-lg font-semibold text-gray-900">
                                                    {{ $todaySessions }}
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 flex items-center justify-between border-t border-gray-200">
                                <div class="text-sm">
                                    <a href="{{ route('trainer.sessions.index') }}" class="font-medium text-green-600 hover:text-green-500 flex items-center">
                                        View all
                                        <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="flex-shrink-0 text-gray-400 text-sm">
                                    <span>{{ now()->format('M d') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Total Sessions -->
                        <div class="bg-white overflow-hidden shadow rounded-lg border-l-4 border-blue-500 hover:shadow-md transition-shadow duration-300">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                        <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">
                                                Total Sessions
                                            </dt>
                                            <dd>
                                                <div class="text-lg font-semibold text-gray-900">
                                                    {{ $totalSessions }}
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 flex items-center justify-between border-t border-gray-200">
                                <div class="text-sm">
                                    <a href="{{ route('trainer.sessions.index') }}" class="font-medium text-blue-600 hover:text-blue-500 flex items-center">
                                        View history
                                        <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="flex-shrink-0 text-sm text-gray-400">
                                    <span>All time</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Total Members -->
                        <div class="bg-white overflow-hidden shadow rounded-lg border-l-4 border-purple-500 hover:shadow-md transition-shadow duration-300">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-purple-100 rounded-md p-3">
                                        <svg class="h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">
                                                Total Members
                                            </dt>
                                            <dd>
                                                <div class="text-lg font-semibold text-gray-900">
                                                    {{ $totalUniqueMembers }}
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 flex items-center justify-between border-t border-gray-200">
                                <div class="text-sm">
                                    <a href="{{ route('trainer.members') }}" class="font-medium text-purple-600 hover:text-purple-500 flex items-center">
                                        View members
                                        <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="flex-shrink-0 text-sm text-gray-400">
                                    <span>Active</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Attendance Rate -->
                        <div class="bg-white overflow-hidden shadow rounded-lg border-l-4 border-yellow-500 hover:shadow-md transition-shadow duration-300">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-yellow-100 rounded-md p-3">
                                        <svg class="h-6 w-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">
                                                Attendance Rate
                                            </dt>
                                            <dd>
                                                <div class="text-lg font-semibold text-gray-900">
                                                    {{ $attendanceRate }}%
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                                    <div class="bg-yellow-500 h-2 rounded-full transition-all duration-500" style="width: {{ min(100, $attendanceRate) }}%"></div>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 flex items-center justify-between border-t border-gray-200">
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-yellow-600 hover:text-yellow-500 flex items-center">
                                        View details
                                        <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                                <div class="flex-shrink-0 text-sm text-gray-400">
                                    <span>Last 30 days</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Left Column (2/3 width) -->
                        <div class="lg:col-span-2 space-y-8">
                            <!-- Upcoming Sessions -->
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6 flex justify-between items-center border-b border-gray-200">
                                    <div>
                                        <h2 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                            <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Upcoming Sessions
                                        </h2>
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Your scheduled classes and appointments</p>
                                    </div>
                                    <a href="{{ route('trainer.sessions.index') }}" class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-500">
                                        View all
                                        <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                                
                                @if($upcomingSessions->count() > 0)
                                <div class="overflow-hidden">
                                    <ul class="divide-y divide-gray-200">
                                        @foreach($upcomingSessions as $session)
                                        <li class="hover:bg-gray-50 transition-colors duration-150">
                                            <div class="px-4 py-4 flex items-center sm:px-6">
                                                <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                                    <div>
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-green-400 to-green-600 rounded-md flex items-center justify-center text-white font-bold">
                                                                {{ substr($session->type, 0, 1) }}
                                                            </div>
                                                            <div class="ml-4">
                                                                <p class="text-sm font-medium text-green-600">
                                                                    {{ $session->title }}
                                                                </p>
                                                                <div class="mt-1 flex items-center text-sm text-gray-500">
                                                                    <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                                    </svg>
                                                                    <p>
                                                                        {{ \Carbon\Carbon::parse($session->date)->format('D, M d, Y') }}
                                                                    </p>
                                                                    <span class="mx-2 text-gray-300">|</span>
                                                                    <p class="flex items-center">
                                                                        <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                                        </svg>
                                                                        {{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }} - 
                                                                        {{ \Carbon\Carbon::parse($session->end_time)->format('g:i A') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4 flex flex-col sm:mt-0 sm:ml-6 sm:flex-row sm:items-center sm:space-x-3">
                                                        <!-- Session Type Badge -->
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $session->type == 'Cardio' ? 'bg-pink-100 text-pink-800' : ($session->type == 'Strength' ? 'bg-blue-100 text-blue-800' : ($session->type == 'Yoga' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800')) }}">
                                                            {{ $session->type }}
                                                        </span>
                                                        
                                                        <!-- Session Level Badge -->
                                                        <span class="mt-2 sm:mt-0 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            {{ $session->level }}
                                                        </span>
                                                        
                                                        <!-- Attendance Count -->
                                                        <div class="mt-2 sm:mt-0 flex items-center text-sm text-gray-500">
                                                            <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="font-medium text-gray-900">{{ $session->attendances->count() }}</span>
                                                            <span class="mx-1">/</span>
                                                            <span>{{ $session->max_capacity }}</span>
                                                        </div>
                                                        
                                                        <!-- Manage Attendance Link -->
                                                        <a href="{{ route('trainer.sessions.attendances', $session->id) }}" class="mt-2 sm:mt-0 px-3 py-1 inline-flex items-center text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-150">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                                            </svg>
                                                            Manage
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                <div class="flex items-center justify-center h-64 bg-gray-50">
                                    <div class="text-center max-w-md px-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <h3 class="mt-4 text-lg font-medium text-gray-900">No upcoming sessions</h3>
                                        <p class="mt-2 text-sm text-gray-500">You don't have any upcoming sessions scheduled. Get started by creating a new session.</p>
                                        <div class="mt-6">
                                            <a href="{{ route('trainer.sessions.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                Create new session
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Recent Attendance Records -->
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                    <h2 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                        </svg>
                                        Recent Attendance Records
                                    </h2>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Member attendance in your recent sessions</p>
                                </div>
                                
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Session</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @forelse($recentAttendances ?? [] as $attendance)
                                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                                                                <span class="text-white font-bold">{{ substr($attendance->user->firstname, 0, 1) }}{{ substr($attendance->user->lastname, 0, 1) }}</span>
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">{{ $attendance->user->firstname }} {{ $attendance->user->lastname }}</div>
                                                                <div class="text-xs text-gray-500">Member</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900 font-medium">{{ $attendance->session->title }}</div>
                                                        <div class="text-xs text-gray-500">{{ $attendance->session->type }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}</div>
                                                        <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($attendance->date)->format('l') }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($attendance->entry_time && $attendance->exit_time)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                <svg class="mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                                </svg>
                                                                Completed
                                                            </span>
                                                        @elseif($attendance->entry_time)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                <svg class="mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                                </svg>
                                                                Checked In
                                                            </span>
                                                        @else
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                                <svg class="mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                                                </svg>
                                                                Registered
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="px-6 py-10 whitespace-nowrap text-center text-gray-500 bg-gray-50">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                                        </svg>
                                                        <p class="mt-2 text-sm font-medium">No recent attendance records found</p>
                                                        <p class="text-xs text-gray-500 mt-1">Records will appear here when members attend your sessions</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Column (1/3 width) -->
                        <div class="space-y-8">
                            <!-- Trainer Badge with QR Code -->
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                    <h2 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                        </svg>
                                        Trainer Badge
                                    </h2>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Your FitTrack Gym credential</p>
                                </div>
                                
                                <div class="px-4 py-5 sm:p-6 flex flex-col items-center">
                                    @php
                                        $badgeClasses = [
                                            'basic' => 'from-gray-200 to-gray-300 border-gray-300',
                                            'bronze' => 'from-yellow-700 to-yellow-800 border-yellow-800',
                                            'silver' => 'from-gray-300 to-gray-500 border-gray-500',
                                            'gold' => 'from-yellow-400 to-yellow-600 border-yellow-600',
                                        ];
                                        $badgeClass = $badgeClasses[$experienceLevel['badge']] ?? $badgeClasses['basic'];
                                    @endphp
                                    
                                    <div class="relative">
                                        <div class="p-1 h-40 w-40 rounded-lg bg-gradient-to-r {{ $badgeClass }} border-2 flex items-center justify-center shadow-md">
                                            <div class="h-full w-full bg-white rounded-md flex flex-col items-center justify-center p-3">
                                                <!-- QR Code -->
                                                <div id="dashboardQrcode" class="w-28 h-28"></div>
                                                <div class="mt-2 text-center">
                                                    <p class="text-xs font-bold text-gray-900">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
                                                    <p class="text-xs font-semibold text-green-600">{{ $experienceLevel['level'] }} Trainer</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Badge controls -->
                                        <div class="absolute -bottom-3 -right-3 flex space-x-1">
                                            <a href="{{ route('trainer.profile.download-badge') }}" class="h-8 w-8 rounded-full bg-white border border-gray-200 shadow-md flex items-center justify-center hover:bg-gray-50 transition-colors duration-150">
                                                <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                            </a>
                                            <span class="h-8 w-8 rounded-full bg-white border border-gray-200 shadow-md flex items-center justify-center">
                                                <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 text-center">
                                        <p class="text-sm font-semibold text-gray-900">{{ $experienceLevel['level'] }} Trainer</p>
                                        <p class="text-xs text-gray-500">{{ $totalSessions }} sessions completed</p>
                                    </div>
                                    
                                    <!-- Progress to next level -->
                                    <div class="w-full mt-4">
                                        <div class="relative pt-1">
                                            <div class="flex mb-2 items-center justify-between">
                                                <div>
                                                    <span class="text-xs font-semibold inline-block text-green-600">
                                                        Progress to next level
                                                    </span>
                                                </div>
                                                <div class="text-right">
                                                    <span class="text-xs font-semibold inline-block text-green-600">
                                                        {{ round($experienceLevel['progress']) }}%
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-green-100">
                                                <div style="width:{{ $experienceLevel['progress'] }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500 transition-all duration-500"></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-2">
                                        <a href="{{ route('trainer.profile') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-150">
                                            View Full Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Session Performance Card -->
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                    <h2 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                        Session Performance
                                    </h2>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Analytics for your sessions</p>
                                </div>
                                
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="space-y-6">
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500">Overall Attendance Rate</h4>
                                            <div class="mt-2 relative pt-1">
                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <span class="text-2xl font-bold text-green-600">{{ $attendanceRate }}%</span>
                                                    </div>
                                                </div>
                                                <div class="mt-2 overflow-hidden h-2 text-xs flex rounded-full bg-green-100">
                                                    <div style="width:{{ min(100, $attendanceRate) }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500 transition-all duration-500"></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500">Popular Session Types</h4>
                                            <div class="mt-3 space-y-3">
                                                <!-- Replace with actual data from your controller -->
                                                <div class="relative">
                                                    <div class="flex items-center justify-between text-sm">
                                                        <div class="flex items-center">
                                                            <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                                                            <span class="text-gray-700">Cardio</span>
                                                        </div>
                                                        <span class="text-gray-900 font-medium">35%</span>
                                                    </div>
                                                    <div class="mt-1 overflow-hidden h-1.5 text-xs flex rounded-full bg-green-100">
                                                        <div style="width:35%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500"></div>
                                                    </div>
                                                </div>
                                                
                                                <div class="relative">
                                                    <div class="flex items-center justify-between text-sm">
                                                        <div class="flex items-center">
                                                            <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                                                            <span class="text-gray-700">Strength</span>
                                                        </div>
                                                        <span class="text-gray-900 font-medium">25%</span>
                                                    </div>
                                                    <div class="mt-1 overflow-hidden h-1.5 text-xs flex rounded-full bg-blue-100">
                                                        <div style="width:25%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
                                                    </div>
                                                </div>
                                                
                                                <div class="relative">
                                                    <div class="flex items-center justify-between text-sm">
                                                        <div class="flex items-center">
                                                            <div class="w-3 h-3 rounded-full bg-purple-500 mr-2"></div>
                                                            <span class="text-gray-700">Yoga</span>
                                                        </div>
                                                        <span class="text-gray-900 font-medium">20%</span>
                                                    </div>
                                                    <div class="mt-1 overflow-hidden h-1.5 text-xs flex rounded-full bg-purple-100">
                                                        <div style="width:20%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-purple-500"></div>
                                                    </div>
                                                </div>
                                                
                                                <div class="relative">
                                                    <div class="flex items-center justify-between text-sm">
                                                        <div class="flex items-center">
                                                            <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                                                            <span class="text-gray-700">HIIT</span>
                                                        </div>
                                                        <span class="text-gray-900 font-medium">20%</span>
                                                    </div>
                                                    <div class="mt-1 overflow-hidden h-1.5 text-xs flex rounded-full bg-yellow-100">
                                                        <div style="width:20%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-yellow-500"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="pt-4 border-t border-gray-200">
                                            <a href="#" class="text-sm font-medium text-green-600 hover:text-green-500 flex items-center justify-center">
                                                <svg class="mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v6a1 1 0 102 0V8z" clip-rule="evenodd" />
                                                </svg>
                                                View detailed analytics
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Quick Actions Card -->
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                    <h2 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                        Quick Actions
                                    </h2>
                                </div>
                                
                                <div class="grid grid-cols-2 divide-x divide-y divide-gray-200">
                                    <a href="{{ route('trainer.sessions.create') }}" class="text-center p-4 hover:bg-gray-50 flex flex-col items-center justify-center transition-colors duration-150">
                                        <div class="bg-green-100 rounded-full p-2 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">Create Session</span>
                                        <span class="text-xs text-gray-500 mt-1">Add a new class</span>
                                    </a>
                                    
                                    <a href="{{ route('trainer.sessions.index') }}" class="text-center p-4 hover:bg-gray-50 flex flex-col items-center justify-center transition-colors duration-150">
                                        <div class="bg-blue-100 rounded-full p-2 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">Manage Attendance</span>
                                        <span class="text-xs text-gray-500 mt-1">Track class checkins</span>
                                    </a>
                                    
                                    <a href="{{ route('trainer.schedule.index') }}" class="text-center p-4 hover:bg-gray-50 flex flex-col items-center justify-center transition-colors duration-150">
                                        <div class="bg-purple-100 rounded-full p-2 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">Update Schedule</span>
                                        <span class="text-xs text-gray-500 mt-1">Manage your slots</span>
                                    </a>
                                    
                                    <a href="{{ route('trainer.members') }}" class="text-center p-4 hover:bg-gray-50 flex flex-col items-center justify-center transition-colors duration-150">
                                        <div class="bg-yellow-100 rounded-full p-2 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900">View Members</span>
                                        <span class="text-xs text-gray-500 mt-1">Manage your clients</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Generate QR Code
        const qrData = @json($qrData);
        const qrContainer = document.getElementById('dashboardQrcode');
        
        if (qrContainer) {
            new QRCode(qrContainer, {
                text: JSON.stringify(qrData),
                width: 100,
                height: 100,
                colorDark: "#16A34A", // Green color
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        }
    });
</script>
@endsection
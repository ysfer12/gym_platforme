@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('partials.receptionist-sidebar')
        
        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <!-- Welcome Banner with Reception Info -->
            <div class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white shadow-lg">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex-1 min-w-0">
                            <h2 class="text-2xl font-bold leading-7 sm:text-3xl sm:truncate">
                                Welcome back, {{ Auth::user()->firstname }}!
                            </h2>
                            <div class="mt-2 flex items-center text-sm text-blue-100">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-700 text-blue-100">
                                    <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Front Desk Status: Online
                                </span>
                                <span class="ml-2 text-sm">{{ now()->format('l, F j, Y') }}</span>
                            </div>
                        </div>
                        <div class="mt-4 flex md:mt-0 md:ml-4 space-x-3">
                            <a href="{{ route('receptionist.subscriptions.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:ring-offset-indigo-600 transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                                New Subscription
                            </a>
                            <a href="{{ route('receptionist.attendances.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-indigo-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:ring-offset-indigo-600 transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Record Attendance
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Today's Check-ins -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100 hover:shadow-md transition-all duration-200">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Today's Check-ins
                                        </dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">
                                                {{ $todayCheckIns ?? 0 }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3 border-t border-gray-100">
                            <div class="text-sm">
                                <a href="{{ route('receptionist.attendances.index') }}" class="font-medium text-indigo-600 hover:text-indigo-500 flex items-center justify-between">
                                    <span>View attendances</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Active Members -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100 hover:shadow-md transition-all duration-200">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Active Members
                                        </dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">
                                                {{ $activeMembers ?? 0 }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3 border-t border-gray-100">
                            <div class="text-sm">
                                <a href="{{ route('receptionist.members') }}" class="font-medium text-indigo-600 hover:text-indigo-500 flex items-center justify-between">
                                    <span>View members</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Today's Revenue -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100 hover:shadow-md transition-all duration-200">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Today's Revenue
                                        </dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">
                                                ${{ number_format($todayRevenue ?? 0, 2) }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3 border-t border-gray-100">
                            <div class="text-sm">
                                <a href="{{ route('receptionist.payments.index') }}" class="font-medium text-indigo-600 hover:text-indigo-500 flex items-center justify-between">
                                    <span>View payments</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sessions Today -->
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100 hover:shadow-md transition-all duration-200">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Sessions Today
                                        </dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">
                                                {{ $todaySessions ?? 0 }}
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3 border-t border-gray-100">
                            <div class="text-sm">
                                <a href="{{ route('receptionist.sessions.index') }}" class="font-medium text-indigo-600 hover:text-indigo-500 flex items-center justify-between">
                                    <span>View sessions</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid with 2 columns for desktop -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column - Today's Sessions & Recent Check-ins -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Today's Sessions Section -->
                        <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                            <div class="px-4 py-5 sm:px-6 flex justify-between items-center bg-gray-50 border-b border-gray-100">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Today's Sessions
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Sessions scheduled for today</p>
                                </div>
                                <a href="{{ route('receptionist.sessions.index') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-900">
                                    View all
                                    <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                            
                            @if(isset($todaySessionsList) && $todaySessionsList->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Session
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Time
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Trainer
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Attendance
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach($todaySessionsList as $session)
                                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900">{{ $session->title }}</div>
                                                        <div class="text-sm text-gray-500">{{ $session->type }} - {{ $session->level }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900 font-medium">
                                                            {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }} - 
                                                            {{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ $session->trainer->firstname }} {{ $session->trainer->lastname }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @php
                                                            $attendancePercent = ($session->attendances->count() / $session->max_capacity) * 100;
                                                            $bgColor = $attendancePercent >= 90 ? 'bg-red-100 text-red-800' : 
                                                                      ($attendancePercent >= 75 ? 'bg-yellow-100 text-yellow-800' : 
                                                                      'bg-green-100 text-green-800');
                                                        @endphp
                                                        <div class="flex items-center">
                                                            <span class="px-2 mr-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $bgColor }}">
                                                                {{ $session->attendances->count() }}/{{ $session->max_capacity }}
                                                            </span>
                                                            <div class="w-16 bg-gray-200 rounded-full h-2.5">
                                                                <div class="h-2.5 rounded-full {{ $bgColor }}" style="width: {{ min($attendancePercent, 100) }}%"></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="{{ route('receptionist.sessions.show', $session->id) }}" class="text-indigo-600 hover:text-indigo-900 inline-flex items-center">
                                                            <span>Manage</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="flex items-center justify-center h-40">
                                    <div class="text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No sessions scheduled for today</h3>
                                        <p class="mt-1 text-sm text-gray-500">Check the sessions calendar for upcoming events.</p>
    
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Recent Check-ins -->
                        <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                            <div class="px-4 py-5 sm:px-6 flex justify-between items-center bg-gray-50 border-b border-gray-100">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        Recent Check-ins
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Latest member activity</p>
                                </div>
                                <a href="{{ route('receptionist.attendances.index') }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-900">
                                    View all
                                    <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
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
                                                    Check-in Time
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Session
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @forelse($recentCheckIns ?? [] as $attendance)
                                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                                <span class="text-indigo-700 font-semibold">{{ substr($attendance->user->firstname, 0, 1) }}{{ substr($attendance->user->lastname, 0, 1) }}</span>
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">{{ $attendance->user->firstname }} {{ $attendance->user->lastname }}</div>
                                                                <div class="text-sm text-gray-500">{{ $attendance->user->email }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($attendance->entry_time)->format('h:i A') }}</div>
                                                        <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900">{{ $attendance->session->title }}</div>
                                                        <div class="text-sm text-gray-500">{{ $attendance->session->type }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($attendance->exit_time)
                                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                <svg class="mr-1 h-3 w-3 text-green-500" fill="currentColor" viewBox="0 0 8 8">
                                                                    <circle cx="4" cy="4" r="3" />
                                                                </svg>
                                                                Completed
                                                            </span>
                                                        @else
                                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                <svg class="mr-1 h-3 w-3 text-yellow-500" fill="currentColor" viewBox="0 0 8 8">
                                                                    <circle cx="4" cy="4" r="3" />
                                                                </svg>
                                                                Active
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="px-6 py-10 whitespace-nowrap text-center text-gray-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                        </svg>
                                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No recent check-ins</h3>
                                                        <a href="{{ route('receptionist.attendances.create') }}" class="mt-2 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                                            Record a check-in
                                                            <svg class="ml-1 h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Expiring Subscriptions Alert -->
                        <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                            <div class="px-4 py-5 sm:px-6 flex justify-between items-center bg-gray-50 border-b border-gray-100">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Subscription Alerts
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Subscriptions expiring soon</p>
                                </div>
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    {{ count($expiringSubscriptions ?? []) }} Expiring
                                </span>
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
                                                    Plan
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Expiry Date
                                                </th>
                                                <th scope="col" class="relative px-6 py-3">
                                                    <span class="sr-only">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @forelse($expiringSubscriptions ?? [] as $subscription)
                                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                                                <span class="text-red-700 font-semibold">{{ substr($subscription->user->firstname, 0, 1) }}{{ substr($subscription->user->lastname, 0, 1) }}</span>
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">{{ $subscription->user->firstname }} {{ $subscription->user->lastname }}</div>
                                                                <div class="text-sm text-gray-500">{{ $subscription->user->email }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900">{{ $subscription->type }}</div>
                                                        <div class="text-sm text-gray-500">${{ number_format($subscription->price, 2) }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($subscription->end_date)->format('M d, Y') }}</div>
                                                        <div class="text-sm text-red-500 font-medium">
                                                            {{ \Carbon\Carbon::parse($subscription->end_date)->diffForHumans() }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="{{ route('receptionist.subscriptions.edit', $subscription->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3 inline-flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                            </svg>
                                                            Renew
                                                        </a>
                                                        <a href="{{ route('receptionist.subscriptions.show', $subscription->id) }}" class="text-indigo-600 hover:text-indigo-900 inline-flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                            View
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="px-6 py-10 whitespace-nowrap text-center text-gray-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No subscriptions expiring soon</h3>
                                                        <p class="mt-1 text-sm text-gray-500">All memberships are in good standing.</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column - Quick Actions & Notifications -->
                    <div class="lg:col-span-1 space-y-8">
                        <!-- Quick Actions Card -->
                        <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                            <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-100">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Quick Actions
                                </h3>
                            </div>
                            <div class="border-t border-gray-200">
                                <div class="grid grid-cols-2 divide-x divide-y divide-gray-200">
                                    <a href="{{ route('receptionist.attendances.create') }}" class="text-center p-5 hover:bg-gray-50 transition-colors duration-200 flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-indigo-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700">Check In</span>
                                    </a>
                                    <a href="{{ route('receptionist.subscriptions.create') }}" class="text-center p-5 hover:bg-gray-50 transition-colors duration-200 flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-indigo-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700">New Subscription</span>
                                    </a>
                                    <a href="{{ route('receptionist.payments.create') }}" class="text-center p-5 hover:bg-gray-50 transition-colors duration-200 flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-indigo-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700">New Payment</span>
                                    </a>
                                    <a href="{{ route('receptionist.sessions.index') }}" class="text-center p-5 hover:bg-gray-50 transition-colors duration-200 flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-indigo-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-700">Book Session</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Notifications -->
                        <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                            <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-100">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                        Notifications
                                    </h3>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                        3 New
                                    </span>
                                </div>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                                <div class="flow-root">
                                    <ul role="list" class="-mb-8">
                                        <li>
                                            <div class="relative pb-8">
                                                <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                                <div class="relative flex items-start space-x-3">
                                                    <div class="relative">
                                                        <div class="h-10 w-10 rounded-full bg-indigo-500 flex items-center justify-center ring-4 ring-white">
                                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900">
                                                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">New subscription</a>
                                                            </div>
                                                            <p class="mt-0.5 text-sm text-gray-500">
                                                                Emma Johnson purchased a Basic 3-month plan
                                                            </p>
                                                        </div>
                                                        <div class="mt-2 text-sm text-gray-500">
                                                            <p class="flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                30 minutes ago
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        
                                        <li>
                                            <div class="relative pb-8">
                                                <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                                <div class="relative flex items-start space-x-3">
                                                    <div class="relative">
                                                        <div class="h-10 w-10 rounded-full bg-red-500 flex items-center justify-center ring-4 ring-white">
                                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900">
                                                                <a href="#" class="font-medium text-red-600 hover:text-red-500">Payment failure</a>
                                                            </div>
                                                            <p class="mt-0.5 text-sm text-gray-500">
                                                                Payment for Michael Brown's subscription failed
                                                            </p>
                                                        </div>
                                                        <div class="mt-2 text-sm text-gray-500">
                                                            <p class="flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                2 hours ago
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        
                                        <li>
                                            <div class="relative">
                                                <div class="relative flex items-start space-x-3">
                                                    <div class="relative">
                                                        <div class="h-10 w-10 rounded-full bg-green-500 flex items-center justify-center ring-4 ring-white">
                                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900">
                                                                <a href="#" class="font-medium text-green-600 hover:text-green-500">Session fully booked</a>
                                                            </div>
                                                            <p class="mt-0.5 text-sm text-gray-500">
                                                                "HIIT Training" session is now at full capacity
                                                            </p>
                                                        </div>
                                                        <div class="mt-2 text-sm text-gray-500">
                                                            <p class="flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                Yesterday
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt-6">
                                    <a href="#" class="w-full flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                                        View all notifications
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Revenue Overview -->
                        <div class="bg-white shadow-sm rounded-lg border border-gray-100 overflow-hidden">
                            <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-100">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    Revenue Overview
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Current month financial summary</p>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                                <dl>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <dt class="text-sm font-medium text-gray-500">Month to Date</dt>
                                            <dd class="mt-1 text-2xl font-semibold text-gray-900">${{ number_format($monthRevenue ?? 0, 2) }}</dd>
                                            <div class="mt-2 flex items-center text-sm">
                                                <span class="text-green-500 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                                    </svg>
                                                    12.5%
                                                </span>
                                                <span class="text-gray-500 ml-1">vs last month</span>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <dt class="text-sm font-medium text-gray-500">New Subscriptions</dt>
                                            <dd class="mt-1 text-2xl font-semibold text-gray-900">{{ $monthNewSubscriptions ?? 0 }}</dd>
                                            <div class="mt-2 flex items-center text-sm">
                                                <span class="text-green-500 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                                    </svg>
                                                    8.3%
                                                </span>
                                                <span class="text-gray-500 ml-1">vs last month</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6">
                                        <dt class="text-sm font-medium text-gray-500 mb-2">Revenue Breakdown</dt>
                                        <dd class="mt-2">
                                            <div class="space-y-4">
                                                <div>
                                                    <div class="flex items-center justify-between">
                                                        <div class="text-sm font-medium text-gray-900 flex items-center">
                                                            <span class="h-3 w-3 bg-indigo-500 rounded-full mr-2"></span>
                                                            Basic Plans
                                                        </div>
                                                        <div class="text-sm font-medium text-gray-900">40%</div>
                                                    </div>
                                                    <div class="mt-1 w-full bg-gray-200 rounded-full h-2.5">
                                                        <div class="bg-indigo-500 h-2.5 rounded-full" style="width: 40%"></div>
                                                    </div>
                                                </div>
                                                
                                                <div>
                                                    <div class="flex items-center justify-between">
                                                        <div class="text-sm font-medium text-gray-900 flex items-center">
                                                            <span class="h-3 w-3 bg-purple-500 rounded-full mr-2"></span>
                                                            Premium Plans
                                                        </div>
                                                        <div class="text-sm font-medium text-gray-900">35%</div>
                                                    </div>
                                                    <div class="mt-1 w-full bg-gray-200 rounded-full h-2.5">
                                                        <div class="bg-purple-500 h-2.5 rounded-full" style="width: 35%"></div>
                                                    </div>
                                                </div>
                                                
                                                <div>
                                                    <div class="flex items-center justify-between">
                                                        <div class="text-sm font-medium text-gray-900 flex items-center">
                                                            <span class="h-3 w-3 bg-green-500 rounded-full mr-2"></span>
                                                            Elite Plans
                                                        </div>
                                                        <div class="text-sm font-medium text-gray-900">25%</div>
                                                    </div>
                                                    <div class="mt-1 w-full bg-gray-200 rounded-full h-2.5">
                                                        <div class="bg-green-500 h-2.5 rounded-full" style="width: 25%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </dd>
                                    </div>
                                </dl>
                                <div class="mt-6">
                                    <a href="{{ route('receptionist.payments.index') }}" class="w-full flex justify-center items-center px-4 py-2 border border-indigo-600 shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-200">
                                        View detailed reports
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Mobile menu functionality
    document.addEventListener('DOMContentLoaded', function() {
        const openSidebarButton = document.getElementById('open-sidebar');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const closeMenuButton = document.getElementById('close-mobile-menu');
        const closeMenuXButton = document.getElementById('close-mobile-menu-x');
        
        if (openSidebarButton && mobileMenu && mobileMenuOverlay) {
            // Open menu
            openSidebarButton.addEventListener('click', function() {
                mobileMenu.classList.remove('hidden');
                mobileMenu.classList.remove('-translate-x-full');
                mobileMenuOverlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            });
            
            // Close menu functions
            const closeMenu = function() {
                mobileMenu.classList.add('-translate-x-full');
                setTimeout(function() {
                    mobileMenu.classList.add('hidden');
                    mobileMenuOverlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }, 300);
            };
            
            // Close with buttons
            if (closeMenuButton) closeMenuButton.addEventListener('click', closeMenu);
            if (closeMenuXButton) closeMenuXButton.addEventListener('click', closeMenu);
            if (mobileMenuOverlay) mobileMenuOverlay.addEventListener('click', closeMenu);
        }
        
        // Add animation to stat cards
        const animateStatCards = () => {
            const statCards = document.querySelectorAll('.overflow-hidden.shadow-sm.rounded-lg');
            statCards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('transform', 'transition');
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        };
        
        // Initialize with opacity 0 and transform
        const statCards = document.querySelectorAll('.overflow-hidden.shadow-sm.rounded-lg');
        statCards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(10px)';
        });
        
        // Animate after a short delay
        setTimeout(animateStatCards, 300);
    });
</script>
@endsection
@endsection
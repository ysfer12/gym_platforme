@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('partials.receptionist-sidebar')
        
        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <!-- Welcome Banner with Reception Info -->
            <div class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex-1 min-w-0">
                            <h2 class="text-2xl font-bold leading-7 sm:text-3xl sm:truncate">
                                Welcome back, {{ Auth::user()->firstname }}!
                            </h2>
                            <div class="mt-2 flex items-center text-sm text-blue-100">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-blue-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <p>
                                    <span class="font-semibold">Front Desk Status: </span> Online
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 flex md:mt-0 md:ml-4 space-x-3">
                            <a href="{{ route('receptionist.subscriptions.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:ring-offset-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                                New Subscription
                            </a>
                            <a href="{{ route('receptionist.attendances.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:ring-offset-blue-600">
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
                    <div class="bg-white overflow-hidden shadow rounded-lg">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
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
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                                <a href="{{ route('receptionist.attendances.index') }}" class="font-medium text-blue-600 hover:text-blue-500">View all attendances</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Active Members -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
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
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                                <a href="{{ route('receptionist.members') }}" class="font-medium text-blue-600 hover:text-blue-500">View all members</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Today's Revenue -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
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
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                                <a href="{{ route('receptionist.payments.index') }}" class="font-medium text-blue-600 hover:text-blue-500">View all payments</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sessions Today -->
                    <div class="bg-white overflow-hidden shadow rounded-lg">
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
                        <div class="bg-gray-50 px-5 py-3">
                            <div class="text-sm">
                                <a href="{{ route('receptionist.sessions.index') }}" class="font-medium text-blue-600 hover:text-blue-500">View all sessions</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid with 2 columns for desktop -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column - Today's Sessions & Recent Check-ins -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Today's Sessions Section -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Today's Sessions</h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Sessions scheduled for today</p>
                                </div>
                                <a href="{{ route('receptionist.sessions.index') }}" class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-900">
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
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm font-medium text-gray-900">{{ $session->title }}</div>
                                                        <div class="text-sm text-gray-500">{{ $session->type }} - {{ $session->level }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">
                                                            {{ \Carbon\Carbon::parse($session->start_time)->format('h:i A') }} - 
                                                            {{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ $session->trainer->firstname }} {{ $session->trainer->lastname }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            {{ $session->attendances->count() }}/{{ $session->max_capacity }}
                                                        </span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="{{ route('receptionist.sessions.show', $session->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Manage</a>
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
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Check-ins</h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Latest member activity</p>
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
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                                <span class="text-blue-700 font-semibold">{{ substr($attendance->user->firstname, 0, 1) }}{{ substr($attendance->user->lastname, 0, 1) }}</span>
                                                            </div>
                                                            <div class="ml-4">
                                                                <div class="text-sm font-medium text-gray-900">{{ $attendance->user->firstname }} {{ $attendance->user->lastname }}</div>
                                                                <div class="text-sm text-gray-500">{{ $attendance->user->email }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($attendance->entry_time)->format('h:i A') }}</div>
                                                        <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ $attendance->session->title }}</div>
                                                        <div class="text-sm text-gray-500">{{ $attendance->session->type }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        @if($attendance->exit_time)
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                Completed
                                                            </span>
                                                        @else
                                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                Active
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                                        No recent check-ins found
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Expiring Subscriptions Alert -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Subscription Alerts</h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Subscriptions expiring soon</p>
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
                                                <tr>
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
                                                        <div class="text-sm text-gray-900">{{ $subscription->type }}</div>
                                                        <div class="text-sm text-gray-500">${{ number_format($subscription->price, 2) }}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($subscription->end_date)->format('M d, Y') }}</div>
                                                        <div class="text-sm text-red-500">
                                                            {{ \Carbon\Carbon::parse($subscription->end_date)->diffForHumans() }}
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="{{ route('receptionist.subscriptions.edit', $subscription->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                                            Renew
                                                        </a>
                                                        <a href="{{ route('receptionist.subscriptions.show', $subscription->id) }}" class="text-blue-600 hover:text-blue-900">
                                                            View
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                                        No subscriptions expiring soon
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
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Quick Actions</h3>
                            </div>
                            <div class="border-t border-gray-200">
                                <div class="grid grid-cols-2 divide-x divide-y divide-gray-200">
                                    <a href="{{ route('receptionist.attendances.create') }}" class="text-center p-4 hover:bg-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-blue-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <span class="text-sm text-gray-700">Check In</span>
                                    </a>
                                    <a href="{{ route('receptionist.subscriptions.create') }}" class="text-center p-4 hover:bg-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-blue-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                        </svg>
                                        <span class="text-sm text-gray-700">New Subscription</span>
                                    </a>
                                    <a href="{{ route('receptionist.payments.create') }}" class="text-center p-4 hover:bg-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-blue-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span class="text-sm text-gray-700">New Payment</span>
                                    </a>
                                    <a href="{{ route('receptionist.sessions.index') }}" class="text-center p-4 hover:bg-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-blue-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-sm text-gray-700">Book Session</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Notifications -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Notifications</h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Recent system alerts</p>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                                <div class="flow-root">
                                    <ul role="list" class="-mb-8">
                                        <li>
                                            <div class="relative pb-8">
                                                <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                                <div class="relative flex items-start space-x-3">
                                                    <div class="relative">
                                                        <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <div>
                                                            <div class="text-sm text-gray-800">
                                                                <a href="#" class="font-medium text-gray-900">New subscription</a>
                                                            </div>
                                                            <p class="mt-0.5 text-sm text-gray-500">
                                                                Emma Johnson purchased a Basic 3-month plan
                                                            </p>
                                                        </div>
                                                        <div class="mt-2 text-sm text-gray-500">
                                                            <p>30 minutes ago</p>
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
                                                        <div class="h-10 w-10 rounded-full bg-red-500 flex items-center justify-center ring-8 ring-white">
                                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <div>
                                                            <div class="text-sm text-gray-800">
                                                                <a href="#" class="font-medium text-gray-900">Payment failure</a>
                                                            </div>
                                                            <p class="mt-0.5 text-sm text-gray-500">
                                                                Payment for Michael Brown's subscription failed
                                                            </p>
                                                        </div>
                                                        <div class="mt-2 text-sm text-gray-500">
                                                            <p>2 hours ago</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        
                                        <li>
                                            <div class="relative pb-8">
                                                <div class="relative flex items-start space-x-3">
                                                    <div class="relative">
                                                        <div class="h-10 w-10 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <div>
                                                            <div class="text-sm text-gray-800">
                                                                <a href="#" class="font-medium text-gray-900">Session fully booked</a>
                                                            </div>
                                                            <p class="mt-0.5 text-sm text-gray-500">
                                                                "HIIT Training" session is now at full capacity
                                                            </p>
                                                        </div>
                                                        <div class="mt-2 text-sm text-gray-500">
                                                            <p>Yesterday</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt-6 text-center">
                                    <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500">View all notifications</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Revenue Overview -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Revenue Overview</h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Current month financial summary</p>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                                <dl>
                                    <div class="sm:grid sm:grid-cols-2 sm:gap-4">
                                        <div class="flex flex-col">
                                            <dt class="text-sm font-medium text-gray-500">Month to Date</dt>
                                            <dd class="mt-1 text-2xl font-semibold text-gray-900">${{ number_format($monthRevenue ?? 0, 2) }}</dd>
                                        </div>
                                        <div class="flex flex-col mt-4 sm:mt-0">
                                            <dt class="text-sm font-medium text-gray-500">New Subscriptions</dt>
                                            <dd class="mt-1 text-2xl font-semibold text-gray-900">{{ $monthNewSubscriptions ?? 0 }}</dd>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6">
                                        <dt class="text-sm font-medium text-gray-500">Revenue Breakdown</dt>
                                        <dd class="mt-2">
                                            <div class="space-y-4">
                                                <div>
                                                    <div class="flex items-center justify-between">
                                                        <div class="text-sm font-medium text-gray-900">Basic Plans</div>
                                                        <div class="text-sm font-medium text-gray-900">40%</div>
                                                    </div>
                                                    <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                                                        <div class="bg-blue-500 h-2 rounded-full" style="width: 40%"></div>
                                                    </div>
                                                </div>
                                                
                                                <div>
                                                    <div class="flex items-center justify-between">
                                                        <div class="text-sm font-medium text-gray-900">Premium Plans</div>
                                                        <div class="text-sm font-medium text-gray-900">35%</div>
                                                    </div>
                                                    <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                                                        <div class="bg-purple-500 h-2 rounded-full" style="width: 35%"></div>
                                                    </div>
                                                </div>
                                                
                                                <div>
                                                    <div class="flex items-center justify-between">
                                                        <div class="text-sm font-medium text-gray-900">Elite Plans</div>
                                                        <div class="text-sm font-medium text-gray-900">25%</div>
                                                    </div>
                                                    <div class="mt-1 w-full bg-gray-200 rounded-full h-2">
                                                        <div class="bg-green-500 h-2 rounded-full" style="width: 25%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </dd>
                                    </div>
                                </dl>
                                <div class="mt-6 text-center">
                                    <a href="{{ route('receptionist.payments.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">View detailed reports</a>
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
    });
</script>
@endsection
@endsection
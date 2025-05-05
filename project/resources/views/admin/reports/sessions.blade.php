@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Include the admin sidebar -->
        @include('partials.admin-sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Page Header -->
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-md">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-bold">Session Reports</h1>
                            <p class="mt-1 text-indigo-100">Analyze session performance, attendance, and popularity</p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.reports.sessions') }}" 
                            class="inline-flex items-center px-4 py-2 border border-white border-opacity-20 rounded-lg shadow-sm text-sm font-medium text-white bg-white bg-opacity-10 hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-orange-500 focus:ring-white transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Refresh Report
                            </a>
                            <button type="button" onclick="window.print()" 
                            class="inline-flex items-center px-4 py-2 border border-white border-opacity-20 rounded-lg shadow-sm text-sm font-medium text-white bg-white bg-opacity-10 hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-orange-500 focus:ring-white transition-all duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                Print Report
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Date Range Filter -->
            <div class="max-w-7xl mx-auto pt-6 px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                    <form action="{{ route('admin.reports.sessions') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ request('start_date', now()->subMonth()->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ request('end_date', now()->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Apply Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Report Content -->
            <div class="max-w-7xl mx-auto pb-6 px-4 sm:px-6 lg:px-8">
                <!-- Session Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Sessions Card -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-indigo-100 p-3 mr-4">
                                <svg class="h-8 w-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-gray-500 text-sm">Total Sessions</div>
                                <div class="text-2xl font-bold text-gray-900">{{ count($sessions) }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Attendance Card -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-green-100 p-3 mr-4">
                                <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-gray-500 text-sm">Total Attendance</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $totalAttendance }}</div>
                                <div class="text-sm text-gray-500">
                                    Avg. {{ count($sessions) > 0 ? number_format($totalAttendance / count($sessions), 1) : 'N/A' }} per session
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Average Capacity Card -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-blue-100 p-3 mr-4">
                                <svg class="h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-gray-500 text-sm">Avg. Capacity</div>
                                <div class="text-2xl font-bold text-gray-900">{{ number_format($avgCapacityPercentage, 1) }}%</div>
                                <div class="text-sm text-gray-500">
                                    Total fill rate
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sessions by Time of Day -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-purple-100 p-3 mr-4">
                                <svg class="h-8 w-8 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="grid grid-cols-3 gap-1 text-xs">
                                    <div>
                                        <div class="text-gray-500">Morning</div>
                                        <div class="font-bold text-gray-900">{{ $morningSessionsCount }}</div>
                                    </div>
                                    <div>
                                        <div class="text-gray-500">Afternoon</div>
                                        <div class="font-bold text-gray-900">{{ $afternoonSessionsCount }}</div>
                                    </div>
                                    <div>
                                        <div class="text-gray-500">Evening</div>
                                        <div class="font-bold text-gray-900">{{ $eveningSessionsCount }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Session Type Distribution Chart -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Sessions by Type -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-lg font-medium text-gray-900">Sessions by Type</h2>
                        </div>
                        <div class="p-6">
                            <div style="height: 300px; position: relative;">
                                <!-- Static Sessions by Type Chart -->
                                <div class="w-full h-full bg-white">
                                    <svg width="100%" height="100%" viewBox="0 0 800 300" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="800" height="300" fill="#fff" />
                                        
                                        <!-- Chart title -->
                                        <text x="400" y="30" font-family="sans-serif" font-size="16" fill="#1f2937" text-anchor="middle" font-weight="bold">Session Types Distribution</text>
                                        
                                        <!-- Pie chart -->
                                        <g transform="translate(170, 150)">
                                            <!-- Cardio slice - 20% -->
                                            <path d="M0,0 L0,-100 A100,100 0 0,1 58.8,81.0 Z" fill="#f472b6" />
                                            
                                            <!-- Strength slice - 25% -->
                                            <path d="M0,0 L58.8,81.0 A100,100 0 0,1 -34.2,93.9 Z" fill="#3b82f6" />
                                            
                                            <!-- Yoga slice - 15% -->
                                            <path d="M0,0 L-34.2,93.9 A100,100 0 0,1 -93.9,-34.2 Z" fill="#10b981" />
                                            
                                            <!-- HIIT slice - 18% -->
                                            <path d="M0,0 L-93.9,-34.2 A100,100 0 0,1 -30.9,-95.1 Z" fill="#f97316" />
                                            
                                            <!-- Other slice - 22% -->
                                            <path d="M0,0 L-30.9,-95.1 A100,100 0 0,1 0,-100 Z" fill="#8b5cf6" />
                                        </g>
                                        
                                        <!-- Legend -->
                                        <g transform="translate(400, 80)">
                                            <!-- Cardio -->
                                            <rect x="0" y="0" width="16" height="16" rx="2" fill="#f472b6" />
                                            <text x="24" y="12" font-family="sans-serif" font-size="14" fill="#4b5563">Cardio (20%)</text>
                                            
                                            <!-- Strength -->
                                            <rect x="0" y="30" width="16" height="16" rx="2" fill="#3b82f6" />
                                            <text x="24" y="42" font-family="sans-serif" font-size="14" fill="#4b5563">Strength (25%)</text>
                                            
                                            <!-- Yoga -->
                                            <rect x="0" y="60" width="16" height="16" rx="2" fill="#10b981" />
                                            <text x="24" y="72" font-family="sans-serif" font-size="14" fill="#4b5563">Yoga (15%)</text>
                                            
                                            <!-- HIIT -->
                                            <rect x="0" y="90" width="16" height="16" rx="2" fill="#f97316" />
                                            <text x="24" y="102" font-family="sans-serif" font-size="14" fill="#4b5563">HIIT (18%)</text>
                                            
                                            <!-- Other -->
                                            <rect x="0" y="120" width="16" height="16" rx="2" fill="#8b5cf6" />
                                            <text x="24" y="132" font-family="sans-serif" font-size="14" fill="#4b5563">Others (22%)</text>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance by Day of Week -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-lg font-medium text-gray-900">Attendance by Day of Week</h2>
                        </div>
                        <div class="p-6">
                            <div style="height: 300px; position: relative;">
                                <!-- Static Attendance by Day of Week Chart -->
                                <div class="w-full h-full bg-white">
                                    <svg width="100%" height="100%" viewBox="0 0 800 300" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="800" height="300" fill="#fff" />
                                        <!-- Axes -->
                                        <line x1="50" y1="250" x2="750" y2="250" stroke="#e5e7eb" stroke-width="2" />
                                        <line x1="50" y1="50" x2="50" y2="250" stroke="#e5e7eb" stroke-width="2" />
                                        
                                        <!-- Horizontal grid lines -->
                                        <line x1="50" y1="210" x2="750" y2="210" stroke="#f3f4f6" stroke-width="1" />
                                        <line x1="50" y1="170" x2="750" y2="170" stroke="#f3f4f6" stroke-width="1" />
                                        <line x1="50" y1="130" x2="750" y2="130" stroke="#f3f4f6" stroke-width="1" />
                                        <line x1="50" y1="90" x2="750" y2="90" stroke="#f3f4f6" stroke-width="1" />
                                        
                                        <!-- X Axis labels (days of week) -->
                                        <text x="130" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Monday</text>
                                        <text x="230" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Tuesday</text>
                                        <text x="330" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Wednesday</text>
                                        <text x="430" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Thursday</text>
                                        <text x="530" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Friday</text>
                                        <text x="630" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Saturday</text>
                                        <text x="730" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Sunday</text>
                                        
                                        <!-- Y Axis labels -->
                                        <text x="40" y="250" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">0</text>
                                        <text x="40" y="210" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">5</text>
                                        <text x="40" y="170" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">10</text>
                                        <text x="40" y="130" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">15</text>
                                        <text x="40" y="90" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">20</text>
                                        <text x="40" y="50" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">25</text>
                                        
                                        <!-- Chart title -->
                                        <text x="400" y="30" font-family="sans-serif" font-size="16" fill="#1f2937" text-anchor="middle" font-weight="bold">Average Attendance by Day of Week</text>
                                        
                                        <!-- Bar chart -->
                                        <rect x="100" y="170" width="60" height="80" fill="rgba(79, 70, 229, 0.7)" rx="2" />
                                        <rect x="200" y="150" width="60" height="100" fill="rgba(79, 70, 229, 0.7)" rx="2" />
                                        <rect x="300" y="130" width="60" height="120" fill="rgba(79, 70, 229, 0.7)" rx="2" />
                                        <rect x="400" y="150" width="60" height="100" fill="rgba(79, 70, 229, 0.7)" rx="2" />
                                        <rect x="500" y="180" width="60" height="70" fill="rgba(79, 70, 229, 0.7)" rx="2" />
                                        <rect x="600" y="110" width="60" height="140" fill="rgba(79, 70, 229, 0.7)" rx="2" />
                                        <rect x="700" y="130" width="60" height="120" fill="rgba(79, 70, 229, 0.7)" rx="2" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trainer Performance -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Trainer Performance</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Trainer
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sessions Conducted
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total Attendance
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Avg. Attendance
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Capacity Filled
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Popular Session Types
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($sessionsByTrainer as $trainerData)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                    <span class="text-indigo-800 font-bold">
                                                        {{ substr($trainerData->trainer->firstname ?? '', 0, 1) }}{{ substr($trainerData->trainer->lastname ?? '', 0, 1) }}
                                                    </span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $trainerData->trainer->firstname ?? '' }} {{ $trainerData->trainer->lastname ?? '' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $trainerData->count }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $trainerAttendance[$trainerData->trainer_id] ?? 0 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @php
                                                $avgAttendance = 0;
                                                if ($trainerData->count > 0) {
                                                    $avgAttendance = ($trainerAttendance[$trainerData->trainer_id] ?? 0) / $trainerData->count;
                                                }
                                            @endphp
                                            {{ number_format($avgAttendance, 1) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @php
                                                $capacityRate = 0;
                                                if (isset($trainerCapacity[$trainerData->trainer_id]) && $trainerCapacity[$trainerData->trainer_id] > 0) {
                                                    $capacityRate = (($trainerAttendance[$trainerData->trainer_id] ?? 0) / $trainerCapacity[$trainerData->trainer_id]) * 100;
                                                }
                                            @endphp
                                            {{ number_format($capacityRate, 1) }}%
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if(isset($trainerPopularTypes[$trainerData->trainer_id]))
                                                @foreach($trainerPopularTypes[$trainerData->trainer_id] as $type => $count)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        @if($type == 'Cardio') bg-pink-100 text-pink-800
                                                        @elseif($type == 'Strength') bg-blue-100 text-blue-800
                                                        @elseif($type == 'Yoga') bg-green-100 text-green-800
                                                        @elseif($type == 'HIIT') bg-orange-100 text-orange-800
                                                        @elseif($type == 'Pilates') bg-purple-100 text-purple-800
                                                        @elseif($type == 'Cycling') bg-yellow-100 text-yellow-800
                                                        @elseif($type == 'Zumba') bg-red-100 text-red-800
                                                        @elseif($type == 'CrossFit') bg-indigo-100 text-indigo-800
                                                        @else bg-gray-100 text-gray-800 @endif mr-1 mb-1">
                                                        {{ $type }} ({{ $count }})
                                                    </span>
                                                @endforeach
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Most Popular Sessions -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Most Popular Sessions</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Rank
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Session Title
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Trainer
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date & Time
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Attendance
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Capacity Filled
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($popularSessions as $index => $session)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $session->title }}
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
                                            {{ $session->trainer->firstname ?? '' }} {{ $session->trainer->lastname ?? '' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($session->date)->format('M d, Y') }}<br>
                                            {{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($session->end_time)->format('g:i A') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $session->attendances_count }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @php
                                                $capacityRate = 0;
                                                if ($session->max_capacity > 0) {
                                                    $capacityRate = ($session->attendances_count / $session->max_capacity) * 100;
                                                }
                                            @endphp
                                            <div class="flex items-center">
                                                <span class="mr-2">{{ number_format($capacityRate, 1) }}%</span>
                                                <div class="w-full bg-gray-200 rounded-full h-2">
                                                    <div class="{{ $capacityRate >= 90 ? 'bg-red-500' : ($capacityRate >= 70 ? 'bg-yellow-500' : 'bg-green-500') }} h-2 rounded-full" style="width: {{ $capacityRate }}%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Time Slot Analysis -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Time Slot Analysis</h2>
                    </div>
                    <div class="p-6">
                        <div style="height: 300px; position: relative;">
                            <!-- Static Time Slot Analysis Chart -->
                            <div class="w-full h-full bg-white">
                                <svg width="100%" height="100%" viewBox="0 0 800 300" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="800" height="300" fill="#fff" />
                                    <!-- Axes -->
                                    <line x1="50" y1="250" x2="750" y2="250" stroke="#e5e7eb" stroke-width="2" />
                                    <line x1="50" y1="50" x2="50" y2="250" stroke="#e5e7eb" stroke-width="2" />
                                    
                                    <!-- Horizontal grid lines -->
                                    <line x1="50" y1="210" x2="750" y2="210" stroke="#f3f4f6" stroke-width="1" />
                                    <line x1="50" y1="170" x2="750" y2="170" stroke="#f3f4f6" stroke-width="1" />
                                    <line x1="50" y1="130" x2="750" y2="130" stroke="#f3f4f6" stroke-width="1" />
                                    <line x1="50" y1="90" x2="750" y2="90" stroke="#f3f4f6" stroke-width="1" />
                                    
                                    <!-- X Axis labels (hour of day) -->
                                    <text x="80" y="270" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="middle">6 AM</text>
                                    <text x="135" y="270" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="middle">7 AM</text>
                                    <text x="190" y="270" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="middle">8 AM</text>
                                    <text x="245" y="270" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="middle">9 AM</text>
                                    <text x="300" y="270" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="middle">10 AM</text>
                                    <text x="355" y="270" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="middle">11 AM</text>
                                    <text x="410" y="270" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="middle">12 PM</text>
                                    <text x="465" y="270" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="middle">1 PM</text>
                                    <text x="520" y="270" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="middle">4 PM</text>
                                    <text x="575" y="270" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="middle">5 PM</text>
                                    <text x="630" y="270" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="middle">6 PM</text>
                                    <text x="685" y="270" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="middle">7 PM</text>
                                    <text x="740" y="270" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="middle">8 PM</text>
                                    
                                    <!-- Y Axis labels (left - Attendance) -->
                                    <text x="40" y="250" font-family="sans-serif" font-size="10" fill="#10b981" text-anchor="end">0</text>
                                    <text x="40" y="210" font-family="sans-serif" font-size="10" fill="#10b981" text-anchor="end">5</text>
                                    <text x="40" y="170" font-family="sans-serif" font-size="10" fill="#10b981" text-anchor="end">10</text>
                                    <text x="40" y="130" font-family="sans-serif" font-size="10" fill="#10b981" text-anchor="end">15</text>
                                    <text x="40" y="90" font-family="sans-serif" font-size="10" fill="#10b981" text-anchor="end">20</text>
                                    <text x="40" y="50" font-family="sans-serif" font-size="10" fill="#10b981" text-anchor="end">25</text>
                                    
                                    <!-- Y Axis label (right - Sessions) -->
                                    <text x="760" y="250" font-family="sans-serif" font-size="10" fill="#4f46e5" text-anchor="start">0</text>
                                    <text x="760" y="210" font-family="sans-serif" font-size="10" fill="#4f46e5" text-anchor="start">2</text>
                                    <text x="760" y="170" font-family="sans-serif" font-size="10" fill="#4f46e5" text-anchor="start">4</text>
                                    <text x="760" y="130" font-family="sans-serif" font-size="10" fill="#4f46e5" text-anchor="start">6</text>
                                    <text x="760" y="90" font-family="sans-serif" font-size="10" fill="#4f46e5" text-anchor="start">8</text>
                                    <text x="760" y="50" font-family="sans-serif" font-size="10" fill="#4f46e5" text-anchor="start">10</text>
                                    
                                    <!-- Chart title -->
                                    <text x="400" y="30" font-family="sans-serif" font-size="16" fill="#1f2937" text-anchor="middle" font-weight="bold">Session Time Slot Analysis</text>
                                    
                                    <!-- Bar chart for session count -->
                                    <rect x="70" y="230" width="20" height="20" fill="rgba(79, 70, 229, 0.6)" rx="2" />
                                    <rect x="125" y="210" width="20" height="40" fill="rgba(79, 70, 229, 0.6)" rx="2" />
                                    <rect x="180" y="190" width="20" height="60" fill="rgba(79, 70, 229, 0.6)" rx="2" />
                                    <rect x="235" y="170" width="20" height="80" fill="rgba(79, 70, 229, 0.6)" rx="2" />
                                    <rect x="290" y="190" width="20" height="60" fill="rgba(79, 70, 229, 0.6)" rx="2" />
                                    <rect x="345" y="210" width="20" height="40" fill="rgba(79, 70, 229, 0.6)" rx="2" />
                                    <rect x="400" y="210" width="20" height="40" fill="rgba(79, 70, 229, 0.6)" rx="2" />
                                    <rect x="455" y="210" width="20" height="40" fill="rgba(79, 70, 229, 0.6)" rx="2" />
                                    <rect x="510" y="190" width="20" height="60" fill="rgba(79, 70, 229, 0.6)" rx="2" />
                                    <rect x="565" y="170" width="20" height="80" fill="rgba(79, 70, 229, 0.6)" rx="2" />
                                    <rect x="620" y="150" width="20" height="100" fill="rgba(79, 70, 229, 0.6)" rx="2" />
                                    <rect x="675" y="170" width="20" height="80" fill="rgba(79, 70, 229, 0.6)" rx="2" />
                                    <rect x="730" y="190" width="20" height="60" fill="rgba(79, 70, 229, 0.6)" rx="2" />
                                    
                                    <!-- Area for average attendance -->
                                    <defs>
                                        <linearGradient id="areaGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" stop-color="rgba(16, 185, 129, 0.4)" />
                                            <stop offset="100%" stop-color="rgba(16, 185, 129, 0.05)" />
                                        </linearGradient>
                                    </defs>
                                    <path d="M80,190 L135,170 L190,150 L245,130 L300,140 L355,160 L400,180 L455,170 L510,140 L565,120 L620,110 L675,120 L730,140 L730,250 L80,250 Z" fill="url(#areaGradient)" />
                                    
                                    <!-- Line for average attendance -->
                                    <path d="M80,190 L135,170 L190,150 L245,130 L300,140 L355,160 L400,180 L455,170 L510,140 L565,120 L620,110 L675,120 L730,140" fill="none" stroke="#10b981" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                                    
                                    <!-- Data points -->
                                    <circle cx="80" cy="190" r="4" fill="#10b981" />
                                    <circle cx="135" cy="170" r="4" fill="#10b981" />
                                    <circle cx="190" cy="150" r="4" fill="#10b981" />
                                    <circle cx="245" cy="130" r="4" fill="#10b981" />
                                    <circle cx="300" cy="140" r="4" fill="#10b981" />
                                    <circle cx="355" cy="160" r="4" fill="#10b981" />
                                    <circle cx="400" cy="180" r="4" fill="#10b981" />
                                    <circle cx="455" cy="170" r="4" fill="#10b981" />
                                    <circle cx="510" cy="140" r="4" fill="#10b981" />
                                    <circle cx="565" cy="120" r="4" fill="#10b981" />
                                    <circle cx="620" cy="110" r="4" fill="#10b981" />
                                    <circle cx="675" cy="120" r="4" fill="#10b981" />
                                    <circle cx="730" cy="140" r="4" fill="#10b981" />
                                    
                                    <!-- Legend -->
                                    <rect x="550" y="50" width="12" height="12" fill="rgba(79, 70, 229, 0.6)" rx="2" />
                                    <text x="568" y="60" font-family="sans-serif" font-size="12" fill="#4b5563">Number of Sessions</text>
                                    
                                    <line x1="650" y1="60" x2="670" y2="60" stroke="#10b981" stroke-width="3" />
                                    <circle cx="660" cy="60" r="4" fill="#10b981" />
                                    <text x="678" y="60" font-family="sans-serif" font-size="12" fill="#4b5563">Average Attendance</text>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        @include('partials.admin-mobile-menu')
    </div>
</div>
@endsection
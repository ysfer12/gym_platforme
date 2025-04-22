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
                        <div>
                            <h1 class="text-3xl font-bold">Session Reports</h1>
                            <p class="mt-1 text-indigo-100">Analyze session performance, attendance, and popularity</p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.reports.sessions') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-800 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Refresh Report
                            </a>
                            <button type="button" onclick="window.print()" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
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
                            <canvas id="sessionTypeChart" height="300"></canvas>
                        </div>
                    </div>

                    <!-- Sessions by Time of Day -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-lg font-medium text-gray-900">Attendance by Day of Week</h2>
                        </div>
                        <div class="p-6">
                            <canvas id="attendanceDayChart" height="300"></canvas>
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
                        <canvas id="timeSlotAnalysisChart" height="300"></canvas>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Session Types Chart
        const typeCtx = document.getElementById('sessionTypeChart').getContext('2d');
        const typeLabels = @json(array_column($sessionsByType->toArray(), 'type'));
        const typeData = @json(array_column($sessionsByType->toArray(), 'count'));
        
        const typeChart = new Chart(typeCtx, {
            type: 'pie',
            data: {
                labels: typeLabels,
                datasets: [{
                    data: typeData,
                    backgroundColor: [
                        'rgba(244, 114, 182, 0.7)', // Pink for Cardio
                        'rgba(59, 130, 246, 0.7)',  // Blue for Strength
                        'rgba(16, 185, 129, 0.7)',  // Green for Yoga
                        'rgba(249, 115, 22, 0.7)',  // Orange for HIIT
                        'rgba(139, 92, 246, 0.7)',  // Purple for Pilates
                        'rgba(245, 158, 11, 0.7)',  // Yellow for Cycling
                        'rgba(239, 68, 68, 0.7)',   // Red for Zumba
                        'rgba(79, 70, 229, 0.7)'    // Indigo for CrossFit
                    ],
                    borderColor: [
                        'rgba(244, 114, 182, 1)',
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(249, 115, 22, 1)',
                        'rgba(139, 92, 246, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(239, 68, 68, 1)',
                        'rgba(79, 70, 229, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: true,
                        text: 'Session Types Distribution'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} sessions (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
        
        // Attendance by Day of Week Chart
        const dayCtx = document.getElementById('attendanceDayChart').getContext('2d');
        
        const dayData = {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            datasets: [{
                label: 'Average Attendance',
                data: @json($attendanceByDay),
                backgroundColor: 'rgba(79, 70, 229, 0.2)',
                borderColor: 'rgba(79, 70, 229, 1)',
                borderWidth: 1
            }]
        };
        
        const dayChart = new Chart(dayCtx, {
            type: 'bar',
            data: dayData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Average Attendance by Day of Week'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Average Attendance'
                        }
                    }
                }
            }
        });
        
        // Time Slot Analysis Chart
        const timeCtx = document.getElementById('timeSlotAnalysisChart').getContext('2d');
        
        const timeData = {
            labels: @json(array_keys($attendanceByHour)),
            datasets: [
                {
                    label: 'Average Attendance',
                    data: @json(array_values($attendanceByHour)),
                    backgroundColor: 'rgba(16, 185, 129, 0.2)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 2,
                    type: 'line',
                    yAxisID: 'y',
                    tension: 0.3,
                    fill: true
                },
                {
                    label: 'Number of Sessions',
                    data: @json(array_values($sessionsByHour)),
                    backgroundColor: 'rgba(79, 70, 229, 0.6)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 1,
                    type: 'bar',
                    yAxisID: 'y1'
                }
            ]
        };
        
        const timeChart = new Chart(timeCtx, {
            type: 'bar',
            data: timeData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Session Time Slot Analysis'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Hour of Day'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        type: 'linear',
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Average Attendance'
                        }
                    },
                    y1: {
                        beginAtZero: true,
                        type: 'linear',
                        position: 'right',
                        grid: {
                            drawOnChartArea: false
                        },
                        title: {
                            display: true,
                            text: 'Number of Sessions'
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
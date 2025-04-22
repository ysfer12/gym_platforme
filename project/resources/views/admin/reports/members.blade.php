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
                            <h1 class="text-3xl font-bold">Member Reports</h1>
                            <p class="mt-1 text-indigo-100">Analyze member demographics, trends, and activity</p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.reports.members') }}" 
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

            <!-- Report Content -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <!-- Member Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Members Card -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-indigo-100 p-3 mr-4">
                                <svg class="h-8 w-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-gray-500 text-sm">Total Members</div>
                                <div class="text-2xl font-bold text-gray-900">{{ count($members) }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Active Members Card -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-green-100 p-3 mr-4">
                                <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-gray-500 text-sm">Active Members</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $activeMembers }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ round(($activeMembers / count($members)) * 100) }}% of total
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Inactive Members Card -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-red-100 p-3 mr-4">
                                <svg class="h-8 w-8 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-gray-500 text-sm">Inactive Members</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $inactiveMembers }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ round(($inactiveMembers / count($members)) * 100) }}% of total
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- New Members Card -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-blue-100 p-3 mr-4">
                                <svg class="h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-gray-500 text-sm">New This Month</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $newMembers }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Monthly Signups Chart -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Monthly Signups (Last 12 Months)</h2>
                    </div>
                    <div class="p-6">
                        <canvas id="signupsChart" height="300"></canvas>
                    </div>
                </div>

                <!-- Member Demographics -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Subscription Types Distribution -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-lg font-medium text-gray-900">Subscription Types Distribution</h2>
                        </div>
                        <div class="p-6">
                            <canvas id="subscriptionTypesChart" height="300"></canvas>
                        </div>
                    </div>

                    <!-- Activity Level Distribution -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-lg font-medium text-gray-900">Member Activity Levels</h2>
                        </div>
                        <div class="p-6">
                            <canvas id="activityLevelsChart" height="300"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Members with Most Attendance -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Top 10 Most Active Members</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Rank
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Member
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subscription Type
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Join Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sessions Attended
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($membersWithMostAttendance as $index => $member)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                    <span class="text-indigo-800 font-bold">
                                                        {{ substr($member->firstname, 0, 1) }}{{ substr($member->lastname, 0, 1) }}
                                                    </span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $member->firstname }} {{ $member->lastname }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $member->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $subscription = $member->subscriptions()->where('status', 'active')->first();
                                                $subscriptionType = $subscription ? $subscription->type : 'None';
                                                
                                                $badgeClass = 'bg-gray-100 text-gray-800';
                                                if ($subscriptionType === 'Basic') {
                                                    $badgeClass = 'bg-blue-100 text-blue-800';
                                                } elseif ($subscriptionType === 'Premium') {
                                                    $badgeClass = 'bg-purple-100 text-purple-800';
                                                } elseif ($subscriptionType === 'Elite') {
                                                    $badgeClass = 'bg-green-100 text-green-800';
                                                }
                                            @endphp
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
                                                {{ $subscriptionType }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($member->registrationDate)->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $member->attendances_count }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No attendance records found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Retention Analysis -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Member Retention Analysis</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <!-- Average Membership Duration -->
                            <div class="bg-indigo-50 rounded-lg p-4">
                                <p class="text-sm text-indigo-700 font-medium">Avg. Membership Duration</p>
                                <p class="text-2xl font-bold text-indigo-900">{{ $avgMembershipMonths }} months</p>
                            </div>
                            
                            <!-- Renewal Rate -->
                            <div class="bg-green-50 rounded-lg p-4">
                                <p class="text-sm text-green-700 font-medium">Subscription Renewal Rate</p>
                                <p class="text-2xl font-bold text-green-900">{{ $renewalRate }}%</p>
                            </div>
                            
                            <!-- Churn Rate -->
                            <div class="bg-red-50 rounded-lg p-4">
                                <p class="text-sm text-red-700 font-medium">Monthly Churn Rate</p>
                                <p class="text-2xl font-bold text-red-900">{{ $churnRate }}%</p>
                            </div>
                        </div>
                        
                        <!-- Retention Chart -->
                        <canvas id="retentionChart" height="300"></canvas>
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
        // Monthly Signups Chart
        const signupsCtx = document.getElementById('signupsChart').getContext('2d');
        const signupsChart = new Chart(signupsCtx, {
            type: 'bar',
            data: {
                labels: @json(array_keys($monthlySignups)),
                datasets: [{
                    label: 'New Members',
                    data: @json(array_values($monthlySignups)),
                    backgroundColor: 'rgba(79, 70, 229, 0.2)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Monthly New Member Signups'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
        
        // Subscription Types Distribution Chart
        const subscriptionCtx = document.getElementById('subscriptionTypesChart').getContext('2d');
        const subscriptionLabels = @json(array_column($membersBySubscriptionType->toArray(), 'type'));
        const subscriptionData = @json(array_column($membersBySubscriptionType->toArray(), 'count'));
        
        const subscriptionChart = new Chart(subscriptionCtx, {
            type: 'doughnut',
            data: {
                labels: subscriptionLabels,
                datasets: [{
                    data: subscriptionData,
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)', // Blue for Basic
                        'rgba(139, 92, 246, 0.7)', // Purple for Premium
                        'rgba(16, 185, 129, 0.7)', // Green for Elite
                        'rgba(209, 213, 219, 0.7)' // Gray for None
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(139, 92, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(209, 213, 219, 1)'
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
                        text: 'Subscription Types'
                    }
                }
            }
        });
        
        // Activity Levels Chart
        const activityCtx = document.getElementById('activityLevelsChart').getContext('2d');
        const activityChart = new Chart(activityCtx, {
            type: 'pie',
            data: {
                labels: ['Highly Active (10+ sessions/month)', 'Active (5-9 sessions/month)', 'Moderately Active (2-4 sessions/month)', 'Low Activity (0-1 sessions/month)'],
                datasets: [{
                    data: @json($activityLevels),
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.7)', // Green for Highly Active
                        'rgba(59, 130, 246, 0.7)', // Blue for Active
                        'rgba(245, 158, 11, 0.7)', // Yellow for Moderately Active
                        'rgba(239, 68, 68, 0.7)'   // Red for Low Activity
                    ],
                    borderColor: [
                        'rgba(16, 185, 129, 1)',
                        'rgba(59, 130, 246, 1)',
                        'rgba(245, 158, 11, 1)',
                        'rgba(239, 68, 68, 1)'
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
                        text: 'Member Activity Levels'
                    }
                }
            }
        });
        
        // Retention Chart
        const retentionCtx = document.getElementById('retentionChart').getContext('2d');
        const retentionChart = new Chart(retentionCtx, {
            type: 'line',
            data: {
                labels: @json(array_keys($retentionByMonth)),
                datasets: [{
                    label: 'Member Retention Rate (%)',
                    data: @json(array_values($retentionByMonth)),
                    backgroundColor: 'rgba(16, 185, 129, 0.2)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Member Retention Rate by Month'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
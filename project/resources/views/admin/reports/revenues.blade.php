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
                            <h1 class="text-3xl font-bold">Revenue Reports</h1>
                            <p class="mt-1 text-indigo-100">Analyze financial performance and revenue streams</p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.reports.revenues') }}" 
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
                <!-- Revenue Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Revenue Card -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-green-100 p-3 mr-4">
                                <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-gray-500 text-sm">Total Revenue</div>
                                <div class="text-2xl font-bold text-gray-900">${{ number_format($totalRevenue, 2) }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Current Month Revenue Card -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-indigo-100 p-3 mr-4">
                                <svg class="h-8 w-8 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg></div>
                            <div>
                                <div class="text-gray-500 text-sm">Current Month</div>
                                <div class="text-2xl font-bold text-gray-900">${{ number_format($currentMonthRevenue, 2) }}</div>
                                <div class="text-sm {{ $growthPercentage >= 0 ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $growthPercentage >= 0 ? '↑' : '↓' }} {{ abs($growthPercentage) }}% from last month
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Previous Month Revenue Card -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-blue-100 p-3 mr-4">
                                <svg class="h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-gray-500 text-sm">Previous Month</div>
                                <div class="text-2xl font-bold text-gray-900">${{ number_format($previousMonthRevenue, 2) }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Average Monthly Revenue Card -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-purple-100 p-3 mr-4">
                                <svg class="h-8 w-8 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-gray-500 text-sm">Avg. Monthly</div>
                                <div class="text-2xl font-bold text-gray-900">${{ number_format(array_sum(array_values($monthlyRevenue)) / count($monthlyRevenue), 2) }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Monthly Revenue Chart -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Monthly Revenue (Last 12 Months)</h2>
                    </div>
                    <div class="p-6">
                        <canvas id="revenueChart" height="300"></canvas>
                    </div>
                </div>

                <!-- Revenue Analysis -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Revenue by Subscription Type -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-lg font-medium text-gray-900">Revenue by Subscription Type</h2>
                        </div>
                        <div class="p-6">
                            <canvas id="revenueByTypeChart" height="300"></canvas>
                        </div>
                    </div>

                    <!-- Revenue by Payment Method -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-lg font-medium text-gray-900">Revenue by Payment Method</h2>
                        </div>
                        <div class="p-6">
                            <canvas id="revenueByMethodChart" height="300"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Revenue Breakdown Table -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Detailed Revenue Breakdown</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Month
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subscription Revenue
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        New Subscriptions
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Renewals
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total Transactions
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Average Transaction
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($monthlyRevenue as $month => $revenue)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $month }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            ${{ number_format($revenue, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $newSubscriptionsByMonth[$month] ?? 0 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $renewalsByMonth[$month] ?? 0 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $transactionsByMonth[$month] ?? 0 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @php
                                                $avgTransaction = 0;
                                                if (isset($transactionsByMonth[$month]) && $transactionsByMonth[$month] > 0) {
                                                    $avgTransaction = $revenue / $transactionsByMonth[$month];
                                                }
                                            @endphp
                                            ${{ number_format($avgTransaction, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Financial Metrics -->
                <div class="mt-8 bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Key Financial Metrics</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Average Revenue Per Member -->
                            <div class="bg-indigo-50 rounded-lg p-4">
                                <p class="text-sm text-indigo-700 font-medium">Avg. Revenue Per Member</p>
                                <p class="text-2xl font-bold text-indigo-900">${{ number_format($avgRevenuePerMember, 2) }}</p>
                                <p class="text-xs text-indigo-700 mt-2">Monthly calculation based on active members</p>
                            </div>
                            
                            <!-- Lifetime Value (LTV) -->
                            <div class="bg-green-50 rounded-lg p-4">
                                <p class="text-sm text-green-700 font-medium">Member Lifetime Value</p>
                                <p class="text-2xl font-bold text-green-900">${{ number_format($memberLTV, 2) }}</p>
                                <p class="text-xs text-green-700 mt-2">Estimated based on retention and spending</p>
                            </div>
                            
                            <!-- Recurring Revenue -->
                            <div class="bg-blue-50 rounded-lg p-4">
                                <p class="text-sm text-blue-700 font-medium">Monthly Recurring Revenue</p>
                                <p class="text-2xl font-bold text-blue-900">${{ number_format($monthlyRecurringRevenue, 2) }}</p>
                                <p class="text-xs text-blue-700 mt-2">Based on active subscriptions</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Projected Revenue -->
                <div class="mt-8 bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Revenue Projections (Next 6 Months)</h2>
                    </div>
                    <div class="p-6">
                        <canvas id="revenueProjectionChart" height="300"></canvas>
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
        // Monthly Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: @json(array_keys($monthlyRevenue)),
                datasets: [{
                    label: 'Revenue ($)',
                    data: @json(array_values($monthlyRevenue)),
                    backgroundColor: 'rgba(16, 185, 129, 0.2)', // Green
                    borderColor: 'rgba(16, 185, 129, 1)',
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
                        text: 'Monthly Revenue'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        });
        
        // Revenue by Subscription Type Chart
        const typeCtx = document.getElementById('revenueByTypeChart').getContext('2d');
        const typeLabels = @json(array_column($revenueByType->toArray(), 'type'));
        const typeData = @json(array_column($revenueByType->toArray(), 'total'));
        
        const typeChart = new Chart(typeCtx, {
            type: 'pie',
            data: {
                labels: typeLabels,
                datasets: [{
                    data: typeData,
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)', // Blue for Basic
                        'rgba(139, 92, 246, 0.7)', // Purple for Premium
                        'rgba(16, 185, 129, 0.7)' // Green for Elite
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(139, 92, 246, 1)',
                        'rgba(16, 185, 129, 1)'
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
                        text: 'Revenue by Subscription Type'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: $${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
        
        // Revenue by Payment Method Chart
        const methodCtx = document.getElementById('revenueByMethodChart').getContext('2d');
        const methodLabels = @json(array_column($revenueByMethod->toArray(), 'method'));
        const methodData = @json(array_column($revenueByMethod->toArray(), 'total'));
        
        const methodChart = new Chart(methodCtx, {
            type: 'doughnut',
            data: {
                labels: methodLabels,
                datasets: [{
                    data: methodData,
                    backgroundColor: [
                        'rgba(245, 158, 11, 0.7)', // Yellow for Cash
                        'rgba(59, 130, 246, 0.7)', // Blue for Credit Card
                        'rgba(16, 185, 129, 0.7)', // Green for Bank Transfer
                        'rgba(124, 58, 237, 0.7)' // Purple for Stripe
                    ],
                    borderColor: [
                        'rgba(245, 158, 11, 1)',
                        'rgba(59, 130, 246, 1)',
                        'rgba(16, 185, 129, 1)',
                        'rgba(124, 58, 237, 1)'
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
                        text: 'Revenue by Payment Method'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: $${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
        
        // Revenue Projections Chart
        const projectionCtx = document.getElementById('revenueProjectionChart').getContext('2d');
        
        // Get last 6 months of actual revenue
        const revenueHistory = @json(array_values($monthlyRevenue));
        const lastSixMonths = revenueHistory.slice(-6);
        
        // Calculate simple projection based on trend
        const projectionMonths = [];
        const currentDate = new Date();
        for (let i = 1; i <= 6; i++) {
            const projDate = new Date(currentDate);
            projDate.setMonth(currentDate.getMonth() + i);
            projectionMonths.push(projDate.toLocaleString('default', { month: 'long', year: 'numeric' }));
        }
        
        // Simple projection calculation (you can implement more complex models)
        const avgGrowth = @json($avgMonthlyGrowthRate);
        const projectedRevenue = [];
        let lastValue = revenueHistory[revenueHistory.length - 1];
        
        for (let i = 0; i < 6; i++) {
            lastValue = lastValue * (1 + avgGrowth / 100);
            projectedRevenue.push(Math.round(lastValue * 100) / 100);
        }
        
        const projectionChart = new Chart(projectionCtx, {
            type: 'line',
            data: {
                labels: projectionMonths,
                datasets: [{
                    label: 'Projected Revenue ($)',
                    data: projectedRevenue,
                    backgroundColor: 'rgba(79, 70, 229, 0.2)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    pointStyle: 'circle',
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(79, 70, 229, 1)',
                    tension: 0.3
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
                        text: 'Revenue Projections'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `Projected: $${context.raw.toFixed(2)}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        ticks: {
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
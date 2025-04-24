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
                        <h1 class="text-3xl font-bold">Payments Management</h1>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.payments.create') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-800 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Record Payment
                            </a>
                            <a href="{{ route('admin.payments.report') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Generate Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Stats Cards -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Total Revenue Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
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

                    <!-- Pending Revenue Card -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex items-center">
                        <div class="rounded-full bg-yellow-100 p-3 mr-4">
                            <svg class="h-8 w-8 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm">Pending Revenue</div>
                            <div class="text-2xl font-bold text-gray-900">${{ number_format($pendingRevenue, 2) }}</div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <form action="{{ route('admin.payments.index') }}" method="GET" class="space-y-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">All Statuses</option>
                                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="refunded" {{ request('status') === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                </select>
                            </div>
                            <div class="flex space-x-2">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Filter
                                </button>
                                <a href="{{ route('admin.payments.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Payment Statistics Charts -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Monthly Revenue Chart -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Monthly Revenue</h3>
                        <div style="height: 300px; position: relative;">
                            <canvas id="monthlyRevenueChart"></canvas>
                        </div>
                    </div>

                    <!-- Payment Methods Distribution -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Methods</h3>
                        <div style="height: 300px; position: relative;">
                            <canvas id="paymentMethodsChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Additional Payment Statistics -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Payment Status Distribution -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Status</h3>
                        <div style="height: 300px; position: relative;">
                            <canvas id="paymentStatusChart"></canvas>
                        </div>
                    </div>

                    <!-- Weekly Payment Trend -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Weekly Payment Trend</h3>
                        <div style="height: 300px; position: relative;">
                            <canvas id="weeklyTrendChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Payments Table -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Payment Records</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Reference
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Member
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subscription
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Method
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($payments as $payment)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $payment->reference ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                    <span class="text-indigo-800 font-bold">
                                                        {{ isset($payment->subscription->user) ? 
                                                        substr($payment->subscription->user->firstname, 0, 1) . substr($payment->subscription->user->lastname, 0, 1) : 
                                                        'NA' }}
                                                    </span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ isset($payment->subscription->user) ? 
                                                        $payment->subscription->user->firstname . ' ' . $payment->subscription->user->lastname : 
                                                        'N/A' }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ isset($payment->subscription->user) ? $payment->subscription->user->email : 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if(isset($payment->subscription))
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if($payment->subscription->type == 'Basic') bg-blue-100 text-blue-800
                                                    @elseif($payment->subscription->type == 'Premium') bg-purple-100 text-purple-800
                                                    @else bg-green-100 text-green-800 @endif">
                                                    {{ $payment->subscription->type }}
                                                </span>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            ${{ number_format($payment->amount, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($payment->date)->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ ucfirst($payment->method) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($payment->status == 'paid') bg-green-100 text-green-800
                                                @elseif($payment->status == 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($payment->status == 'refunded') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('admin.payments.show', $payment) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    View
                                                </a>
                                                @if($payment->status == 'pending')
                                                    <form action="{{ route('admin.payments.process', $payment) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-green-600 hover:text-green-900">
                                                            Process
                                                        </button>
                                                    </form>
                                                @endif
                                                @if($payment->status == 'paid')
                                                    <form action="{{ route('admin.payments.refund', $payment) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to refund this payment?');">
                                                        @csrf
                                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                                            Refund
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No payments found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        {{ $payments->links() }}
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
<!-- Use local Chart.js with CDN fallback -->
<script src="{{ asset('public/js/chart.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Document loaded, checking Chart.js...');
        
        // If Chart.js isn't loaded properly, try to load it from CDN as fallback
        if (typeof Chart === 'undefined') {
            console.log('Chart.js not loaded from local file, trying CDN...');
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js';
            script.onload = function() {
                console.log('Chart.js loaded from CDN');
                initCharts();
            };
            script.onerror = function() {
                console.error('Failed to load Chart.js from CDN');
                displayChartErrors();
            };
            document.head.appendChild(script);
        } else {
            console.log('Chart.js loaded from local file');
            initCharts();
        }
        
        function displayChartErrors() {
            const chartContainers = [
                'monthlyRevenueChart', 
                'paymentMethodsChart', 
                'paymentStatusChart', 
                'weeklyTrendChart'
            ];
            
            chartContainers.forEach(id => {
                const container = document.getElementById(id);
                if (container) {
                    container.innerHTML = '<div class="flex items-center justify-center h-full">' +
                        '<div class="text-red-500 text-center">' +
                        '<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">' +
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />' +
                        '</svg>' +
                        '<p class="mt-2">Error loading chart</p>' +
                        '</div></div>';
                }
            });
        }
        
        function initCharts() {
            // Sample data to use if real data is not available
            const sampleMonthlyLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const sampleMonthlyData = [1500, 2000, 1800, 2200, 2600, 2400, 2800, 3000, 2900, 3200, 3400, 3600];
            
            const sampleMethodsLabels = ['Credit Card', 'Cash', 'Bank Transfer', 'PayPal', 'Other'];
            const sampleMethodsData = [45, 20, 15, 12, 8];
            const methodsColors = [
                'rgba(99, 102, 241, 0.6)',
                'rgba(52, 211, 153, 0.6)',
                'rgba(251, 146, 60, 0.6)',
                'rgba(79, 70, 229, 0.6)',
                'rgba(156, 163, 175, 0.6)'
            ];
            
            const sampleStatusLabels = ['Paid', 'Pending', 'Refunded'];
            const sampleStatusData = [75, 18, 7];
            const statusColors = [
                'rgba(52, 211, 153, 0.6)',
                'rgba(251, 146, 60, 0.6)',
                'rgba(239, 68, 68, 0.6)'
            ];
            
            const sampleWeeklyLabels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
            const sampleWeeklyTransactions = [25, 30, 28, 32];
            const sampleWeeklyRevenue = [5000, 6000, 5500, 6500];
            
            try {
                // Initialize Monthly Revenue Chart
                const monthlyChart = document.getElementById('monthlyRevenueChart');
                if (monthlyChart) {
                    console.log('Initializing monthly revenue chart');
                    
                    @if(isset($monthlyRevenue) && isset($monthlyRevenue['labels']) && isset($monthlyRevenue['data']))
                    // Use real data
                    const monthlyLabels = @json($monthlyRevenue['labels']);
                    const monthlyData = @json($monthlyRevenue['data']);
                    @else
                    // Use sample data
                    const monthlyLabels = sampleMonthlyLabels;
                    const monthlyData = sampleMonthlyData;
                    @endif
                    
                    new Chart(monthlyChart, {
                        type: 'line',
                        data: {
                            labels: monthlyLabels,
                            datasets: [{
                                label: 'Revenue',
                                backgroundColor: 'rgba(99, 102, 241, 0.2)',
                                borderColor: 'rgb(99, 102, 241)',
                                data: monthlyData,
                                borderWidth: 2,
                                tension: 0.4,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return `$${context.raw.toLocaleString()}`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return '$' + value.toLocaleString();
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
                
                // Initialize Payment Methods Chart
                const methodsChart = document.getElementById('paymentMethodsChart');
                if (methodsChart) {
                    console.log('Initializing payment methods chart');
                    
                    @if(isset($paymentMethods) && isset($paymentMethods['labels']) && isset($paymentMethods['data']))
                    // Use real data
                    const methodsLabels = @json($paymentMethods['labels']);
                    const methodsData = @json($paymentMethods['data']);
                    @else
                    // Use sample data
                    const methodsLabels = sampleMethodsLabels;
                    const methodsData = sampleMethodsData;
                    @endif
                    
                    new Chart(methodsChart, {
                        type: 'doughnut',
                        data: {
                            labels: methodsLabels,
                            datasets: [{
                                label: 'Payment Methods',
                                backgroundColor: methodsColors,
                                data: methodsData
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = Math.round((value / total) * 100);
                                            return `${label}: ${percentage}% (${value})`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
                
                // Initialize Payment Status Chart
                const statusChart = document.getElementById('paymentStatusChart');
                if (statusChart) {
                    console.log('Initializing payment status chart');
                    
                    @if(isset($paymentStatuses) && isset($paymentStatuses['labels']) && isset($paymentStatuses['data']))
                    // Use real data
                    const statusLabels = @json($paymentStatuses['labels']);
                    const statusData = @json($paymentStatuses['data']);
                    @else
                    // Use sample data
                    const statusLabels = sampleStatusLabels;
                    const statusData = sampleStatusData;
                    @endif
                    
                    new Chart(statusChart, {
                        type: 'pie',
                        data: {
                            labels: statusLabels,
                            datasets: [{
                                label: 'Payment Status',
                                backgroundColor: statusColors,
                                data: statusData
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = Math.round((value / total) * 100);
                                            return `${label}: ${percentage}% (${value})`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
                
                // Initialize Weekly Payment Trend Chart
                const trendChart = document.getElementById('weeklyTrendChart');
                if (trendChart) {
                    console.log('Initializing weekly trend chart');
                    
                    @if(isset($weeklyTrends) && isset($weeklyTrends['labels']) && isset($weeklyTrends['transactions']) && isset($weeklyTrends['revenue']))
                    // Use real data
                    const weeklyLabels = @json($weeklyTrends['labels']);
                    const weeklyTransactions = @json($weeklyTrends['transactions']);
                    const weeklyRevenue = @json($weeklyTrends['revenue']);
                    @else
                    // Use sample data
                    const weeklyLabels = sampleWeeklyLabels;
                    const weeklyTransactions = sampleWeeklyTransactions;
                    const weeklyRevenue = sampleWeeklyRevenue;
                    @endif
                    
                    new Chart(trendChart, {
                        type: 'bar',
                        data: {
                            labels: weeklyLabels,
                            datasets: [{
                                label: 'Transactions',
                                backgroundColor: 'rgba(37, 99, 235, 0.2)',
                                borderColor: 'rgb(37, 99, 235)',
                                data: weeklyTransactions,
                                borderWidth: 2,
                                yAxisID: 'y'
                            }, {
                                label: 'Revenue ($)',
                                backgroundColor: 'rgba(245, 158, 11, 0.2)',
                                borderColor: 'rgb(245, 158, 11)',
                                data: weeklyRevenue,
                                borderWidth: 2,
                                type: 'line',
                                tension: 0.1,
                                yAxisID: 'y1'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    type: 'linear',
                                    display: true,
                                    position: 'left',
                                    title: {
                                        display: true,
                                        text: 'Transactions'
                                    }
                                },
                                y1: {
                                    type: 'linear',
                                    display: true,
                                    position: 'right',
                                    grid: {
                                        drawOnChartArea: false,
                                    },
                                    title: {
                                        display: true,
                                        text: 'Revenue ($)'
                                    },
                                    ticks: {
                                        callback: function(value) {
                                            return '$' + value.toLocaleString();
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
                
                console.log('All charts initialized');
                
            } catch (error) {
                console.error('Error initializing charts:', error);
                displayChartErrors();
            }
        }
    });
</script>
@endpush
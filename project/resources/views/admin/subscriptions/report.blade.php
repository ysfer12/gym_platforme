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
                        <h1 class="text-3xl font-bold">Subscription Reports</h1>
                        <a href="{{ route('admin.subscriptions.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-800 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Subscriptions
                        </a>
                    </div>
                </div>
            </div>

            <!-- Subscription Stats -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                    <!-- Total Subscriptions -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-900">Total Subscriptions</h3>
                        <p class="mt-2 text-3xl font-bold text-indigo-600">{{ $stats['total'] }}</p>
                    </div>

                    <!-- Active Subscriptions -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-900">Active</h3>
                        <p class="mt-2 text-3xl font-bold text-green-600">{{ $stats['active'] }}</p>
                        <p class="text-sm text-gray-500">{{ $stats['total'] > 0 ? round(($stats['active'] / $stats['total']) * 100) : 0 }}% of total</p>
                    </div>

                    <!-- Pending Subscriptions -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-900">Pending</h3>
                        <p class="mt-2 text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
                        <p class="text-sm text-gray-500">{{ $stats['total'] > 0 ? round(($stats['pending'] / $stats['total']) * 100) : 0 }}% of total</p>
                    </div>

                    <!-- Expired Subscriptions -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-900">Expired</h3>
                        <p class="mt-2 text-3xl font-bold text-gray-600">{{ $stats['expired'] }}</p>
                        <p class="text-sm text-gray-500">{{ $stats['total'] > 0 ? round(($stats['expired'] / $stats['total']) * 100) : 0 }}% of total</p>
                    </div>

                    <!-- Cancelled Subscriptions -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-900">Cancelled</h3>
                        <p class="mt-2 text-3xl font-bold text-red-600">{{ $stats['cancelled'] }}</p>
                        <p class="text-sm text-gray-500">{{ $stats['total'] > 0 ? round(($stats['cancelled'] / $stats['total']) * 100) : 0 }}% of total</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Subscriptions by Type -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                            <h2 class="text-lg font-medium text-gray-900">Subscriptions by Type</h2>
                        </div>
                        <div class="p-6">
                            @if($subscriptionsByType->isNotEmpty())
                                <div class="space-y-4">
                                    @foreach($subscriptionsByType as $typeData)
                                        <div>
                                            <div class="flex justify-between text-sm">
                                                <span>{{ $typeData->type }}</span>
                                                <span>{{ $typeData->count }} ({{ $stats['active'] > 0 ? round(($typeData->count / $stats['active']) * 100) : 0 }}%)</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                                                <div class="h-2.5 rounded-full 
                                                    @if($typeData->type == 'Basic') bg-blue-600
                                                    @elseif($typeData->type == 'Premium') bg-purple-600
                                                    @else bg-green-600 @endif" 
                                                    style="width: {{ $stats['active'] > 0 ? ($typeData->count / $stats['active']) * 100 : 0 }}%">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-center py-4">No active subscriptions found.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Monthly Revenue Chart -->
                    <div class="bg-white shadow rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                            <h2 class="text-lg font-medium text-gray-900">Monthly Revenue ({{ date('Y') }})</h2>
                        </div>
                        <div class="p-6">
                            <canvas id="revenueChart" height="300"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Subscriptions -->
                <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Recent Subscriptions
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Most recently created subscriptions.
                            </p>
                        </div>
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
                                            Type
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Duration
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Price
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Created
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($recentSubscriptions as $subscription)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                                                        {{ substr($subscription->user->firstname, 0, 1) }}{{ substr($subscription->user->lastname, 0, 1) }}
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $subscription->user->firstname }} {{ $subscription->user->lastname }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $subscription->user->email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if($subscription->type == 'Basic') bg-blue-100 text-blue-800
                                                    @elseif($subscription->type == 'Premium') bg-purple-100 text-purple-800
                                                    @else bg-green-100 text-green-800 @endif">
                                                    {{ $subscription->type }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $subscription->duration }} {{ Str::plural('month', $subscription->duration) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                ${{ number_format($subscription->price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if($subscription->status == 'active') bg-green-100 text-green-800
                                                    @elseif($subscription->status == 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($subscription->status == 'cancelled') bg-red-100 text-red-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($subscription->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $subscription->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('admin.subscriptions.show', $subscription) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                                No recent subscriptions found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Monthly Revenue Chart
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const chartData = @json($chartData);
        
        const data = {
            labels: months,
            datasets: [{
                label: 'Revenue ($)',
                data: Object.values(chartData),
                backgroundColor: 'rgba(79, 70, 229, 0.2)',
                borderColor: 'rgba(79, 70, 229, 1)',
                borderWidth: 2,
                tension: 0.1
            }]
        };
        
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '$' + context.raw.toFixed(2);
                            }
                        }
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
        };
        
        new Chart(ctx, config);
    });
</script>
@endpush
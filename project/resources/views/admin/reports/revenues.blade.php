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
                            <h1 class="text-3xl font-bold">Revenue Reports</h1>
                            <p class="mt-1 text-indigo-100">Analyze financial performance and revenue streams</p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.reports.revenues') }}" 
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
                        <div style="height: 300px; position: relative;">
                            <!-- Static Monthly Revenue Chart -->
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
                                    
                                    <!-- X Axis labels -->
                                    <text x="100" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Jan</text>
                                    <text x="157" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Feb</text>
                                    <text x="214" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Mar</text>
                                    <text x="271" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Apr</text>
                                    <text x="328" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">May</text>
                                    <text x="385" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Jun</text>
                                    <text x="442" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Jul</text>
                                    <text x="499" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Aug</text>
                                    <text x="556" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Sep</text>
                                    <text x="613" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Oct</text>
                                    <text x="670" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Nov</text>
                                    <text x="727" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Dec</text>
                                    
                                    <!-- Y Axis labels -->
                                    <text x="40" y="250" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$0</text>
                                    <text x="40" y="210" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$5K</text>
                                    <text x="40" y="170" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$10K</text>
                                    <text x="40" y="130" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$15K</text>
                                    <text x="40" y="90" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$20K</text>
                                    <text x="40" y="50" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$25K</text>
                                    
                                    <!-- Chart title -->
                                    <text x="400" y="30" font-family="sans-serif" font-size="16" fill="#1f2937" text-anchor="middle" font-weight="bold">Monthly Revenue</text>
                                    
                                    <!-- Bar chart -->
                                    <rect x="80" y="160" width="40" height="90" fill="rgba(16, 185, 129, 0.7)" rx="3" />
                                    <rect x="137" y="140" width="40" height="110" fill="rgba(16, 185, 129, 0.7)" rx="3" />
                                    <rect x="194" y="120" width="40" height="130" fill="rgba(16, 185, 129, 0.7)" rx="3" />
                                    <rect x="251" y="130" width="40" height="120" fill="rgba(16, 185, 129, 0.7)" rx="3" />
                                    <rect x="308" y="100" width="40" height="150" fill="rgba(16, 185, 129, 0.7)" rx="3" />
                                    <rect x="365" y="80" width="40" height="170" fill="rgba(16, 185, 129, 0.7)" rx="3" />
                                    <rect x="422" y="90" width="40" height="160" fill="rgba(16, 185, 129, 0.7)" rx="3" />
                                    <rect x="479" y="110" width="40" height="140" fill="rgba(16, 185, 129, 0.7)" rx="3" />
                                    <rect x="536" y="130" width="40" height="120" fill="rgba(16, 185, 129, 0.7)" rx="3" />
                                    <rect x="593" y="100" width="40" height="150" fill="rgba(16, 185, 129, 0.7)" rx="3" />
                                    <rect x="650" y="90" width="40" height="160" fill="rgba(16, 185, 129, 0.7)" rx="3" />
                                    <rect x="707" y="70" width="40" height="180" fill="rgba(16, 185, 129, 0.7)" rx="3" />
                                </svg>
                            </div>
                        </div>
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
                            <div style="height: 300px; position: relative;">
                                <!-- Static Revenue by Subscription Type Chart -->
                                <div class="w-full h-full bg-white">
                                    <svg width="100%" height="100%" viewBox="0 0 800 300" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="800" height="300" fill="#fff" />
                                        
                                        <!-- Chart title -->
                                        <text x="400" y="30" font-family="sans-serif" font-size="16" fill="#1f2937" text-anchor="middle" font-weight="bold">Revenue by Subscription Type</text>
                                        
                                        <!-- Pie chart -->
                                        <g transform="translate(170, 150)">
                                            <!-- Basic slice - 45% -->
                                            <path d="M0,0 L0,-100 A100,100 0 0,1 76.6,64.3 Z" fill="#3b82f6" />
                                            
                                            <!-- Premium slice - 30% -->
                                            <path d="M0,0 L76.6,64.3 A100,100 0 0,1 -50,86.6 Z" fill="#8b5cf6" />
                                            
                                            <!-- Elite slice - 25% -->
                                            <path d="M0,0 L-50,86.6 A100,100 0 0,1 -100,0 Z" fill="#10b981" />
                                            
                                            <!-- Inner white circle to create donut -->
                                            <circle cx="0" cy="0" r="60" fill="white" />
                                        </g>
                                        
                                        <!-- Legend -->
                                        <g transform="translate(400, 80)">
                                            <!-- Basic -->
                                            <rect x="0" y="0" width="16" height="16" rx="2" fill="#3b82f6" />
                                            <text x="24" y="12" font-family="sans-serif" font-size="14" fill="#4b5563">Basic (45%)</text>
                                            
                                            <!-- Premium -->
                                            <rect x="0" y="30" width="16" height="16" rx="2" fill="#8b5cf6" />
                                            <text x="24" y="42" font-family="sans-serif" font-size="14" fill="#4b5563">Premium (30%)</text>
                                            
                                            <!-- Elite -->
                                            <rect x="0" y="60" width="16" height="16" rx="2" fill="#10b981" />
                                            <text x="24" y="72" font-family="sans-serif" font-size="14" fill="#4b5563">Elite (25%)</text>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Revenue by Payment Method -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-lg font-medium text-gray-900">Revenue by Payment Method</h2>
                        </div>
                        <div class="p-6">
                            <div style="height: 300px; position: relative;">
                                <!-- Static Revenue by Payment Method Chart -->
                                <div class="w-full h-full bg-white">
                                    <svg width="100%" height="100%" viewBox="0 0 800 300" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="800" height="300" fill="#fff" />
                                        
                                        <!-- Chart title -->
                                        <text x="400" y="30" font-family="sans-serif" font-size="16" fill="#1f2937" text-anchor="middle" font-weight="bold">Revenue by Payment Method</text>
                                        
                                        <!-- Donut chart -->
                                        <g transform="translate(170, 150)">
                                            <!-- Credit Card slice - 55% -->
                                            <path d="M0,0 L0,-100 A100,100 0 0,1 95.1,30.9 Z" fill="#3b82f6" />
                                            
                                            <!-- Bank Transfer slice - 20% -->
                                            <path d="M0,0 L95.1,30.9 A100,100 0 0,1 17.4,98.5 Z" fill="#10b981" />
                                            
                                            <!-- Stripe slice - 15% -->
                                            <path d="M0,0 L17.4,98.5 A100,100 0 0,1 -50,86.6 Z" fill="#7c3aed" />
                                            
                                            <!-- Cash slice - 10% -->
                                            <path d="M0,0 L-50,86.6 A100,100 0 0,1 -100,0 A100,100 0 0,1 0,-100 Z" fill="#f59e0b" />
                                            
                                            <!-- Inner white circle to create donut -->
                                            <circle cx="0" cy="0" r="60" fill="white" />
                                        </g>
                                        
                                        <!-- Legend -->
                                        <g transform="translate(400, 80)">
                                            <!-- Credit Card -->
                                            <rect x="0" y="0" width="16" height="16" rx="2" fill="#3b82f6" />
                                            <text x="24" y="12" font-family="sans-serif" font-size="14" fill="#4b5563">Credit Card (55%)</text>
                                            
                                            <!-- Bank Transfer -->
                                            <rect x="0" y="30" width="16" height="16" rx="2" fill="#10b981" />
                                            <text x="24" y="42" font-family="sans-serif" font-size="14" fill="#4b5563">Bank Transfer (20%)</text>
                                            
                                            <!-- Stripe -->
                                            <rect x="0" y="60" width="16" height="16" rx="2" fill="#7c3aed" />
                                            <text x="24" y="72" font-family="sans-serif" font-size="14" fill="#4b5563">Stripe (15%)</text>
                                            
                                            <!-- Cash -->
                                            <rect x="0" y="90" width="16" height="16" rx="2" fill="#f59e0b" />
                                            <text x="24" y="102" font-family="sans-serif" font-size="14" fill="#4b5563">Cash (10%)</text>
                                        </g>
                                    </svg>
                                </div>
                            </div>
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
                        <div style="height: 300px; position: relative;">
                            <!-- Static Revenue Projection Chart -->
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
                                    
                                    <!-- X Axis labels (next 6 months) -->
                                    <text x="120" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Jun 2025</text>
                                    <text x="230" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Jul 2025</text>
                                    <text x="340" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Aug 2025</text>
                                    <text x="450" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Sep 2025</text>
                                    <text x="560" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Oct 2025</text>
                                    <text x="670" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Nov 2025</text>
                                    
                                    <!-- Y Axis labels -->
                                    <text x="40" y="250" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$0</text>
                                    <text x="40" y="210" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$10K</text>
                                    <text x="40" y="170" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$20K</text>
                                    <text x="40" y="130" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$30K</text>
                                    <text x="40" y="90" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$40K</text>
                                    <text x="40" y="50" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$50K</text>
                                    
                                    <!-- Chart title -->
                                    <text x="400" y="30" font-family="sans-serif" font-size="16" fill="#1f2937" text-anchor="middle" font-weight="bold">Revenue Projections</text>
                                    
                                    <!-- Area under the projection line -->
                                    <defs>
                                        <linearGradient id="areaGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" stop-color="rgba(79, 70, 229, 0.4)" />
                                            <stop offset="100%" stop-color="rgba(79, 70, 229, 0.05)" />
                                        </linearGradient>
                                    </defs>
                                    <path d="M120,150 L230,140 L340,130 L450,120 L560,110 L670,100 L670,250 L120,250 Z" fill="url(#areaGradient)" />
                                    
                                    <!-- Projection line -->
                                    <path d="M120,150 L230,140 L340,130 L450,120 L560,110 L670,100" 
                                          fill="none" stroke="#4f46e5" stroke-width="3" stroke-dasharray="5,5" stroke-linejoin="round" />
                                    
                                    <!-- Data points -->
                                    <circle cx="120" cy="150" r="5" fill="#4f46e5" />
                                    <circle cx="230" cy="140" r="5" fill="#4f46e5" />
                                    <circle cx="340" cy="130" r="5" fill="#4f46e5" />
                                    <circle cx="450" cy="120" r="5" fill="#4f46e5" />
                                    <circle cx="560" cy="110" r="5" fill="#4f46e5" />
                                    <circle cx="670" cy="100" r="5" fill="#4f46e5" />
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
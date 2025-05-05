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
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
                        <div>
                            <h1 class="text-3xl font-bold tracking-tight flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-3 text-white opacity-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Payments Management
                            </h1>
                            <p class="mt-1 text-orange-50 text-sm flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Manage payment transactions, revenue reports and financial analytics
                            </p>
                        </div>
                        <div class="flex space-x-3">
                          
                            <a href="{{ route('admin.payments.report') }}" 
                               class="inline-flex items-center px-4 py-2 border border-white border-opacity-20 rounded-lg shadow-sm text-sm font-medium text-white bg-white bg-opacity-10 hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-orange-500 focus:ring-white transition-all duration-200">
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
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-200 hover:shadow-lg hover:scale-[1.02] border border-gray-100">
                        <div class="p-5 flex items-center">
                            <div class="rounded-full bg-green-100 p-3 mr-4 flex-shrink-0 shadow-sm">
                                <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-500">Total Revenue</div>
                                <div class="text-2xl font-bold text-gray-900">${{ number_format($totalRevenue, 2) }}</div>
                                <div class="mt-1 text-xs font-medium text-green-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    All time earnings
                                </div>
                            </div>
                        </div>
                        <div class="bg-green-50 px-5 py-2 text-xs font-medium text-green-700">
                            Completed transactions
                        </div>
                    </div>

                    <!-- Pending Revenue Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-200 hover:shadow-lg hover:scale-[1.02] border border-gray-100">
                        <div class="p-5 flex items-center">
                            <div class="rounded-full bg-yellow-100 p-3 mr-4 flex-shrink-0 shadow-sm">
                                <svg class="h-8 w-8 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-500">Pending Revenue</div>
                                <div class="text-2xl font-bold text-gray-900">${{ number_format($pendingRevenue, 2) }}</div>
                                <div class="mt-1 text-xs font-medium text-yellow-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Awaiting processing
                                </div>
                            </div>
                        </div>
                        <div class="bg-yellow-50 px-5 py-2 text-xs font-medium text-yellow-700">
                            Requires attention
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                        <div class="px-5 py-4 bg-gray-50 border-b border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-700">Filter Payments</h3>
                        </div>
                        <form action="{{ route('admin.payments.index') }}" method="GET" class="p-5">
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label>
                                <select id="status" name="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm">
                                    <option value="">All Statuses</option>
                                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="refunded" {{ request('status') === 'refunded' ? 'selected' : '' }}>Refunded</option>
                                </select>
                            </div>
                            <div class="flex space-x-2">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors duration-200">
                                    Apply Filter
                                </button>
                                <a href="{{ route('admin.payments.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors duration-200">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Payment Statistics Charts -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Monthly Revenue Chart -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                        <div class="px-5 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="text-sm font-semibold text-gray-700">Monthly Revenue</h3>
                            <div class="flex space-x-1">
                                <button class="p-1 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                                <button class="p-1 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
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
                                        <text x="40" y="210" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$1,000</text>
                                        <text x="40" y="170" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$2,000</text>
                                        <text x="40" y="130" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$3,000</text>
                                        <text x="40" y="90" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$4,000</text>
                                        <text x="40" y="50" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">$5,000</text>
                                        
                                        <!-- Chart title -->
                                        <text x="400" y="30" font-family="sans-serif" font-size="16" fill="#1f2937" text-anchor="middle" font-weight="bold">Monthly Revenue</text>
                                        
                                        <!-- Line chart data area -->
                                        <defs>
                                            <linearGradient id="areaGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                                <stop offset="0%" stop-color="rgba(249, 115, 22, 0.4)" />
                                                <stop offset="100%" stop-color="rgba(249, 115, 22, 0.05)" />
                                            </linearGradient>
                                        </defs>
                                        
                                        <!-- Area under line -->
                                        <path d="M100,200 L157,180 L214,190 L271,170 L328,150 L385,160 L442,140 L499,130 L556,135 L613,120 L670,110 L727,100 L727,250 L100,250 Z" fill="url(#areaGradient)" />
                                        
                                        <!-- Line chart line -->
                                        <path d="M100,200 L157,180 L214,190 L271,170 L328,150 L385,160 L442,140 L499,130 L556,135 L613,120 L670,110 L727,100" fill="none" stroke="#f97316" stroke-width="3" stroke-linejoin="round" />
                                        
                                        <!-- Data points -->
                                        <circle cx="100" cy="200" r="4" fill="#f97316" />
                                        <circle cx="157" cy="180" r="4" fill="#f97316" />
                                        <circle cx="214" cy="190" r="4" fill="#f97316" />
                                        <circle cx="271" cy="170" r="4" fill="#f97316" />
                                        <circle cx="328" cy="150" r="4" fill="#f97316" />
                                        <circle cx="385" cy="160" r="4" fill="#f97316" />
                                        <circle cx="442" cy="140" r="4" fill="#f97316" />
                                        <circle cx="499" cy="130" r="4" fill="#f97316" />
                                        <circle cx="556" cy="135" r="4" fill="#f97316" />
                                        <circle cx="613" cy="120" r="4" fill="#f97316" />
                                        <circle cx="670" cy="110" r="4" fill="#f97316" />
                                        <circle cx="727" cy="100" r="4" fill="#f97316" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods Distribution -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                        <div class="px-5 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="text-sm font-semibold text-gray-700">Payment Methods</h3>
                            <div class="flex space-x-1">
                                <button class="p-1 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                                <button class="p-1 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <div style="height: 300px; position: relative;">
                                <!-- Static Payment Methods Chart -->
                                <div class="w-full h-full bg-white">
                                    <svg width="100%" height="100%" viewBox="0 0 800 300" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="800" height="300" fill="#fff" />
                                        
                                        <!-- Chart title -->
                                        <text x="400" y="30" font-family="sans-serif" font-size="16" fill="#1f2937" text-anchor="middle" font-weight="bold">Payment Methods</text>
                                        
                                        <!-- Donut chart -->
                                        <g transform="translate(200, 150)">
                                            <!-- Credit Card slice - 45% -->
                                            <path d="M0,0 L0,-100 A100,100 0 0,1 95.1,30.9 Z" fill="#f97316" />
                                            
                                            <!-- Cash slice - 20% -->
                                            <path d="M0,0 L95.1,30.9 A100,100 0 0,1 17.4,98.5 Z" fill="#84cc16" />
                                            
                                            <!-- Bank Transfer slice - 15% -->
                                            <path d="M0,0 L17.4,98.5 A100,100 0 0,1 -76.6,64.3 Z" fill="#6366f1" />
                                            
                                            <!-- PayPal slice - 12% -->
                                            <path d="M0,0 L-76.6,64.3 A100,100 0 0,1 -98.5,-17.4 Z" fill="#8b5cf6" />
                                            
                                            <!-- Other slice - 8% -->
                                            <path d="M0,0 L-98.5,-17.4 A100,100 0 0,1 0,-100 Z" fill="#9ca3af" />
                                            
                                            <!-- Inner white circle to create donut -->
                                            <circle cx="0" cy="0" r="60" fill="white" />
                                        </g>
                                        
                                        <!-- Legend -->
                                        <g transform="translate(400, 80)">
                                            <!-- Credit Card -->
                                            <rect x="0" y="0" width="16" height="16" rx="2" fill="#f97316" />
                                            <text x="24" y="12" font-family="sans-serif" font-size="14" fill="#4b5563">Credit Card (45%)</text>
                                            
                                            <!-- Cash -->
                                            <rect x="0" y="30" width="16" height="16" rx="2" fill="#84cc16" />
                                            <text x="24" y="42" font-family="sans-serif" font-size="14" fill="#4b5563">Cash (20%)</text>
                                            
                                            <!-- Bank Transfer -->
                                            <rect x="0" y="60" width="16" height="16" rx="2" fill="#6366f1" />
                                            <text x="24" y="72" font-family="sans-serif" font-size="14" fill="#4b5563">Bank Transfer (15%)</text>
                                            
                                            <!-- PayPal -->
                                            <rect x="0" y="90" width="16" height="16" rx="2" fill="#8b5cf6" />
                                            <text x="24" y="102" font-family="sans-serif" font-size="14" fill="#4b5563">PayPal (12%)</text>
                                            
                                            <!-- Other -->
                                            <rect x="0" y="120" width="16" height="16" rx="2" fill="#9ca3af" />
                                            <text x="24" y="132" font-family="sans-serif" font-size="14" fill="#4b5563">Other (8%)</text>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Payment Statistics -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Payment Status Distribution -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                        <div class="px-5 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="text-sm font-semibold text-gray-700">Payment Status</h3>
                            <div class="flex space-x-1">
                                <button class="p-1 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                                <button class="p-1 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <div style="height: 300px; position: relative;">
                                <!-- Static Payment Status Chart -->
                                <div class="w-full h-full bg-white">
                                    <svg width="100%" height="100%" viewBox="0 0 800 300" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="800" height="300" fill="#fff" />
                                        
                                        <!-- Chart title -->
                                        <text x="400" y="30" font-family="sans-serif" font-size="16" fill="#1f2937" text-anchor="middle" font-weight="bold">Payment Status Distribution</text>
                                        
                                        <!-- Pie chart -->
                                        <g transform="translate(200, 150)">
                                            <!-- Paid slice - 75% -->
                                            <path d="M0,0 L0,-100 A100,100 0 0,1 70.7,70.7 Z" fill="#22c55e" />
                                            
                                            <!-- Pending slice - 18% -->
                                            <path d="M0,0 L70.7,70.7 A100,100 0 0,1 -30.9,95.1 Z" fill="#f97316" />
                                            
                                            <!-- Refunded slice - 7% -->
                                            <path d="M0,0 L-30.9,95.1 A100,100 0 0,1 0,-100 Z" fill="#ef4444" />
                                        </g>
                                        
                                        <!-- Legend -->
                                        <g transform="translate(400, 100)">
                                            <!-- Paid -->
                                            <rect x="0" y="0" width="16" height="16" rx="2" fill="#22c55e" />
                                            <text x="24" y="12" font-family="sans-serif" font-size="14" fill="#4b5563">Paid (75%)</text>
                                            
                                            <!-- Pending -->
                                            <rect x="0" y="30" width="16" height="16" rx="2" fill="#f97316" />
                                            <text x="24" y="42" font-family="sans-serif" font-size="14" fill="#4b5563">Pending (18%)</text>
                                            
                                            <!-- Refunded -->
                                            <rect x="0" y="60" width="16" height="16" rx="2" fill="#ef4444" />
                                            <text x="24" y="72" font-family="sans-serif" font-size="14" fill="#4b5563">Refunded (7%)</text>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Weekly Payment Trend -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                        <div class="px-5 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="text-sm font-semibold text-gray-700">Weekly Payment Trend</h3>
                            <div class="flex space-x-1">
                                <button class="p-1 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                                <button class="p-1 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <div style="height: 300px; position: relative;">
                                <!-- Static Weekly Payment Trend Chart -->
                                <div class="w-full h-full bg-white">
                                    <svg width="100%" height="100%" viewBox="0 0 800 300" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="800" height="300" fill="#fff" />
                                        
                                        <!-- Chart title -->
                                        <text x="400" y="30" font-family="sans-serif" font-size="16" fill="#1f2937" text-anchor="middle" font-weight="bold">Weekly Payment Trend</text>
                                        
                                        <!-- Axes -->
                                        <line x1="100" y1="250" x2="700" y2="250" stroke="#e5e7eb" stroke-width="2" />
                                        <line x1="100" y1="50" x2="100" y2="250" stroke="#e5e7eb" stroke-width="2" />
                                        
                                        <!-- Horizontal grid lines -->
                                        <line x1="100" y1="210" x2="700" y2="210" stroke="#f3f4f6" stroke-width="1" />
                                        <line x1="100" y1="170" x2="700" y2="170" stroke="#f3f4f6" stroke-width="1" />
                                        <line x1="100" y1="130" x2="700" y2="130" stroke="#f3f4f6" stroke-width="1" />
                                        <line x1="100" y1="90" x2="700" y2="90" stroke="#f3f4f6" stroke-width="1" />
                                        
                                        <!-- X Axis labels -->
                                        <text x="175" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Week 1</text>
                                        <text x="325" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Week 2</text>
                                        <text x="475" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Week 3</text>
                                        <text x="625" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Week 4</text>
                                        
                                        <!-- Y Axis labels for transactions -->
                                        <text x="80" y="250" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="end">0</text>
                                        <text x="80" y="210" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="end">10</text>
                                        <text x="80" y="170" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="end">20</text>
                                        <text x="80" y="130" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="end">30</text>
                                        <text x="80" y="90" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="end">40</text>
                                        <text x="80" y="50" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="end">50</text>
                                        
                                        <!-- Y Axis label for transactions -->
                                        <text x="40" y="150" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle" transform="rotate(-90, 40, 150)">Transactions</text>
                                        
                                        <!-- Y Axis labels for revenue -->
                                        <text x="730" y="250" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="start">$0</text>
                                        <text x="730" y="210" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="start">$2,000</text>
                                        <text x="730" y="170" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="start">$4,000</text>
                                        <text x="730" y="130" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="start">$6,000</text>
                                        <text x="730" y="90" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="start">$8,000</text>
                                        <text x="730" y="50" font-family="sans-serif" font-size="10" fill="#6b7280" text-anchor="start">$10,000</text>
                                        
                                        <!-- Y Axis label for revenue -->
                                        <text x="760" y="150" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle" transform="rotate(90, 760, 150)">Revenue ($)</text>
                                        
                                        <!-- Bar chart for transactions -->
                                        <rect x="137.5" y="170" width="75" height="80" fill="#f97316" rx="4" />
                                        <rect x="287.5" y="150" width="75" height="100" rx="4" fill="#f97316" />
                                        <rect x="437.5" y="160" width="75" height="90" rx="4" fill="#f97316" />
                                        <rect x="587.5" y="140" width="75" height="110" rx="4" fill="#f97316" />
                                        
                                        <!-- Line chart for revenue -->
                                        <path d="M175,160 L325,140 L475,150 L625,130" fill="none" stroke="#8b5cf6" stroke-width="3" stroke-linejoin="round" />
                                        
                                        <!-- Data points -->
                                        <circle cx="175" cy="160" r="5" fill="#8b5cf6" />
                                        <circle cx="325" cy="140" r="5" fill="#8b5cf6" />
                                        <circle cx="475" cy="150" r="5" fill="#8b5cf6" />
                                        <circle cx="625" cy="130" r="5" fill="#8b5cf6" />
                                        
                                        <!-- Legend -->
                                        <rect x="400" y="40" width="12" height="12" rx="2" fill="#f97316" />
                                        <text x="418" y="50" font-family="sans-serif" font-size="12" fill="#4b5563">Transactions</text>
                                        
                                        <circle cx="460" cy="46" r="6" fill="#8b5cf6" />
                                        <text x="472" y="50" font-family="sans-serif" font-size="12" fill="#4b5563">Revenue</text>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payments Table -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                        <h2 class="text-base font-medium text-gray-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Payment Records
                        </h2>
                        <div class="flex items-center space-x-3">
                            <span class="text-sm text-gray-500">{{ $payments->total() }} payments</span>
                            <div class="relative">
                                <input type="text" placeholder="Search..." class="block w-full rounded-md border-gray-300 pl-10 pr-3 py-2 text-sm focus:border-orange-500 focus:ring-orange-500">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
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
                                    <tr class="hover:bg-orange-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $payment->reference ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center shadow-sm">
                                                    <span class="text-white font-bold">
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
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if($payment->subscription->type == 'Basic') bg-blue-100 text-blue-800 border border-blue-200
                                                    @elseif($payment->subscription->type == 'Premium') bg-purple-100 text-purple-800 border border-purple-200
                                                    @else bg-green-100 text-green-800 border border-green-200 @endif">
                                                    {{ $payment->subscription->type }}
                                                </span>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            ${{ number_format($payment->amount, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($payment->date)->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex items-center">
                                                @if($payment->method == 'credit_card')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                    </svg>
                                                @elseif($payment->method == 'cash')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                @elseif($payment->method == 'bank_transfer')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                    </svg>
                                                @endif
                                                {{ ucfirst(str_replace('_', ' ', $payment->method)) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($payment->status == 'paid') bg-green-100 text-green-800 border border-green-200
                                                @elseif($payment->status == 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                                @elseif($payment->status == 'refunded') bg-red-100 text-red-800 border border-red-200
                                                @else bg-gray-100 text-gray-800 border border-gray-200 @endif">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('admin.payments.show', $payment) }}" class="text-orange-600 hover:text-orange-900 px-2 py-1 rounded-md hover:bg-orange-50 transition-colors duration-200">
                                                    <span class="sr-only">View</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                @if($payment->status == 'pending')
                                                    <form action="{{ route('admin.payments.process', $payment) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-green-600 hover:text-green-900 px-2 py-1 rounded-md hover:bg-green-50 transition-colors duration-200">
                                                            <span class="sr-only">Process</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                                @if($payment->status == 'paid')
                                                    <form action="{{ route('admin.payments.refund', $payment) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to refund this payment?');">
                                                        @csrf
                                                        <button type="submit" class="text-red-600 hover:text-red-900 px-2 py-1 rounded-md hover:bg-red-50 transition-colors duration-200">
                                                            <span class="sr-only">Refund</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-10 text-center text-sm text-gray-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                <p class="text-gray-500 font-medium">No payments found</p>
                                                <p class="text-gray-400 text-sm mt-1">Try adjusting your search filters</p>
                                                <a href="{{ route('admin.payments.create') }}" class="mt-3 inline-flex items-center px-3 py-1.5 text-sm text-orange-500 hover:text-orange-700 font-medium">
                                                    <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                    Record your first payment
                                                </a>
                                            </div>
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
<!-- Chart.js CDN (more reliable) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Document loaded, initializing charts...');
        
        // Create simple charts for placeholder display
        createSimpleCharts();
        
        // Then try to load Chart.js from CDN and create full charts
        if (typeof Chart === 'undefined') {
            console.log('Chart.js not available, loading from CDN...');
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js';
            script.onload = function() {
                console.log('Chart.js loaded successfully');
                initCharts();
            };
            script.onerror = function() {
                console.error('Failed to load Chart.js from CDN');
                displayChartFallbacks();
            };
            document.head.appendChild(script);
        } else {
            console.log('Chart.js already available');
            initCharts();
        }
        
        // Create simple placeholder charts that will work even if Chart.js fails to load
        function createSimpleCharts() {
            const chartContainers = [
                'monthlyRevenueChart', 
                'paymentMethodsChart', 
                'paymentStatusChart', 
                'weeklyTrendChart'
            ];
            
            chartContainers.forEach(id => {
                const container = document.getElementById(id);
                if (container) {
                    // Create a simple visual placeholder
                    const fallbackHtml = `
                        <div class="flex items-center justify-center h-full">
                            <div class="w-full text-center">
                                <div class="flex justify-center items-center mb-4">
                                    <div class="animate-pulse flex space-x-4">
                                        <div class="h-24 w-24 bg-orange-200 rounded-full"></div>
                                    </div>
                                </div>
                                <p class="text-gray-500 text-sm">Loading chart data...</p>
                            </div>
                        </div>
                    `;
                    container.innerHTML = fallbackHtml;
                }
            });
        }
        
        // Show an error if charts fail to load
        function displayChartFallbacks() {
            const chartContainers = [
                { id: 'monthlyRevenueChart', title: 'Monthly Revenue', type: 'line' },
                { id: 'paymentMethodsChart', title: 'Payment Methods', type: 'doughnut' },
                { id: 'paymentStatusChart', title: 'Payment Status', type: 'pie' },
                { id: 'weeklyTrendChart', title: 'Weekly Payment Trend', type: 'bar' }
            ];
            
            chartContainers.forEach(chart => {
                const container = document.getElementById(chart.id);
                if (container) {
                    // Create a fallback visualization with inline SVG
                    let fallbackSvg = '';
                    
                    if (chart.type === 'line') {
                        fallbackSvg = `<svg width="100%" height="250" viewBox="0 0 400 200" xmlns="http://www.w3.org/2000/svg">
                            <rect width="400" height="200" fill="#f9fafb" rx="4" />
                            <polyline points="50,150 100,120 150,140 200,80 250,100 300,60 350,50" 
                                    fill="none" stroke="#f97316" stroke-width="3" />
                            <line x1="50" y1="170" x2="350" y2="170" stroke="#e5e7eb" stroke-width="1" />
                            <text x="200" y="190" font-family="sans-serif" font-size="12" text-anchor="middle" fill="#6b7280">Months</text>
                        </svg>`;
                    } else if (chart.type === 'doughnut' || chart.type === 'pie') {
                        fallbackSvg = `<svg width="100%" height="250" viewBox="0 0 400 200" xmlns="http://www.w3.org/2000/svg">
                            <rect width="400" height="200" fill="#f9fafb" rx="4" />
                            <circle cx="120" cy="100" r="70" fill="#f9fafb" stroke="#e5e7eb" />
                            <path d="M 120 100 L 120 30 A 70 70 0 0 1 183 131 z" fill="#f97316" />
                            <path d="M 120 100 L 183 131 A 70 70 0 0 1 98 166 z" fill="#84cc16" />
                            <path d="M 120 100 L 98 166 A 70 70 0 0 1 120 30 z" fill="#3b82f6" />
                            <text x="260" y="80" font-family="sans-serif" font-size="12" fill="#6b7280">Category 1</text>
                            <text x="260" y="110" font-family="sans-serif" font-size="12" fill="#6b7280">Category 2</text>
                            <text x="260" y="140" font-family="sans-serif" font-size="12" fill="#6b7280">Category 3</text>
                            <circle cx="240" cy="76" r="6" fill="#f97316" />
                            <circle cx="240" cy="106" r="6" fill="#84cc16" />
                            <circle cx="240" cy="136" r="6" fill="#3b82f6" />
                        </svg>`;
                    } else { // bar chart
                        fallbackSvg = `<svg width="100%" height="250" viewBox="0 0 400 200" xmlns="http://www.w3.org/2000/svg">
                            <rect width="400" height="200" fill="#f9fafb" rx="4" />
                            <rect x="80" y="50" width="40" height="120" fill="#f97316" rx="4" />
                            <rect x="140" y="80" width="40" height="90" fill="#f97316" rx="4" />
                            <rect x="200" y="60" width="40" height="110" fill="#f97316" rx="4" />
                            <rect x="260" y="40" width="40" height="130" fill="#f97316" rx="4" />
                            <line x1="50" y1="170" x2="350" y2="170" stroke="#e5e7eb" stroke-width="1" />
                            <text x="200" y="190" font-family="sans-serif" font-size="12" text-anchor="middle" fill="#6b7280">Categories</text>
                        </svg>`;
                    }
                    
                    container.innerHTML = `
                        <div class="h-full flex flex-col">
                            <div class="flex items-center justify-between px-4 py-2 bg-orange-50 text-orange-600 text-xs font-medium">
                                <span>${chart.title} Preview</span>
                                <span>Static Visualization</span>
                            </div>
                            <div class="flex-1 flex items-center justify-center p-4 bg-white">
                                ${fallbackSvg}
                            </div>
                        </div>
                    `;
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
                'rgba(249, 115, 22, 0.7)',  // Orange
                'rgba(52, 211, 153, 0.7)',  // Green
                'rgba(99, 102, 241, 0.7)',  // Indigo
                'rgba(124, 58, 237, 0.7)',  // Purple
                'rgba(156, 163, 175, 0.7)'  // Gray
            ];
            
            const sampleStatusLabels = ['Paid', 'Pending', 'Refunded'];
            const sampleStatusData = [75, 18, 7];
            const statusColors = [
                'rgba(52, 211, 153, 0.7)',  // Green
                'rgba(251, 146, 60, 0.7)',  // Orange
                'rgba(239, 68, 68, 0.7)'    // Red
            ];
            
            const sampleWeeklyLabels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
            const sampleWeeklyTransactions = [25, 30, 28, 32];
            const sampleWeeklyRevenue = [5000, 6000, 5500, 6500];
            
            try {
                // Initialize Monthly Revenue Chart - simplify Chart.js config for better compatibility
                const monthlyChartCtx = document.getElementById('monthlyRevenueChart');
                if (monthlyChartCtx) {
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
                    
                    new Chart(monthlyChartCtx, {
                        type: 'line',
                        data: {
                            labels: monthlyLabels,
                            datasets: [{
                                label: 'Revenue',
                                backgroundColor: 'rgba(249, 115, 22, 0.1)',
                                borderColor: 'rgb(249, 115, 22)',
                                data: monthlyData,
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
                                            return `${context.raw.toLocaleString()}`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return ' + value.toLocaleString();
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
                
                // Initialize Payment Methods Chart
                const methodsChartCtx = document.getElementById('paymentMethodsChart');
                if (methodsChartCtx) {
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
                    
                    new Chart(methodsChartCtx, {
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
                const statusChartCtx = document.getElementById('paymentStatusChart');
                if (statusChartCtx) {
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
                    
                    new Chart(statusChartCtx, {
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
                const trendChartCtx = document.getElementById('weeklyTrendChart');
                if (trendChartCtx) {
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
                    
                    new Chart(trendChartCtx, {
                        type: 'bar',
                        data: {
                            labels: weeklyLabels,
                            datasets: [{
                                label: 'Transactions',
                                backgroundColor: 'rgba(249, 115, 22, 0.65)',
                                data: weeklyTransactions,
                                order: 2
                            }, {
                                label: 'Revenue ($)',
                                backgroundColor: 'rgba(124, 58, 237, 0.2)',
                                borderColor: 'rgb(124, 58, 237)',
                                data: weeklyRevenue,
                                type: 'line',
                                order: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Transactions'
                                    }
                                }
                            }
                        }
                    });
                }
                
                console.log('All charts initialized successfully');
                
            } catch (error) {
                console.error('Error initializing charts:', error);
                displayChartFallbacks();
            }
        }
    });
</script>
@endpush
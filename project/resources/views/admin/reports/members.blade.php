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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Member Reports
                            </h1>
                            <p class="mt-1 text-orange-50 text-sm flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Analyze member demographics, trends, and activity metrics
                            </p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.reports.members') }}" 
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
                <!-- Member Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Members Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-200 hover:shadow-lg hover:scale-[1.02] border border-gray-100">
                        <div class="p-5 flex items-center">
                            <div class="rounded-full bg-orange-100 p-3 mr-4 flex-shrink-0 shadow-sm">
                                <svg class="h-8 w-8 text-orange-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-500">Total Members</div>
                                <div class="text-2xl font-bold text-gray-900">{{ count($members) }}</div>
                                <div class="mt-1 text-xs font-medium text-orange-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    All registered members
                                </div>
                            </div>
                        </div>
                        <div class="bg-orange-50 px-5 py-2 text-xs font-medium text-orange-700">
                            Member database
                        </div>
                    </div>

                    <!-- Active Members Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-200 hover:shadow-lg hover:scale-[1.02] border border-gray-100">
                        <div class="p-5 flex items-center">
                            <div class="rounded-full bg-green-100 p-3 mr-4 flex-shrink-0 shadow-sm">
                                <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-500">Active Members</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $activeMembers }}</div>
                                <div class="text-sm text-gray-500">
                                    <span class="text-xs font-medium text-green-600 flex items-center mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        {{ round(($activeMembers / count($members)) * 100) }}% of total
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-green-50 px-5 py-2 text-xs font-medium text-green-700">
                            Currently active
                        </div>
                    </div>

                    <!-- Inactive Members Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-200 hover:shadow-lg hover:scale-[1.02] border border-gray-100">
                        <div class="p-5 flex items-center">
                            <div class="rounded-full bg-red-100 p-3 mr-4 flex-shrink-0 shadow-sm">
                                <svg class="h-8 w-8 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-500">Inactive Members</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $inactiveMembers }}</div>
                                <div class="text-sm text-gray-500">
                                    <span class="text-xs font-medium text-red-600 flex items-center mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ round(($inactiveMembers / count($members)) * 100) }}% of total
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="bg-red-50 px-5 py-2 text-xs font-medium text-red-700">
                            Requires attention
                        </div>
                    </div>

                    <!-- New Members Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-200 hover:shadow-lg hover:scale-[1.02] border border-gray-100">
                        <div class="p-5 flex items-center">
                            <div class="rounded-full bg-blue-100 p-3 mr-4 flex-shrink-0 shadow-sm">
                                <svg class="h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-500">New This Month</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $newMembers }}</div>
                                <div class="mt-1 text-xs font-medium text-blue-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Recent signups
                                </div>
                            </div>
                        </div>
                        <div class="bg-blue-50 px-5 py-2 text-xs font-medium text-blue-700">
                            New acquisitions
                        </div>
                    </div>
                </div>

                <!-- Monthly Signups Chart -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8 border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                        <h2 class="text-lg font-medium text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Monthly Signups (Last 12 Months)
                        </h2>
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
                    <div class="p-6">
                        <div style="height: 300px; position: relative;">
                            <!-- Static Monthly Signups Chart -->
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
                                    <text x="40" y="250" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">0</text>
                                    <text x="40" y="210" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">5</text>
                                    <text x="40" y="170" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">10</text>
                                    <text x="40" y="130" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">15</text>
                                    <text x="40" y="90" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">20</text>
                                    <text x="40" y="50" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">25</text>
                                    
                                    <!-- Chart title -->
                                    <text x="400" y="30" font-family="sans-serif" font-size="16" fill="#1f2937" text-anchor="middle" font-weight="bold">New Member Signups Per Month</text>
                                    
                                    <!-- Bar chart -->
                                    <rect x="80" y="230" width="40" height="20" fill="rgba(249, 115, 22, 0.7)" rx="3" />
                                    <rect x="137" y="210" width="40" height="40" fill="rgba(249, 115, 22, 0.7)" rx="3" />
                                    <rect x="194" y="190" width="40" height="60" fill="rgba(249, 115, 22, 0.7)" rx="3" />
                                    <rect x="251" y="170" width="40" height="80" fill="rgba(249, 115, 22, 0.7)" rx="3" />
                                    <rect x="308" y="150" width="40" height="100" fill="rgba(249, 115, 22, 0.7)" rx="3" />
                                    <rect x="365" y="130" width="40" height="120" fill="rgba(249, 115, 22, 0.7)" rx="3" />
                                    <rect x="422" y="190" width="40" height="60" fill="rgba(249, 115, 22, 0.7)" rx="3" />
                                    <rect x="479" y="210" width="40" height="40" fill="rgba(249, 115, 22, 0.7)" rx="3" />
                                    <rect x="536" y="170" width="40" height="80" fill="rgba(249, 115, 22, 0.7)" rx="3" />
                                    <rect x="593" y="130" width="40" height="120" fill="rgba(249, 115, 22, 0.7)" rx="3" />
                                    <rect x="650" y="170" width="40" height="80" fill="rgba(249, 115, 22, 0.7)" rx="3" />
                                    <rect x="707" y="130" width="40" height="120" fill="rgba(249, 115, 22, 0.7)" rx="3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member Demographics -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Subscription Types Distribution -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                            <h2 class="text-lg font-medium text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                </svg>
                                Subscription Types Distribution
                            </h2>
                            <div class="flex space-x-1">
                                <button class="p-1 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="p-6">
                            <div style="height: 300px; position: relative;">
                                <!-- Static Subscription Types Chart -->
                                <div class="w-full h-full bg-white">
                                    <svg width="100%" height="100%" viewBox="0 0 800 300" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="800" height="300" fill="#fff" />
                                        
                                        <!-- Chart title -->
                                        <text x="400" y="30" font-family="sans-serif" font-size="16" fill="#1f2937" text-anchor="middle" font-weight="bold">Subscription Types Distribution</text>
                                        
                                        <!-- Donut chart -->
                                        <g transform="translate(170, 150)">
                                            <!-- Basic slice - 45% -->
                                            <path d="M0,0 L0,-100 A100,100 0 0,1 76.6,64.3 Z" fill="#3b82f6" />
                                            
                                            <!-- Premium slice - 30% -->
                                            <path d="M0,0 L76.6,64.3 A100,100 0 0,1 -50,86.6 Z" fill="#8b5cf6" />
                                            
                                            <!-- Elite slice - 15% -->
                                            <path d="M0,0 L-50,86.6 A100,100 0 0,1 -95.1,-30.9 Z" fill="#10b981" />
                                            
                                            <!-- None slice - 10% -->
                                            <path d="M0,0 L-95.1,-30.9 A100,100 0 0,1 0,-100 Z" fill="#d1d5db" />
                                            
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
                                            <text x="24" y="72" font-family="sans-serif" font-size="14" fill="#4b5563">Elite (15%)</text>
                                            
                                            <!-- None -->
                                            <rect x="0" y="90" width="16" height="16" rx="2" fill="#d1d5db" />
                                            <text x="24" y="102" font-family="sans-serif" font-size="14" fill="#4b5563">None (10%)</text>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Level Distribution -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                            <h2 class="text-lg font-medium text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Member Activity Levels
                            </h2>
                            <div class="flex space-x-1">
                                <button class="p-1 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="p-6">
                            <div style="height: 300px; position: relative;">
                                <!-- Static Activity Levels Chart -->
                                <div class="w-full h-full bg-white">
                                    <svg width="100%" height="100%" viewBox="0 0 800 300" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="800" height="300" fill="#fff" />
                                        
                                        <!-- Chart title -->
                                        <text x="400" y="30" font-family="sans-serif" font-size="16" fill="#1f2937" text-anchor="middle" font-weight="bold">Member Activity Levels</text>
                                        
                                        <!-- Pie chart -->
                                        <g transform="translate(170, 150)">
                                            <!-- Highly Active slice - 15% -->
                                            <path d="M0,0 L0,-100 A100,100 0 0,1 50,86.6 Z" fill="#10b981" />
                                            
                                            <!-- Active slice - 25% -->
                                            <path d="M0,0 L50,86.6 A100,100 0 0,1 -64.3,76.6 Z" fill="#3b82f6" />
                                            
                                            <!-- Moderately Active slice - 30% -->
                                            <path d="M0,0 L-64.3,76.6 A100,100 0 0,1 -93.97,-34.2 Z" fill="#f59e0b" />
                                            
                                            <!-- Low Activity slice - 30% -->
                                            <path d="M0,0 L-93.97,-34.2 A100,100 0 0,1 0,-100 Z" fill="#ef4444" />
                                        </g>
                                        
                                        <!-- Legend -->
                                        <g transform="translate(400, 80)">
                                            <!-- Highly Active -->
                                            <rect x="0" y="0" width="16" height="16" rx="2" fill="#10b981" />
                                            <text x="24" y="12" font-family="sans-serif" font-size="14" fill="#4b5563">Highly Active (15%)</text>
                                            
                                            <!-- Active -->
                                            <rect x="0" y="30" width="16" height="16" rx="2" fill="#3b82f6" />
                                            <text x="24" y="42" font-family="sans-serif" font-size="14" fill="#4b5563">Active (25%)</text>
                                            
                                            <!-- Moderately Active -->
                                            <rect x="0" y="60" width="16" height="16" rx="2" fill="#f59e0b" />
                                            <text x="24" y="72" font-family="sans-serif" font-size="14" fill="#4b5563">Moderately Active (30%)</text>
                                            
                                            <!-- Low Activity -->
                                            <rect x="0" y="90" width="16" height="16" rx="2" fill="#ef4444" />
                                            <text x="24" y="102" font-family="sans-serif" font-size="14" fill="#4b5563">Low Activity (30%)</text>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Members with Most Attendance -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200 mb-8">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                        <h2 class="text-base font-medium text-gray-700 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            Top 10 Most Active Members
                        </h2>
                        <div class="flex items-center space-x-3">
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
                                    <tr class="hover:bg-orange-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center shadow-sm">
                                                    <span class="text-white font-bold">
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
                                                
                                                $badgeClass = 'bg-gray-100 text-gray-800 border border-gray-200';
                                                if ($subscriptionType === 'Basic') {
                                                    $badgeClass = 'bg-blue-100 text-blue-800 border border-blue-200';
                                                } elseif ($subscriptionType === 'Premium') {
                                                    $badgeClass = 'bg-purple-100 text-purple-800 border border-purple-200';
                                                } elseif ($subscriptionType === 'Elite') {
                                                    $badgeClass = 'bg-green-100 text-green-800 border border-green-200';
                                                }
                                            @endphp
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClass }}">
                                                {{ $subscriptionType }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($member->registrationDate)->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="text-sm font-semibold text-gray-900 mr-2">{{ $member->attendances_count }}</span>
                                                <div class="w-24 bg-gray-200 rounded-full h-2">
                                                    @php
                                                        $maxAttendance = $membersWithMostAttendance->max('attendances_count');
                                                        $percentage = ($maxAttendance > 0) ? ($member->attendances_count / $maxAttendance) * 100 : 0;
                                                    @endphp
                                                    <div class="bg-orange-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                <p class="text-gray-500 font-medium">No attendance records found</p>
                                                <p class="text-gray-400 text-sm mt-1">Members haven't attended any sessions yet</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Retention Analysis -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                        <h2 class="text-lg font-medium text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                            Member Retention Analysis
                        </h2>
                        <div class="flex space-x-1">
                            <button class="p-1 text-xs text-gray-500 hover:text-orange-600 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <!-- Average Membership Duration -->
                            <div class="bg-orange-50 rounded-lg p-4 transform transition-all duration-200 hover:shadow-md hover:scale-[1.02]">
                                <p class="text-sm text-orange-700 font-medium flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Avg. Membership Duration
                                </p>
                                <p class="text-2xl font-bold text-orange-900">{{ $avgMembershipMonths }} months</p>
                            </div>
                            
                            <!-- Renewal Rate -->
                            <div class="bg-green-50 rounded-lg p-4 transform transition-all duration-200 hover:shadow-md hover:scale-[1.02]">
                                <p class="text-sm text-green-700 font-medium flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Subscription Renewal Rate
                                </p>
                                <p class="text-2xl font-bold text-green-900">{{ $renewalRate }}%</p>
                            </div>
                            
                            <!-- Churn Rate -->
                            <div class="bg-red-50 rounded-lg p-4 transform transition-all duration-200 hover:shadow-md hover:scale-[1.02]">
                                <p class="text-sm text-red-700 font-medium flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Monthly Churn Rate
                                </p>
                                <p class="text-2xl font-bold text-red-900">{{ $churnRate }}%</p>
                            </div>
                        </div>
                        
                        <!-- Retention Chart -->
                        <div style="height: 300px; position: relative;">
                            <!-- Static Retention Chart -->
                            <div class="w-full h-full bg-white">
                                <svg width="100%" height="100%" viewBox="0 0 800 300" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="800" height="300" fill="#fff" />
                                    <!-- Axes -->
                                    <line x1="50" y1="250" x2="750" y2="250" stroke="#e5e7eb" stroke-width="2" />
                                    <line x1="50" y1="50" x2="50" y2="250" stroke="#e5e7eb" stroke-width="2" />
                                    
                                    <!-- Horizontal grid lines -->
                                    <line x1="50" y1="200" x2="750" y2="200" stroke="#f3f4f6" stroke-width="1" />
                                    <line x1="50" y1="150" x2="750" y2="150" stroke="#f3f4f6" stroke-width="1" />
                                    <line x1="50" y1="100" x2="750" y2="100" stroke="#f3f4f6" stroke-width="1" />
                                    
                                    <!-- X Axis labels -->
                                    <text x="100" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Jan</text>
                                    <text x="160" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Feb</text>
                                    <text x="220" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Mar</text>
                                    <text x="280" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Apr</text>
                                    <text x="340" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">May</text>
                                    <text x="400" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Jun</text>
                                    <text x="460" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Jul</text>
                                    <text x="520" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Aug</text>
                                    <text x="580" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Sep</text>
                                    <text x="640" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Oct</text>
                                    <text x="700" y="270" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="middle">Nov</text>
                                    
                                    <!-- Y Axis labels -->
                                    <text x="40" y="250" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">0%</text>
                                    <text x="40" y="200" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">25%</text>
                                    <text x="40" y="150" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">50%</text>
                                    <text x="40" y="100" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">75%</text>
                                    <text x="40" y="50" font-family="sans-serif" font-size="12" fill="#6b7280" text-anchor="end">100%</text>
                                    
                                    <!-- Chart title -->
                                    <text x="400" y="30" font-family="sans-serif" font-size="16" fill="#1f2937" text-anchor="middle" font-weight="bold">Member Retention Rate by Month</text>
                                    
                                    <!-- Line chart data area -->
                                    <defs>
                                        <linearGradient id="areaGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                            <stop offset="0%" stop-color="rgba(249, 115, 22, 0.4)" />
                                            <stop offset="100%" stop-color="rgba(249, 115, 22, 0.05)" />
                                        </linearGradient>
                                    </defs>
                                    
                                    <!-- Area under line -->
                                    <path d="M100,100 L160,105 L220,110 L280,100 L340,90 L400,95 L460,85 L520,90 L580,80 L640,70 L700,75 L700,250 L100,250 Z" fill="url(#areaGradient)" />
                                    
                                    <!-- Line chart line -->
                                    <path d="M100,100 L160,105 L220,110 L280,100 L340,90 L400,95 L460,85 L520,90 L580,80 L640,70 L700,75" fill="none" stroke="#f97316" stroke-width="3" stroke-linejoin="round" />
                                    
                                    <!-- Data points -->
                                    <circle cx="100" cy="100" r="4" fill="#f97316" />
                                    <circle cx="160" cy="105" r="4" fill="#f97316" />
                                    <circle cx="220" cy="110" r="4" fill="#f97316" />
                                    <circle cx="280" cy="100" r="4" fill="#f97316" />
                                    <circle cx="340" cy="90" r="4" fill="#f97316" />
                                    <circle cx="400" cy="95" r="4" fill="#f97316" />
                                    <circle cx="460" cy="85" r="4" fill="#f97316" />
                                    <circle cx="520" cy="90" r="4" fill="#f97316" />
                                    <circle cx="580" cy="80" r="4" fill="#f97316" />
                                    <circle cx="640" cy="70" r="4" fill="#f97316" />
                                    <circle cx="700" cy="75" r="4" fill="#f97316" />
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
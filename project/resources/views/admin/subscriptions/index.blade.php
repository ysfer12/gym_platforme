@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Include the admin sidebar -->
        @include('partials.admin-sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Page Header -->
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h1 class="text-3xl font-bold tracking-tight flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                                Subscriptions Management
                            </h1>
                            <p class="mt-1 text-orange-50 text-sm flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Manage your gym membership subscriptions and plans
                            </p>
                        </div>
                        <div class="mt-4 md:mt-0 flex space-x-3">
                            <a href="{{ route('admin.subscriptions.report') }}" 
                               class="inline-flex items-center px-4 py-2 border border-white border-opacity-20 rounded-lg text-sm font-medium text-white bg-white bg-opacity-10 hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-orange-500 focus:ring-white transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                View Reports
                            </a>
                          
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subscription Stats Cards -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Active Subscriptions Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-200 hover:shadow-lg hover:scale-[1.02] border border-gray-100">
                        <div class="p-5 flex items-center">
                            <div class="rounded-full bg-green-100 p-3 mr-4 flex-shrink-0">
                                <svg class="h-8 w-8 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-500">Active Subscriptions</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $activeCount }}</div>
                                <div class="mt-1 text-xs font-medium text-green-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    {{ round(($activeCount / max(1, $activeCount + $expiredCount + $cancelledCount + $pendingCount)) * 100) }}% of total
                                </div>
                            </div>
                        </div>
                        <div class="bg-green-50 px-5 py-2 text-xs font-medium text-green-700">
                            Currently active members
                        </div>
                    </div>

                    <!-- Expired Subscriptions Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-200 hover:shadow-lg hover:scale-[1.02] border border-gray-100">
                        <div class="p-5 flex items-center">
                            <div class="rounded-full bg-yellow-100 p-3 mr-4 flex-shrink-0">
                                <svg class="h-8 w-8 text-yellow-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-500">Expired Subscriptions</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $expiredCount }}</div>
                                <div class="mt-1 text-xs font-medium text-yellow-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                                    </svg>
                                    Need renewal
                                </div>
                            </div>
                        </div>
                        <div class="bg-yellow-50 px-5 py-2 text-xs font-medium text-yellow-700">
                            Expired in the past 30 days
                        </div>
                    </div>

                    <!-- Cancelled Subscriptions Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-200 hover:shadow-lg hover:scale-[1.02] border border-gray-100">
                        <div class="p-5 flex items-center">
                            <div class="rounded-full bg-red-100 p-3 mr-4 flex-shrink-0">
                                <svg class="h-8 w-8 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-500">Cancelled Subscriptions</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $cancelledCount }}</div>
                                <div class="mt-1 text-xs font-medium text-red-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    Lost members
                                </div>
                            </div>
                        </div>
                        <div class="bg-red-50 px-5 py-2 text-xs font-medium text-red-700">
                            Follow up recommended
                        </div>
                    </div>

                    <!-- Pending Subscriptions Card -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-all duration-200 hover:shadow-lg hover:scale-[1.02] border border-gray-100">
                        <div class="p-5 flex items-center">
                            <div class="rounded-full bg-blue-100 p-3 mr-4 flex-shrink-0">
                                <svg class="h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-500">Pending Subscriptions</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $pendingCount }}</div>
                                <div class="mt-1 text-xs font-medium text-blue-600 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Awaiting approval
                                </div>
                            </div>
                        </div>
                        <div class="bg-blue-50 px-5 py-2 text-xs font-medium text-blue-700">
                            Requires attention
                        </div>
                    </div>
                </div>

                <!-- Subscriptions Table -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                    <div class="px-6 py-5 border-b border-gray-200 bg-gray-50 flex flex-col md:flex-row md:items-center md:justify-between space-y-2 md:space-y-0">
                        <h2 class="text-lg font-medium text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            All Subscriptions
                        </h2>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.subscriptions.report') }}" class="inline-flex items-center px-3 py-1.5 border border-orange-200 rounded-md shadow-sm text-sm font-medium text-orange-600 bg-white hover:bg-orange-50 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                </svg>
                                Generate Report
                            </a>
                            <a href="{{ route('admin.subscriptions.export') }}" class="inline-flex items-center px-3 py-1.5 border border-orange-200 rounded-md shadow-sm text-sm font-medium text-orange-600 bg-white hover:bg-orange-50 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Export CSV
                            </a>
                        </div>
                    </div>
                    
                    <!-- Search and Filter Section -->
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <div class="flex flex-col md:flex-row md:items-center space-y-3 md:space-y-0 md:space-x-4">
                            <div class="w-full md:w-64">
                                <label for="search" class="sr-only">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="search" name="search" id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-orange-500 focus:border-orange-500 sm:text-sm" placeholder="Search subscriptions...">
                                </div>
                            </div>
                            
                            <div class="flex flex-wrap items-center gap-2">
                                <select id="status-filter" class="block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm rounded-md">
                                    <option value="">All Statuses</option>
                                    <option value="active">Active</option>
                                    <option value="pending">Pending</option>
                                    <option value="expired">Expired</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                                
                                <select id="type-filter" class="block pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm rounded-md">
                                    <option value="">All Types</option>
                                    <option value="Basic">Basic</option>
                                    <option value="Premium">Premium</option>
                                    <option value="Elite">Elite</option>
                                </select>
                                
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                    </svg>
                                    Filter
                                </button>
                                
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Reset
                                </button>
                            </div>
                        </div>
                    </div>
                    
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
                                        Period
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Payment Method
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($subscriptions as $subscription)
                                    <tr class="hover:bg-orange-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center shadow">
                                                    <span class="text-white font-bold">
                                                        {{ substr($subscription->user->firstname, 0, 1) }}{{ substr($subscription->user->lastname, 0, 1) }}
                                                    </span>
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
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($subscription->type == 'Basic') bg-blue-100 text-blue-800 border border-blue-200
                                                @elseif($subscription->type == 'Premium') bg-purple-100 text-purple-800 border border-purple-200
                                                @else bg-green-100 text-green-800 border border-green-200 @endif">
                                                {{ $subscription->type }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex flex-col">
                                                <span>{{ \Carbon\Carbon::parse($subscription->start_date)->format('M d, Y') }}</span>
                                                <span class="flex items-center text-xs text-gray-400 mt-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($subscription->end_date)->format('M d, Y') }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            ${{ number_format($subscription->price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($subscription->status == 'active') bg-green-100 text-green-800 border border-green-200
                                                @elseif($subscription->status == 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                                @elseif($subscription->status == 'cancelled') bg-red-100 text-red-800 border border-red-200
                                                @else bg-gray-100 text-gray-800 border border-gray-200 @endif">
                                                {{ ucfirst($subscription->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if($subscription->payment_method)
                                                <div class="flex items-center">
                                                    @if($subscription->payment_method == 'credit_card')
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                        </svg>
                                                    @elseif($subscription->payment_method == 'cash')
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                        </svg>
                                                    @elseif($subscription->payment_method == 'bank_transfer')
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                                        </svg>
                                                    @elseif($subscription->payment_method == 'stripe')
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                        </svg>
                                                    @endif
                                                    {{ ucwords(str_replace('_', ' ', $subscription->payment_method)) }}
                                                </div>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('admin.subscriptions.show', $subscription) }}" class="text-orange-600 hover:text-orange-900 px-2 py-1 rounded-md hover:bg-orange-50 transition-colors duration-200">
                                                    <span class="sr-only">View</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('admin.subscriptions.edit', $subscription) }}" class="text-blue-600 hover:text-blue-900 px-2 py-1 rounded-md hover:bg-blue-50 transition-colors duration-200">
                                                    <span class="sr-only">Edit</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                @if($subscription->status == 'active')
                                                    <button type="button" onclick="openRenewModal({{ $subscription->id }})" class="text-green-600 hover:text-green-900 px-2 py-1 rounded-md hover:bg-green-50 transition-colors duration-200">
                                                        <span class="sr-only">Renew</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                        </svg>
                                                    </button>
                                                @endif
                                                @if($subscription->status != 'cancelled')
                                                    <form action="{{ route('admin.subscriptions.cancel', $subscription) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel this subscription?');">
                                                        @csrf
                                                        <button type="submit" class="text-red-600 hover:text-red-900 px-2 py-1 rounded-md hover:bg-red-50 transition-colors duration-200">
                                                            <span class="sr-only">Cancel</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-10 text-center text-sm text-gray-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                                </svg>
                                                <p class="text-gray-500 font-medium">No subscriptions found</p>
                                                <p class="text-gray-400 text-sm mt-1">Try adjusting your search filters</p>
                                                <a href="{{ route('admin.subscriptions.create') }}" class="mt-3 inline-flex items-center px-3 py-1.5 text-sm text-orange-500 hover:text-orange-700 font-medium">
                                                    <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                    Create your first subscription
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
                        {{ $subscriptions->links() }}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        @include('partials.admin-mobile-menu')
    </div>
</div>

<!-- Renew Subscription Modal -->
<div id="renewModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="renewForm" method="POST" action="">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-orange-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Renew Subscription
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Please enter the details to renew this subscription.
                                </p>
                            </div>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label for="duration" class="block text-sm font-medium text-gray-700">Duration (months)</label>
                                    <select name="duration" id="duration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm">
                                        <option value="1">1 month</option>
                                        <option value="3">3 months</option>
                                        <option value="6">6 months</option>
                                        <option value="12">12 months</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">$</span>
                                        </div>
                                        <input type="number" name="price" id="price" step="0.01" min="0" class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" placeholder="0.00">
                                    </div>
                                </div>
                                <div>
                                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm">
                                        <option value="cash">Cash</option>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                        <option value="stripe">Stripe</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="transaction_number" class="block text-sm font-medium text-gray-700">Transaction Number (optional)</label>
                                    <input type="text" name="transaction_number" id="transaction_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-600 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                        Renew
                    </button>
                    <button type="button" onclick="closeRenewModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openRenewModal(subscriptionId) {
        document.getElementById('renewForm').action = `/admin/subscriptions/${subscriptionId}/renew`;
        document.getElementById('renewModal').classList.remove('hidden');
    }
    
    function closeRenewModal() {
        document.getElementById('renewModal').classList.add('hidden');
    }
    
    // Close modal when clicking outside of it
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('renewModal');
        if (event.target === modal) {
            closeRenewModal();
        }
    });
    
    // ESC key to close modal
    window.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeRenewModal();
        }
    });
</script>
@endpush
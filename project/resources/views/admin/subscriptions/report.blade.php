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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Subscription Reports
                            </h1>
                            <p class="mt-1 text-orange-50 text-sm flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Subscription analytics and key performance metrics
                            </p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <a href="{{ route('admin.subscriptions.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-white border-opacity-25 rounded-lg shadow-sm text-sm font-medium text-white bg-white bg-opacity-10 hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-orange-500 focus:ring-white transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back to Subscriptions
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Content -->
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <!-- Date Range Filter -->
                <div class="bg-white shadow-md rounded-lg p-6 mb-8 border border-gray-200">
                    <h2 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Filter Report Period
                    </h2>
                    <form action="{{ route('admin.subscriptions.report') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                        <div class="md:col-span-2">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="date" name="start_date" id="start_date" value="{{ request('start_date', now()->subMonths(6)->format('Y-m-d')) }}" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm transition-colors duration-200">
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input type="date" name="end_date" id="end_date" value="{{ request('end_date', now()->format('Y-m-d')) }}" class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm transition-colors duration-200">
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                Apply Filters
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Subscription Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
                    <!-- Total Subscriptions -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-200 hover:shadow-lg hover:translate-y-[-2px] border border-gray-200">
                        <div class="p-5">
                            <div class="flex items-center mb-3">
                                <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Total Subscriptions</h3>
                            </div>
                            <p class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                            <div class="mt-1 text-sm text-gray-500">All time subscriptions</div>
                        </div>
                    </div>

                    <!-- Active Subscriptions -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-200 hover:shadow-lg hover:translate-y-[-2px] border border-gray-200">
                        <div class="p-5">
                            <div class="flex items-center mb-3">
                                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Active</h3>
                            </div>
                            <p class="text-3xl font-bold text-green-600">{{ $stats['active'] }}</p>
                            <div class="mt-2 flex items-center">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['active'] / $stats['total']) * 100 : 0 }}%"></div>
                                </div>
                                <span class="ml-2 text-sm text-gray-500">{{ $stats['total'] > 0 ? round(($stats['active'] / $stats['total']) * 100) : 0 }}%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Subscriptions -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-200 hover:shadow-lg hover:translate-y-[-2px] border border-gray-200">
                        <div class="p-5">
                            <div class="flex items-center mb-3">
                                <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Pending</h3>
                            </div>
                            <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
                            <div class="mt-2 flex items-center">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-600 h-2 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['pending'] / $stats['total']) * 100 : 0 }}%"></div>
                                </div>
                                <span class="ml-2 text-sm text-gray-500">{{ $stats['total'] > 0 ? round(($stats['pending'] / $stats['total']) * 100) : 0 }}%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Expired Subscriptions -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-200 hover:shadow-lg hover:translate-y-[-2px] border border-gray-200">
                        <div class="p-5">
                            <div class="flex items-center mb-3">
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Expired</h3>
                            </div>
                            <p class="text-3xl font-bold text-gray-600">{{ $stats['expired'] }}</p>
                            <div class="mt-2 flex items-center">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-gray-600 h-2 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['expired'] / $stats['total']) * 100 : 0 }}%"></div>
                                </div>
                                <span class="ml-2 text-sm text-gray-500">{{ $stats['total'] > 0 ? round(($stats['expired'] / $stats['total']) * 100) : 0 }}%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Cancelled Subscriptions -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-200 hover:shadow-lg hover:translate-y-[-2px] border border-gray-200">
                        <div class="p-5">
                            <div class="flex items-center mb-3">
                                <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Cancelled</h3>
                            </div>
                            <p class="text-3xl font-bold text-red-600">{{ $stats['cancelled'] }}</p>
                            <div class="mt-2 flex items-center">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-red-600 h-2 rounded-full" style="width: {{ $stats['total'] > 0 ? ($stats['cancelled'] / $stats['total']) * 100 : 0 }}%"></div>
                                </div>
                                <span class="ml-2 text-sm text-gray-500">{{ $stats['total'] > 0 ? round(($stats['cancelled'] / $stats['total']) * 100) : 0 }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Subscriptions by Type -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                            <h2 class="text-lg font-medium text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                Subscriptions by Type
                            </h2>
                            <div class="flex items-center">
                                <span class="hidden md:inline-block px-3 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-full">
                                    Active subscriptions only
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            @if($subscriptionsByType->isNotEmpty())
                                <div class="space-y-6">
                                    @foreach($subscriptionsByType as $typeData)
                                        <div>
                                            <div class="flex justify-between text-sm mb-2">
                                                <span class="font-medium flex items-center">
                                                    <span class="inline-block w-3 h-3 rounded-sm mr-2
                                                        @if($typeData->type == 'Basic') bg-blue-500
                                                        @elseif($typeData->type == 'Premium') bg-purple-500
                                                        @else bg-green-500 @endif"></span>
                                                    {{ $typeData->type }} Membership
                                                </span>
                                                <span class="font-semibold">{{ $typeData->count }} 
                                                    <span class="text-gray-500 text-xs">({{ $stats['active'] > 0 ? round(($typeData->count / $stats['active']) * 100) : 0 }}%)</span>
                                                </span>
                                            </div>
                                            <div class="relative">
                                                <div class="w-full bg-gray-200 rounded-full h-3">
                                                    <div class="h-3 rounded-full shadow-inner transition-all duration-500 
                                                        @if($typeData->type == 'Basic') bg-blue-500
                                                        @elseif($typeData->type == 'Premium') bg-purple-500
                                                        @else bg-green-500 @endif" 
                                                        style="width: {{ $stats['active'] > 0 ? ($typeData->count / $stats['active']) * 100 : 0 }}%">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <!-- Pie Chart -->
                                <div class="mt-8">
                                    <canvas id="subscriptionTypeChart" height="240"></canvas>
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center py-12">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <p class="text-gray-500 text-center">No active subscriptions found.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Monthly Revenue Chart -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                            <h2 class="text-lg font-medium text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Monthly Revenue ({{ date('Y') }})
                            </h2>
                            <div class="flex items-center">
                                <button id="exportRevenueData" class="text-sm text-orange-600 hover:text-orange-700 focus:outline-none hidden sm:block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Export
                                </button>
                            </div>
                        </div>
                        <div class="p-6">
                            <canvas id="revenueChart" class="w-full"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Recent Subscriptions -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Recent Subscriptions
                            </h2>
                            <p class="mt-1 text-sm text-gray-500">
                                Most recently created subscriptions
                            </p>
                        </div>
                        <a href="{{ route('admin.subscriptions.index') }}" class="text-sm font-medium text-orange-600 hover:text-orange-700 flex items-center">
                            View All
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
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
                                    <tr class="hover:bg-orange-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center text-white font-bold shadow">
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
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($subscription->type == 'Basic') bg-blue-100 text-blue-800 border border-blue-200
                                                @elseif($subscription->type == 'Premium') bg-purple-100 text-purple-800 border border-purple-200
                                                @else bg-green-100 text-green-800 border border-green-200 @endif">
                                                {{ $subscription->type }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $subscription->duration }} {{ Str::plural('month', $subscription->duration) }}
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
                                            {{ $subscription->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.subscriptions.show', $subscription) }}" class="text-orange-600 hover:text-orange-900 px-2 py-1 rounded-md hover:bg-orange-50 transition-colors duration-200">
                                                <span class="sr-only">View</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-10 text-center text-sm text-gray-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                                </svg>
                                                <p class="text-gray-500 font-medium">No recent subscriptions found</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const chartData = @json($chartData);
        
        // Debug: Log the chart data to console
        console.log('Chart Data:', chartData);
        
        // Create an array from the chartData object
        let chartValues = [];
        for (let i = 1; i <= 12; i++) {
            chartValues.push(chartData[i] || 0);
        }
        
        // Debug: Log the processed values
        console.log('Chart Values:', chartValues);
        
        const revenueData = {
            labels: months,
            datasets: [{
                label: 'Revenue ($)',
                data: chartValues,
                backgroundColor: 'rgba(249, 115, 22, 0.2)',
                borderColor: 'rgba(249, 115, 22, 1)',
                borderWidth: 2,
                tension: 0.4,
                borderRadius: 4,
                hoverBackgroundColor: 'rgba(249, 115, 22, 0.4)'
            }]
        };
        
        const revenueConfig = {
            type: 'bar',
            data: revenueData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        bodyFont: {
                            family: 'Inter, system-ui, sans-serif',
                            size: 14
                        },
                        bodyColor: '#fff',
                        boxPadding: 8,
                        padding: 12,
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
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return '$' + value;
                            },
                            font: {
                                family: 'Inter, system-ui, sans-serif'
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'Inter, system-ui, sans-serif'
                            }
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuart'
                }
            }
        };
        
        // Create the revenue chart
        new Chart(revenueCtx, revenueConfig);
        
        // Subscriptions Type Pie Chart
        if (document.getElementById('subscriptionTypeChart')) {
            const typeCtx = document.getElementById('subscriptionTypeChart').getContext('2d');
            const subscriptionTypes = @json($subscriptionsByType);
            
            console.log('Subscription Types:', subscriptionTypes);
            
            const typeData = {
                labels: subscriptionTypes.map(type => type.type + ' Membership'),
                datasets: [{
                    data: subscriptionTypes.map(type => type.count),
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)',   // Blue for Basic
                        'rgba(147, 51, 234, 0.8)',   // Purple for Premium
                        'rgba(16, 185, 129, 0.8)'    // Green for Elite/Other
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(147, 51, 234, 1)',
                        'rgba(16, 185, 129, 1)'
                    ],
                    borderWidth: 1,
                    hoverOffset: 4
                }]
            };
            
            const typeConfig = {
                type: 'doughnut',
                data: typeData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    family: 'Inter, system-ui, sans-serif'
                                },
                                padding: 20
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                            bodyFont: {
                                family: 'Inter, system-ui, sans-serif'
                            },
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '65%',
                    animation: {
                        animateScale: true,
                        animateRotate: true,
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            };
            
            // Create the subscription type chart
            new Chart(typeCtx, typeConfig);
        }
        
        // Export Revenue Data functionality
        if (document.getElementById('exportRevenueData')) {
            document.getElementById('exportRevenueData').addEventListener('click', function() {
                // In a real application, this would trigger a download
                alert('This would download the revenue data as CSV in a real application.');
            });
        }
    });
</script>
@endpush
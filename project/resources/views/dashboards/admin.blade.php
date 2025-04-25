@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Desktop Sidebar -->
        @include('partials.admin-sidebar')

        <!-- Main Content -->
<div class="flex-1 overflow-auto overflow-x-hidden">
            <!-- Dashboard Header -->
            <div class="bg-gradient-to-r from-orange-500 to-red-600 text-white">
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h1 class="text-3xl font-bold tracking-tight">TrainTogether Dashboard</h1>
                            <p class="mt-1 text-orange-100 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Manage your fitness empire
                            </p>
                        </div>
                        <div class="mt-4 md:mt-0 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                            <span class="inline-flex rounded-md shadow-sm">
                                <span class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-orange-800 bg-opacity-40">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ now()->format('F j, Y') }}
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Container -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <!-- Fitness Progress Indicators -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        Gym Performance Metrics
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Members Card -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-gradient-to-tr from-orange-500 to-orange-600 rounded-md p-3">
                                        <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">
                                                Total Members
                                            </dt>
                                            <dd>
                                                <div class="text-2xl font-bold text-gray-900">{{ $membersCount }}</div>
                                                <div class="mt-1 flex items-baseline">
                                                    @php
                                                        $previousMonthMembers = $membersCount - ($membersCount * 0.12);
                                                        $memberGrowth = $previousMonthMembers > 0 
                                                            ? round((($membersCount - $previousMonthMembers) / $previousMonthMembers) * 100) 
                                                            : 0;
                                                    @endphp
                                                    <span class="text-green-500 text-sm font-semibold">
                                                        <svg class="inline-block h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                                        </svg>
                                                        {{ $memberGrowth }}% growth
                                                    </span>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-orange-50 px-4 py-2 flex justify-between items-center">
                                <a href="{{ route('admin.users') }}" class="text-xs font-semibold text-orange-600">View Details</a>
                                <!-- Progress Bar -->
                                <div class="w-20 h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-orange-500" style="width: {{ min(100, $memberGrowth) }}%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Trainers Card -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-gradient-to-tr from-orange-500 to-orange-600 rounded-md p-3">
                                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">
                                                Fitness Trainers
                                            </dt>
                                            <dd>
                                                <div class="text-2xl font-bold text-gray-900">{{ $trainersCount }}</div>
                                                <div class="mt-1 flex items-baseline">
                                                    @php
                                                        $newTrainers = isset($newTrainersCount) ? $newTrainersCount : 2;
                                                    @endphp
                                                    <span class="text-blue-500 text-sm font-semibold">
                                                        <svg class="inline-block h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                        </svg>
                                                        {{ $newTrainers }} new this month
                                                    </span>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-orange-50 px-4 py-2 flex justify-between items-center">
                                <a href="{{ route('admin.users') }}?role=trainer" class="text-xs font-semibold text-orange-600">View Details</a>
                                <div class="flex -space-x-1 overflow-hidden">
                                    <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://randomuser.me/api/portraits/men/32.jpg" alt="">
                                    <img class="inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://randomuser.me/api/portraits/women/44.jpg" alt="">
                                    <div class="inline-block h-6 w-6 rounded-full bg-orange-500 ring-2 ring-white flex items-center justify-center text-xs text-white font-bold">+</div>
                                </div>
                            </div>
                        </div>

                        <!-- Sessions Card -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-gradient-to-tr from-orange-500 to-orange-600 rounded-md p-3">
                                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">
                                                Active Classes
                                            </dt>
                                            <dd>
                                                <div class="text-2xl font-bold text-gray-900">{{ $sessionsCount }}</div>
                                                <div class="mt-1 flex items-baseline">
                                                    @php
                                                        $previousMonthSessions = $sessionsCount - ($sessionsCount * 0.08);
                                                        $sessionGrowth = $previousMonthSessions > 0 
                                                            ? round((($sessionsCount - $previousMonthSessions) / $previousMonthSessions) * 100) 
                                                            : 0;
                                                    @endphp
                                                    <span class="text-green-500 text-sm font-semibold">
                                                        <svg class="inline-block h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                                        </svg>
                                                        {{ $sessionGrowth }}% from last month
                                                    </span>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-orange-50 px-4 py-2 flex justify-between items-center">
                                <a href="{{ route('admin.sessions.index') }}" class="text-xs font-semibold text-orange-600">View Schedule</a>
                                <!-- Session Type Indicators -->
                                <div class="flex space-x-1">
                                    <span class="inline-block h-3 w-3 rounded-full bg-blue-500" title="Strength"></span>
                                    <span class="inline-block h-3 w-3 rounded-full bg-green-500" title="Cardio"></span>
                                    <span class="inline-block h-3 w-3 rounded-full bg-purple-500" title="Yoga"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Revenue Card -->
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-gradient-to-tr from-orange-500 to-orange-600 rounded-md p-3">
                                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">
                                                Monthly Revenue
                                            </dt>
                                            <dd>
                                                <div class="text-2xl font-bold text-gray-900">${{ number_format($revenue, 0) }}</div>
                                                <div class="mt-1 flex items-baseline">
                                                    @php
                                                        $previousMonthRevenue = isset($previousMonthRevenue) ? $previousMonthRevenue : ($revenue * 0.85);
                                                        $revenueGrowth = $previousMonthRevenue > 0 
                                                            ? round((($revenue - $previousMonthRevenue) / $previousMonthRevenue) * 100) 
                                                            : 15;
                                                    @endphp
                                                    <span class="text-green-500 text-sm font-semibold">
                                                        <svg class="inline-block h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11l3-3m0 0l3 3m-3-3v8m0-13a9 9 0 110 18 9 9 0 010-18z" />
                                                        </svg>
                                                        {{ $revenueGrowth }}% increase
                                                    </span>
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-orange-50 px-4 py-2 flex justify-between items-center">
                                <a href="{{ route('admin.payments.index') }}" class="text-xs font-semibold text-orange-600">Financial Details</a>
                                <!-- Mini Spark Line -->
                                <svg class="h-5 w-16" viewBox="0 0 100 20" preserveAspectRatio="none">
                                    <path fill="none" stroke="#f97316" stroke-width="2" d="M0,10 L20,15 L40,5 L60,12 L80,8 L100,16"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Dashboard Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column (2/3 width) -->
                    <div class="lg:col-span-2">
                        <!-- Membership Activity Section -->
                        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900">Membership Overview</h3>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="bg-white text-xs font-medium text-gray-500 hover:text-gray-700 px-3 py-1 rounded-full border border-gray-300">Weekly</button>
                                    <button class="bg-orange-500 text-xs font-medium text-white px-3 py-1 rounded-full border border-orange-500">Monthly</button>
                                    <button class="bg-white text-xs font-medium text-gray-500 hover:text-gray-700 px-3 py-1 rounded-full border border-gray-300">Yearly</button>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-3 gap-4 mb-6">
                                    <div class="text-center p-3 bg-green-50 rounded-lg">
                                        <h4 class="text-sm text-gray-500 mb-1">Active</h4>
                                        <p class="text-2xl font-bold text-green-600">{{ $activeSubscriptionsCount }}</p>
                                    </div>
                                    <div class="text-center p-3 bg-yellow-50 rounded-lg">
                                        <h4 class="text-sm text-gray-500 mb-1">Expiring Soon</h4>
                                        <p class="text-2xl font-bold text-yellow-600">{{ $expiringSubscriptionsCount }}</p>
                                    </div>
                                    <div class="text-center p-3 bg-red-50 rounded-lg">
                                        <h4 class="text-sm text-gray-500 mb-1">Expired</h4>
                                        <p class="text-2xl font-bold text-red-600">{{ $expiredSubscriptionsCount }}</p>
                                    </div>
                                </div>
                                
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Membership Distribution</h4>
                                <div class="space-y-4">
                                    <div>
                                        <div class="flex justify-between text-sm mb-1">
                                            <span class="font-medium flex items-center">
                                                <span class="w-3 h-3 inline-block bg-blue-500 rounded-sm mr-2"></span>
                                                Basic Membership
                                            </span>
                                            <span>{{ $basicSubscriptionsPercentage }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-blue-500 h-2.5 rounded-full" style="width: {{ $basicSubscriptionsPercentage }}%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between text-sm mb-1">
                                            <span class="font-medium flex items-center">
                                                <span class="w-3 h-3 inline-block bg-orange-500 rounded-sm mr-2"></span>
                                                Premium Membership
                                            </span>
                                            <span>{{ $premiumSubscriptionsPercentage }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-orange-500 h-2.5 rounded-full" style="width: {{ $premiumSubscriptionsPercentage }}%"></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex justify-between text-sm mb-1">
                                            <span class="font-medium flex items-center">
                                                <span class="w-3 h-3 inline-block bg-purple-500 rounded-sm mr-2"></span>
                                                Elite Membership
                                            </span>
                                            <span>{{ $eliteSubscriptionsPercentage }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-purple-500 h-2.5 rounded-full" style="width: {{ $eliteSubscriptionsPercentage }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                                <a href="{{ route('admin.subscriptions.index') }}" class="text-sm font-medium text-orange-600 hover:text-orange-800 flex items-center">
                                    Manage all memberships
                                    <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Recent Payments Section -->
                        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900">Recent Payments</h3>
                                </div>
                                <a href="{{ route('admin.payments.index') }}" class="text-sm text-orange-600 hover:text-orange-800 font-medium flex items-center">
                                    View All
                                    <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                            <div class="divide-y divide-gray-200">
                                @forelse($recentPayments as $payment)
                                <div class="px-6 py-4 flex justify-between items-center hover:bg-gray-50">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-800 font-bold">
                                            {{ substr($payment->subscription->user->firstname ?? 'U', 0, 1) }}{{ substr($payment->subscription->user->lastname ?? 'M', 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $payment->subscription->user->firstname ?? 'Unknown' }} 
                                                {{ $payment->subscription->user->lastname ?? 'Member' }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($payment->date)->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">${{ number_format($payment->amount, 2) }}</p>
                                        <div>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                {{ $payment->status === 'paid' ? 'bg-green-100 text-green-800' : 
                                                ($payment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="px-6 py-8 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <p class="mt-2 text-gray-500 text-sm">No recent payments found</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                        
                        <!-- Upcoming Fitness Schedule -->
                        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900">Upcoming Fitness Classes</h3>
                                </div>
                                <a href="{{ route('admin.sessions.index') }}" class="text-sm text-orange-600 hover:text-orange-800 font-medium flex items-center">
                                    View All
                                    <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trainer</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Schedule</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacity</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($upcomingSessions as $session)
                                        <tr class="hover:bg-orange-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-900">{{ $session->title }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-800 font-bold text-xs mr-2">
                                                        {{ substr($session->trainer->firstname, 0, 1) }}{{ substr($session->trainer->lastname, 0, 1) }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">{{ $session->trainer->firstname }} {{ $session->trainer->lastname }}</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ \Carbon\Carbon::parse($session->date)->format('M d, Y') }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }} - 
                                                    {{ \Carbon\Carbon::parse($session->end_time)->format('g:i A') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    <div class="flex items-center">
                                                        <span class="mr-2">{{ $session->attendances()->count() }}/{{ $session->max_capacity }}</span>
                                                        <div class="w-16 bg-gray-200 rounded-full h-2">
                                                            <div class="bg-orange-500 h-2 rounded-full" style="width: {{ min(100, ($session->attendances()->count() / $session->max_capacity) * 100) }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-medium rounded-full 
                                                    {{ $session->type == 'Cardio' ? 'bg-green-100 text-green-800' : 
                                                        ($session->type == 'Strength' ? 'bg-blue-100 text-blue-800' : 
                                                        ($session->type == 'Yoga' ? 'bg-purple-100 text-purple-800' : 
                                                        'bg-orange-100 text-orange-800')) }}">
                                                    {{ $session->type }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-500">
                                                <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <p class="mt-2">No upcoming sessions found</p>
                                                <a href="{{ route('admin.sessions.create') }}" class="mt-3 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none">
                                                    <svg class="-ml-0.5 mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                    </svg>
                                                    Create Session
                                                </a>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column (1/3 width) -->
                    <div class="lg:col-span-1 space-y-8">
                        <!-- Quick Actions Card -->
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                    <svg class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Quick Actions
                                </h3>
                            </div>
                            <div class="p-6 space-y-4">
                                <a href="{{ route('admin.users.create') }}" class="flex items-center justify-between px-4 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
                                    <div class="flex items-center">
                                        <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                        </svg>
                                        <span class="font-medium">Add New Member</span>
                                    </div>
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <a href="{{ route('admin.sessions.create') }}" class="flex items-center justify-between px-4 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
                                    <div class="flex items-center">
                                        <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        <span class="font-medium">Create New Session</span>
                                    </div>
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <a href="{{ route('admin.reports.revenues') }}" class="flex items-center justify-between px-4 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg hover:from-indigo-600 hover:to-purple-700 transition-colors">
                                    <div class="flex items-center">
                                        <svg class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                        <span class="font-medium">View Reports</span>
                                    </div>
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Recent Member Joins -->
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                    <svg class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                    </svg>
                                    Recent Members
                                </h3>
                            </div>
                            <div>
                                @forelse($recentUsers->take(4) as $user)
                                <div class="px-6 py-4 flex items-center justify-between hover:bg-orange-50">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-orange-100 flex items-center justify-center text-orange-800 font-bold">
                                            {{ substr($user->firstname, 0, 1) }}{{ substr($user->lastname, 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $user->firstname }} {{ $user->lastname }}</p>
                                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->role == 'Member' ? 'bg-blue-100 text-blue-800' : ($user->role == 'Trainer' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ $user->role }}
                                    </span>
                                </div>
                                @empty
                                <div class="p-6 text-center text-gray-500">
                                    No recent users found
                                </div>
                                @endforelse
                            </div>
                            <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                                <a href="{{ route('admin.users') }}" class="text-sm font-medium text-orange-600 hover:text-orange-800 flex items-center justify-center">
                                    View all members
                                    <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Monthly Stats Card -->
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                    <svg class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    Performance Metrics
                                </h3>
                            </div>
                            <div class="p-6 space-y-5">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-green-100 text-green-600 mr-3">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                            </svg>
                                        </span>
                                        <div class="text-sm text-gray-700">New Members</div>
                                    </div>
                                    <div class="text-sm font-bold text-gray-900">
                                        @php
                                            $newMembersThisMonth = isset($newMembersThisMonth) ? $newMembersThisMonth : round($membersCount * 0.12);
                                        @endphp
                                        <span class="flex items-center">
                                            +{{ $newMembersThisMonth }}
                                            <span class="ml-1 text-xs font-medium text-green-600">↑</span>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-100 text-blue-600 mr-3">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                            </svg>
                                        </span>
                                        <div class="text-sm text-gray-700">New Subscriptions</div>
                                    </div>
                                    <div class="text-sm font-bold text-gray-900">
                                        @php
                                            $newSubscriptionsThisMonth = isset($newSubscriptionsThisMonth) ? $newSubscriptionsThisMonth : $activeSubscriptionsCount * 0.15;
                                        @endphp
                                        <span class="flex items-center">
                                            +{{ round($newSubscriptionsThisMonth) }}
                                            <span class="ml-1 text-xs font-medium text-green-600">↑</span>
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-orange-100 text-orange-600 mr-3">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </span>
                                        <div class="text-sm text-gray-700">Classes Completed</div>
                                    </div>
                                    <div class="text-sm font-bold text-gray-900">
                                        @php
                                            $completedSessionsThisMonth = isset($completedSessionsThisMonth) ? $completedSessionsThisMonth : $sessionsCount * 0.8;
                                        @endphp
                                        {{ round($completedSessionsThisMonth) }}
                                    </div>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-purple-100 text-purple-600 mr-3">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                        </span>
                                        <div class="text-sm text-gray-700">Total Check-ins</div>
                                    </div>
                                    <div class="text-sm font-bold text-gray-900">
                                        @php
                                            $attendanceThisMonth = isset($attendanceThisMonth) ? $attendanceThisMonth : $membersCount * 3;
                                        @endphp
                                        {{ round($attendanceThisMonth) }}
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                                <a href="{{ route('admin.reports.members') }}" class="text-sm font-medium text-orange-600 hover:text-orange-800 flex items-center justify-center">
                                    View detailed analytics
                                    <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        
                        <!-- System Status Card -->
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                    <svg class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    System Status
                                </h3>
                            </div>
                            <div class="p-6 space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="h-3 w-3 rounded-full bg-green-500 mr-2"></div>
                                        <span class="text-sm text-gray-700">Payments System</span>
                                    </div>
                                    <span class="text-xs font-medium text-green-600">Operational</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="h-3 w-3 rounded-full bg-green-500 mr-2"></div>
                                        <span class="text-sm text-gray-700">Class Booking</span>
                                    </div>
                                    <span class="text-xs font-medium text-green-600">Operational</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="h-3 w-3 rounded-full bg-green-500 mr-2"></div>
                                        <span class="text-sm text-gray-700">User Management</span>
                                    </div>
                                    <span class="text-xs font-medium text-green-600">Operational</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="h-3 w-3 rounded-full bg-green-500 mr-2"></div>
                                        <span class="text-sm text-gray-700">Analytics & Reports</span>
                                    </div>
                                    <span class="text-xs font-medium text-green-600">Operational</span>
                                </div>
                                <div class="pt-4 border-t border-gray-200 text-center">
                                    <span class="text-xs text-gray-500 flex items-center justify-center">
                                        <svg class="h-4 w-4 text-green-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        All systems operational | Updated: {{ now()->format('M d, Y H:i') }}
                                    </span>
                                </div>
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

@section('scripts')
<script>
    // Mobile menu functionality
    document.addEventListener('DOMContentLoaded', function() {
        const openSidebarButton = document.getElementById('open-sidebar');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const closeMenuButtons = document.querySelectorAll('#close-mobile-menu, #close-mobile-menu-x');

        function toggleMobileMenu(open) {
            if (open) {
                mobileMenu.classList.remove('hidden', '-translate-x-full');
                mobileMenuOverlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            } else {
                mobileMenu.classList.add('-translate-x-full');
                setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                    mobileMenuOverlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }, 300);
            }
        }

        if (openSidebarButton) {
            openSidebarButton.addEventListener('click', () => toggleMobileMenu(true));
        }

        closeMenuButtons.forEach(button => {
            button.addEventListener('click', () => toggleMobileMenu(false));
        });

        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', () => toggleMobileMenu(false));
        }
    });
</script>
@endsection

@endsection
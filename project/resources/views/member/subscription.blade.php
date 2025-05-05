@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            @include('partials.member-sidebar')

            <!-- Main Content Area -->
            <div class="flex-1 overflow-auto">
                <div class="bg-white shadow-md border-b border-gray-200">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex justify-between items-center">
                        <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                            <span class="relative">
                                My Subscription
                                <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full transform translate-y-1"></span>
                            </span>
                        </h1>
                        <nav class="hidden sm:flex items-center space-x-2">
                            <a href="{{ route('member.sessions') }}" class="group inline-flex items-center px-4 py-2 text-sm font-medium rounded-full text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 shadow-md hover:shadow-lg transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Book a Session
                            </a>
                        </nav>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    @if (session('success'))
                        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-8 rounded-r-md shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-8 rounded-r-md shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Current Subscription Status -->
                    <div class="bg-white shadow-lg rounded-xl mb-8 overflow-hidden border border-gray-100">
                        <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-semibold text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Subscription Status
                            </h3>
                        </div>
                        <div>
                            @if($activeSubscription)
                                <div class="p-6">
                                    <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-6">
                                        <div class="flex-shrink-0 bg-indigo-100 p-4 rounded-lg border border-indigo-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                        </div>
                                        
                                        <div class="flex-1">
                                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-3">
                                                <h3 class="text-xl font-bold text-gray-900">{{ $activeSubscription->type }} Plan</h3>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                    <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                                    Active
                                                </span>
                                            </div>
                                            <p class="text-gray-600 text-sm mb-3">Your subscription gives you access to premium fitness services and sessions.</p>
                                            <div class="flex flex-wrap gap-4">
                                                <div class="flex items-center text-gray-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span>Started: <span class="font-medium">{{ \Carbon\Carbon::parse($activeSubscription->start_date)->format('M d, Y') }}</span></span>
                                                </div>
                                                <div class="flex items-center text-gray-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span>Expires: <span class="font-medium">{{ \Carbon\Carbon::parse($activeSubscription->end_date)->format('M d, Y') }}</span></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="bg-indigo-600 text-white rounded-xl p-4 shadow-md self-start sm:self-center">
                                            <div class="text-xs uppercase text-indigo-200 font-semibold">Time Remaining</div>
                                            <div class="text-2xl font-bold">{{ \Carbon\Carbon::parse($activeSubscription->end_date)->diffInDays(now()) }} days</div>
                                            <div class="text-sm text-indigo-200">{{ \Carbon\Carbon::parse($activeSubscription->end_date)->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div class="bg-gray-50 border border-gray-100 rounded-lg p-4">
                                            <div class="text-sm font-medium text-gray-500">Current Plan</div>
                                            <div class="mt-1 text-2xl font-bold text-gray-900 flex items-baseline">
                                                {{ $activeSubscription->type }}
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 border border-gray-100 rounded-lg p-4">
                                            <div class="text-sm font-medium text-gray-500">Sessions Available</div>
                                            <div class="mt-1 text-2xl font-bold text-gray-900">
                                                {{ $activeSubscription->max_sessions_count ?? 'Unlimited' }}
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 border border-gray-100 rounded-lg p-4">
                                            <div class="text-sm font-medium text-gray-500">Paid Amount</div>
                                            <div class="mt-1 text-2xl font-bold text-gray-900">${{ number_format($activeSubscription->price, 2) }}</div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 border-t border-gray-200 pt-6 flex justify-between items-center">
                                        <div class="text-sm text-gray-500">
                                            To ensure uninterrupted access to our facilities, consider renewing your subscription before it expires.
                                        </div>
                                        <a href="#subscription-plans" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-md text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                            </svg>
                                            Renew Subscription
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="p-6 text-center">
                                    <div class="mx-auto h-24 w-24 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">No Active Subscription</h3>
                                    <p class="text-gray-600 mb-6 max-w-md mx-auto">Choose a plan below to begin your fitness journey. Our memberships provide access to state-of-the-art facilities and expert-led sessions.</p>
                                    <a href="#subscription-plans" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-md text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                        </svg>
                                        View Membership Plans
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Single Session Notice -->
                    <div class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-400 p-5 mb-8 rounded-r-lg shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-yellow-800">Need a trial session?</h4>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p>
                                        <strong>Looking for a single session?</strong> Visit our reception desk to purchase individual training sessions with our expert trainers before committing to a full membership.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Subscription Plans Section -->
                    <div id="subscription-plans" class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
                        <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-semibold text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                                Membership Plans
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Choose the plan that fits your fitness goals and lifestyle</p>
                        </div>

                        <div class="p-6">
                            <!-- Subscription Plan Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <!-- Basic Plan -->
                                <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-200 hover:border-indigo-300 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-5">
                                        <h3 class="text-xl font-bold text-white flex items-center">
                                            Basic Plan
                                            <span class="ml-2 px-2 py-0.5 text-xs bg-white/30 backdrop-blur-sm rounded-full">Starter</span>
                                        </h3>
                                        <p class="text-blue-100 mt-1">Essential fitness access</p>
                                    </div>
                                    <div class="p-6">
                                        <div class="flex items-baseline mb-6">
                                            <span class="text-3xl font-bold text-gray-900">$29</span>
                                            <span class="text-lg text-gray-500 ml-1">/month</span>
                                        </div>
                                        
                                        <ul class="space-y-4 mb-8">
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-gray-700">4 sessions per month</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-gray-700">Access to gym facilities</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-gray-700">Basic classes</span>
                                            </li>
                                            <li class="flex items-start text-gray-400">
                                                <svg class="h-5 w-5 text-gray-300 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                </svg>
                                                <span>Trainer zone access</span>
                                            </li>
                                        </ul>
                                        
                                        <div class="space-y-2">
                                            <a href="{{ route('member.subscription.payment', ['plan' => 'Basic', 'duration' => 1]) }}" class="group w-full block text-center px-4 py-2.5 border border-transparent rounded-lg shadow-md text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                                <span class="flex items-center justify-center">
                                                    <span>Monthly</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                    </svg>
                                                </span>
                                            </a>
                                            <a href="{{ route('member.subscription.payment', ['plan' => 'Basic', 'duration' => 3]) }}" class="group w-full block text-center px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-indigo-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                                <span class="flex items-center justify-center">
                                                    <span>3 Months (10% off)</span>
                                                    <span class="ml-1.5 px-1.5 py-0.5 text-xs bg-green-100 text-green-800 rounded-full">Save $8.70</span>
                                                </span>
                                            </a>
                                            <a href="{{ route('member.subscription.payment', ['plan' => 'Basic', 'duration' => 12]) }}" class="group w-full block text-center px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-indigo-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                                <span class="flex items-center justify-center">
                                                    <span>12 Months (20% off)</span>
                                                    <span class="ml-1.5 px-1.5 py-0.5 text-xs bg-green-100 text-green-800 rounded-full">Save $69.60</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Premium Plan -->
                                <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-200 hover:border-indigo-300 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 scale-105 z-10 relative">
                                    <div class="absolute top-0 right-0 bg-gradient-to-r from-green-500 to-emerald-500 text-white text-xs font-bold px-3 py-1 transform translate-x-2 -translate-y-2 rotate-12 shadow-md">
                                        Popular
                                    </div>
                                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-5">
                                        <h3 class="text-xl font-bold text-white flex items-center">
                                            Premium Plan
                                            <span class="ml-2 px-2 py-0.5 text-xs bg-white/30 backdrop-blur-sm rounded-full">Recommended</span>
                                        </h3>
                                        <p class="text-indigo-100 mt-1">Advanced fitness experience</p>
                                    </div>
                                    <div class="p-6">
                                        <div class="flex items-baseline mb-6">
                                            <span class="text-3xl font-bold text-gray-900">$59</span>
                                            <span class="text-lg text-gray-500 ml-1">/month</span>
                                        </div>
                                        
                                        <ul class="space-y-4 mb-8">
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-gray-700">8 sessions per month</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-gray-700">All gym facilities</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-gray-700">All class levels</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-gray-700">Trainer zone access</span>
                                            </li>
                                        </ul>
                                        
                                        <div class="space-y-2">
                                            <a href="{{ route('member.subscription.payment', ['plan' => 'Premium', 'duration' => 1]) }}" class="group w-full block text-center px-4 py-2.5 border border-transparent rounded-lg shadow-md text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                                <span class="flex items-center justify-center">
                                                    <span>Monthly</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                    </svg>
                                                </span>
                                            </a>
                                            <a href="{{ route('member.subscription.payment', ['plan' => 'Premium', 'duration' => 3]) }}" class="group w-full block text-center px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-indigo-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                                <span class="flex items-center justify-center">
                                                    <span>3 Months (10% off)</span>
                                                    <span class="ml-1.5 px-1.5 py-0.5 text-xs bg-green-100 text-green-800 rounded-full">Save $17.70</span>
                                                </span>
                                            </a>
                                            <a href="{{ route('member.subscription.payment', ['plan' => 'Premium', 'duration' => 12]) }}" class="group w-full block text-center px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-indigo-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                                <span class="flex items-center justify-center">
                                                    <span>12 Months (20% off)</span>
                                                    <span class="ml-1.5 px-1.5 py-0.5 text-xs bg-green-100 text-green-800 rounded-full">Save $141.60</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Elite Plan -->
                                <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-200 hover:border-indigo-300 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-5">
                                        <h3 class="text-xl font-bold text-white flex items-center">
                                            Elite Plan
                                            <span class="ml-2 px-2 py-0.5 text-xs bg-white/30 backdrop-blur-sm rounded-full">Ultimate</span>
                                        </h3>
                                        <p class="text-purple-100 mt-1">Premium fitness experience</p>
                                    </div>
                                    <div class="p-6">
                                        <div class="flex items-baseline mb-6">
                                            <span class="text-3xl font-bold text-gray-900">$99</span>
                                            <span class="text-lg text-gray-500 ml-1">/month</span>
                                        </div>
                                        
                                        <ul class="space-y-4 mb-8">
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-gray-700">Unlimited sessions</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-gray-700">All gym facilities 24/7</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-gray-700">All classes + VIP sessions</span>
                                            </li>
                                            <li class="flex items-start">
                                                <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="text-gray-700">Personal trainer consult</span>
                                            </li>
                                        </ul>
                                        
                                        <div class="space-y-2">
                                            <a href="{{ route('member.subscription.payment', ['plan' => 'Elite', 'duration' => 1]) }}" class="group w-full block text-center px-4 py-2.5 border border-transparent rounded-lg shadow-md text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200">
                                                <span class="flex items-center justify-center">
                                                    <span>Monthly</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                    </svg>
                                                </span>
                                            </a>
                                            <a href="{{ route('member.subscription.payment', ['plan' => 'Elite', 'duration' => 3]) }}" class="group w-full block text-center px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-indigo-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                                <span class="flex items-center justify-center">
                                                    <span>3 Months (10% off)</span>
                                                    <span class="ml-1.5 px-1.5 py-0.5 text-xs bg-green-100 text-green-800 rounded-full">Save $29.70</span>
                                                </span>
                                            </a>
                                            <a href="{{ route('member.subscription.payment', ['plan' => 'Elite', 'duration' => 12]) }}" class="group w-full block text-center px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-indigo-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                                <span class="flex items-center justify-center">
                                                    <span>12 Months (20% off)</span>
                                                    <span class="ml-1.5 px-1.5 py-0.5 text-xs bg-green-100 text-green-800 rounded-full">Save $237.60</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Comparison Feature Table -->
                            <div class="mt-12 border-t border-gray-200 pt-8">
                                <h4 class="text-lg font-semibold text-gray-900 mb-6">Plan Comparison</h4>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Feature</th>
                                                <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Basic</th>
                                                <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Premium</th>
                                                <th class="px-6 py-3 bg-gray-50 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Elite</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Monthly Price</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">$29</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center font-bold">$59</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">$99</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Sessions Per Month</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">4</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center font-bold">8</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">Unlimited</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Access Hours</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">6AM - 10PM</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center font-bold">6AM - 10PM</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">24/7</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Group Classes</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">Basic Only</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center font-bold">All Classes</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">All + VIP Sessions</td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Trainer Consultations</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                                    <svg class="mx-auto h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                                    </svg>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center font-bold">
                                                    <svg class="mx-auto h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="text-xs">1 Monthly</span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                                    <svg class="mx-auto h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="text-xs">Unlimited</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Locker Access</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">Basic</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center font-bold">Premium</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">VIP</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <!-- FAQ Section -->
                            <div class="mt-12 border-t border-gray-200 pt-8">
                                <h4 class="text-lg font-semibold text-gray-900 mb-6">Frequently Asked Questions</h4>
                                <div class="space-y-6">
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <h5 class="font-medium text-gray-900">How do I change my subscription plan?</h5>
                                        <p class="mt-2 text-sm text-gray-600">You can upgrade your plan at any time. The price difference will be prorated for the remaining period. For downgrades, changes will take effect at the end of your current billing cycle.</p>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <h5 class="font-medium text-gray-900">What is the cancellation policy?</h5>
                                        <p class="mt-2 text-sm text-gray-600">You can cancel your subscription at any time. Refunds are issued for annual plans on a prorated basis. Monthly plans can be canceled but are not eligible for partial refunds once the month has started.</p>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <h5 class="font-medium text-gray-900">Can I freeze my membership?</h5>
                                        <p class="mt-2 text-sm text-gray-600">Yes, you can freeze your membership for up to 30 days per year without any additional charges. Please contact our reception desk or support team to arrange this.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Testimonials -->
                            <div class="mt-12 border-t border-gray-200 pt-8">
                                <h4 class="text-lg font-semibold text-gray-900 mb-6">What Our Members Say</h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                                        <div class="flex items-center mb-4">
                                            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold mr-3">JD</div>
                                            <div>
                                                <h5 class="font-medium text-gray-900">Jane Doe</h5>
                                                <div class="flex text-yellow-400">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-gray-600 text-sm italic">"The Premium Plan has completely transformed my fitness routine. The variety of classes and flexibility with scheduling is exactly what I needed."</p>
                                    </div>
                                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                                        <div class="flex items-center mb-4">
                                            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold mr-3">JW</div>
                                            <div>
                                                <h5 class="font-medium text-gray-900">James Wilson</h5>
                                                <div class="flex text-yellow-400">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-gray-600 text-sm italic">"Upgraded to the Elite Plan and haven't looked back. The 24/7 access and personal trainer consultations have been game-changers for my fitness journey."</p>
                                    </div>
                                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                                        <div class="flex items-center mb-4">
                                            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold mr-3">SM</div>
                                            <div>
                                                <h5 class="font-medium text-gray-900">Sarah Miller</h5>
                                                <div class="flex text-yellow-400">
                                                    @for ($i = 0; $i < 4; $i++)
                                                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    @endfor
                                                    <svg class="h-4 w-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-gray-600 text-sm italic">"Started with the Basic Plan as a beginner, and it was perfect for my needs. The staff is supportive and the facilities are always clean and well-maintained."</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile floating action button -->
    <div class="md:hidden fixed z-20 bottom-6 right-6">
        <a href="#subscription-plans" class="flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
            </svg>
        </a>
    </div>

    @include('partials.mobile-menu')

    @section('scripts')
        <script>
            // Smooth scroll for anchor links
            document.addEventListener('DOMContentLoaded', function() {
                const anchorLinks = document.querySelectorAll('a[href^="#"]');
                
                anchorLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        
                        const targetId = this.getAttribute('href');
                        const targetElement = document.querySelector(targetId);
                        
                        if (targetElement) {
                            window.scrollTo({
                                top: targetElement.offsetTop - 80, // Adjust offset as needed
                                behavior: 'smooth'
                            });
                        }
                    });
                });
                
                // Mobile menu functionality
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

                // Optional: Close mobile menu when clicking outside
                const mobileMenuOverlayElement = document.getElementById('mobile-menu-overlay');
                if (mobileMenuOverlayElement) {
                    mobileMenuOverlayElement.addEventListener('click', () => toggleMobileMenu(false));
                }
            });
        </script>
    @endsection
@endsection
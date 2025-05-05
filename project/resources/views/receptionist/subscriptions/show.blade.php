@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('partials.receptionist-sidebar')
        
        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-3 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                            <h1 class="text-2xl font-bold text-gray-900">Subscription Details</h1>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('receptionist.subscriptions.edit', $subscription->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <a href="{{ route('receptionist.subscriptions.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back
                            </a>
                        </div>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <!-- Status Banner with improved design -->
                    @if($subscription->status === 'active')
                        <div class="rounded-md bg-gradient-to-r from-green-50 to-green-100 p-4 mb-6 shadow-sm border border-green-200">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-green-800">Active Subscription</h3>
                                    <div class="mt-2 text-sm text-green-700">
                                        <p>This subscription is currently active and will expire on {{ \Carbon\Carbon::parse($subscription->end_date)->format('F j, Y') }} ({{ \Carbon\Carbon::parse($subscription->end_date)->diffForHumans() }}).</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($subscription->status === 'pending')
                        <div class="rounded-md bg-gradient-to-r from-yellow-50 to-yellow-100 p-4 mb-6 shadow-sm border border-yellow-200">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">Pending Subscription</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p>This subscription is pending payment or approval.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($subscription->status === 'cancelled')
                        <div class="rounded-md bg-gradient-to-r from-red-50 to-red-100 p-4 mb-6 shadow-sm border border-red-200">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Cancelled Subscription</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <p>This subscription has been cancelled.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($subscription->status === 'expired')
                        <div class="rounded-md bg-gradient-to-r from-gray-50 to-gray-100 p-4 mb-6 shadow-sm border border-gray-200">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-gray-800">Expired Subscription</h3>
                                    <div class="mt-2 text-sm text-gray-700">
                                        <p>This subscription has expired on {{ \Carbon\Carbon::parse($subscription->end_date)->format('F j, Y') }} ({{ \Carbon\Carbon::parse($subscription->end_date)->diffForHumans() }}).</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons for Active/Pending Subscriptions with improved layout -->
                    @if($subscription->status === 'active' || $subscription->status === 'pending')
                        <div class="flex flex-col sm:flex-row sm:justify-end space-y-2 sm:space-y-0 sm:space-x-3 mb-6">
                            @if($subscription->status === 'active')
                                <form action="{{ route('receptionist.subscriptions.cancel', $subscription->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="w-full sm:w-auto inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-md text-sm font-medium text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400 transition-all duration-200" onclick="return confirm('Are you sure you want to cancel this subscription?')">
                                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Cancel Subscription
                                    </button>
                                </form>
                            @endif
                            
                            <!-- Renew Modal Button -->
                            <button type="button" class="w-full sm:w-auto inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 transition-all duration-200" onclick="document.getElementById('renewModal').classList.remove('hidden')">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Renew Subscription
                            </button>
                        </div>
                    @endif

                    <!-- Subscription Details with improved styling -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6 border border-gray-200">
                        <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Subscription Information</h3>
                            </div>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Details about the subscription and the member.</p>
                        </div>
                        <div class="border-t border-gray-200">
                            <dl>
                                <!-- Member Information -->
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Member</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mr-2">
                                            <span class="text-white font-semibold text-xs">{{ substr($subscription->user->firstname, 0, 1) }}{{ substr($subscription->user->lastname, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <div>{{ $subscription->user->firstname }} {{ $subscription->user->lastname }}</div>
                                            <div class="text-xs text-gray-500">{{ $subscription->user->email }}</div>
                                        </div>
                                    </dd>
                                </div>
                                
                                <!-- Type -->
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Type</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $subscription->type == 'Basic' ? 'bg-blue-100 text-blue-800' : 
                                            ($subscription->type == 'Premium' ? 'bg-purple-100 text-purple-800' : 
                                            'bg-indigo-100 text-indigo-800') }}">
                                            {{ $subscription->type }}
                                        </span>
                                    </dd>
                                </div>
                                
                                <!-- Duration -->
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Duration</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $subscription->duration }} month(s)</dd>
                                </div>
                                
                                <!-- Price -->
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Price</dt>
                                    <dd class="mt-1 text-sm font-semibold text-gray-900 sm:mt-0 sm:col-span-2">${{ number_format($subscription->price, 2) }}</dd>
                                </div>
                                
                                <!-- Date Range -->
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Date Range</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ \Carbon\Carbon::parse($subscription->start_date)->format('F j, Y') }} to 
                                        {{ \Carbon\Carbon::parse($subscription->end_date)->format('F j, Y') }}
                                        <div class="mt-1 text-sm text-gray-500">
                                            Ends {{ \Carbon\Carbon::parse($subscription->end_date)->diffForHumans() }}
                                        </div>
                                    </dd>
                                </div>
                                
                                <!-- Status -->
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if($subscription->status == 'active')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                <svg class="mr-1.5 h-2 w-2 text-green-500 mt-1" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Active
                                            </span>
                                        @elseif($subscription->status == 'pending')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                <svg class="mr-1.5 h-2 w-2 text-yellow-500 mt-1" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Pending
                                            </span>
                                        @elseif($subscription->status == 'cancelled')
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                <svg class="mr-1.5 h-2 w-2 text-red-500 mt-1" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Cancelled
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                <svg class="mr-1.5 h-2 w-2 text-gray-500 mt-1" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Expired
                                            </span>
                                        @endif
                                    </dd>
                                </div>
                                
                                <!-- Payment Method -->
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Payment Method</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if($subscription->payment_method)
                                            <span class="capitalize">{{ str_replace('_', ' ', $subscription->payment_method) }}</span>
                                        @else
                                            <span class="text-gray-500 italic">Not specified</span>
                                        @endif
                                    </dd>
                                </div>
                                
                                <!-- Transaction Number -->
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Transaction Number</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if($subscription->transaction_number)
                                            <span class="font-mono">{{ $subscription->transaction_number }}</span>
                                        @else
                                            <span class="text-gray-500 italic">Not available</span>
                                        @endif
                                    </dd>
                                </div>
                                
                                <!-- Sessions -->
                                @if(isset($subscription->max_sessions_count) || isset($subscription->sessions_left))
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Sessions</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if(isset($subscription->max_sessions_count) && isset($subscription->sessions_left))
                                            <div class="flex items-center">
                                                <span class="font-medium">{{ $subscription->sessions_left }} / {{ $subscription->max_sessions_count }}</span>
                                                <span class="ml-1.5">sessions remaining</span>
                                            </div>
                                            
                                            @if($subscription->max_sessions_count > 0)
                                                <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($subscription->sessions_left / $subscription->max_sessions_count) * 100 }}%"></div>
                                                </div>
                                            @endif
                                        @elseif(isset($subscription->max_sessions_count))
                                            {{ $subscription->max_sessions_count }} total sessions
                                        @elseif(isset($subscription->sessions_left))
                                            {{ $subscription->sessions_left }} sessions remaining
                                        @else
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Unlimited sessions</span>
                                        @endif
                                    </dd>
                                </div>
                                @endif
                                
                                <!-- Trainer Zone Access -->
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Trainer Zone Access</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if($subscription->trainer_zone_access)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="mr-1.5 h-3.5 w-3.5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Trainer Zone Access Granted
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <svg class="mr-1.5 h-3.5 w-3.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                No Trainer Zone Access
                                            </span>
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                    
                    <!-- Payment History with improved styling -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                        <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200 flex justify-between items-center">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Payment History</h3>
                            </div>
                            <a href="{{ route('receptionist.payments.create') }}?subscription_id={{ $subscription->id }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Payment
                            </a>
                        </div>
                        <div class="border-t border-gray-200">
                            <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction ID</th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($subscription->payments as $payment)
                                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ \Carbon\Carbon::parse($payment->date)->format('M d, Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    ${{ number_format($payment->amount, 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ ucfirst(str_replace('_', ' ', $payment->method)) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($payment->status == 'paid')
                                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            <svg class="mr-1 h-2 w-2 text-green-500 mt-1" fill="currentColor" viewBox="0 0 8 8">
                                                                <circle cx="4" cy="4" r="3" />
                                                            </svg>
                                                            Paid
                                                        </span>
                                                    @elseif($payment->status == 'pending')
                                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            <svg class="mr-1 h-2 w-2 text-yellow-500 mt-1" fill="currentColor" viewBox="0 0 8 8">
                                                                <circle cx="4" cy="4" r="3" />
                                                            </svg>
                                                            Pending
                                                        </span>
                                                    @elseif($payment->status == 'failed')
                                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                            <svg class="mr-1 h-2 w-2 text-red-500 mt-1" fill="currentColor" viewBox="0 0 8 8">
                                                                <circle cx="4" cy="4" r="3" />
                                                            </svg>
                                                            Failed
                                                        </span>
                                                    @elseif($payment->status == 'refunded')
                                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                            <svg class="mr-1 h-2 w-2 text-blue-500 mt-1" fill="currentColor" viewBox="0 0 8 8">
                                                                <circle cx="4" cy="4" r="3" />
                                                            </svg>
                                                            Refunded
                                                        </span>
                                                    @else
                                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            <svg class="mr-1 h-2 w-2 text-gray-500 mt-1" fill="currentColor" viewBox="0 0 8 8">
                                                                <circle cx="4" cy="4" r="3" />
                                                            </svg>
                                                            {{ ucfirst($payment->status) }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">
                                                    {{ $payment->transaction_id ?? 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <div class="flex justify-end space-x-3">
                                                        <a href="{{ route('receptionist.payments.show', $payment->id) }}" class="text-blue-600 hover:text-blue-800">View</a>
                                                        @if($payment->status == 'pending')
                                                            <form action="{{ route('receptionist.payments.process', $payment->id) }}" method="POST" class="inline-block">
                                                                @csrf
                                                                <button type="submit" class="text-green-600 hover:text-green-800">Process</button>
                                                            </form>
                                                        @endif
                                                        @if($payment->status == 'paid')
                                                            <a href="{{ route('receptionist.payments.receipt', $payment->id) }}" class="text-blue-600 hover:text-blue-800">Receipt</a>
                                                            <form action="{{ route('receptionist.payments.refund', $payment->id) }}" method="POST" class="inline-block">
                                                                @csrf
                                                                <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to refund this payment?')">Refund</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="px-6 py-8 whitespace-nowrap text-sm text-gray-500 text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                    <p class="mt-4 text-gray-500">No payment records found for this subscription</p>
                                                    <div class="mt-4">
                                                        <a href="{{ route('receptionist.payments.create') }}?subscription_id={{ $subscription->id }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                                            Add First Payment
                                                        </a>
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
            </div>
        </div>
    </div>
</div>

<!-- Renew Subscription Modal with improved styling -->
<div id="renewModal" class="fixed z-30 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-4 py-3 border-b border-gray-200 sm:px-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center" id="modal-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Renew Subscription
                    </h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500" onclick="document.getElementById('renewModal').classList.add('hidden')">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <form action="{{ route('receptionist.subscriptions.renew', $subscription->id) }}" method="POST">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="mt-2">
                        <p class="text-sm text-gray-500 mb-4">
                            Extend this subscription by selecting a new end date and payment method.
                        </p>
                        
                        <div class="mb-4">
                            <label for="current_end_date" class="block text-sm font-medium text-gray-700 mb-1">Current End Date</label>
                            <div class="mt-1 p-2 bg-gray-50 rounded-md border border-gray-200">
                                <div class="text-sm text-gray-700">{{ \Carbon\Carbon::parse($subscription->end_date)->format('F j, Y') }}</div>
                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($subscription->end_date)->diffForHumans() }}</div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">New End Date</label>
                            <input type="date" name="end_date" id="renew_end_date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                                min="{{ \Carbon\Carbon::parse($subscription->end_date)->format('Y-m-d') }}">
                        </div>
                        
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label for="duration_months" class="block text-sm font-medium text-gray-700 mb-1">Add Months</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <button type="button" onclick="addMonths(1)" class="inline-flex items-center px-3 py-2 border border-r-0 border-gray-300 rounded-l-md bg-gray-50 text-gray-500 sm:text-sm">
                                        +1
                                    </button>
                                    <button type="button" onclick="addMonths(3)" class="inline-flex items-center px-3 py-2 border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                        +3
                                    </button>
                                    <button type="button" onclick="addMonths(6)" class="inline-flex items-center px-3 py-2 border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                        +6
                                    </button>
                                    <button type="button" onclick="addMonths(12)" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-r-md bg-gray-50 text-gray-500 sm:text-sm">
                                        +12
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                            <select id="payment_method" name="payment_method" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md sm:text-sm">
                                <option value="cash">Cash</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="debit_card">Debit Card</option>
                                <option value="bank_transfer">Bank Transfer</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-200">
                        Renew Subscription
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-200" onclick="document.getElementById('renewModal').classList.add('hidden')">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Initialize Renew Modal Date and add helper functions -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const renewEndDateInput = document.getElementById('renew_end_date');
        const currentEndDate = new Date('{{ $subscription->end_date }}');
        
        // Calculate default new end date (3 months from current end date)
        const newEndDate = new Date(currentEndDate);
        newEndDate.setMonth(newEndDate.getMonth() + 3);
        
        // Format date as YYYY-MM-DD
        const year = newEndDate.getFullYear();
        const month = String(newEndDate.getMonth() + 1).padStart(2, '0');
        const day = String(newEndDate.getDate()).padStart(2, '0');
        
        renewEndDateInput.value = `${year}-${month}-${day}`;
    });
    
    // Function to add months to the renewal date
    function addMonths(monthsToAdd) {
        const renewEndDateInput = document.getElementById('renew_end_date');
        const currentEndDate = new Date('{{ $subscription->end_date }}');
        
        const newEndDate = new Date(currentEndDate);
        newEndDate.setMonth(newEndDate.getMonth() + monthsToAdd);
        
        // Format date as YYYY-MM-DD
        const year = newEndDate.getFullYear();
        const month = String(newEndDate.getMonth() + 1).padStart(2, '0');
        const day = String(newEndDate.getDate()).padStart(2, '0');
        
        renewEndDateInput.value = `${year}-${month}-${day}`;
    }
</script>
@endsection
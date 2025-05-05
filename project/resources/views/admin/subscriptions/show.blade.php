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
                                Subscription Details
                            </h1>
                            <p class="mt-1 text-orange-50 text-sm flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                View complete subscription information and payment history
                            </p>
                        </div>
                        <div class="mt-4 md:mt-0 flex space-x-3">
                            <a href="{{ route('admin.subscriptions.edit', $subscription) }}" 
                               class="inline-flex items-center px-4 py-2 border border-white border-opacity-20 rounded-lg text-sm font-medium text-white bg-white bg-opacity-10 hover:bg-opacity-20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-orange-500 focus:ring-white transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <a href="{{ route('admin.subscriptions.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-orange-600 bg-white hover:bg-orange-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-orange-500 focus:ring-white transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subscription Details -->
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Info Column -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Subscription Information Card -->
                        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900">Subscription Information</h3>
                                
                                <div class="ml-auto">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($subscription->status == 'active') bg-green-100 text-green-800 border border-green-200
                                        @elseif($subscription->status == 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                                        @elseif($subscription->status == 'cancelled') bg-red-100 text-red-800 border border-red-200
                                        @else bg-gray-100 text-gray-800 border border-gray-200 @endif">
                                        {{ ucfirst($subscription->status) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row md:items-center mb-6 pb-6 border-b border-gray-100">
                                    <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-6">
                                        <div class="h-20 w-20 rounded-full bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center shadow-md">
                                            <span class="text-white text-2xl font-bold">
                                                {{ substr($subscription->user->firstname, 0, 1) }}{{ substr($subscription->user->lastname, 0, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-bold text-gray-900">{{ $subscription->user->firstname }} {{ $subscription->user->lastname }}</h2>
                                        <div class="flex flex-col md:flex-row md:items-center text-sm text-gray-500 mt-1 space-y-1 md:space-y-0 md:space-x-4">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                                {{ $subscription->user->email }}
                                            </div>
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                {{ $subscription->user->phone ?? 'No phone number' }}
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <a href="{{ route('admin.users.edit', $subscription->user) }}" class="text-sm font-medium text-orange-600 hover:text-orange-700">
                                                View Member Profile
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Subscription ID</label>
                                            <div class="text-base font-semibold text-gray-900">#{{ $subscription->id }}</div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Type</label>
                                            <div>
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if($subscription->type == 'Basic') bg-blue-100 text-blue-800 border border-blue-200
                                                    @elseif($subscription->type == 'Premium') bg-purple-100 text-purple-800 border border-purple-200
                                                    @else bg-green-100 text-green-800 border border-green-200 @endif">
                                                    {{ $subscription->type }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Created</label>
                                            <div class="text-base text-gray-900">{{ $subscription->created_at->format('F d, Y h:i A') }}</div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                                            <div class="text-base text-gray-900">{{ $subscription->updated_at->format('F d, Y h:i A') }}</div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Subscription Period</label>
                                            <div class="flex items-center">
                                                <span class="text-base font-semibold text-gray-900">
                                                    {{ \Carbon\Carbon::parse($subscription->start_date)->format('F d, Y') }}
                                                </span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                                </svg>
                                                <span class="text-base font-semibold text-gray-900">
                                                    {{ \Carbon\Carbon::parse($subscription->end_date)->format('F d, Y') }}
                                                </span>
                                            </div>
                                            <div class="mt-1 text-sm text-gray-500">
                                                {{ $subscription->duration }} {{ Str::plural('month', $subscription->duration) }}
                                                
                                                @if($subscription->status == 'active')
                                                    @php
                                                        $daysLeft = \Carbon\Carbon::parse($subscription->end_date)->diffInDays(\Carbon\Carbon::now());
                                                        $isExpiring = $daysLeft <= 7;
                                                    @endphp
                                                    
                                                    @if($isExpiring)
                                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            Expires in {{ $daysLeft }} {{ Str::plural('day', $daysLeft) }}
                                                        </span>
                                                    @else
                                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                            {{ $daysLeft }} {{ Str::plural('day', $daysLeft) }} remaining
                                                        </span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Subscription Price</label>
                                            <div class="text-lg font-bold text-gray-900">${{ number_format($subscription->price, 2) }}</div>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Payment Method</label>
                                            <div class="flex items-center text-base text-gray-900">
                                                @if($subscription->payment_method == 'cash')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                @elseif($subscription->payment_method == 'credit_card')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                    </svg>
                                                @elseif($subscription->payment_method == 'bank_transfer')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                                    </svg>
                                                @elseif($subscription->payment_method == 'stripe')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                    </svg>
                                                @endif
                                                {{ ucwords(str_replace('_', ' ', $subscription->payment_method ?? 'Not specified')) }}
                                                
                                                @if($subscription->transaction_number)
                                                    <span class="ml-2 text-sm text-gray-500">(Transaction #: {{ $subscription->transaction_number }})</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="text-sm font-medium text-gray-500 mb-1">Sessions</div>
                                            <div class="flex items-center">
                                                <span class="text-lg font-semibold text-gray-900">{{ $subscription->sessions_left }}</span>
                                                <span class="mx-1 text-gray-400">/</span>
                                                <span class="text-base text-gray-700">{{ $subscription->max_sessions_count }}</span>
                                            </div>
                                            <div class="mt-2 text-xs text-gray-500">
                                                Remaining sessions
                                            </div>
                                        </div>
                                        
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="text-sm font-medium text-gray-500 mb-1">Trainer Zone Access</div>
                                            <div class="flex items-center mt-1">
                                                @if($subscription->trainer_zone_access)
                                                    <span class="flex items-center text-green-600 font-medium">
                                                        <svg class="h-5 w-5 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Enabled
                                                    </span>
                                                @else
                                                    <span class="flex items-center text-red-600 font-medium">
                                                        <svg class="h-5 w-5 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        Disabled
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="mt-2 text-xs text-gray-500">
                                                Special training area access
                                            </div>
                                        </div>
                                        
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="text-sm font-medium text-gray-500 mb-1">Next Renewal</div>
                                            @if($subscription->status == 'active')
                                                <div class="text-base font-medium text-gray-900">
                                                    {{ \Carbon\Carbon::parse($subscription->end_date)->format('M d, Y') }}
                                                </div>
                                                <div class="mt-2 text-xs text-gray-500">
                                                    Auto-renewal {{ $subscription->auto_renew ? 'enabled' : 'disabled' }}
                                                </div>
                                            @else
                                                <div class="flex items-center text-red-600 font-medium">
                                                    <svg class="h-5 w-5 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    No renewal scheduled
                                                </div>
                                                <div class="mt-2 text-xs text-gray-500">
                                                    Subscription is not active
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                @if($subscription->notes)
                                <div class="mt-6 pt-6 border-t border-gray-100">
                                    <label class="block text-sm font-medium text-gray-500 mb-2">Notes</label>
                                    <div class="text-gray-700 bg-gray-50 p-4 rounded-lg">
                                        {{ $subscription->notes }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Payment History Card -->
                        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900">Payment History</h3>
                                </div>
                                <button type="button" onclick="openNewPaymentModal()" class="inline-flex items-center px-3 py-1.5 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors duration-200">
                                    <svg class="-ml-1 mr-1.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Add Payment
                                </button>
                            </div>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Amount
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Method
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Reference
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($subscription->payments as $payment)
                                            <tr class="hover:bg-orange-50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ \Carbon\Carbon::parse($payment->date)->format('M d, Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                    ${{ number_format($payment->amount, 2) }}
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
                                                        @elseif($payment->method == 'stripe')
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                            </svg>
                                                        @endif
                                                        {{ ucfirst($payment->method) }}
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
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $payment->reference ?? 'N/A' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <div class="flex justify-end space-x-1">
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
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        <a href="{{ route('admin.payments.receipt', $payment) }}" target="_blank" class="text-blue-600 hover:text-blue-900 px-2 py-1 rounded-md hover:bg-blue-50 transition-colors duration-200">
                                                            <span class="sr-only">Receipt</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                        </svg>
                                                        <p class="text-gray-500 font-medium">No payments found for this subscription</p>
                                                        <button type="button" onclick="openNewPaymentModal()" class="mt-3 inline-flex items-center px-3 py-1.5 text-sm text-orange-500 hover:text-orange-700 font-medium">
                                                            <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                            </svg>
                                                            Add first payment
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sidebar Column -->
                    <div class="space-y-8">
                        <!-- Quick Actions Card -->
                        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Quick Actions
                                </h3>
                            </div>
                            <div class="p-4 space-y-3">
                                @if($subscription->status == 'active')
                                    <button type="button" onclick="openRenewModal()" class="w-full inline-flex justify-center items-center px-4 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Renew Subscription
                                    </button>
                                @endif
                                
                                <a href="{{ route('admin.subscriptions.edit', $subscription) }}" class="w-full inline-flex justify-center items-center px-4 py-3 border border-orange-300 rounded-md shadow-sm text-sm font-medium text-orange-700 bg-white hover:bg-orange-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit Subscription
                                </a>
                                
                                @if($subscription->status == 'active')
                                    <button type="button" onclick="openUpdateSessionsModal()" class="w-full inline-flex justify-center items-center px-4 py-3 border border-orange-300 rounded-md shadow-sm text-sm font-medium text-orange-700 bg-white hover:bg-orange-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                        <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Update Available Sessions
                                    </button>
                                    
                                    <button type="button" onclick="toggleTrainerZoneAccess()" class="w-full inline-flex justify-center items-center px-4 py-3 border border-orange-300 rounded-md shadow-sm text-sm font-medium text-orange-700 bg-white hover:bg-orange-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                        @if($subscription->trainer_zone_access)
                                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                            </svg>
                                            Disable Trainer Zone Access
                                        @else
                                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                            </svg>
                                            Enable Trainer Zone Access
                                        @endif
                                    </button>
                                @endif
                                
                                @if($subscription->status != 'cancelled')
                                    <form action="{{ route('admin.subscriptions.cancel', $subscription) }}" method="POST" class="w-full" onsubmit="return confirm('Are you sure you want to cancel this subscription?');">
                                        @csrf
                                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Cancel Subscription
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Subscription Details Card -->
                        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Subscription Benefits
                                </h3>
                            </div>
                            <div class="p-4">
                                <ul class="space-y-3">
                                    @if($subscription->type == 'Basic')
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-sm text-gray-700">Basic gym access</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-sm text-gray-700">8 sessions per month</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-red-500 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            <span class="text-sm text-gray-500">No trainer zone access</span>
                                        </li>
                                    @elseif($subscription->type == 'Premium')
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-sm text-gray-700">Full gym access</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-sm text-gray-700">16 sessions per month</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-sm text-gray-700">Trainer zone access</span>
                                        </li>
                                    @else
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-sm text-gray-700">Unlimited gym access</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-sm text-gray-700">Unlimited sessions</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-sm text-gray-700">Trainer zone access</span>
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-sm text-gray-700">Personal trainer included</span>
                                        </li>
                                    @endif
                                </ul>
                                
                                @if($subscription->status == 'active' && $subscription->type != 'Elite')
                                    <div class="mt-4 pt-4 border-t border-gray-100">
                                        <a href="{{ route('admin.subscriptions.edit', $subscription) }}?upgrade=true" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-orange-700 bg-orange-100 hover:bg-orange-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                            </svg>
                                            Upgrade Membership
                                        </a>
                                    </div>
                                @endif
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

<!-- Renew Subscription Modal -->
<div id="renewModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="renewForm" method="POST" action="{{ route('admin.subscriptions.renew', $subscription) }}">
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
                                        <input type="number" name="price" id="price" step="0.01" min="0" class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" placeholder="0.00" value="{{ number_format($subscription->price, 2, '.', '') }}">
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

<!-- Update Sessions Modal -->
<div id="updateSessionsModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('admin.subscriptions.update', $subscription) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="update_type" value="sessions">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-orange-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Update Available Sessions
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Adjust the number of available sessions for this subscription.
                                </p>
                            </div>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label for="sessions_left" class="block text-sm font-medium text-gray-700">Available Sessions</label>
                                    <input type="number" name="sessions_left" id="sessions_left" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" value="{{ $subscription->sessions_left }}">
                                    <p class="mt-1 text-xs text-gray-500">Current: {{ $subscription->sessions_left }} / {{ $subscription->max_sessions_count }}</p>
                                </div>
                                <div>
                                    <label for="max_sessions_count" class="block text-sm font-medium text-gray-700">Maximum Sessions</label>
                                    <input type="number" name="max_sessions_count" id="max_sessions_count" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" value="{{ $subscription->max_sessions_count }}">
                                </div>
                                <div>
                                    <label for="session_notes" class="block text-sm font-medium text-gray-700">Notes (optional)</label>
                                    <textarea name="session_notes" id="session_notes" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" placeholder="Reason for updating sessions"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-600 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                        Update Sessions
                    </button>
                    <button type="button" onclick="closeUpdateSessionsModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- New Payment Modal -->
<div id="newPaymentModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('admin.payments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-orange-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Add New Payment
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Add a new payment record for this subscription.
                                </p>
                            </div>
                            <div class="mt-4 space-y-4">
                                <div>
                                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">$</span>
                                        </div>
                                        <input type="number" name="amount" id="amount" step="0.01" min="0" class="pl-7 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" placeholder="0.00" required>
                                    </div>
                                </div>
                                <div>
                                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" required>
                                </div>
                                <div>
                                    <label for="method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                    <select name="method" id="method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" required>
                                        <option value="cash">Cash</option>
                                        <option value="credit_card">Credit Card</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                        <option value="stripe">Stripe</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm" required>
                                        <option value="pending">Pending</option>
                                        <option value="paid">Paid</option>
                                        <option value="refunded">Refunded</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="reference" class="block text-sm font-medium text-gray-700">Reference (optional)</label>
                                    <input type="text" name="reference" id="reference" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes (optional)</label>
                                    <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500 sm:text-sm"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-600 text-base font-medium text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                        Add Payment
                    </button>
                    <button type="button" onclick="closeNewPaymentModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upgrade Membership Modal removed -->

@endsection

@push('scripts')
<script>
    // Renew Subscription Modal
    function openRenewModal() {
        document.getElementById('renewModal').classList.remove('hidden');
    }
    
    function closeRenewModal() {
        document.getElementById('renewModal').classList.add('hidden');
    }
    
    // Update Sessions Modal
    function openUpdateSessionsModal() {
        document.getElementById('updateSessionsModal').classList.remove('hidden');
    }
    
    function closeUpdateSessionsModal() {
        document.getElementById('updateSessionsModal').classList.add('hidden');
    }
    
    // New Payment Modal
    function openNewPaymentModal() {
        document.getElementById('newPaymentModal').classList.remove('hidden');
    }
    
    function closeNewPaymentModal() {
        document.getElementById('newPaymentModal').classList.add('hidden');
    }
    
    // Upgrade Membership Modal
    function openUpgradeModal() {
        document.getElementById('upgradeModal').classList.remove('hidden');
        
        // Set default upgrade fee based on new type selected
        const newTypeSelect = document.getElementById('new_type');
        calculateUpgradeFee(newTypeSelect.value);
        
        newTypeSelect.addEventListener('change', function() {
            calculateUpgradeFee(this.value);
        });
    }
    
    function closeUpgradeModal() {
        document.getElementById('upgradeModal').classList.add('hidden');
    }
    
    function calculateUpgradeFee(newType) {
        let baseFee = 0;
        const currentType = "{{ $subscription->type }}";
        const currentPrice = {{ $subscription->price }};
        const remainingDays = {{ \Carbon\Carbon::parse($subscription->end_date)->diffInDays(\Carbon\Carbon::now()) }};
        const totalDays = {{ $subscription->duration * 30 }}; // Approximate month length
        
        if (newType === 'Premium' && currentType === 'Basic') {
            baseFee = 30;
        } else if (newType === 'Elite') {
            baseFee = currentType === 'Basic' ? 70 : 40;
        }
        
        // Pro-rate based on remaining time
        const proRatedFee = baseFee * (remainingDays / totalDays);
        document.getElementById('upgrade_price').value = proRatedFee.toFixed(2);
    }
    
    // Toggle Trainer Zone Access
    function toggleTrainerZoneAccess() {
        if (confirm('Are you sure you want to toggle trainer zone access for this subscription?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('admin.subscriptions.update', $subscription) }}';
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'PUT';
            
            const updateType = document.createElement('input');
            updateType.type = 'hidden';
            updateType.name = 'update_type';
            updateType.value = 'trainer_zone';
            
            form.appendChild(csrfToken);
            form.appendChild(method);
            form.appendChild(updateType);
            document.body.appendChild(form);
            form.submit();
        }
    }
    
    // Calculate price based on duration for renewal
    document.getElementById('duration').addEventListener('change', function() {
        const duration = parseInt(this.value);
        const subscriptionPrice = {{ $subscription->price }};
        const subscriptionDuration = {{ $subscription->duration > 0 ? $subscription->duration : 1 }};
        const basePrice = subscriptionPrice / subscriptionDuration;
        
        // Apply discounts for longer durations
        let price = basePrice * duration;
        if (duration >= 3) {
            price = price * 0.95; // 5% discount for 3+ months
        }
        if (duration >= 6) {
            price = price * 0.95; // Additional 5% discount for 6+ months
        }
        if (duration >= 12) {
            price = price * 0.95; // Additional 5% discount for 12+ months
        }
        
        document.getElementById('price').value = price.toFixed(2);
    });
    
    // Close modals when clicking outside or pressing ESC
    window.addEventListener('click', function(event) {
        if (event.target === document.getElementById('renewModal')) {
            closeRenewModal();
        }
        if (event.target === document.getElementById('updateSessionsModal')) {
            closeUpdateSessionsModal();
        }
        if (event.target === document.getElementById('newPaymentModal')) {
            closeNewPaymentModal();
        }
    });
    
    window.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeRenewModal();
            closeUpdateSessionsModal();
            closeNewPaymentModal();
        }
    });
</script>
@endpush
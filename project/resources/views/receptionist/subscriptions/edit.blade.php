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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            <h1 class="text-2xl font-bold text-gray-900">Edit Subscription</h1>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('receptionist.subscriptions.show', $subscription->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
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
                    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                        <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Subscription Information</h3>
                            </div>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Update the subscription details for this member</p>
                        </div>
                        <form action="{{ route('receptionist.subscriptions.update', $subscription->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <!-- Member Selection -->
                                    <div class="col-span-2">
                                        <label for="user_id" class="block text-sm font-medium text-gray-700">Member</label>
                                        <div class="relative mt-1 rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <select id="user_id" name="user_id" required class="pl-10 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option value="">Select a member</option>
                                                @foreach($members as $member)
                                                    <option value="{{ $member->id }}" {{ (old('user_id') ?? $subscription->user_id) == $member->id ? 'selected' : '' }}>
                                                        {{ $member->firstname }} {{ $member->lastname }} ({{ $member->email }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('user_id')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Subscription Details Card -->
                                    <div class="col-span-2 p-4 bg-gray-50 rounded-lg border border-gray-200 mb-4">
                                        <h4 class="text-md font-medium text-gray-900 mb-3 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            Subscription Details
                                        </h4>
                                        
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <!-- Subscription Type -->
                                            <div>
                                                <label for="type" class="block text-sm font-medium text-gray-700">Subscription Type</label>
                                                <div class="mt-1">
                                                    <div class="relative rounded-md shadow-sm">
                                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                            </svg>
                                                        </div>
                                                        <select id="type" name="type" required class="pl-10 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                            <option value="">Select a type</option>
                                                            <option value="Basic" {{ (old('type') ?? $subscription->type) == 'Basic' ? 'selected' : '' }}>Basic</option>
                                                            <option value="Premium" {{ (old('type') ?? $subscription->type) == 'Premium' ? 'selected' : '' }}>Premium</option>
                                                            <option value="Elite" {{ (old('type') ?? $subscription->type) == 'Elite' ? 'selected' : '' }}>Elite</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                @error('type')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Duration -->
                                            <div>
                                                <label for="duration" class="block text-sm font-medium text-gray-700">Duration (months)</label>
                                                <div class="mt-1">
                                                    <div class="relative rounded-md shadow-sm">
                                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                        </div>
                                                        <select id="duration" name="duration" required class="pl-10 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                            <option value="1" {{ (old('duration') ?? $subscription->duration) == 1 ? 'selected' : '' }}>1 Month</option>
                                                            <option value="3" {{ (old('duration') ?? $subscription->duration) == 3 ? 'selected' : '' }}>3 Months</option>
                                                            <option value="6" {{ (old('duration') ?? $subscription->duration) == 6 ? 'selected' : '' }}>6 Months</option>
                                                            <option value="12" {{ (old('duration') ?? $subscription->duration) == 12 ? 'selected' : '' }}>12 Months</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                @error('duration')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pricing and Dates Card -->
                                    <div class="col-span-2 p-4 bg-gray-50 rounded-lg border border-gray-200 mb-4">
                                        <h4 class="text-md font-medium text-gray-900 mb-3 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Pricing & Dates
                                        </h4>
                                        
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <!-- Price -->
                                            <div>
                                                <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                                                <div class="mt-1 relative rounded-md shadow-sm">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <span class="text-gray-500 sm:text-sm">$</span>
                                                    </div>
                                                    <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price') ?? $subscription->price }}" required class="pl-7 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>
                                                @error('price')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            
                                            <!-- Dates section -->
                                            <div class="grid grid-cols-2 gap-4">
                                                <!-- Start Date -->
                                                <div>
                                                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') ?? $subscription->start_date }}" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    @error('start_date')
                                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <!-- End Date -->
                                                <div>
                                                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') ?? $subscription->end_date }}" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    @error('end_date')
                                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Payment Details Card -->
                                    <div class="col-span-2 p-4 bg-gray-50 rounded-lg border border-gray-200 mb-4">
                                        <h4 class="text-md font-medium text-gray-900 mb-3 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Payment & Status
                                        </h4>
                                        
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <!-- Status -->
                                            <div>
                                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                                <div class="mt-1 relative rounded-md shadow-sm">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                    </div>
                                                    <select id="status" name="status" required class="pl-10 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                        <option value="pending" {{ (old('status') ?? $subscription->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="active" {{ (old('status') ?? $subscription->status) == 'active' ? 'selected' : '' }}>Active</option>
                                                        <option value="cancelled" {{ (old('status') ?? $subscription->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                        <option value="expired" {{ (old('status') ?? $subscription->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                                                    </select>
                                                </div>
                                                @error('status')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Payment Method -->
                                            <div>
                                                <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                                <div class="mt-1 relative rounded-md shadow-sm">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                        </svg>
                                                    </div>
                                                    <select id="payment_method" name="payment_method" class="pl-10 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                        <option value="">None</option>
                                                        <option value="cash" {{ (old('payment_method') ?? $subscription->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                                                        <option value="credit_card" {{ (old('payment_method') ?? $subscription->payment_method) == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                                        <option value="debit_card" {{ (old('payment_method') ?? $subscription->payment_method) == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                                                        <option value="bank_transfer" {{ (old('payment_method') ?? $subscription->payment_method) == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                                    </select>
                                                </div>
                                                @error('payment_method')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Transaction Information -->
                                        <div class="mt-4">
                                            <label for="transaction_number" class="block text-sm font-medium text-gray-700">Transaction Number</label>
                                            <div class="mt-1 relative rounded-md shadow-sm">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </div>
                                                <input type="text" name="transaction_number" id="transaction_number" value="{{ old('transaction_number') ?? $subscription->transaction_number }}" class="pl-10 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                            @error('transaction_number')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Session Details Card -->
                                    <div class="col-span-2 p-4 bg-gray-50 rounded-lg border border-gray-200 mb-4">
                                        <h4 class="text-md font-medium text-gray-900 mb-3 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                            Session Details
                                        </h4>
                                        
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <!-- Max Sessions Count -->
                                            <div>
                                                <label for="max_sessions_count" class="block text-sm font-medium text-gray-700">Max Sessions</label>
                                                <div class="mt-1 relative rounded-md shadow-sm">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                                        </svg>
                                                    </div>
                                                    <input type="number" name="max_sessions_count" id="max_sessions_count" min="0" placeholder="Leave blank for unlimited" value="{{ old('max_sessions_count') ?? $subscription->max_sessions_count }}" class="pl-10 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>
                                                @error('max_sessions_count')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- Sessions Left -->
                                            <div>
                                                <label for="sessions_left" class="block text-sm font-medium text-gray-700">Sessions Left</label>
                                                <div class="mt-1 relative rounded-md shadow-sm">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                        </svg>
                                                    </div>
                                                    <input type="number" name="sessions_left" id="sessions_left" min="0" value="{{ old('sessions_left') ?? $subscription->sessions_left }}" class="pl-10 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>
                                                @error('sessions_left')
                                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Trainer Zone Access -->
                                    <div class="col-span-2">
                                        <div class="relative flex items-start p-4 bg-gray-50 rounded-lg border border-gray-200">
                                            <div class="flex items-center h-5">
                                                <input id="trainer_zone_access" name="trainer_zone_access" type="checkbox" value="1" {{ (old('trainer_zone_access') ?? $subscription->trainer_zone_access) ? 'checked' : '' }} class="focus:ring-blue-500 h-5 w-5 text-blue-600 border-gray-300 rounded transition-all duration-200">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="trainer_zone_access" class="font-medium text-gray-700">Trainer Zone Access</label>
                                                <p class="text-gray-500 mt-1">Allow member to access the trainer zone and premium equipment</p>
                                            </div>
                                        </div>
                                        @error('trainer_zone_access')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 border-t border-gray-200">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 transition-all duration-200">
                                    Update Subscription
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Calculate End Date JS -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const durationSelect = document.getElementById('duration');
        const typeSelect = document.getElementById('type');
        const priceInput = document.getElementById('price');
        const trainerZoneCheckbox = document.getElementById('trainer_zone_access');
        
        function calculateEndDate() {
            const startDate = new Date(startDateInput.value);
            const duration = parseInt(durationSelect.value);
            
            if (startDate && !isNaN(duration)) {
                const endDate = new Date(startDate);
                endDate.setMonth(endDate.getMonth() + duration);
                
                // Format date as YYYY-MM-DD
                const year = endDate.getFullYear();
                const month = String(endDate.getMonth() + 1).padStart(2, '0');
                const day = String(endDate.getDate()).padStart(2, '0');
                
                endDateInput.value = `${year}-${month}-${day}`;
            }
        }
        
        function updatePrice() {
            const type = typeSelect.value;
            const duration = parseInt(durationSelect.value);
            
            // Only update the price if user hasn't manually edited it
            if (!priceInput.dataset.userModified) {
                // Example pricing logic
                let basePrice = 0;
                
                if (type === 'Basic') basePrice = 30;
                else if (type === 'Premium') {
                    basePrice = 50;
                    // Automatically check trainer zone access for Premium and Elite
                    trainerZoneCheckbox.checked = true;
                }
                else if (type === 'Elite') {
                    basePrice = 80;
                    trainerZoneCheckbox.checked = true;
                }
                
                // Apply discount for longer durations
                let discount = 1;
                if (duration === 3) discount = 0.95; // 5% discount for 3 months
                else if (duration === 6) discount = 0.9; // 10% discount for 6 months
                else if (duration === 12) discount = 0.85; // 15% discount for 12 months
                
                // Calculate total price
                if (basePrice > 0) {
                    const totalPrice = (basePrice * duration * discount).toFixed(2);
                    priceInput.value = totalPrice;
                }
            }
        }
        
        // Set up event listeners
        startDateInput.addEventListener('change', calculateEndDate);
        durationSelect.addEventListener('change', () => {
            calculateEndDate();
            updatePrice();
        });
        typeSelect.addEventListener('change', updatePrice);
        
        // Mark price as user-modified when edited directly
        priceInput.addEventListener('change', () => {
            priceInput.dataset.userModified = 'true';
        });
        
        // For edit form, don't automatically update price unless user changes type/duration
        if (!priceInput.dataset.userModified) {
            priceInput.dataset.userModified = 'true';
        }
    });
</script>
@endsection
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
                        <h1 class="text-2xl font-semibold text-gray-900">Edit Subscription</h1>
                        <div class="flex space-x-2">
                            <a href="{{ route('receptionist.subscriptions.show', $subscription->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View
                            </a>
                            <a href="{{ route('receptionist.subscriptions.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back
                            </a>
                        </div>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <form action="{{ route('receptionist.subscriptions.update', $subscription->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <!-- Member Selection -->
                                    <div class="col-span-2">
                                        <label for="user_id" class="block text-sm font-medium text-gray-700">Member</label>
                                        <select id="user_id" name="user_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="">Select a member</option>
                                            @foreach($members as $member)
                                                <option value="{{ $member->id }}" {{ (old('user_id') ?? $subscription->user_id) == $member->id ? 'selected' : '' }}>
                                                    {{ $member->firstname }} {{ $member->lastname }} ({{ $member->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Subscription Type -->
                                    <div>
                                        <label for="type" class="block text-sm font-medium text-gray-700">Subscription Type</label>
                                        <select id="type" name="type" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="">Select a type</option>
                                            <option value="Basic" {{ (old('type') ?? $subscription->type) == 'Basic' ? 'selected' : '' }}>Basic</option>
                                            <option value="Premium" {{ (old('type') ?? $subscription->type) == 'Premium' ? 'selected' : '' }}>Premium</option>
                                            <option value="Elite" {{ (old('type') ?? $subscription->type) == 'Elite' ? 'selected' : '' }}>Elite</option>
                                        </select>
                                        @error('type')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Duration -->
                                    <div>
                                        <label for="duration" class="block text-sm font-medium text-gray-700">Duration (months)</label>
                                        <select id="duration" name="duration" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="1" {{ (old('duration') ?? $subscription->duration) == 1 ? 'selected' : '' }}>1 Month</option>
                                            <option value="3" {{ (old('duration') ?? $subscription->duration) == 3 ? 'selected' : '' }}>3 Months</option>
                                            <option value="6" {{ (old('duration') ?? $subscription->duration) == 6 ? 'selected' : '' }}>6 Months</option>
                                            <option value="12" {{ (old('duration') ?? $subscription->duration) == 12 ? 'selected' : '' }}>12 Months</option>
                                        </select>
                                        @error('duration')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Price -->
                                    <div>
                                        <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                                        <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price') ?? $subscription->price }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('price')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Start Date -->
                                    <div>
                                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') ?? $subscription->start_date }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('start_date')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- End Date -->
                                    <div>
                                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') ?? $subscription->end_date }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('end_date')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                        <select id="status" name="status" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="pending" {{ (old('status') ?? $subscription->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="active" {{ (old('status') ?? $subscription->status) == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="cancelled" {{ (old('status') ?? $subscription->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            <option value="expired" {{ (old('status') ?? $subscription->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                                        </select>
                                        @error('status')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Payment Method -->
                                    <div>
                                        <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                        <select id="payment_method" name="payment_method" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="">None</option>
                                            <option value="cash" {{ (old('payment_method') ?? $subscription->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="credit_card" {{ (old('payment_method') ?? $subscription->payment_method) == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                            <option value="debit_card" {{ (old('payment_method') ?? $subscription->payment_method) == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                                            <option value="bank_transfer" {{ (old('payment_method') ?? $subscription->payment_method) == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                        </select>
                                        @error('payment_method')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Transaction Number -->
                                    <div>
                                        <label for="transaction_number" class="block text-sm font-medium text-gray-700">Transaction Number</label>
                                        <input type="text" name="transaction_number" id="transaction_number" value="{{ old('transaction_number') ?? $subscription->transaction_number }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('transaction_number')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Max Sessions Count -->
                                    <div>
                                        <label for="max_sessions_count" class="block text-sm font-medium text-gray-700">Max Sessions (Leave blank for unlimited)</label>
                                        <input type="number" name="max_sessions_count" id="max_sessions_count" min="0" value="{{ old('max_sessions_count') ?? $subscription->max_sessions_count }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('max_sessions_count')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Sessions Left -->
                                    <div>
                                        <label for="sessions_left" class="block text-sm font-medium text-gray-700">Sessions Left</label>
                                        <input type="number" name="sessions_left" id="sessions_left" min="0" value="{{ old('sessions_left') ?? $subscription->sessions_left }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('sessions_left')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Trainer Zone Access -->
                                    <div class="col-span-2">
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="trainer_zone_access" name="trainer_zone_access" type="checkbox" value="1" {{ (old('trainer_zone_access') ?? $subscription->trainer_zone_access) ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="trainer_zone_access" class="font-medium text-gray-700">Trainer Zone Access</label>
                                                <p class="text-gray-500">Allow member to access the trainer zone and premium equipment</p>
                                            </div>
                                        </div>
                                        @error('trainer_zone_access')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
        
        // Calculate end date when start date or duration changes
        startDateInput.addEventListener('change', calculateEndDate);
        durationSelect.addEventListener('change', calculateEndDate);
    });
</script>
@endsection
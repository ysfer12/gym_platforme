@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Include the admin sidebar -->
        @include('partials.admin-sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Page Header -->
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <h1 class="text-3xl font-bold">Edit Subscription</h1>
                        <a href="{{ route('admin.subscriptions.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-800 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Subscriptions
                        </a>
                    </div>
                </div>
            </div>

            <!-- Subscription Form -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow overflow-hidden rounded-lg">
                    <form action="{{ route('admin.subscriptions.update', $subscription) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                <!-- Member Selection -->
                                <div class="sm:col-span-3">
                                    <label for="user_id" class="block text-sm font-medium text-gray-700">Member</label>
                                    <div class="mt-1">
                                        <select id="user_id" name="user_id" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                            <option value="">Select a member</option>
                                            @foreach($members as $member)
                                                <option value="{{ $member->id }}" {{ old('user_id', $subscription->user_id) == $member->id ? 'selected' : '' }}>
                                                    {{ $member->firstname }} {{ $member->lastname }} ({{ $member->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('user_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Subscription Type -->
                                <div class="sm:col-span-3">
                                    <label for="type" class="block text-sm font-medium text-gray-700">Subscription Type</label>
                                    <div class="mt-1">
                                        <select id="type" name="type" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" onchange="updateSubscriptionDefaults()">
                                            <option value="">Select a type</option>
                                            @foreach($types as $type)
                                                <option value="{{ $type }}" {{ old('type', $subscription->type) == $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Duration -->
                                <div class="sm:col-span-2">
                                    <label for="duration" class="block text-sm font-medium text-gray-700">Duration (months)</label>
                                    <div class="mt-1">
                                        <select id="duration" name="duration" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" onchange="updateSubscriptionPrice()">
                                            <option value="">Select duration</option>
                                            @foreach($durations as $duration)
                                                <option value="{{ $duration }}" {{ old('duration', $subscription->duration) == $duration ? 'selected' : '' }}>
                                                    {{ $duration }} {{ $duration == 1 ? 'month' : 'months' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('duration')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Price -->
                                <div class="sm:col-span-2">
                                    <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                                    <div class="mt-1">
                                        <input type="number" name="price" id="price" min="0" step="0.01" value="{{ old('price', $subscription->price) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    @error('price')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="sm:col-span-2">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <div class="mt-1">
                                        <select id="status" name="status" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                            <option value="pending" {{ old('status', $subscription->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="active" {{ old('status', $subscription->status) == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="cancelled" {{ old('status', $subscription->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Start Date -->
                                <div class="sm:col-span-3">
                                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                                    <div class="mt-1">
                                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $subscription->start_date ? date('Y-m-d', strtotime($subscription->start_date)) : '') }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" onchange="updateEndDate()">
                                    </div>
                                    @error('start_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- End Date -->
                                <div class="sm:col-span-3">
                                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                                    <div class="mt-1">
                                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $subscription->end_date ? date('Y-m-d', strtotime($subscription->end_date)) : '') }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    @error('end_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Payment Method -->
                                <div class="sm:col-span-3">
                                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                    <div class="mt-1">
                                        <select id="payment_method" name="payment_method" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                            <option value="">None</option>
                                            <option value="cash" {{ old('payment_method', $subscription->payment_method) == 'cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="credit_card" {{ old('payment_method', $subscription->payment_method) == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                            <option value="bank_transfer" {{ old('payment_method', $subscription->payment_method) == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                            <option value="stripe" {{ old('payment_method', $subscription->payment_method) == 'stripe' ? 'selected' : '' }}>Stripe</option>
                                        </select>
                                    </div>
                                    @error('payment_method')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Transaction Number -->
                                <div class="sm:col-span-3">
                                    <label for="transaction_number" class="block text-sm font-medium text-gray-700">Transaction Number (optional)</label>
                                    <div class="mt-1">
                                        <input type="text" name="transaction_number" id="transaction_number" value="{{ old('transaction_number', $subscription->transaction_number) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    @error('transaction_number')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Max Sessions Count -->
                                <div class="sm:col-span-2">
                                    <label for="max_sessions_count" class="block text-sm font-medium text-gray-700">Max Sessions</label>
                                    <div class="mt-1">
                                        <input type="number" name="max_sessions_count" id="max_sessions_count" min="0" value="{{ old('max_sessions_count', $subscription->max_sessions_count) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    @error('max_sessions_count')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Sessions Left -->
                                <div class="sm:col-span-2">
                                    <label for="sessions_left" class="block text-sm font-medium text-gray-700">Sessions Left</label>
                                    <div class="mt-1">
                                        <input type="number" name="sessions_left" id="sessions_left" min="0" value="{{ old('sessions_left', $subscription->sessions_left) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    @error('sessions_left')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Trainer Zone Access -->
                                <div class="sm:col-span-2">
                                    <div class="flex items-start mt-6">
                                        <div class="flex items-center h-5">
                                            <input id="trainer_zone_access" name="trainer_zone_access" type="checkbox" value="1" {{ old('trainer_zone_access', $subscription->trainer_zone_access) ? 'checked' : '' }} class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="trainer_zone_access" class="font-medium text-gray-700">Trainer Zone Access</label>
                                            <p class="text-gray-500">Allow member to access trainer zones</p>
                                        </div>
                                    </div>
                                    @error('trainer_zone_access')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Notes -->
                                <div class="sm:col-span-6">
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                    <div class="mt-1">
                                        <textarea id="notes" name="notes" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('notes', $subscription->notes) }}</textarea>
                                    </div>
                                    @error('notes')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
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
        
        <!-- Mobile Menu -->
        @include('partials.admin-mobile-menu')
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateEndDate() {
        const startDateInput = document.getElementById('start_date');
        const durationInput = document.getElementById('duration');
        const endDateInput = document.getElementById('end_date');
        
        if (startDateInput.value && durationInput.value) {
            const startDate = new Date(startDateInput.value);
            const durationMonths = parseInt(durationInput.value);
            
            const endDate = new Date(startDate);
            endDate.setMonth(endDate.getMonth() + durationMonths);
            
            // Format date to YYYY-MM-DD
            const year = endDate.getFullYear();
            const month = String(endDate.getMonth() + 1).padStart(2, '0');
            const day = String(endDate.getDate()).padStart(2, '0');
            
            endDateInput.value = `${year}-${month}-${day}`;
        }
    }
    
    function updateSubscriptionPrice() {
        const typeInput = document.getElementById('type');
        const durationInput = document.getElementById('duration');
        const priceInput = document.getElementById('price');
        
        if (typeInput.value && durationInput.value) {
            const type = typeInput.value;
            const duration = parseInt(durationInput.value);
            
            // Base prices
            let basePrice = 0;
            if (type === 'Basic') {
                basePrice = 29.99;
            } else if (type === 'Premium') {
                basePrice = 59.99;
            } else if (type === 'Elite') {
                basePrice = 99.99;
            }
            
            // Apply discounts for longer durations
            let price = basePrice * duration;
            if (duration >= 3) {
                price = price * 0.95; // 5% discount for 3+ months
            }
            if (duration >= 6) {
                price = price * 0.90; // Additional 10% discount for 6+ months
            }
            if (duration >= 12) {
                price = price * 0.85; // Additional 15% discount for 12+ months
            }
            
            priceInput.value = price.toFixed(2);
        }
    }
</script>
@endpush
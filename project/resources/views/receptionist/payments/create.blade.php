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
                        <h1 class="text-2xl font-semibold text-gray-900">Record New Payment</h1>
                        <a href="{{ route('receptionist.payments.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Payments
                        </a>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <form action="{{ route('receptionist.payments.store') }}" method="POST">
                            @csrf
                            <div class="px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <!-- Subscription Selection -->
                                    <div class="sm:col-span-2">
                                        <label for="subscription_id" class="block text-sm font-medium text-gray-700">Subscription</label>
                                        <select id="subscription_id" name="subscription_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="">Select a subscription</option>
                                            @foreach($subscriptions as $subscription)
                                                <option value="{{ $subscription->id }}" {{ (old('subscription_id') ?? request('subscription_id')) == $subscription->id ? 'selected' : '' }}>
                                                    {{ $subscription->user->firstname }} {{ $subscription->user->lastname }} - 
                                                    {{ $subscription->type }} ({{ \Carbon\Carbon::parse($subscription->start_date)->format('M d, Y') }} to {{ \Carbon\Carbon::parse($subscription->end_date)->format('M d, Y') }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subscription_id')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Amount -->
                                    <div>
                                        <label for="amount" class="block text-sm font-medium text-gray-700">Amount ($)</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">$</span>
                                            </div>
                                            <input type="number" name="amount" id="amount" step="0.01" min="0" value="{{ old('amount') }}" required class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                        @error('amount')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Date -->
                                    <div>
                                        <label for="date" class="block text-sm font-medium text-gray-700">Payment Date</label>
                                        <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" required class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('date')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Payment Method -->
                                    <div>
                                        <label for="method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                        <select id="method" name="method" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="">Select a method</option>
                                            <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="credit_card" {{ old('method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                            <option value="debit_card" {{ old('method') == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                                            <option value="bank_transfer" {{ old('method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                            <option value="mobile_payment" {{ old('method') == 'mobile_payment' ? 'selected' : '' }}>Mobile Payment</option>
                                        </select>
                                        @error('method')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div>
                                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                        <select id="status" name="status" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                        </select>
                                        @error('status')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Transaction ID -->
                                    <div>
                                        <label for="transaction_id" class="block text-sm font-medium text-gray-700">Transaction ID</label>
                                        <input type="text" name="transaction_id" id="transaction_id" value="{{ old('transaction_id') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('transaction_id')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Notes -->
                                    <div class="sm:col-span-2">
                                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                        <textarea id="notes" name="notes" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('notes') }}</textarea>
                                        @error('notes')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Record Payment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const subscriptionSelect = document.getElementById('subscription_id');
        const amountInput = document.getElementById('amount');
        
        // Create a mapping of subscription IDs to prices
        const subscriptionPrices = {
            @foreach($subscriptions as $subscription)
                {{ $subscription->id }}: {{ $subscription->price }},
            @endforeach
        };
        
        // Update amount when subscription changes
        subscriptionSelect.addEventListener('change', function() {
            const subscriptionId = this.value;
            if (subscriptionId && subscriptionPrices[subscriptionId]) {
                amountInput.value = subscriptionPrices[subscriptionId];
            }
        });
        
        // Set initial amount if subscription is pre-selected
        if (subscriptionSelect.value && subscriptionPrices[subscriptionSelect.value]) {
            amountInput.value = subscriptionPrices[subscriptionSelect.value];
        }
    });
</script>
@endsection
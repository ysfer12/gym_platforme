@extends('layouts.main')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">My Subscription</h1>
            <p class="mt-2 text-sm text-gray-600">Manage your gym membership subscription</p>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-8">
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
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-8">
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
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
            <div class="px-4 py-5 sm:px-6 bg-gray-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Subscription Status</h3>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    @if($activeSubscription)
                        <div class="bg-green-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1 text-sm text-green-800 sm:mt-0 sm:col-span-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Active
                                </span>
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Plan</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $activeSubscription->type }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Duration</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $activeSubscription->duration }} {{ $activeSubscription->duration == 1 ? 'month' : 'months' }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Start Date</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($activeSubscription->start_date)->format('M d, Y') }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">End Date</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($activeSubscription->end_date)->format('M d, Y') }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Time Remaining</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($activeSubscription->end_date)->diffForHumans(['parts' => 2]) }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Price</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">${{ number_format($activeSubscription->price, 2) }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Actions</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <a href="#subscription-plans" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Renew Subscription
                                </a>
                            </dd>
                        </div>
                    @else
                        <div class="bg-yellow-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1 text-sm text-yellow-800 sm:mt-0 sm:col-span-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3" />
                                    </svg>
                                    Inactive
                                </span>
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:px-6 text-center">
                            <p class="text-gray-700 mb-4">You don't have an active subscription.</p>
                            <a href="#subscription-plans" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                View Available Plans
                            </a>
                        </div>
                    @endif
                </dl>
            </div>
        </div>

        <!-- Subscription History -->
        @if($subscriptionHistory && $subscriptionHistory->count() > 0)
            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
                <div class="px-4 py-5 sm:px-6 bg-gray-50">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Subscription History</h3>
                </div>
                <div class="border-t border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Period</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($subscriptionHistory as $subscription)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $subscription->type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $subscription->duration }} {{ $subscription->duration == 1 ? 'month' : 'months' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($subscription->start_date)->format('M d, Y') }} - 
                                        {{ \Carbon\Carbon::parse($subscription->end_date)->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($subscription->price, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($subscription->status == 'active')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        @elseif($subscription->status == 'expired')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Expired</span>
                                        @elseif($subscription->status == 'cancelled')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Cancelled</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">{{ ucfirst($subscription->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Single Session Notice -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        <strong>Looking for a single session?</strong> Please visit our reception desk to purchase individual training sessions.
                    </p>
                </div>
            </div>
        </div>

        <!-- Available Plans -->
        <div id="subscription-plans" class="bg-white shadow sm:rounded-lg mb-8">
            <div class="px-4 py-5 sm:px-6 bg-gray-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Available Subscription Plans</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Choose the plan that fits your fitness goals</p>
            </div>
            
            <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    @foreach($availablePlans as $plan)
                        <div class="bg-white overflow-hidden shadow rounded-lg border {{ $activeSubscription && $activeSubscription->type == $plan['name'] ? 'border-indigo-500' : 'border-gray-200' }}">
                            <div class="p-5 {{ $activeSubscription && $activeSubscription->type == $plan['name'] ? 'bg-indigo-50' : '' }}">
                                <h3 class="text-lg font-bold text-gray-900">{{ $plan['name'] }}</h3>
                                <p class="mt-3 text-sm text-gray-500">{{ $plan['description'] }}</p>
                                
                                <!-- Subscription Durations -->
                                <div class="mt-4">
                                    <h4 class="text-sm font-medium text-gray-700">Select Duration:</h4>
                                    <div class="mt-2 space-y-2">
                                        @foreach($plan['durations'] as $duration)
                                            <div class="relative flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input id="{{ $plan['name'] }}-{{ $duration['months'] }}" name="{{ $plan['name'] }}-duration" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label for="{{ $plan['name'] }}-{{ $duration['months'] }}" class="font-medium text-gray-700">
                                                        {{ $duration['months'] }} {{ $duration['months'] == 1 ? 'month' : 'months' }}
                                                    </label>
                                                    <p class="text-gray-500">${{ $duration['price'] }} ({{ $duration['months'] == 12 ? 'Best value' : '' }})</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="px-5 py-3 bg-gray-50">
                                <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wide">Features</h4>
                                <ul class="mt-3 space-y-2">
                                    @foreach($plan['features'] as $feature)
                                        <li class="flex items-start">
                                            <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="ml-2 text-sm text-gray-700">{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="px-5 py-4 bg-gray-50 border-t border-gray-200 text-center">
                                @if($activeSubscription && $activeSubscription->type == $plan['name'])
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Current Plan
                                    </span>
                                @else
                                    <button type="button" class="select-plan-btn inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" data-plan="{{ $plan['name'] }}">
                                        {{ $activeSubscription ? 'Switch Plan' : 'Select Plan' }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Subscription Purchase Form -->
        <div id="purchase-form" class="bg-white shadow sm:rounded-lg mb-8 hidden">
            <div class="px-4 py-5 sm:px-6 bg-gray-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Complete Your Subscription</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Review and confirm your selection</p>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('member.subscription.purchase') }}" method="POST">
                    @csrf
                    <input type="hidden" name="plan" id="selected-plan" value="">
                    <input type="hidden" name="duration" id="selected-duration" value="">
                    
                    <div class="mb-6">
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-md">
                            <dt class="text-sm font-medium text-gray-500">Selected Plan</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-900 sm:mt-0 sm:col-span-2" id="summary-plan"></dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-md">
                            <dt class="text-sm font-medium text-gray-500">Duration</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-900 sm:mt-0 sm:col-span-2" id="summary-duration"></dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 rounded-md">
                            <dt class="text-sm font-medium text-gray-500">Price</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-900 sm:mt-0 sm:col-span-2" id="summary-price"></dd>
                        </div>
                    </div>
                    
                    <!-- Add payment method selection -->
                    <div class="mb-6">
                        <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                        <select id="payment_method" name="payment_method" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="credit_card">Credit Card</option>
                            <option value="debit_card">Debit Card</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="cash">Cash at Reception</option>
                        </select>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" id="cancel-purchase" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </button>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Complete Purchase
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Contact Support -->
        <div class="bg-white shadow sm:rounded-lg mb-8">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Need Help With Your Subscription?</h3>
                <div class="mt-2 max-w-xl text-sm text-gray-500">
                    <p>Contact our support team for assistance with your subscription or billing questions.</p>
                </div>
                <div class="mt-5">
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Define plan prices
    const planPrices = {
        'Basic': {
            1: 29,
            3: 79,
            12: 290
        },
        'Premium': {
            1: 59,
            3: 169,
            12: 590
        },
        'Elite': {
            1: 99,
            3: 279,
            12: 990
        }
    };

    // Track selected plan and duration
    let selectedPlan = '';
    let selectedDuration = 0;
    
    // Set up event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Set up radio button listeners
        const radios = document.querySelectorAll('input[type="radio"]');
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                const id = this.id.split('-');
                selectedPlan = id[0];
                selectedDuration = parseInt(id[1]);
                
                // Uncheck other plan's radios
                document.querySelectorAll('input[type="radio"]').forEach(r => {
                    if (!r.id.startsWith(selectedPlan)) {
                        r.checked = false;
                    }
                });
            });
        });
        
        // Select plan buttons
        const planButtons = document.querySelectorAll('.select-plan-btn');
        planButtons.forEach(button => {
            button.addEventListener('click', function() {
                const planName = this.getAttribute('data-plan');
                
                // Find if any duration is selected for this plan
                const selectedRadio = document.querySelector(`input[id^="${planName}-"]:checked`);
                
                if (!selectedRadio) {
                    alert('Please select a duration for this plan.');
                    return;
                }
                
                // Set the values for the form
                selectedPlan = planName;
                selectedDuration = parseInt(selectedRadio.id.split('-')[1]);
                
                document.getElementById('selected-plan').value = selectedPlan;
                document.getElementById('selected-duration').value = selectedDuration;
                
                // Update the summary
                document.getElementById('summary-plan').textContent = selectedPlan;
                document.getElementById('summary-duration').textContent = `${selectedDuration} ${selectedDuration === 1 ? 'month' : 'months'}`;
                document.getElementById('summary-price').textContent = `$${planPrices[selectedPlan][selectedDuration]}`;
                
                // Show the purchase form
                document.getElementById('purchase-form').classList.remove('hidden');
                
                // Scroll to the form
                document.getElementById('purchase-form').scrollIntoView({ behavior: 'smooth' });
            });
        });
        
        // Cancel button
        document.getElementById('cancel-purchase').addEventListener('click', function() {
            document.getElementById('purchase-form').classList.add('hidden');
        });
    });
</script>
@endsection
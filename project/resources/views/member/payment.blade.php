@extends('layouts.main')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Complete Your Subscription</h1>
            <p class="mt-2 text-sm text-gray-600">Review and finalize your subscription purchase</p>
        </div>

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

        <!-- Order Summary -->
        <div class="bg-white shadow sm:rounded-lg mb-8">
            <div class="px-4 py-5 sm:px-6 bg-gray-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Order Summary</h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Selected Plan</dt>
                        <dd class="mt-1 text-lg font-medium text-gray-900">{{ $plan }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Duration</dt>
                        <dd class="mt-1 text-lg font-medium text-gray-900">{{ $duration }} {{ $duration == 1 ? 'month' : 'months' }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Total Price</dt>
                        <dd class="mt-1 text-2xl font-bold text-gray-900">${{ number_format($price, 2) }}</dd>
                    </div>
                </dl>
            </div>
        </div>
        
        <!-- Payment Selection -->
        <div class="bg-white shadow sm:rounded-lg mb-8">
            <div class="px-4 py-5 sm:px-6 bg-gray-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Payment Method</h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                <div class="space-y-4" x-data="{ paymentMethod: 'stripe' }">
                    <!-- Payment Method Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Payment Method</label>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input id="payment-stripe" name="payment_method" type="radio" x-model="paymentMethod" value="stripe" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="payment-stripe" class="ml-3 block text-sm font-medium text-gray-700">
                                    Credit/Debit Card (Online)
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="payment-cash" name="payment_method" type="radio" x-model="paymentMethod" value="cash" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="payment-cash" class="ml-3 block text-sm font-medium text-gray-700">
                                    Cash (Pay at Reception)
                                </label>
                            </div>
                        </div>
                    </div>
                    
<!-- Stripe Payment Option -->
<div x-show="paymentMethod === 'stripe'" class="mt-6">
    <form action="{{ route('member.subscription.stripe-redirect') }}" method="POST">
        @csrf
        <input type="hidden" name="plan" value="{{ $plan }}">
        <input type="hidden" name="duration" value="{{ $duration }}">
        
        <div class="mb-6">
            <div class="flex items-center">
                <input id="terms-stripe" name="terms" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" required>
                <label for="terms-stripe" class="ml-2 block text-sm text-gray-900">
                    I agree to the <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Terms and Conditions</a>
                </label>
            </div>
        </div>
        
        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
            Proceed to Payment
        </button>
    </form>
</div>                    
                    <!-- Cash Payment Option -->
                    <div x-show="paymentMethod === 'cash'" class="mt-6">
                        <form action="{{ route('member.subscription.purchase') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plan" value="{{ $plan }}">
                            <input type="hidden" name="duration" value="{{ $duration }}">
                            <input type="hidden" name="payment_method" value="cash">
                            
                            <div class="bg-yellow-50 p-4 rounded-md mb-6">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">
                                            Cash Payment Instructions
                                        </h3>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            <p>
                                                By selecting this option, your subscription will be reserved for 24 hours. Please visit our reception desk within this time to complete your payment. Bring your ID and the exact amount in cash.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center mb-6">
                                <input id="terms-cash" name="terms" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" required>
                                <label for="terms-cash" class="ml-2 block text-sm text-gray-900">
                                    I agree to the <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Terms and Conditions</a>
                                </label>
                            </div>
                            
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('member.subscription') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Cancel
                                </a>
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Reserve and Pay Later
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<!-- Stripe.js -->
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Stripe with your publishable key
        var stripe = Stripe('{{ $stripeKey }}');
        var checkoutButton = document.getElementById('checkout-button');
        
        if (checkoutButton) {
            checkoutButton.addEventListener('click', function(event) {
                event.preventDefault();
                
                // Check if terms are agreed
                var termsCheckbox = document.getElementById('terms-stripe');
                if (!termsCheckbox.checked) {
                    alert('You must agree to the Terms and Conditions to proceed.');
                    return;
                }
                
                // Disable the button to prevent multiple clicks
                checkoutButton.disabled = true;
                checkoutButton.textContent = 'Processing...';
                
                // Create a checkout session
                let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                // Create a checkout session using a regular form submission approach
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('member.subscription.purchase') }}';

                var planInput = document.createElement('input');
                planInput.type = 'hidden';
                planInput.name = 'plan';
                planInput.value = '{{ $plan }}';
                form.appendChild(planInput);

                var durationInput = document.createElement('input');
                durationInput.type = 'hidden';
                durationInput.name = 'duration';
                durationInput.value = '{{ $duration }}';
                form.appendChild(durationInput);

                var methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = 'payment_method';
                methodInput.value = 'stripe';
                form.appendChild(methodInput);

                var csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                // Append the form to the body and submit it
                document.body.appendChild(form);
                form.submit();
            });
        } else {
            console.error('Checkout button not found');
        }
    });
</script>
@endsection
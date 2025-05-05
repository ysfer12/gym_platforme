@extends('layouts.main')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <div class="flex items-center mb-2">
                <a href="{{ route('member.subscription') }}" class="flex items-center text-indigo-600 hover:text-indigo-800 transition-colors duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Plans
                </a>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mt-3">Complete Your Subscription</h1>
            <p class="mt-2 text-sm text-gray-600">Review your plan selection and choose your payment method</p>
        </div>

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

        <!-- Order Summary -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100 mb-8">
            <div class="px-6 py-5 bg-gradient-to-r from-indigo-600 to-purple-600 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-white">Order Summary</h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                <div class="flex items-center justify-center mb-6">
                    <div class="text-center px-8 py-6 bg-gray-50 rounded-xl border border-gray-100 w-full">
                        <div class="flex flex-col items-center">
                            <div class="rounded-full w-16 h-16 bg-indigo-100 flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                            </div>
                            <div class="mb-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $plan === 'Basic' ? 'bg-blue-100 text-blue-800' : 
                                    ($plan === 'Premium' ? 'bg-purple-100 text-purple-800' : 
                                    'bg-pink-100 text-pink-800') }}">
                                    {{ $plan }} Plan
                                </span>
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $duration }} {{ $duration == 1 ? 'month' : 'months' }}
                                </span>
                            </div>
                            <div class="text-3xl font-bold text-gray-900">${{ number_format($price, 2) }}</div>
                            @if($duration > 1)
                                <div class="text-sm text-gray-500 mt-1">
                                    @if($duration == 3)
                                        Includes 10% discount
                                    @elseif($duration == 12)
                                        Includes 20% discount
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2 border-t border-gray-200 pt-6">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Selected Plan</dt>
                        <dd class="mt-1 text-lg font-medium text-gray-900">{{ $plan }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Duration</dt>
                        <dd class="mt-1 text-lg font-medium text-gray-900">{{ $duration }} {{ $duration == 1 ? 'month' : 'months' }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">What's included</dt>
                        <dd class="mt-1 text-sm text-gray-700">
                            <ul class="space-y-1">
                                @if($plan === 'Basic')
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        4 sessions per month
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Access to gym facilities
                                    </li>
                                @elseif($plan === 'Premium')
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        8 sessions per month
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        All gym facilities and classes
                                    </li>
                                @else
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Unlimited sessions
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        24/7 access to all facilities
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Personal trainer consultations
                                    </li>
                                @endif
                            </ul>
                        </dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Total Price</dt>
                        <dd class="mt-1 text-2xl font-bold text-gray-900">${{ number_format($price, 2) }}</dd>
                    </div>
                </dl>
            </div>
        </div>
        
        <!-- Payment Selection -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100 mb-8">
            <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-gray-100 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Payment Method
                </h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                <div class="space-y-4" x-data="{ paymentMethod: 'stripe' }">
                    <!-- Payment Method Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Choose how you want to pay</label>
                        <div class="space-y-3">
                            <div class="relative bg-white border border-gray-200 rounded-lg shadow-sm p-4 transition-colors hover:border-indigo-300 cursor-pointer" 
                                 :class="{'border-indigo-500 ring-2 ring-indigo-500': paymentMethod === 'stripe'}"
                                 @click="paymentMethod = 'stripe'">
                                <input id="payment-stripe" name="payment_method" type="radio" x-model="paymentMethod" value="stripe" class="absolute h-4 w-4 text-indigo-600 focus:ring-indigo-500 top-1/2 transform -translate-y-1/2 left-4">
                                <div class="pl-7">
                                    <div class="flex items-center justify-between">
                                        <label for="payment-stripe" class="block text-sm font-medium text-gray-900 cursor-pointer">
                                            Credit/Debit Card (Online)
                                        </label>
                                        <div class="flex space-x-2">
                                            <svg class="h-8 w-auto" viewBox="0 0 36 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="36" height="24" rx="4" fill="#1A1F71"/>
                                                <path d="M15.4151 15.8566H13.1313L14.5376 8.14404H16.8214L15.4151 15.8566Z" fill="white"/>
                                                <path d="M23.1934 8.30211C22.65 8.10305 21.8075 7.88428 20.771 7.88428C18.5685 7.88428 17.0128 9.0455 17.0038 10.6908C16.9858 11.9123 18.1052 12.5984 18.9297 13.0246C19.7812 13.4598 20.0551 13.7466 20.0551 14.1377C20.0461 14.7517 19.2937 15.036 18.6012 15.036C17.6458 15.036 17.1384 14.8912 16.3598 14.5684L16.0408 14.4236L15.6947 16.4089C16.3328 16.6728 17.5063 16.9045 18.7239 16.9135C21.0617 16.9135 22.5814 15.7613 22.5994 14.0005C22.608 12.8213 21.8345 11.9063 20.4823 11.2564C19.6938 10.8383 19.2046 10.5696 19.2136 10.1514C19.2136 9.77428 19.6488 9.36623 20.5682 9.36623C21.3397 9.34653 21.9085 9.52589 22.352 9.70525L22.5814 9.82045L22.9184 7.88428L23.1934 8.30211Z" fill="white"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M26.9722 8.14404H25.2385C24.7491 8.14404 24.3759 8.29893 24.1735 8.82581L21.627 15.8566H23.9738L24.3998 14.6226H27.1297L27.3861 15.8566H29.4254L27.9651 8.14404H26.9722ZM25.0091 12.9692C25.0091 12.9692 25.8147 10.7035 25.9595 10.2773C26.2604 10.2773 25.0091 12.9692 25.0091 12.9692ZM11.9701 8.14404L9.79739 13.3744L9.53945 12.0579C9.11171 10.8157 8.00204 9.4992 6.76878 8.86542L8.79837 15.8476H11.1722L14.3532 8.14404H11.9701Z" fill="white"/>
                                                <path d="M7.44352 8.14404H3.67891L3.62964 8.36281C6.50085 9.07059 8.41733 10.5606 9.10542 12.4428L8.28094 9.00726C8.12605 8.31917 7.78325 8.16428 7.44352 8.14404Z" fill="#F9A51A"/>
                                            </svg>
                                            <svg class="h-8 w-auto" viewBox="0 0 36 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="36" height="24" rx="4" fill="#EB001B" fill-opacity="0.15"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.0326 6.41982H22.9673V17.5802H13.0326V6.41982Z" fill="#FF5F00"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6068 12C13.6068 9.65637 14.7189 7.56807 16.4788 6.41971C15.1293 5.37391 13.4478 4.77777 11.6341 4.77777C7.4153 4.77777 4 8.02264 4 12C4 15.9773 7.4153 19.2222 11.6341 19.2222C13.4478 19.2222 15.1293 18.6261 16.4788 17.5803C14.7189 16.4318 13.6068 14.3435 13.6068 12Z" fill="#EB001B"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M31.9998 12C31.9998 15.9773 28.5845 19.2222 24.3657 19.2222C22.552 19.2222 20.8706 18.6261 19.521 17.5803C21.2809 16.4319 22.393 14.3436 22.393 12C22.393 9.65644 21.2809 7.56814 19.521 6.41978C20.8706 5.37397 22.552 4.77783 24.3657 4.77783C28.5845 4.77783 31.9998 8.0227 31.9998 12Z" fill="#F79E1B"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">Secure online payment processed instantly</p>
                                </div>
                            </div>
                            <div class="relative bg-white border border-gray-200 rounded-lg shadow-sm p-4 transition-colors hover:border-indigo-300 cursor-pointer"
                                 :class="{'border-indigo-500 ring-2 ring-indigo-500': paymentMethod === 'cash'}"
                                 @click="paymentMethod = 'cash'">
                                <input id="payment-cash" name="payment_method" type="radio" x-model="paymentMethod" value="cash" class="absolute h-4 w-4 text-indigo-600 focus:ring-indigo-500 top-1/2 transform -translate-y-1/2 left-4">
                                <div class="pl-7">
                                    <label for="payment-cash" class="block text-sm font-medium text-gray-900 cursor-pointer">
                                        Cash (Pay at Reception)
                                    </label>
                                    <p class="text-sm text-gray-500 mt-1">Reserve your subscription and pay in person</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stripe Payment Option -->
                    <div x-show="paymentMethod === 'stripe'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="mt-6 bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <form action="{{ route('member.subscription.stripe-redirect') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plan" value="{{ $plan }}">
                            <input type="hidden" name="duration" value="{{ $duration }}">
                            
                            <div class="mb-6">
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Payment Information</h4>
                                <p class="text-sm text-gray-600 mb-4">Secure payment information will be collected on the next screen.</p>
                                
                                <div class="flex items-center">
                                    <input id="terms-stripe" name="terms" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" required>
                                    <label for="terms-stripe" class="ml-2 block text-sm text-gray-900">
                                        I agree to the <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Terms and Conditions</a>
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="w-full inline-flex justify-center items-center py-3 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                <span class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    Proceed to Secure Payment
                                </span>
                            </button>
                        </form>
                    </div>                    
                    
                    <!-- Cash Payment Option -->
                    <div x-show="paymentMethod === 'cash'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" class="mt-6 bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <form action="{{ route('member.subscription.purchase') }}" method="POST">
                            @csrf
                            <input type="hidden" name="plan" value="{{ $plan }}">
                            <input type="hidden" name="duration" value="{{ $duration }}">
                            <input type="hidden" name="payment_method" value="cash">
                            
                            <div class="bg-yellow-50 p-4 rounded-md mb-6 border border-yellow-100">
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
                            
                            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                                <a href="{{ route('member.subscription') }}" class="inline-flex justify-center py-2.5 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                    Cancel
                                </a>
                                <button type="submit" class="inline-flex justify-center py-2.5 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                                    Reserve and Pay Later
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Payment Security Info -->
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 shadow-sm rounded-lg p-4 border border-gray-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-600">All transactions are secure and encrypted. Your payment information is never stored on our servers.</p>
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
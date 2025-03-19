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
                                {{ $activeSubscription->duration ?? '1' }} {{ ($activeSubscription->duration ?? 1) == 1 ? 'month' : 'months' }}
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
                <!-- Basic Plan -->
                <div class="mb-12">
                    <h4 class="text-xl font-bold mb-4">Basic Plan</h4>
                    <p class="text-gray-500 mb-4">Standard gym access during regular hours</p>
                    
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <ul class="mb-4">
                            <li class="flex items-center mb-2">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Standard gym access</span>
                            </li>
                            <li class="flex items-center mb-2">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Basic locker room access</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Initial fitness assessment</span>
                            </li>
                        </ul>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="mb-2">
                                    <h5 class="font-medium">1 Month</h5>
                                    <div class="text-2xl font-bold text-gray-900">$29</div>
                                </div>
                                <a href="{{ route('member.subscription.payment', ['plan' => 'Basic', 'duration' => 1]) }}" 
                                   class="block text-center bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                                    Select Plan
                                </a>
                            </div>
                            
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="mb-2">
                                    <h5 class="font-medium">3 Months</h5>
                                    <div class="text-2xl font-bold text-gray-900">$79</div>
                                    <div class="text-sm text-green-600">Save $8</div>
                                </div>
                                <a href="{{ route('member.subscription.payment', ['plan' => 'Basic', 'duration' => 3]) }}" 
                                   class="block text-center bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                                    Select Plan
                                </a>
                            </div>
                            
                            <div class="bg-white p-4 rounded-lg shadow-sm border-2 border-indigo-500">
                                <div class="mb-2">
                                    <div class="text-sm font-medium text-indigo-600 mb-1">Best Value</div>
                                    <h5 class="font-medium">12 Months</h5>
                                    <div class="text-2xl font-bold text-gray-900">$290</div>
                                    <div class="text-sm text-green-600">Save $58</div>
                                </div>
                                <a href="{{ route('member.subscription.payment', ['plan' => 'Basic', 'duration' => 12]) }}" 
                                   class="block text-center bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                                    Select Plan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Premium Plan -->
                <div class="mb-12">
                    <h4 class="text-xl font-bold mb-4">Premium Plan</h4>
                    <p class="text-gray-500 mb-4">Extended hours and unlimited classes</p>
                    
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <ul class="mb-4">
                            <li class="flex items-center mb-2">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Extended gym access</span>
                            </li>
                            <li class="flex items-center mb-2">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Premium locker room access</span>
                            </li>
                            <li class="flex items-center mb-2">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Unlimited group classes</span>
                            </li>
                            <li class="flex items-center mb-2">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>2 trainer sessions/month</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Quarterly fitness assessment</span>
                            </li>
                        </ul>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="mb-2">
                                    <h5 class="font-medium">1 Month</h5>
                                    <div class="text-2xl font-bold text-gray-900">$59</div>
                                </div>
                                <a href="{{ route('member.subscription.payment', ['plan' => 'Premium', 'duration' => 1]) }}" 
                                   class="block text-center bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                                    Select Plan
                                </a>
                            </div>
                            
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="mb-2">
                                    <h5 class="font-medium">3 Months</h5>
                                    <div class="text-2xl font-bold text-gray-900">$169</div>
                                    <div class="text-sm text-green-600">Save $8</div>
                                </div>
                                <a href="{{ route('member.subscription.payment', ['plan' => 'Premium', 'duration' => 3]) }}" 
                                   class="block text-center bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                                    Select Plan
                                </a>
                            </div>
                            
                            <div class="bg-white p-4 rounded-lg shadow-sm border-2 border-indigo-500">
                                <div class="mb-2">
                                    <div class="text-sm font-medium text-indigo-600 mb-1">Best Value</div>
                                    <h5 class="font-medium">12 Months</h5>
                                    <div class="text-2xl font-bold text-gray-900">$590</div>
                                    <div class="text-sm text-green-600">Save $118</div>
                                </div>
                                <a href="{{ route('member.subscription.payment', ['plan' => 'Premium', 'duration' => 12]) }}" 
                                   class="block text-center bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                                    Select Plan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Elite Plan -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Elite Plan</h4>
                    <p class="text-gray-500 mb-4">24/7 access and premium features</p>
                    
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <ul class="mb-4">
                            <li class="flex items-center mb-2">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>24/7 gym access</span>
                            </li>
                            <li class="flex items-center mb-2">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Exclusive locker with amenities</span>
                            </li>
                            <li class="flex items-center mb-2">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>All group classes + priority</span>
                            </li>
                            <li class="flex items-center mb-2">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Unlimited trainer sessions</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-5 w-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Nutrition consultation included</span>
                            </li>
                        </ul>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="mb-2">
                                    <h5 class="font-medium">1 Month</h5>
                                    <div class="text-2xl font-bold text-gray-900">$99</div>
                                </div>
                                <a href="{{ route('member.subscription.payment', ['plan' => 'Elite', 'duration' => 1]) }}" 
                                   class="block text-center bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                                    Select Plan
                                </a>
                            </div>
                            
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <div class="mb-2">
                                    <h5 class="font-medium">3 Months</h5>
                                    <div class="text-2xl font-bold text-gray-900">$279</div>
                                    <div class="text-sm text-green-600">Save $18</div>
                                </div>
                                <a href="{{ route('member.subscription.payment', ['plan' => 'Elite', 'duration' => 3]) }}" 
                                   class="block text-center bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                                    Select Plan
                                </a>
                            </div>
                            
                            <div class="bg-white p-4 rounded-lg shadow-sm border-2 border-indigo-500">
                                <div class="mb-2">
                                    <div class="text-sm font-medium text-indigo-600 mb-1">Best Value</div>
                                    <h5 class="font-medium">12 Months</h5>
                                    <div class="text-2xl font-bold text-gray-900">$990</div>
                                    <div class="text-sm text-green-600">Save $198</div>
                                </div>
                                <a href="{{ route('member.subscription.payment', ['plan' => 'Elite', 'duration' => 12]) }}" 
                                   class="block text-center bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                                    Select Plan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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
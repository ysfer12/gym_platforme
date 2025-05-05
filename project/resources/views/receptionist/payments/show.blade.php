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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h1 class="text-2xl font-bold text-gray-900">Payment Details</h1>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('receptionist.payments.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back
                            </a>
                        </div>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <!-- Status Banner with improved styling -->
                    @if($payment->status === 'paid')
                        <div class="rounded-md bg-gradient-to-r from-green-50 to-green-100 p-4 mb-6 shadow-sm border border-green-200">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-green-800">Payment Completed</h3>
                                    <div class="mt-2 text-sm text-green-700">
                                        <p>This payment has been successfully processed and marked as paid.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($payment->status === 'pending')
                        <div class="rounded-md bg-gradient-to-r from-yellow-50 to-yellow-100 p-4 mb-6 shadow-sm border border-yellow-200">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">Payment Pending</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p>This payment is still pending processing or confirmation.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($payment->status === 'refunded')
                        <div class="rounded-md bg-gradient-to-r from-red-50 to-red-100 p-4 mb-6 shadow-sm border border-red-200">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Payment Refunded</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <p>This payment has been refunded to the member.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Quick Actions with improved styling -->
                    <div class="flex flex-col sm:flex-row sm:justify-end space-y-2 sm:space-y-0 sm:space-x-3 mb-6">
                        @if($payment->status === 'pending')
                            <form action="{{ route('receptionist.payments.process', $payment->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="w-full sm:w-auto inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-md text-sm font-medium text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 transition-all duration-200">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Process Payment
                                </button>
                            </form>
                        @endif
                        
                        @if($payment->status === 'paid')
                            <a href="{{ route('receptionist.payments.edit', $payment->id) }}" class="w-full sm:w-auto inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Payment
                            </a>
                            
                            <a href="{{ route('receptionist.payments.receipt', $payment->id) }}" class="w-full sm:w-auto inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 transition-all duration-200">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Generate Receipt
                            </a>
                            
                            <form action="{{ route('receptionist.payments.refund', $payment->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="w-full sm:w-auto inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-md text-sm font-medium text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-400 transition-all duration-200" onclick="return confirm('Are you sure you want to refund this payment?')">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                    </svg>
                                    Refund Payment
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- Payment Details Card with improved styling -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                        <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Payment Information</h3>
                            </div>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Details about the payment and associated subscription.</p>
                        </div>
                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Payment ID</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $payment->id }}</dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Member</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                                                <span class="text-white font-semibold">{{ substr($payment->subscription->user->firstname, 0, 1) }}{{ substr($payment->subscription->user->lastname, 0, 1) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $payment->subscription->user->firstname }} {{ $payment->subscription->user->lastname }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $payment->subscription->user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Subscription</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <div class="flex flex-col">
                                            <div class="flex items-center">
                                                <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $payment->subscription->type == 'Basic' ? 'bg-blue-100 text-blue-800' : 
                                                    ($payment->subscription->type == 'Premium' ? 'bg-purple-100 text-purple-800' : 
                                                    'bg-indigo-100 text-indigo-800') }}">
                                                    {{ $payment->subscription->type }}
                                                </span>
                                                <span class="ml-2 text-sm text-gray-500">{{ $payment->subscription->duration }} month(s)</span>
                                            </div>
                                            <span class="text-gray-500 mt-1">{{ \Carbon\Carbon::parse($payment->subscription->start_date)->format('M d, Y') }} - {{ \Carbon\Carbon::parse($payment->subscription->end_date)->format('M d, Y') }}</span>
                                            <a href="{{ route('receptionist.subscriptions.show', $payment->subscription->id) }}" class="text-blue-600 hover:text-blue-800 mt-2 inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View Subscription
                                            </a>
                                        </div>
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Amount</dt>
                                    <dd class="mt-1 text-sm font-semibold text-gray-900 sm:mt-0 sm:col-span-2">${{ number_format($payment->amount, 2) }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Date</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($payment->date)->format('F j, Y') }}</dd>
                                    </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Payment Method</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <div class="flex items-center">
                                            @if($payment->method == 'cash')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            @elseif(strpos($payment->method, 'card') !== false)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                                </svg>
                                            @elseif($payment->method == 'bank_transfer')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                            @endif
                                            {{ ucfirst(str_replace('_', ' ', $payment->method)) }}
                                        </div>
                                    </dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1 sm:mt-0 sm:col-span-2">
                                        @if($payment->status == 'paid')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="mr-1.5 h-2 w-2 text-green-500" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Paid
                                            </span>
                                        @elseif($payment->status == 'pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <svg class="mr-1.5 h-2 w-2 text-yellow-500" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Pending
                                            </span>
                                        @elseif($payment->status == 'refunded')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <svg class="mr-1.5 h-2 w-2 text-red-500" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Refunded
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <svg class="mr-1.5 h-2 w-2 text-gray-500" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        @endif
                                    </dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Transaction ID</dt>
                                    <dd class="mt-1 text-sm font-mono text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{ $payment->transaction_id ?? 'N/A' }}
                                    </dd>
                                </div>
                                @if($payment->notes)
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Notes</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            <div class="bg-white p-3 rounded-md border border-gray-200">
                                                {{ $payment->notes }}
                                            </div>
                                        </dd>
                                    </div>
                                @endif
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Created At</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $payment->created_at->format('F j, Y, g:i a') }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $payment->updated_at->format('F j, Y, g:i a') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h1 class="text-2xl font-bold text-gray-900">Payment Receipt</h1>
                        </div>
                        <div class="flex space-x-3">
                            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 print:hidden">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                Print Receipt
                            </button>
                            <a href="{{ route('receptionist.payments.email-receipt', $payment) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 print:hidden">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Email Receipt
                            </a>
                            <a href="{{ route('receptionist.payments.show', $payment) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 print:hidden">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back to Payment
                            </a>
                        </div>
                    </div>
                </div>

                <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 print:mt-0 animate-fade-in-up" id="receipt">
                    <div class="bg-white shadow-md overflow-hidden rounded-lg print:shadow-none border border-gray-200">
                        <!-- Receipt Header -->
                        <div class="border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50 px-4 py-5 sm:px-6 print:py-3">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">
                                        TrainTogether
                                    </h2>
                                    <p class="text-sm text-gray-500 mt-2">
                                        753 Allali Fassi<br>
                                        Marrakech, 40 000<br>
                                        Phone: 0613319557<br>
                                        Email: direction@traintogether.ma
                                    </p>
                                </div>
                                <div class="text-right">
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mb-2">
                                        RECEIPT
                                    </div>
                                    <p class="text-sm text-gray-600">
                                        Receipt #: <span class="font-medium">{{ $payment->transaction_id ?? 'Not assigned' }}</span><br>
                                        Date: <span class="font-medium">{{ date('F j, Y', strtotime($payment->date)) }}</span><br>
                                        Payment ID: <span class="font-medium">{{ $payment->id }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Member Information -->
                        <div class="border-b border-gray-200 px-4 py-5 sm:px-6 bg-white">
                            <h3 class="text-base font-semibold text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Member Information
                            </h3>
                            <div class="mt-4 grid grid-cols-1 gap-x-4 gap-y-3 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <p class="text-sm font-medium text-gray-500">Name:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->subscription->user->firstname }} {{ $payment->subscription->user->lastname }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm font-medium text-gray-500">Email:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->subscription->user->email }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm font-medium text-gray-500">Member ID:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->subscription->user->id }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm font-medium text-gray-500">Registration Date:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->subscription->user->registrationDate ? date('F j, Y', strtotime($payment->subscription->user->registrationDate)) : 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="border-b border-gray-200 px-4 py-5 sm:px-6 bg-gray-50">
                            <h3 class="text-base font-semibold text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Payment Details
                            </h3>
                            <div class="mt-4 grid grid-cols-1 gap-x-4 gap-y-3 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <p class="text-sm font-medium text-gray-500">Amount:</p>
                                    <p class="mt-1 text-sm text-gray-900 font-semibold">${{ number_format($payment->amount, 2) }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm font-medium text-gray-500">Payment Method:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ ucfirst(str_replace('_', ' ', $payment->method)) }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm font-medium text-gray-500">Status:</p>
                                    <p class="mt-1">
                                        @if($payment->status == 'paid')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="mr-1 h-2 w-2 text-green-500" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Paid
                                            </span>
                                        @elseif($payment->status == 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <svg class="mr-1 h-2 w-2 text-yellow-500" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Pending
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm font-medium text-gray-500">Transaction ID:</p>
                                    <p class="mt-1 text-sm text-gray-900 font-mono">{{ $payment->transaction_id ?? 'Not assigned' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Subscription Details -->
                        <div class="border-b border-gray-200 px-4 py-5 sm:px-6 bg-white">
                            <h3 class="text-base font-semibold text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                Subscription Details
                            </h3>
                            <div class="mt-4 grid grid-cols-1 gap-x-4 gap-y-3 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <p class="text-sm font-medium text-gray-500">Subscription Type:</p>
                                    <p class="mt-1">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $payment->subscription->type == 'Basic' ? 'bg-blue-100 text-blue-800' : 
                                            ($payment->subscription->type == 'Premium' ? 'bg-purple-100 text-purple-800' : 
                                            'bg-indigo-100 text-indigo-800') }}">
                                            {{ $payment->subscription->type }}
                                        </span>
                                    </p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm font-medium text-gray-500">Duration:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->subscription->duration ?? 'N/A' }} month(s)</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm font-medium text-gray-500">Start Date:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ date('F j, Y', strtotime($payment->subscription->start_date)) }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm font-medium text-gray-500">End Date:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ date('F j, Y', strtotime($payment->subscription->end_date)) }}</p>
                                </div>
                                @if($payment->subscription->max_sessions_count)
                                <div class="sm:col-span-1">
                                    <p class="text-sm font-medium text-gray-500">Max Sessions:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->subscription->max_sessions_count }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm font-medium text-gray-500">Sessions Left:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->subscription->sessions_left ?? 'N/A' }}</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Receipt Footer -->
                        <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-blue-50 to-indigo-50">
                            <div class="text-center">
                                <p class="text-sm text-gray-900 font-medium">Thank you for your business!</p>
                                <div class="mt-2 border-t border-dashed border-gray-200 pt-2">
                                    <p class="text-xs text-gray-500">
                                        This receipt was generated on {{ now()->format('F j, Y \a\t g:i A') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Print Styling -->
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        
        #receipt, #receipt * {
            visibility: visible;
        }
        
        #receipt {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 1rem;
        }
        
        .print\:hidden {
            display: none !important;
        }
        
        .print\:shadow-none {
            box-shadow: none !important;
        }
        
        .print\:mt-0 {
            margin-top: 0 !important;
        }
        
        .print\:py-3 {
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
        }
    }
    
    /* Animation */
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
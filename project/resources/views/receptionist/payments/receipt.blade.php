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
                        <h1 class="text-2xl font-semibold text-gray-900">Payment Receipt</h1>
                        <div class="flex space-x-3">
                            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 print:hidden">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                Print Receipt
                            </button>
                            <a href="{{ route('receptionist.payments.email-receipt', $payment) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 print:hidden">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Email Receipt
                            </a>
                            <a href="{{ route('receptionist.payments.show', $payment) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 print:hidden">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back to Payment
                            </a>
                        </div>
                    </div>
                </div>

                <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 print:mt-0" id="receipt">
                    <div class="bg-white shadow overflow-hidden rounded-lg print:shadow-none">
                        <!-- Receipt Header -->
                        <div class="border-b border-gray-200 bg-gray-50 px-4 py-5 sm:px-6 print:py-3">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900">
                                        {{ config('app.name', 'Gym Platform') }}
                                    </h2>
                                    <p class="text-sm text-gray-500">
                                        123 Fitness Street<br>
                                        Workout City, ST 12345<br>
                                        Phone: (555) 123-4567<br>
                                        Email: info@gymplatform.com
                                    </p>
                                </div>
                                <div class="text-right">
                                    <h3 class="text-lg font-bold text-gray-900">RECEIPT</h3>
                                    <p class="text-sm text-gray-600">
                                        Receipt #: {{ $payment->transaction_id ?? 'Not assigned' }}<br>
                                        Date: {{ date('F j, Y', strtotime($payment->date)) }}<br>
                                        Payment ID: {{ $payment->id }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Member Information -->
                        <div class="border-b border-gray-200 px-4 py-5 sm:px-6 bg-white">
                            <h3 class="text-base font-semibold text-gray-900">Member Information</h3>
                            <div class="mt-2 grid grid-cols-1 gap-x-4 gap-y-2 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <p class="text-sm text-gray-500">Name:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->subscription->user->firstname }} {{ $payment->subscription->user->lastname }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm text-gray-500">Email:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->subscription->user->email }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm text-gray-500">Member ID:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->subscription->user->id }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm text-gray-500">Registration Date:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->subscription->user->registrationDate ? date('F j, Y', strtotime($payment->subscription->user->registrationDate)) : 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="border-b border-gray-200 px-4 py-5 sm:px-6 bg-gray-50">
                            <h3 class="text-base font-semibold text-gray-900">Payment Details</h3>
                            <div class="mt-2 grid grid-cols-1 gap-x-4 gap-y-2 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <p class="text-sm text-gray-500">Amount:</p>
                                    <p class="mt-1 text-sm text-gray-900">${{ number_format($payment->amount, 2) }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm text-gray-500">Payment Method:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ ucfirst($payment->method) }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm text-gray-500">Status:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ ucfirst($payment->status) }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm text-gray-500">Transaction ID:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->transaction_id ?? 'Not assigned' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Subscription Details -->
                        <div class="border-b border-gray-200 px-4 py-5 sm:px-6 bg-white">
                            <h3 class="text-base font-semibold text-gray-900">Subscription Details</h3>
                            <div class="mt-2 grid grid-cols-1 gap-x-4 gap-y-2 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <p class="text-sm text-gray-500">Subscription Type:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->subscription->type }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm text-gray-500">Duration:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->subscription->duration ?? 'N/A' }} month(s)</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm text-gray-500">Start Date:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ date('F j, Y', strtotime($payment->subscription->start_date)) }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm text-gray-500">End Date:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ date('F j, Y', strtotime($payment->subscription->end_date)) }}</p>
                                </div>
                                @if($payment->subscription->max_sessions_count)
                                <div class="sm:col-span-1">
                                    <p class="text-sm text-gray-500">Max Sessions:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->subscription->max_sessions_count }}</p>
                                </div>
                                <div class="sm:col-span-1">
                                    <p class="text-sm text-gray-500">Sessions Left:</p>
                                    <p class="mt-1 text-sm text-gray-900">{{ $payment->subscription->sessions_left ?? 'N/A' }}</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Receipt Footer -->
                        <div class="px-4 py-5 sm:px-6 bg-gray-50">
                            <div class="text-center">
                                <p class="text-sm text-gray-500">Thank you for your business!</p>
                                <p class="text-xs text-gray-400 mt-2">
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
</style>
@endsection
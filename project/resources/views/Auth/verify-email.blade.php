@extends('layouts.main')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-indigo-600 to-blue-500 p-6 text-center">
            <h2 class="text-2xl font-extrabold text-white">Verify Your Email</h2>
            <p class="mt-2 text-sm text-indigo-100">One last step to complete your registration</p>
        </div>

        <div class="p-8 text-center">
            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 rounded-lg bg-green-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ __('A new verification link has been sent to your email address.') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex flex-col items-center">
                <div class="w-24 h-24 bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                
                <h3 class="text-xl font-semibold text-gray-800">Check your inbox</h3>
                
                <div class="mt-4 text-gray-600 max-w-sm">
                    <p class="mb-4">
                        We've sent a verification link to your email address. Please click the link to verify your account.
                    </p>
                    <p class="text-sm text-gray-500">
                        If you didn't receive the email, check your spam folder or click the button below to request a new link.
                    </p>
                </div>
            </div>
            
            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" 
                        class="inline-flex items-center justify-center px-5 py-2 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-indigo-600 to-blue-500 hover:from-indigo-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform transition-all duration-150 hover:scale-[1.02] active:scale-[0.98] shadow-md hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Resend Verification Email
                    </button>
                </form>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                        class="inline-flex items-center justify-center px-5 py-2 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
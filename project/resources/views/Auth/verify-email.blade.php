@extends('layouts.main')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-50 to-amber-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full flex overflow-hidden rounded-3xl shadow-2xl">
        <!-- Left Side - Image and Content -->
        <div class="hidden md:block md:w-1/2 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-500/90 to-orange-700/90 z-10"></div>
            <img src="https://images.unsplash.com/photo-1549476464-37392f717541?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" 
                 alt="Fitness Training" 
                 class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <div class="text-center px-8 max-w-md">
                    <div class="mb-6">
                        <span class="inline-block w-20 h-2 bg-white rounded-full"></span>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-4">You're Almost There!</h3>
                    <p class="text-white/90 mb-8">
                        Verify your email to unlock all the features of TrainTogether and start your fitness journey with us.
                    </p>
                    
                    <div class="space-y-6 mb-8">
                        <div class="bg-white/10 p-6 rounded-xl">
                            <div class="flex items-start mb-4">
                                <div class="flex-shrink-0 w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-white font-medium">Track workouts and progress</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start mb-4">
                                <div class="flex-shrink-0 w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-white font-medium">Book classes and personal training</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-white font-medium">Get personalized workout plans</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-white/20"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="px-3 bg-orange-600/50 text-white text-sm">Members Get Results</span>
                        </div>
                    </div>
                    
                    <div class="mt-8 flex space-x-8 justify-center">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">87%</div>
                            <div class="text-white/80 text-sm">Goal Achievement</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">15k+</div>
                            <div class="text-white/80 text-sm">Active Members</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Verify Email Content -->
        <div class="w-full md:w-1/2 bg-white p-10 md:p-12">
            <div class="max-w-md mx-auto">
                <div class="text-center mb-8">
                    <div class="w-24 h-24 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Verify Your Email</h2>
                    <p class="text-gray-600">One last step to complete your registration</p>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-8 rounded-lg bg-green-50 p-4">
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

                <div class="bg-orange-50 rounded-lg p-6 mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Check your inbox</h3>
                    
                    <div class="text-gray-600">
                        <p class="mb-4">
                            We've sent a verification link to your email address. Please click the link to verify your account and unlock all TrainTogether features.
                        </p>
                        <p class="text-sm text-gray-500 mb-4">
                            If you didn't receive the email, check your spam folder or click the button below to request a new link.
                        </p>
                        
                        <div class="space-y-3 mt-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-600">
                                        <strong>Still can't find it?</strong> Make sure to check your spam, promotions, or junk folders.
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-gray-600">
                                        <strong>Wrong email?</strong> Log out and sign up again with the correct email address.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Email Illustration -->
                <div class="flex justify-center mb-8">
                    <div class="relative">
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center text-white animate-pulse">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="w-16 h-12 border-2 border-gray-300 rounded-lg flex items-center justify-center bg-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row justify-center gap-4 mb-8">
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" 
                            class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transform transition-all duration-150 hover:scale-[1.02] active:scale-[0.98] shadow-md hover:shadow-lg w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Resend Verification Email
                        </button>
                    </form>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                            class="inline-flex items-center justify-center px-5 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-sm w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
                
                <div class="text-center text-sm text-gray-500">
                    <p>Need help? <a href="{{ route('contact') }}" class="text-orange-600 hover:text-orange-500 font-medium">Contact our support team</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
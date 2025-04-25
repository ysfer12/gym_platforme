@extends('layouts.main')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-50 to-amber-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full flex overflow-hidden rounded-3xl shadow-2xl">
        <!-- Left Side - Image and Content -->
        <div class="hidden md:block md:w-1/2 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-500/90 to-orange-700/90 z-10"></div>
            <img src="https://images.unsplash.com/photo-1599058917212-d750089bc07e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80" 
                 alt="Fitness Training" 
                 class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <div class="text-center px-8 max-w-md">
                    <div class="mb-6">
                        <span class="inline-block w-20 h-2 bg-white rounded-full"></span>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-4">No Worries!</h3>
                    <p class="text-white/90 mb-8">
                        We'll help you reset your password so you can get back to tracking your fitness progress and achieving your goals.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="ml-3 text-white">Enter your email address</span>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="ml-3 text-white">Check your inbox for a reset link</span>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="ml-3 text-white">Create a new password</span>
                        </div>
                    </div>
                    <div class="mt-10">
                        <div class="bg-white/10 p-4 rounded-lg">
                            <p class="text-white text-sm italic">
                                "I forgot my password but the reset process was so easy! I was back to tracking my workouts in no time."
                            </p>
                            <div class="flex items-center mt-4">
                                <div class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center text-white text-xs font-bold">
                                    JD
                                </div>
                                <div class="ml-3">
                                    <p class="text-white text-sm font-medium">Jane Doe</p>
                                    <p class="text-white/70 text-xs">Member since 2022</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Reset Password Form -->
        <div class="w-full md:w-1/2 bg-white p-10 md:p-12">
            <div class="max-w-md mx-auto">
                <div class="text-center mb-6">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Reset Password</h2>
                    <p class="text-gray-600">We'll send you a link to reset your password</p>
                </div>

                @if (session('status'))
                    <div class="mb-6 rounded-lg bg-green-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex flex-col items-center mb-8">
                    <div class="w-24 h-24 bg-orange-100 rounded-full flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    
                    <p class="text-gray-600 text-center max-w-sm mb-4">
                        Forgot your password? No problem. Just enter your email address below and we'll send you a link to reset your password.
                    </p>
                </div>

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                                class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" 
                                placeholder="your.email@example.com">
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-md font-medium rounded-lg text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transform transition-all duration-150 hover:scale-[1.02] active:scale-[0.98] shadow-md hover:shadow-lg">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-orange-300 group-hover:text-orange-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </span>
                            Send Password Reset Link
                        </button>
                    </div>
                </form>

                <!-- Additional Help Section -->
                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Need help?</span>
                        </div>
                    </div>

                    <div class="mt-6 space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="ml-3 text-sm text-gray-600">
                                If you don't receive an email within a few minutes, please check your spam folder or <a href="#" class="text-orange-600 hover:text-orange-500 font-medium">contact our support team</a>.
                            </p>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="ml-3 text-sm text-gray-600">
                                Password reset links are valid for 60 minutes after they are sent.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center text-sm text-orange-600 hover:text-orange-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
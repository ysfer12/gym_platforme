@extends('layouts.main')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-50 to-amber-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full flex overflow-hidden rounded-3xl shadow-2xl">
        <!-- Left Side - Image and Content -->
        <div class="hidden md:block md:w-1/2 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-500/90 to-orange-700/90 z-10"></div>
            <img src="https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                 alt="Fitness Training" 
                 class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <div class="text-center px-8 max-w-md">
                    <div class="mb-6">
                        <span class="inline-block w-20 h-2 bg-white rounded-full"></span>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-4">Reset Your Password</h3>
                    <p class="text-white/90 mb-8">
                        Create a new secure password to protect your TrainTogether account and continue your fitness journey.
                    </p>
                    <div class="mt-8">
                        <div class="bg-white/10 p-4 rounded-lg">
                            <p class="text-white text-sm italic">
                                "TrainTogether's secure password reset helps me feel confident that my personal fitness data stays protected while I focus on achieving my goals."
                            </p>
                            <div class="flex items-center mt-4">
                                <div class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center text-white text-xs font-bold">
                                    MT
                                </div>
                                <div class="ml-3">
                                    <p class="text-white text-sm font-medium">Michael Thompson</p>
                                    <p class="text-white/70 text-xs">Premium Member</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-10 space-y-6">
                        <div class="flex items-center justify-center">
                            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <div class="ml-3 text-left">
                                <p class="text-white font-medium">Strong Password Tips</p>
                                <p class="text-white/70 text-xs">Use mix of letters, numbers & symbols</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Reset Password Form -->
        <div class="w-full md:w-1/2 bg-white p-10 md:p-12">
            <div class="max-w-md mx-auto">
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Create New Password</h2>
                    <p class="text-gray-600">Enter a new password for your account</p>
                </div>

                <p class="text-gray-600 text-center max-w-sm mb-8">
                    You're almost there! Create a new password below to complete the reset process and secure your account.
                </p>

                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" value="{{ $email ?? old('email') }}" required autofocus
                                class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" 
                                placeholder="your.email@example.com">
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" required
                                class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" 
                                placeholder="••••••••">
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500" 
                                placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Password Strength Indicator -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Password Strength</label>
                        <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div id="password-strength" class="h-full bg-gray-400 rounded-full"></div>
                        </div>
                        <p id="password-feedback" class="text-xs text-gray-500">Enter a new password to see strength</p>
                    </div>

                    <div>
                        <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-md font-medium rounded-lg text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transform transition-all duration-150 hover:scale-[1.02] active:scale-[0.98] shadow-md hover:shadow-lg">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-orange-300 group-hover:text-orange-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            Reset Password
                        </button>
                    </div>
                </form>

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

<!-- Password Strength Check Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('password-strength');
        const feedback = document.getElementById('password-feedback');
        
        passwordInput.addEventListener('input', function() {
            const password = passwordInput.value;
            let strength = 0;
            let feedback_text = '';
            
            if (password.length > 6) {
                strength += 25;
            }
            
            if (password.match(/[A-Z]/)) {
                strength += 25;
            }
            
            if (password.match(/[0-9]/)) {
                strength += 25;
            }
            
            if (password.match(/[^A-Za-z0-9]/)) {
                strength += 25;
            }
            
            // Update the strength bar width and color
            strengthBar.style.width = strength + '%';
            
            if (strength < 25) {
                strengthBar.classList.remove('bg-yellow-500', 'bg-green-500');
                strengthBar.classList.add('bg-red-500');
                feedback_text = 'Weak - Use at least 8 characters';
            } else if (strength < 50) {
                strengthBar.classList.remove('bg-red-500', 'bg-green-500');
                strengthBar.classList.add('bg-yellow-500');
                feedback_text = 'Fair - Try adding numbers';
            } else if (strength < 75) {
                strengthBar.classList.remove('bg-red-500', 'bg-green-500');
                strengthBar.classList.add('bg-yellow-500');
                feedback_text = 'Good - Try adding special characters';
            } else {
                strengthBar.classList.remove('bg-red-500', 'bg-yellow-500');
                strengthBar.classList.add('bg-green-500');
                feedback_text = 'Strong password!';
            }
            
            // Update feedback text
            feedback.textContent = password.length > 0 ? feedback_text : 'Enter a new password to see strength';
        });
    });
</script>
@endsection
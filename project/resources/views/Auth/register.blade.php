@extends('layouts.main')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-50 to-amber-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl w-full flex overflow-hidden rounded-3xl shadow-2xl">
        <!-- Left Side - Image and Content -->
        <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-orange-500/90 to-orange-700/90 z-10"></div>
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                 alt="Fitness Training" 
                 class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <div class="text-center px-8 max-w-lg">
                    <div class="mb-6">
                        <span class="inline-block w-20 h-2 bg-white rounded-full"></span>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-4">Join Our Fitness Community</h3>
                    <p class="text-white/90 mb-8">
                        Become a member of TrainTogether and transform your fitness journey with personalized workouts, nutrition guidance, and a supportive community.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="ml-3 text-white">Personalized fitness plans</span>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="ml-3 text-white">Nutrition coaching available</span>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <span class="ml-3 text-white">30-day money back guarantee</span>
                        </div>
                    </div>
                    
                    <div class="mt-10">
                        <div class="flex space-x-4 justify-center">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-white">15k+</div>
                                <div class="text-white/80 text-sm">Happy Members</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-white">10</div>
                                <div class="text-white/80 text-sm">Locations</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-white">50+</div>
                                <div class="text-white/80 text-sm">Expert Trainers</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side - Registration Form -->
        <div class="w-full lg:w-1/2 bg-white p-10 md:p-12">
            <div class="max-w-md mx-auto">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-1">Create Your Account</h2>
                    <p class="text-gray-600">Join TrainTogether and start your fitness journey today</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="firstname" class="block text-sm font-medium text-gray-700">First Name</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input id="firstname" name="firstname" type="text" value="{{ old('firstname') }}" required autofocus 
                                    class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 @error('firstname') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" 
                                    placeholder="John">
                            </div>
                            @error('firstname')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="lastname" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input id="lastname" name="lastname" type="text" value="{{ old('lastname') }}" required
                                    class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 @error('lastname') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" 
                                    placeholder="Doe">
                            </div>
                            @error('lastname')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" 
                                placeholder="your.email@example.com">
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input id="address" name="address" type="text" value="{{ old('address') }}" required
                                class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-orange-500 focus:border-orange-500 @error('address') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" 
                                placeholder="123 Fitness Street">
                        </div>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
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
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
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

                    <!-- Membership Preference -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Membership</label>
                        <div class="grid grid-cols-3 gap-3">
                            <div>
                                <input type="radio" id="membership_basic" name="membership_preference" value="basic" class="hidden peer" checked>
                                <label for="membership_basic" class="flex flex-col items-center justify-between p-4 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-orange-500 peer-checked:text-orange-500 hover:bg-gray-50">                           
                                    <div class="w-full text-center">
                                        <div class="text-lg font-semibold">Basic</div>
                                        <div class="text-sm">$29/month</div>
                                        <div class="mt-1 text-xs">Standard access</div>
                                    </div>
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="membership_premium" name="membership_preference" value="premium" class="hidden peer">
                                <label for="membership_premium" class="flex flex-col items-center justify-between p-4 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-orange-500 peer-checked:text-orange-500 hover:bg-gray-50">                           
                                    <div class="w-full text-center">
                                        <div class="text-lg font-semibold">Premium</div>
                                        <div class="text-sm">$59/month</div>
                                        <div class="mt-1 text-xs">Classes included</div>
                                    </div>
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="membership_elite" name="membership_preference" value="elite" class="hidden peer">
                                <label for="membership_elite" class="flex flex-col items-center justify-between p-4 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-orange-500 peer-checked:text-orange-500 hover:bg-gray-50">                           
                                    <div class="w-full text-center">
                                        <div class="text-lg font-semibold">Elite</div>
                                        <div class="text-sm">$99/month</div>
                                        <div class="mt-1 text-xs">Personal training</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required 
                                  class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-gray-700">
                                I agree to the <a href="#" class="text-orange-600 hover:text-orange-500">Terms and Conditions</a> and <a href="#" class="text-orange-600 hover:text-orange-500">Privacy Policy</a>
                            </label>
                        </div>
                    </div>

                    <div>
                        <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-md font-medium rounded-lg text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transform transition-all duration-150 hover:scale-[1.02] active:scale-[0.98] shadow-md hover:shadow-lg">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-orange-300 group-hover:text-orange-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-medium text-orange-600 hover:text-orange-500 transition-colors">
                            Sign in
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
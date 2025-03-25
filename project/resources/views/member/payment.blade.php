@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            @include('partials.member-sidebar')

            <!-- Main Content Area -->
            <div class="flex-1 overflow-auto">
                <div class="bg-white shadow-sm border-b border-gray-200">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
                        <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            Complete Your Subscription
                        </h1>
                        <nav class="flex items-center space-x-2">
                            <a href="{{ route('member.subscription') }}" class="text-sm text-indigo-600 hover:text-indigo-800 transition-colors">
                                Back to Subscriptions
                            </a>
                        </nav>
                    </div>
                </div>

                <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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

                    <!-- Order Summary -->
                    <div class="bg-white shadow sm:rounded-lg mb-8">
                        <div class="px-4 py-5 sm:px-6 bg-gray-50">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Order Summary</h3>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Selected Plan</dt>
                                    <dd class="mt-1 text-lg font-medium text-gray-900">{{ $plan }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Duration</dt>
                                    <dd class="mt-1 text-lg font-medium text-gray-900">{{ $duration }} {{ $duration == 1 ? 'month' : 'months' }}</dd>
                                </div>
                                <div class="sm:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500">Total Price</dt>
                                    <dd class="mt-1 text-2xl font-bold text-gray-900">${{ number_format($price, 2) }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Payment Method Selection -->
                    <div class="bg-white shadow sm:rounded-lg mb-8">
                        <div class="px-4 py-5 sm:px-6 bg-gray-50">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Payment Method</h3>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                            <!-- Rest of the payment method selection content -->
                            <!-- Existing content from the previous payment.blade.php -->
                            <div class="space-y-4" x-data="{ paymentMethod: 'stripe' }">
                                <!-- Payment method radio buttons and forms -->
                                <!-- This section remains mostly the same as your previous implementation -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
        <!-- Keep existing scripts from the previous implementation -->
        <script>
            // Mobile menu functionality
            document.addEventListener('DOMContentLoaded', function() {
                const openSidebarButton = document.getElementById('open-sidebar');
                const mobileMenu = document.getElementById('mobile-menu');
                const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
                const closeMenuButtons = document.querySelectorAll('#close-mobile-menu, #close-mobile-menu-x');

                function toggleMobileMenu(open) {
                    if (open) {
                        mobileMenu.classList.remove('hidden', '-translate-x-full');
                        mobileMenuOverlay.classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    } else {
                        mobileMenu.classList.add('-translate-x-full');
                        setTimeout(() => {
                            mobileMenu.classList.add('hidden');
                            mobileMenuOverlay.classList.add('hidden');
                            document.body.classList.remove('overflow-hidden');
                        }, 300);
                    }
                }

                if (openSidebarButton) {
                    openSidebarButton.addEventListener('click', () => toggleMobileMenu(true));
                }

                closeMenuButtons.forEach(button => {
                    button.addEventListener('click', () => toggleMobileMenu(false));
                });

                // Optional: Close mobile menu when clicking outside
                const mobileMenuOverlayElement = document.getElementById('mobile-menu-overlay');
                if (mobileMenuOverlayElement) {
                    mobileMenuOverlayElement.addEventListener('click', () => toggleMobileMenu(false));
                }
            });
        </script>
    @endsection

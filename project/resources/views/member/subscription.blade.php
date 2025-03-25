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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                            My Subscription
                        </h1>
                        <nav class="flex items-center space-x-2">
                            <a href="{{ route('member.sessions.book') }}" class="text-sm text-indigo-600 hover:text-indigo-800 transition-colors">
                                Book a Session
                            </a>
                        </nav>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
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
                    <div class="bg-white shadow-md rounded-lg mb-8 overflow-hidden">
                        <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Subscription Status</h3>
                        </div>
                        <div>
                            @if($activeSubscription)
                                <div class="p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Current Plan</dt>
                                            <dd class="mt-1 text-2xl font-bold text-gray-900 flex items-center">
                                                {{ $activeSubscription->type }}
                                                <span class="ml-2 px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Active
                                            </span>
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Expires</dt>
                                            <dd class="mt-1 text-lg text-gray-900">
                                                {{ \Carbon\Carbon::parse($activeSubscription->end_date)->format('M d, Y') }}
                                                <span class="text-sm text-gray-500 ml-2">
                                                ({{ \Carbon\Carbon::parse($activeSubscription->end_date)->diffForHumans() }})
                                            </span>
                                            </dd>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Total Sessions</dt>
                                            <dd class="mt-1 text-lg text-gray-900">
                                                {{ $activeSubscription->max_sessions_count ?? 'Unlimited' }}
                                            </dd>
                                        </div>
                                    </div>
                                    <div class="mt-6 border-t border-gray-200 pt-6 flex justify-between items-center">
                                        <div>
                                            <p class="text-sm text-gray-500">Paid: ${{ number_format($activeSubscription->price, 2) }}</p>
                                        </div>
                                        <a href="#subscription-plans" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Renew Subscription
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="p-6 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Active Subscription</h3>
                                    <p class="text-gray-500 mb-6">Choose a plan to get started with your fitness journey.</p>
                                    <a href="#subscription-plans" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        View Plans
                                    </a>
                                </div>
                            @endif
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

                    <!-- Subscription Plans Section -->
                    <div id="subscription-plans" class="bg-white shadow-md rounded-lg">
                        <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Available Subscription Plans</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Choose the plan that fits your fitness goals</p>
                        </div>

                        <div class="p-6">
                            <!-- Subscription Plan Cards -->
                            <!-- This would be similar to the existing subscription plan cards in the previous implementation -->
                            <!-- You can keep the existing plan cards from the previous implementation -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
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

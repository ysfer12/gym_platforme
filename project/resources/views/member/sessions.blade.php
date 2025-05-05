@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            @include('partials.member-sidebar')

            <!-- Main Content Area -->
            <div class="flex-1 overflow-auto">
                <!-- Header -->
                <div class="bg-white shadow-md border-b border-gray-200">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex justify-between items-center">
                        <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="relative">
                                Fitness Sessions
                                <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-orange-500 to-red-500 rounded-full transform translate-y-1"></span>
                            </span>
                        </h1>
                        <div class="flex items-center space-x-3">
                            @if(auth()->user()->activeSubscription)
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200 shadow-sm">
                                    <span class="w-2 h-2 mr-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                    {{ auth()->user()->activeSubscription->type }} Plan Active
                                </span>
                            @else
                                <a href="{{ route('member.subscription') }}" class="inline-flex items-center px-4 py-1.5 text-sm font-medium rounded-full text-white bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 shadow-md hover:shadow-lg transition-all duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Activate Subscription
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <!-- Session Filters -->
                    <div class="bg-white shadow-lg rounded-lg mb-8 border border-gray-100 overflow-hidden">
                        <div class="px-4 py-5 sm:p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                Filter Sessions
                            </h2>
                            <form action="{{ route('member.sessions') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-5">
                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Session Type</label>
                                    <div class="relative">
                                        <select id="type" name="type" class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200">
                                            <option value="">All Types</option>
                                            <option value="Cardio" {{ request('type') == 'Cardio' ? 'selected' : '' }}>Cardio</option>
                                            <option value="Strength" {{ request('type') == 'Strength' ? 'selected' : '' }}>Strength</option>
                                            <option value="Yoga" {{ request('type') == 'Yoga' ? 'selected' : '' }}>Yoga</option>
                                            <option value="HIIT" {{ request('type') == 'HIIT' ? 'selected' : '' }}>HIIT</option>
                                            <option value="Cycling" {{ request('type') == 'Cycling' ? 'selected' : '' }}>Cycling</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="level" class="block text-sm font-medium text-gray-700 mb-2">Difficulty Level</label>
                                    <div class="relative">
                                        <select id="level" name="level" class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200">
                                            <option value="">All Levels</option>
                                            <option value="Beginner" {{ request('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                            <option value="Intermediate" {{ request('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                            <option value="Advanced" {{ request('level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                                    <input type="date" id="date" name="date" value="{{ request('date') }}"
                                           min="{{ date('Y-m-d') }}"
                                           class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200">
                                </div>
                                <div class="flex items-end space-x-2">
                                    <button type="submit" class="inline-flex justify-center items-center py-2.5 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                        </svg>
                                        Apply Filters
                                    </button>
                                    <a href="{{ route('member.sessions') }}" class="inline-flex justify-center items-center py-2.5 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Sessions List -->
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-100">
                        @if (session('success'))
                            <div class="bg-green-50 border-l-4 border-green-400 p-4 mx-4 mt-4">
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
                            <div class="bg-red-50 border-l-4 border-red-400 p-4 mx-4 mt-4">
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

                        <div class="px-4 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200 sm:px-6 flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                                Available Sessions
                            </h3>
                            <div class="text-sm text-gray-600 font-medium">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-orange-100 text-orange-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                    </svg>
                                    {{ $upcomingSessions->total() }} session(s) found
                                </span>
                            </div>
                        </div>

                        @if($upcomingSessions->count() > 0)
                            <ul class="divide-y divide-gray-200">
                                @foreach ($upcomingSessions as $session)
                                    <li class="hover:bg-gray-50 transition-all duration-150 transform hover:scale-[0.995]">
                                        <div class="px-4 py-5 sm:px-6">
                                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4">
                                                <div>
                                                    <h3 class="text-lg font-semibold text-orange-600 flex items-center">
                                                        {{ $session->title }}
                                                        @if($session->attendances()->count() > $session->max_capacity * 0.8)
                                                            <span class="ml-2 px-2 py-0.5 text-xs font-bold bg-red-100 text-red-800 rounded-full">
                                                                Filling fast!
                                                            </span>
                                                        @endif
                                                    </h3>
                                                    <div class="mt-2 flex items-center flex-wrap gap-1.5">
                                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $session->type == 'Cardio' ? 'bg-pink-100 text-pink-800 border border-pink-200' : ($session->type == 'Strength' ? 'bg-blue-100 text-blue-800 border border-blue-200' : ($session->type == 'Yoga' ? 'bg-green-100 text-green-800 border border-green-200' : ($session->type == 'HIIT' ? 'bg-red-100 text-red-800 border border-red-200' : 'bg-purple-100 text-purple-800 border border-purple-200'))) }}">
                                                            {{ $session->type }}
                                                        </span>
                                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                                            {{ $session->level }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="mt-3 sm:mt-0">
                                                    @if (in_array($session->id, $bookedSessionIds))
                                                        <span class="inline-flex items-center px-3.5 py-2 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200 shadow-sm">
                                                            <svg class="mr-1.5 h-4 w-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                            </svg>
                                                            Booked
                                                        </span>
                                                    @else
                                                        <form action="{{ route('member.sessions-post', $session) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="group inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-md text-white bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-4 w-4 transform group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                                </svg>
                                                                Book Now
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3 bg-gray-50 p-4 rounded-lg">
                                                <div class="sm:col-span-1">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                        </div>
                                                        <div class="ml-3">
                                                            <dt class="text-sm font-medium text-gray-500">Date & Time</dt>
                                                            <dd class="mt-1 text-sm font-semibold text-gray-900">
                                                                {{ \Carbon\Carbon::parse($session->date)->format('M d, Y') }}
                                                                <div class="font-normal text-gray-600">
                                                                    {{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }} - 
                                                                    {{ \Carbon\Carbon::parse($session->end_time)->format('g:i A') }}
                                                                </div>
                                                            </dd>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="sm:col-span-1">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                            </svg>
                                                        </div>
                                                        <div class="ml-3">
                                                            <dt class="text-sm font-medium text-gray-500">Trainer</dt>
                                                            <dd class="mt-1 text-sm font-semibold text-gray-900">{{ $session->trainer->firstname }} {{ $session->trainer->lastname }}</dd>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="sm:col-span-1">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10 bg-green-100 text-green-600 rounded-lg flex items-center justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                            </svg>
                                                        </div>
                                                        <div class="ml-3">
                                                            <dt class="text-sm font-medium text-gray-500">Availability</dt>
                                                            <dd class="mt-1 text-sm font-semibold text-gray-900 flex items-center">
                                                                {{ $session->attendances()->count() }} / {{ $session->max_capacity }} spots
                                                                <div class="ml-2 w-20 bg-gray-200 rounded-full h-2.5 overflow-hidden">
                                                                    <div class="bg-gradient-to-r from-green-500 to-orange-500 h-2.5 rounded-full" style="width: {{ min(100, ($session->attendances()->count() / $session->max_capacity) * 100) }}%"></div>
                                                                </div>
                                                            </dd>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($session->description)
                                                <div class="mt-4 bg-gray-50 p-4 rounded-lg border border-gray-100">
                                                    <div class="flex">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 h-5 w-5 text-gray-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        <div>
                                                            <dt class="text-sm font-medium text-gray-600">Description</dt>
                                                            <dd class="mt-1 text-sm text-gray-700">{{ $session->description }}</dd>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="px-4 py-12 sm:px-6 text-center">
                                <div class="mx-auto h-32 w-32 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-medium text-gray-900">No sessions available</h3>
                                <p class="mt-2 text-sm text-gray-500 max-w-md mx-auto">There are no sessions matching your criteria. Please check back later or adjust your filters.</p>
                                <div class="mt-6">
                                    <a href="{{ route('member.sessions') }}" class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-full text-white bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Reset Filters
                                    </a>
                                </div>
                            </div>
                        @endif

                        <div class="bg-white px-4 py-4 border-t border-gray-200 sm:px-6">
                            {{ $upcomingSessions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile floating action button -->
    <div class="md:hidden fixed z-20 bottom-6 right-6">
        <a href="{{ route('member.subscription') }}" class="flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-lg hover:from-orange-600 hover:to-red-600 transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
        </a>
    </div>

    @include('partials.mobile-menu')
@endsection
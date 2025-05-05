@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar - Include the separate file -->
        @include('partials.member-sidebar')

        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <!-- Welcome Banner with Subscription Info -->
            <div class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white relative overflow-hidden">
                <!-- Decorative Elements -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 left-1/4 w-64 h-64 bg-orange-500 rounded-full filter blur-3xl"></div>
                    <div class="absolute bottom-0 right-1/3 w-80 h-80 bg-red-500 rounded-full filter blur-3xl"></div>
                </div>
                
                <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex-1 min-w-0">
                            <h2 class="text-3xl font-bold leading-tight sm:text-4xl sm:truncate bg-clip-text text-transparent bg-gradient-to-r from-white via-orange-100 to-white">
                                Welcome back, {{ Auth::user()->firstname }}!
                            </h2>
                            @if($activeSubscription)
                                <div class="mt-3 flex items-center text-sm text-gray-300">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 mr-2">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        Active
                                    </span>
                                    <p>
                                        <span class="font-semibold text-orange-300">{{ $activeSubscription->type }} Plan</span> 
                                        <span class="mx-2">•</span>
                                        Valid until {{ \Carbon\Carbon::parse($activeSubscription->end_date)->format('M d, Y') }}
                                        <span class="ml-1 text-orange-200">({{ \Carbon\Carbon::parse($activeSubscription->end_date)->diffForHumans() }})</span>
                                    </p>
                                </div>
                            @else
                                <div class="mt-3 flex items-center text-sm text-gray-300">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 mr-2">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        Inactive
                                    </span>
                                    <p>You don't have an active subscription. <a href="{{ route('member.subscription') }}" class="font-bold text-orange-400 hover:text-orange-300 underline transition-colors duration-150">Subscribe now</a> to access all features.</p>
                                </div>
                            @endif
                            </div>
                        <div class="mt-4 flex md:mt-0 md:ml-4">
                            <a href="{{ route('member.sessions') }}" class="inline-flex items-center px-5 py-2.5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-gray-900 bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 focus:ring-offset-gray-800 transition-all duration-200 transform hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Book a Session
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Wavy Shape Divider -->
                <div class="absolute -bottom-1 left-0 right-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" class="fill-current text-gray-100">
                        <path d="M0,32L60,53.3C120,75,240,117,360,117.3C480,117,600,75,720,64C840,53,960,75,1080,80C1200,85,1320,75,1380,69.3L1440,64L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
            <!-- Quick Stats -->
            <div class="max-w-7xl mx-auto -mt-10 mb-6 px-4 sm:px-6 lg:px-8 relative z-20">
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                    <!-- Next Session -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-200 transform transition-all duration-200 hover:shadow-xl hover:-translate-y-1">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-gradient-to-br from-orange-500 to-red-500 rounded-md p-3 shadow">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Next Session
                                        </dt>
                                        <dd>
                                            @if($upcomingSessions->count() > 0)
                                                <div class="text-lg font-medium text-gray-900">
                                                    {{ \Carbon\Carbon::parse($upcomingSessions->first()->date)->format('M d') }} - {{ $upcomingSessions->first()->title }}
                                                </div>
                                            @else
                                                <div class="text-lg font-medium text-gray-500">
                                                    No upcoming sessions
                                                </div>
                                            @endif
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3 border-t border-gray-200">
                            <div class="text-sm">
                                <a href="{{ route('member.sessions') }}" class="font-medium text-orange-600 hover:text-orange-500 flex items-center transition-colors duration-150">
                                    View all sessions
                                    <svg class="ml-1 h-5 w-5 transition-transform duration-150 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>  
                    <!-- Monthly Activity -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-200 transform transition-all duration-200 hover:shadow-xl hover:-translate-y-1">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-gradient-to-br from-green-500 to-emerald-500 rounded-md p-3 shadow">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            This Month's Activity
                                        </dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">
                                                {{ $monthlyActivity }} sessions
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3 border-t border-gray-200">
                            <div class="text-sm">
                                <a href="{{ route('member.attendance') }}" class="font-medium text-orange-600 hover:text-orange-500 flex items-center transition-colors duration-150">
                                    View activity history
                                    <svg class="ml-1 h-5 w-5 transition-transform duration-150 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Membership Status -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-200 transform transition-all duration-200 hover:shadow-xl hover:-translate-y-1">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-md p-3 shadow">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Membership Status
                                        </dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900 flex items-center">
                                                @if($activeSubscription)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mr-2">
                                                        Active
                                                    </span>
                                                    {{ $activeSubscription->type }}
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 mr-2">
                                                        Inactive
                                                    </span>
                                                    <span>No active plan</span>
                                                @endif
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3 border-t border-gray-200">
                            <div class="text-sm">
                                <a href="{{ route('member.subscription') }}" class="font-medium text-orange-600 hover:text-orange-500 flex items-center transition-colors duration-150">
                                    Manage subscription
                                    <svg class="ml-1 h-5 w-5 transition-transform duration-150 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Fitness Progress -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-200 transform transition-all duration-200 hover:shadow-xl hover:-translate-y-1">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-gradient-to-br from-orange-500 to-red-500 rounded-md p-3 shadow">
                                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Fitness Progress
                                        </dt>
                                        <dd>
                                            <div class="text-lg font-medium text-gray-900">
                                                <div class="flex items-center">
                                                    <span class="mr-2">{{ min(100, $monthlyActivity * 10) }}%</span>
                                                    <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                                        <div class="bg-gradient-to-r from-orange-500 to-red-500 h-2.5 rounded-full" style="width: {{ min(100, $monthlyActivity * 10) }}%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-5 py-3 border-t border-gray-200">
                            <div class="text-sm">
                                <a href="#" class="font-medium text-orange-600 hover:text-orange-500 flex items-center transition-colors duration-150">
                                    Set fitness goals
                                    <svg class="ml-1 h-5 w-5 transition-transform duration-150 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid with 2 columns for desktop -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Column - Upcoming Sessions & Activity Feed -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Upcoming Sessions Section -->
                        <div class="bg-white shadow-lg overflow-hidden rounded-xl border border-gray-200">
                            <div class="px-4 py-5 sm:px-6 flex justify-between items-center border-b border-gray-200">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Upcoming Sessions
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Your booked classes and appointments</p>
                                </div>
                                <a href="{{ route('member.sessions') }}" class="inline-flex items-center text-sm font-semibold text-orange-600 hover:text-orange-500 transition-colors duration-150 group">
                                    View all
                                    <svg class="ml-1 h-5 w-5 transition-transform duration-150 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                            
                            @if($upcomingSessions->count() > 0)
                                <ul class="divide-y divide-gray-200">
                                    @foreach($upcomingSessions->take(3) as $session)
                                        <li>
                                            <div class="px-4 py-4 sm:px-6 hover:bg-gray-50 transition-colors duration-150">
                                                <div class="flex items-center justify-between">
                                                    <div class="sm:flex items-center">
                                                        <p class="text-sm font-medium text-orange-600 truncate">
                                                            {{ $session->title }}
                                                        </p>
                                                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                            </svg>
                                                            <p>
                                                                {{ \Carbon\Carbon::parse($session->date)->format('M d, Y') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="ml-2 flex-shrink-0 flex">
                                                        <p class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            {{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }} - 
                                                            {{ \Carbon\Carbon::parse($session->end_time)->format('g:i A') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="mt-2 sm:flex sm:justify-between">
                                                    <div class="sm:flex">
                                                        <div class="flex items-center text-sm text-gray-500">
                                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                                            </svg>
                                                            <p>
                                                                {{ $session->trainer->firstname }} {{ $session->trainer->lastname }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $session->type == 'Cardio' ? 'bg-pink-100 text-pink-800' : ($session->type == 'Strength' ? 'bg-blue-100 text-blue-800' : ($session->type == 'Yoga' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800')) }}">
                                                            {{ $session->type }}
                                                        </span>
                                                        <span class="ml-2 px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            {{ $session->level }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="flex items-center justify-center h-48">
                                    <div class="text-center px-4 py-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <h3 class="mt-4 text-sm font-medium text-gray-900">No upcoming sessions</h3>
                                        <p class="mt-2 text-sm text-gray-500">Get started by booking a session with a trainer.</p>
                                        <div class="mt-4">
                                            <a href="{{ route('member.sessions') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200 transform hover:scale-105">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                Book a session
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- Activity Feed -->
                        <div class="bg-white shadow-lg overflow-hidden rounded-xl border border-gray-200">
                            <div class="px-4 py-5 sm:px-6 flex justify-between items-center border-b border-gray-200">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                        </svg>
                                        Recent Activity
                                    </h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Your fitness journey at a glance</p>
                                </div>
                            </div>
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flow-root">
                                    <ul role="list" class="-mb-8">
                                        @forelse($recentAttendances as $index => $attendance)
                                        <li>
                                            <div class="relative pb-8">
                                                @if(!$loop->last)
                                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                                @endif
                                                <div class="relative flex space-x-3">
                                                    <div>
                                                        <span class="h-9 w-9 rounded-full {{ $index % 3 == 0 ? 'bg-gradient-to-br from-orange-500 to-red-500' : ($index % 3 == 1 ? 'bg-gradient-to-br from-green-500 to-emerald-500' : 'bg-gradient-to-br from-purple-500 to-indigo-500') }} flex items-center justify-center ring-8 ring-white">
                                                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                        <div>
                                                            <p class="text-sm text-gray-500">Attended <span class="font-medium text-gray-900">{{ $attendance->session->title }}</span></p>
                                                        </div>
                                                        <div class="text-sm text-right text-gray-500">
                                                            <time datetime="{{ $attendance->date }}">{{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}</time>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @empty
                                        <li>
                                            <div class="text-center py-8">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                                </svg>
                                                <h3 class="mt-4 text-sm font-medium text-gray-900">No activity yet</h3>
                                                <p class="mt-2 text-sm text-gray-500">Your activities will show up here once you attend sessions.</p>
                                            </div>
                                        </li>
                                        @endforelse
                                        <li>
                                            <div class="relative pb-8">
                                                <div class="relative flex space-x-3">
                                                    <div>
                                                        <span class="h-9 w-9 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center ring-8 ring-white">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                        <div>
                                                            <p class="text-sm text-gray-500">Account created</p>
                                                        </div>
                                                        <div class="text-sm text-right text-gray-500">
                                                            <time datetime="{{ Auth::user()->created_at }}">{{ \Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans() }}</time>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Right Column - Popular Classes & Personalized Recommendations -->
                    <div class="lg:col-span-1 space-y-8">
                        <!-- Popular Classes Card -->
                        <div class="bg-white shadow-lg overflow-hidden rounded-xl border border-gray-200">
                            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    Popular Classes
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Most attended sessions</p>
                            </div>
                            <div class="px-4 py-5 sm:p-6">
                                <div class="space-y-3">
                                    @forelse($popularSessions as $session)
                                    <div class="bg-gray-50 rounded-lg p-3 hover:bg-gray-100 transition-colors duration-150 border border-gray-100 shadow-sm">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-orange-500 to-red-500 text-white flex items-center justify-center shadow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-sm font-medium text-gray-900">{{ $session->title }}</h4>
                                                <p class="mt-1 text-xs text-gray-500">
                                                    @if($session->date)
                                                        {{ \Carbon\Carbon::parse($session->date)->format('l') }}, 
                                                        {{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }}
                                                    @else
                                                        Multiple dates and times
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="bg-gray-50 rounded-lg p-3 hover:bg-gray-100 transition-colors duration-150 border border-gray-100 shadow-sm">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-orange-500 to-red-500 text-white flex items-center justify-center shadow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-sm font-medium text-gray-900">Yoga Flow</h4>
                                                <p class="mt-1 text-xs text-gray-500">Tuesdays & Thursdays, 7:00 AM</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-3 hover:bg-gray-100 transition-colors duration-150 border border-gray-100 shadow-sm">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-orange-500 to-red-500 text-white flex items-center justify-center shadow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-sm font-medium text-gray-900">HIIT Training</h4>
                                                <p class="mt-1 text-xs text-gray-500">Mon, Wed, Fri, 6:00 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-3 hover:bg-gray-100 transition-colors duration-150 border border-gray-100 shadow-sm">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-orange-500 to-red-500 text-white flex items-center justify-center shadow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-sm font-medium text-gray-900">Strength & Conditioning</h4>
                                                <p class="mt-1 text-xs text-gray-500">Everyday, 9:00 AM</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforelse
                                </div>
                                <div class="mt-6 text-sm">
                                    <a href="{{ route('member.sessions') }}" class="font-medium text-orange-600 hover:text-orange-500 flex items-center transition-colors duration-150 group">
                                        View all classes
                                        <svg class="ml-1 h-5 w-5 transition-transform duration-150 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Personalized Recommendations -->
                        <div class="bg-white shadow-lg overflow-hidden rounded-xl border border-gray-200">
                            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Recommendations For You
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Based on your preferences</p>
                            </div>
                            <div class="px-4 py-5 sm:p-6">
                                <!-- Session Recommendation -->
                                <div class="mb-6 bg-gradient-to-br from-orange-50 to-red-50 p-4 rounded-lg border border-orange-100 shadow-sm">
                                    <h4 class="font-medium text-orange-800 mb-3 flex items-center text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                        </svg>
                                        Try These Sessions
                                    </h4>
                                    <div class="space-y-3">
                                        <div class="flex items-center p-2 bg-white rounded-lg shadow-sm border border-orange-100">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white shadow">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">HIIT Cardio Blast</p>
                                                <p class="text-xs text-gray-500 mt-0.5">45 min • Intermediate</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center p-2 bg-white rounded-lg shadow-sm border border-orange-100">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gradient-to-br from-orange-500 to-red-500 flex items-center justify-center text-white shadow">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">Core Strength Focus</p>
                                                <p class="text-xs text-gray-500 mt-0.5">30 min • All Levels</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Quick Tips -->
                                <div class="mb-6">
                                    <h4 class="font-medium text-gray-900 mb-3 flex items-center text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Fitness Tip of the Day
                                    </h4>
                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-r-lg shadow-sm">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-yellow-700">
                                                    Don't forget to hydrate before, during, and after workouts. Proper hydration enhances performance and recovery.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Recommended Trainers -->
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-3 flex items-center text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Top Trainers
                                    </h4>
                                    <div class="flex space-x-4 overflow-x-auto pb-2">
                                        <div class="flex-shrink-0 w-20">
                                            <div class="aspect-w-1 aspect-h-1">
                                                <div class="rounded-full bg-gradient-to-br from-orange-100 to-red-100 overflow-hidden h-20 w-20 flex items-center justify-center shadow-sm border border-orange-200">
                                                    <div class="text-xl font-bold text-orange-500">JD</div>
                                                </div>
                                            </div>
                                            <p class="mt-2 text-xs text-center text-gray-500">John D.</p>
                                        </div>
                                        <div class="flex-shrink-0 w-20">
                                            <div class="aspect-w-1 aspect-h-1">
                                                <div class="rounded-full bg-gradient-to-br from-orange-100 to-red-100 overflow-hidden h-20 w-20 flex items-center justify-center shadow-sm border border-orange-200">
                                                    <div class="text-xl font-bold text-orange-500">SJ</div>
                                                </div>
                                            </div>
                                            <p class="mt-2 text-xs text-center text-gray-500">Sarah J.</p>
                                        </div>
                                        <div class="flex-shrink-0 w-20">
                                            <div class="aspect-w-1 aspect-h-1">
                                                <div class="rounded-full bg-gradient-to-br from-orange-100 to-red-100 overflow-hidden h-20 w-20 flex items-center justify-center shadow-sm border border-orange-200">
                                                    <div class="text-xl font-bold text-orange-500">MR</div>
                                                </div>
                                            </div>
                                            <p class="mt-2 text-xs text-center text-gray-500">Mike R.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Quick Actions Card for Mobile -->
                        <div class="lg:hidden bg-white shadow-lg overflow-hidden rounded-xl border border-gray-200">
                            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    Quick Actions
                                </h3>
                            </div>
                            <div class="border-t border-gray-200">
                                <div class="grid grid-cols-2 divide-x divide-y divide-gray-200">
                                    <a href="{{ route('member.sessions') }}" class="text-center p-4 hover:bg-gray-50 transition-colors duration-150 group">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-orange-600 mb-2 transition-transform duration-150 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        <span class="text-sm text-gray-700">Book Session</span>
                                    </a>
                                    <a href="{{ route('member.attendance') }}" class="text-center p-4 hover:bg-gray-50 transition-colors duration-150 group">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-orange-600 mb-2 transition-transform duration-150 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                        </svg>
                                        <span class="text-sm text-gray-700">My Attendance</span>
                                    </a>
                                    <a href="{{ route('member.subscription') }}" class="text-center p-4 hover:bg-gray-50 transition-colors duration-150 group">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-orange-600 mb-2 transition-transform duration-150 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        <span class="text-sm text-gray-700">Subscription</span>
                                    </a>
                                    <a href="{{ route('member.profile') }}" class="text-center p-4 hover:bg-gray-50 transition-colors duration-150 group">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-orange-600 mb-2 transition-transform duration-150 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span class="text-sm text-gray-700">Profile</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="bg-gray-800 mt-auto">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="md:flex md:items-center md:justify-between">
                        <div class="flex justify-center md:order-2 space-x-6">
                            <a href="#" class="text-gray-400 hover:text-gray-300 transition-colors duration-150">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-gray-300 transition-colors duration-150">
                                <span class="sr-only">Instagram</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-gray-300 transition-colors duration-150">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                        </div>
                        <div class="mt-8 md:mt-0 md:order-1">
                            <p class="text-center text-base text-gray-400">
                                &copy; 2025 TrainTogether, Inc. All rights reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Include the mobile menu partial -->
    @include('partials.mobile-menu')
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all the elements we need
    const openSidebarButton = document.getElementById('open-sidebar');
    const closeMobileMenuButton = document.getElementById('close-mobile-menu');
    const closeMobileMenuXButton = document.getElementById('close-mobile-menu-x');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
    
    // Function to open the mobile menu
    const openMobileMenu = function() {
        mobileMenu.classList.remove('hidden');
        mobileMenuOverlay.classList.remove('hidden');
        
        // Use setTimeout to ensure the transition happens after the display change
        setTimeout(function() {
            mobileMenu.classList.remove('-translate-x-full');
            document.body.classList.add('overflow-hidden');
        }, 10);
    };
    
    // Function to close the mobile menu
    const closeMobileMenu = function() {
        mobileMenu.classList.add('-translate-x-full');
        
        // Wait for transition to finish before hiding the elements
        setTimeout(function() {
            mobileMenu.classList.add('hidden');
            mobileMenuOverlay.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 300); // Match this with your CSS transition duration
    };
    
    // Event listeners for opening the mobile menu
    if (openSidebarButton) {
        openSidebarButton.addEventListener('click', openMobileMenu);
    }
    
    // Event listeners for closing the mobile menu
    if (closeMobileMenuButton) {
        closeMobileMenuButton.addEventListener('click', closeMobileMenu);
    }
    
    if (closeMobileMenuXButton) {
        closeMobileMenuXButton.addEventListener('click', closeMobileMenu);
    }
    
    // Close when clicking the overlay
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);
    }
    
    // Close menu when pressing Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
            closeMobileMenu();
        }
    });
    
    // Auto-close menu when navigating to a new page (for SPA behavior)
    const mobileMenuLinks = mobileMenu.querySelectorAll('a');
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Add a small delay before closing to make navigation feel smoother
            setTimeout(closeMobileMenu, 150);
        });
    });
});</script>
@endsection
@endsection
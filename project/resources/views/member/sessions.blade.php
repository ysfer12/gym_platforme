@extends('layouts.main')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Available Sessions</h1>
            <p class="mt-2 text-sm text-gray-600">Browse and book fitness sessions</p>
        </div>

        <!-- Session Filters -->
        <div class="bg-white shadow rounded-lg mb-8">
            <div class="px-4 py-5 sm:p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Filter Sessions</h2>
                <form action="{{ route('member.sessions.book') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                        <select id="type" name="type" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">All Types</option>
                            <option value="Cardio" {{ request('type') == 'Cardio' ? 'selected' : '' }}>Cardio</option>
                            <option value="Strength" {{ request('type') == 'Strength' ? 'selected' : '' }}>Strength</option>
                            <option value="Yoga" {{ request('type') == 'Yoga' ? 'selected' : '' }}>Yoga</option>
                            <option value="HIIT" {{ request('type') == 'HIIT' ? 'selected' : '' }}>HIIT</option>
                            <option value="Cycling" {{ request('type') == 'Cycling' ? 'selected' : '' }}>Cycling</option>
                        </select>
                    </div>
                    <div>
                        <label for="level" class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                        <select id="level" name="level" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">All Levels</option>
                            <option value="Beginner" {{ request('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="Intermediate" {{ request('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="Advanced" {{ request('level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                    </div>
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                        <input type="date" id="date" name="date" value="{{ request('date') }}" min="{{ date('Y-m-d') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Apply Filters
                        </button>
                        <a href="{{ route('member.sessions.book') }}" class="ml-3 inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Clear
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sessions List -->
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4">
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
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
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
            
            <ul class="divide-y divide-gray-200">
                @forelse ($upcomingSessions as $session)
                    <li>
                        <div class="px-4 py-5 sm:px-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-indigo-600">{{ $session->title }}</h3>
                                    <div class="mt-1 flex items-center">
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $session->type == 'Cardio' ? 'bg-pink-100 text-pink-800' : ($session->type == 'Strength' ? 'bg-blue-100 text-blue-800' : ($session->type == 'Yoga' ? 'bg-green-100 text-green-800' : ($session->type == 'HIIT' ? 'bg-red-100 text-red-800' : 'bg-purple-100 text-purple-800'))) }}">
                                            {{ $session->type }}
                                        </span>
                                        <span class="ml-2 px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $session->level }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    @if (in_array($session->id, $bookedSessionIds))
                                        <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-green-100 text-green-800">
                                            <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Booked
                                        </span>
                                    @else
                                        <form action="{{ route('member.sessions.book-post', $session) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Book Now
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-4 grid grid-cols-1 gap-2 sm:grid-cols-3">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Date & Time</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($session->date)->format('M d, Y') }} | 
                                        {{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }} - 
                                        {{ \Carbon\Carbon::parse($session->end_time)->format('g:i A') }}
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Trainer</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $session->trainer->firstname }} {{ $session->trainer->lastname }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Availability</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        {{ $session->attendances()->count() }} / {{ $session->max_capacity }} spots filled
                                    </dd>
                                </div>
                            </div>
                            @if($session->description)
                                <div class="mt-4">
                                    <dt class="text-sm font-medium text-gray-500">Description</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $session->description }}</dd>
                                </div>
                            @endif
                        </div>
                    </li>
                @empty
                    <li class="px-4 py-5 sm:px-6 text-center">
                        <p class="text-gray-500">No sessions available. Please check back later.</p>
                    </li>
                @endforelse
            </ul>
            
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $upcomingSessions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
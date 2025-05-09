<!-- resources/views/trainer/members/index.blade.php -->
@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-900">
    <div class="flex h-screen overflow-hidden">
        <!-- Include the trainer sidebar -->
        @include('partials.trainer-sidebar')
        
        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <!-- Page header -->
            <div class="bg-gray-800 shadow-md border-b border-gray-700">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-2xl font-semibold text-white">Members in Your Sessions</h1>
                </div>
            </div>
            
            <!-- Page content -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <!-- Search and filters -->
                <div class="mb-6 bg-gray-800 p-4 shadow-md rounded-lg border border-gray-700">
                    <form action="{{ route('trainer.members') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-gray-300">Search</label>
                            <input type="text" name="search" id="search" value="{{ request()->search }}" 
                                class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm placeholder-gray-400"
                                placeholder="Search by name or email">
                        </div>
                        <div>
                            <label for="sort" class="block text-sm font-medium text-gray-300">Sort By</label>
                            <select name="sort" id="sort" 
                                class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm py-2 px-3 text-white focus:outline-none focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                                <option value="sessions" {{ request()->sort == 'sessions' ? 'selected' : '' }}>Sessions Count</option>
                                <option value="lastname" {{ request()->sort == 'lastname' ? 'selected' : '' }}>Last Name</option>
                                <option value="recent" {{ request()->sort == 'recent' ? 'selected' : '' }}>Most Recent</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="bg-orange-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                Filter
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Members list -->
                <div class="bg-gray-800 shadow-md overflow-hidden sm:rounded-lg border border-gray-700">
                    <ul role="list" class="divide-y divide-gray-700">
                        @forelse($members as $member)
                            <li>
                                <a href="{{ route('trainer.members.show', $member->id) }}" class="block hover:bg-gray-700 transition-colors duration-150">
                                    <div class="px-4 py-4 sm:px-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-orange-800 flex items-center justify-center">
                                                    <span class="text-orange-200 font-semibold">{{ substr($member->firstname, 0, 1) }}{{ substr($member->lastname, 0, 1) }}</span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-orange-400">
                                                        {{ $member->firstname }} {{ $member->lastname }}
                                                    </div>
                                                    <div class="text-sm text-gray-400">
                                                        {{ $member->email }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ml-2 flex-shrink-0 flex">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-800 text-green-200">
                                                    {{ $member->session_count }} Sessions
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="px-4 py-5 sm:px-6">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-white">No members found</h3>
                                    <p class="mt-1 text-sm text-gray-400">No members have attended your sessions yet.</p>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
                
                <!-- Pagination -->
                @if($members->hasPages())
                    <div class="mt-4">
                        {{ $members->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
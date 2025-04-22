<!-- resources/views/trainer/sessions/index.blade.php -->
@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Include the trainer sidebar -->
        @include('partials.trainer-sidebar')
        
        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <!-- Page header -->
            <div class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                    <h1 class="text-2xl font-semibold text-gray-900">My Sessions</h1>
                    <a href="{{ route('trainer.sessions.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Create New Session
                    </a>
                </div>
            </div>
            
            <!-- Page content -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <!-- Session filters -->
                <div class="bg-white shadow rounded-lg mb-6 p-4">
                    <form action="{{ route('trainer.sessions.index') }}" method="GET" class="flex flex-wrap gap-4">
                        <div class="w-full md:w-auto">
                            <label for="date" class="block text-sm font-medium text-gray-700">Filter by Date</label>
                            <input type="date" name="date" id="date" value="{{ request()->date }}" 
                                   class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        
                        <div class="w-full md:w-auto">
                            <label for="type" class="block text-sm font-medium text-gray-700">Filter by Type</label>
                            <select name="type" id="type" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <option value="all">All Types</option>
                                @foreach($sessionTypes as $type)
                                    <option value="{{ $type }}" {{ request()->type == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="w-full md:w-auto flex items-end">
                            <button type="submit" class="bg-indigo-600 text-white py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Filter
                            </button>
                            
                            @if(request()->has('date') || request()->has('type'))
                                <a href="{{ route('trainer.sessions.index') }}" class="ml-2 text-sm text-gray-600 hover:text-gray-900">
                                    Clear Filters
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                
                <!-- Sessions list -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            My Sessions
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            All sessions you've created and are scheduled to lead
                        </p>
                    </div>
                    
                    @if(session('success'))
                        <div class="px-4 py-3 bg-green-50 text-green-800 rounded-md mx-4 mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="px-4 py-3 bg-red-50 text-red-800 rounded-md mx-4 mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <div class="border-t border-gray-200">
                        @if($sessions->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Session
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date & Time
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Attendance
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($sessions as $session)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ $session->title }}</div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $session->type }} - {{ $session->level }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ \Carbon\Carbon::parse($session->date)->format('M d, Y') }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }} - 
                                                        {{ \Carbon\Carbon::parse($session->end_time)->format('g:i A') }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ $session->registered_members ?? $session->attendances->count() }}/{{ $session->max_capacity }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ $session->max_capacity - ($session->registered_members ?? $session->attendances->count()) }} spots left
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @php
                                                        $now = \Carbon\Carbon::now();
                                                        $sessionDate = \Carbon\Carbon::parse($session->date);
                                                        $startTime = \Carbon\Carbon::parse($session->start_time);
                                                        $endTime = \Carbon\Carbon::parse($session->end_time);
                                                        
                                                        $sessionDateTime = $sessionDate->copy()->setTime(
                                                            $startTime->format('H'), 
                                                            $startTime->format('i')
                                                        );
                                                        
                                                        $sessionEndDateTime = $sessionDate->copy()->setTime(
                                                            $endTime->format('H'), 
                                                            $endTime->format('i')
                                                        );
                                                    @endphp
                                                    
                                                    @if($sessionEndDateTime->isPast())
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            Completed
                                                        </span>
                                                    @elseif($sessionDateTime->isPast() && !$sessionEndDateTime->isPast())
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            In Progress
                                                        </span>
                                                    @elseif($sessionDateTime->isToday())
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            Today
                                                        </span>
                                                    @else
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                            Upcoming
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('trainer.sessions.show', $session->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                                        View
                                                    </a>
                                                    
                                                    @if(!$sessionDateTime->isPast())
                                                        <a href="{{ route('trainer.sessions.edit', $session->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                                            Edit
                                                        </a>
                                                        
                                                        <form method="POST" action="{{ route('trainer.sessions.destroy', $session->id) }}" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-900"
                                                                    onclick="return confirm('Are you sure you want to cancel this session?')">
                                                                Cancel
                                                            </button>
                                                        </form>
                                                    @endif
                                                    
                                                    <a href="{{ route('trainer.sessions.attendances', $session->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-2">
                                                        Attendance
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-10">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No sessions found</h3>
                                <p class="mt-1 text-sm text-gray-500">Get started by creating a new session.</p>
                                <div class="mt-6">
                                    <a href="{{ route('trainer.sessions.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Create New Session
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Pagination -->
                @if($sessions->hasPages())
                    <div class="mt-4">
                        {{ $sessions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
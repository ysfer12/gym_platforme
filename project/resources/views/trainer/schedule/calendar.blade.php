<!-- resources/views/trainer/schedule/calendar.blade.php -->
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
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-semibold text-white">My Schedule Calendar</h1>
                        <div class="flex space-x-2">
                            <a href="{{ route('trainer.schedule.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-300 bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                List View
                            </a>
                            <a href="{{ route('trainer.schedule.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Availability
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Page content -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <!-- Calendar legend -->
                <div class="bg-gray-800 shadow-md overflow-hidden sm:rounded-lg mb-6 border border-gray-700">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-white">Calendar Legend</h3>
                        <div class="mt-4 flex flex-wrap gap-4">
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded-md bg-green-800 mr-2"></div>
                                <span class="text-sm text-gray-300">Available Day</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded-md bg-orange-800 mr-2"></div>
                                <span class="text-sm text-gray-300">Scheduled Session</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-6 h-6 rounded-md bg-red-800 mr-2"></div>
                                <span class="text-sm text-gray-300">Unavailable Day</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Weekly calendar view -->
                @foreach($weeks as $weekIndex => $week)
                    <div class="bg-gray-800 shadow-md overflow-hidden sm:rounded-lg mb-6 border border-gray-700">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-white">
                                Week {{ $weekIndex + 1 }}: {{ $week[0]['date']->format('M d') }} - {{ $week[6]['date']->format('M d, Y') }}
                            </h3>
                        </div>
                        <div class="border-t border-gray-700">
                            <div class="grid grid-cols-7 border-b border-gray-700">
                                @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $dayName)
                                    <div class="px-2 py-3 text-center font-medium bg-gray-700 text-gray-300">
                                        {{ $dayName }}
                                    </div>
                                @endforeach
                            </div>
                            <div class="grid grid-cols-7 min-h-[150px]">
                                @foreach($week as $day)
                                    <div class="border-r border-gray-700 last:border-r-0 border-b border-gray-700 p-2 
                                        {{ $day['date']->isToday() ? 'bg-yellow-900 bg-opacity-30' : '' }}
                                        {{ !$day['date']->isToday() && $day['isAvailable'] ? 'bg-green-900 bg-opacity-20' : '' }}">
                                        <div class="flex justify-between items-center mb-2">
                                            <div class="font-medium text-sm {{ $day['date']->isToday() ? 'text-orange-400 font-bold' : 'text-gray-300' }}">
                                                {{ $day['date']->format('j') }}
                                            </div>
                                            @if($day['isAvailable'])
                                                <span class="px-1 text-xs font-semibold rounded-full bg-green-800 text-green-200">
                                                    Available
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <!-- Day's sessions -->
                                        <div class="space-y-1">
                                            @foreach($day['sessions'] as $session)
                                                @php
                                                    $startTime = \Carbon\Carbon::parse($session->start_time);
                                                    $endTime = \Carbon\Carbon::parse($session->end_time);
                                                @endphp
                                                <div class="px-1 py-1 text-xs rounded bg-orange-800 text-orange-200 border border-orange-700">
                                                    <div class="font-medium truncate" title="{{ $session->title }}">
                                                        {{ $session->title }}
                                                    </div>
                                                    <div class="text-orange-300">
                                                        {{ $startTime->format('g:i A') }} - {{ $endTime->format('g:i A') }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <!-- Availability schedule -->
                <div class="bg-gray-800 shadow-md overflow-hidden sm:rounded-lg border border-gray-700">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-white">
                            Weekly Availability Schedule
                        </h3>
                    </div>
                    <div class="border-t border-gray-700">
                        @if($availabilities->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-700">
                                    <thead class="bg-gray-700">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                                Day
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                                Time Slot
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                                        @foreach($availabilities as $availability)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-white">{{ $availability->dayName }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-white">
                                                        {{ \Carbon\Carbon::parse($availability->start_time)->format('g:i A') }} - 
                                                        {{ \Carbon\Carbon::parse($availability->end_time)->format('g:i A') }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $availability->is_available ? 'bg-green-800 text-green-200' : 'bg-red-800 text-red-200' }}">
                                                        {{ $availability->is_available ? 'Available' : 'Unavailable' }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('trainer.schedule.edit', $availability->id) }}" class="text-orange-400 hover:text-orange-300 mr-3">Edit</a>
                                                    <form method="POST" action="{{ route('trainer.schedule.destroy', $availability->id) }}" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Are you sure you want to delete this availability slot?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-10">
                                <svg class="mx-auto h-12 w-12 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-white">No availability slots set</h3>
                                <p class="mt-1 text-sm text-gray-400">Get started by adding your first availability slot.</p>
                                <div class="mt-6">
                                    <a href="{{ route('trainer.schedule.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Add Availability Slot
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
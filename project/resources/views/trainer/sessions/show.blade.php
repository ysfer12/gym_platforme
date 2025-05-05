<!-- resources/views/trainer/sessions/show.blade.php -->
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
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-semibold text-gray-900">Session Details</h1>
                        <div class="flex space-x-2">
                            <a href="{{ route('trainer.sessions.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back to Sessions
                            </a>
                            @php
                                $sessionDate = \Carbon\Carbon::parse($session->date);
                                $startTime = \Carbon\Carbon::parse($session->start_time);
                                $sessionDateTime = $sessionDate->copy()->setTime(
                                    $startTime->format('H'), 
                                    $startTime->format('i')
                                );
                            @endphp
                            
                            @if(!$sessionDateTime->isPast())
                                <a href="{{ route('trainer.sessions.edit', $session->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit Session
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Page content -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <!-- Session information -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
                    <div class="px-4 py-5 sm:px-6 flex justify-between">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $session->title }}</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                {{ $session->type }} - {{ $session->level }}
                            </p>
                        </div>
                        <div>
                            @php
                                $endTime = \Carbon\Carbon::parse($session->end_time);
                                $sessionEndDateTime = $sessionDate->copy()->setTime(
                                    $endTime->format('H'), 
                                    $endTime->format('i')
                                );
                            @endphp
                            
                            @if($sessionEndDateTime->isPast())
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Completed
                                </span>
                            @elseif($sessionDateTime->isPast() && !$sessionEndDateTime->isPast())
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    In Progress
                                </span>
                            @elseif($sessionDateTime->isToday())
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Today
                                </span>
                            @else
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Upcoming
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Description</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $session->description ?? 'No description provided' }}</dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Date & Time</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ \Carbon\Carbon::parse($session->date)->format('M d, Y') }} • 
                                    {{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }} - 
                                    {{ \Carbon\Carbon::parse($session->end_time)->format('g:i A') }}
                                </dd>
                            </div>
                            <!-- City information -->
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Location</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $session->city ?? 'No location specified' }}</dd>
                            </div>
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Maximum Capacity</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $session->max_capacity }} members</dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Current Registrations</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="flex items-center">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            @php
                                                $registrationPercent = ($attendanceCount / $session->max_capacity) * 100;
                                            @endphp
                                            <div class="bg-indigo-600 h-2.5 rounded-full" style="width: {{ $registrationPercent }}%"></div>
                                        </div>
                                        <span class="ml-2">{{ $attendanceCount }}/{{ $session->max_capacity }}</span>
                                    </div>
                                </dd>
                            </div>
                            
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Available Spots</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $availableSpots }} spots left</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                
                <!-- Member List -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Registered Members</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Members who have signed up for this session</p>
                        </div>
                        <a href="{{ route('trainer.sessions.attendances', $session->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Manage Attendance
                        </a>
                    </div>
                    <div class="border-t border-gray-200">
                        @if($members->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Member
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Registration Date
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($members as $attendance)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                            <span class="text-indigo-700 font-semibold">{{ substr($attendance->user->firstname, 0, 1) }}{{ substr($attendance->user->lastname, 0, 1) }}</span>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $attendance->user->firstname }} {{ $attendance->user->lastname }}
                                                            </div>
                                                            <div class="text-sm text-gray-500">
                                                                {{ $attendance->user->email }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ \Carbon\Carbon::parse($attendance->created_at)->format('M d, Y') }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ \Carbon\Carbon::parse($attendance->created_at)->format('g:i A') }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($attendance->entry_time && $attendance->exit_time)
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            Completed
                                                        </span>
                                                    @elseif($attendance->entry_time)
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            Checked In
                                                        </span>
                                                    @else
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            Registered
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-10">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No members registered</h3>
                                <p class="mt-1 text-sm text-gray-500">No members have registered for this session yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
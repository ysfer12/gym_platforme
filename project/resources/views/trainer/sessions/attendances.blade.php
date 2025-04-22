<!-- resources/views/trainer/sessions/attendances.blade.php -->
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
                        <div>
                            <h1 class="text-2xl font-semibold text-gray-900">Session Attendance</h1>
                            <p class="mt-1 text-sm text-gray-500">{{ $session->title }} - {{ \Carbon\Carbon::parse($session->date)->format('M d, Y') }} ({{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($session->end_time)->format('g:i A') }})</p>
                        </div>
                        <a href="{{ route('trainer.sessions.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Sessions
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Page content -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <!-- Session stats -->
                <div class="bg-white shadow sm:rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="text-center">
                                <span class="text-3xl font-bold text-indigo-600">{{ $attendances->count() }}</span>
                                <p class="mt-1 text-sm text-gray-500">Registered Members</p>
                            </div>
                            <div class="text-center">
                                <span class="text-3xl font-bold text-indigo-600">{{ $attendances->whereNotNull('entry_time')->count() }}</span>
                                <p class="mt-1 text-sm text-gray-500">Checked In</p>
                            </div>
                            <div class="text-center">
                                <span class="text-3xl font-bold text-indigo-600">{{ $session->max_capacity - $attendances->count() }}</span>
                                <p class="mt-1 text-sm text-gray-500">Available Spots</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Attendance list -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Member Attendance</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Manage attendances for this session</p>
                    </div>
                    <div class="border-t border-gray-200">
                        @if($attendances->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Member
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Entry Time
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Exit Time
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($attendances as $attendance)
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
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ $attendance->entry_time ? \Carbon\Carbon::parse($attendance->entry_time)->format('g:i A') : 'Not checked in' }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ $attendance->exit_time ? \Carbon\Carbon::parse($attendance->exit_time)->format('g:i A') : 'Not checked out' }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    @if(!$attendance->entry_time)
                                                        <form action="{{ route('trainer.attendances.record-entry') }}" method="POST" class="inline">
                                                            @csrf
                                                            <input type="hidden" name="session_id" value="{{ $session->id }}">
                                                            <input type="hidden" name="user_id" value="{{ $attendance->user_id }}">
                                                            <button type="submit" class="text-indigo-600 hover:text-indigo-900">Record Entry</button>
                                                        </form>
                                                    @elseif(!$attendance->exit_time)
                                                        <form action="{{ route('trainer.attendances.record-exit', $attendance->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="text-indigo-600 hover:text-indigo-900">Record Exit</button>
                                                        </form>
                                                    @else
                                                        <span class="text-gray-400">Completed</span>
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
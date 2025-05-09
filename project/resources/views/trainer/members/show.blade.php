<!-- resources/views/trainer/members/show.blade.php -->
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
                        <h1 class="text-2xl font-semibold text-white">Member Details</h1>
                        <a href="{{ route('trainer.members') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Members
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Page content -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <!-- Member profile -->
                <div class="bg-gray-800 shadow-md overflow-hidden sm:rounded-lg mb-6 border border-gray-700">
                    <div class="px-4 py-5 sm:px-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-16 w-16 rounded-full bg-orange-800 flex items-center justify-center">
                                <span class="text-2xl text-orange-200 font-semibold">{{ substr($member->firstname, 0, 1) }}{{ substr($member->lastname, 0, 1) }}</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg leading-6 font-medium text-white">
                                    {{ $member->firstname }} {{ $member->lastname }}
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-400">
                                    {{ $member->email }}
                                </p>
                                <p class="mt-1 max-w-2xl text-sm text-gray-400">
                                    Member since: {{ $member->registrationDate ? $member->registrationDate->format('M d, Y') : 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Attendance history -->
                <div class="bg-gray-800 shadow-md overflow-hidden sm:rounded-lg border border-gray-700">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-white">
                            Session Attendance History
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-400">
                            Record of sessions this member has attended with you
                        </p>
                    </div>
                    <div class="border-t border-gray-700">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-700">
                                <thead class="bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            Session
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            Date & Time
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-800 divide-y divide-gray-700">
                                    @forelse($attendances as $attendance)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-white">{{ $attendance->session->title }}</div>
                                                <div class="text-sm text-gray-400">{{ $attendance->session->type }} - {{ $attendance->session->level }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-white">{{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}</div>
                                                <div class="text-sm text-gray-400">
                                                    {{ \Carbon\Carbon::parse($attendance->session->start_time)->format('g:i A') }} - 
                                                    {{ \Carbon\Carbon::parse($attendance->session->end_time)->format('g:i A') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($attendance->entry_time && $attendance->exit_time)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-800 text-green-200">
                                                        Completed
                                                    </span>
                                                @elseif($attendance->entry_time)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-800 text-yellow-200">
                                                        Checked In
                                                    </span>
                                                @elseif(\Carbon\Carbon::parse($attendance->date)->isPast())
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-800 text-red-200">
                                                        Missed
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-600 text-gray-200">
                                                        Registered
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-gray-400">
                                                No attendance records found for this member
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Pagination -->
                @if($attendances->hasPages())
                    <div class="mt-4">
                        {{ $attendances->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Include the admin sidebar -->
        @include('partials.admin-sidebar')

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Page Header -->
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <h1 class="text-3xl font-bold">Attendance Details</h1>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.attendances.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-800 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back to Attendances
                            </a>
                            <a href="{{ route('admin.attendances.edit', $attendance) }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Attendance
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Details -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Attendance Information</h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Member Information -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-md font-semibold text-gray-800 mb-4">Member Details</h3>
                                
                                <div class="flex items-center mb-4">
                                    <div class="flex-shrink-0 h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                        <span class="text-indigo-800 font-bold text-lg">
                                            {{ isset($attendance->user) ? 
                                            substr($attendance->user->firstname, 0, 1) . substr($attendance->user->lastname, 0, 1) : 
                                            'NA' }}
                                        </span>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-lg font-medium text-gray-900">
                                            {{ isset($attendance->user) ? 
                                            $attendance->user->firstname . ' ' . $attendance->user->lastname : 
                                            'N/A' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ isset($attendance->user) && isset($attendance->user->email) ? 
                                            $attendance->user->email : 
                                            'N/A' }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    @if(isset($attendance->user))
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Membership ID</div>
                                            <div class="mt-1 text-sm text-gray-900">{{ $attendance->user->id }}</div>
                                        </div>
                                        
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Member Since</div>
                                            <div class="mt-1 text-sm text-gray-900">
                                                {{ isset($attendance->user->created_at) ? 
                                                \Carbon\Carbon::parse($attendance->user->created_at)->format('M d, Y') : 
                                                'N/A' }}
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Phone</div>
                                            <div class="mt-1 text-sm text-gray-900">
                                                {{ isset($attendance->user->phone) ? 
                                                $attendance->user->phone : 
                                                'N/A' }}
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Status</div>
                                            <div class="mt-1">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ isset($attendance->user->status) && $attendance->user->status == 'Active' ? 
                                                    'bg-green-100 text-green-800' : 
                                                    'bg-gray-100 text-gray-800' }}">
                                                    {{ isset($attendance->user->status) ? 
                                                    $attendance->user->status : 
                                                    'Unknown' }}
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-span-2 text-sm text-gray-500">
                                            Member information not available
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Session Information -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-md font-semibold text-gray-800 mb-4">Session Details</h3>
                                
                                @if(isset($attendance->session))
                                    <div class="mb-4">
                                        <div class="text-lg font-medium text-gray-900">
                                            {{ $attendance->session->title }}
                                        </div>
                                        <div>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($attendance->session->type == 'Cardio') bg-pink-100 text-pink-800
                                                @elseif($attendance->session->type == 'Strength') bg-blue-100 text-blue-800
                                                @elseif($attendance->session->type == 'Yoga') bg-green-100 text-green-800
                                                @elseif($attendance->session->type == 'HIIT') bg-orange-100 text-orange-800
                                                @elseif($attendance->session->type == 'Pilates') bg-purple-100 text-purple-800
                                                @elseif($attendance->session->type == 'Cycling') bg-yellow-100 text-yellow-800
                                                @elseif($attendance->session->type == 'Zumba') bg-red-100 text-red-800
                                                @elseif($attendance->session->type == 'CrossFit') bg-indigo-100 text-indigo-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ $attendance->session->type }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Session Date</div>
                                            <div class="mt-1 text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($attendance->session->date)->format('M d, Y') }}
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Session Time</div>
                                            <div class="mt-1 text-sm text-gray-900">
                                                {{ \Carbon\Carbon::parse($attendance->session->start_time)->format('g:i A') }} - 
                                                {{ \Carbon\Carbon::parse($attendance->session->end_time)->format('g:i A') }}
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Duration</div>
                                            <div class="mt-1 text-sm text-gray-900">
                                                @php
                                                    $start = \Carbon\Carbon::parse($attendance->session->start_time);
                                                    $end = \Carbon\Carbon::parse($attendance->session->end_time);
                                                    $duration = $start->diffInMinutes($end);
                                                    $hours = floor($duration / 60);
                                                    $minutes = $duration % 60;
                                                @endphp
                                                {{ $hours > 0 ? $hours . 'h ' : '' }}{{ $minutes }}m
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <div class="text-sm font-medium text-gray-500">Instructor</div>
                                            <div class="mt-1 text-sm text-gray-900">
                                                {{ isset($attendance->session->instructor) ? 
                                                $attendance->session->instructor : 
                                                'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-sm text-gray-500">
                                        Session information not available
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Attendance Details -->
                        <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-md font-semibold text-gray-800 mb-4">Attendance Information</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Date</div>
                                    <div class="mt-1 text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Entry Time</div>
                                    <div class="mt-1 text-sm text-gray-900">
                                        {{ $attendance->entry_time ? 
                                        \Carbon\Carbon::parse($attendance->entry_time)->format('g:i A') : 
                                        'Not recorded' }}
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Exit Time</div>
                                    <div class="mt-1 text-sm text-gray-900">
                                        {{ $attendance->exit_time ? 
                                        \Carbon\Carbon::parse($attendance->exit_time)->format('g:i A') : 
                                        'Not recorded' }}
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Duration</div>
                                    <div class="mt-1 text-sm text-gray-900">
                                        @if($attendance->entry_time && $attendance->exit_time)
                                            @php
                                                $entry = \Carbon\Carbon::parse($attendance->date . ' ' . $attendance->entry_time);
                                                $exit = \Carbon\Carbon::parse($attendance->date . ' ' . $attendance->exit_time);
                                                $duration = $entry->diffInMinutes($exit);
                                                $hours = floor($duration / 60);
                                                $minutes = $duration % 60;
                                            @endphp
                                            {{ $hours > 0 ? $hours . 'h ' : '' }}{{ $minutes }}m
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Check-in Method</div>
                                    <div class="mt-1 text-sm text-gray-900">
                                        {{ ucfirst(str_replace('-', ' ', $attendance->check_in_method)) }}
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="text-sm font-medium text-gray-500">Created</div>
                                    <div class="mt-1 text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($attendance->created_at)->format('M d, Y g:i A') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="mt-6 flex justify-end space-x-3">
                            @if(!$attendance->exit_time)
                                <form action="{{ route('admin.attendances.record-exit', $attendance) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Record Exit
                                    </button>
                                </form>
                            @endif
                            
                            <form action="{{ route('admin.attendances.destroy', $attendance) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this attendance record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete Attendance
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        @include('partials.admin-mobile-menu')
    </div>
</div>
@endsection
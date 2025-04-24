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
                        <h1 class="text-3xl font-bold">Attendance Management</h1>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.attendances.create') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-800 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Record Attendance
                            </a>
                            <a href="{{ route('admin.attendances.report') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Attendance Report
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                    <form action="{{ route('admin.attendances.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-6">
                        <!-- Filter by Date Range -->
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        
                        <!-- Filter by Member -->
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700">Member</label>
                            <select id="user_id" name="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">All Members</option>
                                @foreach(\App\Models\User::where('role', 'Member')->orderBy('firstname')->get() as $member)
                                    <option value="{{ $member->id }}" {{ request('user_id') == $member->id ? 'selected' : '' }}>
                                        {{ $member->firstname }} {{ $member->lastname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Filter by Session Type -->
                        <div>
                            <label for="session_type" class="block text-sm font-medium text-gray-700">Session Type</label>
                            <select id="session_type" name="session_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">All Types</option>
                                <option value="Cardio" {{ request('session_type') === 'Cardio' ? 'selected' : '' }}>Cardio</option>
                                <option value="Strength" {{ request('session_type') === 'Strength' ? 'selected' : '' }}>Strength</option>
                                <option value="HIIT" {{ request('session_type') === 'HIIT' ? 'selected' : '' }}>HIIT</option>
                                <option value="Yoga" {{ request('session_type') === 'Yoga' ? 'selected' : '' }}>Yoga</option>
                                <option value="Pilates" {{ request('session_type') === 'Pilates' ? 'selected' : '' }}>Pilates</option>
                                <option value="Cycling" {{ request('session_type') === 'Cycling' ? 'selected' : '' }}>Cycling</option>
                                <option value="Zumba" {{ request('session_type') === 'Zumba' ? 'selected' : '' }}>Zumba</option>
                                <option value="CrossFit" {{ request('session_type') === 'CrossFit' ? 'selected' : '' }}>CrossFit</option>
                            </select>
                        </div>
                        
                        <!-- Filter Actions -->
                        <div class="flex items-end space-x-2">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Filter
                            </button>
                            <a href="{{ route('admin.attendances.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
                
                <!-- Today's Quick Check-in Section -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Today's Quick Check-in</h2>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('admin.attendances.record-entry') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @csrf
                            <!-- Member Selection -->
                            <div>
                                <label for="quick_user_id" class="block text-sm font-medium text-gray-700">Member</label>
                                <select id="quick_user_id" name="user_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">Select Member</option>
                                    @foreach(\App\Models\User::where('role', 'Member')->orderBy('firstname')->get() as $member)
                                        <option value="{{ $member->id }}">
                                            {{ $member->firstname }} {{ $member->lastname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Session Selection -->
                            <div>
                                <label for="quick_session_id" class="block text-sm font-medium text-gray-700">Session</label>
                                <select id="quick_session_id" name="session_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">Select Session</option>
                                    @foreach(\App\Models\Session::where('date', now()->format('Y-m-d'))->orderBy('start_time')->get() as $session)
                                        <option value="{{ $session->id }}">
                                            {{ $session->title }} ({{ \Carbon\Carbon::parse($session->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($session->end_time)->format('g:i A') }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Check-in Button -->
                            <div class="flex items-end">
                                <button type="submit" class="inline-flex w-full justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Check-in Member
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Attendance Records Table -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h2 class="text-lg font-medium text-gray-900">Attendance Records</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Member
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Session
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Entry Time
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Exit Time
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Duration
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($attendances as $attendance)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                                    <span class="text-indigo-800 font-bold">
                                                        {{ isset($attendance->user) ? 
                                                        substr($attendance->user->firstname, 0, 1) . substr($attendance->user->lastname, 0, 1) : 
                                                        'NA' }}
                                                    </span>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ isset($attendance->user) ? 
                                                        $attendance->user->firstname . ' ' . $attendance->user->lastname : 
                                                        'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ isset($attendance->session) ? $attendance->session->title : 'N/A' }}
                                            </div>
                                            <div>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    @if(isset($attendance->session))
                                                        @if($attendance->session->type == 'Cardio') bg-pink-100 text-pink-800
                                                        @elseif($attendance->session->type == 'Strength') bg-blue-100 text-blue-800
                                                        @elseif($attendance->session->type == 'Yoga') bg-green-100 text-green-800
                                                        @elseif($attendance->session->type == 'HIIT') bg-orange-100 text-orange-800
                                                        @elseif($attendance->session->type == 'Pilates') bg-purple-100 text-purple-800
                                                        @elseif($attendance->session->type == 'Cycling') bg-yellow-100 text-yellow-800
                                                        @elseif($attendance->session->type == 'Zumba') bg-red-100 text-red-800
                                                        @elseif($attendance->session->type == 'CrossFit') bg-indigo-100 text-indigo-800
                                                        @else bg-gray-100 text-gray-800 @endif
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ isset($attendance->session) ? $attendance->session->type : 'N/A' }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $attendance->entry_time ? \Carbon\Carbon::parse($attendance->entry_time)->format('g:i A') : 'Not recorded' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $attendance->exit_time ? \Carbon\Carbon::parse($attendance->exit_time)->format('g:i A') : 'Not recorded' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        @if($attendance->entry_time && $attendance->exit_time)
    @php
        // Create date object from attendance date
        $dateObj = \Carbon\Carbon::parse($attendance->date);
        
        // Parse entry time and set it on the same date
        $entry = \Carbon\Carbon::parse($attendance->entry_time);
        $entry->setDateFrom($dateObj);
        
        // Parse exit time and set it on the same date
        $exit = \Carbon\Carbon::parse($attendance->exit_time);
        $exit->setDateFrom($dateObj);
        
        // Calculate duration
        $duration = $entry->diffInMinutes($exit);
        $hours = floor($duration / 60);
        $minutes = $duration % 60;
    @endphp
    {{ $hours > 0 ? $hours . 'h ' : '' }}{{ $minutes }}m
@else
    -
@endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('admin.attendances.show', $attendance) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    View
                                                </a>
                                                <a href="{{ route('admin.attendances.edit', $attendance) }}" class="text-green-600 hover:text-green-900">
                                                    Edit
                                                </a>
                                                @if(!$attendance->exit_time)
                                                    <form action="{{ route('admin.attendances.record-exit', $attendance) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="text-blue-600 hover:text-blue-900">
                                                            Record Exit
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.attendances.destroy', $attendance) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this attendance record?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-centertext-sm text-gray-500">
                                            No attendance records found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        @include('partials.admin-mobile-menu')
    </div>
</div>
@endsection
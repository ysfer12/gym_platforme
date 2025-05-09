@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('partials.receptionist-sidebar')
        
        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-semibold text-gray-900">Daily Attendance</h1>
                        <div class="flex space-x-2">
                            <a href="{{ route('receptionist.attendances.create-daily-form') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Record Manual Attendance
                            </a>
                            <a href="{{ route('receptionist.attendances.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Session Attendance
                            </a>
                        </div>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <!-- Quick Check-in Card -->
                    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6 mb-6">
                        <h2 class="text-lg font-medium text-gray-900 mb-4">Quick Check-in</h2>
                        <form action="{{ route('receptionist.attendances.recordDailyEntry') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div>
                                    <label for="quick_user_id" class="block text-sm font-medium text-gray-700">Member</label>
                                    <select id="quick_user_id" name="user_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                        <option value="">Select a member</option>
                                        @foreach($members as $member)
                                            <option value="{{ $member->id }}">
                                                {{ $member->firstname }} {{ $member->lastname }} ({{ $member->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="date" value="{{ request('date', now()->toDateString()) }}">
                                </div>
                                <div class="flex items-end">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                        </svg>
                                        Check In
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Date selection and search filters -->
                    <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6 mb-6">
                        <form action="{{ route('receptionist.attendances.daily') }}" method="GET">
                            <div class="flex flex-col sm:flex-row sm:items-end space-y-4 sm:space-y-0 sm:space-x-4">
                                <div class="flex-1">
                                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" name="date" id="date" value="{{ request('date', now()->toDateString()) }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                                <div class="flex-1">
                                    <label for="search" class="block text-sm font-medium text-gray-700">Search Members</label>
                                    <input type="text" name="search" id="search" value="{{ request('search') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Name or email">
                                </div>
                                <div>
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Summary Cards -->
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 mb-6">
                        <!-- Total Members Card -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">
                                                Total Members
                                            </dt>
                                            <dd>
                                                <div class="text-lg font-medium text-gray-900">
                                                    {{ $members->total() }}
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Checked In Today Card -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">
                                                Checked In Today
                                            </dt>
                                            <dd>
                                                <div class="text-lg font-medium text-gray-900">
                                                    {{ $attendances->count() }}
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Currently Active Card -->
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">
                                                Currently Active
                                            </dt>
                                            <dd>
                                                <div class="text-lg font-medium text-gray-900">
                                                    {{ $attendances->where('entry_time', '!=', null)->where('exit_time', null)->count() }}
                                                </div>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Daily Attendance Table -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="bg-gray-50 px-4 py-5 sm:px-6 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Daily Attendance for {{ Carbon\Carbon::parse(request('date', now()->toDateString()))->format('F j, Y') }}</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Record entries and exits for gym members.</p>
                        </div>
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
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Duration
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($members as $member)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                        <span class="text-blue-700 font-semibold">{{ substr($member->firstname, 0, 1) }}{{ substr($member->lastname, 0, 1) }}</span>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $member->firstname }} {{ $member->lastname }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $member->email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if(isset($attendances[$member->id]))
                                                    @if($attendances[$member->id]->entry_time && $attendances[$member->id]->exit_time)
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            Completed
                                                        </span>
                                                    @elseif($attendances[$member->id]->entry_time)
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                            Active
                                                        </span>
                                                    @else
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            Registered
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Not Checked In
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if(isset($attendances[$member->id]) && $attendances[$member->id]->entry_time)
                                                    {{ Carbon\Carbon::parse($attendances[$member->id]->entry_time)->format('h:i A') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if(isset($attendances[$member->id]) && $attendances[$member->id]->exit_time)
                                                    {{ Carbon\Carbon::parse($attendances[$member->id]->exit_time)->format('h:i A') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if(isset($attendances[$member->id]) && $attendances[$member->id]->entry_time && $attendances[$member->id]->exit_time)
                                                    @php
                                                        $duration = Carbon\Carbon::parse($attendances[$member->id]->entry_time)->diffInMinutes(Carbon\Carbon::parse($attendances[$member->id]->exit_time));
                                                        $hours = floor($duration / 60);
                                                        $minutes = $duration % 60;
                                                    @endphp
                                                    {{ $hours > 0 ? $hours . 'h ' : '' }}{{ $minutes }}m
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                @if(!isset($attendances[$member->id]) || !$attendances[$member->id]->entry_time)
                                                    <form action="{{ route('receptionist.attendances.recordDailyEntry') }}" method="POST" class="inline-block">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $member->id }}">
                                                        <input type="hidden" name="date" value="{{ request('date', now()->toDateString()) }}">
                                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-3">Record Entry</button>
                                                    </form>
                                                @elseif(isset($attendances[$member->id]) && $attendances[$member->id]->entry_time && !$attendances[$member->id]->exit_time)
                                                    <form action="{{ route('receptionist.attendances.recordDailyExit', $attendances[$member->id]->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        <button type="submit" class="text-red-600 hover:text-red-900">Record Exit</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                No members found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                            {{ $members->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
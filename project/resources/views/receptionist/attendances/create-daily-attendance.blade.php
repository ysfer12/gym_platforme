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
                        <h1 class="text-2xl font-semibold text-gray-900">Record Daily Attendance</h1>
                        <div class="flex space-x-2">
                            <a href="{{ route('receptionist.attendances.daily') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Back to Daily Attendance
                            </a>
                        </div>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <!-- Manual Attendance Form -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 bg-gray-50">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Create Daily Attendance Record</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Record a custom daily attendance entry with specific times.</p>
                        </div>
                        <div class="border-t border-gray-200">
                            <form action="{{ route('receptionist.attendances.create-daily') }}" method="POST">
                                @csrf
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                        <!-- Member Selection -->
                                        <div class="sm:col-span-2">
                                            <label for="user_id" class="block text-sm font-medium text-gray-700">Member</label>
                                            <select id="user_id" name="user_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                                <option value="">Select a member</option>
                                                @foreach($members as $member)
                                                    <option value="{{ $member->id }}" {{ old('user_id') == $member->id ? 'selected' : '' }}>
                                                        {{ $member->firstname }} {{ $member->lastname }} ({{ $member->email }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Date -->
                                        <div>
                                            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                            <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('date')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Entry Time -->
                                        <div>
                                            <label for="entry_time" class="block text-sm font-medium text-gray-700">Entry Time</label>
                                            <input type="time" name="entry_time" id="entry_time" value="{{ old('entry_time') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('entry_time')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Exit Time -->
                                        <div>
                                            <label for="exit_time" class="block text-sm font-medium text-gray-700">Exit Time</label>
                                            <input type="time" name="exit_time" id="exit_time" value="{{ old('exit_time') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @error('exit_time')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Check-in Method -->
                                        <div>
                                            <label for="check_in_method" class="block text-sm font-medium text-gray-700">Check-in Method</label>
                                            <select id="check_in_method" name="check_in_method" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                                <option value="receptionist" {{ old('check_in_method') == 'receptionist' ? 'selected' : '' }}>Receptionist</option>
                                                <option value="self" {{ old('check_in_method') == 'self' ? 'selected' : '' }}>Self Check-in</option>
                                                <option value="trainer" {{ old('check_in_method') == 'trainer' ? 'selected' : '' }}>Trainer</option>
                                                <option value="system" {{ old('check_in_method') == 'system' ? 'selected' : '' }}>System</option>
                                            </select>
                                            @error('check_in_method')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Create Attendance Record
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
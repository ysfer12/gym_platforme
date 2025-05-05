@extends('layouts.main')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar - Keep existing sidebar -->
        @include('partials.member-sidebar')
        
        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <!-- Header -->
            <div class="bg-white shadow-md border-b border-gray-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span class="relative">
                            My Attendance
                            <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-orange-500 to-red-500 rounded-full transform translate-y-1"></span>
                        </span>
                    </h1>
                    <div class="hidden sm:flex items-center space-x-4">
                        <a href="{{ route('member.sessions') }}" class="group inline-flex items-center px-4 py-2 text-sm font-medium rounded-full text-white bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 shadow-md hover:shadow-lg transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Book a Session
                        </a>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                    <div>
                        <p class="text-gray-600">Track your workout journey and monitor your progress</p>
                        <p class="text-sm text-gray-500 mt-1">View detailed attendance records and attendance statistics</p>
                    </div>
                    
                    <!-- Activity Streak -->
                    <div class="mt-4 sm:mt-0 bg-white rounded-lg shadow-md px-4 py-2 border border-gray-100 flex items-center">
                        <div class="flex space-x-1">
                            @for ($i = 0; $i < 7; $i++)
                                <div class="w-2 h-8 rounded-full {{ $i < 4 ? 'bg-gradient-to-b from-orange-400 to-red-500' : 'bg-gray-200' }}"></div>
                            @endfor
                        </div>
                        <div class="ml-3">
                            <p class="text-xs font-medium text-gray-500">Weekly streak</p>
                            <p class="text-sm font-bold text-gray-800">4 days</p>
                        </div>
                    </div>
                </div>

                <!-- Attendance Statistics -->
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                    <!-- Total Attendance -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-gradient-to-r from-orange-500 to-red-500 rounded-lg p-3 shadow-md">
                                    <svg class="h-7 w-7 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Total Attendance
                                        </dt>
                                        <dd class="mt-1">
                                            <div class="text-2xl font-bold text-gray-900 flex items-baseline">
                                                {{ $stats['total'] }} 
                                                <span class="text-sm font-normal text-gray-500 ml-1">sessions</span>
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <!-- Progress bar -->
                            <div class="mt-4">
                                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-orange-500 to-red-500 rounded-full" style="width: {{ min(100, ($stats['total'] / 100) * 100) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- This Month -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-gradient-to-r from-green-500 to-teal-500 rounded-lg p-3 shadow-md">
                                    <svg class="h-7 w-7 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            This Month
                                        </dt>
                                        <dd class="mt-1">
                                            <div class="text-2xl font-bold text-gray-900 flex items-baseline">
                                                {{ $stats['thisMonth'] }}
                                                <span class="text-sm font-normal text-gray-500 ml-1">sessions</span>
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <!-- Progress bar -->
                            <div class="mt-4">
                                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-green-500 to-teal-500 rounded-full" style="width: {{ min(100, ($stats['thisMonth'] / 12) * 100) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Last Month -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-gradient-to-r from-yellow-500 to-amber-500 rounded-lg p-3 shadow-md">
                                    <svg class="h-7 w-7 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            Last Month
                                        </dt>
                                        <dd class="mt-1">
                                            <div class="text-2xl font-bold text-gray-900 flex items-baseline">
                                                {{ $stats['lastMonth'] }}
                                                <span class="text-sm font-normal text-gray-500 ml-1">sessions</span>
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <!-- Progress bar -->
                            <div class="mt-4">
                                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-yellow-500 to-amber-500 rounded-full" style="width: {{ min(100, ($stats['lastMonth'] / 12) * 100) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- This Year -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-lg p-3 shadow-md">
                                    <svg class="h-7 w-7 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 truncate">
                                            This Year
                                        </dt>
                                        <dd class="mt-1">
                                            <div class="text-2xl font-bold text-gray-900 flex items-baseline">
                                                {{ $stats['thisYear'] }}
                                                <span class="text-sm font-normal text-gray-500 ml-1">sessions</span>
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                            <!-- Progress bar -->
                            <div class="mt-4">
                                <div class="w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full" style="width: {{ min(100, ($stats['thisYear'] / 144) * 100) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance History Table -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden border border-gray-100">
                    <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg leading-6 font-semibold text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Attendance History
                        </h3>
                        <div class="flex space-x-2">
                            <div class="relative inline-block text-left">
                                <select class="block w-full pl-3 pr-10 py-2 text-sm border-gray-300 bg-white rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200">
                                    <option>All time</option>
                                    <option>Last 30 days</option>
                                    <option>Last 90 days</option>
                                    <option>This year</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    @if($attendances->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Session</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Time</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Check-in</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($attendances as $attendance)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-9 w-9 bg-orange-100 text-orange-700 rounded-lg flex items-center justify-center font-semibold mr-3">
                                                        {{ \Carbon\Carbon::parse($attendance->date)->format('d') }}
                                                    </div>
                                                    {{ \Carbon\Carbon::parse($attendance->date)->format('M Y') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm font-semibold text-gray-900">
                                                            {{ $attendance->session->title }}
                                                        </div>
                                                        <div class="flex items-center mt-1">
                                                            <span class="px-2 py-0.5 inline-flex text-xs leading-5 font-medium rounded-full {{ $attendance->session->type == 'Cardio' ? 'bg-pink-100 text-pink-800' : ($attendance->session->type == 'Strength' ? 'bg-blue-100 text-blue-800' : ($attendance->session->type == 'Yoga' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800')) }}">
                                                                {{ $attendance->session->type }}
                                                            </span>
                                                            <span class="ml-2 px-2 py-0.5 inline-flex text-xs leading-5 font-medium rounded-full bg-gray-100 text-gray-800">
                                                                {{ $attendance->session->level }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                                @if($attendance->entry_time)
                                                    <div class="flex items-center">
                                                        <svg class="h-4 w-4 text-gray-400 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ \Carbon\Carbon::parse($attendance->entry_time)->format('g:i A') }}
                                                        @if($attendance->exit_time)
                                                            <span class="px-2">to</span> {{ \Carbon\Carbon::parse($attendance->exit_time)->format('g:i A') }}
                                                            <span class="ml-2 px-2 py-0.5 text-xs bg-gray-100 text-gray-500 rounded-full">
                                                                {{ \Carbon\Carbon::parse($attendance->entry_time)->diffInMinutes(\Carbon\Carbon::parse($attendance->exit_time)) }} min
                                                            </span>
                                                        @endif
                                                    </div>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($attendance->entry_time)
                                                    <span class="px-2.5 py-1 inline-flex items-center text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                        <svg class="mr-1 h-3 w-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                        </svg>
                                                        Checked in
                                                    </span>
                                                @else
                                                    <span class="px-2.5 py-1 inline-flex items-center text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        <svg class="mr-1 h-3 w-3 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                        </svg>
                                                        Booked
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="bg-white px-4 py-4 border-t border-gray-200 sm:px-6">
                            {{ $attendances->links() }}
                        </div>
                    @else
                        <div class="px-4 py-10 text-center">
                            <div class="mx-auto h-24 w-24 text-gray-300 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No attendance records yet</h3>
                            <p class="mt-2 text-sm text-gray-500">Time to start your fitness journey! Book your first session now.</p>
                            <div class="mt-6">
                                <a href="{{ route('member.sessions') }}" class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-full text-white bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Book Your First Session
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile floating action button -->
<div class="md:hidden fixed z-20 bottom-6 right-6">
    <a href="{{ route('member.sessions') }}" class="flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-lg hover:from-orange-600 hover:to-red-600 transition-all duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
    </a>
</div>

@include('partials.mobile-menu')
@endsection
<!-- resources/views/trainer/profile.blade.php -->
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
                    <h1 class="text-2xl font-semibold text-gray-900">My Profile</h1>
                </div>
            </div>
            
            <!-- Page content -->
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Profile section -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Trainer Profile</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal details and trainer information</p>
                        </div>
                        <div>
                            <a href="#" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Edit Profile
                            </a>
                        </div>
                    </div>
                    <div class="border-t border-gray-200">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="flex flex-col sm:flex-row">
                                <div class="sm:w-1/3 mb-6 sm:mb-0 flex flex-col items-center">
                                    <div class="h-32 w-32 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white text-4xl font-bold mb-4">
                                        {{ substr($user->firstname, 0, 1) }}{{ substr($user->lastname, 0, 1) }}
                                    </div>
                                    
                                    <!-- Trainer Badge with QR Code -->
                                    <div class="flex flex-col items-center">
                                        <div class="relative">
                                            @php
                                                $badgeClasses = [
                                                    'basic' => 'from-gray-200 to-gray-300 border-gray-300',
                                                    'bronze' => 'from-yellow-700 to-yellow-800 border-yellow-800',
                                                    'silver' => 'from-gray-300 to-gray-500 border-gray-500',
                                                    'gold' => 'from-yellow-400 to-yellow-600 border-yellow-600',
                                                ];
                                                $badgeClass = $badgeClasses[$experienceLevel['badge']] ?? $badgeClasses['basic'];
                                            @endphp
                                            
                                            <div class="p-1 h-52 w-52 rounded-lg bg-gradient-to-r {{ $badgeClass }} border-2 flex items-center justify-center">
                                                <div class="h-full w-full bg-white rounded-md flex flex-col items-center justify-center p-3">
                                                    <!-- QR Code -->
                                                    <div id="profileQrcode" class="w-32 h-32"></div>
                                                    <div class="mt-2 text-center">
                                                        <p class="text-xs font-bold text-gray-900">{{ $user->firstname }} {{ $user->lastname }}</p>
                                                        <p class="text-xs font-semibold text-indigo-600">{{ $experienceLevel['level'] }} Trainer</p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Download and Badge indicators -->
                                            <div class="absolute -bottom-3 -right-3 flex space-x-1">
                                                <a href="{{ route('trainer.profile.download-badge') }}" class="h-8 w-8 rounded-full bg-white border border-gray-200 shadow-md flex items-center justify-center hover:bg-gray-50">
                                                    <svg class="h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                </a>
                                                <span class="h-8 w-8 rounded-full bg-white border border-gray-200 shadow-md flex items-center justify-center">
                                                    <svg class="h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-5 text-center">
                                            <p class="text-sm font-medium text-gray-900">{{ $experienceLevel['level'] }} Trainer</p>
                                            <p class="text-xs text-gray-500">{{ $totalSessions }} sessions completed</p>
                                            <div class="mt-2 flex gap-1 items-center justify-center">
                                                <a href="{{ route('trainer.profile.download-badge') }}" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    <svg class="-ml-0.5 mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                    Download Badge
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <!-- Progress to next level -->
                                        <div class="w-full mt-4">
                                            <div class="relative pt-1">
                                                <div class="flex mb-2 items-center justify-between">
                                                    <div>
                                                        <span class="text-xs font-semibold inline-block text-indigo-600">
                                                            Progress to next level
                                                        </span>
                                                    </div>
                                                    <div class="text-right">
                                                        <span class="text-xs font-semibold inline-block text-indigo-600">
                                                            {{ round($experienceLevel['progress']) }}%
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-indigo-200">
                                                    <div style="width:{{ $experienceLevel['progress'] }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-500"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="sm:w-2/3 sm:pl-8">
                                    <div class="space-y-6">
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">Personal Information</h3>
                                            <div class="mt-3 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->firstname }} {{ $user->lastname }}</dd>
                                                </div>
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->email }}</dd>
                                                </div>
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500">Role</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->role }}</dd>
                                                </div>
                                                <div>
                                                    <dt class="text-sm font-medium text-gray-500">Member Since</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->registrationDate ? $user->registrationDate->format('M d, Y') : 'N/A' }}</dd>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <h3 class="text-lg font-medium text-gray-900">Trainer Statistics</h3>
                                            <div class="mt-3 grid grid-cols-1 gap-5 sm:grid-cols-3">
                                                <div class="bg-white overflow-hidden shadow rounded-lg">
                                                    <div class="px-4 py-5 sm:p-6">
                                                        <dt class="text-sm font-medium text-gray-500 truncate">Total Sessions</dt>
                                                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalSessions }}</dd>
                                                    </div>
                                                </div>
                                                
                                                <div class="bg-white overflow-hidden shadow rounded-lg">
                                                    <div class="px-4 py-5 sm:p-6">
                                                        <dt class="text-sm font-medium text-gray-500 truncate">Members Trained</dt>
                                                        <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $totalUniqueMembers }}</dd>
                                                    </div>
                                                </div>
                                                
                                                <div class="bg-white overflow-hidden shadow rounded-lg">
                                                    <div class="px-4 py-5 sm:p-6">
                                                        <dt class="text-sm font-medium text-gray-500 truncate">Specialties</dt>
                                                        <dd class="mt-1 text-sm text-gray-900">
                                                            @if(count($specialties) > 0)
                                                                <div class="flex flex-wrap gap-2">
                                                                    @foreach($specialties as $specialty)
                                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                                            {{ $specialty }}
                                                                        </span>
                                                                    @endforeach
                                                                </div>
                                                            @else
                                                                <span class="text-gray-500">No specialties yet</span>
                                                            @endif
                                                        </dd>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Additional sections could be added here -->
                <!-- For example: Availability schedule, Recent sessions, etc. -->
                
            </div>
        </div>
    </div>
</div>

<!-- Add QRCode.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Generate QR Code
        const qrData = @json($qrData);
        const qrContainer = document.getElementById('profileQrcode');
        
        if (qrContainer) {
            new QRCode(qrContainer, {
                text: JSON.stringify(qrData),
                width: 128,
                height: 128,
                colorDark: "#4F46E5", // Indigo color
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        }
    });
</script>
@endsection
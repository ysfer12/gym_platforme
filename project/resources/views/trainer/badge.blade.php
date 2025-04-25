<!-- resources/views/trainer/badge.blade.php -->
@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-6">
            <a href="{{ route('trainer.profile') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Profile
            </a>
        </div>
        
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Trainer Badge</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Official FitTrack Gym trainer credential</p>
                </div>
                <a href="{{ route('trainer.profile.download-badge') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Download Badge
                </a>
            </div>
            <div class="border-t border-gray-200">
                <div class="flex flex-col items-center py-10">
                    @php
                        $badgeClasses = [
                            'basic' => 'from-gray-200 to-gray-300 border-gray-300',
                            'bronze' => 'from-yellow-700 to-yellow-800 border-yellow-800',
                            'silver' => 'from-gray-300 to-gray-500 border-gray-500',
                            'gold' => 'from-yellow-400 to-yellow-600 border-yellow-600',
                        ];
                        $badgeClass = $badgeClasses[$experienceLevel['badge']] ?? $badgeClasses['basic'];
                    @endphp
                    
                    <div class="p-2 h-96 w-96 rounded-lg bg-gradient-to-r {{ $badgeClass }} border-2 flex items-center justify-center">
                        <div class="h-full w-full bg-white rounded-md flex flex-col items-center justify-center p-6">
                            <!-- Gym Logo -->
                            <div class="mb-2 text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-blue-500">
                                FitTrack Gym
                            </div>
                            
                            <!-- QR Code -->
                            <div id="badgeQrcode" class="w-48 h-48 mb-3 flex items-center justify-center"></div>
                            
                            <!-- Trainer Info -->
                            <div class="text-center">
                                <h2 class="text-lg font-bold text-gray-900">{{ $user->firstname }} {{ $user->lastname }}</h2>
                                <div class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                    {{ $experienceLevel['level'] }} Trainer
                                </div>
                                <p class="mt-2 text-sm text-gray-500">{{ $user->email }}</p>
                                
                                @if(count($specialties) > 0)
                                    <div class="mt-3">
                                        <p class="text-xs text-gray-500">Specialties:</p>
                                        <div class="flex flex-wrap justify-center gap-1 mt-1">
                                            @foreach($specialties as $specialty)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    {{ $specialty }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                
                                <p class="mt-3 text-xs text-gray-500">Sessions Completed: {{ $totalSessions }}</p>
                                <p class="text-xs text-gray-500">Badge ID: TRN-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 text-center text-sm text-gray-500">
                        <p>Scan this QR code to verify trainer credentials.</p>
                        <p class="mt-1">This badge belongs to a certified FitTrack Gym trainer.</p>
                    </div>
                </div>
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
        const qrContainer = document.getElementById('badgeQrcode');
        
        if (qrContainer) {
            new QRCode(qrContainer, {
                text: JSON.stringify(qrData),
                width: 180,
                height: 180,
                colorDark: "#4F46E5", // Indigo color
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        }
    });
</script>
@endsection
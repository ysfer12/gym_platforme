@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        @include('partials.member-sidebar')
        
        <!-- Main content -->
        <div class="flex-1 overflow-auto">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-semibold text-gray-900 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            My Profile
                        </h1>
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <!-- Profile Information -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
                        <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Personal Information</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Your account details and membership information</p>
                        </div>
                        <div class="border-t border-gray-200">
                            <dl>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Full name</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Email address</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ Auth::user()->email }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Member since</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ Auth::user()->registrationDate ? \Carbon\Carbon::parse(Auth::user()->registrationDate)->format('F j, Y') : \Carbon\Carbon::parse(Auth::user()->created_at)->format('F j, Y') }}</dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Member ID</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ Auth::user()->id }}</dd>
                                </div>
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Address</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ Auth::user()->address ?? 'Not provided' }}</dd>
                                </div>
                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Membership Status</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        @if($activeSubscription)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Active
                                            </span>
                                            {{ $activeSubscription->type }} Plan (Valid until {{ \Carbon\Carbon::parse($activeSubscription->end_date)->format('M d, Y') }})
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Inactive
                                            </span>
                                            No active subscription
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Member Badge Section -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Membership Badge</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">Your digital membership badge and QR code for check-in</p>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Badge Preview -->
                                <div>
                                    <div id="badge-card" class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden border-2 border-indigo-500">
                                        <!-- Badge Header -->
                                        <div class="bg-gradient-to-r from-indigo-500 to-blue-600 px-4 py-4 flex justify-between items-center">
                                            <div class="flex items-center">
                                                <div class="text-2xl font-bold text-white">GYM PLATFORM</div>
                                            </div>
                                            <div class="text-sm text-white font-semibold">MEMBER CARD</div>
                                        </div>
                                        <!-- Badge Content -->
                                        <div class="p-6">
                                            <div class="flex">
                                                <!-- Member Photo/Avatar -->
                                                <div class="mr-4 flex-shrink-0">
                                                    <div class="h-32 w-32 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-4xl font-bold">
                                                        {{ substr(Auth::user()->firstname, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}
                                                    </div>
                                                </div>
                                                <!-- Member Info -->
                                                <div class="flex-1">
                                                    <h2 class="text-xl font-bold text-gray-900">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h2>
                                                    <p class="text-gray-600 text-sm mt-1">Member #{{ Auth::user()->id }}</p>
                                                    
                                                    <div class="mt-4 space-y-2">
                                                        <div class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                            <span class="text-sm text-gray-700">Member since: {{ Auth::user()->registrationDate ? \Carbon\Carbon::parse(Auth::user()->registrationDate)->format('M d, Y') : \Carbon\Carbon::parse(Auth::user()->created_at)->format('M d, Y') }}</span>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                            </svg>
                                                            <span class="text-sm text-gray-700">
                                                                @if($activeSubscription)
                                                                {{ $activeSubscription->type }} Membership
                                                                @else
                                                                No active membership
                                                                @endif
                                                            </span>
                                                        </div>
                                                        @if($activeSubscription)
                                                        <div class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            <span class="text-sm text-gray-700">Valid until: {{ \Carbon\Carbon::parse($activeSubscription->end_date)->format('M d, Y') }}</span>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- QR Code -->
                                            <div class="mt-6 flex justify-center">
                                                <!-- QR code will be generated here -->
                                                <div id="qrcode" class="p-2 bg-white border border-gray-200 rounded-md"></div>
                                            </div>
                                            <div class="mt-2 text-center text-xs text-gray-500">Scan for check-in</div>
                                        </div>
                                        <!-- Badge Footer -->
                                        <div class="px-6 py-2 bg-gray-50 text-xs text-center text-gray-500">
                                            <p>This card is the property of Gym Platform. If found, please return to any Gym Platform location.</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Badge Actions -->
                                <div class="flex flex-col justify-center">
                                    <div class="text-sm text-gray-500 mb-6">
                                        <p>Your digital membership badge can be used to check in at the gym. You can:</p>
                                        <ul class="list-disc list-inside mt-2 space-y-1">
                                            <li>Download it to your phone to show at reception</li>
                                            <li>Print it out for a physical copy</li>
                                            <li>Use the QR code for quick check-in at our kiosks</li>
                                        </ul>
                                    </div>
                                    
                                    <!-- Buttons -->
                                    <div class="space-y-4">
                                        <button id="download-badge" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                            Download Badge
                                        </button>
                                        <button id="print-badge" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-indigo-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                            </svg>
                                            Print Badge
                                        </button>
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

@endsection

@section('scripts')
<!-- Include QR Code Generator Library -->
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
<!-- Include html2canvas for badge screenshot -->
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.3.2/dist/html2canvas.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Generate QR Code
        const qrCodeData = JSON.stringify({
            memberId: {{ Auth::user()->id }},
            name: "{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}",
            timestamp: new Date().toISOString()
        });
        
        QRCode.toCanvas(document.getElementById('qrcode'), qrCodeData, {
            width: 120,
            margin: 1,
            color: {
                dark: '#000000',
                light: '#ffffff'
            }
        }, function(error) {
            if (error) console.error(error);
        });
        
        // Download Badge as Image
        document.getElementById('download-badge').addEventListener('click', function() {
            const badgeElement = document.getElementById('badge-card');
            
            html2canvas(badgeElement, {
                scale: 2, // Higher resolution
                logging: false,
                useCORS: true,
                allowTaint: true
            }).then(canvas => {
                // Create download link
                const link = document.createElement('a');
                link.download = 'gym-membership-badge.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        });
        
        // Print Badge
        document.getElementById('print-badge').addEventListener('click', function() {
            const printContent = document.getElementById('badge-card').outerHTML;
            const originalContent = document.body.innerHTML;
            
            // Create a print-friendly version
            const printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write(`
                <html>
                <head>
                    <title>Print Membership Badge</title>
                    <style>
                        body { margin: 0; padding: 20px; }
                        .print-container { width: 100%; max-width: 400px; margin: 0 auto; }
                    </style>
                </head>
                <body>
                    <div class="print-container">${printContent}</div>
                    <script>
                        window.onload = function() {
                            window.print();
                            window.close();
                        }
                    </script>
                </body>
                </html>
            `);
            printWindow.document.close();
        });
    });
</script>
@endsection
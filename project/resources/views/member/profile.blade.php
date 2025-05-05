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

                <!-- Success message for download - initially hidden -->
                <div id="download-success" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 hidden">
                    <div class="bg-green-50 border-l-4 border-green-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">Badge downloaded successfully!</p>
                            </div>
                        </div>
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
                                                <div id="qrcode-container" class="flex flex-col items-center">
                                                    <div id="qrcode" class="p-2 bg-white border border-gray-200 rounded-md flex items-center justify-center min-h-[140px] min-w-[140px]"></div>
                                                    <div id="qrcode-loading" class="mt-2">
                                                        <svg class="animate-spin h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                    </div>
                                                    <div id="qrcode-error" class="mt-2 text-sm text-red-600 hidden cursor-pointer">Error generating QR code. Click to retry.</div>
                                                </div>
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
                                            <span id="download-badge-text">Download Badge</span>
                                            <span id="download-badge-loading" class="hidden ml-2">
                                                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                            </span>
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
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log("Profile script loaded");
    
    // QR Code generation function with enhanced error handling
    function generateQRCode() {
        console.log("Starting QR code generation");
        
        const qrcodeContainer = document.getElementById('qrcode-container');
        const qrcodeElement = document.getElementById('qrcode');
        const qrcodeLoading = document.getElementById('qrcode-loading');
        const qrcodeError = document.getElementById('qrcode-error');
        
        // Clear any existing content in the QR code element
        if (qrcodeElement) {
            while (qrcodeElement.firstChild) {
                qrcodeElement.removeChild(qrcodeElement.firstChild);
            }
        } else {
            console.error("QR code element not found");
            if (qrcodeError) {
                qrcodeError.classList.remove('hidden');
                qrcodeError.textContent = "QR code element not found. Please refresh the page.";
            }
            return;
        }
        
        if (qrcodeLoading) {
            qrcodeLoading.classList.remove('hidden');
        }
        
        if (qrcodeError) {
            qrcodeError.classList.add('hidden');
        }
        
        try {
            // Create data for QR code with basic member info
            const memberId = {{ Auth::user()->id }};
            const memberName = "{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}";
            const timestamp = new Date().toISOString();
            
            // Create a simple identifier for the QR code
            // We're keeping this simple to ensure it works reliably
            const qrCodeData = JSON.stringify({
                id: memberId,
                name: memberName,
                time: timestamp
            });
            
            console.log("QR code data prepared:", qrCodeData.length, "characters");
            
            // First try with the toCanvas method
            try {
                QRCode.toCanvas(qrcodeElement, qrCodeData, {
                    width: 140, // Slightly smaller size to ensure it works
                    margin: 2,
                    color: {
                        dark: '#000000',
                        light: '#ffffff'
                    },
                    errorCorrectionLevel: 'M' // Medium error correction level
                }, function(error) {
                    if (qrcodeLoading) {
                        qrcodeLoading.classList.add('hidden');
                    }
                    
                    if (error) {
                        console.error("QR Code canvas generation error:", error);
                        // If canvas fails, try the toDataURL method as fallback
                        generateQRCodeFallback(qrcodeElement, qrCodeData, qrcodeError);
                    } else {
                        console.log("QR code generated successfully with canvas method");
                    }
                });
            } catch (canvasError) {
                console.error("Exception in QR canvas generation:", canvasError);
                // Try fallback if canvas method throws an exception
                generateQRCodeFallback(qrcodeElement, qrCodeData, qrcodeError);
            }
        } catch (error) {
            console.error("Error preparing QR code data:", error);
            if (qrcodeLoading) {
                qrcodeLoading.classList.add('hidden');
            }
            if (qrcodeError) {
                qrcodeError.classList.remove('hidden');
                qrcodeError.textContent = "Error generating QR code. Please refresh.";
            }
        }
    }

    // Fallback QR code generation using image method
    function generateQRCodeFallback(element, data, errorElement) {
        console.log("Trying QR code fallback method");
        try {
            // Try the simpler toDataURL method
            QRCode.toDataURL(data, { 
                errorCorrectionLevel: 'L',
                margin: 1,
                width: 140,
                color: {
                    dark: '#000000',
                    light: '#ffffff'
                }
            }, function(err, url) {
                const qrcodeLoading = document.getElementById('qrcode-loading');
                if (qrcodeLoading) {
                    qrcodeLoading.classList.add('hidden');
                }
                
                if (err) {
                    console.error("QR Code URL generation error:", err);
                    if (errorElement) {
                        errorElement.classList.remove('hidden');
                        errorElement.textContent = "Error generating QR code. Please refresh.";
                    }
                    return;
                }
                
                // Create an image element and set the QR code
                const img = document.createElement('img');
                img.src = url;
                img.alt = "Member QR Code";
                img.style.width = "140px";
                img.style.height = "140px";
                
                // Clear element and append the image
                while (element.firstChild) {
                    element.removeChild(element.firstChild);
                }
                element.appendChild(img);
                console.log("QR code generated successfully with image fallback method");
            });
        } catch (fallbackError) {
            console.error("QR Code fallback generation failed:", fallbackError);
            const qrcodeLoading = document.getElementById('qrcode-loading');
            if (qrcodeLoading) {
                qrcodeLoading.classList.add('hidden');
            }
            if (errorElement) {
                errorElement.classList.remove('hidden');
                errorElement.textContent = "Error generating QR code. Please refresh.";
            }
        }
    }
    
    function setupDownloadButton() {
        const downloadButton = document.getElementById('download-badge');
        if (!downloadButton) {
            console.error("Download button not found");
            return;
        }
        
        const downloadBadgeText = document.getElementById('download-badge-text');
        const downloadBadgeLoading = document.getElementById('download-badge-loading');
        const downloadSuccess = document.getElementById('download-success');
        
        downloadButton.addEventListener('click', function(e) {
            e.preventDefault();
            console.log("Download button clicked");
            
            // Show loading indicator
            downloadButton.disabled = true;
            if (downloadBadgeText) {
                downloadBadgeText.textContent = 'Generating Badge...';
            }
            if (downloadBadgeLoading) {
                downloadBadgeLoading.classList.remove('hidden');
            }
            
            const badgeElement = document.getElementById('badge-card');
            if (!badgeElement) {
                console.error("Badge element not found");
                alert("Error: Badge element not found");
                
                // Reset button state
                downloadButton.disabled = false;
                if (downloadBadgeText) {
                    downloadBadgeText.textContent = 'Download Badge';
                }
                if (downloadBadgeLoading) {
                    downloadBadgeLoading.classList.add('hidden');
                }
                return;
            }
            
            // Use a timeout to ensure the loading state shows
            setTimeout(function() {
                console.log("Starting html2canvas...");
                
                // Create an image with html2canvas
                html2canvas(badgeElement, {
                    scale: 2,
                    logging: true,
                    useCORS: true,
                    allowTaint: true,
                    backgroundColor: '#ffffff'
                }).then(function(canvas) {
                    console.log("Canvas generated successfully");
                    try {
                        // Convert canvas to blob for more reliable download
                        canvas.toBlob(function(blob) {
                            // Create object URL
                            const url = URL.createObjectURL(blob);
                            
                            // Create a download link and trigger it
                            const link = document.createElement('a');
                            link.download = 'gym-membership-badge-{{ Auth::user()->id }}.png';
                            link.href = url;
                            document.body.appendChild(link);
                            link.click();
                            
                            // Clean up
                            setTimeout(function() {
                                document.body.removeChild(link);
                                URL.revokeObjectURL(url);
                                
                                // Show success message
                                if (downloadSuccess) {
                                    downloadSuccess.classList.remove('hidden');
                                    setTimeout(function() {
                                        downloadSuccess.classList.add('hidden');
                                    }, 5000);
                                }
                                
                                // Reset button state
                                downloadButton.disabled = false;
                                if (downloadBadgeText) {
                                    downloadBadgeText.textContent = 'Download Badge';
                                }
                                if (downloadBadgeLoading) {
                                    downloadBadgeLoading.classList.add('hidden');
                                }
                            }, 100);
                        }, 'image/png');
                    } catch (error) {
                        console.error("Error creating download link:", error);
                        alert("Error downloading badge. Please try again.");
                        
                        // Reset button state
                        downloadButton.disabled = false;
                        if (downloadBadgeText) {
                            downloadBadgeText.textContent = 'Download Badge';
                        }
                        if (downloadBadgeLoading) {
                            downloadBadgeLoading.classList.add('hidden');
                        }
                    }
                }).catch(function(error) {
                    console.error("Error generating badge image:", error);
                    alert("Error generating badge image. Please try again.");
                    
                    // Reset button state
                    downloadButton.disabled = false;
                    if (downloadBadgeText) {
                        downloadBadgeText.textContent = 'Download Badge';
                    }
                    if (downloadBadgeLoading) {
                        downloadBadgeLoading.classList.add('hidden');
                    }
                });
            }, 100);
        });
    }
    
    function setupPrintButton() {
        const printButton = document.getElementById('print-badge');
        if (!printButton) {
            console.error("Print button not found");
            return;
        }
        
        printButton.addEventListener('click', function(e) {
            e.preventDefault();
            console.log("Print button clicked");
            
            const badgeElement = document.getElementById('badge-card');
            if (!badgeElement) {
                console.error("Badge element not found for printing");
                alert("Error: Badge element not found");
                return;
            }
            
            const printContent = badgeElement.outerHTML;
            
            // Simple approach - direct print
            try {
                const printWindow = window.open('', '_blank');
                if (!printWindow) {
                    alert("Please allow pop-ups for this site to print your badge.");
                    return;
                }
                
                printWindow.document.open();
                printWindow.document.write(`
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <title>Print Membership Badge</title>
                        <style>
                            body { margin: 0; padding: 20px; font-family: Arial, sans-serif; }
                            .print-container { width: 100%; max-width: 400px; margin: 0 auto; }
                            @media print {
                                body { margin: 0; padding: 0; }
                                .print-container { max-width: 100%; }
                            }
                        </style>
                    </head>
                    <body>
                        <div class="print-container">${printContent}</div>
                    </body>
                    </html>
                `);
                printWindow.document.close();
                
                // Add a delay to ensure the content is loaded
                setTimeout(function() {
                    try {
                        printWindow.print();
                        // Don't close the window immediately to allow printing
                    } catch(e) {
                        console.error("Print error:", e);
                        alert("Error printing. Please try again.");
                    }
                }, 1000);
            } catch(e) {
                console.error("Error opening print window:", e);
                alert("Error opening print window. Please check your browser settings and try again.");
            }
        });
    }
    
    // Initialize everything
    generateQRCode();
    setupDownloadButton();
    setupPrintButton();
    
    // Add a retry button functionality if needed
    const qrcodeError = document.getElementById('qrcode-error');
    if (qrcodeError) {
        qrcodeError.addEventListener('click', function() {
            console.log("Retry QR code generation requested");
            generateQRCode();
        });
    }
});
</script>
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Badge - {{ $user->firstname }} {{ $user->lastname }}</title>
    <!-- Use CDN links that are more reliable -->
    <script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dom-to-image@2.6.0/dist/dom-to-image.min.js"></script>
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
                background-color: white !important;
            }
            .no-print {
                display: none !important;
            }
            .badge-container {
                margin: 0 auto;
                box-shadow: none !important;
            }
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to bottom, #111827, #1f2937);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            color: #e5e7eb;
        }

        .badge-container {
            width: 380px;
            height: 580px;
            padding: 8px;
            border-radius: 12px;
            background: linear-gradient(to right, 
                {{ $experienceLevel['badge'] == 'gold' ? '#F59E0B, #D97706' : 
                   ($experienceLevel['badge'] == 'silver' ? '#9CA3AF, #6B7280' : 
                   ($experienceLevel['badge'] == 'bronze' ? '#92400E, #78350F' : '#4B5563, #374151')) }});
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
            border: 1px solid #4B5563;
        }

        .badge-inner {
            height: 100%;
            width: 100%;
            background-color: #111827;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 24px;
            box-sizing: border-box;
        }

        .badge-header {
            margin-bottom: 12px;
            font-size: 24px;
            font-weight: bold;
            background: linear-gradient(to right, #fb923c, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .badge-header span {
            -webkit-text-fill-color: white;
        }

        .qr-container {
            width: 180px;
            height: 180px;
            margin: 16px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 8px;
            background-color: white;
            border-radius: 8px;
        }

        .trainer-info {
            text-align: center;
            margin-top: 16px;
        }

        .trainer-name {
            font-size: 20px;
            font-weight: bold;
            color: #e5e7eb;
            margin-bottom: 8px;
        }

        .trainer-level {
            display: inline-block;
            padding: 4px 10px;
            background-color: #064e3b;
            color: #10b981;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .trainer-email {
            color: #9ca3af;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .specialties {
            margin-top: 16px;
        }

        .specialties-title {
            font-size: 12px;
            color: #9ca3af;
        }

        .specialties-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 6px;
            margin-top: 8px;
        }

        .specialty {
            background-color: #1f2937;
            color: #d1d5db;
            border-radius: 9999px;
            padding: 3px 10px;
            font-size: 11px;
            font-weight: 500;
        }

        .trainer-footer {
            margin-top: 20px;
            font-size: 11px;
            color: #9ca3af;
            text-align: center;
        }

        .button-container {
            margin-top: 32px;
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .btn {
            padding: 10px 20px;
            background-color: #16a34a;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
        }

        .btn:hover {
            background-color: #15803d;
            transform: translateY(-1px);
        }
        
        .brand-text {
            font-weight: bold;
            display: inline-block;
        }
        
        .brand-text-colored {
            background: linear-gradient(to right, #fb923c, #f97316);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body>
    <div class="badge-container" id="badge">
        <div class="badge-inner">
            <div class="badge-header">
                <span class="brand-text-colored">Train</span><span>Together</span>
            </div>
            
            <!-- QR code will be placed here -->
            <div class="qr-container" id="qrcode"></div>
            
            <div class="trainer-info">
                <div class="trainer-name">{{ $user->firstname }} {{ $user->lastname }}</div>
                <div class="trainer-level">{{ $experienceLevel['level'] }} Trainer</div>
                <div class="trainer-email">{{ $user->email }}</div>
                
                @if(count($specialties) > 0)
                <div class="specialties">
                    <div class="specialties-title">Specialties:</div>
                    <div class="specialties-container">
                        @foreach($specialties as $specialty)
                        <span class="specialty">{{ $specialty }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <div class="trainer-footer">
                    <p>Sessions Completed: {{ $totalSessions }}</p>
                    <p>Badge ID: TRN-{{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</p>
                    <p>Scan this QR code to verify trainer credentials.</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="button-container no-print">
        <button id="printButton" class="btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
            </svg>
            Print Badge
        </button>
        <button id="downloadButton" class="btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
            </svg>
            Download as Image
        </button>
        <a href="{{ route('trainer.profile') }}" class="btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Back to Profile
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Generate QR code using qrcode-generator library
            const qrData = @json($qrData);
            const qrContainer = document.getElementById('qrcode');
            
            // Using a more reliable QR code generator
            function generateQRCode() {
                // Convert JSON to string
                const data = JSON.stringify(qrData);
                
                // Create QR code (using qrcode-generator)
                const typeNumber = 0; // Auto-detect
                const errorCorrectionLevel = 'H';
                const qr = qrcode(typeNumber, errorCorrectionLevel);
                qr.addData(data);
                qr.make();
                
                // Create HTML for QR code
                const qrHtml = qr.createImgTag(5); // Cell size = 5
                qrContainer.innerHTML = qrHtml;
                
                // Style the generated image
                const qrImage = qrContainer.querySelector('img');
                if (qrImage) {
                    qrImage.style.width = '180px';
                    qrImage.style.height = '180px';
                    qrImage.style.display = 'block';
                    // Set QR code color to green
                    qrImage.style.filter = 'hue-rotate(100deg)'; // Apply a green hue
                }
            }
            
            // Generate the QR code
            generateQRCode();
            
            // Print button handler
            document.getElementById('printButton').addEventListener('click', function() {
                window.print();
            });
            
            // Download button handler using dom-to-image library
            document.getElementById('downloadButton').addEventListener('click', function() {
                const badge = document.getElementById('badge');
                
                // Show a loading state
                this.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Generating...';
                
                // Use dom-to-image instead of html2canvas
                domtoimage.toPng(badge, { 
                    quality: 0.95,
                    bgcolor: '#111827',
                    width: badge.offsetWidth,
                    height: badge.offsetHeight,
                    style: {
                        'border-radius': '12px',
                        'box-shadow': '0 10px 25px rgba(0, 0, 0, 0.5)'
                    }
                })
                .then(function(dataUrl) {
                    // Create a link and trigger download
                    const link = document.createElement('a');
                    link.download = 'trainer_badge_{{ $user->firstname }}_{{ $user->lastname }}.png';
                    link.href = dataUrl;
                    link.click();
                    
                    // Reset button text
                    document.getElementById('downloadButton').innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                        Download as Image`;
                })
                .catch(function(error) {
                    console.error('Error generating image:', error);
                    document.getElementById('downloadButton').textContent = 'Error: Try Again';
                });
            });
        });
    </script>
</body>
</html>
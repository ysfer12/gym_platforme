<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - TrainTogether</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Custom Tailwind Configuration -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        orange: {
                            50: '#fff8f1',
                            100: '#feecdc',
                            200: '#fcd9bd',
                            300: '#fdba8c',
                            400: '#ff8a4c',
                            500: '#ff5e14',
                            600: '#d03801',
                            700: '#b43403',
                            800: '#8a2c0d',
                            900: '#771d1d',
                        },
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.3s ease-in-out',
                        'slide-in-up': 'slideInUp 0.4s ease-in-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideInUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                    },
                },
            },
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Custom Styles -->
    <style>
        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #ff5e14;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #d03801;
        }
        
        /* Ensure main content has padding for fixed navbar */
        main {
        }
    </style>
    
    @yield('styles')
</head>
<body class="font-sans text-gray-900 antialiased">
    <!-- Navigation - Only show on public pages -->
    @if(!request()->is('dashboard*') && !request()->is('member*') && !request()->is('trainer*') && !request()->is('admin*') && !request()->is('receptionist*'))
        @include('layouts.navbar')
    @endif

    <!-- Main Content -->
    <main class="min-h-screen bg-gray-50 animate-fade-in">
        @yield('content')
    </main>

    <!-- Footer - Only show on public pages -->
    @if(!request()->is('dashboard*') && !request()->is('member*') && !request()->is('trainer*') && !request()->is('admin*') && !request()->is('receptionist*'))
        @include('layouts.footer')
    @endif

    <!-- Back to top button - Show on all pages -->
    <button id="back-to-top" class="fixed bottom-6 right-6 bg-orange-500 text-white rounded-full p-3 shadow-lg hidden hover:bg-orange-600 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11l7-7 7 7M5 19l7-7 7 7" />
        </svg>
    </button>

    <!-- Back to top script -->
    <script>
        // Get the button
        let backToTopButton = document.getElementById("back-to-top");

        // Show the button when user scrolls down 300px
        window.onscroll = function() {
            if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
                backToTopButton.classList.remove("hidden");
                backToTopButton.classList.add("flex");
            } else {
                backToTopButton.classList.remove("flex");
                backToTopButton.classList.add("hidden");
            }
        };

        // Scroll to the top when button is clicked
        backToTopButton.addEventListener("click", function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>
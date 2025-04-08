<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'City Club Gym') }}</title>

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
                        sans: ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Custom Styles -->
    <style>
        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Active navigation indicator */
        .nav-indicator {
            @apply absolute -bottom-px left-0 right-0 h-0.5 bg-orange-500 transition-all duration-300;
        }

        /* Button hover effect */
        .btn-hover-effect {
            @apply transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-md active:scale-95;
        }

        /* Form focus styles */
        input:focus, textarea:focus, select:focus {
            @apply outline-none ring-2 ring-orange-500 ring-opacity-50 border-orange-500;
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
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
<!-- Navigation - Only show on public pages, hide on dashboard and other authenticated sections -->
@if(!request()->is('dashboard*') && !request()->is('member*') && !request()->is('trainer*') && !request()->is('admin*') && !request()->is('receptionist*'))
    <nav class="bg-white shadow-sm" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo and Main Navigation -->
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-500 to-orange-600">
                                CityClub
                            </span>
                            <span class="ml-1 text-xl font-semibold text-gray-800">Fitness</span>
                        </a>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-6">
                        <a href="{{ route('home') }}" class="relative inline-flex items-center px-1 py-1 text-sm font-medium h-full {{ request()->routeIs('home') ? 'text-orange-600' : 'text-gray-500 hover:text-gray-900' }}">
                            Home
                            @if(request()->routeIs('home'))
                                <div class="nav-indicator"></div>
                            @endif
                        </a>

                        <a href="{{ route('about') }}" class="relative inline-flex items-center px-1 py-1 text-sm font-medium h-full {{ request()->routeIs('about') ? 'text-orange-600' : 'text-gray-500 hover:text-gray-900' }}">
                            About
                            @if(request()->routeIs('about'))
                                <div class="nav-indicator"></div>
                            @endif
                        </a>

                        <a href="{{ route('subscriptions') }}" class="relative inline-flex items-center px-1 py-1 text-sm font-medium h-full {{ request()->routeIs('subscriptions') ? 'text-orange-600' : 'text-gray-500 hover:text-gray-900' }}">
                            Subscriptions
                            @if(request()->routeIs('subscriptions'))
                                <div class="nav-indicator"></div>
                            @endif
                        </a>

                        <a href="{{ route('sessions') }}" class="relative inline-flex items-center px-1 py-1 text-sm font-medium h-full {{ request()->routeIs('sessions') ? 'text-orange-600' : 'text-gray-500 hover:text-gray-900' }}">
                            Sessions
                            @if(request()->routeIs('sessions'))
                                <div class="nav-indicator"></div>
                            @endif
                        </a>

                        <a href="{{ route('trainers') }}" class="relative inline-flex items-center px-1 py-1 text-sm font-medium h-full {{ request()->routeIs('trainers') ? 'text-orange-600' : 'text-gray-500 hover:text-gray-900' }}">
                            Trainers
                            @if(request()->routeIs('trainers'))
                                <div class="nav-indicator"></div>
                            @endif
                        </a>

                        <a href="{{ route('contact') }}" class="relative inline-flex items-center px-1 py-1 text-sm font-medium h-full {{ request()->routeIs('contact') ? 'text-orange-600' : 'text-gray-500 hover:text-gray-900' }}">
                            Contact
                            @if(request()->routeIs('contact'))
                                <div class="nav-indicator"></div>
                            @endif
                        </a>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    @guest
                        <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-orange-600 bg-orange-50 hover:bg-orange-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 mr-2 btn-hover-effect">
                            Sign in
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 btn-hover-effect">
                            Sign up
                        </a>
                    @else
                        <!-- Profile dropdown -->
                        <div class="ml-3 relative" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" type="button" class="max-w-xs bg-white rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-150" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 flex items-center justify-center text-white">
                                        {{ substr(Auth::user()->firstname, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}
                                    </div>
                                </button>
                            </div>

                            <!-- Dropdown menu -->
                            <div x-show="open"
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                 role="menu"
                                 aria-orientation="vertical"
                                 aria-labelledby="user-menu-button"
                                 tabindex="-1"
                                 style="display: none;">
                                <!-- Active: "bg-gray-100", Not Active: "" -->
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
                                    Dashboard
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Mobile menu button -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Icon when menu is closed -->
                        <svg x-show="!open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke  aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Icon when menu is open -->
                        <svg x-show="open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div x-show="open" class="sm:hidden" id="mobile-menu" style="display: none;">
            <div class="pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('home') ? 'border-orange-500 text-orange-700 bg-orange-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} text-base font-medium">
                    Home
                </a>
                <a href="{{ route('about') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('about') ? 'border-orange-500 text-orange-700 bg-orange-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} text-base font-medium">
                    About
                </a>
                <a href="{{ route('subscriptions') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('subscriptions') ? 'border-orange-500 text-orange-700 bg-orange-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} text-base font-medium">
                    Subscriptions
                </a>
                <a href="{{ route('sessions') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('sessions') ? 'border-orange-500 text-orange-700 bg-orange-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} text-base font-medium">
                    Sessions
                </a>
                <a href="{{ route('trainers') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('trainers') ? 'border-orange-500 text-orange-700 bg-orange-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} text-base font-medium">
                    Trainers
                </a>
                <a href="{{ route('contact') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('contact') ? 'border-orange-500 text-orange-700 bg-orange-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} text-base font-medium">
                    Contact
                </a>
            </div>

            <!-- Mobile menu authentication links -->
            <div class="pt-4 pb-3 border-t border-gray-200">
                @guest
                    <div class="mt-3 space-y-1 px-2">
                        <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                            Sign in
                        </a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                            Sign up
                        </a>
                    </div>
                @else
                    <div class="flex items-center px-4">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 flex items-center justify-center text-white">
                                {{ substr(Auth::user()->firstname, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-gray-800">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</div>
                            <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <div class="mt-3 space-y-1 px-2">
                        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                                Sign out
                            </button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </nav>
@endif

<!-- Main Content -->
<main class="min-h-screen animate-fade-in">
    @yield('content')
</main>

<!-- Footer - Only show on public pages -->
@if(!request()->is('dashboard*') && !request()->is('member*') && !request()->is('trainer*') && !request()->is('admin*') && !request()->is('receptionist*'))
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Brand Info -->
                <div class="col-span-1 md:col-span-1">
                    <div class="flex items-center">
                        <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-400 to-orange-300">
                            CityClub
                        </span>
                        <span class="ml-1 text-xl font-semibold text-gray-300">Fitness</span>
                    </div>
                    <p class="mt-3 text-gray-400 text-sm">
                        Your premier fitness destination. We help you achieve your fitness goals with state-of-the-art equipment and expert trainers.
                    </p>
                    <div class="mt-4 flex space-x-5">
                        <a href="#" class="text-gray-400 hover:text-orange-400 transition-colors duration-300">
                            <span class="sr-only">Facebook</span>
                            <i class='bx bxl-facebook text-xl'></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-orange-400 transition-colors duration-300">
                            <span class="sr-only">Instagram</span>
                            <i class='bx bxl-instagram text-xl'></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-orange-400 transition-colors duration-300">
                            <span class="sr-only">Twitter</span>
                            <i class='bx bxl-twitter text-xl'></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-orange-400 transition-colors duration-300">
                            <span class="sr-only">YouTube</span>
                            <i class='bx bxl-youtube text-xl'></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-span-1">
                    <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase">Quick Links</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-orange-400 transition-colors duration-300 text-sm">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-orange-400 transition-colors duration-300 text-sm">About</a></li>
                        <li><a href="{{ route('subscriptions') }}" class="text-gray-400 hover:text-orange-400 transition-colors duration-300 text-sm">Subscriptions</a></li>
                        <li><a href="{{ route('sessions') }}" class="text-gray-400 hover:text-orange-400 transition-colors duration-300 text-sm">Sessions</a></li>
                        <li><a href="{{ route('trainers') }}" class="text-gray-400 hover:text-orange-400 transition-colors duration-300 text-sm">Trainers</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-orange-400 transition-colors duration-300 text-sm">Contact</a></li>
                    </ul>
                </div>

                <!-- Business Hours -->
                <div class="col-span-1">
                    <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase">Opening Hours</h3>
                    <ul class="mt-4 space-y-2">
                        <li class="text-gray-400 text-sm flex items-center">
                            <i class='bx bx-time text-orange-400 mr-2'></i>
                            Monday - Friday: 6:00 AM - 10:00 PM
                        </li>
                        <li class="text-gray-400 text-sm flex items-center">
                            <i class='bx bx-time text-orange-400 mr-2'></i>
                            Saturday: 7:00 AM - 8:00 PM
                        </li>
                        <li class="text-gray-400 text-sm flex items-center">
                            <i class='bx bx-time text-orange-400 mr-2'></i>
                            Sunday: 8:00 AM - 6:00 PM
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-span-1">
                    <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase">Contact Info</h3>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-start">
                            <i class='bx bx-map text-orange-400 mr-2 mt-0.5'></i>
                            <span class="text-gray-400 text-sm">123 Fitness Avenue, Gym City, GC 12345</span>
                        </li>
                        <li class="flex items-start">
                            <i class='bx bx-phone text-orange-400 mr-2 mt-0.5'></i>
                            <span class="text-gray-400 text-sm">+1 (123) 456-7890</span>
                        </li>
                        <li class="flex items-start">
                            <i class='bx bx-envelope text-orange-400 mr-2 mt-0.5'></i>
                            <span class="text-gray-400 text-sm">info@cityclubfitness.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="mt-8 pt-8 border-t border-gray-800">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-400">
                        &copy; {{ date('Y') }} City Club Fitness. All rights reserved.
                    </p>
                    <div class="mt-4 md:mt-0 flex space-x-6">
                        <a href="#" class="text-sm text-gray-400 hover:text-orange-400 transition-colors duration-300">Privacy Policy</a>
                        <a href="#" class="text-sm text-gray-400 hover:text-orange-400 transition-colors duration-300">Terms of Service</a>
                        <a href="#" class="text-sm text-gray-400 hover:text-orange-400 transition-colors duration-300">Cookie Policy</a>
                    </div>
                </div>
                <p class="mt-4 text-xs text-center text-gray-500">
                    Designed with ❤️ for fitness enthusiasts everywhere
                </p>
            </div>
        </div>
    </footer>
@endif

<!-- Back to top button - Show on all pages -->
<button id="back-to-top" class="fixed bottom-6 right-6 bg-orange-500 text-white rounded-full p-2 shadow-lg hidden hover:bg-orange-600 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 z-50">
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
</body>
</html>


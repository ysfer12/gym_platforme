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
                        primary: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
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

    <!-- Custom Styles -->
    <style>
        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
        
        /* Active navigation indicator */
        .nav-indicator {
            @apply absolute -bottom-px left-0 right-0 h-0.5 bg-indigo-500 transition-all duration-300;
        }
        
        /* Button hover effect */
        .btn-hover-effect {
            @apply transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-md active:scale-95;
        }
        
        /* Form focus styles */
        input:focus, textarea:focus, select:focus {
            @apply outline-none ring-2 ring-indigo-500 ring-opacity-50 border-indigo-500;
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
                            <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-blue-500">
                                CityClub
                            </span>
                            <span class="ml-1 text-xl font-semibold text-gray-800">Gym</span>
                        </a>
                    </div>
                    
                    <!-- Desktop Navigation -->
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-6">
                        <a href="{{ route('home') }}" class="relative inline-flex items-center px-1 py-1 text-sm font-medium h-full {{ request()->routeIs('home') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-900' }}">
                            Home
                            @if(request()->routeIs('home'))
                                <div class="nav-indicator"></div>
                            @endif
                        </a>
                        
                        <a href="{{ route('about') }}" class="relative inline-flex items-center px-1 py-1 text-sm font-medium h-full {{ request()->routeIs('about') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-900' }}">
                            About
                            @if(request()->routeIs('about'))
                                <div class="nav-indicator"></div>
                            @endif
                        </a>
                        
                        <a href="{{ route('subscriptions') }}" class="relative inline-flex items-center px-1 py-1 text-sm font-medium h-full {{ request()->routeIs('subscriptions') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-900' }}">
                            Subscriptions
                            @if(request()->routeIs('subscriptions'))
                                <div class="nav-indicator"></div>
                            @endif
                        </a>
                        
                        <a href="{{ route('sessions') }}" class="relative inline-flex items-center px-1 py-1 text-sm font-medium h-full {{ request()->routeIs('sessions') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-900' }}">
                            Sessions
                            @if(request()->routeIs('sessions'))
                                <div class="nav-indicator"></div>
                            @endif
                        </a>
                        
                        <a href="{{ route('trainers') }}" class="relative inline-flex items-center px-1 py-1 text-sm font-medium h-full {{ request()->routeIs('trainers') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-900' }}">
                            Trainers
                            @if(request()->routeIs('trainers'))
                                <div class="nav-indicator"></div>
                            @endif
                        </a>
                        
                        <a href="{{ route('contact') }}" class="relative inline-flex items-center px-1 py-1 text-sm font-medium h-full {{ request()->routeIs('contact') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-900' }}">
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
                        <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-indigo-600 bg-indigo-50 hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2 btn-hover-effect">
                            Sign in
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-indigo-600 to-blue-500 hover:from-indigo-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 btn-hover-effect">
                            Sign up
                        </a>
                    @else
                        <!-- Profile dropdown -->
                        <div class="ml-3 relative" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" type="button" class="max-w-xs bg-white rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-150" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <div class="h-8 w-8 rounded-full bg-gradient-to-r from-indigo-500 to-blue-500 flex items-center justify-center text-white">
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
                    <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Icon when menu is closed -->
                        <svg x-show="!open" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
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
                <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('home') ? 'border-indigo-500 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} text-base font-medium">
                    Home
                </a>
                <a href="{{ route('about') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('about') ? 'border-indigo-500 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} text-base font-medium">
                    About
                </a>
                <a href="{{ route('subscriptions') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('subscriptions') ? 'border-indigo-500 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} text-base font-medium">
                    Subscriptions
                </a>
                <a href="{{ route('sessions') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('sessions') ? 'border-indigo-500 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} text-base font-medium">
                    Sessions
                </a>
                <a href="{{ route('trainers') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('trainers') ? 'border-indigo-500 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} text-base font-medium">
                    Trainers
                </a>
                <a href="{{ route('contact') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('contact') ? 'border-indigo-500 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} text-base font-medium">
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
                            <div class="h-10 w-10 rounded-full bg-gradient-to-r from-indigo-500 to-blue-500 flex items-center justify-center text-white">
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
                        <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-blue-300">
                            CityClub
                        </span>
                        <span class="ml-1 text-xl font-semibold text-gray-300">Gym</span>
                    </div>
                    <p class="mt-3 text-gray-400 text-sm">
                        Your premier fitness destination. We help you achieve your fitness goals with state-of-the-art equipment and expert trainers.
                    </p>
                    <div class="mt-4 flex space-x-5">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-span-1">
                    <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase">Quick Links</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white text-sm">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white text-sm">About</a></li>
                        <li><a href="{{ route('subscriptions') }}" class="text-gray-400 hover:text-white text-sm">Subscriptions</a></li>
                        <li><a href="{{ route('sessions') }}" class="text-gray-400 hover:text-white text-sm">Sessions</a></li>
                        <li><a href="{{ route('trainers') }}" class="text-gray-400 hover:text-white text-sm">Trainers</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white text-sm">Contact</a></li>
                    </ul>
                </div>

                <!-- Business Hours -->
                <div class="col-span-1">
                    <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase">Opening Hours</h3>
                    <ul class="mt-4 space-y-2">
                        <li class="text-gray-400 text-sm">Monday - Friday: 6:00 AM - 10:00 PM</li>
                        <li class="text-gray-400 text-sm">Saturday: 7:00 AM - 8:00 PM</li>
                        <li class="text-gray-400 text-sm">Sunday: 8:00 AM - 6:00 PM</li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-span-1">
                    <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase">Contact Info</h3>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-gray-400 text-sm">123 Fitness Avenue, Gym City, GC 12345</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="text-gray-400 text-sm">+1 (123) 456-7890</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-400 text-sm">info@fittrackgym.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="mt-8 pt-8 border-t border-gray-800">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-400">
                        &copy; {{ date('Y') }} FitTrack Gym. All rights reserved.
                    </p>
                    <div class="mt-4 md:mt-0 flex space-x-6">
                        <a href="#" class="text-sm text-gray-400 hover:text-gray-300">Privacy Policy</a>
                        <a href="#" class="text-sm text-gray-400 hover:text-gray-300">Terms of Service</a>
                        <a href="#" class="text-sm text-gray-400 hover:text-gray-300">Cookie Policy</a>
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
    <button id="back-to-top" class="fixed bottom-6 right-6 bg-indigo-600 text-white rounded-full p-2 shadow-lg hidden hover:bg-indigo-700 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
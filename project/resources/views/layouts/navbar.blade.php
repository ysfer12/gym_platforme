<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
        <div class="flex">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900 flex items-center">
                    <span class="text-orange-500 mr-1">City</span>
                    <span class="text-orange-600">Club</span>
                    <span class="ml-1 text-gray-700">Fitness</span>
                </a>
            </div>

            <!-- Navigation Links (Desktop) -->
            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'border-orange-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                    Home
                </a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'border-orange-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                    About
                </a>
                <a href="{{ route('subscriptions') }}" class="{{ request()->routeIs('subscriptions') ? 'border-orange-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                    Subscriptions
                </a>
                <a href="{{ route('sessions') }}" class="{{ request()->routeIs('sessions') ? 'border-orange-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                    Sessions
                </a>
                <a href="{{ route('trainers') }}" class="{{ request()->routeIs('trainers') ? 'border-orange-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                    Trainers
                </a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'border-orange-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                    Contact
                </a>
            </div>
        </div>

        <!-- Login/Register Buttons -->
        <div class="hidden sm:ml-6 sm:flex sm:items-center">
            <a href="#" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium">
                Login
            </a>
            <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md text-sm font-medium ml-3 transition-all duration-300">
                Register
            </a>
        </div>

        <!-- Mobile menu button -->
        <div class="flex items-center sm:hidden">
            <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500" aria-controls="mobile-menu" aria-expanded="false" x-on:click="mobileMenuOpen = !mobileMenuOpen">
                <span class="sr-only">Open main menu</span>
                <!-- Menu open: "hidden", Menu closed: "block" -->
                <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <!-- Menu open: "block", Menu closed: "hidden" -->
                <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>

<!-- Mobile menu, show/hide based on menu state. -->
<div class="sm:hidden" id="mobile-menu" x-data="{ mobileMenuOpen: false }" x-show="mobileMenuOpen" x-cloak>
    <div class="pt-2 pb-3 space-y-1">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-orange-50 border-orange-500 text-orange-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
            Home
        </a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'bg-orange-50 border-orange-500 text-orange-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
            About
        </a>
        <a href="{{ route('subscriptions') }}" class="{{ request()->routeIs('subscriptions') ? 'bg-orange-50 border-orange-500 text-orange-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
            Subscriptions
        </a>
        <a href="{{ route('sessions') }}" class="{{ request()->routeIs('sessions') ? 'bg-orange-50 border-orange-500 text-orange-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
            Sessions
        </a>
        <a href="{{ route('trainers') }}" class="{{ request()->routeIs('trainers') ? 'bg-orange-50 border-orange-500 text-orange-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
            Trainers
        </a>
        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'bg-orange-50 border-orange-500 text-orange-700' : 'border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
            Contact
        </a>
    </div>
    <div class="pt-4 pb-3 border-t border-gray-200">
        <div class="flex space-x-3 px-4">
            <a href="#" class="block text-sm font-medium text-gray-500 hover:text-gray-700">Login</a>
            <a href="#" class="block text-sm font-medium text-orange-600 hover:text-orange-700">Register</a>
        </div>
    </div>
</div>


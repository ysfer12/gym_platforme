<nav class="bg-white shadow-md fixed w-full z-50" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="text-2xl font-bold">
                            <span class="text-orange-500">Train</span><span class="text-gray-800">Together</span>
                        </span>
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden sm:ml-10 sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'border-orange-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium h-20">
                        Home
                    </a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'border-orange-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium h-20">
                        About
                    </a>
                    <a href="{{ route('subscriptions') }}" class="{{ request()->routeIs('subscriptions') ? 'border-orange-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium h-20">
                        Memberships
                    </a>
                    <a href="{{ route('sessions') }}" class="{{ request()->routeIs('sessions') ? 'border-orange-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium h-20">
                        Classes
                    </a>
                    <a href="{{ route('trainers') }}" class="{{ request()->routeIs('trainers') ? 'border-orange-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium h-20">
                        Trainers
                    </a>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'border-orange-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium h-20">
                        Contact
                    </a>
                </div>
            </div>

            <!-- Login/Register Buttons -->
            <div class="hidden sm:ml-6 sm:flex sm:items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-900 font-medium text-sm transition-colors duration-300">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2.5 rounded-full text-sm font-medium shadow-md transition-all duration-300">
                        Join Now
                    </a>
                @else
                    <!-- Profile dropdown -->
                    <div class="ml-3 relative" x-data="{ open: false }">
                        <div>
                            <button @click="open = !open" type="button" class="max-w-xs bg-white rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-all duration-150" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <div class="h-9 w-9 rounded-full bg-orange-500 flex items-center justify-center text-white">
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
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                Dashboard
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                My Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon when menu is closed -->
                    <svg x-show="!mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <!-- Icon when menu is open -->
                    <svg x-show="mobileMenuOpen" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileMenuOpen" class="sm:hidden shadow-lg" id="mobile-menu" style="display: none;">
        <div class="pt-2 pb-3 space-y-1 bg-white">
            <a href="{{ route('home') }}" class="block pl-3 pr-4 py-3 {{ request()->routeIs('home') ? 'border-l-4 border-orange-500 text-orange-700 bg-orange-50 font-medium' : 'border-l-4 border-transparent text-gray-500 hover:bg-gray-50 hover:text-gray-900' }} text-base">
                Home
            </a>
            <a href="{{ route('about') }}" class="block pl-3 pr-4 py-3 {{ request()->routeIs('about') ? 'border-l-4 border-orange-500 text-orange-700 bg-orange-50 font-medium' : 'border-l-4 border-transparent text-gray-500 hover:bg-gray-50 hover:text-gray-900' }} text-base">
                About
            </a>
            <a href="{{ route('subscriptions') }}" class="block pl-3 pr-4 py-3 {{ request()->routeIs('subscriptions') ? 'border-l-4 border-orange-500 text-orange-700 bg-orange-50 font-medium' : 'border-l-4 border-transparent text-gray-500 hover:bg-gray-50 hover:text-gray-900' }} text-base">
                Memberships
            </a>
            <a href="{{ route('sessions') }}" class="block pl-3 pr-4 py-3 {{ request()->routeIs('sessions') ? 'border-l-4 border-orange-500 text-orange-700 bg-orange-50 font-medium' : 'border-l-4 border-transparent text-gray-500 hover:bg-gray-50 hover:text-gray-900' }} text-base">
                Classes
            </a>
            <a href="{{ route('trainers') }}" class="block pl-3 pr-4 py-3 {{ request()->routeIs('trainers') ? 'border-l-4 border-orange-500 text-orange-700 bg-orange-50 font-medium' : 'border-l-4 border-transparent text-gray-500 hover:bg-gray-50 hover:text-gray-900' }} text-base">
                Trainers
            </a>
            <a href="{{ route('contact') }}" class="block pl-3 pr-4 py-3 {{ request()->routeIs('contact') ? 'border-l-4 border-orange-500 text-orange-700 bg-orange-50 font-medium' : 'border-l-4 border-transparent text-gray-500 hover:bg-gray-50 hover:text-gray-900' }} text-base">
                Contact
            </a>
        </div>
        
        <!-- Mobile menu auth links -->
        <div class="pt-4 pb-5 border-t border-gray-200 bg-white">
            @guest
                <div class="flex items-center justify-around">
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 text-base font-medium">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-full text-base font-medium">
                        Join Now
                    </a>
                </div>
            @else
                <div class="flex items-center px-4 mb-4">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 rounded-full bg-orange-500 flex items-center justify-center text-white">
                            {{ substr(Auth::user()->firstname, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}
                        </div>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="space-y-1 px-4">
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                        Dashboard
                    </a>
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">
                        My Profile
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
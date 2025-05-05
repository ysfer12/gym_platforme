<!-- Member Sidebar: resources/views/partials/member-sidebar.blade.php -->
<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 border-r border-gray-700 bg-gradient-to-b from-gray-900 to-gray-800 shadow-xl">
        <!-- Header and Logo Section -->
        <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
            <div class="flex items-center flex-shrink-0 px-4 mb-4">
                <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-400 to-orange-500">
                    Train<span class="text-white">Together</span>
                </span>
                <span class="ml-2 px-2 py-1 text-xs font-bold bg-orange-500 text-white rounded shadow-sm">MEMBER</span>
            </div>
            
            <!-- Member Profile Card -->
            <div class="mx-4 p-3 bg-gray-800 rounded-lg border border-gray-700 shadow-inner">
                <div class="flex items-center">
                    <div class="h-12 w-12 rounded-full bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center text-white font-bold text-lg shadow-md">
                        {{ substr(Auth::user()->firstname, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
                        <p class="text-xs text-gray-400">Premium Member</p>
                    </div>
                </div>
                
                <!-- Member Quick Stats -->
                <div class="grid grid-cols-2 gap-2 mt-4">
                    <div class="bg-gray-700 bg-opacity-50 rounded-md p-2 text-center shadow-inner">
                        <div class="text-orange-400 text-sm font-semibold">12</div>
                        <div class="text-gray-300 text-xs">Total Sessions</div>
                    </div>
                    <div class="bg-gray-700 bg-opacity-50 rounded-md p-2 text-center shadow-inner">
                        <div class="text-orange-400 text-sm font-semibold">85%</div>
                        <div class="text-gray-300 text-xs">Attendance Rate</div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Menu -->
            <div class="mt-6 flex-grow flex flex-col">
                <!-- Navigation Header -->
                <div class="px-4 mb-2">
                    <h3 class="text-xs font-semibold text-orange-500 uppercase tracking-wider">
                        MEMBER PORTAL
                    </h3>
                </div>
                
                <nav class="flex-1 px-2 space-y-1" aria-label="Sidebar">
                    <!-- Dashboard Link -->
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('dashboard') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="2" y="3" width="7" height="9" rx="1" fill="currentColor" opacity="0.3"/>
                            <rect x="15" y="3" width="7" height="5" rx="1" fill="currentColor" opacity="0.3"/>
                            <rect x="2" y="15" width="7" height="6" rx="1" fill="currentColor" opacity="0.3"/>
                            <rect x="15" y="12" width="7" height="9" rx="1" fill="currentColor" opacity="0.3"/>
                        </svg>
                        Dashboard
                    </a>

                    <!-- Sessions Link -->
                    <a href="{{ route('member.sessions') }}" class="{{ request()->routeIs('member.sessions') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('member.sessions') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Fitness Sessions
                    </a>

                    <!-- Subscription Link -->
                    <a href="{{ route('member.subscription') }}" class="{{ request()->routeIs('member.subscription') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('member.subscription') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        Membership
                    </a>

                    <!-- Attendance Link -->
                    <a href="{{ route('member.attendance') }}" class="{{ request()->routeIs('member.attendance') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('member.attendance') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Gym Attendance
                    </a>

                    <!-- Profile Link -->
                    <a href="{{ route('member.profile') }}" class="{{ request()->routeIs('member.profile') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('member.profile') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profile & Badge
                    </a>

                    <!-- Divider -->
                    <div class="border-t border-gray-700 my-3"></div>

                    <!-- Progress Section -->
                    <div class="px-3 py-3 rounded-md bg-gray-700 bg-opacity-30 mt-2">
                        <h3 class="text-sm font-semibold text-white mb-2">Your Progress</h3>
                        <div class="mb-2">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs text-gray-300">Monthly Goal</span>
                                <span class="text-xs text-orange-400">75%</span>
                            </div>
                            <div class="w-full bg-gray-600 rounded-full h-2">
                                <div class="bg-gradient-to-r from-orange-500 to-red-500 h-2 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                        <a href="{{ route('member.profile') }}" class="flex items-center justify-center py-2 px-3 bg-orange-600 hover:bg-orange-700 text-white text-xs font-medium rounded-md transition-all duration-200 shadow-sm">
                            View Full Progress
                        </a>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Footer with Logout -->
        <div class="flex-shrink-0 flex p-4 border-t border-gray-700">
            <div class="flex-shrink-0 w-full group block">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-2 text-sm text-gray-300 rounded-md hover:bg-gray-700 hover:text-white transition-all duration-200 group">
                        <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Mobile sidebar menu button -->
<div class="md:hidden fixed z-20 top-4 left-4">
    <button type="button" id="open-sidebar" class="bg-gray-800 p-2 rounded-md text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500 shadow-lg" aria-controls="mobile-menu" aria-expanded="false">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>
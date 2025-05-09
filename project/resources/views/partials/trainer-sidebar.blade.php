<!-- Trainer Sidebar Partial: resources/views/partials/trainer-sidebar.blade.php -->
<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 border-r border-gray-200 bg-gradient-to-b from-gray-900 to-gray-800">
        <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
            <div class="flex items-center flex-shrink-0 px-4">
                <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-400 to-orange-500">
                    Train<span class="text-white">Together</span>
                </span>
                <span class="ml-2 px-2 py-1 text-xs font-bold bg-green-500 text-white rounded">TRAINER</span>
            </div>
            
            <!-- Trainer Avatar and Quick Stats -->
            <div class="mt-6 px-4">
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center text-white">
                        {{ substr(Auth::user()->firstname, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
                        <p class="text-xs text-gray-400">Fitness Trainer</p>
                    </div>
                </div>
                
                <!-- Quick Stats Bar -->
                <div class="grid grid-cols-2 gap-2 mt-4">
                    <div class="bg-gray-700 bg-opacity-50 rounded p-2 text-center">
                        <div class="text-white text-sm font-semibold">{{ number_format(24) }}</div>
                        <div class="text-gray-400 text-xs">Sessions</div>
                    </div>
                    <div class="bg-gray-700 bg-opacity-50 rounded p-2 text-center">
                        <div class="text-white text-sm font-semibold">{{ number_format(32) }}</div>
                        <div class="text-gray-400 text-xs">Members</div>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex-grow flex flex-col">
                <!-- Navigation Header -->
                <div class="px-4 mb-2">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                        MANAGEMENT
                    </h3>
                </div>
                
                <nav class="flex-1 px-2 space-y-1 bg-transparent" aria-label="Sidebar">
                    <!-- Dashboard Link -->
                    <a href="{{ route('trainer.dashboard') }}" class="{{ request()->routeIs('trainer.dashboard') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('trainer.dashboard') ? 'text-green-300' : 'text-gray-400 group-hover:text-gray-300' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5z" fill="currentColor" opacity="0.3"/>
                            <path d="M14 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5z" fill="currentColor" opacity="0.3"/>
                            <path d="M4 15a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-4z" fill="currentColor" opacity="0.3"/>
                            <path d="M14 13a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-6z" fill="currentColor" opacity="0.3"/>
                        </svg>
                        Dashboard
                    </a>
                    
                    <!-- Sessions Link -->
                    <a href="{{ route('trainer.sessions.index') }}" class="{{ request()->routeIs('trainer.sessions*') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('trainer.sessions*') ? 'text-green-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Sessions
                    </a>
                    
                    <!-- Schedule Link -->
                    <a href="{{ route('trainer.schedule.index') }}" class="{{ request()->routeIs('trainer.schedule*') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('trainer.schedule*') ? 'text-green-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Schedule
                    </a>
                    
                    <!-- Members Link -->
                    <a href="{{ route('trainer.members') }}" class="{{ request()->routeIs('trainer.members*') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('trainer.members*') ? 'text-green-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Members
                    </a>
                    
                    <!-- Profile Link -->
                    <a href="{{ route('trainer.profile') }}" class="{{ request()->routeIs('trainer.profile*') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('trainer.profile*') ? 'text-green-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profile
                    </a>
                    
                    <!-- Reports Section Heading -->
                    <div class="px-2 mt-5 mb-2">
                        <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            ANALYTICS
                        </h3>
                    </div>
                    
                    <!-- Trainer Reports -->
                    <a href="#" class="{{ request()->routeIs('trainer.analytics*') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('trainer.analytics*') ? 'text-green-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        Performance Analytics
                    </a>
                </nav>
            </div>
        </div>
        <div class="flex-shrink-0 flex p-4 border-t border-gray-700">
            <div class="flex-shrink-0 w-full group block">
                <div class="flex items-center">
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-2 text-sm text-gray-300 rounded-md hover:bg-gray-700 hover:text-white transition-all duration-200">
                            <svg class="mr-3 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile sidebar menu button -->
<div class="md:hidden fixed z-20 top-4 left-4">
    <button type="button" id="open-sidebar" class="bg-gray-800 p-2 rounded-md text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500" aria-controls="mobile-menu" aria-expanded="false">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

@include('partials.trainer-mobile-menu')
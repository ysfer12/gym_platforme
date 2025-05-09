<!-- Receptionist Sidebar Partial: resources/views/partials/receptionist-sidebar.blade.php -->
<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 border-r border-gray-200 bg-gradient-to-b from-gray-900 to-gray-800">
        <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
            <div class="flex items-center flex-shrink-0 px-4">
                <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-500">
                    Train<span class="text-white">Together</span>
                </span>
                <span class="ml-2 px-2 py-1 text-xs font-bold bg-blue-500 text-white rounded">STAFF</span>
            </div>
            
            <!-- Receptionist Avatar and Quick Stats -->
            <div class="mt-6 px-4">
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white">
                        {{ substr(Auth::user()->firstname, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
                        <p class="text-xs text-gray-400">Receptionist</p>
                    </div>
                </div>
                
                <!-- Quick Stats Bar -->
                <div class="grid grid-cols-2 gap-2 mt-4">
                    <div class="bg-gray-700 bg-opacity-50 rounded p-2 text-center">
                        <div class="text-white text-sm font-semibold">{{ number_format(156) }}</div>
                        <div class="text-gray-400 text-xs">Members</div>
                    </div>
                    <div class="bg-gray-700 bg-opacity-50 rounded p-2 text-center">
                        <div class="text-white text-sm font-semibold">12</div>
                        <div class="text-gray-400 text-xs">Today's Sessions</div>
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
                    <!-- Dashboard Link with Enhanced Icon -->
                    <a href="{{ route('receptionist.dashboard') }}" class="{{ request()->routeIs('receptionist.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('receptionist.dashboard') ? 'text-blue-300' : 'text-gray-400 group-hover:text-gray-300' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5z" fill="currentColor" opacity="0.3"/>
                            <path d="M14 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5z" fill="currentColor" opacity="0.3"/>
                            <path d="M4 15a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-4z" fill="currentColor" opacity="0.3"/>
                            <path d="M14 13a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-6z" fill="currentColor" opacity="0.3"/>
                        </svg>
                        Dashboard
                    </a>

                    <!-- Members Link with Enhanced Icon -->
                    <a href="{{ route('receptionist.members') }}" class="{{ request()->routeIs('receptionist.members') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('receptionist.members') ? 'text-blue-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Members
                    </a>

                    <!-- Sessions Link with Enhanced Icon -->
                    <a href="{{ route('receptionist.sessions.index') }}" class="{{ request()->routeIs('receptionist.sessions*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('receptionist.sessions*') ? 'text-blue-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Sessions
                    </a>

                    <!-- Subscriptions Link with Enhanced Icon -->
                    <a href="{{ route('receptionist.subscriptions.index') }}" class="{{ request()->routeIs('receptionist.subscriptions*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('receptionist.subscriptions*') ? 'text-blue-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        Subscriptions
                    </a>

                    <!-- Payments Link with Enhanced Icon -->
                    <a href="{{ route('receptionist.payments.index') }}" class="{{ request()->routeIs('receptionist.payments*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('receptionist.payments*') ? 'text-blue-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Payments
                    </a>

                    <!-- Attendance Section with Dropdown -->
                    <div class="space-y-1">
                        <button type="button" class="{{ request()->routeIs('receptionist.attendances*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group w-full flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200" aria-expanded="false" id="attendance-menu-button">
                            <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('receptionist.attendances*') ? 'text-blue-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Attendance
                            <svg class="ml-auto h-5 w-5 text-gray-400 transform transition-transform" id="attendance-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="hidden space-y-1 pl-10" id="attendance-submenu">
                            <a href="{{ route('receptionist.attendances.index') }}" class="{{ request()->routeIs('receptionist.attendances.index') ? 'text-blue-400' : 'text-gray-400 hover:text-white' }} group flex items-center px-2 py-2 text-xs font-medium rounded-md transition-all duration-200">
                                <span class="w-2 h-2 mr-2 bg-gray-400 rounded-full group-hover:bg-blue-400"></span>
                                Session Attendance
                            </a>
                            <a href="{{ route('receptionist.attendances.daily') }}" class="{{ request()->routeIs('receptionist.attendances.daily') ? 'text-blue-400' : 'text-gray-400 hover:text-white' }} group flex items-center px-2 py-2 text-xs font-medium rounded-md transition-all duration-200">
                                <span class="w-2 h-2 mr-2 bg-gray-400 rounded-full group-hover:bg-blue-400"></span>
                                Daily Attendance
                            </a>
                            <a href="{{ route('receptionist.attendances.create') }}" class="{{ request()->routeIs('receptionist.attendances.create') ? 'text-blue-400' : 'text-gray-400 hover:text-white' }} group flex items-center px-2 py-2 text-xs font-medium rounded-md transition-all duration-200">
                                <span class="w-2 h-2 mr-2 bg-gray-400 rounded-full group-hover:bg-blue-400"></span>
                                Record Attendance
                            </a>
                        </div>
                    </div>
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
    <button type="button" id="open-sidebar" class="bg-gray-800 p-2 rounded-md text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" aria-controls="mobile-menu" aria-expanded="false">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

@include('partials.receptionist-mobile-menu')

<script>
    // Toggle attendance submenu
    document.addEventListener('DOMContentLoaded', function() {
        const attendanceMenuButton = document.getElementById('attendance-menu-button');
        const attendanceSubmenu = document.getElementById('attendance-submenu');
        const attendanceArrow = document.getElementById('attendance-arrow');
        
        if (attendanceMenuButton && attendanceSubmenu) {
            attendanceMenuButton.addEventListener('click', function() {
                attendanceSubmenu.classList.toggle('hidden');
                attendanceArrow.classList.toggle('rotate-180');
            });
            
            // Auto-expand if any attendance route is active
            if (window.location.href.includes('receptionist/attendances')) {
                attendanceSubmenu.classList.remove('hidden');
                attendanceArrow.classList.add('rotate-180');
            }
        }
    });
</script>
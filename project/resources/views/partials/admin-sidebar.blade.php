<!-- Admin Sidebar Partial: resources/views/partials/admin-sidebar.blade.php -->
<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 border-r border-gray-200 bg-gradient-to-b from-gray-900 to-gray-800">
        <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
            <div class="flex items-center flex-shrink-0 px-4">
                <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-400 to-orange-500">
                    Train<span class="text-white">Together</span>
                </span>
                <span class="ml-2 px-2 py-1 text-xs font-bold bg-orange-500 text-white rounded">ADMIN</span>
            </div>
            
            <!-- Admin Avatar and Quick Stats -->
            <div class="mt-6 px-4">
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center text-white">
                        {{ substr(Auth::user()->firstname, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
                        <p class="text-xs text-gray-400">Administrator</p>
                    </div>
                </div>
                
                <!-- Quick Stats Bar -->
                <div class="grid grid-cols-2 gap-2 mt-4">
                    <div class="bg-gray-700 bg-opacity-50 rounded p-2 text-center">
                        <div class="text-white text-sm font-semibold">${{ number_format(28560, 0) }}</div>
                        <div class="text-gray-400 text-xs">Revenue</div>
                    </div>
                    <div class="bg-gray-700 bg-opacity-50 rounded p-2 text-center">
                        <div class="text-white text-sm font-semibold">{{ number_format(156) }}</div>
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
                    <!-- Dashboard Link with Enhanced Icon -->
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.dashboard') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5z" fill="currentColor" opacity="0.3"/>
                            <path d="M14 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5z" fill="currentColor" opacity="0.3"/>
                            <path d="M4 15a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-4z" fill="currentColor" opacity="0.3"/>
                            <path d="M14 13a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-6z" fill="currentColor" opacity="0.3"/>
                        </svg>
                        Dashboard
                    </a>

                    <!-- Users Link with Enhanced Icon -->
                    <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.users*') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Members & Staff
                    </a>

                    <!-- Sessions Link with Enhanced Icon -->
                    <a href="{{ route('admin.sessions.index') }}" class="{{ request()->routeIs('admin.sessions*') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.sessions*') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Fitness Sessions
                    </a>

                    <!-- Subscriptions Link with Enhanced Icon -->
                    <a href="{{ route('admin.subscriptions.index') }}" class="{{ request()->routeIs('admin.subscriptions*') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.subscriptions*') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        Memberships
                    </a>

                    <!-- Payments Link with Enhanced Icon -->
                    <a href="{{ route('admin.payments.index') }}" class="{{ request()->routeIs('admin.payments*') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.payments*') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Payments & Revenue
                    </a>

                  

                    <!-- Reports Section Heading -->
                    <div class="px-2 mt-5 mb-2">
                        <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            ANALYTICS
                        </h3>
                    </div>

                    <!-- Reports Link -->
                    <div class="space-y-1">
                        <button type="button" class="text-gray-300 hover:bg-gray-700 hover:text-white group w-full flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200" aria-expanded="false" id="reports-menu-button">
                            <svg class="mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Reports & Analytics
                            <svg class="ml-auto h-5 w-5 text-gray-400 transform transition-transform" id="reports-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="hidden space-y-1 pl-11" id="reports-submenu">
                            <a href="{{ route('admin.reports.members') }}" class="{{ request()->routeIs('admin.reports.members') ? 'text-orange-400' : 'text-gray-400 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                                <span class="w-2 h-2 mr-3 bg-gray-400 rounded-full group-hover:bg-orange-400"></span>
                                Member Analytics
                            </a>
                            <a href="{{ route('admin.reports.sessions') }}" class="{{ request()->routeIs('admin.reports.sessions') ? 'text-orange-400' : 'text-gray-400 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                                <span class="w-2 h-2 mr-3 bg-gray-400 rounded-full group-hover:bg-orange-400"></span>
                                Session Analytics
                            </a>
                            <a href="{{ route('admin.reports.revenues') }}" class="{{ request()->routeIs('admin.reports.revenues') ? 'text-orange-400' : 'text-gray-400 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                                <span class="w-2 h-2 mr-3 bg-gray-400 rounded-full group-hover:bg-orange-400"></span>
                                Financial Analytics
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
    <button type="button" id="open-sidebar" class="bg-gray-800 p-2 rounded-md text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500" aria-controls="mobile-menu" aria-expanded="false">
        <span class="sr-only">Open sidebar</span>
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

<script>
    // Toggle reports submenu
    document.addEventListener('DOMContentLoaded', function() {
        const reportsMenuButton = document.getElementById('reports-menu-button');
        const reportsSubmenu = document.getElementById('reports-submenu');
        const reportsArrow = document.getElementById('reports-arrow');
        
        if (reportsMenuButton && reportsSubmenu) {
            reportsMenuButton.addEventListener('click', function() {
                reportsSubmenu.classList.toggle('hidden');
                reportsArrow.classList.toggle('rotate-180');
            });
            
            // Auto-expand if any report route is active
            if (
                window.location.href.includes('admin/reports/members') || 
                window.location.href.includes('admin/reports/sessions') || 
                window.location.href.includes('admin/reports/revenues')
            ) {
                reportsSubmenu.classList.remove('hidden');
                reportsArrow.classList.add('rotate-180');
            }
        }
    });
</script>
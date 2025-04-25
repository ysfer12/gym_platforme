<!-- Admin Mobile Menu Partial: resources/views/partials/admin-mobile-menu.blade.php -->
<div class="md:hidden fixed inset-0 z-10 hidden bg-gray-900 bg-opacity-75 backdrop-blur-sm" id="mobile-menu-overlay"></div>
<div class="md:hidden fixed inset-y-0 left-0 z-10 w-full max-w-xs transform -translate-x-full bg-gradient-to-b from-gray-900 to-gray-800 transition-transform duration-300 ease-in-out hidden" id="mobile-menu">
    <div class="absolute top-0 right-0 -mr-12 pt-2">
        <button id="close-mobile-menu" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500">
            <span class="sr-only">Close sidebar</span>
            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <div class="h-full flex flex-col py-6 overflow-y-auto">
        <div class="px-4 sm:px-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-400 to-orange-500">
                        Train<span class="text-white">Together</span>
                    </span>
                    <span class="ml-2 px-2 py-1 text-xs font-bold bg-orange-500 text-white rounded">ADMIN</span>
                </div>
                <button id="close-mobile-menu-x" class="rounded-md text-white hover:text-orange-500 focus:outline-none">
                    <span class="sr-only">Close panel</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Admin Profile Info -->
        <div class="mt-4 mx-4 p-3 bg-gray-800 bg-opacity-50 rounded-lg border border-gray-700">
            <div class="flex items-center space-x-3">
                <div class="h-12 w-12 rounded-full bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center text-white font-bold text-lg">
                    {{ substr(Auth::user()->firstname, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-white font-medium">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h3>
                    <p class="text-sm text-gray-400">Administrator</p>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <div class="grid grid-cols-2 gap-2 mt-3">
                <div class="bg-gray-700 bg-opacity-50 rounded p-2 text-center">
                    <div class="text-orange-400 text-lg font-semibold">156</div>
                    <div class="text-gray-300 text-xs">Members</div>
                </div>
                <div class="bg-gray-700 bg-opacity-50 rounded p-2 text-center">
                    <div class="text-orange-400 text-lg font-semibold">12</div>
                    <div class="text-gray-300 text-xs">Today's Sessions</div>
                </div>
            </div>
        </div>
        
        <div class="mt-6 relative flex-1 px-4 sm:px-6">
            <nav class="flex-1 space-y-1">
                <!-- Section Heading -->
                <div class="pt-2 pb-1">
                    <p class="text-xs font-bold text-orange-500 uppercase tracking-wider">Management</p>
                </div>
                
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.dashboard') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="3" width="7" height="9" rx="1" fill="currentColor" opacity="0.3"/>
                        <rect x="15" y="3" width="7" height="5" rx="1" fill="currentColor" opacity="0.3"/>
                        <rect x="2" y="15" width="7" height="6" rx="1" fill="currentColor" opacity="0.3"/>
                        <rect x="15" y="12" width="7" height="9" rx="1" fill="currentColor" opacity="0.3"/>
                    </svg>
                    Dashboard
                </a>
                
                <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.users*') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Members & Staff
                </a>
                
                <a href="{{ route('admin.sessions.index') }}" class="{{ request()->routeIs('admin.sessions*') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.sessions*') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Fitness Sessions
                </a>
                
                <a href="{{ route('admin.subscriptions.index') }}" class="{{ request()->routeIs('admin.subscriptions*') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.subscriptions*') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                    Memberships
                </a>
                
                <a href="{{ route('admin.payments.index') }}" class="{{ request()->routeIs('admin.payments*') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.payments*') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Payments & Revenue
                </a>
                
                <a href="{{ route('admin.attendances.index') }}" class="{{ request()->routeIs('admin.attendances*') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.attendances*') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Gym Attendance
                </a>
                
                <!-- Section Heading -->
                <div class="pt-6 pb-1">
                    <p class="text-xs font-bold text-orange-500 uppercase tracking-wider">Analytics</p>
                </div>

                <!-- Reports Dropdown -->
                <div class="space-y-1">
                    <button type="button" class="text-gray-300 hover:bg-gray-700 hover:text-white group w-full flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200" aria-expanded="false" id="mobile-reports-menu-button">
                        <svg class="mr-4 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Reports & Analytics
                        <svg class="ml-auto h-5 w-5 text-gray-400 transform transition-transform" id="mobile-reports-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div class="hidden space-y-1 pl-12" id="mobile-reports-submenu">
                        <a href="{{ route('admin.reports.members') }}" class="{{ request()->routeIs('admin.reports.members') ? 'text-orange-400' : 'text-gray-400 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                            <span class="w-2 h-2 mr-2 bg-gray-400 rounded-full group-hover:bg-orange-400"></span>
                            Member Analytics
                        </a>
                        <a href="{{ route('admin.reports.sessions') }}" class="{{ request()->routeIs('admin.reports.sessions') ? 'text-orange-400' : 'text-gray-400 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                            <span class="w-2 h-2 mr-2 bg-gray-400 rounded-full group-hover:bg-orange-400"></span>
                            Session Analytics
                        </a>
                        <a href="{{ route('admin.reports.revenues') }}" class="{{ request()->routeIs('admin.reports.revenues') ? 'text-orange-400' : 'text-gray-400 hover:text-white' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md transition-all duration-200">
                            <span class="w-2 h-2 mr-2 bg-gray-400 rounded-full group-hover:bg-orange-400"></span>
                            Financial Analytics
                        </a>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-700 my-4"></div>

                <!-- Mobile Actions -->
                <div class="px-3 py-3 rounded-md bg-gray-700 bg-opacity-30">
                    <h3 class="text-sm font-semibold text-white mb-3">Quick Actions</h3>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('admin.users.create') }}" class="flex items-center justify-center py-2 px-3 bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium rounded-md transition-all duration-200">
                            <svg class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add User
                        </a>
                        <a href="{{ route('admin.sessions.create') }}" class="flex items-center justify-center py-2 px-3 bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium rounded-md transition-all duration-200">
                            <svg class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add Session
                        </a>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="mt-6">
                    @csrf
                    <button type="submit" class="group flex w-full items-center px-3 py-3 text-base font-medium text-red-400 hover:bg-gray-700 hover:text-red-300 rounded-md transition-all duration-200">
                        <svg class="mr-4 flex-shrink-0 h-6 w-6 text-red-400 group-hover:text-red-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Sign Out
                    </button>
                </form>
            </nav>
        </div>
    </div>
</div>

<script>
    // Toggle reports submenu in mobile menu
    document.addEventListener('DOMContentLoaded', function() {
        const mobileReportsMenuButton = document.getElementById('mobile-reports-menu-button');
        const mobileReportsSubmenu = document.getElementById('mobile-reports-submenu');
        const mobileReportsArrow = document.getElementById('mobile-reports-arrow');
        
        if (mobileReportsMenuButton && mobileReportsSubmenu) {
            mobileReportsMenuButton.addEventListener('click', function() {
                mobileReportsSubmenu.classList.toggle('hidden');
                mobileReportsArrow.classList.toggle('rotate-180');
            });
            
            // Auto-expand if any report route is active
            if (
                window.location.href.includes('admin/reports/members') || 
                window.location.href.includes('admin/reports/sessions') || 
                window.location.href.includes('admin/reports/revenues')
            ) {
                mobileReportsSubmenu.classList.remove('hidden');
                mobileReportsArrow.classList.add('rotate-180');
            }
        }
    });
</script>
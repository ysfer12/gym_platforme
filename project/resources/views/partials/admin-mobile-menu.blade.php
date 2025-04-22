<!-- Admin Mobile Menu Partial: resources/views/partials/admin-mobile-menu.blade.php -->
<div class="md:hidden fixed inset-0 z-10 hidden bg-gray-600 bg-opacity-75" id="mobile-menu-overlay"></div>
<div class="md:hidden fixed inset-y-0 left-0 z-10 w-full max-w-xs transform -translate-x-full bg-white transition-transform duration-300 ease-in-out hidden" id="mobile-menu">
    <div class="absolute top-0 right-0 -mr-12 pt-2">
        <button id="close-mobile-menu" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
            <span class="sr-only">Close sidebar</span>
            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <div class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-auto">
        <div class="px-4 sm:px-6">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-medium text-gray-900">Admin Menu</h2>
                <button id="close-mobile-menu-x" class="rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <span class="sr-only">Close panel</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="mt-6 relative flex-1 px-4 sm:px-6">
            <nav class="flex-1 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-3 py-3 text-base font-medium rounded-md">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
                
                <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-3 py-3 text-base font-medium rounded-md">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.users*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Users
                </a>
                
                <a href="{{ route('admin.sessions.index') }}" class="{{ request()->routeIs('admin.sessions*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-3 py-3 text-base font-medium rounded-md">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.sessions*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Sessions
                </a>
                
                <a href="{{ route('admin.subscriptions.index') }}" class="{{ request()->routeIs('admin.subscriptions*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-3 py-3 text-base font-medium rounded-md">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.subscriptions*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                    Subscriptions
                </a>
                
                <a href="{{ route('admin.payments.index') }}" class="{{ request()->routeIs('admin.payments*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-3 py-3 text-base font-medium rounded-md">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.payments*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Payments
                </a>
                
                <a href="{{ route('admin.attendances.index') }}" class="{{ request()->routeIs('admin.attendances*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-3 py-3 text-base font-medium rounded-md">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.attendances*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Attendance
                </a>
                
                <!-- Reports Dropdown -->
                <div class="space-y-1">
                    <button type="button" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group w-full flex items-center px-3 py-3 text-base font-medium rounded-md" aria-expanded="false" id="mobile-reports-menu-button">
                        <svg class="mr-4 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Reports
                        <svg class="ml-auto h-5 w-5 text-gray-400 transform transition-transform" id="mobile-reports-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div class="hidden space-y-1 pl-10" id="mobile-reports-submenu">
                        <a href="{{ route('admin.reports.members') }}" class="{{ request()->routeIs('admin.reports.members') ? 'text-indigo-600' : 'text-gray-600 hover:text-gray-900' }} group flex items-center px-3 py-3 text-base font-medium rounded-md">
                            Members Report
                        </a>
                        <a href="{{ route('admin.reports.sessions') }}" class="{{ request()->routeIs('admin.reports.sessions') ? 'text-indigo-600' : 'text-gray-600 hover:text-gray-900' }} group flex items-center px-3 py-3 text-base font-medium rounded-md">
                            Sessions Report
                        </a>
                        <a href="{{ route('admin.reports.revenues') }}" class="{{ request()->routeIs('admin.reports.revenues') ? 'text-indigo-600' : 'text-gray-600 hover:text-gray-900' }} group flex items-center px-3 py-3 text-base font-medium rounded-md">
                            Revenue Report
                        </a>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="mt-6">
                    @csrf
                    <button type="submit" class="group flex w-full items-center px-3 py-3 text-base font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-md">
                        <svg class="mr-4 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
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
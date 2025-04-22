<!-- Admin Sidebar Partial: resources/views/partials/admin-sidebar.blade.php -->
<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 border-r border-gray-200 bg-white">
        <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
            <div class="flex items-center flex-shrink-0 px-4">
                <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-blue-500">
                    FitTrack
                </span>
                <span class="ml-1 text-xl font-semibold text-gray-800">Gym</span>
            </div>
            <div class="mt-5 flex-grow flex flex-col">
                <nav class="flex-1 px-2 space-y-1 bg-white" aria-label="Sidebar">
                    <!-- Dashboard Link -->
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <!-- Users Link -->
                    <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.users*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Users
                    </a>

                    <!-- Sessions Link -->
                    <a href="{{ route('admin.sessions.index') }}" class="{{ request()->routeIs('admin.sessions*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.sessions*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Sessions
                    </a>

                    <!-- Subscriptions Link -->
                    <a href="{{ route('admin.subscriptions.index') }}" class="{{ request()->routeIs('admin.subscriptions*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.subscriptions*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        Subscriptions
                    </a>

                    <!-- Payments Link -->
                    <a href="{{ route('admin.payments.index') }}" class="{{ request()->routeIs('admin.payments*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.payments*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Payments
                    </a>

                    <!-- Attendance Link -->
                    <a href="{{ route('admin.attendances.index') }}" class="{{ request()->routeIs('admin.attendances*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="mr-3 flex-shrink-0 h-6 w-6 {{ request()->routeIs('admin.attendances*') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Attendance
                    </a>

                    <!-- Reports Link -->
                    <div class="space-y-1">
                        <button type="button" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group w-full flex items-center px-2 py-2 text-sm font-medium rounded-md" aria-expanded="false" id="reports-menu-button">
                            <svg class="mr-3 flex-shrink-0 h-6 w-6 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Reports
                            <svg class="ml-auto h-5 w-5 text-gray-400 transform transition-transform" id="reports-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div class="hidden space-y-1 pl-7" id="reports-submenu">
                            <a href="{{ route('admin.reports.members') }}" class="{{ request()->routeIs('admin.reports.members') ? 'text-indigo-600' : 'text-gray-600 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                Members Report
                            </a>
                            <a href="{{ route('admin.reports.sessions') }}" class="{{ request()->routeIs('admin.reports.sessions') ? 'text-indigo-600' : 'text-gray-600 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                Sessions Report
                            </a>
                            <a href="{{ route('admin.reports.revenues') }}" class="{{ request()->routeIs('admin.reports.revenues') ? 'text-indigo-600' : 'text-gray-600 hover:text-gray-900' }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                                Revenue Report
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
            <div class="flex-shrink-0 w-full group block">
                <div class="flex items-center">
                    <div>
                        <div class="h-9 w-9 rounded-full bg-gradient-to-r from-indigo-500 to-blue-500 flex items-center justify-center text-white">
                            {{ substr(Auth::user()->firstname, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-xs font-medium text-red-500 group-hover:text-gray-700">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile sidebar menu button -->
<div class="md:hidden fixed z-20 top-4 left-4">
    <button type="button" id="open-sidebar" class="bg-white p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
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
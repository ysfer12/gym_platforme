<!-- Trainer Mobile Menu Partial: resources/views/partials/trainer-mobile-menu.blade.php -->
<div class="md:hidden fixed inset-0 z-10 hidden bg-gray-900 bg-opacity-75 backdrop-blur-sm" id="mobile-menu-overlay"></div>
<div class="md:hidden fixed inset-y-0 left-0 z-10 w-full max-w-xs transform -translate-x-full bg-gradient-to-b from-gray-900 to-gray-800 transition-transform duration-300 ease-in-out hidden" id="mobile-menu">
    <div class="absolute top-0 right-0 -mr-12 pt-2">
        <button id="close-mobile-menu" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500">
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
                    <span class="ml-2 px-2 py-1 text-xs font-bold bg-green-500 text-white rounded">TRAINER</span>
                </div>
                <button id="close-mobile-menu-x" class="rounded-md text-white hover:text-green-500 focus:outline-none">
                    <span class="sr-only">Close panel</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Trainer Profile Info -->
        <div class="mt-4 mx-4 p-3 bg-gray-800 bg-opacity-50 rounded-lg border border-gray-700">
            <div class="flex items-center space-x-3">
                <div class="h-12 w-12 rounded-full bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center text-white font-bold text-lg">
                    {{ substr(Auth::user()->firstname, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-white font-medium">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h3>
                    <p class="text-sm text-gray-400">Fitness Trainer</p>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <div class="grid grid-cols-2 gap-2 mt-3">
                <div class="bg-gray-700 bg-opacity-50 rounded p-2 text-center">
                    <div class="text-green-400 text-lg font-semibold">24</div>
                    <div class="text-gray-300 text-xs">Sessions</div>
                </div>
                <div class="bg-gray-700 bg-opacity-50 rounded p-2 text-center">
                    <div class="text-green-400 text-lg font-semibold">32</div>
                    <div class="text-gray-300 text-xs">Members</div>
                </div>
            </div>
        </div>
        
        <div class="mt-6 relative flex-1 px-4 sm:px-6">
            <nav class="flex-1 space-y-1">
                <!-- Section Heading -->
                <div class="pt-2 pb-1">
                    <p class="text-xs font-bold text-green-500 uppercase tracking-wider">Management</p>
                </div>
                
                <a href="{{ route('trainer.dashboard') }}" class="{{ request()->routeIs('trainer.dashboard') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('trainer.dashboard') ? 'text-green-300' : 'text-gray-400 group-hover:text-gray-300' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="3" width="7" height="9" rx="1" fill="currentColor" opacity="0.3"/>
                        <rect x="15" y="3" width="7" height="5" rx="1" fill="currentColor" opacity="0.3"/>
                        <rect x="2" y="15" width="7" height="6" rx="1" fill="currentColor" opacity="0.3"/>
                        <rect x="15" y="12" width="7" height="9" rx="1" fill="currentColor" opacity="0.3"/>
                    </svg>
                    Dashboard
                </a>
                
                <a href="{{ route('trainer.sessions.index') }}" class="{{ request()->routeIs('trainer.sessions*') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('trainer.sessions*') ? 'text-green-300' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Sessions
                </a>
                
                <a href="{{ route('trainer.schedule.index') }}" class="{{ request()->routeIs('trainer.schedule*') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('trainer.schedule*') ? 'text-green-300' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Schedule
                </a>
                
                <a href="{{ route('trainer.members') }}" class="{{ request()->routeIs('trainer.members*') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('trainer.members*') ? 'text-green-300' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Members
                </a>
                
                <a href="{{ route('trainer.profile') }}" class="{{ request()->routeIs('trainer.profile*') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('trainer.profile*') ? 'text-green-300' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile
                </a>
                
                <!-- Section Heading -->
                <div class="pt-6 pb-1">
                    <p class="text-xs font-bold text-green-500 uppercase tracking-wider">Analytics</p>
                </div>
                
                <a href="#" class="{{ request()->routeIs('trainer.analytics*') ? 'bg-green-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('trainer.analytics*') ? 'text-green-300' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Performance Analytics
                </a>

                <!-- Divider -->
                <div class="border-t border-gray-700 my-4"></div>

                <!-- Mobile Actions -->
                <div class="px-3 py-3 rounded-md bg-gray-700 bg-opacity-30">
                    <h3 class="text-sm font-semibold text-white mb-3">Quick Actions</h3>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('trainer.sessions.create') }}" class="flex items-center justify-center py-2 px-3 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition-all duration-200">
                            <svg class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add Session
                        </a>
                        <a href="{{ route('trainer.schedule.create') }}" class="flex items-center justify-center py-2 px-3 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-md transition-all duration-200">
                            <svg class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add Schedule
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
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const openSidebar = document.getElementById('open-sidebar');
        const closeMobileMenu = document.getElementById('close-mobile-menu');
        const closeMobileMenuX = document.getElementById('close-mobile-menu-x');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        
        if (openSidebar) {
            openSidebar.addEventListener('click', function() {
                mobileMenu.classList.remove('hidden', '-translate-x-full');
                mobileMenuOverlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            });
        }
        
        if (closeMobileMenu) {
            closeMobileMenu.addEventListener('click', function() {
                mobileMenu.classList.add('-translate-x-full');
                setTimeout(function() {
                    mobileMenu.classList.add('hidden');
                    mobileMenuOverlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }, 300);
            });
        }
        
        if (closeMobileMenuX) {
            closeMobileMenuX.addEventListener('click', function() {
                mobileMenu.classList.add('-translate-x-full');
                setTimeout(function() {
                    mobileMenu.classList.add('hidden');
                    mobileMenuOverlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }, 300);
            });
        }
        
        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', function() {
                mobileMenu.classList.add('-translate-x-full');
                setTimeout(function() {
                    mobileMenu.classList.add('hidden');
                    mobileMenuOverlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }, 300);
            });
        }
    });
</script>
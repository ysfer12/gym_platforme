<!-- Mobile Menu: resources/views/partials/mobile-menu.blade.php -->
<div class="md:hidden fixed inset-0 z-10 hidden bg-gray-900 bg-opacity-75 backdrop-blur-sm" id="mobile-menu-overlay"></div>
<div class="md:hidden fixed inset-y-0 left-0 z-10 w-full max-w-xs transform -translate-x-full bg-gradient-to-b from-gray-900 to-gray-800 transition-transform duration-300 ease-in-out hidden" id="mobile-menu">
    <!-- Close button on mobile -->
    <div class="absolute top-0 right-0 -mr-12 pt-2">
        <button id="close-mobile-menu" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-orange-500">
            <span class="sr-only">Close sidebar</span>
            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    
    <div class="h-full flex flex-col py-6 overflow-y-auto">
        <!-- Header with logo and close button -->
        <div class="px-4 sm:px-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-400 to-orange-500">
                        Train<span class="text-white">Together</span>
                    </span>
                    <span class="ml-2 px-2 py-1 text-xs font-bold bg-orange-500 text-white rounded shadow-sm">MEMBER</span>
                </div>
                <button id="close-mobile-menu-x" class="rounded-md text-white hover:text-orange-500 focus:outline-none">
                    <span class="sr-only">Close panel</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Member Profile Card -->
        <div class="mt-4 mx-4 p-3 bg-gray-800 bg-opacity-50 rounded-lg border border-gray-700 shadow-inner">
            <div class="flex items-center space-x-3">
                <div class="h-12 w-12 rounded-full bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center text-white font-bold text-lg shadow-md">
                    {{ substr(Auth::user()->firstname, 0, 1) }}{{ substr(Auth::user()->lastname, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-white font-medium">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h3>
                    <p class="text-sm text-gray-400">Premium Member</p>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <div class="grid grid-cols-2 gap-2 mt-3">
                <div class="bg-gray-700 bg-opacity-50 rounded p-2 text-center shadow-inner">
                    <div class="text-orange-400 text-lg font-semibold">12</div>
                    <div class="text-gray-300 text-xs">Total Sessions</div>
                </div>
                <div class="bg-gray-700 bg-opacity-50 rounded p-2 text-center shadow-inner">
                    <div class="text-orange-400 text-lg font-semibold">85%</div>
                    <div class="text-gray-300 text-xs">Attendance Rate</div>
                </div>
            </div>
        </div>
        
        <!-- Navigation Menu -->
        <div class="mt-6 relative flex-1 px-4 sm:px-6">
            <nav class="flex-1 space-y-2">
                <!-- Section Heading -->
                <div class="pt-2 pb-1 mb-2">
                    <p class="text-xs font-bold text-orange-500 uppercase tracking-wider">Member Portal</p>
                </div>
                
                <!-- Dashboard Link -->
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('dashboard') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="3" width="7" height="9" rx="1" fill="currentColor" opacity="0.3"/>
                        <rect x="15" y="3" width="7" height="5" rx="1" fill="currentColor" opacity="0.3"/>
                        <rect x="2" y="15" width="7" height="6" rx="1" fill="currentColor" opacity="0.3"/>
                        <rect x="15" y="12" width="7" height="9" rx="1" fill="currentColor" opacity="0.3"/>
                    </svg>
                    Dashboard
                </a>
                
                <!-- Sessions Link -->
                <a href="{{ route('member.sessions') }}" class="{{ request()->routeIs('member.sessions') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('member.sessions') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Fitness Sessions
                </a>
                
                <!-- Subscription Link -->
                <a href="{{ route('member.subscription') }}" class="{{ request()->routeIs('member.subscription') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('member.subscription') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                    Membership
                </a>
                
                <!-- Attendance Link -->
                <a href="{{ route('member.attendance') }}" class="{{ request()->routeIs('member.attendance') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('member.attendance') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Gym Attendance
                </a>
                
                <!-- Profile Link -->
                <a href="{{ route('member.profile') }}" class="{{ request()->routeIs('member.profile') ? 'bg-orange-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-3 py-3 text-base font-medium rounded-md transition-all duration-200">
                    <svg class="mr-4 flex-shrink-0 h-6 w-6 {{ request()->routeIs('member.profile') ? 'text-orange-300' : 'text-gray-400 group-hover:text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profile & Badge
                </a>

                <!-- Progress Section -->
                <div class="mt-5">
                    <div class="px-3 mb-2">
                        <p class="text-xs font-bold text-orange-500 uppercase tracking-wider">Your Progress</p>
                    </div>
                    <div class="px-3 py-3 rounded-md bg-gray-700 bg-opacity-30 shadow-inner">
                        <div class="mb-3">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm text-gray-300">Monthly Goal</span>
                                <span class="text-sm text-orange-400">75%</span>
                            </div>
                            <div class="w-full bg-gray-600 rounded-full h-2.5">
                                <div class="bg-gradient-to-r from-orange-500 to-red-500 h-2.5 rounded-full" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Quick Actions -->
                <div class="px-3 py-3 rounded-md bg-gray-700 bg-opacity-30 mt-4 shadow-inner">
                    <h3 class="text-sm font-semibold text-white mb-3">Quick Actions</h3>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="{{ route('member.sessions') }}" class="flex items-center justify-center py-2 px-3 bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium rounded-md transition-all duration-200 shadow-sm">
                            <svg class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Book Session
                        </a>
                        <a href="{{ route('member.profile') }}" class="flex items-center justify-center py-2 px-3 bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium rounded-md transition-all duration-200 shadow-sm">
                            <svg class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            My Profile
                        </a>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-700 my-3"></div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
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

<!-- Mobile Menu JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all the elements we need
        const openSidebarButton = document.getElementById('open-sidebar');
        const closeMobileMenuButton = document.getElementById('close-mobile-menu');
        const closeMobileMenuXButton = document.getElementById('close-mobile-menu-x');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        
        // Function to open the mobile menu
        const openMobileMenu = function() {
            mobileMenu.classList.remove('hidden');
            mobileMenuOverlay.classList.remove('hidden');
            
            // Use setTimeout to ensure the transition happens after the display change
            setTimeout(function() {
                mobileMenu.classList.remove('-translate-x-full');
            }, 10);
        };
        
        // Function to close the mobile menu
        const closeMobileMenu = function() {
            mobileMenu.classList.add('-translate-x-full');
            
            // Wait for transition to finish before hiding the elements
            setTimeout(function() {
                mobileMenu.classList.add('hidden');
                mobileMenuOverlay.classList.add('hidden');
            }, 300); // Match this with your CSS transition duration
        };
        
        // Event listeners for opening the mobile menu
        if (openSidebarButton) {
            openSidebarButton.addEventListener('click', openMobileMenu);
        }
        
        // Event listeners for closing the mobile menu
        if (closeMobileMenuButton) {
            closeMobileMenuButton.addEventListener('click', closeMobileMenu);
        }
        
        if (closeMobileMenuXButton) {
            closeMobileMenuXButton.addEventListener('click', closeMobileMenu);
        }
        
        // Close when clicking the overlay
        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeMobileMenu);
        }
        
        // Close menu when pressing Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                closeMobileMenu();
            }
        });
        
        // Auto-close menu when navigating to a new page (for SPA behavior)
        const mobileMenuLinks = mobileMenu.querySelectorAll('a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Add a small delay before closing to make navigation feel smoother
                setTimeout(closeMobileMenu, 150);
            });
        });
    });
</script>


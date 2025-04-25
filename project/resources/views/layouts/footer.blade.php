<footer class="bg-gray-900 text-white pt-16 pb-8 relative overflow-hidden">
    <!-- Enhanced Background Elements -->
    <div class="absolute inset-0 bg-gradient-to-b from-gray-900 via-gray-900 to-black z-0"></div>
    
    <!-- Animated Wave Background -->
    <div class="absolute top-0 left-0 right-0 h-40 overflow-hidden z-0">
        <div class="absolute bottom-0 left-0 w-full opacity-15" style="animation: wave 15s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none" style="width: 100%; height: 120px;">
                <path fill="#ff5e14" d="M0,128L48,144C96,160,192,192,288,197.3C384,203,480,181,576,165.3C672,149,768,139,864,149.3C960,160,1056,192,1152,202.7C1248,213,1344,203,1392,197.3L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
            </svg>
        </div>
        <div class="absolute bottom-0 left-0 w-full opacity-20" style="animation: wave 18s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite reverse; animation-delay: -5s;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none" style="width: 100%; height: 100px;">
                <path fill="#ff7a00" d="M0,224L48,229.3C96,235,192,245,288,218.7C384,192,480,128,576,122.7C672,117,768,171,864,192C960,213,1056,203,1152,181.3C1248,160,1344,128,1392,112L1440,96L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
            </svg>
        </div>
    </div>
    
    <!-- Animated Gradient Elements -->
    <div class="absolute top-10 right-10 w-64 h-64 rounded-full opacity-5 z-0 bg-gradient-to-r from-orange-500 to-orange-600 blur-3xl" style="animation: pulse 8s ease-in-out infinite alternate;"></div>
    <div class="absolute bottom-10 left-10 w-48 h-48 rounded-full opacity-5 z-0 bg-gradient-to-r from-orange-600 to-orange-400 blur-3xl" style="animation: pulse 10s ease-in-out infinite alternate-reverse;"></div>
    
    <!-- Main Footer Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-10">
            <!-- Column 1: Logo & Info -->
            <div class="md:col-span-4">
                <div class="flex items-center">
                    <span class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-orange-400 to-orange-300">
                        TrainTogether
                    </span>
                </div>
                <p class="mt-6 text-gray-300 text-sm leading-relaxed">
                    Your premier fitness destination with state-of-the-art equipment, expert trainers, and a supportive community that helps you achieve your fitness goals.
                </p>
                <div class="flex space-x-4 mt-8">
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-orange-500 hover:text-white hover:-translate-y-1 transition-all duration-300">
                        <i class='bx bxl-facebook text-xl'></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-orange-500 hover:text-white hover:-translate-y-1 transition-all duration-300">
                        <i class='bx bxl-instagram text-xl'></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-orange-500 hover:text-white hover:-translate-y-1 transition-all duration-300">
                        <i class='bx bxl-twitter text-xl'></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:bg-orange-500 hover:text-white hover:-translate-y-1 transition-all duration-300">
                        <i class='bx bxl-youtube text-xl'></i>
                    </a>
                </div>
                
                <!-- Newsletter Subscription -->
                <div class="mt-8 bg-gray-800 bg-opacity-50 p-5 rounded-lg border border-gray-700">
                    <h4 class="text-lg font-semibold text-white mb-3">Join Our Newsletter</h4>
                    <form class="flex">
                        <input type="email" placeholder="Your email address" class="flex-1 bg-gray-700 text-white border border-gray-600 rounded-l-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-3 rounded-r-md transition-colors duration-300 font-medium">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="md:col-span-2">
                <h3 class="text-lg font-bold text-white mb-6">Quick Links</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-orange-400 hover:pl-1 transition-all duration-300 inline-block">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-orange-400 hover:pl-1 transition-all duration-300 inline-block">About</a></li>
                    <li><a href="{{ route('subscriptions') }}" class="text-gray-300 hover:text-orange-400 hover:pl-1 transition-all duration-300 inline-block">Memberships</a></li>
                    <li><a href="{{ route('sessions') }}" class="text-gray-300 hover:text-orange-400 hover:pl-1 transition-all duration-300 inline-block">Classes</a></li>
                    <li><a href="{{ route('trainers') }}" class="text-gray-300 hover:text-orange-400 hover:pl-1 transition-all duration-300 inline-block">Trainers</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-orange-400 hover:pl-1 transition-all duration-300 inline-block">Contact</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-orange-400 hover:pl-1 transition-all duration-300 inline-block">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Column 3: Opening Hours -->
            <div class="md:col-span-3">
                <h3 class="text-lg font-bold text-white mb-6">Opening Hours</h3>
                <ul class="space-y-4 text-gray-300">
                    <li class="flex items-start">
                        <div class="bg-gray-800 p-2 rounded-md mr-3 shadow-lg border border-gray-700">
                            <i class='bx bx-time text-orange-400 text-xl'></i>
                        </div>
                        <div>
                            <span class="font-medium block">Monday - Friday</span>
                            <span class="text-sm text-gray-400">6:00 AM - 10:00 PM</span>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="bg-gray-800 p-2 rounded-md mr-3 shadow-lg border border-gray-700">
                            <i class='bx bx-time text-orange-400 text-xl'></i>
                        </div>
                        <div>
                            <span class="font-medium block">Saturday</span>
                            <span class="text-sm text-gray-400">7:00 AM - 9:00 PM</span>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="bg-gray-800 p-2 rounded-md mr-3 shadow-lg border border-gray-700">
                            <i class='bx bx-time text-orange-400 text-xl'></i>
                        </div>
                        <div>
                            <span class="font-medium block">Sunday</span>
                            <span class="text-sm text-gray-400">8:00 AM - 8:00 PM</span>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <div class="bg-gray-800 p-2 rounded-md mr-3 shadow-lg border border-gray-700">
                            <i class='bx bx-calendar text-orange-400 text-xl'></i>
                        </div>
                        <div>
                            <span class="font-medium block">Public Holidays</span>
                            <span class="text-sm text-gray-400">8:00 AM - 8:00 PM</span>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Contact & Payment Methods -->
            <div class="md:col-span-3">
                <h3 class="text-lg font-bold text-white mb-6">Contact Info</h3>
                <ul class="space-y-4 text-gray-300 mb-6">
                    <li class="flex items-start group">
                        <div class="bg-gray-800 p-2 rounded-md mr-3 shadow-lg border border-gray-700 group-hover:bg-orange-500 group-hover:text-white transition-all duration-300">
                            <i class='bx bx-map text-orange-400 text-xl group-hover:text-white'></i>
                        </div>
                        <span>123 Fitness Avenue, Gym City, 10001</span>
                    </li>
                    <li class="flex items-start group">
                        <div class="bg-gray-800 p-2 rounded-md mr-3 shadow-lg border border-gray-700 group-hover:bg-orange-500 group-hover:text-white transition-all duration-300">
                            <i class='bx bx-phone text-orange-400 text-xl group-hover:text-white'></i>
                        </div>
                        <span>(123) 456-7890</span>
                    </li>
                    <li class="flex items-start group">
                        <div class="bg-gray-800 p-2 rounded-md mr-3 shadow-lg border border-gray-700 group-hover:bg-orange-500 group-hover:text-white transition-all duration-300">
                            <i class='bx bx-envelope text-orange-400 text-xl group-hover:text-white'></i>
                        </div>
                        <span>info@traintogether.com</span>
                    </li>
                </ul>
                
                <!-- Payment Methods Section -->
                <h4 class="text-white font-semibold mb-4">Payment Methods</h4>
                <div class="flex flex-wrap gap-3">
                    <div class="bg-gray-800 p-2 rounded-md shadow-md hover:shadow-orange-500/10 hover:-translate-y-1 transition-all duration-300 border border-gray-700">
                        <i class='bx bxl-visa text-blue-400 text-2xl'></i>
                    </div>
                    <div class="bg-gray-800 p-2 rounded-md shadow-md hover:shadow-orange-500/10 hover:-translate-y-1 transition-all duration-300 border border-gray-700">
                        <i class='bx bxl-mastercard text-red-400 text-2xl'></i>
                    </div>
                    <div class="bg-gray-800 p-2 rounded-md shadow-md hover:shadow-orange-500/10 hover:-translate-y-1 transition-all duration-300 border border-gray-700">
                        <i class='bx bxl-paypal text-blue-500 text-2xl'></i>
                    </div>
                    <div class="bg-gray-800 p-2 rounded-md shadow-md hover:shadow-orange-500/10 hover:-translate-y-1 transition-all duration-300 border border-gray-700">
                        <i class='bx bxl-apple text-gray-300 text-2xl'></i>
                    </div>
                    <div class="bg-gray-800 p-2 rounded-md shadow-md hover:shadow-orange-500/10 hover:-translate-y-1 transition-all duration-300 border border-gray-700">
                        <i class='bx bx-credit-card text-orange-400 text-2xl'></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="mt-12 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-400 text-sm">
                &copy; {{ date('Y') }} TrainTogether. All rights reserved.
            </p>
            <div class="mt-4 md:mt-0 flex flex-wrap gap-4">
                <a href="#" class="text-gray-400 hover:text-orange-400 text-sm transition-colors duration-300">Terms & Conditions</a>
                <a href="#" class="text-gray-400 hover:text-orange-400 text-sm transition-colors duration-300">Privacy Policy</a>
                <a href="#" class="text-gray-400 hover:text-orange-400 text-sm transition-colors duration-300">Cookie Policy</a>
                <a href="#" class="text-gray-400 hover:text-orange-400 text-sm transition-colors duration-300">Accessibility</a>
            </div>
        </div>
    </div>
    
    <!-- Animation Styles -->
    <style>
        @keyframes wave {
            0% { transform: translateX(-25%); }
            100% { transform: translateX(25%); }
        }
        
        @keyframes pulse {
            0% { transform: scale(0.95); opacity: 0.5; }
            100% { transform: scale(1.05); opacity: 0.8; }
        }
    </style>
</footer>
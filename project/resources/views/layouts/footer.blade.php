<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Column 1: Logo & Info -->
        <div>
            <h2 class="text-lg font-semibold text-white mb-4">FitTrack Gym</h2>
            <p class="text-gray-300 mb-4">
                Your premier fitness destination with state-of-the-art equipment, expert trainers, and a supportive community.
            </p>
            <div class="flex space-x-4 mt-4">
                <a href="#" class="text-gray-400 hover:text-white">
                    <i class='bx bxl-facebook text-xl'></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white">
                    <i class='bx bxl-instagram text-xl'></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white">
                    <i class='bx bxl-twitter text-xl'></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white">
                    <i class='bx bxl-youtube text-xl'></i>
                </a>
            </div>
        </div>
        
        <!-- Column 2: Quick Links -->
        <div>
            <h2 class="text-lg font-semibold text-white mb-4">Quick Links</h2>
            <ul class="space-y-2">
                <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white">Home</a></li>
                <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white">About</a></li>
                <li><a href="{{ route('subscriptions') }}" class="text-gray-300 hover:text-white">Subscriptions</a></li>
                <li><a href="{{ route('sessions') }}" class="text-gray-300 hover:text-white">Sessions</a></li>
                <li><a href="{{ route('trainers') }}" class="text-gray-300 hover:text-white">Trainers</a></li>
                <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white">Contact</a></li>
            </ul>
        </div>
        
        <!-- Column 3: Opening Hours -->
        <div>
            <h2 class="text-lg font-semibold text-white mb-4">Opening Hours</h2>
            <ul class="space-y-2 text-gray-300">
                <li>Monday - Friday: 6:00 AM - 10:00 PM</li>
                <li>Saturday: 7:00 AM - 9:00 PM</li>
                <li>Sunday: 8:00 AM - 8:00 PM</li>
                <li>Public Holidays: 8:00 AM - 8:00 PM</li>
            </ul>
        </div>
        
        <!-- Column 4: Contact Info -->
        <div>
            <h2 class="text-lg font-semibold text-white mb-4">Contact Info</h2>
            <ul class="space-y-2 text-gray-300">
                <li class="flex items-start">
                    <i class='bx bx-map text-indigo-400 mr-2 mt-1'></i>
                    <span>123 Fitness Avenue, Gym City</span>
                </li>
                <li class="flex items-start">
                    <i class='bx bx-phone text-indigo-400 mr-2 mt-1'></i>
                    <span>(123) 456-7890</span>
                </li>
                <li class="flex items-start">
                    <i class='bx bx-envelope text-indigo-400 mr-2 mt-1'></i>
                    <span>info@fittrackgym.com</span>
                </li>
            </ul>
            <a href="{{ route('contact') }}" class="inline-block mt-4 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition duration-300">Contact Us</a>
        </div>
    </div>
    
    <div class="border-t border-gray-700 mt-8 pt-8 text-center">
        <p class="text-gray-400">&copy; {{ date('Y') }} FitTrack Gym. All rights reserved.</p>
    </div>
</div>
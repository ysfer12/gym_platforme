<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Column 1: Logo & Info -->
        <div>
            <h2 class="text-lg font-semibold text-white mb-4 flex items-center">
                <span class="text-orange-400 mr-1">City</span>
                <span class="text-orange-300">Club</span>
                <span class="ml-1">Fitness</span>
            </h2>
            <p class="text-gray-300 mb-4">
                Your premier fitness destination with state-of-the-art equipment, expert trainers, and a supportive community.
            </p>
            <div class="flex space-x-4 mt-4">
                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                    <i class='bx bxl-facebook text-xl'></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                    <i class='bx bxl-instagram text-xl'></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                    <i class='bx bxl-twitter text-xl'></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                    <i class='bx bxl-youtube text-xl'></i>
                </a>
            </div>
        </div>

        <!-- Column 2: Quick Links -->
        <div>
            <h2 class="text-lg font-semibold text-white mb-4">Quick Links</h2>
            <ul class="space-y-2">
                <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-orange-300 transition-colors duration-300">Home</a></li>
                <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-orange-300 transition-colors duration-300">About</a></li>
                <li><a href="{{ route('subscriptions') }}" class="text-gray-300 hover:text-orange-300 transition-colors duration-300">Subscriptions</a></li>
                <li><a href="{{ route('sessions') }}" class="text-gray-300 hover:text-orange-300 transition-colors duration-300">Sessions</a></li>
                <li><a href="{{ route('trainers') }}" class="text-gray-300 hover:text-orange-300 transition-colors duration-300">Trainers</a></li>
                <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-orange-300 transition-colors duration-300">Contact</a></li>
            </ul>
        </div>

        <!-- Column 3: Opening Hours -->
        <div>
            <h2 class="text-lg font-semibold text-white mb-4">Opening Hours</h2>
            <ul class="space-y-2 text-gray-300">
                <li class="flex items-center">
                    <i class='bx bx-time text-orange-400 mr-2'></i>
                    Monday - Friday: 6:00 AM - 10:00 PM
                </li>
                <li class="flex items-center">
                    <i class='bx bx-time text-orange-400 mr-2'></i>
                    Saturday: 7:00 AM - 9:00 PM
                </li>
                <li class="flex items-center">
                    <i class='bx bx-time text-orange-400 mr-2'></i>
                    Sunday: 8:00 AM - 8:00 PM
                </li>
                <li class="flex items-center">
                    <i class='bx bx-time text-orange-400 mr-2'></i>
                    Public Holidays: 8:00 AM - 8:00 PM
                </li>
            </ul>
        </div>

        <!-- Column 4: Contact Info -->
        <div>
            <h2 class="text-lg font-semibold text-white mb-4">Contact Info</h2>
            <ul class="space-y-2 text-gray-300">
                <li class="flex items-start">
                    <i class='bx bx-map text-orange-400 mr-2 mt-1'></i>
                    <span>123 Fitness Avenue, Gym City</span>
                </li>
                <li class="flex items-start">
                    <i class='bx bx-phone text-orange-400 mr-2 mt-1'></i>
                    <span>(123) 456-7890</span>
                </li>
                <li class="flex items-start">
                    <i class='bx bx-envelope text-orange-400 mr-2 mt-1'></i>
                    <span>info@cityclubfitness.com</span>
                </li>
            </ul>
            <a href="{{ route('contact') }}" class="inline-block mt-4 px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-md transition duration-300">Contact Us</a>
        </div>
    </div>

    <div class="border-t border-gray-700 mt-8 pt-8 text-center">
        <p class="text-gray-400">&copy; {{ date('Y') }} City Club Fitness. All rights reserved.</p>
    </div>
</div>


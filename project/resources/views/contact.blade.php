@extends('layouts.main')

@section('title', 'Contact Us')

@section('content')
<!-- Hero Section -->
<div class="bg-indigo-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Contact Us</h1>
        <p class="text-xl max-w-3xl mx-auto">We're here to help! Reach out with any questions about memberships, classes, or facilities</p>
    </div>
</div>

<!-- Contact Information and Form -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:flex lg:gap-16">
            <!-- Contact Information -->
            <div class="lg:w-1/3 mb-12 lg:mb-0">
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Get In Touch</h2>
                <div class="space-y-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <i class='bx bx-map text-xl'></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Our Location</h3>
                            <p class="mt-2 text-gray-600">123 Fitness Avenue<br>Gym City, GC 12345</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <i class='bx bx-phone text-xl'></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Contact Phone</h3>
                            <p class="mt-2 text-gray-600">+1 (123) 456-7890</p>
                            <p class="mt-1 text-gray-600">+1 (987) 654-3210</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <i class='bx bx-envelope text-xl'></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Email Address</h3>
                            <p class="mt-2 text-gray-600">info@fittrackgym.com</p>
                            <p class="mt-1 text-gray-600">support@fittrackgym.com</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <i class='bx bx-time-five text-xl'></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Working Hours</h3>
                            <p class="mt-2 text-gray-600">Monday - Friday: 6:00 AM - 10:00 PM</p>
                            <p class="mt-1 text-gray-600">Saturday: 7:00 AM - 9:00 PM</p>
                            <p class="mt-1 text-gray-600">Sunday: 8:00 AM - 8:00 PM</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-10">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-indigo-500">
                            <i class='bx bxl-facebook text-2xl'></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-indigo-500">
                            <i class='bx bxl-instagram text-2xl'></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-indigo-500">
                            <i class='bx bxl-twitter text-2xl'></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-indigo-500">
                            <i class='bx bxl-youtube text-2xl'></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="lg:w-2/3 bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-900">Send Us a Message</h2>
                <form action="#" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="first_name" class="block text-gray-700 mb-2">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label for="last_name" class="block text-gray-700 mb-2">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="email" class="block text-gray-700 mb-2">Email Address</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label for="phone" class="block text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="subject" class="block text-gray-700 mb-2">Subject</label>
                        <input type="text" id="subject" name="subject" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                    
                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 mb-2">Message</label>
                        <textarea id="message" name="message" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required></textarea>
                    </div>
                    
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600" required>
                            <span class="ml-2 text-gray-700">I agree to the <a href="#" class="text-indigo-600 hover:underline">privacy policy</a></span>
                        </label>
                    </div>
                    
                    <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-md hover:bg-indigo-700 transition duration-300">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Find Us</h2>
            <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">Conveniently located in the heart of the city with easy access to public transportation</p>
        </div>
        
        <div class="bg-white p-2 rounded-lg shadow-lg">
            <!-- Replace with an actual map embed or image -->
            <div class="h-96 w-full bg-gray-300 rounded-md flex items-center justify-center">
                <span class="text-gray-600">Map Location</span>
                <!-- For a real implementation, you would use something like: -->
                <!-- <iframe src="https://www.google.com/maps/embed?..." width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Frequently Asked Questions</h2>
            <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">Find quick answers to common questions</p>
        </div>
        
        <div class="max-w-3xl mx-auto">
            <div class="space-y-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <button class="flex justify-between items-center w-full text-left focus:outline-none" onclick="toggleContactFaq('contact-faq1')">
                        <h3 class="text-lg font-medium text-gray-900">How do I become a member?</h3>
                        <i class='bx bx-chevron-down text-2xl text-gray-500'></i>
                    </button>
                    <div id="contact-faq1" class="mt-4 hidden">
                        <p class="text-gray-600">You can become a member by visiting our gym in person, registering through our website, or calling our membership hotline. We offer various membership plans to suit different needs and budgets.</p>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <button class="flex justify-between items-center w-full text-left focus:outline-none" onclick="toggleContactFaq('contact-faq2')">
                        <h3 class="text-lg font-medium text-gray-900">What amenities are available?</h3>
                        <i class='bx bx-chevron-down text-2xl text-gray-500'></i>
                    </button>
                    <div id="contact-faq2" class="mt-4 hidden">
                        <p class="text-gray-600">Our gym features state-of-the-art cardio and strength equipment, group fitness studios, locker rooms with showers, sauna and steam rooms, a recovery area, and a nutrition bar. Premium and Elite members also have access to dedicated changing areas and extended facilities.</p>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <button class="flex justify-between items-center w-full text-left focus:outline-none" onclick="toggleContactFaq('contact-faq3')">
                        <h3 class="text-lg font-medium text-gray-900">How do I book a personal training session?</h3>
                        <i class='bx bx-chevron-down text-2xl text-gray-500'></i>
                    </button>
                    <div id="contact-faq3" class="mt-4 hidden">
                        <p class="text-gray-600">You can book a personal training session through our website, mobile app, by calling our front desk, or speaking with any of our trainers in person. We recommend scheduling at least 24 hours in advance to ensure availability with your preferred trainer.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script>
    function toggleContactFaq(id) {
        const element = document.getElementById(id);
        if (element.classList.contains('hidden')) {
            element.classList.remove('hidden');
        } else {
            element.classList.add('hidden');
        }
    }
</script>
@endsection
@endsection
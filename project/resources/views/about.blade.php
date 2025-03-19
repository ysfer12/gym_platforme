@extends('layouts.main')

@section('title', 'About Us')

@section('content')
<!-- Hero Section -->
<div class="bg-indigo-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">About FitTrack Gym</h1>
        <p class="text-xl max-w-3xl mx-auto">Our mission is to help you achieve your fitness goals in a supportive and motivating environment</p>
    </div>
</div>

<!-- Our Story Section -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:flex lg:items-center lg:space-x-12">
            <div class="lg:w-1/2 mb-10 lg:mb-0">
                <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80" alt="Gym Interior" class="rounded-lg shadow-lg w-full h-[400px] object-cover">
            </div>
            <div class="lg:w-1/2">
                <h2 class="text-3xl font-bold mb-6 text-gray-900">Our Story</h2>
                <p class="text-gray-600 mb-4">FitTrack Gym was founded in 2010 with a simple mission: to create a fitness environment where everyone feels welcome and empowered to achieve their health goals.</p>
                <p class="text-gray-600 mb-4">What started as a small local gym has grown into a community of fitness enthusiasts, professional trainers, and health experts all united by the passion for wellness and personal growth.</p>
                <p class="text-gray-600 mb-4">Our philosophy centers around the belief that fitness should be accessible to everyone, regardless of their starting point. We've created programs that accommodate all fitness levels and goals, from beginners taking their first steps toward an active lifestyle to seasoned athletes looking to push their limits.</p>
                <p class="text-gray-600">Over the years, we've helped thousands of members transform their lives, not just physically but mentally and emotionally as well. We take pride in being more than just a gym – we're a supportive community where lasting friendships are formed and personal milestones are celebrated together.</p>
            </div>
        </div>
    </div>
</section>

<!-- Our Values Section -->
<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900">Our Core Values</h2>
            <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">The principles that guide everything we do</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="w-16 h-16 mx-auto bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                    <i class='bx bx-group text-3xl text-indigo-600'></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Community</h3>
                <p class="text-gray-600">We believe in building a supportive community where members inspire and motivate each other.</p>
            </div>
            
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="w-16 h-16 mx-auto bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                    <i class='bx bx-medal text-3xl text-indigo-600'></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Excellence</h3>
                <p class="text-gray-600">We strive for excellence in our facilities, programs, and the service we provide to our members.</p>
            </div>
            
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="w-16 h-16 mx-auto bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                    <i class='bx bx-heart text-3xl text-indigo-600'></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Inclusivity</h3>
                <p class="text-gray-600">We welcome everyone, regardless of fitness level, age, or background, to join our community.</p>
            </div>
            
            <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                <div class="w-16 h-16 mx-auto bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                    <i class='bx bx-trending-up text-3xl text-indigo-600'></i>
                </div>
                <h3 class="text-xl font-semibold mb-4">Growth</h3>
                <p class="text-gray-600">We are committed to helping our members grow and continuously improve their health and fitness.</p>
            </div>
        </div>
    </div>
</section>

<!-- Our Team Section -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900">Meet Our Team</h2>
            <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">The people behind FitTrack Gym</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80" alt="CEO" class="w-full h-64 object-cover">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-semibold mb-2">Michael Thompson</h3>
                    <p class="text-indigo-600 font-medium mb-4">Founder & CEO</p>
                    <p class="text-gray-600 mb-4">Former professional athlete with a passion for helping others achieve their fitness potential.</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-indigo-600">
                            <i class='bx bxl-linkedin'></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600">
                            <i class='bx bxl-twitter'></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600">
                            <i class='bx bxl-instagram'></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1734&q=80" alt="COO" class="w-full h-64 object-cover">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-semibold mb-2">Sarah Johnson</h3>
                    <p class="text-indigo-600 font-medium mb-4">Chief Operations Officer</p>
                    <p class="text-gray-600 mb-4">With 15+ years in fitness center management, Sarah ensures our facilities run smoothly.</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-indigo-600">
                            <i class='bx bxl-linkedin'></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600">
                            <i class='bx bxl-twitter'></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600">
                            <i class='bx bxl-instagram'></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1583468323330-9032ad490fed?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1746&q=80" alt="Fitness Director" class="w-full h-64 object-cover">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-semibold mb-2">David Wilson</h3>
                    <p class="text-indigo-600 font-medium mb-4">Fitness Director</p>
                    <p class="text-gray-600 mb-4">Master trainer with multiple certifications who develops our training programs.</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-indigo-600">
                            <i class='bx bxl-linkedin'></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600">
                            <i class='bx bxl-twitter'></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600">
                            <i class='bx bxl-instagram'></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1548690312-e3b507d8c110?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80" alt="Nutrition Expert" class="w-full h-64 object-cover">
                <div class="p-6 text-center">
                    <h3 class="text-xl font-semibold mb-2">Emily Chen</h3>
                    <p class="text-indigo-600 font-medium mb-4">Nutrition Director</p>
                    <p class="text-gray-600 mb-4">Registered dietitian who leads our nutrition consultation services and wellness programs.</p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="text-gray-400 hover:text-indigo-600">
                            <i class='bx bxl-linkedin'></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600">
                            <i class='bx bxl-twitter'></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600">
                            <i class='bx bxl-instagram'></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-indigo-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="lg:w-0 lg:flex-1">
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Ready to Experience FitTrack Gym?</h2>
                <p class="mt-4 text-lg text-indigo-100 max-w-3xl">Join our community today and start your fitness journey with us.</p>
            </div>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="#" class="px-5 py-3 bg-white text-indigo-600 font-medium rounded-md hover:bg-indigo-50">Join Now</a>
                </div>
                <div class="ml-3 inline-flex rounded-md shadow">
                    <a href="{{ route('contact') }}" class="px-5 py-3 bg-indigo-500 text-white font-medium rounded-md hover:bg-indigo-400">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
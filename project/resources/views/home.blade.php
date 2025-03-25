@extends('layouts.main')

@section('title', 'Home')

@section('styles')
    <style>
        /* Animation Keyframes */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Hero Gradient Animation */
        .hero-gradient {
            background: linear-gradient(-45deg, #4f46e5, #2dd4bf, #3b82f6, #6366f1);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Animation Classes */
        .animate-fadeInUp { animation: fadeInUp 1s ease forwards; }
        .animate-float { animation: float 5s infinite ease-in-out; }
        .animate-pulse { animation: pulse 3s infinite ease-in-out; }

        /* Hover Effects */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Button Effects */
        .btn-3d {
            transition: all 0.2s ease;
        }

        .btn-3d:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #6366f1;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #4f46e5;
        }

        /* Text Gradient */
        .text-gradient {
            background: linear-gradient(to right, #4f46e5, #2dd4bf);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Card Shine Effect */
        .shine {
            position: relative;
            overflow: hidden;
        }

        .shine::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.3) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(30deg);
            transition: transform 0.7s;
            opacity: 0;
        }

        .shine:hover::before {
            opacity: 1;
            transform: rotate(30deg) translate(150%, -150%);
        }

        /* Sticky Navigation */
        .sticky-nav {
            position: sticky;
            top: 0;
            z-index: 50;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Progress Bar */
        .progress-bar {
            height: 6px;
            background: linear-gradient(to right, #4f46e5, #2dd4bf);
            width: 0%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            transition: width 0.3s ease;
        }

        /* Parallax Effect */
        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Tilt Effect */
        .tilt {
            transform-style: preserve-3d;
            transform: perspective(1000px);
        }

        .tilt-inner {
            transform: translateZ(20px);
        }

        /* Timeline */
        .timeline {
            position: relative;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 100%;
            background: linear-gradient(to bottom, #4f46e5, #2dd4bf);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 2rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #4f46e5;
            z-index: 1;
        }

        /* Fitness Calculator */
        .calculator-input {
            @apply w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500;
        }

        .calculator-result {
            @apply mt-4 p-4 bg-indigo-50 rounded-lg border border-indigo-100;
        }

        /* Custom Checkbox */
        .custom-checkbox {
            @apply appearance-none w-5 h-5 border border-gray-300 rounded bg-white checked:bg-indigo-600 checked:border-indigo-600 focus:outline-none transition duration-200 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer;
        }

        /* Floating Labels */
        .floating-label {
            position: relative;
        }

        .floating-label input {
            @apply w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500;
            height: 56px;
        }

        .floating-label label {
            @apply absolute text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] left-4 peer-focus:text-indigo-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4;
        }
    </style>
@endsection

@section('content')
    <!-- Progress Bar -->
    <div id="progress-bar" class="progress-bar"></div>


    <!-- Hero Section -->
    <div class="relative min-h-screen flex items-center justify-center">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                 alt="Gym Background"
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 hero-gradient opacity-70"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="text-white space-y-6 animate-fadeInUp">
                <span class="inline-block px-4 py-1 rounded-full bg-white/20 backdrop-blur-sm text-sm font-semibold mb-2">
                    #1 FITNESS CENTER IN THE CITY
                </span>
                    <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
                        TRANSFORM <br>YOUR <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-indigo-200">BODY</span>
                    </h1>
                    <p class="text-xl md:text-2xl font-light max-w-xl leading-relaxed">
                        Join City Club Gym today and embark on a fitness journey guided by expert trainers using state-of-the-art equipment.
                    </p>
                    <div class="pt-4 flex flex-wrap gap-4">
                        <a href="#" class="btn-3d px-8 py-4 bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-bold rounded-full hover:shadow-xl transition-all duration-300 flex items-center justify-center">
                            <span>GET STARTED NOW</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="{{ route('subscriptions') }}" class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-indigo-700 transition-all duration-300 flex items-center justify-center">
                            <span>VIEW PLANS</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    <div class="flex flex-wrap items-center space-x-4 md:space-x-8 pt-6">
                        <div class="flex flex-col items-center glass rounded-xl p-3">
                            <span class="text-4xl md:text-5xl font-bold">50+</span>
                            <span class="text-xs md:text-sm uppercase tracking-wider">Expert<br>Trainers</span>
                        </div>
                        <div class="flex flex-col items-center glass rounded-xl p-3">
                            <span class="text-4xl md:text-5xl font-bold">100+</span>
                            <span class="text-xs md:text-sm uppercase tracking-wider">Weekly<br>Classes</span>
                        </div>
                        <div class="flex flex-col items-center glass rounded-xl p-3">
                            <span class="text-4xl md:text-5xl font-bold">24/7</span>
                            <span class="text-xs md:text-sm uppercase tracking-wider">Access<br>Available</span>
                        </div>
                    </div>
                </div>

                <div class="hidden lg:block">
                    <div class="relative">
                        <div class="absolute -top-10 -left-10 w-40 h-40 bg-indigo-500 rounded-full opacity-20 animate-pulse"></div>
                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-500 rounded-full opacity-20 animate-pulse"></div>
                        <img src="https://images.unsplash.com/photo-1549060279-7e168fcee0c2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                             alt="Fitness Transformation"
                             class="rounded-3xl shadow-2xl animate-float relative z-10">
                        <div class="absolute -bottom-8 -left-8 glass text-white p-6 rounded-xl z-20 shine">
                            <div class="flex items-center space-x-4">
                                <div class="bg-white/20 rounded-full p-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold">Sarah Transformed</p>
                                    <p class="text-sm opacity-80">Lost 45 pounds in 6 months</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 text-white text-center">
            <p class="text-sm mb-2 opacity-80">Scroll Down</p>
            <div class="animate-bounce w-10 h-10 mx-auto glass rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
            <span class="inline-block px-3 py-1 rounded-full bg-indigo-100 text-indigo-600 text-sm font-semibold mb-2">
                WHY CHOOSE US
            </span>
                <h2 class="mt-2 text-4xl leading-tight font-bold text-gray-900 sm:text-5xl">
                    Elevate Your Fitness Experience
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-blue-500 mx-auto my-4 rounded-full"></div>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    City Club offers a premium fitness environment with everything you need to achieve your health and wellness goals.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden shine">
                    <div class="relative h-56">
                        <img src="https://images.unsplash.com/photo-1593079831268-3381b0db4a77?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80"
                             alt="Modern Equipment"
                             class="w-full h-full object-cover transition-all duration-500 hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold">State-of-the-Art Equipment</h4>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600">
                            Access the latest fitness technology and equipment designed to maximize results and enhance your workout experience.
                        </p>
                        <ul class="mt-4 space-y-2">
                            <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                                <span class="ml-3 text-gray-700">Premium cardio machines</span>
                            </li>
                            <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                                <span class="ml-3 text-gray-700">Free weight area</span>
                            </li>
                            <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                                <span class="ml-3 text-gray-700">Specialized training zones</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden shine">
                    <div class="relative h-56">
                        <img src="https://images.unsplash.com/photo-1599058917765-a780eda07a3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80"
                             alt="Expert Trainers"
                             class="w-full h-full object-cover transition-all duration-500 hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold">Expert Certified Trainers</h4>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600">
                            Work with our team of certified professionals who are passionate about helping you achieve your fitness goals.
                        </p>
                        <ul class="mt-4 space-y-2">
                            <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                                <span class="ml-3 text-gray-700">Personalized coaching</span>
                            </li>
                            <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                                <span class="ml-3 text-gray-700">Customized workout plans</span>
                            </li>
                            <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                                <span class="ml-3 text-gray-700">Nutritional guidance</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden shine">
                    <div class="relative h-56">
                        <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1375&q=80"
                             alt="Classes"
                             class="w-full h-full object-cover transition-all duration-500 hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold">Diverse Class Selection</h4>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600">
                            Choose from a wide variety of fitness classes designed for all levels, interests, and fitness goals.
                        </p>
                        <ul class="mt-4 space-y-2">
                            <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                                <span class="ml-3 text-gray-700">HIIT, yoga, cycling & more</span>
                            </li>
                            <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                                <span class="ml-3 text-gray-700">All fitness levels welcome</span>
                            </li>
                            <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                                <span class="ml-3 text-gray-700">Flexible scheduling</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Class Schedule Section -->
    <section id="classes" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
            <span class="inline-block px-3 py-1 rounded-full bg-indigo-100 text-indigo-600 text-sm font-semibold mb-2">
                OUR CLASSES
            </span>
                <h2 class="mt-2 text-4xl leading-tight font-bold text-gray-900 sm:text-5xl">
                    Find Your Perfect Workout
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-blue-500 mx-auto my-4 rounded-full"></div>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Explore our diverse range of classes designed to challenge, motivate, and transform your body.
                </p>
            </div>

            <!-- Class Schedule Tabs -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden" x-data="{ activeDay: 'monday' }">
                <!-- Days of Week Tabs -->
                <div class="flex overflow-x-auto scrollbar-hide border-b">
                    <button @click="activeDay = 'monday'" :class="{ 'border-indigo-500 text-indigo-600': activeDay === 'monday' }" class="flex-shrink-0 px-6 py-4 text-sm font-medium border-b-2 border-transparent hover:text-indigo-600 hover:border-indigo-300 focus:outline-none">
                        Monday
                    </button>
                    <button @click="activeDay = 'tuesday'" :class="{ 'border-indigo-500 text-indigo-600': activeDay === 'tuesday' }" class="flex-shrink-0 px-6 py-4 text-sm font-medium border-b-2 border-transparent hover:text-indigo-600 hover:border-indigo-300 focus:outline-none">
                        Tuesday
                    </button>
                    <button @click="activeDay = 'wednesday'" :class="{ 'border-indigo-500 text-indigo-600': activeDay === 'wednesday' }" class="flex-shrink-0 px-6 py-4 text-sm font-medium border-b-2 border-transparent hover:text-indigo-600 hover:border-indigo-300 focus:outline-none">
                        Wednesday
                    </button>
                    <button @click="activeDay = 'thursday'" :class="{ 'border-indigo-500 text-indigo-600': activeDay === 'thursday' }" class="flex-shrink-0 px-6 py-4 text-sm font-medium border-b-2 border-transparent hover:text-indigo-600 hover:border-indigo-300 focus:outline-none">
                        Thursday
                    </button>
                    <button @click="activeDay = 'friday'" :class="{ 'border-indigo-500 text-indigo-600': activeDay === 'friday' }" class="flex-shrink-0 px-6 py-4 text-sm font-medium border-b-2 border-transparent hover:text-indigo-600 hover:border-indigo-300 focus:outline-none">
                        Friday
                    </button>
                    <button @click="activeDay = 'saturday'" :class="{ 'border-indigo-500 text-indigo-600': activeDay === 'saturday' }" class="flex-shrink-0 px-6 py-4 text-sm font-medium border-b-2 border-transparent hover:text-indigo-600 hover:border-indigo-300 focus:outline-none">
                        Saturday
                    </button>
                    <button @click="activeDay = 'sunday'" :class="{ 'border-indigo-500 text-indigo-600': activeDay === 'sunday' }" class="flex-shrink-0 px-6 py-4 text-sm font-medium border-b-2 border-transparent hover:text-indigo-600 hover:border-indigo-300 focus:outline-none">
                        Sunday
                    </button>
                </div>

                <!-- Monday Schedule -->
                <div x-show="activeDay === 'monday'" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Class 1 -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100 hover:shadow-md transition-all">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-gray-900">Morning HIIT</h4>
                                    <p class="text-sm text-gray-600">6:00 AM - 7:00 AM</p>
                                </div>
                                <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">Intermediate</span>
                            </div>
                            <div class="mt-3 flex items-center">
                                <img src="https://images.unsplash.com/photo-1597347324655-f353ada5ffe8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Trainer" class="w-8 h-8 rounded-full mr-2">
                                <span class="text-sm text-gray-700">Coach Mike</span>
                            </div>
                            <button class="mt-3 w-full py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                                Book Class
                            </button>
                        </div>

                        <!-- Class 2 -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100 hover:shadow-md transition-all">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-gray-900">Yoga Flow</h4>
                                    <p class="text-sm text-gray-600">9:00 AM - 10:00 AM</p>
                                </div>
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">All Levels</span>
                            </div>
                            <div class="mt-3 flex items-center">
                                <img src="https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Trainer" class="w-8 h-8 rounded-full mr-2">
                                <span class="text-sm text-gray-700">Coach Sarah</span>
                            </div>
                            <button class="mt-3 w-full py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                                Book Class
                            </button>
                        </div>

                        <!-- Class 3 -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100 hover:shadow-md transition-all">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-gray-900">Spin Class</h4>
                                    <p class="text-sm text-gray-600">5:30 PM - 6:30 PM</p>
                                </div>
                                <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">Intermediate</span>
                            </div>
                            <div class="mt-3 flex items-center">
                                <img src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Trainer" class="w-8 h-8 rounded-full mr-2">
                                <span class="text-sm text-gray-700">Coach Alex</span>
                            </div>
                            <button class="mt-3 w-full py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                                Book Class
                            </button>
                        </div>

                        <!-- Class 4 -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100 hover:shadow-md transition-all">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-gray-900">Strength Training</h4>
                                    <p class="text-sm text-gray-600">6:45 PM - 7:45 PM</p>
                                </div>
                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">Advanced</span>
                            </div>
                            <div class="mt-3 flex items-center">
                                <img src="https://images.unsplash.com/photo-1534367610401-9f5ed68180aa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Trainer" class="w-8 h-8 rounded-full mr-2">
                                <span class="text-sm text-gray-700">Coach James</span>
                            </div>
                            <button class="mt-3 w-full py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                                Book Class
                            </button>
                        </div>

                        <!-- Class 5 -->
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-100 hover:shadow-md transition-all">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-bold text-gray-900">Evening Pilates</h4>
                                    <p class="text-sm text-gray-600">8:00 PM - 9:00 PM</p>
                                </div>
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">All Levels</span>
                            </div>
                            <div class="mt-3 flex items-center">
                                <img src="https://images.unsplash.com/photo-1548690312-e3b507d8c110?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Trainer" class="w-8 h-8 rounded-full mr-2">
                                <span class="text-sm text-gray-700">Coach Emma</span>
                            </div>
                            <button class="mt-3 w-full py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                                Book Class
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Other days would have similar structure but different classes -->
                <div x-show="activeDay !== 'monday'" class="p-6 text-center text-gray-500">
                    <p>Please select Monday to view the sample schedule. In a real implementation, each day would have its own schedule.</p>
                </div>
            </div>

            <!-- View Full Schedule Button -->
            <div class="mt-10 text-center">
                <a href="{{ route('sessions') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    View Full Schedule
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Trainers Section -->
    <section id="trainers" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
            <span class="inline-block px-3 py-1 rounded-full bg-indigo-100 text-indigo-600 text-sm font-semibold mb-2">
                EXPERT TRAINERS
            </span>
                <h2 class="mt-2 text-4xl leading-tight font-bold text-gray-900 sm:text-5xl">
                    Meet Our Fitness Professionals
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-blue-500 mx-auto my-4 rounded-full"></div>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Our certified trainers are dedicated to helping you achieve your fitness goals with personalized guidance.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Trainer 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden group">
                    <div class="relative h-80">
                        <img src="https://images.unsplash.com/photo-1597347324655-f353ada5ffe8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                             alt="Trainer Mike"
                             class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform">
                            <div class="flex space-x-3 justify-center">
                                <a href="#" class="bg-white/20 p-2 rounded-full hover:bg-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                                    </svg>
                                </a>
                                <a href="#" class="bg-white/20 p-2 rounded-full hover:bg-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                    </svg>
                                </a>
                                <a href="#" class="bg-white/20 p-2 rounded-full hover:bg-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900">Mike Johnson</h4>
                        <p class="text-indigo-600 font-medium">HIIT & Strength Specialist</p>
                        <p class="mt-2 text-gray-600">
                            With 10+ years of experience, Mike specializes in high-intensity training and strength conditioning.
                        </p>
                        <div class="mt-4 flex items-center">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <span class="ml-2 text-gray-600 text-sm">5.0 (128 reviews)</span>
                        </div>
                    </div>
                </div>

                <!-- Trainer 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden group">
                    <div class="relative h-80">
                        <img src="https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                             alt="Trainer Sarah"
                             class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform">
                            <div class="flex space-x-3 justify-center">
                                <a href="#" class="bg-white/20 p-2 rounded-full hover:bg-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                                    </svg>
                                </a>
                                <a href="#" class="bg-white/20 p-2 rounded-full hover:bg-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                    </svg>
                                </a>
                                <a href="#" class="bg-white/20 p-2 rounded-full hover:bg-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900">Sarah Williams</h4>
                        <p class="text-indigo-600 font-medium">Yoga & Pilates Instructor</p>
                        <p class="mt-2 text-gray-600">
                            Sarah is a certified yoga instructor with expertise in mindfulness and body alignment techniques.
                        </p>
                        <div class="mt-4 flex items-center">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <span class="ml-2 text-gray-600 text-sm">5.0 (96 reviews)</span>
                        </div>
                    </div>
                </div>

                <!-- Trainer 3 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden group">
                    <div class="relative h-80">
                        <img src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                             alt="Trainer Alex"
                             class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform">
                            <div class="flex space-x-3 justify-center">
                                <a href="#" class="bg-white/20 p-2 rounded-full hover:bg-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                                    </svg>
                                </a>
                                <a href="#" class="bg-white/20 p-2 rounded-full hover:bg-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                    </svg>
                                </a>
                                <a href="#" class="bg-white/20 p-2 rounded-full hover:bg-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900">Alex Rodriguez</h4>
                        <p class="text-indigo-600 font-medium">Cardio & Cycling Expert</p>
                        <p class="mt-2 text-gray-600">
                            Alex specializes in high-energy cardio workouts and cycling classes that push your limits.
                        </p>
                        <div class="mt-4 flex items-center">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <span class="ml-2 text-gray-600 text-sm">4.9 (87 reviews)</span>
                        </div>
                    </div>
                </div>

                <!-- Trainer 4 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden group">
                    <div class="relative h-80">
                        <img src="https://images.unsplash.com/photo-1548690312-e3b507d8c110?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                             alt="Trainer Emma"
                             class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white transform translate-y-full group-hover:translate-y-0 transition-transform">
                            <div class="flex space-x-3 justify-center">
                                <a href="#" class="bg-white/20 p-2 rounded-full hover:bg-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                                    </svg>
                                </a>
                                <a href="#" class="bg-white/20 p-2 rounded-full hover:bg-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.  viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                    </svg>
                                </a>
                                <a href="#" class="bg-white/20 p-2 rounded-full hover:bg-indigo-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900">Emma Davis</h4>
                        <p class="text-indigo-600 font-medium">Nutrition & Wellness Coach</p>
                        <p class="mt-2 text-gray-600">
                            Emma combines fitness training with nutrition coaching to help you achieve holistic wellness.
                        </p>
                        <div class="mt-4 flex items-center">
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <span class="ml-2 text-gray-600 text-sm">4.8 (112 reviews)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View All Trainers Button -->
            <div class="mt-10 text-center">
                <a href="{{ route('trainers') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    View All Trainers
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Membership Plans Section -->
    <section id="pricing" class="py-20 bg-gradient-to-br from-indigo-900 via-indigo-800 to-purple-900 text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
            <span class="inline-block px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm text-sm font-semibold mb-2">
                MEMBERSHIP OPTIONS
            </span>
                <h3 class="mt-2 text-4xl leading-tight font-bold sm:text-5xl">
                    Find Your Perfect Plan
                </h3>
                <div class="w-24 h-1 bg-gradient-to-r from-indigo-300 to-blue-300 mx-auto my-4 rounded-full"></div>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-indigo-200">
                    Choose the membership that fits your lifestyle and helps you achieve your fitness goals.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Basic Plan -->
                <div class="rounded-2xl overflow-hidden bg-gradient-to-br from-gray-900 to-gray-800 shadow-xl transform transition-all duration-500 relative card-hover">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-gray-700 to-gray-600"></div>
                    <div class="p-8">
                        <h4 class="text-xl font-bold mb-2">Basic</h4>
                        <div class="flex items-baseline">
                            <span class="text-5xl font-bold">$29</span>
                            <span class="ml-2 text-xl text-indigo-300">/month</span>
                        </div>
                        <p class="mt-4 text-indigo-200">Perfect for beginners and those looking for essential gym access.</p>
                        <ul class="mt-6 space-y-4">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Standard gym access</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Basic locker room access</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Initial fitness assessment</span>
                            </li>
                            <li class="flex items-center text-indigo-300/60">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <span class="line-through">Group classes</span>
                            </li>
                            <li class="flex items-center text-indigo-300/60">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <span class="line-through">Personal training sessions</span>
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="{{ route('subscriptions') }}" class="btn-3d block w-full py-3 px-4 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-center font-medium transition duration-300">
                                Choose Basic
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Premium Plan -->
                <div class="rounded-2xl overflow-hidden bg-gradient-to-br from-indigo-600 to-indigo-500 shadow-2xl transform transition-all duration-500 relative card-hover scale-105 z-10">
                    <div class="absolute -top-4 right-4">
                        <div class="bg-gradient-to-r from-yellow-400 to-amber-500 text-indigo-900 text-xs font-bold px-6 py-1 rounded-full transform rotate-2 shadow-lg">
                            MOST POPULAR
                        </div>
                    </div>
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-400 to-indigo-300"></div>
                    <div class="p-8">
                        <h4 class="text-xl font-bold mb-2">Premium</h4>
                        <div class="flex items-baseline">
                            <span class="text-5xl font-bold">$59</span>
                            <span class="ml-2 text-xl text-indigo-100">/month</span>
                        </div>
                        <p class="mt-4 text-indigo-100">The perfect balance of features for serious fitness enthusiasts.</p>
                        <ul class="mt-6 space-y-4">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Extended gym access</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Premium locker room access</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Unlimited group classes</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>2 trainer sessions/month</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Quarterly fitness assessment</span>
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="{{ route('subscriptions') }}" class="btn-3d block w-full py-3 px-4 rounded-lg bg-white text-indigo-600 hover:bg-indigo-50 text-center font-medium transition duration-300">
                                Choose Premium
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Elite Plan -->
                <div class="rounded-2xl overflow-hidden bg-gradient-to-br from-gray-900 to-gray-800 shadow-xl transform transition-all duration-500 relative card-hover">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-gray-700 to-gray-600"></div>
                    <div class="p-8">
                        <h4 class="text-xl font-bold mb-2">Elite</h4>
                        <div class="flex items-baseline">
                            <span class="text-5xl font-bold">$99</span>
                            <span class="ml-2 text-xl text-indigo-300">/month</span>
                        </div>
                        <p class="mt-4 text-indigo-200">The ultimate fitness experience with premium perks and unlimited access.</p>
                        <ul class="mt-6 space-y-4">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>24/7 gym access</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Exclusive locker with amenities</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>All group classes + priority</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Unlimited trainer sessions</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span>Nutrition consultation included</span>
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="{{ route('subscriptions') }}" class="btn-3d block w-full py-3 px-4 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white text-center font-medium transition duration-300">
                                Choose Elite
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Corporate Plans -->
            <div class="mt-16 text-center">
                <h4 class="text-2xl font-bold mb-4">Looking for Corporate Plans?</h4>
                <p class="text-indigo-200 max-w-2xl mx-auto mb-6">
                    We offer special rates for companies looking to provide fitness benefits to their employees. Contact our corporate team for customized packages that fit your company's needs and budget.
                </p>
                <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-900 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                    Contact for Corporate Rates
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
            <span class="inline-block px-3 py-1 rounded-full bg-indigo-100 text-indigo-600 text-sm font-semibold mb-2">
                TESTIMONIALS
            </span>
                <h3 class="mt-2 text-4xl leading-tight font-bold text-gray-900 sm:text-5xl">
                    Success Stories from Our Members
                </h3>
                <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-blue-500 mx-auto my-4 rounded-full"></div>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Hear from the people who have transformed their lives with City Club Gym.
                </p>
            </div>

            <!-- Testimonial Slider -->
            <div class="relative" x-data="{ activeSlide: 1 }">
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-in-out" :style="{ transform: `translateX(-${(activeSlide - 1) * 100}%)` }">
                        <!-- Testimonial 1 -->
                        <div class="w-full flex-shrink-0 px-4">
                            <div class="flex flex-col md:flex-row gap-8">
                                <div class="md:w-1/2 bg-white rounded-2xl shadow-xl p-8 transform transition-all duration-500 hover:shadow-2xl">
                                    <div class="flex items-center mb-6">
                                        <img src="https://images.unsplash.com/photo-1603415526960-f7e0328c63b1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                                             alt="Testimonial 1"
                                             class="w-16 h-16 rounded-full object-cover mr-4 border-4 border-indigo-100">
                                        <div>
                                            <h4 class="text-xl font-bold text-gray-900">Michael Thompson</h4>
                                            <p class="text-indigo-600">Member for 2 years</p>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-100 absolute -top-6 -left-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                        </svg>
                                        <p class="text-gray-600 relative z-10 pl-4">
                                            "I've tried many gyms over the years, but City Club is by far the best. The trainers are knowledgeable and supportive, and the equipment is always well-maintained. Since joining, I've lost 30 pounds and gained significant muscle mass. More importantly, I've found a supportive community that keeps me motivated."
                                        </p>
                                        <div class="mt-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="md:w-1/2 bg-white rounded-2xl shadow-xl p-8 transform transition-all duration-500 hover:shadow-2xl">
                                    <div class="flex items-center mb-6">
                                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1488&q=80"
                                             alt="Testimonial 2"
                                             class="w-16 h-16 rounded-full object-cover mr-4 border-4 border-indigo-100">
                                        <div>
                                            <h4 class="text-xl font-bold text-gray-900">Jennifer Adams</h4>
                                            <p class="text-indigo-600">Member for 1 year</p>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-100 absolute -top-6 -left-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                        </svg>
                                        <p class="text-gray-600 relative z-10 pl-4">
                                            "The variety of classes at City Club keeps my workout routine exciting and challenging. Sarah's yoga classes have improved my flexibility and reduced my stress levels significantly. The nutrition guidance has completely changed my relationship with food. What I love most is the community here—everyone is so supportive and encouraging!"
                                        </p>
                                        <div class="mt-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 2 -->
                        <div class="w-full flex-shrink-0 px-4">
                            <div class="flex flex-col md:flex-row gap-8">
                                <div class="md:w-1/2 bg-white rounded-2xl shadow-xl p-8 transform transition-all duration-500 hover:shadow-2xl">
                                    <div class="flex items-center mb-6">
                                        <img src="https://images.unsplash.com/photo-1534367610401-9f5ed68180aa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                                             alt="Testimonial 3"
                                             class="w-16 h-16 rounded-full object-cover mr-4 border-4 border-indigo-100">
                                        <div>
                                            <h4 class="text-xl font-bold text-gray-900">David Wilson</h4>
                                            <p class="text-indigo-600">Member for 3 years</p>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-100 absolute -top-6 -left-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                        </svg>
                                        <p class="text-gray-600 relative z-10 pl-4">
                                            "As someone who travels frequently for work, the 24/7 access at City Club has been a game-changer. I can work out whenever my schedule allows, and the app makes it easy to book classes and track my progress. The Elite membership is worth every penny for the personalized attention and premium amenities."
                                        </p>
                                        <div class="mt-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="md:w-1/2 bg-white rounded-2xl shadow-xl p-8 transform transition-all duration-500 hover:shadow-2xl">
                                    <div class="flex items-center mb-6">
                                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=761&q=80"
                                             alt="Testimonial 4"
                                             class="w-16 h-16 rounded-full object-cover mr-4 border-4 border-indigo-100">
                                        <div>
                                            <h4 class="text-xl font-bold text-gray-900">Sophia Chen</h4>
                                            <p class="text-indigo-600">Member for 6 months</p>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-100 absolute -top-6 -left-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                                        </svg>
                                        <p class="text-gray-600 relative z-10 pl-4">
                                            "As a beginner, I was intimidated to join a gym, but the staff at City Club made me feel welcome from day one. The introductory sessions helped me learn proper form, and the trainers create workouts tailored to my goals. In just six months, I've gained confidence and seen amazing results!"
                                        </p>
                                        <div class="mt-4 flex">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slider Controls -->
                <div class="flex justify-center mt-8 space-x-4">
                    <button @click="activeSlide = 1" :class="{ 'bg-indigo-600': activeSlide === 1, 'bg-gray-300': activeSlide !== 1 }" class="w-3 h-3 rounded-full focus:outline-none"></button>
                    <button @click="activeSlide = 2" :class="{ 'bg-indigo-600': activeSlide === 2, 'bg-gray-300': activeSlide !== 2 }" class="w-3 h-3 rounded-full focus:outline-none"></button>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="mt-16 text-center">
                <a href="{{ route('subscriptions') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-blue-500 text-white font-bold rounded-full hover:shadow-xl transition-all duration-300">
                    Join Our Community Today
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Fitness App Section -->
    <section id="app" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2">
                <span class="inline-block px-3 py-1 rounded-full bg-indigo-100 text-indigo-600 text-sm font-semibold mb-2">
                    MOBILE APP
                </span>
                    <h3 class="mt-2 text-4xl leading-tight font-bold text-gray-900 sm:text-5xl">
                        Take Your Fitness Journey Anywhere
                    </h3>
                    <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-blue-500 my-4 rounded-full"></div>
                    <p class="mt-4 text-xl text-gray-600 mb-8">
                        Download our mobile app to track your workouts, book classes, monitor your progress, and stay connected with your fitness community.
                    </p>

                    <div class="space-y-6">
                        <!-- Feature 1 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-indigo-100 rounded-full p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">Workout Tracking</h4>
                                <p class="mt-1 text-gray-600">Log your workouts, track your sets, reps, and weights to monitor your progress over time.</p>
                            </div>
                        </div>

                        <!-- Feature 2 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-indigo-100 rounded-full p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">Class Scheduling</h4>
                                <p class="mt-1 text-gray-600">Browse and book classes, receive reminders, and manage your fitness schedule with ease.</p>
                            </div>
                        </div>

                        <!-- Feature 3 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-indigo-100 rounded-full p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-bold text-gray-900">Progress Analytics</h4>
                                <p class="mt-1 text-gray-600">Visualize your fitness journey with detailed charts and analytics to stay motivated.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex space-x-4">
                        <a href="#" class="flex items-center bg-black text-white px-4 py-3 rounded-lg hover:bg-gray-800 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                            </svg>
                            <div>
                                <div class="text-xs">Download on the</div>
                                <div class="text-xl font-semibold font-sans -mt-1">App Store</div>
                            </div>
                        </a>
                        <a href="#" class="flex items-center bg-black text-white px-4 py-3 rounded-lg hover:bg-gray-800 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <div class="text-xs">GET IT ON</div>
                                <div class="text-xl font-semibold font-sans -mt-1">Google Play</div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="lg:w-1/2 relative">
                    <div class="absolute -top-10 -left-10 w-40 h-40 bg-indigo-500 rounded-full opacity-10 animate-pulse"></div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-500 rounded-full opacity-10 animate-pulse"></div>

                    <div class="relative z-10 flex justify-center">
                        <div class="relative mx-6">
                            <img src="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80"
                                 alt="Fitness App"
                                 class="rounded-3xl shadow-2xl max-w-xs mx-auto">
                            <div class="absolute -bottom-6 -right-6 glass text-white p-4 rounded-xl z-20 shine">
                                <div class="flex items-center space-x-2">
                                    <div class="bg-white/20 rounded-full p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm">4.9 Star Rating</p>
                                        <p class="text-xs opacity-80">10,000+ Downloads</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BMI Calculator Section -->
    <section id="calculator" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
            <span class="inline-block px-3 py-1 rounded-full bg-indigo-100 text-indigo-600 text-sm font-semibold mb-2">
                FITNESS TOOLS
            </span>
                <h3 class="mt-2 text-4xl leading-tight font-bold text-gray-900 sm:text-5xl">
                    Calculate Your BMI
                </h3>
                <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-blue-500 mx-auto my-4 rounded-full"></div>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Use our BMI calculator to get a quick assessment of your body mass index and understand your health status.
                </p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-8 bg-gradient-to-br from-indigo-600 to-indigo-700 text-white">
                            <h4 class="text-2xl font-bold mb-4">What is BMI?</h4>
                            <p class="mb-6">
                                Body Mass Index (BMI) is a measure of body fat based on height and weight that applies to adult men and women. It's a simple way to assess if you're underweight, normal weight, overweight, or obese.
                            </p>

                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-blue-300 rounded-full mr-3"></div>
                                    <div>
                                        <span class="font-semibold">Below 18.5:</span> Underweight
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-300 rounded-full mr-3"></div>
                                    <div>
                                        <span class="font-semibold">18.5 - 24.9:</span> Normal weight
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-yellow-300 rounded-full mr-3"></div>
                                    <div>
                                        <span class="font-semibold">25 - 29.9:</span> Overweight
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-red-300 rounded-full mr-3"></div>
                                    <div>
                                        <span class="font-semibold">30 and above:</span> Obese
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8">
                                <p class="text-indigo-200 text-sm">
                                    Note: BMI is a general indicator and doesn't account for factors like muscle mass, bone density, and overall body composition. Consult with a healthcare professional for a comprehensive assessment.
                                </p>
                            </div>
                        </div>

                        <div class="p-8" x-data="{
                        weight: '',
                        height: '',
                        bmi: null,
                        category: '',
                        calculateBMI() {
                            if (this.weight && this.height) {
                                const heightInMeters = this.height / 100;
                                this.bmi = (this.weight / (heightInMeters * heightInMeters)).toFixed(1);

                                if (this.bmi < 18.5) {
                                    this.category = 'Underweight';
                                } else if (this.bmi >= 18.5 && this.bmi < 25) {
                                    this.category = 'Normal weight';
                                } else if (this.bmi >= 25 && this.bmi < 30) {
                                    this.category = 'Overweight';
                                } else {
                                    this.category = 'Obese';
                                }
                            }
                        }
                    }">
                            <h4 class="text-2xl font-bold text-gray-900 mb-6">Calculate Your BMI</h4>

                            <div class="space-y-6">
                                <div>
                                    <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">Weight (kg)</label>
                                    <input type="number" id="weight" x-model="weight" class="calculator-input" placeholder="Enter your weight">
                                </div>

                                <div>
                                    <label for="height" class="block text-sm font-medium text-gray-700 mb-1">Height (cm)</label>
                                    <input type="number" id="height" x-model="height" class="calculator-input" placeholder="Enter your height">
                                </div>

                                <button @click="calculateBMI()" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors">
                                    Calculate BMI
                                </button>

                                <div x-show="bmi" x-cloak class="calculator-result">
                                    <div class="text-center">
                                        <p class="text-gray-700">Your BMI is</p>
                                        <p class="text-3xl font-bold text-indigo-600" x-text="bmi"></p>
                                        <p class="text-lg font-medium" :class="{
                                        'text-blue-600': category === 'Underweight',
                                        'text-green-600': category === 'Normal weight',
                                        'text-yellow-600': category === 'Overweight',
                                        'text-red-600': category === 'Obese'
                                    }" x-text="category"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('contact') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                        <span>Talk to a fitness expert about your results</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-20 bg-gradient-to-br from-indigo-900 via-indigo-800 to-purple-900 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h3 class="text-3xl md:text-4xl font-bold mb-4">Stay Updated with Fitness Tips</h3>
                <p class="text-xl text-indigo-200 mb-8">
                    Subscribe to our newsletter for weekly workout tips, nutrition advice, and exclusive member offers.
                </p>

                <form class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
                    <input type="email" placeholder="Enter your email" class="flex-grow px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-300">
                    <button type="submit" class="btn-3d px-6 py-3 bg-white text-indigo-600 font-bold rounded-lg hover:bg-indigo-50 transition-all duration-300">
                        Subscribe
                    </button>
                </form>

                <p class="mt-4 text-sm text-indigo-300">
                    We respect your privacy. Unsubscribe at any time.
                </p>
            </div>
        </div>
    </section>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 bg-indigo-600 text-white p-3 rounded-full shadow-lg opacity-0 invisible transition-all duration-300 z-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

@endsection

@section('scripts')
    <script>
        // Progress Bar
        window.addEventListener('scroll', function() {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.getElementById('progress-bar').style.width = scrolled + '%';

            // Back to Top Button
            const backToTopButton = document.getElementById('back-to-top');
            if (winScroll > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.add('opacity-0', 'invisible');
                backToTopButton.classList.remove('opacity-100', 'visible');
            }
        });

        // Back to Top Button Click
        document.getElementById('back-to-top').addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth Scroll for Navigation Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Initialize Alpine.js components if needed
        document.addEventListener('alpine:init', () => {
            // Any Alpine.js initialization can go here
        });
    </script>
@endsection

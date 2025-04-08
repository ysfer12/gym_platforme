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

        /* Gradient Animation */
        .animated-gradient {
            background: linear-gradient(-45deg, #ff5e14, #ff7a00, #ff8c00, #ff9500);
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
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .card-hover:hover {
            transform: translateY(-15px);
            box-shadow: 0 30px 60px -12px rgba(50, 50, 93, 0.25), 0 18px 36px -18px rgba(0, 0, 0, 0.3);
        }

        /* Button Effects */
        .btn-3d {
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .btn-3d:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(255, 94, 20, 0.4), 0 10px 10px -5px rgba(255, 94, 20, 0.3);
        }

        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        /* Decorative Elements */
        .circle-decoration {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 94, 20, 0.15);
            z-index: 0;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            top: -150px;
            right: -150px;
        }

        .circle-2 {
            width: 200px;
            height: 200px;
            bottom: -100px;
            left: -100px;
        }

        /* Diagonal Divider */
        .diagonal-divider {
            position: relative;
            height: 150px;
            overflow: hidden;
        }

        .diagonal-divider::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            clip-path: polygon(0 100%, 100% 0, 100% 100%);
        }

        .diagonal-divider-bottom {
            position: relative;
            height: 150px;
            overflow: hidden;
        }

        .diagonal-divider-bottom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            clip-path: polygon(0 0, 100% 0, 0 100%);
        }

        /* Custom Checkbox */
        .custom-checkbox {
            display: flex;
            align-items: center;
        }

        .custom-checkbox-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff5e14, #ff8c00);
            display: flex;
            align-items: center;
            justify-center: center;
            margin-right: 12px;
            color: white;
            box-shadow: 0 4px 10px rgba(255, 94, 20, 0.3);
        }

        /* Pricing Card Styles */
        .pricing-card {
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .pricing-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.1);
        }

        .pricing-card.featured {
            position: relative;
            z-index: 1;
            transform: scale(1.05);
        }

        .pricing-card.featured:hover {
            transform: scale(1.05) translateY(-15px);
        }

        /* Testimonial Card */
        .testimonial-card {
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px rgba(0,0,0,0.1);
        }

        /* Scroll Reveal Animation */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(to right, #ff5e14, #ff8c00);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Blob Shape */
        .blob-shape {
            position: absolute;
            z-index: -1;
            opacity: 0.1;
        }

        /* Class Schedule Styles */
        .schedule-tab {
            transition: all 0.3s ease;
        }

        .schedule-tab.active {
            background: linear-gradient(to right, #ff5e14, #ff8c00);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(255, 94, 20, 0.3), 0 4px 6px -2px rgba(255, 94, 20, 0.2);
        }

        .schedule-item {
            transition: all 0.3s ease;
        }

        .schedule-item:hover {
            background-color: #fff8f1;
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Gallery Styles */
        .gallery-item {
            overflow: hidden;
            position: relative;
            border-radius: 12px;
        }

        .gallery-item img {
            transition: all 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-item .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 60%);
            opacity: 0;
            transition: all 0.3s ease;
        }

        .gallery-item:hover .overlay {
            opacity: 1;
        }

        /* Program Card Styles */
        .program-card {
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .program-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .program-card .program-image {
            height: 200px;
            overflow: hidden;
        }

        .program-card .program-image img {
            transition: all 0.5s ease;
        }

        .program-card:hover .program-image img {
            transform: scale(1.1);
        }

        /* Blog Card Styles */
        .blog-card {
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .blog-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .blog-card .blog-image {
            height: 200px;
            overflow: hidden;
        }

        .blog-card .blog-image img {
            transition: all 0.5s ease;
        }

        .blog-card:hover .blog-image img {
            transform: scale(1.1);
        }

        /* Trainer Card Styles */
        .trainer-card {
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .trainer-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .trainer-card .trainer-image {
            height: 300px;
            overflow: hidden;
        }

        .trainer-card .trainer-image img {
            transition: all 0.5s ease;
        }

        .trainer-card:hover .trainer-image img {
            transform: scale(1.1);
        }

        .social-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: rgba(255, 94, 20, 0.1);
            color: #ff5e14;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background-color: #ff5e14;
            color: white;
            transform: translateY(-3px);
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                 alt="Gym Background"
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 animated-gradient opacity-80"></div>
        </div>

        <!-- Decorative Elements -->
        <div class="circle-decoration circle-1"></div>
        <div class="circle-decoration circle-2"></div>

        <!-- SVG Blob Shapes -->
        <svg class="blob-shape" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" style="width: 600px; height: 600px; right: -300px; top: -100px;">
            <path fill="#FF5E14" d="M44.7,-76.4C58.8,-69.2,71.8,-59.1,79.6,-45.8C87.4,-32.6,90,-16.3,88.5,-1.5C87,13.4,81.3,26.8,73.6,39.2C65.9,51.7,56.1,63.3,43.4,70.7C30.7,78.1,15.3,81.4,0.4,80.8C-14.6,80.2,-29.2,75.7,-42.2,68.1C-55.2,60.5,-66.7,49.8,-74.4,36.6C-82.1,23.4,-86,7.7,-83.9,-7.1C-81.8,-21.9,-73.7,-35.7,-63.3,-44.7C-52.9,-53.6,-40.2,-57.6,-28.5,-65.9C-16.8,-74.2,-6.1,-86.8,5.4,-95.8C16.8,-104.8,33.7,-110.2,44.7,-76.4Z" transform="translate(100 100)" />
        </svg>

        <svg class="blob-shape" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" style="width: 500px; height: 500px; left: -250px; bottom: -200px;">
            <path fill="#FF5E14" d="M45.3,-77.5C58.9,-71.2,70.5,-59.9,79.2,-46.3C87.9,-32.7,93.7,-16.3,93.2,-0.3C92.7,15.7,85.8,31.5,76.7,45.8C67.5,60.2,56,73.1,41.7,79.9C27.4,86.7,10.2,87.3,-6.9,86.6C-24,85.9,-41,83.9,-54.8,76.1C-68.6,68.2,-79.2,54.5,-85.9,39.2C-92.6,24,-95.4,7.1,-93.3,-9.2C-91.2,-25.5,-84.2,-41.2,-73.4,-53.3C-62.6,-65.4,-48,-73.9,-33.5,-79.5C-19,-85.1,-4.7,-87.8,8.5,-85.1C21.7,-82.4,43.3,-74.3,45.3,-77.5Z" transform="translate(100 100)" />
        </svg>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-white space-y-8 animate-fadeInUp">
                    <div class="inline-block px-4 py-1 rounded-full bg-white/20 backdrop-blur-md text-white text-sm font-semibold mb-2">
                        #1 FITNESS CENTER IN THE CITY
                    </div>
                    <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
                        ELEVATE YOUR <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-yellow-200">FITNESS</span>
                    </h1>
                    <p class="text-xl md:text-2xl font-light max-w-xl leading-relaxed">
                        Join City Club Gym today and embark on a fitness journey guided by expert trainers using state-of-the-art equipment.
                    </p>
                    <div class="pt-4 flex flex-wrap gap-6">
                        <a href="#" class="btn-3d px-10 py-5 bg-white text-orange-600 font-bold rounded-full hover:shadow-xl transition-all duration-300 flex items-center">
                            <span>GET STARTED NOW</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="{{ route('subscriptions') }}" class="px-10 py-5 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-orange-600 transition-all duration-300">
                            VIEW PLANS
                        </a>
                    </div>
                    <div class="flex items-center space-x-12 pt-8">
                        <div class="flex flex-col items-center">
                            <span class="text-5xl font-bold">50+</span>
                            <span class="text-sm uppercase tracking-wider mt-1">Expert<br>Trainers</span>
                        </div>
                        <div class="w-px h-16 bg-white/30"></div>
                        <div class="flex flex-col items-center">
                            <span class="text-5xl font-bold">100+</span>
                            <span class="text-sm uppercase tracking-wider mt-1">Weekly<br>Classes</span>
                        </div>
                        <div class="w-px h-16 bg-white/30"></div>
                        <div class="flex flex-col items-center">
                            <span class="text-5xl font-bold">24/7</span>
                            <span class="text-sm uppercase tracking-wider mt-1">Access<br>Available</span>
                        </div>
                    </div>
                </div>

                <div class="hidden lg:block">
                    <div class="relative">
                        <div class="absolute -top-10 -left-10 w-full h-full bg-gradient-to-br from-orange-500 to-orange-600 rounded-3xl transform rotate-6 opacity-20"></div>
                        <img src="https://images.unsplash.com/photo-1549060279-7e168fcee0c2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                             alt="Fitness Transformation"
                             class="rounded-3xl shadow-2xl animate-float relative z-10">
                        <div class="absolute -bottom-8 -left-8 glass text-white p-6 rounded-xl z-20">
                            <div class="flex items-center space-x-4">
                                <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-full p-3">
                                    <i class="bx bx-heart-circle text-3xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold">Sarah Transformed</p>
                                    <p class="text-sm opacity-80">Lost 45 pounds in 6 months</p>
                                </div>
                            </div>
                        </div>

                        <!-- Floating Badge -->
                        <div class="absolute -top-5 -right-5 bg-white text-orange-600 px-4 py-2 rounded-full font-bold shadow-lg z-20 animate-pulse">
                            Join Today!
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 text-white text-center">
            <p class="text-sm mb-2 opacity-80">Scroll Down</p>
            <div class="animate-bounce w-12 h-12 mx-auto bg-white/10 backdrop-blur-md rounded-full flex items-center justify-center">
                <i class="bx bx-chevron-down text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Diagonal Divider -->
    <div class="diagonal-divider bg-orange-500"></div>

    <!-- Features Section -->
    <section class="py-24 bg-white relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-orange-100 rounded-full opacity-50 transform translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-orange-100 rounded-full opacity-50 transform -translate-x-1/3 translate-y-1/3"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-20">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">WHY CHOOSE US</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Elevate Your <span class="gradient-text">Fitness Experience</span>
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    City Club offers a premium fitness environment with everything you need to achieve your health and wellness goals.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="card-hover bg-white rounded-3xl shadow-xl overflow-hidden reveal">
                    <div class="relative h-64">
                        <img src="https://images.unsplash.com/photo-1593079831268-3381b0db4a77?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80"
                             alt="Modern Equipment"
                             class="w-full h-full object-cover transition-all duration-700 hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <div class="flex items-center mb-2">
                                <div class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center mr-3">
                                    <i class="bx bx-dumbbell text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold">State-of-the-Art Equipment</h3>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <p class="text-gray-600 mb-6">
                            Access the latest fitness technology and equipment designed to maximize results and enhance your workout experience.
                        </p>
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <div class="custom-checkbox-icon">
                                    <i class="bx bx-check text-lg"></i>
                                </div>
                                <span class="text-gray-700 font-medium">Premium cardio machines</span>
                            </li>
                            <li class="flex items-center">
                                <div class="custom-checkbox-icon">
                                    <i class="bx bx-check text-lg"></i>
                                </div>
                                <span class="text-gray-700 font-medium">Free weight area</span>
                            </li>
                            <li class="flex items-center">
                                <div class="custom-checkbox-icon">
                                    <i class="bx bx-check text-lg"></i>
                                </div>
                                <span class="text-gray-700 font-medium">Specialized training zones</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="card-hover bg-white rounded-3xl shadow-xl overflow-hidden reveal" style="transition-delay: 0.2s;">
                    <div class="relative h-64">
                        <img src="https://images.unsplash.com/photo-1599058917765-a780eda07a3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80"
                             alt="Expert Trainers"
                             class="w-full h-full object-cover transition-all duration-700 hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <div class="flex items-center mb-2">
                                <div class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center mr-3">
                                    <i class="bx bx-user-voice text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold">Expert Certified Trainers</h3>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <p class="text-gray-600 mb-6">
                            Work with our team of certified professionals who are passionate about helping you achieve your fitness goals.
                        </p>
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <div class="custom-checkbox-icon">
                                    <i class="bx bx-check text-lg"></i>
                                </div>
                                <span class="text-gray-700 font-medium">Personalized coaching</span>
                            </li>
                            <li class="flex items-center">
                                <div class="custom-checkbox-icon">
                                    <i class="bx bx-check text-lg"></i>
                                </div>
                                <span class="text-gray-700 font-medium">Customized workout plans</span>
                            </li>
                            <li class="flex items-center">
                                <div class="custom-checkbox-icon">
                                    <i class="bx bx-check text-lg"></i>
                                </div>
                                <span class="text-gray-700 font-medium">Nutritional guidance</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="card-hover bg-white rounded-3xl shadow-xl overflow-hidden reveal" style="transition-delay: 0.4s;">
                    <div class="relative h-64">
                        <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1375&q=80"
                             alt="Classes"
                             class="w-full h-full object-cover transition-all duration-700 hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <div class="flex items-center mb-2">
                                <div class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center mr-3">
                                    <i class="bx bx-calendar-event text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold">Diverse Class Selection</h3>
                            </div>
                        </div>
                    </div>
                    <div class="p-8">
                        <p class="text-gray-600 mb-6">
                            Choose from a wide variety of fitness classes designed for all levels, interests, and fitness goals.
                        </p>
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <div class="custom-checkbox-icon">
                                    <i class="bx bx-check text-lg"></i>
                                </div>
                                <span class="text-gray-700 font-medium">HIIT, yoga, cycling & more</span>
                            </li>
                            <li class="flex items-center">
                                <div class="custom-checkbox-icon">
                                    <i class="bx bx-check text-lg"></i>
                                </div>
                                <span class="text-gray-700 font-medium">All fitness levels welcome</span>
                            </li>
                            <li class="flex items-center">
                                <div class="custom-checkbox-icon">
                                    <i class="bx bx-check text-lg"></i>
                                </div>
                                <span class="text-gray-700 font-medium">Flexible scheduling</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-gradient-to-r from-orange-600 to-orange-500 text-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="reveal">
                    <div class="text-5xl font-bold mb-2">5,000+</div>
                    <p class="text-orange-100 uppercase tracking-wider text-sm">Happy Members</p>
                </div>
                <div class="reveal" style="transition-delay: 0.1s;">
                    <div class="text-5xl font-bold mb-2">150+</div>
                    <p class="text-orange-100 uppercase tracking-wider text-sm">Weekly Classes</p>
                </div>
                <div class="reveal" style="transition-delay: 0.2s;">
                    <div class="text-5xl font-bold mb-2">50+</div>
                    <p class="text-orange-100 uppercase tracking-wider text-sm">Expert Trainers</p>
                </div>
                <div class="reveal" style="transition-delay: 0.3s;">
                    <div class="text-5xl font-bold mb-2">10+</div>
                    <p class="text-orange-100 uppercase tracking-wider text-sm">Years Experience</p>
                </div>
            </div>
        </div>
    </section>

    <!-- NEW SECTION: Gym Facilities/Gallery -->
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-20">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">OUR FACILITIES</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    State-of-the-Art <span class="gradient-text">Gym Facilities</span>
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Experience premium fitness with our modern equipment and specialized training areas.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Gallery Item 1 -->
                <div class="gallery-item reveal">
                    <img src="https://images.unsplash.com/photo-1540497077202-7c8a3999166f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                         alt="Cardio Area"
                         class="w-full h-80 object-cover">
                    <div class="overlay flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Cardio Area</h3>
                            <p class="text-white/80 text-sm">Latest treadmills, ellipticals, and bikes</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 2 -->
                <div class="gallery-item reveal" style="transition-delay: 0.1s;">
                    <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                         alt="Free Weights"
                         class="w-full h-80 object-cover">
                    <div class="overlay flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Free Weights</h3>
                            <p class="text-white/80 text-sm">Comprehensive selection for all training needs</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 3 -->
                <div class="gallery-item reveal" style="transition-delay: 0.2s;">
                    <img src="https://images.unsplash.com/photo-1574680178050-55c6a6a96e0a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80"
                         alt="Yoga Studio"
                         class="w-full h-80 object-cover">
                    <div class="overlay flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Yoga Studio</h3>
                            <p class="text-white/80 text-sm">Peaceful environment for mind-body wellness</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 4 -->
                <div class="gallery-item reveal" style="transition-delay: 0.3s;">
                    <img src="https://images.unsplash.com/photo-1570829460005-c840387bb1ca?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1632&q=80"
                         alt="Swimming Pool"
                         class="w-full h-80 object-cover">
                    <div class="overlay flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Swimming Pool</h3>
                            <p class="text-white/80 text-sm">Olympic-sized pool for aquatic workouts</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 5 -->
                <div class="gallery-item reveal" style="transition-delay: 0.4s;">
                    <img src="https://images.unsplash.com/photo-1571388208497-71bedc66e932?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80"
                         alt="Group Class Room"
                         class="w-full h-80 object-cover">
                    <div class="overlay flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Group Class Room</h3>
                            <p class="text-white/80 text-sm">Spacious area for energetic group workouts</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery Item 6 -->
                <div class="gallery-item reveal" style="transition-delay: 0.5s;">
                    <img src="https://images.unsplash.com/photo-1576678927484-cc907957088c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80"
                         alt="Locker Rooms"
                         class="w-full h-80 object-cover">
                    <div class="overlay flex items-end p-6">
                        <div>
                            <h3 class="text-white text-xl font-bold">Luxury Locker Rooms</h3>
                            <p class="text-white/80 text-sm">Premium amenities and spa-like atmosphere</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#" class="btn-3d inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-full hover:shadow-xl transition-all duration-300">
                    <span>TAKE A VIRTUAL TOUR</span>
                    <i class='bx bx-right-arrow-alt ml-2 text-xl'></i>
                </a>
            </div>
        </div>
    </section>

    <!-- NEW SECTION: Class Schedule -->
    <section class="py-24 bg-gray-50 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">CLASS SCHEDULE</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Find Your Perfect <span class="gradient-text">Workout</span>
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Choose from our diverse range of classes led by expert instructors to achieve your fitness goals.
                </p>
            </div>

            <!-- Schedule Tabs -->
            <div class="flex flex-wrap justify-center mb-8 gap-2" x-data="{ activeTab: 'monday' }">
                <button @click="activeTab = 'monday'" :class="{ 'active': activeTab === 'monday' }" class="schedule-tab px-6 py-3 rounded-full font-medium text-gray-700">Monday</button>
                <button @click="activeTab = 'tuesday'" :class="{ 'active': activeTab === 'tuesday' }" class="schedule-tab px-6 py-3 rounded-full font-medium text-gray-700">Tuesday</button>
                <button @click="activeTab = 'wednesday'" :class="{ 'active': activeTab === 'wednesday' }" class="schedule-tab px-6 py-3 rounded-full font-medium text-gray-700">Wednesday</button>
                <button @click="activeTab = 'thursday'" :class="{ 'active': activeTab === 'thursday' }" class="schedule-tab px-6 py-3 rounded-full font-medium text-gray-700">Thursday</button>
                <button @click="activeTab = 'friday'" :class="{ 'active': activeTab === 'friday' }" class="schedule-tab px-6 py-3 rounded-full font-medium text-gray-700">Friday</button>
                <button @click="activeTab = 'saturday'" :class="{ 'active': activeTab === 'saturday' }" class="schedule-tab px-6 py-3 rounded-full font-medium text-gray-700">Saturday</button>
                <button @click="activeTab = 'sunday'" :class="{ 'active': activeTab === 'sunday' }" class="schedule-tab px-6 py-3 rounded-full font-medium text-gray-700">Sunday</button>
            </div>

            <!-- Schedule Content -->
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                <!-- Monday Schedule -->
                <div x-show="activeTab === 'monday'" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Class 1 -->
                        <div class="schedule-item p-6 rounded-xl border border-gray-100">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">HIIT Workout</h3>
                                    <p class="text-gray-500">06:00 - 07:00 AM</p>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                                    <i class='bx bx-timer text-2xl text-orange-500'></i>
                                </div>
                            </div>
                            <div class="flex items-center mb-4">
                                <img src="https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80"
                                     alt="Trainer"
                                     class="w-10 h-10 rounded-full object-cover mr-3">
                                <span class="text-gray-700">Sarah Johnson</span>
                            </div>
                            <a href="#" class="text-orange-500 font-medium hover:text-orange-600 transition-colors flex items-center">
                                Book Now <i class='bx bx-right-arrow-alt ml-1'></i>
                            </a>
                        </div>

                        <!-- Class 2 -->
                        <div class="schedule-item p-6 rounded-xl border border-gray-100">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Yoga Flow</h3>
                                    <p class="text-gray-500">08:00 - 09:00 AM</p>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                                    <i class='bx bx-spa text-2xl text-orange-500'></i>
                                </div>
                            </div>
                            <div class="flex items-center mb-4">
                                <img src="https://images.unsplash.com/photo-1548690312-e3b507d8c110?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80"
                                     alt="Trainer"
                                     class="w-10 h-10 rounded-full object-cover mr-3">
                                <span class="text-gray-700">Emma Davis</span>
                            </div>
                            <a href="#" class="text-orange-500 font-medium hover:text-orange-600 transition-colors flex items-center">
                                Book Now <i class='bx bx-right-arrow-alt ml-1'></i>
                            </a>
                        </div>

                        <!-- Class 3 -->
                        <div class="schedule-item p-6 rounded-xl border border-gray-100">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Spin Class</h3>
                                    <p class="text-gray-500">12:00 - 01:00 PM</p>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                                    <i class='bx bx-cycling text-2xl text-orange-500'></i>
                                </div>
                            </div>
                            <div class="flex items-center mb-4">
                                <img src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                                     alt="Trainer"
                                     class="w-10 h-10 rounded-full object-cover mr-3">
                                <span class="text-gray-700">Michael Brown</span>
                            </div>
                            <a href="#" class="text-orange-500 font-medium hover:text-orange-600 transition-colors flex items-center">
                                Book Now <i class='bx bx-right-arrow-alt ml-1'></i>
                            </a>
                        </div>

                        <!-- Class 4 -->
                        <div class="schedule-item p-6 rounded-xl border border-gray-100">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Boxing</h3>
                                    <p class="text-gray-500">05:30 - 06:30 PM</p>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                                    <i class='bx bx-boxing text-2xl text-orange-500'></i>
                                </div>
                            </div>
                            <div class="flex items-center mb-4">
                                <img src="https://images.unsplash.com/photo-1549476464-37392f717541?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80"
                                     alt="Trainer"
                                     class="w-10 h-10 rounded-full object-cover mr-3">
                                <span class="text-gray-700">Alex Thompson</span>
                            </div>
                            <a href="#" class="text-orange-500 font-medium hover:text-orange-600 transition-colors flex items-center">
                                Book Now <i class='bx bx-right-arrow-alt ml-1'></i>
                            </a>
                        </div>

                        <!-- Class 5 -->
                        <div class="schedule-item p-6 rounded-xl border border-gray-100">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Pilates</h3>
                                    <p class="text-gray-500">06:45 - 07:45 PM</p>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                                    <i class='bx bx-body text-2xl text-orange-500'></i>
                                </div>
                            </div>
                            <div class="flex items-center mb-4">
                                <img src="https://images.unsplash.com/photo-1566241440091-ec10de8db2e1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1376&q=80"
                                     alt="Trainer"
                                     class="w-10 h-10 rounded-full object-cover mr-3">
                                <span class="text-gray-700">Jessica Miller</span>
                            </div>
                            <a href="#" class="text-orange-500 font-medium hover:text-orange-600 transition-colors flex items-center">
                                Book Now <i class='bx bx-right-arrow-alt ml-1'></i>
                            </a>
                        </div>

                        <!-- Class 6 -->
                        <div class="schedule-item p-6 rounded-xl border border-gray-100">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">CrossFit</h3>
                                    <p class="text-gray-500">08:00 - 09:00 PM</p>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                                    <i class='bx bx-dumbbell text-2xl text-orange-500'></i>
                                </div>
                            </div>
                            <div class="flex items-center mb-4">
                                <img src="https://images.unsplash.com/photo-1567013127542-490d757e51fc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80"
                                     alt="Trainer"
                                     class="w-10 h-10 rounded-full object-cover mr-3">
                                <span class="text-gray-700">David Wilson</span>
                            </div>
                            <a href="#" class="text-orange-500 font-medium hover:text-orange-600 transition-colors flex items-center">
                                Book Now <i class='bx bx-right-arrow-alt ml-1'></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Other days would have similar structure but different content -->
                <div x-show="activeTab === 'tuesday'" class="p-6">
                    <p class="text-center text-gray-500">Tuesday schedule content would go here</p>
                </div>
                <div x-show="activeTab === 'wednesday'" class="p-6">
                    <p class="text-center text-gray-500">Wednesday schedule content would go here</p>
                </div>
                <div x-show="activeTab === 'thursday'" class="p-6">
                    <p class="text-center text-gray-500">Thursday schedule content would go here</p>
                </div>
                <div x-show="activeTab === 'friday'" class="p-6">
                    <p class="text-center text-gray-500">Friday schedule content would go here</p>
                </div>
                <div x-show="activeTab === 'saturday'" class="p-6">
                    <p class="text-center text-gray-500">Saturday schedule content would go here</p>
                </div>
                <div x-show="activeTab === 'sunday'" class="p-6">
                    <p class="text-center text-gray-500">Sunday schedule content would go here</p>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#" class="btn-3d inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-full hover:shadow-xl transition-all duration-300">
                    <span>VIEW FULL SCHEDULE</span>
                    <i class='bx bx-calendar ml-2 text-xl'></i>
                </a>
            </div>
        </div>
    </section>

    <!-- NEW SECTION: Fitness Programs -->
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">SPECIALIZED PROGRAMS</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Achieve Your <span class="gradient-text">Fitness Goals</span>
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Our specialized programs are designed to help you reach specific fitness goals with expert guidance.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Program 1 -->
                <div class="program-card bg-white shadow-lg reveal">
                    <div class="program-image">
                        <img src="https://images.unsplash.com/photo-1616279969856-759f559de54c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                             alt="Weight Loss Program"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Weight Loss Program</h3>
                        <p class="text-gray-600 mb-4">A comprehensive program designed to help you lose weight effectively and sustainably through a combination of cardio, strength training, and nutrition guidance.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-orange-500 font-bold">8 Weeks</span>
                            <a href="#" class="px-4 py-2 bg-orange-500 text-white rounded-full hover:bg-orange-600 transition-colors">Learn More</a>
                        </div>
                    </div>
                </div>

                <!-- Program 2 -->
                <div class="program-card bg-white shadow-lg reveal" style="transition-delay: 0.2s;">
                    <div class="program-image">
                        <img src="https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                             alt="Muscle Building"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Muscle Building</h3>
                        <p class="text-gray-600 mb-4">Build lean muscle mass with our specialized program that includes progressive resistance training, proper nutrition, and recovery strategies.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-orange-500 font-bold">12 Weeks</span>
                            <a href="#" class="px-4 py-2 bg-orange-500 text-white rounded-full hover:bg-orange-600 transition-colors">Learn More</a>
                        </div>
                    </div>
                </div>

                <!-- Program 3 -->
                <div class="program-card bg-white shadow-lg reveal" style="transition-delay: 0.4s;">
                    <div class="program-image">
                        <img src="https://images.unsplash.com/photo-1599058917212-d750089bc07e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80"
                             alt="Functional Fitness"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Functional Fitness</h3>
                        <p class="text-gray-600 mb-4">Improve your everyday movement patterns and build practical strength with exercises that mimic real-life activities and enhance overall mobility.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-orange-500 font-bold">6 Weeks</span>
                            <a href="#" class="px-4 py-2 bg-orange-500 text-white rounded-full hover:bg-orange-600 transition-colors">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#" class="btn-3d inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-full hover:shadow-xl transition-all duration-300">
                    <span>EXPLORE ALL PROGRAMS</span>
                    <i class='bx bx-right-arrow-alt ml-2 text-xl'></i>
                </a>
            </div>
        </div>
    </section>

    <!-- NEW SECTION: Meet Our Trainers -->
    <section class="py-24 bg-gray-50 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">EXPERT TRAINERS</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Meet Our <span class="gradient-text">Professional Trainers</span>
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Our certified trainers are dedicated to helping you achieve your fitness goals with personalized guidance.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Trainer 1 -->
                <div class="trainer-card bg-white shadow-lg reveal">
                    <div class="trainer-image">
                        <img src="https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80"
                             alt="Sarah Johnson"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Sarah Johnson</h3>
                        <p class="text-orange-500 font-medium mb-3">HIIT Specialist</p>
                        <p class="text-gray-600 mb-4">Certified personal trainer with 8+ years of experience specializing in high-intensity interval training.</p>
                        <div class="flex space-x-2">
                            <a href="#" class="social-icon"><i class='bx bxl-instagram'></i></a>
                            <a href="#" class="social-icon"><i class='bx bxl-facebook'></i></a>
                            <a href="#" class="social-icon"><i class='bx bxl-twitter'></i></a>
                        </div>
                    </div>
                </div>

                <!-- Trainer 2 -->
                <div class="trainer-card bg-white shadow-lg reveal" style="transition-delay: 0.2s;">
                    <div class="trainer-image">
                        <img src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                             alt="Michael Brown"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Michael Brown</h3>
                        <p class="text-orange-500 font-medium mb-3">Strength Coach</p>
                        <p class="text-gray-600 mb-4">Former competitive powerlifter with expertise in strength training and muscle development techniques.</p>
                        <div class="flex space-x-2">
                            <a href="#" class="social-icon"><i class='bx bxl-instagram'></i></a>
                            <a href="#" class="social-icon"><i class='bx bxl-facebook'></i></a>
                            <a href="#" class="social-icon"><i class='bx bxl-twitter'></i></a>
                        </div>
                    </div>
                </div>

                <!-- Trainer 3 -->
                <div class="trainer-card bg-white shadow-lg reveal" style="transition-delay: 0.4s;">
                    <div class="trainer-image">
                        <img src="https://images.unsplash.com/photo-1548690312-e3b507d8c110?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80"
                             alt="Emma Davis"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Emma Davis</h3>
                        <p class="text-orange-500 font-medium mb-3">Yoga Instructor</p>
                        <p class="text-gray-600 mb-4">Certified yoga instructor with a holistic approach to fitness, focusing on mind-body connection.</p>
                        <div class="flex space-x-2">
                            <a href="#" class="social-icon"><i class='bx bxl-instagram'></i></a>
                            <a href="#" class="social-icon"><i class='bx bxl-facebook'></i></a>
                            <a href="#" class="social-icon"><i class='bx bxl-twitter'></i></a>
                        </div>
                    </div>
                </div>

                <!-- Trainer 4 -->
                <div class="trainer-card bg-white shadow-lg reveal" style="transition-delay: 0.6s;">
                    <div class="trainer-image">
                        <img src="https://images.unsplash.com/photo-1549476464-37392f717541?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80"
                             alt="Alex Thompson"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">Alex Thompson</h3>
                        <p class="text-orange-500 font-medium mb-3">Boxing Coach</p>
                        <p class="text-gray-600 mb-4">Former professional boxer with a passion for teaching proper technique and building confidence.</p>
                        <div class="flex space-x-2">
                            <a href="#" class="social-icon"><i class='bx bxl-instagram'></i></a>
                            <a href="#" class="social-icon"><i class='bx bxl-facebook'></i></a>
                            <a href="#" class="social-icon"><i class='bx bxl-twitter'></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('trainers') }}" class="btn-3d inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-full hover:shadow-xl transition-all duration-300">
                    <span>MEET ALL TRAINERS</span>
                    <i class='bx bx-user-voice ml-2 text-xl'></i>
                </a>
            </div>
        </div>
    </section>

    <!-- NEW SECTION: Fitness Blog -->
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">FITNESS TIPS & ADVICE</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Latest From Our <span class="gradient-text">Fitness Blog</span>
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Stay informed with the latest fitness trends, nutrition advice, and workout tips from our experts.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Blog Post 1 -->
                <div class="blog-card bg-white shadow-lg reveal">
                    <div class="blog-image">
                        <img src="https://images.unsplash.com/photo-1551632436-cbf8dd35adfa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80"
                             alt="Nutrition Tips"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-3 py-1 rounded-full">Nutrition</span>
                            <span class="text-gray-500 text-sm ml-3">June 15, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">10 Nutrition Tips for Optimal Workout Recovery</h3>
                        <p class="text-gray-600 mb-4">Learn how proper nutrition can significantly improve your recovery time and enhance your workout results.</p>
                        <a href="#" class="text-orange-500 font-medium hover:text-orange-600 transition-colors flex items-center">
                            Read More <i class='bx bx-right-arrow-alt ml-1'></i>
                        </a>
                    </div>
                </div>

                <!-- Blog Post 2 -->
                <div class="blog-card bg-white shadow-lg reveal" style="transition-delay: 0.2s;">
                    <div class="blog-image">
                        <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                             alt="HIIT Workouts"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-3 py-1 rounded-full">Workouts</span>
                            <span class="text-gray-500 text-sm ml-3">June 8, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">5 HIIT Workouts You Can Do in 20 Minutes or Less</h3>
                        <p class="text-gray-600 mb-4">Short on time? These high-intensity interval training workouts will maximize your results in minimal time.</p>
                        <a href="#" class="text-orange-500 font-medium hover:text-orange-600 transition-colors flex items-center">
                            Read More <i class='bx bx-right-arrow-alt ml-1'></i>
                        </a>
                    </div>
                </div>

                <!-- Blog Post 3 -->
                <div class="blog-card bg-white shadow-lg reveal" style="transition-delay: 0.4s;">
                    <div class="blog-image">
                        <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1520&q=80"
                             alt="Mental Health"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-3 py-1 rounded-full">Wellness</span>
                            <span class="text-gray-500 text-sm ml-3">June 1, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">The Connection Between Exercise and Mental Health</h3>
                        <p class="text-gray-600 mb-4">Discover how regular physical activity can improve your mood, reduce anxiety, and boost overall mental wellbeing.</p>
                        <a href="#" class="text-orange-500 font-medium hover:text-orange-600 transition-colors flex items-center">
                            Read More <i class='bx bx-right-arrow-alt ml-1'></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#" class="btn-3d inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-full hover:shadow-xl transition-all duration-300">
                    <span>VIEW ALL ARTICLES</span>
                    <i class='bx bx-book-open ml-2 text-xl'></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Membership Plans Section -->
    <section class="py-24 bg-gray-50 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-20 bg-gradient-to-b from-white to-transparent"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-20">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">MEMBERSHIP OPTIONS</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Find Your <span class="gradient-text">Perfect Plan</span>
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Choose the membership that fits your lifestyle and helps you achieve your fitness goals.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Basic Plan -->
                <div class="pricing-card bg-white rounded-3xl overflow-hidden shadow-xl reveal">
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-2xl font-bold mb-2 text-gray-900">Basic</h3>
                                <div class="flex items-baseline">
                                    <span class="text-5xl font-bold text-gray-900">$29</span>
                                    <span class="ml-2 text-xl text-orange-500">/month</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 rounded-full bg-orange-100 flex items-center justify-center">
                                <i class='bx bx-dumbbell text-3xl text-orange-500'></i>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-8">Perfect for beginners and those looking for essential gym access.</p>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center">
                                <i class="bx bx-check-circle text-orange-500 text-xl mr-3"></i>
                                <span class="text-gray-700">Standard gym access</span>
                            </li>
                            <li class="flex items-center">
                                <i class="bx bx-check-circle text-orange-500 text-xl mr-3"></i>
                                <span class="text-gray-700">Basic locker room access</span>
                            </li>
                            <li class="flex items-center">
                                <i class="bx bx-check-circle text-orange-500 text-xl mr-3"></i>
                                <span class="text-gray-700">Initial fitness assessment</span>
                            </li>
                            <li class="flex items-center text-gray-400">
                                <i class="bx bx-x-circle text-gray-400 text-xl mr-3"></i>
                                <span class="line-through">Group classes</span>
                            </li>
                            <li class="flex items-center text-gray-400">
                                <i class="bx bx-x-circle text-gray-400 text-xl mr-3"></i>
                                <span class="line-through">Personal training sessions</span>
                            </li>
                        </ul>
                        <a href="{{ route('subscriptions') }}" class="btn-3d block w-full py-4 px-6 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 text-white text-center font-bold transition duration-300">
                            Choose Basic
                        </a>
                    </div>
                </div>

                <!-- Premium Plan -->
                <div class="pricing-card featured bg-white rounded-3xl overflow-hidden shadow-2xl reveal" style="transition-delay: 0.2s;">
                    <div class="absolute -top-4 right-4">
                        <div class="bg-gradient-to-r from-yellow-400 to-amber-500 text-orange-900 text-xs font-bold px-6 py-1 rounded-full transform rotate-2 shadow-lg">
                            MOST POPULAR
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-2xl font-bold mb-2 text-gray-900">Premium</h3>
                                <div class="flex items-baseline">
                                    <span class="text-5xl font-bold text-gray-900">$59</span>
                                    <span class="ml-2 text-xl text-orange-500">/month</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 rounded-full bg-orange-500 flex items-center justify-center">
                                <i class='bx bx-trophy text-3xl text-white'></i>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-8">The perfect balance of features for serious fitness enthusiasts.</p>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center">
                                <i class="bx bx-check-circle text-orange-500 text-xl mr-3"></i>
                                <span class="text-gray-700">Extended gym access</span>
                            </li>
                            <li class="flex items-center">
                                <i class="bx bx-check-circle text-orange-500 text-xl mr-3"></i>
                                <span class="text-gray-700">Premium locker room access</span>
                            </li>
                            <li class="flex items-center">
                                <i class="bx bx-check-circle text-orange-500 text-xl mr-3"></i>
                                <span class="text-gray-700">Unlimited group classes</span>
                            </li>
                            <li class="flex items-center">
                                <i class="bx bx-check-circle text-orange-500 text-xl mr-3"></i>
                                <span class="text-gray-700">2 trainer sessions/month</span>
                            </li>
                            <li class="flex items-center">
                                <i class="bx bx-check-circle text-orange-500 text-xl mr-3"></i>
                                <span class="text-gray-700">Quarterly fitness assessment</span>
                            </li>
                        </ul>
                        <a href="{{ route('subscriptions') }}" class="btn-3d block w-full py-4 px-6 rounded-xl bg-white border-2 border-orange-500 text-orange-600 text-center font-bold transition duration-300 hover:bg-orange-50">
                            Choose Premium
                        </a>
                    </div>
                </div>

                <!-- Elite Plan -->
                <div class="pricing-card bg-white rounded-3xl overflow-hidden shadow-xl reveal" style="transition-delay: 0.4s;">
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="text-2xl font-bold mb-2 text-gray-900">Elite</h3>
                                <div class="flex items-baseline">
                                    <span class="text-5xl font-bold text-gray-900">$99</span>
                                    <span class="ml-2 text-xl text-orange-500">/month</span>
                                </div>
                            </div>
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-orange-500 to-orange-700 flex items-center justify-center">
                                <i class='bx bx-crown text-3xl text-white'></i>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-8">The ultimate fitness experience with premium perks and unlimited access.</p>
                        <ul class="space-y-4 mb-8">
                            <li class="flex items-center">
                                <i class="bx bx-check-circle text-orange-500 text-xl mr-3"></i>
                                <span class="text-gray-700">24/7 gym access</span>
                            </li>
                            <li class="flex items-center">
                                <i class="bx bx-check-circle text-orange-500 text-xl mr-3"></i>
                                <span class="text-gray-700">Exclusive locker with amenities</span>
                            </li>
                            <li class="flex items-center">
                                <i class="bx bx-check-circle text-orange-500 text-xl mr-3"></i>
                                <span class="text-gray-700">All group classes + priority</span>
                            </li>
                            <li class="flex items-center">
                                <i class="bx bx-check-circle text-orange-500 text-xl mr-3"></i>
                                <span class="text-gray-700">Unlimited trainer sessions</span>
                            </li>
                            <li class="flex items-center">
                                <i class="bx bx-check-circle text-orange-500 text-xl mr-3"></i>
                                <span class="text-gray-700">Nutrition consultation included</span>
                            </li>
                        </ul>
                        <a href="{{ route('subscriptions') }}" class="btn-3d block w-full py-4 px-6 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 text-white text-center font-bold transition duration-300">
                            Choose Elite
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-24 bg-white relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-72 h-72 bg-orange-100 rounded-full opacity-50 transform translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-orange-100 rounded-full opacity-50 transform -translate-x-1/3 translate-y-1/3"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-20">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">TESTIMONIALS</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Success <span class="gradient-text">Stories</span> from Our Members
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Hear from the people who have transformed their lives with City Club Gym.
                </p>
            </div>

            <div class="flex flex-col md:flex-row gap-10">
                <!-- Testimonial 1 -->
                <div class="md:w-1/2 testimonial-card bg-white rounded-3xl shadow-xl p-8 reveal">
                    <div class="flex items-center mb-6">
                        <img src="https://images.unsplash.com/photo-1603415526960-f7e0328c63b1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                             alt="Testimonial 1"
                             class="w-20 h-20 rounded-full object-cover mr-4 border-4 border-orange-100">
                        <div>
                            <h4 class="text-xl font-bold text-gray-900">Michael Thompson</h4>
                            <p class="text-orange-500">Member for 2 years</p>
                        </div>
                    </div>
                    <div class="relative">
                        <i class="bx bxs-quote-alt-left text-6xl text-orange-100 absolute -top-6 -left-2"></i>
                        <p class="text-gray-600 relative z-10 pl-4 text-lg leading-relaxed">
                            "I've tried many gyms over the years, but City Club is by far the best. The trainers are knowledgeable and supportive, and the equipment is always well-maintained. Since joining, I've lost 30 pounds and gained significant muscle mass. More importantly, I've found a supportive community that keeps me motivated."
                        </p>
                        <div class="mt-6 flex">
                            <i class="bx bxs-star text-yellow-400 text-xl"></i>
                            <i class="bx bxs-star text-yellow-400 text-xl"></i>
                            <i class="bx bxs-star text-yellow-400 text-xl"></i>
                            <i class="bx bxs-star text-yellow-400 text-xl"></i>
                            <i class="bx bxs-star text-yellow-400 text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="md:w-1/2 testimonial-card bg-white rounded-3xl shadow-xl p-8 reveal" style="transition-delay: 0.2s;">
                    <div class="flex items-center mb-6">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1488&q=80"
                             alt="Testimonial 2"
                             class="w-20 h-20 rounded-full object-cover mr-4 border-4 border-orange-100">
                        <div>
                            <h4 class="text-xl font-bold text-gray-900">Jennifer Adams</h4>
                            <p class="text-orange-500">Member for 1 year</p>
                        </div>
                    </div>
                    <div class="relative">
                        <i class="bx bxs-quote-alt-left text-6xl text-orange-100 absolute -top-6 -left-2"></i>
                        <p class="text-gray-600 relative z-10 pl-4 text-lg leading-relaxed">
                            "The variety of classes at City Club keeps my workout routine exciting and challenging. Sarah's yoga classes have improved my flexibility and reduced my stress levels significantly. The nutrition guidance has completely changed my relationship with food. What I love most is the community here—everyone is so supportive and encouraging!"
                        </p>
                        <div class="mt-6 flex">
                            <i class="bx bxs-star text-yellow-400 text-xl"></i>
                            <i class="bx bxs-star text-yellow-400 text-xl"></i>
                            <i class="bx bxs-star text-yellow-400 text-xl"></i>
                            <i class="bx bxs-star text-yellow-400 text-xl"></i>
                            <i class="bx bxs-star text-yellow-400 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-3xl overflow-hidden shadow-2xl">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 p-12">
                        <h2 class="text-3xl md:text-4xl font-bold text-white leading-tight mb-4">
                            Ready to Start Your Fitness Journey?
                        </h2>
                        <p class="text-lg text-orange-100 mb-8">
                            Join City Club Gym today and take the first step towards a healthier, stronger you. Our team is ready to support you every step of the way.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('register') }}" class="btn-3d px-8 py-4 bg-white text-orange-600 font-bold rounded-full hover:shadow-xl transition-all duration-300">
                                <span>JOIN NOW</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="{{ route('contact') }}" class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-orange-600 transition-all duration-300">
                                CONTACT US
                            </a>
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                             alt="Join City Club Gym"
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scroll Reveal Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Scroll reveal animation
            function revealOnScroll() {
                var reveals = document.querySelectorAll('.reveal');

                for (var i = 0; i < reveals.length; i++) {
                    var windowHeight = window.innerHeight;
                    var elementTop = reveals[i].getBoundingClientRect().top;
                    var elementVisible = 150;

                    if (elementTop < windowHeight - elementVisible) {
                        reveals[i].classList.add('active');
                    }
                }
            }

            window.addEventListener('scroll', revealOnScroll);
            revealOnScroll(); // Trigger on page load
        });
    </script>
@endsection

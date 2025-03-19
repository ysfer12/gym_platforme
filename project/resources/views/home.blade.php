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
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<div class="relative min-h-screen flex items-center justify-center">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
             alt="Gym Background" 
             class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 hero-gradient opacity-70"></div>
    </div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <div class="text-white space-y-6 animate-fadeInUp">
                <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
                    TRANSFORM <br>YOUR <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-indigo-200">BODY</span>
                </h1>
                <p class="text-xl md:text-2xl font-light max-w-xl leading-relaxed">
                    Join FitTrack Gym today and embark on a fitness journey guided by expert trainers using state-of-the-art equipment.
                </p>
                <div class="pt-4 flex flex-wrap gap-4">
                    <a href="#" class="btn-3d px-8 py-4 bg-gradient-to-r from-indigo-500 to-blue-600 text-white font-bold rounded-full hover:shadow-xl transition-all duration-300">
                        GET STARTED NOW
                    </a>
                    <a href="{{ route('subscriptions') }}" class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-indigo-700 transition-all duration-300">
                        VIEW PLANS
                    </a>
                </div>
                <div class="flex items-center space-x-8 pt-6">
                    <div class="flex flex-col items-center">
                        <span class="text-5xl font-bold">50+</span>
                        <span class="text-sm uppercase tracking-wider">Expert<br>Trainers</span>
                    </div>
                    <div class="w-px h-16 bg-white/30"></div>
                    <div class="flex flex-col items-center">
                        <span class="text-5xl font-bold">100+</span>
                        <span class="text-sm uppercase tracking-wider">Weekly<br>Classes</span>
                    </div>
                    <div class="w-px h-16 bg-white/30"></div>
                    <div class="flex flex-col items-center">
                        <span class="text-5xl font-bold">24/7</span>
                        <span class="text-sm uppercase tracking-wider">Access<br>Available</span>
                    </div>
                </div>
            </div>
            
            <div class="hidden lg:block">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Fitness Transformation" 
                         class="rounded-3xl shadow-2xl animate-float">
                    <div class="absolute -bottom-8 -left-8 glass text-white p-6 rounded-xl">
                        <div class="flex items-center space-x-4">
                            <div class="bg-white/20 rounded-full p-3">
                                <i class="bx bx-heart-circle text-3xl"></i>
                            </div>
                            <div>
                                <p class="font-bold">John Transformed</p>
                                <p class="text-sm opacity-80">Lost 30 pounds in 3 months</p>
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
        <div class="animate-bounce w-10 h-10 mx-auto bg-white/20 rounded-full flex items-center justify-center">
            <i class="bx bx-chevron-down text-2xl"></i>
        </div>
    </div>
</div>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-base text-indigo-600 font-bold uppercase tracking-wide">Why Choose Us</h2>
            <h3 class="mt-2 text-4xl leading-tight font-bold text-gray-900 sm:text-5xl">
                Elevate Your Fitness Experience
            </h3>
            <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                FitTrack offers a premium fitness environment with everything you need to achieve your health and wellness goals.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="relative h-56">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Modern Equipment" 
                         class="w-full h-full object-cover transition-all duration-500 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h4 class="text-xl font-bold">State-of-the-Art Equipment</h4>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600">
                        Access the latest fitness technology and equipment designed to maximize results and enhance your workout experience.
                    </p>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <i class="bx bx-check text-lg"></i>
                            </span>
                            <span class="ml-3 text-gray-700">Premium cardio machines</span>
                        </li>
                        <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <i class="bx bx-check text-lg"></i>
                            </span>
                            <span class="ml-3 text-gray-700">Free weight area</span>
                        </li>
                        <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <i class="bx bx-check text-lg"></i>
                            </span>
                            <span class="ml-3 text-gray-700">Specialized training zones</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Feature 2 -->
            <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="relative h-56">
                    <img src="https://images.unsplash.com/photo-1571732154690-f6d1d3e25e42?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1632&q=80" 
                         alt="Expert Trainers" 
                         class="w-full h-full object-cover transition-all duration-500 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h4 class="text-xl font-bold">Expert Certified Trainers</h4>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600">
                        Work with our team of certified professionals who are passionate about helping you achieve your fitness goals.
                    </p>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <i class="bx bx-check text-lg"></i>
                            </span>
                            <span class="ml-3 text-gray-700">Personalized coaching</span>
                        </li>
                        <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <i class="bx bx-check text-lg"></i>
                            </span>
                            <span class="ml-3 text-gray-700">Customized workout plans</span>
                        </li>
                        <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <i class="bx bx-check text-lg"></i>
                            </span>
                            <span class="ml-3 text-gray-700">Nutritional guidance</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Feature 3 -->
            <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="relative h-56">
                    <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Classes" 
                         class="w-full h-full object-cover transition-all duration-500 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h4 class="text-xl font-bold">Diverse Class Selection</h4>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-600">
                        Choose from a wide variety of fitness classes designed for all levels, interests, and fitness goals.
                    </p>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <i class="bx bx-check text-lg"></i>
                            </span>
                            <span class="ml-3 text-gray-700">HIIT, yoga, cycling & more</span>
                        </li>
                        <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <i class="bx bx-check text-lg"></i>
                            </span>
                            <span class="ml-3 text-gray-700">All fitness levels welcome</span>
                        </li>
                        <li class="flex items-center">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center">
                                <i class="bx bx-check text-lg"></i>
                            </span>
                            <span class="ml-3 text-gray-700">Flexible scheduling</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Membership Plans Section -->
<section class="py-20 bg-gradient-to-br from-indigo-900 via-indigo-800 to-purple-900 text-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-base text-indigo-300 font-bold uppercase tracking-wide">Membership Options</h2>
            <h3 class="mt-2 text-4xl leading-tight font-bold sm:text-5xl">
                Find Your Perfect Plan
            </h3>
            <p class="mt-4 max-w-3xl mx-auto text-xl text-indigo-200">
                Choose the membership that fits your lifestyle and helps you achieve your fitness goals.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Basic Plan -->
            <div class="rounded-2xl overflow-hidden bg-gradient-to-br from-gray-900 to-gray-800 shadow-xl transform transition-all duration-500 relative card-hover">
                <div class="p-8">
                    <h4 class="text-xl font-bold mb-2">Basic</h4>
                    <div class="flex items-baseline">
                        <span class="text-5xl font-bold">$29</span>
                        <span class="ml-2 text-xl text-indigo-300">/month</span>
                    </div>
                    <p class="mt-4 text-indigo-200">Perfect for beginners and those looking for essential gym access.</p>
                    <ul class="mt-6 space-y-4">
                        <li class="flex items-center">
                            <i class="bx bx-check-circle text-indigo-400 text-xl mr-2"></i>
                            <span>Standard gym access</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bx bx-check-circle text-indigo-400 text-xl mr-2"></i>
                            <span>Basic locker room access</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bx bx-check-circle text-indigo-400 text-xl mr-2"></i>
                            <span>Initial fitness assessment</span>
                        </li>
                        <li class="flex items-center text-indigo-300/60">
                            <i class="bx bx-x-circle text-gray-500 text-xl mr-2"></i>
                            <span class="line-through">Group classes</span>
                        </li>
                        <li class="flex items-center text-indigo-300/60">
                            <i class="bx bx-x-circle text-gray-500 text-xl mr-2"></i>
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
                <div class="p-8">
                    <h4 class="text-xl font-bold mb-2">Premium</h4>
                    <div class="flex items-baseline">
                        <span class="text-5xl font-bold">$59</span>
                        <span class="ml-2 text-xl text-indigo-100">/month</span>
                    </div>
                    <p class="mt-4 text-indigo-100">The perfect balance of features for serious fitness enthusiasts.</p>
                    <ul class="mt-6 space-y-4">
                        <li class="flex items-center">
                            <i class="bx bx-check-circle text-white text-xl mr-2"></i>
                            <span>Extended gym access</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bx bx-check-circle text-white text-xl mr-2"></i>
                            <span>Premium locker room access</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bx bx-check-circle text-white text-xl mr-2"></i>
                            <span>Unlimited group classes</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bx bx-check-circle text-white text-xl mr-2"></i>
                            <span>2 trainer sessions/month</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bx bx-check-circle text-white text-xl mr-2"></i>
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
                <div class="p-8">
                    <h4 class="text-xl font-bold mb-2">Elite</h4>
                    <div class="flex items-baseline">
                        <span class="text-5xl font-bold">$99</span>
                        <span class="ml-2 text-xl text-indigo-300">/month</span>
                    </div>
                    <p class="mt-4 text-indigo-200">The ultimate fitness experience with premium perks and unlimited access.</p>
                    <ul class="mt-6 space-y-4">
                        <li class="flex items-center">
                            <i class="bx bx-check-circle text-indigo-400 text-xl mr-2"></i>
                            <span>24/7 gym access</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bx bx-check-circle text-indigo-400 text-xl mr-2"></i>
                            <span>Exclusive locker with amenities</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bx bx-check-circle text-indigo-400 text-xl mr-2"></i>
                            <span>All group classes + priority</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bx bx-check-circle text-indigo-400 text-xl mr-2"></i>
                            <span>Unlimited trainer sessions</span>
                        </li>
                        <li class="flex items-center">
                            <i class="bx bx-check-circle text-indigo-400 text-xl mr-2"></i>
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
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-base text-indigo-600 font-bold uppercase tracking-wide">Testimonials</h2>
            <h3 class="mt-2 text-4xl leading-tight font-bold text-gray-900 sm:text-5xl">
                Success Stories from Our Members
            </h3>
            <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                Hear from the people who have transformed their lives with FitTrack Gym.
            </p>
        </div>
        
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Testimonial 1 -->
            <div class="md:w-1/2 bg-white rounded-2xl shadow-xl p-8 transform transition-all duration-500">
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
                    <i class="bx bxs-quote-alt-left text-5xl text-indigo-100 absolute -top-6 -left-2"></i>
                    <p class="text-gray-600 relative z-10 pl-4">
                        "I've tried many gyms over the years, but FitTrack is by far the best. The trainers are knowledgeable and supportive, and the equipment is always well-maintained. Since joining, I've lost 30 pounds and gained significant muscle mass. More importantly, I've found a supportive community that keeps me motivated."
                    </p>
                    <div class="mt-4 flex">
                        <i class="bx bxs-star text-yellow-400"></i>
                        <i class="bx bxs-star text-yellow-400"></i>
                        <i class="bx bxs-star text-yellow-400"></i>
                        <i class="bx bxs-star text-yellow-400"></i>
                        <i class="bx bxs-star text-yellow-400"></i>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="md:w-1/2 bg-white rounded-2xl shadow-xl p-8 transform transition-all duration-500">
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
                    <i class="bx bxs-quote-alt-left text-5xl text-indigo-100 absolute -top-6 -left-2"></i>
                    <p class="text-gray-600 relative z-10 pl-4">
                        "The variety of classes at FitTrack keeps my workout routine exciting and challenging. Sarah's yoga classes have improved my flexibility and reduced my stress levels significantly. The nutrition guidance has completely changed my relationship with food. What I love most is the community here—everyone is so supportive and encouraging!"
                    </p>
                    <div class="mt-4 flex">
                        <i class="bx bxs-star text-yellow-400"></i>
                        <i class="bx bxs-star text-yellow-400"></i>
                        <i class="bx bxs-star text-yellow-400"></i>
                        <i class="bx bxs-star text-yellow-400"></i>
                        <i class="bx bxs-star text-yellow-400"></i>
                    </div>
                </div>
            </div>
        </div>
        
@endsection

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
            50% { transform: translateY(-20px); }
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
        .animate-float { animation: float 6s infinite ease-in-out; }
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
            justify-content: center;
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
        
        /* Enhanced Hero Section Background Animations */
        
        /* Background Pattern */
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M54.627 0l.83.828-1.415 1.415L51.8 0h2.827zM5.373 0l-.83.828L5.96 2.243 8.2 0H5.374zM48.97 0l3.657 3.657-1.414 1.414L46.143 0h2.828zM11.03 0L7.372 3.657 8.787 5.07 13.857 0H11.03zm32.284 0L49.8 6.485 48.384 7.9l-7.9-7.9h2.83zM16.686 0L10.2 6.485 11.616 7.9l7.9-7.9h-2.83zm20.97 0l9.315 9.314-1.414 1.414L34.828 0h2.83zM22.344 0L13.03 9.314l1.414 1.414L25.172 0h-2.83zM32 0l12.142 12.142-1.414 1.414L30 .828 17.272 13.556l-1.414-1.414L28 0h4zM.284 0l28 28-1.414 1.414L0 2.544v-2.26zM0 5.373l25.456 25.455-1.414 1.415L0 8.2V5.374zm0 5.656l22.627 22.627-1.414 1.414L0 13.86v-2.83zm0 5.656l19.8 19.8-1.415 1.413L0 19.514v-2.83zm0 5.657l16.97 16.97-1.414 1.415L0 25.172v-2.83zM0 28l14.142 14.142-1.414 1.414L0 30.828V28zm0 5.657L11.314 44.97 9.9 46.386l-9.9-9.9v-2.828zm0 5.657L8.485 47.8 7.07 49.212 0 42.143v-2.83zm0 5.657l5.657 5.657-1.414 1.415L0 47.8v-2.83zm0 5.657l2.828 2.83-1.414 1.413L0 53.458v-2.83zM54.627 60L30 35.373 5.373 60H8.2L30 38.2 51.8 60h2.827zm-5.656 0L30 41.03 11.03 60h2.828L30 43.858 46.142 60h2.83zm-5.656 0L30 46.686 16.686 60h2.83L30 49.515 40.485 60h2.83zm-5.657 0L30 52.343 22.344 60h2.83L30 55.172 34.828 60h2.83zM32 60l-2-2-2 2h4zM59.716 0l-28 28 1.414 1.414L60 2.544V0h-.284zM60 5.373L34.544 30.828l1.414 1.415L60 8.2V5.374zm0 5.656L37.373 33.656l1.414 1.414L60 13.86v-2.83zm0 5.656l-19.8 19.8 1.415 1.413L60 19.514v-2.83zm0 5.657l-16.97 16.97 1.414 1.415L60 25.172v-2.83zM60 28L45.858 42.142l1.414 1.414L60 30.828V28zm0 5.657L48.686 44.97l1.415 1.415 9.9-9.9v-2.828zm0 5.657L51.515 47.8l1.414 1.413 7.07-7.07v-2.83zm0 5.657l-5.657 5.657 1.414 1.415L60 47.8v-2.83zm0 5.657l-2.828 2.83 1.414 1.413L60 53.458v-2.83z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
        
        /* Animated Orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            opacity: 0.5;
            z-index: 5;
            animation: float 12s ease-in-out infinite;
        }
        
        .orb-1 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,94,20,0.7) 0%, rgba(255,122,0,0) 70%);
            top: 10%;
            right: 15%;
            animation-delay: 0s;
        }
        
        .orb-2 {
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(255,140,0,0.7) 0%, rgba(255,149,0,0) 70%);
            bottom: 15%;
            left: 10%;
            animation-delay: -3s;
        }
        
        .orb-3 {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,94,20,0.5) 0%, rgba(255,122,0,0) 70%);
            top: 40%;
            left: 25%;
            animation-delay: -6s;
        }
        
        /* Animated Lines */
        .lines-container {
            position: absolute;
            inset: 0;
            overflow: hidden;
            opacity: 0.3;
        }
        
        .line {
            position: absolute;
            width: 2px;
            background: linear-gradient(to bottom, rgba(255,94,20,0) 0%, rgba(255,94,20,1) 50%, rgba(255,94,20,0) 100%);
            animation: line-move 15s infinite linear;
        }
        
        .line-1 {
            height: 50vh;
            left: 25%;
            top: -50%;
            animation-delay: 0s;
        }
        
        .line-2 {
            height: 60vh;
            left: 65%;
            top: -60%;
            animation-delay: -5s;
        }
        
        .line-3 {
            height: 40vh;
            left: 45%;
            top: -40%;
            animation-delay: -10s;
        }
        
        /* Particles Overlay */
        .particles-overlay {
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='4' height='4' viewBox='0 0 4 4'%3E%3Cpath fill='%23ffffff' fill-opacity='0.15' d='M1 3h1v1H1V3zm2-2h1v1H3V1z'%3E%3C/path%3E%3C/svg%3E");
            opacity: 0.3;
        }
        
        /* Hero Image Styling */
        .hero-image-container {
            position: relative;
            perspective: 1000px;
            transform-style: preserve-3d;
        }
        
        .hero-glow {
            position: absolute;
            inset: -10px;
            background: linear-gradient(45deg, rgba(255,94,20,0.5), rgba(255,140,0,0.5));
            border-radius: 24px;
            filter: blur(25px);
            opacity: 0.6;
            animation: glow-pulse 6s infinite alternate;
            z-index: 1;
        }
        
        .hero-image {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.2);
            z-index: 2;
        }
        
        .hero-image img {
            transform: scale(1);
            transition: transform 10s cubic-bezier(0.215, 0.610, 0.355, 1.000);
        }
        
        .hero-image:hover img {
            transform: scale(1.1);
        }
        
        .hero-text {
            opacity: 0;
            transform: translateY(30px);
            animation: text-reveal 1s forwards 0.5s;
        }
        
        /* Floating Cards */
        .floating-card {
            position: absolute;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 3;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .floating-card-1 {
            bottom: -30px;
            left: -30px;
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-card-2 {
            top: 30%;
            right: -20px;
            animation: float 8s ease-in-out infinite 1s;
        }
        
        .floating-card-icon {
            background: linear-gradient(to right, #ff5e14, #ff8c00);
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .badge-element {
            position: absolute;
            top: 20px;
            right: -10px;
            background: linear-gradient(to right, #ff5e14, #ff8c00);
            color: white;
            padding: 8px 16px;
            border-radius: 30px;
            font-weight: 600;
            z-index: 3;
            box-shadow: 0 5px 15px rgba(255, 94, 20, 0.3);
            animation: pulse 2s infinite;
        }
        
        /* Stats Cards */
        .stats-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            padding: 16px 24px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .counter {
            animation: countUp 2.5s ease-out forwards 1s;
            opacity: 0;
        }
        
        /* Scroll Indicator */
        .scroll-indicator {
            width: 50px;
            height: 50px;
            background: linear-gradient(to bottom right, #ff5e14, #ff8c00);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(255, 94, 20, 0.3);
            animation: bounce 2s infinite;
            margin: 0 auto;
        }
        
        /* Additional Keyframe Animations */
        @keyframes line-move {
            0% { transform: translateY(0%); }
            100% { transform: translateY(1000%); }
        }
        
        @keyframes glow-pulse {
            0% { opacity: 0.4; filter: blur(20px); }
            100% { opacity: 0.7; filter: blur(30px); }
        }
        
        @keyframes text-reveal {
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes countUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-20px); }
            60% { transform: translateY(-10px); }
        }

        /* New Styles for Added Sections */
        /* Best Equipment & Trainers Section */
        .trainer-benefit-item {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }
        
        .trainer-benefit-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(255, 94, 20, 0.1);
            color: #ff5e14;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }
        
        .info-box {
            background: #1a1a1a;
            border-radius: 8px;
            padding: 24px;
            height: 100%;
            transition: all 0.3s ease;
        }
        
        .info-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px rgba(0,0,0,0.1);
        }
        
        .info-icon {
            width: 48px;
            height: 48px;
            margin-bottom: 16px;
        }
        
        /* Classes Section */
        .class-card {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .class-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px rgba(0,0,0,0.2);
        }
        
        .class-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            transition: all 0.5s ease;
        }
        
        .class-card:hover img {
            transform: scale(1.1);
        }
        
        .class-info {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 16px;
            background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0));
            color: white;
        }
        
        .class-type {
            position: absolute;
            top: 0;
            right: 0;
            writing-mode: vertical-rl;
            text-orientation: mixed;
            padding: 16px 8px;
            background-color: rgba(255, 94, 20, 0.8);
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* Workout Section */
        .workout-section {
            position: relative;
            background: #1a1a1a;
            overflow: hidden;
        }
        
        .workout-arrow {
            position: absolute;
            height: 100%;
            width: 30%;
            background: #ff5e14;
            clip-path: polygon(0 0, 100% 50%, 0 100%);
            left: 28%;
            top: 0;
        }
        
        .workout-content {
            position: relative;
            z-index: 1;
        }
        
        .workout-step {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }
        
        .workout-number {
            width: 24px;
            height: 24px;
            background: #ff5e14;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
            font-weight: bold;
        }
        
        /* Testimonials and BMI Calculator Section */
        .testimonial-slider {
            position: relative;
            overflow: hidden;
        }
        
        .bmi-calculator {
            background: #1a1a1a;
            border-radius: 8px;
            padding: 24px;
            color: white;
        }
        
        .bmi-input {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 4px;
            padding: 12px;
            color: white;
            width: 100%;
            margin-bottom: 16px;
        }
        
        .bmi-result {
            font-size: 4rem;
            font-weight: bold;
            text-align: center;
        }
        
        .calculate-btn {
            background: #ff5e14;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 12px 24px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .calculate-btn:hover {
            background: #e65012;
        }

        /* Discount Banner */
        .discount-banner {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            height: 100%;
        }
        
        .discount-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .discount-text {
            position: absolute;
            top: 50%;
            right: 5%;
            transform: translateY(-50%);
            text-align: right;
            color: white;
            font-weight: bold;
        }
        
        .discount-percentage {
            font-size: 5rem;
            line-height: 1;
        }
    </style>
@endsection

@section('content')
    <!-- Enhanced Hero Section with Advanced Background Animation -->
    <div class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Video Background with Advanced Overlay Effects -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-orange-900/60 z-10"></div>
            <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover scale-105">
                <source src="https://cdn.coverr.co/videos/coverr-people-working-out-at-the-gym-3287/1080p.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-pattern z-20 opacity-20"></div>
        </div>

        <!-- Animated Background Elements -->
        <div class="absolute inset-0 z-10 pointer-events-none">
            <!-- Animated Gradient Orbs -->
            <div class="orb orb-1"></div>
            <div class="orb orb-2"></div>
            <div class="orb orb-3"></div>
            
            <!-- Dynamic Lines/Particles -->
            <div class="lines-container">
                <div class="line line-1"></div>
                <div class="line line-2"></div>
                <div class="line line-3"></div>
            </div>
            
            <!-- Subtle Particle Overlay -->
            <div class="particles-overlay"></div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-30">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 text-white space-y-8 animate-fadeInUp">
                    <div class="inline-block px-5 py-2 rounded-full bg-white/10 backdrop-blur-md text-white border border-white/20 text-sm font-semibold mb-4 shadow-xl">
                        <span class="flex items-center">
                            <span class="w-3 h-3 bg-orange-500 rounded-full mr-2 animate-pulse"></span>
                            TRANSFORM YOUR BODY & MIND
                        </span>
                    </div>
                    
                    <h1 class="text-5xl md:text-8xl font-extrabold leading-none hero-text">
                        DREAM <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">BIG</span>, 
                        <br class="hidden md:block">TRAIN <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">TOGETHER</span>
                    </h1>
                    
                    <p class="text-xl md:text-2xl font-light max-w-xl leading-relaxed text-gray-300">
                        Where your fitness dreams become reality. Join our community of dreamers, achievers, and fitness enthusiasts guided by world-class trainers.
                    </p>
                    
                    <div class="pt-6 flex flex-wrap gap-6">
                        <a href="#" class="btn-3d group px-10 py-5 bg-orange-500 text-white font-bold rounded-full hover:bg-orange-600 hover:shadow-xl hover:shadow-orange-600/20 transition-all duration-300 flex items-center">
                            <span>START YOUR JOURNEY</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="{{ route('subscriptions') }}" class="group px-10 py-5 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-orange-600 transition-all duration-300 flex items-center">
                            <span>EXPLORE MEMBERSHIPS</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    
                    <!-- Stats with animated counter -->
                    <div class="flex flex-wrap items-center gap-5 pt-8">
                        <div class="stats-card">
                            <span class="text-5xl font-bold counter">5000+</span>
                            <span class="text-sm uppercase tracking-wider mt-1 text-gray-300">Satisfied<br>Members</span>
                        </div>
                        <div class="stats-card">
                            <span class="text-5xl font-bold counter">150+</span>
                            <span class="text-sm uppercase tracking-wider mt-1 text-gray-300">Weekly<br>Classes</span>
                        </div>
                        <div class="stats-card">
                            <span class="text-5xl font-bold counter">24/7</span>
                            <span class="text-sm uppercase tracking-wider mt-1 text-gray-300">Access<br>Available</span>
                        </div>
                    </div>
                </div>

                <div class="hidden lg:block lg:col-span-5">
                    <div class="relative hero-image-container">
                        <!-- Glow Effect -->
                        <div class="hero-glow"></div>
                        
                        <!-- Main Image with Glass Effect -->
                        <div class="hero-image">
                            <img src="https://images.unsplash.com/photo-1637666030574-a66e15bf9332?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                                 alt="Fitness Transformation"
                                 class="w-full h-[600px] object-cover">
                        </div>
                                 
                        <!-- Floating Card Elements -->
                        <div class="floating-card floating-card-1">
                            <div class="flex items-center space-x-4">
                                <div class="floating-card-icon">
                                    <i class="bx bx-badge-check text-3xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-lg">Proven Results</p>
                                    <div class="flex mt-1">
                                        <i class="bx bxs-star text-yellow-400"></i>
                                        <i class="bx bxs-star text-yellow-400"></i>
                                        <i class="bx bxs-star text-yellow-400"></i>
                                        <i class="bx bxs-star text-yellow-400"></i>
                                        <i class="bx bxs-star text-yellow-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Top Right Badge -->
                        <div class="badge-element">
                            <span class="flex items-center">
                                <i class="bx bx-timer mr-2"></i>
                                Limited Time Offer!
                            </span>
                        </div>
                        
                        <!-- User Testimonial -->
                        <div class="floating-card floating-card-2">
                            <div class="flex items-center space-x-3">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" class="w-12 h-12 rounded-full border-2 border-orange-400" alt="Member">
                                <div class="text-white">
                                    <p class="font-bold">Sarah J.</p>
                                    <p class="text-xs text-gray-300">Lost 45 lbs in 6 months</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Down Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 text-white text-center z-20">
            <p class="text-sm mb-2 opacity-80">Scroll to discover more</p>
            <div class="scroll-indicator">
                <i class="bx bx-chevron-down text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Diagonal Divider -->
    <div class="diagonal-divider bg-orange-500"></div>

    <!-- NEW SECTION: Best Equipment & Trainers (based on Image 1) -->
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Column - Image -->
                <div class="reveal">
                    <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Fitness Trainers" 
                         class="rounded-lg shadow-xl w-full">
                    <div class="flex space-x-2 mt-4">
                        <div class="w-3 h-3 bg-yellow-400 transform rotate-45"></div>
                        <div class="w-3 h-3 bg-yellow-400 transform rotate-45"></div>
                        <div class="w-3 h-3 bg-yellow-400 transform rotate-45"></div>
                        <div class="w-3 h-3 bg-gray-800 transform rotate-45"></div>
                        <div class="w-3 h-3 bg-gray-800 transform rotate-45"></div>
                    </div>
                </div>
                
                <!-- Right Column - Content -->
                <div class="space-y-8 reveal" style="transition-delay: 0.2s;">
                    <div>
                        <p class="text-orange-500 font-semibold">SINCE 2005</p>
                        <h2 class="text-4xl md:text-5xl font-bold mt-2">
                            BEST <span class="text-orange-500">EQUIPMENTS</span> 
                            <br>& <span class="text-orange-500">FITNESS</span> TRAINERS
                        </h2>
                    </div>
                    
                    <p class="text-gray-600">
                        Gym is very important to maintain our health. TrainTogether offers the best equipment and certified trainers to help you achieve your fitness goals, whether you're looking to lose weight, build muscle, or improve your overall health.
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="trainer-benefit-item">
                            <div class="trainer-benefit-icon">
                                <i class="bx bx-check"></i>
                            </div>
                            <span>Builds Aerobic Power</span>
                        </div>
                        <div class="trainer-benefit-item">
                            <div class="trainer-benefit-icon">
                                <i class="bx bx-check"></i>
                            </div>
                            <span>Strong body Structure</span>
                        </div>
                        <div class="trainer-benefit-item">
                            <div class="trainer-benefit-icon">
                                <i class="bx bx-check"></i>
                            </div>
                            <span>Boots your Memory</span>
                        </div>
                        <div class="trainer-benefit-item">
                            <div class="trainer-benefit-icon">
                                <i class="bx bx-check"></i>
                            </div>
                            <span>Bring about restful Sleep</span>
                        </div>
                    </div>
                    
                    <div class="flex space-x-4">
                        <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full transition duration-300">
                            LET'S START
                        </a>
                        <a href="#" class="flex items-center space-x-2 text-gray-700 hover:text-orange-500 transition duration-300">
                            <div class="w-10 h-10 bg-white shadow-md rounded-full flex items-center justify-center">
                                <i class="bx bx-play text-orange-500"></i>
                            </div>
                            <span>INTRO VIDEO</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Info Boxes -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-16">
                <!-- Info Box 1 -->
                <div class="info-box text-white reveal" style="transition-delay: 0.1s;">
                    <img src="{{ asset('images/dumbbell-icon.svg') }}" alt="Best Training" class="info-icon" onerror="this.src='https://img.icons8.com/ios-filled/50/ffffff/dumbbell.png'">
                    <h3 class="text-xl font-bold mb-2">Best Training</h3>
                    <p class="text-gray-400">Expert training programs designed to maximize results and minimize injury risk, tailored to your individual needs.</p>
                </div>
                
                <!-- Info Box 2 -->
                <div class="info-box text-white reveal" style="transition-delay: 0.2s;">
                    <img src="{{ asset('images/trainer-icon.svg') }}" alt="Qualified Instructor" class="info-icon" onerror="this.src='https://img.icons8.com/ios-filled/50/ffffff/personal-trainer.png'">
                    <h3 class="text-xl font-bold mb-2">Qualified Instructor</h3>
                    <p class="text-gray-400">Our certified instructors bring years of expertise to help you achieve your fitness goals with professional guidance.</p>
                </div>
                
                <!-- Info Box 3 -->
                <div class="info-box text-white reveal" style="transition-delay: 0.3s;">
                    <img src="{{ asset('images/equipment-icon.svg') }}" alt="Latest Equipment" class="info-icon" onerror="this.src='https://img.icons8.com/ios-filled/50/ffffff/gym-equipment.png'">
                    <h3 class="text-xl font-bold mb-2">Latest Equipment</h3>
                    <p class="text-gray-400">State-of-the-art fitness equipment to provide you with the best workout experience and optimal results.</p>
                </div>
                
                <!-- Info Box 4 -->
                <div class="info-box text-white reveal" style="transition-delay: 0.4s;">
                    <img src="{{ asset('images/award-icon.svg') }}" alt="Award Winners" class="info-icon" onerror="this.src='https://img.icons8.com/ios-filled/50/ffffff/trophy.png'">
                    <h3 class="text-xl font-bold mb-2">Award Winners</h3>
                    <p class="text-gray-400">Our trainers and facilities have been recognized with multiple industry awards for excellence and service.</p>
                </div>
            </div>
            
            <!-- Discount Banner (from Image 1 bottom section) -->
            <div class="mt-12 reveal" style="transition-delay: 0.5s;">
                <div class="discount-banner">
                    <img src="https://images.unsplash.com/photo-1577221084712-45b0445d2b00?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1498&q=80" 
                         alt="Discount Offer" 
                         class="w-full h-64 object-cover rounded-lg">
                    <div class="discount-text">
                        <div class="discount-percentage">35%</div>
                        <div class="text-2xl uppercase">Discount</div>
                        <div class="text-sm mt-2">Limited time offer for new members</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-24 bg-gray-50 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-orange-100 rounded-full opacity-50 transform translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-orange-100 rounded-full opacity-50 transform -translate-x-1/3 translate-y-1/3"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-20">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">WHY CHOOSE US</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Elevate Your <span class="gradient-text">Fitness Journey</span>
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    TrainTogether offers a premium fitness environment with everything you need to achieve your health and wellness goals.
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
                                <h3 class="text-xl font-bold">Premium Equipment</h3>
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
                                <span class="text-gray-700 font-medium">High-end cardio machines</span>
                            </li>
                            <li class="flex items-center">
                                <div class="custom-checkbox-icon">
                                    <i class="bx bx-check text-lg"></i>
                                </div>
                                <span class="text-gray-700 font-medium">Extensive free weight area</span>
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
                                <h3 class="text-xl font-bold">Elite Certified Trainers</h3>
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
                                <span class="text-gray-700 font-medium">Custom workout plans</span>
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

    <!-- NEW SECTION: Classes We Provide (based on Image 2) -->
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    <span class="text-orange-500">CLASSES</span> WE PROVIDE
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-gray-600">
                    Our gym classes offer a diverse range of workouts designed to help you achieve your fitness goals, 
                    led by experienced instructors in a motivating environment.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Class 1 -->
                <div class="class-card reveal">
                    <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80" 
                         alt="Body Building Class">
                    <div class="class-type">BODY BUILDING CLASS</div>
                    <div class="class-info">
                        <p class="text-sm font-bold">Duration: 50 Minutes</p>
                    </div>
                </div>

                <!-- Class 2 -->
                <div class="class-card reveal" style="transition-delay: 0.2s;">
                    <img src="https://images.unsplash.com/photo-1518310383802-640c2de311b6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Fitness Class">
                    <div class="class-type">FITNESS CLASS</div>
                    <div class="class-info">
                        <p class="text-sm font-bold">Duration: 45 Minutes</p>
                    </div>
                </div>

                <!-- Class 3 -->
                <div class="class-card reveal" style="transition-delay: 0.4s;">
                    <img src="https://images.unsplash.com/photo-1532029837206-abbe2b7620e3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Crossfit Class">
                    <div class="class-type">CROSSFIT CLASS</div>
                    <div class="class-info">
                        <p class="text-sm font-bold">Duration: 35 Minutes</p>
                    </div>
                </div>

                <!-- Class 4 -->
                <div class="class-card reveal" style="transition-delay: 0.6s;">
                    <img src="https://images.unsplash.com/photo-1510894347713-fc3ed6fdf539?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Yoga Class">
                    <div class="class-type">YOGA CLASS</div>
                    <div class="class-info">
                        <p class="text-sm font-bold">Duration: 25 Minutes</p>
                    </div>
                </div>

                <!-- Class 5 -->
                <div class="class-card reveal" style="transition-delay: 0.8s;">
                    <img src="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Martial Art Class">
                    <div class="class-type">MARTIAL ART CLASS</div>
                    <div class="class-info">
                        <p class="text-sm font-bold">Duration: 30 Minutes</p>
                    </div>
                </div>

                <!-- Class 6 -->
                <div class="class-card reveal" style="transition-delay: 1s;">
                    <img src="https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Cardio Class">
                    <div class="class-type">CARDIO CLASS</div>
                    <div class="class-info">
                        <p class="text-sm font-bold">Duration: 40 Minutes</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('sessions') }}" class="btn-3d inline-block px-10 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-full hover:shadow-xl transition-all duration-300">
                    VIEW ALL CLASSES
                </a>
            </div>
        </div>
    </section>

    <!-- NEW SECTION: Classical Workout (based on Image 3) -->
    <section class="py-16 workout-section relative overflow-hidden">
        <div class="workout-arrow"></div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="text-white workout-content reveal">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">CLASSICAL<br>WORKOUT</h2>
                    <p class="text-gray-400 mb-8">
                        Our classical workout routine combines traditional exercises with modern techniques for 
                        optimal results. Follow these steps for a complete full-body workout experience.
                    </p>
                    <a href="#" class="text-orange-500 font-bold hover:text-orange-400 transition-colors inline-flex items-center">
                        VIEW SCHEDULE 
                        <i class="bx bx-right-arrow-alt ml-2"></i>
                    </a>
                </div>
                
                <div class="workout-steps reveal" style="transition-delay: 0.3s;">
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Step 1 -->
                        <div class="flex flex-col items-center">
                            <img src="https://images.unsplash.com/photo-1566501206188-5dd0cf160a0e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" 
                                 alt="Downward Dog" 
                                 class="rounded-lg mb-2 h-32 w-full object-cover">
                            <div class="workout-step">
                                <div class="workout-number">1</div>
                                <span class="text-white">Downward Dog</span>
                            </div>
                        </div>
                        
                        <!-- Step 2 -->
                        <div class="flex flex-col items-center">
                            <img src="https://images.unsplash.com/photo-1517637382994-f02da38c6728?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1473&q=80" 
                                 alt="Cobra Pose" 
                                 class="rounded-lg mb-2 h-32 w-full object-cover">
                            <div class="workout-step">
                                <div class="workout-number">2</div>
                                <span class="text-white">Cobra Pose</span>
                            </div>
                        </div>
                        
                        <!-- Step 3 -->
                        <div class="flex flex-col items-center">
                            <img src="https://images.unsplash.com/photo-1599447292325-2caba821a6a6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                                 alt="Lunge Stretch" 
                                 class="rounded-lg mb-2 h-32 w-full object-cover">
                            <div class="workout-step">
                                <div class="workout-number">3</div>
                                <span class="text-white">Lunge Stretch</span>
                            </div>
                        </div>
                        
                        <!-- Step 4 -->
                        <div class="flex flex-col items-center">
                        <img src="https://images.unsplash.com/photo-1575052814086-f385e2e2ad1b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                                 alt="Child's Pose" 
                                 class="rounded-lg mb-2 h-32 w-full object-cover">
                            <div class="workout-step">
                                <div class="workout-number">4</div>
                                <span class="text-white">Child's Pose</span>
                            </div>
                        </div>
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

    <!-- NEW SECTION: Testimonials and BMI Calculator (based on Image 4) -->
    <section class="py-24 bg-gray-50 relative overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Testimonials Column -->
                <div class="reveal">
                    <div class="mb-8">
                        <p class="text-sm font-semibold text-orange-500">TESTIMONIALS</p>
                        <h2 class="text-4xl font-bold mt-2">
                            THAT'S WHAT OUR<br><span class="text-orange-500">CLIENT</span> SAYS
                        </h2>
                    </div>
                    
                    <div class="testimonial-slider bg-white p-8 rounded-lg shadow-lg">
                        <blockquote class="italic text-gray-700 mb-4">
                            "TrainTogether is very smart and technically sound gym, which maintains professional trainer as well as modern equipments. It helped me to maintain my health lutpas sit fugit, sed quia cuuntur magni dolores eos qui rat ione volupta pleasure rationally."
                        </blockquote>
                        <div class="flex items-center">
                            <div class="mr-4">
                                <div class="w-16 h-16 rounded-full overflow-hidden">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Stephen Fleming" class="w-full h-full object-cover">
                                </div>
                            </div>
                            <div>
                                <p class="font-bold text-lg">Stephen Fleming</p>
                                <p class="text-gray-500 text-sm">Mainland, USA</p>
                            </div>
                        </div>
                        
                        <div class="flex justify-end mt-4">
                            <div class="flex space-x-2">
                                <button class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-400 hover:text-orange-500 hover:border-orange-500 transition-colors">
                                    <i class="bx bx-chevron-left"></i>
                                </button>
                                <button class="w-8 h-8 rounded-full border border-gray-300 flex items-center justify-center text-gray-400 hover:text-orange-500 hover:border-orange-500 transition-colors">
                                    <i class="bx bx-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Decorative Element -->
                    <div class="flex space-x-1 mt-4">
                        <div class="w-2 h-2 bg-yellow-400 rounded-full"></div>
                        <div class="w-2 h-2 bg-yellow-400 rounded-full"></div>
                        <div class="w-2 h-2 bg-yellow-400 rounded-full"></div>
                        <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                        <div class="w-2 h-2 bg-gray-800 rounded-full"></div>
                        <div class="w-2 h-2 bg-gray-800 rounded-full"></div>
                    </div>
                </div>
                
                <!-- BMI Calculator Column -->
                <div class="reveal" style="transition-delay: 0.3s;">
                    <div class="bmi-calculator">
                        <h2 class="text-3xl font-bold mb-6">BMI <span class="text-orange-500">CALCULATOR</span></h2>
                        <p class="text-gray-400 mb-8">BMI is a reliable guide to estimate the healthy weight range based on height, weight and age.</p>
                        
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-gray-400 mb-2">Height / cm</label>
                                <input type="number" class="bmi-input" placeholder="Enter your height">
                            </div>
                            
                            <div>
                                <label class="block text-gray-400 mb-2">Weight / kg</label>
                                <input type="number" class="bmi-input" placeholder="Enter your weight">
                            </div>
                            
                            <div>
                                <label class="block text-gray-400 mb-2">Age</label>
                                <input type="number" class="bmi-input" placeholder="Enter your age">
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-400 mb-2">Gender</label>
                                    <select class="bmi-input">
                                        <option>Select gender</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-gray-400 mb-2">Activity factor</label>
                                    <select class="bmi-input">
                                        <option>Select an activity factor</option>
                                        <option>Sedentary</option>
                                        <option>Light Exercise</option>
                                        <option>Moderate Exercise</option>
                                        <option>Heavy Exercise</option>
                                    </select>
                                </div>
                            </div>
                            
                            <button class="calculate-btn">CALCULATE</button>
                            
                            <div class="bmi-result text-orange-500">0.0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Membership Plans Section -->
    <section class="py-24 bg-white relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-20 bg-gradient-to-b from-gray-50 to-transparent"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-20">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">MEMBERSHIP OPTIONS</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Choose Your <span class="gradient-text">Membership</span>
                </h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Select the plan that fits your lifestyle and helps you achieve your fitness goals.
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
                            Join TrainTogether today and take the first step towards a healthier, stronger you. Our team is ready to support you every step of the way.
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
                             alt="Join TrainTogether"
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
            
            // BMI Calculator Functionality
            const calculateBtn = document.querySelector('.calculate-btn');
            if (calculateBtn) {
                calculateBtn.addEventListener('click', function() {
                    const height = parseFloat(document.querySelectorAll('.bmi-input')[0].value) / 100; // convert cm to m
                    const weight = parseFloat(document.querySelectorAll('.bmi-input')[1].value);
                    const bmiResult = document.querySelector('.bmi-result');
                    
                    if (height && weight) {
                        const bmi = (weight / (height * height)).toFixed(1);
                        bmiResult.textContent = bmi;
                    } else {
                        bmiResult.textContent = '0.0';
                    }
                });
            }
        });
    </script>
@endsection
@extends('layouts.main')

@section('title', 'About Us')

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
        
        /* About Page Specific Styles */
        .about-hero {
            background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1534367610401-9f5ed68180aa?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .about-card {
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s ease;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .about-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        
        .value-card {
            border-radius: 16px;
            padding: 32px;
            background: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .value-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .value-icon {
            width: 70px;
            height: 70px;
            border-radius: 20px;
            background: linear-gradient(135deg, #ff5e14, #ff8c00);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }
        
        .value-card:hover .value-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        .team-card {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        
        .team-img {
            height: 350px;
            width: 100%;
            object-fit: cover;
            transition: all 0.5s ease;
        }
        
        .team-card:hover .team-img {
            transform: scale(1.05);
        }
        
        .team-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0));
            color: white;
            transition: all 0.3s ease;
        }
        
        .team-card:hover .team-info {
            padding-bottom: 30px;
        }
        
        .team-social {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .team-social-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }
        
        .team-social-icon:hover {
            background: #ff5e14;
            transform: translateY(-3px);
        }
        
        .timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background-color: #ff5e14;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
        }
        
        .timeline-container {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
        }
        
        .timeline-container.left {
            left: 0;
        }
        
        .timeline-container.right {
            left: 50%;
        }
        
        .timeline-container::after {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            right: -13px;
            background: linear-gradient(135deg, #ff5e14, #ff8c00);
            border: 4px solid white;
            top: 20px;
            border-radius: 50%;
            z-index: 1;
        }
        
        .timeline-container.right::after {
            left: -13px;
        }
        
        .timeline-content {
            padding: 20px 30px;
            background: white;
            position: relative;
            border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .timeline-content h3 {
            color: #ff5e14;
            margin-bottom: 10px;
        }
        
        @media screen and (max-width: 768px) {
            .timeline::after {
                left: 31px;
            }
            
            .timeline-container {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }
            
            .timeline-container.right {
                left: 0%;
            }
            
            .timeline-container.left::after, .timeline-container.right::after {
                left: 18px;
            }
        }
        
        .stat-card {
            padding: 40px 30px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .stat-number {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 10px;
            background: linear-gradient(to right, #ff5e14, #ff8c00);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .cta-section {
            background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1517836357463-d25dfeac3438?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            border-radius: 20px;
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="about-hero py-40 relative">
        <div class="container mx-auto px-4 text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">About <span class="text-orange-500">TrainTogether</span></h1>
            <p class="text-xl max-w-3xl mx-auto">Our mission is to empower individuals with the tools, knowledge, and community support they need to achieve their fitness goals and live healthier lives.</p>
        </div>
    </div>
    
    <!-- Our Story Section -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="reveal">
                    <div class="about-card p-4">
                        <img src="https://images.unsplash.com/photo-1561214078-f3247647fc5e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1074&q=80" 
                             alt="TrainTogether Gym" 
                             class="rounded-lg h-full w-full object-cover">
                    </div>
                </div>
                
                <div class="space-y-6 reveal" style="transition-delay: 0.2s;">
                    <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold">OUR STORY</span>
                    <h2 class="text-4xl font-bold">From <span class="gradient-text">Passion</span> to <span class="gradient-text">Community</span></h2>
                    <p class="text-gray-600">
                        Founded in 2005, TrainTogether began as a small gym with a big vision: to create a fitness community where everyone feels welcome, supported, and empowered to achieve their health and wellness goals. 
                    </p>
                    <p class="text-gray-600">
                        Our founders, former professional athletes and certified trainers, noticed a gap in the fitness industry. Too many gyms were intimidating spaces that focused solely on physical appearance rather than overall well-being and sustainable lifestyle changes.
                    </p>
                    <p class="text-gray-600">
                        What started as a modest facility with just a few pieces of equipment has grown into a premier fitness destination with multiple locations across the country. Despite our growth, we've never lost sight of our core values: community, education, innovation, and inclusivity.
                    </p>
                    <div class="flex space-x-4 pt-4">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Founder" class="w-16 h-16 rounded-full">
                        <div>
                            <p class="font-bold text-lg">Michael Thompson</p>
                            <p class="text-orange-500">Founder & CEO</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Our Values Section -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">OUR VALUES</span>
                <h2 class="text-4xl font-bold mb-4">What Makes Us <span class="gradient-text">Different</span></h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Our values drive everything we do, from how we design our fitness programs to how we interact with our community members.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Value 1 -->
                <div class="value-card reveal">
                    <div class="value-icon">
                        <i class="bx bx-group text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Community</h3>
                    <p class="text-gray-600">
                        We believe fitness is better together. Our community-focused approach creates a supportive environment where members motivate each other to achieve their goals.
                    </p>
                </div>
                
                <!-- Value 2 -->
                <div class="value-card reveal" style="transition-delay: 0.2s;">
                    <div class="value-icon">
                        <i class="bx bx-book-open text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Education</h3>
                    <p class="text-gray-600">
                        Knowledge is power. We prioritize educating our members about fitness, nutrition, and wellness so they can make informed decisions about their health.
                    </p>
                </div>
                
                <!-- Value 3 -->
                <div class="value-card reveal" style="transition-delay: 0.4s;">
                    <div class="value-icon">
                        <i class="bx bx-bulb text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Innovation</h3>
                    <p class="text-gray-600">
                        We constantly evolve our programs, equipment, and approaches based on the latest research and technology to provide the most effective fitness experience.
                    </p>
                </div>
                
                <!-- Value 4 -->
                <div class="value-card reveal" style="transition-delay: 0.6s;">
                    <div class="value-icon">
                        <i class="bx bx-check-shield text-white text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Inclusivity</h3>
                    <p class="text-gray-600">
                        Fitness is for everyone. We create a welcoming space for people of all fitness levels, backgrounds, ages, and abilities to pursue their health goals.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Our History/Timeline Section -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">OUR JOURNEY</span>
                <h2 class="text-4xl font-bold mb-4">Our <span class="gradient-text">Evolution</span></h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    From our humble beginnings to becoming a leading fitness brand, our journey has been driven by a commitment to excellence and innovation.
                </p>
            </div>
            
            <div class="timeline">
                <!-- 2005 -->
                <div class="timeline-container left reveal">
                    <div class="timeline-content">
                        <h3 class="text-xl font-bold">2005</h3>
                        <p class="text-gray-600">Founded in a small warehouse with just a few pieces of equipment and a vision to create a different kind of fitness community.</p>
                    </div>
                </div>
                
                <!-- 2008 -->
                <div class="timeline-container right reveal" style="transition-delay: 0.2s;">
                    <div class="timeline-content">
                        <h3 class="text-xl font-bold">2008</h3>
                        <p class="text-gray-600">Expanded to a larger facility and introduced our first comprehensive fitness programs and personal training services.</p>
                    </div>
                </div>
                
                <!-- 2012 -->
                <div class="timeline-container left reveal" style="transition-delay: 0.4s;">
                    <div class="timeline-content">
                        <h3 class="text-xl font-bold">2012</h3>
                        <p class="text-gray-600">Opened our second location and launched our nutrition coaching program to provide holistic health support.</p>
                    </div>
                </div>
                
                <!-- 2016 -->
                <div class="timeline-container right reveal" style="transition-delay: 0.6s;">
                    <div class="timeline-content">
                        <h3 class="text-xl font-bold">2016</h3>
                        <p class="text-gray-600">Received industry recognition as one of the top fitness centers in the region and expanded to five locations nationwide.</p>
                    </div>
                </div>
                
                <!-- 2020 -->
                <div class="timeline-container left reveal" style="transition-delay: 0.8s;">
                    <div class="timeline-content">
                        <h3 class="text-xl font-bold">2020</h3>
                        <p class="text-gray-600">Launched our digital platform to provide virtual training options and connect our growing community of members.</p>
                    </div>
                </div>
                
                <!-- 2023 -->
                <div class="timeline-container right reveal" style="transition-delay: 1s;">
                    <div class="timeline-content">
                        <h3 class="text-xl font-bold">2023</h3>
                        <p class="text-gray-600">Celebrating our continued growth with the opening of our 10th location and the introduction of new cutting-edge fitness programs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Meet Our Team Section -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">OUR TEAM</span>
                <h2 class="text-4xl font-bold mb-4">Meet Our <span class="gradient-text">Expert Team</span></h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Our team of certified fitness professionals is dedicated to helping you achieve your health and wellness goals.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Team Member 1 -->
                <div class="team-card reveal">
                    <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Michael Thompson" 
                         class="team-img">
                    <div class="team-info">
                        <h3 class="text-xl font-bold">Michael Thompson</h3>
                        <p class="text-orange-400">Founder & CEO</p>
                        <div class="team-social">
                            <a href="#" class="team-social-icon"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="team-social-icon"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="team-social-icon"><i class="bx bxl-instagram"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 2 -->
                <div class="team-card reveal" style="transition-delay: 0.2s;">
                    <img src="https://images.unsplash.com/photo-1599058917765-a780eda07a3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80" 
                         alt="Sarah Johnson" 
                         class="team-img">
                    <div class="team-info">
                        <h3 class="text-xl font-bold">Sarah Johnson</h3>
                        <p class="text-orange-400">Head of Training</p>
                        <div class="team-social">
                            <a href="#" class="team-social-icon"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="team-social-icon"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="team-social-icon"><i class="bx bxl-instagram"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 3 -->
                <div class="team-card reveal" style="transition-delay: 0.4s;">
                    <img src="https://images.unsplash.com/photo-1546483875-ad9014c88eba?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1464&q=80" 
                         alt="David Wilson" 
                         class="team-img">
                    <div class="team-info">
                        <h3 class="text-xl font-bold">David Wilson</h3>
                        <p class="text-orange-400">Nutrition Specialist</p>
                        <div class="team-social">
                            <a href="#" class="team-social-icon"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="team-social-icon"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="team-social-icon"><i class="bx bxl-instagram"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Team Member 4 -->
                <div class="team-card reveal" style="transition-delay: 0.6s;">
                    <img src="https://images.unsplash.com/photo-1548690312-e3b507d8c110?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" 
                         alt="Emma Davis" 
                         class="team-img">
                    <div class="team-info">
                        <h3 class="text-xl font-bold">Emma Davis</h3>
                        <p class="text-orange-400">Yoga & Wellness Coach</p>
                        <div class="team-social">
                            <a href="#" class="team-social-icon"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="team-social-icon"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="team-social-icon"><i class="bx bxl-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('trainers') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-full hover:shadow-xl transition-all duration-300">
                    View All Team Members
                </a>
            </div>
        </div>
    </section>
    
    <!-- Stats Section -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">OUR IMPACT</span>
                <h2 class="text-4xl font-bold mb-4">By The <span class="gradient-text">Numbers</span></h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    We're proud of the impact we've made in helping thousands of individuals transform their lives through fitness.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Stat 1 -->
                <div class="stat-card reveal">
                    <div class="stat-number">18+</div>
                    <p class="text-gray-700 font-semibold uppercase">Years Experience</p>
                </div>
                
                <!-- Stat 2 -->
                <div class="stat-card reveal" style="transition-delay: 0.2s;">
                    <div class="stat-number">10</div>
                    <p class="text-gray-700 font-semibold uppercase">Locations</p>
                </div>
                
                <!-- Stat 3 -->
                <div class="stat-card reveal" style="transition-delay: 0.4s;">
                    <div class="stat-number">50+</div>
                    <p class="text-gray-700 font-semibold uppercase">Expert Trainers</p>
                </div>
                
                <!-- Stat 4 -->
                <div class="stat-card reveal" style="transition-delay: 0.6s;">
                    <div class="stat-number">15k+</div>
                    <p class="text-gray-700 font-semibold uppercase">Happy Members</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="cta-section p-12 md:p-20 text-white">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Join Our Community?</h2>
                    <p class="text-lg mb-8">
                        Take the first step towards a healthier, stronger you by joining the TrainTogether community today. 
                        Experience the difference our expert trainers, state-of-the-art facilities, and supportive community can make in your fitness journey.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-full transition-all duration-300">
                            Become a Member
                        </a>
                        <a href="{{ route('contact') }}" class="px-8 py-4 bg-transparent border-2 border-white hover:bg-white hover:text-orange-600 text-white font-bold rounded-full transition-all duration-300">
                            Contact Us
                        </a>
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
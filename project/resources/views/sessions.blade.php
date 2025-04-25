@extends('layouts.main')

@section('title', 'Classes')

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
        
        /* Classes Page Specific Styles */
        .classes-hero {
            background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1571902943202-507ec2618e8f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1375&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .class-card {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
            background: white;
            position: relative;
        }
        
        .class-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .class-image {
            height: 250px;
            position: relative;
        }
        
        .class-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.5s ease;
        }
        
        .class-card:hover .class-image img {
            transform: scale(1.1);
        }
        
        .class-difficulty {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .beginner {
            background: rgba(72, 187, 120, 0.9);
        }
        
        .intermediate {
            background: rgba(237, 137, 54, 0.9);
        }
        
        .advanced {
            background: rgba(224, 36, 36, 0.9);
        }
        
        .class-content {
            padding: 24px;
        }
        
        .class-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        
        .class-meta-item {
            display: flex;
            align-items: center;
            color: #718096;
        }
        
        .class-meta-item i {
            margin-right: 8px;
            color: #ff5e14;
        }
        
        .class-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #2d3748;
        }
        
        .class-description {
            color: #718096;
            margin-bottom: 20px;
        }
        
        .class-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
        }
        
        .class-instructor {
            display: flex;
            align-items: center;
        }
        
        .instructor-image {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 12px;
        }
        
        .instructor-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .instructor-name {
            font-weight: 600;
            color: #2d3748;
        }
        
        .class-btn {
            background: linear-gradient(to right, #ff5e14, #ff8c00);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .class-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 94, 20, 0.3);
        }
        
        .filter-btn {
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            background: white;
            color: #4a5568;
            border: 1px solid #e2e8f0;
        }
        
        .filter-btn.active {
            background: linear-gradient(to right, #ff5e14, #ff8c00);
            color: white;
            border-color: transparent;
            box-shadow: 0 10px 20px rgba(255, 94, 20, 0.2);
        }
        
        .filter-btn:hover:not(.active) {
            background: #f7fafc;
            border-color: #ff5e14;
            color: #ff5e14;
        }
        
        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .schedule-table th {
            background: linear-gradient(to right, #ff5e14, #ff8c00);
            color: white;
            padding: 16px;
            text-align: left;
        }
        
        .schedule-table td {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .schedule-table tr:last-child td {
            border-bottom: none;
        }
        
        .schedule-table tr:hover td {
            background: #f7fafc;
        }
        
        .schedule-class {
            display: flex;
            align-items: center;
        }
        
        .schedule-class-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 94, 20, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 16px;
            color: #ff5e14;
        }
        
        .day-tabs {
            display: flex;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 32px;
        }
        
        .day-tab {
            flex: 1;
            padding: 16px;
            text-align: center;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }
        
        .day-tab.active {
            background: linear-gradient(to right, #ff5e14, #ff8c00);
            color: white;
            border-bottom-color: #ff8c00;
        }
        
        .day-tab:not(.active):hover {
            background: #f7fafc;
            border-bottom-color: #ff5e14;
            color: #ff5e14;
        }
        
        .testimonial-card {
            background: white;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .testimonial-text {
            font-style: italic;
            color: #4a5568;
            margin-bottom: 24px;
            position: relative;
        }
        
        .testimonial-text::before {
            content: """;
            font-size: 72px;
            color: rgba(255, 94, 20, 0.1);
            position: absolute;
            top: -20px;
            left: -10px;
            z-index: -1;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
        }
        
        .testimonial-author-image {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 16px;
        }
        
        .testimonial-author-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .testimonial-author-name {
            font-weight: 600;
            color: #2d3748;
        }
        
        .testimonial-author-title {
            color: #718096;
            font-size: 14px;
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="classes-hero py-40 relative">
        <div class="container mx-auto px-4 text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">Our <span class="text-orange-500">Classes</span></h1>
            <p class="text-xl max-w-3xl mx-auto">Discover a wide range of fitness classes designed to help you achieve your health and wellness goals, led by our expert instructors.</p>
        </div>
    </div>
    
    <!-- Filter Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">OUR CLASSES</span>
                <h2 class="text-4xl font-bold mb-4">Find Your <span class="gradient-text">Perfect Class</span></h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Filter through our diverse range of classes to find the perfect fit for your fitness journey.
                </p>
            </div>
            
            <div class="flex flex-wrap justify-center gap-4 mb-12">
                <button class="filter-btn active" data-category="all">All Classes</button>
                <button class="filter-btn" data-category="cardio">Cardio</button>
                <button class="filter-btn" data-category="strength">Strength</button>
                <button class="filter-btn" data-category="yoga">Yoga</button>
                <button class="filter-btn" data-category="crossfit">CrossFit</button>
                <button class="filter-btn" data-category="hiit">HIIT</button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Class 1 -->
                <div class="class-card reveal" data-category="cardio">
                    <div class="class-image">
                        <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="Cardio Blast">
                        <div class="class-difficulty beginner">Beginner</div>
                    </div>
                    <div class="class-content">
                        <div class="class-meta">
                            <div class="class-meta-item">
                                <i class="bx bx-time"></i>
                                <span>45 min</span>
                            </div>
                            <div class="class-meta-item">
                                <i class="bx bx-calendar"></i>
                                <span>Mon, Wed, Fri</span>
                            </div>
                        </div>
                        <h3 class="class-title">Cardio Blast</h3>
                        <p class="class-description">
                            A high-energy cardio workout designed to boost your endurance and burn calories through dynamic movements and interval training.
                        </p>
                        <div class="class-footer">
                            <div class="class-instructor">
                                <div class="instructor-image">
                                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Sarah Johnson">
                                </div>
                                <div>
                                    <div class="instructor-name">Sarah Johnson</div>
                                    <div class="instructor-role text-sm text-gray-500">Cardio Specialist</div>
                                </div>
                            </div>
                            <a href="#" class="class-btn">Book Now</a>
                        </div>
                    </div>
                </div>
                
                <!-- Class 2 -->
                <div class="class-card reveal" data-category="strength" style="transition-delay: 0.2s;">
                    <div class="class-image">
                        <img src="https://images.unsplash.com/photo-1596357395217-80de13130e92?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" 
                             alt="Power Lifting">
                        <div class="class-difficulty intermediate">Intermediate</div>
                    </div>
                    <div class="class-content">
                        <div class="class-meta">
                            <div class="class-meta-item">
                                <i class="bx bx-time"></i>
                                <span>60 min</span>
                            </div>
                            <div class="class-meta-item">
                                <i class="bx bx-calendar"></i>
                                <span>Tue, Thu</span>
                            </div>
                        </div>
                        <h3 class="class-title">Power Lifting</h3>
                        <p class="class-description">
                            Build strength and muscle definition through progressive weight training techniques focused on proper form and maximum results.
                        </p>
                        <div class="class-footer">
                            <div class="class-instructor">
                                <div class="instructor-image">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Mike Thompson">
                                </div>
                                <div>
                                    <div class="instructor-name">Mike Thompson</div>
                                    <div class="instructor-role text-sm text-gray-500">Strength Coach</div>
                                </div>
                            </div>
                            <a href="#" class="class-btn">Book Now</a>
                        </div>
                    </div>
                </div>
                
                <!-- Class 3 -->
                <div class="class-card reveal" data-category="yoga" style="transition-delay: 0.4s;">
                    <div class="class-image">
                        <img src="https://images.unsplash.com/photo-1599447292325-2caba821a6a6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="Yoga Flow">
                        <div class="class-difficulty beginner">Beginner</div>
                    </div>
                    <div class="class-content">
                        <div class="class-meta">
                            <div class="class-meta-item">
                                <i class="bx bx-time"></i>
                                <span>50 min</span>
                            </div>
                            <div class="class-meta-item">
                                <i class="bx bx-calendar"></i>
                                <span>Mon, Wed, Fri</span>
                            </div>
                        </div>
                        <h3 class="class-title">Yoga Flow</h3>
                        <p class="class-description">
                            Connect movement with breath in this flowing yoga class that improves flexibility, balance, and mental clarity.
                        </p>
                        <div class="class-footer">
                            <div class="class-instructor">
                                <div class="instructor-image">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Emma Davis">
                                </div>
                                <div>
                                    <div class="instructor-name">Emma Davis</div>
                                    <div class="instructor-role text-sm text-gray-500">Yoga Instructor</div>
                                </div>
                            </div>
                            <a href="#" class="class-btn">Book Now</a>
                        </div>
                    </div>
                </div>
                
                <!-- Class 4 -->
                <div class="class-card reveal" data-category="crossfit" style="transition-delay: 0.2s;">
                    <div class="class-image">
                        <img src="https://images.unsplash.com/photo-1526506118085-60ce8714f8c5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80" 
                             alt="CrossFit Challenge">
                        <div class="class-difficulty advanced">Advanced</div>
                    </div>
                    <div class="class-content">
                        <div class="class-meta">
                            <div class="class-meta-item">
                                <i class="bx bx-time"></i>
                                <span>55 min</span>
                            </div>
                            <div class="class-meta-item">
                                <i class="bx bx-calendar"></i>
                                <span>Tue, Thu, Sat</span>
                            </div>
                        </div>
                        <h3 class="class-title">CrossFit Challenge</h3>
                        <p class="class-description">
                            Push your limits with high-intensity functional movements that build strength, endurance, and mental toughness.
                        </p>
                        <div class="class-footer">
                            <div class="class-instructor">
                                <div class="instructor-image">
                                    <img src="https://randomuser.me/api/portraits/men/52.jpg" alt="Alex Rodriguez">
                                </div>
                                <div>
                                    <div class="instructor-name">Alex Rodriguez</div>
                                    <div class="instructor-role text-sm text-gray-500">CrossFit Coach</div>
                                </div>
                            </div>
                            <a href="#" class="class-btn">Book Now</a>
                        </div>
                    </div>
                </div>
                
                <!-- Class 5 -->
                <div class="class-card reveal" data-category="hiit" style="transition-delay: 0.4s;">
                    <div class="class-image">
                        <img src="https://images.unsplash.com/photo-1434682881908-b43d0467b798?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1474&q=80" 
                             alt="HIIT Workout">
                        <div class="class-difficulty intermediate">Intermediate</div>
                    </div>
                    <div class="class-content">
                        <div class="class-meta">
                            <div class="class-meta-item">
                                <i class="bx bx-time"></i>
                                <span>30 min</span>
                            </div>
                            <div class="class-meta-item">
                                <i class="bx bx-calendar"></i>
                                <span>Mon, Wed, Fri</span>
                            </div>
                        </div>
                        <h3 class="class-title">HIIT Workout</h3>
                        <p class="class-description">
                            Maximize calorie burn and improve cardiovascular health with this time-efficient high-intensity interval training session.
                        </p>
                        <div class="class-footer">
                            <div class="class-instructor">
                                <div class="instructor-image">
                                    <img src="https://randomuser.me/api/portraits/women/28.jpg" alt="Jessica Martinez">
                                </div>
                                <div>
                                    <div class="instructor-name">Jessica Martinez</div>
                                    <div class="instructor-role text-sm text-gray-500">HIIT Specialist</div>
                                </div>
                            </div>
                            <a href="#" class="class-btn">Book Now</a>
                        </div>
                    </div>
                </div>
                
                <!-- Class 6 -->
                <div class="class-card reveal" data-category="strength" style="transition-delay: 0.6s;">
                    <div class="class-image">
                        <img src="https://images.unsplash.com/photo-1448387473223-5c37445527e7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="Core Strength">
                        <div class="class-difficulty beginner">Beginner</div>
                    </div>
                    <div class="class-content">
                        <div class="class-meta">
                            <div class="class-meta-item">
                                <i class="bx bx-time"></i>
                                <span>40 min</span>
                            </div>
                            <div class="class-meta-item">
                                <i class="bx bx-calendar"></i>
                                <span>Tue, Thu</span>
                            </div>
                        </div>
                        <h3 class="class-title">Core Strength</h3>
                        <p class="class-description">
                            Focus on building a strong core with exercises that target your abs, back, and stabilizing muscles for better posture and performance.
                        </p>
                        <div class="class-footer">
                            <div class="class-instructor">
                                <div class="instructor-image">
                                    <img src="https://randomuser.me/api/portraits/men/63.jpg" alt="David Wilson">
                                </div>
                                <div>
                                    <div class="instructor-name">David Wilson</div>
                                    <div class="instructor-role text-sm text-gray-500">Core Specialist</div>
                                </div>
                            </div>
                            <a href="#" class="class-btn">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="#" class="inline-block px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-full hover:shadow-xl transition-all duration-300">
                    View All Classes
                </a>
            </div>
        </div>
    </section>
    
    <!-- Weekly Schedule Section -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">CLASS SCHEDULE</span>
                <h2 class="text-4xl font-bold mb-4">Weekly <span class="gradient-text">Class Schedule</span></h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Plan your week ahead with our comprehensive class schedule. Find the perfect time that fits your lifestyle.
                </p>
            </div>
            
            <div class="day-tabs">
                <div class="day-tab active" data-day="monday">Monday</div>
                <div class="day-tab" data-day="tuesday">Tuesday</div>
                <div class="day-tab" data-day="wednesday">Wednesday</div>
                <div class="day-tab" data-day="thursday">Thursday</div>
                <div class="day-tab" data-day="friday">Friday</div>
                <div class="day-tab" data-day="saturday">Saturday</div>
                <div class="day-tab" data-day="sunday">Sunday</div>
            </div>
            
            <div class="schedule-container">
                <!-- Monday Schedule -->
                <div class="schedule-day active" id="monday">
                    <table class="schedule-table">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Class</th>
                                <th>Instructor</th>
                                <th>Duration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>06:00 AM</td>
                                <td>
                                    <div class="schedule-class">
                                        <div class="schedule-class-icon">
                                            <i class="bx bx-timer"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold">HIIT Workout</div>
                                            <div class="text-sm text-gray-500">High Intensity Training</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Jessica Martinez</td>
                                <td>30 min</td>
                                <td><a href="#" class="class-btn">Book</a></td>
                            </tr>
                            <tr>
                                <td>08:00 AM</td>
                                <td>
                                    <div class="schedule-class">
                                        <div class="schedule-class-icon">
                                            <i class="bx bx-spa"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold">Yoga Flow</div>
                                            <div class="text-sm text-gray-500">Mind & Body Connection</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Emma Davis</td>
                                <td>50 min</td>
                                <td><a href="#" class="class-btn">Book</a></td>
                            </tr>
                            <tr>
                                <td>12:00 PM</td>
                                <td>
                                    <div class="schedule-class">
                                        <div class="schedule-class-icon">
                                            <i class="bx bx-run"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold">Cardio Blast</div>
                                            <div class="text-sm text-gray-500">Endurance Training</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Sarah Johnson</td>
                                <td>45 min</td>
                                <td><a href="#" class="class-btn">Book</a></td>
                            </tr>
                            <tr>
                                <td>05:30 PM</td>
                                <td>
                                    <div class="schedule-class">
                                        <div class="schedule-class-icon">
                                            <i class="bx bx-dumbbell"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold">Core Strength</div>
                                            <div class="text-sm text-gray-500">Ab & Back Focus</div>
                                        </div>
                                    </div>
                                </td>
                                <td>David Wilson</td>
                                <td>40 min</td>
                                <td><a href="#" class="class-btn">Book</a></td>
                            </tr>
                            <tr>
                                <td>07:00 PM</td>
                                <td>
                                    <div class="schedule-class">
                                        <div class="schedule-class-icon">
                                            <i class="bx bx-cycling"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold">Spin Class</div>
                                            <div class="text-sm text-gray-500">Indoor Cycling</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Michael Brown</td>
                                <td>45 min</td>
                                <td><a href="#" class="class-btn">Book</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Other days would have similar structure but different content -->
                <div class="schedule-day hidden" id="tuesday">
                    <!-- Tuesday schedule content would go here -->
                </div>
                <div class="schedule-day hidden" id="wednesday">
                    <!-- Wednesday schedule content would go here -->
                </div>
                <div class="schedule-day hidden" id="thursday">
                    <!-- Thursday schedule content would go here -->
                </div>
                <div class="schedule-day hidden" id="friday">
                    <!-- Friday schedule content would go here -->
                </div>
                <div class="schedule-day hidden" id="saturday">
                    <!-- Saturday schedule content would go here -->
                </div>
                <div class="schedule-day hidden" id="sunday">
                    <!-- Sunday schedule content would go here -->
                </div>
            </div>
            
            <div class="mt-8 text-center">
                <p class="text-gray-600 mb-4">Want to see our full schedule or book a class in advance?</p>
                <a href="#" class="inline-block px-8 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-full hover:shadow-xl transition-all duration-300">
                    Download Full Schedule
                </a>
            </div>
        </div>
    </section>
    
    <!-- Class Testimonials Section -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">TESTIMONIALS</span>
                <h2 class="text-4xl font-bold mb-4">What Our <span class="gradient-text">Members Say</span></h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Hear from our members about how our classes have helped them transform their fitness journey.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="testimonial-card reveal">
                    <div class="testimonial-text">
                        "The HIIT classes at TrainTogether have completely transformed my fitness routine. In just two months, I've lost 15 pounds and gained so much energy. Jessica is an incredible instructor who knows how to push you just the right amount!"
                    </div>
                    <div class="testimonial-author">
                        <div class="testimonial-author-image">
                            <img src="https://randomuser.me/api/portraits/women/33.jpg" alt="Rebecca White">
                        </div>
                        <div>
                            <div class="testimonial-author-name">Rebecca White</div>
                            <div class="testimonial-author-title">Member since 2022</div>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="testimonial-card reveal" style="transition-delay: 0.2s;">
                    <div class="testimonial-text">
                        "I was intimidated to try CrossFit, but Alex made me feel welcome from day one. The community aspect of these classes is what keeps me coming back. I've never felt stronger or more confident in my athletic abilities."
                    </div>
                    <div class="testimonial-author">
                        <div class="testimonial-author-image">
                            <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="James Peterson">
                        </div>
                        <div>
                            <div class="testimonial-author-name">James Peterson</div>
                            <div class="testimonial-author-title">Member since 2021</div>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="testimonial-card reveal" style="transition-delay: 0.4s;">
                    <div class="testimonial-text">
                        "Emma's Yoga Flow class has been a game-changer for my stress levels and flexibility. As someone who sits at a desk all day, this class has helped me correct my posture and reduce back pain. I never miss a session!"
                    </div>
                    <div class="testimonial-author">
                        <div class="testimonial-author-image">
                            <img src="https://randomuser.me/api/portraits/women/57.jpg" alt="Michelle Thompson">
                        </div>
                        <div>
                            <div class="testimonial-author-name">Michelle Thompson</div>
                            <div class="testimonial-author-title">Member since 2020</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-3xl overflow-hidden shadow-2xl">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 p-12">
                        <h2 class="text-3xl md:text-4xl font-bold text-white leading-tight mb-4">
                            Ready to Try a Class?
                        </h2>
                        <p class="text-lg text-orange-100 mb-8">
                            Join TrainTogether today and experience our world-class fitness classes with a free trial. Our expert instructors will guide you every step of the way.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-orange-600 font-bold rounded-full hover:shadow-xl transition-all duration-300">
                                Get Started
                            </a>
                            <a href="#" class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-orange-600 transition-all duration-300">
                                Book a Trial Class
                            </a>
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1375&q=80"
                             alt="TrainTogether Class"
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
            
            // Class Filtering
            const filterButtons = document.querySelectorAll('.filter-btn');
            const classCards = document.querySelectorAll('.class-card');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    
                    // Add active class to clicked button
                    button.classList.add('active');
                    
                    // Get category to filter
                    const category = button.dataset.category;
                    
                    // Show/hide classes based on category
                    classCards.forEach(card => {
                        if (category === 'all' || card.dataset.category === category) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
            
            // Day Tabs for Schedule
            const dayTabs = document.querySelectorAll('.day-tab');
            const scheduleDays = document.querySelectorAll('.schedule-day');
            
            dayTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // Remove active class from all tabs
                    dayTabs.forEach(t => t.classList.remove('active'));
                    
                    // Add active class to clicked tab
                    tab.classList.add('active');
                    
                    // Get day to show
                    const day = tab.dataset.day;
                    
                    // Show/hide schedule days
                    scheduleDays.forEach(schedule => {
                        if (schedule.id === day) {
                            schedule.classList.remove('hidden');
                            schedule.classList.add('active');
                        } else {
                            schedule.classList.add('hidden');
                            schedule.classList.remove('active');
                        }
                    });
                });
            });
        });
    </script>
@endsection
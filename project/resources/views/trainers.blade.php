@extends('layouts.main')

@section('title', 'Our Trainers')

@section('content')
<!-- Hero Section -->
<div class="bg-indigo-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Meet Our Expert Trainers</h1>
        <p class="text-xl max-w-3xl mx-auto">Our certified fitness professionals are dedicated to helping you achieve your goals</p>
    </div>
</div>

<!-- Trainers Filter -->
<section class="py-10 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-center gap-4">
            <button class="px-4 py-2 bg-indigo-600 text-white rounded-md">All Trainers</button>
            <button class="px-4 py-2 bg-white hover:bg-gray-200 text-gray-800 rounded-md">Strength & Conditioning</button>
            <button class="px-4 py-2 bg-white hover:bg-gray-200 text-gray-800 rounded-md">Yoga & Pilates</button>
            <button class="px-4 py-2 bg-white hover:bg-gray-200 text-gray-800 rounded-md">Cardio & HIIT</button>
            <button class="px-4 py-2 bg-white hover:bg-gray-200 text-gray-800 rounded-md">Nutrition</button>
        </div>
    </div>
</section>

<!-- Trainers Grid -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <!-- Trainer 1 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="John Davis" class="w-full h-80 object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2">John Davis</h3>
                    <p class="text-indigo-600 font-medium mb-4">Strength & Conditioning</p>
                    <p class="text-gray-600 mb-4">Specializes in powerlifting and functional strength training with 8+ years of experience and multiple certifications including NASM-CPT and CSCS.</p>
                    <div class="flex space-x-3 mb-6">
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Strength Training</span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Functional Fitness</span>
                    </div>
                    <a href="#" class="block w-full py-3 text-center bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Book a Session</a>
                </div>
            </div>
            
            <!-- Trainer 2 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <img src="https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Sarah Johnson" class="w-full h-80 object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2">Sarah Johnson</h3>
                    <p class="text-indigo-600 font-medium mb-4">Yoga & Pilates</p>
                    <p class="text-gray-600 mb-4">Certified yoga instructor with over 500 hours of training and 6 years of teaching experience. Specializes in vinyasa flow and restorative yoga practices.</p>
                    <div class="flex space-x-3 mb-6">
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Yoga</span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Pilates</span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Meditation</span>
                    </div>
                    <a href="#" class="block w-full py-3 text-center bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Book a Session</a>
                </div>
            </div>
            
            <!-- Trainer 3 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1583468323330-9032ad490fed?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Mike Roberts" class="w-full h-80 object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2">Mike Roberts</h3>
                    <p class="text-indigo-600 font-medium mb-4">Cardio & HIIT</p>
                    <p class="text-gray-600 mb-4">Specializes in high-intensity interval training and cardio conditioning. Former college athlete with ACE and HIIT certifications.</p>
                    <div class="flex space-x-3 mb-6">
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">HIIT</span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Cardio</span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Circuit Training</span>
                    </div>
                    <a href="#" class="block w-full py-3 text-center bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Book a Session</a>
                </div>
            </div>
            
            <!-- Trainer 4 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1548690312-e3b507d8c110?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Emily Chen" class="w-full h-80 object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2">Emily Chen</h3>
                    <p class="text-indigo-600 font-medium mb-4">Nutrition & Wellness</p>
                    <p class="text-gray-600 mb-4">Certified nutritionist with a degree in Dietetics. Helps clients achieve health goals through personalized nutrition plans and holistic wellness approaches.</p>
                    <div class="flex space-x-3 mb-6">
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Nutrition</span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Meal Planning</span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Weight Management</span>
                    </div>
                    <a href="#" class="block w-full py-3 text-center bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Book a Session</a>
                </div>
            </div>
            
            <!-- Trainer 5 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="David Wilson" class="w-full h-80 object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2">David Wilson</h3>
                    <p class="text-indigo-600 font-medium mb-4">Boxing & Combat Fitness</p>
                    <p class="text-gray-600 mb-4">Former professional boxer with 10+ years of coaching experience. Specializes in boxing technique, conditioning, and combat-inspired fitness training.</p>
                    <div class="flex space-x-3 mb-6">
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Boxing</span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Combat Fitness</span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Self-Defense</span>
                    </div>
                    <a href="#" class="block w-full py-3 text-center bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Book a Session</a>
                </div>
            </div>
            
            <!-- Trainer 6 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1620859478794-da776e5e9c0c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Lisa Thompson" class="w-full h-80 object-cover">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2">Lisa Thompson</h3>
                    <p class="text-indigo-600 font-medium mb-4">Senior Fitness Specialist</p>
                    <p class="text-gray-600 mb-4">Certified senior fitness specialist with expertise in modifying exercises for older adults. Focuses on improving mobility, balance, and strength for seniors.</p>
                    <div class="flex space-x-3 mb-6">
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Senior Fitness</span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Functional Movement</span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">Balance</span>
                    </div>
                    <a href="#" class="block w-full py-3 text-center bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Book a Session</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Certification Section -->
<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Our Certifications</h2>
            <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">All of our trainers are certified professionals with extensive experience and education</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 justify-items-center">
            <div class="bg-white p-6 rounded-lg shadow-md w-full text-center">
                <img src="https://via.placeholder.com/100" alt="NASM" class="mx-auto h-16 mb-4">
                <h3 class="font-medium">NASM</h3>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md w-full text-center">
                <img src="https://via.placeholder.com/100" alt="ACE" class="mx-auto h-16 mb-4">
                <h3 class="font-medium">ACE</h3>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md w-full text-center">
                <img src="https://via.placeholder.com/100" alt="ISSA" class="mx-auto h-16 mb-4">
                <h3 class="font-medium">ISSA</h3>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md w-full text-center">
                <img src="https://via.placeholder.com/100" alt="ACSM" class="mx-auto h-16 mb-4">
                <h3 class="font-medium">ACSM</h3>
            </div>
        </div>
    </div>
</section>

<!-- Become a Trainer Section -->
<section class="py-16 bg-indigo-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:flex lg:items-center lg:space-x-12">
            <div class="lg:w-1/2 mb-10 lg:mb-0">
                <h2 class="text-3xl font-bold mb-6">Join Our Team of Trainers</h2>
                <p class="mb-6">Are you a certified fitness professional looking to grow your career? FitTrack Gym is always looking for passionate trainers to join our team.</p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start">
                        <i class='bx bx-check-circle text-2xl mr-3'></i>
                        <span>Competitive compensation and flexible scheduling</span>
                    </li>
                    <li class="flex items-start">
                        <i class='bx bx-check-circle text-2xl mr-3'></i>
                        <span>Growing client base and marketing support</span>
                    </li>
                    <li class="flex items-start">
                        <i class='bx bx-check-circle text-2xl mr-3'></i>
                        <span>Continuing education and professional development</span>
                    </li>
                    <li class="flex items-start">
                        <i class='bx bx-check-circle text-2xl mr-3'></i>
                        <span>State-of-the-art facilities and equipment</span>
                    </li>
                </ul>
                <a href="{{ route('contact') }}?subject=Trainer Application" class="inline-block px-6 py-3 bg-white text-indigo-600 rounded-md hover:bg-indigo-50">Apply Today</a>
            </div>
            <div class="lg:w-1/2">
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Trainer Team" class="rounded-lg shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-6 text-gray-900">Ready to Work with Our Trainers?</h2>
        <p class="text-lg text-gray-600 mb-8 max-w-3xl mx-auto">Book a session with one of our expert trainers and start your journey toward achieving your fitness goals.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="#" class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Book a Session</a>
            <a href="{{ route('contact') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Contact Us</a>
        </div>
    </div>
</section>
@endsection
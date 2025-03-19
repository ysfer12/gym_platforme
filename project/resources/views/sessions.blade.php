@extends('layouts.main')

@section('title', 'Fitness Sessions')

@section('content')
<!-- Hero Section -->
<div class="bg-indigo-600 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Fitness Sessions</h1>
        <p class="text-xl max-w-3xl mx-auto">Explore our diverse range of classes and training sessions led by expert instructors</p>
    </div>
</div>

<!-- Sessions Filter -->
<section class="py-10 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="w-full md:w-auto flex flex-wrap gap-2">
                <button class="px-4 py-2 bg-indigo-600 text-white rounded-md">All</button>
                <button class="px-4 py-2 bg-white hover:bg-gray-200 text-gray-800 rounded-md">Cardio</button>
                <button class="px-4 py-2 bg-white hover:bg-gray-200 text-gray-800 rounded-md">Strength</button>
                <button class="px-4 py-2 bg-white hover:bg-gray-200 text-gray-800 rounded-md">Yoga</button>
                <button class="px-4 py-2 bg-white hover:bg-gray-200 text-gray-800 rounded-md">HIIT</button>
                <button class="px-4 py-2 bg-white hover:bg-gray-200 text-gray-800 rounded-md">Cycling</button>
            </div>
            <div class="w-full md:w-auto mt-4 md:mt-0">
                <select class="px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option>All Levels</option>
                    <option>Beginner</option>
                    <option>Intermediate</option>
                    <option>Advanced</option>
                </select>
            </div>
        </div>
    </div>
</section>

<!-- Sessions Listings -->
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Session Card 1 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="HIIT Session" class="w-full h-56 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-sm font-medium">HIIT</span>
                        <span class="text-gray-500 text-sm">60 min</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">High Intensity Interval Training</h3>
                    <p class="text-gray-600 mb-4">A fast-paced workout that alternates between intense bursts of activity and fixed periods of less-intense activity or rest.</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="Trainer" class="w-10 h-10 rounded-full">
                            <span class="ml-2 text-gray-700">John Davis</span>
                        </div>
                        <span class="text-indigo-600 font-medium">Intermediate</span>
                    </div>
                    <div class="mt-6 flex justify-between items-center">
                        <div>
                            <div class="text-gray-700 font-medium">Mon, Wed, Fri</div>
                            <div class="text-gray-500 text-sm">6:00 PM - 7:00 PM</div>
                        </div>
                        <a href="#" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Book Now</a>
                    </div>
                </div>
            </div>
            
            <!-- Session Card 2 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Yoga Session" class="w-full h-56 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm font-medium">Yoga</span>
                        <span class="text-gray-500 text-sm">75 min</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Vinyasa Flow Yoga</h3>
                    <p class="text-gray-600 mb-4">A dynamic practice that connects breath with movement, flowing through poses to build strength, flexibility, and mindfulness.</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="Trainer" class="w-10 h-10 rounded-full">
                            <span class="ml-2 text-gray-700">Sarah Johnson</span>
                        </div>
                        <span class="text-indigo-600 font-medium">All Levels</span>
                    </div>
                    <div class="mt-6 flex justify-between items-center">
                        <div>
                            <div class="text-gray-700 font-medium">Tue, Thu, Sat</div>
                            <div class="text-gray-500 text-sm">9:00 AM - 10:15 AM</div>
                        </div>
                        <a href="#" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Book Now</a>
                    </div>
                </div>
            </div>
            
            <!-- Session Card 3 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1574680178050-55c6a6a96e0a?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Strength Training" class="w-full h-56 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm font-medium">Strength</span>
                        <span class="text-gray-500 text-sm">45 min</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Total Body Strength</h3>
                    <p class="text-gray-600 mb-4">A full-body workout focusing on building muscle strength and endurance using free weights, machines, and bodyweight exercises.</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="Trainer" class="w-10 h-10 rounded-full">
                            <span class="ml-2 text-gray-700">Mike Roberts</span>
                        </div>
                        <span class="text-indigo-600 font-medium">Intermediate</span>
                    </div>
                    <div class="mt-6 flex justify-between items-center">
                        <div>
                            <div class="text-gray-700 font-medium">Mon, Wed, Fri</div>
                            <div class="text-gray-500 text-sm">7:30 AM - 8:15 AM</div>
                        </div>
                        <a href="#" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Book Now</a>
                    </div>
                </div>
            </div>
            
            <!-- Session Card 4 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1558611848-73f7eb4001a1?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Cycling Session" class="w-full h-56 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded-full text-sm font-medium">Cycling</span>
                        <span class="text-gray-500 text-sm">45 min</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Indoor Cycling</h3>
                    <p class="text-gray-600 mb-4">A high-energy indoor cycling class with music that simulates outdoor riding with sprints, climbs, and intervals.</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="Trainer" class="w-10 h-10 rounded-full">
                            <span class="ml-2 text-gray-700">Alex Turner</span>
                        </div>
                        <span class="text-indigo-600 font-medium">All Levels</span>
                    </div>
                    <div class="mt-6 flex justify-between items-center">
                        <div>
                            <div class="text-gray-700 font-medium">Tue, Thu</div>
                            <div class="text-gray-500 text-sm">5:30 PM - 6:15 PM</div>
                        </div>
                        <a href="#" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Book Now</a>
                    </div>
                </div>
            </div>
            
            <!-- Session Card 5 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1571902943202-507ec2618e8f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Cardio Session" class="w-full h-56 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="px-3 py-1 bg-pink-100 text-pink-600 rounded-full text-sm font-medium">Cardio</span>
                        <span class="text-gray-500 text-sm">60 min</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Cardio Blast</h3>
                    <p class="text-gray-600 mb-4">A high-energy cardio workout combining different exercises to improve cardiovascular fitness and burn calories.</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1499952127939-9bbf5af6c51c?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="Trainer" class="w-10 h-10 rounded-full">
                            <span class="ml-2 text-gray-700">Jennifer Adams</span>
                        </div>
                        <span class="text-indigo-600 font-medium">Beginner</span>
                    </div>
                    <div class="mt-6 flex justify-between items-center">
                        <div>
                            <div class="text-gray-700 font-medium">Wed, Fri</div>
                            <div class="text-gray-500 text-sm">6:30 PM - 7:30 PM</div>
                        </div>
                        <a href="#" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Book Now</a>
                    </div>
                </div>
            </div>
            
            <!-- Session Card 6 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://images.unsplash.com/photo-1517836757821-5dbeb75a2e54?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Boxing Session" class="w-full h-56 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm font-medium">Boxing</span>
                        <span class="text-gray-500 text-sm">60 min</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Boxing Fundamentals</h3>
                    <p class="text-gray-600 mb-4">Learn boxing techniques and combinations while improving strength, agility, and cardiovascular fitness.</p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1566492031773-4f4e44671857?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&q=80" alt="Trainer" class="w-10 h-10 rounded-full">
                            <span class="ml-2 text-gray-700">Daniel Thompson</span>
                        </div>
                        <span class="text-indigo-600 font-medium">All Levels</span>
                    </div>
                    <div class="mt-6 flex justify-between items-center">
                        <div>
                            <div class="text-gray-700 font-medium">Mon, Thu</div>
                            <div class="text-gray-500 text-sm">7:00 PM - 8:00 PM</div>
                        </div>
                        <a href="#" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            <nav class="flex items-center space-x-2">
                <a href="#" class="px-3 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Previous</a>
                <a href="#" class="px-3 py-2 bg-indigo-600 text-white rounded-md">1</a>
                <a href="#" class="px-3 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">2</a>
                <a href="#" class="px-3 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">3</a>
                <span class="px-3 py-2 text-gray-500">...</span>
                <a href="#" class="px-3 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">8</a>
                <a href="#" class="px-3 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Next</a>
            </nav>
        </div>
    </div>
</section>

<!-- Personal Training Section -->
<section class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:flex lg:items-center lg:space-x-12">
            <div class="lg:w-1/2 mb-10 lg:mb-0">
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Personal Training" class="rounded-lg shadow-lg">
            </div>
            <div class="lg:w-1/2">
                <h2 class="text-3xl font-bold mb-6 text-gray-900">Personal Training</h2>
                <p class="text-gray-600 mb-6">Take your fitness journey to the next level with personalized one-on-one training sessions tailored to your specific goals, fitness level, and schedule.</p>
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start">
                        <i class='bx bx-check-circle text-indigo-600 text-2xl mr-3'></i>
                        <span class="text-gray-700">Customized workout programs designed specifically for you</span>
                    </li>
                    <li class="flex items-start">
                        <i class='bx bx-check-circle text-indigo-600 text-2xl mr-3'></i>
                        <span class="text-gray-700">Expert guidance on proper form and technique</span>
                    </li>
                    <li class="flex items-start">
                        <i class='bx bx-check-circle text-indigo-600 text-2xl mr-3'></i>
                        <span class="text-gray-700">Accountability and motivation to help you stay consistent</span>
                    </li>
                    <li class="flex items-start">
                        <i class='bx bx-check-circle text-indigo-600 text-2xl mr-3'></i>
                        <span class="text-gray-700">Nutritional guidance and lifestyle advice</span>
                    </li>
                </ul>
                <a href="#" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Schedule a Session</a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-indigo-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="lg:w-0 lg:flex-1">
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Ready to Join a Session?</h2>
                <p class="mt-4 text-lg text-indigo-100 max-w-3xl">Sign up for a membership today and get access to all our fitness sessions and classes.</p>
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
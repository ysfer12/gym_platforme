@extends('layouts.main')

@section('title', 'Contact Us')

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
        
        /* Contact Page Specific Styles */
        .contact-hero {
            background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1594882645126-14020914d58d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1485&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .contact-form {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .contact-form-input {
            width: 100%;
            padding: 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 16px;
            transition: all 0.3s ease;
        }
        
        .contact-form-input:focus {
            border-color: #ff5e14;
            box-shadow: 0 0 0 3px rgba(255, 94, 20, 0.1);
            outline: none;
        }
        
        .contact-form-textarea {
            width: 100%;
            padding: 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 16px;
            transition: all 0.3s ease;
            min-height: 150px;
            resize: vertical;
        }
        
        .contact-form-textarea:focus {
            border-color: #ff5e14;
            box-shadow: 0 0 0 3px rgba(255, 94, 20, 0.1);
            outline: none;
        }
        
        .contact-form-submit {
            background: linear-gradient(to right, #ff5e14, #ff8c00);
            color: white;
            border: none;
            padding: 14px 30px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .contact-form-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 94, 20, 0.3);
        }
        
        .contact-info-card {
            padding: 24px;
            border-radius: 16px;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: 100%;
            transition: all 0.3s ease;
        }
        
        .contact-info-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .contact-info-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: linear-gradient(135deg, #ff5e14, #ff8c00);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: white;
            font-size: 24px;
            transition: all 0.3s ease;
        }
        
        .contact-info-card:hover .contact-info-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        .map-container {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: 450px;
        }
        
        .faq-card {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .faq-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }
        
        .faq-question {
            padding: 20px;
            background: white;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .faq-question:hover {
            background: #f8fafc;
        }
        
        .faq-answer {
            padding: 0 20px;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
            background: #f8fafc;
        }
        
        .faq-answer.active {
            padding: 20px;
            max-height: 1000px;
        }
        
        .faq-icon {
            transition: all 0.3s ease;
        }
        
        .faq-icon.active {
            transform: rotate(180deg);
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <div class="contact-hero py-40 relative">
        <div class="container mx-auto px-4 text-center text-white">
            <h1 class="text-5xl md:text-6xl font-bold mb-6">Contact <span class="text-orange-500">Us</span></h1>
            <p class="text-xl max-w-3xl mx-auto">Have questions or need more information? We're here to help. Get in touch with our team and we'll respond as soon as possible.</p>
        </div>
    </div>
    
    <!-- Contact Information Section -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">GET IN TOUCH</span>
                <h2 class="text-4xl font-bold mb-4">We'd Love To <span class="gradient-text">Hear From You</span></h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Whether you have a question about memberships, classes, or anything else, our team is ready to answer all your questions.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Contact Card 1: Location -->
                <div class="contact-info-card reveal">
                    <div class="contact-info-icon">
                        <i class="bx bx-map"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Our Location</h3>
                    <p class="text-gray-600 mb-4">Visit us at our state-of-the-art fitness facility</p>
                    <p class="text-gray-800">123 Fitness Avenue,<br>Gym City, 10001</p>
                </div>
                
                <!-- Contact Card 2: Email -->
                <div class="contact-info-card reveal" style="transition-delay: 0.2s;">
                    <div class="contact-info-icon">
                        <i class="bx bx-envelope"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Email Us</h3>
                    <p class="text-gray-600 mb-4">Send us an email and we'll get back to you</p>
                    <a href="mailto:info@traintogether.com" class="text-orange-500 hover:text-orange-600 transition-colors font-medium">info@traintogether.com</a>
                </div>
                
                <!-- Contact Card 3: Phone -->
                <div class="contact-info-card reveal" style="transition-delay: 0.4s;">
                    <div class="contact-info-icon">
                        <i class="bx bx-phone"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Call Us</h3>
                    <p class="text-gray-600 mb-4">Speak directly with our friendly team</p>
                    <a href="tel:+11234567890" class="text-orange-500 hover:text-orange-600 transition-colors font-medium">(123) 456-7890</a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Contact Form & Map Section -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="contact-form bg-white p-8 md:p-12 reveal">
                    <h3 class="text-3xl font-bold mb-6">Send us a <span class="gradient-text">Message</span></h3>
                    <p class="text-gray-600 mb-8">
                        Fill out the form below, and we'll be in touch as soon as possible. We value your feedback and inquiries.
                    </p>
                    
                    <form action="#" method="POST">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="name" class="block text-gray-700 font-medium mb-2">Your Name</label>
                                <input type="text" id="name" name="name" placeholder="John Doe" class="contact-form-input" required>
                            </div>
                            <div>
                                <label for="email" class="block text-gray-700 font-medium mb-2">Your Email</label>
                                <input type="email" id="email" name="email" placeholder="johndoe@example.com" class="contact-form-input" required>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
                            <input type="text" id="subject" name="subject" placeholder="How can we help you?" class="contact-form-input" required>
                        </div>
                        
                        <div class="mb-6">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Your Message</label>
                            <textarea id="message" name="message" placeholder="Write your message here..." class="contact-form-textarea" required></textarea>
                        </div>
                        
                        <div class="text-center md:text-left">
                            <button type="submit" class="contact-form-submit">
                                <div class="flex items-center">
                                    <span>Send Message</span>
                                    <i class='bx bx-send ml-2'></i>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Map -->
                <div class="map-container reveal" style="transition-delay: 0.3s;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215266254887!2d-73.9878589!3d40.7484405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1625160989327!5m2!1sen!2sus" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Operating Hours Section -->
    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">HOURS & INFORMATION</span>
                <h2 class="text-4xl font-bold mb-4">When to <span class="gradient-text">Find Us</span></h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Our gym is open 7 days a week to accommodate your busy schedule. Check our hours below.
                </p>
            </div>
            
            <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden reveal">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-8 md:p-12">
                        <h3 class="text-2xl font-bold mb-6">Operating Hours</h3>
                        <ul class="space-y-4">
                            <li class="flex justify-between items-center pb-3 border-b border-gray-100">
                                <span class="font-medium">Monday - Friday</span>
                                <span class="text-orange-500 font-semibold">6:00 AM - 10:00 PM</span>
                            </li>
                            <li class="flex justify-between items-center pb-3 border-b border-gray-100">
                                <span class="font-medium">Saturday</span>
                                <span class="text-orange-500 font-semibold">7:00 AM - 9:00 PM</span>
                            </li>
                            <li class="flex justify-between items-center pb-3 border-b border-gray-100">
                                <span class="font-medium">Sunday</span>
                                <span class="text-orange-500 font-semibold">8:00 AM - 8:00 PM</span>
                            </li>
                            <li class="flex justify-between items-center">
                                <span class="font-medium">Public Holidays</span>
                                <span class="text-orange-500 font-semibold">8:00 AM - 8:00 PM</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white p-8 md:p-12">
                        <h3 class="text-2xl font-bold mb-6">Contact Information</h3>
                        <ul class="space-y-6">
                            <li class="flex items-start">
                                <i class='bx bx-map-pin text-2xl mr-4 mt-1'></i>
                                <span>123 Fitness Avenue,<br>Gym City, 10001</span>
                            </li>
                            <li class="flex items-center">
                                <i class='bx bx-phone text-2xl mr-4'></i>
                                <span>(123) 456-7890</span>
                            </li>
                            <li class="flex items-center">
                                <i class='bx bx-envelope text-2xl mr-4'></i>
                                <span>info@traintogether.com</span>
                            </li>
                            <li class="flex items-center">
                                <i class='bx bx-globe text-2xl mr-4'></i>
                                <span>www.traintogether.com</span>
                            </li>
                        </ul>
                        
                        <div class="mt-8 flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-orange-500 transition-all duration-300">
                                <i class='bx bxl-facebook'></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-orange-500 transition-all duration-300">
                                <i class='bx bxl-instagram'></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-orange-500 transition-all duration-300">
                                <i class='bx bxl-twitter'></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white hover:text-orange-500 transition-all duration-300">
                                <i class='bx bxl-youtube'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- FAQ Section -->
    <section class="py-24 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-semibold mb-3">FREQUENTLY ASKED QUESTIONS</span>
                <h2 class="text-4xl font-bold mb-4">Got <span class="gradient-text">Questions?</span></h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-600">
                    Find answers to commonly asked questions about our gym, memberships, and services.
                </p>
            </div>
            
            <div class="max-w-4xl mx-auto space-y-6">
                <!-- FAQ Item 1 -->
                <div class="faq-card reveal">
                    <div class="faq-question" data-faq="1">
                        <span>How do I sign up for a membership?</span>
                        <i class='bx bx-chevron-down text-xl text-orange-500 faq-icon'></i>
                    </div>
                    <div class="faq-answer" id="faq-1">
                        <p class="text-gray-600">
                            Signing up for a membership is easy! You can sign up online through our website, visit us in person at any of our locations, or give us a call. We offer different membership tiers to fit your needs and budget. All new members receive a complimentary fitness assessment with one of our trainers.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 2 -->
                <div class="faq-card reveal" style="transition-delay: 0.1s;">
                    <div class="faq-question" data-faq="2">
                        <span>Can I try before I buy?</span>
                        <i class='bx bx-chevron-down text-xl text-orange-500 faq-icon'></i>
                    </div>
                    <div class="faq-answer" id="faq-2">
                        <p class="text-gray-600">
                            Absolutely! We offer a free 1-day pass for new visitors. This gives you access to our facilities, including group classes (subject to availability). It's a great way to experience what TrainTogether has to offer before committing to a membership. Simply contact us to arrange your visit.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 3 -->
                <div class="faq-card reveal" style="transition-delay: 0.2s;">
                    <div class="faq-question" data-faq="3">
                        <span>What amenities are included with membership?</span>
                        <i class='bx bx-chevron-down text-xl text-orange-500 faq-icon'></i>
                    </div>
                    <div class="faq-answer" id="faq-3">
                        <p class="text-gray-600">
                            Our memberships include access to all workout areas, locker rooms with showers, and free Wi-Fi. Depending on your membership tier, you may also receive perks such as unlimited group classes, personal training sessions, access to premium amenities like saunas and hot tubs, and nutritional consultations. Check our membership page for detailed information.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 4 -->
                <div class="faq-card reveal" style="transition-delay: 0.3s;">
                    <div class="faq-question" data-faq="4">
                        <span>How do I book a class?</span>
                        <i class='bx bx-chevron-down text-xl text-orange-500 faq-icon'></i>
                    </div>
                    <div class="faq-answer" id="faq-4">
                        <p class="text-gray-600">
                            Classes can be booked through our mobile app, website, or in person at the reception desk. We recommend booking classes in advance as they can fill up quickly. If you're unable to attend a booked class, please cancel at least 2 hours before the start time to avoid a no-show fee and to allow others to take your spot.
                        </p>
                    </div>
                </div>
                
                <!-- FAQ Item 5 -->
                <div class="faq-card reveal" style="transition-delay: 0.4s;">
                    <div class="faq-question" data-faq="5">
                        <span>Can I freeze my membership temporarily?</span>
                        <i class='bx bx-chevron-down text-xl text-orange-500 faq-icon'></i>
                    </div>
                    <div class="faq-answer" id="faq-5">
                        <p class="text-gray-600">
                            Yes, we understand that life happens! Members can freeze their membership for up to 3 months per year. There may be a small monthly maintenance fee during the freeze period. To freeze your membership, please contact our customer service team or visit the front desk at your location.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="py-16">
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
                            <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-orange-600 font-bold rounded-full hover:shadow-xl transition-all duration-300">
                                JOIN NOW
                            </a>
                            <a href="{{ route('subscriptions') }}" class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-orange-600 transition-all duration-300">
                                VIEW MEMBERSHIPS
                            </a>
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        <img src="https://images.unsplash.com/photo-1549476464-37392f717541?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1374&q=80"
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
            
            // FAQ toggle
            const faqQuestions = document.querySelectorAll('.faq-question');
            
            faqQuestions.forEach(question => {
                question.addEventListener('click', () => {
                    const faqId = question.getAttribute('data-faq');
                    const answer = document.getElementById('faq-' + faqId);
                    const icon = question.querySelector('.faq-icon');
                    
                    // Toggle active class for the answer
                    answer.classList.toggle('active');
                    
                    // Toggle active class for the icon
                    icon.classList.toggle('active');
                });
            });
        });
    </script>
@endsection
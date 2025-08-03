<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AI Job Analyst') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                overflow-x: hidden;
            }
            .bg-gradient {
                background: linear-gradient(135deg, #2563EB 0%, #3B82F6 50%, #60A5FA 100%);
                position: relative;
                overflow: hidden;
            }
            .bg-gradient::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
                opacity: 0.3;
            }
            .floating-shapes {
                position: absolute;
                width: 100%;
                height: 100%;
                overflow: hidden;
                z-index: 0;
            }
            .shape {
                position: absolute;
                background-color: rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                animation: float 15s infinite ease-in-out;
            }
            .shape:nth-child(1) {
                width: 100px;
                height: 100px;
                top: 20%;
                left: 10%;
                animation-delay: 0s;
            }
            .shape:nth-child(2) {
                width: 150px;
                height: 150px;
                top: 60%;
                left: 70%;
                animation-delay: 2s;
            }
            .shape:nth-child(3) {
                width: 70px;
                height: 70px;
                top: 40%;
                left: 40%;
                animation-delay: 4s;
            }
            .shape:nth-child(4) {
                width: 120px;
                height: 120px;
                top: 70%;
                left: 20%;
                animation-delay: 6s;
            }
            @keyframes float {
                0% { transform: translateY(0) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(5deg); }
                100% { transform: translateY(0) rotate(0deg); }
            }
            .card {
                backdrop-filter: blur(16px);
                background-color: rgba(255, 255, 255, 0.9);
                border-radius: 16px;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                border: 1px solid rgba(255, 255, 255, 0.5);
                transition: all 0.5s ease;
                transform-style: preserve-3d;
                perspective: 1000px;
            }
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            .card-front, .card-back {
                backface-visibility: hidden;
                transition: transform 0.8s ease;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border-radius: 16px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 2rem;
            }
            .card-back {
                transform: rotateY(180deg);
            }
            .card.flipped .card-front {
                transform: rotateY(180deg);
            }
            .card.flipped .card-back {
                transform: rotateY(0);
            }
            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0.75rem 1.5rem;
                font-weight: 600;
                border-radius: 0.5rem;
                transition: all 0.3s ease;
                cursor: pointer;
            }
            .btn-primary {
                background-color: #2563EB;
                color: white;
                box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2), 0 2px 4px -1px rgba(37, 99, 235, 0.1);
            }
            .btn-primary:hover {
                background-color: #1D4ED8;
                transform: translateY(-2px);
                box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2), 0 4px 6px -2px rgba(37, 99, 235, 0.1);
            }
            .btn-secondary {
                background-color: white;
                color: #2563EB;
                border: 2px solid #2563EB;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }
            .btn-secondary:hover {
                background-color: #f8fafc;
                transform: translateY(-2px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }
            .btn-icon {
                margin-left: 0.5rem;
            }
            .feature-icon {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 3rem;
                height: 3rem;
                border-radius: 0.5rem;
                background-color: rgba(37, 99, 235, 0.1);
                color: #2563EB;
                margin-bottom: 1rem;
            }
            .feature {
                transition: all 0.3s ease;
            }
            .feature:hover {
                transform: translateY(-5px);
            }
            .animate-fade-in {
                animation: fadeIn 0.5s ease-in-out;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-bounce {
                animation: bounce 2s infinite;
            }
            @keyframes bounce {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen bg-gradient relative flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8">
            <!-- Floating shapes for background animation -->
            <div class="floating-shapes">
                <div class="shape"></div>
                <div class="shape"></div>
                <div class="shape"></div>
                <div class="shape"></div>
            </div>
            
            <div class="mb-8 z-10 text-center">
                <div class="flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white animate-bounce" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 005 10a6 6 0 0012 0c0-.35-.035-.69-.1-1.02A5 5 0 0010 11z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2 drop-shadow-lg">AI Job Analyst</h1>
                <p class="text-xl text-white opacity-90 max-w-md mx-auto">Your intelligent career companion for job analysis and optimization</p>
            </div>

            <div class="w-full max-w-md z-10 relative" style="height: 400px;">
                <div id="auth-card" class="card w-full h-full relative">
                    <!-- Front side (Login) -->
                    <div class="card-front p-8 text-center">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Welcome to AI Job Analyst</h2>
                        <p class="text-gray-600 mb-8">Sign in to your account to continue your career journey</p>
                        
                        <div class="space-y-4">
                            <a href="{{ route('login') }}" class="btn btn-primary w-full">
                                Sign In
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 btn-icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500">Or</span>
                                </div>
                            </div>
                            
                            <button id="flip-to-register" class="btn btn-secondary w-full">
                                Create New Account
                            </button>
                        </div>
                    </div>
                    
                    <!-- Back side (Register) -->
                    <div class="card-back p-8 text-center">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Join AI Job Analyst</h2>
                        <p class="text-gray-600 mb-8">Create an account to start your career optimization journey</p>
                        
                        <div class="space-y-4">
                            <a href="{{ route('register') }}" class="btn btn-primary w-full">
                                Create Account
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 btn-icon" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500">Or</span>
                                </div>
                            </div>
                            
                            <button id="flip-to-login" class="btn btn-secondary w-full">
                                Sign In Instead
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Features section -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto z-10">
                <div class="feature bg-white bg-opacity-90 p-6 rounded-xl shadow-md text-center animate-fade-in" style="animation-delay: 0.1s">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Resume Analysis</h3>
                    <p class="text-gray-600">Get detailed insights and improvement suggestions for your resume</p>
                </div>
                
                <div class="feature bg-white bg-opacity-90 p-6 rounded-xl shadow-md text-center animate-fade-in" style="animation-delay: 0.3s">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Job Matching</h3>
                    <p class="text-gray-600">Find the perfect job opportunities that match your skills and experience</p>
                </div>
                
                <div class="feature bg-white bg-opacity-90 p-6 rounded-xl shadow-md text-center animate-fade-in" style="animation-delay: 0.5s">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Career Growth</h3>
                    <p class="text-gray-600">Get personalized recommendations to advance your career path</p>
                </div>
            </div>
            
            <div class="mt-12 text-center text-white text-sm opacity-80 z-10">
                <p>© {{ date('Y') }} AI Job Analyst. All rights reserved.</p>
            </div>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const card = document.getElementById('auth-card');
                const flipToRegister = document.getElementById('flip-to-register');
                const flipToLogin = document.getElementById('flip-to-login');
                
                flipToRegister.addEventListener('click', function() {
                    card.classList.add('flipped');
                });
                
                flipToLogin.addEventListener('click', function() {
                    card.classList.remove('flipped');
                });
                
                // Add entrance animations
                const features = document.querySelectorAll('.feature');
                features.forEach((feature, index) => {
                    setTimeout(() => {
                        feature.classList.add('animate-fade-in');
                    }, index * 200);
                });
            });
        </script>
    </body>
</html>

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
            .login-container {
                backdrop-filter: blur(16px);
                background-color: rgba(255, 255, 255, 0.9);
                border-radius: 16px;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                border: 1px solid rgba(255, 255, 255, 0.5);
                transition: all 0.3s ease;
            }
            .login-container:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
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
            .auth-tabs {
                display: flex;
                background-color: rgba(255, 255, 255, 0.2);
                border-radius: 12px;
                padding: 4px;
                margin-bottom: 20px;
                position: relative;
                overflow: hidden;
            }
            .auth-tab {
                flex: 1;
                text-align: center;
                padding: 12px;
                color: white;
                font-weight: 500;
                position: relative;
                z-index: 1;
                transition: all 0.3s ease;
                border-radius: 8px;
            }
            .auth-tab.active {
                color: #2563EB;
                font-weight: 600;
            }
            .tab-indicator {
                position: absolute;
                height: calc(100% - 8px);
                top: 4px;
                left: 4px;
                width: calc(50% - 4px);
                background-color: white;
                border-radius: 8px;
                transition: all 0.3s ease;
                z-index: 0;
            }
            .tab-indicator.register {
                left: calc(50% + 0px);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient relative">
            <!-- Floating shapes for background animation -->
            <div class="floating-shapes">
                <div class="shape"></div>
                <div class="shape"></div>
                <div class="shape"></div>
                <div class="shape"></div>
            </div>
            
            <div class="mb-4 z-10">
                <a href="/" class="flex items-center justify-center">
                    <x-application-logo class="w-20 h-20" />
                    <span class="ml-3 text-3xl font-bold text-white">AI Job Analyst</span>
                </a>
            </div>

            <div class="w-full sm:max-w-lg mt-2 px-10 py-10 login-container shadow-xl overflow-hidden sm:rounded-2xl z-10">
                <!-- Auth tabs for login/register -->
                @if(request()->routeIs('login') || request()->routeIs('register'))
                <div class="auth-tabs">
                    <div class="tab-indicator {{ request()->routeIs('register') ? 'register' : '' }}"></div>
                    <a href="{{ route('login') }}" class="auth-tab {{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
                    <a href="{{ route('register') }}" class="auth-tab {{ request()->routeIs('register') ? 'active' : '' }}">Register</a>
                </div>
                @endif
                
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-white text-sm opacity-80 z-10">
                <p>© {{ date('Y') }} AI Job Analyst. All rights reserved.</p>
            </div>
        </div>
    </body>
</html>

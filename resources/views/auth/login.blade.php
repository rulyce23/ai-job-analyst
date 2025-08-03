<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome Back!</h1>
        <p class="text-gray-600">Sign in to continue your career journey</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="relative mb-6">
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium mb-2 text-base" />
            <div class="flex items-center relative group">
                <x-text-input id="email" class="" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="your@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="relative mb-6">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium mb-2 text-base" />
            <div class="flex items-center relative group">
                <x-text-input id="password" class=""
                                type="password"
                                name="password"
                                required autocomplete="current-password"
                                placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mb-8 mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded-md border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 w-5 h-5" name="remember">
                <span class="ms-3 text-base text-gray-600">{{ __('Remember me') }}</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-base text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="mb-6">
            <x-primary-button>
                <span class="flex items-center justify-center">
                    {{ __('Sign In') }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </span>
            </x-primary-button>
        </div>
        
        <div class="text-center">
            <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300">Create Account</a></p>
        </div>
    </form>
</x-guest-layout>

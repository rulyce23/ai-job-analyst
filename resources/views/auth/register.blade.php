<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Create Account</h1>
        <p class="text-gray-600">Join us to start your career journey</p>
    </div>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="relative mb-6">
            <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 font-medium mb-2 text-base" />
            <div class="flex items-center relative group">
                <x-text-input id="name" class="" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="relative mb-6">
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium mb-2 text-base" />
            <div class="flex items-center relative group">
                <x-text-input id="email" class="" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="your@email.com" />
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
                                required autocomplete="new-password"
                                placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="relative mb-8">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium mb-2 text-base" />
            <div class="flex items-center relative group">
                <x-text-input id="password_confirmation" class=""
                                type="password"
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mb-6">
            <x-primary-button>
                <span class="flex items-center justify-center">
                    {{ __('Create Account') }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </span>
            </x-primary-button>
        </div>
        
        <div class="text-center">
            <p class="text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300">Sign In</a></p>
        </div>
    </form>
</x-guest-layout>

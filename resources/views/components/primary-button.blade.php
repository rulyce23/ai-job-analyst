<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center w-full px-8 py-4 bg-blue-600 border border-transparent rounded-xl font-semibold text-base text-white tracking-wide hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transform hover:scale-105 transition-all ease-in-out duration-300 shadow-lg hover:shadow-xl']) }}>
    {{ $slot }}
</button>

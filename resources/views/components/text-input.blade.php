@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-xl shadow-sm w-full px-5 py-4 text-base bg-white/80 backdrop-blur-sm transition-all duration-300 focus:bg-white focus:shadow-md mb-1']) }}>

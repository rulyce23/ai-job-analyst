<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            AI Job Analyst - Hasil Analisis
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-green-500 to-blue-600 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-2xl font-bold mb-2">Analisis Selesai!</h3>
                            <p class="text-green-100">AI telah menganalisis profil Anda dan menemukan {{ $recommendations->count() }} pekerjaan yang sesuai.</p>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold">{{ $recommendations->count() }}</div>
                            <div class="text-sm text-green-100">Rekomendasi Pekerjaan</div>
                        </div>
                    </div>
                </div>
            </div>

            @if($recommendations->count() > 0)
                <!-- Recommendations List -->
                <div class="space-y-6">
                    @foreach($recommendations as $recommendation)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 
                                {{ $recommendation->match_score >= 80 ? 'border-green-500' : 
                                   ($recommendation->match_score >= 60 ? 'border-yellow-500' : 'border-gray-300') }}">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h3 class="text-xl font-bold text-gray-900">{{ $recommendation->jobRole->title }}</h3>
                                        <div class="flex items-center space-x-2">
                                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                                {{ $recommendation->match_score >= 80 ? 'bg-green-100 text-green-800' : 
                                                   ($recommendation->match_score >= 60 ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                {{ number_format($recommendation->match_score, 1) }}% Match
                                            </span>
                                            @if($recommendation->jobRole->work_type)
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                                {{ ucfirst($recommendation->jobRole->work_type) }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center space-x-4 text-sm text-gray-600 mb-3">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-2m-2 0h2m-2 0h-2m2 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v12m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v12"></path>
                                            </svg>
                                            {{ $recommendation->jobRole->category }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                            </svg>
                                            {{ $recommendation->jobRole->level }}
                                        </span>
                                        @if($recommendation->jobRole->min_experience_years > 0)
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Min. {{ $recommendation->jobRole->min_experience_years }} tahun pengalaman
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="flex flex-col items-end space-y-2">
                                    <button onclick="toggleSaveJob({{ $recommendation->id }})" 
                                            class="save-btn-{{ $recommendation->id }} flex items-center space-x-1 px-3 py-1 rounded-md text-sm
                                                   {{ $recommendation->is_saved ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-600 hover:bg-yellow-100 hover:text-yellow-800' }} 
                                                   transition duration-200">
                                        <svg class="w-4 h-4" fill="{{ $recommendation->is_saved ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                        </svg>
                                        <span>{{ $recommendation->is_saved ? 'Tersimpan' : 'Simpan' }}</span>
                                    </button>
                                    
                                    @if($recommendation->jobRole->min_salary && $recommendation->jobRole->max_salary)
                                    <div class="text-right text-sm">
                                        <div class="font-semibold text-gray-900">
                                            Rp {{ number_format($recommendation->jobRole->min_salary, 0, ',', '.') }} - 
                                            Rp {{ number_format($recommendation->jobRole->max_salary, 0, ',', '.') }}
                                        </div>
                                        <div class="text-gray-500">per bulan</div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Job Description -->
                            <div class="mb-4">
                                <p class="text-gray-700">{{ $recommendation->jobRole->description }}</p>
                            </div>

                            <!-- AI Recommendation Reason -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                <div class="flex items-start space-x-2">
                                    <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                    <div>
                                        <h4 class="font-semibold text-blue-900 mb-1">Analisis AI</h4>
                                        <p class="text-blue-800 text-sm">{{ $recommendation->recommendation_reason }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Skills Match -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if(!empty($recommendation->matching_skills))
                                <div>
                                    <h4 class="font-semibold text-green-800 mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Keahlian yang Sesuai
                                    </h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($recommendation->matching_skills as $skill)
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                @if(!empty($recommendation->missing_skills))
                                <div>
                                    <h4 class="font-semibold text-orange-800 mb-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                        Keahlian yang Perlu Dikembangkan
                                    </h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($recommendation->missing_skills as $skill)
                                        <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Job Requirements -->
                            @if($recommendation->jobRole->requirements)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <h4 class="font-semibold text-gray-900 mb-2">Persyaratan</h4>
                                <div class="text-sm text-gray-700">
                                    {!! nl2br(e($recommendation->jobRole->requirements)) !!}
                                </div>
                            </div>
                            @endif

                            <!-- Responsibilities -->
                            @if($recommendation->jobRole->responsibilities)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <h4 class="font-semibold text-gray-900 mb-2">Tanggung Jawab</h4>
                                <div class="text-sm text-gray-700">
                                    {!! nl2br(e($recommendation->jobRole->responsibilities)) !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Action Buttons -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                    <div class="p-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Langkah Selanjutnya</h3>
                                <p class="text-gray-600">Tingkatkan peluang Anda dengan mengembangkan keahlian yang dibutuhkan.</p>
                            </div>
                            <div class="flex space-x-4">
                                <a href="{{ route('job-analysis.index') }}" 
                                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">
                                    Analisis Ulang
                                </a>
                                <a href="{{ route('profile.skills') }}" 
                                   class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                                    Update Keahlian
                                </a>
                                <a href="{{ route('dashboard') }}" 
                                   class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200">
                                    Kembali ke Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- No Results -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.29-1.009-5.824-2.562M15 6.306a7.962 7.962 0 00-6 0m6 0V5a2 2 0 00-2-2H9a2 2 0 00-2 2v1.306m8 0V7a2 2 0 012 2v6.414l-1.293-1.293a1 1 0 00-1.414 0L12 17.414l-2.293-2.293a1 1 0 00-1.414 0L7 16.414V9a2 2 0 012-2h8a2 2 0 012 2v7.414z"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Rekomendasi</h3>
                        <p class="text-gray-600 mb-6">Maaf, saat ini tidak ada pekerjaan yang sesuai dengan profil Anda. Coba perbarui keahlian atau preferensi Anda.</p>
                        <div class="flex justify-center space-x-4">
                            <a href="{{ route('job-analysis.index') }}" 
                               class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                                Coba Lagi
                            </a>
                            <a href="{{ route('profile.complete') }}" 
                               class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">
                                Update Profil
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        function toggleSaveJob(recommendationId) {
            fetch(`/dashboard/save-job/${recommendationId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const btn = document.querySelector(`.save-btn-${recommendationId}`);
                    const svg = btn.querySelector('svg');
                    const span = btn.querySelector('span');
                    
                    if (data.is_saved) {
                        btn.classList.remove('bg-gray-100', 'text-gray-600');
                        btn.classList.add('bg-yellow-100', 'text-yellow-800');
                        svg.setAttribute('fill', 'currentColor');
                        span.textContent = 'Tersimpan';
                    } else {
                        btn.classList.remove('bg-yellow-100', 'text-yellow-800');
                        btn.classList.add('bg-gray-100', 'text-gray-600');
                        svg.setAttribute('fill', 'none');
                        span.textContent = 'Simpan';
                    }
                    
                    // Show toast notification
                    showToast(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
            toast.textContent = message;
            document.body.appendChild(toast);
            
            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 100);
            
            // Animate out and remove
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        }
    </script>
</x-app-layout>
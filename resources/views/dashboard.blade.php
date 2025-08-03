<!-- Kilo AI -->
@php
use Illuminate\Support\Facades\Auth;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            AI Job Analyst - Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">Selamat datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-blue-100">Temukan pekerjaan yang sesuai dengan keahlian dan minat Anda menggunakan AI Job Analyst.</p>
                    <div class="mt-4">
                        <a href="{{ route('job-analysis.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white dark:bg-blue-500 dark:hover:bg-blue-600 px-4 py-2 rounded-md font-medium">
              Mulai Analisis Pekerjaan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Rekomendasi</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_recommendations'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Match Tinggi (80%+)</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $stats['high_match_jobs'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Pekerjaan Disimpan</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $stats['saved_jobs'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Keahlian Anda</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $stats['user_skills_count'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Completion -->
            @if($profileCompletion < 100)
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">Lengkapi Profil Anda</h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <p>Profil Anda {{ $profileCompletion }}% lengkap. Lengkapi profil untuk mendapatkan rekomendasi pekerjaan yang lebih akurat.</p>
                            <div class="mt-2">
                                <div class="bg-yellow-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $profileCompletion }}%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('profile.complete') }}" class="text-sm bg-yellow-100 text-yellow-800 px-3 py-1 rounded-md hover:bg-yellow-200 transition duration-200">
                                Lengkapi Profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Job Recommendations -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Rekomendasi Pekerjaan Terbaru</h3>
                                <a href="{{ route('job-analysis.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Lihat Semua
                                </a>
                            </div>
                            
                            @if($recommendations->count() > 0)
                                <div class="space-y-4">
                                    @foreach($recommendations as $recommendation)
                                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <h4 class="text-lg font-semibold text-gray-900">{{ $recommendation->jobRole->title }}</h4>
                                                <p class="text-sm text-gray-600 mb-2">{{ $recommendation->jobRole->category }} • {{ $recommendation->jobRole->level }} • {{ $recommendation->jobRole->company_name ?? 'Perusahaan Tidak Diketahui' }}</p>
                                                <div class="flex items-center mb-2">
                                                    <div class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                                        {{ number_format($recommendation->match_score, 1) }}% Match
                                                    </div>
                                                    @if($recommendation->jobRole->work_type)
                                                    <span class="ml-2 bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                                        {{ ucfirst($recommendation->jobRole->work_type) }}
                                                    </span>
                                                    @endif
                                                </div>
                                                <p class="text-sm text-gray-700">{{ $recommendation->recommendation_reason }}</p>
                                            </div>
                                            <div class="ml-4 flex flex-col space-y-2">
                                                <button onclick="toggleSaveJob({{ $recommendation->id }})"
                                                        class="save-btn-{{ $recommendation->id }} text-gray-400 hover:text-yellow-500 transition duration-200">
                                                    <svg class="w-5 h-5 {{ $recommendation->is_saved ? 'text-yellow-500 fill-current' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m-8 0V6a2 2 0 00-2 2v6"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada rekomendasi</h3>
                                    <p class="mt-1 text-sm text-gray-500">Mulai analisis pekerjaan untuk mendapatkan rekomendasi yang sesuai.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('job-analysis.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white dark:bg-blue-500 dark:hover:bg-blue-600 px-4 py-2 rounded-md font-medium">
           Mulai Analisis
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Trending Categories -->
                <div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Kategori Pekerjaan Trending</h3>
                            <div class="space-y-3">
                                @foreach($trendingCategories as $category)
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-900">{{ $category->category }}</span>
                                    <span class="text-sm text-gray-500">{{ $category->job_count }} posisi</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                            <div class="space-y-3">
                                <a href="{{ route('job-analysis.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition duration-200">
                                    🔍 Analisis Pekerjaan Baru
                                </a>
                                <a href="{{ route('profile.complete') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition duration-200">
                                    👤 Perbarui Profil
                                </a>
                                <a href="{{ route('profile.skills') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition duration-200">
                                    ⭐ Kelola Keahlian
                                </a>
                                @if(Auth::user()->email === 'admin@example.com' || Auth::user()->name === 'admin')
                                <a href="{{ route('candidates.create') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition duration-200">
                                    ➕ Tambah Kandidat
                                </a>
                                @endif
                                <a href="{{ route('decisions.index') }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md transition duration-200">
                                    📋 Kelola Kandidat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Candidate Decision Making Section -->
            @if(isset($pendingCandidates) && $pendingCandidates->count() > 0)
            <div class="mt-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Kandidat Menunggu Keputusan</h3>
                            <div class="flex space-x-3">
                                @if(Auth::user()->email === 'admin@example.com' || Auth::user()->name === 'admin')
                                <a href="{{ route('candidates.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                                    Tambah Kandidat
                                </a>
                                @endif
                                <a href="{{ route('decisions.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Lihat Semua
                                </a>
                            </div>
                        </div>
                        
                        <!-- Candidate Statistics -->
                        @if(isset($candidateStats))
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <div class="bg-blue-50 p-3 rounded-lg">
                                <p class="text-sm text-blue-600 font-medium">Total Kandidat</p>
                                <p class="text-xl font-bold text-blue-900">{{ $candidateStats['total_candidates'] }}</p>
                            </div>
                            <div class="bg-yellow-50 p-3 rounded-lg">
                                <p class="text-sm text-yellow-600 font-medium">Menunggu</p>
                                <p class="text-xl font-bold text-yellow-900">{{ $candidateStats['pending_candidates'] }}</p>
                            </div>
                            <div class="bg-green-50 p-3 rounded-lg">
                                <p class="text-sm text-green-600 font-medium">Disetujui</p>
                                <p class="text-xl font-bold text-green-900">{{ $candidateStats['approved_candidates'] }}</p>
                            </div>
                            <div class="bg-red-50 p-3 rounded-lg">
                                <p class="text-sm text-red-600 font-medium">Ditolak</p>
                                <p class="text-xl font-bold text-red-900">{{ $candidateStats['rejected_candidates'] }}</p>
                            </div>
                        </div>
                        @endif
                        
                        <div class="space-y-4">
                            @foreach($pendingCandidates as $candidate)
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="text-lg font-semibold text-gray-900">{{ $candidate->name }}</h4>
                                        <p class="text-sm text-gray-600 mb-2">{{ $candidate->email }} • {{ $candidate->phone }}</p>
                                        <div class="flex items-center mb-2">
                                            @if($candidate->category)
                                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium mr-2">
                                                {{ $candidate->category->name }}
                                            </span>
                                            @endif
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs mr-2">
                                                {{ $candidate->years_of_experience }} tahun pengalaman
                                            </span>
                                            @if($candidate->user)
                                            <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full text-xs">
                                                Oleh: {{ $candidate->user->name }}
                                            </span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-700">{{ Str::limit($candidate->reason, 100) }}</p>
                                        <p class="text-xs text-gray-500 mt-1">Dibuat: {{ $candidate->created_at->diffForHumans() }}</p>
                                    </div>
                            <div class="ml-4 flex flex-col space-y-2">
                                <button onclick="showCandidateModal({{ $candidate->id }})"
                                        class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600 transition duration-200">
                                    Detail
                                </button>
                                @if((auth()->user()->email === 'admin123@example.com' || auth()->user()->name === 'Admin') && auth()->user()->company_name === $candidate->company_name)
                                <button onclick="quickDecision({{ $candidate->id }}, 'approved')"
                                        class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600 transition duration-200">
                                    Setuju
                                </button>
                                <button onclick="quickDecision({{ $candidate->id }}, 'rejected')"
                                        class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600 transition duration-200">
                                    Tolak
                                </button>
                                @endif
                            </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Candidate Detail Modal -->
    <div id="candidateModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-screen overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Detail Kandidat</h3>
                        <button onclick="closeCandidateModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div id="candidateDetails">
                        <!-- Candidate details will be loaded here -->
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button onclick="closeCandidateModal()" class="px-4 py-2 text-gray-600 border border-gray-300 rounded hover:bg-gray-50">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
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
                    const btn = document.querySelector(`.save-btn-${recommendationId} svg`);
                    if (data.is_saved) {
                        btn.classList.add('text-yellow-500', 'fill-current');
                    } else {
                        btn.classList.remove('text-yellow-500', 'fill-current');
                    }
                    
                    // Show toast notification
                    showToast(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function showToast(message) {
            // Simple toast notification
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
            toast.textContent = message;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
        
        // Candidate decision making functions
        let currentCandidateId = null;
        
        function showCandidateModal(candidateId) {
            currentCandidateId = candidateId;
            fetch(`/decisions/candidate/${candidateId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.candidate) {
                        const candidate = data.candidate;
                        document.getElementById('candidateDetails').innerHTML = `
                            <div class="space-y-4">
                                <div>
                                    <h4 class="font-semibold text-gray-900">${candidate.name}</h4>
                                    <p class="text-gray-600">${candidate.email}</p>
                                </div>
                        
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Pengalaman</label>
                                    <p class="text-gray-900">${candidate.years_of_experience} tahun</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Pendidikan</label>
                                    <p class="text-gray-900"> ${candidate.education_level || 'Tidak disebutkan'} - ${candidate.field_of_study || 'Tidak disebutkan'}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Gaji yang Diharapkan</label>
                                    <p class="text-gray-900">Rp ${candidate.expected_salary || 'Tidak disebutkan'}</p>
                                </div>
                                <!-- Informasi User -->
                                ${candidate.user ? `
                                <div class="border-t border-gray-200 pt-4 mt-4">
                                    <h4 class="font-semibold text-gray-900 mb-3 text-lg">Informasi User</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="bg-gray-50 p-3 rounded-lg">
                                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Nama User</label>
                                            <p class="text-gray-900 font-medium">${candidate.user.name}</p>
                                        </div>
                                        <div class="bg-gray-50 p-3 rounded-lg">
                                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Email User</label>
                                            <p class="text-gray-900 font-medium">${candidate.user.email}</p>
                                        </div>
                                        ${candidate.user.profile ? `
                                        <div class="bg-gray-50 p-3 rounded-lg">
                                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Telepon</label>
                                            <p class="text-gray-900">•${candidate.phone || 'Tidak disebutkan'}</p>
                                        </div>
                                        <div class="bg-gray-50 p-3 rounded-lg">
                                            <label class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Pengalaman</label>
                                            <p class="text-gray-900">${candidate.user.profile.years_of_experience || 0} tahun</p>
                                        </div>
                                        ` : ''}
                                    </div>
                                </div>
                                ` : ''}
                            </div>
                        `;
                        document.getElementById('candidateModal').classList.remove('hidden');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
        
        function closeCandidateModal() {
            document.getElementById('candidateModal').classList.add('hidden');
            currentCandidateId = null;
        }
        
        function quickDecision(candidateId, decision) {
            if (confirm(`Apakah Anda yakin ingin ${decision === 'approved' ? 'menyetujui' : 'menolak'} kandidat ini?`)) {
                makeDecisionRequest(candidateId, decision);
            }
        }
        
        function makeDecision(decision) {
            if (currentCandidateId) {
                makeDecisionRequest(currentCandidateId, decision);
                closeCandidateModal();
            }
        }
        
        function makeDecisionRequest(candidateId, decision) {
            fetch('/decisions/decide', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    candidate_id: candidateId,
                    decision: decision,
                    notes: `Keputusan dibuat dari dashboard pada ${new Date().toLocaleString()}`
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message);
                    // Reload the page to update the candidate list
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</x-app-layout>

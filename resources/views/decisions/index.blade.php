@php
use Illuminate\Support\Facades\Auth;
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                Kelola Kandidat - Pengambilan Keputusan
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Total Kandidat</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-amber-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Menunggu Keputusan</p>
                                <p class="text-3xl font-bold text-amber-600">{{ $stats['pending'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Disetujui</p>
                                <p class="text-3xl font-bold text-emerald-600">{{ $stats['approved'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide">Ditolak</p>
                                <p class="text-3xl font-bold text-red-600">{{ $stats['rejected'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100 mb-8">
                <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Filter Kandidat</h3>
                        </div>
                    <form method="GET" action="{{ route('decisions.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-2">
                            <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">🔍 Cari Kandidat</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                   placeholder="Nama atau email kandidat..."
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-900 placeholder-gray-500">
                        </div>
                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">📂 Kategori</label>
                            <select name="category_id" id="category_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-900">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }} ({{ $category->candidates_count }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">📊 Status</label>
                            <select name="status" id="status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-900">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Menunggu</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>✅ Disetujui</option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>❌ Ditolak</option>
                            </select>
                        </div>
                        <div class="md:col-span-4 flex justify-end">
                            <button type="submit" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                <span>Terapkan Filter</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Candidates List -->
            <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-100">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Daftar Kandidat</h3>
                        </div>
                        @if($candidates->where('status', 'pending')->count() > 0)
                        <div class="flex space-x-3">
                            <!-- <button onclick="bulkDecision('approved')" class="bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Setujui Terpilih</span>
                            </button>
                            <button onclick="bulkDecision('rejected')" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span>Tolak Terpilih</span>
                            </button> -->
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="p-6">
                    @if($candidates->count() > 0)
                        <div class="space-y-6">
                            @foreach($candidates as $candidate)
                            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 hover:shadow-lg hover:bg-white transition-all duration-300">
                                <div class="flex justify-between items-start">
                                    <div class="flex items-start space-x-4">
                                        @if($candidate->status === 'pending')
                                        <input type="checkbox" name="candidate_ids[]" value="{{ $candidate->id }}"
                                               class="mt-2 h-5 w-5 rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        @endif
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-3 mb-3">
                                                <h4 class="text-xl font-bold text-gray-900">{{ $candidate->name }}</h4>
                                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                                    @if($candidate->status === 'pending') bg-amber-100 text-amber-800 border border-amber-200
                                                    @elseif($candidate->status === 'approved') bg-emerald-100 text-emerald-800 border border-emerald-200
                                                    @else bg-red-100 text-red-800 border border-red-200 @endif">
                                                    @if($candidate->status === 'pending') ⏳ Menunggu
                                                    @elseif($candidate->status === 'approved') ✅ Disetujui
                                                    @else ❌ Ditolak @endif
                                                </span>
                                            </div>
                                            <div class="flex items-center space-x-4 mb-3 text-sm text-gray-600">
                                                <span class="flex items-center space-x-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <span>{{ $candidate->email }}</span>
                                                </span>
                                                <span class="flex items-center space-x-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                                    </svg>
                                                    <span>{{ $candidate->phone }}</span>
                                                </span>
                                            </div>
                                            <div class="flex flex-wrap gap-2 mb-4">
                                                @if($candidate->category)
                                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold border border-blue-200">
                                                    💼 {{ $candidate->category->name }}
                                                </span>
                                                @endif
                                                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-semibold border border-purple-200">
                                                    🎯 {{ $candidate->years_of_experience }} tahun pengalaman
                                                </span>
                                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold border border-green-200">
                                                    💰 Rp {{ number_format($candidate->expected_salary, 0, ',', '.') }}
                                                </span>
                                                @if($candidate->user)
                                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold border border-indigo-200">
                                                    👥 Ditambahkan oleh: {{ $candidate->user->name }}
                                                </span>
                                                @endif
                                            </div>
                                            <p class="text-gray-700 mb-4 leading-relaxed">{{ Str::limit($candidate->reason, 200) }}</p>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                                <div class="flex items-center space-x-2 text-gray-600">
                                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                    </svg>
                                                    <span><strong>Pendidikan:</strong> {{ $candidate->education_level }} {{ $candidate->field_of_study }}</span>
                                                </div>
                                                <div class="flex items-center space-x-2 text-gray-600">
                                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    <span><strong>Lokasi:</strong> {{ $candidate->preferred_location }}</span>
                                                </div>
                                                <div class="flex items-center space-x-2 text-gray-600">
                                                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m-8 0V6a2 2 0 00-2 2v6"></path>
                                                    </svg>
                                                    <span><strong>Tipe:</strong> {{ ucfirst($candidate->work_type_preference) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-6 flex flex-col space-y-3">
                                        <button onclick="showCandidateModal({{ $candidate->id }})"
                                                class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            <span>Detail</span>
                                        </button>
                                        @if($candidate->status === 'pending' && (auth()->user()->email === 'admin123@example.com' || auth()->user()->name === 'Admin') && auth()->user()->company_name === $candidate->company_name)
                                        <button onclick="quickDecision({{ $candidate->id }}, 'approved')"
                                                class="bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>Setuju</span>
                                        </button>
                                        <button onclick="quickDecision({{ $candidate->id }}, 'rejected')"
                                                class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            <span>Tolak</span>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        @if($candidates->hasPages())
                        <div class="mt-8 flex justify-center">
                            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-4">
                                {{ $candidates->links() }}
                            </div>
                        </div>
                        @endif
                    @else
                        <div class="text-center py-16">
                            <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak ada kandidat ditemukan</h3>
                            <p class="text-gray-500 mb-6">Belum ada kandidat yang sesuai dengan filter yang dipilih.</p>
                            <a href="{{ route('decisions.index') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                                Lihat Semua Kandidat
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Candidate Detail Modal -->
    <div id="candidateModal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-10 mx-auto p-6 border w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 shadow-2xl rounded-2xl bg-white max-h-screen overflow-y-auto">
            <div class="sticky top-0 bg-white pb-4 border-b border-gray-200 mb-6">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900" id="modalTitle">Detail Kandidat</h3>
                    </div>
                    <button onclick="closeCandidateModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-all duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div id="candidateDetails" class="space-y-6">
                <!-- Content will be loaded here -->
                <div class="flex items-center justify-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500"></div>
                </div>
            </div>
            <div class="sticky bottom-0 bg-white pt-4 border-t border-gray-200 mt-6">
                <div class="flex justify-end space-x-3">
                    <button onclick="closeCandidateModal()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 px-6 rounded-lg transition-all duration-300">
                        Tutup
                    </button>
                    <button id="approveBtn" onclick="makeDecision('approved')" class="bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 hidden flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Setujui</span>
                    </button>
                    <button id="rejectBtn" onclick="makeDecision('rejected')" class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 hidden flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span>Tolak</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentCandidateId = null;
        
        function showCandidateModal(candidateId) {
            currentCandidateId = candidateId;
            
            // Show modal with loading state
            const modal = document.getElementById('candidateModal');
            modal.classList.remove('hidden');
            
            // Reset modal content to loading state
            document.getElementById('candidateDetails').innerHTML = `
                <div class="flex items-center justify-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500"></div>
                </div>
            `;
            
            fetch(`/decisions/candidate/${candidateId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.candidate) {
                        const candidate = data.candidate;
                        document.getElementById('modalTitle').textContent = `Detail Kandidat - ${candidate.name}`;
                        document.getElementById('candidateDetails').innerHTML = `
                            <div class="space-y-8">
                                <!-- Personal Information -->
                                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-6 border border-blue-100">
                                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span>Informasi Personal</span>
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">👤 Nama Lengkap</label>
                                            <p class="text-gray-900 font-medium">${candidate.name}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">📧 Email</label>
                                            <p class="text-gray-900">${candidate.email}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">📱 Telepon</label>
                                            <p class="text-gray-900">${candidate.phone}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">📊 Status</label>
                                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                                ${candidate.status === 'pending' ? 'bg-amber-100 text-amber-800 border border-amber-200' :
                                                  candidate.status === 'approved' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 'bg-red-100 text-red-800 border border-red-200'}">
                                                ${candidate.status === 'pending' ? '⏳ Menunggu' : candidate.status === 'approved' ? '✅ Disetujui' : '❌ Ditolak'}
                                            </span>
                                        </div>
                                        ${candidate.user ? `
                                        <div class="col-span-2">
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">👥 Ditambahkan Oleh</label>
                                            <p class="text-gray-900">${candidate.user.name} (${candidate.user.email})</p>
                                        </div>
                                        ` : ''}
                                    </div>
                                </div>

                                <!-- Professional Information -->
                                <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-6 border border-green-100">
                                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m-8 0V6a2 2 0 00-2 2v6"></path>
                                        </svg>
                                        <span>Informasi Profesional</span>
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">💼 Kategori</label>
                                            <p class="text-gray-900">${candidate.category ? candidate.category.name : 'Tidak ada kategori'}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">🎯 Pengalaman</label>
                                            <p class="text-gray-900">${candidate.years_of_experience} tahun</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">🎓 Pendidikan</label>
                                            <p class="text-gray-900">${candidate.education_level || 'Tidak disebutkan'} ${candidate.field_of_study || ''}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">💰 Gaji Diharapkan</label>
                                            <p class="text-gray-900 font-semibold">Rp ${candidate.expected_salary ? new Intl.NumberFormat('id-ID').format(candidate.expected_salary) : '0'}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">📍 Lokasi Preferensi</label>
                                            <p class="text-gray-900">${candidate.preferred_location || 'Fleksibel'}</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">🏢 Tipe Kerja</label>
                                            <p class="text-gray-900">${candidate.work_type_preference || 'Hybrid'}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Application Details -->
                                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-100">
                                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <span>Detail Lamaran</span>
                                    </h4>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">📝 Alasan Melamar</label>
                                        <div class="bg-white rounded-lg p-4 border border-gray-200">
                                            <p class="text-gray-900 leading-relaxed">${candidate.reason || 'Tidak ada alasan yang diberikan'}</p>
                                        </div>
                                    </div>
                                    ${candidate.skills && candidate.skills.length > 0 ? `
                                        <div class="mt-6">
                                            <label class="block text-sm font-semibold text-gray-700 mb-3">🛠️ Keahlian</label>
                                            <div class="flex flex-wrap gap-2">
                                                ${candidate.skills.map(skill => `<span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium border border-blue-200">${skill}</span>`).join('')}
                                            </div>
                                        </div>
                                    ` : ''}
                                </div>
                            </div>
                        `;
                        
                        // Show decision buttons only for pending candidates
                        if (candidate.status === 'pending') {
                            document.getElementById('approveBtn').classList.remove('hidden');
                            document.getElementById('rejectBtn').classList.remove('hidden');
                        } else {
                            document.getElementById('approveBtn').classList.add('hidden');
                            document.getElementById('rejectBtn').classList.add('hidden');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('candidateDetails').innerHTML = `
                        <div class="text-center py-12">
                            <div class="w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Terjadi Kesalahan</h3>
                            <p class="text-gray-500">Tidak dapat memuat data kandidat. Silakan coba lagi.</p>
                        </div>
                    `;
                });
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
                    notes: `Keputusan dibuat pada ${new Date().toLocaleString()}`
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
        
        function bulkDecision(decision) {
            const selectedCandidates = document.querySelectorAll('input[name="candidate_ids[]"]:checked');
            if (selectedCandidates.length === 0) {
                alert('Pilih kandidat terlebih dahulu');
                return;
            }
            
            const candidateIds = Array.from(selectedCandidates).map(cb => cb.value);
            
            if (confirm(`Apakah Anda yakin ingin ${decision === 'approved' ? 'menyetujui' : 'menolak'} ${candidateIds.length} kandidat?`)) {
                fetch('/decisions/bulk-decide', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        candidate_ids: candidateIds,
                        decision: decision,
                        notes: `Keputusan bulk dibuat pada ${new Date().toLocaleString()}`
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message);
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
        
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-emerald-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
            const icon = type === 'success' ?
                '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' :
                type === 'error' ?
                '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>' :
                '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
            
            toast.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-4 rounded-lg shadow-2xl z-50 flex items-center space-x-3 transform transition-all duration-300 translate-x-full`;
            toast.innerHTML = `
                ${icon}
                <span class="font-medium">${message}</span>
                <button onclick="this.parentElement.remove()" class="ml-2 text-white hover:text-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            
            document.body.appendChild(toast);
            
            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 100);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.remove();
                    }
                }, 300);
            }, 5000);
        }

        // Close modal when clicking outside
        document.getElementById('candidateModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCandidateModal();
            }
        });

        // Add keyboard support for modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('candidateModal').classList.contains('hidden')) {
                closeCandidateModal();
            }
        });

        // Add loading states for buttons
        function setButtonLoading(button, loading = true) {
            if (loading) {
                button.disabled = true;
                const originalContent = button.innerHTML;
                button.setAttribute('data-original-content', originalContent);
                button.innerHTML = `
                    <div class="flex items-center space-x-2">
                        <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></div>
                        <span>Memproses...</span>
                    </div>
                `;
            } else {
                button.disabled = false;
                const originalContent = button.getAttribute('data-original-content');
                if (originalContent) {
                    button.innerHTML = originalContent;
                }
            }
        }

        // Add smooth scrolling for better UX
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add auto-refresh functionality (optional)
        let autoRefreshInterval;
        function startAutoRefresh() {
            autoRefreshInterval = setInterval(() => {
                // Only refresh if no modal is open
                if (document.getElementById('candidateModal').classList.contains('hidden')) {
                    window.location.reload();
                }
            }, 300000); // Refresh every 5 minutes
        }

        function stopAutoRefresh() {
            if (autoRefreshInterval) {
                clearInterval(autoRefreshInterval);
            }
        }

        // Start auto-refresh when page loads
        // startAutoRefresh(); // Uncomment if you want auto-refresh

        // Add visual feedback for form submissions
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const submitButton = form.querySelector('button[type="submit"]');
                    if (submitButton) {
                        setButtonLoading(submitButton, true);
                    }
                });
            });
        });
    </script>
</x-app-layout>
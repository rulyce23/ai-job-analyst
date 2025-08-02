// IBM Granite AI + Kilo Ai
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Keahlian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('profile.skills.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Keahlian Anda</h3>
                            <p class="text-sm text-gray-600 mb-4">Pilih keahlian yang Anda miliki untuk mendapatkan rekomendasi pekerjaan yang lebih tepat.</p>
                            
                            @error('skills')
                                <p class="mt-1 text-sm text-red-600 mb-4">{{ $message }}</p>
                            @enderror

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-h-96 overflow-y-auto border border-gray-200 rounded-lg p-4">
                                @php $currentCategory = null; @endphp
                                
                                @foreach($skills as $skill)
                                    @if($currentCategory !== $skill->category)
                                        @if($currentCategory !== null)
                                            </div>
                                        @endif
                                        @php $currentCategory = $skill->category; @endphp
                                        <div class="col-span-full">
                                            <h5 class="font-semibold text-gray-800 text-sm uppercase tracking-wide border-b border-gray-200 pb-1 mb-2">
                                                {{ $skill->category ?? 'Lainnya' }}
                                            </h5>
                                        </div>
                                        <div class="col-span-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                                    @endif
                                    
                                    <div class="p-2 rounded hover:bg-gray-50">
                                        <label class="flex items-center space-x-2">
                                            <input type="checkbox" name="skills[]" value="{{ $skill->id }}" 
                                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                                {{ $userSkills->contains('id', $skill->id) ? 'checked' : '' }}>
                                            <span class="text-sm text-gray-700">{{ $skill->name }}</span>
                                            @if($skill->demand_level >= 4)
                                                <span class="text-xs bg-red-100 text-red-800 px-1 rounded">High Demand</span>
                                            @endif
                                        </label>
                                        
                                        @if($userSkills->contains('id', $skill->id))
                                            <div class="mt-2 pl-6">
                                                <div class="mb-2">
                                                    <label class="block text-xs text-gray-600 mb-1">Tingkat Keahlian</label>
                                                    <select name="proficiency[{{ $skill->id }}]" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                                        <option value="1" {{ $userSkills->firstWhere('id', $skill->id)->pivot->proficiency_level == 1 ? 'selected' : '' }}>Pemula</option>
                                                        <option value="2" {{ $userSkills->firstWhere('id', $skill->id)->pivot->proficiency_level == 2 ? 'selected' : '' }}>Menengah</option>
                                                        <option value="3" {{ $userSkills->firstWhere('id', $skill->id)->pivot->proficiency_level == 3 ? 'selected' : '' }}>Mahir</option>
                                                        <option value="4" {{ $userSkills->firstWhere('id', $skill->id)->pivot->proficiency_level == 4 ? 'selected' : '' }}>Ahli</option>
                                                        <option value="5" {{ $userSkills->firstWhere('id', $skill->id)->pivot->proficiency_level == 5 ? 'selected' : '' }}>Pakar</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="mb-2">
                                                    <label class="block text-xs text-gray-600 mb-1">Pengalaman (tahun)</label>
                                                    <input type="number" name="years[{{ $skill->id }}]" min="0" max="20" 
                                                        value="{{ $userSkills->firstWhere('id', $skill->id)->pivot->years_of_experience }}" 
                                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                                </div>
                                                
                                                <div>
                                                    <label class="flex items-center space-x-2">
                                                        <input type="checkbox" name="certified[{{ $skill->id }}]" value="1" 
                                                            {{ $userSkills->firstWhere('id', $skill->id)->pivot->is_certified ? 'checked' : '' }}
                                                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                                        <span class="text-xs text-gray-600">Tersertifikasi</span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                                
                                @if($currentCategory !== null)
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('dashboard') }}" 
                               class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                                Simpan Keahlian
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            AI Job Analyst - Analisis Pekerjaan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Temukan Pekerjaan yang Tepat untuk Anda</h3>
                        <p class="text-gray-600">Sistem AI kami akan menganalisis keahlian dan preferensi Anda untuk memberikan rekomendasi pekerjaan yang paling sesuai.</p>
                    </div>

                    <form action="{{ route('job-analysis.analyze') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Skills Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Pilih Keahlian Anda <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-h-96 overflow-y-auto border border-gray-200 rounded-lg p-4">
                                @php $currentCategory = null; @endphp
                                @foreach($skills as $skill)
                                    @if($currentCategory !== $skill->category)
                                        @if($currentCategory !== null)
                                            </div>
                                        @endif
                                        @php $currentCategory = $skill->category; @endphp
                                        <div class="col-span-full">
                                            <h4 class="font-semibold text-gray-800 text-sm uppercase tracking-wide border-b border-gray-200 pb-1 mb-2">
                                                {{ $skill->category ?? 'Lainnya' }}
                                            </h4>
                                        </div>
                                        <div class="col-span-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                                    @endif
                                    
                                    <label class="flex items-center space-x-2 p-2 rounded hover:bg-gray-50">
                                        <input type="checkbox" name="skills[]" value="{{ $skill->id }}" 
                                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                               {{ $userSkills->contains('id', $skill->id) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700">{{ $skill->name }}</span>
                                        @if($skill->demand_level >= 4)
                                            <span class="text-xs bg-red-100 text-red-800 px-1 rounded">High Demand</span>
                                        @endif
                                    </label>
                                @endforeach
                                @if($currentCategory !== null)
                                    </div>
                                @endif
                            </div>
                            @error('skills')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Experience Years -->
                        <div>
                            <label for="experience_years" class="block text-sm font-medium text-gray-700 mb-2">
                                Pengalaman Kerja (Tahun) <span class="text-red-500">*</span>
                            </label>
                            <select name="experience_years" id="experience_years" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Pilih pengalaman kerja</option>
                                <option value="0" {{ old('experience_years', $userProfile->years_of_experience ?? '') == '0' ? 'selected' : '' }}>Fresh Graduate (0 tahun)</option>
                                <option value="1" {{ old('experience_years', $userProfile->years_of_experience ?? '') == '1' ? 'selected' : '' }}>1 tahun</option>
                                <option value="2" {{ old('experience_years', $userProfile->years_of_experience ?? '') == '2' ? 'selected' : '' }}>2 tahun</option>
                                <option value="3" {{ old('experience_years', $userProfile->years_of_experience ?? '') == '3' ? 'selected' : '' }}>3 tahun</option>
                                <option value="4" {{ old('experience_years', $userProfile->years_of_experience ?? '') == '4' ? 'selected' : '' }}>4 tahun</option>
                                <option value="5" {{ old('experience_years', $userProfile->years_of_experience ?? '') == '5' ? 'selected' : '' }}>5 tahun</option>
                                <option value="6" {{ old('experience_years', $userProfile->years_of_experience ?? '') == '6' ? 'selected' : '' }}>6-10 tahun</option>
                                <option value="10" {{ old('experience_years', $userProfile->years_of_experience ?? '') == '10' ? 'selected' : '' }}>10+ tahun</option>
                            </select>
                            @error('experience_years')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preferred Salary -->
                        <div>
                            <label for="preferred_salary" class="block text-sm font-medium text-gray-700 mb-2">
                                Ekspektasi Gaji (Rp/bulan)
                            </label>
                            <input type="number" name="preferred_salary" id="preferred_salary" 
                                   value="{{ old('preferred_salary', $userProfile->expected_salary ?? '') }}"
                                   placeholder="Contoh: 5000000"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('preferred_salary')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Work Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                Preferensi Tipe Kerja <span class="text-red-500">*</span>
                            </label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <label class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="radio" name="work_type" value="remote" 
                                           {{ old('work_type', $userProfile->work_type_preference ?? 'hybrid') == 'remote' ? 'checked' : '' }}
                                           class="text-blue-600 focus:ring-blue-500">
                                    <div>
                                        <div class="font-medium text-gray-900">Remote</div>
                                        <div class="text-sm text-gray-500">Kerja dari rumah</div>
                                    </div>
                                </label>
                                <label class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="radio" name="work_type" value="onsite" 
                                           {{ old('work_type', $userProfile->work_type_preference ?? 'hybrid') == 'onsite' ? 'checked' : '' }}
                                           class="text-blue-600 focus:ring-blue-500">
                                    <div>
                                        <div class="font-medium text-gray-900">Onsite</div>
                                        <div class="text-sm text-gray-500">Kerja di kantor</div>
                                    </div>
                                </label>
                                <label class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                    <input type="radio" name="work_type" value="hybrid" 
                                           {{ old('work_type', $userProfile->work_type_preference ?? 'hybrid') == 'hybrid' ? 'checked' : '' }}
                                           class="text-blue-600 focus:ring-blue-500">
                                    <div>
                                        <div class="font-medium text-gray-900">Hybrid</div>
                                        <div class="text-sm text-gray-500">Kombinasi remote & onsite</div>
                                    </div>
                                </label>
                            </div>
                            @error('work_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                Lokasi Preferensi
                            </label>
                            <input type="text" name="location" id="location" 
                                   value="{{ old('location', $userProfile->preferred_location ?? '') }}"
                                   placeholder="Contoh: Jakarta, Bandung, Surabaya"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                             <!-- Full Name -->
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Anda  Note : Untuk Analisa JOB
                            </label>
                            <input type="text" name="full_name" id="full_name" 
                                   value="{{ old('full_name', $userProfile->full_name ?? '') }}"
                                   placeholder="Contoh: Ruly Rizki Perdana"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('full_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('dashboard') }}" 
                               class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                                <span>Analisis dengan AI</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add some interactivity for better UX
        document.addEventListener('DOMContentLoaded', function() {
            const skillCheckboxes = document.querySelectorAll('input[name="skills[]"]');
            const submitButton = document.querySelector('button[type="submit"]');
            
            function updateSubmitButton() {
                const checkedSkills = document.querySelectorAll('input[name="skills[]"]:checked');
                if (checkedSkills.length === 0) {
                    submitButton.disabled = true;
                    submitButton.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    submitButton.disabled = false;
                    submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }
            
            skillCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSubmitButton);
            });
            
            // Initial check
            updateSubmitButton();
        });
    </script>
</x-app-layout>
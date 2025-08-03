// Kilo Ai
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lengkapi Profil Anda
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Profil Lengkap untuk Rekomendasi Terbaik</h3>
                        <p class="text-gray-600">Lengkapi informasi profil Anda untuk mendapatkan rekomendasi pekerjaan yang lebih akurat dari AI Job Analyst.</p>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.complete.update') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Personal Information -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pribadi</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="full_name" id="full_name" required
                                           value="{{ old('full_name', $profile->full_name ?? '') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    @error('full_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nomor Telepon
                                    </label>
                                    <input type="text" name="phone" id="phone"
                                           value="{{ old('phone', $profile->phone ?? '') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tanggal Lahir
                                    </label>
                                    <input type="date" name="birth_date" id="birth_date"
                                           value="{{ old('birth_date', $profile->birth_date ?? '') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    @error('birth_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jenis Kelamin
                                    </label>
                                    <select name="gender" id="gender"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <option value="">Pilih jenis kelamin</option>
                                        <option value="male" {{ old('gender', $profile->gender ?? '') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="female" {{ old('gender', $profile->gender ?? '') == 'female' ? 'selected' : '' }}>Perempuan</option>
                                        <option value="other" {{ old('gender', $profile->gender ?? '') == 'other' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('gender')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                    Alamat
                                </label>
                                <textarea name="address" id="address" rows="3"
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('address', $profile->address ?? '') }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Education -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Pendidikan</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="education_level" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tingkat Pendidikan
                                    </label>
                                    <select name="education_level" id="education_level"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <option value="">Pilih tingkat pendidikan</option>
                                        <option value="SMA/SMK" {{ old('education_level', $profile->education_level ?? '') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                        <option value="D3" {{ old('education_level', $profile->education_level ?? '') == 'D3' ? 'selected' : '' }}>Diploma 3 (D3)</option>
                                        <option value="S1" {{ old('education_level', $profile->education_level ?? '') == 'S1' ? 'selected' : '' }}>Sarjana (S1)</option>
                                        <option value="S2" {{ old('education_level', $profile->education_level ?? '') == 'S2' ? 'selected' : '' }}>Magister (S2)</option>
                                        <option value="S3" {{ old('education_level', $profile->education_level ?? '') == 'S3' ? 'selected' : '' }}>Doktor (S3)</option>
                                    </select>
                                    @error('education_level')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="field_of_study" class="block text-sm font-medium text-gray-700 mb-2">
                                        Bidang Studi
                                    </label>
                                    <input type="text" name="field_of_study" id="field_of_study"
                                           value="{{ old('field_of_study', $profile->field_of_study ?? '') }}"
                                           placeholder="Contoh: Teknik Informatika, Manajemen"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    @error('field_of_study')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Work Experience -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Pengalaman Kerja</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="years_of_experience" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tahun Pengalaman <span class="text-red-500">*</span>
                                    </label>
                                    <select name="years_of_experience" id="years_of_experience" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <option value="">Pilih pengalaman kerja</option>
                                        <option value="0" {{ old('years_of_experience', $profile->years_of_experience ?? '') == '0' ? 'selected' : '' }}>Fresh Graduate (0 tahun)</option>
                                        <option value="1" {{ old('years_of_experience', $profile->years_of_experience ?? '') == '1' ? 'selected' : '' }}>1 tahun</option>
                                        <option value="2" {{ old('years_of_experience', $profile->years_of_experience ?? '') == '2' ? 'selected' : '' }}>2 tahun</option>
                                        <option value="3" {{ old('years_of_experience', $profile->years_of_experience ?? '') == '3' ? 'selected' : '' }}>3 tahun</option>
                                        <option value="4" {{ old('years_of_experience', $profile->years_of_experience ?? '') == '4' ? 'selected' : '' }}>4 tahun</option>
                                        <option value="5" {{ old('years_of_experience', $profile->years_of_experience ?? '') == '5' ? 'selected' : '' }}>5 tahun</option>
                                        <option value="6" {{ old('years_of_experience', $profile->years_of_experience ?? '') == '6' ? 'selected' : '' }}>6-10 tahun</option>
                                        <option value="10" {{ old('years_of_experience', $profile->years_of_experience ?? '') == '10' ? 'selected' : '' }}>10+ tahun</option>
                                    </select>
                                    @error('years_of_experience')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="expected_salary" class="block text-sm font-medium text-gray-700 mb-2">
                                        Ekspektasi Gaji (Rp/bulan)
                                    </label>
                                    <input type="number" name="expected_salary" id="expected_salary"
                                           value="{{ old('expected_salary', $profile->expected_salary ?? '') }}"
                                           placeholder="Contoh: 5000000"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    @error('expected_salary')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="work_experience" class="block text-sm font-medium text-gray-700 mb-2">
                                    Detail Pengalaman Kerja
                                </label>
                                <textarea name="work_experience" id="work_experience" rows="4"
                                          placeholder="Jelaskan pengalaman kerja Anda, posisi yang pernah dipegang, dan pencapaian yang diraih..."
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('work_experience', $profile->work_experience ?? '') }}</textarea>
                                @error('work_experience')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Career Preferences -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Preferensi Karir</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="preferred_location" class="block text-sm font-medium text-gray-700 mb-2">
                                        Lokasi Preferensi
                                    </label>
                                    <input type="text" name="preferred_location" id="preferred_location"
                                           value="{{ old('preferred_location', $profile->preferred_location ?? '') }}"
                                           placeholder="Contoh: Jakarta, Bandung, Surabaya"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    @error('preferred_location')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        Preferensi Tipe Kerja <span class="text-red-500">*</span>
                                    </label>
                                    <div class="space-y-2">
                                        <label class="flex items-center">
                                            <input type="radio" name="work_type_preference" value="remote" 
                                                   {{ old('work_type_preference', $profile->work_type_preference ?? 'hybrid') == 'remote' ? 'checked' : '' }}
                                                   class="text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2 text-sm text-gray-700">Remote (Kerja dari rumah)</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="work_type_preference" value="onsite" 
                                                   {{ old('work_type_preference', $profile->work_type_preference ?? 'hybrid') == 'onsite' ? 'checked' : '' }}
                                                   class="text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2 text-sm text-gray-700">Onsite (Kerja di kantor)</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" name="work_type_preference" value="hybrid" 
                                                   {{ old('work_type_preference', $profile->work_type_preference ?? 'hybrid') == 'hybrid' ? 'checked' : '' }}
                                                   class="text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2 text-sm text-gray-700">Hybrid (Kombinasi remote & onsite)</span>
                                        </label>
                                    </div>
                                    @error('work_type_preference')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="interests" class="block text-sm font-medium text-gray-700 mb-2">
                                    Minat dan Hobi
                                </label>
                                <textarea name="interests" id="interests" rows="3"
                                          placeholder="Ceritakan tentang minat, hobi, atau aktivitas yang Anda sukai..."
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('interests', $profile->interests ?? '') }}</textarea>
                                @error('interests')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label for="career_goals" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tujuan Karir
                                </label>
                                <textarea name="career_goals" id="career_goals" rows="3"
                                          placeholder="Jelaskan tujuan karir jangka pendek dan jangka panjang Anda..."
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('career_goals', $profile->career_goals ?? '') }}</textarea>
                                @error('career_goals')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Skills Selection -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Keahlian Anda</h4>
                            <p class="text-sm text-gray-600 mb-4">Pilih keahlian yang Anda miliki untuk mendapatkan rekomendasi pekerjaan yang lebih tepat.</p>
                            
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

                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('dashboard') }}" 
                               class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                                Simpan Profil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
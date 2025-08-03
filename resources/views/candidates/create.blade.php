<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Kandidat Baru') }}
            </h2>
            <a href="{{ route('decisions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
                    @if ($jobRecommendation)
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="text-lg font-medium text-blue-800 mb-2">Rekomendasi Pekerjaan</h3>
                                <p class="text-blue-700">
                                    Anda melamar untuk posisi <strong>{{ $jobRecommendation->jobRole->title }}</strong> 
                                    di perusahaan <strong>{{ $jobRecommendation->jobRole->company_name }}</strong>.
                                </p>
                                <input type="hidden" name="job_recommendation_id" value="{{ $jobRecommendation->id }}">
                                <input type="hidden" name="company_name" value="{{ $jobRecommendation->jobRole->company_name }}">
                            </div>
                        </div>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('candidates.store') }}" class="space-y-6">
                        @csrf
                        
                        @if ($jobRecommendation)
                        <input type="hidden" name="job_recommendation_id" value="{{ $jobRecommendation->id }}">
                        @endif

                        <div class="bg-blue-50 p-4 rounded-lg mb-6">
                            <h3 class="text-lg font-medium text-blue-800 mb-2">Informasi Dasar</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Kategori -->
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori Pekerjaan</label>
                                    @if ($jobRecommendation)
                                    <input type="hidden" name="category_id" id="category_id" value="{{ is_object($jobRecommendation->jobRole) ? $jobRecommendation->jobRole->id : '' }}">
                                    <input type="hidden" name="company_name" id="company_name" value="{{ is_object($jobRecommendation->jobRole) ? $jobRecommendation->jobRole->company_name : '' }}">
                                    
                                    <div class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 py-2 px-3">
                                        {{ is_object($jobRecommendation->jobRole) ? $jobRecommendation->jobRole->title : '' }}
                                    </div>
                                    @else
                                    <input type="hidden" name="category_id" id="category_id" value="">
                                    <div class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 py-2 px-3 text-gray-500">
                                        Kategori otomatis terisi saat melamar dari halaman rekomendasi pekerjaan.
                                    </div>
                                    @endif
                                    @error('category_id')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nama -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $jobRecommendation ? Auth::user()->name : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $jobRecommendation ? Auth::user()->email : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Telepon -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @error('phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="bg-green-50 p-4 rounded-lg mb-6">
                            <h3 class="text-lg font-medium text-green-800 mb-2">Informasi Personal</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Alamat -->
                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                    <textarea name="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('address') }}</textarea>
                                    @error('address')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Tanggal Lahir -->
                                <div>
                                    <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                    <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @error('birth_date')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Jenis Kelamin -->
                                <div>
                                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                    <select id="gender" name="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('gender')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-50 p-4 rounded-lg mb-6">
                            <h3 class="text-lg font-medium text-purple-800 mb-2">Pendidikan & Pengalaman</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Tingkat Pendidikan -->
                                <div>
                                    <label for="education_level" class="block text-sm font-medium text-gray-700 mb-1">Tingkat Pendidikan</label>
                                    <select id="education_level" name="education_level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="">Pilih Tingkat Pendidikan</option>
                                        <option value="SMA" {{ old('education_level') == 'SMA' ? 'selected' : '' }}>SMA/SMK</option>
                                        <option value="D3" {{ old('education_level') == 'D3' ? 'selected' : '' }}>Diploma (D3)</option>
                                        <option value="S1" {{ old('education_level') == 'S1' ? 'selected' : '' }}>Sarjana (S1)</option>
                                        <option value="S2" {{ old('education_level') == 'S2' ? 'selected' : '' }}>Magister (S2)</option>
                                        <option value="S3" {{ old('education_level') == 'S3' ? 'selected' : '' }}>Doktor (S3)</option>
                                    </select>
                                    @error('education_level')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Bidang Studi -->
                                <div>
                                    <label for="field_of_study" class="block text-sm font-medium text-gray-700 mb-1">Bidang Studi</label>
                                    <input type="text" name="field_of_study" id="field_of_study" value="{{ old('field_of_study') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @error('field_of_study')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Tahun Pengalaman -->
                                <div>
                                    <label for="years_of_experience" class="block text-sm font-medium text-gray-700 mb-1">Tahun Pengalaman</label>
                                    <input type="number" name="years_of_experience" id="years_of_experience" value="{{ old('years_of_experience') }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @error('years_of_experience')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Pengalaman Kerja -->
                                <div class="md:col-span-2">
                                    <label for="work_experience" class="block text-sm font-medium text-gray-700 mb-1">Pengalaman Kerja</label>
                                    <textarea name="work_experience" id="work_experience" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('work_experience') }}</textarea>
                                    @error('work_experience')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="bg-yellow-50 p-4 rounded-lg mb-6">
                            <h3 class="text-lg font-medium text-yellow-800 mb-2">Keahlian & Preferensi</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Keahlian -->
                                <div class="md:col-span-2">
                                    <label for="skills" class="block text-sm font-medium text-gray-700 mb-1">Keahlian (pisahkan dengan koma)</label>
                                    <input type="text" name="skills" id="skills" value="{{ is_array(old('skills')) ? implode(', ', old('skills')) : old('skills') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="HTML, CSS, JavaScript, PHP, Laravel">
                                    <p class="text-xs text-gray-500 mt-1">Masukkan keahlian dipisahkan dengan koma</p>
                                    @error('skills')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Gaji yang Diharapkan -->
                                <div>
                                    <label for="expected_salary" class="block text-sm font-medium text-gray-700 mb-1">Gaji yang Diharapkan (Rp)</label>
                                    <input type="number" name="expected_salary" id="expected_salary" value="{{ old('expected_salary') }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @error('expected_salary')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Lokasi yang Diinginkan -->
                                <div>
                                    <label for="preferred_location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi yang Diinginkan</label>
                                    <input type="text" name="preferred_location" id="preferred_location" value="{{ old('preferred_location') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @error('preferred_location')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Preferensi Tipe Pekerjaan -->
                                <div>
                                    <label for="work_type_preference" class="block text-sm font-medium text-gray-700 mb-1">Preferensi Tipe Pekerjaan</label>
                                    <select id="work_type_preference" name="work_type_preference" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <option value="">Pilih Tipe Pekerjaan</option>
                                        <option value="onsite" {{ old('work_type_preference') == 'onsite' ? 'selected' : '' }}>Onsite</option>
                                        <option value="remote" {{ old('work_type_preference') == 'remote' ? 'selected' : '' }}>Remote</option>
                                        <option value="hybrid" {{ old('work_type_preference') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    </select>
                                    @error('work_type_preference')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Alasan Melamar -->
                                <div class="md:col-span-2">
                                    <label for="reason" class="block text-sm font-medium text-gray-700 mb-1">Alasan Melamar</label>
                                    <textarea name="reason" id="reason" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('reason') }}</textarea>
                                    @error('reason')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200">
                                Tambah Kandidat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle skills input
            const skillsInput = document.getElementById('skills');
            
            skillsInput.addEventListener('blur', function() {
                const skills = this.value.split(',').map(skill => skill.trim()).filter(skill => skill !== '');
                this.value = skills.join(', ');
            });

            // Form submission
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Process skills into array
                const skillsValue = skillsInput.value;
                const skillsArray = skillsValue.split(',').map(skill => skill.trim()).filter(skill => skill !== '');
                
                // Remove existing skills hidden inputs
                document.querySelectorAll('input[name="skills[]"]').forEach(el => el.remove());
                
                // Add skills as hidden inputs
                skillsArray.forEach(skill => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'skills[]';
                    input.value = skill;
                    form.appendChild(input);
                });
                
                // Submit the form
                this.submit();
            });
        });
    </script>
</x-app-layout>

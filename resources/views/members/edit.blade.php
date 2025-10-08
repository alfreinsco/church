<x-layouts.app>
    <div class="min-h-screen bg-base-200">
        <!-- Header -->
        <div class="bg-primary text-primary-content">
            <div class="container mx-auto px-4 py-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold">Edit Data Jemaat</h1>
                        <p class="text-primary-content/80">Perbarui data {{ $member->name }}</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('members.show', $member->id) }}" class="btn btn-outline btn-primary-content">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Lihat Detail
                        </a>
                        <a href="{{ route('members.index') }}" class="btn btn-outline btn-primary-content">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <form action="{{ route('members.update', $member->id) }}" method="POST" enctype="multipart/form-data"
                class="max-w-4xl mx-auto">
                @csrf
                @method('PUT')

                <!-- Personal Information -->
                <div class="card bg-base-100 shadow-xl mb-6">
                    <div class="card-body">
                        <h2 class="card-title text-2xl mb-4">Informasi Pribadi</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Nama Lengkap *</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name', $member->name) }}"
                                    class="input input-bordered @error('name') input-error @enderror"
                                    placeholder="Masukkan nama lengkap" required>
                                @error('name')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Email</span>
                                </label>
                                <input type="email" name="email" value="{{ old('email', $member->email) }}"
                                    class="input input-bordered @error('email') input-error @enderror"
                                    placeholder="email@example.com">
                                @error('email')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">No. Telepon</span>
                                </label>
                                <input type="text" name="phone" value="{{ old('phone', $member->phone) }}"
                                    class="input input-bordered @error('phone') input-error @enderror"
                                    placeholder="08xxxxxxxxxx">
                                @error('phone')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Jenis Kelamin *</span>
                                </label>
                                <select name="gender"
                                    class="select select-bordered @error('gender') select-error @enderror" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="laki-laki"
                                        {{ old('gender', $member->gender) == 'laki-laki' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="perempuan"
                                        {{ old('gender', $member->gender) == 'perempuan' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Tanggal Lahir</span>
                                </label>
                                <input type="date" name="birth_date"
                                    value="{{ old('birth_date', $member->birth_date?->format('Y-m-d')) }}"
                                    class="input input-bordered @error('birth_date') input-error @enderror">
                                @error('birth_date')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Tempat Lahir</span>
                                </label>
                                <input type="text" name="birth_place"
                                    value="{{ old('birth_place', $member->birth_place) }}"
                                    class="input input-bordered @error('birth_place') input-error @enderror"
                                    placeholder="Kota, Provinsi">
                                @error('birth_place')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Status Pernikahan *</span>
                                </label>
                                <select name="marital_status"
                                    class="select select-bordered @error('marital_status') select-error @enderror"
                                    required>
                                    <option value="">Pilih Status Pernikahan</option>
                                    <option value="belum menikah"
                                        {{ old('marital_status', $member->marital_status) == 'belum menikah' ? 'selected' : '' }}>
                                        Belum Menikah</option>
                                    <option value="menikah"
                                        {{ old('marital_status', $member->marital_status) == 'menikah' ? 'selected' : '' }}>
                                        Menikah</option>
                                    <option value="cerai"
                                        {{ old('marital_status', $member->marital_status) == 'cerai' ? 'selected' : '' }}>
                                        Cerai</option>
                                    <option value="janda"
                                        {{ old('marital_status', $member->marital_status) == 'janda' ? 'selected' : '' }}>
                                        Janda</option>
                                    <option value="duda"
                                        {{ old('marital_status', $member->marital_status) == 'duda' ? 'selected' : '' }}>
                                        Duda</option>
                                </select>
                                @error('marital_status')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Pekerjaan</span>
                                </label>
                                <input type="text" name="occupation"
                                    value="{{ old('occupation', $member->occupation) }}"
                                    class="input input-bordered @error('occupation') input-error @enderror"
                                    placeholder="Pekerjaan">
                                @error('occupation')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Pendidikan</span>
                                </label>
                                <input type="text" name="education"
                                    value="{{ old('education', $member->education) }}"
                                    class="input input-bordered @error('education') input-error @enderror"
                                    placeholder="Tingkat pendidikan">
                                @error('education')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Status Keanggotaan *</span>
                                </label>
                                <select name="status"
                                    class="select select-bordered @error('status') select-error @enderror" required>
                                    <option value="">Pilih Status</option>
                                    <option value="aktif"
                                        {{ old('status', $member->status) == 'aktif' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="tidak aktif"
                                        {{ old('status', $member->status) == 'tidak aktif' ? 'selected' : '' }}>Tidak
                                        Aktif</option>
                                    <option value="pindah"
                                        {{ old('status', $member->status) == 'pindah' ? 'selected' : '' }}>Pindah
                                    </option>
                                    <option value="meninggal"
                                        {{ old('status', $member->status) == 'meninggal' ? 'selected' : '' }}>Meninggal
                                    </option>
                                </select>
                                @error('status')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Foto Profil</span>
                                </label>
                                <input type="file" name="photo"
                                    class="file-input file-input-bordered @error('photo') file-input-error @enderror"
                                    accept="image/*">
                                @if ($member->photo)
                                    <div class="mt-2">
                                        <img src="{{ asset($member->photo) }}" alt="Current photo"
                                            class="w-20 h-20 object-cover rounded">
                                        <p class="text-sm text-base-content/60">Foto saat ini</p>
                                    </div>
                                @endif
                                @error('photo')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                        </div>

                        <div class="form-control mt-4">
                            <label class="label">
                                <span class="label-text">Alamat</span>
                            </label>
                            <textarea name="address" class="textarea textarea-bordered @error('address') textarea-error @enderror"
                                placeholder="Alamat lengkap">{{ old('address', $member->address) }}</textarea>
                            @error('address')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Religious Information -->
                <div class="card bg-base-100 shadow-xl mb-6">
                    <div class="card-body">
                        <h2 class="card-title text-2xl mb-4">Informasi Keagamaan</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Tanggal Baptis</span>
                                </label>
                                <input type="date" name="baptism_date"
                                    value="{{ old('baptism_date', $member->baptism_date?->format('Y-m-d')) }}"
                                    class="input input-bordered @error('baptism_date') input-error @enderror">
                                @error('baptism_date')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Tempat Baptis</span>
                                </label>
                                <input type="text" name="baptism_place"
                                    value="{{ old('baptism_place', $member->baptism_place) }}"
                                    class="input input-bordered @error('baptism_place') input-error @enderror"
                                    placeholder="Gereja tempat baptis">
                                @error('baptism_place')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Tanggal Sidi</span>
                                </label>
                                <input type="date" name="sidi_date"
                                    value="{{ old('sidi_date', $member->sidi_date?->format('Y-m-d')) }}"
                                    class="input input-bordered @error('sidi_date') input-error @enderror">
                                @error('sidi_date')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Tempat Sidi</span>
                                </label>
                                <input type="text" name="sidi_place"
                                    value="{{ old('sidi_place', $member->sidi_place) }}"
                                    class="input input-bordered @error('sidi_place') input-error @enderror"
                                    placeholder="Gereja tempat sidi">
                                @error('sidi_place')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Tanggal Pernikahan</span>
                                </label>
                                <input type="date" name="marriage_date"
                                    value="{{ old('marriage_date', $member->marriage_date?->format('Y-m-d')) }}"
                                    class="input input-bordered @error('marriage_date') input-error @enderror">
                                @error('marriage_date')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Tempat Pernikahan</span>
                                </label>
                                <input type="text" name="marriage_place"
                                    value="{{ old('marriage_place', $member->marriage_place) }}"
                                    class="input input-bordered @error('marriage_place') input-error @enderror"
                                    placeholder="Gereja tempat pernikahan">
                                @error('marriage_place')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Family Information -->
                <div class="card bg-base-100 shadow-xl mb-6">
                    <div class="card-body">
                        <h2 class="card-title text-2xl mb-4">Informasi Keluarga</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Keluarga</span>
                                </label>
                                <select name="family_id"
                                    class="select select-bordered @error('family_id') select-error @enderror">
                                    <option value="">Pilih Keluarga</option>
                                    @foreach ($families as $family)
                                        <option value="{{ $family->id }}"
                                            {{ old('family_id', $member->family_id) == $family->id ? 'selected' : '' }}>
                                            {{ $family->family_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('family_id')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Ayah</span>
                                </label>
                                <select name="father_id"
                                    class="select select-bordered @error('father_id') select-error @enderror">
                                    <option value="">Pilih Ayah</option>
                                    @foreach ($members as $memberOption)
                                        @if ($memberOption->id != $member->id)
                                            <option value="{{ $memberOption->id }}"
                                                {{ old('father_id', $member->father_id) == $memberOption->id ? 'selected' : '' }}>
                                                {{ $memberOption->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('father_id')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Ibu</span>
                                </label>
                                <select name="mother_id"
                                    class="select select-bordered @error('mother_id') select-error @enderror">
                                    <option value="">Pilih Ibu</option>
                                    @foreach ($members as $memberOption)
                                        @if ($memberOption->id != $member->id)
                                            <option value="{{ $memberOption->id }}"
                                                {{ old('mother_id', $member->mother_id) == $memberOption->id ? 'selected' : '' }}>
                                                {{ $memberOption->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('mother_id')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Pasangan</span>
                                </label>
                                <select name="spouse_id"
                                    class="select select-bordered @error('spouse_id') select-error @enderror">
                                    <option value="">Pilih Pasangan</option>
                                    @foreach ($members as $memberOption)
                                        @if ($memberOption->id != $member->id)
                                            <option value="{{ $memberOption->id }}"
                                                {{ old('spouse_id', $member->spouse_id) == $memberOption->id ? 'selected' : '' }}>
                                                {{ $memberOption->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('spouse_id')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                        </div>

                        <div class="form-control mt-4">
                            <label class="label">
                                <span class="label-text">Catatan</span>
                            </label>
                            <textarea name="notes" class="textarea textarea-bordered @error('notes') textarea-error @enderror"
                                placeholder="Catatan tambahan">{{ old('notes', $member->notes) }}</textarea>
                            @error('notes')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-4">
                    <a href="{{ route('members.show', $member->id) }}" class="btn btn-outline">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z">
                            </path>
                        </svg>
                        Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>

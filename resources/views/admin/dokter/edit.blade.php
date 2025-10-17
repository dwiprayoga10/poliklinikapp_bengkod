<x-layouts.app>
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h1 class="mb-4">Edit Dokter</h1>

                {{-- ✅ Alert CRUD --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('dokter.update', $dokter->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Baris 1: Nama & Email --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="nama" class="form-label">Nama Dokter <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama"
                                            value="{{ old('nama', $dokter->nama) }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email"
                                            value="{{ old('email', $dokter->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Baris 2: No KTP & No HP --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="no_ktp" class="form-label">No KTP <span class="text-danger">*</span></label>
                                        <input type="number"
                                            class="form-control @error('no_ktp') is-invalid @enderror"
                                            id="no_ktp" name="no_ktp"
                                            value="{{ old('no_ktp', $dokter->no_ktp) }}" required>
                                        @error('no_ktp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="no_hp" class="form-label">No HP <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('no_hp') is-invalid @enderror"
                                            id="no_hp" name="no_hp"
                                            value="{{ old('no_hp', $dokter->no_hp) }}" required>
                                        @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div class="form-group mb-3">
                                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea name="alamat" id="alamat"
                                    class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $dokter->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Poli --}}
                            <div class="form-group mb-3">
                                <label for="id_poli" class="form-label">Poli <span class="text-danger">*</span></label>
                                <select name="id_poli" id="id_poli"
                                    class="form-control @error('id_poli') is-invalid @enderror" required>
                                    <option value="">Pilih Poli</option>
                                    @foreach ($polis as $poli)
                                        <option value="{{ $poli->id }}"
                                            {{ (string) old('id_poli', $dokter->id_poli) === (string) $poli->id ? 'selected' : '' }}>
                                            {{ $poli->nama_poli ?? 'Poli Tidak Dikenal' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_poli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password (opsional) --}}
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password Baru (opsional)</label>
                                <input type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password"
                                    placeholder="Biarkan kosong jika tidak ingin mengubah password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="form-group mb-3 text-end">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-1"></i> Update
                                </button>
                                <a href="{{ route('dokter.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
    <h4 class="mb-4">Tambah Anggota</h4>

    <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label for="kontak" class="form-label">Kontak</label>
            <input type="text" name="kontak" class="form-control" value="{{ old('kontak') }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="tidak aktif" {{ old('status') == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto (Opsional)</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
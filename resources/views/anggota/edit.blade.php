@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')
    <h4 class="mb-4">Edit Anggota</h4>

    <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $anggota->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="kontak" class="form-label">Kontak</label>
            <input type="text" name="kontak" class="form-control" value="{{ old('kontak', $anggota->kontak) }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="aktif" {{ $anggota->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="tidak aktif" {{ $anggota->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $anggota->alamat) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Baru (Opsional)</label>
            <input type="file" name="foto" class="form-control">
            @if ($anggota->foto)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $anggota->foto) }}" width="100">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
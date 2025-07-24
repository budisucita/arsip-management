@extends('layouts.app')

@section('title', 'Tambah Dokumentasi')

@section('content')
    <h4 class="mb-4">Tambah Dokumentasi Kegiatan</h4>

    <form action="{{ route('dokumentasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="kegiatan_id" class="form-label">Kegiatan</label>
            <select name="kegiatan_id" class="form-select" required>
                <option value="">-- Pilih Kegiatan --</option>
                @foreach ($kegiatan as $item)
                    <option value="{{ $item->id }}" {{ old('kegiatan_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_kegiatan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe</label>
            <select name="tipe" class="form-select" required>
                <option value="foto" {{ old('tipe') == 'foto' ? 'selected' : '' }}>Foto</option>
                <option value="video" {{ old('tipe') == 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="file_path" class="form-label">Upload File</label>
            <input type="file" name="file_path" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('dokumentasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
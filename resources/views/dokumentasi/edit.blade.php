@extends('layouts.app')

@section('title', 'Edit Dokumentasi')

@section('content')
    <h4 class="mb-4">Edit Dokumentasi Kegiatan</h4>

    <form action="{{ route('dokumentasi.update', $dokumentasi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kegiatan_id" class="form-label">Kegiatan</label>
            <select name="kegiatan_id" class="form-select" required>
                @foreach ($kegiatan as $item)
                    <option value="{{ $item->id }}" {{ $dokumentasi->kegiatan_id == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_kegiatan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe</label>
            <select name="tipe" class="form-select" required>
                <option value="foto" {{ $dokumentasi->tipe == 'foto' ? 'selected' : '' }}>Foto</option>
                <option value="video" {{ $dokumentasi->tipe == 'video' ? 'selected' : '' }}>Video</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">File Lama</label><br>
            @if ($dokumentasi->tipe == 'foto')
                <img src="{{ asset('storage/' . $dokumentasi->file_path) }}" width="120">
            @else
                <a href="{{ asset('storage/' . $dokumentasi->file_path) }}" target="_blank">Lihat Video</a>
            @endif
        </div>

        <div class="mb-3">
            <label for="file_path" class="form-label">Ganti File (opsional)</label>
            <input type="file" name="file_path" class="form-control">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi', $dokumentasi->deskripsi) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('dokumentasi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
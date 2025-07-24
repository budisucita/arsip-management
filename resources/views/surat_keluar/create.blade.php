@extends('layouts.app')

@section('title', 'Tambah Surat Keluar')

@section('content')
    <h4 class="mb-4">Tambah Surat Keluar</h4>

    <form action="{{ route('surat-keluar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="no_surat" class="form-label">No Surat</label>
            <input type="text" name="no_surat" class="form-control" value="{{ old('no_surat') }}" required>
        </div>

        <div class="mb-3">
            <label for="penerima" class="form-label">Penerima</label>
            <input type="text" name="penerima" class="form-control" value="{{ old('penerima') }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_kirim" class="form-label">Tanggal Kirim</label>
            <input type="date" name="tanggal_kirim" class="form-control" value="{{ old('tanggal_kirim') }}" required>
        </div>

        <div class="mb-3">
            <label for="perihal" class="form-label">Perihal</label>
            <textarea name="perihal" class="form-control" rows="3" required>{{ old('perihal') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="file_surat" class="form-label">File Surat (PDF/JPG/PNG)</label>
            <input type="file" name="file_surat" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
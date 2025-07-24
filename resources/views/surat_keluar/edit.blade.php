@extends('layouts.app')

@section('title', 'Edit Surat Keluar')

@section('content')
    <h4 class="mb-4">Edit Surat Keluar</h4>

    <form action="{{ route('surat-keluar.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="no_surat" class="form-label">No Surat</label>
            <input type="text" name="no_surat" class="form-control" value="{{ old('no_surat', $surat->no_surat) }}" required>
        </div>

        <div class="mb-3">
            <label for="penerima" class="form-label">Penerima</label>
            <input type="text" name="penerima" class="form-control" value="{{ old('penerima', $surat->penerima) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_kirim" class="form-label">Tanggal Kirim</label>
            <input type="date" name="tanggal_kirim" class="form-control" value="{{ old('tanggal_kirim', $surat->tanggal_kirim) }}" required>
        </div>

        <div class="mb-3">
            <label for="perihal" class="form-label">Perihal</label>
            <textarea name="perihal" class="form-control" rows="3" required>{{ old('perihal', $surat->perihal) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">File Surat</label><br>
            @if ($surat->file_surat)
                <a href="{{ asset('storage/' . $surat->file_surat) }}" target="_blank">Lihat File Lama</a><br>
            @endif
            <input type="file" name="file_surat" class="form-control mt-2">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
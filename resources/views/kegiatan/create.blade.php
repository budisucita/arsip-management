@extends('layouts.app')

@section('title', 'Tambah Kegiatan')

@section('content')
    <h4 class="mb-4">Tambah Kegiatan</h4>

    <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan') }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai') }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="proposal_file" class="form-label">Upload Proposal (PDF)</label>
            <input type="file" name="proposal_file" class="form-control">
        </div>

        <div class="mb-3">
            <label for="rab_file" class="form-label">Upload RAB (PDF)</label>
            <input type="file" name="rab_file" class="form-control">
        </div>

        <div class="mb-3">
            <label for="lpj_file" class="form-label">Upload LPJ (PDF)</label>
            <input type="file" name="lpj_file" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
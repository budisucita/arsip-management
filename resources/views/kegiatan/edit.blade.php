@extends('layouts.app')

@section('title', 'Edit Kegiatan')

@section('content')
    <h4 class="mb-4">Edit Kegiatan</h4>

    <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $kegiatan->tanggal_mulai) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $kegiatan->tanggal_selesai) }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Proposal (Opsional)</label><br>
            @if ($kegiatan->proposal_file)
                <a href="{{ asset('storage/' . $kegiatan->proposal_file) }}" target="_blank">Download Proposal</a><br>
            @endif
            <input type="file" name="proposal_file" class="form-control mt-2">
        </div>

        <div class="mb-3">
            <label class="form-label">RAB (Opsional)</label><br>
            @if ($kegiatan->rab_file)
                <a href="{{ asset('storage/' . $kegiatan->rab_file) }}" target="_blank">Download RAB</a><br>
            @endif
            <input type="file" name="rab_file" class="form-control mt-2">
        </div>

        <div class="mb-3">
            <label class="form-label">LPJ (Opsional)</label><br>
            @if ($kegiatan->lpj_file)
                <a href="{{ asset('storage/' . $kegiatan->lpj_file) }}" target="_blank">Download LPJ</a><br>
            @endif
            <input type="file" name="lpj_file" class="form-control mt-2">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
@extends('layouts.app')

@section('title', 'Tambah Transaksi Keuangan')

@section('content')
    <h4 class="mb-4">Tambah Transaksi Keuangan</h4>

    <form action="{{ route('keuangan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="kegiatan_id" class="form-label">Nama Kegiatan</label>
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
            <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
            <select name="jenis_transaksi" class="form-select" required>
                <option value="pemasukan" {{ old('jenis_transaksi') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                <option value="pengeluaran" {{ old('jenis_transaksi') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah (Rp)</label>
            <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3" required>{{ old('keterangan') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="bukti_file" class="form-label">Upload Bukti (PDF/JPG/PNG)</label>
            <input type="file" name="bukti_file" class="form-control">
        </div>

        <div class="mb-3">
            <label for="lpj_file" class="form-label">Upload LPJ (PDF)</label>
            <input type="file" name="lpj_file" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('keuangan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
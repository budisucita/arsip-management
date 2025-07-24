@extends('layouts.app')

@section('title', 'Edit Transaksi Keuangan')

@section('content')
    <h4 class="mb-4">Edit Transaksi Keuangan</h4>

    <form action="{{ route('keuangan.update', $keuangan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="kegiatan_id" class="form-label">Nama Kegiatan</label>
            <select name="kegiatan_id" class="form-select" required>
                @foreach ($kegiatan as $item)
                    <option value="{{ $item->id }}" {{ $keuangan->kegiatan_id == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_kegiatan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
            <select name="jenis_transaksi" class="form-select" required>
                <option value="pemasukan" {{ $keuangan->jenis_transaksi == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                <option value="pengeluaran" {{ $keuangan->jenis_transaksi == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah (Rp)</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $keuangan->jumlah }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $keuangan->tanggal }}" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3" required>{{ $keuangan->keterangan }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Bukti File</label><br>
            @if ($keuangan->bukti_file)
                <a href="{{ asset('storage/' . $keuangan->bukti_file) }}" target="_blank">Lihat Bukti</a><br>
            @endif
            <input type="file" name="bukti_file" class="form-control mt-2">
        </div>

        <div class="mb-3">
            <label class="form-label">LPJ File</label><br>
            @if ($keuangan->lpj_file)
                <a href="{{ asset('storage/' . $keuangan->lpj_file) }}" target="_blank">Lihat LPJ</a><br>
            @endif
            <input type="file" name="lpj_file" class="form-control mt-2">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('keuangan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
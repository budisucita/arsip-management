@extends('layouts.app')

@section('title', 'Data Keuangan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Keuangan</h4>
        <a href="{{ route('keuangan.create') }}" class="btn btn-primary">+ Tambah Transaksi</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Kegiatan</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>User</th>
                <th>Bukti</th>
                <th>LPJ</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->kegiatan->nama_kegiatan ?? '-' }}</td>
                <td>{{ ucfirst($item->jenis_transaksi) }}</td>
                <td>Rp {{ number_format($item->jumlah, 2, ',', '.') }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->user->nama ?? '-' }}</td>
                <td>
                    @if ($item->bukti_file)
                        <a href="{{ asset('storage/' . $item->bukti_file) }}" target="_blank">Download</a>
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if ($item->lpj_file)
                        <a href="{{ asset('storage/' . $item->lpj_file) }}" target="_blank">Download</a>
                    @else
                        -
                    @endif
                </td>
                <td>{{ $item->keterangan }}</td>
                <td>
                    <a href="{{ route('keuangan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('keuangan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@extends('layouts.app')

@section('title', 'Dokumentasi Kegiatan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Dokumentasi Kegiatan</h4>
        <a href="{{ route('dokumentasi.create') }}" class="btn btn-primary">+ Tambah Dokumentasi
            @if(auth()->user()->role !== 'admin') style="display: none" @endif>
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Kegiatan</th>
                <th>Tipe</th>
                <th>Deskripsi</th>
                <th>File</th>
                <th>Waktu Upload</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->kegiatan->nama_kegiatan ?? '-' }}</td>
                <td>{{ ucfirst($item->tipe) }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>
                    @if ($item->tipe === 'foto')
                        <img src="{{ asset('storage/' . $item->file_path) }}" alt="foto" width="100">
                    @else
                        <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank">Lihat Video</a>
                    @endif
                </td>
                <td>{{ $item->uploaded_at }}</td>
                <td>
                    <a href="{{ route('dokumentasi.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('dokumentasi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus dokumentasi ini?')">
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
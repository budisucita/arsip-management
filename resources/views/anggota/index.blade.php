@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Anggota</h4>
        <a href="{{ route('anggota.create') }}" class="btn btn-primary">+ Tambah Anggota
            @if(auth()->user()->role !== 'admin') style="display: none" @endif>
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Status</th>
                <th>Alamat</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->kontak }}</td>
                <td>{{ $row->status }}</td>
                <td>{{ $row->alamat }}</td>
                <td>
                    @if ($row->foto)
                        <img src="{{ asset('storage/' . $row->foto) }}" width="60">
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('anggota.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('anggota.destroy', $row->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
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
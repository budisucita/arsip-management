@extends('layouts.app')

@section('title', 'Surat Keluar')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Surat Keluar</h4>
        <a href="{{ route('surat-keluar.create') }}" class="btn btn-primary">+ Tambah Surat
            @if(auth()->user()->role !== 'admin') style="display: none" @endif>
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No Surat</th>
                <th>Penerima</th>
                <th>Tanggal Kirim</th>
                <th>Perihal</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($data as $surat)
            <tr>
                <td>{{ $surat->no_surat }}</td>
                <td>{{ $surat->penerima }}</td>
                <td>{{ $surat->tanggal_kirim }}</td>
                <td>{{ $surat->perihal }}</td>
                <td>
                    @if ($surat->file_surat)
                        <a href="{{ asset('storage/' . $surat->file_surat) }}" target="_blank">Download</a>
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('surat-keluar.edit', $surat->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('surat-keluar.destroy', $surat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus surat ini?')">
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
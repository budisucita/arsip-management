@extends('layouts.app')

@section('title', 'Surat Masuk')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Surat Masuk</h4>
        <a href="{{ route('surat-masuk.create') }}" class="btn btn-primary">+ Tambah Surat
            @if(auth()->user()->role !== 'admin') style="display: none" @endif>
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No Surat</th>
                <th>Pengirim</th>
                <th>Tanggal Terima</th>
                <th>Perihal</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($data as $surat)
            <tr>
                <td>{{ $surat->no_surat }}</td>
                <td>{{ $surat->pengirim }}</td>
                <td>{{ $surat->tanggal_terima }}</td>
                <td>{{ $surat->perihal }}</td>
                <td>
                    @if ($surat->file_surat)
                        <a href="{{ asset('storage/' . $surat->file_surat) }}" target="_blank">Download</a>
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('surat-masuk.edit', $surat->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('surat-masuk.destroy', $surat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus surat ini?')">
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
@extends('layouts.app')

@section('title', 'Data Kegiatan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Kegiatan</h4>
        <a href="{{ route('kegiatan.create') }}" class="btn btn-primary">+ Tambah Kegiatan
            @if(auth()->user()->role !== 'admin') style="display: none" @endif>
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama Kegiatan</th>
                <th>Tanggal</th>
                <th>Penanggung Jawab</th>
                <th>Proposal</th>
                <th>RAB</th>
                <th>LPJ</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->nama_kegiatan }}</td>
                <td>{{ $item->tanggal_mulai }} s/d {{ $item->tanggal_selesai }}</td>
                <td>{{ $item->user->nama ?? '-' }}</td>
                <td>
                    @if ($item->proposal_file)
                        <a href="{{ asset('storage/' . $item->proposal_file) }}" target="_blank">Download</a>
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if ($item->rab_file)
                        <a href="{{ asset('storage/' . $item->rab_file) }}" target="_blank">Download</a>
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
                <td>
                    <a href="{{ route('kegiatan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('kegiatan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
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
@extends('layouts.app')

@section('title', 'Laporan Kegiatan')

@section('content')
    <h4 class="mb-4">Laporan Kegiatan Tahunan</h4>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="tahun" class="form-label">Tahun</label>
            <select name="tahun" class="form-select" onchange="this.form.submit()">
                @foreach ($tahunList as $tahun)
                    <option value="{{ $tahun }}" {{ $tahun == request('tahun') ? 'selected' : '' }}>{{ $tahun }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 align-self-end">
            <a href="{{ route('laporan.kegiatan.pdf', ['tahun' => request('tahun')]) }}"
            target="_blank" class="btn btn-danger">
                Export PDF
            </a>
        </div>
    </form>

    <div class="col-md-4 align-self-end">
        <a href="{{ route('laporan.kegiatan.pdf', ['tahun' => request('tahun')]) }}"
        target="_blank" class="btn btn-danger">
            Export PDF
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Kegiatan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Deskripsi</th>
                <th>Proposal</th>
                <th>LPJ</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($kegiatan as $item)
            <tr>
                <td>{{ $item->nama_kegiatan }}</td>
                <td>{{ $item->tanggal_mulai }}</td>
                <td>{{ $item->tanggal_selesai }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td>
                    @if ($item->proposal_file)
                        <a href="{{ asset('storage/' . $item->proposal_file) }}" target="_blank">Download</a>
                    @endif
                </td>
                <td>
                    @if ($item->lpj_file)
                        <a href="{{ asset('storage/' . $item->lpj_file) }}" target="_blank">Download</a>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center">Tidak ada data kegiatan.</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection
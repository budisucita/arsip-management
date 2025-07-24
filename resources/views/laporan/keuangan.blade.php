@extends('layouts.app')

@section('title', 'Laporan Keuangan')

@section('content')
    <h4 class="mb-4">Laporan Keuangan</h4>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="bulan" class="form-label">Bulan</label>
            <select name="bulan" class="form-select">
                <option value="">Semua</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-md-3">
            <label for="tahun" class="form-label">Tahun</label>
            <select name="tahun" class="form-select">
                @foreach ($tahunList as $tahun)
                    <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 align-self-end">
            <button class="btn btn-primary">Tampilkan</button>
        </div>

        <div class="col-md-3 align-self-end">
            <a href="{{ route('laporan.keuangan.pdf', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}"
            target="_blank" class="btn btn-danger">
            Export PDF
            </a>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kegiatan</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Bukti</th>
            </tr>
        </thead>
        <tbody>
        @php
            $totalMasuk = 0;
            $totalKeluar = 0;
        @endphp
        @forelse ($keuangan as $item)
            <tr>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->kegiatan->nama_kegiatan ?? '-' }}</td>
                <td>{{ ucfirst($item->jenis_transaksi) }}</td>
                <td>Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>
                    @if ($item->bukti_file)
                        <a href="{{ asset('storage/' . $item->bukti_file) }}" target="_blank">Download</a>
                    @endif
                </td>
            </tr>
            @php
                if ($item->jenis_transaksi === 'pemasukan') {
                    $totalMasuk += $item->jumlah;
                } else {
                    $totalKeluar += $item->jumlah;
                }
            @endphp
        @empty
            <tr><td colspan="6" class="text-center">Tidak ada transaksi.</td></tr>
        @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Pemasukan</th>
                <th colspan="3">Rp{{ number_format($totalMasuk, 0, ',', '.') }}</th>
            </tr>
            <tr>
                <th colspan="3">Total Pengeluaran</th>
                <th colspan="3">Rp{{ number_format($totalKeluar, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
@endsection
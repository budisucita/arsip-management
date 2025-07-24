<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Keuangan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function kegiatan(Request $request)
    {
        $tahun = $request->tahun ?? now()->year;
        $tahunList = Kegiatan::selectRaw('YEAR(tanggal_mulai) as tahun')->distinct()->pluck('tahun');

        $kegiatan = Kegiatan::whereYear('tanggal_mulai', $tahun)->get();

        return view('laporan.kegiatan', compact('kegiatan', 'tahunList'));
    }

    public function keuangan(Request $request)
    {
        $tahun = $request->tahun ?? now()->year;
        $bulan = $request->bulan;

        $query = Keuangan::with('kegiatan');

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }

        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }

        $keuangan = $query->get();
        $tahunList = Keuangan::selectRaw('YEAR(tanggal) as tahun')->distinct()->pluck('tahun');

        return view('laporan.keuangan', compact('keuangan', 'tahunList'));
    }

    public function exportKegiatanPDF(Request $request)
    {
        $tahun = $request->tahun ?? now()->year;
        $data = Kegiatan::whereYear('tanggal_mulai', $tahun)->get();

        $pdf = Pdf::loadView('laporan.pdf.kegiatan', compact('data', 'tahun'));
        return $pdf->download("laporan-kegiatan-{$tahun}.pdf");
    }

    public function exportKeuanganPDF(Request $request)
    {
        $tahun = $request->tahun ?? now()->year;
        $bulan = $request->bulan;

        $query = Keuangan::with('kegiatan');
        if ($tahun) $query->whereYear('tanggal', $tahun);
        if ($bulan) $query->whereMonth('tanggal', $bulan);

        $data = $query->get();

        $pdf = Pdf::loadView('laporan.pdf.keuangan', compact('data', 'tahun', 'bulan'));
        return $pdf->download("laporan-keuangan-{$tahun}.pdf");
    }

}

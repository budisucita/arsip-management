<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keuangan;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Keuangan::with(['user', 'kegiatan'])->get();
        return view('keuangan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kegiatan = Kegiatan::all();
        return view('keuangan.create', compact('kegiatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'jenis_transaksi' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
            'bukti_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'lpj_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $keuangan = new Keuangan($request->only([
            'kegiatan_id', 'jenis_transaksi', 'jumlah', 'keterangan', 'tanggal'
        ]));

        $keuangan->id = Str::uuid();
        $keuangan->users_id = Auth::id();

        if ($request->hasFile('bukti_file')) {
            $keuangan->bukti_file = $request->file('bukti_file')->store('bukti_keuangan', 'public');
        }

        if ($request->hasFile('lpj_file')) {
            $keuangan->lpj_file = $request->file('lpj_file')->store('lpj_keuangan', 'public');
        }

        $keuangan->save();
        return redirect()->route('keuangan.index')->with('success', 'Data keuangan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keuangan $keuangan)
    {
        $kegiatan = Kegiatan::all();
        return view('keuangan.edit', compact('keuangan', 'kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keuangan $keuangan)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'jenis_transaksi' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'required|string',
            'tanggal' => 'required|date',
            'bukti_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'lpj_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $keuangan->fill($request->only([
            'kegiatan_id', 'jenis_transaksi', 'jumlah', 'keterangan', 'tanggal'
        ]));

        if ($request->hasFile('bukti_file')) {
            $keuangan->bukti_file = $request->file('bukti_file')->store('bukti_keuangan', 'public');
        }

        if ($request->hasFile('lpj_file')) {
            $keuangan->lpj_file = $request->file('lpj_file')->store('lpj_keuangan', 'public');
        }

        $keuangan->save();
        return redirect()->route('keuangan.index')->with('success', 'Data keuangan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keuangan $keuangan)
    {
        $keuangan->delete();
        return redirect()->route('keuangan.index')->with('success', 'Data keuangan berhasil dihapus');
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SuratKeluar::with('user')->get();
        return view('surat_keluar.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('surat_keluar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_surat' => 'required|string|max:100',
            'penerima' => 'required|string|max:100',
            'tanggal_kirim' => 'required|date',
            'perihal' => 'required|string',
            'file_surat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $surat = new SuratKeluar([
            'id' => Str::uuid(),
            'users_id' => Auth::id(),
            'no_surat' => $request->no_surat,
            'penerima' => $request->penerima,
            'tanggal_kirim' => $request->tanggal_kirim,
            'perihal' => $request->perihal,
        ]);

        if ($request->hasFile('file_surat')) {
            $surat->file_surat = $request->file('file_surat')->store('surat_keluar', 'public');
        }

        $surat->save();
        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil ditambahkan');
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
    public function edit(SuratKeluar $surat_keluar)
    {
        return view('surat_keluar.edit', compact('surat_keluar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratMasuk $surat_keluar)
    {
        $request->validate([
            'no_surat' => 'required|string|max:100',
            'penerima' => 'required|string|max:100',
            'tanggal_kirim' => 'required|date',
            'perihal' => 'required|string',
            'file_surat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $surat_keluar->fill($request->only([
            'no_surat', 'penerima', 'tanggal_kirim', 'perihal'
        ]));

        if ($request->hasFile('file_surat')) {
            $surat_keluar->file_surat = $request->file('file_surat')->store('surat_keluar', 'public');
        }

        $surat_keluar->save();
        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratKeluar $surat_keluar)
    {
        $surat_keluar->delete();
        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil dihapus');
    }

}


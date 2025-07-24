<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SuratMasuk::with('user')->get();
        return view('surat_masuk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('surat_masuk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_surat' => 'required|string|max:100',
            'pengirim' => 'required|string|max:100',
            'tanggal_terima' => 'required|date',
            'perihal' => 'required|string',
            'file_surat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $surat = new SuratMasuk([
            'id' => Str::uuid(),
            'users_id' => Auth::id(),
            'no_surat' => $request->no_surat,
            'pengirim' => $request->pengirim,
            'tanggal_terima' => $request->tanggal_terima,
            'perihal' => $request->perihal,
        ]);

        if ($request->hasFile('file_surat')) {
            $surat->file_surat = $request->file('file_surat')->store('surat_masuk', 'public');
        }

        $surat->save();
        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil ditambahkan');
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
    public function edit(SuratMasuk $surat_masuk)
    {
        return view('surat_masuk.edit', ['surat_masuk' => $surat_masuk]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratMasuk $surat_masuk)
    {
         $request->validate([
            'no_surat' => 'required|string|max:100',
            'pengirim' => 'required|string|max:100',
            'tanggal_terima' => 'required|date',
            'perihal' => 'required|string',
            'file_surat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $surat_masuk->fill($request->only([
            'no_surat', 'pengirim', 'tanggal_terima', 'perihal'
        ]));

        if ($request->hasFile('file_surat')) {
            $surat_masuk->file_surat = $request->file('file_surat')->store('surat_masuk', 'public');
        }

        $surat_masuk->save();
        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratMasuk $surat_masuk)
    {
        $surat_masuk->delete();
        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil dihapus');
    }
}

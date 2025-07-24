<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumentasi;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Dokumentasi::with('kegiatan')->get();
        return view('dokumentasi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kegiatan = Kegiatan::all();
        return view('dokumentasi.create', compact('kegiatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'tipe' => 'required|in:foto,video',
            'file_path' => 'required|file|mimes:jpg,jpeg,png,mp4,mov|max:51200',
            'deskripsi' => 'nullable|string',
        ]);

        $filePath = $request->file('file_path')->store('dokumentasi', 'public');

        Dokumentasi::create([
            'id' => Str::uuid(),
            'kegiatan_id' => $request->kegiatan_id,
            'users_id' => Auth::id(),
            'tipe' => $request->tipe,
            'file_path' => $filePath,
            'deskripsi' => $request->deskripsi,
            'uploaded_at' => now(),
        ]);

        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil ditambahkan');
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
    public function edit(Dokumentasi $dokumentasi)
    {
        $kegiatan = Kegiatan::all();
        return view('dokumentasi.edit', compact('dokumentasi', 'kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokumentasi $dokumentasi)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatan,id',
            'tipe' => 'required|in:foto,video',
            'file_path' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov|max:51200',
            'deskripsi' => 'nullable|string',
        ]);

        $dokumentasi->fill([
            'kegiatan_id' => $request->kegiatan_id,
            'tipe' => $request->tipe,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($request->hasFile('file_path')) {
            $dokumentasi->file_path = $request->file('file_path')->store('dokumentasi', 'public');
        }

        $dokumentasi->save();
        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokumentasi $dokumentasi)
    {
        $dokumentasi->delete();
        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil dihapus');
    }

}

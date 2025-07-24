<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Str;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Anggota::all();
        return view('anggota.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kontak' => 'required|string|max:50',
            'status' => 'required|in:aktif,tidak aktif',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $anggota = new Anggota($request->only(['nama', 'kontak', 'status', 'alamat']));
        $anggota->id = Str::uuid();

        if ($request->hasFile('foto')) {
            $anggota->foto = $request->file('foto')->store('anggota', 'public');
        }

        $anggota->save();
        return redirect()->route('anggota.index')->with('success', 'Data berhasil ditambahkan');
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
    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'kontak' => 'required|string|max:50',
            'status' => 'required|in:aktif,tidak aktif',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $anggota->fill($request->only(['nama', 'kontak', 'status', 'alamat']));

        if ($request->hasFile('foto')) {
            $anggota->foto = $request->file('foto')->store('anggota', 'public');
        }

        $anggota->save();
        return redirect()->route('anggota.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anggota $anggota)
    {
        $anggota->delete();
        return redirect()->route('anggota.index')->with('success', 'Data berhasil dihapus');
    }
}

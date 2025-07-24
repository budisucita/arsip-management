<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kegiatan::with('user')->get();
        return view('kegiatan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'required|string',
            'proposal_file' => 'nullable|file|mimes:pdf|max:2048',
            'rab_file' => 'nullable|file|mimes:pdf|max:2048',
            'lpj_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $kegiatan = new Kegiatan($request->only([
            'nama_kegiatan',
            'tanggal_mulai',
            'tanggal_selesai',
            'deskripsi',
        ]));

        $kegiatan->id = Str::uuid();
        $kegiatan->users_id = Auth::id();

        if ($request->hasFile('proposal_file')) {
            $kegiatan->proposal_file = $request->file('proposal_file')->store('proposal', 'public');
        }
        if ($request->hasFile('rab_file')) {
            $kegiatan->rab_file = $request->file('rab_file')->store('rab', 'public');
        }
        if ($request->hasFile('lpj_file')) {
            $kegiatan->lpj_file = $request->file('lpj_file')->store('lpj', 'public');
        }

        $kegiatan->save();
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan');
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
    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'required|string',
            'proposal_file' => 'nullable|file|mimes:pdf|max:2048',
            'rab_file' => 'nullable|file|mimes:pdf|max:2048',
            'lpj_file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $kegiatan->fill($request->only([
            'nama_kegiatan',
            'tanggal_mulai',
            'tanggal_selesai',
            'deskripsi',
        ]));

        if ($request->hasFile('proposal_file')) {
            $kegiatan->proposal_file = $request->file('proposal_file')->store('proposal', 'public');
        }
        if ($request->hasFile('rab_file')) {
            $kegiatan->rab_file = $request->file('rab_file')->store('rab', 'public');
        }
        if ($request->hasFile('lpj_file')) {
            $kegiatan->lpj_file = $request->file('lpj_file')->store('lpj', 'public');
        }

        $kegiatan->save();
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus');
    }
}

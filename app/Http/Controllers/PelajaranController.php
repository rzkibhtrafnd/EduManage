<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelajaran;

class PelajaranController extends Controller
{
    public function index()
    {
        $pelajaran = Pelajaran::paginate(10);
        return view('admin.pelajaran.index', compact('pelajaran'));
    }

    public function create()
    {
        return view('admin.pelajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        Pelajaran::create($request->only(['nama', 'deskripsi']));
        return redirect()->route('pelajaran.index')->with('success', 'Pelajaran berhasil ditambahkan');
    }

    public function edit(Pelajaran $pelajaran)
    {
        return view('admin.pelajaran.edit', compact('pelajaran'));
    }

    public function update(Request $request, Pelajaran $pelajaran)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        $pelajaran->update($request->only(['nama', 'deskripsi']));
        return redirect()->route('pelajaran.index')->with('success', 'Pelajaran berhasil diubah');
    }

    public function destroy(Pelajaran $pelajaran)
    {
        $pelajaran->delete();
        return redirect()->route('pelajaran.index')->with('success', 'Pelajaran berhasil dihapus');
    }
}

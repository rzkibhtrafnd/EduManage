<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;

class KelasController extends Controller
{
    // Menampilkan daftar kelas
    public function index()
    {
        $kelas = Kelas::paginate(10);
        return view('admin.kelas.index', compact('kelas'));
    }

    // Form untuk membuat kelas baru
    public function create()
    {
        return view('admin.kelas.create');
    }

    // Menyimpan data kelas baru
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Kelas::create($request->only('name', 'description'));

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    // Menampilkan detail kelas beserta daftar siswa yang terdaftar
    public function show($id)
    {
        $kelas = Kelas::with('students.user')->findOrFail($id);
        return view('admin.kelas.detail', compact('kelas'));
    }

    // Form untuk mengedit data kelas
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('admin.kelas.edit', compact('kelas'));
    }

    // Memperbarui data kelas
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $kelas->update($request->only('name', 'description'));

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    // Menghapus kelas
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}

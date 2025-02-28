<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jadwal;

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
        $kelas = Kelas::with([
            'students.user',
            'jadwal' => function ($query) {
                $query->with(['pelajaran', 'user'])
                      ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
                      ->orderBy('jam_mulai', 'asc');
            }
        ])->findOrFail($id);

        return view('admin.kelas.detail', compact('kelas'));
    } // End of show method

    // Form untuk mengedit data kelas
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('admin.kelas.edit', compact('kelas'));
    } // End of edit method

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
    } // End of update method

    // Menghapus kelas
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus.');
    } // End of destroy method
}

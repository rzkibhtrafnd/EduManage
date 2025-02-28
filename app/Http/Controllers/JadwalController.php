<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\User;

class JadwalController extends Controller
{
    public function index()
    {
        // Mengambil semua data jadwal beserta relasi kelas, user (guru) dan pelajaran,
        // diurutkan berdasarkan kelas, hari (sesuai urutan) dan jam_mulai
        $jadwal = Jadwal::with(['kelas', 'user', 'pelajaran'])
                    ->orderBy('kelas_id')
                    ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
                    ->orderBy('jam_mulai')
                    ->paginate(10);
        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $guru = User::where('role', 2)->get();
        $pelajaran = Pelajaran::all();
        return view('admin.jadwal.create', compact('kelas', 'guru', 'pelajaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'guru_id' => 'required|exists:users,id',
            'pelajaran_id' => 'required|exists:pelajaran,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    // Method show dihapus karena tidak lagi dibutuhkan

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $kelas = Kelas::all();
        $guru = User::where('role', 2)->get();
        $pelajaran = Pelajaran::all();
        return view('admin.jadwal.edit', compact('jadwal', 'kelas', 'guru', 'pelajaran'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'guru_id' => 'required|exists:users,id',
            'pelajaran_id' => 'required|exists:pelajaran,id',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diubah');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }
}

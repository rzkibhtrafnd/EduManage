<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\User;
use App\Models\Siswa;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::with(['kelas', 'user', 'pelajaran'])
            ->orderBy('kelas_id')
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam_mulai')
            ->paginate(10);

        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        return view('admin.jadwal.create', [
            'kelas'     => Kelas::all(),
            'guru'      => User::where('role', 2)->get(),
            'pelajaran' => Pelajaran::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id'      => 'required|exists:kelas,id',
            'guru_id'       => 'required|exists:users,id',
            'pelajaran_id'  => 'required|exists:pelajaran,id',
            'hari'          => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai'     => 'required|date_format:H:i',
            'jam_selesai'   => 'required|date_format:H:i|after:jam_mulai',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);

        return view('admin.jadwal.edit', [
            'jadwal'    => $jadwal,
            'kelas'     => Kelas::all(),
            'guru'      => User::where('role', 2)->get(),
            'pelajaran' => Pelajaran::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);

        $request->validate([
            'kelas_id'      => 'required|exists:kelas,id',
            'guru_id'       => 'required|exists:users,id',
            'pelajaran_id'  => 'required|exists:pelajaran,id',
            'hari'          => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai'     => 'required|date_format:H:i',
            'jam_selesai'   => 'required|date_format:H:i|after:jam_mulai',
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

    public function guruIndex()
    {
        $jadwal = Jadwal::with(['kelas', 'user', 'pelajaran'])
            ->where('guru_id', auth()->id())
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam_mulai')
            ->paginate(50);

        return view('guru.jadwal.index', compact('jadwal'));
    }

    public function muridIndex()
    {
        $siswa = Siswa::where('user_id', auth()->id())->first();
        $kelasId = $siswa->kelas_id;

        $jadwal = Jadwal::with(['kelas', 'user', 'pelajaran'])
            ->where('kelas_id', $kelasId)
            ->orderBy('kelas_id')
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam_mulai')
            ->paginate(50);

        return view('murid.jadwal.index', compact('jadwal'));
    }
}

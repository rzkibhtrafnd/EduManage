<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil data siswa beserta relasi user
        $siswas = Siswa::with('user')->paginate(10);
        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|min:6',
            'NISN'           => 'required|string|unique:siswa,NISN',
            'alamat'         => 'required|string',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'telepon'        => 'required|string|max:15',
            'img'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kelas_id'       => 'required|exists:kelas,id'
        ]);

        $imgPath = null;
        if ($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('siswa_images', 'public');
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 3,
        ]);

        Siswa::create([
            'user_id'       => $user->id,
            'kelas_id'      => $request->kelas_id,
            'NISN'          => $request->NISN,
            'alamat'        => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telepon'       => $request->telepon,
            'img'           => $imgPath,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function show($id)
    {
        // Gunakan id siswa (primary key pada tabel siswa)
        $siswa = Siswa::with('user', 'kelas')->findOrFail($id);
        return view('admin.siswa.detail', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);
        $kelas = Kelas::all();
        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $user = $siswa->user;

        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $user->id,
            'NISN'           => 'required|string|unique:siswa,NISN,' . $siswa->id,
            'alamat'         => 'required|string',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'telepon'        => 'required|string|max:15',
            'img'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kelas_id'       => 'required|exists:kelas,id'
        ]);

        $imgPath = $siswa->img;
        if ($request->hasFile('img')) {
            if ($imgPath) {
                Storage::disk('public')->delete($imgPath);
            }
            $imgPath = $request->file('img')->store('siswa_images', 'public');
        }

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        $siswa->update([
            'kelas_id'      => $request->kelas_id,
            'NISN'          => $request->NISN,
            'alamat'        => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telepon'       => $request->telepon,
            'img'           => $imgPath,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        if ($siswa->img) {
            Storage::disk('public')->delete($siswa->img);
        }
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus');
    }
}

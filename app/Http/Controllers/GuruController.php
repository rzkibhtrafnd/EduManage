<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Guru;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = User::where('role', 2)->paginate(10);
        return view('admin.guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'NIP' => 'required|string|unique:guru,NIP',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'telepon' => 'required|string|max:15',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imgPath = null;
        if ($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('guru_images', 'public');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2,
        ]);

        Guru::create([
            'user_id' => $user->id,
            'NIP' => $request->NIP,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telepon' => $request->telepon,
            'img' => $imgPath,
        ]);

        return redirect()->route('guru.index')->with('success', 'Guru berhasil ditambahkan');
    }

    public function show($id)
    {
        $guru = Guru::where('user_id', $id)->with('user')->firstOrFail();
        return view('admin.guru.detail', compact('guru'));
    }

    public function edit($id)
    {
        $guru = Guru::where('user_id', $id)->with('user')->firstOrFail();
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);
        $user = $guru->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'NIP' => 'required|string|unique:guru,NIP,' . $guru->id,
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'telepon' => 'required|string|max:15',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('img')) {
            if ($guru->img) {
                Storage::disk('public')->delete($guru->img);
            }
            $imgPath = $request->file('img')->store('guru_images', 'public');
            $guru->img = $imgPath;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        $guru->update([
            'NIP' => $request->NIP,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('guru.index')->with('success', 'Guru berhasil diperbarui');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $user = $guru->user;

        if ($guru->img) {
            Storage::disk('public')->delete($guru->img);
        }

        $guru->delete();
        $user->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus');
    }
}

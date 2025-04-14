<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan daftar admin.
     */
    public function index()
    {
        $admins = User::where('role', 1)->paginate(10);
        return view('admin.admin.index', compact('admins'));
    }

    /**
     * Form tambah admin baru.
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Simpan admin baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 1,
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan!');
    }

    /**
     * Form edit admin.
     */
    public function edit(User $admin)
    {
        if ($admin->role !== 1) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.admin.edit', compact('admin'));
    }

    /**
     * Update data admin.
     */
    public function update(Request $request, User $admin)
    {
        if ($admin->role !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:6',
        ]);

        $admin->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $admin->password,
        ]);

        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui!');
    }

    /**
     * Hapus admin.
     */
    public function destroy(User $admin)
    {
        if ($admin->role !== 1) {
            abort(403, 'Unauthorized action.');
        }

        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus!');
    }
}

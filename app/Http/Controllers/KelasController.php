<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        return response()->json(Kelas::with('teacher', 'students')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:users,id',
        ]);

        $kelas = Kelas::create($request->all());

        return response()->json(['message' => 'Kelas berhasil dibuat', 'kelas' => $kelas], 201);
    }

    public function show($id)
    {
        return response()->json(Kelas::with('teacher', 'students')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());

        return response()->json(['message' => 'Kelas diperbarui', 'kelas' => $kelas]);
    }

    public function destroy($id)
    {
        Kelas::destroy($id);
        return response()->json(['message' => 'Kelas dihapus']);
    }

    public function addStudent($class_id, $student_id)
    {
        $kelas = Kelas::findOrFail($class_id);
        $student = User::where('id', $student_id)->where('role', 3)->firstOrFail();

        $kelas->students()->attach($student->id);

        return response()->json(['message' => 'Siswa ditambahkan ke kelas']);
    }

    public function removeStudent($class_id, $student_id)
    {
        $kelas = Kelas::findOrFail($class_id);
        $kelas->students()->detach($student_id);

        return response()->json(['message' => 'Siswa dihapus dari kelas']);
    }
}

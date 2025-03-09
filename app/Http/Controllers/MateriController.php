<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use App\Models\Materi;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    // Menampilkan daftar pelajaran
    public function indexPelajaran()
    {
        $pelajaran = Pelajaran::paginate(10);
        return view('guru.materi.index', compact('pelajaran'));
    }

    // Menampilkan daftar materi untuk pelajaran tertentu
    public function materiByPelajaran($pelajaranId)
    {
        $pelajaran = Pelajaran::findOrFail($pelajaranId);
        $materi = Materi::with('guru', 'kelas')
                    ->where('pelajaran_id', $pelajaranId)
                    ->latest()
                    ->paginate(10);
        $kelas = Kelas::all(); // Untuk form create/edit
        return view('guru.materi.show', compact('pelajaran', 'materi', 'kelas'));
    }

    // Menampilkan form tambah materi
    public function create($pelajaranId)
    {
        if (Auth::user()->role != 2) {
            abort(403, 'Unauthorized action.');
        }
        $pelajaran = Pelajaran::findOrFail($pelajaranId);
        $kelas = Kelas::all();
        return view('guru.materi.create', compact('pelajaran', 'kelas'));
    }

    // Menyimpan materi baru
    public function store(Request $request, $pelajaranId)
    {
        if (Auth::user()->role != 2) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'kelas_id'    => 'required|exists:kelas,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'required|file|mimes:pdf,mp4,ppt,pptx',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('materi', $filename, 'public');

        // Pastikan file berhasil diunggah
        if (!$path) {
            return redirect()->back()->with('error', 'Gagal mengunggah file.');
        }

        Materi::create([
            'pelajaran_id' => $pelajaranId,
            'kelas_id'     => $request->kelas_id,
            'guru_id'      => Auth::id(),
            'title'        => $request->title,
            'description' => $request->description,
            'file_path'   => $path,
            'file_type'   => $file->getClientMimeType(),
        ]);

        return redirect()->route('guru.materi.show', $pelajaranId)
                         ->with('success', 'Materi berhasil ditambahkan.');
    }

    // Menampilkan form edit materi
    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        if (Auth::user()->role != 2 || Auth::id() != $materi->guru_id) {
            abort(403, 'Unauthorized action.');
        }
        $pelajaran = Pelajaran::findOrFail($materi->pelajaran_id);
        $kelas = Kelas::all();
        return view('guru.materi.edit', compact('materi', 'pelajaran', 'kelas'));
    }

    // Menyimpan perubahan materi
    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);
        if (Auth::user()->role != 2 || Auth::id() != $materi->guru_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'kelas_id'    => 'required|exists:kelas,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'nullable|file|mimes:pdf,mp4,ppt,pptx',
        ]);

        $data = $request->only('kelas_id', 'title', 'description');

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
                Storage::disk('public')->delete($materi->file_path);
            }
            // Upload file baru
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('materi', $filename, 'public');

            // Pastikan file berhasil diunggah
            if (!$path) {
                return redirect()->back()->with('error', 'Gagal mengunggah file.');
            }

            $data['file_path'] = $path;
            $data['file_type'] = $file->getClientMimeType();
        }

        $materi->update($data);

        return redirect()->route('guru.materi.show', $materi->pelajaran_id)
                         ->with('success', 'Materi berhasil diperbarui.');
    }

    // Menghapus materi
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        if (Auth::user()->role != 2 || Auth::id() != $materi->guru_id) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus file dari storage
        if ($materi->file_path) {
            Storage::disk('public')->delete($materi->file_path);
        }

        $pelajaranId = $materi->pelajaran_id;
        $materi->delete();

        return redirect()->route('guru.materi.show', $pelajaranId)
                         ->with('success', 'Materi berhasil dihapus.');
    }

    // Download materi
    public function download($id)
    {
        $materi = Materi::findOrFail($id);

        // Periksa apakah file ada
        if (!Storage::disk('public')->exists($materi->file_path)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        // Ambil ekstensi file dari nama file
        $extension = pathinfo($materi->file_path, PATHINFO_EXTENSION);

        // Buat nama file untuk diunduh dengan menyertakan ekstensi
        $downloadFileName = $materi->title . '.' . $extension;

        // Dapatkan path lengkap file
        $filePath = Storage::disk('public')->path($materi->file_path);

        // Set header untuk response
        $headers = [
            'Content-Type' => mime_content_type($filePath), // Tipe MIME file
            'Content-Disposition' => 'attachment; filename="' . $downloadFileName . '"',
        ];

        return response()->download($filePath, $downloadFileName, $headers);
    }

    // Menampilkan daftar pelajaran untuk murid
    public function indexPelajaranMurid()
    {
        $pelajaran = Pelajaran::paginate(10);
        return view('murid.materi.index', compact('pelajaran'));
    }

    // Menampilkan daftar materi untuk pelajaran tertentu (murid)
    public function materiByPelajaranMurid($pelajaranId)
    {
        $pelajaran = Pelajaran::findOrFail($pelajaranId);
        $materi = Materi::with('guru', 'kelas')
                    ->where('pelajaran_id', $pelajaranId)
                    ->latest()
                    ->paginate(10);
        return view('murid.materi.show', compact('pelajaran', 'materi'));
    }
}

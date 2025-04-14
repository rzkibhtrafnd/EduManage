<?php

namespace App\Http\Controllers;

use App\Models\Pelajaran;
use App\Models\Materi;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MateriController extends Controller
{
    // ===== GURU SECTION =====

    public function indexPelajaran()
    {
        $guruId = Auth::id();

        $pelajaran = Pelajaran::whereHas('jadwal', function ($query) use ($guruId) {
            $query->where('guru_id', $guruId);
        })->paginate(10);

        return view('guru.materi.index', compact('pelajaran'));
    }

    public function materiByPelajaran($pelajaranId)
    {
        $guruId = Auth::id();
        $pelajaran = Pelajaran::findOrFail($pelajaranId);

        $materi = Materi::with('guru', 'kelas')
            ->where('pelajaran_id', $pelajaranId)
            ->where('guru_id', $guruId)
            ->latest()
            ->paginate(10);

        $kelas = Kelas::all(); // Opsional: bisa filter berdasarkan guru

        return view('guru.materi.show', compact('pelajaran', 'materi', 'kelas'));
    }

    public function create($pelajaranId)
    {
        $this->authorizeGuru();

        $pelajaran = Pelajaran::findOrFail($pelajaranId);
        $guruId = Auth::id();

        $kelas = Kelas::whereHas('jadwal', function ($query) use ($guruId, $pelajaranId) {
            $query->where('guru_id', $guruId)
                  ->where('pelajaran_id', $pelajaranId);
        })->get();

        return view('guru.materi.create', compact('pelajaran', 'kelas'));
    }

    public function store(Request $request, $pelajaranId)
    {
        $this->authorizeGuru();

        $guruId = Auth::id();

        $allowedKelas = Kelas::whereHas('jadwal', function ($query) use ($guruId, $pelajaranId) {
            $query->where('guru_id', $guruId)
                  ->where('pelajaran_id', $pelajaranId);
        })->pluck('id')->toArray();

        $request->validate([
            'kelas_id'    => ['required', Rule::in($allowedKelas)],
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'required|file|mimes:pdf,mp4,ppt,pptx',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('materi', $filename, 'public');

        if (!$path) {
            return back()->with('error', 'Gagal mengunggah file.');
        }

        Materi::create([
            'pelajaran_id' => $pelajaranId,
            'kelas_id'     => $request->kelas_id,
            'guru_id'      => $guruId,
            'title'        => $request->title,
            'description'  => $request->description,
            'file_path'    => $path,
            'file_type'    => $file->getClientMimeType(),
        ]);

        return redirect()->route('guru.materi.show', $pelajaranId)
                         ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $materi = Materi::findOrFail($id);
        $this->authorizeGuru($materi->guru_id);

        $pelajaran = Pelajaran::findOrFail($materi->pelajaran_id);
        $kelas = Kelas::all();

        return view('guru.materi.edit', compact('materi', 'pelajaran', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);
        $this->authorizeGuru($materi->guru_id);

        $request->validate([
            'kelas_id'    => 'required|exists:kelas,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'nullable|file|mimes:pdf,mp4,ppt,pptx',
        ]);

        $data = $request->only('kelas_id', 'title', 'description');

        if ($request->hasFile('file')) {
            if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
                Storage::disk('public')->delete($materi->file_path);
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('materi', $filename, 'public');

            if (!$path) {
                return back()->with('error', 'Gagal mengunggah file.');
            }

            $data['file_path'] = $path;
            $data['file_type'] = $file->getClientMimeType();
        }

        $materi->update($data);

        return redirect()->route('guru.materi.show', $materi->pelajaran_id)
                         ->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        $this->authorizeGuru($materi->guru_id);

        if ($materi->file_path) {
            Storage::disk('public')->delete($materi->file_path);
        }

        $materi->delete();

        return redirect()->route('guru.materi.show', $materi->pelajaran_id)
                         ->with('success', 'Materi berhasil dihapus.');
    }

    public function download($id)
    {
        $materi = Materi::findOrFail($id);

        if (!Storage::disk('public')->exists($materi->file_path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        $extension = pathinfo($materi->file_path, PATHINFO_EXTENSION);
        $fileName = $materi->title . '.' . $extension;
        $filePath = Storage::disk('public')->path($materi->file_path);

        return response()->download($filePath, $fileName, [
            'Content-Type'        => mime_content_type($filePath),
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    // ===== MURID SECTION =====

    public function indexPelajaranMurid()
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();
        $kelasId = $siswa->kelas_id;

        $pelajaran = Pelajaran::whereHas('jadwal', function ($query) use ($kelasId) {
                $query->where('kelas_id', $kelasId);
            })
            ->withCount(['materis' => function ($query) use ($kelasId) {
                $query->where('kelas_id', $kelasId);
            }])
            ->orderBy('nama')
            ->paginate(10);

        return view('murid.materi.index', compact('pelajaran'));
    }

    public function materiByPelajaranMurid($pelajaranId)
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();
        $kelasId = $siswa->kelas_id;
        $pelajaran = Pelajaran::findOrFail($pelajaranId);

        $materis = Materi::with(['guru', 'pelajaran'])
            ->where('pelajaran_id', $pelajaranId)
            ->where('kelas_id', $kelasId)
            ->latest()
            ->paginate(10);

        return view('murid.materi.show', compact('pelajaran', 'materis'));
    }

    // ===== PRIVATE HELPERS =====

    private function authorizeGuru($ownerId = null)
    {
        if (Auth::user()->role != 2 || ($ownerId && Auth::id() != $ownerId)) {
            abort(403, 'Unauthorized action.');
        }
    }
}

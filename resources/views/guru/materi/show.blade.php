@extends('layouts.guruapp')

@section('title', 'Materi Pelajaran: ' . $pelajaran->nama)

@section('content')
<div class="container mx-auto mt-8">
  <div class="bg-white shadow-lg rounded-lg p-6">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4">
      <h2 class="text-2xl font-bold text-gray-800 mb-2 md:mb-0">Materi Pelajaran: {{ $pelajaran->nama }}</h2>
      <div class="flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0">
        <a href="{{ route('guru.materi.show', $pelajaran->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
          <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
        <a href="{{ route('guru.materi.create', $pelajaran->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
          <i class="fas fa-plus mr-2"></i> Tambah Materi
        </a>
      </div>
    </div>

    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
      </div>
    @endif

    <div class="overflow-x-auto">
      <table class="min-w-full text-left">
        <thead class="bg-gray-100 border-b">
          <tr>
            <th class="px-4 py-2">No.</th>
            <th class="px-4 py-2">Judul Materi</th>
            <th class="px-4 py-2">Deskripsi</th>
            <th class="px-4 py-2">Kelas</th>
            <th class="px-4 py-2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($materi as $item)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-2 border-t">{{ $loop->iteration }}</td>
            <td class="px-4 py-2 border-t">{{ $item->title }}</td>
            <td class="px-4 py-2 border-t">{{ $item->description }}</td>
            <td class="px-4 py-2 border-t">{{ $item->kelas->name }}</td>
            <td class="px-4 py-2 border-t flex flex-col md:flex-row md:space-x-2 space-y-1 md:space-y-0">
              <a href="{{ route('guru.materi.download', $item->id) }}" class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                Unduh
              </a>
              <a href="{{ route('guru.materi.edit', $item->id) }}" class="inline-flex items-center px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                Edit
              </a>
              <form action="{{ route('guru.materi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus materi ini?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                  Hapus
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="text-center px-4 py-2 border-t">Tidak ada materi untuk pelajaran ini.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <!-- Pagination -->
    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 mt-4">
      <div class="flex flex-1 justify-between sm:hidden">
        @if($materi->previousPageUrl())
          <a href="{{ $materi->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
        @endif
        @if($materi->nextPageUrl())
          <a href="{{ $materi->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
        @endif
      </div>
      <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <p class="text-sm text-gray-700">
          Menampilkan <span class="font-medium">{{ $materi->firstItem() }}</span>
          sampai <span class="font-medium">{{ $materi->lastItem() }}</span>
          dari <span class="font-medium">{{ $materi->total() }}</span> data
        </p>
        <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
          @if($materi->previousPageUrl())
            <a href="{{ $materi->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-gray-400 ring-1 ring-gray-300 hover:bg-gray-50">
              <span class="sr-only">Previous</span>&laquo;
            </a>
          @endif
          @for ($i = 1; $i <= $materi->lastPage(); $i++)
            <a href="{{ $materi->url($i) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold {{ $materi->currentPage() == $i ? 'bg-indigo-600 text-white' : 'text-gray-900 ring-1 ring-gray-300 hover:bg-gray-50' }}">
              {{ $i }}
            </a>
          @endfor
          @if($materi->nextPageUrl())
            <a href="{{ $materi->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-gray-400 ring-1 ring-gray-300 hover:bg-gray-50">
              <span class="sr-only">Next</span>&raquo;
            </a>
          @endif
        </nav>
      </div>
    </div>
  </div>
</div>
@endsection

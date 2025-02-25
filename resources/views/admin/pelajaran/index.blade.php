@extends('layouts.adminapp')

@section('title', 'Data Pelajaran')

@section('content')
<div class="container mx-auto mt-8">
  <div class="bg-white shadow-lg rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-bold text-gray-800">Data Pelajaran</h2>
      <a href="{{ route('pelajaran.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
        Tambah Pelajaran
      </a>
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
            <th class="px-4 py-2">Nama Pelajaran</th>
            <th class="px-4 py-2">Deskripsi</th>
            <th class="px-4 py-2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($pelajaran as $item)
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-2 border-t">{{ $loop->iteration }}</td>
              <td class="px-4 py-2 border-t">{{ $item->nama }}</td>
              <td class="px-4 py-2 border-t">{{ $item->deskripsi }}</td>
              <td class="px-4 py-2 border-t flex space-x-2">
                <a href="{{ route('pelajaran.edit', $item->id) }}" class="text-yellow-500 hover:text-yellow-600">Edit</a>
                <form action="{{ route('pelajaran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pelajaran ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-500 hover:text-red-600">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center px-4 py-2 border-t">Tidak ada data pelajaran.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
        <!-- Pagination -->
    <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 mt-4">
      <div class="flex flex-1 justify-between sm:hidden">
        @if($pelajaran->previousPageUrl())
          <a href="{{ $pelajaran->previousPageUrl() }}" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
        @endif
        @if($pelajaran->nextPageUrl())
          <a href="{{ $pelajaran->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
        @endif
      </div>
      <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <p class="text-sm text-gray-700">
          Menampilkan <span class="font-medium">{{ $pelajaran->firstItem() }}</span>
          sampai <span class="font-medium">{{ $pelajaran->lastItem() }}</span>
          dari <span class="font-medium">{{ $pelajaran->total() }}</span> data
        </p>
        <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
          @if($pelajaran->previousPageUrl())
            <a href="{{ $pelajaran->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-gray-400 ring-1 ring-gray-300 hover:bg-gray-50">
              <span class="sr-only">Previous</span>&laquo;
            </a>
          @endif
          @for ($i = 1; $i <= $pelajaran->lastPage(); $i++)
            <a href="{{ $pelajaran->url($i) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold {{ $pelajaran->currentPage() == $i ? 'bg-indigo-600 text-white' : 'text-gray-900 ring-1 ring-gray-300 hover:bg-gray-50' }}">
              {{ $i }}
            </a>
          @endfor
          @if($pelajaran->nextPageUrl())
            <a href="{{ $pelajaran->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 text-gray-400 ring-1 ring-gray-300 hover:bg-gray-50">
              <span class="sr-only">Next</span>&raquo;
            </a>
          @endif
        </nav>
      </div>
    </div>
  </div>
</div>
@endsection

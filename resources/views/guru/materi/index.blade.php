@extends('layouts.guruapp')

@section('title', 'Manajemen Materi')

@section('content')
<div class="container mx-auto mt-8">
  <div class="bg-white shadow-lg rounded-lg p-6">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4">
      <h2 class="text-2xl font-bold text-gray-800 mb-2 md:mb-0">Daftar Pelajaran</h2>
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
            <th class="px-4 py-2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($pelajaran as $item)
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-2 border-t">{{ $loop->iteration }}</td>
            <td class="px-4 py-2 border-t">{{ $item->nama }}</td>
            <td class="px-4 py-2 border-t">
              <a href="{{ route('guru.materi.show', $item->id) }}" class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                Lihat Materi
              </a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="3" class="text-center px-4 py-2 border-t">Tidak ada pelajaran.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

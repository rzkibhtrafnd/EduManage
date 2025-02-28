@extends('layouts.adminapp')

@section('title', 'Detail Jadwal Kelas')

@section('content')
<div class="container mx-auto mt-8">
  <div class="bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Jadwal Kelas: {{ $kelas->name }}</h2>
    <a href="{{ route('jadwal.index') }}" class="text-blue-600 hover:underline mb-4 block">Kembali ke Daftar Kelas</a>

    <div class="overflow-x-auto">
      <table class="min-w-full text-left border">
        <thead class="bg-gray-100 border-b">
          <tr>
            <th class="px-4 py-2">Hari</th>
            <th class="px-4 py-2">Jam</th>
            <th class="px-4 py-2">Mata Pelajaran</th>
            <th class="px-4 py-2">Guru</th>
          </tr>
        </thead>
        <tbody>
          @forelse($jadwal as $item)
            <tr class="hover:bg-gray-50 border-t">
              <td class="px-4 py-2">{{ $item->hari }}</td>
              <td class="px-4 py-2">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
              <td class="px-4 py-2">{{ optional($item->pelajaran)->nama ?? 'Tidak Ada' }}</td>
              <td class="px-4 py-2">{{ optional($item->user)->name ?? 'Tidak Ada' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center px-4 py-2 border-t">Tidak ada jadwal untuk kelas ini.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

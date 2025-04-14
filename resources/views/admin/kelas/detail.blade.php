@extends('layouts.adminapp')

@section('title', 'Detail Kelas')

@section('content')
<div class="w-full px-6 py-8 bg-white rounded-xl shadow-lg">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Detail Kelas</h1>
    <a href="{{ route('kelas.index') }}" class="text-blue-600 hover:underline">Kembali ke Daftar Kelas</a>
  </div>

  <div class="mb-6">
    <h2 class="text-xl font-semibold">{{ $kelas->name }}</h2>
    <p class="text-gray-600">{{ $kelas->description }}</p>
  </div>

  <!-- Tampilan berdampingan full halaman -->
  <div class="flex flex-col lg:flex-row gap-8">
    
    <!-- Daftar Siswa -->
    <div class="w-full lg:w-1/2">
      <h3 class="text-lg font-semibold mb-2">Daftar Siswa</h3>
      @if($kelas->students->count() > 0)
        <div class="overflow-x-auto">
          <table class="w-full text-left border">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-4 py-2">No.</th>
                <th class="px-4 py-2">Nama Siswa</th>
                <th class="px-4 py-2">NISN</th>
              </tr>
            </thead>
            <tbody>
              @foreach($kelas->students as $index => $student)
              <tr class="hover:bg-gray-50 border-t">
                <td class="px-4 py-2">{{ $index + 1 }}</td>
                <td class="px-4 py-2">{{ $student->user->name ?? 'N/A' }}</td>
                <td class="px-4 py-2">{{ $student->NISN }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <p class="text-gray-600">Belum ada siswa yang terdaftar di kelas ini.</p>
      @endif
    </div>

    <!-- Jadwal Kelas -->
    <div class="w-full lg:w-1/2">
      <h3 class="text-lg font-semibold mb-2">Jadwal Kelas</h3>
      @if($kelas->jadwal->count() > 0)
        <div class="overflow-x-auto">
          <table class="w-full text-left border">
            <thead class="bg-gray-100">
              <tr>
                <th class="px-4 py-2">Hari</th>
                <th class="px-4 py-2">Jam</th>
                <th class="px-4 py-2">Mata Pelajaran</th>
                <th class="px-4 py-2">Guru</th>
              </tr>
            </thead>
            <tbody>
              @foreach($kelas->jadwal as $jadwal)
              <tr class="hover:bg-gray-50 border-t">
                <td class="px-4 py-2">{{ $jadwal->hari }}</td>
                <td class="px-4 py-2">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                <td class="px-4 py-2">{{ optional($jadwal->pelajaran)->nama ?? 'N/A' }}</td>
                <td class="px-4 py-2">{{ optional($jadwal->user)->name ?? 'N/A' }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <p class="text-gray-600">Belum ada jadwal yang tersedia untuk kelas ini.</p>
      @endif
    </div>
  </div>
</div>
@endsection

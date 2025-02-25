@extends('layouts.adminapp')

@section('title', 'Detail Kelas')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-lg">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Detail Kelas</h1>
    <a href="{{ route('kelas.index') }}" class="text-blue-600 hover:underline">Kembali ke Daftar Kelas</a>
  </div>
  <div class="mb-6">
    <h2 class="text-xl font-semibold">{{ $kelas->name }}</h2>
    <p class="text-gray-600">{{ $kelas->description }}</p>
  </div>
  <div>
    <h3 class="text-lg font-semibold mb-2">Daftar Siswa</h3>
    @if($kelas->students->count() > 0)
      <table class="min-w-full text-left border">
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
    @else
      <p class="text-gray-600">Belum ada siswa yang terdaftar di kelas ini.</p>
    @endif
  </div>
</div>
@endsection

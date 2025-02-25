@extends('layouts.adminapp')

@section('title', 'Detail Siswa')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Detail Siswa</h1>
    <a href="{{ route('siswa.index') }}" class="text-blue-600 hover:underline">Kembali ke Daftar Siswa</a>
  </div>
  <div class="overflow-x-auto">
    <table class="min-w-full text-left">
      <tr class="border-b">
        <th class="px-4 py-2 w-1/3">Nama</th>
        <td class="px-4 py-2">{{ $siswa->user->name }}</td>
      </tr>
      <tr class="border-b">
        <th class="px-4 py-2">Email</th>
        <td class="px-4 py-2">{{ $siswa->user->email }}</td>
      </tr>
      <tr class="border-b">
        <th class="px-4 py-2">NISN</th>
        <td class="px-4 py-2">{{ $siswa->NISN }}</td>
      </tr>
      <tr class="border-b">
        <th class="px-4 py-2">Alamat</th>
        <td class="px-4 py-2">{{ $siswa->alamat }}</td>
      </tr>
      <tr class="border-b">
        <th class="px-4 py-2">Jenis Kelamin</th>
        <td class="px-4 py-2">{{ $siswa->jenis_kelamin }}</td>
      </tr>
      <tr class="border-b">
        <th class="px-4 py-2">Telepon</th>
        <td class="px-4 py-2">{{ $siswa->telepon }}</td>
      </tr>
      <tr class="border-b">
        <th class="px-4 py-2">Kelas</th>
        <td class="px-4 py-2">{{ $siswa->kelas->name }}</td>
      </tr>
      <tr>
        <th class="px-4 py-2">Foto</th>
        <td class="px-4 py-2">
          @if($siswa->img)
            <img src="{{ asset('storage/' . $siswa->img) }}" alt="Foto Siswa" class="w-40">
          @else
            Tidak ada foto
          @endif
        </td>
      </tr>
    </table>
  </div>
</div>
@endsection

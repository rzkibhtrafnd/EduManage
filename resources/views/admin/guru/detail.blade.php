@extends('layouts.adminapp')

@section('title', 'Detail Guru')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg">
  <div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Detail Guru</h2>
    <a href="{{ route('guru.index') }}" class="text-blue-600 hover:underline">Kembali ke Daftar Guru</a>
  </div>
  <div class="overflow-x-auto">
    <table class="min-w-full text-left">
      <tr class="border-b">
        <th class="px-4 py-2 w-1/3">Nama</th>
        <td class="px-4 py-2">{{ $guru->user->name }}</td>
      </tr>
      <tr class="border-b">
        <th class="px-4 py-2">Email</th>
        <td class="px-4 py-2">{{ $guru->user->email }}</td>
      </tr>
      <tr class="border-b">
        <th class="px-4 py-2">NIP</th>
        <td class="px-4 py-2">{{ $guru->NIP }}</td>
      </tr>
      <tr class="border-b">
        <th class="px-4 py-2">Alamat</th>
        <td class="px-4 py-2">{{ $guru->alamat }}</td>
      </tr>
      <tr class="border-b">
        <th class="px-4 py-2">Jenis Kelamin</th>
        <td class="px-4 py-2">{{ $guru->jenis_kelamin }}</td>
      </tr>
      <tr class="border-b">
        <th class="px-4 py-2">Telepon</th>
        <td class="px-4 py-2">{{ $guru->telepon }}</td>
      </tr>
      <tr>
        <th class="px-4 py-2">Foto</th>
        <td class="px-4 py-2">
          @if($guru->img)
            <img src="{{ asset('storage/' . $guru->img) }}" alt="Foto Guru" class="w-40">
          @else
            Tidak ada foto
          @endif
        </td>
      </tr>
    </table>
  </div>
</div>
@endsection

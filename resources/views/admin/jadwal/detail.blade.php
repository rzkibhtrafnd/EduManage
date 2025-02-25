@extends('layouts.adminapp')

@section('title', 'Detail Jadwal')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-lg">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Detail Jadwal</h1>
    <a href="{{ route('jadwal.index') }}" class="text-blue-600 hover:underline">Kembali ke Daftar Jadwal</a>
  </div>
  <div class="mb-6">
    <h2 class="text-xl font-semibold">Kelas: {{ $jadwal->kelas->name ?? 'N/A' }}</h2>
    <p class="text-gray-600">Guru: {{ $jadwal->user->name ?? 'N/A' }}</p>
    <p class="text-gray-600">Pelajaran: {{ $jadwal->pelajaran->nama ?? 'N/A' }}</p>
    <p class="text-gray-600">Hari: {{ $jadwal->hari }}</p>
    <p class="text-gray-600">Jam Mulai: {{ $jadwal->jam_mulai }}</p>
    <p class="text-gray-600">Jam Selesai: {{ $jadwal->jam_selesai }}</p>
  </div>
</div>
@endsection

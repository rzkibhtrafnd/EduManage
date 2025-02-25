@extends('layouts.adminapp')

@section('title', 'Edit Jadwal')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-lg">
  <div class="flex flex-col md:flex-row justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Jadwal</h1>
    <a href="{{ route('jadwal.index') }}" class="text-blue-600 hover:underline">Kembali ke Daftar Jadwal</a>
  </div>
  <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <div>
      <label for="kelas_id" class="block text-gray-700 font-medium mb-1">Kelas</label>
      <select name="kelas_id" id="kelas_id" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('kelas_id') border-red-500 @enderror">
        <option value="">Pilih Kelas</option>
        @foreach($kelas as $kelasItem)
          <option value="{{ $kelasItem->id }}" {{ old('kelas_id', $jadwal->kelas_id) == $kelasItem->id ? 'selected' : '' }}>
            {{ $kelasItem->name }}
          </option>
        @endforeach
      </select>
      @error('kelas_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="guru_id" class="block text-gray-700 font-medium mb-1">Guru</label>
      <select name="guru_id" id="guru_id" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('guru_id') border-red-500 @enderror">
        <option value="">Pilih Guru</option>
        @foreach($guru as $guruItem)
          <option value="{{ $guruItem->id }}" {{ old('guru_id', $jadwal->guru_id) == $guruItem->id ? 'selected' : '' }}>
            {{ $guruItem->name }}
          </option>
        @endforeach
      </select>
      @error('guru_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="pelajaran_id" class="block text-gray-700 font-medium mb-1">Pelajaran</label>
      <select name="pelajaran_id" id="pelajaran_id" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('pelajaran_id') border-red-500 @enderror">
        <option value="">Pilih Pelajaran</option>
        @foreach($pelajaran as $pelajaranItem)
          <option value="{{ $pelajaranItem->id }}" {{ old('pelajaran_id', $jadwal->pelajaran_id) == $pelajaranItem->id ? 'selected' : '' }}>
            {{ $pelajaranItem->nama }}
          </option>
        @endforeach
      </select>
      @error('pelajaran_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="hari" class="block text-gray-700 font-medium mb-1">Hari</label>
      <select name="hari" id="hari" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('hari') border-red-500 @enderror">
        <option value="">Pilih Hari</option>
        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
          <option value="{{ $day }}" {{ old('hari', $jadwal->hari) == $day ? 'selected' : '' }}>
            {{ $day }}
          </option>
        @endforeach
      </select>
      @error('hari')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label for="jam_mulai" class="block text-gray-700 font-medium mb-1">Jam Mulai</label>
        <input type="time" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai', $jadwal->jam_mulai) }}" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('jam_mulai') border-red-500 @enderror">
        @error('jam_mulai')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label for="jam_selesai" class="block text-gray-700 font-medium mb-1">Jam Selesai</label>
        <input type="time" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai', $jadwal->jam_selesai) }}" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('jam_selesai') border-red-500 @enderror">
        @error('jam_selesai')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-end space-y-4 md:space-y-0 md:space-x-4">
      <button type="reset" class="w-full md:w-auto px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
        Reset
      </button>
      <button type="submit" class="w-full md:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
        Update
      </button>
    </div>
  </form>
</div>
@endsection

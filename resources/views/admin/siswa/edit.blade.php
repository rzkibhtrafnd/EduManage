@extends('layouts.adminapp')

@section('title', 'Edit Siswa')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg">
  <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Siswa</h1>
    <a href="{{ route('siswa.index') }}" class="text-blue-600 hover:underline">Kembali ke Daftar Siswa</a>
  </div>
  <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Kolom Kiri -->
      <div class="space-y-4">
        <div>
          <label for="name" class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
          <input type="text" name="name" id="name" value="{{ old('name', $siswa->user->name) }}" required
            class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror">
          @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="email" class="block text-gray-700 font-medium mb-1">Alamat Email</label>
          <input type="email" name="email" id="email" value="{{ old('email', $siswa->user->email) }}" required
            class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('email') border-red-500 @enderror">
          @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="password" class="block text-gray-700 font-medium mb-1">
            Password <span class="text-sm text-gray-500">(kosongkan jika tidak ingin mengubah)</span>
          </label>
          <input type="password" name="password" id="password" placeholder="Minimal 8 karakter"
            class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('password') border-red-500 @enderror">
          @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>
      <!-- Kolom Kanan -->
      <div class="space-y-4">
        <div>
          <label for="NISN" class="block text-gray-700 font-medium mb-1">Nomor Induk Siswa Nasional (NISN)</label>
          <input type="text" name="NISN" id="NISN" value="{{ old('NISN', $siswa->NISN) }}" required
            class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('NISN') border-red-500 @enderror">
          @error('NISN')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="jenis_kelamin" class="block text-gray-700 font-medium mb-1">Jenis Kelamin</label>
          <select name="jenis_kelamin" id="jenis_kelamin" required
            class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500">
            <option value="Laki-laki" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
          </select>
          @error('jenis_kelamin')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="telepon" class="block text-gray-700 font-medium mb-1">Nomor Telepon</label>
          <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $siswa->telepon) }}" required
            class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500">
        </div>
      </div>
    </div>
    <div>
      <label for="kelas_id" class="block text-gray-700 font-medium mb-1">Kelas</label>
      <select name="kelas_id" id="kelas_id" required
        class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500">
        <option value="">Pilih Kelas</option>
        @foreach($kelas as $k)
          <option value="{{ $k->id }}" {{ old('kelas_id', $siswa->kelas_id) == $k->id ? 'selected' : '' }}>{{ $k->name }}</option>
        @endforeach
      </select>
    </div>
    <div>
      <label for="alamat" class="block text-gray-700 font-medium mb-1">Alamat Lengkap</label>
      <textarea name="alamat" id="alamat" rows="3" required
        class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500">{{ old('alamat', $siswa->alamat) }}</textarea>
    </div>
    <div>
      <label for="img" class="block text-gray-700 font-medium mb-1">Foto</label>
      <input type="file" name="img" id="img"
        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors duration-200">
      @if($siswa->img)
        <img src="{{ asset('storage/' . $siswa->img) }}" alt="Foto siswa" class="mt-2 w-40">
      @endif
      @error('img')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>
    <div class="flex justify-end space-x-4 border-t pt-6">
      <button type="reset" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg">Reset</button>
      <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg">Simpan Siswa</button>
    </div>
  </form>
</div>
@endsection

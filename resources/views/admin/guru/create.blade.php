@extends('layouts.adminapp')

@section('title', 'Tambah Guru')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg">
  <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Tambah Guru Baru</h1>
    <a href="{{ route('guru.index') }}" class="text-blue-600 hover:underline">Kembali ke Daftar Guru</a>
  </div>
  <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Kolom Kiri -->
      <div class="space-y-4">
        <div>
          <label for="name" class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
          <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror">
          @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="email" class="block text-gray-700 font-medium mb-1">Alamat Email</label>
          <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="contoh@sekolah.id" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('email') border-red-500 @enderror">
          @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
          <input type="password" name="password" id="password" placeholder="Minimal 8 karakter" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('password') border-red-500 @enderror">
          @error('password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>
      <!-- Kolom Kanan -->
      <div class="space-y-4">
        <div>
          <label for="NIP" class="block text-gray-700 font-medium mb-1">Nomor Induk Pegawai (NIP)</label>
          <input type="text" name="NIP" id="NIP" value="{{ old('NIP') }}" placeholder="Masukkan NIP yang valid" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('NIP') border-red-500 @enderror">
          @error('NIP')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="jenis_kelamin" class="block text-gray-700 font-medium mb-1">Jenis Kelamin</label>
          <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('jenis_kelamin') border-red-500 @enderror">
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
          @error('jenis_kelamin')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
        <div>
          <label for="telepon" class="block text-gray-700 font-medium mb-1">Nomor Telepon</label>
          <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}" placeholder="Contoh: 0812-3456-7890" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('telepon') border-red-500 @enderror">
          @error('telepon')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>
    </div>
    <div>
      <label for="alamat" class="block text-gray-700 font-medium mb-1">Alamat Lengkap</label>
      <textarea name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat lengkap" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
      @error('alamat')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>
    <div>
      <label for="img" class="block text-gray-700 font-medium mb-1">Upload Foto Profil</label>
      <input type="file" name="img" id="img" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors duration-200">
      @error('img')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>
    <div class="flex flex-col md:flex-row justify-end space-y-4 md:space-y-0 md:space-x-4 border-t pt-6">
      <button type="reset" class="w-full md:w-auto px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Reset Form</button>
      <button type="submit" class="w-full md:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan Data Guru</button>
    </div>
  </form>
</div>
@endsection

@extends('layouts.adminapp')

@section('title', 'Tambah Admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg">
  <h1 class="text-2xl font-bold mb-6 text-gray-800">Tambah Admin</h1>

  <form action="{{ route('admin.store') }}" method="POST" class="space-y-6">
    @csrf

    <div>
      <label for="name" class="block text-gray-700 font-medium mb-1">Nama</label>
      <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500">
      @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
      <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500">
      @error('email')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
      <input type="password" name="password" id="password" required class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500">
      @error('password')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Konfirmasi Password</label>
      <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500">
    </div>

    <div class="flex justify-end space-x-3">
      <a href="{{ route('admin.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">Batal</a>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
    </div>
  </form>
</div>
@endsection

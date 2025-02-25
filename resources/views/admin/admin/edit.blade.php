@extends('layouts.adminapp')

@section('title', 'Edit Admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg">
  <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Admin</h1>

  <form action="{{ route('admin.update', $admin->id) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <div>
      <label for="name" class="block text-gray-700 font-medium mb-1">Nama</label>
      <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}" required class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500">
      @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
      <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" required class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500">
      @error('email')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="password" class="block text-gray-700 font-medium mb-1">
        Password <span class="text-sm text-gray-500">(kosongkan jika tidak ingin mengubah)</span>
      </label>
      <input type="password" name="password" id="password" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500">
      @error('password')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="flex space-x-4">
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan Perubahan</button>
      <a href="{{ route('admin.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">Kembali</a>
    </div>
  </form>
</div>
@endsection

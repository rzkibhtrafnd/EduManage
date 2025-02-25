@extends('layouts.adminapp')

@section('title', 'Edit Kelas')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg">
  <div class="flex flex-col md:flex-row justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Kelas</h1>
    <a href="{{ route('kelas.index') }}" class="text-blue-600 hover:underline">Kembali ke Daftar Kelas</a>
  </div>
  <form action="{{ route('kelas.update', $kelas->id) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')
    <div>
      <label for="name" class="block text-gray-700 font-medium mb-1">Nama Kelas</label>
      <input type="text" name="name" id="name" value="{{ old('name', $kelas->name) }}" placeholder="Masukkan nama kelas" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror">
      @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
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

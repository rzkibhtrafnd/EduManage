@extends('layouts.guruapp')

@section('title', 'Tambah Materi - ' . $pelajaran->nama)

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-lg">
  <div class="flex justify-between items-center mb-8">
    <h1 class="text-2xl font-bold text-gray-800">Tambah Materi untuk {{ $pelajaran->nama }}</h1>
    <a href="{{ route('guru.materi.show', $pelajaran->id) }}" class="text-gray-600 hover:text-gray-800">
      <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
  </div>

  <form action="{{ route('guru.materi.store', $pelajaran->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <div>
      <label for="kelas_id" class="block text-gray-700 font-medium mb-1">Kelas</label>
      <select name="kelas_id" id="kelas_id" required class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500">
        <option value="">-- Pilih Kelas --</option>
        @foreach($kelas as $k)
          <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>{{ $k->name }}</option>
        @endforeach
      </select>
      @error('kelas_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="title" class="block text-gray-700 font-medium mb-1">Judul Materi</label>
      <input type="text" name="title" id="title" value="{{ old('title') }}" required 
             class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500">
      @error('title')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="description" class="block text-gray-700 font-medium mb-1">Deskripsi</label>
      <textarea name="description" id="description" rows="4"
                class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:border-blue-500">{{ old('description') }}</textarea>
      @error('description')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="file" class="block text-gray-700 font-medium mb-1">File Materi (PDF, Video, PPT)</label>
      <input type="file" name="file" id="file" required 
             class="w-full border border-gray-300 px-4 py-2 rounded-lg file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
      @error('file')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <div class="flex justify-end space-x-3">
      <a href="{{ route('guru.materi.show', $pelajaran->id) }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">
        Batal
      </a>
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
        <i class="fas fa-save mr-2"></i> Simpan
      </button>
    </div>
  </form>
</div>
@endsection
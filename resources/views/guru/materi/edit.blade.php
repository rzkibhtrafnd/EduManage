@extends('layouts.guruapp')

@section('title', 'Edit Materi - ' . $pelajaran->nama)

@section('content')
<div class="container mx-auto mt-8">
  <div class="bg-white shadow-lg rounded-lg p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
      <h2 class="text-2xl font-bold text-gray-800 mb-2 md:mb-0">Edit Materi untuk {{ $pelajaran->nama }}</h2>
      <a href="{{ route('guru.materi.show', $pelajaran->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
      </a>
    </div>

    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('guru.materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="mb-4">
        <label for="kelas_id" class="block text-gray-700 font-semibold">Kelas</label>
        <select name="kelas_id" id="kelas_id" class="w-full border-gray-300 rounded-md p-2" required>
          <option value="">-- Pilih Kelas --</option>
          @foreach($kelas as $k)
            <option value="{{ $k->id }}" {{ $materi->kelas_id == $k->id ? 'selected' : '' }}>{{ $k->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-4">
        <label for="title" class="block text-gray-700 font-semibold">Judul Materi</label>
        <input type="text" name="title" id="title" value="{{ $materi->title }}" class="w-full border-gray-300 rounded-md p-2" required>
      </div>
      <div class="mb-4">
        <label for="description" class="block text-gray-700 font-semibold">Deskripsi</label>
        <textarea name="description" id="description" rows="4" class="w-full border-gray-300 rounded-md p-2">{{ $materi->description }}</textarea>
      </div>
      <div class="mb-4">
        <label for="file" class="block text-gray-700 font-semibold">File Materi (PDF, Video, PPT) - Kosongkan jika tidak ingin mengganti</label>
        <input type="file" name="file" id="file" class="w-full border-gray-300 rounded-md p-2">
      </div>
      <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
        <i class="fas fa-save mr-2"></i> Perbarui
      </button>
    </form>
  </div>
</div>
@endsection

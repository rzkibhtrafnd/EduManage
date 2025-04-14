<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $pelajaran = [
            ['nama' => 'Matematika', 'deskripsi' => 'Pelajaran tentang angka, logika, dan perhitungan.'],
            ['nama' => 'Bahasa Indonesia', 'deskripsi' => 'Pelajaran tentang bahasa nasional Indonesia.'],
            ['nama' => 'Bahasa Inggris', 'deskripsi' => 'Pelajaran bahasa asing internasional.'],
            ['nama' => 'Fisika', 'deskripsi' => 'Ilmu yang mempelajari gejala alam dan hukum fisika.'],
            ['nama' => 'Kimia', 'deskripsi' => 'Ilmu tentang zat dan reaksi kimia.'],
            ['nama' => 'Biologi', 'deskripsi' => 'Ilmu tentang makhluk hidup dan kehidupan.'],
            ['nama' => 'Sejarah', 'deskripsi' => 'Pelajaran tentang kejadian masa lalu dan perjuangan bangsa.'],
            ['nama' => 'Geografi', 'deskripsi' => 'Ilmu yang mempelajari bumi dan fenomena alam.'],
            ['nama' => 'Ekonomi', 'deskripsi' => 'Ilmu tentang kegiatan produksi, distribusi, dan konsumsi.'],
            ['nama' => 'Sosiologi', 'deskripsi' => 'Ilmu tentang perilaku sosial manusia.'],
            ['nama' => 'PKn', 'deskripsi' => 'Pendidikan Kewarganegaraan dan nilai-nilai pancasila.'],
            ['nama' => 'Seni Budaya', 'deskripsi' => 'Pelajaran tentang seni musik, tari, dan rupa.'],
            ['nama' => 'Pendidikan Jasmani', 'deskripsi' => 'Pelajaran olahraga dan kesehatan jasmani.'],
            ['nama' => 'TIK', 'deskripsi' => 'Teknologi Informasi dan Komunikasi.'],
            ['nama' => 'Bahasa Arab', 'deskripsi' => 'Pelajaran bahasa Arab dasar dan percakapan.'],
        ];

        DB::table('pelajaran')->insert($pelajaran);
    }
}

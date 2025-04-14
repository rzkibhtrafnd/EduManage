<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $jamList = [
            ['07:00', '08:30'],
            ['08:30', '10:00'],
            ['10:15', '11:45'],
            ['13:00', '14:30'],
            ['14:30', '16:00'],
        ];

        $kelasIds = DB::table('kelas')->pluck('id')->toArray();
        $pelajaranIds = DB::table('pelajaran')->pluck('id')->toArray();

        // Ambil hanya user_id dari guru yang tersimpan di tabel guru
        $guruIds = DB::table('guru')->pluck('user_id')->toArray();

        $jadwal = [];

        foreach ($kelasIds as $kelasId) {
            $usedComb = [];
            foreach ($hariList as $hari) {
                foreach ($jamList as $jam) {
                    $guruId = fake()->randomElement($guruIds);
                    $pelajaranId = fake()->randomElement($pelajaranIds);

                    // Hindari duplikat pelajaran di hari dan jam yang sama dalam satu kelas
                    $key = "$kelasId|$hari|{$jam[0]}";
                    if (in_array($key, $usedComb)) continue;

                    $jadwal[] = [
                        'kelas_id' => $kelasId,
                        'guru_id' => $guruId,
                        'pelajaran_id' => $pelajaranId,
                        'hari' => $hari,
                        'jam_mulai' => $jam[0],
                        'jam_selesai' => $jam[1],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $usedComb[] = $key;
                }
            }
        }

        DB::table('jadwal')->insert($jadwal);
    }
}

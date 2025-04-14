<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = [
            'X IPA 1',
            'X IPA 2',
            'X IPS 1',
            'X IPS 2',
            'XI IPA 1',
            'XI IPA 2',
            'XI IPS 1',
            'XI IPS 2',
            'XII IPA 1',
            'XII IPS 1',
        ];

        foreach ($kelas as $nama_kelas) {
            DB::table('kelas')->insert([
                'name' => $nama_kelas,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

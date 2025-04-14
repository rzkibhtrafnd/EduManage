<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\User;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $kelasIds = DB::table('kelas')->pluck('id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            $userId = DB::table('users')->insertGetId([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'role' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('siswa')->insert([
                'user_id' => $userId,
                'kelas_id' => $faker->randomElement($kelasIds),
                'NISN' => $faker->unique()->numerify('00############'),
                'alamat' => $faker->address,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'telepon' => $faker->phoneNumber,
                'img' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

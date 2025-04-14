<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Guru;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $gurus = [
            [
                'name' => 'Ki Hajar Dewantara',
                'email' => 'ki.hajar@sekolah.com',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Yogyakarta',
                'telepon' => '081234567001',
                'img' => 'ki_hajar.jpg',
            ],
            [
                'name' => 'R.A. Kartini',
                'email' => 'kartini@sekolah.com',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jepara, Jawa Tengah',
                'telepon' => '081234567002',
                'img' => 'kartini.jpg',
            ],
            [
                'name' => 'Ahmad Dahlan',
                'email' => 'dahlan@sekolah.com',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Yogyakarta',
                'telepon' => '081234567003',
                'img' => 'dahlan.jpg',
            ],
            [
                'name' => 'Dewi Sartika',
                'email' => 'dewi.sartika@sekolah.com',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Bandung, Jawa Barat',
                'telepon' => '081234567004',
                'img' => 'dewi_sartika.jpg',
            ],
            [
                'name' => 'Mohammad Natsir',
                'email' => 'natsir@sekolah.com',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Padang, Sumatera Barat',
                'telepon' => '081234567005',
                'img' => 'natsir.jpg',
            ],
            [
                'name' => 'Maria Ulfah',
                'email' => 'maria.ulfah@sekolah.com',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Serang, Banten',
                'telepon' => '081234567006',
                'img' => 'maria_ulfah.jpg',
            ],
            [
                'name' => 'Hamka',
                'email' => 'hamka@sekolah.com',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Bukittinggi, Sumatera Barat',
                'telepon' => '081234567007',
                'img' => 'hamka.jpg',
            ],
            [
                'name' => 'Cut Nyak Dhien',
                'email' => 'cut.nyak@sekolah.com',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Aceh Besar',
                'telepon' => '081234567008',
                'img' => 'cut_nyak.jpg',
            ],
            [
                'name' => 'Soetomo',
                'email' => 'soetomo@sekolah.com',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Surabaya, Jawa Timur',
                'telepon' => '081234567009',
                'img' => 'soetomo.jpg',
            ],
            [
                'name' => 'Rasuna Said',
                'email' => 'rasuna@sekolah.com',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Maninjau, Sumatera Barat',
                'telepon' => '081234567010',
                'img' => 'rasuna.jpg',
            ],
            [
                'name' => 'Tan Malaka',
                'email' => 'tan.malaka@sekolah.com',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Limapuluh Kota, Sumatera Barat',
                'telepon' => '081234567011',
                'img' => 'tan_malaka.jpg',
            ],
            [
                'name' => 'Moch. Yamin',
                'email' => 'yamin@sekolah.com',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Sawahlunto, Sumatera Barat',
                'telepon' => '081234567012',
                'img' => 'yamin.jpg',
            ],
            [
                'name' => 'Hasyim Asy\'ari',
                'email' => 'hasyim.asyari@sekolah.com',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jombang, Jawa Timur',
                'telepon' => '081234567013',
                'img' => 'hasyim.jpg',
            ],
            [
                'name' => 'Kartono',
                'email' => 'kartono@sekolah.com',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jepara, Jawa Tengah',
                'telepon' => '081234567014',
                'img' => 'kartono.jpg',
            ],
            [
                'name' => 'Sartono',
                'email' => 'sartono@sekolah.com',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Madiun, Jawa Timur',
                'telepon' => '081234567015',
                'img' => 'sartono.jpg',
            ],
        ];

        foreach ($gurus as $index => $guru) {
            $user = User::create([
                'name' => $guru['name'],
                'email' => $guru['email'],
                'password' => Hash::make('guru123'), 
                'role' => 2, 
            ]);

            Guru::create([
                'user_id' => $user->id,
                'NIP' => 'G' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'alamat' => $guru['alamat'],
                'jenis_kelamin' => $guru['jenis_kelamin'],
                'telepon' => $guru['telepon'],
                'img' => $guru['img'],
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = \faker\Factory::create('id_ID');

        $jurusanList = [
            'Teknik Informatika',
            'Sistem Informasi',
            'Teknik Elektro',
            'Manajemen',
            'Akuntansi',
            'Hukum',
            // Tambahkan jurusan lain sesuai kebutuhan
        ];
        for($i=1;$i<=10;$i++){
            $jurusan = $jurusanList[array_rand($jurusanList)];
            Mahasiswa::create([
                'nama'=>$faker->name,
                'nim'=>$faker->unique()->randomNumber,
                'jurusan'=>$jurusan,
                'semester'=>$faker->numberBetween(1,8),
            ]);
        }
    }
}

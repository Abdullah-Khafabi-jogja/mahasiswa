<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mahasiswas')->insert([
            [
                'nama' => 'John Doe',
                'nip' => '1234567890',
                'universitas' => 'Universitas A',
                'keterangan' => 'Lorem ipsum dolor sit amet',
            ],
            [
                'nama' => 'Jane Smith',
                'nip' => '0987654321',
                'universitas' => 'Universitas B',
                'keterangan' => 'Consectetur adipiscing elit',
            ],
            // Add more dummy data as needed
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KawasanSeeder extends Seeder
{
    public function run()
    {
        DB::table('kawasan')->insert([
            [
                'nama_kawasan' => 'Asia Timur',
                'id_direktorat' => 1, // Aspasaf
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_kawasan' => 'Asia Tenggara',
                'id_direktorat' => 1, // Aspasaf
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_kawasan' => 'Asia Selatan & Tengah',
                'id_direktorat' => 1, // Aspasaf
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_kawasan' => 'Amerika 1',
                'id_direktorat' => 2, // Amerop
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_kawasan' => 'Eropa 1',
                'id_direktorat' => 2, // Amerop
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_kawasan' => 'Eropa 2',
                'id_direktorat' => 2, // Amerop
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_kawasan' => 'Amerika 2',
                'id_direktorat' => 2, // Amerop
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}


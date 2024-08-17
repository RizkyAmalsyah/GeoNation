<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DirektoratSeeder extends Seeder
{
    public function run()
    {
        DB::table('direktorat')->insert([
            [
                'nama_direktorat' => 'Aspasaf',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_direktorat' => 'Amerop',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}


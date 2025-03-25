<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class levelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Level::Create( [
            'level' => 'Admin',

        ]);
       Level::Create( [

            'level' => 'Kepala Produksi',

        ]);
       Level::Create( [

            'level' => 'Operator Transfer'
        ]);

       Level::Create( [

            'level' => 'Operator Transfer Set'
        ]);

       Level::Create( [

            'level' => 'Operator Mesin Latex'
        ]);
    }
}

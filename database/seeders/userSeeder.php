<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create( [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'nip' => '00001',
            'level_id' => '1',
            'password' => Hash::make(123456789),

        ]);
        User::Create( [
            'name' => 'Kepala Produksi',
            'email' => 'kepalaproduksi@gmail.com',
            'nip' => '00002',
            'level_id' => '2',
            'password' => Hash::make(123456789),

        ]);
        User::Create( [
            'name' => 'Operator Transfer Oem',
            'email' => 'operatoroem@gmail.com',
            'nip' => '00003',
            'level_id' => '3',
            'password' => Hash::make(123456789),

        ]);
        User::Create( [
            'name' => 'Operator Transfer Spin On',
            'email' => 'operatorspinon@gmail.com',
            'nip' => '00004',
            'level_id' => '4',
            'password' => Hash::make(123456789),

        ]);
        User::Create( [
            'name' => 'Operator Transfer Set',
            'email' => 'operatorset@gmail.com',
            'nip' => '00005',
            'level_id' => '5',
            'password' => Hash::make(123456789),

        ]);
        User::Create( [
            'name' => 'Operator Transfer Mesin Latex',
            'email' => 'operatormesinlatex@gmail.com',
            'nip' => '00006',
            'level_id' => '6',
            'password' => Hash::make(123456789),

        ]);





    }
}

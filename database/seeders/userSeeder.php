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
            'name' => 'Admin Super',
            'email' => 'adminsuper@gmail.com',
            'nopol' => '2055201058NOPOL',
            'no_rangka' => '2055201058RANGKA',
            'no_hp' => '087880182823',
            'level_id' => '1',
            'tipe_mobil' => 'HONDA BRIO RS',
            'alamat' => 'Cengkareng Jakarta Barat',
            'password' => Hash::make(123456789),

        ]);
        User::Create( [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'nopol' => '2055201058NOPOL2',
            'no_rangka' => '2055201058RANGKA2',
            'no_hp' => '087880182823',
            'level_id' => '2',
            'tipe_mobil' => 'HONDA YARIS',
            'alamat' => 'Cengkareng Jakarta Pusat',
            'password' => Hash::make(123456789),

        ]);
        User::Create( [
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'nopol' => '2055201058NOPOL3',
            'no_rangka' => '2055201058RANGKA3',
            'no_hp' => '087880182823',
            'level_id' => '1',
            'tipe_mobil' => 'HONDA BRV',
            'alamat' => 'Cengkareng Jakarta Timur',
            'password' => Hash::make(123456789),

        ]);




    }
}

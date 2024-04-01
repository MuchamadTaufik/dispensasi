<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            [
                'kelas_id' => 1,
                'name' => 'Muchamad Taufik Mulyadi',
                'email' => 'muhamadtaufikm10@gmail.com',
                'nomor_induk' => '203040142',
                'role_id' => 2,
            ],
            [
                'kelas_id' => 1,
                'name' => 'Cristiano Ronaldo',
                'email' => 'cr7@gmail.com',
                'nomor_induk' => '203040141',
                'role_id' => 1,
            ],

            // [
            //     'kelas_id' => 1,
            //     'name' => 'Taufik',
            //     'email' => 'taufikm10@gmail.com',
            //     'nomor_induk' => '203040140',
            //     'role_id' => 2,
            // ],
            // [
            //     'kelas_id' => 1,
            //     'name' => 'Ronaldo',
            //     'email' => 'r7@gmail.com',
            //     'nomor_induk' => '203040139',
            //     'role_id' => 1,
            // ],
            // [
            //     'kelas_id' => 2,
            //     'name' => 'Messi',
            //     'email' => 'messi@gmail.com',
            //     'nomor_induk' => '203040138',
            //     'role_id' => 3,
            // ],
            // [
            //     'kelas_id' => 3,
            //     'name' => 'neymar',
            //     'email' => 'neymar@gmail.com',
            //     'nomor_induk' => '203040137',
            //     'role_id' => 3,
            // ],
            // [
            //     'kelas_id' => 4,
            //     'name' => 'bale',
            //     'email' => 'bale@gmail.com',
            //     'nomor_induk' => '203040136',
            //     'role_id' => 3,
            // ],
            // [
            //     'kelas_id' => 5,
            //     'name' => 'benzema',
            //     'email' => 'benzema@gmail.com',
            //     'nomor_induk' => '203040135',
            //     'role_id' => 3,
            // ],
            // [
            //     'kelas_id' => 6,
            //     'name' => 'suarez',
            //     'email' => 'suarez@gmail.com',
            //     'nomor_induk' => '203040134',
            //     'role_id' => 3,
            // ],
            // [
            //     'kelas_id' => 7,
            //     'name' => 'kaka',
            //     'email' => 'kaka@gmail.com',
            //     'nomor_induk' => '203040133',
            //     'role_id' => 3,
            // ],
            // [
            //     'kelas_id' => 8,
            //     'name' => 'mbappe',
            //     'email' => 'mbappe@gmail.com',
            //     'nomor_induk' => '203040132',
            //     'role_id' => 3,
            // ],
            // [
            //     'kelas_id' => 9,
            //     'name' => 'halland',
            //     'email' => 'halland@gmail.com',
            //     'nomor_induk' => '203040131',
            //     'role_id' => 3,
            // ],
            // [
            //     'kelas_id' => 10,
            //     'name' => 'zidane',
            //     'email' => 'zidane@gmail.com',
            //     'nomor_induk' => '203040130',
            //     'role_id' => 3,
            // ],
            // Add other users with the same structure
        ];
        
        foreach ($data as $value) {
            User::insert([
                'kelas_id' => $value['kelas_id'] ?? null,
                'name' => $value['name'] ?? null,
                'email' => $value['email'] ?? null,
                'nomor_induk' => $value['nomor_induk'] ?? null,
                'role_id' => $value['role_id'] ?? null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        
    }
}

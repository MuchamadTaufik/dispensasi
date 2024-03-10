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

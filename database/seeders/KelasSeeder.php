<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Kelas::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['name' => 'Guru'],
            ['name' => '10 A IPA'],
            ['name' => '10 B IPA'],
            ['name' => '10 C IPA'],
            ['name' => '11 A IPA'],
            ['name' => '11 B IPA'],
            ['name' => '11 C IPA'],
            ['name' => '12 A IPA'],
            ['name' => '12 B IPA'],
            ['name' => '12 C IPA'],

            ['name' => '10 A IPS'],
            ['name' => '10 B IPS'],
            ['name' => '10 C IPS'],
            ['name' => '11 A IPS'],
            ['name' => '11 B IPS'],
            ['name' => '11 C IPS'],
            ['name' => '12 A IPS'],
            ['name' => '12 B IPS'],
            ['name' => '12 C IPS'],
        ];

        foreach ($data as $value) {
            Kelas::insert([
                'name' => $value['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}

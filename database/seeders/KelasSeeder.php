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

            ['name' => '10 IPA 1'],
            ['name' => '10 IPA 2'],
            ['name' => '10 IPA 3'],
            ['name' => '10 IPA 4'],
            ['name' => '10 IPA 5'],
            ['name' => '10 IPA 6'],

            ['name' => '10 IPS 1'],
            ['name' => '10 IPS 2'],
            ['name' => '10 IPS 3'],
            ['name' => '10 IPS 4'],
            ['name' => '10 IPS 5'],

            ['name' => '10 Agama'],

            ['name' => '11 IPA 1'],
            ['name' => '11 IPA 2'],
            ['name' => '11 IPA 3'],
            ['name' => '11 IPA 4'],
            ['name' => '11 IPA 5'],
            ['name' => '11 IPA 6'],

            ['name' => '11 IPS 1'],
            ['name' => '11 IPS 2'],
            ['name' => '11 IPS 3'],
            ['name' => '11 IPS 4'],
            ['name' => '11 IPS 5'],

            ['name' => '11 Agama'],

            ['name' => '12 IPA 1'],
            ['name' => '12 IPA 2'],
            ['name' => '12 IPA 3'],
            ['name' => '12 IPA 4'],
            ['name' => '12 IPA 5'],
            ['name' => '12 IPA 6'],

            ['name' => '12 IPS 1'],
            ['name' => '12 IPS 2'],
            ['name' => '12 IPS 3'],
            ['name' => '12 IPS 4'],
            ['name' => '12 IPS 5'],

            ['name' => '12 Agama'],
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

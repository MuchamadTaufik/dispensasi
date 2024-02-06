<?php

namespace Database\Seeders;

use App\Models\Alasan;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Alasan::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['name' => 'Sakit'],
            ['name' => 'Izin'],
        ];

        foreach ($data as $value) {
            Alasan::insert([
                'name' => $value['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}

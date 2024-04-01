<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Type::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['name' => 'Dispensasi Izin Masuk ke Sekolah'],
            ['name' => 'Dispensasi Izin Pulang Sekolah'],
        ];

        foreach ($data as $value) {
            Type::insert([
                'name' => $value['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}

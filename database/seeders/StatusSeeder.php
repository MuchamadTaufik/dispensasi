<?php

namespace Database\Seeders;

use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Status::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['name' => 'Pending'],
            ['name' => 'Diterima'],
            ['name' => 'Ditolak'],
            ['name' => 'Selesai'],
        ];

        foreach ($data as $value) {
            Status::insert([
                'name' => $value['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}

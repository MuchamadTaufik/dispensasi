<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'name'     => $row['name'],
            'kelas_id'     => $row['kelas_id'],
            'nomor_induk'    => $row['nomor_induk'],
            'email' => $row['email'],
        ]);
    }
}
